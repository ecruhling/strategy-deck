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

	// eslint-disable-next-line camelcase
	const { block_id, word, checked } = attributes;

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
			<input
				data-checked={ checked }
				/* eslint-disable-next-line camelcase */
				id={ block_id + `-input` }
				/* eslint-disable-next-line camelcase */
				name={ block_id + `-input` }
				type="checkbox"
				checked={ Boolean( checked ) }
				onChange={ ( change ) =>
					setAttributes( {
						...attributes,
						checked: change.target.checked,
					} )
				}
			/>
			<label
				className="form-check-label"
				/* eslint-disable-next-line camelcase */
				htmlFor={ block_id + `-input` }
			>
				{ word }
			</label>
		</>
	);
};

export default FrontendDeckCard;
