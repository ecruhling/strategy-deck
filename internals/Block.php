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

namespace Strategy_Deck\Internals;

use Strategy_Deck\Engine\Base;
use function add_action;
use function is_array;
use function register_block_type;
use function wp_json_file_decode;

/**
 * Block of this plugin
 */
class Block extends Base {

	/**
	 * Initialize the class.
	 *
	 * @return void
	 */
	public function initialize() {
		parent::initialize();

		add_action( 'init', array( $this, 'register_block' ) );
	}

	/**
	 * Registers and enqueue the block assets
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function register_block() {
		// Register the block by passing the location of block.json to register_block_type.
		$json = wp_json_file_decode( SD_PLUGIN_ROOT . 'assets/src/block/block.json', array( 'associative' => true ) );

		if ( ! is_array( $json ) ) {
			return;
		}

		register_block_type( SD_PLUGIN_ROOT . 'assets/src/block/' );
	}

}
