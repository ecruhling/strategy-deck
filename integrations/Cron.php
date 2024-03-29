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

namespace Strategy_Deck\Integrations;

use Strategy_Deck\Engine\Base;

/**
 * The various Cron of this plugin
 */
class Cron extends Base {

	/**
	 * Initialize the class.
	 *
	 * @return void|bool
	 */
	public function initialize() {
		/*
		 * Load CronPlus
		 */
		$args = array(
			'recurrence'       => 'weekly',
			'schedule'         => 'schedule',
			'name'             => 'weekly_cron',
			'cb'               => array( $this, 'weekly_cron' ),
			'plugin_root_file' => 'strategydeck.php',
		);

//		$cronplus = new \CronPlus( $args );
		// Schedule the event
//		$cronplus->schedule_event();
		// Remove the event by the schedule
		// $cronplus->clear_schedule_by_hook();
		// Jump the scheduled event
		// $cronplus->unschedule_specific_event();
	}

	/**
	 * Cron Hourly example
	 *
	 * @since 1.0.0
	 * @param int $id The ID.
	 * @return void
	 */
	public function weekly_cron( int $id ) {
		echo \esc_html( (string) $id );
	}

}
