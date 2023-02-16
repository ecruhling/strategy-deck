// Runs just on the front end.
import FrontendDeckCard from './block/view';
import { render } from '@wordpress/element';
import html2PDF from 'jspdf-html2canvas';

// select all the deck cards
const deckCardClass = '.wp-block-strategydeck-deck-card',
	deckCards = document.querySelectorAll( deckCardClass );

// iterate over the deck cards, apply attributes, and render each component
deckCards.forEach( ( deckCard ) => {
	const attributes = {
		block_id: deckCard.dataset.id,
		post_id: parseInt( deckCard.dataset.post_id, 10 ),
		word: deckCard.firstElementChild.nextElementSibling.innerHTML,
		checked: deckCard.firstElementChild.checked,
	};

	render( <FrontendDeckCard dataAttributes={ attributes } />, deckCard );
} );

// click on #deck-print button
document.getElementById( 'deck-print' ).addEventListener( 'click', () => {
	// the element to print - entire body; the buttons have 'data-html2canvas-ignore' attributes, so they are ignored.
	const body = document.body;

	html2PDF( body, {
		html2canvas: {
			scale: 1,
			foreignObjectRendering: true,
			scrollX: 0,
			scrollY: -window.scrollY,
		},
		jsPDF: {
			orientation: 'landscape',
			// format: 'letter',
			format: [ body.offsetWidth, body.offsetHeight + 150 ],
		},
		imageType: 'image/jpeg',
		output: document.title + '.pdf',
	} );
} );
