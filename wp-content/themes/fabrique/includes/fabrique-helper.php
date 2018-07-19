<?php


function fabrique_option( $option_name )
{
	global $fabrique;
	return $fabrique->get_option( 'fabrique_' . $option_name );
}


function fabrique_mod( $mod_name, $default = null )
{
	$default = !empty( $default ) ? $default : fabrique_theme_options( $mod_name );
	return get_theme_mod( $mod_name, $default );
}


function fabrique_smod( $mod_name, $value )
{
	set_theme_mod( 'fbq_' . $mod_name, $value );
}


/**
 * output placeholder
 */
function fabrique_placeholder( $type = null )
{
	$type = !empty( $type ) ? '-' . $type : '';
	return fabrique_asset( 'images/fabrique-placeholder' . $type . '.png', false );
}


function fabrique_escape_content( $content )
{
	return apply_filters( 'fabrique_escape_content', $content );
}


/**
 * check if WooCommerce is Active
 */
function fabrique_is_woocommerce_activated()
{
	return class_exists( 'woocommerce' );
}


/**
 * check if Blueprint is Active
 */
function fabrique_is_blueprint_active( $bp_data )
{
	if ( $bp_data ) {
		if ( is_array( $bp_data ) ) {
			if ( isset( $bp_data['builder'] ) && isset( $bp_data['builder']['active'] ) ) {
				return $bp_data['builder']['active'] == true;
			}
		}
	}

	return false;
}


function fabrique_bp_data( $post_id )
{
	return get_post_meta( $post_id, 'bp_data', true );
}


/**
 * Output Attribute
 */
function fabrique_a( $args )
{
	$attribute = array();
	$keys = array( 'id', 'class', 'role', 'itemprop', 'itemtype' );
	foreach ( $keys as $key ) {
		if ( isset( $args[$key] ) && !empty( $args[$key] ) ) {
			if ( is_array( $args[$key] ) ) {
				$attribute[] = $key . '="' . esc_attr( implode( ' ', $args[$key] ) ) .'"';
			} else {
				$attribute[] = $key . '="' . esc_attr( $args[$key] ) .'"';
			}
		}
	}

	if ( isset( $args['itemscope'] )&& $args['itemscope'] ) {
		$attribute[] = 'itemscope="itemscope"';
	}

	if ( isset( $args['style_attr'] ) && !empty( $args['style_attr'] ) ) {
		$attribute[] = fabrique_s( $args['style_attr'] );
	}

	if ( isset( $args['data_attr'] ) && !empty( $args['data_attr'] ) ) {
		$attribute[] = fabrique_d( $args['data_attr'] );
	}

	return implode( ' ', $attribute );
}


/**
 * Parsing Theme Colors
 */
function fabrique_c( $color )
{
	if ( '#' === substr( $color, 0, 1 ) || 'transparent' === $color ) {
		$output = $color;
	} elseif ( 'default' === $color || empty( $color ) ) {
		return;
	} else {
		if ( 'bp' === substr( $color, 0, 2 ) ) {
			$output = fabrique_mod( $color );
		} else {
			switch ( $color ) {
				case 'primary_brand' :
					$output = fabrique_mod( 'bp_color_1' );
					break;
				case 'secondary_brand' :
					$output = fabrique_mod( 'bp_color_2' );
					break;
				case 'primary_text' :
					$output = fabrique_mod( 'bp_color_3' );
					break;
				case 'secondary_text' :
					$output = fabrique_mod( 'bp_color_4' );
					break;
				case 'primary_background' :
					$output = fabrique_mod( 'bp_color_5' );
					break;
				case 'secondary_background' :
					$output = fabrique_mod( 'bp_color_6' );
					break;
				case 'border' :
					$output = fabrique_mod( 'bp_color_7' );
					break;
				case 'dark_primary_text' :
					$output = fabrique_mod( 'bp_color_8' );
					break;
				case 'dark_secondary_text' :
					$output = fabrique_mod( 'bp_color_9' );
					break;
				case 'dark_primary_background' :
					$output = fabrique_mod( 'bp_color_10' );
					break;
				case 'dark_secondary_background' :
					$output = fabrique_mod( 'bp_color_11' );
					break;
				case 'dark_border' :
					$output = fabrique_mod( 'bp_color_12' );
					break;
				case 'custom_1' :
					$output = fabrique_mod( 'bp_color_13' );
					break;
				case 'custom_2' :
					$output = fabrique_mod( 'bp_color_14' );
					break;
				default :
					$output = $color;
			}
		}
	}

	return $output;
}


