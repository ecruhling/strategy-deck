import {
	InspectorControls,
	RichText,
	useBlockProps,
} from '@wordpress/block-editor';
import { Panel, PanelBody, PanelRow, TextControl } from '@wordpress/components';
import { blockStyle } from './index';

export const Edit = ( {
	clientId,
	isSelected,
	style,
	attributes,
	setAttributes,
} ) => {
	setAttributes( { blockId: clientId } );

	return (
		<div
			className={ 'deck-card-container' }
			id={ `deck-card-${ attributes.blockId }` }
		>
			<div
				{ ...useBlockProps( {
					style: { ...blockStyle, style },
				} ) }
			>
				<RichText
					tagName="label"
					value={ attributes.word }
					onChange={ ( word ) => setAttributes( { word } ) }
					style={
						isSelected
							? { border: '1px dashed black' }
							: { border: 'none' }
					}
				/>
			</div>
		</div>
	);
};
