<?php

/*
  Plugin Name: CommerceGurus Visual Composer Extensions
  Plugin URI: http://commercegurus.com
  Description: Extensions to Visual Composer for the CommerceGurus themes.
  Version: 1.0
  Author: CommerceGurus
  Author URI: http://commercegurus.com
  License: GPLv2 or later
 */

// don't load directly
if ( !defined( 'ABSPATH' ) )
	die( '-1' );

/*
  Display notice if Visual Composer is not installed or activated.
 */
if ( !defined( 'WPB_VC_VERSION' ) ) {
	add_action( 'admin_notices', 'factorycommercegurus_vc_extend_notice' );
	return;
}

function factorycommercegurus_vc_extend_notice() {
	$factorycommercegurus_plugin_data = get_plugin_data( __FILE__ );
	echo '
  <div class="updated">
    <p>' . sprintf( esc_html__( '<strong>%s</strong> requires <strong><a href="http://bit.ly/vcomposer" target="_blank">Visual Composer</a></strong> plugin to be installed and activated on your site.', 'factory' ), $factorycommercegurus_plugin_data['Name'] ) . '</p>
  </div>';
}

//Removing shortcodes
vc_remove_element( "vc_widget_sidebar" );
vc_remove_element( "vc_wp_search" );
vc_remove_element( "vc_wp_meta" );
vc_remove_element( "vc_wp_recentcomments" );
vc_remove_element( "vc_wp_calendar" );
vc_remove_element( "vc_wp_tagcloud" );
vc_remove_element( "vc_wp_custommenu" );
vc_remove_element( "vc_wp_text" );
vc_remove_element( "vc_wp_posts" );
vc_remove_element( "vc_wp_links" );
vc_remove_element( "vc_wp_categories" );
vc_remove_element( "vc_wp_archives" );
vc_remove_element( "vc_wp_rss" );
vc_remove_param( 'vc_separator', 'accent_color' );
vc_remove_param( 'vc_separator', 'style' );
vc_remove_param( 'vc_separator', 'el_width' );


vc_add_param( "vc_row", array(
	"type"		 => "dropdown",
	"class"		 => "",
	"heading"	 => esc_html__( "Type", 'factory' ),
	"param_name" => "type",
	"save_always" 	 => true,
	"value"		 => array(
		esc_html__( "Fixed Page Width", 'factory' )					 => "container",
		esc_html__( "Full Page Width - No Container", 'factory ' )	 => "full_page_width",
		esc_html__( "Full Page Width - Inner Container", 'factory' )	 => "full_page_width_inner_container",
	),
) );

// Separator
$factorycommercegurus_separator_setting = array(
	'show_settings_on_create'	 => true,
	"controls"					 => '',
);
vc_map_update( 'vc_separator', $factorycommercegurus_separator_setting );

vc_add_param( "vc_separator", array(
	"type"			 => "dropdown",
	"class"			 => "",
	"heading"		 => esc_html__( "Type", 'factory' ),
	"param_name"	 => "type",
	"value"			 => array(
		"Normal"		 => "normal",
		"Transparent"	 => "transparent",
		"Full width"	 => "full_width",
		"Small"			 => "small"
	),
	"save_always" 	 => true,
	"description"	 => ""
) );

vc_add_param( "vc_separator", array(
	"type"			 => "dropdown",
	"class"			 => "",
	"heading"		 => esc_html__( "Position", 'factory' ),
	"param_name"	 => "position",
	"value"			 => array(
		"Center" => "center",
		"Left"	 => "left",
		"Right"	 => "right"
	),
	"dependency"	 => array( "element" => "type", "value" => array( "small" ) ),
	"save_always" 	 => true,
	"description"	 => ""
) );

vc_add_param( "vc_separator", array(
	"type"			 => "colorpicker",
	"class"			 => "",
	"heading"		 => esc_html__("Color", 'factory' ),
	"param_name"	 => "color",
	"value"			 => "",
	"save_always" 	 => true,
	"description"	 => ""
) );

vc_add_param( "vc_separator", array(
	"type"			 => "textfield",
	"class"			 => "",
	"heading"		 => esc_html__( "Thickness", 'factory' ),
	"param_name"	 => "thickness",
	"value"			 => "",
	"save_always" 	 => true,
	"description"	 => ""
) );
vc_add_param( "vc_separator", array(
	"type"			 => "textfield",
	"class"			 => "",
	"heading"		 => esc_html__( "Top Margin", 'factory' ),
	"param_name"	 => "up",
	"value"			 => "",
	"save_always" 	 => true,
	"description"	 => ""
) );
vc_add_param( "vc_separator", array(
	"type"			 => "textfield",
	"class"			 => "",
	"heading"		 => esc_html__( "Bottom Margin", 'factory' ),
	"param_name"	 => "down",
	"value"			 => "",
	"save_always" 	 => true,
	"description"	 => ""
) );


/*
  Lets call wpb_map function to "register" our custom shortcode within Visual Composer interface.
 */

vc_map( array(
	"name"		 => __( "CommerceGurus Logos", 'factory' ),
	"base"		 => "cg_logos",
	"class"		 => "",
	"controls"	 => "full",
	"icon"		 => "icon-wpb-cg_vc_extend",
	"category"	 => esc_html__( 'CommerceGurus Shortcodes', 'factory' ),
	"params"	 => array(
		array(
			"type"			 => "textfield",
			"holder"		 => "div",
			"class"			 => "",
			"heading"		 => esc_html__( "Number of Logos", 'factory' ),
			"param_name"	 => "posts",
			"value"			 => "10",
			"save_always" 	 => true,
			"description"	 => __( "Enter the total number of logos you wish to display in the carousel.", 'factory' )
		),
	)
) );