/**
 * Output Style Attribute
 */
function fabrique_s( $args, $inline_style = true )
{
	if ( empty( $args ) )
		return;

	if ( is_array( $args ) ) {
		$props = array();

		foreach ( $args as $key => $value ) {
			if ( !empty( $value ) || 0 === $value || '0' === $value ) {
				if ( 'background' === $key ) {
					$props[] = $value;
				} else {
					$props[] = esc_attr( $key ) . ':' . $value . ';';
				}
			}
		}

		$output = implode( ' ', $props );
	} else {
		$output = $args;
	}

	if ( $inline_style && !empty( $output ) ) {
		return 'style="' . fabrique_escape_content( $output ) . '"';
	} else {
		return fabrique_escape_content( $output );
	}
}


/**
 * Output Data Attribute
 */
function fabrique_d( $args )
{
	if ( !empty( $args ) ) {
		$property = array();

		foreach ( $args as $key => $value ) {
			if ( !empty( $value ) || 0 === $value || '0' === $value ) {
				$property[] = 'data-'. esc_attr( $key ) .'="'. esc_attr( $value ) .'"';
			}
		}

		$output = fabrique_escape_content( implode( ' ', $property ) );
	} else {
		$output = null;
	}

	return $output;
}


/**
 * Get Row Format
 */
function fabrique_get_row_items( $items, $columns )
{
	$formatted = array();

	foreach ( $items as $index => $data ) {

		$row_index = floor( $index / $columns );
		$column_index = floor( $index % $columns );

		$row = isset( $formatted[$row_index] ) ? $formatted[$row_index] : array();
		$row[$column_index] = $data;

		$formatted[$row_index] = $row;
	}

	return $formatted;
}


/**
 * Get Grid Columns
 */
function fabrique_space_class( $layout = '1', $index = 0 )
{
	if ( '1-1-1-1-1' === $layout ) {
		$classes = array( 'fbq-col-1-5' );
	} else {
		preg_match_all( "/(\d+)/", $layout, $matches );
		$columns = array_sum( $matches[0] );
		$classes = array( 'fbq-col-' . 12/$columns * $matches[0][$index] );
	}

	return implode( ' ', $classes );
}


/**
 * Return Selected Color from Color Array
 */
function fabrique_customizer_get_color( $color, $args = array() )
{
	if ( 'bp' === substr( $color, 0, 2 ) && !empty( $args ) ) {
		$color = $args[$color];
	} elseif ( 'default' === $color ) {
		return;
	}

	return $color;
}


/**
 * Get Header Height (topbar + navbar)
 */
function fabrique_get_header_height( $image_url = null, $navbar_position = 'top', $navbar_style = 'standard' )
{
	$stacked_line_height = fabrique_mod( 'navbar_stacked_lineheight' );
	$topbar_height = ( fabrique_mod( 'topbar' ) ) ? fabrique_mod( 'topbar_height' ) : 0;

	if ( 'stacked' !== $navbar_style ) {
		$logo_offset_top = ( null !== fabrique_mod( 'navbar_logo_offset_top' ) ) ? (int)fabrique_mod( 'navbar_logo_offset_top' ) : 0;
		$menu_offset_top = ( null !== fabrique_mod( 'navbar_menu_offset_top' ) ) ? (int)fabrique_mod( 'navbar_menu_offset_top' ) : 0;
	} else {
		$logo_offset_top = ( null !== fabrique_mod( 'navbar_stacked_logo_offset_top' ) ) ? (int)fabrique_mod( 'navbar_stacked_logo_offset_top' ) : 0;
		$menu_offset_top = ( null !== fabrique_mod( 'navbar_stacked_menu_offset_top' ) ) ? (int)fabrique_mod( 'navbar_stacked_menu_offset_top' ) : 0;
	}

	if ( 'text' === fabrique_mod( 'logo_type' ) ) {
		$logo_set_height = fabrique_mod( 'logo_font_size' );
	} else {
		$attached_image = fabrique_convert_image( $image_url );

		if ( !empty( $attached_image ) ) {
			$logo_ratio = ( 0 != $attached_image['width'] && 0 != $attached_image['height'] ) ? $attached_image['width'] / $attached_image['height'] : 1;
		} else {
			$logo_ratio = 1;
		}

		$logo_set_height = !empty( $image_url ) ? fabrique_mod( 'logo_width' ) / $logo_ratio : fabrique_mod( 'logo_width' );
	}

	if ( 'top' === $navbar_position ) {
		if ( 'stacked' !== $navbar_style ) {
			if ( 'small' === fabrique_mod( 'navbar_size' ) ) {
				$navbar_height = 70;
			} elseif ( 'large' === fabrique_mod( 'navbar_size' ) ) {
				$navbar_height = 100;
			} else {
				$navbar_height = fabrique_mod( 'navbar_height' );
			}
		} else {
			$menu_height = !empty( $stacked_line_height ) ? $stacked_line_height : 56;
			$border_width = fabrique_mod( 'navbar_menu_border_thickness' );
			$navbar_height =  $logo_offset_top + ceil( $logo_set_height ) + $menu_offset_top + $menu_height + $border_width;
		}
	} else {
		$navbar_height = 0;
	}

	$header_height = $topbar_height + $navbar_height;

	return $header_height;
}


