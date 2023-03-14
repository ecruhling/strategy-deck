// Runs just on the front end.
import FrontendDeckCard from './block/view';
import { render } from '@wordpress/element';
import html2PDF from 'jspdf-html2canvas';

// select all the deck cards
const deckCards = document.querySelectorAll(
	'.wp-block-strategydeck-deck-card'
);

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
document
	.getElementById( 'deck-print' )
	.addEventListener( 'click', ( event ) => {
		// the element to print - entire body; the buttons have 'data-html2canvas-ignore' attributes, so they are ignored.
		const body = document.body;
		const timestamp = new Date().getTime();
		const title = event.target.getAttribute( 'data-title' );

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
			output: title + '-' + timestamp + '.pdf',
		} );
	} );

// click on #deck-reset button
document.getElementById( 'deck-reset' ).addEventListener( 'click', () => {
	const deckCardInputsChecked = document.querySelectorAll(
		"input[data-checked='true']"
	);

	// generate clicks on each card that is checked
	deckCardInputsChecked.forEach( ( inputElement, index ) => {
		// add timeout function to slow down rate of clicks
		setTimeout( function () {
			inputElement.click();
		}, index * 150 );
	} );
} );
