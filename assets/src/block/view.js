import { useEffect, useState } from '@wordpress/element';
import { RichText, useBlockProps } from '@wordpress/block-editor';
import { blockStyle } from './index';

const FrontendDeckCard = ( props ) => {
	const { dataAttributes } = props;

	const [ attributes, setAttributes ] = useState( {
		id: 0,
		style: '',
	} );

	useEffect( () => {
		setAttributes( {
			...dataAttributes,
		} );
	}, [] );

	return (
		<div className="deck-card-container" id={ attributes.id }>
			<div style={ attributes.style }>
				{ /* eslint-disable-next-line jsx-a11y/label-has-associated-control */ }
				<label className="form-check-label" htmlFor="-input"></label>
				<input id="-input" name="-input" value="" type="checkbox" />
			</div>
		</div>
	);
};

export default FrontendDeckCard;
