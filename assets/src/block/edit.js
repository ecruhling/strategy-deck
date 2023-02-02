import { RichText, useBlockProps } from '@wordpress/block-editor';
import { useEffect } from '@wordpress/element';

import { blockStyle } from './index';

export const Edit = ( {
	clientId,
	isSelected,
	attributes: { id, word, style },
	setAttributes,
} ) => {
	// useEffect sets the id once and only once.
	useEffect( () => {
		// if id has not been created, create and set it
		// this ensures it is set only once, at block creation
		if ( id.length === 0 ) {
			setAttributes( {
				id: clientId,
			} );
		}
	}, [] );

	return (
		<div className={ 'deck-card-container' } id={ `deck-card-${ id }` }>
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
