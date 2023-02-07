import { useEffect, useState } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';

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
		}, 1500 );

		return () => clearTimeout( timer );
	}, [ notice ] );

	// save updates.
	const saveUpdates = async () => {
		setLoading( true );
		setNotice( null );

		console.log( { ...attributes, checked: ! checked } );

		const response = await apiFetch( {
			// eslint-disable-next-line no-undef
			path: `${ initDecks.route }/${ dataAttributes.post_id }`, // strategydeck/v1/decks/11622
			method: 'POST',
			data: {
				...attributes,
				checked: ! checked,
			},
		} )
			.then( ( success ) => {
				// Update dataAttributes to reflect changes here...
				// E.g., dataAttributes.someAttr = someAttr;

				dataAttributes.checked = ! checked;

				console.log( dataAttributes.checked );

				return {
					type: 'success',
					message: success,
				};
			} )
			.catch( ( error ) => {
				return {
					type: 'error',
					message: error.message,
				};
			} );

		setLoading( false );
		setNotice( response );
	};

	return (
		<>
			<input
				data-checked={ checked }
				/* eslint-disable-next-line camelcase */
				id={ block_id + `-input` }
				/* eslint-disable-next-line camelcase */
				name={ block_id + `-input` }
				type="checkbox"
				// something wrong here; should not be setting checked
				checked={ checked }
				onChange={ ( change ) => {
					setAttributes( {
						...attributes,
						checked: change.target.checked,
					} );
					saveUpdates();
				} }
			/>
			<label
				className="form-check-label"
				/* eslint-disable-next-line camelcase */
				htmlFor={ block_id + `-input` }
			>
				{ word }
			</label>
			{ null !== notice && (
				<span
					className={ `notice ${ notice.type }` }
					role={ 'error' === notice.type ? 'alert' : 'status' }
				>
					{ notice.message }
				</span>
			) }
		</>
	);
};

export default FrontendDeckCard;
