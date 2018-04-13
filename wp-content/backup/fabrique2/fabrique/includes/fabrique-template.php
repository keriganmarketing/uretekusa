<?php

function fabrique_template( $template_path, $args = array(), $options = array() )
{
	global $fabrique_core;

	$template = str_replace( '.php', '', $template_path );

	$fabrique_core->set_template_args( $template, $args );
	get_template_part( 'templates/' . $template );
}


function fabrique_template_partial( $template_path, $args = array(), $options = array() )
{
	global $fabrique_core;

	$template = str_replace( '.php', '', $template_path );

	$fabrique_core->set_template_args( $template, $args );
	get_template_part( 'templates/partials/' . $template );
}


function fabrique_template_args( $template )
{
	global $fabrique_core;
	return $fabrique_core->get_template_args( $template );
}


function fabrique_template_style_custom( $values = array() )
{
	$values = apply_filters( 'fabrique_customize_values', $values );

	ob_start();
	fabrique_template( 'style-custom', $values );
	$output = ob_get_clean();

	return $output;
}


function fabrique_template_item( $item )
{
	$type = str_replace( 'fbq-', '', $item['type'] );

	if ( get_template_directory() ) {
		$template = apply_filters( 'fabrique_template_item', $type, $item );
		$template_name = 'items/' . $template;

		fabrique_template( $template_name , $item, array( 'item_element' => true, 'item_type' => $type ) );
	} else {
		do_action( 'fabrique_template_item_' . $type );
	}
}


function fabrique_filter_section_content( $section )
{
	if ( isset( $section['type'] ) && 'blueprintblock' === $section['type']
	&& isset( $section['blueprintblock_id'] ) && !empty( $section['blueprintblock_id'] ) ) {
		$blueprint_block_content = get_post_meta( $section['blueprintblock_id'], 'bp_data', true );
		if ( !empty( $blueprint_block_content ) && 'publish' === get_post_status( $section['blueprintblock_id'] ) ) {
			$filtered_section = $blueprint_block_content['sections'];
		} else {
			$filtered_section = array( $section );
		}
	} else {
		$filtered_section = array( $section );
	}

	return $filtered_section;
}


function fabrique_template_blueprint_page_title( $builder )
{
	if ( isset( $builder['header'] ) ) {
		$header_type = $builder['header'];
	} else {
		$header_type = fabrique_mod( 'page_title' ) ? 'title' : 'none';
	}

	if ( 'none' === $header_type ) {
		return;
	} else if ( 'blueprintblock' === $header_type ) {
		$bp_block = $builder['blueprintblock'];
		if ( isset( $bp_block['blueprintblock_id'] ) && !empty( $bp_block['blueprintblock_id'] ) ) {
			$blueprint_block_content = get_post_meta( $bp_block['blueprintblock_id'], 'bp_data', true );
			if ( !empty( $blueprint_block_content ) && 'publish' === get_post_status( $bp_block['blueprintblock_id'] ) ) {
				$section = $blueprint_block_content['sections'];
				foreach ( $section as $s_index => $section_content ) {
					$section_args = array(
						'section' => $section_content,
						'index' => $s_index
					);
					fabrique_template( 'section-content.php', $section_args );
				}
			}
		}
	} else if ( in_array( $header_type, array( 'title', 'hero' ) ) ) {
		fabrique_template( 'page-' . $header_type . '.php', $builder[$header_type] );
	} else {
		fabrique_template_item( $builder[$header_type] );
	}
}


function fabrique_main_page_class( $sidebar = false, $sidebar_position = 'right', $sidebar_background = 'default' )
{
	$classes = array( 'fbq-main' );

	if ( $sidebar ) {
		$classes[] = ( 'right' === $sidebar_position ) ? 'fbq-left' : 'fbq-right';
		$default_sidbar_bg = fabrique_mod( 'sidebar_background_color' );

		if ( ( 'default' === $sidebar_background && 'transparent' === $default_sidbar_bg ) || 'transparent' === $sidebar_background ) {
			$classes[] = 'without-sidebar-bg';
		}
	} else {
		$classes[] = 'fbq-main--single';
	}

	return apply_filters( 'fabrique_main_page_class', implode( ' ', $classes ) );
}


function fabrique_sidebar_class( $sidebar_position = 'right', $sidebar_fixed = false, $color_scheme = '' )
{
	$classes = array( 'fbq-sidebar' );
	$classes[] = 'fbq-' . $sidebar_position;

	if ( $sidebar_fixed ) {
		$classes[] = 'fbq-sidebar--fixed';
	}

	// Sidebar-style 'custom' or 'default'
	if ( empty( $color_scheme ) || 'default' === $color_scheme ) {
		$classes[] = 'fbq-sidebar--default';

		$sidebar_color_scheme = fabrique_mod( 'sidebar_color_scheme' );

		if ( !empty( $sidebar_color_scheme ) && 'default' !== $sidebar_color_scheme  )  {
			$classes[] = 'fbq-' . $sidebar_color_scheme . '-scheme';
		}
	} else {
		$classes[] = 'fbq-sidebar--custom';
		$classes[] = 'fbq-' . $color_scheme . '-scheme';
	}

	return apply_filters( 'fabrique_sidebar_class', implode( ' ', $classes ) );
}


if ( !function_exists( 'fabrique_template_preload' ) ) :
function fabrique_template_preload( $style = 'wave', $logo = '' )
{
	$output = '<div class="fbq-loading fbq-loading--' . esc_attr( $style ) . ' fbq-p-border-border">';

	switch ( $style ) {
		case 'fading-circle' :
			for ( $i = 1; $i <= 12; $i++ ) {
				$output .= '<div class="fbq-circle fbq-circle--' . esc_attr( $i ) . '"></div>';
			}
			break;
		case 'double-bounce' :
			$output .= '<div class="fbq-bounce fbq-p-brand-bg fbq-bounce--1"></div>';
			$output .= '<div class="fbq-bounce fbq-p-brand-bg fbq-bounce--2"></div>';
			break;
		case 'three-bounce' :
			for ( $i = 1; $i <= 3; $i++ ) {
				$output .= '<div class="fbq-bounce fbq-p-brand-bg fbq-bounce--' . esc_attr( $i ) . '"></div>';
			}
			break;
		case 'ring' :
			break;
		case 'ripple' :
			$output .= '<div class="fbq-ring fbq-p-brand-border"></div>';
			break;
		case 'logo' :
			$logo = ( !empty( $logo ) ) ? $logo : fabrique_mod( 'logo' );
			$output .= '<img src="' . esc_url( $logo ) . '" alt="' . esc_attr__( 'logo', 'fabrique' ) . '" />';
			break;
		case 'fade-logo' :
			$logo = ( !empty( $logo ) ) ? $logo : fabrique_mod( 'logo' );
			$output .= '<img src="' . esc_url( $logo ) . '" alt="' . esc_attr__( 'logo', 'fabrique' ) . '" />';
			break;
		default :
			for ( $i = 1; $i <= 5; $i++ ) {
				$output .= '<div class="fbq-rect fbq-p-brand-bg fbq-rect--' . esc_attr( $i ) . '"></div>';
			}
	}

	$output .= '</div>';

	return $output;
}
endif;


if ( !function_exists( 'fabrique_template_pagination' ) ) :
function fabrique_template_pagination( $query, $opts = array() )
{
	if ( !$query )
		return;

	if ( !is_array( $query ) ) {
		$opts['all_posts'] = $query->found_posts;
		$max_num_page = $query->max_num_pages;
	} else {
		$opts['all_posts'] = isset( $query['all_posts'] ) ? $query['all_posts'] : 12;
		$max_num_page = isset( $query['max_num_page'] ) ? $query['max_num_page'] : 0;
	}

	if ( $max_num_page <= 1 )
		return;

	$big = 999999999;
	$current_page = ( isset( $opts['query_args'] ) && isset( $opts['query_args']['paged'] ) ) ? $opts['query_args']['paged'] : 1;
	$opts['pagination_style'] = isset( $opts['pagination_style'] ) ? $opts['pagination_style'] : 'pagination';

	if ( !is_single() ) {
		$base = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );
		$format = '?paged=%#%';
	} else {
		$base = esc_url( get_permalink() ) . '%#%';
		$format = '%#%';
	}

	if ( 'pagination' === $opts['pagination_style'] ) {
		$opts['pagination_class'] = 'fbq-pagination fbq-pagination--standard fbq-s-bg-bg fbq-secondary-font';
		$opts['pagination_link_args'] = array(
			'base'			=> $base,
			'format'		=> $format,
			'current'		=> max( 1, $current_page ),
			'total' 		=> $max_num_page,
			'type' 			=> 'list',
			'prev_text'	=> '<span class="twf twf-arrow-bold-left"></span><span class="pagination-button-label">' . esc_html__( 'PREV', 'fabrique' ) . '</span>',
			'next_text'	=> '<span class="pagination-button-label">' . esc_html__( 'NEXT', 'fabrique' ) . '</span><span class="twf twf-arrow-bold-right"></span>',
		);
	} else {
		$opts['pagination_class'] = 'js-load-more fbq-pagination fbq-pagination--' . esc_attr( $opts['pagination_style'] ) . ' fbq-button fbq-button-size--medium fbq-button--full';
		$opts['pagination_link_args'] = array();
		unset( $opts['query'] );
	}

	fabrique_template_partial( 'pagination', $opts );
}
endif;


