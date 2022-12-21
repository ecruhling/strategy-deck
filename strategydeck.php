<?php

/**
 * @package   Strategy_Deck
 * @author    Erik Rühling <ecruhling@gmail.com>
 * @copyright Resource Branding
 * @link      https://resourceatlanta.com
 *
 * Plugin Name:     Strategy Deck
 * Plugin URI:      @TODO
 * Description:     @TODO
 * Version:         1.0.0
 * Author:          Erik Rühling
 * Author URI:      https://resourceatlanta.com
 * Text Domain:     strategydeck
 * License:         GPL 2.0+
 * License URI:     http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path:     /languages
 * Requires PHP:    7.4
 */

// If this file is called directly, abort.
if ( !defined( 'ABSPATH' ) ) {
	die( 'We\'re sorry, but you can not directly access this file.' );
}

define( 'SD_VERSION', '1.0.0' );
define( 'SD_TEXTDOMAIN', 'strategydeck' );
define( 'SD_NAME', 'Strategy Deck' );
define( 'SD_PLUGIN_ROOT', plugin_dir_path( __FILE__ ) );
define( 'SD_PLUGIN_ABSOLUTE', __FILE__ );
define( 'SD_MIN_PHP_VERSION', '7.4' );
define( 'SD_WP_VERSION', '5.3' );

if ( version_compare( PHP_VERSION, SD_MIN_PHP_VERSION, '<=' ) ) {
	add_action(
		'admin_init',
		static function() {
			deactivate_plugins( plugin_basename( __FILE__ ) );
		}
	);
	add_action(
		'admin_notices',
		static function() {
			echo wp_kses_post(
			sprintf(
				'<div class="notice notice-error"><p>%s</p></div>',
				__( '"Strategy Deck" requires PHP 5.6 or newer.', SD_TEXTDOMAIN )
			)
			);
		}
	);

	// Return early to prevent loading the plugin.
	return;
}

$strategydeck_libraries = require SD_PLUGIN_ROOT . 'vendor/autoload.php'; //phpcs:ignore

require_once SD_PLUGIN_ROOT . 'functions/functions.php';
require_once SD_PLUGIN_ROOT . 'functions/debug.php';

$requirements = new \Micropackage\Requirements\Requirements(
	'Strategy Deck',
	array(
		'php'            => SD_MIN_PHP_VERSION,
		'php_extensions' => array( 'mbstring' ),
		'wp'             => SD_WP_VERSION,
	)
);

if ( ! $requirements->satisfied() ) {
	$requirements->print_notice();

	return;
}


/**
 * Create a helper function for easy SDK access.
 *
 * @global type $sd_fs
 * @return object
 */
function sd_fs(): object
{
	global $sd_fs;

	if ( !isset( $sd_fs ) ) {
		require_once SD_PLUGIN_ROOT . 'vendor/freemius/wordpress-sdk/start.php';
		$sd_fs = fs_dynamic_init(
			array(
				'id'             => '',
				'slug'           => 'strategydeck',
				'public_key'     => '',
				'is_live'        => false,
				'is_premium'     => true,
				'has_addons'     => false,
				'has_paid_plans' => true,
				'menu'           => array(
					'slug' => 'strategydeck',
				),
			)
		);

		if ( $sd_fs->is_premium() ) {
			$sd_fs->add_filter(
				'support_forum_url',
				static function ( $wp_org_support_forum_url ) { //phpcs:ignore
					return 'https://your-url.test';
				}
			);
		}
	}

	return $sd_fs;
}

// sd_fs();

// Documentation to integrate GitHub, GitLab or BitBucket https://github.com/YahnisElsts/plugin-update-checker/blob/master/README.md
Puc_v4_Factory::buildUpdateChecker( 'https://github.com/user-name/repo-name/', __FILE__, 'unique-plugin-or-theme-slug' );

if ( ! wp_installing() ) {
	register_activation_hook( SD_TEXTDOMAIN . '/' . SD_TEXTDOMAIN . '.php', array( new \Strategy_Deck\Backend\ActDeact, 'activate' ) );
	register_deactivation_hook( SD_TEXTDOMAIN . '/' . SD_TEXTDOMAIN . '.php', array( new \Strategy_Deck\Backend\ActDeact, 'deactivate' ) );
	add_action(
		'plugins_loaded',
		static function () use ( $strategydeck_libraries ) {
			new \Strategy_Deck\Engine\Initialize( $strategydeck_libraries );
		}
	);
}
