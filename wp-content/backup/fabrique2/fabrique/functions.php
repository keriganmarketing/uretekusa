<?php

$dir = get_template_directory();

require_once $dir . '/lib/class-tgm-plugin-activation.php';
require_once $dir . '/includes/fabrique.php';

function fabrique_version()
{
	return '1.0.12';
}

function fabrique_after_setup_theme()
{
	global $content_width;
	$theme_defaults = get_theme_mod( 'theme_defaults' );

	if ( !$theme_defaults ) {
		$options = fabrique_theme_options();

		foreach ( $options as $key => $value ) {
			set_theme_mod( $key, $value );
		}

		set_theme_mod( 'theme_defaults', true );
	}

	$post_settings = get_theme_mod( 'post_settings' );

	if ( empty( $post_settings ) ) {
		set_theme_mod( 'post_settings', fabrique_default_post_options() );
	}

	// Theme support
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-header' );
	add_theme_support( 'custom-background' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption'
	) );

	// Add post format
	add_theme_support( 'post-formats', array(
		'gallery',
		'quote',
		'video',
		'audio'
	) );

	// added tiny mce editor styling
	add_editor_style();

	// Add excerpt to support page post type
	add_post_type_support( 'page', 'excerpt' );

	// Add attribute to support post post type
	add_post_type_support( 'post', 'page-attributes' );

	register_nav_menus( array(
		'fbq-primary-menu'  => esc_html__( 'Primary Menu', 'fabrique' ),
		'fbq-mobile-menu'  => esc_html__( 'Mobile Menu', 'fabrique' )
	) );

	// Set up content max width
	$content_max_width = fabrique_mod( 'content_max_width' );

	if ( !empty( $content_max_width ) ) {
		$content_width = $content_max_width;
	} else {
		$content_width = apply_filters( 'default_content_max_width', 1100 );
	}
}
add_action( 'after_setup_theme', 'fabrique_after_setup_theme' );


function fabrique_register_initial_sidebar()
{
	// register dynamic sidebars
	$fabrique_sidebars = array(
		'fabrique-sidebar' => esc_html__( 'Fabrique Sidebar', 'fabrique' ),
		'fabrique-topbar-1' => esc_html__( 'Topbar 1', 'fabrique' ),
		'fabrique-topbar-2' => esc_html__( 'Topbar 2', 'fabrique' ),
		'fabrique-topbar-3' => esc_html__( 'Topbar 3', 'fabrique' ),
		'fabrique-topbar-4' => esc_html__( 'Topbar 4', 'fabrique' ),
		'fabrique-navbar-stacked-left' => esc_html__( 'Stacked Navbar Left', 'fabrique' ),
		'fabrique-navbar-stacked-right' => esc_html__( 'Stacked Navbar Right', 'fabrique' ),
		'fabrique-navbar-standard-right' => esc_html__( 'Standard Navbar Right', 'fabrique' ),
		'fabrique-navbar-mobile' => esc_html__( 'Mobile Navbar', 'fabrique' ),
		'fabrique-navbar-full' => esc_html__( 'Full Navbar', 'fabrique' ),
		'fabrique-navbar-offcanvas' => esc_html__( 'Offcanvas Navbar', 'fabrique' ),
		'fabrique-navbar-side' => esc_html__( 'Side Navbar', 'fabrique' ),
		'fabrique-headerwidget-1' => esc_html__( 'Header Widget 1', 'fabrique' ),
		'fabrique-headerwidget-2' => esc_html__( 'Header Widget 2', 'fabrique' ),
		'fabrique-headerwidget-3' => esc_html__( 'Header Widget 3', 'fabrique' ),
		'fabrique-headerwidget-4' => esc_html__( 'Header Widget 4', 'fabrique' )
	);

	$widget_title = fabrique_get_title( array( 'size' => 'h3' ), false );
	$sidebar = array(
		'class' => 'fabrique_theme js-dyanmic-sidebar',
		'description' => esc_html__( 'Custom Widget', 'fabrique' ),
		'before_title' => $widget_title['prefix'],
		'after_title' => $widget_title['suffix']
	);

	foreach ( $fabrique_sidebars as $id => $name ) {
		$sidebar['id'] = $id;
		$sidebar['name'] = $name;
		register_sidebar( $sidebar );
	}
}
add_action( 'widgets_init', 'fabrique_register_initial_sidebar' );


// TGM Register
function fabrique_tgmpa_register()
{
	$template_directory = get_template_directory();

	$plugins = array(
		array(
			'name' => esc_html__( 'Fabrique Core', 'fabrique' ),
			'slug' => 'fabrique-core',
			'version' => '1.0.12',
			'source' => $template_directory . '/lib/plugins/fabrique-core.zip',
			'required' => true
		),
		array(
			'name' => esc_html__( 'Envato Market', 'fabrique' ),
			'slug' => 'envato-market',
			'source' => $template_directory . '/lib/plugins/envato-market.zip',
			'required' => false
		),
		array(
			'name' => esc_html__( 'Slider Revolution', 'fabrique' ),
			'slug' => 'revslider',
			'source' => $template_directory . '/lib/plugins/revslider.zip',
			'required' => false
		),
		array(
			'name' => esc_html__( 'Contact Form 7', 'fabrique' ),
			'slug' => 'contact-form-7',
			'required' => false
		),
		array(
			'name' => esc_html__( 'MailChimp for WordPress', 'fabrique' ),
			'slug' => 'mailchimp-for-wp',
			'required' => false
		),
		array(
			'name' => esc_html__( 'WooCommerce', 'fabrique' ),
			'slug' => 'woocommerce',
			'required' => false
		),
		array(
			'name' => esc_html__( 'WP Google Maps', 'fabrique' ),
			'slug' => 'wp-google-maps',
			'required' => false
		),
		array(
			'name' => esc_html__( 'Yoast SEO', 'fabrique' ),
			'slug' => 'wordpress-seo',
			'required' => false
		)
	);

	$configs = array(
		'id' => 'fabrique-tgmpa',
		'is_automatic' => true
	);

	$plugins = apply_filters( 'fabrique_tgmpa_plugins', $plugins );
	$configs = apply_filters( 'fabrique_tgmpa_configs', $configs );

	tgmpa( $plugins, $configs );
}
add_action( 'tgmpa_register', 'fabrique_tgmpa_register' );
