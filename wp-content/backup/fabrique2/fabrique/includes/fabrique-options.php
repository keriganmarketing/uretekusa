<?php

function fabrique_default_options()
{
	return array(
		'minified_asset' => true,
		'asset_uri' => apply_filters( 'fabrique_asset_uri', get_template_directory_uri() . '/dist' )
	);
}

function fabrique_theme_options( $key = '' )
{
	$default_options = array(
		'bp_color_1' => '#56a9aa',
		'bp_color_2' => '#0e8a8c',
		'bp_color_3' => '#788791',
		'bp_color_4' => '#283035',
		'bp_color_5' => '#ffffff',
		'bp_color_6' => '#ebf0f5',
		'bp_color_7' => '#e3e3e3',
		'bp_color_8' => '#6a8985',
		'bp_color_9' => '#ffffff',
		'bp_color_10' => '#333333',
		'bp_color_11' => '#1d1d1d',
		'bp_color_12' => '#4f4f4f',
		'bp_color_13' => '#fafafa',
		'bp_color_14' => '#363636',
		'default_color_scheme' => 'light',
		'topbar_color_scheme' => 'dark',
		'navbar_color_scheme' => 'light',
		'header_widget_color_scheme' => 'dark',
		'page_title_color_scheme' => 'dark',
		'sidebar_color_scheme' => 'default',
		'logo_homescreen_icon' => '',
		'navbar_offcanvas_cursor' => '',
		'navbar_logo_section' => '',
		'logo_type' => 'text',
		'logo' => '',
		'logo_width' => 120,
		'logo_text_title' => 'FABRIQUÉ',
		'logo_typography' => 'secondary',
		'logo_font_color' => 'default',
		'logo_font_size' => 24,
		'logo_letter_spacing' => 0.1,
		'mobile_navbar_logo_section' => '',
		'mobile_navbar_logo' => '',
		'mobile_navbar_logo_width' => 60,
		'fixed_navbar_logo_section' => '',
		'fixed_navbar_logo' => '',
		'fixed_navbar_logo_light_scheme' => '',
		'fixed_navbar_logo_dark_scheme' => '',
		'fixed_navbar_logo_width' => 60,
		'site_layout' => 'wide',
		'frame_color' => 'default',
		'frame_width' => 30,
		'content_max_width' => 1200,
		'side_padding' => 16,
		'header_on_frame' => 0,
		'sidebar' => 0,
		'sidebar_position' => 'right',
		'sidebar_select' => '',
		'sidebar_fixed' => 0,
		'sidebar_background_color' => 'default',
		'sidebar_width' => 25,
		'sidebar_top_padding' => 60,
		'content_background' => 0,
		'content_background_color' => 'default',
		'content_background_image' => '',
		'content_background_repeat' => 'repeat',
		'content_background_size' => 'cover',
		'content_background_position' => 'center center',
		'content_background_attachment' => 1,
		'body_background' => 0,
		'body_background_color' => 'default',
		'body_background_image' => '',
		'body_background_repeat' => 'repeat',
		'body_background_size' => 'cover',
		'body_background_position' => 'center center',
		'body_background_attachment' => 1,
		'boxed_shadow' => '0 0 30px 0 rgba(0, 0, 0, 0.1)',
		'site_responsive' => 1,
		'enable_mobile_parallax' => 0,
		'style_typography' => 'primary',
		'style_font_size' => 16,
		'style_line_height' => 1.5,
		'heading_style' => 'leadline',
		'heading_typography' => 'secondary',
		'heading_size_h1' => 50,
		'heading_size_h2' => 36,
		'heading_size_h3' => 24,
		'heading_size_h4' => 20,
		'heading_size_h5' => 16,
		'heading_size_h6' => 14,
		'button_style' => 'fill',
		'button_hover_style' => 'brand',
		'button_size' => 'medium',
		'button_typography' => 'secondary',
		'button_uppercase' => 0,
		'button_border' => 1,
		'button_radius' => 0,
		'carousel_arrow_background' => 'square',
		'carousel_arrow_style' => 'angle',
		'cookies_notice' => 0,
		'cookies_notice_color_scheme' => 'light',
		'cookies_notice_background_color' => 'default',
		'cookies_notice_background_opacity' => 100,
		'cookies_notice_message' => 'We use cookies to deliver you the best experience. By browsing our website you agree to our use of cookies. [bp_link url="/"]Learn More[/bp_link]',
		'preload_style' => 'none',
		'preload_background_color' => 'default',
		'preload_logo' => '',
		'preload_logo_width' => 80,
		'back_to_top' => 0,
		'back_to_top_background' => 'circle',
		'back_to_top_background_color' => 'default',
		'back_to_top_style' => 'arrow-bold',
		'back_to_top_arrow_color' => 'default',
		'navbar_position' => 'top',
		'navbar_style' => 'standard',
		'navbar_fullwidth' => 0,
		'side_navbar_style' => 'fixed',
		'navbar_menu_position' => 'right',
		'side_navbar_menu_alignment' => 'left',
		'inline_navbar_menu_position' => 'inner',
		'minimal_navbar_menu_style' => 'full',
		'navbar_size' => 'custom',
		'navbar_height' => 90,
		'navbar_menu_hover_style' => 'default',
		'navbar_stacked_options' => '',
		'navbar_stacked_overlap' => 0,
		'navbar_stacked_lineheight' => 62,
		'navbar_stacked_background_color' => 'bp_color_10',
		'navbar_stacked_opacity' => 100,
		'navbar_menu_border' => '',
		'navbar_menu_border_thickness' => 1,
		'navbar_menu_border_color' => 'default',
		'navbar_offset' => '',
		'navbar_logo_offset_top' => '',
		'navbar_menu_offset_top' => '',
		'navbar_stacked_logo_offset_top' => 30,
		'navbar_stacked_menu_offset_top' => 30,
		'sidenav_logo_offset_top' => '',
		'sidenav_menu_offset_top' => '',
		'navbar_component' => '',
		'mega_menu_separator' => 0,
		'navbar_search' => 0,
		'navbar_cart' => 0,
		'navbar_cart_icon' => 'et-bag',
		'navbar_background_custom' => 0,
		'navbar_background_color' => 'default',
		'navbar_opacity' => 100,
		'navbar_menu_custom' => 0,
		'navbar_menu_color' => 'default',
		'navbar_menu_active_color' => 'default',
		'navbar_menu_hover_color' => 'default',
		'navbar_menu_typography' => 'primary',
		'navbar_menu_uppercase' => 0,
		'navbar_menu_font_size' => 14,
		'navbar_menu_letter_spacing' => 0,
		'navbar_menu_separator' => 'none',
		'dropdown_menu' => 0,
		'dropdown_menu_uppercase' => 0,
		'dropdown_menu_font_size' => 14,
		'dropdown_menu_letter_spacing' => '',
		'dropdown_menu_min_width' => 220,
		'dropdown_color_scheme' => 'dark',
		'dropdown_background_color' => 'default',
		'dropdown_opacity' => 100,
		'dropdown_menu_color' => 'default',
		'dropdown_hover_color' => 'default',
		'sidenav_background_custom' => 0,
		'sidenav_background_color' => 'default',
		'sidenav_background_image' => '',
		'sidenav_background_repeat' => 'repeat',
		'sidenav_background_size' => 'cover',
		'sidenav_background_position' => 'center center',
		'sidenav_background_attachment' => 1,
		'sidenav_menu_custom' => 0,
		'sidenav_menu_color' => 'default',
		'sidenav_menu_active_color' => 'default',
		'sidenav_menu_hover_color' => 'default',
		'sidenav_menu_typography' => 'secondary',
		'sidenav_menu_uppercase' => 1,
		'sidenav_menu_font_size' => 15,
		'sidenav_menu_letter_spacing' => -0.03,
		'navbar_full_background' => 0,
		'navbar_full_background_color' => 'default',
		'navbar_full_opacity' => 100,
		'navbar_full_background_image' => '',
		'navbar_full_background_repeat' => 'repeat',
		'navbar_full_background_size' => 'cover',
		'navbar_full_background_position' => 'center center',
		'navbar_full_menu_custom' => 0,
		'navbar_full_menu_axis' => 'vertical',
		'navbar_full_menu_color' => 'default',
		'navbar_full_menu_active_color' => 'default',
		'navbar_full_menu_hover_color' => 'default',
		'navbar_full_menu_typography' => 'secondary',
		'navbar_full_menu_font_size' => 30,
		'navbar_full_menu_letter_spacing' => -0.03,
		'mobile_navbar_style' => 'classic',
		'mobile_navbar_menu_typography' => 'secondary',
		'mobile_navbar_menu_uppercase' => 1,
		'mobile_navbar_menu_font_size' => 14,
		'mobile_navbar_menu_letter_spacing' => '',
		'mobile_navbar_advance' => 0,
		'mobile_navbar_background_color' => 'default',
		'mobile_navbar_opacity' => 100,
		'mobile_navbar_background_image' => '',
		'mobile_navbar_background_repeat' => 'repeat',
		'mobile_navbar_background_size' => 'cover',
		'mobile_navbar_background_position' => 'center center',
		'mobile_navbar_menu_color' => 'default',
		'mobile_navbar_menu_active_color' => 'default',
		'mobile_navbar_menu_hover_color' => 'default',
		'fixed_navbar' => 0,
		'fixed_navbar_hide' => 0,
		'fixed_navbar_style' => 'custom',
		'fixed_navbar_height' => 70,
		'fixed_navbar_transition' => 'show',
		'fixed_navbar_transition_point' => '',
		'fixed_navbar_bottom_border' => '',
		'fixed_navbar_bottom_border_thickness' => 1,
		'fixed_navbar_bottom_border_color' => '#eeeeee',
		'fixed_navbar_advance' => 0,
		'fixed_navbar_background_color' => 'default',
		'fixed_navbar_opacity' => 100,
		'fixed_navbar_menu_font_size' => 12,
		'fixed_navbar_menu_color' => 'default',
		'fixed_navbar_menu_active_color' => 'default',
		'fixed_navbar_menu_hover_color' => 'default',
		'topbar' => 0,
		'enable_mobile_topbar' => 0,
		'topbar_column' => 2,
		'topbar_height' => 36,
		'topbar_separator' => 0,
		'topbar_bottom_border' => '',
		'topbar_bottom_border_thickness' => 0,
		'topbar_bottom_border_color' => 'default',
		'topbar_advance' => 0,
		'topbar_background_color' => 'default',
		'topbar_background_opacity' => 100,
		'topbar_text_color' => 'default',
		'topbar_link_color' => 'default',
		'topbar_link_hover_color' => 'default',
		'header_action_button' => 0,
		'action_type' => 'link',
		'fixed_nav_action_button' => 1,
		'action_mobile_display' => 0,
		'action_button_style_section' => '',
		'action_button_text' => 'GET A QUOTE',
		'action_button_icon' => '',
		'action_button_icon_position' => 'before',
		'action_button_style' => 'fill',
		'action_button_hover_style' => 'brand',
		'action_button_border' => 1,
		'action_button_radius' => 0,
		'action_button_setting_section' => '',
		'action_link' => '/',
		'action_target_self' => 0,
		'header_widget_column' => 4,
		'header_widget_alignment' => 'left',
		'header_widget_max_height' => '',
		'header_widget_advance' => 0,
		'header_widget_separator' => 0,
		'header_widget_background_color' => 'default',
		'header_widget_background_opacity' => 100,
		'header_widget_background_image' => '',
		'header_widget_background_repeat' => 'repeat',
		'header_widget_background_size' => 'cover',
		'header_widget_background_position' => 'center center',
		'header_widget_text_color' => 'default',
		'header_widget_link_color' => 'default',
		'header_widget_link_hover_color' => 'default',
		'action_social_component' => array(
			'facebook',
			'instagram',
			'tripadvisor',
			'phone'
		),
		'footer' => 1,
		'footer_parallax' => 0,
		'footer_id' => '',
		'page_title_full_width' => 0,
		'breadcrumb_setting_section' => '',
		'breadcrumb' => 0,
		'breadcrumb_separator' => 'angle-right',
		'breadcrumb_text_color' => 'default',
		'breadcrumb_background_color' => 'default',
		'breadcrumb_background_opacity' => 100,
		'page_title_setting_section' => '',
		'page_title' => 1,
		'breadcrumb_alignment' => 'left',
		'breadcrumb_position' => 'top',
		'page_title_alignment' => 'left',
		'page_title_text_color' => 'default',
		'page_title_background_custom' => 0,
		'page_title_background_color' => 'default',
		'page_title_background_opacity' => 80,
		'page_title_background_image' => '',
		'page_title_background_repeat' => 'repeat',
		'page_title_background_size' => 'cover',
		'page_title_background_position' => 'center center',
		'page_title_label_section' => 0,
		'page_title_blog_label' => 'Blog',
		'page_title_shop_label' => 'Products',
		'page_title_archive_label' => 'Archives of ',
		'page_title_category_label' => 'Archives of ',
		'page_title_tag_label' => 'Archives of #',
		'page_title_search_label' => 'Search Results for: ',
		'page_title_author_label' => 'All posts of ',
		'page_title_day_label' => 'Archive of day: ',
		'page_title_month_label' => 'Archive of month: ',
		'page_title_year_label' => 'Archive of year: ',
		'blog_subtitle' => '',
		'blog_custom_archive' => '',
		'blog_full_width' => 0,
		'blog_style' => 'plain',
		'blog_layout' => 'list',
		'blog_list_thumbnail_size' => 'small',
		'blog_columns' => 3,
		'blog_alignment' => 'left',
		'blog_featured_media' => 'auto',
		'blog_image_size' => 'large',
		'blog_image_ratio' => 'auto',
		'blog_image_hover' => 'none',
		'blog_border' => 0,
		'blog_color_section' => '',
		'blog_color_scheme' => 'default',
		'blog_background' => 'default',
		'blog_opacity' => 100,
		'blog_spacing_section' => '',
		'blog_spacing' => 60,
		'blog_inner_spacing' => 0,
		'blog_typography_section' => '',
		'blog_title_uppercase' => 0,
		'blog_title_font_size' => 24,
		'blog_title_letter_spacing' => 0,
		'blog_title_line_height' => '',
		'blog_advance_section' => '',
		'blog_load' => 'pagination',
		'blog_filter' => 0,
		'blog_filter_alignment' => 'left',
		'blog_filter_sorting' => 'default',
		'blog_excerpt_content' => 'excerpt',
		'blog_excerpt_length' => '',
		'blog_more_icon_position' => 'before',
		'blog_more_message' => 'Read More',
		'blog_link' => 'post',
		'blog_link_new_tab' => 0,
		'blog_component' => array(
			'media',
			'category',
			'tag',
			'title',
			'excerpt',
			'link'
		),
		'project_slug' => 'project',
		'project_custom_archive' => '',
		'project_subtitle' => "Edit this subtitle in customizer's project section",
		'project_items' => 12,
		'project_full_width' => 0,
		'project_style' => 'plain',
		'project_layout' => 'grid',
		'project_list_thumbnail_size' => 'small',
		'project_columns' => 3,
		'project_alignment' => 'left',
		'project_image_size' => 'large',
		'project_image_ratio' => 'auto',
		'project_image_hover' => 'zoom',
		'project_border' => 0,
		'project_sidebar' => 0,
		'project_sidebar_position' => 'right',
		'project_sidebar_select' => '',
		'project_sidebar_fixed' => false,
		'project_color_section' => '',
		'project_color_scheme' => 'default',
		'project_background' => 'default',
		'project_opacity' => 100,
		'project_spacing_section' => '',
		'project_spacing' => 60,
		'project_inner_spacing' => 0,
		'project_typography_section' => '',
		'project_title_uppercase' => 0,
		'project_title_font_size' => 24,
		'project_title_letter_spacing' => 0,
		'project_title_line_height' => '',
		'project_advance_section' => '',
		'project_load' => 'pagination',
		'project_filter' => 1,
		'project_filter_alignment' => 'left',
		'project_filter_sorting' => 'default',
		'project_excerpt_content' => 'excerpt',
		'project_excerpt_length' => '',
		'project_more_icon_position' => 'before',
		'project_more_message' => 'View Project',
		'project_link' => 'post',
		'project_link_new_tab' => 1,
		'project_component' => array(
			'media',
			'category',
			'title',
			'excerpt',
			'link'
		),
		'shop_subtitle' => "Our quality products, tools, and spare parts",
		'shop_full_width' => 0,
		'shop_style' => 'plain',
		'shop_product' => 9,
		'shop_column' => 4,
		'shop_spacing' => 20,
		'shop_image_size' => 'large',
		'shop_image_ratio' => 'auto',
		'shop_sidebar' => 0,
		'shop_sidebar_position' => 'left',
		'shop_sidebar_select' => '',
		'shop_sidebar_fixed' => 1,
		'shop_typography_section' => '',
		'shop_title_uppercase' => 1,
		'shop_title_letter_spacing' => 0,
		'shop_title_font_size' => 20,
		'shop_price_font_size' => 16,
		'shop_component' => array(
			'media',
			'title',
			'excerpt',
			'rating',
			'addtocart',
			'price'
		),
		'product_image_action' => 'lightbox',
		'product_variation_mode' => 'radio',
		'product_thumbnail_position' => 'bottom',
		'product_thumbnail_item' => 4,
		'product_detail_position' => 'right',
		'product_detail_width' => 40,
		'product_component' => '',
		'product_related' => 1,
		'product_related_column' => 4,
		'product_share' => 0,
		'product_sidebar' => 0,
		'product_sidebar_position' => 'left',
		'product_sidebar_select' => '',
		'product_sidebar_fixed' => false,
		'social_auto_color' => 0,
		'social_icon_style' => 'plain',
		'social_icon_hover_style' => 'plain',
		'social_facebook' => 'https://www.facebook.com/twisttheme/',
		'social_twitter' => 'https://twitter.com/ThemeTwist',
		'social_youtube' => 'https://www.youtube.com',
		'social_vimeo' => '',
		'social_instagram' => 'https://www.instagram.com',
		'social_linkedin' => '',
		'social_google-plus' => '',
		'social_skype' => '',
		'social_pinterest' => 'http://www.pinterest.com',
		'social_tripadvisor' => '',
		'social_flickr' => '',
		'social_tumblr' => '',
		'social_dribbble' => '',
		'social_behance' => '',
		'social_stumbleupon' => '',
		'social_email' => 'support@twisttheme.com',
		'social_phone' => '',
		'social_line' => '',
		'social_xing' => '',
		'social_share_component' => array(
			'facebook',
			'twitter',
			'email',
			'linkedin'
		),
		'use_style_custom_version' => true,
		'style_custom_version' => ''
	);

	if ( !empty( $key ) ) {
		return isset( $default_options[$key] ) ? $default_options[$key] : '';
	} else {
		return $default_options;
	}
}


