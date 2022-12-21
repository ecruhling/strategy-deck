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

use Strategy_Deck\Engine\Base;
use function __;
use function add_action;
use function register_extended_post_type;

/**
 * Post Types and Taxonomies
 */
class PostTypes extends Base {

	/**
	 * Initialize the class.
	 *
	 * @return void
	 */
	public function initialize() { // phpcs:ignore
		parent::initialize();

		add_action( 'init', array( $this, 'load_custom_post_types' ) );

	}

	/**
	 * Load CPT and Taxonomies on WordPress
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function load_custom_post_types() { //phpcs:ignore
		// Create Custom Post Type https://github.com/johnbillion/extended-cpts/wiki
		$deck_cpt = register_extended_post_type(
			'deck',
			array(
				'dashboard_glance'    => true,
				'dashboard_activity'  => true,
				'enter_title_here'    => 'Company Name | Project Name',
				'featured_image'      => 'Thumbnail Image',
				'show_in_feed'        => false,
				'slug'                => 'deck',
				'show_in_rest'        => true,
				'hierarchical'        => false,
				'exclude_from_search' => true,
				'publicly_queryable'  => false,
				'show_in_nav_menus'   => false,
				'menu_position'       => 3,
				'menu_icon'           => 'dashicons-layout',
				'has_archive'         => false,
				'query_var'         => false,
				'supports'            => array(
					'title',
					'editor',
					'revisions',
					'author',
					'custom-fields',
				),
				'archive'             => array(
					'nopaging' => true,
				),
				'admin_cols'          => array(
					'title' => array(
						'title'       => 'Company Name | Project Name',
						'meta_key'    => 'title',
					),
					'published' => array(
						'title'       => 'Created On',
						'meta_key'    => 'published_date',
						'date_format' => 'd/m/Y'
					),
				),
			),
			array(
				'singular' => __( 'Deck', SD_TEXTDOMAIN ),
				'plural'   => __( 'Decks', SD_TEXTDOMAIN ),
			)
		);
	}

}
