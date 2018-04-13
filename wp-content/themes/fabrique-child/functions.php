<?php

function fabrique_child_init()
{
	wp_enqueue_style( 'fabrique-child', get_stylesheet_uri() , array( 'fabrique' ) );
	// *** Remove this comment to use custom script.***///
	// wp_enqueue_script( 'custom-script', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery' ) );

	// *** To include translations file of pickadate.
	// wp_enqueue_script(
	// 	'pickadate-language',
	// 	'URL of the translation file from https://cdnjs.com/libraries/pickadate.js',
	// 	array( 'fabrique' )
	// );
}
add_action( 'wp_enqueue_scripts', 'fabrique_child_init' );


// *** To include translations file of pickadate in backend
// function fabrique_child_pickadate_translation()
// {
// 	wp_enqueue_script(
// 		'pickadate-language',
// 		'URL of the translation file from https://cdnjs.com/libraries/pickadate.js',
// 		array( 'jquery' ),
// 		fabrique_version(),
// 		true
// 	);
// }
// add_action( 'admin_enqueue_scripts', 'fabrique_child_pickadate_translation', 11 );


//*** We recommend you to use plugin "Toolset Types" https://wordpress.org/plugins/types/ to create new custom post type.
//*** Remove this comment to enable blueprint with custom post type. Replace the post type name you want into "xxxxxxx".***///
// function child_theme_support_blueprint( $post_types )
// {
// 		$post_types[] = 'xxxxxxx';
// 		return $post_types;
// }
//
// add_filter( 'support_blueprint_post_types', 'child_theme_support_blueprint' );


//*** Remove this comment to enable media library to be able to upload SVG file type.***///
// function child_theme_mime_types( $mimes )
// {
// 		$mimes['svg'] = 'image/svg+xml';
// 		return $mimes;
// }
// add_filter( 'upload_mimes', 'child_theme_mime_types' );


// *** Remove this comment and rearrange social order yourself.
// function child_theme_social_order()
// {
// 	return array(
// 		'facebook',
// 		'twitter',
// 		'instagram',
// 		'youtube',
// 		'vimeo',
// 		'linkedin',
// 		'google-plus',
// 		'skype',
// 		'pinterest',
// 		'tripadvisor',
// 		'flickr',
// 		'tumblr',
// 		'dribbble',
// 		'behance',
// 		'stumbleupon',
// 		'email',
// 		'phone',
// 		'line'
// 	);
// }
// add_filter( 'default_social_order', 'child_theme_social_order' );


//*** Remove this comment to enable rating with custom post type. Replace the post type name you want into "xxxxxxx".***///
// function child_theme_support_rating( $post_types )
// {
// 		$post_types[] = 'xxxxxxx';
// 		return $post_types;
// }
//
// add_filter( 'support_rating_post_types', 'child_theme_support_rating' );


//*** Remove this comment to enable comment like/dislike with custom post type. Replace the post type name you want into "xxxxxxx".***///
// function child_theme_support_comment_like( $post_types )
// {
// 		$post_types[] = 'xxxxxxx';
// 		return $post_types;
// }
//
// add_filter( 'support_comment_like_dislike_post_types', 'child_theme_support_comment_like' );
