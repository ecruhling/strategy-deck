<?php

/**
 * Strategy_Deck
 *
 * @package   Strategy_Deck
 * @author    Erik Rühling <ecruhling@gmail.com>
 * @copyright Resource Branding
 * @license   GPL 2.0+
 * @link      https://resourceatlanta.com
 */

namespace Strategy_Deck\Internals;

use CPT_columns;
use Seravo_Custom_Bulk_Action;
use Strategy_Deck\Engine\Base;
use WP_Query;
use function __;
use function add_action;
use function add_filter;
use function array_push;
use function is_admin;
use function is_array;
use function post_type_exists;
use function register_extended_post_type;
use function register_extended_taxonomy;
use function sprintf;
use function wp_count_posts;

/**
 * Post Types and Taxonomies
 */
class PostTypes extends Base {

	/**
	 * Initialize the class.
	 *
	 * @return void|bool
	 */
	public function initialize() { // phpcs:ignore
		parent::initialize();

		add_action( 'init', array( $this, 'load_cpts' ) );
		/*
		 * Custom Columns
		 */
		$post_columns = new CPT_columns( 'deck' );
		$post_columns->add_column(
			'cmb2_field',
			array(
				'label'    => __( 'CMB2 Field', SD_TEXTDOMAIN ),
				'type'     => 'post_meta',
				'meta_key' => '_deck_' . SD_TEXTDOMAIN . '_text', // phpcs:ignore WordPress.DB
				'orderby'  => 'meta_value',
				'sortable' => true,
				'prefix'   => '<b>',
				'suffix'   => '</b>',
				'def'      => 'Not defined', // Default value in case post meta not found
				'order'    => '-1',
			)
		);
		/*
		 * Custom Bulk Actions
		 */
		$bulk_actions = new Seravo_Custom_Bulk_Action( array( 'post_type' => 'demo' ) );
		$bulk_actions->register_bulk_action(
			array(
				'menu_text'    => 'Mark meta',
				'admin_notice' => 'Written something on custom bulk meta',
				'callback'     => static function( $post_ids ) {
					foreach ( $post_ids as $post_id ) {
						\update_post_meta( $post_id, '_deck_' . SD_TEXTDOMAIN . '_text', 'Random stuff' );
					}

					return true;
				},
			)
		);
		$bulk_actions->init();
		// Add bubble notification for cpt pending
		add_action( 'admin_menu', array( $this, 'pending_cpt_bubble' ), 999 );
		add_filter( 'pre_get_posts', array( $this, 'filter_search' ) );
	}

	/**
	 * Add support for custom CPT on the search box
	 *
	 * @param WP_Query $query WP_Query.
	 * @since 1.0.0
	 * @return WP_Query
	 */
	public function filter_search( WP_Query $query ) {
		if ( $query->is_search && ! is_admin() ) {
			$post_types = $query->get( 'post_type' );

			if ( 'post' === $post_types ) {
				$post_types = array( $post_types );
				$query->set( 'post_type', array_push( $post_types, array( 'deck' ) ) );
			}
		}

		return $query;
	}

	/**
	 * Load CPT and Taxonomies on WordPress
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function load_cpts() { //phpcs:ignore
		// Create Custom Post Type https://github.com/johnbillion/extended-cpts/wiki
		$deck_cpt = register_extended_post_type(
				'deck',
				array(
					// Show all posts on the post type archive:
					'archive'            => array(
						'nopaging' => true,
					),
					'slug'               => 'deck',
					'show_in_rest'       => true,
					'dashboard_activity' => true,
//					'capability_type'    => array( 'deck', 'decks' ),
					// Add some custom columns to the admin screen
					'admin_cols'         => array(
						'featured_image' => array(
							'title'          => 'Featured Image',
							'featured_image' => 'thumbnail',
						),
						'title',
						'genre'          => array(
							'taxonomy' => 'deck-section',
						),
						'custom_field'   => array(
							'title'    => 'By Lib',
							'meta_key' => '_deck_' . SD_TEXTDOMAIN . '_text', // phpcs:ignore
							'cap'      => 'manage_options',
						),
						'date'           => array(
							'title'   => 'Date',
							'default' => 'ASC',
						),
					),
					// Add a dropdown filter to the admin screen:
					'admin_filters'      => array(
						'genre' => array(
							'taxonomy' => 'deck-section',
						),
					),
			),
			array(
				// Override the base names used for labels:
				'singular' => __( 'Deck', SD_TEXTDOMAIN ),
				'plural'   => __( 'Decks', SD_TEXTDOMAIN ),
			)
		);

		$deck_cpt->add_taxonomy( 'deck-section', array( 'hierarchical' => false, 'show_ui' => false ) );
		// Create Custom Taxonomy https://github.com/johnbillion/extended-taxos
		register_extended_taxonomy(
			'deck-section',
			'deck',
			array(
				// Use radio buttons in the meta box for this taxonomy on the post editing screen:
				'meta_box'         => 'radio',
				// Show this taxonomy in the 'At a Glance' dashboard widget:
				'dashboard_glance' => true,
				// Add a custom column to the admin screen:
				'admin_cols'       => array(
					'featured_image' => array(
						'title'          => 'Featured Image',
						'featured_image' => 'thumbnail',
					),
				),
				'slug'             => 'deck-cat',
				'show_in_rest'     => true,
				'capabilities'     => array(
					'manage_terms' => 'manage_decks',
					'edit_terms'   => 'manage_decks',
					'delete_terms' => 'manage_decks',
					'assign_terms' => 'read_deck',
				),
			),
			array(
				// Override the base names used for labels:
				'singular' => __( 'Deck Category', SD_TEXTDOMAIN ),
				'plural'   => __( 'Deck Categories', SD_TEXTDOMAIN ),
			)
		);
	}

	/**
	 * Bubble Notification for pending cpt<br>
	 * NOTE: add in $post_types your cpts<br>
	 *
	 *        Reference:  http://wordpress.stackexchange.com/questions/89028/put-update-like-notification-bubble-on-multiple-cpts-menus-for-pending-items/95058
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function pending_cpt_bubble() {
		global $menu;

		$post_types = array( 'deck' );

		foreach ( $post_types as $type ) {
			if ( ! post_type_exists( $type ) ) {
				continue;
			}

			// Count posts
			$cpt_count = wp_count_posts( $type );

			if ( !$cpt_count->pending ) {
				continue;
			}

			// Locate the key of
			$key = self::recursive_array_search_php( 'edit.php?post_type=' . $type, $menu );

			// Not found, just in case
			if ( !$key ) {
				return;
			}

			// Modify menu item
			$menu[ $key ][ 0 ] .= sprintf( //phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				'<span class="update-plugins count-%1$s"><span class="plugin-count">%1$s</span></span>',
				$cpt_count->pending
			);
		}
	}

	/**
	 * Required for the bubble notification<br>
	 *
	 *  Reference:  http://wordpress.stackexchange.com/questions/89028/put-update-like-notification-bubble-on-multiple-cpts-menus-for-pending-items/95058
	 *
	 * @param string $needle First parameter.
	 * @param array  $haystack Second parameter.
	 * @since 1.0.0
	 * @return string|bool
	 */
	private function recursive_array_search_php( string $needle, array $haystack ) {
		foreach ( $haystack as $key => $value ) {
			$current_key = $key;

			if (
				$needle === $value ||
				( is_array( $value ) &&
				false !== self::recursive_array_search_php( $needle, $value ) )
			) {
				return $current_key;
			}
		}

		return false;
	}

}