/**
 * Get Contrast Colot, specially use with text in background color
 */
function fabrique_contrast_color( $color )
{
	if ( empty( $color ) || 'default' === $color ) {
		return;
	} elseif ( 'transparent' === $color ) {
		return '#222';
	} else {
		$hex = str_replace( '#', '', fabrique_c( $color ) );
		$r = hexdec( substr( $hex, 0, 2 ) );
		$g = hexdec( substr( $hex, 2, 2 ) );
		$b = hexdec( substr( $hex, 4, 2 ) );
		$brightness = ( ( $r*299 ) + ( $g*587 ) + ( $b*114 ) ) / 1000;

		return ( $brightness > 180 ) ? '#222' : '#fff';
	}
}


/**
 * Convert from image url or id to array of image data
 */
function fabrique_convert_image( $image = null, $size = 'full', $ratio = 'auto' )
{
	$image_set = array();
	$image_set_size = array( 'full', 'twist_large', 'large', 'medium_large', 'twist_medium', 'medium', 'thumbnail' );
	$start_position = array_search( $size, $image_set_size );
	$start_position = ( $start_position ) ? $start_position : 0;
	$default_output = array(
		'id' => false,
		'url' => fabrique_placeholder(),
		'full_image_url' => fabrique_placeholder(),
		'full_image_width' => 900,
		'full_image_height' => 600,
		'width' => 900,
		'height' => 600,
		'image_set' => array()
	);

	if ( empty( $image ) ) {
		return $default_output;
	} else {
		$image_id = is_numeric( $image ) ? $image : fabrique_attachment_url_to_id( $image );

		if ( $image_id && !empty( $image_id ) ) {
			$fullsize_attachment = wp_get_attachment_image_src( $image_id, 'full' );

			if ( $fullsize_attachment ) {
				$full_image_url = $fullsize_attachment[0];
				$full_image_width = $fullsize_attachment[1];
				$full_image_height = $fullsize_attachment[2];

				for ( $index = $start_position; $index < count( $image_set_size ); $index++ ) {
					if ( 'auto' === $ratio ) {
						if ( 0 == $index ) {
							$image_set[$image_set_size[$index]] = $fullsize_attachment;
						} else {
							$image_set[$image_set_size[$index]] = wp_get_attachment_image_src( $image_id, $image_set_size[$index] );
						}
					} else {
						$image_set[$image_set_size[$index]] = fabrique_crop_image( $image_id, $fullsize_attachment, $ratio, $image_set_size[$index] );
					}

					if ( $image_set_size[$index] === $size ) {
						$attachment = $image_set[$image_set_size[$index]];
					}
				}

				if ( !isset( $attachment ) ) {
					if ( isset( $image_set[$size] ) ) {
						$attachment = $image_set[$size];
					} else {
						$attachment = $fullsize_attachment;
					}
				}

				$image_url = $attachment[0];
			} else {
				return $default_output;
			}
		} else {
			$attachment = array( $image, '', '' );
			$image_url = $image;
			$full_image_url = $image;
			$full_image_width = '';
			$full_image_height = '';
		}

		$image_width = $attachment[1];
		$image_height = $attachment[2];

		return array(
			'id' => $image_id,
			'url' => $image_url,
			'full_image_url' => $full_image_url,
			'full_image_width' => $full_image_width,
			'full_image_height' => $full_image_height,
			'width' => $image_width,
			'height' => $image_height,
			'image_set' => $image_set
		);
	}

	return $output;
}


