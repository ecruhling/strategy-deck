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
use WP_REST_Request;
use WP_REST_Response;
use WP_REST_Server;
use function __;
use function add_action;
use function register_rest_route;

/**
 * Deck class for REST
 */
class Deck extends Base
{

	/**
	 * Initialize the class.
	 *
	 * @return void|bool
	 */
	public function initialize()
	{
		parent::initialize();

		add_action('rest_api_init', array($this, 'deck_rest'));
	}

	/**
	 * Deck REST
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function deck_rest(): void
	{
		$this->add_deck_rest_route();
	}

	/**
	 * Register Deck REST route
	 *
	 * @return void
	 * @since 1.0.0
	 *
	 */
	public function add_deck_rest_route(): void
	{
		register_rest_route('strategydeck/v1', '/decks/(?P<id>[\d]+)', [
			'methods' => WP_REST_SERVER::EDITABLE,
			'callback' => [$this, 'update_deck'],
//			'permission_callback' => [ $this, 'check_deck_permissions' ],
		]);
	}

	/**
	 * Check Deck Permissions
	 *
	 * @param WP_REST_Request $request
	 * @return bool
	 */
	function check_deck_permissions(WP_REST_Request $request): bool
	{
		$post_id = $request->get_param('id') ?? 0;

		if (!is_user_logged_in()) {
			return false;
		}

		$post = get_post($post_id);

		if (null === $post) {
			return false;
		}

		if (current_user_can('edit_published_posts')) {
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
	function update_deck(WP_REST_Request $request): WP_REST_Response
	{

		$post_id = $request->get_param('id');
		$block_id = $request->get_param('block_id');
		$checked = $request->get_param('checked');
		$word = preg_replace("/[\n\r\t]/",'', $request->get_param('word'));
		$post_content = get_post_field('post_content', $post_id);
		$post_blocks = parse_blocks($post_content);

		$post_blocks = array_map(function ($block) use ($block_id, $word, $checked) {
			// return if not a deck-card block, or the block id is not equal
			if ('strategydeck/deck-card' !== ($block['blockName'] ?? '') || ($block['attrs']['id'] ?? 0) !== $block_id) {
				return $block;
			}

			// Update block attributes
			$block['attrs']['checked'] = $checked;
			$block['attrs']['word'] = $word;

			return $block;
		}, $post_blocks);

		wp_update_post([
			'ID' => $post_id,
			'post_content' => serialize_blocks($post_blocks),
		]);

		return new WP_REST_Response(__('Updated.', 'strategydeck'), 200);
	}

}
