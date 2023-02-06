import { useEffect, useState } from '@wordpress/element';

const FrontendDeckCard = ( props ) => {
	const { dataAttributes } = props;

	const [ attributes, setAttributes ] = useState( {
		block_id: 0,
		style: '',
		word: '',
	} );

	const [ isLoading, setLoading ] = useState( false );
	const [ notice, setNotice ] = useState( null );

	// set the attributes, once
	useEffect( () => {
		setAttributes( {
			...dataAttributes,
		} );
	}, [] );

	// Clear notice after delay if not null.
	useEffect( () => {
		if ( null === notice ) {
			return;
		}

		const timer = setTimeout( () => {
			setNotice( null );
		}, 60000 );

		return () => clearTimeout( timer );
	}, [ notice ] );

	return (
		<div
			id={ attributes.block_id }
			style={ {
				color: attributes.style.color,
				backgroundColor: attributes.style.backgroundColor,
			} }
		>
			<label
				className="form-check-label"
				htmlFor={ attributes.block_id + `-input` }
			>
				{ attributes.word }
			</label>
			<input
				id={ attributes.block_id + `-input` }
				name={ attributes.block_id + `-input` }
				value=""
				type="checkbox"
			/>
		</div>
	);
};

export default FrontendDeckCard;
