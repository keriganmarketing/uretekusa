<?php

function fabrique_core_option( $name )
{
	global $fabrique_core;
	return $fabrique_core['core_' . $name];
}

function fabrique_core_asset( $asset, $minify = false )
{
	global $fabrique_core;

	$info = pathinfo( $asset );
	$image = in_array( $info['extension'], array( 'png', 'jpg' ) );

	if ( !$image && ($minify || $fabrique_core['minified_asset']) ) {
		$pos = strrpos( $asset, '.' );

		if ( $pos !== false ) {
			$asset = substr_replace($asset, '.min.', $pos, 1 );
		}
	}

	return $fabrique_core['core_asset_uri'] . '/' . $asset;
}


function fabrique_core_template( $template, $args = array(), $absolute_path = false )
{
	global $fabrique_core;

	if ( $args ) {
		$fabrique_core->set_template_args( $template, $args );
	}

	if ( !$absolute_path ) {
		$template_file = $fabrique_core['core_path'] . 'templates/' . $template . '.php';
	} else {
		$template_file = $absolute_path;
	}

	load_template( $template_file, false );
}


function fabrique_core_template_style_custom( $values = array() )
{
	global $fabrique_core;

	$default_template = $fabrique_core['core_path'] . 'templates/style-custom.php';

	$values = apply_filters( 'fabrique_core_style_custom_values', $values );
	$template_path = apply_filters( 'fabrique_core_style_custom_template', $default_template );

	ob_start();
	fabrique_core_template( 'style-custom', $values, $template_path );
	return ob_get_clean();
}


function fabrique_core_template_blueprint_style_custom( $values = array() )
{
	global $fabrique_core;

	$default_template = $fabrique_core['core_path'] . 'templates/style-custom-blueprint.php';

	$values = apply_filters( 'fabrique_core_style_custom_values', $values );
	$template_path = apply_filters( 'fabrique_core_blueprint_style_custom_template', $default_template );

	ob_start();
	fabrique_core_template( 'style-custom-blueprint', $values, $template_path );
	return ob_get_clean();
}


function fabrique_core_template_args( $template )
{
	global $fabrique_core;
	return $fabrique_core->get_template_args( $template );
}


function fabrique_core_let_to_num( $size )
{
	$l = substr( $size, -1 );
	$ret = substr( $size, 0, -1 );

	switch ( strtoupper( $l ) ) {
		case 'P':
			$ret *= 1024;
		case 'T':
			$ret *= 1024;
		case 'G':
			$ret *= 1024;
		case 'M':
			$ret *= 1024;
		case 'K':
			$ret *= 1024;
	}

	return $ret;
}


function fabrique_core_system_reports()
{
	$reports = array(
		'memory_limit' => array(
			'value' => WP_MEMORY_LIMIT,
			'recommended' => '64M'
		),
		'max_execution_time' => array(
			'value' => ini_get( 'max_execution_time' ),
			'recommended' => 120
		)
	);

	$reports['max_execution_time']['status'] = ( $reports['max_execution_time']['value'] >= 120 );
	$reports['memory_limit']['status'] = ( fabrique_core_let_to_num( $reports['memory_limit']['value'] ) >= 67108864 );

	return $reports;
}


function fabrique_core_import_demo_status()
{
	$reports = fabrique_core_system_reports();

	$reports['related_configs'] = array();
	$reports['import_demo_status'] = true;

	if ( !$reports['memory_limit']['status'] ) {
		$reports['related_configs'][] = 'Memory Limit';
		$reports['import_demo_status'] = false;
	}

	if ( !$reports['max_execution_time']['status'] ) {
		$reports['related_configs'][] = 'Max Executation Time';
		$reports['import_demo_status'] = false;
	}

	return $reports;
}


function fabrique_core_style_custom_dir()
{
	$upload_dir = wp_upload_dir();
	$filename = apply_filters( 'fabrique_style_custom_filename', 'style-custom.css' );

	$path = trailingslashit( $upload_dir['basedir'] ) . $filename;
	$url = trailingslashit( $upload_dir['baseurl'] ) . $filename;

	return apply_filters( 'fabrique_core_style_custom_dir', array(
		'path' => $path,
		'url' => $url
	) );
}


function fabrique_core_scan_template_files( $path )
{
	$files  = @scandir( $path );
	$output = array();

	if ( !empty( $files ) ) {
		foreach ( $files as $key => $value ) {
			if ( !in_array( $value, array( '.', '..' ) ) ) {
				if ( is_dir( $path . '/' . $value ) ) {
					$sub_folder = fabrique_core_scan_template_files( $path . '/' . $value );
					foreach ( $sub_folder as $sub_file ) {
						if ( '.php' === substr( $sub_file, -4 ) ) {
							$output[] = $value . '/' . $sub_file;
						}
					}
				} else {
					if ( '.php' === substr( $value, -4 ) ) {
						$output[] = $value;
					}
				}
			}
		}
	}
	return $output;
}