/**
 * This function use to replace attachment_url_to_postid WordPress function, since it has problem in wordpress verdion 4.0
 */
function fabrique_attachment_url_to_id( $image_url )
{
	$image_id = attachment_url_to_postid( $image_url );

	if ( $image_id ) {
		return $image_id;
	} else {
		global $wpdb;

		$attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ) );
		if ( !empty( $attachment ) ) {
			return (int) apply_filters( 'fabrique_attachment_url_to_id', $attachment[0], $image_url );
		} else {
			return false;
		}
	}
}


/**
 * Convert Hex format color to Rgba
 */
function fabrique_hex_to_rgba( $color, $opacity = 1 )
{
	if ( 'transparent' ===  $color || 0 == $opacity ) {
		$output = 'transparent';
	} elseif ( 'default' === $color ) {
		return;
	} else {
		$rgb_background_color = sscanf( fabrique_c( $color ), "#%02x%02x%02x" );

		if ( is_array( $rgb_background_color ) ) {
			$output = 'rgba('. implode( ',', $rgb_background_color ) .','. $opacity .')';
		} else {
			$output = 'transparent';
		}
	}

	return $output;
}


/**
 * Output background image style
 */
function fabrique_get_background_image( $args = array() )
{
	$output = '';
	$defaults = array(
		'id' => '',
		'url' => '',
		'size' => 'cover',
		'position' => 'center center',
		'repeat' => 'repeat',
		'fixed' => false
	);

	$args = array_merge( $defaults, $args );

	if ( !empty( $args['id'] ) || !empty( $args['url'] ) ) {
		if ( !empty( $args['id'] ) ) {
			$fullsize_attachment = wp_get_attachment_image_src( $args['id'], 'full' );
			$image_url = $fullsize_attachment[0];
		} elseif ( !is_numeric( $args['url'] ) ) {
			$image_url = $args['url'];
		} else {
			$fullsize_attachment = wp_get_attachment_image_src( $args['url'], 'full' );
			$image_url = $fullsize_attachment[0];
		}

		if ( $image_url ) {
			$output .= 'background-image:url('. esc_url( $image_url ) .'); ';
			$output .= 'background-size:'. esc_attr( $args['size'] ) .'; ';
			$output .= 'background-position:'. esc_attr( $args['position'] ) .'; ';
			$output .= 'background-repeat:'. esc_attr( $args['repeat'] ) .';';

			if ( $args['fixed'] ) {
				$output .= 'background-attachment:fixed;';
			}
		}
	}

	return $output;
}


/**
 * Convert dates to readable format
 */
function fabrique_relative_time( $timestamp )
{
		//get current timestamp
		$b = strtotime( "now" );
		//get timestamp when tweet created
		$c = strtotime( $timestamp );
		//get difference
		$d = $b - $c;
		//calculate different time values
		$minute = 60;
		$hour = $minute * 60;
		$day = $hour * 24;
		$week = $day * 7;

		if( is_numeric( $d ) && $d > 0 ) {
			//if less then 3 seconds
			if ( $d < 3 ) return  ' ' . esc_html__( "right now", 'fabrique' );
			//if less then minute
			if ( $d < $minute ) return ' ' . floor( $d ) . ' ' . esc_html__( "seconds ago", 'fabrique' );
			//if less then 2 minutes
			if ( $d < $minute * 2 ) return  ' ' . esc_html__( "about 1 minute ago", 'fabrique' );
			//if less then hour
			if ( $d < $hour ) return ' ' .  floor( $d / $minute ) . ' ' . esc_html__( "minutes ago", 'fabrique' );
			//if less then 2 hours
			if ( $d < $hour * 2 ) return ' ' . esc_html__( "about 1 hour ago", 'fabrique' );
			//if less then day
			if ( $d < $day ) return ' ' . floor($d / $hour) . ' ' . esc_html__( "hours ago", 'fabrique' );
			//if more then day, but less then 2 days
			if ( $d > $day && $d < $day * 2 ) return ' ' . esc_html__( "yesterday", 'fabrique' );
			//if less then year
			if ( $d < $day * 365 ) return ' ' . floor( $d / $day ) . ' ' . esc_html__( "days ago", 'fabrique');
			//else return more than a year
			return ' ' . esc_html__( "over a year ago", 'fabrique' );
		}
}


