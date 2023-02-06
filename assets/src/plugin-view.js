import FrontendDeckCard from './block/view';
import { render } from '@wordpress/element';

const deckCardClass = '.wp-block-strategydeck-deck-card',
	deckCards = document.querySelectorAll( deckCardClass );

deckCards.forEach( ( deckCard ) => {
	const attributes = {
		block_id: deckCard.dataset.id,
		post_id: parseInt( deckCard.dataset.post_id, 10 ),
		style: deckCard.style,
		word: deckCard.firstElementChild.innerHTML,
	};

	render( <FrontendDeckCard dataAttributes={ attributes } />, deckCard );
} );
