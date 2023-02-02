import { RichText, useBlockProps } from '@wordpress/block-editor';
import { useEffect } from '@wordpress/element';

import { blockStyle } from './index';

export const Edit = ( {
	clientId,
	isSelected,
	attributes: { blockId, word, style },
	setAttributes,
} ) => {
	// useEffect sets the blockId once and only once.
	useEffect( () => {
		if ( 0 === blockId.length ) {
			setAttributes( {
				blockId: clientId,
			} );
		}
	}, [] );

	return (
		<div
			className={ 'deck-card-container' }
			id={ `deck-card-${ blockId }` }
		>
			<div
				{ ...useBlockProps( {
					style: { ...blockStyle, style },
				} ) }
			>
				<RichText
					tagName="label"
					value={ word }
					onChange={ ( value ) => setAttributes( { word: value } ) }
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
