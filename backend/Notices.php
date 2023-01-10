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

/**
 * Everything that involves notification on the WordPress dashboard
 */
class Notices extends Base {

	/**
	 * Initialize the class
	 *
	 * @return void
	 */
	public function initialize() {
		if ( !parent::initialize() ) {
			return;
		}

//		\wpdesk_wp_notice( \__( 'Updated Messages', SD_TEXTDOMAIN ), 'updated' );

		$builder = new \Page_Madness_Detector(); // phpcs:ignore

		if ( $builder->has_entrophy() ) {
			\wpdesk_wp_notice( \__( 'A Page Builder/Visual Composer was found on this website!', SD_TEXTDOMAIN ), 'error', true );
		}

	}

}