if ( !function_exists( 'fabrique_template_filter' ) ) :
function fabrique_template_filter( $filter_query, $opts )
{
	$defaults = array(
		'filter_taxonomy' => 'category',
		'filter_sorting' => 'default',
		'filter_alignment' => 'left',
		'filter_initial' => 'all',
		'filter_disable_all' => false
	);

	$opts = array_merge( $defaults, $opts );
	if ( !$filter_query ) {
		global $wp_query;
		$query = $wp_query;
	} else {
		$query = $filter_query;
	}

	$names = array();
	$slugs = array();
	if ( $query->have_posts() ) {
		while( $query->have_posts() ) {
			$query->the_post();
			$categories = fabrique_get_taxonomy( $opts['filter_taxonomy'] );
			if ( $categories && !is_wp_error( $categories ) ) {
				$term_names = fabrique_term_names( $categories );

				foreach ( $term_names['name'] as $index => $term_name ) {
					$names[] = esc_attr( $term_name );
					$slugs[$term_name] = $term_names['slug'][$index];
				}
			}
		}

		wp_reset_postdata();
	}

	$opts['categories'] = array_unique( $names );
	$opts['categories_slug'] = $slugs;
	if ( 'char_asc' === $opts['filter_sorting'] ) {
		natcasesort( $opts['categories'] );
	} elseif ( 'char_desc' === $opts['filter_sorting'] ) {
		natcasesort( $opts['categories'] );
		$opts['categories'] = array_reverse( $opts['categories'] );
	} elseif ( 'custom_order' === $opts['filter_sorting'] ) {
		$ref_categories = get_terms( $opts['filter_taxonomy'], array( 'hide_empty' => false, 'fields' => 'id=>name' ) );
		$ref_categories = ( $ref_categories ) ? $ref_categories : array();
		$opts['categories'] = array_intersect( $ref_categories, $opts['categories'] );
	}

	$opts['base_class'] = 'js-filter-list fbq-p-text-color';

	return fabrique_template_partial( 'filter', $opts );
}
endif;


if ( !function_exists( 'fabrique_template_share' ) ) :
function fabrique_template_share( $opts )
{
	$defaults = array(
		'components' => fabrique_mod( 'social_share_component' ),
		'style' => 'button',
		'size' => '',
		'counter' => false,
		'divider' => false,
		'auto_color' => true,
		'color' => 'default',
		'icon_hover_color' => 'default',
		'icon_style' => 'plain',
		'icon_hover_style' => 'none',
		'page_title' => urlencode( html_entity_decode( get_the_title(), ENT_COMPAT, 'UTF-8' ) ),
		'share_url' => get_permalink(),
		'mail_title' => esc_html__( 'Site Sharing', 'fabrique' ),
		'mail_body' => esc_html__( 'Check out this site', 'fabrique' )
	);

	$opts = array_merge( $defaults, $opts );
	do_action( 'fabrique_global_share_options', $opts );
	$opts['social_share'] = array(
		'facebook'  => array(
			'label' => 'Facebook',
			'link'  => 'http://www.facebook.com/share.php?u=' . $opts['share_url'] . '&title=' . $opts['page_title']
		),
		'twitter'   => array(
			'label' => 'Twitter',
			'link'  => 'http://twitter.com/intent/tweet?text=' . $opts['page_title'] . '+' . $opts['share_url']
		),
		'pinterest' => array(
			'label' => 'Pinterest',
			'link'  => 'http://pinterest.com/pin/create/button/?url=' . $opts['share_url']
		),
		'google-plus' => array(
			'label' => 'Google+',
			'link'  => 'https://plus.google.com/share?url=' . $opts['share_url']
		),
		'email'     => array(
			'label' => 'Email',
			'link'  => "mailto:?subject={$opts['mail_title']}&amp;body={$opts['mail_body']}-{$opts['share_url']}"
		),
		'tumblr'    => array(
			'label' => 'Tumblr',
			'link'  => 'http://www.tumblr.com/share/link?url=' . $opts['share_url'] . '&name=' . $opts['page_title']
		),
		'linkedin'  => array(
			'label' => 'Linkedin',
			'link'  => 'http://www.linkedin.com/shareArticle?mini=true&url=' . $opts['share_url'] . '&title=' . $opts['page_title']
		),
		'stumbleupon'  => array(
			'label' => 'StumbleUpon',
			'link'  => 'http://www.stumbleupon.com/submit?url=' . $opts['share_url'] . '&title=' . $opts['page_title']
		)
	);

	if ( has_post_thumbnail() ) {
		$opts['social_share']['pinterest']['link'] .= '&media=' . wp_get_attachment_url( get_post_thumbnail_id() );
	}
	$opts['social_share']['pinterest']['link'] .= '&description=' . $opts['page_title'];

	$opts['share_attr'] = array(
		'class' => array( 'fbq-social-share', 'fbq-social-share--' . $opts['style'] ),
		'style_attr' => !empty( $opts['size'] ) ? array( 'font-size' => $opts['size'] .'px' ) : array()
	);
	if ( $opts['divider'] ) {
		$opts['share_attr']['class'][] = 'with-divider';
	}

	$opts['item_class'] = array( 'fbq-p-border-border', 'fbq-share-item' );
	$opts['link_attr'] = array(
		'class' => array( 'js-share' ),
		'style_attr' => array()
	);

	if ( 'icon' === $opts['style'] ) {
		$opts['icon_args'] = array(
			'icon_style' => $opts['icon_style'],
			'icon_hover_style' => $opts['icon_hover_style']
		);
	} elseif ( 'button' === $opts['style'] ) {
		$opts['item_class'][] = 'fbq-p-brand-contrast-color';
		$opts['link_attr']['class'][] = 'btnx';
		$opts['link_attr']['class'][] = 'fbq-p-brand-bg';
		$opts['icon_args'] = array( 'icon_style' => 'default' );
	} elseif ( 'box' === $opts['style'] ) {
		$opts['link_attr']['class'][] = 'box';
	}

	if ( $opts['auto_color'] ) {
		$opts['link_attr']['class'][] = 'fbq-social-item--color';
	} else {
		if ('minimal' === $opts['style'] ) {
			$opts['link_attr']['style_attr']['color'] = fabrique_c( $opts['color'] );
		} elseif ( 'icon' === $opts['style'] ) {
			$opts['icon_args']['icon_color'] = $opts['color'];
			$opts['icon_args']['icon_hover_color'] = $opts['icon_hover_color'];
		} else {
			$opts['link_attr']['style_attr']['background-color'] = fabrique_c( $opts['color'] );
			$opts['link_attr']['style_attr']['color'] = fabrique_contrast_color( $opts['color'] );
		}
	}

	return fabrique_template_partial( 'social-share', $opts );
}
endif;


if ( !function_exists( 'fabrique_template_comment_list' ) ) :
function fabrique_template_comment_list( $comment, $args, $depth ) {
	global $comment;

	$opts = array();
	$opts['comment'] = $comment;
	$opts['comment_open'] = comments_open();
	$opts['edit_comment_link'] = get_edit_comment_link();
	$opts['comment_reply_args'] = array(
		'reply_text' => esc_html__( 'Reply', 'fabrique' ),
		'depth' => $depth,
		'max_depth' => $args['max_depth']
	);

	fabrique_template_partial( 'comment-list', $opts );
}
endif;


// Buffering minicart code use in navbar
function fabrique_template_mini_cart()
{
	ob_start();
	woocommerce_mini_cart();
	$var = ob_get_contents();
	ob_end_clean();

	return $var;
}