function fabrique_core_get_template_file_version( $file )
{
	$fp = fopen( $file, 'r' );
	$file_data = fread( $fp, 8192 );
	fclose( $fp );

	$file_data = str_replace( "\r", "\n", $file_data );
	$version   = '';

	if ( preg_match( '/^[ \t\/*#@]*' . preg_quote( '@version', '/' ) . '(.*)$/mi', $file_data, $match ) && $match[1] )
		$version = _cleanup_header_comment( $match[1] );

	return $version ;
}


function fabrique_core_escape_content( $content )
{
	return apply_filters( 'fabrique_core_escape_content', $content );
}

function fabrique_core_sanitize_text_value( $text )
{
	return $text;
}

function fabrique_core_sanitize_url_value( $url )
{
	return $url;
}

function fabrique_core_sanitize_color_value( $value )
{
	preg_match( "/^bp_color_(\\d\\d?)$/", $value, $sync_match );
	preg_match( "/^#([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?$/", $value, $hex_match );

	if ( 'transparent' === $value || ( $sync_match && 0 < $sync_match[1] && $sync_match[1] < 15 ) || $hex_match ) {
		return $value;
	} else {
		return 'default';
	}
}

function fabrique_core_sanitize_number_value( $number )
{
	if ( is_numeric( $number ) ) {
		return $number;
	} elseif ( '0' === $number ) {
		return 0;
	} else {
		return '';
	}
}

function fabrique_core_sanitize_boolean_value( $boolean )
{
	if ( true === $boolean || 'true' === $boolean || 1 === $boolean ) {
		return true;
	} else {
		return false;
	}
}

function fabrique_core_sanitize_component_value( $value )
{
	$multi_values = !is_array( $value ) ? explode( ',', $value ) : $value;
	return !empty( $multi_values ) ? $multi_values : array();
}

function fabrique_core_woocommerce_activated()
{
	return class_exists( 'woocommerce' );
}

function fabrique_core_scrape_instagram( $username, $access_token, $count = null )
{
	//if (false === ($instagram = get_transient('instagram-photos-'.sanitize_title_with_dashes($username)))) {
	// get id section
	$post_count = '';
	if ( !empty( $count ) ) {
		$post_count .= '&count=' . $count;
	}

	$remote_id = wp_remote_get( 'https://api.instagram.com/v1/users/search?q=' . trim( $username ) . '&access_token=' . trim( $access_token ) );

	if ( is_wp_error( $remote_id ) )
		return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'fabrique-core' ) );

	if ( 200 != wp_remote_retrieve_response_code( $remote_id ) )
		return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'fabrique-core' ) );

	$user_data = json_decode( $remote_id['body'] );

	if ( empty($user_data->data[0]->id) ) {
		return new WP_Error( 'cannot_get_id', esc_html__( 'Could not get instagram access token.', 'fabrique-core' ) );
	}

	// get image section
	$remote = wp_remote_get( 'https://api.instagram.com/v1/users/' . $user_data->data[0]->id . '/media/recent/?access_token=' . trim( $access_token ) . $post_count );

	if ( is_wp_error( $remote ) )
		return new WP_Error('site_down', esc_html__( 'Unable to communicate with Instagram.', 'fabrique-core' ) );

	if ( 200 != wp_remote_retrieve_response_code( $remote ) )
		return new WP_Error( 'invalid_response', esc_html__('Instagram did not return a 200.', 'fabrique-core' ) );

	$user_content = json_decode( $remote['body'], true );
	$images = $user_content['data'];
	$instagram = array();
	foreach ( $images as $image ) {
		if ( 'image' === $image['type'] ) {

			$instagram[] = array(
				'caption' 		=> $image['caption']['text'],
				'link' 			=> $image['link'],
				'time'			=> $image['created_time'],
				'comments' 		=> $image['comments']['count'],
				'likes' 		=> $image['likes']['count'],
				'tags'			=> $image['tags'],
				'url'			=> $image['images']['standard_resolution']['url'],
				'width'			=> $image['images']['standard_resolution']['width'],
				'height'		=> $image['images']['standard_resolution']['height']
			);
		}
	}

	$instagram = base64_encode( serialize( $instagram ) );
	set_transient( 'instagram-photos-' . sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS*2 ) );
	// }

	$instagram = unserialize( base64_decode( $instagram ) );

	return $instagram;
}