/**
 * Return new ratio, espacially use in masonry grid size
 */
function fabrique_adjust_ratio( $width = 1, $height = 1, $ratio = '1x1' )
{
	$image_size = explode( 'x', $ratio );
	$new_width = $width * $image_size[0];
	$new_height = $height * $image_size[1];

	return $new_width . 'x' . $new_height;
}


/**
 * Crop image from ratio and attachment
 */
function fabrique_crop_image( $attachment_id = 0, $fullsize_attachment, $ratio = 'auto', $size = 'large' )
{
	if ( empty( $attachment_id ) ) {
		return;
	} elseif ( 'auto' === $ratio ) {
		return wp_get_attachment_image_src( $attachment_id, $size );
	} else {
		$attachment = ( 'full' !== $size ) ? wp_get_attachment_image_src( $attachment_id, $size ) : $fullsize_attachment;

		// check if the image is not exist, if not then return placeholder
		if ( !$attachment ) {
			$output = fabrique_placeholder();
		} else {
			if ( 0 == $attachment[1] || 0 == (int)$attachment[2] ) {
				$output = $attachment;
			} else {
				$fullsize_ratio = (int)$attachment[1] / (int)$attachment[2];
				$image_size = explode( 'x', $ratio );
				$crop_ratio = (int)$image_size[0] / (int)$image_size[1];

				//if image ratio is not match the original size, then crop
				if ( $fullsize_ratio != $crop_ratio ) {
					$original_path = get_attached_file( $attachment_id );
					$orig_info = pathinfo( $original_path );
					$dir = $orig_info['dirname'];
					$ext = $orig_info['extension'];
					$chopped_image_url = str_replace( '.' . $ext, '', $fullsize_attachment[0] );

					// Check if landscape or portrait for the ratio
					$width = $attachment[1];
					$height = round( $width / $crop_ratio );

					if ( $height > $attachment[2] ) {
						$height = $attachment[2];
						$width = round( $attachment[2] * $crop_ratio );
					}

					$suffix = $width . 'x' . $height;

					if ( function_exists( 'wp_basename' ) ) {
						$name = wp_basename( $original_path, '.' . $ext );
					} else {
						$name = basename( $original_path, '.' . $ext );
					}

					$destfilename = $dir . '/' . $name . '-' . $suffix . '.' . $ext;

					// If image's already cropped then return the existing url.
					if ( !file_exists( $destfilename ) ) {
						$cropped_image = wp_get_image_editor( $original_path );

						if ( !is_wp_error( $cropped_image ) ) {
							$cropped_image->resize( $width, $height, true );
							$cropped_image->save( $destfilename );
							$output = array( $chopped_image_url . '-' . $suffix . '.' . $ext, $width, $height );
							do_action( 'fabrique_after_crop_image', $output );
						} else {
							$output = $attachment;
						}
					} else {
						$output = array( $chopped_image_url . '-' . $suffix . '.' . $ext, $width, $height );
					}

				} else {
					$output = $attachment;
				}
			}
		}

		return $output;
	}
}


function fabrique_sanitize_boolean_value_walker( &$value )
{
	if ( 'true' === $value ) {
		$value = true;
	} else if ( 'false' === $value ) {
		$value = false;
	}
}


/**
 * Get array of terms
 */
if ( !function_exists( 'fabrique_term_names' ) ) {
	function fabrique_term_names( $terms, $class = '' )
	{
		$name = array();
		$slug = array();
		$link = array();
		$target = apply_filters( 'fabrique_term_names_target', '_self' );

		if ( $terms && !empty( $terms ) ) {
			foreach ( $terms as $term ) {

				if ( isset( $term->name ) ) {
					$name[] = esc_html( $term->name );
					$slug[] = esc_html( $term->slug );

					if ( isset( $term->term_id ) ) {
						$class_attr = !empty( $class ) ? 'class="' . esc_attr( $class ) . '"' : '';
						$link[] = '<a ' . fabrique_escape_content( $class_attr ) . ' href="' . esc_url( get_term_link( $term->term_id ) ) . '" target="' . esc_attr( $target ) . '">' . esc_html( $term->name ) . '</a>';
					} else {
						$link[] = esc_html( $term->name );
					}
				}
			}
		}

		return array(
			'name' => array_unique( $name ),
			'slug' => array_unique( $slug ),
			'link' => array_unique( $link )
		);
	}
}


