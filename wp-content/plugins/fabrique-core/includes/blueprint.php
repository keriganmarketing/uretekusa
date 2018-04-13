<?php

function fabrique_module( $fabrique_core )
{
	wp_register_script(
		'fabrique-admin-common',
		fabrique_core_asset( 'js/fbq.admin-common.js' ),
		array( 'jquery', 'jquery-ui-widget' ),
		fabrique_core_version(),
		true
	);

	wp_register_style(
		'fabrique-admin-common',
		fabrique_core_asset( 'css/fbq.admin-common.css' ),
		null,
		fabrique_core_version()
	);
}
add_action( 'fabrique_core_init', 'fabrique_module' );


function fabrique_blueprint_scripts( $dependencies = array() , $options, $strings )
{
	array_unshift( $dependencies, 'fabrique-admin-common' );

	wp_enqueue_script(
		'fabrique-blueprint',
		fabrique_core_asset( 'js/fbq.blueprint.js' ),
		$dependencies,
		fabrique_core_version(),
		true
	);

	wp_enqueue_style( 'fabrique-admin-common' );

	wp_localize_script( 'fabrique-blueprint', 'BPOptions', $options );
	wp_localize_script( 'fabrique-blueprint', 'BPStrings', $strings );
}
add_action( 'fabrique_core_blueprint_scripts', 'fabrique_blueprint_scripts', 10, 3 );


function fabrique_customize_scripts( $dependencies = array() , $options )
{
	array_unshift( $dependencies, 'fabrique-admin-common' );

	wp_enqueue_script(
		'fabrique-customize',
		fabrique_core_asset( 'js/fbq.customize.js' ),
		$dependencies,
		fabrique_core_version(),
		true
	);

	wp_enqueue_style( 'fabrique-admin-common' );
}
add_action( 'fabrique_core_customize_scripts', 'fabrique_customize_scripts', 10, 2 );


function fabrique_customize_preview_scripts()
{
	wp_enqueue_script( 'fabrique-preview' );
	wp_localize_script( 'fabrique-preview', 'Fabrique', get_theme_mods() );
}
add_action( 'fabrique_core_customize_preview_scripts', 'fabrique_customize_preview_scripts' );


function fabrique_admin_scripts( $dependencies = array(), $options  = array(), $strings = array() )
{
	array_unshift( $dependencies, 'fabrique-admin-common' );

	wp_enqueue_script(
		'fabrique-admin',
		fabrique_core_asset( 'js/fbq.admin.js' ),
		$dependencies,
		fabrique_core_version(),
		true
	);

	wp_enqueue_style( 'fabrique-admin-common' );

	wp_localize_script( 'fabrique-admin', 'BPOptions', $options );
	wp_localize_script( 'fabrique-admin', 'BPStrings', $strings );
}
add_action( 'fabrique_core_admin_scripts', 'fabrique_admin_scripts', 10, 3 );


// script for taxonomy page to upload images
function fabrique_taxonomy_scripts( $dependencies = array(), $options  = array() )
{
	wp_enqueue_media();
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_style( 'wp-color-picker' );

	wp_enqueue_script(
		'fabrique-taxonomy',
		fabrique_core_asset( 'js/fbq.taxonomy.js' ),
		$dependencies,
		fabrique_core_version(),
		true
	);

	$options = apply_filters( 'taxonomy_pages_options', array(
		'placeholder' => fabrique_placeholder(),
		'multiple' => 'false',
		'string' => array(
			'choose' => esc_html__( 'Choose an image', 'fabrique' ),
			'use' => esc_html__( 'Use image', 'fabrique' )
		)
	) );

	wp_localize_script( 'fabrique-taxonomy', 'taxonomyObj', $options );
}
add_action( 'fabrique_core_taxonomy_scripts', 'fabrique_taxonomy_scripts', 10, 2 );


// Common admin menu pages (not theme dashboard)
function fabrique_menu_pages_scripts( $dependencies = array(), $options = array() )
{
	array_unshift( $dependencies, 'fabrique-admin-common' );

	wp_enqueue_script(
		'fabrique-admin',
		fabrique_core_asset( 'js/fbq.admin.js' ),
		$dependencies,
		fabrique_core_version(),
		true
	);

	wp_enqueue_style( 'fabrique-admin-common' );
}
add_action( 'fabrique_core_menu_pages_scripts', 'fabrique_menu_pages_scripts', 10, 2 );


function fabrique_widgets_scripts( $dependencies = array(), $options = array(), $strings = array() )
{
	array_unshift( $dependencies, 'fabrique-admin-common' );

	wp_enqueue_script(
		'fabrique-widgets',
		fabrique_core_asset( 'js/fbq.widgets.js' ),
		$dependencies,
		fabrique_core_version(),
		true
	);

	wp_enqueue_style( 'fabrique-admin-common' );
	wp_localize_script( 'fabrique-widgets', 'BPOptions', $options );
	wp_localize_script( 'fabrique-widgets', 'BPStrings', $strings );
}
add_action( 'fabrique_core_widgets_scripts', 'fabrique_widgets_scripts', 10, 3 );


function fabrique_post_scripts( $dependencies = array(), $options = array() )
{
	wp_enqueue_script(
		'fabrique-tinymce',
		fabrique_core_asset( 'js/fbq.tinymce.js' ),
		$dependencies,
		fabrique_core_version(),
		true
	);
}
add_action( 'fabrique_core_post_scripts', 'fabrique_post_scripts', 10, 2 );


// Filters
function fabrique_app_name()
{
	return 'fabrique';
}
add_filter( 'fabrique_app_name', 'fabrique_app_name' );


function fabrique_blueprint_options( $options )
{
	$options['placeholders'] = fabrique_core_asset( 'images/placeholder.png' );

	return $options;
}
add_filter( 'blueprint_options', 'fabrique_blueprint_options' );


function fabrique_mce_plugins( $plugins )
{
	$plugins['fabrique'] = fabrique_core_asset( 'js/fbq.tinymce.js' );

	return $plugins;
}
add_filter( 'mce_external_plugins', 'fabrique_mce_plugins' );


function fabrique_mce_buttons( $buttons )
{
    $buttons[] = 'fabrique-gallery';
    $buttons[] = 'fabrique-image';
    $buttons[] = 'fabrique-video';
    $buttons[] = 'fabrique-blockquote';
    $buttons[] = 'fabrique-button';

    return $buttons;
}
add_filter( 'mce_buttons', 'fabrique_mce_buttons' );


function fabrique_default_customize_options( $options )
{
	return $options;
}
add_filter( 'fabrique_core_default_customize_options', 'fabrique_default_customize_options' );


function fabrique_style_custom_template()
{
	return trailingslashit(get_template_directory()) . 'templates/style-custom.php';
}
add_filter( 'fabrique_core_style_custom_template', 'fabrique_style_custom_template' );


function fabrique_blueprint_style_custom_template()
{
	return trailingslashit(get_template_directory()) . 'templates/style-custom-blueprint.php';
}
add_filter( 'fabrique_core_blueprint_style_custom_template', 'fabrique_blueprint_style_custom_template' );
