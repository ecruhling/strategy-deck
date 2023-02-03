<?php

/**
 * Registers and enqueue the block assets
 * @return void
 */
function strategy_deck_register_block() {
	// Register the block by passing the location of block.json to register_block_type.
	register_block_type( __DIR__ . '/block' );
}

add_action( 'init', 'strategy_deck_register_block' );