if ( !function_exists( 'fabrique_get_post_taxonomy_name' ) ) {
	function fabrique_get_post_taxonomy_name( $post_type = null, $tag = false )
	{
		$post_type = !empty( $post_type ) ? $post_type : get_post_type();

		switch ( $post_type ) {
			case 'post':
				return !$tag ? 'category' : 'post_tag';
			case 'product':
				return !$tag ? 'product_cat' : 'product_tag';
			case 'page':
				return !$tag ? 'fbq_page_category' : 'fbq_page_tag';
			case 'fbq_project':
				return !$tag ? 'fbq_project_category' : 'fbq_project_tag';
			default:
				return 'object';
		}
	}
}


if ( !function_exists( 'fabrique_get_taxonomy' ) ) {
	function fabrique_get_taxonomy( $taxonomy_name = null, $tag = false, $id = null )
	{
		$post_type = get_post_type( $id );

		if ( empty( $taxonomy_name ) ) {
			$taxonomy_name = fabrique_get_post_taxonomy_name( $post_type, $tag );
		}

		if ( 'object' !== $taxonomy_name ) {
			$id = !empty( $id ) ? $id : get_the_ID();
			return get_the_terms( $id, $taxonomy_name );
		} else {
			$taxonomies = get_object_taxonomies( $post_type, 'objects' );
			if ( $taxonomies && !is_wp_error( $taxonomies ) ) {
				return $taxonomies;
			}
		}
	}
}


function fabrique_get_post_types_by_taxonomy( $tax = 'category' )
{
		global $wp_taxonomies;
		return ( isset( $wp_taxonomies[$tax] ) ) ? $wp_taxonomies[$tax]->object_type : array();
}


/**
 * Get Masonry width and height
 */
if ( !function_exists( 'fabrique_get_masonry_size' ) ) {
	function fabrique_get_masonry_size( $image_id = null, $columns = 4 )
	{
		if ( !empty( $image_id ) ) {
			$image_w = get_post_meta( $image_id, '_masonry_width', true );
			$image_w = ( !empty( $image_w ) ) ? (int)$image_w : 1;
			$image_w = ( $image_w > $columns ) ? $columns : $image_w;

			$image_h = get_post_meta( $image_id, '_masonry_height', true );
			$image_h = ( !empty( $image_h ) ) ? (int)$image_h : 1;

			return array(
				'width' => $image_w,
				'height' => $image_h
			);
		} else {
			return;
		}
	}
}


/**
 * Get Excerpt
 */
if ( !function_exists( 'fabrique_limit_excerpt' ) ) {
	function fabrique_limit_excerpt( $excerpt, $length )
	{
		if ( !empty( $excerpt ) ) {
			return ( !empty( $length ) && is_numeric( $length ) ) ? substr( $excerpt, 0, (int)$length ) . '...' : $excerpt;
		} else {
			return '';
		}
	}
}

/**
 * Set global post
 */
function fabrique_set_global_post( $p )
{
	global $custom_page;
	$custom_page = $p;

	setup_postdata( $custom_page );
}

function fabrique_get_page_id()
{
	global $custom_page;
	if ( empty( $custom_page ) || 0 == $custom_page->ID ) {
		$page_id = ( is_single() || is_page() ) ? get_queried_object_id() : false;
	} else {
		$page_id = $custom_page->ID;
	}

	return $page_id;
}

function fabrique_get_spacing_style( $item, $property = 'padding', $style = array() )
{
	$spacing_args = array(
		$property . '_top' => $property . '-top',
		$property . '_right' => $property . '-right',
		$property . '_left' => $property . '-left',
		$property . '_bottom' => $property . '-bottom'
	);

	foreach ( $spacing_args as $key => $property ) {
		if ( isset( $item[$key] ) ) {
			$style[$property] = is_numeric( $item[$key] ) ? $item[$key] . 'px' : $item[$key];
		}
	}

	return $style;
}


