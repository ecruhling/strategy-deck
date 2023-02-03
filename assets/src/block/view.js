import { useEffect, useState } from '@wordpress/element';
import { RichText, useBlockProps } from '@wordpress/block-editor';
import { blockStyle } from './index';

const FrontendDeckCard = ( props ) => {
	const { dataAttributes } = props;

	const [ attributes, setAttributes ] = useState( {
		block_id: 0,
	} );

	useEffect( () => {
		setAttributes( {
			...dataAttributes,
		} );
	}, [] );

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
					name={ `deck-card-${ attributes.blockId }-input` }
					value=""
					type="checkbox"
				/>
			</div>
		</div>
	);
};

export default FrontendDeckCard;
