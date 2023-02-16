// Runs just on the front end.
import FrontendDeckCard from './block/view';
import { render } from '@wordpress/element';
import { jsPDF } from 'jspdf';
import 'html2canvas';
import 'html2pdf.js';

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
	const pdf = new jsPDF( {
		orientation: 'landscape',
		unit: 'pt',
		format: 'ledger',
		putOnlyUsedFonts: false,
	} );

	pdf.html( document.body, {
		html2canvas: {
			scale: 0.9,
		},
		callback() {
			// pdf.save( 'deck.pdf' );
			const iframe = document.createElement( 'iframe' );
			iframe.setAttribute(
				'style',
				'position:fixed;right:0; top:0; height:100vh; width:50vw; z-index: 9999;'
			);
			document.body.appendChild( iframe );
			iframe.src = pdf.output( 'datauristring' );
		},
	} );
}

document.getElementById( 'deck-print' ).addEventListener( 'click', () => {
	printPDF();
} );
