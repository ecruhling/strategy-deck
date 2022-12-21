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

namespace Strategy_Deck\Integrations;

use Cmb2Grid\Grid\Cmb2Grid;
use Strategy_Deck\Engine\Base;
use function __;
use function add_action;
use function new_cmb2_box;

/**
 * All the CMB related code.
 */
class CMB extends Base {

	/**
	 * Initialize class.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function initialize() {
		parent::initialize();

		require_once SD_PLUGIN_ROOT . 'vendor/cmb2/init.php';
		require_once SD_PLUGIN_ROOT . 'vendor/cmb2-grid/Cmb2GridPluginLoad.php';
		add_action( 'cmb2_init', array( $this, 'cmb_deck_metaboxes' ) );
	}

	/**
	 * Metabox on Deck CPT
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function cmb_deck_metaboxes() { // phpcs:ignore
		// Start with an underscore to hide fields from custom fields list
		$prefix   = '_deck_';
		$cmb_demo = new_cmb2_box(
			array(
				'id'           => $prefix . 'metabox',
				'title'        => __( 'Deck Metabox', SD_TEXTDOMAIN ),
				'object_types' => array( 'deck' ),
				'context'      => 'normal',
				'priority'     => 'high',
				'show_names'   => true, // Show field names on the left
		)
			);
		$cmb2Grid = new Cmb2Grid( $cmb_demo ); //phpcs:ignore WordPress.NamingConventions
		$row      = $cmb2Grid->addRow(); //phpcs:ignore WordPress.NamingConventions
		$field1 = $cmb_demo->add_field(
			array(
				'name' => __( 'Text', SD_TEXTDOMAIN ),
				'desc' => __( 'field description (optional)', SD_TEXTDOMAIN ),
				'id'   => $prefix . SD_TEXTDOMAIN . '_text',
				'type' => 'text',
				)
			);
		$field2 = $cmb_demo->add_field(
			array(
				'name' => __( 'Text 2', SD_TEXTDOMAIN ),
				'desc' => __( 'field description (optional)', SD_TEXTDOMAIN ),
				'id'   => $prefix . SD_TEXTDOMAIN . '_text2',
				'type' => 'text',
				)
			);

		$field3 = $cmb_demo->add_field(
			array(
				'name' => __( 'Text Small', SD_TEXTDOMAIN ),
				'desc' => __( 'field description (optional)', SD_TEXTDOMAIN ),
				'id'   => $prefix . SD_TEXTDOMAIN . '_textsmall',
				'type' => 'text_small',
				)
			);
		$field4 = $cmb_demo->add_field(
			array(
				'name' => __( 'Text Small 2', SD_TEXTDOMAIN ),
				'desc' => __( 'field description (optional)', SD_TEXTDOMAIN ),
				'id'   => $prefix . SD_TEXTDOMAIN . '_textsmall2',
				'type' => 'text_small',
		)
			);
		$row->addColumns( array( $field1, $field2 ) );
		$row = $cmb2Grid->addRow(); //phpcs:ignore WordPress.NamingConventions
		$row->addColumns( array( $field3, $field4 ) );
	}

}
