<?php
/**
 * Strategy_Deck
 *
 * @package   Strategy_Deck
 * @author    Erik Rühling <ecruhling@gmail.com>
 * @copyright Resource Branding
 * @license   GPL 2.0+
 * @link      https://resourceatlanta.com
 */

namespace Strategy_Deck\Ajax;

use Strategy_Deck\Engine\Base;
use function add_action;
use function apply_filters;
use function wp_send_json_success;

/**
 * AJAX in the public
 */
class Ajax extends Base {

	/**
	 * Initialize the class.
	 *
	 * @return void
	 */
	public function initialize() {
		if ( ! apply_filters( 'strategydeck_sd_ajax_initialize', true ) ) {
			return;
		}

		// For not logged user
		add_action( 'wp_ajax_nopriv_update_form', array( $this, 'update_form' ) );
	}

	/**
	 * The method to run on ajax
	 *
	 * @since 1.0.0
	 * @return void
	 *
	 * https://stackoverflow.com/questions/56743679/how-to-save-meta-data-in-wordpress-back-end-with-php
	 */
	public function update_form( $post_id ) {
		// @TODO
		// You should add some additional security checks here
		// eg. nonce, user capabilities, etc, to prevent
		// malicious users from doing bad stuff.

		/* OK, it's safe for us to save the data now. */

		// Make sure that it is set.
		if ( ! isset( $_POST['deck_form'] ) ) {
			return;
		}

		// Sanitize user input.
		$deck_form_data = sanitize_text_field( $_POST['deck_form'] );

		// Update the meta field in the database.
		update_post_meta( $post_id, '_deck_form', $deck_form_data );

		$return = array(
			'message' => 'Saved',
			'data' => $deck_form_data,
			'ID'      => 1,
		);

		wp_send_json_success( $return );
		// wp_send_json_error( $return );
	}

}
