<?php
/*
 * Retrieve these settings on front end in either of these ways:
 *   $my_setting = cmb2_get_option( SD_TEXTDOMAIN . '-settings', 'some_setting', 'default' );
 *   $my_settings = get_option( SD_TEXTDOMAIN . '-settings', 'default too' );
 * CMB2 Snippet: https://github.com/CMB2/CMB2-Snippet-Library/blob/master/options-and-settings-pages/theme-options-cmb.php
 */
?>
<div id="tabs-1" class="wrap">
			<?php
			$cmb = new_cmb2_box(
				array(
					'id'         => SD_TEXTDOMAIN . '_options',
					'hookup'     => false,
					'show_on'    => array( 'key' => 'options-page', 'value' => array( SD_TEXTDOMAIN ) ),
					'show_names' => true,
				)
			);
			$cmb->add_field(
				array(
					'name'    => __( 'Text', SD_TEXTDOMAIN ),
					'desc'    => __( 'field description (optional)', SD_TEXTDOMAIN ),
					'id'      => 'text',
					'type'    => 'text',
					'default' => 'Default Text',
				)
			);
			$cmb->add_field(
				array(
					'name'    => __( 'Color Picker', SD_TEXTDOMAIN ),
					'desc'    => __( 'field description (optional)', SD_TEXTDOMAIN ),
					'id'      => 'colorpicker',
					'type'    => 'colorpicker',
					'default' => '#bada55',
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Text Medium', SD_TEXTDOMAIN ),
					'desc' => __( 'field description (optional)', SD_TEXTDOMAIN ),
					'id'   => '_textmedium',
					'type' => 'text_medium',
					// 'repeatable' => true,
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Website URL', SD_TEXTDOMAIN ),
					'desc' => __( 'field description (optional)', SD_TEXTDOMAIN ),
					'id'   => '_url',
					'type' => 'text_url',
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Text Email', SD_TEXTDOMAIN ),
					'desc' => __( 'field description (optional)', SD_TEXTDOMAIN ),
					'id'   => '_email',
					'type' => 'text_email',
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Time', SD_TEXTDOMAIN ),
					'desc' => __( 'field description (optional)', SD_TEXTDOMAIN ),
					'id'   => '_time',
					'type' => 'text_time',
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Date Picker', SD_TEXTDOMAIN ),
					'desc' => __( 'field description (optional)', SD_TEXTDOMAIN ),
					'id'   => '_textdate',
					'type' => 'text_date',
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Date Picker (UNIX timestamp)', SD_TEXTDOMAIN ),
					'desc' => __( 'field description (optional)', SD_TEXTDOMAIN ),
					'id'   => '_textdate_timestamp',
					'type' => 'text_date_timestamp',
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Date/Time Picker Combo (UNIX timestamp)', SD_TEXTDOMAIN ),
					'desc' => __( 'field description (optional)', SD_TEXTDOMAIN ),
					'id'   => '_datetime_timestamp',
					'type' => 'text_datetime_timestamp',
				)
			);
			$cmb->add_field(
				array(
					'name'         => __( 'Test Money', SD_TEXTDOMAIN ),
					'desc'         => __( 'field description (optional)', SD_TEXTDOMAIN ),
					'id'           => '_textmoney',
					'type'         => 'text_money',
					'before_field' => '€', // Override '$' symbol if needed
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Text Area', SD_TEXTDOMAIN ),
					'desc' => __( 'field description (optional)', SD_TEXTDOMAIN ),
					'id'   => '_textarea',
					'type' => 'textarea',
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Text Area for Code', SD_TEXTDOMAIN ),
					'desc' => __( 'field description (optional)', SD_TEXTDOMAIN ),
					'id'   => '_textarea_code',
					'type' => 'textarea_code',
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Title Weeeee', SD_TEXTDOMAIN ),
					'desc' => __( 'This is a title description', SD_TEXTDOMAIN ),
					'id'   => '_title',
					'type' => 'title',
				)
			);
			$cmb->add_field(
				array(
					'name'             => __( 'Test Select', SD_TEXTDOMAIN ),
					'desc'             => __( 'field description (optional)', SD_TEXTDOMAIN ),
					'id'               => '_select',
					'type'             => 'select',
					'show_option_none' => true,
					'options'          => array(
						'standard' => __( 'Option One', SD_TEXTDOMAIN ),
						'custom'   => __( 'Option Two', SD_TEXTDOMAIN ),
						'none'     => __( 'Option Three', SD_TEXTDOMAIN ),
					),
				)
			);
			$cmb->add_field(
				array(
					'name'             => __( 'Test Radio inline', SD_TEXTDOMAIN ),
					'desc'             => __( 'field description (optional)', SD_TEXTDOMAIN ),
					'id'               => '_radio_inline',
					'type'             => 'radio_inline',
					'show_option_none' => 'No Selection',
					'options'          => array(
						'standard' => __( 'Option One', SD_TEXTDOMAIN ),
						'custom'   => __( 'Option Two', SD_TEXTDOMAIN ),
						'none'     => __( 'Option Three', SD_TEXTDOMAIN ),
					),
				)
			);
			$cmb->add_field(
				array(
					'name'    => __( 'Test Radio', SD_TEXTDOMAIN ),
					'desc'    => __( 'field description (optional)', SD_TEXTDOMAIN ),
					'id'      => '_radio',
					'type'    => 'radio',
					'options' => array(
						'option1' => __( 'Option One', SD_TEXTDOMAIN ),
						'option2' => __( 'Option Two', SD_TEXTDOMAIN ),
						'option3' => __( 'Option Three', SD_TEXTDOMAIN ),
					),
				)
			);
			$cmb->add_field(
				array(
					'name'     => __( 'Test Taxonomy Radio', SD_TEXTDOMAIN ),
					'desc'     => __( 'field description (optional)', SD_TEXTDOMAIN ),
					'id'       => '_text_taxonomy_radio',
					'type'     => 'taxonomy_radio',
					'taxonomy' => 'category', // Taxonomy Slug
					// 'inline'  => true, // Toggles display to inline
				)
			);
			$cmb->add_field(
				array(
					'name'     => __( 'Test Taxonomy Select', SD_TEXTDOMAIN ),
					'desc'     => __( 'field description (optional)', SD_TEXTDOMAIN ),
					'id'       => '_taxonomy_select',
					'type'     => 'taxonomy_select',
					'taxonomy' => 'category', // Taxonomy Slug
				)
			);
			$cmb->add_field(
				array(
					'name'     => __( 'Test Taxonomy Multi Checkbox', SD_TEXTDOMAIN ),
					'desc'     => __( 'field description (optional)', SD_TEXTDOMAIN ),
					'id'       => '_multitaxonomy',
					'type'     => 'taxonomy_multicheck',
					'taxonomy' => 'category', // Taxonomy Slug
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Checkbox', SD_TEXTDOMAIN ),
					'desc' => __( 'field description (optional)', SD_TEXTDOMAIN ),
					'id'   => '_checkbox',
					'type' => 'checkbox',
				)
			);
			$cmb->add_field(
				array(
					'name'    => __( 'Test Multi Checkbox', SD_TEXTDOMAIN ),
					'desc'    => __( 'field description (optional)', SD_TEXTDOMAIN ),
					'id'      => '_multicheckbox',
					'type'    => 'multicheck',
					'options' => array(
						'check1' => __( 'Check One', SD_TEXTDOMAIN ),
						'check2' => __( 'Check Two', SD_TEXTDOMAIN ),
						'check3' => __( 'Check Three', SD_TEXTDOMAIN ),
					),
				)
			);
			$cmb->add_field(
				array(
					'name'    => __( 'Test wysiwyg', SD_TEXTDOMAIN ),
					'desc'    => __( 'field description (optional)', SD_TEXTDOMAIN ),
					'id'      => '_wysiwyg',
					'type'    => 'wysiwyg',
					'options' => array( 'textarea_rows' => 5 ),
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Image', SD_TEXTDOMAIN ),
					'desc' => __( 'Upload an image or enter a URL.', SD_TEXTDOMAIN ),
					'id'   => '_image',
					'type' => 'file',
				)
			);
			$cmb->add_field(
				array(
					'name'         => __( 'Multiple Files', SD_TEXTDOMAIN ),
					'desc'         => __( 'Upload or add multiple images/attachments.', SD_TEXTDOMAIN ),
					'id'           => '_file_list',
					'type'         => 'file_list',
					'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'oEmbed', SD_TEXTDOMAIN ),
					'desc' => __( 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.', SD_TEXTDOMAIN ),
					'id'   => '_embed',
					'type' => 'oembed',
				)
			);
			$cmb->add_field(
				array(
					'name'         => 'Testing Field Parameters',
					'id'           => '_parameters',
					'type'         => 'text',
					'before_row'   => '<p>before_row_if_2</p>', // Callback
					'before'       => '<p>Testing <b>"before"</b> parameter</p>',
					'before_field' => '<p>Testing <b>"before_field"</b> parameter</p>',
					'after_field'  => '<p>Testing <b>"after_field"</b> parameter</p>',
					'after'        => '<p>Testing <b>"after"</b> parameter</p>',
					'after_row'    => '<p>Testing <b>"after_row"</b> parameter</p>',
				)
			);

			cmb2_metabox_form( SD_TEXTDOMAIN . '_options', SD_TEXTDOMAIN . '-settings' );
			?>

			<!-- @TODO: Provide other markup for your options page here. -->
		</div>
