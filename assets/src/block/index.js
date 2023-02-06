/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';
import { blockIcon } from './icon';

// The block configuration
const blockConfig = require( './block.json' );

import { Edit } from './edit';
// not used because this is a dynamic block (render-block.php creates the front end markup)
// import { Save } from './save';

// Register the block
/// https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
registerBlockType( blockConfig.name, {
	...blockConfig,
	icon: blockIcon,
	edit: Edit,
	// save: Save,
	save: () => null,
} );
