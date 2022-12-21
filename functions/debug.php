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

$sd_debug = new WPBP_Debug( __( 'Strategy Deck', SD_TEXTDOMAIN ) );

/**
 * Log text inside the debugging plugins.
 *
 * @param string $text The text.
 * @return void
 */
function sd_log( string $text ) {
	global $sd_debug;
	$sd_debug->log( $text );
}