if ( !function_exists( 'fabrique_template_button' ) ) :
function fabrique_template_button( $opts, $property = 'button' )
{
	$defaults = array(
		$property . '_id' => '',
		$property . '_extra_class' => '',
		$property . '_style_attr' => array(),
		$property . '_link_extra_class' => '',
		$property . '_style' => fabrique_mod( 'button_style' ),
		$property . '_hover' => fabrique_mod( 'button_hover_style' ),
		$property . '_size' => fabrique_mod( 'button_size' ),
		$property . '_color' => 'brand',
		$property . '_thickness' => 1,
		$property . '_radius' => 0,
		$property . '_icon' => '',
		$property . '_icon_position' => 'before',
		$property . '_label' => 'Button',
		$property . '_link' => '',
		$property . '_target_self' => false,
		$property . '_full_width' => false,
		$property . '_inline' => false,
		$property . '_hover_label' => '',
	);
	$opts = array_merge( $defaults, $opts );
	$button_class = array( 'fbq-button' );
	$button_class[] = !empty( $opts[$property . '_style'] ) ? 'fbq-button--' . esc_attr( $opts[$property . '_style'] ) : 'fbq-button--fill';
	$button_class[] = !empty( $opts[$property . '_hover'] ) ? 'fbq-button-hover--' . esc_attr( $opts[$property . '_hover'] ) : 'fbq-button-hover--brand';
	$button_class[] = !empty( $opts[$property . '_size'] ) ? 'fbq-button-size--' . esc_attr( $opts[$property . '_size'] ) : 'fbq-button-size--small';
	$button_class[] = !empty( $opts[$property . '_color'] ) ? 'fbq-button-color--' . esc_attr( $opts[$property . '_color'] ) : 'fbq-button-color--brand';

	if ( $opts[$property . '_full_width'] && 'false' !== $opts[$property . '_full_width'] ) {
		$button_class[] = 'fbq-button--full';
	}

	if ( $opts[$property . '_inline'] && 'false' !== $opts[$property . '_inline'] ) {
		$button_class[] = 'fbq-button--inline';
	}

	if ( is_array( $opts[$property . '_extra_class'] ) ) {
		$button_class = array_unique( array_merge( $button_class, $opts[$property . '_extra_class'] ) );
	} elseif ( !empty( $opts[$property . '_extra_class'] ) ) {
		$button_class[] = $opts[$property . '_extra_class'];
	}

	$opts['button_attr'] = array(
		'class' => $button_class,
		'id' => $opts[$property . '_id'],
		'style_attr' => $opts[$property . '_style_attr'],
		'data_attr' => array(
			'style' => $opts[$property . '_style']
		)
	);

	$opts['btnx_attr'] = array(
		'class' => array( 'btnx', $opts[$property . '_link_extra_class'] ),
		'style_attr' => array(
			'border-radius' => (int)$opts[$property . '_radius'] . 'px',
			'border-width' => (int)$opts[$property . '_thickness'] . 'px'
		)
	);

	if ( !empty( $opts[$property . '_hover_label'] ) ) {
		$opts['btnx_attr']['data_attr'] = array( 'hoverlabel' => $opts[$property . '_hover_label'] );
	}

	$opts['button_link'] = $opts[$property . '_link'];
	if ( '#' !== substr( $opts[$property . '_link'], 0 , 1 ) && ( !$opts[$property . '_target_self'] || 'false' === $opts[$property . '_target_self'] ) ) {
		$opts['link_target'] = '_blank';
	} else {
		$opts['link_target'] = '_self';
	}
	$opts['icon_position'] = $opts[$property . '_icon_position'];
	$opts['icon'] = $opts[$property . '_icon'];
	$opts['label'] = $opts[$property . '_label'];

	return fabrique_template_partial( 'button', $opts );
}
endif;


if ( !function_exists( 'fabrique_template_icon' ) ) :
function fabrique_template_icon( $args = array() )
{
	$defaults = array(
		'icon' => '',
		'icon_inline' => false,
		'icon_style' => 'plain',
		'icon_hover_style' => 'none',
		'icon_size' => '',
		'default_color' => false, // use primary text color instead of brand color
		'auto_color' => false, // for social icon auto color
		'icon_color' => 'default',
		'icon_hover_color' => 'default',
		'extra_class' => ''
	);
	$args = array_merge( $defaults, $args );

	if ( empty( $args['icon'] ) ) return;

	$output = '';
	$icon_class = array( 'fbq-icon', 'fbq-icon--' . $args['icon_style'] );

	if ( !empty( $args['extra_class'] ) ) {
		$icon_class[] = $args['extra_class'];
	}

	if ( !empty( $args['icon_size'] ) ) {
		$icon_class[] = 'fbq-icon--' . $args['icon_size'];
	}

	$has_hover = ( 'none' !== $args['icon_hover_style'] ) ? true : false;

	if ( $has_hover ) {
		$icon_class[] = 'fbq-icon--with-hover';
		$icon_class[] = 'fbq-icon--hover-' . $args['icon_hover_style'];
	} else {
		$icon_class[] = 'fbq-icon--without-hover';
	}

	if ( $args['icon_inline'] ) {
		$icon_class[] = 'fbq-icon--inline';
	}

	$normal_style_attr = array();
	$hover_style_attr = array();

	if ( !$args['auto_color'] ) {
		$color = fabrique_c( $args['icon_color'] );
		if ( 'fill' === $args['icon_style'] or 'fill-square' === $args['icon_style'] ) {
			$normal_style_attr['background-color'] = $color;
			$normal_style_attr['color'] = fabrique_contrast_color( $color );
		} else {
			$normal_style_attr['color'] = $color;
		}

		$hover_color = fabrique_c( $args['icon_hover_color'] );
		if ( 'fill' === $args['icon_hover_style'] or 'fill-square' === $args['icon_hover_style'] ) {
			$hover_style_attr['background-color'] = $hover_color;
			$hover_style_attr['color'] = fabrique_contrast_color( $hover_color );
		} else {
			$hover_style_attr['color'] = $hover_color;
		}
	}

	$normal_class = array( 'fbq-icon-normal', 'fbq-icon-' . $args['icon_style'] );
	$hover_class = array( 'fbq-icon-hover', 'fbq-icon-' . $args['icon_hover_style'] );

	// if icon style is default then use color inherit from parent.
	if ( 'default' !== $args['icon_style'] ) {
		if ( 'fill' === $args['icon_style'] || 'fill-square' === $args['icon_style'] ) {
			$normal_class[] = ( !$args['default_color'] ) ? 'fbq-p-brand-bg fbq-p-brand-contrast-color' : 'fbq-p-text-bg fbq-p-text-contrast-color';
		} else {
			$normal_class[] = ( !$args['default_color'] ) ? 'fbq-p-brand-color' : 'fbq-p-text-color';
		}
	}

	$output .= '<span class="' . esc_attr( implode( ' ', $icon_class ) ) . '">';
	$output .=    '<span class="' . esc_attr( implode( ' ', $normal_class ) ) . '" ' . fabrique_s( $normal_style_attr ) . '>';
	$output .=        '<i class="twf twf-' . esc_attr( $args['icon'] ) . '"></i>';
	$output .=    '</span>';

	if ( $has_hover ) {
		if ( 'fill' === $args['icon_hover_style'] || 'fill-square' === $args['icon_hover_style'] ) {
			$hover_class[] = ( !$args['default_color'] ) ? 'fbq-s-brand-bg fbq-s-brand-contrast-color' : 'fbq-p-brand-bg fbq-p-brand-contrast-color';
		} else {
			$hover_class[] = ( !$args['default_color'] ) ? 'fbq-s-brand-color' : 'fbq-p-brand-color';
		}

		$output .=  '<span class="' . esc_attr( implode( ' ', $hover_class ) ) . '" ' . fabrique_s( $hover_style_attr ) . '>';
		$output .=      '<i class="twf twf-' . esc_attr( $args['icon'] ) . '"></i>';
		$output .=  '</span>';
	}

	$output .= '</span>';

	return $output;
}
endif;


