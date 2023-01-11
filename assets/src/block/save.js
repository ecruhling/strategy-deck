import { useBlockProps, RichText } from '@wordpress/block-editor';
import { blockStyle } from './index';

export const Save = ( { attributes } ) => {
	return (
		<div className={ 'deck-card-container' }>
			<div
				{ ...useBlockProps.save( {
					style: { ...blockStyle },
					className: 'wp-block-strategydeck-deck-card',
				} ) }
			>
				<RichText.Content
					className="form-check-label"
					tagName="label"
					value={ attributes.word }
				/>
				<input value="" type="checkbox" />
			</div>
		</div>
	);
};
