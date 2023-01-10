import { useBlockProps, RichText } from '@wordpress/block-editor';
import { blockStyle } from './index';

export const Save = ( { attributes } ) => {
	return (
		<div
			{ ...useBlockProps.save( {
				style: { ...blockStyle },
				className: 'wp-block-strategydeck-deck-card',
			} ) }
		>
			<RichText.Content tagName="p" value={ attributes.word } />
		</div>
	);
};
