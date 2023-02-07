import { RichText, useBlockProps } from '@wordpress/block-editor';
import { useEffect } from '@wordpress/element';

export const Edit = ( {
	clientId,
	isSelected,
	attributes: { id, word, checked },
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
		<div { ...useBlockProps() } id={ `deck-card-${ id }` }>
			<input
				data-checked={ checked.toString() }
				id={ `${ id }-input` }
				name={ `${ id }-input` }
				type="checkbox"
				checked={ checked }
				onChange={ ( change ) =>
					setAttributes( {
						checked: change.target.checked,
					} )
				}
			/>
			<RichText
				className="form-check-label"
				htmlFor={ `${ id }-input` }
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
	);
};