if ( !function_exists( 'fabrique_template_external_media' ) ) :
function fabrique_template_external_media( $data = array() )
{
	// work with only external media which know the original size
	$defaults = array(
		'lazy_load'		=> true,
		'hover'			=> 'none',
		'circle'		=> false,
		'popup'			=> false,
		'url'			=> '',
		'link'			=> '',
		'width'			=> '',
		'height'		=> '',
		'title'			=> '',
		'alt'			=> '',
		'style_attr'	=> '',
		'wrapper_style' => ''
	);

	$data = array_merge( $defaults, $data );
	if ( empty( $data['url'] ) ) {
		return;
	}

	$output = '';
	$wrapper_attr = array(
		'class' => array( 'fbq-media-wrapper external' ),
		'style_attr' => $data['wrapper_style']
	);
	$image_attribute = '';
	$image_html = '';
	$attributes = array(
		'class'				=> 'fbq-media-wrapper-image',
		'width' 			=> $data['width'],
		'height'			=> $data['height'],
		'title'				=> $data['title'],
		'alt'				=> $data['alt'],
		'style'				=> $data['style_attr'],
		'data-full-width'	=> $data['width'],
		'data-full-height'	=> $data['height']
	);

	if ( $data['circle'] && 'false' !== $data['circle'] ) {
		$wrapper_attr['class'][] = 'image-circle';
	}

	if ( 'none' !== $data['hover'] ) {
		$wrapper_attr['class'][] = 'anmt-image-' . $data['hover'];
	}

	if ( !empty( $data['width'] ) && !empty( $data['height'] ) ) {
		$wrapper_attr['class'][] = 'with-placeholder';
		$ratio = (int)$data['width'] / (int)$data['height'];

		if ( isset( $data['ratio'] ) && 'auto' !== $data['ratio'] ) {
			$actual_ratio = $ratio;
			$ratio = explode( 'x', $data['ratio'] );
			$ratio = (int)$ratio[0] / (int)$ratio[1];
			if ( $ratio < $actual_ratio ) {
				$attributes['style'] = 'left:' . (1 - $data['width']/$data['height']/$ratio)*50 . '%; max-width:none; width:auto; max-height: 100%;';
			} elseif ( $ratio > $actual_ratio ) {
				$attributes['style'] = 'top:' . (1 - $data['height']/$data['width']*$ratio)*50 . '%;';
			}
		}

		$image_html .= '<div class="media-placeholder" style="width:' . $data['width'] . 'px; padding-bottom:' . 100/$ratio . '%;"></div>';
	}

	if ( $data['lazy_load'] && 'false' !== $data['lazy_load'] ) {
		$attributes['class'] .= ' image-lazy-load';
		$attributes['data-src'] = esc_url( $data['url'] );
	} else {
		$attributes['src'] = esc_url( $data['url'] );
	}

	foreach ( $attributes as $attribute => $value ) {
		if ( !empty( $value ) ) {
			$image_attribute .= ' ' . esc_attr( $attribute ) . '="' . $value . '"';
		}
	}

	$image_html .= '<img ' . fabrique_escape_content( $image_attribute ) . ' />';
	$output .= '<div ' . fabrique_a( $wrapper_attr ) . '>';
	if ( !empty( $data['link'] ) || ( $data['popup'] && 'false' !== $data['popup'] ) ) {
		// if image pop up option is checked then override the image url
		if ( $data['popup'] && 'false' !== $data['popup'] ) {
			$data['link'] = '#embed(' . $data['url'] . ')';
			$link_target = '_self';
		} else {
			$link_target = ( '#' !== substr( $data['link'], 0 , 1 ) ) ? '_blank' : '_self';
		}

		$output .= '<a class="fbq-media-wrapper-inner" href="'. fabrique_escape_url( $data['link'] ) . '" target="' . esc_attr( $link_target ) . '">';
		$output .=    $image_html;
		$output .= '</a>';
	} else {
		$output .= '<div class="fbq-media-wrapper-inner">' . $image_html . '</div>';
	}
	$output .= '</div>';

	return $output;
}
endif;


