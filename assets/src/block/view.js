import { useEffect, useState } from '@wordpress/element';

const FrontendDeckCard = ( props ) => {
	const { dataAttributes } = props;

	const [ attributes, setAttributes ] = useState( {
		block_id: 0,
		post_id: 0,
		word: '',
		checked: false,
	} );

	const [ isLoading, setLoading ] = useState( false );
	const [ notice, setNotice ] = useState( null );

	// set the attributes, once
	useEffect( () => {
		setAttributes( {
			...dataAttributes,
		} );
	}, [] );

	console.log( attributes );

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
		<>
			<label
				className="form-check-label"
				htmlFor={ attributes.block_id + `-input` }
			>
				{ attributes.word }
			</label>
			<input
				data-checked={ attributes.checked }
				id={ attributes.block_id + `-input` }
				name={ attributes.block_id + `-input` }
				type="checkbox"
				checked={ Boolean( attributes.checked ) }
				onChange={ ( change ) =>
					setAttributes( {
						...attributes,
						checked: change.target.checked,
					} )
				}
			/>
		</>
	);
};

export default FrontendDeckCard;
