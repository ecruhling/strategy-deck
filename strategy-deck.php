<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @since             1.0.0
 * @package           Strategy_Deck
 *
 * @wordpress-plugin
 * Plugin Name:       Resource Client Strategy Deck
 * Plugin URI:        https://resourceatlanta.com/
 * Description:       A client strategy deck.
 * Version:           1.0.0
 * Author:            Resource Branding
 * Author URI:        https://resourceatlanta.com/
 * Text Domain:       resource
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The plugin version.
 */
define( 'STRATEGY_DECK_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-resource-activator.php
 */
function activate_plugin_name(): void
{
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-resource-activator.php';
	Strategy_Deck_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-resource-deactivator.php
 */
function deactivate_plugin_name(): void
{
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-resource-deactivator.php';
	Strategy_Deck_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_plugin_name' );
register_deactivation_hook( __FILE__, 'deactivate_plugin_name' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-resource.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_strategy_deck(): void
{

	$plugin = new Strategy_Deck();
	$plugin->run();

}
run_strategy_deck();