if ( !function_exists( 'fabrique_template_media' ) ) :
function fabrique_template_media( $data, $get_image_url = false, $responsive = true )
{
	$defaults = array(
		'media_type' => 'image',
		'media_style' => array(), // this is extra style attribute add to image tag
		'wrapper_style' => array(),
		'image_id' => '',
		'image_url' => '',
		'image_link' => '',
		'image_ratio' => 'auto',
		'image_size' => 'large',
		'image_hover' => 'none',
		'image_column_width' => 12,
		'image_popup' => false,
		'image_caption' => false,
		'image_caption_text' => '',
		'image_caption_icon' => 'arrow-bold-right-up',
		'image_max_width' => '',
		'image_lazy_load' => true,
		'media_target_self' => false,
		'media_empty_available' => false, // if no URL then use placeholder
		'itemprop' => ''
	);
	$data = array_merge( $defaults, $data );

	$output = '';
	$image_url = '';
	$full_image_url = '';
	$image_wrapper_style = $data['wrapper_style'];
	$link_target = ( $data['media_target_self'] && 'false' !== $data['media_target_self'] ) ? '_self' : '_blank';

	if ( 'image' === $data['media_type'] ) {
		if ( !empty( $data['image_id'] ) || !empty( $data['image_url'] ) ) {
			if ( 'featured-image' === $data['image_url'] ) {
				$image_input = get_post_thumbnail_id( get_the_ID() );
				$image_input = !empty( $image_input ) ? $image_input : '';
			} else {
				$image_input = !empty( $data['image_id'] ) ? $data['image_id'] : $data['image_url'];
			}

			$image =  fabrique_convert_image(
				$image_input,
				$data['image_size'],
				$data['image_ratio']
			);
			$image_set = $image['image_set'];
			$image_url = $image['url'];
			$full_image_url = $image['full_image_url'];
			$full_image_width = $image['full_image_width'];
			$full_image_height = $image['full_image_height'];
			$image_alt = get_post_meta( $image['id'], '_wp_attachment_image_alt', true );
			$image_post = get_post( $image['id'] );
			$image_title = $image_post->post_title;
			$image_caption = empty( $data['image_caption_text'] ) ? $image_post->post_excerpt : $data['image_caption_text'];
			$image_width = $image['width']; // width after processed
			$image_height = $image['height']; // height after processed
			$placeholder_ratio = ( !empty( $image_width ) && !empty( $image_height ) && 0 != $image['width'] ) ? $image_height/$image_width : 0;
		} elseif ( !$data['media_empty_available'] ) {
			$image_set = array();
			$image_url = fabrique_placeholder();
			$full_image_url = fabrique_placeholder();
			$full_image_width = 900;
			$full_image_height = 600;
			$image_alt = '';
			$image_title = '';
			$image_caption = $data['image_caption_text'];
			$image_width = 900;
			$image_height = 600;
			$placeholder_ratio = 60/90;
		} else {
			return;
		}

		// if has max-width then change image width (in case of larger than the set value) to max width value
		if ( !empty( $data['image_max_width'] ) ) {
			if ( is_numeric( $data['image_max_width'] ) ) {
				$image_wrapper_style['max-width'] = $data['image_max_width'] . 'px';
				$image_width = ( $data['image_max_width'] > $image_width ) ? $image_width : (int)$data['image_max_width'];
			} else {
				$image_wrapper_style['max-width'] = $data['image_max_width'];
				if ( 'px' === substr( $data['image_max_width'], -2 ) ) {
					$image_width = ( (int)$data['image_max_width'] > $image_width ) ? $image_width : (int)$data['image_max_width'];
				}
			}
		}

		$image_html = '';
		$image_srcset = '';
		$image_sizes = '';
		$media_src = array(); // to collect srcset
		$media_url = array(); // collect media url of all sizes image
		$media_width = array();
		$media_sizes = array();
		$image_class = 'fbq-media-wrapper-image';
		$wrapper_class = array( 'fbq-media-wrapper' );

		if ( isset( $data['image_circle'] ) && $data['image_circle'] && 'false' !== $data['image_circle'] ) {
			$wrapper_class[] = 'image-circle';
		}

		// if width of images can be detected and ratio is not 0 then use lazy-load
		if ( 0 != $placeholder_ratio && !empty( $image_width ) ) {
			$wrapper_class[] = 'with-placeholder';
			$image_html .= '<div class="media-placeholder" style="width:' . $image_width . 'px; padding-bottom:' . $placeholder_ratio*100 . '%;"></div>';
		}

		// Check if width and height can be detected (if SVG file width and height will be 0)
		if ( !empty( $full_image_width ) && 0 != $full_image_width ) {
			if ( !empty( $image_set ) && $responsive ) { // if not responsive then don't return srcset
				foreach ( $image_set as $size => $set ) {
					// include all size except thumbnail in "srcset"
					if ( 'thumbnail' !== $size && $set && !in_array( $set[0], $media_url ) && !in_array( $set[1], $media_width ) ) {
						$media_url[] = $set[0];
						$media_width[] = $set[1];
						$media_src[] = $set[0] . ' ' . esc_attr( $set[1] . 'w' );
					}
				}

				// combine srcset attribute
				if ( !empty( $media_src ) ) {
					$image_srcset .= implode( ', ', array_unique( $media_src ) );
					// if image divide into column of element (client, entries, etc.)
					if ( !empty( $data['image_column_width'] ) && 12 != $data['image_column_width'] ) {
						if ( '1-5' === $data['image_column_width'] ) {
							$media_sizes[] = '(max-width:767px) 100vw';
							$media_sizes[] = '(max-width:1100px) 25vw';
							$media_sizes[] = '20vw';
						} else {
							if ( $data['image_column_width'] < 3 ) $media_sizes[] = '(max-width:1100px) 25vw';
							if ( 3 <= $data['image_column_width'] && 5 >= $data['image_column_width'] ) {
								$media_sizes[] = '(max-width:767px) 100vw';
								$media_sizes[] = '(max-width:960px) 50vw';
							} elseif ( 7 <= $data['image_column_width'] && 11 >= $data['image_column_width'] ) {
								$media_sizes[] = '(max-width:960px) 100vw';
							} else {
								$media_sizes[] = '(max-width:767px) 100vw';
							}

							$media_sizes[] = (int)( $data['image_column_width'] / 12 * 100 ) . 'vw';
						}

						$image_sizes .= implode( ', ', $media_sizes );
					} elseif ( !empty( $image_width ) ) {
						$image_sizes .= '(max-width:' . $image_width . 'px) 100vw, ' . $image_width . 'px';
					}
				}
			}
		}

		// add image hover class to animate it
		if ( 'none' !== $data['image_hover'] ) {
			$wrapper_class[] = 'anmt-image-' . $data['image_hover'];
		}

		// if image pop up option is checked then override the image url
		if ( $data['image_popup'] && 'false' !== $data['image_popup'] ) {
			$data['image_link'] = '#embed(' . $full_image_url . ')';
		}

		// define attributes
		$attributes = array(
			'title' => esc_attr( $image_title ),
			'width' => esc_attr( $image_width ),
			'height' => esc_attr( $image_height ),
			'data-full-width' => esc_attr( $full_image_width ),
			'data-full-height' => esc_attr( $full_image_height ),
			'itemprop' => esc_attr( $data['itemprop'] )
		);

		// if lazy load then use "data-src" and "data-srcset" instead
		if ( $data['image_lazy_load'] && 'false' !== $data['image_lazy_load'] ) {
			$image_class .= ' image-lazy-load';
			$attributes['data-sizes'] = $image_sizes;
			$attributes['data-src'] = esc_url( $image_url );
			$attributes['data-srcset'] = $image_srcset;
			// get smallest image as initial load (not to effect SEO)
			if ( !empty( $media_url ) ) {
				$attributes['src'] = end( $media_url );
			} elseif ( !empty( $image_url ) ) {
				$attributes['src'] = $image_url;
			} else {
				$attributes['src'] = fabrique_placeholder();
			}
		} else {
			$attributes['sizes'] = $image_sizes;
			$attributes['srcset'] = $image_srcset;
			$attributes['src'] = esc_url( $image_url );
		}

		// get image attribute
		$image_attribute = 'alt="' . esc_attr( $image_alt ) . '"';
		$attributes['class'] = esc_attr( $image_class );
		foreach ( $attributes as $attribute => $value ) {
			if ( !empty( $value ) ) {
				$image_attribute .= ' ' . esc_attr( $attribute ) . '="' . $value . '"';
			}
		}
		$image_attribute .= ' ' . fabrique_s( $data['media_style'] );

		$image_html .= '<img ' . fabrique_escape_content( $image_attribute ) . ' />';

		// if image caption enable
		if ( $data['image_caption'] && 'false' !== $data['image_caption'] && !empty( $image_caption ) ) {
			$image_html .= '<div class="fbq-image-caption"><i class="twf twf-' . esc_attr( $data['image_caption_icon'] ) . ' fbq-p-brand-bg fbq-p-brand-contrast-color"></i>' . do_shortcode( $image_caption ) . '</div>';
		}

		$output .= '<div class="' . esc_attr( implode( ' ', $wrapper_class ) ) . '" ' . fabrique_s( $image_wrapper_style ) . '>';

		if ( !empty( $data['image_link'] ) ) {
			$link_target = ( '#' !== substr( $data['image_link'], 0 , 1 ) ) ? $link_target : '_self';
			$output .= '<a class="fbq-media-wrapper-inner" href="'. fabrique_escape_url( $data['image_link'] ) . '" target="' . esc_attr( $link_target ) . '">';
			$output .=    $image_html;
			$output .= '</a>';
		} else {
			$output .= '<div class="fbq-media-wrapper-inner">' . $image_html . '</div>';
		}

		$output .= '</div>';
	} else {
		$output .= '<div class="fbq-media-wrapper">';

		if ( !empty( $data['icon_link'] ) ) {
			$link_target = ( '#' !== substr( $data['icon_link'], 0 , 1 ) ) ? $link_target : '_self';
			$output .= '<a class="fbq-media-wrapper-inner" href="'. fabrique_escape_url( $data['icon_link'] ) . '" target="' . esc_attr( $link_target ) . '">';
			$output .=    fabrique_template_icon( $data );
			$output .= '</a>';
		} else {
			$output .= '<div class="fbq-media-wrapper-inner">' . fabrique_template_icon( $data ) . '</div>';
		}

		$output .= '</div>';
	}

	if ( !$get_image_url ) {
		return $output;
	} else {
		return array( 'html' => $output, 'image_url' => $full_image_url );
	}
}
endif;


