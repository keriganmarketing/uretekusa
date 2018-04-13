<?php

function fabrique_api_response( $api_action, $result = null )
{
	if ( $result && isset( $result['error'] ) ) {
		if ( $api_action ) {
			$result['api_action'] = $api_action;
		}

		wp_send_json_error( $result );
		return false;
	}

	wp_send_json_success( array( 'api_action' => $api_action, 'result' => $result ) );
	return false;
}


add_action( 'wp_ajax_fabrique_gallery_entries', 'fabrique_load_gallery_entries' );
add_action( 'wp_ajax_nopriv_fabrique_gallery_entries', 'fabrique_load_gallery_entries' );
if ( !function_exists( 'fabrique_load_gallery_entries' ) ) :
function fabrique_load_gallery_entries()
{
	$images = array_slice(
		$_POST['query_args']['posts'],
		$_POST['pagination_index'] * $_POST['query_args']['posts_per_page'],
		$_POST['query_args']['posts_per_page']
	);

	if ( $images && is_array( $images ) ) {
		ob_start();

		foreach ( $images as $index => $image ) {
			$_POST['image'] = $image;
			$_POST['image_index'] = $_POST['pagination_index'] * $_POST['query_args']['posts_per_page'] + $index;

			if ( !is_array( $image ) ) {
				fabrique_template( 'entry-gallery.php', $_POST );
			} else {
				if ( isset( $_POST['query_post_args'] ) ) {
					$query_post_args = $_POST['query_post_args'];
					if ( !empty( $_POST['link_taxonomy'] ) && !empty( $image['tags'] ) ) {
						$query_post_args['tax_query'] = array(
							'relation' => 'OR',
							array(
								'taxonomy' => $_POST['link_taxonomy'],
								'field' => 'slug',
								'terms' => array_values( $image['tags'] )
							)
						);
					}
					$post_query = new WP_Query( $query_post_args );
					if ( !$post_query->have_posts() ) {
						$post_query = new WP_Query( $_POST['query_post_args'] );
					} // fall back when can't find post from tags

					if ( $post_query->have_posts() ) {
						$posts = $post_query->posts;
						$_POST['post'] = $posts[0];
						$_POST['query_post_args']['post__not_in'][] = $_POST['post']->ID;
					}

					wp_reset_postdata();
				}
				fabrique_template( 'entry-instagram.php', $_POST );
				unset( $_POST['post'] );
			}
		}

		$output = ob_get_clean();

		return fabrique_api_response( 'paginate', array( 'content' => $output ) );
	}
}
endif;


add_action( 'wp_ajax_fabrique_entries', 'fabrique_load_post_entries' );
add_action( 'wp_ajax_nopriv_fabrique_entries', 'fabrique_load_post_entries' );
if ( !function_exists( 'fabrique_load_post_entries' ) ) :
function fabrique_load_post_entries()
{
	$_POST['query_args']['post_status'] = 'publish';
	$_POST['query_args']['suppress_filters'] = false;
	$_POST['query_args']['nopaging'] = false;
	$_POST['query_args']['paged'] = ( isset( $_POST['pagination_index'] ) && !empty( $_POST['pagination_index'] ) ) ? $_POST['pagination_index'] + 1 : 2;
	$query = new WP_Query( $_POST['query_args'] );

	if ( $query->have_posts() ) {
		ob_start();

		while ( $query->have_posts() ) {
			$query->the_post();
			$_POST['index'] = $_POST['pagination_index'] * $_POST['query_args']['posts_per_page'] + $query->current_post;
			fabrique_template( 'entry.php', $_POST );
		}
		wp_reset_postdata();

		$output = ob_get_clean();

		return fabrique_api_response( 'paginate', array( 'content' => $output ) );
	}
}
endif;


if ( !function_exists( 'fabrique_item_options' ) ) :
function fabrique_item_options( $defaults = array(), $item = array(), $exception = array() )
{
	$item = array_merge( $defaults, $item );
	$type = str_replace( 'fbq-', '', $item['type'] );
	$style = isset( $item['css_style'] ) ? $item['css_style'] : array();
	$id = isset( $item['css_id'] ) ? array( $item['css_id'] ) : array();
	$data_attr = array();
	$class = array( 'fbq-item' );

	$class[] = 'js-item-' . $type;
	$class[] = 'fbq-'. $type;

	if ( array_key_exists( 'style', $item ) ) {
		$class[] = 'fbq-' . $type . '--'. $item['style'];
		$data_attr['style'] = $item['style'];
	}

	if ( array_key_exists( 'layout', $item ) ) {
		$data_attr['layout'] = $item['layout'];
	}

	if ( isset( $item['css_class'] ) ) {
		$class[] = $item['css_class'];
	}

	if ( isset( $item['alignment'] ) && !in_array( 'alignment', $exception ) ) {
		$class[] = 'fbq-' . $item['alignment'] . '-align';
	}

	$extra_classes = array(
		'pc_hidden' => 'fbq-pc-hidden',
		'tablet_landscape_hidden' => 'fbq-tablet-landscape-hidden',
		'tablet_hidden' => 'fbq-tablet-hidden',
		'force_no_padding_tablet' => 'fbq-force-no-padding-tablet',
		'mobile_hidden' => 'fbq-mobile-hidden',
		'force_mobile_center' => 'fbq-force-center-mobile',
		'force_no_padding_mobile' => 'fbq-force-no-padding-mobile'
	);

	foreach ( $extra_classes as $option => $extra_class ) {
		if ( isset( $item[$option] ) && $item[$option] ) {
			$class[] = $extra_class;
		}
	}

	if ( isset( $item['animation'] ) && 'none' !== $item['animation'] && !in_array( 'animation', $exception ) ) {
		$class[] = 'anmt-item anmt-' . $item['animation'];

		if ( isset( $item['stagger'] ) && $item['stagger'] ) {
			$class[] = 'stagger';
		}
	}

	if ( !in_array( 'padding', $exception ) ) {
		$padding = fabrique_get_spacing_style( $item, 'padding' );
		$style = array_merge( $style, $padding );
	}

	if ( !in_array( 'margin', $exception ) ) {
		$margin = fabrique_get_spacing_style( $item, 'margin' );
		$style = array_merge( $style, $margin );
	}

	$item['class'] = $class;
	$item['id'] = $id;
	$item['style_attr'] = $style;
	$item['data_attr'] = $data_attr;

	return $item;
}
endif;


if ( !function_exists( 'fabrique_item_post_query' ) ) :
function fabrique_item_post_query( $item, $post_type = '', $taxonomy = '' )
{
	$order = isset( $item['order'] ) ? $item['order'] : 'desc';
	$orderby = isset( $item['order_by'] ) ? $item['order_by'] : 'post_date';
	$filter = isset( $item['filters'] ) ? $item['filters'] : array( 'all' );
	$offset = isset( $item['query_offset'] ) ? $item['query_offset'] : 0;
	$posts_per_page = ( ( int )$item['no_of_items'] ) ? ( int )$item['no_of_items'] : 10;

	if ( 'rand' === $orderby ) {
		$orderby = 'RAND(' . rand( 1, 1000 ) . ')';
	}

	if ( get_query_var( 'paged' ) ) {
		$paged = get_query_var( 'paged' );
	} else if ( get_query_var( 'page' ) ) {
		$paged = get_query_var( 'page' );
	} else {
		$paged = 1;
	}

	$query_args = array(
		'post_status' => 'publish',
		'suppress_filters' => false,
		'ignore_sticky_posts' => 1,
		'orderby' => $orderby,
		'order' => $order,
		'offset' => $offset,
		'paged' => $paged,
		'posts_per_page' => $posts_per_page
	);

	if ( !empty( $post_type ) ) {
		$query_args['post_type'] = $post_type;
	}

	if ( isset( $item['tax_query'] ) ) {
		$query_args['tax_query'] = $item['tax_query'];

		if ( !empty( $taxonomy ) && !empty( $filter ) && !in_array( 'all', $filter ) ) {
			$query_args['tax_query']['relation'] = 'AND';
			$query_args['tax_query'][] = array(
				'taxonomy' => $taxonomy,
				'field' => 'slug',
				'terms' => array_values( $filter )
			);
		}
	} elseif ( !empty( $taxonomy ) && !empty( $filter ) && !in_array( 'all', $filter ) ) {
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => $taxonomy,
				'field' => 'slug',
				'terms' => array_values( $filter )
			)
		);
	}

	if ( isset( $item['meta_query'] ) && !empty( $item['meta_query'] ) ) {
		$query_args['meta_query'] = $item['meta_query'];
	}

	if ( isset( $item['meta_key'] ) && !empty( $item['meta_key'] ) ) {
		$query_args['meta_key'] = $item['meta_key'];
	}

	return $query_args;
}
endif;