if ( !function_exists( 'fabrique_get_dummy_template' ) ) {
	function fabrique_get_dummy_template( $title = null, $subtitle = null )
	{
		$output = '';
		if ( !empty( $title ) || !empty( $subtitle ) ) {
			$output .=	'<div class="fbq-dummy fbq-p-bg-bg">';

			if ( !empty( $title ) ) {
				$output .=		'<div class="fbq-dummy-title">' . esc_html( $title ) . '</div>';
			}

			if ( !empty( $subtitle ) ) {
				$output .=		'<div class="fbq-dummy-subtitle">' . esc_html( $subtitle ) . '</div>';
			}

			$output .=	'</div>';
		}

		return $output;
	}
}


function fabrique_get_average_ratings( $post_id = null )
{
	if ( empty( $post_id ) )
		return false;

	$count = 1;
	if ( $comment_array = get_approved_comments( $post_id ) ) {
		$i = 0;
		$total = 0;
		foreach ( $comment_array as $comment ) {
			$rating = get_comment_meta( $comment->comment_ID, 'rating', true );
			if ( isset( $rating ) && !empty( $rating ) ) {
				$i++;
				$total += $rating;
			}
		}

		if ( 0 == $i ) {
			return false;
		} else {
			return $total/$i;
		}
	} else {
		return false;
	}
}


if ( !function_exists( 'fabrique_get_share_count' ) ) :
function fabrique_get_share_count( $social_list = array(), $url )
{
	$count = 0;

	foreach ( $social_list as $social ) {
		switch ( $social ) {
			case 'facebook':
				$response = wp_remote_get( 'http://graph.facebook.com/?id=' . $url );
				$response_body = wp_remote_retrieve_body( $response );
				$data = json_decode( $response_body );

				if ( !empty( $data->share->share_count ) ) {
					$count += $data->share->share_count;
				} else if ( !empty( $data->shares ) ) {
					$count += $data->shares;
				}

				break;
			case 'twitter':
				$response = wp_remote_get( 'http://opensharecount.com/count.json?url=' . $url );
				$response_body = wp_remote_retrieve_body( $response );
				$data = json_decode( $response_body );

				if ( !empty( $data->count ) ) {
					$count += $data->count;
				}

				break;
			case 'linkedin':
				$response = wp_remote_get( 'https://www.linkedin.com/countserv/count/share?url=' . $url . '&format=json' );
				$response_body = wp_remote_retrieve_body( $response );
				$data = json_decode( $response_body );

				if ( !empty($data->count) ) {
					$count += $data->count;
				}

				break;
			case 'google-plus':
				$query = '[{"method": "pos.plusones.get","id": "p","params": {"nolog": true, "id": "' . $url . '", "source": "widget", "userId": "@viewer", "groupId": "@self"},"jsonrpc": "2.0","key": "p","apiVersion": "v1"}]';
				$response = wp_remote_post( 'https://clients6.google.com/rpc', array( 'headers' => array( 'Content-type' => 'application/json' ), 'body' => $query ) );
				$response_body = wp_remote_retrieve_body( $response );
				$data = json_decode( $response_body, true);

				if ( !empty( $data[0]['result']['metadata']['globalCounts']['count'] ) ) {
					$count += $data[0]['result']['metadata']['globalCounts']['count'];
				}

				break;
			case 'pinterest':
				$response = wp_remote_get( 'http://api.pinterest.com/v1/urls/count.json?callback%20&url=' . $url );
				$response_body = wp_remote_retrieve_body( $response );
				$response_body = preg_replace( '/^receiveCount\((.*)\)$/', '\\1', $response_body );
				$data = json_decode( $response_body );

				if ( !empty($data->count) ) {
					$count += $data->count;
				}

				break;
			case 'stumbleupon':
				$response = wp_remote_get( 'https://www.stumbleupon.com/services/1.01/badge.getinfo?url=' . $url );
				$response_body = wp_remote_retrieve_body( $response );
				$data = json_decode( $response_body );

				if ( !empty( $data->count ) ) {
					$count += $data->count;
				}

				break;
			default:
				break;
		}
	}

	return $count;
}
endif;


if ( !function_exists( 'fabrique_escape_url' ) ) :
function fabrique_escape_url( $url = '' )
{
	if ( '#' === substr( $url, 0, 1 ) || 'sms:' === substr( $url, 0, 4 ) ) {
		return $url;
	} else {
		return esc_url( $url );
	}
}
endif;