if ( !function_exists( 'fabrique_template_video' ) ) :
function fabrique_template_video( $item )
{
	$defaults = array(
		'video_type' => 'external',
		'video_url' => '',
		'external_url' => '',
		'poster_id' => '',
		'poster_url' => '',
		'width' => 1920,
		'autoplay' => false,
		'loop' => false
	);
	$item = array_merge( $defaults, $item );
	$output = '';
	$width = $item['width'];
	$height = $width * 9 / 16;

	if ( 'self-hosted' === $item['video_type'] ) {
		if ( !empty( $item['video_url'] ) ) {
			$shortcode = '[video width="' . esc_attr( $width ) . '" height="' . esc_attr( $height ) . '"';
			$shortcode .= ' src="'. esc_url( $item['video_url'] ) . '"';
			if ( $item['loop'] && 'false' !== $item['loop'] ) {
				$shortcode .= ' loop="on"';
			}
			if ( !empty( $item['poster_id'] ) || !empty( $item['poster_url'] ) ) {
				if ( !empty( $item['poster_id'] ) ) {
					$fullsize_attachment = wp_get_attachment_image_src( $item['poster_id'], 'full' );
					$poster_url = $fullsize_attachment[0];
				} elseif ( !is_numeric( $item['poster_url'] ) ) {
					$poster_url = $item['poster_url'];
				} else {
					$fullsize_attachment = wp_get_attachment_image_src( $item['poster_url'], 'full' );
					$poster_url = $fullsize_attachment[0];
				}

				if ( $poster_url ) {
					$shortcode .= ' poster="'. esc_url( $poster_url ) . '"';
				}
			}
			$shortcode .= '][/video]';
			$output .= do_shortcode( $shortcode );
		}
	} else {
		$video = $item['external_url'];
		$autoplay = ( $item['autoplay'] && 'false' !== $item['autoplay'] ) ? 1 : 0;

		if ( !empty( $video ) ) {
			// embed shortcode
			if ( preg_match( '#^\[embed.+\[/embed\]#', $video, $match ) ) {
				global $wp_embed;
				$output .= $wp_embed->run_shortcode( $match[0] );
			// youtube link
			} else if ( false !== strpos( $video, 'youtube' ) ) {
				preg_match( '#[?&]v=([^&]+)(&.+)?#', $video, $id );
				$id[2] = empty( $id[2] )? '': $id[2];
				$allow_fullscreen = 'allowfullscreen="allowfullscreen" mozallowfullscreen="mozallowfullscreen" msallowfullscreen="msallowfullscreen" oallowfullscreen="oallowfullscreen" webkitallowfullscreen="webkitallowfullscreen"';
				if ( !empty( $id[1] ) ) {
					$frame_src = '//www.youtube.com/embed/'. esc_attr( $id[1] ) .'?wmode=transparent&rel=0&showinfo=0&autoplay=' . esc_attr( $autoplay );
					if ( $item['loop'] && 'false' !== $item['loop'] ) {
						$frame_src .= '&loop=1&playlist=' . esc_attr( $id[1] );
					}
					$output .= '<iframe src="' . esc_url( $frame_src ) . '" width="'. esc_attr( $width ) . '" height="'. esc_attr( $height ) . '" ' . fabrique_escape_content( $allow_fullscreen ) . '></iframe>';
				}
			// youtu.be link
			} else if ( false !== strpos( $video, 'youtu.be' ) ) {
				$allow_fullscreen = 'allowfullscreen="allowfullscreen" mozallowfullscreen="mozallowfullscreen" msallowfullscreen="msallowfullscreen" oallowfullscreen="oallowfullscreen" webkitallowfullscreen="webkitallowfullscreen"';
				preg_match( '#youtu.be\/([^?&]+)#', $video, $id );
				if ( !empty( $id[1] ) ) {
					$frame_src = '//www.youtube.com/embed/'. esc_attr( $id[1] ) .'?wmode=transparent&rel=0&showinfo=0&autoplay=' . esc_attr( $autoplay );
					if ( $item['loop'] && 'false' !== $item['loop'] ) {
						$frame_src .= '&loop=1&playlist=' . esc_attr( $id[1] );
					}
					$output .= '<iframe src="' . esc_url( $frame_src ) . '" width="'. esc_attr( $width ) . '" height="' . esc_attr( $height ) . '" ' . fabrique_escape_content( $allow_fullscreen ) . '></iframe>';
				}
			// vimeo link
			} else if ( false !== strpos( $video, 'vimeo' ) ) {
				preg_match( '#https?:\/\/vimeo.com\/(\d+)#', $video, $id );

				if ( !empty( $id[1] ) ) {
					$frame_src = '//player.vimeo.com/video/'. esc_attr( $id[1] ) .'?title=0&byline=0&badge=0&portrait=0&autoplay=' . esc_attr( $autoplay );
					if ( $item['loop'] && 'false' !== $item['loop'] ) {
						$frame_src .= '&loop=1';
					}
					$output .= '<iframe src="' . esc_url( $frame_src ) . '" width="'. esc_attr( $width ) . '" height="'. esc_attr( $height ) . '" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
				}
			// another link
			} else {
				preg_match( '#^https?://\S+#', $video, $match );
				if ( !empty( $match[0] ) ) {
					global $wp_embed;
					$video_embed = '[embed width="'. esc_attr( $width ) .'" height="'. esc_attr( $height ) .'" ]'. $match[0] .'[/embed]';
					$output .= $wp_embed->run_shortcode( $video_embed );
				}
			}
		}
	}

	return $output;
}
endif;


function fabrique_template_featured_media( $opts, $responsive = true )
{
	$default_featured_image = array(
		'post_format' => 'standard',
		'image_id' => '',
		'image_url' => '',
		'image_link' => '',
		'image_ratio' => 'auto',
		'image_lazy_load' => false,
		'image_size' => 'large',
		'image_column_width' => 12,
		'video' => false,
		'video-external' => '',
		'audio' => '',
		'audio-external' => '',
		'gallery' => array(),
		'quote' => '',
		'author' => '',
		'responsive' => $responsive
	);

	$opts = array_merge( $default_featured_image, $opts );

	return fabrique_template_partial( 'featured-media', $opts );
}


if ( !function_exists( 'fabrique_template_sidebar_background' ) ) :
function fabrique_template_sidebar_background( $color = null, $echo = true )
{
	$default_color = fabrique_mod( 'sidebar_background_color' );
	$output = '';

	if ( 'transparent' !== $color ) {
		if ( 'default' !== $color ) {
			$output .= '<div class="fbq-sidebar-background" style="background-color: ' . fabrique_c( $color ) . ';"></div>';
		} else if ( 'transparent' !== $default_color ) {
			$output .= '<div class="fbq-sidebar-background fbq-s-bg-bg"></div>';
		}
	}

	if ( $echo ) {
		echo fabrique_escape_content( $output );
	} else {
		return $output;
	}
}
endif;


