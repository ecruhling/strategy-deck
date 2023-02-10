// Runs just on the front end.
import FrontendDeckCard from './block/view';
import { render } from '@wordpress/element';
import { jsPDF } from 'jspdf';
import 'html2canvas';

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

function printPDF() {
	const doc = new jsPDF();
	doc.html( document.getElementById( 'deck-form' ), function () {
		doc.save( 'deck.pdf' );
	} );
}

document
	.getElementById( 'deck-print' )
	.addEventListener( 'click', ( event ) => {
		printPDF();
		console.log( event );
	} );
