import { useEffect, useState } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';
import { RichText } from '@wordpress/block-editor';

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
		}, 250 );

		return () => clearTimeout( timer );
	}, [ notice ] );

	// save updates.
	const saveUpdates = async () => {
		setLoading( true );
		setNotice( null );

		const response = await apiFetch( {
			// eslint-disable-next-line no-undef
			path: `${ initDecks.route }/${ dataAttributes.post_id }`, // strategydeck/v1/decks/11622
			method: 'POST',
			data: {
				...attributes,
				checked: ! checked,
				// eslint-disable-next-line camelcase
				block_id,
				word,
			},
		} )
			.then( ( success ) => {
				// Update dataAttributes to reflect changes.
				dataAttributes.checked = ! checked;

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
				checked={ checked }
				onChange={ ( change ) => {
					setAttributes( {
						...attributes,
						checked: change.target.checked,
					} );
					saveUpdates();
				} }
			/>
			{ /*<label*/ }
			{ /*	className="form-check-label"*/ }
			{ /*	htmlFor={ block_id + `-input` }*/ }
			{ /*>*/ }
			{ /*	{ word }*/ }
			{ /*</label>*/ }
			<RichText
				className="form-check-label"
				/* eslint-disable-next-line camelcase */
				htmlFor={ block_id + `-input` }
				tagName="label"
				value={ word }
				onChange={ ( value ) =>
					setAttributes( { ...attributes, word: value } )
				}
				// style={
				// 	isSelected
				// 		? { border: '1px dashed black' }
				// 		: { border: 'none' }
				// }
			/>
			{ null !== notice && (
				<span
					className={ `notice ${ notice.type }` }
					role={ 'error' === notice.type ? 'alert' : 'status' }
				>
					{ notice.message }
					<svg className="spinner">
						<circle cx="10" cy="10" r="7"></circle>
					</svg>
				</span>
			) }
		</>
	);
};

export default FrontendDeckCard;
