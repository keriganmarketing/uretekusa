<?php

$template_directory = get_template_directory();
require_once $template_directory . '/classes/fabrique-theme.php';

require_once $template_directory . '/includes/fabrique-helper.php';
require_once $template_directory . '/includes/fabrique-items.php';
require_once $template_directory . '/includes/fabrique-navmenu.php';
require_once $template_directory . '/includes/fabrique-options.php';
require_once $template_directory . '/includes/fabrique-template.php';

if ( fabrique_is_woocommerce_activated() ) {
	require_once $template_directory . '/includes/fabrique-woocommerce.php';
}

function fabrique_init()
{
	global $fabrique;
	global $fabrique_core;
	global $wp_customize;

	$fabrique = apply_filters( 'fabrique_options', fabrique_default_options() );
	$fonts = apply_filters( 'fabrique_fonts', null );

	$version = fabrique_version();
	$style_custom = get_theme_mod( 'style_custom' );

	if ( !$wp_customize && $style_custom ) {
		if ( get_theme_mod( 'style_custom_version' ) ) {
			$style_version = get_theme_mod( 'style_custom_version' );
		} else {
			$style_version = $version;
		}

		$style_version = apply_filters( 'fabrique_style_custom_version', $style_version );
		$style_custom = preg_replace( "/^http:|https:/i", '', $style_custom );
	} else {
		$style_version = $version;
		$style_custom = get_template_directory_uri() . '/style-custom.css';
	}

	$style_custom = apply_filters( 'fabrique_style_custom', $style_custom, $style_version );

	wp_register_script(
		'fabrique-vendors',
		fabrique_asset( 'js/fbq.vendors.js' ),
		array( 'jquery', 'jquery-ui-widget' ),
		$version,
		true
	);

	wp_register_script(
		'fabrique',
		fabrique_asset( 'js/fbq.main.js' ),
		array( 'fabrique-vendors' ),
		$version,
		true
	);

	wp_register_script(
		'fabrique-preview',
		fabrique_asset( 'js/fbq.preview.js' ),
		array( 'jquery' ),
		$version,
		true
	);

	wp_register_style(
		'fabrique',
		fabrique_asset( 'css/fbq.main.css' ),
		null,
		$version
	);

	wp_register_style(
		'fabrique-custom',
		$style_custom,
		null,
		$style_version
	);

	if ( !class_exists( 'Fabrique_Core' ) ) {
		$fabrique_core = new Fabrique_Theme( 'fabrique', array() );
		$fabrique_core['core_asset_uri'] = get_template_directory_uri();

		do_action( 'fabrique_core_init', $fabrique_core );

		$fabrique_core->start();
	}
}
add_action( 'init', 'fabrique_init', 8 );


function fabrique_scripts()
{
	global $fabrique;
	global $fabrique_core;
	global $wp_customize;

	$customize_module = $fabrique_core->get_module( 'customize' );

	wp_enqueue_script( 'comment-reply' );
	wp_enqueue_script( 'fabrique' );
	wp_localize_script( 'fabrique', 'FabriqueOptions', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'ajax_nonce' => wp_create_nonce( 'ajax-nonce' )
	) );

	wp_enqueue_style( 'fabrique' );

	if ( $wp_customize  && $customize_module ) {
		$values = $customize_module->get_customize_values( $wp_customize );
		wp_add_inline_style( 'fabrique', fabrique_core_template_style_custom( $values ) );
	} else {
		wp_enqueue_style( 'fabrique-custom' );
	}
}
add_action( 'wp_enqueue_scripts', 'fabrique_scripts' );


function fabrique_asset( $asset, $minify = false )
{
	global $fabrique;

	$info = pathinfo( $asset );
	$image = in_array( $info['extension'], array( 'png', 'jpg' ) );

	if ( !$image && ($minify || $fabrique['minified_asset']) ) {
		$pos = strrpos( $asset, '.' );

		if ( $pos !== false ) {
			$asset = substr_replace($asset, '.min.', $pos, 1 );
		}
	}

	return $fabrique['asset_uri'] . '/' . $asset;
}


function fabrique_head()
{
	if ( function_exists( 'wp_site_icon' ) ) {
		wp_site_icon();
	}

	if ( fabrique_mod( 'site_responsive' ) ) {
		echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
	}

	echo '<!--[if lte IE 9]><style type="text/css">.fbq-opacity1 { opacity: 1; }</style><![endif]-->';
}
add_action( 'wp_head', 'fabrique_head' );
