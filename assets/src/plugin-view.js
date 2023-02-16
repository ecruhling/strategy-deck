// Runs just on the front end.
import FrontendDeckCard from './block/view';
import { render } from '@wordpress/element';
import 'jspdf';
import html2canvas from 'html2canvas';
import html2pdf from 'html2pdf.js';

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

// function printPDF() {
// 	const pdf = new jsPDF( {
// 		orientation: 'landscape',
// 		unit: 'pt',
// 		format: 'ledger',
// 		putOnlyUsedFonts: false,
// 	} );
//
// 	pdf.html( document.body, {
// 		html2canvas: {
// 			scale: 0.9,
// 		},
// 		callback() {
// 			// pdf.save( 'deck.pdf' );
// 			const iframe = document.createElement( 'iframe' );
// 			iframe.setAttribute(
// 				'style',
// 				'position:fixed;right:0; top:0; height:100vh; width:50vw; z-index: 9999;'
// 			);
// 			document.body.appendChild( iframe );
// 			iframe.src = pdf.output( 'datauristring' );
// 		},
// 	} );
// }

// click on #deck-print button
document.getElementById( 'deck-print' ).addEventListener( 'click', () => {
	// the element to print - entire body; the buttons have 'data-html2canvas-ignore' attributes, so they are ignored.
	const body = document.body;

	// the options to pass to html2pdf()
	const opt = {
		filename: document.title + '.pdf',
		html2canvas: {
			scale: 0.9,
			foreignObjectRendering: true,
		},
		jsPDF: {
			orientation: 'landscape',
			unit: 'in',
			format: 'ledger',
		},
	};

	// create PDF and save it
	html2pdf().set( opt ).from( body ).save();
} );

// testing canvas by appending it to the document
// html2canvas( document.body, {
// 	foreignObjectRendering: true,
// 	width: document.documentElement.scrollWidth,
// 	height: document.documentElement.scrollHeight,
// } ).then( function ( canvas ) {
// 	document.body.appendChild( canvas );
// } );
