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
use Yoast_I18n_WordPressOrg_v3;

/**
 * Everything that involves notification on the WordPress dashboard
 */
class Notices extends Base {

	/**
	 * Initialize the class
	 *
	 * @return void|bool
	 */
	public function initialize() {
		if ( !parent::initialize() ) {
			return;
		}

		\wpdesk_wp_notice( \__( 'Updated Messages', SD_TEXTDOMAIN ), 'updated' );

		$builder = new \Page_Madness_Detector(); // phpcs:ignore

		if ( $builder->has_entrophy() ) {
			\wpdesk_wp_notice( \__( 'A Page Builder/Visual Composer was found on this website!', SD_TEXTDOMAIN ), 'error', true );
		}

		/*
		 * Review plugin notice.
		 */
		new \WP_Review_Me(
			array(
				'days_after' => 15,
				'type'       => 'plugin',
				'slug'       => SD_TEXTDOMAIN,
				'rating'     => 5,
				'message'    => \__( 'Review me!', SD_TEXTDOMAIN ),
				'link_label' => \__( 'Click here to review', SD_TEXTDOMAIN ),
			)
		);

		/*
		 * Alert after few days to suggest to contribute to the localization if it is incomplete
		 * on translate.wordpress.org, the filter enables to remove globally.
		 */
		if ( \apply_filters( 'strategydeck_alert_localization', true ) ) {
			new Yoast_I18n_WordPressOrg_v3(
			array(
				'textdomain'  => SD_TEXTDOMAIN,
				'strategydeck' => SD_NAME,
				'hook'        => 'admin_notices',
			),
			true
			);
		}

	}

}
