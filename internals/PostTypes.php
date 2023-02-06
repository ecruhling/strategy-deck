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
				'publicly_queryable'  => true,
				'show_in_nav_menus'   => false,
				'menu_position'       => 3,
				'menu_icon' => 'data:image/svg+xml;base64,' . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="black" d="M7.47,194.9c-15.37-26.7-6.25-60.7,20.38-76.1L220.7,7.47c26.6-15.37,60.7-6.25,76.1,20.38l167,289.25 c15.3,26.7,6.2,60.7-20.4,76.1L250.5,504.5c-26.6,15.4-60.6,6.3-76-20.3L7.47,194.9z M491.5,301.1L354.7,64.25 c1.8-0.17,3.5-1.15,5.3-1.15h224c30.9,0,56,25.97,56,56V456c0,30.9-25.1,56-56,56H360c-13.6,0-26.2-4.9-35.9-13.9l135.3-77.2 C501.3,396.7,515.7,343.1,491.5,301.1L491.5,301.1z"/></svg>'),
				'has_archive'         => false,
				'query_var'           => false,
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