function fabrique_default_post_options()
{
	return array(
		'featured_media_layout' => 'standard',
		'featured_media_parallax' => true,
		'featured_media_scheme' => 'dark',
		'breadcrumb' => false,
		'breadcrumb_color_scheme' => 'default',
		'breadcrumb_color' => 'default',
		'breadcrumb_background' => 'default',
		'breadcrumb_opacity' => 100,
		'breadcrumb_alignment' => 'left',
		'header_alignment' => 'left',
		'title_font' => 'secondary',
		'title_size' => 42,
		'title_max_width' => '60%',
		'title_letter_spacing' => '',
		'title_line_height' => '',
		'sidebar' => false,
		'sidebar_id' => '',
		'sidebar_position' => 'right',
		'sidebar_fixed' => false,
		'sidebar_background_color' => 'default',
		'sidebar_color_scheme' => 'default',
		'category' => true,
		'author' => true,
		'date' => true,
		'tag' => true,
		'comment' => true,
		'author_box' => false,
		'print_button' => false,
		'comment_color_scheme' => 'default',
		'comment_background_color' => 'default',
		'social' => false,
		'social_components' => array( 'facebook', 'twitter', 'pinterest'),
		'social_counter' => false,
		'social_divider' => false,
		'social_size' => 15,
		'social_auto_color' => false,
		'social_color' => 'default',
		'social_icon_style' => 'border',
		'social_icon_hover_style' => 'fill',
		'social_icon_hover_color' => 'default',
		'navigation' => true,
		'navigation_style' => 'bar',
		'related' => true,
		'related_title' => 'Related Posts',
		'related_items' => 4,
		'related_column' => 4,
		'related_thumbnail' => false,
		'related_date' => true,
		'related_entry_background' => 'transparent',
		'related_color_scheme' => 'default',
		'related_background_color' => 'default'
	);
}


function fabrique_default_font_options( $options = array() )
{
	if ( !isset ($options['primary']) || empty( $options['primary'] ) ) {
		$options['primary'] = array(
			'type' => 'google_font',
			'family' => 'Roboto',
			'style' => 'regular',
			'category' => 'sans-serif',
			'variants' => array(
				'100',
				'100italic',
				'300',
				'300italic',
				'regular',
				'italic',
				'500',
				'500italic',
				'700',
				'700italic',
				'900',
				'900italic'
			)
		);
	}

	if ( !isset( $options['secondary'] ) || empty( $options['secondary'] ) ) {
		$options['secondary'] = array(
			'type' => 'google_font',
			'family' => 'Roboto',
			'style' => '500',
			'category' => 'sans-serif',
			'variants' => array(
				'100',
				'100italic',
				'300',
				'300italic',
				'regular',
				'italic',
				'500',
				'500italic',
				'700',
				'700italic',
				'900',
				'900italic'
			)
		);
	}

	return $options;
}
add_filter( 'fabrique_fonts', 'fabrique_default_font_options' );


function fabrique_customize_options( $options )
{
	return $options;
}


function fabrique_body_class( $classes )
{
	$opts = array(
		'topbar' => fabrique_mod( 'topbar' ),
		'site_layout' => fabrique_mod( 'site_layout' ),
		'header_on_frame' => fabrique_mod( 'header_on_frame' ),
		'responsive' => fabrique_mod( 'site_responsive' ),
		'navbar_position' => fabrique_mod( 'navbar_position' ),
		'navbar_style' => fabrique_mod( 'navbar_style' ),
		'navbar_stacked_overlap' => fabrique_mod( 'navbar_stacked_overlap' ),
		'minimal_navbar_menu_style' => fabrique_mod( 'minimal_navbar_menu_style' ),
		'sidenav_style' => fabrique_mod( 'side_navbar_style' )
	);

	$classes[] = 'fbq-layout fbq-layout--' . $opts['site_layout'];

	if ( 'boxed' === $opts['site_layout'] ) {
		$classes[] = 'fbq-s-bg-bg';
	} elseif ( 'frame' === $opts['site_layout'] ) {
		if ( $opts['header_on_frame'] ) {
			$classes[] = 'header-on-frame';
		}
	}

	$page_id = fabrique_get_page_id();
	$bp_data = fabrique_bp_data( $page_id );

	if ( fabrique_is_blueprint_active( $bp_data ) ) {
		$builder = $bp_data['builder'];

		if ( isset( $builder['responsive'] ) ) {
			$opts['responsive'] = ( 'disable' === $builder['responsive'] ) ? false : true;
		}

		if ( isset( $builder['nav_style'] ) && 'default' !== $builder['nav_style'] ) {
			$navbar_style = explode( '-', $builder['nav_style'] );
			$opts['navbar_position'] = $navbar_style[0];

			if ( 'top' !== $opts['navbar_position'] ) {
				$opts['sidenav_style'] = $navbar_style[1];
			} else {
				$opts['navbar_style'] = $navbar_style[1];
			}
		}

		$opts['nav_menu'] = isset( $builder['nav_menu'] ) ? $builder['nav_menu'] : 'default';
	} else {
		$opts['nav_menu'] = 'default';
	}

	// add responsive class
	if ( $opts['responsive'] ) {
		$classes[] = 'fbq-layout-responsive';
	}

	if ( 'none' === $opts['nav_menu'] ) {
		$classes[] = 'fbq-layout--no-navbar';
	} else if ( 'top' === $opts['navbar_position'] ) {
		$classes[] = 'fbq-layout--topnav';
		$classes[] = 'fbq-layout--topnav-' . $opts['navbar_style'];

		if ( 'minimal' === $opts['navbar_style'] || 'split' === $opts['navbar_style'] ) {
			$classes[] = 'collapsed-' . $opts['minimal_navbar_menu_style'];
		} else if ( 'stacked' === $opts['navbar_style'] && $opts['navbar_stacked_overlap'] ) {
			$classes[] = 'fbq-layout--topnav-stacked-overlap';
		}
	} else if ( 'top' !== $opts['navbar_position'] ) {
		$classes[] = 'fbq-layout--sidenav';
		$classes[] = 'fbq-layout--sidenav-' . esc_attr( $opts['sidenav_style'] ) . ' fbq-layout--sidenav-' . esc_attr( $opts['sidenav_style'] ) . '-' . esc_attr( $opts['navbar_position'] );
	}

	return $classes;
}
add_filter( 'body_class', 'fabrique_body_class' );


