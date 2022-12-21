<?php

/**
 * @package   Strategy_Deck
 * @author    Erik Rühling <ecruhling@gmail.com>
 * @copyright Resource Branding
 * @link      https://resourceatlanta.com
 *
 * Plugin Name:     Resource Client Strategy Deck
 * Plugin URI:      https://resourceatlanta.com/
 * Description:     Creates a custom post type 'decks' that is used in the client discovery phase.
 * Version:         1.0.0
 * Author:          Erik Rühling
 * Author URI:      https://resourceatlanta.com
 * Text Domain:     resource
 * License:         GPL 2.0+
 * License URI:     http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path:     /languages
 * Requires PHP:    7.4
 */

use Micropackage\Requirements\Requirements;
use Strategy_Deck\Backend\ActDeact;
use Strategy_Deck\Engine\Initialize;

// If this file is called directly, abort.
if ( !defined( 'ABSPATH' ) ) {
	die( 'This file may not be directly accessed.' );
}

const SD_VERSION = '1.0.0';
const SD_TEXTDOMAIN = 'resource';
const SD_NAME = 'Strategy Deck';
define( 'SD_PLUGIN_ROOT', plugin_dir_path( __FILE__ ) );
const SD_PLUGIN_ABSOLUTE = __FILE__;
const SD_MIN_PHP_VERSION = '7.4';
const SD_WP_VERSION      = '5.3';

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
				__( 'The "Resource Client Strategy Deck" plugin requires PHP 7.4 or newer.', SD_TEXTDOMAIN )
			)
			);
		}
	);

	// Return early to prevent loading the plugin.
	return;
}

$strategy_deck_libraries = require SD_PLUGIN_ROOT . 'vendor/autoload.php'; //phpcs:ignore

require_once SD_PLUGIN_ROOT . 'functions/functions.php';
require_once SD_PLUGIN_ROOT . 'functions/debug.php';

$requirements = new Requirements(
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

// Documentation to integrate GitHub, GitLab or BitBucket https://github.com/YahnisElsts/plugin-update-checker/blob/master/README.md
Puc_v4_Factory::buildUpdateChecker( 'https://github.com/ecruhling/strategy-deck/', __FILE__, 'strategydeck' );

if ( ! wp_installing() ) {
	register_activation_hook( SD_TEXTDOMAIN . '/' . SD_TEXTDOMAIN . '.php', array( new ActDeact, 'activate' ) );
	register_deactivation_hook( SD_TEXTDOMAIN . '/' . SD_TEXTDOMAIN . '.php', array( new ActDeact, 'deactivate' ) );
	add_action(
		'plugins_loaded',
		static function () use ( $strategy_deck_libraries ) {
			new Initialize( $strategy_deck_libraries );
		}
	);
}
