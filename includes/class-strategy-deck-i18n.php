<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 *
 * @package    Strategy_Deck
 * @subpackage Strategy_Deck/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Strategy_Deck
 * @subpackage Strategy_Deck/includes
 * @author     Erik Ruhling <erik@resourceatlanta.com>
 */
class Strategy_Deck_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain(): void
    {

		load_plugin_textdomain(
			'resource',
			false,
			dirname(plugin_basename(__FILE__), 2) . '/languages/'
		);

	}



}