if ( !function_exists( 'fabrique_template_background' ) ) :
function fabrique_template_background( $data, $scheme_bg_class = '', $echo = true )
{
	if ( !is_array( $data ) ) {
		return;
	}

	$default = array(
		'default' => false,
		'background_animation' => 'none',
		'background_extend' => 'none',
		'background_type' => 'image',
		'background_id' => '',
		'background_url' => '',
		'background_size' => 'cover',
		'background_position' => 'center center',
		'background_repeat' => 'repeat',
		'background_fixed' => false,
		'background_color' => 'transparent',
		'background_opacity' => 100,
		'background_video_url' => '',
		'background_video_ratio' => '',
		'background_video_sound' => 0,
		'background_poster_id' => '',
		'background_poster_url' => '',
		'parallax_speed' => 0,
		'content_fade' => false,
		'overlay_on' => false //for background color without inline style make this value "true"
	);

	$output = '';
	$data = array_merge( $default, $data );
	$mobile_parallax = fabrique_mod( 'enable_mobile_parallax' ) ? true : false;

	$attribute = array(
		'class' => array( 'fbq-background' ),
		'data_attr' => array(
			'type' => $data['background_type'],
			'parallaxspeed' => $data['parallax_speed'],
			'contentfade' => $data['content_fade'],
			'mobileparallax' => $mobile_parallax
		)
	);

	if ( 'none' !== $data['background_extend'] ) {
		$attribute['class'][] = 'extend-' . $data['background_extend'];
	}

	if ( $data['background_fixed'] ) {
		$attribute['class'][] = 'fbq-background--fixed';
		$attribute['data_attr']['parallaxspeed'] = 0;
	}

	if ( 'video' === $data['background_type'] ) {
		if ( !empty( $data['background_video_url'] ) || ( 'transparent' !== $data['background_color'] && 0 != $data['background_opacity'] ) || $data['default'] ) {
			$video_inner_class = 'fbq-video-background-inner';

			if ( !$data['background_video_sound'] ) {
				$sound = 'muted';
				$vimeo_suffix = 1;
			} else {
				$sound = '';
				$vimeo_suffix = 0;
			}

			if ( !empty( $data['background_video_ratio'] ) ) {
				$attribute['data_attr']['ratio'] = $data['background_video_ratio'];
			}

			$output .= '<div ' . fabrique_a( $attribute ) . '>';

			if ( !empty( $data['background_video_url'] ) ) {
				if ( 'featured-video' === $data['background_video_url'] ) {
					$post_id = get_the_ID();
					$post_format = get_post_format( $post_id );

					if ( 'video' === $post_format ) {
						$featured_video = get_post_meta( $post_id, 'bp_post_format_settings', true );

						if ( $featured_video['video'] ) {
							$data['background_video_url'] = wp_get_attachment_url( $featured_video['video'] );
						} elseif ( $featured_video['video-external'] ) {
							$data['background_video_url'] = $featured_video['video-external'];
						}
					}
				}

				if ( 'featured-image' === $data['background_poster_url'] ) {
					$data['background_poster_id'] = get_post_thumbnail_id( get_the_ID() );
					$data['background_poster_url'] = wp_get_attachment_image_src( $data['background_poster_id'], 'full' );
					$data['background_poster_url'] = $data['background_poster_url'] ? $data['background_poster_url'][0] : '';
				}

				$style_args = array( 'background' => fabrique_get_background_image( array(
					'id' => $data['background_poster_id'],
					'url' => $data['background_poster_url'],
					'size' => $data['background_size'],
					'position' => $data['background_position'],
					'repeat' => $data['background_repeat']
				) ) );

				$output .=    '<div class="fbq-background-wrapper" ' . fabrique_s( $style_args ) . '>';

					if ( false != strpos( $data['background_video_url'], 'youtube' ) ) {
						preg_match( '#[?&]v=([^&]+)(&.+)?#', $data['background_video_url'], $matches );
						if ( empty( $matches[2] ) ) $matches[2] = '';
						$video_id = $matches[1];
						if ( !empty( $video_id ) ) {
							$video_inner_class .= ' fbq-video-background-inner--external fbq-video-background-inner--youtube';
							$if_src = '//www.youtube.com/embed/' . esc_attr( $video_id ) . '?loop=1&autoplay=1&controls=0&showinfo=0&playlist='. esc_attr( $video_id ) .'&enablejsapi=1' . $matches[2];
							$output .= '<iframe class="'. esc_attr( $video_inner_class ) . '" src="' . esc_url( $if_src ) .'" data-sound="' . esc_attr( $sound ) . '"></iframe>';
						}
					} else if ( false !== strpos( $data['background_video_url'], 'vimeo' ) ) {
						preg_match( '#https?:\/\/vimeo.com\/(\d+)#', $data['background_video_url'], $matches );

						if ( !empty( $matches[1] ) ) {
							$video_inner_class .= ' fbq-video-background-inner--external fbq-video-background-inner--vimeo';
							$if_src = '//player.vimeo.com/video/' . $matches[1] . '?api=1&title=0&byline=0&badge=0&portrait=0&autoplay=1&loop=1&background=' . esc_attr( $vimeo_suffix );
							$output .= '<iframe class="'. esc_attr( $video_inner_class ) . '" src="' . esc_url( $if_src ) .'" data-sound="' . esc_attr( $sound ) . '"></iframe>';
						}
					} else {
						$video_inner_class .= ' fbq-video-background-inner--selfhosted';
						$output .= '<div class="fbq-background-wrapper-inner">';
						$output .= 	'<video class="' . esc_attr( $video_inner_class ) .'" loop ' . esc_attr( $sound ) . '>';
						$output .=    '<source src="' . esc_url( $data['background_video_url'] ) . '">';
						$output .= 	'</video>';
						$output .= '</div>';
					}

				$output .=    '</div>';
			}

			if ( $data['overlay_on'] || $data['default'] ) {
				$output .=    '<div class="fbq-background-overlay ' . esc_attr( $scheme_bg_class ) . '"></div>';
			} elseif ( 'transparent' !== $data['background_color'] && 0 != $data['background_opacity'] ) {
				$style_args = array( 'background-color' => fabrique_c( $data['background_color'] ), 'opacity' => $data['background_opacity'] / 100 );
				$output .=    '<div class="fbq-background-overlay ' . esc_attr( $scheme_bg_class ) . '" ' . fabrique_s( $style_args ) . '></div>';
			} else {
				$output .=    '<div class="fbq-background-overlay" style="background-color:transparent;"></div>';
			}

			$output .= '</div>';
		}
	} else {
		if ( !empty( $data['background_id'] ) || !empty( $data['background_url'] ) || ( 'transparent' !== $data['background_color'] && 0 != $data['background_opacity'] ) || $data['default'] ) {
			if ( 'none' !== $data['background_animation'] ) {
				$attribute['class'][] = 'fbq-background--' . $data['background_animation'];
			}

			$output .=  '<div ' . fabrique_a( $attribute ) . '>';

			if ( !empty( $data['background_id'] ) || !empty( $data['background_url'] ) || $data['default'] ) {
				if ( 'featured-image' === $data['background_url'] ) {
					$data['background_id'] = get_post_thumbnail_id( get_the_ID() );
					$data['background_url'] = wp_get_attachment_image_src( $data['background_id'], 'full' );
					$data['background_url'] = $data['background_url'] ? $data['background_url'][0] : '';
				}

				$style_args = array( 'background' => fabrique_get_background_image( array(
					'id' => $data['background_id'],
					'url' => $data['background_url'],
					'size' => $data['background_size'],
					'position' => $data['background_position'],
					'repeat' => $data['background_repeat'],
					'lazy_load' => true
				) ) );
				$output .=    '<div class="fbq-background-wrapper">';
				$output .=        '<div class="fbq-background-inner" ' . fabrique_s( $style_args ) . '></div>';
				$output .=    '</div>';
			}

			if ( $data['overlay_on'] || $data['default'] ) {
				$output .=    '<div class="fbq-background-overlay ' . esc_attr( $scheme_bg_class ) . '"></div>';
			} elseif ( 'transparent' !== $data['background_color'] && 0 != $data['background_opacity'] ) {
				$style_args = array( 'background-color' => fabrique_c( $data['background_color'] ), 'opacity' => $data['background_opacity'] / 100 );
				$output .=    '<div class="fbq-background-overlay ' . esc_attr( $scheme_bg_class ) . '" ' . fabrique_s( $style_args ) . '></div>';
			}

			$output .= '</div>';
		}
	}

	if ( $echo ) {
		echo fabrique_escape_content( $output );
	} else {
		return $output;
	}
}
endif;


// get navigation menu, if not the same layout (standard/inline) then get 2 menus
if ( !function_exists( 'fabrique_template_nav_menu' ) ) :
function fabrique_template_nav_menu( $opts = array(), $mobile = false )
{
	$defaults = array(
		'navbar_menu' => 'default',
		'navbar_menu_mobile' => 'default',
		'navbar_style' => 'standard', // This is navigation style
		'menu_position' => 'top', // Not navigation bar position (eg. offcanvas = side)
		'mobile' => false,
		'search_on' => false,
		'cart_on' => false,
		'echo' => false
	);
	$opts = array_merge( $defaults, $opts );

	if ( 'default' !== $opts['navbar_menu'] ) {
		$navbar_args = array(
			'menu' => $opts['navbar_menu'],
			'navbar_style' => $opts['navbar_style'],
			'menu_position' => $opts['menu_position'],
			'search_on' => $opts['search_on'],
			'cart_on' => $opts['cart_on'],
			'mobile' => $mobile,
			'echo' => false
		);
	} elseif ( has_nav_menu( 'fbq-primary-menu' ) ) {
		$navbar_args = array(
			'theme_location' => 'fbq-primary-menu',
			'navbar_style' => $opts['navbar_style'],
			'menu_position' => $opts['menu_position'],
			'search_on' => $opts['search_on'],
			'cart_on' => $opts['cart_on'],
			'mobile' => $mobile,
			'echo' => false
		);
	} else {
		$navbar_args = array();
	}

	if ( $mobile ) {
		if ( 'default' !== $opts['navbar_menu_mobile'] ) {
			unset( $navbar_args['theme_location'] );
			$navbar_args['menu'] = $opts['navbar_menu_mobile'];
		} elseif ( has_nav_menu( 'fbq-mobile-menu' ) ) {
			unset( $navbar_args['menu'] );
			$navbar_args['theme_location'] = 'fbq-mobile-menu';
		}
	}

	if ( !empty( $navbar_args ) ) {
		$nav_menu = wp_nav_menu( $navbar_args );
	} else {
		$nav_menu = '';
	}

	return $nav_menu;
}
endif;


if ( !function_exists( 'fabrique_template_breadcrumb_separator' ) ) :
function fabrique_template_breadcrumb_separator( $separator )
{
	echo '<li class="fbq-separator"><span class="twf twf-' . esc_attr( $separator ) . '"></span></li>';
}
endif;


// get search menu
if ( !function_exists( 'fabrique_template_menu_search' ) ) :
function fabrique_template_menu_search( $in_navbar = true, $menu_position = 'top' )
{
	$menu_class = ( $in_navbar ) ? 'fbq-menu-search menu-item' : 'fbq-menu-search';
	$output = '<li class="' . esc_attr( $menu_class ) . '">';
	$output .=   '<a href="#" class="js-menu-search"><i class="twf twf-search"></i></a>';
	if ( 'top' !== $menu_position ) {
		$output .=      '<form class="fbq-search-form" role="search" method="get" action="' . esc_url( home_url( '/' ) ) . '">';
		$output .=         '<input type="text" placeholder="' . esc_html__( 'Search', 'fabrique' ) . '" value="" name="s" />';
		$output .=         '<span class="js-search-close fbq-search-close twf twf-ln-cross"></span>';
		$output .=      '</form>';
	}
	$output .= '</li>';

	return $output;
}
endif;


