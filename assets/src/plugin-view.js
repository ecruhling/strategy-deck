// Runs just on the front end.
import FrontendDeckCard from './block/view';
import { render } from '@wordpress/element';

const deckCardClass = '.wp-block-strategydeck-deck-card',
	deckCards = document.querySelectorAll( deckCardClass );

deckCards.forEach( ( deckCard ) => {
	const attributes = {
		block_id: deckCard.dataset.id,
		post_id: parseInt( deckCard.dataset.post_id, 10 ),
		word: deckCard.firstElementChild.nextElementSibling.innerHTML,
		checked: deckCard.firstElementChild.checked,
	};

	render( <FrontendDeckCard dataAttributes={ attributes } />, deckCard );
} );
