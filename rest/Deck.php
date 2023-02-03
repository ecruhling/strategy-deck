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

namespace Strategy_Deck\Rest;

use Strategy_Deck\Engine\Base;
use WP_Error;
use WP_Post;
use WP_REST_Request;
use WP_REST_Response;
use WP_REST_Server;
use function add_action;
use function get_post_meta;
use function is_wp_error;
use function register_rest_field;
use function register_rest_route;
use function rest_ensure_response;
use function strval;
use function update_post_meta;
use function wp_verify_nonce;

/**
 * Deck class for REST
 */
class Deck extends Base {

	/**
	 * Initialize the class.
	 *
	 * @return void|bool
	 */
	public function initialize() {
		parent::initialize();

		add_action( 'rest_api_init', array( $this, 'deck_rest' ) );
	}

	/**
	 * Deck REST
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function deck_rest(): void
	{
		$this->add_custom_field();
		$this->add_deck_rest_route();
	}

	/**
	 * Add Custom Field
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function add_custom_field(): void
	{
		register_rest_field(
			'demo',
			SD_TEXTDOMAIN . '_text',
			array(
				'get_callback'    => array( $this, 'get_text_field' ),
				'update_callback' => array( $this, 'update_text_field' ),
				'schema'          => array(
					'description' => \__( 'Text field demo of Post type', SD_TEXTDOMAIN ),
					'type'        => 'string',
				),
			)
		);
	}

	/**
	 * Register Deck REST route
	 *
	 * @since 1.0.0
     *
     * @return void
	 */
	public function add_deck_rest_route(): void
	{
		register_rest_route( 'strategydeck/v1', '/decks/(?P<id>[\d]+)', [
			'methods'             => WP_REST_SERVER::EDITABLE,
			'callback'            => [ $this, 'update_deck' ],
			'permission_callback' => [ $this, 'check_deck_permissions' ],
		] );
	}

	/**
	 * Check Deck Permissions
	 *
	 * @param WP_REST_Request $request
	 * @return bool
	 */
	function check_deck_permissions( WP_REST_Request $request ) : bool {
		$post_id = $request->get_param( 'id' ) ?? 0;

		if ( ! is_user_logged_in() ) {
			return false;
		}

		$post = get_post( $post_id );

		if ( null === $post ) {
			return false;
		}

		if ( current_user_can( 'edit_published_posts' ) ) {
			return true;
		}

		return get_current_user_id() === $post->post_author;
	}

	/**
	 * Update Deck
	 *
	 * @param WP_REST_Request $request
	 * @return WP_REST_Response
	 */
	function update_deck( WP_REST_Request $request ) : WP_REST_Response {
		$post_id      = $request->get_param( 'id' );
		$block_id     = $request->get_param( 'block_id' );
		$post_content = get_post_field( 'post_content', $post_id );
		$post_blocks  = parse_blocks( $post_content );

		$post_blocks = array_map( function( $block ) use ( $block_id ) {
			if ( 'strategydeck/deck-card' !== ( $block['blockName'] ?? '' ) || ( $block['attrs']['id'] ?? 0 ) !== $block_id ) {
				return $block;
			}

			// Update block attributes here...
			// E.g., $block['attrs']['some-attr'] = $attr_value;

			return $block;
		}, $post_blocks );

		wp_update_post( [
			'ID'           => $post_id,
			'post_content' => serialize_blocks( $post_blocks ),
		] );

		return new WP_REST_Response( __( 'Initiative updated.', 'resource-tracker' ), 200 );
	}

	/**
	 * Get Text Field
	 *
	 * @since 1.0.0
	 * @param array $post_obj Post ID.
	 * @return string
	 */
	public function get_text_field( array $post_obj ) {
		$post_id = $post_obj['id'];

		return strval( get_post_meta( $post_id, SD_TEXTDOMAIN . '_text', true ) );
	}

	/**
	 * Update Text Field
	 *
	 * @param string   $value Value.
	 * @param WP_Post $post  Post object.
	 * @param string   $key   Key.
	 * @return bool|WP_Error
	 *@since 1.0.0
	 */
	public function update_text_field( string $value, WP_Post $post, string $key ) {
		$post_id = update_post_meta( $post->ID, $key, $value );

		if ( false === $post_id ) {
			return new WP_Error(
				'rest_post_views_failed',
				\__( 'Failed to update post views.', SD_TEXTDOMAIN ),
				array( 'status' => 500 )
			);
		}

		return true;
	}

	/**
	 * Sum
	 *
	 * @since 1.0.0
	 * @param WP_REST_Request $request Values.
	 * @return array
	 */
	public function sum( WP_REST_Request $request ) {
		if ( !isset( $request[ 'first' ], $request[ 'second' ] ) ) {
			return array( 'result' => 0 );
		}

		return array( 'result' => $request[ 'first' ] + $request[ 'second' ] );
	}

	/**
	 * Demo Example
	 *
	 * @param WP_REST_Request $request Values.
	 * @return WP_REST_Response|WP_REST_Request
	 *@since 1.0.0
	 */
	public function demo_example( WP_REST_Request $request ) {
		// $request is an array with various parameters
		if ( !wp_verify_nonce( strval( $request['nonce'] ), 'demo_example' ) ) {
			$response = rest_ensure_response( 'Wrong nonce' );

			if ( is_wp_error( $response ) ) {
				return $request;
			}

			$response->set_status( 500 );

			return $response;
		}

		$response = rest_ensure_response( 'Something here' );

		if ( is_wp_error( $response ) ) {
			return $request;
		}

		$response->set_status( 500 );

		return $response;
	}

}
