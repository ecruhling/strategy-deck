import FrontendDeckCard from './block/view';
import { render } from '@wordpress/element';

const deckCardClass = '.wp-block-strategydeck-deck-card',
	deckCards = document.querySelectorAll( deckCardClass );

deckCards.forEach( ( deckCard ) => {
	const attributes = {
		id: deckCard.id,
		style: deckCard.style,
	};

	render( <FrontendDeckCard dataAttributes={ attributes } />, deckCard );
} );
