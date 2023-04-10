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

/**
 * Restrict the 'deck' post type to only use the Deck Card block.
 *
 * @since 1.0.0
 * @return array
 */

add_filter( 'allowed_block_types_all', 'allowed_post_type_blocks', 10, 2 );

function allowed_post_type_blocks( $allowed_block_types, $editor_context ) {
	if ( 'deck' === $editor_context->post->post_type ) {
		return array(
			'strategydeck/deck-card',
		);
	}

	return $allowed_block_types;
}
