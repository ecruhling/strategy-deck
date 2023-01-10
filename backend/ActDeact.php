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

namespace Strategy_Deck\Backend;

use Strategy_Deck\Engine\Base;
use function add_action;
use function delete_option;
use function did_action;
use function flush_rewrite_rules;
use function function_exists;
use function get_option;
use function get_role;
use function get_sites;
use function is_admin;
use function is_multisite;
use function is_null;
use function restore_current_blog;
use function strval;
use function switch_to_blog;
use function update_option;
use function version_compare;

/**
 * Activate and deactivate method of the plugin and relates.
 */
class ActDeact extends Base {

	/**
	 * Initialize the class.
	 *
	 * @return void
	 */
	public function initialize() {
		if ( !parent::initialize() ) {
			return;
		}

		// Activate plugin when new blog is added
		add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );

		add_action( 'admin_init', array( $this, 'upgrade_procedure' ) );
	}

	/**
	 * Fired when a new site is activated with a WPMU environment.
	 *
	 * @param int $blog_id ID of the new blog.
	 * @since 1.0.0
	 * @return void
	 */
	public function activate_new_site( int $blog_id ) {
		if ( 1 !== did_action( 'wpmu_new_blog' ) ) {
			return;
		}

		switch_to_blog( $blog_id );
		self::single_activate();
		restore_current_blog();
	}

	/**
	 * Fired when the plugin is activated.
	 *
	 * @param bool $network_wide True if active in a multisite, false if classic site.
	 * @since 1.0.0
	 * @return void
	 */
	public static function activate( bool $network_wide ) {
		if ( function_exists( 'is_multisite' ) && is_multisite() ) {
			if ( $network_wide ) {
				// Get all blog ids
				/** @var array<\WP_Site> $blogs */
				$blogs = get_sites();

				foreach ( $blogs as $blog ) {
					switch_to_blog( (int) $blog->blog_id );
					self::single_activate();
					restore_current_blog();
				}

				return;
			}
		}

		self::single_activate();
	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @param bool $network_wide True if WPMU superadmin uses
	 * "Network Deactivate" action, false if
	 * WPMU is disabled or plugin is
	 * deactivated on an individual blog.
	 * @since 1.0.0
	 * @return void
	 */
	public static function deactivate( bool $network_wide ) {
		if ( function_exists( 'is_multisite' ) && is_multisite() ) {
			if ( $network_wide ) {
				// Get all blog ids
				/** @var array<\WP_Site> $blogs */
				$blogs = get_sites();

				foreach ( $blogs as $blog ) {
					switch_to_blog( (int) $blog->blog_id );
					self::single_deactivate();
					restore_current_blog();
				}

				return;
			}
		}

		self::single_deactivate();
	}

	/**
	 * Add admin capabilities
	 *
	 * @return void
	 */
	public static function add_capabilities() {
		// Add the capabilities to all the roles
		$caps  = array(
			'create_plugins',
			'read_deck',
			'read_private_decks',
			'edit_deck',
			'edit_decks',
			'edit_private_decks',
			'edit_published_decks',
			'edit_others_decks',
			'publish_decks',
			'delete_deck',
			'delete_decks',
			'delete_private_decks',
			'delete_published_decks',
			'delete_others_decks',
			'manage_decks',
		);
		$roles = array(
			get_role( 'administrator' ),
			get_role( 'editor' ),
			get_role( 'author' ),
			get_role( 'contributor' ),
			get_role( 'subscriber' ),
		);

		foreach ( $roles as $role ) {
			foreach ( $caps as $cap ) {
				if ( is_null( $role ) ) {
					continue;
				}

				$role->add_cap( $cap );
			}
		}
	}

	/**
	 * Remove capabilities to specific roles
	 *
	 * @return void
	 */
	public static function remove_capabilities() {
		// Remove capabilities to specific roles
		$bad_caps = array(
			'create_decks',
			'read_private_decks',
			'edit_deck',
			'edit_decks',
			'edit_private_decks',
			'edit_published_decks',
			'edit_others_decks',
			'publish_decks',
			'delete_deck',
			'delete_decks',
			'delete_private_decks',
			'delete_published_decks',
			'delete_others_decks',
			'manage_decks',
		);
		$roles    = array(
			get_role( 'author' ),
			get_role( 'contributor' ),
			get_role( 'subscriber' ),
		);

		foreach ( $roles as $role ) {
			foreach ( $bad_caps as $cap ) {
				if ( is_null( $role ) ) {
					continue;
				}

				$role->remove_cap( $cap );
			}
		}
	}

	/**
	 * Upgrade procedure
	 *
	 * @return void
	 */
	public static function upgrade_procedure() {
		if ( ! is_admin() ) {
			return;
		}

		$version = strval( get_option( 'strategydeck-version' ) );

		if ( ! version_compare( SD_VERSION, $version, '>' ) ) {
			return;
		}

		update_option( 'strategydeck-version', SD_VERSION );
		delete_option( SD_TEXTDOMAIN . '_fake-meta' );
	}

	/**
	 * Fired for each blog when the plugin is activated.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	private static function single_activate() {
		// @TODO: Define activation functionality here
		// add_role( 'advanced', __( 'Advanced' ) ); //Add a custom roles
		self::add_capabilities();
		self::upgrade_procedure();
		// Clear the permalinks
		flush_rewrite_rules();
	}

	/**
	 * Fired for each blog when the plugin is deactivated.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	private static function single_deactivate() {
		// @TODO: Define deactivation functionality here
		self::remove_capabilities();
		// Clear the permalinks
		flush_rewrite_rules();
	}

}