// get cart menu
if ( !function_exists( 'fabrique_template_menu_cart' ) ) :
function fabrique_template_menu_cart( $in_navbar = true, $menu_position = 'top' )
{
	if ( !fabrique_is_woocommerce_activated() ) {
		return;
	}

	global $woocommerce;
	$output = '';

	if ( $woocommerce->cart ) {
		$menu_class = ( $in_navbar ) ? 'fbq-menu-cart menu-item' : 'fbq-menu-search';
		$output .= '<li class="' . esc_attr( $menu_class ) . '">';
		$output .=    '<a href="' . wc_get_cart_url() . '" class="js-menu-cart"><i class="twf twf-' . esc_attr( fabrique_mod( 'navbar_cart_icon' ) ) . '"></i>';
		$output .=      '<span class="fbq-menu-cart-count">' . esc_html( $woocommerce->cart->cart_contents_count ) . '</span>';
		$output .=    '</a>';
		if ( 'top' === $menu_position ) {
			$output .=    '<div class="fbq-cart-box fbq-s-bg-bg woocommerce">';
			$output .=      '<div class="widget_shopping_cart">';
			$output .=        '<div class="widget_shopping_cart_content">';
			$output .=          fabrique_template_mini_cart();
			$output .=        '</div>';
			$output .=      '</div>';
			$output .=    '</div>';
		}
		$output .= '</li>';
	}

	return $output;
}
endif;


/**
 * Get Heading with Global style setting (use in widget heading)
 */
if ( !function_exists( 'fabrique_get_title' ) ) :
function fabrique_get_title( $opts, $echo = true )
{
	$defaults = array(
		'class' => '',
		'id' => '',
		'style_attr' => array(),
		'style' => fabrique_mod( 'heading_style' ),
		'alternate_color' => 'default',
		'size' => 'h3',
		'uppercase' => false,
		'font_family' => 'secondary',
		'letter_spacing' => '',
		'text' => 'Heading',
		'alignment' => 'left'
	);

	$opts = array_merge( $defaults, $opts );
	$base_class = array( 'fbq-heading fbq-heading--' . $opts['style'] );
	$style_attr = $opts['style_attr'];
	$text_class = array( 'fbq-heading-text fbq-' . $opts['font_family'] . '-font' );
	$text_class[] = ( 'leadline' !== $opts['style'] ) ? 'fbq-p-border-border' : 'fbq-s-text-border';
	$text_style = fabrique_get_spacing_style( $opts, 'padding' );
	$text_style['letter-spacing'] = is_numeric( $opts['letter_spacing'] ) ? $opts['letter_spacing'] . 'px' : $opts['letter_spacing'];
	$pretext = '';
	$posttext = '';

	if ( !empty( $opts['class'] ) ) {
		if ( is_array( $opts['class'] ) ) {
			$class = array_unique( array_merge( $base_class, $opts['class'] ) );
		} else {
			$class[] = $opts['class'];
		}
	} else {
		$class = $base_class;
	}

	if ( $opts['uppercase'] && 'false' !== $opts['uppercase'] ) {
		$class[] = 'fbq-uppercase';
	}

	$alternate_color = fabrique_c( $opts['alternate_color'] );

	if ( 'fill' === $opts['style'] ) {
		$class[] = 'fbq-s-text-bg';
		$style_attr['background-color'] = $alternate_color;
		$text_class[] = 'fbq-s-text-contrast-color';
	} else {
		$text_class[] = 'fbq-s-text-color';

		if ( 'breakline' === $opts['style'] || 'shade' === $opts['style'] ) {
			$line_class = 'fbq-heading-line';
			$line_style = '';

			if ( 'breakline' === $opts['style'] ) {
				$line_class .= ' fbq-p-border-bg';
				if ( 'default' !== $opts['alternate_color'] ) {
					$line_style .= ' style="background-color:' . $alternate_color .';"';
				}
			} elseif ( 'default' !== $opts['alternate_color'] ) {
				$line_style .= ' style="background-image:-webkit-repeating-linear-gradient(45deg, transparent, transparent 2px, ' . $alternate_color . ' 2px ,' . $alternate_color . ' 4px);background-image:-o-repeating-linear-gradient(45deg, transparent, transparent 2px, ' . $alternate_color . ' 2px ,' . $alternate_color . ' 4px);background-image:-moz-repeating-linear-gradient(45deg, transparent, transparent 2px, ' . $alternate_color . ' 2px ,' . $alternate_color . ' 4px);background-image:repeating-linear-gradient(45deg, transparent, transparent 2px, ' . $alternate_color . ' 2px ,' . $alternate_color . ' 4px);"';
			}

			if ( 'left' === $opts['alignment'] ) {
				$posttext .= '<div class="' . $line_class . ' after"' . $line_style . '></div>';
			} else if ( 'center' === $opts['alignment'] ) {
				$pretext .= '<div class="' . $line_class . ' before"' . $line_style . '></div>';
				$posttext .= '<div class="' . $line_class . ' after"' . $line_style . '></div>';
			} else {
				$pretext .= '<div class="' . $line_class . ' before"' . $line_style . '></div>';
			}
		} else {
			$text_style['border-color'] = $alternate_color;
		}
	}

	$heading_attr = array(
		'class' => $class,
		'id' => $opts['id'],
		'style_attr' => $style_attr,
		'data' => array( 'style' => $opts['style'] )
	);

	$text_attr = array(
		'class' => $text_class,
		'style_attr' => $text_style
	);

	$prefix = '<div ' . fabrique_a( $heading_attr ) . '><div class="fbq-heading-inner">' . $pretext . '<' . esc_attr( $opts['size'] ) . ' ' . fabrique_a( $text_attr ) . '>';
	$suffix = '</' . esc_attr( $opts['size'] ) . '>' . $posttext . '</div></div>';

	if ( $echo ) {
		echo fabrique_escape_content( $prefix . do_shortcode( $opts['text'] ) . $suffix );
	} else {
		return array(
			'prefix' => $prefix,
			'content' => $opts['text'],
			'suffix' => $suffix,
			'html' => $prefix . do_shortcode( $opts['text'] ) . $suffix
		);
	}
}
endif;


/**
 * Output social icon (auto color available)
 */
if ( !function_exists( 'fabrique_get_social_icon' ) ) :
function fabrique_get_social_icon( $item = array() )
{
	$global_social_style = fabrique_mod( 'social_icon_style' );
	$global_social_hover = fabrique_mod( 'social_icon_hover_style' );
	$global_social_auto_color = fabrique_mod( 'social_auto_color' );

	$default_social = array(
		'facebook',
		'twitter',
		'instagram',
		'youtube',
		'vimeo',
		'linkedin',
		'google-plus',
		'skype',
		'pinterest',
		'tripadvisor',
		'flickr',
		'tumblr',
		'dribbble',
		'behance',
		'stumbleupon',
		'email',
		'phone',
		'line',
		'xing'
	);

	$defaults = array(
		'icon_style' => !empty( $global_social_style ) ? $global_social_style : 'plain',
		'icon_hover_style' => !empty( $global_social_hover ) ? $global_social_hover : 'none',
		'auto_color' => !empty( $global_social_auto_color ) ? $global_social_auto_color : false,
		'default_color' => false,
		'icon_color' => 'default',
		'icon_hover_color' => 'default',
		'components' => $default_social,
		'socials' => array()
	);

	$item = array_merge( $defaults, $item );
	$output = '';
	$social_class = !$item['auto_color'] ? 'fbq-social-item' : 'fbq-social-item fbq-social-item--color';

	$social_order = apply_filters( 'default_social_order', $default_social );
	$social_options = array_intersect( $social_order, $item['components'] );

	foreach ( $social_options as $option ) {
		$social_input = isset( $item['socials'][$option] ) ? $item['socials'][$option] : fabrique_mod( 'social_' . $option );
		if ( !empty( $social_input ) ) {
			$item['icon'] = $option;

			switch ( $option ) {
				case 'email' :
					$item['icon'] = 'envelope';
					$social_link = 'mailto:' . esc_attr( $social_input );
					$link_target = '_self';
					break;
				case 'skype' :
					$social_link = 'skype:'. esc_attr( $social_input ) . '?chat';
					$link_target = '_self';
					break;
				case 'phone' :
					$social_link = 'tel:'. esc_attr( $social_input );
					$link_target = '_self';
					break;
				case 'line' :
					$social_link = 'http://line.me/ti/p/~'. esc_attr( $social_input );
					$link_target = '_blank';
					break;
				default :
					$social_link = esc_url( $social_input );
					$link_target = '_blank';
			}

			$output .= '<a href="' . $social_link . '" class="'. esc_attr( $social_class ) . ' fbq-social-' . esc_attr( $option ) . '" target="' . esc_attr( $link_target ) . '">';
			$output .=    fabrique_template_icon( $item );
			$output .= '</a>';
		}
	}

	return $output;
}
endif;
