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
use function add_filter;
use function in_the_loop;
use function is_singular;
use function wpbp_get_template_part;

/**
 * Load custom template files
 */
class Template extends Base {

	/**
	 * Initialize the class.
	 *
	 * @return void
	 */
	public function initialize() {
		parent::initialize();

		// Override the template hierarchy for load /templates/content-demo.php
		add_filter( 'template_include', array( self::class, 'load_content_template' ) );
	}

	/**
	 * Override the template system on the frontend
	 *
	 * @param string $original_template The original template HTML.
	 * @since 1.0.0
	 * @return string
	 */
	public static function load_content_template( string $original_template ): string {
		if ( is_singular( 'deck' )) {
			return wpbp_get_template_part( SD_TEXTDOMAIN, 'content', 'deck', false );
		}

		return $original_template;
	}

}
