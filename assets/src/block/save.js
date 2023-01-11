import { useBlockProps, RichText } from '@wordpress/block-editor';
import { blockStyle } from './index';

export const Save = ( { attributes } ) => {
	return (
		<div
			className={ 'deck-card-container' }
			id={ `deck-card-${ attributes.blockId }` }
		>
			<div
				{ ...useBlockProps.save( {
					style: { ...blockStyle },
					className: 'wp-block-strategydeck-deck-card',
				} ) }
			>
				<RichText.Content
					className="form-check-label"
					tagName="label"
					htmlFor={ `deck-card-${ attributes.blockId }-input` }
					value={ attributes.word }
				/>
				<input
					id={ `deck-card-${ attributes.blockId }-input` }
					value=""
					type="checkbox"
				/>
			</div>
		</div>
	);
};
