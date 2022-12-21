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

namespace Strategy_Deck\Frontend\Extras;

use Strategy_Deck\Engine\Base;

/**
 * Add custom css class to <body>
 */
class Body_Class extends Base {

	/**
	 * Initialize the class.
	 *
	 * @return void|bool
	 */
	public function initialize() {
		parent::initialize();

		\add_filter( 'body_class', array( self::class, 'add_sd_class' ), 10, 3 );
	}

	/**
	 * Add class in the body on the frontend
	 *
	 * @param array $classes The array with all the classes of the page.
	 * @since 1.0.0
	 * @return array
	 */
	public static function add_sd_class( array $classes ) {
		$classes[] = SD_TEXTDOMAIN;

		return $classes;
	}

}
