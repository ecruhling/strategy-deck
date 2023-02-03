import { useEffect, useState } from '@wordpress/element';

const FrontendDeckCard = ( props ) => {
	const { dataAttributes } = props;

	const [ attributes, setAttributes ] = useState( {
		id: 0,
		style: '',
		word: '',
	} );

	// set the attributes, once
	useEffect( () => {
		setAttributes( {
			...dataAttributes,
		} );
	}, [] );

	return (
		<div
			id={ attributes.id }
			style={ {
				color: attributes.style.color,
				backgroundColor: attributes.style.backgroundColor,
			} }
		>
			<label
				className="form-check-label"
				htmlFor={ attributes.id + `-input` }
			>
				{ attributes.word }
			</label>
			<input
				id={ attributes.id + `-input` }
				name={ attributes.id + `-input` }
				value=""
				type="checkbox"
			/>
		</div>
	);
};

export default FrontendDeckCard;
