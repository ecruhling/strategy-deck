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

namespace Strategy_Deck\Backend;

use Strategy_Deck\Engine\Base;
use WP_Error;
use function __;
use function add_action;
use function admin_url;
use function current_user_can;
use function end;
use function esc_html__;
use function explode;
use function get_object_vars;
use function get_option;
use function gmdate;
use function header;
use function ignore_user_abort;
use function is_array;
use function json_decode;
use function nocache_headers;
use function sanitize_text_field;
use function update_option;
use function wp_die;
use function wp_json_encode;
use function wp_safe_redirect;
use function wp_unslash;
use function wp_verify_nonce;

/**
 * Provide Import and Export of the settings of the plugin
 */
class ImpExp extends Base {

	/**
	 * Initialize the class.
	 *
	 * @return void
	 */
	public function initialize() {
		if ( !parent::initialize() ) {
			return;
		}

		// Add the export settings method
		add_action( 'admin_init', array( $this, 'settings_export' ) );
		// Add the import settings method
		add_action( 'admin_init', array( $this, 'settings_import' ) );
	}

	/**
	 * Process a settings export from config
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function settings_export() {
		if (
			empty( $_POST[ 'sd_action' ] ) || //phpcs:ignore WordPress.Security.NonceVerification
			'export_settings' !== sanitize_text_field( wp_unslash( $_POST[ 'sd_action' ] ) ) //phpcs:ignore WordPress.Security.NonceVerification
		) {
			return;
		}

		if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ 'sd_export_nonce' ] ) ), 'sd_export_nonce' ) ) { //phpcs:ignore WordPress.Security.ValidatedSanitizedInput
			return;
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$settings      = array();
		$settings[ 0 ] = get_option( SD_TEXTDOMAIN . '-settings' );
		$settings[ 1 ] = get_option( SD_TEXTDOMAIN . '-settings-second' );

		ignore_user_abort( true );

		nocache_headers();
		header( 'Content-Type: application/json; charset=utf-8' );
		header( 'Content-Disposition: attachment; filename=strategydeck-settings-export-' . gmdate( 'm-d-Y' ) . '.json' );
		header( 'Expires: 0' );

		echo wp_json_encode( $settings, JSON_PRETTY_PRINT );

		exit; // phpcs:ignore
	}

	/**
	 * Process a settings import from a json file
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function settings_import() {
		if (
			empty( $_POST[ 'sd_action' ] ) || //phpcs:ignore WordPress.Security.NonceVerification
			'import_settings' !== sanitize_text_field( wp_unslash( $_POST[ 'sd_action' ] ) ) //phpcs:ignore WordPress.Security.NonceVerification
		) {
			return;
		}

		if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ 'sd_import_nonce' ] ) ), 'sd_import_nonce' ) ) { //phpcs:ignore WordPress.Security.ValidatedSanitizedInput
			return;
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$file_name_parts = explode( '.', $_FILES[ 'sd_import_file' ][ 'name' ] ); //phpcs:ignore WordPress.Security.ValidatedSanitizedInput
		$extension       = end( $file_name_parts );

		if ( 'json' !== $extension ) {
			wp_die( esc_html__( 'Please upload a valid .json file', SD_TEXTDOMAIN ) );
		}

		$import_file = $_FILES[ 'sd_import_file' ][ 'tmp_name' ]; //phpcs:ignore WordPress.Security.ValidatedSanitizedInput

		if ( empty( $import_file ) ) {
			wp_die( esc_html__( 'Please upload a file to import', SD_TEXTDOMAIN ) );
		}

		// Retrieve the settings from the file and convert the json object to an array.
		$settings_file = file_get_contents( $import_file );// phpcs:ignore

		if ( !$settings_file ) {
			$settings = json_decode( (string) $settings_file );

			if ( is_array( $settings ) ) {
				update_option( SD_TEXTDOMAIN . '-settings', get_object_vars( $settings[ 0 ] ) );
				update_option( SD_TEXTDOMAIN . '-settings-second', get_object_vars( $settings[ 1 ] ) );
			}

			wp_safe_redirect( admin_url( 'options-general.php?page=' . SD_TEXTDOMAIN ) );
			exit;
		}

		new WP_Error(
				'strategydeck_import_settings_failed',
				__( 'Failed to import the settings.', SD_TEXTDOMAIN )
			);

	}

}
