<?php

$factorycommercegurus_logo_position = '';
$factorycommercegurus_logo_position = factorycommercegurus_getoption( 'factorycommercegurus_logo_position' );

if ( ( $factorycommercegurus_logo_position == 'beside' ) || ( $factorycommercegurus_logo_position == 'right' ) ) {
	add_action( 'cmb2_init', 'factorycommercegurus_register_page_options' );
}

/**
 * CMB2 options CommerceGurus themes - engage!
 */
function factorycommercegurus_register_page_options() {

	// Start with an underscore to hide fields from custom fields list
	$factorycommercegurus_prefix = '_cgcmb_';

	/**
	 * Page Settings
	 */
	$factorycommercegurus_page_setting_box = new_cmb2_box( array(
		'id'			 => $factorycommercegurus_prefix . 'metabox',
		'title'			 => esc_html__( 'Page Settings', 'factory' ),
		'object_types'	 => array( 'page', ), // Post type
		'context'		 => 'side',
		'priority'		 => 'high',
	) );

	$factorycommercegurus_page_setting_box->add_field( array(
		'name'				 => esc_html__( 'Header Transparency Style', 'factory' ),
		'desc'				 => esc_html__( 'Default value is set via Theme Options -> Header Settings -> Header Transparency', 'factory' ),
		'id'				 => $factorycommercegurus_prefix . 'header_style',
		'type'				 => 'select',
		'show_option_none'	 => false,
		'options'			 => array(
			'header-globaloption'	 => esc_html__( 'Set in theme options', 'factory' ),
			'header-default'		 => esc_html__( 'No transparency', 'factory' ),
			'transparent-light'		 => esc_html__( 'Transparent - Light text', 'factory' ),
			'transparent-dark'		 => esc_html__( 'Transparent - Dark text', 'factory' ),
		),
		'default'			 => 'header-globaloption',
	) );
}
