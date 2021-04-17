<?php
/**
 * WordPress Settings Framework
 *
 * @author  Gilbert Pellegrom, James Kemp
 * @link    https://github.com/gilbitron/WordPress-Settings-Framework
 * @license MIT
 */

/**
 * Define your settings
 *
 * The first parameter of this filter should be wpsf_register_settings_[options_group],
 * in this case "my_example_settings".
 *
 * Your "options_group" is the second param you use when running new WordPressSettingsFramework()
 * from your init function. It's important as it differentiates your options from others.
 *
 * To use the tabbed example, simply change the second param in the filter below to 'wpsf_tabbed_settings'
 * and check out the tabbed settings function on line 156.
 */

use Kaizen_Coders\Url_Shortify\Helper;

add_filter( 'wpsf_register_settings_kc_us', 'wpsf_tabbed_settings' );
//add_filter( 'wpsf_register_settings_kc_us', 'wpsf_tabless_settings' );

/**
 * Tabless example
 */
function wpsf_tabless_settings( $wpsf_settings ) {
	// General Settings section
	$wpsf_settings[] = array(
		'section_id'          => 'general',
		'section_title'       => 'General Settings',
		'section_description' => 'Some intro description about this section.',
		'section_order'       => 5,
		'fields'              => array(
			array(
				'id'          => 'text',
				'title'       => 'Text',
				'desc'        => 'This is a description.',
				'placeholder' => 'This is a placeholder.',
				'type'        => 'text',
				'default'     => 'This is default',
			),
			array(
				'id'      => 'number',
				'title'   => 'Number',
				'desc'    => 'This is a description.',
				'type'    => 'number',
				'default' => 10,
			),
			array(
				'id'         => 'time',
				'title'      => 'Time Picker',
				'desc'       => 'This is a description.',
				'type'       => 'time',
				'timepicker' => array(), // Array of timepicker options (http://fgelinas.com/code/timepicker)
			),
			array(
				'id'         => 'date',
				'title'      => 'Date Picker',
				'desc'       => 'This is a description.',
				'type'       => 'date',
				'datepicker' => array(), // Array of datepicker options (http://api.jqueryui.com/datepicker/)
			),
			array(
				'id'        => 'group',
				'title'     => 'Group',
				'desc'      => 'This is a description.',
				'type'      => 'group',
				'subfields' => array(
					// accepts most types of fields
					array(
						'id'          => 'sub-text',
						'title'       => 'Sub Text',
						'desc'        => 'This is a description.',
						'placeholder' => 'This is a placeholder.',
						'type'        => 'text',
						'default'     => 'Sub text',
					),

					array(
						'id'      => 'select',
						'title'   => 'Select',
						'desc'    => 'This is a description.',
						'type'    => 'select',
						'default' => 'green',
						'choices' => array(
							'red'   => 'Red',
							'green' => 'Green',
							'blue'  => 'Blue',
						),
					),
				)
			),
			array(
				'id'          => 'password',
				'title'       => 'Password',
				'desc'        => 'This is a description.',
				'placeholder' => 'This is a placeholder.',
				'type'        => 'password',
				'default'     => 'Example',
			),
			array(
				'id'          => 'textarea',
				'title'       => 'Textarea',
				'desc'        => 'This is a description.',
				'placeholder' => 'This is a placeholder.',
				'type'        => 'textarea',
				'default'     => 'This is default',
			),
			array(
				'id'      => 'select',
				'title'   => 'Select',
				'desc'    => 'This is a description.',
				'type'    => 'select',
				'default' => 'green',
				'choices' => array(
					'red'   => 'Red',
					'green' => 'Green',
					'blue'  => 'Blue',
				),
			),
			array(
				'id'      => 'radio',
				'title'   => 'Radio',
				'desc'    => 'This is a description.',
				'type'    => 'radio',
				'default' => 'green',
				'choices' => array(
					'red'   => 'Red',
					'green' => 'Green',
					'blue'  => 'Blue',
				),
			),
			array(
				'id'      => 'checkbox',
				'title'   => 'Checkbox',
				'desc'    => 'This is a description.',
				'type'    => 'checkbox',
				'default' => 1,
			),
			array(
				'id'      => 'checkboxes',
				'title'   => 'Checkboxes',
				'desc'    => 'This is a description.',
				'type'    => 'checkboxes',
				'default' => array(
					'red',
					'blue',
				),
				'choices' => array(
					'red'   => 'Red',
					'green' => 'Green',
					'blue'  => 'Blue',
				),
			),
			array(
				'id'      => 'color',
				'title'   => 'Color',
				'desc'    => 'This is a description.',
				'type'    => 'color',
				'default' => '#ffffff',
			),
			array(
				'id'      => 'file',
				'title'   => 'File',
				'desc'    => 'This is a description.',
				'type'    => 'file',
				'default' => '',
			),
			array(
				'id'      => 'editor',
				'title'   => 'Editor',
				'desc'    => 'This is a description.',
				'type'    => 'editor',
				'default' => '',
			),
		),
	);

	// More Settings section
	$wpsf_settings[] = array(
		'section_id'    => 'more',
		'section_title' => 'More Settings',
		'section_order' => 10,
		'fields'        => array(
			array(
				'id'      => 'more-text',
				'title'   => 'More Text',
				'desc'    => 'This is a description.',
				'type'    => 'text',
				'default' => 'This is default',
			),
		),
	);

	return $wpsf_settings;
}

/**
 * Tabbed example
 */

function wpsf_tabbed_settings( $wpsf_settings ) {
	// Tabs
	$tabs = array(

		array(
			'id'    => 'links',
			'title' => __( 'Links', 'url-shortify' ),
		),
	);

	$wpsf_settings['tabs'] = apply_filters( 'kc_us_filter_settings_tab', $tabs );

	$redirection_types = Helper::get_redirection_types();


	$default_link_options = array(
		array(
			'id'      => 'redirection_type',
			'title'   => __( 'Redirection', 'url-shortify' ),
			'desc'    => '',
			'type'    => 'select',
			'default' => '307',
			'choices' => $redirection_types
		),

		array(
			'id'      => 'enable_nofollow',
			'title'   => __( 'Nofollow', 'url-shortify' ),
			'desc'    => '',
			'type'    => 'switch',
			'default' => 1,
		),

		array(
			'id'      => 'enable_sponsored',
			'title'   => __( 'Sponsored', 'url-shortify' ),
			'desc'    => '',
			'type'    => 'switch',
			'default' => 0,
		),

		array(
			'id'      => 'enable_paramter_forwarding',
			'title'   => __( 'Paramter Forwarding', 'url-shortify' ),
			'desc'    => '',
			'type'    => 'switch',
			'default' => 0,
		),

		array(
			'id'      => 'enable_tracking',
			'title'   => __( 'Tracking', 'url-shortify' ),
			'desc'    => '',
			'type'    => 'switch',
			'default' => 1,
		),

	);

	$default_link_options = apply_filters( 'kc_us_filter_default_link_options', $default_link_options );

	$sections = array(

		array(
			'tab_id'        => 'links',
			'section_id'    => 'default_link_options',
			'section_title' => __( 'Default Link Options' ),
			'section_order' => 10,
			'fields'        => $default_link_options
		),
	);

	$sections = apply_filters( 'kc_us_filter_settings_sections', $sections );

	$wpsf_settings['sections'] = $sections;

	return $wpsf_settings;
}