<?php

$plugin_path = plugin_dir_path( __FILE__ );

require_once $plugin_path . 'includes/helpers.php';
require_once $plugin_path . 'includes/translation.php';
require_once $plugin_path . 'classes/fabrique-core.php';
require_once $plugin_path . 'classes/fabrique-utility.php';
require_once $plugin_path . 'classes/fabrique-importer.php';
require_once $plugin_path . 'classes/modules/base-module.php';
require_once $plugin_path . 'classes/modules/api-module.php';
require_once $plugin_path . 'classes/modules/blueprint-module.php';
require_once $plugin_path . 'classes/modules/comment-module.php';
require_once $plugin_path . 'classes/modules/core-module.php';
require_once $plugin_path . 'classes/modules/customize-module.php';
require_once $plugin_path . 'classes/modules/font-module.php';
require_once $plugin_path . 'classes/modules/post-module.php';
require_once $plugin_path . 'classes/modules/widget-module.php';
require_once $plugin_path . 'classes/modules/import-module.php';
require_once $plugin_path . 'classes/modules/woocommerce-module.php';

require_once $plugin_path . 'classes/menu/nav-menu-edit.php';


function fabrique_core_init()
{
	// Add image sizes
	add_image_size( 'twist_medium', 512 );
	add_image_size( 'twist_large', 1280 );

	global $fabrique_core;
	$plugin_path = plugin_dir_path( __FILE__ );
	$plugin_url = plugin_dir_url( __FILE__ );

	if ( class_exists( 'WP_Customize_Control' ) ) {
		require_once $plugin_path . 'classes/customizes/color-control.php';
		require_once $plugin_path . 'classes/customizes/radio-control.php';
		require_once $plugin_path . 'classes/customizes/section-control.php';
		require_once $plugin_path . 'classes/customizes/select-control.php';
		require_once $plugin_path . 'classes/customizes/slider-control.php';
		require_once $plugin_path . 'classes/customizes/switch-control.php';
		require_once $plugin_path . 'classes/customizes/text-control.php';
		require_once $plugin_path . 'classes/customizes/theme-color-control.php';
		require_once $plugin_path . 'classes/customizes/component-control.php';
	}

	fabrique_core_register_taxonomies();
	fabrique_core_register_post_types();

	$options = apply_filters( 'fabrique_core_options', fabrique_core_default_options() );
	$app_name = apply_filters( 'fabrique_app_name', '' );

	$fabrique_core = new Fabrique_Core( $app_name, $options );
	$fabrique_core['core_path'] = $plugin_path;
	$fabrique_core['core_asset_uri'] = apply_filters( 'fabrique_core_asset_uri', $plugin_url . 'dist' );

	do_action( 'fabrique_core_init', $fabrique_core );

	$fabrique_core->start();
}

function fabrique_core_default_options()
{
	return array(
		'minified_asset' => false
	);
}

function fabrique_core_register_post_types()
{
	register_post_type( 'twcbp_block', array(
		'show_ui' => true,
		'has_archive' => false,
		'rewrite' => array(
			'slug' => 'bp-block'
		),
		'supports' => array(
			'title',
			'editor'
		),
		'labels' => array(
			'name' => _x( 'Blueprint Block', 'fabrique-core' ),
			'add_new_item' => __( 'Add New Blueprint Block', 'fabrique-core' ),
			'edit_item' => __( 'Edit Blueprint Block', 'fabrique-core' ),
			'new_item' => __( 'New Blueprint Block', 'fabrique-core' ),
			'view_item' => __( 'View Blueprint Block', 'fabrique-core' ),
			'all_items' => __( 'All Blueprint Block', 'fabrique-core' ),
			'archives' => __( '% Archives', 'fabrique-core' )
		),
		'menu_icon' => 'dashicons-schedule'
	) );
}

function fabrique_core_register_taxonomies()
{
	register_taxonomy( 'fbq_page_category', 'page', array(
		'rewrite' => array(
			'slug' => apply_filters( 'fabrique_page_category_slug', 'page_category' )
		),
		'show_admin_column' => true,
		'hierarchical' => true
	) );

	register_taxonomy( 'fbq_page_tag', 'page', array(
		'rewrite' => array(
			'slug' => apply_filters( 'fabrique_page_tag_slug', 'page_tag' )
		)
	) );
}

function fabrique_core_search_blueprint( $where, $wp_query )
{
	if ( empty( $where ) ) return $where;
	global $wpdb;

	// get search expression
	$terms = $wp_query->query_vars['s'];

	// explode search expression to get search terms
	$exploded = explode( ' ', $terms );
	if( $exploded === FALSE || count($exploded) == 0 ){
		$exploded = array( 0 => $terms );
	}

	// reset search in order to rebuilt it as we whish
	$where = '';

	// search acf
	$search_data = 'bp_data';

	foreach ( $exploded as $tag ) {
		$tag = esc_sql($tag);
		$where .= "
			AND (
				({$wpdb->prefix}posts.post_title LIKE '%$tag%')
				OR ({$wpdb->prefix}posts.post_content LIKE '%$tag%')
				OR EXISTS (
					SELECT * FROM {$wpdb->prefix}postmeta
					WHERE post_id = {$wpdb->prefix}posts.ID
					AND (meta_key = '" . $search_data . "' AND meta_value LIKE '%{$tag}%')
				)
			)
		";
	}

	return $where;
}
add_filter( 'posts_search', 'fabrique_core_search_blueprint', 10, 2 );