if ( !function_exists( 'fabrique_header_content_options' ) ) :
function fabrique_header_content_options( $opts = array(), $post_id = '' )
{
	$opts['responsive'] = fabrique_mod( 'site_responsive' );
	$opts['topbar'] = fabrique_mod( 'topbar' );
	$opts['topbar_height'] = fabrique_mod( 'topbar_height' );
	$opts['enable_mobile_topbar'] = fabrique_mod( 'enable_mobile_topbar' );
	$opts['topbar_column'] = fabrique_mod( 'topbar_column' );
	$opts['topbar_color_scheme'] = fabrique_mod( 'topbar_color_scheme' );
	$opts['site_layout'] = fabrique_mod( 'site_layout' );
	$opts['frame_width'] = fabrique_mod( 'frame_width' );
	$opts['preload_style'] = fabrique_mod( 'preload_style' );
	$opts['preload_logo'] = fabrique_mod( 'preload_logo' );
	$opts['sidenav_style'] = fabrique_mod( 'side_navbar_style' );
	$opts['navbar_style'] = fabrique_mod( 'navbar_style' );
	$opts['navbar_fullwidth'] = fabrique_mod( 'navbar_fullwidth' );
	$opts['navbar_position'] = fabrique_mod( 'navbar_position' );
	$opts['footer_parallax'] = fabrique_mod( 'footer_parallax' );
	$opts['color_scheme'] = fabrique_mod( 'default_color_scheme' );
	$opts['carousel_arrow_background'] = fabrique_mod( 'carousel_arrow_background' );
	$opts['carousel_arrow_style'] = fabrique_mod( 'carousel_arrow_style' );
	$opts['navbar_background_color'] = fabrique_mod( 'navbar_background_color' );
	$opts['navbar_opacity'] = fabrique_mod( 'navbar_opacity' );
	$opts['navbar_transparent'] = ( 'transparent' === $opts['navbar_background_color'] || ( 0 == $opts['navbar_opacity'] && 'default' !== $opts['navbar_background_color'] ) ) ? true : false;
	$opts['header_transparent'] = ''; // opacity of navigation bar less than 100

	$opts['topbar_attr'] = array(
		'class' => array( 'fbq-topbar', 'fbq-' . $opts['topbar_color_scheme'] . '-scheme' ),
		'data_attr' => array(
			'height' => $opts['topbar_height'],
			'mobile' => $opts['enable_mobile_topbar']
		)
	);
	$wrapper_class = array ( 'fbq-wrapper', 'fbq-p-bg-bg' );
	$wrapper_style = array();
	$wrapper_id = array();

	// Case Blueprint Activated
	$bp_data = fabrique_bp_data( $post_id );
	if ( fabrique_is_blueprint_active( $bp_data ) ) {
		$builder = $bp_data['builder'];
		$opts['nav_menu'] = isset( $builder['nav_menu'] ) ? $builder['nav_menu'] : 'default';
		$opts['nav_menu_mobile'] = isset( $builder['nav_menu_mobile'] ) ? $builder['nav_menu_mobile'] : 'default';

		// Overide global settings from customizer
		if ( isset( $builder['preload'] ) && 'default' !== $builder['preload'] ) {
			$opts['preload_style'] = $builder['preload'];
		}
		if ( isset( $builder['footer_parallax'] ) && 'default' !== $builder['footer_parallax'] ) {
			$opts['footer_parallax'] = $builder['footer_parallax'];
		}

		if ( !$opts['footer_parallax'] && isset( $builder['page_background_color'] ) ) {
			$wrapper_style['background-color'] = fabrique_c( $builder['page_background_color'] );
		}

		if ( isset( $builder['nav_style'] ) && 'default' !== $builder['nav_style'] ) {
			$navbar = explode( '-', $builder['nav_style'] );
			$opts['navbar_position'] = $navbar[0];

			if ( 'top' === $opts['navbar_position'] ) {
				$opts['navbar_style'] = $navbar[1];

				if ( 'inline' === $opts['navbar_style'] ) {
					$opts['inline_navbar_menu_position'] = $navbar[2];
				} elseif ( 'minimal' === $opts['navbar_style'] ) {
					$opts['minimal_navbar_menu_style'] = $navbar[2];
				}
			} else {
				$opts['sidenav_style'] = $navbar[1];
			}
		}

		if ( isset( $builder['nav_transparent'] ) && $builder['nav_transparent'] && 'false' !== $builder['nav_transparent'] ) {
			$opts['navbar_transparent'] = true;
		}

		if ( isset( $builder['nav_full'] ) && 'default' !== $builder['nav_full'] ) {
			$opts['navbar_fullwidth'] = ( 'enable' === $builder['nav_full'] ) ? true : false;
		}

		if ( isset( $builder['css_class'] ) ) {
			$wrapper_class[] = $builder['css_class'];
		}

		if ( isset( $builder['css_id'] ) ) {
			$wrapper_id[] = $builder['css_id'];
		}
	} else {
		$opts['nav_menu'] = 'default';
		$opts['nav_menu_mobile'] = 'default';
	}

	$opts['body_data'] = array(
		'scheme' => $opts['color_scheme'],
		'layout' => $opts['site_layout'],
		'arrow_style' => $opts['carousel_arrow_style'],
		'arrow_background' => $opts['carousel_arrow_background']
	);

	// Frame Layout
	if ( 'frame' === $opts['site_layout'] ) {
		$opts['body_data']['frame_width'] = $opts['frame_width'];
	}

	// Parallax Footer Case
	if ( $opts['footer_parallax'] ) {
		$wrapper_class[] = 'fbq-wrapper--parallax-footer';
	}

	// Container Class
	if ( !$opts['navbar_fullwidth'] || 'false' === $opts['navbar_fullwidth'] ) {
		$opts['container_class'] = 'fbq-container';
	} else {
		$opts['container_class'] = 'fbq-container--fullwidth';
	}

	// If top navbar is transparent or opacity of top navbar less than 100
	if ( 'none' !== $opts['nav_menu'] ) {
		if ( 'top' === $opts['navbar_position'] && ( ( $opts['navbar_transparent'] && 'false' !== $opts['navbar_transparent'] ) || ( 'transparent' === $opts['navbar_background_color'] || ( 100 > $opts['navbar_opacity'] && 'default' !== $opts['navbar_background_color'] ) ) ) ) {
			$wrapper_class[] = 'fbq-wrapper--header-transparent';
			$opts['header_transparent'] = true;
		}

		// Topbar Mobile
		if ( $opts['topbar'] && $opts['enable_mobile_topbar'] ) {
			$opts['topbar_mobile'] = 'true';
			$wrapper_class[] = 'mobile-topbar-enable';
		} else {
			$opts['topbar_mobile'] = 'false';
		}
	}

	// Wrap Up wrapper attribute
	$opts['wrapper_attr'] = array(
		'class' => $wrapper_class,
		'id' => $wrapper_id,
		'style_attr' => $wrapper_style
	);

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_navbar_options' ) ) :
function fabrique_navbar_options( $opts = array() )
{
	$defaults = array(
		'is_item' => false,
		'extra_class' => '',
		'nav_menu' => 'default',
		'mobile_navbar_logo' => '',
		'logo_on' => true,
		'append_inline_style' => false,
		'logo' => fabrique_mod( 'logo' ),
		'logo_type' => fabrique_mod( 'logo_type' ),
		'logo_text_title' => fabrique_mod( 'logo_text_title' ),
		'fixed_navbar_logo' => fabrique_mod( 'fixed_navbar_logo' ),
		'fixed_navbar_logo_light' => fabrique_mod( 'fixed_navbar_logo_light_scheme' ),
		'fixed_navbar_logo_dark' => fabrique_mod( 'fixed_navbar_logo_dark_scheme' ),
		'navbar_position' => fabrique_mod( 'navbar_position' ),
		'navbar_style' => fabrique_mod( 'navbar_style' ),
		'navbar_size' => fabrique_mod( 'navbar_size' ),
		'navbar_menu_border_width' => fabrique_mod( 'navbar_menu_border_thickness' ),
		'navbar_stacked_lineheight' => fabrique_mod( 'navbar_stacked_lineheight' ),
		'navbar_fullwidth' => fabrique_mod( 'navbar_fullwidth' ),
		'navbar_menu_position' => fabrique_mod( 'navbar_menu_position' ),
		'minimal_navbar_menu_style' => fabrique_mod( 'minimal_navbar_menu_style' ),
		'inline_navbar_menu_position' => fabrique_mod( 'inline_navbar_menu_position' ),
		'navbar_full_menu_axis' => fabrique_mod( 'navbar_full_menu_axis' ),
		'navbar_menu_hover_style' => fabrique_mod( 'navbar_menu_hover_style' ),
		'navbar_stacked_overlap' => fabrique_mod( 'navbar_stacked_overlap' ),
		'navbar_color_scheme' => fabrique_mod( 'navbar_color_scheme' ),
		'dropdown_color_scheme' => fabrique_mod( 'dropdown_color_scheme' ),
		'fixed_navbar' => fabrique_mod( 'fixed_navbar' ),
		'fixed_navbar_style' => fabrique_mod( 'fixed_navbar_style' ),
		'fixed_navbar_height' => fabrique_mod( 'fixed_navbar_height' ),
		'fixed_navbar_hide' => fabrique_mod( 'fixed_navbar_hide' ),
		'fixed_navbar_transition' => fabrique_mod( 'fixed_navbar_transition' ),
		'fixed_navbar_transition_point' => fabrique_mod( 'fixed_navbar_transition_point' ),
		'navbar_background_color' => fabrique_mod( 'navbar_background_color' ),
		'navbar_opacity' => fabrique_mod( 'navbar_opacity' ),
		'fixed_navbar_background_color' => fabrique_mod( 'fixed_navbar_background_color' ),
		'fixed_navbar_opacity' => fabrique_mod( 'fixed_navbar_opacity' ),
		'header_action_button' => fabrique_mod( 'header_action_button' ),
		'action_type' =>fabrique_mod( 'action_type' ),
		'action_button_style' => fabrique_mod( 'action_button_style' ),
		'action_button_radius' => fabrique_mod( 'action_button_radius' ),
		'action_button_thickness' => fabrique_mod( 'action_button_border' ),
		'action_button_hover_style' => fabrique_mod( 'action_button_hover_style' ),
		'action_button_icon' => fabrique_mod( 'action_button_icon' ),
		'action_button_icon_position' => fabrique_mod( 'action_button_icon_position' ),
		'action_button_text' => fabrique_mod( 'action_button_text' ),
		'action_link' => fabrique_mod( 'action_link' ),
		'action_target_self' => fabrique_mod( 'action_target_self' ),
		'header_widget_col' => fabrique_mod( 'header_widget_column' ),
		'header_widget_alignment' => fabrique_mod( 'header_widget_alignment' ),
		'header_widget_color_scheme' => fabrique_mod( 'header_widget_color_scheme' ),
		'action_social_component' => fabrique_mod( 'action_social_component' ),
		'search_on' => fabrique_mod( 'navbar_search' ),
		'cart_on' => fabrique_mod( 'navbar_cart' )
	);

	if ( 'transparent' === $defaults['navbar_background_color'] || ( 0 == $defaults['navbar_opacity'] && 'default' !== $defaults['navbar_background_color'] ) ) {
		$defaults['navbar_transparent'] = true;
	} else {
		$defaults['navbar_transparent'] = false;
	}

	$defaults['navbar_stacked_lineheight'] = !empty( $defaults['navbar_stacked_lineheight'] ) ? $defaults['navbar_stacked_lineheight'] : 56;
	$defaults['navbar_full_menu_axis'] = !empty( $defaults['navbar_full_menu_axis'] ) ? $defaults['navbar_full_menu_axis'] : 'horizontal';
	$defaults['fixed_navbar_transparent'] = false;
	$defaults['two_schemes_logo'] = false;

	$opts = array_merge( $defaults, $opts );

	$opts['nav_menu_args'] = array(
		'navbar_menu' => $opts['nav_menu'],
		'navbar_style' => $opts['navbar_style'],
		'menu_position' => 'top',
		'search_on' => $opts['search_on'],
		'cart_on' => $opts['cart_on']
	);

	$opts['collapsed_classes'] = array( 'fbq-collapsed-menu' );

	$navbar_classes = array(
		'fbq-navbar',
		'fbq-navbar--' . $opts['navbar_position'],
		'fbq-navbar--' . $opts['navbar_style'],
		'fbq-highlight-' . $opts['navbar_menu_hover_style']
	);
	$navbar_inner_style_attr = array();
	$navbar_style_attr = array();
	$navbar_data_attr = array(
		'position' => $opts['navbar_position'],
		'style' => $opts['navbar_style'],
		'highlight' => $opts['navbar_menu_hover_style']
	);

	if ( !empty( $opts['extra_class'] ) ) {
		$navbar_classes[] = $opts['extra_class'];
	}

	// Do inline style for navigation menu item
	if ( $opts['append_inline_style'] ) {
		if ( 'default' !== $opts['navbar_background_color'] ) {
			$navbar_inner_style_attr['background-color'] = fabrique_hex_to_rgba( $opts['navbar_background_color'], (int)$opts['navbar_opacity']/100 );

			if ( 'transparent' !== $opts['navbar_background_color'] || 0 != $opts['navbar_opacity'] ) {
				$opts['navbar_transparent'] = false;
			}
		}

		if ( isset( $opts['navbar_border_thickness'] ) ) {
			$navbar_inner_style_attr['border-bottom-width'] = (int)$opts['navbar_border_thickness'] . 'px';
			if ( 0 == $opts['navbar_border_thickness'] ) {
				$opts['navbar_menu_border_width'] = 0;
			}
		}

		if ( isset( $opts['navbar_border_color'] ) && 'default' !== $opts['navbar_border_color'] ) {
			$navbar_inner_style_attr['border-bottom-color'] = fabrique_c( $opts['navbar_border_color'] );
		}

		if ( isset( $opts['navbar_height'] ) ) {
			$navbar_style_attr['height'] = (int)$opts['navbar_height'] . 'px';
			$navbar_style_attr['line-height'] = (int)$opts['navbar_height'] . 'px';
		}
	}

	// in case there is border width
	if ( $opts['navbar_menu_border_width'] > 0 ) {
		$navbar_classes[] = 'with-border';
	}

	// Container Class
	if ( !$opts['navbar_fullwidth'] || 'false' === $opts['navbar_fullwidth'] ) {
		$opts['container_class'] = 'fbq-container';
	} else {
		$opts['container_class'] = 'fbq-container--fullwidth';
	}

	// Top menu style
	if ( !( ( 'split' === $opts['navbar_style'] || 'minimal' === $opts['navbar_style'] ) && ( 'full' === $opts['minimal_navbar_menu_style'] || 'offcanvas' === $opts['minimal_navbar_menu_style'] ) ) ) {
		// Add dropdown scheme class
		if ( 'default' !== $opts['dropdown_color_scheme'] && $opts['navbar_color_scheme'] !== $opts['dropdown_color_scheme'] ) {
			$navbar_classes[] = 'fbq-navbar-dropdown-' . $opts['dropdown_color_scheme'] . '-scheme';
		}
	}

	if ( 'inline' === $opts['navbar_style'] ) {
		$navbar_classes[] = 'fbq-navbar--inline--' . $opts['inline_navbar_menu_position'];
	} elseif ( 'minimal' === $opts['navbar_style'] || 'split' === $opts['navbar_style'] ) {
		$navbar_data_attr['collapsed_style'] = $opts['minimal_navbar_menu_style'];
		$navbar_classes[] = $opts['minimal_navbar_menu_style'];
		$opts['collapsed_classes'][] = 'fbq-collapsed-menu--' . $opts['minimal_navbar_menu_style'];

		if ( 'full' === $opts['minimal_navbar_menu_style'] ) {
			$navbar_classes[] = 'fbq-navbar-collapsed-fixed';
			$opts['collapsed_classes'][] = 'fbq-p-bg-bg ' . $opts['navbar_full_menu_axis'];
			$opts['nav_menu_args']['menu_position'] = 'full';
		} else if ( 'offcanvas' === $opts['minimal_navbar_menu_style'] ) {
			$navbar_classes[] = 'fbq-navbar-collapsed-fixed';
			$opts['collapsed_classes'][] = 'fbq-highlight-' . $opts['navbar_menu_hover_style'];
			$opts['collapsed_classes'][] = 'fbq-' . $opts['navbar_color_scheme'] . '-scheme';
			$opts['nav_menu_args']['menu_position'] = 'side';
		}
	} else {
		$navbar_classes[] = 'fbq-navbar--' . $opts['navbar_menu_position'];
	}

	// Not stacked style the input size class
	if ( 'stacked' !== $opts['navbar_style'] ) {
		$navbar_classes[] =  'fbq-navbar--' . $opts['navbar_size'];
	} else {
		$navbar_data_attr['stacked_menu_height'] = $opts['navbar_stacked_lineheight'];

		if ( $opts['navbar_stacked_overlap'] ) {
			$navbar_classes[] = 'overlap';
			$opts['action_button_style'] = 'fill';
			$opts['action_button_hover_style'] = 'brand';
			$opts['action_button_radius'] = 0;
			$opts['action_button_thickness'] = 0;
		}
	}

	// Fixed Navigation Bar
	if ( $opts['fixed_navbar'] ) {
		$navbar_data_attr['fixed'] = 'true';

		if ( $opts['fixed_navbar_hide'] && !$opts['is_item'] ) {
			$navbar_data_attr['autohide'] = 'true';
		}

		if ( 'custom' === $opts['fixed_navbar_style'] && !$opts['is_item'] ) {
			$navbar_data_attr['transition'] = 'custom-' . $opts['fixed_navbar_transition'];
			$navbar_data_attr['transition_point'] = $opts['fixed_navbar_transition_point'];
			$navbar_data_attr['height_fixed'] = $opts['fixed_navbar_height'];

			if ( 'transparent' === $opts['fixed_navbar_background_color'] || ( 0 == $opts['fixed_navbar_opacity'] && 'default' !== $opts['fixed_navbar_background_color'] ) ) {
				$opts['fixed_navbar_transparent'] = true;
				$navbar_classes[] = 'fixed-transparent';
			}
		} else {
			$navbar_data_attr['transition'] = 'default';

			if ( $opts['navbar_transparent'] && 'false' !== $opts['navbar_transparent'] ) {
				$opts['fixed_navbar_transparent'] = true;
				$navbar_classes[] = 'fixed-transparent';
			}
		}

		// Check if have fixed navbar logo
		if ( !empty( $opts['fixed_navbar_logo'] ) ) {
			$navbar_classes[] = 'has-fixed-logo';
		}
	}

	// If Navigation bar transparent case
	if ( $opts['navbar_transparent'] && 'false' !== $opts['navbar_transparent'] ) {
		$navbar_classes[] = 'transparent';
	}

	// Check if has 2 scheme logos
	if ( ( ( $opts['navbar_transparent'] && 'false' !== $opts['navbar_transparent'] ) || ( $opts['fixed_navbar_transparent'] && 'false' !== $opts['fixed_navbar_transparent'] ) ) && !empty( $opts['fixed_navbar_logo_light'] ) && !empty( $opts['fixed_navbar_logo_dark'] ) ) {
		$opts['two_schemes_logo'] = true;
		$navbar_classes[] = 'has-two-schemes-logo';
	}

	$opts['navbar_attribute'] = array(
		'class' => $navbar_classes,
		'style_attr' => $navbar_style_attr,
		'data_attr' => $navbar_data_attr,
	);

	$opts['navbar_inner_style'] = $navbar_inner_style_attr;

	// if not item then add micro data
	if ( !$opts['is_item'] ) {
		$opts['navbar_attribute']['data_attr']['role'] = 'navigation';
		$opts['navbar_attribute']['itemscope'] = true;
		$opts['navbar_attribute']['itemtype'] = 'http://schema.org/SiteNavigationElement';
	} else {
		$opts['navbar_attribute']['data_attr']['role'] = 'item';
	}

	$opts['header_widgets_class'] = array(
		'fbq-header-widgets',
		'fbq-' . $opts['header_widget_alignment'] . '-align',
		'fbq-' . $opts['header_widget_color_scheme'] . '-scheme'
	);

	$opts['action_button_args'] = array(
		'button_style' => $opts['action_button_style'],
		'button_hover' => $opts['action_button_hover_style'],
		'button_radius' => $opts['action_button_radius'],
		'button_thickness' => $opts['action_button_thickness'],
		'button_icon' => $opts['action_button_icon'],
		'button_icon_position' => $opts['action_button_icon_position'],
		'button_label' => $opts['action_button_text'],
		'button_link' => ( 'link' === $opts['action_type'] ) ? $opts['action_link'] : '#' ,
		'button_target_self' => $opts['action_target_self'],
		'button_extra_class' => 'fbq-navbar-widget',
		'button_link_extra_class' => 'js-header-' . $opts['action_type'] . '-btn'
	);

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_navbar_mobile_options' ) ) :
function fabrique_navbar_mobile_options( $opts = array() )
{
	$defaults = array(
		'is_item' => false,
		'extra_class' => '',
		'nav_menu' => 'default',
		'nav_menu_mobile' => 'default',
		'logo_on' => true,
		'append_inline_style' => false,
		'mobile_navbar_logo' => fabrique_mod( 'mobile_navbar_logo' ),
		'logo' => fabrique_mod( 'logo' ),
		'logo_type' => fabrique_mod( 'logo_type' ),
		'logo_text_title' => fabrique_mod( 'logo_text_title' ),
		'fixed_navbar_logo' => fabrique_mod( 'fixed_navbar_logo' ),
		'fixed_navbar_logo_light' => fabrique_mod( 'fixed_navbar_logo_light_scheme' ),
		'fixed_navbar_logo_dark' => fabrique_mod( 'fixed_navbar_logo_dark_scheme' ),
		'navbar_position' => fabrique_mod( 'navbar_position' ),
		'mobile_navbar_style' => fabrique_mod( 'mobile_navbar_style' ),
		'navbar_color_scheme' => fabrique_mod( 'navbar_color_scheme' ),
		'navbar_fullwidth' => fabrique_mod( 'navbar_fullwidth' ),
		'fixed_navbar' => fabrique_mod( 'fixed_navbar' ),
		'fixed_navbar_style' => fabrique_mod( 'fixed_navbar_style' ),
		'fixed_navbar_height' => fabrique_mod( 'fixed_navbar_height' ),
		'fixed_navbar_hide' => fabrique_mod( 'fixed_navbar_hide' ),
		'fixed_navbar_transition' => fabrique_mod( 'fixed_navbar_transition' ),
		'fixed_navbar_transition_point' => fabrique_mod( 'fixed_navbar_transition_point' ),
		'navbar_background_color' => fabrique_mod( 'navbar_background_color' ),
		'navbar_opacity' => fabrique_mod( 'navbar_opacity' ),
		'fixed_navbar_background_color' => fabrique_mod( 'fixed_navbar_background_color' ),
		'fixed_navbar_opacity' => fabrique_mod( 'fixed_navbar_opacity' ),
		'header_action_button' => fabrique_mod( 'header_action_button' ),
		'action_mobile_display' => fabrique_mod( 'action_mobile_display' ),
		'action_type' =>fabrique_mod( 'action_type' ),
		'action_button_style' => fabrique_mod( 'action_button_style' ),
		'action_button_radius' => fabrique_mod( 'action_button_radius' ),
		'action_button_thickness' => fabrique_mod( 'action_button_border' ),
		'action_button_hover_style' => fabrique_mod( 'action_button_hover_style' ),
		'action_button_icon' => fabrique_mod( 'action_button_icon' ),
		'action_button_icon_position' => fabrique_mod( 'action_button_icon_position' ),
		'action_button_text' => fabrique_mod( 'action_button_text' ),
		'action_link' => fabrique_mod( 'action_link' ),
		'action_target_self' => fabrique_mod( 'action_target_self' ),
		'action_social_component' => fabrique_mod( 'action_social_component' ),
		'search_on' => fabrique_mod( 'navbar_search' ),
		'cart_on' => fabrique_mod( 'navbar_cart' )
	);
	$defaults['fixed_navbar_transparent'] = false;
	$defaults['two_schemes_logo'] = false;

	if ( 'transparent' === $defaults['navbar_background_color'] || ( 0 == $defaults['navbar_opacity'] && 'default' !== $defaults['navbar_background_color'] ) ) {
		$defaults['navbar_transparent'] = true;
	} else {
		$defaults['navbar_transparent'] = false;
	}

	$defaults['mobile_navbar_style'] = !empty( $defaults['mobile_navbar_style'] ) ? $defaults['mobile_navbar_style'] : 'full';
	$opts = array_merge( $defaults, $opts );

	$opts['nav_menu_args'] = array(
		'navbar_menu' => $opts['nav_menu'],
		'navbar_menu_mobile' => $opts['nav_menu_mobile'],
		'navbar_style' => $opts['mobile_navbar_style'],
		'menu_position' => $opts['mobile_navbar_style'],
		'search_on' => $opts['search_on'],
		'cart_on' => $opts['cart_on']
	);

	$navbar_mobile_classes = array(
		'fbq-navbar--mobile',
		'fbq-navbar--mobile--' . $opts['navbar_position'],
		'fbq-navbar--mobile--' . $opts['mobile_navbar_style'],
		$opts['extra_class']
	);
	$navbar_mobile_style_attr = array();
	$navbar_inner_style_attr = array();
	$navbar_mobile_data_attr = array(
		'position' => $opts['navbar_position'],
		'style' => $opts['mobile_navbar_style'],
		'collapsed_style' => $opts['mobile_navbar_style']
	);

	// Do inline style for navigation menu item
	if ( $opts['append_inline_style'] ) {
		if ( 'default' !== $opts['navbar_background_color'] ) {
			$navbar_inner_style_attr['background-color'] = fabrique_hex_to_rgba( $opts['navbar_background_color'], $opts['navbar_opacity'] );

			if ( 'transparent' !== $opts['navbar_background_color'] || 0 != $opts['navbar_opacity'] ) {
				$opts['navbar_transparent'] = false;
			}
		}

		if ( isset( $opts['navbar_border_thickness'] ) ) {
			$navbar_inner_style_attr['border-bottom-width'] = $opts['navbar_border_thickness'] . 'px';
		}

		if ( isset( $opts['navbar_border_color'] ) && 'default' !== $opts['navbar_border_color'] ) {
			$navbar_inner_style_attr['border-bottom-color'] = fabrique_c( $opts['navbar_border_color'] );
		}

		if ( isset( $opts['navbar_height'] ) ) {
			$navbar_mobile_style_attr['height'] = (int)$opts['navbar_height'] . 'px';
			$navbar_mobile_style_attr['line-height'] = (int)$opts['navbar_height'] . 'px';
		}
	}

	// Container Class
	if ( !$opts['navbar_fullwidth'] || 'false' === $opts['navbar_fullwidth'] ) {
		$opts['container_class'] = 'fbq-container';
	} else {
		$opts['container_class'] = 'fbq-container--fullwidth';
	}

	// Fixed Navigation Bar
	if ( $opts['fixed_navbar'] ) {
		$navbar_mobile_data_attr['fixed'] = 'true';

		if ( $opts['fixed_navbar_hide'] && !$opts['is_item'] ) {
			$navbar_mobile_data_attr['autohide'] = 'true';
		}

		if ( 'custom' === $opts['fixed_navbar_style'] && !$opts['is_item'] ) {
			$navbar_mobile_data_attr['transition'] = 'custom-' . $opts['fixed_navbar_transition'];
			$navbar_mobile_data_attr['transition_point'] = $opts['fixed_navbar_transition_point'];
			$navbar_mobile_data_attr['height_fixed'] = $opts['fixed_navbar_height'];

			if ( 'transparent' === $opts['fixed_navbar_background_color'] || ( 0 == $opts['fixed_navbar_opacity'] && 'default' !== $opts['fixed_navbar_background_color'] ) ) {
				$opts['fixed_navbar_transparent'] = true;
				$navbar_mobile_classes[] = 'fixed-transparent';
			}
		} else {
			$navbar_mobile_data_attr['transition'] = 'default';

			if ( $opts['navbar_transparent'] && 'false' !== $opts['navbar_transparent'] ) {
				$opts['fixed_navbar_transparent'] = true;
				$navbar_mobile_classes[] = 'fixed-transparent';
			}
		}

		// Check if have fixed navbar logo
		if ( !empty( $opts['fixed_navbar_logo'] ) ) {
			$navbar_mobile_classes[] = 'has-fixed-logo';
		}
	}

	// If Navigation bar transparent case
	if ( $opts['navbar_transparent'] && 'false' !== $opts['navbar_transparent'] ) {
		$navbar_mobile_classes[] = 'transparent';
	}

	// Check if has 2 scheme logos
	if ( ( ( $opts['navbar_transparent'] && 'false' !== $opts['navbar_transparent'] ) || ( $opts['fixed_navbar_transparent'] && 'false' !== $opts['fixed_navbar_transparent'] ) ) && !empty( $opts['fixed_navbar_logo_light'] ) && !empty( $opts['fixed_navbar_logo_dark'] ) ) {
		$opts['two_schemes_logo'] = true;
		$navbar_mobile_classes[] = 'has-two-schemes-logo';
	}

	$opts['navbar_mobile_attr'] = array(
		'class' => $navbar_mobile_classes,
		'style_attr' => $navbar_mobile_style_attr,
		'data_attr' => $navbar_mobile_data_attr
	);

	$opts['navbar_inner_style'] = $navbar_inner_style_attr;

	// if not item then add micro data
	if ( !$opts['is_item'] ) {
		$opts['navbar_mobile_attr']['data_attr']['role'] = 'navigation';
		$opts['navbar_mobile_attr']['itemscope'] = true;
		$opts['navbar_mobile_attr']['itemtype'] = 'http://schema.org/SiteNavigationElement';
	} else {
		$opts['navbar_mobile_attr']['data_attr']['role'] = 'item';
	}

	$opts['action_button_args'] = array(
		'button_style' => $opts['action_button_style'],
		'button_hover' => $opts['action_button_hover_style'],
		'button_radius' => $opts['action_button_radius'],
		'button_thickness' => $opts['action_button_thickness'],
		'button_icon' => $opts['action_button_icon'],
		'button_icon_position' => $opts['action_button_icon_position'],
		'button_label' => $opts['action_button_text'],
		'button_link' => ( 'link' === $opts['action_type'] ) ? $opts['action_link'] : '#' ,
		'button_target_self' => $opts['action_target_self'],
		'button_extra_class' => 'fbq-navbar-widget',
		'button_link_extra_class' => 'js-header-' . $opts['action_type'] . '-btn'
	);

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_side_navbar_options' ) ) :
function fabrique_side_navbar_options( $opts = array() )
{
	$defaults = array(
		'is_item' => false,
		'nav_menu' => 'default',
		'mobile_navbar_logo' => '',
		'logo' => fabrique_mod( 'logo' ),
		'logo_type' => fabrique_mod( 'logo_type' ),
		'logo_text_title' => fabrique_mod( 'logo_text_title' ),
		'fixed_navbar_logo' => fabrique_mod( 'fixed_navbar_logo' ),
		'fixed_navbar_logo_light' => fabrique_mod( 'fixed_navbar_logo_light_scheme' ),
		'fixed_navbar_logo_dark' => fabrique_mod( 'fixed_navbar_logo_dark_scheme' ),
		'navbar_position' => fabrique_mod( 'navbar_position' ),
		'sidenav_style' => fabrique_mod( 'side_navbar_style' ),
		'navbar_fullwidth' => fabrique_mod( 'navbar_fullwidth' ),
		'side_navbar_menu_alignment' => fabrique_mod( 'side_navbar_menu_alignment' ),
		'navbar_menu_hover_style' => fabrique_mod( 'navbar_menu_hover_style' ),
		'navbar_color_scheme' => fabrique_mod( 'navbar_color_scheme' ),
		'navbar_full_menu_axis' => fabrique_mod( 'navbar_full_menu_axis' ),
		'search_on' => fabrique_mod( 'navbar_search' ),
		'cart_on' => fabrique_mod( 'navbar_cart' )
	);
	$opts['two_schemes_logo'] = false;
	$defaults['navbar_full_menu_axis'] = !empty( $defaults['navbar_full_menu_axis'] ) ? $defaults['navbar_full_menu_axis'] : 'horizontal';
	$opts = array_merge( $defaults, $opts );

	$opts['nav_menu_args'] = array(
		'navbar_menu' => $opts['nav_menu'],
		'navbar_style' => $opts['sidenav_style'],
		'menu_position' => 'side',
		'search_on' => $opts['search_on'],
		'cart_on' => $opts['cart_on']
	);

	// Navbar Attribute
	$opts['collapsed_classes'] = array( 'fbq-collapsed-menu' );
	$navbar_data_attr = array(
		'position' => $opts['navbar_position'],
		'style' => $opts['sidenav_style']
	);
	$navbar_classes = array(
		'fbq-side-navbar',
		'fbq-side-navbar--' . $opts['navbar_position'],
		'fbq-side-navbar--' . $opts['sidenav_style'],
		'fbq-' . $opts['side_navbar_menu_alignment'] . '-align',
		'fbq-highlight-' . $opts['navbar_menu_hover_style']
	);

	if ( 'minimal' === $opts['sidenav_style'] && !empty( $opts['fixed_navbar_logo_light'] ) && !empty( $opts['fixed_navbar_logo_dark'] ) ) {
		$opts['two_schemes_logo'] = true;
		$navbar_classes[] = 'has-two-schemes-logo';
	}

	if ( 'fixed' !== $opts['sidenav_style'] ) {
		$navbar_data_attr['collapsed_style'] =  $opts['sidenav_style'];
		$opts['collapsed_classes'][] = 'fbq-collapsed-menu--' . $opts['sidenav_style'];

		if ( 'full' === $opts['sidenav_style'] ) {
			$opts['collapsed_classes'][] = 'fbq-p-bg-bg';
			$opts['collapsed_classes'][] = $opts['navbar_full_menu_axis'];
			$opts['nav_menu_args']['menu_position'] = 'full';
		}
	}

	$opts['navbar_attribute'] = array(
		'class' => $navbar_classes,
		'data_attr' => $navbar_data_attr
	);

	// if not item then add micro data
	if ( !$opts['is_item'] ) {
		$opts['navbar_attribute']['data_attr']['role'] = 'navigation';
		$opts['navbar_attribute']['itemscope'] = true;
		$opts['navbar_attribute']['itemtype'] = 'http://schema.org/SiteNavigationElement';
	} else {
		$opts['navbar_attribute']['data_attr']['role'] = 'item';
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_footer_options' ) ) :
function fabrique_footer_options( $opts = array(), $post_id = '' )
{
	$opts['back_to_top'] = fabrique_mod( 'back_to_top' );
	$back_to_top_background = fabrique_mod( 'back_to_top_background' );
	$back_to_top_style = fabrique_mod( 'back_to_top_style' );
	$opts['back_to_top_background'] = !empty( $back_to_top_background ) ? $back_to_top_background : 'square' ;
	$opts['back_to_top_style'] = !empty( $back_to_top_style ) ? $back_to_top_style : 'arrow-bold';
	$opts['cookies_notice'] = fabrique_mod( 'cookies_notice' );
	$opts['cookies_notice_color_scheme'] = fabrique_mod( 'cookies_notice_color_scheme' );
	$opts['cookies_notice_style_attr'] = array();
	$opts['cookies_notice_message'] = fabrique_mod( 'cookies_notice_message' );
	$cookies_bg_color = fabrique_mod( 'cookies_notice_background_color' );
	if ( 'default' !== $cookies_bg_color ) {
		$cookies_bg_opacity = fabrique_mod( 'cookies_notice_background_opacity' );
		$opts['cookies_notice_style_attr']['background-color'] = fabrique_hex_to_rgba( $cookies_bg_color, $cookies_bg_opacity/100 );
	}

	$bp_data = fabrique_bp_data( $post_id );
	if ( fabrique_is_blueprint_active( $bp_data ) ) {
		$defaults = array(
			'full_page_scroll' => false,
			'half_page_scroll' => false,
			'back_to_top' => 'default',
			'footer' => 'footer',
			'footer_id' => ''
		);
		$builder = array_merge( $defaults, $bp_data['builder'] );

		if ( !$builder['full_page_scroll'] && !$builder['half_page_scroll'] ) {
			if ( 'default' !== $builder['back_to_top'] ) {
				$opts['back_to_top'] = ( 'enable' === $builder['back_to_top'] ) ? true : false;
			}
			$opts['footer_active'] = ( 'none' !== $builder['footer'] ) ? true : false;
		} else {
			$opts['footer_active'] = false;
		}

		$opts['footer_id'] = !empty( $builder['footer_id'] ) ? $builder['footer_id'] : fabrique_mod( 'footer_id' );
	} else {
		$opts['footer_active'] = fabrique_mod( 'footer' );
		$opts['footer_id'] = fabrique_mod( 'footer_id' );
	}

	$opts['footer_id'] = apply_filters( 'wpml_object_id', $opts['footer_id'], 'twcbp_block', TRUE );

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_post_options' ) ) :
function fabrique_post_options( $opts = array(), $post_id = '' )
{
	$defaults = array(
		'builder' => array(
			'active' => false,
		),
		'sidebar' => false,
		'sidebar_select' => '',
		'sidebar_position' => 'right',
		'sidebar_fixed' => false,
		'sidebar_background_color' => 'transparent',
		'sidebar_color_scheme' => '',
		'class' => array( 'fbq-content' ),
		'id' => array( 'main' ),
		'style_attr' => array()
	);

	$bp_data = get_post_meta( $post_id, 'bp_data', true );
	$bp_data = is_array( $bp_data ) ? $bp_data : array();
	$opts = array_merge( $defaults, $bp_data );

	$opts['blueprint_active'] = $opts['builder']['active'];

	if ( !$opts['blueprint_active'] ) {
		$default_post_settings = fabrique_default_post_options();
		$mode = get_post_meta( $post_id, 'bp_post_settings_mode', true );
		if ( 'custom' === $mode ) {
			$opts = get_post_meta( $post_id, 'bp_post_settings', true );
			if ( empty( $opts ) ) {
				$opts = fabrique_mod( 'post_settings', $default_post_settings );
			}
		} else {
			$opts = fabrique_mod( 'post_settings', $default_post_settings );
		}

		$opts = array_merge( $default_post_settings, $opts );

		array_walk( $opts, 'fabrique_sanitize_boolean_value_walker' );
		$breadcrumb_color_scheme = isset( $opts['breadcrumb_color_scheme'] ) ? $opts['breadcrumb_color_scheme'] : 'default';

		$opts['breadcrumb_args'] = array(
			'breadcrumb_on' => $opts['breadcrumb'],
			'title_on' => false,
			'subtitle_on' => false,
			'breadcrumb_position' => 'top',
			'breadcrumb_alignment' => $opts['breadcrumb_alignment'],
			'color_scheme' => $breadcrumb_color_scheme,
			'dynamic_nav' => false,
			'breadcrumb_color' => $opts['breadcrumb_color'],
			'background_color' => $opts['breadcrumb_background'],
			'background_opacity' => $opts['breadcrumb_opacity'],
		);

		$opts['social_args'] = array(
			'style' => 'icon',
			'divider' => $opts['social_divider'],
			'components' => $opts['social_components'],
			'size' => $opts['social_size'],
			'auto_color' => $opts['social_auto_color'],
			'color' => $opts['social_color'],
			'icon_style' => $opts['social_icon_style'],
			'icon_hover_style' => $opts['social_icon_hover_style'],
			'icon_hover_color' => $opts['social_icon_hover_color'],
			'counter' => $opts['social_counter']
		);

		$opts['nav_args'] = array(
			'type' => 'navigation',
			'style' => $opts['navigation_style']
		);

		$opts['related_post_args'] = array(
			'type' => 'fbq-relatedpost',
			'style' => 'grid',
			'no_of_items' => $opts['related_items'],
			'no_of_columns' => $opts['related_column'],
			'thumbnail_on' => $opts['related_thumbnail'],
			'date_on' => $opts['related_date'],
			'background_color' => $opts['related_entry_background'],
			'heading' => $opts['related_title']
		);

		$opts['class'] = array( 'fbq-content' );
		$opts['id'] = 'main';
		$opts['itemprop'] = 'mainContentOfPage';
		$opts['itemscope'] = true;
		$opts['itemtype'] = 'http://schema.org/Article';
		$opts['content_wrapper_style'] = array();
		$opts['layout_class'] = array( 'fbq-post' );

		if ( 'none' === $opts['featured_media_layout'] || 'standard' === $opts['featured_media_layout'] ) {
			$content_extra_class = 'fbq-content--no-header';
		} else {
			$content_extra_class = 'fbq-content--with-header';
		}

		if ( $opts['sidebar'] ) {
			$opts['layout_class'][] = 'fbq-post--with-sidebar';
		} else {
			$opts['layout_class'][] = 'fbq-post--no-sidebar';
		}

		$opts['featured_media_args'] = false;
		$opts['featured_post_format'] = false;
		$opts['featured_media_attr'] = false;
		$opts['featured_background_attr'] = false;

		if ( 'none' !== $opts['featured_media_layout'] ) {
			$post_format = get_post_format( $post_id );
			$featured_media = get_post_meta( $post_id, 'bp_post_format_settings', true );
			$thumbnail_id = get_post_thumbnail_id( $post_id );
			$background_attr = false;

			if ( !$post_format ) {
				$post_format = 'standard';
			}

			if ( empty( $thumbnail_id ) && ( 'standard' === $post_format || empty( $featured_media ) ) ) {
				$opts['featured_media_layout'] = 'none';
			}

			$media_args = array(
				'post_format' => $post_format,
				'image_id' => $thumbnail_id,
				'image_size' => 'full'
			);

			if ( true === is_array( $featured_media ) ) {
				$media_args = array_merge( $media_args, $featured_media );
			}

			$opts['layout_class'][] = 'fbq-post-format--' . $post_format;
			$media_class = array(
				'fbq-post-media',
				'fbq-post-media--' . $post_format
			);
			$media_data_attr = array();

			if ( 'fullwidth' === $opts['featured_media_layout'] ) {
				$media_class[] = 'js-dynamic-navbar';

				if ( 'standard' === $post_format ) {
					$background_attr = array(
						'background_id' => $thumbnail_id,
						'overlay_on' => true
					);

					if ( $opts['featured_media_parallax'] ) {
						$background_attr['parallax_speed'] = 5;
						$background_attr['content_fade'] = true;
					}
				} elseif ( 'audio' === $post_format ) {
					if ( isset( $featured_media['audio'] ) && !empty( $featured_media['audio'] ) ) {
						$media_class[] = 'fbq-post-media--audio-selfhosted';
					} elseif ( !empty( $featured_media['audio-external'] ) ) {
						$media_class[] = 'fbq-post-media--audio-external';
						$content_extra_class = 'fbq-content--no-header';
					}
				} elseif ( 'quote' === $post_format ) {
					$media_data_attr['scheme'] = 'dark';
				}

				$media_data_attr['scheme'] = $opts['featured_media_scheme'];
			}

			$opts['featured_media_attr'] = array(
				'class' => $media_class,
				'data_attr' => $media_data_attr
			);

			$opts['class'][] = $content_extra_class;
			$opts['featured_media_args'] = $media_args;
			$opts['featured_post_format'] = $post_format;
			$opts['featured_background_attr'] = $background_attr;
		}

		$opts['layout_class'][] = 'fbq-post-featured--' . $opts['featured_media_layout'];

		// Comment part
		$opts['comment_attr'] = array(
			'class' => array( 'fbq-comment' ),
			'style_attr' => array(),
			'id' => array( 'comments' )
		);

		if ( 'default' !== $opts['comment_color_scheme'] && !$opts['sidebar'] ) {
			$opts['comment_attr']['class'][] = 'fbq-' . $opts['comment_color_scheme'] . '-scheme';
		}

		if ( 'default' !== $opts['comment_background_color'] && !$opts['sidebar'] ) {
			$opts['comment_attr']['style_attr']['background-color'] = fabrique_c( $opts['comment_background_color'] );
		}

		// Related post part
		$opts['related_attr'] = array(
			'class' => array( 'fbq-post-related' ),
			'style_attr' => array()
		);

		if ( 'default' !== $opts['related_color_scheme'] && !$opts['sidebar'] ) {
			$opts['related_attr']['class'][] = 'fbq-' . $opts['related_color_scheme'] . '-scheme';
		}

		if ( 'default' !== $opts['related_background_color'] && !$opts['sidebar'] ) {
			$opts['related_attr']['style_attr']['background-color'] = fabrique_c( $opts['related_background_color'] );
		}

		$opts['blueprint_active'] = false;
	}

	$opts['post_id'] = $post_id;

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_page_content_options' ) ) :
function fabrique_page_content_options( $post_id = '' )
{
	$defaults = array(
		'builder' => array(
			'active' => false
		),
		'sidebar' => false,
		'sidebar_select' => '',
		'sidebar_position' => 'right',
		'sidebar_fixed' => false,
		'sidebar_background_color' => 'transparent',
		'sidebar_color_scheme' => '',
		'class' => array( 'fbq-content' ),
		'id' => array( 'main' ),
		'style_attr' => array(),
		'itemprop' => 'mainContentOfPage'
	);

	$bp_data = get_post_meta( $post_id, 'bp_data', true );
	$bp_data = is_array( $bp_data ) ? $bp_data : array();
	$opts = array_merge( $defaults, $bp_data );
	$opts['blueprint_active'] = $opts['builder']['active'];

	if ( !$opts['blueprint_active'] ) {
		$opts['builder'] = array(
			'header' => 'title',
			'title' => array(
				'background_color' => 'default',
				'components' => array( 'title' )
			)
		);
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_product_options' ) ) :
function fabrique_product_options( $opts = array(), $post_id = '' )
{
	$defaults = array(
		'builder' => array(
			'active' => false,
		),
		'sidebar' => fabrique_mod( 'product_sidebar' ),
		'sidebar_select' => fabrique_mod( 'product_sidebar_select' ),
		'sidebar_position' => fabrique_mod( 'product_sidebar_position' ),
		'sidebar_fixed' => fabrique_mod( 'product_sidebar_fixed' ),
		'sidebar_background_color' => 'default',
		'sidebar_color_scheme' => '',
		'class' => array( 'fbq-content' ),
		'id' => array( 'main' ),
		'style_attr' => array(),
		'content_wrapper_style' => array(),
		'footer_parallax' => fabrique_mod( 'footer_parallax' ),
		'main_container_class' => 'fbq-container'
	);

	$bp_data = get_post_meta( $post_id, 'bp_data', true );
	$bp_data = is_array( $bp_data ) ? $bp_data : array();
	$opts = array_merge( $defaults, $bp_data );
	$builder = $opts['builder'];

	if ( $opts['builder']['active'] && 'false' !== $opts['builder']['active'] ) {
		$opts['class'][] = 'product-blueprint-active';
		if ( 'none' !== $builder['sidebar'] && isset( $builder['sidebar_id'] ) ) {
			$opts['sidebar'] = true;
			$opts['sidebar_select'] = $builder['sidebar_id'];
			$opts['sidebar_position'] = $builder['sidebar'];
			$opts['sidebar_fixed'] = $builder['sidebar_fixed'];

			if ( isset( $builder['sidebar_full'] ) && $builder['sidebar_full'] ) {
				$opts['main_container_class'] = 'fbq-container--fullwidth';
			}
		}

		if ( 'none' === $builder['header'] ) {
			$opts['class'][] = 'fbq-content--no-header';
		} else {
			$opts['class'][] = 'fbq-content--with-header';
			$opts['content_wrapper_style'] = fabrique_get_spacing_style( $opts['builder'], 'padding' );
		}

		// Overide Footer parallax global setting
		if ( isset( $builder['footer_parallax'] ) && 'default' !== $builder['footer_parallax'] ) {
			$opts['footer_parallax'] = ( 'enable' === $builder['footer_parallax'] ) ? true : false;
		}

		if ( isset( $builder['sidebar_background_color'] ) ) {
			$opts['sidebar_background_color'] = $builder['sidebar_background_color'];
		}

		if ( isset( $builder['sidebar_color_scheme'] ) ) {
			$opts['sidebar_color_scheme'] = $builder['sidebar_color_scheme'];
		}

		if ( $opts['footer_parallax'] && isset( $builder['page_background_color'] ) ) {
			$opts['style_attr']['background-color'] = fabrique_c( $builder['page_background_color'] );
		}
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_blueprint_content_options' ) ) :
function fabrique_blueprint_content_options( $opts = array() )
{
	$builder = $opts['builder'];
	$builder_defaults = array(
		'header' => 'none',
		'sidebar' => false,
		'sidebar_id' => '',
		'half_page_scroll' => false,
		'full_page_scroll' => false,
		'footer_parallax' => fabrique_mod( 'footer_parallax' )
	);
	$builder = array_merge( $builder_defaults, $opts['builder'] );
	$opts['content_wrapper_style'] = fabrique_get_spacing_style( $builder, 'padding' );
	$opts['half_page_scroll'] = $builder['half_page_scroll'];
	$opts['full_page_scoll'] = $builder['full_page_scroll'];
	$opts['footer_parallax'] = $builder['footer_parallax'];
	$opts['scroll_page'] = $opts['full_page_scoll'] || $opts['half_page_scroll'];
	$opts['main_container_class'] = 'fbq-container';
	$opts['main_wrapper_class'] = array( 'fbq-main-wrapper' );

	if ( !$opts['scroll_page'] && 'none' !== $builder['sidebar'] && !empty( $builder['sidebar_id'] ) ) {
		$opts['sidebar'] = true;
		$opts['sidebar_select'] = $builder['sidebar_id'];

		if ( isset( $builder['sidebar_full'] ) && $builder['sidebar_full'] ) {
			$opts['main_container_class'] = 'fbq-container--fullwidth';
		}

		if ( isset( $builder['sidebar_fixed'] ) ) {
			$opts['sidebar_fixed'] = $builder['sidebar_fixed'];
		}

		if ( isset( $builder['sidebar'] ) ) {
			$opts['sidebar_position'] = $builder['sidebar'];
		}

		if ( isset( $builder['sidebar_background_color'] ) ) {
			$opts['sidebar_background_color'] = $builder['sidebar_background_color'];
		}

		if ( isset( $builder['sidebar_color_scheme'] ) ) {
			$opts['sidebar_color_scheme'] = $builder['sidebar_color_scheme'];
		}
	} else {
		$opts['sidebar'] = false;
	}

	if ( $opts['scroll_page'] ) {
		$opts['class'][] = 'fbq-content--with-header';
	} else {
		if ( 'none' === $builder['header'] ) {
			$opts['class'][] = 'fbq-content--no-header';
		} else {
			$opts['class'][] = 'fbq-content--with-header';
		}
	}

	if ( $opts['full_page_scoll'] ) {
		$opts['main_wrapper_class'][] = 'fbq-scrollpage';
		$opts['main_wrapper_class'][] = 'fbq-scrollpage--full';
		$opts['main_wrapper_class'][] = 'fbq-scrollpage--full--' . $builder['scroll_direction'];
	}

	if ( $opts['half_page_scroll'] ) {
		$opts['main_wrapper_class'][] = 'fbq-scrollpage';
		$opts['main_wrapper_class'][] = 'fbq-scrollpage--half';
	}

	if ( $opts['footer_parallax'] && isset( $builder['page_background_color'] ) ) {
		$opts['style_attr']['background-color'] = fabrique_c( $builder['page_background_color'] );
	}

	$section_indexes = array();
	foreach ( $opts['sections'] as $key => $section ) {
		$section_indexes[$key] = $section['index'];
	}

	array_multisort( $section_indexes, SORT_ASC, $opts['sections'] );

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_section_content_options' ) ) :
function fabrique_section_content_options( $opts = array() )
{
	$defaults = array(
		'section' => array(),
		'index' => 1,
		'sidebar' => false,
		'scroll_page' => false,
		'half_page_scroll' => false
	);

	$section_defaults = array(
		'blocks' => array(),
		'sid' => array(),
		'full_width' => false,
		'fit_height' => false,
		'fit_height_percent' => 100,
		'fit_height_offset' => '',
		'vertical' => 'middle',
		'color_scheme' => 'default',
		'border_thickness' => 0
	);

	$opts = array_merge( $defaults, $opts );
	$section = array_merge( $section_defaults, $opts['section'] );
	$opts['section_wrapper_attr'] = array(
		'class' => 'fbq-section-wrapper fbq-' . $section['vertical'] . '-vertical',
		'style_attr' => fabrique_get_spacing_style( $section, 'padding' )
	);
	$opts['container_class'] = ( $section['full_width'] || $opts['half_page_scroll'] ) ? 'fbq-container--fullwidth' : 'fbq-container';

	$section_class = array( 'fbq-section', 'js-dynamic-navbar', 'fbq-p-border-border' );
	$section_data = array( 'index' => $opts['index'] );

	if ( 'default' !== $section['color_scheme'] && fabrique_mod( 'default_color_scheme' ) !== $section['color_scheme'] ) {
		$section_class[] = 'fbq-' . $section['color_scheme'] . '-scheme';
		$section_data['scheme'] = $section['color_scheme'];
	}

	$section_style = array();
	if ( $section['fit_height'] && !$opts['scroll_page'] ) {
		$section_class[] = 'fbq-section--fit-height';
		$section_data['screen_percent'] = (int)$section['fit_height_percent'];
		$section_style['height'] = (int)$section['fit_height_percent'] . 'vh';
		$section_style['line-height'] = (int)$section['fit_height_percent'] . 'vh';

		if ( !empty( $section['fit_height_offset'] ) ) {
			$section_data['screen_offset'] = $section['fit_height_offset'];
		}
	}

	$hidden_classes = array(
		'pc_hidden' => 'fbq-pc-hidden',
		'tablet_landscape_hidden' => 'fbq-tablet-landscape-hidden',
		'tablet_hidden' => 'fbq-tablet-hidden',
		'mobile_hidden' => 'fbq-mobile-hidden',
		'force_mobile_center' => 'fbq-force-center-mobile'
	);

	foreach ( $hidden_classes as $option => $hidden_class ) {
		if ( isset( $section[$option] ) && $section[$option] ) {
			$section_class[] = $hidden_class;
		}
	}

	if ( $section['border_thickness'] > 0 && 'transparent' !== $section['border_color'] ) {
		$section_style['border-bottom-width'] = $section['border_thickness'] . 'px';
		$section_style['border-bottom-style'] = 'solid';
		$section_style['border-bottom-color'] = fabrique_c( $section['border_color'] );
	}

	$margin = fabrique_get_spacing_style( $section, 'margin' );
	$section_style = array_merge( $section_style, $margin );

	$opts['section_attr'] = array(
		'id' => $section['sid'],
		'class' => $section_class,
		'style_attr' => $section_style,
		'data_attr' => $section_data,
	);

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_index_options' ) ) :
function fabrique_index_options( $opts = array() )
{
	global $wp_query;
	$opts['sidebar'] = fabrique_mod( 'sidebar' );
	$opts['sidebar_position'] = fabrique_mod( 'sidebar_position' );
	$opts['content_class'] = 'fbq-content';
	$opts['content_class'] .= ( fabrique_mod( 'page_title' ) ) ? ' fbq-content--with-header' : ' fbq-content--no-header';
	$opts['container_class'] = ( fabrique_mod( 'blog_full_width' ) ) ? 'fbq-container--fullwidth' : 'fbq-container';

	$opts['entries_args'] = array(
		'type' => 'fbq-blog',
		'style' => fabrique_mod( 'blog_style' ),
		'layout' => is_home() ? fabrique_mod( 'blog_layout' ) : 'grid',
		'list_thumbnail_size' => fabrique_mod( 'blog_list_thumbnail_size' ),
		'no_of_columns' => fabrique_mod( 'blog_columns' ),
		'alignment' => fabrique_mod( 'blog_alignment' ),
		'featured_media' => fabrique_mod( 'blog_featured_media' ),
		'image_size' => fabrique_mod( 'blog_image_size' ),
		'image_ratio' => fabrique_mod( 'blog_image_ratio' ),
		'image_hover' => fabrique_mod( 'blog_image_hover' ),
		'border' => fabrique_mod( 'blog_border' ),
		'entry_color_scheme' => fabrique_mod( 'blog_color_scheme' ),
		'background_color' => fabrique_mod( 'blog_background' ),
		'background_opacity' => fabrique_mod( 'blog_opacity' ),
		'spacing' => fabrique_mod( 'blog_spacing' ),
		'inner_spacing' => fabrique_mod( 'blog_inner_spacing' ),
		'title_uppercase' => fabrique_mod( 'blog_title_uppercase' ),
		'title_letter_spacing' => fabrique_mod( 'blog_title_letter_spacing' ) . 'em',
		'title_size' => fabrique_mod( 'blog_title_font_size' ),
		'title_line_height' => fabrique_mod( 'blog_title_line_height' ),
		'pagination' => true,
		'pagination_style' => fabrique_mod( 'blog_load' ),
		'filter' => fabrique_mod( 'blog_filter' ),
		'filter_alignment' => fabrique_mod( 'blog_filter_alignment' ),
		'filter_sorting' => fabrique_mod( 'blog_filter_sorting' ),
		'excerpt_content' => fabrique_mod( 'blog_excerpt_content' ),
		'excerpt_length' => fabrique_mod( 'blog_excerpt_length' ),
		'more_icon_position' => fabrique_mod( 'blog_more_icon_position' ),
		'more_message' => fabrique_mod( 'blog_more_message' ),
		'entry_link' => fabrique_mod( 'blog_link' ),
		'link_new_tab' => fabrique_mod( 'blog_link_new_tab' ),
		'components' => fabrique_mod( 'blog_component' ),
		'query' => $wp_query,
		'query_args' => $wp_query->query_vars
	);

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_search_result_options' ) ) :
function fabrique_search_result_options( $opts = array() )
{
	global $wp_query;
	$opts['sidebar'] = fabrique_mod( 'sidebar' );
	$opts['sidebar_position'] = fabrique_mod( 'sidebar_position' );
	$opts['content_class'] = 'fbq-content';
	$opts['content_class'] .= ( fabrique_mod( 'page_title' ) ) ? ' fbq-content--with-header' : ' fbq-content--no-header';
	$opts['container_class'] = ( fabrique_mod( 'blog_full_width' ) ) ? 'fbq-container--fullwidth' : 'fbq-container';

	$opts['entries_args'] = array(
		'type' => 'fbq-blog',
		'style' => 'plain',
		'layout' => 'list',
		'no_of_columns' => 1,
		'alignment' => 'left',
		'entry_color_scheme' => fabrique_mod( 'default_color_scheme' ),
		'title_uppercase' => fabrique_mod( 'blog_title_uppercase' ),
		'title_letter_spacing' => fabrique_mod( 'blog_title_letter_spacing' ) . 'em',
		'title_size' => fabrique_mod( 'blog_title_font_size' ),
		'title_line_height' => fabrique_mod( 'blog_title_line_height' ),
		'background_color' => 'default',
		'background_opacity' => 100,
		'spacing' => 60,
		'inner_spacing' => 0,
		'pagination' => true,
		'filter' => false,
		'excerpt_content' => fabrique_mod( 'blog_excerpt_content' ),
		'excerpt_length' => fabrique_mod( 'blog_excerpt_length' ),
		'entry_link' => 'post',
		'link_new_tab' => fabrique_mod( 'blog_link_new_tab' ),
		'components' => array( 'title', 'excerpt', 'posttype' ),
		'query' => $wp_query,
		'query_args' => $wp_query->query_vars
	);

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_archive_project_options' ) ) :
function fabrique_archive_project_options( $opts = array() )
{
	global $wp_query;
	$opts['sidebar'] = fabrique_mod( 'project_sidebar' );
	$opts['sidebar_position'] = fabrique_mod( 'project_sidebar_position' );
	$opts['sidebar_select'] = fabrique_mod( 'project_sidebar_select' );
	$opts['sidebar_fixed'] = fabrique_mod( 'project_sidebar_fixed' );
	$opts['content_class'] = 'fbq-content';
	$opts['content_class'] .= ( fabrique_mod( 'page_title' ) ) ? ' fbq-content--with-header' : ' fbq-content--no-header';
	$opts['container_class'] = ( fabrique_mod( 'project_full_width' ) ) ? 'fbq-container--fullwidth' : 'fbq-container';

	$opts['entries_args'] = array(
		'type' => 'fbq-project',
		'style' => fabrique_mod( 'project_style' ),
		'layout' => fabrique_mod( 'project_layout' ),
		'list_thumbnail_size' => fabrique_mod( 'project_list_thumbnail_size' ),
		'no_of_columns' => fabrique_mod( 'project_columns' ),
		'alignment' => fabrique_mod( 'project_alignment' ),
		'image_size' => fabrique_mod( 'project_image_size' ),
		'image_ratio' => fabrique_mod( 'project_image_ratio' ),
		'image_hover' => fabrique_mod( 'project_image_hover' ),
		'border' => fabrique_mod( 'project_border' ),
		'entry_color_scheme' => fabrique_mod( 'project_color_scheme' ),
		'background_color' => fabrique_mod( 'project_background' ),
		'background_opacity' => fabrique_mod( 'project_opacity' ),
		'spacing' => fabrique_mod( 'project_spacing' ),
		'inner_spacing' => fabrique_mod( 'project_inner_spacing' ),
		'title_uppercase' => fabrique_mod( 'project_title_uppercase' ),
		'title_letter_spacing' => fabrique_mod( 'project_title_letter_spacing' ) . 'em',
		'title_size' => fabrique_mod( 'project_title_font_size' ),
		'title_line_height' => fabrique_mod( 'project_title_line_height' ),
		'pagination' => true,
		'pagination_style' => fabrique_mod( 'project_load' ),
		'filter' => fabrique_mod( 'project_filter' ),
		'filter_alignment' => fabrique_mod( 'project_filter_alignment' ),
		'filter_sorting' => fabrique_mod( 'project_filter_sorting' ),
		'excerpt_content' => fabrique_mod( 'project_excerpt_content' ),
		'excerpt_length' => fabrique_mod( 'project_excerpt_length' ),
		'more_icon_position' => fabrique_mod( 'project_more_icon_position' ),
		'more_message' => fabrique_mod( 'project_more_message' ),
		'entry_link' => fabrique_mod( 'project_link' ),
		'link_new_tab' => fabrique_mod( 'project_link_new_tab' ),
		'components' => fabrique_mod( 'project_component' ),
		'query' => $wp_query,
		'query_args' => $wp_query->query_vars
	);

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_archive_title_options' ) ) :
function fabrique_archive_title_options( $opts = array() )
{
	$opts['default'] = true;
	$opts['breadcrumb_inline_style'] = false;
	$opts['breadcrumb_color'] = fabrique_mod( 'breadcrumb_text_color' );
	$opts['breadcrumb_on'] = fabrique_mod( 'breadcrumb' );
	$opts['title_on'] = fabrique_mod( 'page_title' );
	$opts['color_scheme'] = fabrique_mod( 'page_title_color_scheme' );
	$opts['subtitle_on'] = false;
	$opts['breadcrumb_alignment'] = fabrique_mod( 'breadcrumb_alignment' );
	$opts['breadcrumb_position'] = fabrique_mod( 'breadcrumb_position' );
	$opts['alignment'] = fabrique_mod( 'page_title_alignment' );
	$opts['full_width'] = fabrique_mod( 'page_title_full_width' );

	if ( is_home() ) {
		$blog_title = fabrique_mod( 'page_title_blog_label' );
		$opts['title_content'] = $blog_title;
		$opts['subtitle_on'] = true;
		$opts['subtitle'] = fabrique_mod( 'blog_subtitle' );
	} elseif ( is_archive() && !( is_tax() || is_category() || is_tag() || is_author() || is_year() || is_month() || is_day() ) ) {
		$post_type = get_post_type();
		if ( is_post_type_archive( 'fbq_project' ) ) {
			$opts['title_content'] = apply_filters( 'fabrique_project_title', fabrique_mod( 'project_slug' ) );
			$opts['subtitle_on'] = true;
			$opts['subtitle'] = fabrique_mod( 'project_subtitle' );
		} elseif ( true === fabrique_is_woocommerce_activated() && is_shop() ) {
			$shop_title = fabrique_mod( 'page_title_shop_label' );
			$opts['title_content'] = $shop_title;
			$opts['subtitle_on'] = true;
			$opts['subtitle'] = fabrique_mod( 'shop_subtitle' );

			// function woocommerce_page_title //
			if ( is_search() ) {
				$search_title = fabrique_mod( 'page_title_search_label' );
				$opts['title_content'] = sprintf( $search_title . ' &ldquo;%s&rdquo;', get_search_query() );

				if ( get_query_var( 'paged' ) ) {
					$opts['title_content'] .= sprintf( '&nbsp;&ndash; ' . esc_html__( 'Page', 'fabrique' ) . ' %s', get_query_var( 'paged' ) );
				}
			}
		} else {
			$blog_title = fabrique_mod( 'page_title_blog_label' );
			$opts['title_content'] = $blog_title;
			$opts['subtitle_on'] = true;
			$opts['subtitle'] = fabrique_mod( 'blog_subtitle' );
		}
	} elseif ( is_archive() && is_tax() && !is_category() ) {
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$archive_title = fabrique_mod( 'page_title_archive_label' );
		$opts['title_content'] = $archive_title . $term->name;

		if ( !empty( $term->description ) ) {
				$opts['subtitle_on'] = true;
				$opts['subtitle'] = $term->description;
		}
	} elseif ( is_category() ) {
		$category_title = fabrique_mod( 'page_title_category_label' );
		$opts['title_content'] = $category_title . single_cat_title( '', false );
		$description = category_description();

		if ( !empty( $description ) ) {
			$opts['subtitle_on'] = true;
			$opts['subtitle'] = $description;
		}
	} elseif ( is_tag() ) {
		$tag_title = fabrique_mod( 'page_title_tag_label' );
		$opts['title_content'] = $tag_title . single_tag_title( '', false );
		$description = tag_description();

		if ( !empty( $description ) ) {
			$opts['subtitle_on'] = true;
			$opts['subtitle'] = $description;
		}
	} elseif ( is_author() ) {
		$autor_title = fabrique_mod( 'page_title_author_label' );
		$opts['title_content'] = $autor_title . get_the_author_meta( 'display_name' );
	} elseif ( is_day() ) {
		$day_title = fabrique_mod( 'page_title_day_label' );
		$opts['title_content'] = $day_title . get_the_date();
	} elseif ( is_month() ) {
		$month_title = fabrique_mod( 'page_title_month_label' );
		$opts['title_content'] = $month_title . get_the_date( 'F Y' );
	} elseif ( is_year() ) {
		$year_title = fabrique_mod( 'page_title_month_label' );
		$opts['title_content'] = $year_title . get_the_date( 'Y' );
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_page_hero_options' ) ) :
function fabrique_page_hero_options( $opts = array() )
{
	$defaults = array(
		'components' => array( 'title', 'subtitle', 'firstbutton', 'secondbutton', 'divider' ),
		'full_width' => false,
		'fit_height' => false,
		'fit_height_percent' => 100,
		'fit_height_offset' => '',
		'height' => '',
		'content_max_width' => '',
		'divider_width' => '',
		'bannertext_style' => 'flip',
		'bannertext_loop' => true,
		'bannertext_duration' => 3000,
		'bannertext_size' => 36,
		'bannertext_cursor' => '|',
		'bannertext_color' => 'default',
		'bannertext_background_color' => 'default',
		'title_uppercase' => false,
		'title_letter_spacing' => '',
		'title_font' => 'secondary',
		'topsubtitle_font' => 'primary',
		'subtitle_font' => 'primary',
		'bannertext_font' => 'secondary',
		'layout' => 'stacked',
		'horizontal' => 'center',
		'vertical' => 'middle',
		'alignment' => 'center',
		'topsubtitle' => 'Edit Top Subtitle',
		'title' => 'Edit Title',
		'bannertext' => 'Text 1, Text 2, Text 3',
		'subtitle' => 'Edit Subtitle Here',
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
		'icon_size' => 'medium',
		'icon_color' => 'default',
		'icon_hover_color' => 'default',
		'icon' => 'et-speedometer',
		'icon_link' => '',
		'media_target_self' => false,
		'content_fade' => false,
		'parallax_speed' => 2,
		'color_scheme' => 'default',
		'background_type' => 'image',
		'background_id' => '',
		'background_url' => '',
		'background_color' => 'default',
		'background_opacity' => 90,
		'background_size' => 'cover',
		'background_position' => 'center center',
		'background_repeat' => 'repeat',
		'background_animation' => 'none',
		'firstbutton_style' => 'fill',
		'firstbutton_color' => 'brand',
		'firstbutton_hover' => 'inverse',
		'firstbutton_thickness' => 1,
		'firstbutton_radius' => 0,
		'firstbutton_size' => 'medium',
		'firstbutton_label' => 'Button',
		'firstbutton_icon' => 'et-speedometer',
		'firstbutton_icon_position' => 'before',
		'firstbutton_link' => '/',
		'firstbutton_target_self' => false,
		'secondbutton_style' => 'fill',
		'secondbutton_color' => 'brand',
		'secondbutton_hover' => 'inverse',
		'secondbutton_thickness' => 1,
		'secondbutton_radius' => 0,
		'secondbutton_size' => 'medium',
		'secondbutton_label' => 'Button',
		'secondbutton_icon' => 'et-speedometer',
		'secondbutton_icon_position' => 'before',
		'secondbutton_link' => '/',
		'secondbutton_target_self' => false,
	);
	$opts = array_merge( $defaults, $opts );
	$opts['image_on'] = isset( $opts['image_on'] ) ? $opts['image_on'] : in_array( 'image', $opts['components'] );
	$opts['topsubtitle_on'] = isset( $opts['topsubtitle_on'] ) ? $opts['topsubtitle_on'] : in_array( 'topsubtitle', $opts['components'] );
	$opts['subtitle_on'] = isset( $opts['subtitle_on'] ) ? $opts['subtitle_on'] : in_array( 'subtitle', $opts['components'] );
	$opts['firstbutton_on'] = isset( $opts['firstbutton_on'] ) ? $opts['firstbutton_on'] : in_array( 'firstbutton', $opts['components'] );
	$opts['secondbutton_on'] = isset( $opts['secondbutton_on'] ) ? $opts['secondbutton_on'] : in_array( 'secondbutton', $opts['components'] );
	$opts['title_on'] = isset( $opts['title_on'] ) ? $opts['title_on'] : in_array( 'title', $opts['components'] );
	$opts['bannertext_on'] = isset( $opts['bannertext_on'] ) ? $opts['bannertext_on'] : in_array( 'bannertext', $opts['components'] );
	$opts['divider_on'] = isset( $opts['divider_on'] ) ? $opts['divider_on'] : in_array( 'divider', $opts['components'] );
	$opts['body_on'] = $opts['topsubtitle_on'] || $opts['subtitle_on'] || $opts['title_on'] || $opts['bannertext_on'] || $opts['firstbutton_on'] || $opts['secondbutton_on'];
	$opts['content_wrapper_style'] = array();
	$opts['title_style'] = array(
		'letter-spacing' => is_numeric( $opts['title_letter_spacing'] ) ? $opts['title_letter_spacing'] .'px' : $opts['title_letter_spacing']
	);

	if ( $opts['title_uppercase']  ) {
		$opts['title_style']['text-transform'] = 'uppercase';
	}

	$opts['content_wrapper_style']['max-width'] = is_numeric( $opts['content_max_width'] ) ? $opts['content_max_width'] .'px' : $opts['content_max_width'];

	$opts['class'] = array( 'fbq-content-header', 'js-dynamic-navbar', 'fbq-page-hero', 'fbq-page-hero--' . $opts['layout'] );
	$opts['style_attr'] = fabrique_get_spacing_style( $opts, 'margin' );
	$opts['content_style'] = fabrique_get_spacing_style( $opts, 'padding' );

	if ( 'default' !== $opts['color_scheme'] && fabrique_mod( 'default_color_scheme' ) !== $opts['color_scheme'] ) {
		$opts['class'][] = 'fbq-' . $opts['color_scheme'] . '-scheme';
		$opts['data_attr']['scheme'] = $opts['color_scheme'];
	}

	$opts['container_class'] = ( !$opts['full_width'] ) ? 'fbq-container' : 'fbq-container--fullwidth';

	if ( $opts['fit_height'] ) {
		$opts['class'][] = 'fbq-page-hero--fit-height';
		$opts['data_attr']['screen_percent'] = (int)$opts['fit_height_percent'];
		$opts['style_attr']['height'] = (int)$opts['fit_height_percent'] . 'vh';
		$opts['data_attr']['screen_offset'] = $opts['fit_height_offset'];
	} else {
		$opts['style_attr']['height'] = is_numeric( $opts['height'] ) ? $opts['height'] .'px' : $opts['height'];
	}

	$opts['divider_style'] = array(
		'max-width' => is_numeric( $opts['divider_width'] ) ? $opts['divider_width'] .'px' : $opts['divider_width']
	);

	$hidden_classes = array(
		'pc_hidden' => 'fbq-pc-hidden',
		'tablet_landscape_hidden' => 'fbq-tablet-landscape-hidden',
		'tablet_hidden' => 'fbq-tablet-hidden',
		'mobile_hidden' => 'fbq-mobile-hidden',
		'force_mobile_center' => 'fbq-force-center-mobile'
	);

	foreach ( $hidden_classes as $option => $hidden_class ) {
		if ( isset( $opts[$option] ) && $opts[$option] ) {
			$opts['class'][] = $hidden_class;
		}
	}

	if ( isset( $opts['animation'] ) && 'none' !== $opts['animation'] ) {
		$opts['class'][] = 'anmt-item anmt-' . $opts['animation'];

		if ( isset( $opts['stagger'] ) && $opts['stagger'] ) {
			$opts['class'][] = 'stagger';
		}
	}

	if ( isset( $opts['css_class'] ) ) {
		$opts['class'][] = $opts['css_class'];
	}

	if ( isset( $opts['css_id'] ) ) {
		$opts['id'] = $opts['css_id'];
	}

	$opts['bannertext_attr'] = array(
		'class' => 'fbq-item js-item-bannertext fbq-bannertext fbq-bannertext--' . $opts['bannertext_style'],
		'data_attr' => array(
			'item' => 'bannertext',
			'loop' => $opts['bannertext_loop'],
			'duration' => $opts['bannertext_duration'],
			'words' => $opts['bannertext']
		)
	);

	if ( 'type' === $opts['bannertext_style'] ) {
		$opts['bannertext_attr']['data_attr']['cursor'] = $opts['bannertext_cursor'];
	}

	$opts['bannertext_dynamic_class'] = array( 'fbq-bannertext-dynamic', 'fbq-p-brand-color', 'fbq-' . $opts['bannertext_font'] . '-font' );
	if ( 48 < $opts['bannertext_size'] ) {
		$opts['bannertext_dynamic_class'][] = 'font-style-big';
	}

	$opts['bannertext_dynamic_style'] = array(
		'color' => fabrique_c( $opts['bannertext_color'] ),
		'background-color' => fabrique_c( $opts['bannertext_background_color'] ),
		'font-size' => $opts['bannertext_size'] . 'px'
	);

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_page_title_options' ) ) :
function fabrique_page_title_options( $opts = array() )
{
	$defaults = array(
		'default' => false,
		'dynamic_nav' => true,
		'components' => array( 'breadcrumb', 'title', 'subtitle' ),
		'subtitle' => 'Enter Subtitle Here',
		'full_width' => false,
		'breadcrumb_position' => 'top',
		'breadcrumb_alignment' => 'left',
		'title_color' => 'default',
		'breadcrumb_inline_style' => false,
		'breadcrumb_color' => 'default',
		'breadcrumb_background_color' => 'default',
		'breadcrumb_opacity' => 100,
		'alignment' => 'left',
		'color_scheme' => 'default',
		'background_id' => '',
		'background_url' => '',
		'background_color' => 'default',
		'background_opacity' => 90,
		'background_size' => 'cover',
		'background_position' => 'center center',
		'background_repeat' => 'repeat',
		'title_font' => 'secondary',
		'subtitle_font' => 'primary',
		'breadcrumb_font' => 'primary'
	);
	$opts = array_merge( $defaults, $opts );
	$opts['breadcrumb_on'] = isset( $opts['breadcrumb_on'] ) ? $opts['breadcrumb_on'] : in_array( 'breadcrumb', $opts['components'] );
	$opts['title_on'] = isset( $opts['title_on'] ) ? $opts['title_on'] : in_array( 'title', $opts['components'] );
	$opts['subtitle_on'] = isset( $opts['subtitle_on'] ) ? $opts['subtitle_on'] : in_array( 'subtitle', $opts['components'] );
	$opts['container_class'] = ( !$opts['full_width'] ) ? 'fbq-container' : 'fbq-container--fullwidth';

	$opts['class'] = array( 'fbq-content-header', 'fbq-page-title', 'fbq-page-title--' . $opts['breadcrumb_position'], 'fbq-' . $opts['alignment'] . '-align' );
	$padding = fabrique_get_spacing_style( $opts, 'padding' );
	$margin = fabrique_get_spacing_style( $opts, 'margin' );
	$opts['style_attr'] = array_merge( $padding, $margin  );
	$opts['data_attr'] = array( 'role' => 'header' );
	$opts['breadcrumb_class'] = 'fbq-page-title-breadcrumb fbq-' . $opts['breadcrumb_font'] . '-font fbq-' . $opts['breadcrumb_alignment'] . '-align fbq-p-text-color';
	$opts['breadcrumb_class'] .= ( 'default' !== $opts['breadcrumb_color'] ) ? ' custom-color' : '';
	$opts['breadcrumb_style'] = array( 'color' => fabrique_c( $opts['breadcrumb_color'] ) );
	$opts['title_style'] = array( 'color' => fabrique_c( $opts['title_color'] ) );

	if ( $opts['dynamic_nav'] ) {
		$opts['class'][] = 'js-dynamic-navbar';
	}

	if ( 'default' !== $opts['color_scheme'] && ( fabrique_mod( 'default_color_scheme' ) !== $opts['color_scheme'] ) ) {
		$opts['class'][] = 'fbq-' . $opts['color_scheme'] . '-scheme';
		$opts['data_attr']['scheme'] = $opts['color_scheme'];
	}

	if ( $opts['default'] ) {
		$opts['class'][] = 'fbq-page-title--default';
	}

	if ( 'inline' === $opts['breadcrumb_position'] ) {
		$opts['class'][] = 'fbq-page-title--'. $opts['alignment'];
	} else {
		$opts['breadcrumb_style']['background-color'] = fabrique_hex_to_rgba( $opts['breadcrumb_background_color'], $opts['breadcrumb_opacity'] / 100 );
	}

	$hidden_classes = array(
		'pc_hidden' => 'fbq-pc-hidden',
		'tablet_landscape_hidden' => 'fbq-tablet-landscape-hidden',
		'tablet_hidden' => 'fbq-tablet-hidden',
		'mobile_hidden' => 'fbq-mobile-hidden',
		'force_mobile_center' => 'fbq-force-center-mobile'
	);

	foreach ( $hidden_classes as $option => $hidden_class ) {
		if ( isset( $opts[$option] ) && $opts[$option] ) {
			$opts['class'][] = $hidden_class;
		}
	}

	if ( isset( $opts['animation'] ) && 'none' !== $opts['animation'] ) {
		$opts['class'][] = 'anmt-item anmt-' . $opts['animation'];

		if ( isset( $opts['stagger'] ) && $opts['stagger'] ) {
			$opts['class'][] = 'stagger';
		}
	}

	if ( isset( $opts['css_class'] ) ) {
		$opts['class'][] = $opts['css_class'];
	}

	if ( isset( $opts['css_id'] ) ) {
		$opts['id'] = $opts['css_id'];
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_entry_options' ) ) :
function fabrique_entry_options( $opts = array(), $post_id = '' )
{
	foreach ( $opts as $key => $value ) {
		if ( 'true' === $value ) {
			$opts[$key] = true;
		} elseif ( 'false' === $value ) {
			$opts[$key] = false;
		}
	}

	if ( $bp_data = fabrique_bp_data( $post_id ) ) {
		$entry_setting = $bp_data['builder'];
	} else {
		$entry_setting = array();
	}

	$single_width = isset( $entry_setting['width'] ) ? $entry_setting['width'] : 1;
	$single_height = isset( $entry_setting['height'] ) ? $entry_setting['height'] : 1;

	$defaults = array(
		'post_type' => 'post',
		'post_taxonomy' => 'category',
		'post_tag' => 'tag',
		'style' => 'plain',
		'layout' => 'grid',
		'media_on' => true,
		'author_on' => false,
		'category_on' => false,
		'tag_on' => false,
		'title_on' => true,
		'posttype_on' => false,
		'excerpt_on' => false,
		'comment_on' => false,
		'date_on' => false,
		'link_on' => false,
		'rating_on' => false,
		'price_on' => false,
		'addtocart_on' => false,
		'featured_media' => 'image',
		'image_size' => 'medium_large',
		'image_ratio' => 'auto',
		'image_lazy_load' => false,
		'image_hover' => 'none',
		'media_style' => array(),
		'no_of_columns' => 2,
		'spacing' => 30,
		'inner_spacing' => 0,
		'entry_color_scheme' => 'default',
		'background_color' => 'default',
		'background_opacity' => 100,
		'title_uppercase' => false,
		'title_letter_spacing' => '',
		'title_line_height' => '',
		'title_size' => '',
		'title_font' => 'secondary',
		'meta_font' => 'primary',
		'price_font_size' => 16,
		'price_font' => 'primary',
		'excerpt_content' => 'excerpt',
		'excerpt_length' => '',
		'more_message' => 'Read More',
		'entry_link' => 'post',
		'link_new_tab' => false,
		'fade' => false,
		'variable_width' => false,
		'carousel_height' => '',
	);

	$opts = array_merge( $defaults, $opts );

	// entry setting
	$opts['entry_link'] = ( isset( $entry_setting['entry_link'] ) && 'default' !== $entry_setting['entry_link'] ) ? $entry_setting['entry_link'] : $opts['entry_link'];
	$opts['alternate_link'] = isset( $entry_setting['alternate_link'] ) ? $entry_setting['alternate_link'] : '';
	$opts['image_hover'] = ( isset( $entry_setting['image_hover'] ) && 'default' !== $entry_setting['image_hover'] ) ? $entry_setting['image_hover'] : $opts['image_hover'];
	$opts['no_of_columns'] = !empty( $opts['no_of_columns'] ) ? $opts['no_of_columns'] : 2;
	$opts['entry_class'] = array( 'fbq-entry' );
	$opts['entry_style'] = array();
	$opts['header_style'] = array();
	$opts['body_style'] = array();
	$opts['inner_attr'] = array(
		'class' => array( 'fbq-entry-inner fbq-p-border-border' ),
		'style_attr' => array()
	);
	$opts['media_wrapper_style'] = array();

	$opts['title_attr'] = array(
		'class' => array(
			'fbq-entry-title',
			'fbq-' . $opts['title_font'] . '-font'
		),
		'style_attr' => array(
			'letter-spacing' => is_numeric( $opts['title_letter_spacing'] ) ? $opts['title_letter_spacing'] .'px' : $opts['title_letter_spacing'],
			'line-height' => $opts['title_line_height'],
			'text-transform' => $opts['title_uppercase'] ? 'uppercase' : ''
		)
	);

	if ( !empty( $opts['title_size'] ) ) {
		$opts['title_attr']['style_attr']['font-size'] = $opts['title_size'] . 'px';
	}

	if ( !$opts['posttype_on'] ) {
		$opts['title_attr']['class'][] = 'fbq-s-text-color';
	} else {
		$opts['title_attr']['class'][] = 'fbq-p-brand-color';
	}

	$opts['price_attr'] = array(
		'class' => array(
			'fbq-entry-price',
			'fbq-' . $opts['price_font'] . '-font'
		),
		'style_attr' => array(
			'font-size' => $opts['price_font_size'] . 'px',
		)
	);

	$opts['link_target'] = ( $opts['link_new_tab'] ) ? '_blank' : '_self';

	if ( isset( $opts['animation'] ) && 'none' !== $opts['animation'] ) {
		$opts['inner_attr']['class'][] = 'anmt-item anmt-' . $opts['animation'];

		if ( isset( $opts['stagger'] ) && $opts['stagger'] ) {
			$opts['inner_attr']['class'][] = 'stagger';
		}
	}

	if ( 'alternate' === $opts['entry_link'] ) {
		$opts['permalink'] = empty( $opts['alternate_link'] ) ? get_permalink( $post_id ) : $opts['alternate_link'];
	} else {
		$opts['permalink'] = get_permalink( $post_id );
	}

	if ( 'masonry' === $opts['layout'] && 'gradient' === $opts['style'] ) {
		$opts['inner_attr']['style_attr']['width'] = 'calc(100% - ' . $opts['spacing'] . 'px)';
		$opts['inner_attr']['style_attr']['margin-bottom'] = $opts['spacing'] . 'px';
		$opts['media_wrapper_style']['margin'] = -$opts['spacing'] / 2 . 'px ' . -$opts['spacing'] / 2 . 'px ' . -$opts['spacing'] / 2 . 'px';
		$masonry_width = ( $single_width > $opts['no_of_columns'] ) ? $opts['no_of_columns'] : $single_width;
		$opts['image_column_width'] = ( $opts['no_of_columns'] != 5 ) ? 12 / $opts['no_of_columns'] * $masonry_width : $masonry_width . '-5';
		$opts['entry_class'][] = 'fbq-col-' . $opts['image_column_width'];

		if ( 'auto' !== $opts['image_ratio'] ) {
			$opts['image_ratio'] = fabrique_adjust_ratio( $masonry_width, $single_height, $opts['image_ratio'] );
		}
	} else {
		$opts['entry_style']['margin-bottom'] = $opts['spacing'] . 'px';

		if ( 'list' !== $opts['layout'] ) {
			$opts['entry_style']['padding'] = '0 ' . $opts['spacing'] / 2 . 'px';
			if ( 'carousel' === $opts['layout'] && ( $opts['fade'] || ( 'gradient' === $opts['style'] && $opts['variable_width'] ) ) ) {
				$opts['image_column_width'] = 12;
			} else {
				$opts['image_column_width'] = ( $opts['no_of_columns'] != 5 ) ? 12 / $opts['no_of_columns'] : '1-5';
				$opts['entry_class'][] = 'fbq-col-' . $opts['image_column_width'];
			}
		} else {
			$opts['image_column_width'] = 12;
		}
	}

	// override background color from entry setting
	if ( isset( $entry_setting['background_custom'] ) && $entry_setting['background_custom'] ) {
		$opts['background_color'] = isset( $entry_setting['background_color'] ) ? $entry_setting['background_color'] : $opts['background_color'];
		$opts['background_color'] = isset( $entry_setting['background_opacity'] ) ? $entry_setting['background_opacity'] : $opts['background_opacity'];
		$opts['entry_color_scheme'] = isset( $entry_setting['entry_color_scheme'] ) ? $entry_setting['entry_color_scheme'] : $opts['entry_color_scheme'];
	}

	$background_color = fabrique_hex_to_rgba( $opts['background_color'], $opts['background_opacity'] / 100 );
	if ( 'gradient' === $opts['style'] ) {
		$opts['inner_attr']['style_attr']['color'] = fabrique_contrast_color( $opts['background_color'] );
		$opts['inner_attr']['style_attr']['background-color'] = $background_color;

		if ( 'transparent' !== $opts['background_color'] && 'default' !== $opts['background_color'] ) {
			$opts['inner_attr']['class'][] = 'with-background';
		}

		// animation on hover (content on hover)
		if ( 'none' !== $opts['image_hover'] ) {
			$opts['inner_attr']['class'][] = 'anmt-image-' . $opts['image_hover'];
		}

		if ( 0 != $opts['inner_spacing'] ) {
			$opts['body_style']['padding-left'] = $opts['inner_spacing'] / 2 . 'px';
			$opts['body_style']['padding-right'] = $opts['inner_spacing'] / 2 . 'px';
		}
	} else {
		$opts['body_style']['background-color'] = $background_color;
		if ( 0 != $opts['inner_spacing'] ) {
			$opts['body_style']['padding'] = $opts['inner_spacing'] / 2 . 'px';
		}
	}

	if ( 'default' !== $opts['entry_color_scheme'] ) {
		$opts['entry_class'][] = 'fbq-entry-' . $opts['entry_color_scheme'] . '-scheme';
	}

	// Featured Media
	$thumb_id = get_post_thumbnail_id( $post_id );
	$opts['featured_media_args'] = array(
		'image_id' => $thumb_id,
		'image_link' => $opts['permalink'],
		'image_size' => $opts['image_size'],
		'image_ratio' => $opts['image_ratio'],
		'image_hover' => $opts['image_hover'],
		'image_column_width' => $opts['image_column_width'],
		'media_style' => $opts['media_style'],
		'wrapper_style' => $opts['media_wrapper_style'],
		'image_lazy_load' => $opts['image_lazy_load'],
		'media_target_self' => !$opts['link_new_tab']
	);

	if ( !$opts['media_on'] || !$thumb_id ) {
		$opts['entry_class'][] = 'no-media';
	}

	if ( 'gradient' === $opts['style'] ) {
		$opts['featured_media_args']['post_format'] = 'standard';
	} elseif ( 'image' === $opts['featured_media'] ) {
		$opts['featured_media_args']['post_format'] = 'standard';
	} else {
		$post_format = get_post_format( $post_id ) ? get_post_format( $post_id ) : 'standard';
		$opts['featured_media_args']['post_format'] = $post_format;

		if ( 'standard' !== $post_format ) {
			$post_type_settings = get_post_meta( $post_id, 'bp_post_format_settings', true );
			if ( is_array( $post_type_settings ) ) {
				$opts['featured_media_args'] = array_merge( $opts['featured_media_args'], $post_type_settings );
			}
		}
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_entry_product_options' ) ) :
function fabrique_entry_product_options( $opts = array() )
{
	foreach ( $opts as $key => $value ) {
		if ( 'true' === $value ) {
			$opts[$key] = true;
		} elseif ( 'false' === $value ) {
			$opts[$key] = false;
		}
	}

	$defaults = array(
		'extra_class' => array(),
		'style' => 'list',
		'animation' => 'none',
		'stagger' => false,
		'enable_link' => true,
		'no_of_columns' => 4,
		'spacing' => '',
		'image_on' => true,
		'subtitle_on' => true,
		'image_size' => 'medium_large',
		'image_ratio' => 'auto',
		'image_lazy_load' => false,
		'image_circle' => false,
		'title_font' => 'secondary',
		'title_size' => 14,
		'title_uppercase' => 0,
		'title_letter_spacing' => '',
		'title_line_height' => '',
		'subtitle_font' => 'primary',
		'subtitle_size' => 12,
		'subtitle_uppercase' => false,
		'subtitle_letter_spacing' => '',
		'subtitle_line_height' => '',
		'price_font' => 'secondary',
		'price_font_size' => 14,
	);
	$opts = array_merge( $defaults, $opts );
	$opts['entry_class'] = array( 'fbq-entry' );
	$opts['entry_class'] = array_merge( $opts['extra_class'], $opts['entry_class'] );
	$opts['entry_inner_class'] = array( 'fbq-entry-inner', 'fbq-p-border-border' );
	$opts['entry_inner_style'] = array();
	$opts['entry_style'] = array();
	$opts['menu_line_style'] = array();
	$opts['price_style'] = array(
		'font-size' => $opts['price_font_size'] . 'px'
	);

	$opts['media_args'] = array(
		'image_size' => $opts['image_size'],
		'image_ratio' => $opts['image_ratio'],
		'image_circle' => $opts['image_circle'],
		'image_lazy_load' => $opts['image_lazy_load']
	);

	if ( !empty( $opts['animation'] ) && 'none' !== $opts['animation'] ) {
		$opts['entry_inner_class'][] = 'anmt-item anmt-' . $opts['animation'];

		if ( $opts['stagger'] ) {
			$opts['entry_inner_class'][] = 'stagger';
		}
	}

	if ( 'grid' === $opts['style'] ) {
		$column_width = ( 5 == $opts['no_of_columns'] ) ? '1-5' : 12/$opts['no_of_columns'];
		$opts['entry_class'][] = 'fbq-col-' . $column_width;
		$opts['media_args']['image_column_width'] = $column_width;

		if ( !empty( $opts['spacing'] ) || ( is_numeric( $opts['spacing'] ) && 0 == $opts['spacing'] ) ) {
			$opts['entry_style']['padding'] = '0 ' . $opts['spacing']/2 . 'px';
			$opts['entry_style']['margin-bottom'] = $opts['spacing'] . 'px';
		}
	} else if ( !empty( $opts['spacing'] ) || ( is_numeric( $opts['spacing'] ) && 0 == $opts['spacing'] ) ) {
		$opts['entry_inner_style']['padding-bottom'] = $opts['spacing']/2 . 'px';
		$opts['entry_style']['margin-bottom'] = $opts['spacing']/2 . 'px';
	}

	$opts['title_style'] = array(
		'font-size' => $opts['title_size'] . 'px',
		'letter-spacing' => is_numeric( $opts['title_letter_spacing'] ) ? $opts['title_letter_spacing'] .'px' : $opts['title_letter_spacing'],
		'line-height' => $opts['title_line_height'],
		'text-transform' => $opts['title_uppercase'] ? 'uppercase' : ''
	);

	$opts['subtitle_attr'] = array(
		'class' => array(
			'fbq-entry-subtitle',
			'fbq-' . $opts['subtitle_font'] . '-font'
		),
		'style_attr' => array(
			'font-size' => $opts['subtitle_size'] . 'px',
			'letter-spacing' => is_numeric( $opts['subtitle_letter_spacing'] ) ? $opts['subtitle_letter_spacing'] .'px' : $opts['subtitle_letter_spacing'],
			'line-height' => $opts['subtitle_line_height'],
			'text-transform' => $opts['subtitle_uppercase'] ? 'uppercase' : ''
		)
	);

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_entry_productcat_options' ) ) :
function fabrique_entry_productcat_options( $opts = array() )
{
	foreach ( $opts as $key => $value ) {
		if ( 'true' === $value ) {
			$opts[$key] = true;
		} elseif ( 'false' === $value ) {
			$opts[$key] = false;
		}
	}

	$defaults = array(
		'taxonomy' => 'product_cat',
		'extra_class' => array(),
		'style' => 'overlay',
		'layout' => 'grid',
		'animation' => 'none',
		'stagger' => false,
		'category_obj' => false,
		'no_of_columns' => 4,
		'spacing' => '',
		'image_size' => 'large',
		'image_ratio' => 'auto',
		'image_lazy_load' => false,
		'image_hover' => 'none',
		'title_font' => 'secondary',
		'title_size' => 16,
		'title_uppercase' => 0,
		'title_letter_spacing' => '',
	);
	$opts = array_merge( $defaults, $opts );
	$column_width = ( 5 == $opts['no_of_columns'] ) ? '1-5' : 12/$opts['no_of_columns'];
	$opts['entry_class'] = array( 'fbq-entry', 'fbq-productcat-entry', 'fbq-productcat-entry--' . $opts['style'], 'fbq-col-' . $column_width );
	$opts['entry_class'] = array_merge( $opts['extra_class'], $opts['entry_class'] );

	if ( !empty( $opts['spacing'] ) ) {
		$opts['entry_style'] = array( 'padding' => '0 '. $opts['spacing']/2 . 'px' );

		if ( 'carousel' !== $opts['layout'] ) {
			$opts['entry_style']['margin-bottom'] = $opts['spacing'] . 'px';
		}
	}

	$opts['entry_inner_class'] = array( 'fbq-entry-inner' );
	if ( 'none' !== $opts['image_hover'] ) {
		$opts['entry_inner_class'][] = ' anmt-image-' . $opts['image_hover'];
	}

	if ( !empty( $opts['animation'] ) && 'none' !== $opts['animation'] ) {
		$opts['entry_inner_class'][] = 'anmt-item anmt-' . $opts['animation'];

		if ( $opts['stagger'] ) {
			$opts['entry_inner_class'][] = 'stagger';
		}
	}

	$opts['title_attr'] = array(
		'class' => array(
			'fbq-entry-title',
			'fbq-' . $opts['title_font'] . '-font'
		),
		'style_attr' => array(
			'font-size' => $opts['title_size'] . 'px',
			'letter-spacing' => is_numeric( $opts['title_letter_spacing'] ) ? $opts['title_letter_spacing'] .'px' : $opts['title_letter_spacing'],
			'text-transform' => $opts['title_uppercase'] ? 'uppercase' : ''
		)
	);

	$opts['media_args'] = array(
		'image_size' => $opts['image_size'],
		'image_ratio' => $opts['image_ratio'],
		'image_hover' => $opts['image_hover'],
		'image_column_width' => $column_width,
		'image_lazy_load' => $opts['image_lazy_load']
	);

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_entry_instagram_options' ) ) :
function fabrique_entry_instagram_options( $opts = array() )
{
	array_walk( $opts, 'fabrique_sanitize_boolean_value_walker' );

	$defaults = array(
		'image' => array(),
		'link_label' => __( 'View Post', 'fabrique' ),
		'caption_on' => true,
		'image_index' => 0,
		'style' => 'grid',
		'no_of_columns' => 3,
		'image_ratio' => 'auto',
		'image_lazy_load' => false,
		'on_image_click' => 'none',
		'image_hover' => 'none',
		'spacing' => 15,
		'variable_width' => false,
		'height' => 500,
		'fade' => false
	);
	$opts = array_merge( $defaults, $opts );

	$opts['item_attr'] = array(
		'class' => array( 'fbq-gallery-item' ),
		'style_attr' => array()
	);

	$opts['body_attr'] = array(
		'class' => array( 'fbq-gallery-body' ),
		'style_attr' => array()
	);

	$opts['media_wrapper_style'] = array();

	if ( isset( $opts['animation'] ) && 'none' !== $opts['animation'] ) {
		$opts['body_attr']['class'][] = 'anmt-item anmt-' . $opts['animation'];

		if ( isset( $opts['stagger'] ) && $opts['stagger'] ) {
			$opts['body_attr']['class'][] = 'stagger';
		}
	}

	if ( 'masonry' === $opts['style'] ) {
		$masonry_size = array(
			'width' => 1,
			'height' => 1
		);
		$opts['body_attr']['style_attr']['width'] = 'calc(100% - ' . $opts['spacing'] . 'px)';
		$opts['body_attr']['style_attr']['margin-bottom'] = $opts['spacing'] . 'px';
		$opts['media_wrapper_style']['margin'] = -$opts['spacing'] / 2 . 'px ' . -$opts['spacing'] / 2 . 'px ' . -$opts['spacing'] / 2 . 'px';

		if ( 'auto' !== $opts['image_ratio'] ) {
			$opts['image_ratio'] = fabrique_adjust_ratio( $masonry_size['width'], $masonry_size['height'], $opts['image_ratio'] );
		}

		if ( 5 == $opts['no_of_columns'] ) {
			$image_column_width = $masonry_size['width'] . '-5';
			$opts['item_attr']['class'][] = 'fbq-col-' . $image_column_width;
		} else {
			$image_column_width = 12 / $opts['no_of_columns'] * $masonry_size['width'];
			$opts['item_attr']['class'][] = 'fbq-col-'. $image_column_width;
		}
	} elseif ( 'carousel' === $opts['style'] ) {
		$opts['item_attr']['style_attr']['padding'] = '0 '. $opts['spacing']/2 .'px';
		if ( !$opts['variable_width'] && !$opts['fade'] ) {
			if ( 5 == $opts['no_of_columns'] ) {
				$image_column_width = '1-5';
				$opts['item_attr']['class'][] = 'fbq-col-' . $image_column_width;
			} else {
				$image_column_width = 12 / $opts['no_of_columns'];
				$opts['item_attr']['class'][] = 'fbq-col-'. $image_column_width;
			}
		} elseif ( $opts['variable_width'] ) {
			$opts['image']['style_attr'] = 'max-height:' . $opts['height'] .'px;';
		}
	} elseif ( 'grid' === $opts['style'] ) {
		$opts['item_attr']['style_attr']['padding'] = '0 '. $opts['spacing']/2 .'px';
		$opts['item_attr']['style_attr']['margin-bottom'] = $opts['spacing'] . 'px';
		if ( 5 == $opts['no_of_columns'] ) {
			$image_column_width = '1-5';
			$opts['item_attr']['class'][] = 'fbq-col-' . $image_column_width;
		} else {
			$image_column_width = 12 / $opts['no_of_columns'];
			$opts['item_attr']['class'][] = 'fbq-col-'. $image_column_width;
		}
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_entry_gallery_options' ) ) :
function fabrique_entry_gallery_options( $opts = array() )
{
	array_walk( $opts, 'fabrique_sanitize_boolean_value_walker' );

	$defaults = array(
		'responsive' => true,
		'image' => '',
		'image_index' => 0,
		'style' => 'grid',
		'title_on' => false,
		'caption' => 'This will be gallery caption',
		'caption_on' => false,
		'image_title' => '',
		'image_caption' => '',
		'no_of_columns' => 3,
		'image_size' => 'large',
		'image_ratio' => 'auto',
		'image_lazy_load' => false,
		'on_image_click' => 'popup',
		'image_hover' => 'none',
		'media_style' => array(),
		'spacing' => 15,
		'variable_width' => false,
		'height' => 500,
		'fade' => false,
		'thumbnail' => false
	);
	$opts = array_merge( $defaults, $opts );
	$opts['item_attr'] = array(
		'class' => array( 'fbq-gallery-item' ),
		'style_attr' => array()
	);

	$opts['body_attr'] = array(
		'class' => array( 'fbq-gallery-body' ),
		'style_attr' => array()
	);

	$opts['media_wrapper_style'] = array();

	$image_column_width = '';
	$attachment = get_post( $opts['image'] );
	if ( !empty( $attachment ) ) {
		$opts['image_title'] = $attachment->post_title;
		$opts['image_caption'] = $attachment->post_excerpt;

		if ( isset( $opts['animation'] ) && 'none' !== $opts['animation'] ) {
			$opts['body_attr']['class'][] = 'anmt-item anmt-' . $opts['animation'];

			if ( isset( $opts['stagger'] ) && $opts['stagger'] ) {
				$opts['body_attr']['class'][] = 'stagger';
			}
		}

		if ( 'masonry' === $opts['style'] ) {
			$masonry_size = fabrique_get_masonry_size( $opts['image'], $opts['no_of_columns'] );
			$opts['body_attr']['style_attr']['width'] = 'calc(100% - ' . $opts['spacing'] . 'px)';
			$opts['body_attr']['style_attr']['margin-bottom'] = $opts['spacing'] . 'px';
			$opts['media_wrapper_style']['margin'] = -$opts['spacing'] / 2 . 'px ' . -$opts['spacing'] / 2 . 'px ' . -$opts['spacing'] / 2 . 'px';

			if ( 'auto' !== $opts['image_ratio'] ) {
				$opts['image_ratio'] = fabrique_adjust_ratio( $masonry_size['width'], $masonry_size['height'], $opts['image_ratio'] );
			}

			if ( 5 == $opts['no_of_columns'] ) {
				$image_column_width = $masonry_size['width'] . '-5';
				$opts['item_attr']['class'][] = 'fbq-col-' . $image_column_width;
			} else {
				$image_column_width = 12 / $opts['no_of_columns'] * $masonry_size['width'];
				$opts['item_attr']['class'][] = 'fbq-col-'. $image_column_width;
			}
		} elseif ( 'carousel' === $opts['style'] ) {
			$opts['item_attr']['style_attr']['padding'] = '0 '. $opts['spacing']/2 .'px';
			if ( !$opts['variable_width'] && !$opts['fade'] && !$opts['thumbnail'] ) {
				if ( 5 == $opts['no_of_columns'] ) {
					$image_column_width = '1-5';
					$opts['item_attr']['class'][] = 'fbq-col-' . $image_column_width;
				} else {
					$image_column_width = 12 / $opts['no_of_columns'];
					$opts['item_attr']['class'][] = 'fbq-col-'. $image_column_width;
				}
			} elseif ( $opts['variable_width'] ) {
				$opts['media_style']['max-height'] = $opts['height'] .'px';
			}
		} elseif ( 'grid' === $opts['style'] ) {
			$opts['item_attr']['style_attr']['padding'] = '0 '. $opts['spacing']/2 .'px';
			$opts['item_attr']['style_attr']['margin-bottom'] = $opts['spacing'] . 'px';
			if ( 5 == $opts['no_of_columns'] ) {
				$image_column_width = '1-5';
				$opts['item_attr']['class'][] = 'fbq-col-' . $image_column_width;
			} else {
				$image_column_width = 12 / $opts['no_of_columns'];
				$opts['item_attr']['class'][] = 'fbq-col-'. $image_column_width;
			}
		}

		$opts['image_args'] = array(
			'image_id' => $opts['image'],
			'image_ratio' => $opts['image_ratio'],
			'image_size' => $opts['image_size'],
			'image_hover' => $opts['image_hover'],
			'image_column_width' => $image_column_width,
			'media_style' => $opts['media_style'],
			'wrapper_style' => $opts['media_wrapper_style'],
			'image_lazy_load' => $opts['image_lazy_load']
		);
	}

	return $opts;
}
endif;


if ( !function_exists( 'fabrique_style_custom_options' ) ) :
function fabrique_style_custom_options( $opts )
{
	// Fonts
	$font_indexes = array(
		'primary',
		'secondary',
		'custom_a',
		'custom_b',
		'custom_c',
		'custom_d',
		'custom_e',
		'custom_f',
		'custom_g',
		'custom_h'
	);

	if ( !isset( $opts['fonts'] ) ) {
		$opts['fonts'] = array();
	}

	if ( !isset( $opts['custom_fonts'] ) ) {
		$opts['custom_fonts'] = array();
	}

	foreach ( $font_indexes as $index ) {
		$font = array();
		$fallback_font = 'sans-serif';
		$value = $opts['font_' . $index];

		if ( !empty( $value ) ) {
			if ( 'default' !== $value['type'] ) {
				if ( isset( $value['category'] ) && !in_array( $value['category'], array( 'sans-serif', 'serif' ) ) ) {
					$fallback_font = 'sans-serif';
				}

				$font['font-family'] = "'" . $value['family'] . "', " . $fallback_font;
				 // remove italic out of 'style' to get font-weight
				if ( false !== strpos( $value['style'], 'italic' ) ) {
					$font['font-style'] = 'italic';
					$value['style'] = str_replace( 'italic', '', $value['style'] );
				} else {
					$font['font-style'] = 'normal';
				}

				if ( is_numeric( $value['style'] ) || in_array( $value['style'], array( 'normal', 'bold' ) ) ) {
					$font['font-weight'] = $value['style'];
				} else {
					$font['font-weight'] = 'normal';
				}

				if ( 'custom' === $value['type'] ) {
					$opts['custom_fonts'][] = $value;
				}
			} else {
				$font['font-family'] = $value['family'];
			}
		}

		$opts['fonts'][$index] = $font;
	}

	// Color Scheme
	$opts['primary_brand'] = $opts['bp_color_1'];
	$opts['secondary_brand'] = $opts['bp_color_2'];
	$opts['primary_brand_contrast'] = fabrique_contrast_color( $opts['bp_color_1'] );
	$opts['secondary_brand_contrast'] = fabrique_contrast_color( $opts['bp_color_2'] );
	if ( 'light' === $opts['default_color_scheme'] ) {
		$button_primary_text_color = $opts['bp_color_5'];
		$opts['primary_text'] = $opts['bp_color_3'];
		$opts['secondary_text'] = $opts['bp_color_4'];
		$opts['primary_background'] = $opts['bp_color_5'];
		$opts['secondary_background'] = $opts['bp_color_6'];
		$opts['primary_border'] = $opts['bp_color_7'];
	} elseif ( 'dark' === $opts['default_color_scheme'] ) {
		$button_primary_text_color = $opts['bp_color_10'];
		$opts['primary_text'] = $opts['bp_color_8'];
		$opts['secondary_text'] = $opts['bp_color_9'];
		$opts['primary_background'] = $opts['bp_color_10'];
		$opts['secondary_background'] = $opts['bp_color_11'];
		$opts['primary_border'] = $opts['bp_color_12'];
	}

	$opts['primary_text_contrast'] = fabrique_contrast_color( $opts['primary_text'] );
	$opts['secondary_text_contrast'] = fabrique_contrast_color( $opts['secondary_text'] );
	$opts['primary_background_contrast'] = fabrique_contrast_color( $opts['primary_background'] );
	$color_set = array(
		'default' => array(
			'primary_brand' => $opts['primary_brand'],
			'primary_brand_contrast' => $opts['primary_brand_contrast'],
			'secondary_brand' => $opts['secondary_brand'],
			'secondary_brand_contrast' => $opts['secondary_brand_contrast'],
			'primary_text' => $opts['primary_text'],
			'primary_text_contrast' => $opts['primary_text_contrast'],
			'secondary_text' => $opts['secondary_text'],
			'secondary_text_contrast' => $opts['secondary_text_contrast'],
			'primary_background' => $opts['primary_background'],
			'primary_background_contrast' => $opts['primary_background_contrast'],
			'secondary_background' => $opts['secondary_background'],
			'primary_border' => $opts['primary_border'],
		),
		'light' => array(
			'primary_brand' => $opts['primary_brand'],
			'primary_brand_contrast' => $opts['primary_brand_contrast'],
			'secondary_brand' => $opts['secondary_brand'],
			'secondary_brand_contrast' => $opts['secondary_brand_contrast'],
			'primary_text' => $opts['bp_color_3'],
			'primary_text_contrast' => fabrique_contrast_color( $opts['bp_color_3'] ),
			'secondary_text' => $opts['bp_color_4'],
			'secondary_text_contrast' => fabrique_contrast_color( $opts['bp_color_4'] ),
			'primary_background' => $opts['bp_color_5'],
			'primary_background_contrast' => fabrique_contrast_color( $opts['bp_color_5'] ),
			'secondary_background' => $opts['bp_color_6'],
			'primary_border' => $opts['bp_color_7'],
		),
		'dark' => array(
			'primary_brand' => $opts['primary_brand'],
			'primary_brand_contrast' => $opts['primary_brand_contrast'],
			'secondary_brand' => $opts['secondary_brand'],
			'secondary_brand_contrast' => $opts['secondary_brand_contrast'],
			'primary_text' => $opts['bp_color_8'],
			'primary_text_contrast' => fabrique_contrast_color( $opts['bp_color_8'] ),
			'secondary_text' => $opts['bp_color_9'],
			'secondary_text_contrast' => fabrique_contrast_color( $opts['bp_color_9'] ),
			'primary_background' => $opts['bp_color_10'],
			'primary_background_contrast' => fabrique_contrast_color( $opts['bp_color_10'] ),
			'secondary_background' => $opts['bp_color_11'],
			'primary_border' => $opts['bp_color_12'],
		)
	);

	$opts['base_sch_args'] = array( 'all_color' => $color_set, 'default_scheme' => $opts['default_color_scheme'] );
	// Button Color
	if ( 'border' === $opts['button_style'] ) {
		$opts['button_text_color'] = $opts['bp_color_1'];
		$opts['button_border_color'] = $opts['bp_color_1'];
		$opts['button_background_color'] = 'transparent';
	} else {
		$opts['button_text_color'] = $opts['primary_brand_contrast'];
		$opts['button_border_color'] = $opts['bp_color_1'];
		$opts['button_background_color'] = $opts['bp_color_1'];
	}

	if ( 'inverse' === $opts['button_hover_style'] ) {
		if ( 'border' === $opts['button_style'] ) {
			$opts['button_text_hover_color'] = $opts['primary_brand_contrast'];
			$opts['button_border_hover_color'] = $opts['bp_color_1'];
			$opts['button_background_hover_color'] = $opts['bp_color_1'];
		} else {
			$opts['button_text_hover_color'] = $opts['bp_color_1'];
			$opts['button_border_hover_color'] = $opts['bp_color_1'];
			$opts['button_background_hover_color'] = 'transparent';
		}
	} elseif ( 'none' === $opts['button_hover_style'] ) {
		if ( 'border' === $opts['button_style'] ) {
			$opts['button_text_hover_color'] = $opts['bp_color_1'];
			$opts['button_border_hover_color'] = $opts['bp_color_1'];
			$opts['button_background_hover_color'] = 'transparent';
		} else {
			$opts['button_text_hover_color'] = $opts['primary_brand_contrast'];
			$opts['button_border_hover_color'] = $opts['bp_color_1'];
			$opts['button_background_hover_color'] = $opts['bp_color_1'];
		}
	} else {
		if ( 'border' === $opts['button_style'] ) {
			$opts['button_text_hover_color'] = $opts['bp_color_2'];
			$opts['button_border_hover_color'] = $opts['bp_color_2'];
			$opts['button_background_hover_color'] = 'transparent';
		} else {
			$opts['button_text_hover_color'] = $opts['secondary_brand_contrast'];
			$opts['button_border_hover_color'] = $opts['bp_color_2'];
			$opts['button_background_hover_color'] = $opts['bp_color_2'];
		}
	}

	if ( 'small' === $opts['button_size'] ) {
		$opts['button_padding'] = '12.5px 24px';
	} elseif ( 'medium' === $opts['button_size'] ) {
		$opts['button_padding'] = '16.5px 32px';
	} elseif ( 'large' === $opts['button_size'] ) {
		$opts['button_padding'] = '20.5px 44px';
	}

	return $opts;
}
endif;


/**
 * Output CSS properties in style-custom
 */
if ( !function_exists( 'fabrique_sch_css' ) ) :
function fabrique_sch_css( $args = array(), $blueprint = false )
{
	if ( !isset( $args['selector'] ) || !isset( $args['property'] ) ) {
		return;
	} else {
		$color = $args['all_color'];
		$opacity = isset( $args['opacity'] ) ? $args['opacity'] : 1;
		$parents = isset( $args['parent'] ) ? $args['parent'] : '';
		$default_scheme = isset( $args['default_scheme'] ) ? $args['default_scheme'] : 'light';
		$high_level_selector = isset( $args['is_high_level'] ) ? $args['is_high_level'] : false; // selector is the same level with scheme class
		$blueprint_class = ( $blueprint ) ? '.bp-context ' : '';
		$important = isset( $args['important'] ) ? $args['important'] : false;

		if ( 'dark' === $default_scheme ) {
			$schemes = array( 'default', 'light', 'dark' );
		} else {
			$schemes = array( 'default', 'dark', 'light' );
		}

		$all_prop = array();
		$extra_prop = array();

		foreach ( $schemes as $scheme ) {
			$all_prop[$scheme]['class'] = array();

			if ( is_array( $args['selector'] ) ) {
				foreach ( $args['selector'] as $selector ) {
					if ( 'default' === $scheme ) {
						$all_prop[$scheme]['class'][] = $blueprint_class . $selector;
					} else {
						$all_prop[$scheme]['class'][] = $blueprint_class . '.fbq-' . $scheme . '-scheme ' . $selector;

						if ( $high_level_selector ) {
							$all_prop[$scheme]['class'][] = $blueprint_class . '.fbq-' . $scheme . '-scheme' . $selector;
						}

						if ( !empty( $parents ) ) {
							if ( is_array( $parents ) ) {
								foreach ( $parents as $parent_class ) {
									$extra_prop[$scheme]['class'][] = $blueprint_class . '.fbq-' . $parent_class . '-' . $scheme . '-scheme ' . $selector;
								}
							} else {
								$extra_prop[$scheme]['class'][] = $blueprint_class . '.fbq-' . $parents . '-' . $scheme . '-scheme ' . $selector;
							}
						}
					}
				}
			} else {
				if ( 'default' === $scheme ) {
					$all_prop[$scheme]['class'][] = $blueprint_class . $args['selector'];
				} else {
					$all_prop[$scheme]['class'][] = $blueprint_class . '.fbq-' . $scheme . '-scheme ' . $args['selector'];

					if ( $high_level_selector ) {
						$all_prop[$scheme]['class'][] = $blueprint_class . '.fbq-' . $scheme . '-scheme' . $args['selector'];
					}

					if ( !empty( $parents ) ) {
						if ( is_array( $parents ) ) {
							foreach ( $parents as $parent_class ) {
								$extra_prop[$scheme]['class'][] = $blueprint_class . '.fbq-' . $parent_class . '-' . $scheme . '-scheme ' . $args['selector'];
							}
						} else {
							$extra_prop[$scheme]['class'][] = $blueprint_class . '.fbq-' . $parents . '-' . $scheme . '-scheme ' . $args['selector'];
						}
					}
				}
			}

			$all_prop[$scheme]['property'] = array();
			foreach ( $args['property'] as $key => $value ) {
				$property = ( !$important ) ? esc_attr( $key ) . ': ' . $color[$scheme][$value] . ';' : esc_attr( $key ) . ': ' . $color[$scheme][$value] . ' !important;';

				if ( 1 != $opacity && 'background-color' === $key ) {
					$property .= ( !$important ) ? ' ' . esc_attr( $key ) . ': ' . fabrique_hex_to_rgba( $color[$scheme][$value], $opacity ) . ';' : ' ' . esc_attr( $key ) . ': ' . fabrique_hex_to_rgba( $color[$scheme][$value], $opacity ) . ' !important;';
				}

				$all_prop[$scheme]['property'][] = $property;

				if ( !empty( $parents ) && ( 'default' !== $scheme ) ) {
					$extra_prop[$scheme]['property'][] = $property;
				}
			}
		}

		$output = array();
		foreach ( $all_prop as $css_prop ) {
			$output[] = implode( ', ', $css_prop['class'] ) . ' {' . implode( ' ', $css_prop['property'] ) . '}';
		}

		if ( !empty( $parents ) && !empty( $extra_prop ) ) {
			foreach ( $extra_prop as $css_prop ) {
				$output[] = implode( ', ', $css_prop['class'] ) . ' {' . implode( ' ', $css_prop['property'] ) . '}';
			}
		}

		echo implode( "\n", $output );
	}
}
endif;