if ( !function_exists( 'fabrique_item_default_options' ) ) :
function fabrique_item_default_options( $opts )
{
	$opts = fabrique_item_options( array(), $opts );
	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_entries_options' ) ) :
function fabrique_item_entries_options( $opts )
{
	$defaults = array(
		'post_type' => '',
		'post_taxonomy' => '',
		'post_tag' => '',
		'index' => 0,
		'style' => 'plain',
		'layout' => 'grid',
		'components' => array( 'media', 'author', 'category', 'tag', 'title', 'excerpt', 'comment', 'date', 'link' ),
		'name' => '',
		'no_of_items' => 10,
		'list_thumbnail_size' => '',
		'order_by' => 'post_date',
		'order' => 'desc',
		'query_offset' => '',
		'featured_media' => 'image',
		'image_size' => 'medium_large',
		'image_ratio' => 'auto',
		'image_lazy_load' => false,
		'image_hover' => 'none',
		'no_of_columns' => 2,
		'spacing' => 30,
		'inner_spacing' => 0,
		'entry_color_scheme' => 'default',
		'background_color' => 'default',
		'background_opacity' => 100,
		'border' => false,
		'alignment' => 'left',
		'title_uppercase' => false,
		'title_letter_spacing' => '',
		'title_line_height' => '',
		'title_size' => 16,
		'title_font' => 'secondary',
		'meta_font' => 'primary',
		'filter' => true,
		'filter_alignment' => 'left',
		'filter_sorting' => 'default',
		'filter_disable_all' => false,
		'filter_initial' => '',
		'excerpt_content' => 'excerpt',
		'excerpt_length' => '',
		'more_icon_position' => 'before',
		'more_message' => 'Read More',
		'pagination' => true,
		'pagination_style' => 'pagination',
		'entry_link' => 'post',
		'link_new_tab' => false,
		'no_of_scrolls' => 1,
		'navigation' => true,
		'indicator' => true,
		'loop' => true,
		'fade' => false,
		'adaptive_height' => false,
		'autoplay' => false,
		'autoplay_speed' => 5000,
		'center_mode' => false,
		'center_padding' => '',
		'variable_width' => false,
		'carousel_height' => ''
	);

	$opts = fabrique_item_options( $defaults, $opts, array( 'animation' ) );

	$opts['media_on'] = isset( $opts['media_on'] ) ? $opts['media_on'] : in_array( 'media', $opts['components'] );
	$opts['author_on'] = isset( $opts['author_on'] ) ? $opts['author_on'] : in_array( 'author', $opts['components'] );
	$opts['category_on'] = isset( $opts['category_on'] ) ? $opts['category_on'] : in_array( 'category', $opts['components'] );
	$opts['tag_on'] = isset( $opts['tag_on'] ) ? $opts['tag_on'] : in_array( 'tag', $opts['components'] );
	$opts['title_on'] = isset( $opts['title_on'] ) ? $opts['title_on'] : in_array( 'title', $opts['components'] );
	$opts['posttype_on'] = isset( $opts['posttype_on'] ) ? $opts['posttype_on'] : in_array( 'posttype', $opts['components'] );
	$opts['excerpt_on'] = isset( $opts['excerpt_on'] ) ? $opts['excerpt_on'] : in_array( 'excerpt', $opts['components'] );
	$opts['comment_on'] = isset( $opts['comment_on'] ) ? $opts['comment_on'] : in_array( 'comment', $opts['components'] );
	$opts['date_on'] = isset( $opts['date_on'] ) ? $opts['date_on'] : in_array( 'date', $opts['components'] );
	$opts['link_on'] = isset( $opts['link_on'] ) ? $opts['link_on'] : in_array( 'link', $opts['components'] );
	$opts['rating_on'] = isset( $opts['rating_on'] ) ? $opts['rating_on'] : in_array( 'rating', $opts['components'] );
	$opts['price_on'] = isset( $opts['price_on'] ) ? $opts['price_on'] : in_array( 'price', $opts['components'] );
	$opts['addtocart_on'] = isset( $opts['addtocart_on'] ) ? $opts['addtocart_on'] : in_array( 'addtocart', $opts['components'] );
	$opts['class'][] = 'fbq-entries fbq-entries--' . $opts['layout'] . ' fbq-entries--' . $opts['style'];
	$content_class = 'fbq-entries-content';
	$content_style = array();
	$content_data = array();
	$opts['media_style'] = array(); // style for img tag of thumbnail

	if ( !empty( $opts['list_thumbnail_size'] ) ) {
		$opts['class'][] = $opts['list_thumbnail_size'];
	}

	if ( !empty( $opts['name'] ) ) {
		$opts['id'][] = 'entries-' . $opts['name'];
	}

	$opts['filter_args'] = array(
		'filter_taxonomy' => $opts['post_taxonomy'],
		'filter_sorting' => $opts['filter_sorting'],
		'filter_alignment' => $opts['filter_alignment'],
		'filter_initial' => $opts['filter_initial'],
		'filter_disable_all' => $opts['filter_disable_all']
	);

	if ( $opts['border'] ) {
		$opts['class'][] = 'with-border';
	}

	if ( 'gradient' === $opts['style'] && 'masonry' === $opts['layout'] ) {
		$content_style['margin-right'] = -$opts['spacing'] . 'px';
	} elseif ( 'list' !== $opts['layout'] ) {
		$content_style['margin'] = '0 '. -$opts['spacing']/2 . 'px';

		if ( 'carousel' === $opts['layout'] ) {
			$content_data['display'] = $opts['no_of_columns'];
			$content_data['scroll'] = ( $opts['no_of_scrolls'] > $opts['no_of_columns'] ) ? $opts['no_of_columns'] : $opts['no_of_scrolls'];

			if ( $opts['autoplay'] ) {
				$content_data['duration'] = $opts['autoplay_speed'];
			}

			if ( 'gradient' === $opts['style'] && $opts['variable_width'] ) {
				$opts['class'][] = 'fbq-variable-width';
				$content_data['variable_width'] = 'true';
				$carousel_height = ( is_numeric( $opts['carousel_height'] ) || false !== strpos( $opts['carousel_height'], 'px' ) ) ? ( int )$opts['carousel_height'] : 500;
				$opts['media_style']['max-height'] = $carousel_height .'px';
			}

			if ( $opts['center_mode'] ) {
				$content_data['center_mode'] = 'true';
				$content_data['center_padding'] = is_numeric( $opts['center_padding'] ) ? $opts['center_padding'] . 'px' : $opts['center_padding'];
			}

			if ( $opts['fade'] ) {
				$content_data['display'] = 1;
				$content_data['scroll'] = 1;
				$content_data['fade'] = 'true';
			}

			$content_data['adaptive_height'] = !$opts['adaptive_height'] ? 'false' : 'true';
			$content_data['arrows'] = !$opts['navigation'] ? 'false' : 'true';
			$content_data['indicator'] = !$opts['indicator'] ? 'false' : 'true';
			$content_data['loop'] = !$opts['loop'] ? 'false' : 'true';
		}
	}

	if ( 'default' !== $opts['filter_sorting'] ) {
		$content_data['filter_sorting'] = $opts['filter_sorting'];
	}

	$opts['content_attr'] = array(
		'class' => $content_class,
		'style_attr' => $content_style,
		'data_attr' => $content_data
	);

	if ( !isset( $opts['query_args'] ) ) {
		$opts['query_args'] = fabrique_item_post_query( $opts, $opts['post_type'], $opts['post_taxonomy'] );
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_accordion_options' ) ) :
function fabrique_item_accordion_options( $opts )
{
	$defaults = array(
		'data' => array(),
		'spaces' => array(),
		'style' => 'border',
		'components' => array( 'icon' ),
		'name' => '',
		'multiple' => false,
		'close_by_default' => false,
		'no_of_items' => 3,
		'default_active' => 1,
		'icon_style' => 'plus',
		'alternate_color' => 'default',
		'alignment' => 'left',
		'title_font' => 'primary',
		'background_id' => '',
		'background_url' => '',
		'background_color' => 'default',
		'background_opacity' => 90,
		'background_size' => 'cover',
		'background_position' => 'center center',
		'background_repeat' => 'repeat'
	);

	$opts = fabrique_item_options( $defaults, $opts, array( 'padding' ) );
	$opts['default_active'] = !empty( $opts['default_active'] ) ? (int)( $opts['default_active'] ) : 1;
	$opts['icon_on'] = isset( $opts['icon_on'] ) ? $opts['icon_on'] : in_array( 'icon', $opts['components'] );
	$opts['data_attr']['multiple'] = $opts['multiple'];
	$opts['class'][] = $opts['icon_style'];
	$opts['heading_attr'] = array(
		'class' => array( 'fbq-accordion-heading', 'fbq-p-text-color' ),
		'style_attr' => array()
	);
	$opts['panel_style'] = array();

	if ( 'fill' === $opts['style'] ) {
		$opts['heading_attr']['style_attr']['background-color'] = fabrique_c( $opts['alternate_color'] );
	} else {
		$opts['panel_style']['border-color'] = fabrique_c( $opts['alternate_color'] );
	}

	$opts['body_attr'] = array(
		'class' => array( 'fbq-accordion-body' ),
		'style_attr' => fabrique_get_spacing_style( $opts, 'padding' )
	);

	if ( ( 'default' !== $opts['background_color'] && 'transparent' !== $opts['background_color'] ) || !empty( $opts['background_image'] ) ) {
		$opts['body_attr']['class'][] = 'fbq-side-padding';
	}

	if ( !empty( $opts['name'] ) ) {
		$opts['id'][] = 'accordion-' . $opts['name'];
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_action_options' ) ) :
function fabrique_item_action_options( $opts )
{
	$defaults = array(
		'style' => 'inline',
		'components' => array( 'image', 'subtitle' ),
		'title' => 'Call to action',
		'subtitle' => 'Proin Quis Tortor Orci. Etiam At Risus Et Justo Dignissim Congue.',
		'image_width' => 33,
		'border_thickness' => 0,
		'border_color' => 'default',
		'background_color' => 'default',
		'background_opacity' => 100,
		'image_position' => 'left',
		'media_type' => 'image',
		'image_id' => '',
		'image_url' => '',
		'image_circle' => false,
		'image_link' => '',
		'image_size' => 'medium',
		'image_max_width' => '',
		'image_popup' => false,
		'image_caption' => false,
		'icon_style' => 'plain',
		'icon_hover_style' => 'fill',
		'icon_size' => 'large',
		'icon_color' => 'default',
		'icon_hover_color' => 'default',
		'icon' => 'anchor',
		'icon_link' => '',
		'media_target_self' => false,
		'alignment' => 'left',
		'title_font' => 'primary',
		'button_style' => 'fill',
		'button_color' => 'brand',
		'button_hover' => 'brand',
		'button_thickness' => 1,
		'button_radius' => 0,
		'button_size' => 'medium',
		'button_label' => 'Action',
		'button_icon' => 'et-speedometer',
		'button_icon_position' => 'before',
		'button_link' => '/',
		'button_target_self' => false
	);

	$opts = fabrique_item_options( $defaults, $opts );
	$opts['image_on'] = isset( $opts['image_on'] ) ? $opts['image_on'] : in_array( 'image', $opts['components'] );
	$opts['subtitle_on'] = isset( $opts['subtitle_on'] ) ? $opts['subtitle_on'] : in_array( 'subtitle', $opts['components'] );
	$opts['class'][] = 'fbq-s-bg-bg fbq-p-border-border';
	$opts['body_style'] = array();
	$opts['action_media_style'] = array();

	if ( $opts['border_thickness'] > 0 ) {
		$opts['style_attr']['border-width'] = $opts['border_thickness'] . 'px';
		$opts['style_attr']['border-color'] = fabrique_c( $opts['border_color'] );
	}

	$opts['style_attr']['background-color'] = fabrique_hex_to_rgba( $opts['background_color'], $opts['background_opacity'] / 100 );

	if ( 'inline' === $opts['style'] ) {
		$opts['class'][] = 'fbq-action--'. $opts['image_position'];
		$opts['action_media_style']['width'] = $opts['image_width'] . '%';

		if ( $opts['image_on'] ) {
			$opts['body_style']['width'] = 74 - $opts['image_width'] . '%';
		} else {
			$opts['body_style']['width'] = '74%';
		}
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_banner_options' ) ) :
function fabrique_item_banner_options( $opts )
{
	$defaults = array(
		'style' => 'gradient',
		'components' => array( 'media', 'title', 'subtitle', 'button' ),
		'height' => '',
		'transition' => 's2s',
		'image_hover' => 'none',
		'overlay_background' => 'default',
		'overlay_opacity' => 60,
		'banner_link' => '',
		'link_new_tab' => false,
		'vertical_align' => 'middle',
		'alignment' => 'center',
		'title_font' => 'secondary',
		'tutle_uppercase' => true,
		'title_letter_spacing' => '',
		'title_line_height' => '',
		'subtitle_font' => 'primary',
		'subtitle_letter_spacing' => '',
		'subtitle_line_height' => '',
		'title' => 'Banner title',
		'subtitle' => 'This is banner subtitle',
		'media_type' => 'icon',
		'image_id' => '',
		'image_url' => '',
		'image_circle' => false,
		'image_size' => 'medium',
		'image_max_width' => '',
		'icon_style' => 'plain',
		'icon_hover_style' => 'none',
		'icon_size' => 'medium',
		'icon_color' => 'default',
		'icon_hover_color' => 'default',
		'icon' => 'anchor',
		'button_style' => 'fill',
		'button_color' => 'brand',
		'button_hover' => 'brand',
		'button_thickness' => 1,
		'button_radius' => 0,
		'button_size' => 'small',
		'button_label' => 'learn more',
		'button_icon' => '',
		'button_icon_position' => 'before',
		'color_scheme' => 'default',
		'background_color' => 'transparent',
		'background_opacity' => 50,
		'background_size' => 'cover',
		'background_position' => 'center center',
		'background_repeat' => 'repeat'
	);

	$opts = fabrique_item_options( $defaults, $opts, array( 'padding' ) );
	$opts['media_on'] = isset( $opts['media_on'] ) ? $opts['media_on'] : in_array( 'media', $opts['components'] );
	$opts['title_on'] = isset( $opts['title_on'] ) ? $opts['title_on'] : in_array( 'title', $opts['components'] );
	$opts['subtitle_on'] = isset( $opts['subtitle_on'] ) ? $opts['subtitle_on'] : in_array( 'subtitle', $opts['components'] );
	$opts['button_on'] = isset( $opts['button_on'] ) ? $opts['button_on'] : in_array( 'button', $opts['components'] );
	$opts['link_target'] = $opts['link_new_tab'] ? '_blank' : '_self';
	$opts['class'][] = 'fbq-banner--' . $opts['transition'];
	$opts['class'][] = 'fbq-banner--' . $opts['image_hover'];

	$height = is_numeric( $opts['height'] ) ? $opts['height'] .'px' : $opts['height'];
	$opts['content_style'] = array(
		'height' => $height,
		'line-height' => ( 'auto' !== $height ) ? $height : ''
	);

	$opts['content_inner_attr'] = array(
		'class' => 'fbq-banner-content-inner fbq-' . $opts['vertical_align'] . '-vertical',
		'style_attr' => fabrique_get_spacing_style( $opts, 'padding' )
	);

 	if ( 'overlay' === $opts['style'] )  {
		$opts['class'][] = 'fbq-' . $opts['color_scheme'] . '-scheme';
		$opts['content_style']['background-color'] = fabrique_hex_to_rgba( $opts['overlay_background'], $opts['overlay_opacity'] / 100 );
	} else {
		$opts['class'][] = 'fbq-dark-scheme';
	}

	$opts['title_attr'] = array(
		'class' => 'fbq-banner-title fbq-s-text-color fbq-' . $opts['title_font'] . '-font',
		'style_attr' => array(
			'letter-spacing' => is_numeric( $opts['title_letter_spacing'] ) ? $opts['title_letter_spacing'] .'px' : $opts['title_letter_spacing'],
			'line-height' => $opts['title_line_height'],
			'text-transform' => $opts['title_uppercase'] ? 'uppercase' : ''
		)
	);

	$opts['subtitle_attr'] = array(
		'class' => 'fbq-banner-subtitle fbq-p-text-color fbq-' . $opts['subtitle_font'] . '-font',
		'style_attr' => array(
			'letter-spacing' => is_numeric( $opts['subtitle_letter_spacing'] ) ? $opts['subtitle_letter_spacing'] .'px' : $opts['subtitle_letter_spacing'],
			'line-height' => $opts['subtitle_line_height']
		)
	);

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_bannertext_options' ) ) :
function fabrique_item_bannertext_options( $opts )
{
	$defaults = array(
		'style' => 'flip',
		'components' => array( 'fronttext', 'backtext' ),
		'loop' => true,
		'duration' => 3000,
		'cursor' => '|',
		'size' => 36,
		'color' => 'default',
		'background_color' => 'default',
		'bannertext_uppercase' => false,
		'bannertext_line_height' => '',
		'bannertext_letter_spacing' => '',
		'bannertext_font' => 'secondary',
		'text_uppercase' => false,
		'text_line_height' => '',
		'text_letter_spacing' => '',
		'text_font' => 'primary',
		'alignment' => 'center',
		'fronttext' => 'double click to edit',
		'backtext' => 'double click to edit',
		'words' => 'text 1, text 2, text 3'
	);

	$opts = fabrique_item_options( $defaults, $opts );
	$opts['fronttext_on'] = isset( $opts['fronttext_on'] ) ? $opts['fronttext_on'] : in_array( 'fronttext', $opts['components'] );
	$opts['backtext_on'] = isset( $opts['backtext_on'] ) ? $opts['backtext_on'] : in_array( 'backtext', $opts['components'] );
	$opts['data_attr']['loop'] = $opts['loop'];

	if ( 'type' === $opts['style'] ) {
		$opts['data_attr']['cursor'] = $opts['cursor'];
	}

	$opts['data_attr']['duration'] = $opts['duration'];
	$opts['data_attr']['words'] = $opts['words'];

	$opts['dynamic_attr'] = array(
		'class' => 'fbq-bannertext-dynamic fbq-p-brand-color fbq-' . $opts['bannertext_font'] . '-font',
		'style_attr' => array(
			'font-size' => $opts['size'] . 'px',
			'color' => fabrique_c( $opts['color'] ),
			'background-color' => fabrique_c( $opts['background_color'] ),
			'letter-spacing' => is_numeric( $opts['bannertext_letter_spacing'] ) ? $opts['bannertext_letter_spacing'] .'px' : $opts['bannertext_letter_spacing'],
			'line-height' => $opts['bannertext_line_height'],
			'text-transform' => $opts['bannertext_uppercase'] ? 'uppercase' : ''
		)
	);

	$opts['static_attr'] = array(
		'class' => 'fbq-bannertext-static fbq-' . $opts['text_font'] . '-font fbq-s-text-color',
		'style_attr' => array(
			'letter-spacing' => is_numeric( $opts['text_letter_spacing'] ) ? $opts['text_letter_spacing'] .'px' : $opts['text_letter_spacing'],
			'line-height' => $opts['text_line_height'],
			'text-transform' => $opts['text_uppercase'] ? 'uppercase' : ''
		)
	);

	if ( 48 < $opts['size'] ) {
		$opts['dynamic_attr']['class'] .= ' font-style-big';
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_blog_options' ) ) :
function fabrique_item_blog_options( $opts )
{
	if ( !isset( $opts['query'] ) ) {
		$opts['post_type'] = 'post';
		$opts['post_taxonomy'] = 'category';
		$opts['post_tag'] = 'post_tag';
	}

	$opts = fabrique_item_entries_options( $opts );

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_blueprintblock_options' ) ) :
function fabrique_item_blueprintblock_options( $opts )
{
	$defaults = array(
		'blueprintblock_id' => ''
	);

	$opts = fabrique_item_options( $defaults, $opts );
	$opts['blueprintblock_id'] = apply_filters( 'wpml_object_id', $opts['blueprintblock_id'], 'twcbp_block', TRUE );
	$bp_data = get_post_meta( $opts['blueprintblock_id'], 'bp_data', true );
	$opts['bp_data'] = $bp_data;
	$opts['is_publish'] = ( !empty( $bp_data ) && 'publish' === get_post_status( $opts['blueprintblock_id'] ) ) ? true : false;

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_box_options' ) ) :
function fabrique_item_box_options( $opts )
{
	$defaults = array(
		'spaces' => array(),
		'fit_screen_height' => false,
		'fit_height_percent' => 100,
		'fit_height_offset' => '',
		'height' => '',
		'max_width' => '',
		'overflow' => 'hidden',
		'box_shadow' => '',
		'top_border' => 0,
		'bottom_border' => 0,
		'left_border' => 0,
		'right_border' => 0,
		'border_color' => 'default',
		'vertical_align' => 'middle',
		'alignment' => 'center',
		'pinned_id' => '',
		'pinned_offset' => '',
		'fit_height_id' => '',
		'parallax_content' => false,
		'parallax_content_offset' => 200,
		'no_of_items' => 1,
		'color_scheme' => 'default',
		'background_type' => 'image',
		'background_color' => 'default',
		'background_opacity' => 90,
		'background_id' => '',
		'background_url' => '',
		'background_size' => 'cover',
		'background_position' => 'center center',
		'background_repeat' => 'repeat',
		'background_animation' => 'none',
		'background_extend' => 'none',
		'background_fixed' => false,
		'parallax_speed' => 0
	);

	$opts = fabrique_item_options( $defaults, $opts, array( 'padding' ) );
	$opts['body_style'] = fabrique_get_spacing_style( $opts, 'padding' );
	$opts['class'][] = 'fbq-p-border-border';
	$opts['content_style'] = array(
		'max-width' => is_numeric( $opts['max_width'] ) ? $opts['max_width'] .'px' : $opts['max_width']
	);

	$opts['inner_attr'] = array(
		'class' => 'fbq-box-inner',
		'style_attr' => array(),
		'data_attr' => array()
	);

	if ( !empty( $opts['box_shadow'] ) ) {
		$opts['style_attr']['box-shadow'] = $opts['box_shadow'];
	}

	if ( 'default' !== $opts['color_scheme'] ) {
		$opts['class'][] = 'fbq-' . $opts['color_scheme'] . '-scheme';
		$opts['data_attr']['scheme'] = $opts['color_scheme'];
	}

	if ( $opts['fit_screen_height'] ) {
		$opts['class'][] = 'fbq-box--fit-height';
		$opts['inner_attr']['data_attr']['screen_percent'] = (int)$opts['fit_height_percent'];
		$opts['inner_attr']['style_attr']['height'] = (int)$opts['fit_height_percent'] . 'vh';
		$opts['inner_attr']['style_attr']['line-height'] = (int)$opts['fit_height_percent'] . 'vh';
		$opts['inner_attr']['data_attr']['screen_offset'] = $opts['fit_height_offset'];
	} else {
		$height = is_numeric( $opts['height'] ) ? $opts['height'] .'px' : $opts['height'];
		$opts['inner_attr']['style_attr']['height'] = $height;
		$opts['inner_attr']['style_attr']['line-height'] = ( 'auto' !== $height ) ? $height : '';
		$opts['inner_attr']['data_attr']['height'] = $height;

		if ( !empty( $opts['fit_height_id'] ) ) {
			$opts['class'][] = 'js-box-fitted';
			$opts['data_attr']['group'] = $opts['fit_height_id'];
		}
	}

	if ( !empty( $opts['pinned_id'] ) ) {
		$opts['class'][] = 'fbq-box--pinned';
		$opts['data_attr']['pinned'] = '#' . $opts['pinned_id'];
		$opts['data_attr']['pinned_offset'] = $opts['pinned_offset'];
	}

	if ( $opts['parallax_content'] ) {
		$opts['class'][] = 'fbq-box--parallax-content';

		if ( !empty( $opts['parallax_content_offset'] ) ) {
			$opts['data_attr']['parallaxoffset'] = (int)$opts['parallax_content_offset'];
		}
	}

	if ( 'visible' === $opts['overflow'] ) {
		$opts['content_style']['overflow'] = $opts['overflow'];
	} else {
		$opts['content_style']['overflow-y'] = $opts['overflow'];
	}

	$opts['style_attr']['border-color'] = fabrique_c( $opts['border_color'] );

	$border_args = array( 'top', 'right', 'bottom', 'left' );
	foreach ( $border_args as $direction ) {
		if ( 0 < $opts[$direction . '_border'] ) {
			$opts['style_attr']['border-' . $direction . '-width'] = $opts[$direction . '_border'] . 'px';
		}
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_button_options' ) ) :
function fabrique_item_button_options( $opts )
{
	$defaults = array(
		'style' => 'fill',
		'button_hover' => 'brand',
		'button_color' => 'brand',
		'button_size' => 'medium',
		'button_thickness' => 1,
		'button_radius' => 0,
		'button_icon' => 'minimal-plus',
		'button_icon_position' => 'after',
		'button_label' => 'View',
		'button_link' => '/',
		'button_target_self' => false,
		'button_full_width' => false,
		'button_inline' => false,
		'alignment' => 'center',
	);

	$opts = fabrique_item_options( $defaults, $opts );
	$opts['button_style'] = $opts['style'];
	$opts['button_extra_class'] = $opts['class'];
	$opts['button_style_attr'] = $opts['style_attr'];
	if ( isset( $opts['css_id'] ) && !empty( $opts['css_id'] ) ) {
		$opts['button_id'] = $opts['css_id'];
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_client_options' ) ) :
function fabrique_item_client_options( $opts )
{
	$defaults = array(
		'data' => array(),
		'style' => 'grid',
		'no_of_items' => 4,
		'no_of_columns' => 4,
		'no_of_scrolls' => 4,
		'separator' => false,
		'image_hover' => 'none',
		'spacing' => 30,
		'navigation' => true,
		'indicator' => false,
		'loop' => true,
		'fade' => false,
		'adaptive_height' => false,
		'autoplay' => false,
		'autoplay_speed' => 5000,
		'center_mode' => false,
		'center_padding' => ''
	);

	$opts = fabrique_item_options( $defaults, $opts, array( 'animation' ) );
	$opts['formatted'] = fabrique_get_row_items( $opts['data'], $opts['no_of_columns'] );
	$content_style = array();
	$content_data = array();

	if ( $opts['separator'] ) {
		$opts['class'][] = 'with-separator';
	}

	$opts['column_width'] = ( 5 == $opts['no_of_columns'] ) ? '1-5' : 12 / $opts['no_of_columns'];
	$column_class = 'fbq-col-' . $opts['column_width'];

	if ( 'carousel' === $opts['style'] ) {
		if ( $opts['separator'] ) {
			$content_style['margin'] = '0 '. -( ( $opts['spacing'] / 2 ) - 1 ) .'px 0 '. -$opts['spacing'] / 2 .'px';
		} else {
			$content_style['margin'] = '0 '. -$opts['spacing'] / 2 .'px';
		}

		$content_data['display'] = $opts['no_of_columns'];
		$content_data['scroll'] = ( $opts['no_of_scrolls'] > $opts['no_of_columns'] ) ? $opts['no_of_columns'] : $opts['no_of_scrolls'];
		$content_data['loop'] = ( !$opts['loop'] ) ? 'false' : 'true';
		if ( $opts['adaptive_height'] ) $content_data['adaptive_height'] = 'true';
		if ( !$opts['navigation'] ) $content_data['arrows'] = 'false';
		if ( $opts['indicator'] ) $content_data['indicator'] = 'true';

		if ( $opts['autoplay'] ) {
			$content_data['duration'] = $opts['autoplay_speed'];
		}

		if ( $opts['center_mode'] ) {
			$content_data['center_mode'] = 'true';
			$content_data['center_padding'] = is_numeric( $opts['center_padding'] ) ? $opts['center_padding'] . 'px' : $opts['center_padding'];
		}

		if ( isset( $opts['fade'] ) && $opts['fade'] ) {
			$column_class = 'fbq-col-12';
			$content_data['display'] = 1;
			$content_data['scroll'] = 1;
			$content_data['fade'] = 'true';
		}
	}

	$opts['content_attr'] = array(
		'class' => 'fbq-client-content',
		'style_attr' => $content_style,
		'data_attr' => $content_data
	);

	$opts['item_attr'] = array(
		'class' => array(
			'fbq-client-item',
			'fbq-p-border-border',
			$column_class
		),
		'style_attr' => array(
			'padding' => '0 '. $opts['spacing'] / 2 .'px'
		)
	);

	if ( isset( $opts['animation'] ) && 'none' !== $opts['animation'] ) {
		$opts['item_attr']['class'][] = 'anmt-item anmt-' . $opts['animation'];

		if ( isset( $opts['stagger'] ) && $opts['stagger'] ) {
			$opts['item_attr']['class'][] = 'stagger';
		}
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_comment_options' ) ) :
function fabrique_item_comment_options( $opts )
{
	$opts = fabrique_item_options( array(), $opts );
	$opts['id'][] = 'comments';

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_contactform_options' ) ) :
function fabrique_item_contactform_options( $opts )
{
	$defaults = array(
		'contactform' => '',
	);
	$opts = fabrique_item_options( $defaults, $opts );

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_countdown_options' ) ) :
function fabrique_item_countdown_options( $opts )
{
	$defaults = array(
		'style' => 'digit',
		'components' => array( '' ),
		'month' => 7,
		'day' => 12,
		'year' => 2018,
		'hour' => 18,
		'minute' => 30,
		'timezone' => '+0000',
		'size' => 24,
		'border_radius' => 4,
		'color' => 'default',
		'background_color' => 'default',
		'label_color' => 'default',
		'number_font' => 'primary',
		'label_font' => 'primary',
		'alignment' => 'center'
	);
	$opts = fabrique_item_options( $defaults, $opts );

	$opts['week_on'] = isset( $opts['week_on'] ) ? $opts['week_on'] : in_array( 'week', $opts['components'] );
	$timestamp = strtotime( $opts['day'] . '-' . $opts['month'] . '-' . $opts['year'] . ' ' . $opts['hour'] . ':' . $opts['minute'] . ' ' . $opts['timezone'] );
	$opts['data_attr']['timestamp'] = $timestamp . '000';

	if ( 'transparent' !== $opts['background_color'] ) {
		$opts['class'][] = 'with-background';
	}

	$opts['number_attr'] = array(
		'class' => array(
			'fbq-countdown-number',
			'fbq-s-text-contrast-color',
			'fbq-' . $opts['number_font'] . '-font'
		),
		'style_attr' => array(
			'color' => fabrique_c( $opts['color'] ),
			'font-size' => $opts['size'] . 'px'
		)
	);

	$opts['label_attr'] = array(
		'class' => 'fbq-countdown-label fbq-' . $opts['label_font'] . '-font',
		'style_attr' => array(
			'color' => fabrique_c( $opts['label_color'] )
		)
	);

	if ( 'digit' === $opts['style'] ) {
		$opts['data_attr']['background-color'] = fabrique_c( $opts['background_color'] );

		if ( 0 <  $opts['border_radius'] ) {
			$opts['data_attr']['border-radius'] = $opts['border_radius'];
		}
	} elseif ( 'group' === $opts['style'] ) {
		$opts['number_attr']['class'][] = 'fbq-s-text-bg';
		$opts['number_attr']['style_attr']['background-color'] = fabrique_c( $opts['background_color'] );

		if ( 0 <  $opts['border_radius'] ) {
			$opts['number_attr']['style_attr']['border-radius'] = $opts['border_radius'] . 'px';
		}
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_custompost_options' ) ) :
function fabrique_item_custompost_options( $opts )
{
	$opts = fabrique_item_entries_options( $opts );
	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_divider_options' ) ) :
function fabrique_item_divider_options( $opts )
{
	$defaults = array(
		'style' => 'single',
		'components' => array(),
		'color' => 'default',
		'width' => '100%',
		'line_thickness' => 1,
		'alignment' => 'center',
		'text' => 'text',
		'text_size' => 14,
		'text_background_color' => 'default'
	);
	$opts = fabrique_item_options( $defaults, $opts );

	$opts['text_on'] = isset( $opts['text_on'] ) ? $opts['text_on'] : in_array( 'text', $opts['components'] );
	$opts['line_attr'] = array(
		'class' => array( 'fbq-divider-line' ),
		'style_attr' => array(
			'width' => is_numeric( $opts['width'] ) ? $opts['width'] . 'px' : $opts['width']
		)
	);

	$color = fabrique_c( $opts['color'] );
	if ( 'single' === $opts['style'] ) {
		$opts['line_attr']['class'][] = 'fbq-p-border-bg';
		$opts['line_attr']['style_attr']['height'] = $opts['line_thickness'] .'px';
		$opts['line_attr']['style_attr']['background-color'] = $color;
	} elseif ( 'double' === $opts['style'] ) {
		$opts['line_attr']['class'][] = 'fbq-p-border-border';
		$opts['line_attr']['style_attr']['border-top-width'] = $opts['line_thickness'] * 3 .'px';
		$opts['line_attr']['style_attr']['border-top-color'] = $color;
	} elseif ( 'shade' === $opts['style'] ) {
		$opts['line_attr']['style_attr']['height'] = $opts['line_thickness'] .'px';
		if ( 'default' !== $opts['color'] ) {
			$opts['line_attr']['style_attr']['background-image'] = '-webkit-repeating-linear-gradient(45deg, transparent, transparent 2px, ' . $color . ' 2px ,' . $color . ' 4px);-o-repeating-linear-gradient(45deg, transparent, transparent 2px, ' . $color . ' 2px ,' . $color . ' 4px);-moz-repeating-linear-gradient(45deg, transparent, transparent 2px, ' . $color . ' 2px ,' . $color . ' 4px);repeating-linear-gradient(45deg, transparent, transparent 2px, ' . $color . ' 2px ,' . $color . ' 4px);';
		}
	}

	$opts['text_attr'] = array(
		'class' => 'fbq-divider-text fbq-p-border-color fbq-p-bg-bg'
	);

	if ( $opts['text_on'] ) {
		$opts['text_attr']['style_attr']['font-size'] = $opts['text_size'] .'px';
		$opts['text_attr']['style_attr']['color'] = $color;
		$opts['text_attr']['style_attr']['background-color'] = fabrique_c( $opts['text_background_color'] );
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_feature_options' ) ) :
function fabrique_item_feature_options( $opts )
{
	$defaults = array(
		'data' => array(),
		'style' => 'top',
		'components' => array( 'media', 'title', 'description', 'button' ),
		'alignment' => 'left',
		'no_of_columns' => 3,
		'no_of_items' => 3,
		'separator' => false,
		'background_color' => 'default',
		'background_opacity' => 100,
		'inner_spacing_x' => 0,
		'inner_spacing_y' => 0,
		'spacing' => 30,
		'title_uppercase' => false,
		'title_letter_spacing' => '',
		'title_font' => 'primary'
	);
	$opts = fabrique_item_options( $defaults, $opts, array( 'animation' ) );
	$opts['formatted'] = fabrique_get_row_items( $opts['data'], $opts['no_of_columns'] );
	$opts['title_on'] = isset( $opts['title_on'] ) ? $opts['title_on'] : in_array( 'title', $opts['components'] );
	$opts['media_on'] = isset( $opts['media_on'] ) ? $opts['media_on'] : in_array( 'media', $opts['components'] );
	$opts['description_on'] = isset( $opts['description_on'] ) ? $opts['description_on'] : in_array( 'description', $opts['components'] );
	$opts['button_on'] = isset( $opts['button_on'] ) ? $opts['button_on'] : in_array( 'button', $opts['components'] );
	$opts['item_inner_attr'] = array(
		'class' => 'fbq-feature-item-inner',
		'style_attr' => array(
			'background-color' => fabrique_hex_to_rgba( $opts['background_color'], $opts['background_opacity']/100 )
		)
	);

	$opts['item_body_attr'] = array(
		'class' => 'fbq-feature-body',
		'style_attr' => array()
	);

	$inner_space_selector = ( 'top' === $opts['style'] ) ? 'item_body_attr' : 'item_inner_attr';
	$opts[$inner_space_selector]['style_attr']['padding-top'] = $opts['inner_spacing_y'] / 2 .'px';
	$opts[$inner_space_selector]['style_attr']['padding-bottom'] = $opts['inner_spacing_y'] / 2 .'px';
	$opts[$inner_space_selector]['style_attr']['padding-left'] = $opts['inner_spacing_x'] / 2 .'px';
	$opts[$inner_space_selector]['style_attr']['padding-right'] = $opts['inner_spacing_x'] / 2 .'px';

	$opts['title_style'] = array(
		'letter-spacing' => is_numeric( $opts['title_letter_spacing'] ) ? $opts['title_letter_spacing'] .'px' : $opts['title_letter_spacing']
	);

	if ( $opts['title_uppercase'] ) {
		$opts['title_style']['text-transform'] = 'uppercase';
	}

	if ( $opts['separator'] ) {
		$opts['class'][] = 'with-separator';
	}

	$opts['column_width'] = ( 5 == $opts['no_of_columns'] ) ? '1-5' : 12 / $opts['no_of_columns'];
	$opts['item_attr'] = array(
		'class' => array(
			'fbq-feature-item',
			'fbq-p-border-border',
			'fbq-col-' . $opts['column_width']
		),
		'style_attr' => array(
			'padding' => '0 '. $opts['spacing'] / 2 .'px',
		)
	);

	if ( isset( $opts['animation'] ) && 'none' !== $opts['animation'] ) {
		$opts['item_attr']['class'][] = 'anmt-item anmt-' . $opts['animation'];

		if ( isset( $opts['stagger'] ) && $opts['stagger'] ) {
			$opts['item_attr']['class'][] = 'stagger';
		}
	}

	if ( 'transparent' !== $opts['background_color'] && 'default' !== $opts['background_color'] && 0 != $opts['background_opacity'] ) {
		$opts['class'][] = 'with-background';
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_featuredpost_options' ) ) :
function fabrique_item_featuredpost_options( $opts )
{
	$defaults = array(
		'role' => 'item',
		'filters' => array( 'all' ),
		'components' => array( 'category', 'author' ),
		'full_width' => false,
		'height' => 500,
		'entry_color_scheme' => 'default',
		'entry_background' => 'default',
		'entry_background_opacity' => 100,
		'title_uppercase' => 0,
		'title_letter_spacing' => '',
		'title_size' => 20,
		'title_font' => 'secondary',
		'meta_font' => 'primary',
		'use_latest_post' => false,
		'first_post_id' => '',
		'second_post_id' => '',
		'third_post_id' => '',
		'forth_post_id' => '',
		'fifth_post_id' => '',
		'sixth_post_id' => '',
		'seventh_post_id' => '',
		'eighth_post_id' => '',
		'max_width' => '',
		'carousel_background_type' => 'box',
		'fit_height' => false,
		'fit_height_percent' => 100,
		'fit_height_offset' => '',
		'fade' => false,
		'navigation' => false,
		'indicator' => false,
		'autoplay' => false,
		'autoplay_speed' => 5000,
		'background_id' => '',
		'background_url' => '',
		'color_scheme' => 'default',
		'background_color' => 'default',
		'background_opacity' => 90,
		'background_size' => 'cover',
		'background_position' => 'center center',
		'background_repeat' => 'repeat',
		'container_class' => '',
		'header_attr' => array()
	);
	$opts = fabrique_item_options( $defaults, $opts );
	$opts['category_on'] = isset( $opts['category_on'] ) ? $opts['category_on'] : in_array( 'category', $opts['components'] );
	$opts['author_on'] = isset( $opts['author_on'] ) ? $opts['author_on'] : in_array( 'author', $opts['components'] );
	$opts['excerpt_on'] = isset( $opts['excerpt_on'] ) ? $opts['excerpt_on'] : in_array( 'excerpt', $opts['components'] );
	$opts['entry_extra_class'] = ( 'default' !== $opts['entry_color_scheme'] ) ? 'fbq-entry-' . $opts['entry_color_scheme'] . '-scheme' : '';
	$opts['entry_inner_style'] = array();
	$opts['body_style'] = array();
	$opts['body_inner_style'] = array();
	$content_style = array();
	$content_data = array();
	$background_color = fabrique_hex_to_rgba( $opts['entry_background'], $opts['entry_background_opacity'] / 100 );

	$opts['header_attr'] = array(
		'class' => array( 'fbq-content-header', 'js-dynamic-navbar' ),
		'data_attr' => array()
	);

	$opts['title_attr'] = array(
		'class' => array( 'fbq-entry-title', 'fbq-s-text-color', 'fbq-' . $opts['title_font'] . '-font' ),
		'style_attr' => array(
			'font-size' => $opts['title_size'] . 'px',
			'letter-spacing' => is_numeric( $opts['title_letter_spacing'] ) ? $opts['title_letter_spacing'] .'px' : $opts['title_letter_spacing']
		)
	);
	if ( $opts['title_uppercase']  ) {
		$opts['title_attr']['style_attr']['text-transform'] = 'uppercase';
	}

	// In case featured post is page-title //
	if ( 'header' === $opts['role'] ) {
		$opts['data_attr']['role'] = 'header';
		$opts['container_class'] = ( !$opts['full_width'] ) ? 'fbq-container' : 'fbq-container--fullwidth';

		if ( 'default' !== $opts['color_scheme'] ) {
			$opts['header_attr']['class'][] = 'fbq-' . $opts['color_scheme'] . '-scheme';
			$opts['header_attr']['data_attr']['scheme'] = $opts['color_scheme'];
		}
	}

	if ( $opts['use_latest_post'] ) {
		$query_items = array(
			'no_of_items' => 8,
			'filters' => $opts['filters']
		);

		$posts = wp_get_recent_posts( fabrique_item_post_query( $query_items ) );
		$opts['post_id'] = array();
		if ( $posts ) {
			foreach ( $posts as $key => $value ) {
				$opts['post_id'][] = $value['ID'];
			}
		}
	} else {
		$post_id = array(
			apply_filters( 'wpml_object_id', $opts['first_post_id'], 'post', TRUE ),
			apply_filters( 'wpml_object_id', $opts['second_post_id'], 'post', TRUE ),
			apply_filters( 'wpml_object_id', $opts['third_post_id'], 'post', TRUE ),
			apply_filters( 'wpml_object_id', $opts['forth_post_id'], 'post', TRUE ),
			apply_filters( 'wpml_object_id', $opts['fifth_post_id'], 'post', TRUE ),
			apply_filters( 'wpml_object_id', $opts['sixth_post_id'], 'post', TRUE ),
			apply_filters( 'wpml_object_id', $opts['seventh_post_id'], 'post', TRUE ),
			apply_filters( 'wpml_object_id', $opts['eighth_post_id'], 'post', TRUE )
		);
		$opts['post_id'] = array_filter( $post_id );
	}

	$opts['class'][] = 'fbq-featuredpost--carousel';
	$opts['class'][] = $opts['carousel_background_type'] . '-background';
	$width = is_numeric( $opts['max_width'] ) ? $opts['max_width'] .'px' : $opts['max_width'];
	$opts['body_style']['max-width'] = ( 'auto' !== $width ) ? $width : '';

	if ( $opts['fit_height'] ) {
		$opts['class'][] = 'fbq-featuredpost--fit-height';
		$opts['data_attr']['screen_percent'] = (int)$opts['fit_height_percent'];
		$opts['entry_inner_style']['height'] = (int)$opts['fit_height_percent'] . 'vh';
		$opts['entry_inner_style']['line-height'] = (int)$opts['fit_height_percent'] . 'vh';

		if ( !empty( $opts['fit_height_offset'] ) ) {
			$opts['data_attr']['screen_offset'] = $opts['fit_height_offset'];
		}
	} else {
		$height = is_numeric( $opts['height'] ) ? $opts['height'] . 'px' : $opts['height'];
		$opts['entry_inner_style']['height'] = $height;
		$opts['entry_inner_style']['line-height'] = ( 'auto' !== $height ) ? $height : '';
	}

	if ( 'overlay' !== $opts['carousel_background_type'] ) {
		$opts['body_style']['background-color'] = $background_color;
	} else {
		$opts['class'][] = 'fbq-slider-dark-scheme';
	}

	$content_data['arrows'] = ( $opts['navigation'] ) ? 'true' : 'false';
	$content_data['indicator'] = ( $opts['indicator'] ) ? 'true' : 'false';
	if ( $opts['fade'] ) $content_data['fade'] = 'true';

	if ( $opts['autoplay'] ) {
		$content_data['duration'] = !empty( $opts['autoplay_speed'] ) ? $opts['autoplay_speed'] : 5000;
	}

	$opts['content_attr'] = array(
		'class' => 'fbq-featuredpost-content',
		'style_attr' => $content_style,
		'data_attr' => $content_data
	);

	$opts['post'] = array();
	$opts['post_format'] = array();
	$opts['post_meta'] = array();
	$opts['post_status'] = array();
	$opts['post_link'] = array();
	$opts['header_style'] = array();

	foreach ( $opts['post_id'] as $index => $post_id ) {
		$opts['post'][$index] = get_post( $post_id );
		$opts['post_format'][$index] = 'standard';
		$opts['post_meta'][$index] = array();
		$opts['post_status'][$index] = get_post_status( $post_id );
		$opts['post_link'][$index] = get_permalink( $post_id );
		$opts['header_style'][$index] = array();

		if ( 'publish' === $opts['post_status'][$index] && !empty( $post_id ) ) {
			$opts['post_format'][$index] = ( false == get_post_format( $post_id ) ) ? 'standard' : get_post_format( $post_id );
			$post_meta = get_post_meta( $post_id, 'bp_post_format_settings', true );
			$opts['post_meta'][$index] = is_array( $post_meta ) ? $post_meta : array();
			$thumb_id = get_post_thumbnail_id( $post_id );

			if ( 'carousel' === $opts['style'] ) {
				$opts['header_style'][$index]['background'] = fabrique_get_background_image( array( 'id' => $thumb_id ) );
			}
		}
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_gallery_options' ) ) :
function fabrique_item_gallery_options( $opts )
{
	$defaults = array(
		'responsive' => true, // for image without srcset
		'style' => 'grid',
		'components' => array(),
		'random_order' => false,
		'no_of_columns' => 3,
		'image_size' => 'large',
		'image_ratio' => 'auto',
		'image_lazy_load' => false,
		'on_image_click' => 'popup',
		'image_hover' => 'none',
		'spacing' => 15,
		'pagination' => false,
		'no_of_items' => -1,
		'pagination_style' => 'pagination',
		'no_of_scrolls' => 1,
		'thumbnail' => false,
		'thumbnail_columns' => 5,
		'navigation' => true,
		'indicator' => false,
		'loop' => true,
		'variable_width' => false,
		'height' => 500,
		'fade' => false,
		'adaptive_height' => false,
		'autoplay' => false,
		'autoplay_speed' => 5000,
		'center_mode' => false,
		'center_padding' => '',
		'images' => '',
		'caption' => ''
	);
	$opts = fabrique_item_options( $defaults, $opts, array( 'animation' ) );
	$opts['title_on'] = isset( $opts['title_on'] ) ? $opts['title_on'] : in_array( 'title', $opts['components'] );
	$opts['caption_on'] = isset( $opts['caption_on'] ) ? $opts['caption_on'] : in_array( 'caption', $opts['components'] );
	$opts['gallery_caption_on'] = isset( $opts['gallery_caption_on'] ) ? $opts['gallery_caption_on'] : in_array( 'gallerycaption', $opts['components'] );

	$opts['thumbnail_column_width'] = ( 5 == $opts['thumbnail_columns'] ) ? '1-5' : 12 / $opts['thumbnail_columns'];
	$opts['height'] = ( is_numeric( $opts['height'] ) || false !== strpos( $opts['height'], 'px' ) ) ? ( int )$opts['height'] : 500;
	$opts['image_id'] = array();
	$content_style = array();
	$content_data = array();

	if ( 'popup' ===  $opts['on_image_click'] || 'teaser' === $opts['style'] ) {
		$opts['data_attr']['action'] = 'image';
	}

	if ( 'carousel' === $opts['style'] ) {
		$content_style['margin'] = '0 ' . -$opts['spacing'] / 2 .'px';
		$content_data['loop'] = ( !$opts['loop'] || 'false' === $opts['loop'] ) ? 'false' : 'true';

		if ( $opts['thumbnail'] || $opts['fade'] ) {
			$content_data['display'] = 1;
			$content_data['scroll'] = 1;
			if ( $opts['fade'] && 'false' !== $opts['fade'] ) $content_data['fade'] = 'true';
		} else {
			$content_data['display'] = $opts['no_of_columns'];
			$content_data['scroll'] = ( $opts['no_of_scrolls'] > $opts['no_of_columns'] ) ? $opts['no_of_columns'] : $opts['no_of_scrolls'];
		}

		if ( $opts['variable_width'] && 'false' !== $opts['variable_width'] ) {
			$opts['class'][] = 'fbq-variable-width';
			$content_data['variable_width'] = 'true';
		}

		if ( $opts['center_mode'] && 'false' !== $opts['center_mode'] ) {
			$content_data['center_mode'] = 'true';
			$content_data['center_padding'] = is_numeric( $opts['center_padding'] ) ? $opts['center_padding'] . 'px' : $opts['center_padding'];
		}

		if ( $opts['autoplay'] && 'false' !== $opts['autoplay'] ) $content_data['duration'] = $opts['autoplay_speed'];
		if ( $opts['adaptive_height'] && 'false' !== $opts['adaptive_height'] ) $content_data['adaptive_height'] = 'true';
		if ( !$opts['navigation'] || 'false' === $opts['navigation'] ) $content_data['arrows'] = 'false';
		if ( $opts['indicator'] && 'false' !== $opts['indicator'] ) $content_data['indicator'] = 'true';
	} elseif ( 'grid' === $opts['style'] ) {
		$content_style['margin'] = '0 ' . -$opts['spacing'] / 2 . 'px';
	} elseif ( 'masonry' === $opts['style'] ) {
		$content_style['margin-right'] = -$opts['spacing'] . 'px';
	}

	$opts['content_attr'] = array(
		'class' => 'fbq-gallery-content',
		'style_attr' => $content_style,
		'data_attr' => $content_data
	);

	if ( !empty( $opts['images'] ) ) {
		$images  = is_array( $opts['images'] ) ? $opts['images'] : explode( ',', $opts['images'] );
		foreach ( $images as $image_id ) {
			$attachment = get_post( $image_id );
			if ( !empty( $attachment ) ) {
				$opts['image_id'][] = $image_id;
			}
		}
	}

	if ( $opts['random_order'] ) {
		shuffle( $opts['image_id'] );
	}

	$all_posts = sizeof( $opts['image_id'] );
	if ( get_query_var( 'paged' ) ) {
		$paged = get_query_var( 'paged' );
	} else if ( get_query_var( 'page' ) ) {
		$paged = get_query_var( 'page' );
	} else {
		$paged = 1;
	}

	$opts['query_args'] = array(
		'posts' => $opts['image_id'],
		'all_posts' => $all_posts,
		'paged' => $paged
	);

	if ( !empty( $opts['no_of_items'] ) && 0 != (int)( $opts['no_of_items'] ) ) {
		$opts['query_args']['posts_per_page'] = $opts['no_of_items'];
		$opts['query_args']['max_num_page'] = ceil( $all_posts / $opts['no_of_items'] );
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_heading_options' ) ) :
function fabrique_item_heading_options( $opts )
{
	$defaults = array(
		'style' => 'plain',
		'alternate_color' => 'default',
		'size' => 'h3',
		'letter_spacing' => '',
		'alignment' => 'left',
		'uppercase' => false,
		'font_family' => 'secondary',
		'text' => 'Heading'
	);
	$opts = fabrique_item_options( $defaults, $opts, array( 'padding' ) );

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_image_options' ) ) :
function fabrique_item_image_options( $opts )
{
	$defaults = array(
		'alignment' => 'center',
		'media_type' => 'image',
		'image_id' => '',
		'image_url' => '',
		'image_circle' => false,
		'image_size' => 'full',
		'image_max_width' => '',
		'image_popup' => false,
		'image_caption' => false,
		'image_ratio' => 'auto',
		'image_lazy_load' => false,
		'image_link' => '',
		'icon_style' => 'plain',
		'icon_hover_style' => 'fill',
		'icon_size' => 'x-large',
		'icon_color' => 'default',
		'icon_hover_color' => 'default',
		'icon' => 'et-speedometer',
		'icon_link' => '',
		'media_target_self' => false,
	);

	$opts = fabrique_item_options( $defaults, $opts );

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_instagram_options' ) ) :
function fabrique_item_instagram_options( $opts )
{
	$defaults = array(
		'style' => 'grid',
		'username' => '',
		'access_token' => '',
		'hashtag' => '',
		'no_of_query' => '',
		'no_of_items' => 12,
		'no_of_columns' => 3,
		'random_order' => false,
		'pagination' => false,
		'pagination_style' => 'pagination',
		'image_lazy_load' => true,
		'on_image_click' => 'none',
		'caption_on' => true,
		'link_post_type' => '',
		'link_taxonomy' => '',
		'link_label' => __( 'View Post', 'fabrique' ),
		'image_ratio' => 'auto',
		'image_hover' => 'none',
		'spacing' => 30,
		'filter' => false,
		'filter_alignment' => 'left',
		'filter_sorting' => 'default',
		'filter_disable_all' => false,
		'filter_initial' => '',
		'no_of_scrolls' => 1,
		'navigation' => true,
		'indicator' => false,
		'loop' => true,
		'autoplay' => false,
		'autoplay_speed' => 5000,
		'center_mode' => false,
		'center_padding' => '',
		'variable_width' => false,
		'height' => '',
		'fade' => false,
		'adaptive_height' => false
	);
	$opts['type'] = 'gallery';
	$opts = fabrique_item_options( $defaults, $opts, array( 'animation' ) );
	$opts['height'] = ( is_numeric( $opts['height'] ) || false !== strpos( $opts['height'], 'px' ) ) ? ( int )$opts['height'] : 500;
	$content_style = array();
	$content_data = array();
	$opts['data_attr']['action'] = $opts['on_image_click'];

	if ( 'default' !== $opts['filter_sorting'] ) {
		$content_data['filter_sorting'] = $opts['filter_sorting'];
	}

	if ( 'carousel' === $opts['style'] ) {
		$content_style['margin'] = '0 ' . -$opts['spacing'] / 2 .'px';
		$content_data['loop'] = ( !$opts['loop'] || 'false' === $opts['loop'] ) ? 'false' : 'true';

		if ( $opts['fade'] ) {
			$content_data['display'] = 1;
			$content_data['scroll'] = 1;
			if ( $opts['fade'] && 'false' !== $opts['fade'] ) $content_data['fade'] = 'true';
		} else {
			$content_data['display'] = $opts['no_of_columns'];
			$content_data['scroll'] = ( $opts['no_of_scrolls'] > $opts['no_of_columns'] ) ? $opts['no_of_columns'] : $opts['no_of_scrolls'];
		}

		if ( $opts['variable_width'] && 'false' !== $opts['variable_width'] ) {
			$opts['class'][] = 'fbq-variable-width';
			$content_data['variable_width'] = 'true';
		}

		if ( $opts['center_mode'] && 'false' !== $opts['center_mode'] ) {
			$content_data['center_mode'] = 'true';
			$content_data['center_padding'] = is_numeric( $opts['center_padding'] ) ? $opts['center_padding'] . 'px' : $opts['center_padding'];
		}

		if ( $opts['autoplay'] && 'false' !== $opts['autoplay'] ) $content_data['duration'] = $opts['autoplay_speed'];
		if ( $opts['adaptive_height'] && 'false' !== $opts['adaptive_height'] ) $content_data['adaptive_height'] = 'true';
		if ( !$opts['navigation'] || 'false' === $opts['navigation'] ) $content_data['arrows'] = 'false';
		if ( $opts['indicator'] && 'false' !== $opts['indicator'] ) $content_data['indicator'] = 'true';
	} elseif ( 'grid' === $opts['style'] ) {
		$content_style['margin'] = '0 ' . -$opts['spacing'] / 2 . 'px';
	} elseif ( 'masonry' === $opts['style'] ) {
		$content_style['margin-right'] = -$opts['spacing'] . 'px';
	}

	$opts['content_attr'] = array(
		'class' => 'fbq-gallery-content',
		'style_attr' => $content_style,
		'data_attr' => $content_data
	);

	if ( !empty( $opts['link_post_type'] ) && 'content' === $opts['on_image_click'] ) {
		$opts['query_post_args'] = array(
			'post_type' => $opts['link_post_type'],
			'post_status' => 'publish',
			'suppress_filters' => false,
			'ignore_sticky_posts' => 1,
			'orderby' => 'rand',
			'posts_per_page' => 1,
			'post__not_in' => array()
		);
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_interactive_options' ) ) :
function fabrique_item_interactive_options( $opts )
{
	$defaults = array(
		'data' => array( array(), array() ),
		'spaces' => array( array(), array() ),
		'style' => 'overlay',
		'no_of_items' => 2,
		'name' => '',
		'disable_hover' => false,
		'height' => 500,
		'overlay_effect' => 'fadein',
		'slide_direction' => 'left',
		'border_thickness' => 0,
		'border_color' => 'default'
	);
	$opts = fabrique_item_options( $defaults, $opts, array( 'padding' ) );
	$opts['space_style'] = fabrique_get_spacing_style( $opts, 'padding' );
	$opts['normal_class'] = '';
	$opts['hover_class'] = '';
	$opts['class'][] = 'fbq-p-border-border';

	if ( !empty( $opts['name'] ) ) {
		$opts['id'][] = 'interactive-' . $opts['name'];
	}

	if ( $opts['disable_hover'] ) {
		$opts['class'][] = 'disable-hover';
	}

	if ( 'slide' === $opts['style'] ) {
		$opts['class'][] = 'fbq-interactive--slide-' . $opts['slide_direction'];
	} elseif ( 'overlay' === $opts['style'] ) {
		$opts['class'][] = 'fbq-interactive--overlay-' . $opts['overlay_effect'];
	}

	if ( 'default' !== $opts['data'][0]['color_scheme'] ) {
		$opts['normal_class'] .= 'fbq-' . $opts['data'][0]['color_scheme'] . '-scheme';
	}

	if ( 'default' !== $opts['data'][1]['color_scheme'] ) {
		$opts['hover_class'] .= 'fbq-' . $opts['data'][1]['color_scheme'] . '-scheme';
	}

	if ( $opts['border_thickness'] > 0 ) {
		$opts['style_attr']['border-width'] = $opts['border_thickness'] .'px';
		$opts['style_attr']['border-color'] = fabrique_c( $opts['border_color'] );
	}

	$height = is_numeric( $opts['height'] ) ? $opts['height'] . 'px' : $opts['height'];
	$opts['style_attr']['height'] = $height;
	$opts['style_attr']['line-height'] = ( 'auto' !== $height ) ? $height : '';

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_map_options' ) ) :
function fabrique_item_map_options( $opts )
{
	$defaults = array(
		'map_id' => ''
	);

	$opts = fabrique_item_options( $defaults, $opts );
	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_message_options' ) ) :
function fabrique_item_message_options( $opts )
{
	$defaults = array(
		'components' => array( 'icon', 'button' ),
		'size' => 14,
		'border_thickness' => 2,
		'border_radius' => 4,
		'border_color' => 'default',
		'text_color' => 'default',
		'background_color' => 'default',
		'background_opacity' => 100,
		'text' => 'Notification Message',
		'media_type' => 'icon',
		'icon_style' => 'plain',
		'icon_hover_style' => 'none',
		'icon_size' => 'small',
		'icon_color' => 'bp_color_5',
		'icon_hover_color' => 'default',
		'icon' => 'exclamation-triangle',
		'icon_link' => '/'
	);
	$opts = fabrique_item_options( $defaults, $opts );

	$opts['icon_on'] = isset( $opts['icon_on'] ) ? $opts['icon_on'] : in_array( 'icon', $opts['components'] );
	$opts['button_on'] = isset( $opts['button_on'] ) ? $opts['button_on'] : in_array( 'button', $opts['components'] );
	$opts['class'][] = 'js-close-all';
	$opts['class'][] = 'fbq-p-brand-contrast-color fbq-p-brand-bg';

	$opts['style_attr']['font-size'] = $opts['size'] .'px';
	$opts['style_attr']['color'] = fabrique_c( $opts['text_color'] );
	$opts['style_attr']['border-radius'] = $opts['border_radius'] . 'px';

	if ( 0 < $opts['border_thickness'] ) {
		$opts['style_attr']['border-width'] = $opts['border_thickness'] .'px';
		$opts['style_attr']['border-color'] = fabrique_c( $opts['border_color'] );
	}

	$opts['style_attr']['background-color'] = fabrique_hex_to_rgba( $opts['background_color'], $opts['background_opacity'] / 100 );

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_milestone_options' ) ) :
function fabrique_item_milestone_options( $opts )
{
	$defaults = array(
		'data' => array(),
		'style' => 'stacked',
		'components' => array( 'subtitle' ),
		'no_of_items' => 3,
		'width' => 150,
		'height' => '',
		'title_position' => 'bottom',
		'border_thickness' => 0,
		'border_radius' => 0,
		'border_color' => 'default',
		'background_color' => 'default',
		'background_opacity' => 100,
		'number_color' => 'default',
		'separator' => false,
		'number_animation' => true,
		'title_letter_spacing' => '',
		'letter_spacing' => 2,
		'number_font' => 'secondary',
		'title_font' => 'primary',
		'subtitle_font' => 'primary',
		'alignment' => 'center',
	);
	$opts = fabrique_item_options( $defaults, $opts, array( 'animation' ) );
	$opts['media_on'] = isset( $opts['media_on'] ) ? $opts['media_on'] : in_array( 'media', $opts['components'] );
	$opts['subtitle_on'] = isset( $opts['subtitle_on'] ) ? $opts['subtitle_on'] : in_array( 'subtitle', $opts['components'] );
	$opts['wrapper_style'] = array();
	$opts['title_style'] = array();
	$opts['subtitle_style'] = array();
	$opts['number_style'] = array();

	$opts['number_style']['color'] = fabrique_c( $opts['number_color'] );
	$opts['title_style']['letter-spacing'] = is_numeric( $opts['title_letter_spacing'] ) ? $opts['title_letter_spacing'] .'px' : $opts['title_letter_spacing'];
	$opts['subtitle_style']['letter-spacing'] = is_numeric( $opts['letter_spacing'] ) ? $opts['letter_spacing'] .'px' : $opts['letter_spacing'];

	$opts['column_width'] = ( 5 == $opts['no_of_items'] ) ? '1-5' : 12 / $opts['no_of_items'];
	$opts['item_class'] = 'fbq-milestone-item fbq-p-border-border fbq-col-' . $opts['column_width'];

	if ( $opts['number_animation'] ) {
		$opts['data_attr']['counter-animation'] = 'true';
	}

	if ( $opts['separator'] ) {
		$opts['class'][] = 'with-separator';
	}

	if ( 'transparent' === $opts['background_color'] && 0 == $opts['border_thickness'] ) {
		$opts['class'][] = 'transparent';
	}

	$width = is_numeric( $opts['width'] ) ? $opts['width'] .'px' : $opts['width'];
	$opts['wrapper_style']['max-width'] = ( 'auto' !== $width ) ? $width : '';
	$opts['wrapper_style']['height'] = is_numeric( $opts['height'] ) ? $opts['height'] .'px' : $opts['height'];
	$opts['wrapper_style']['border-radius'] = $opts['border_radius'] .'%';
	$opts['wrapper_style']['background-color'] = fabrique_hex_to_rgba( $opts['background_color'], $opts['background_opacity']/100 );

	if ( 0 < $opts['border_thickness'] ) {
		$opts['wrapper_style']['border-width'] = $opts['border_thickness'] .'px';
		$opts['wrapper_style']['border-color'] = fabrique_c( $opts['border_color'] );
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_modal_options' ) ) :
function fabrique_item_modal_options( $opts )
{
	$defaults = array(
		'spaces' => array(),
		'splash_screen' => true,
		'splash_screen_delay' => 1000,
		'splash_screen_expire' => 3,
		'name' => '',
		'max_width' => '',
		'overflow' => 'hidden',
		'popup_animation' => 'fade',
		'color_scheme' => 'default',
		'background_color' => 'default',
		'background_opacity' => 90,
		'background_size' => 'cover',
		'background_position' => 'center center',
		'background_repeat' => 'repeat',
	);

	$opts = fabrique_item_options( $defaults, $opts, array( 'animation', 'padding', 'margin' ) );
	$padding_style_args = fabrique_get_spacing_style( $opts, 'padding' );
	$opts['wrapper_style'] = fabrique_get_spacing_style( $opts, 'margin', $padding_style_args );
	$opts['inner_style'] = array( 'overflow-y' => $opts['overflow'] );
	$opts['class'][] = 'fbq-modal--' . $opts['popup_animation'];

	if ( 'default' !== $opts['color_scheme'] ) {
		$opts['class'][] = 'fbq-' . $opts['color_scheme'] . '-scheme';
	}

	if ( !empty( $opts['name'] ) ) {
		$opts['id'][] = 'modal-' . $opts['name'];
	}

	if ( !empty( $opts['max_width'] ) ) {
		$opts['wrapper_style']['max-width'] = is_numeric( $opts['max_width'] ) ? $opts['max_width'] . 'px' : $opts['max_width'];
	}

	if ( $opts['splash_screen'] ) {
		$opts['data_attr']['splash'] = true;
		$opts['data_attr']['delay'] = is_numeric( $opts['splash_screen_delay'] ) ? (int)$opts['splash_screen_delay'] : 1000;
		$opts['data_attr']['expire'] = is_numeric( $opts['splash_screen_expire'] ) ? (int)$opts['splash_screen_expire'] : 3;
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_navigation_options' ) ) :
function fabrique_item_navigation_options( $opts )
{
	$defaults = array(
		'style' => 'bar',
		'same_term' => false,
		'border_top' => true,
		'border_bottom' => false
	);

	$opts = fabrique_item_options( $defaults, $opts );
	$opts['class'][] = 'fbq-secondary-font';
	$opts['class'][] = 'fbq-p-border-border';
	$opts['link_class'] = 'fbq-navigation-link';

	if ( 'fill' === $opts['style'] ) {
		$opts['link_class'] .= ' fbq-s-bg-bg';
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_navigation_menu_options' ) ) :
function fabrique_item_navigation_menu_options( $opts )
{
	$defaults = array(
		'is_item' => true,
		'nav_menu' => 'default',
		'style' => 'standard',
		'components' => array( 'logo' ),
		'height' => 70,
		'color_scheme' => 'default',
		'background_color' => 'default',
		'background_opacity' => 100,
		'border_thickness' => 0,
		'border_color' => 'default',
		'menu_hover_style' => 'default',
		'fixed_nav' => false,
		'stop_element' => '',
		'action_type' => 'link',
		'inline_position' => 'inner',
		'menu_position' => 'center'
	);
	$opts = fabrique_item_options( $defaults, $opts, array( 'alignment', 'animation' ) );

	$opts['style_attr']['height'] = $opts['height'] . 'px';
	$opts['navbar_position'] = 'top';
	$opts['fixed_navbar_style'] = 'default';
	$opts['append_inline_style'] = true;
	$opts['navbar_style'] = $opts['style'];
	$opts['navbar_height'] = $opts['height'];
	$opts['navbar_menu_position'] = $opts['menu_position'];
	$opts['inline_navbar_menu_position'] = $opts['inline_position'];
	$opts['navbar_menu_hover_style'] = $opts['menu_hover_style'];
	$opts['fixed_navbar'] = $opts['fixed_nav'];
	$opts['navbar_background_color'] = $opts['background_color'];
	$opts['navbar_opacity'] = $opts['background_opacity'];
	$opts['fixed_navbar_background_color'] = $opts['background_color'];
	$opts['fixed_navbar_opacity'] = $opts['background_opacity'];
	$opts['navbar_border_thickness'] = $opts['border_thickness'];
	$opts['navbar_border_color'] = $opts['border_color'];
	$opts['logo_on'] = isset( $opts['logo_on'] ) ? $opts['logo_on'] : in_array( 'logo', $opts['components'] );
	$opts['search_on'] = isset( $opts['search_on'] ) ? $opts['search_on'] : in_array( 'search', $opts['components'] );
	$opts['cart_on'] = isset( $opts['cart_on'] ) ? $opts['cart_on'] : in_array( 'cart', $opts['components'] );
	$opts['header_action_button'] = isset( $opts['header_action_button'] ) ? $opts['header_action_button'] : in_array( 'actionbutton', $opts['components'] );

	if ( 'default' !== $opts['color_scheme'] ) {
		$opts['navbar_color_scheme'] = $opts['color_scheme'];
	}

	if ( !empty( $opts['stop_element'] ) ) {
		$opts['data_attr']['stop'] = '#' . $opts['stop_element'];
	}

	if ( isset( $opts['animation'] ) && 'none' !== $opts['animation'] ) {
		$opts['extra_class'] = 'anmt-item anmt-' . $opts['animation'];

		if ( isset( $opts['stagger'] ) && $opts['stagger'] ) {
			$opts['extra_class'] .= ' stagger';
		}
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_pluginslider_options' ) ) :
function fabrique_item_pluginslider_options( $opts )
{
	$defaults = array(
		'pluginslider' => ''
	);

	$opts = fabrique_item_options( $defaults, $opts );
	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_pricing_options' ) ) :
function fabrique_item_pricing_options( $opts )
{
	$defaults = array(
		'data' => array(),
		'content' => array(),
		'style' => 'border',
		'components' => array( 'button' ),
		'header' => 'inline',
		'no_of_items' => 3,
		'no_of_rows' => 4,
		'highlighted_column' => 2,
		'currency' => '$',
		'alignment' => 'center',
		'body_color' => 'default',
		'border_color' => 'default',
		'alternate_row' => 'default',
		'price_font' => 'secondary',
		'toptitle_font' => 'secondary',
		'subtitle_font' => 'secondary',
		'content_font' => 'primary'
	);
	$opts = fabrique_item_options( $defaults, $opts, array( 'animation' ) );
	$opts['image_on'] = isset( $opts['image_on'] ) ? $opts['image_on'] : in_array( 'image', $opts['components'] );
	$opts['button_on'] = isset( $opts['button_on'] ) ? $opts['button_on'] : in_array( 'button', $opts['components'] );
	$opts['class'][] = 'fbq-pricing--'. $opts['header'];

	if ( 'default' !== $opts['alternate_row'] && 'transparent' !== $opts['alternate_row'] ) {
		$opts['class'][] = 'fbq-pricing--alternate';
	}

	$opts['item_class'] = array();
	$opts['item_style'] = array();
	$opts['heading_class'] = array();
	$opts['heading_style'] = array();
	$opts['alternate_style'] = array();
	$body_color = fabrique_c( $opts['body_color'] );
	$border_color = fabrique_c( $opts['border_color'] );

	$opts['column_width'] = ( 5 == $opts['no_of_items'] ) ? '1-5' : 12 / $opts['no_of_items'];
	$opts['column_class'] = 'fbq-col-' . $opts['column_width'];

	foreach ( $opts['data'] as $index => $data ) {
		$item_style = array();
		$heading_style = array();
		$opts['item_class'][$index] = array();
		$opts['heading_class'][$index] = array();
		$opts['item_class'][$index][] = $opts['column_class'];
		$item_style['border-color'] = $border_color;

		if ( $opts['image_on'] && 'image' === $data['media_type'] && empty( $data['top_title'] ) ) {
			$opts['item_class'][$index][] = 'no-top-padding';
		}

		if ( isset( $opts['animation'] ) && 'none' !== $opts['animation'] ) {
			$opts['item_class'][$index][] = 'anmt-item anmt-' . $opts['animation'];

			if ( isset( $opts['stagger'] ) && $opts['stagger'] ) {
				$opts['item_class'][$index][] = 'stagger';
			}
		}

		if ( 'fill' === $opts['style'] ) {
			$item_style['background-color'] = fabrique_c( $data['background_color'] );
			$heading_style['color'] = fabrique_c( $data['color'] );

			if ( $index == $opts['highlighted_column'] - 1 ) {
				$opts['item_class'][$index][] = 'highlighted';
				$opts['item_class'][$index][] = 'fbq-p-bg-bg';
				$opts['heading_class'][$index][] = 'fbq-p-brand-color';
			} else {
				$opts['item_class'][$index][] = 'fbq-s-bg-bg';
				$opts['heading_class'][$index][] = 'fbq-s-text-color';
			}
		} else {
			$opts['item_class'][$index][] = 'fbq-p-bg-bg';
			$item_style['background-color'] = $body_color;
			$heading_style['background-color'] = fabrique_c( $data['background_color'] );
			$heading_style['color'] = fabrique_c( $data['color'] );

			if ( $index == $opts['highlighted_column'] - 1 ) {
				$opts['item_class'][$index][] = 'highlighted';
				$opts['heading_class'][$index][] = 'fbq-p-brand-contrast-color';
				$opts['heading_class'][$index][] = 'fbq-p-brand-bg';
			} else {
				$opts['heading_class'][$index][] = 'fbq-s-bg-bg';
				$opts['heading_class'][$index][] = 'fbq-s-text-color';
			}
		}

		$opts['item_style'][] = $item_style;
		$opts['heading_style'][] = $heading_style;
	}

	$alternate_index_mod = ( 'fill' === $opts['style'] ) ? 0 : 1;

	for ( $index = 0; $index < $opts['no_of_rows']; $index++ ) {
		$alternate_style = array();

		if ( $index % 2 == $alternate_index_mod ) {
			$alternate_style['background-color'] = fabrique_c( $opts['alternate_row'] );
		}

		$opts['alternate_style'][] = $alternate_style;
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_product_options' ) ) :
function fabrique_item_product_options( $opts )
{
	if ( !isset( $opts['query'] ) ) {
		$opts['post_type'] = 'product';
		$opts['post_taxonomy'] = 'product_cat';
		$opts['post_tag'] = 'product_tag';

		if ( 'price' === $opts['order_by'] ) {
			$opts['meta_key'] = '_price';
			$opts['orderby'] = 'meta_value_num';
		} else if ( 'sales' === $opts['order_by'] ) {
			$opts['meta_key'] = 'total_sales';
			$opts['orderby'] = 'meta_value_num';
		}

		if ( 'onsale' === $opts['special_filter'] ) {
			$opts['meta_key'] = '';
			$opts['meta_query'] = array(
				'relation' => 'OR',
				array(
					'key'     => '_sale_price',
					'value'   => 0,
					'compare' => '>',
					'type'    => 'numeric'
				),
				array(
					'key'     => '_min_variation_sale_price',
					'value'   => 0,
					'compare' => '>',
					'type'    => 'numeric'
				)
			);
		} elseif ( 'featured' === $opts['special_filter'] ) {
			$opts['tax_query'] = array(
				array(
					'taxonomy' => 'product_visibility',
					'field' => 'slug',
					'terms' => 'featured'
				)
			);
		}
	}

	$opts = fabrique_item_entries_options( $opts );
	$opts['class'][] = 'woocommerce';

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_productcat_options' ) ) :
function fabrique_item_productcat_options( $opts )
{
	$defaults = array(
		'style' => 'overlay',
		'order_by' => 'name',
		'order' => 'asc',
		'image_size' => 'large',
		'image_ratio' => 'auto',
		'image_lazy_load' => false,
		'image_hover' => 'none',
		'no_of_columns' => 4,
		'spacing' => 30,
		'filters' => array( 'all' ),
		'title_font' => 'secondary',
		'title_size' => 20,
		'title_uppercase' => 0,
		'title_letter_spacing' => ''
	);
	$opts = fabrique_item_options( $defaults, $opts, array( 'animation' ) );

	$opts['taxonomy'] = 'product_cat';
	$opts['category_args'] = array(
		'orderby' => $opts['order_by'],
		'order' => $opts['order'],
		'hide_empty' => false,
		'parent' => 0
	);

	$opts['content_attr'] = array(
		'class' => array( 'fbq-entries-content' ),
		'style_attr' => array( 'margin' => '0 '. -$opts['spacing']/2 . 'px' )
	);

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_quote_options' ) ) :
function fabrique_item_quote_options( $opts )
{
	$defaults = array(
		'style' => 'standard',
		'components' => array( 'author' ),
		'background_color' => 'default',
		'background_opacity' => 100,
		'alternate_color' => 'default',
		'quote_letter_spacing' => '',
		'quote_line_height' => '',
		'quote_font' => 'secondary',
		'alignment' => 'center',
		'text' => 'Type your quote here',
		'author' => 'John Doe',
	);

	$opts = fabrique_item_options( $defaults, $opts );
	$opts['author_on'] = isset( $opts['author_on'] ) ? $opts['author_on'] : in_array( 'author', $opts['components'] );
	$opts['style_attr']['background-color'] = fabrique_hex_to_rgba( $opts['background_color'], $opts['background_opacity']/100 );

	if ( 'transparent' !== $opts['background_color'] && 'default' !== $opts['background_color'] && 0 != $opts['background_opacity'] ) {
		$opts['class'][] = 'with-background';
	}

	$opts['quote_text_attr'] = array(
		'class' => 'fbq-quote-text fbq-p-brand-color fbq-' . $opts['quote_font'] . '-font',
		'style_attr' => array(
			'line-height' => $opts['quote_line_height'],
			'letter-spacing' => $opts['quote_letter_spacing']
		)
	);

	$opts['quote_icon_attr'] = array(
		'class' => 'fbq-quote-icon fbq-p-brand-color',
		'style_attr' => array(
			'color' => fabrique_c( $opts['alternate_color'] ),
		)
	);

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_relatedpost_options' ) ) :
function fabrique_item_relatedpost_options( $opts, $post_id )
{
	$defaults = array(
		'style' => 'grid',
		'components' => array( 'heading', 'thumbnail' ),
		'no_of_items' => 6,
		'no_of_columns' => 6,
		'image_size' => 'medium_large',
		'image_ratio' => '3x2',
		'image_lazy_load' => false,
		'background_color' => 'default',
		'heading' => 'More...',
	);
	$opts = fabrique_item_options( $defaults, $opts );
	$opts['heading_on'] = isset( $opts['heading_on'] ) ? $opts['heading_on'] : in_array( 'heading', $opts['components'] );
	$opts['thumbnail_on'] = isset( $opts['thumbnail_on'] ) ? $opts['thumbnail_on'] : in_array( 'thumbnail', $opts['components'] );
	$opts['date_on'] = isset( $opts['date_on'] ) ? $opts['date_on'] : in_array( 'date', $opts['components'] );
	$opts['filters'] = array();

	$post_type = get_post_type();
	if ( 'fbq_project' === $post_type ) {
		$term_name = 'fbq_project_category';
	} elseif ( 'page' === $post_type ) {
		$term_name = 'fbq_page_category';
	} elseif ( 'product' === $post_type ) {
		$term_name = 'product_cat';
	} else {
		$term_name = 'category';
	}

	$categories = get_the_terms( $post_id, $term_name );
	$opts['categories'] = !empty( $categories ) ? $categories : array();
	foreach ( $opts['categories'] as $cat ) {
		$opts['filters'][] = $cat->slug;
	}
	$opts['relatedpost_query_args'] = fabrique_item_post_query( $opts, $post_type, $term_name );
	$opts['relatedpost_query_args']['post__not_in'] = array( $post_id );

	if ( 'transparent' !== $opts['background_color'] && 'default' !== $opts['background_color'] ) {
		$opts['class'][] = 'with-background';
		$opts['style_attr']['background-color'] = fabrique_c( $opts['background_color'] );
	}

	if ( 'list' !== $opts['style'] ) {
		$opts['column_size'] = ( 5 == $opts['no_of_columns'] ) ? '1-5' : 12 / $opts['no_of_columns'];
	} else {
		$opts['column_size'] = 12;
	}

	$opts['entry_class'] = 'fbq-col-' . $opts['column_size'];

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_share_options' ) ) :
function fabrique_item_share_options( $opts )
{
	$defaults = array(
		'style' => 'minimal',
		'components' => array( 'facebook', 'twitter', 'pinterest', 'google-plus', 'tumblr', 'email' ),
		'divider' => false,
		'size' => 14,
		'auto_color' => true,
		'color' => 'default',
		'icon_style' => 'plain',
		'icon_hover_style' => 'none',
		'icon_hover_color' => 'default',
		'alignment' => 'center'
	);

	$opts = fabrique_item_options( $defaults, $opts );
	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_showmore_options' ) ) :
function fabrique_item_showmore_options( $opts )
{
	$defaults = array(
		'spaces' => array(),
		'height' => '',
		'more_button_color' => 'default',
		'more_button_label' => 'Show More',
		'less_button_label' => 'Show Less',
		'no_of_items' => 1,
		'color_scheme' => 'default',
		'background_type' => 'image',
		'background_color' => 'default',
		'background_opacity' => 90,
		'background_id' => '',
		'background_url' => '',
		'background_size' => 'cover',
		'background_position' => 'center center',
		'background_repeat' => 'repeat',
	);

	$opts = fabrique_item_options( $defaults, $opts, array( 'padding' ) );
	$opts['style_attr']['max-height'] = is_numeric( $opts['height'] ) ? $opts['height'] .'px' : $opts['height'];
	$opts['inner_attr'] = array(
		'class' => 'fbq-showmore-inner',
		'style_attr' => fabrique_get_spacing_style( $opts, 'padding' )
	);

	$opts['overlay_style'] = array();
	$opts['more_button_style'] = array();

	if ( 'default' !== $opts['more_button_color'] ) {
		$opts['more_button_style']['color'] = fabrique_c( $opts['more_button_color'] );
	}

	if ( 'default' !== $opts['background_color'] ) {
		$button_bg_color = fabrique_c( $opts['background_color'] );
		$opts['overlay_style']['background'] = 'background:linear-gradient(to bottom, transparent 0%, ' . $button_bg_color . ' 60%);';
	}

	if ( 'default' !== $opts['color_scheme'] ) {
		$opts['class'][] = 'fbq-' . $opts['color_scheme'] . '-scheme';
		$opts['data_attr']['scheme'] = $opts['color_scheme'];
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_skill_options' ) ) :
function fabrique_item_skill_options( $opts )
{
	$defaults = array(
		'data' => array(),
		'style' => 'bar',
		'components' => array( 'percentage' ),
		'no_of_items' => 4,
		'axis' => 'horizontal',
		'height' => 200,
		'width' => 150,
		'thickness' => '4px',
		'border_radius' => 0,
		'base_background_color' => 'default',
		'alignment' => 'center',
	);

	if ( 'bar' === $opts['style'] && 'vertical' === $opts['axis'] ) {
		$opts = fabrique_item_options( $defaults, $opts, array( 'animation' ) );
	} else {
		$opts = fabrique_item_options( $defaults, $opts, array( 'alignment', 'animation' ) );
	}

	$opts['percentage_on'] = isset( $opts['percentage_on'] ) ? $opts['percentage_on'] : in_array( 'percentage', $opts['components'] );
	$opts['icon_on'] = isset( $opts['icon_on'] ) ? $opts['icon_on'] : in_array( 'icon', $opts['components'] );

	$default_bar_style = array();
	$default_progress_style = array();
	$base_percent_style = array();
	$opts['inner_style'] = array();
	$opts['item_data'] = array();
	$opts['icon_style'] = array();
	$opts['piechart_style'] = array();
	$opts['percent_style'] = array();

	if ( 5 == $opts['no_of_items'] ) {
		$opts['item_class'] = 'fbq-col-1-5';
	} else {
		$opts['item_class'] = 'fbq-col-'. 12 / $opts['no_of_items'];
	}

	if ( 'bar' === $opts['style'] ) {
		$opts['class'][] = 'fbq-skill--' . $opts['axis'];

		if ( 'horizontal' === $opts['axis'] ) {
			$opts['item_class'] = 'fbq-col-12';
			$default_bar_style['background-color'] = fabrique_c( $opts['base_background_color'] );

			if ( 0 != $opts['border_radius'] ) {
				$default_bar_style['border-radius'] = $opts['border_radius'] . 'px';
				$default_progress_style['border-radius'] = $opts['border_radius'] . 'px';
			}

			if ( !empty( $opts['thickness'] ) ) {
				$default_bar_style['height'] = is_numeric( $opts['thickness'] ) ? $opts['thickness'] . 'px' : $opts['thickness'];
			} else {
				$default_bar_style['height'] = '4px';
			}
		} else {
			$default_bar_style['height'] = is_numeric( $opts['height'] ) ? $opts['height'] . 'px' : $opts['height'];
			$default_progress_style['background-color'] = fabrique_c( $opts['base_background_color'] );

			if ( !empty( $opts['thickness'] ) ) {
				$opts['inner_style']['max-width'] = is_numeric( $opts['thickness'] ) ? $opts['thickness'] . 'px' : $opts['thickness'];
			}

			if ( 0 != $opts['border_radius'] ) {
				$default_bar_style['border-radius'] = $opts['border_radius'] . 'px';
				$default_progress_style['border-top-left-radius'] = $opts['border_radius'] . 'px';
				$default_progress_style['border-top-right-radius'] = $opts['border_radius'] . 'px';
			}
		}
	} elseif ( 'circle' === $opts['style'] ) {
		$opts['piechart_style']['width'] = ( int )$opts['width'] . 'px';
		$opts['piechart_style']['height'] = ( int )$opts['width'] . 'px';

		if ( !$opts['icon_on'] ) {
			$base_percent_style['font-size'] = ( int )$opts['width']*0.3 . 'px';
		}
	}

	if ( isset( $opts['animation'] ) && 'none' !== $opts['animation'] ) {
		$opts['item_class'] .= ' anmt-item anmt-' . $opts['animation'];

		if ( isset( $opts['stagger'] ) && $opts['stagger'] ) {
			$opts['item_class'] .= ' stagger';
		}
	}

	foreach ( $opts['data'] as $i => $data ) {
		$item_data = array();
		$icon_style = array();
		$bar_style = $default_bar_style;
		$progress_style = $default_progress_style;
		$item_data['percent'] = $data['percent'];
		$icon_style['color'] = fabrique_c( $data['icon_color'] );
		$opts['percent_style'][] = $base_percent_style;

		if ( 'circle' === $opts['style'] ) {
			$item_data['size'] = $opts['width'];
			if ( 'default' === $data['color'] ) {
				$item_data['color'] = fabrique_mod( 'bp_color_1' );
			} else {
				$skill_color = fabrique_c( $data['color'] );
				$item_data['color'] = $skill_color;
				$opts['percent_style'][$i]['color'] = $skill_color;
			}

			$item_data['thickness'] = $opts['thickness'];

			if ( 'default' === $opts['base_background_color'] ) {
				$item_data['base'] = ( 'light' === fabrique_mod( 'default_color_scheme' ) ) ? fabrique_mod( 'bp_color_6' ) : fabrique_mod( 'bp_color_11' );
			} else {
				$item_data['base'] = fabrique_c( $opts['base_background_color'] );
			}

			$icon_style['font-size'] = $opts['width'] / 4 . 'px';
		} elseif ( 'bar' === $opts['style'] ) {
			$item_data['axis'] = $opts['axis'];

			if ( 'horizontal' === $opts['axis'] ) {
				$progress_style['background-color'] = fabrique_c( $data['color'] );
			} else {
				$bar_style['background-color'] = fabrique_c( $data['color'] );
			}
		}

		$opts['item_data'][] = $item_data;
		$opts['icon_style'][] = $icon_style;
		$opts['bar_style'][] = $bar_style;
		$opts['progress_style'][] = $progress_style;
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_slider_options' ) ) :
function fabrique_item_slider_options( $opts )
{
	$defaults = array(
		'data' => array(),
		'components' => array( 'indicator', 'navigation' ),
		'name' => '',
		'full_width' => true,
		'fit_height' => true,
		'fit_height_percent' => 100,
		'fit_height_offset' => '',
		'no_of_items' => 2,
		'height' => '',
		'content_max_width' => '',
		'title_uppercase' => 0,
		'title_letter_spacing' => '',
		'title_font' => 'secondary',
		'topsubtitle_font' => 'primary',
		'subtitle_font' => 'primary',
		'fade' => false,
		'adaptive_height' => false,
		'loop' => false,
		'autoplay' => false,
		'play_on_hover' => false,
		'autoplay_speed' => 5000
	);
	$opts = fabrique_item_options( $defaults, $opts, array( 'padding' ) );
	$opts['content_style'] = fabrique_get_spacing_style( $opts, 'padding' );
	$opts['inner_class'] = '';
	$opts['is_header'] = false;

	if ( !empty( $opts['name'] ) ) {
		$opts['id'][] = 'slider-' . $opts['name'];
	}

	if ( isset( $opts['role'] ) && 'header' === $opts['role'] ) {
		$opts['is_header'] = true;
		$opts['class'][] = 'fbq-content-header js-dynamic-navbar';
		$opts['data_attr']['role'] = $opts['role'];

		if ( !$opts['full_width'] ) {
			$opts['inner_class'] = 'fbq-container';
		}
	}

	if ( !in_array( 'navigation', $opts['components'] ) ) {
		$opts['data_attr']['arrows'] = 'false';
	}

	if ( in_array( 'indicator', $opts['components'] ) ) {
		$opts['data_attr']['indicator'] = 'true';
	}

	$opts['data_attr']['loop'] = ( $opts['loop'] ) ? 'true' : 'false';

	if ( $opts['autoplay'] ) {
		$opts['data_attr']['duration'] = $opts['autoplay_speed'];
	}

	if ( $opts['play_on_hover'] ) {
		$opts['data_attr']['play_on_hover'] = 'true';
	}

	if ( $opts['fade'] ) {
		$opts['data_attr']['fade'] = 'true';
	}

	if ( $opts['adaptive_height'] ) {
		$opts['data_attr']['adaptive_height'] = 'true';
	}

	$opts['content_wrapper_style'] = array();
	$opts['content_wrapper_style']['max-width'] = is_numeric( $opts['content_max_width'] ) ? $opts['content_max_width'] .'px' : $opts['content_max_width'];

	$opts['title_style'] = array(
		'letter-spacing' => is_numeric( $opts['title_letter_spacing'] ) ? $opts['title_letter_spacing'] .'px' : $opts['title_letter_spacing'],
		'line-height' => $opts['title_line_height'],
		'text-transform' => $opts['title_uppercase'] ? 'uppercase' : ''
	);

	$opts['image'] = array();
	$opts['topsubtitle'] = array();
	$opts['subtitle'] = array();
	$opts['divider'] = array();
	$opts['firstbutton'] = array();
	$opts['secondbutton'] = array();
	$opts['video_background'] = array();
	$opts['item_attribute'] = array();
	$opts['divider_style'] = array();
	$item_style = array();

	if ( $opts['fit_height'] ) {
		$opts['class'][] = 'fbq-slider--fit-height';
		$opts['data_attr']['screen_percent'] = (int)$opts['fit_height_percent'];
		$item_style['height'] = (int)$opts['fit_height_percent'] . 'vh';

		if ( !empty( $opts['fit_height_offset'] ) ) {
			$opts['data_attr']['screen_offset'] = $opts['fit_height_offset'];
		}
	} else {
		$item_style['height'] = is_numeric( $opts['height'] ) ? $opts['height'] .'px' : $opts['height'];
	}

	foreach ( $opts['data'] as $index => $data ) {
		$opts['divider_style'][$index] = array();

		if ( isset( $data['divider_width'] ) ) {
			$opts['divider_style'][$index]['max-width'] = is_numeric( $data['divider_width'] ) ? $data['divider_width'] .'px' : $data['divider_width'];
		}

		$opts['image_on'][] = isset( $data['image_on'] ) ? $data['image_on'] : in_array( 'image', $data['components'] );
		$opts['topsubtitle_on'][] = isset( $data['topsubtitle_on'] ) ? $data['topsubtitle_on'] : in_array( 'topsubtitle', $data['components'] );
		$opts['title_on'][] = isset( $data['title_on'] ) ? $data['title_on'] : in_array( 'title', $data['components'] );
		$opts['subtitle_on'][] = isset( $data['subtitle_on'] ) ? $data['subtitle_on'] : in_array( 'subtitle', $data['components'] );
		$opts['divider_on'][] = isset( $data['divider_on'] ) ? $data['divider_on'] : in_array( 'divider', $data['components'] );
		$opts['firstbutton_on'][] = isset( $data['firstbutton_on'] ) ? $data['firstbutton_on'] : in_array( 'firstbutton', $data['components'] );
		$opts['secondbutton_on'][] = isset( $data['secondbutton_on'] ) ? $data['secondbutton_on'] : in_array( 'secondbutton', $data['components'] );

		$item_class = array( 'fbq-slider-item' );
		$item_data_attr = array();
		$item_class[] = 'fbq-slider-item--' . $data['layout'];
		$item_class[] = 'fbq-' . $data['horizontal'] . '-align';

		if ( 'none' !== $data['content_animation'] ) {
			$item_class[] = 'with-animation';
			$item_class[] = 'fbq-slider-item--' . $data['content_animation'];
		}

		if ( 'default' !== $data['color_scheme'] ) {
			$item_class[] = 'fbq-slider-' . $data['color_scheme'] . '-scheme';
			$item_data_attr['scheme'] = $data['color_scheme'];

			// Set element initial class scheme as same as first slide
			if ( 0 == $index ) {
				$opts['class'][] = 'fbq-slider-' . $data['color_scheme'] . '-scheme';
				$opts['data_attr']['scheme'] = $data['color_scheme'];
			}
		}

		$opts['item_attribute'][] = array(
			'class' => $item_class,
			'style_attr' => $item_style,
			'data_attr' => $item_data_attr
		);
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_social_options' ) ) :
function fabrique_item_social_options( $opts )
{
	$defaults = array(
		'style' => 'plain',
		'icon_hover_style' => 'fill',
		'auto_color' => true,
		'icon_color' => 'default',
		'icon_hover_color' => 'default',
		'icon_size' => 'small',
		'components' => array( 'facebook', 'twitter', 'instagram', 'youtube' ),
		'alignment' => 'center'
	);

	$opts = fabrique_item_options( $defaults, $opts );
	$opts['icon_style'] = $opts['style'];
	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_space_options' ) ) :
function fabrique_item_space_options( $opts )
{
	$defaults = array(
		'height' => 20
	);
	$opts = fabrique_item_options( $defaults, $opts );
	$opts['style_attr']['height'] = $opts['height'] .'px';

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_tab_options' ) ) :
function fabrique_item_tab_options( $opts )
{
	$defaults = array(
		'style' => 'plain',
		'data' => array(),
		'spaces' => array(),
		'components' => array(),
		'name' => '',
		'no_of_items' => 2,
		'tab_position' => 'top',
		'height' => 'auto',
		'side_padding' => '',
		'tab_background_color' => 'default',
		'alignment' => 'left',
		'background_id' => '',
		'background_url' => '',
		'background_color' => 'default',
		'background_opacity' => 90,
		'background_size' => 'cover',
		'background_position' => 'center center',
		'background_repeat' => 'repeat'
	);
	$opts = fabrique_item_options( $defaults, $opts, array( 'padding' ) );
	$opts['media_on'] = isset( $opts['media_on'] ) ? $opts['media_on'] : in_array( 'media', $opts['components'] );

	$opts['class'][] = 'fbq-tab--'. $opts['tab_position'];
	$opts['nav_attr'] = array(
		'class' => array( 'fbq-tab-nav' ),
		'style_attr' => array()
	);
	$opts['nav_list_attr'] = array(
		'class' => array( 'fbq-tab-nav-list' ),
		'style_attr' => array()
	);
	$opts['content_class'] = 'fbq-tab-content';
	$opts['body_class'] = 'fbq-tab-body';
	$opts['body_style'] = fabrique_get_spacing_style( $opts, 'padding' );

	if ( 'default' !== $opts['tab_background_color'] && 'transparent' !== $opts['tab_background_color'] ) {
		$opts['nav_attr']['style_attr']['color'] = fabrique_contrast_color( $opts['tab_background_color'] );
		$opts['nav_attr']['style_attr']['background-color'] = fabrique_c( $opts['tab_background_color'] );
		$opts['nav_attr']['class'][] = 'with-background';
	}

	$opts['body_style']['min-height'] = is_numeric( $opts['height'] ) ? $opts['height'] .'px' : $opts['height'];

	if ( 'transparent' !== $opts['background_color'] && 'default' !== $opts['background_color'] || !empty( $opts['background_id'] ) || !empty( $opts['background_url'] ) ) {
		$opts['body_class'] .= ' with-background';
	}

	if ( 'underline' === $opts['style'] ) {
		$opts['nav_attr']['class'][] = 'fbq-p-border-border fbq-s-text-color';
	} elseif ( 'fullwidth' === $opts['style'] ) {
		$opts['nav_attr']['class'][] = 'fbq-s-bg-bg fbq-p-brand-color';
		$opts['nav_list_attr']['class'][] = 'fbq-p-bg-border';
		if ( 'top' === $opts['tab_position'] ) {
			$opts['nav_list_attr']['style_attr']['width'] = 100/(int)$opts['no_of_items'] . '%';
			$side_padding = is_numeric( $opts['side_padding'] ) ? $opts['side_padding'] .'px' : $opts['side_padding'];
			$opts['nav_attr']['style_attr']['padding-left'] = $side_padding;
			$opts['nav_attr']['style_attr']['padding-right'] = $side_padding;
		}
	}

	if ( !empty( $opts['name'] ) ) {
		$opts['id'][] = 'tab-' . $opts['name'];
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_table_options' ) ) :
function fabrique_item_table_options( $opts )
{
	$defaults = array(
		'data' => array(),
		'style' => 'minimal',
		'no_of_columns' => 2,
		'no_of_rows' => 5,
		'column_widths' => array( 30, 70 ),
		'header_row' => true,
		'main_color' => 'default',
		'body_background_color' => 'default',
		'alternate_row' => 'default',
		'column_border' => 'default',
		'alignment' => 'left',
		'data_header' => array( 'Item', 'Specification' )
	);
	$opts = fabrique_item_options( $defaults, $opts );

	$opts['formatted'] = fabrique_get_row_items( $opts['data'], $opts['no_of_columns'] );
	$opts['header_class'] = array();
	$opts['header_style'] = array();
	$opts['th_style'] = array();
	$opts['tr_class'] = array();
	$opts['tr_style'] = array();
	$opts['td_style'] = array();
	$opts['body_style'] = array();

	$main_color = fabrique_c( $opts['main_color'] );
	$border_color = fabrique_c( $opts['column_border'] );

	if ( 'minimal' === $opts['style'] ) {
		$opts['header_class'][] = 'fbq-p-brand-border';
		$opts['header_style']['border-color'] = $main_color;
	} elseif ( 'standard' === $opts['style'] ) {
		$opts['header_class'][] = 'fbq-p-brand-contrast-color fbq-p-brand-bg';
		$opts['header_style']['background-color'] = $main_color;
	}

	if ( 'transparent' !== $opts['column_border'] && 'default' !== $opts['column_border'] ) {
		$opts['th_style']['border-left-width'] = '1px';
		$opts['th_style']['border-left-style'] = 'solid';
		$opts['th_style']['border-left-color'] = $border_color;
		$opts['th_style']['border-right-width'] = '1px';
		$opts['th_style']['border-right-style'] = 'solid';
		$opts['th_style']['border-right-color'] = $border_color;
	}

	if ( ('transparent' === $opts['body_background_color'] || 'default' === $opts['body_background_color'] ) && 'transparent' === $opts['alternate_row'] ) {
		$opts['class'][] = 'without-background';
	}

	$opts['body_style']['background-color'] = fabrique_c( $opts['body_background_color'] );
	$opts['body_style']['border-color'] = $main_color;

	for ( $index = 0; $index < $opts['no_of_rows']; $index++ ) {
		$tr_style = array();
		$opts['tr_class'][$index] = '';

		if ( 0 != $index % 2 ) {
			$opts['tr_class'][$index] .= 'fbq-s-bg-bg';

			if ( 'default' !== $opts['alternate_row'] ) {
				$tr_style['background-color'] = fabrique_c( $opts['alternate_row'] );
			}
		}

		$opts['tr_style'][] = $tr_style;
	}

	for ( $index = 0; $index < $opts['no_of_columns']; $index++ ) {
		$td_style = $opts['th_style'];
		$td_style['width'] = $opts['column_widths'][$index] .'%';

		$opts['td_style'][] = $td_style;
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_team_options' ) ) :
function fabrique_item_team_options( $opts )
{
	$defaults = array(
		'style' => 'box',
		'alignment' => 'center',
		'inner_spacing' => 30,
		'border_thickness' => 0,
		'border_color' => 'default',
		'mouseover_effect' => 'fade',
		'name_font' => 'secondary',
		'title_font' => 'primary',
		'socials' => array(),
		'social_style' => 'border',
		'social_hover' => 'fill',
		'social_auto_color' => true,
		'social_color' => 'default',
		'social_hover_color' => 'default',
		'background_color' => 'default',
		'background_opacity' => 100,
		'components' => array( 'description', 'social' ),
		'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
		'name' => 'John Appleseed',
		'title' => 'Creative Director',
		'image_id' => '',
		'image_url' => '',
		'image_circle' => false,
		'image_link' => '',
		'image_size' => 'large',
		'image_max_width' => '',
		'image_popup' => false,
		'image_caption' => false,
		'media_target_self' => false,
	);
	$opts = fabrique_item_options( $defaults, $opts );

	$opts['description_on'] = isset( $opts['description_on'] ) ? $opts['description_on'] : in_array( 'description', $opts['components'] );
	$opts['social_on'] = isset( $opts['social_on'] ) ? $opts['social_on'] : in_array( 'social', $opts['components'] );
	$opts['body_class'] = array();
	$opts['hover_style'] = array();
	$opts['body_style'] = array();
	$opts['content_style'] = array();

	$initial_style = array();
	$initial_style['background-color'] = fabrique_hex_to_rgba( $opts['background_color'], $opts['background_opacity']/100 );

	if ( 0 < $opts['border_thickness'] ) {
		$initial_style['border-width'] = $opts['border_thickness'] .'px';
		$initial_style['border-style'] = 'solid';
		$initial_style['border-color'] = fabrique_c( $opts['border_color'] );
	}

	if ( 0 < $opts['inner_spacing'] ) {
		$opts['body_style']['padding'] = $opts['inner_spacing'] .'px';
	}

	if ( 'box' === $opts['style'] ) {
		$opts['class'][] = 'fbq-s-bg-bg fbq-p-border-border';
		$opts['style_attr'] = array_merge( $opts['style_attr'], $initial_style );
	} elseif ( 'hover' === $opts['style'] ) {
		$opts['body_style'] = array();
		$opts['class'][] = 'fbq-team--' . $opts['mouseover_effect'];
		$opts['hover_style'] = $initial_style;

		if ( 0 < $opts['inner_spacing'] ) {
			$opts['content_style']['padding'] = $opts['inner_spacing'] .'px';
		}
	}

	if ( $opts['image_circle'] && 'false' !== $opts['image_circle'] ) {
		$opts['class'][] = 'fbq-team--circle';
	}

	$opts['social_args'] = array(
		'icon_style' => $opts['social_style'],
		'icon_hover_style' => $opts['social_hover'],
		'auto_color' => $opts['social_auto_color'],
		'icon_color' => $opts['social_color'],
		'icon_hover_color' => $opts['social_hover_color'],
		'components' => array_keys( $opts['socials'] ),
		'socials' => $opts['socials']
	);

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_testimonial_options' ) ) :
function fabrique_item_testimonial_options( $opts )
{
	$defaults = array(
		'data' => array(),
		'avatar_position' => 'left',
		'components' => array( 'author', 'avatar', 'title' ),
		'border_thickness' => 1,
		'border_color' => 'default',
		'background_color' => 'default',
		'background_opacity' => 100,
		'boxshadow' => '',
		'text_font' => 'secondary',
		'carousel' => false,
		'loop' => false,
		'fade' => false,
		'adaptive_height' => false,
		'navigation' => false,
		'indicator' => false,
		'no_of_items' => 3,
		'autoplay' => false,
		'autoplay_speed' => 5000
	);
	$opts = fabrique_item_options( $defaults, $opts, array( 'padding' ) );
	$opts['item_style'] = array();
	$opts['inner_style'] = fabrique_get_spacing_style( $opts, 'padding' );
	$opts['avatar_on'] = isset( $opts['avatar_on'] ) ? $opts['avatar_on'] : in_array( 'avatar', $opts['components'] );
	$opts['title_on'] = isset( $opts['title_on'] ) ? $opts['title_on'] : in_array( 'title', $opts['components'] );
	$opts['author_on'] = isset( $opts['author_on'] ) ? $opts['author_on'] : in_array( 'author', $opts['components'] );
	$opts['class'][] = 'fbq-testimonial--' . $opts['avatar_position'];

	if ( $opts['avatar_on'] ) {
		$opts['class'][] = 'with-avatar';
	}

	if ( $opts['carousel'] ) {
		$opts['class'][] = 'fbq-testimonial--carousel';
		$opts['no_of_data'] = $opts['no_of_items'];
		$opts['data_attr']['arrows'] = ( $opts['navigation'] ) ? 'true' : 'false';
		$opts['data_attr']['indicator'] = ( $opts['indicator'] ) ? 'true' : 'false';
		$opts['data_attr']['loop'] = ( $opts['loop'] ) ? 'true' : 'false';

		if ( $opts['fade'] ) {
			$opts['data_attr']['fade'] = 'true';
		}

		if ( $opts['adaptive_height'] ) {
			$opts['data_attr']['adaptive_height'] = 'true';
		}

		if ( $opts['autoplay'] ) {
			$opts['data_attr']['duration'] = $opts['autoplay_speed'];
		}

	} else {
		$opts['no_of_data'] = 1;
	}

	if ( 'transparent' !== $opts['background_color'] && 0 != $opts['background_opacity'] ) {
		$opts['class'][] = 'with-background';
	}

	$background_color = fabrique_hex_to_rgba( $opts['background_color'], $opts['background_opacity']/100 );
	$opts['item_style']['background-color'] = $background_color;
	$opts['item_style']['box-shadow'] = $opts['boxshadow'];

	if ( 0 < $opts['border_thickness'] ) {
		$opts['item_style']['border-width'] = $opts['border_thickness'] .'px';
		$opts['item_style']['border-color'] = fabrique_c( $opts['border_color'] );
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_text_options' ) ) :
function fabrique_item_text_options( $opts )
{
	$defaults = array(
		'data' => array(),
		'no_of_items' => 1,
		'spacing' => 30,
		'bullet' => false,
		'bullet_style' => 'decimal',
		'uppercase' => false,
		'line_height' => '',
		'letter_spacing' => '',
		'text_indent' => '',
		'font_family' => 'primary',
		'alignment' => 'left',
	);
	$opts = fabrique_item_options( $defaults, $opts, array( 'animation' ) );
	$opts['class'][] = 'fbq-' . $opts['font_family'] . '-font';
	$opts['row_style'] = array();
	$opts['content_style'] = array(
		'line-height' => $opts['line_height'],
		'letter-spacing' => is_numeric( $opts['letter_spacing'] ) ? $opts['letter_spacing'] .'px' : $opts['letter_spacing'],
		'text-indent' => is_numeric( $opts['text_indent'] ) ? $opts['text_indent'] .'px' : $opts['text_indent']
	);

	if ( $opts['uppercase']  ) {
		$opts['content_style']['text-transform'] = 'uppercase';
	}

	$opts['row_style']['margin'] = '0 ' . -$opts['spacing'] . 'px';
	$opts['content_style']['padding'] = '0 ' . $opts['spacing'] . 'px';

	if ( 5 == $opts['no_of_items'] ) {
		$column_class = 'fbq-col-1-5';
	} else {
		$column_class = 'fbq-col-'. 12 / $opts['no_of_items'];
	}

	foreach ( $opts['data'] as $index => $data ) {
		$opts['item_class'][$index] = $column_class;

		if ( isset( $opts['animation'] ) && 'none' !== $opts['animation'] ) {
			$opts['item_class'][$index] .= ' anmt-item anmt-' . $opts['animation'];

			if ( isset( $opts['stagger'] ) && $opts['stagger'] ) {
				$opts['item_class'][$index] .= ' stagger';
			}
		}
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_video_options' ) ) :
function fabrique_item_video_options( $opts )
{
	$defaults = array(
		'style' => 'standard',
		'autoplay' => false,
		'loop' => false,
		'width' => 1280,
		'video_ratio' => '',
		'alignment' => 'center',
		'video_type' => 'self-hosted',
		'poster_url' => '',
		'poster_id' => '',
		'poster_size' => 'large',
		'poster_ratio' => 'auto',
		'video_url' => '',
		'external_url' => ''
	);
	$opts = fabrique_item_options( $defaults, $opts );
	$opts['data_attr'] = array( 'autoplay' => $opts['autoplay'] );

	$opts['inner_style'] = array();
	$opts['inner_style']['max-width'] = $opts['width'] .'px';

	$opts['content_style'] = array();
	if ( !empty( $opts['video_ratio'] ) ) {
		$ratio = explode( ':', $opts['video_ratio'] );

		if ( is_array( $ratio ) && ( count( $ratio ) == 2 ) ) {
			if ( is_numeric( $ratio[0] ) && is_numeric( $ratio[1] ) ) {
				$opts['content_style']['padding-bottom'] = $ratio[1]/$ratio[0]*100 . '%';
			}
		}
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_template_widgets_options' ) ) :
function fabrique_template_widgets_options( $opts )
{
	$defaults = array(
		'sidebar_id' => ''
	);

	$opts = fabrique_item_options( $defaults, $opts );
	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_wpcontent_options' ) ) :
function fabrique_item_wpcontent_options( $opts )
{
	$defaults = array();
	$opts = fabrique_item_options( $defaults, $opts );

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_meta_options' ) ) :
function fabrique_item_meta_options( $opts )
{
	$defaults = array(
		'style' => 'inline',
		'components' => array( 'title', 'icon' ),
		'no_of_items' => 4,
		'icon_color' => 'default',
		'title_color' => 'default',
		'detail_color' => 'default',
		'title_uppercase' => false,
		'title_letter_spacing' => '',
		'title_font' => 'secondary',
		'detail_uppercase' => false,
		'detail_letter_spacing' => '',
		'detail_font' => 'primary',
		'alignment' => 'left',
	);

	$opts = fabrique_item_options( $defaults, $opts );
	$opts['title_on'] = isset( $opts['title_on'] ) ? $opts['title_on'] : in_array( 'title', $opts['components'] );
	$opts['icon_on'] = isset( $opts['icon_on'] ) ? $opts['icon_on'] : in_array( 'icon', $opts['components'] );
	$opts['class'][] = 'fbq-s-text-color';

	$opts['icon_style'] = array(
		'color' => fabrique_c( $opts['icon_color'] )
	);
	$opts['title_style'] = array(
		'color' => fabrique_c( $opts['title_color'] ),
		'letter-spacing' => is_numeric( $opts['title_letter_spacing'] ) ? $opts['title_letter_spacing'] .'px' : $opts['title_letter_spacing'],
		'text-transform' => $opts['title_uppercase'] ? 'uppercase' : ''
	);
	$opts['detail_style'] = array(
		'color' => fabrique_c( $opts['detail_color'] ),
		'letter-spacing' => is_numeric( $opts['detail_letter_spacing'] ) ? $opts['detail_letter_spacing'] .'px' : $opts['detail_letter_spacing'],
		'text-transform' => $opts['detail_uppercase'] ? 'uppercase' : ''
	);

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_item_project_options' ) ) :
function fabrique_item_project_options( $opts )
{
	$opts['post_type'] = 'fbq_project';
	$opts['post_taxonomy'] = 'fbq_project_category';
	$opts['post_tag'] = 'fbq_project_tag';

	$opts = fabrique_item_entries_options( $opts );

	return $opts;
}
endif;
