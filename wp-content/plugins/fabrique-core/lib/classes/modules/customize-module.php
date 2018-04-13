<?php

class Fabrique_Customize_Module extends Fabrique_Base_Module
{
	protected $customize_defaults;

	public function get_name()
	{
		return 'customize';
	}

	public function start()
	{
		add_action( 'customize_register', array( $this, 'customize_register' ), 10 );
		add_action( 'customize_save_after', array( $this, 'customize_save_after' ) );
		add_action( 'customize_preview_init', array( $this, 'customize_preview_init' ) );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'customize_controls_enqueue_scripts' ) );

		add_action( 'admin_post_bp_customizer_export', array( $this, 'customizer_export' ) );
		add_action( 'admin_post_bp_customizer_import', array( $this, 'customizer_import' ) );
		add_action( 'admin_post_bp_customizer_reset', array( $this, 'customizer_reset' ) );

		add_filter( 'blueprint_options', array( $this, 'blueprint_options' ) );
	}

	public function customizer_reset()
	{
		$options = array_merge( get_theme_mods(), fabrique_theme_options() );
		update_option( 'theme_mods_fabrique', $theme_mods, true );

		return $this->base_admin_redirect( 'customizer', 'success', __( 'Customizer settings reset', 'fabrique-core' ) );
	}

	public function customizer_import()
	{
		if ( !isset( $_FILES['bp_import_file'] ) ) {
			return $this->base_admin_redirect( 'customizer', 'error', __( 'Unable to upload selected file', 'fabrique-core' ) );
		}

		$content = file_get_contents( $_FILES['bp_import_file']['tmp_name'] );
		$data = json_decode( $content, true );
		$theme_mods = $data['theme_mods'];
		$theme_folder_name = wp_get_theme()->stylesheet;

		update_option( 'theme_mods_' . $theme_folder_name, $theme_mods, true );

		return $this->base_admin_redirect( 'customizer', 'success', __( 'Import customizer settings completed', 'fabrique-core' ) );
	}

	public function customizer_export()
	{
		$data = array( 'theme_mods' => get_theme_mods() );

		header( 'Content-type: application/json; charset=utf-8;' );
		header( 'Content-Disposition: attachment; filename="customize-settings.json"' );

		print( json_encode( $data ) );
	}

	public function blueprint_options( $options )
	{
		$colors = array();
		$default_colors = $this->get_default_theme_colors();

		foreach ($default_colors as $key => $value ) {
			if ( $color = get_theme_mod( $key ) ) {
				$colors[$key] = $color;
			} else {
				$colors[$key] = $value;
			}
		}

		$options['colors'] = $colors;

		return $options;
	}

	public function customize_preview_init()
	{
		do_action( 'fabrique_core_customize_preview_scripts' );
	}

	public function customize_save_after( $wp_customize )
	{
		$values = get_theme_mods();
		$settings = $wp_customize->settings();

		foreach ( $settings as $key => $setting ) {
			$values[$key] = $setting->value();
		}

		$this->write_style_custom( $values );
	}

	public function customize_controls_enqueue_scripts()
	{
		do_action( 'fabrique_core_customize_scripts', array(), array() );
	}

	public function write_style_custom( $values = null )
	{
		$sender = 'wp-admin/customize.php';

		if ( !$values ) {
			$values = $this->get_customize_values();
		}

		$style_dir = fabrique_core_style_custom_dir();

		if ( Fabrique_Util::can_write_file( $sender, $style_dir['path'] ) ) {
			$output = fabrique_core_template_style_custom( $values );
			Fabrique_Util::write_file( $sender, $style_dir['path'], $output );

			$version = substr( md5( $output ), 0, 8 );
			$version = apply_filters( 'fabrique_core_style_custom_version', $version, $output );

			set_theme_mod( 'style_custom_version', $version );
			set_theme_mod( 'style_custom', $style_dir['url'] );
		}
	}

	public function get_customize_values( $wp_customize = null )
	{
		$values = array();
		$default_options = $this->get_default_options();

		if ( $wp_customize ) {
			foreach ( $default_options as $key => $value ) {
				$setting = $wp_customize->get_setting( $key );

				if ( $setting ) {
					$values[$key] = $setting->value();
				} else {
					$values[$key] = get_theme_mod( $key );
				}
			}
		} else {
			$values = get_theme_mods();

			if ( $values && is_array( $values ) ) {
				$values = array_merge( $default_options, $values );
			} else {
				$values = $default_options;
			}
		}

		return apply_filters( 'fabrique_customize_values', $values );
	}

	public function get_customize_panels()
	{
		return array(
			'fabrique_color_panel' => array(
				'title' => esc_html__( 'Theme Color', 'fabrique-core' ),
				'priority' => 1
			),
			'fabrique_style_panel' => array(
				'title' => esc_html__( 'Design', 'fabrique-core' ),
				'priority' => 20
			),
			'fabrique_header_panel' => array(
				'title' => esc_html__( 'Header', 'fabrique-core' ),
				'priority' => 30
			),
			'fabrique_woocommerce_panel' => array(
				'title' => esc_html__( 'WooCommerce', 'fabrique-core' ),
				'priority' => 60
			),
			'fabrique_social_panel' => array(
				'title' => esc_html__( 'Social', 'fabrique-core' ),
				'priority' => 70
			)
		);
	}

	public function get_customize_sections()
	{
 		return array(
			'fabrique_color_scheme_section' => array(
				'panel' => 'fabrique_color_panel',
				'title' => esc_html__( 'Color Scheme', 'fabrique-core' ),
				'description' => esc_html__( "Set the main components' color scheme.", 'fabrique-core' ),
				'priority' => 3
			),
			'fabrique_color_section' => array(
				'panel' => 'fabrique_color_panel',
				'title' => esc_html__( 'Color', 'fabrique-core' ),
				'description' => esc_html__( 'These colors will be used as sync color in color pickers.', 'fabrique-core' ),
				'priority' => 5
			),
			'fabrique_logo_section' => array(
				'title' => esc_html__( 'Logo', 'fabrique-core' ),
				'priority' => 6
			),
			'fabrique_layout_section' => array(
				'title' => esc_html__( 'Layout', 'fabrique-core' ),
				'priority' => 10
			),
			'fabrique_responsive_section' => array(
				'title' => esc_html__( 'Responsive', 'fabrique-core' ),
				'priority' => 12
			),
			'fabrique_header_navigation_section' => array(
				'panel' => 'fabrique_header_panel',
				'title' => esc_html__( 'Navigation Bar', 'fabrique-core' ),
				'priority' => 20
			),
			'fabrique_header_mobile_navigation_section' => array(
				'panel' => 'fabrique_header_panel',
				'title' => esc_html__( 'Mobile Navigation', 'fabrique-core' ),
				'priority' => 25
			),
			'fabrique_header_fixed_navigation_section' => array(
				'panel' => 'fabrique_header_panel',
				'title' => esc_html__( 'Fixed Navigation', 'fabrique-core' ),
				'priority' => 30
			),
			'fabrique_header_topbar_section' => array(
				'panel' => 'fabrique_header_panel',
				'title' => esc_html__( 'Topbar', 'fabrique-core' ),
				'priority' => 40
			),
			'fabrique_header_action_button_section' => array(
				'panel' => 'fabrique_header_panel',
				'title' => esc_html__( 'Action / Header Widget', 'fabrique-core' ),
				'description' => esc_html__( 'Action and header widget will not be applied with side navigation', 'fabrique-core' ),
				'priority' => 50
			),
			'fabrique_style_typography_section' => array(
				'panel' => 'fabrique_style_panel',
				'title' => esc_html__( 'Typography', 'fabrique-core' ),
				'priority' => 30
			),
			'fabrique_style_heading_section' => array(
				'panel' => 'fabrique_style_panel',
				'title' => esc_html__( 'Heading', 'fabrique-core' ),
				'priority' => 40
			),
			'fabrique_style_button_section' => array(
				'panel' => 'fabrique_style_panel',
				'title' => esc_html__( 'Button', 'fabrique-core' ),
				'priority' => 50
			),
			'fabrique_style_carousel_section' => array(
				'panel' => 'fabrique_style_panel',
				'title' => esc_html__( 'Carousel', 'fabrique-core' ),
				'priority' => 60
			),
			'fabrique_style_cookies_section' => array(
				'panel' => 'fabrique_style_panel',
				'title' => esc_html__( 'Cookies', 'fabrique-core' ),
				'priority' => 70
			),
			'fabrique_style_preload_section' => array(
				'panel' => 'fabrique_style_panel',
				'title' => esc_html__( 'Page Preloading', 'fabrique-core' ),
				'priority' => 80
			),
			'fabrique_style_back_to_top_section' => array(
				'panel' => 'fabrique_style_panel',
				'title' => esc_html__( 'Back to top button', 'fabrique-core' ),
				'priority' => 90
			),
			'fabrique_footer_section' => array(
				'title' => esc_html__( 'Footer', 'fabrique-core' ),
				'priority' => 40
			),
			'fabrique_page_title_section' => array(
				'title' => esc_html__( 'Page Title', 'fabrique-core' ),
				'description' => esc_html__( "Tip: this will apply to archives, search results, tags, categories, and authors page.", 'fabrique-core' ),
				'priority' => 45
			),
			'fabrique_blog_section' => array(
				'title' => esc_html__( 'Blog', 'fabrique-core' ),
				'description' => esc_html__( "Tip: this will apply to index, archives, search results, tags, categories, and authors page.", 'fabrique-core' ),
				'priority' => 50
			),
			'fabrique_project_section' => array(
				'title' => esc_html__( 'Project', 'fabrique-core' ),
				'priority' => 55
			),
			'fabrique_shop_section' => array(
				'panel' => 'fabrique_woocommerce_panel',
				'title' => esc_html__( 'Shop', 'fabrique-core' ),
				'priority' => 10
			),
			'fabrique_product_section' => array(
				'panel' => 'fabrique_woocommerce_panel',
				'title' => esc_html__( 'Product', 'fabrique-core' ),
				'priority' => 20
			),
			'fabrique_social_section' => array(
				'panel' => 'fabrique_social_panel',
				'title' => esc_html__( 'Site Social', 'fabrique-core' ),
				'description' => esc_html__( "Tip: this will apply with social widgets.", 'fabrique-core' ),
				'priority' => 10
			),
			'fabrique_social_share_section' => array(
				'panel' => 'fabrique_social_panel',
				'title' => esc_html__( 'Social Share', 'fabrique-core' ),
				'description' => esc_html__( "This will apply with anywhere that has social share buttons. (Ex. Single post, Single product.)", 'fabrique-core' ),
				'priority' => 20
			)
		);
	}

	public function customize_register( $wp_customize )
	{
		$panels = $this->get_customize_panels();
		$sections = $this->get_customize_sections();

		foreach ( $panels as $name => $panel ) {
			$wp_customize->add_panel( $name, $panel );
		}

		foreach ( $sections as $name => $section ) {
			$wp_customize->add_section( $name, $section );
		}

		$wp_customize->remove_section( 'colors' );
		$wp_customize->remove_section( 'header_image' );
		$wp_customize->remove_section( 'background_image' );
		$wp_customize->remove_section( 'nav' );
		$wp_customize->remove_section( 'static_front_page' );

		$defaults = apply_filters( 'fabrique_core_default_customize_options', $this->get_default_options() );
		$image_sizes = apply_filters( 'fabrique_core_customize_image_size_options', $this->image_size_options() );
		$fonts = $this->font_options();

		$wp_customize->add_setting( 'default_color_scheme', array(
			'default' => $defaults['default_color_scheme'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'default_color_scheme', array (
			'section' => 'fabrique_color_scheme_section',
			'settings' => 'default_color_scheme',
			'label' => esc_html__( 'Site Default Color Scheme', 'fabrique-core' ),
			'description' => esc_html__( 'Select your main scheme of the site.', 'fabrique-core' ),
			'priority' => 10,
			'choices' => array(
				'light' => esc_html__( 'Light', 'fabrique-core' ),
				'dark' => esc_html__( 'Dark', 'fabrique-core' )
			)
		) ) );

		$wp_customize->add_setting( 'topbar_color_scheme', array(
			'default' => $defaults['topbar_color_scheme'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'topbar_color_scheme', array (
			'section' => 'fabrique_color_scheme_section',
			'settings' => 'topbar_color_scheme',
			'label' => esc_html__( 'Topbar Color Scheme', 'fabrique-core' ),
			'priority' => 20,
			'choices' => array(
				'light' => esc_html__( 'Light', 'fabrique-core' ),
				'dark' => esc_html__( 'Dark', 'fabrique-core' )
			)
		) ) );


		$wp_customize->add_setting( 'navbar_color_scheme', array(
			'default' => $defaults['navbar_color_scheme'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'navbar_color_scheme', array (
			'section' => 'fabrique_color_scheme_section',
			'settings' => 'navbar_color_scheme',
			'label' => esc_html__( 'Navigation Bar Color Scheme', 'fabrique-core' ),
			'priority' => 30,
			'choices' => array(
				'light' => esc_html__( 'Light', 'fabrique-core' ),
				'dark' => esc_html__( 'Dark', 'fabrique-core' )
			)
		) ) );


		$wp_customize->add_setting( 'header_widget_color_scheme', array(
			'default' => $defaults['header_widget_color_scheme'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'header_widget_color_scheme', array (
			'section' => 'fabrique_color_scheme_section',
			'settings' => 'header_widget_color_scheme',
			'label' => esc_html__( 'Header Widget Color Scheme', 'fabrique-core' ),
			'priority' => 40,
			'choices' => array(
				'light' => esc_html__( 'Light', 'fabrique-core' ),
				'dark' => esc_html__( 'Dark', 'fabrique-core' )
			)
		) ) );


		$wp_customize->add_setting( 'page_title_color_scheme', array(
			'default' => $defaults['page_title_color_scheme'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'page_title_color_scheme', array (
			'section' => 'fabrique_color_scheme_section',
			'settings' => 'page_title_color_scheme',
			'label' => esc_html__( 'Page Title Color Scheme', 'fabrique-core' ),
			'priority' => 60,
			'choices' => array(
				'default' => esc_html__( 'Default', 'fabrique-core' ),
				'light' => esc_html__( 'Light', 'fabrique-core' ),
				'dark' => esc_html__( 'Dark', 'fabrique-core' )
			)
		) ) );


		$wp_customize->add_setting( 'sidebar_color_scheme', array(
			'default' => $defaults['sidebar_color_scheme'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'sidebar_color_scheme', array (
			'section' => 'fabrique_color_scheme_section',
			'settings' => 'sidebar_color_scheme',
			'label' => esc_html__( 'Sidebar Color Scheme', 'fabrique-core' ),
			'priority' => 70,
			'choices' => array(
				'default' => esc_html__( 'Default', 'fabrique-core' ),
				'light' => esc_html__( 'Light', 'fabrique-core' ),
				'dark' => esc_html__( 'Dark', 'fabrique-core' )
			)
		) ) );

		$theme_colors = $this->get_default_theme_colors();

		foreach ( $theme_colors as $key => $default ) {
			$wp_customize->add_setting( $key, array(
				'default' => $default,
				'sanitize_callback' => 'fabrique_core_sanitize_color_value'
			) );
		}

		$wp_customize->add_control( new Fabrique_Theme_Color_Control( $wp_customize, 'theme_color', array (
			'label' => esc_html__( 'Preset Color', 'fabrique-core' ),
			'description' => esc_html__( "Preset Color will automatically apply all sync colors.", 'fabrique-core' ),
			'section' => 'fabrique_color_section',
			'settings' => array_keys( $theme_colors ),
			'priority' => 20
		) ) );


		$wp_customize->add_setting( 'navbar_offcanvas_cursor', array(
			'default' => $defaults['navbar_offcanvas_cursor'],
			'sanitize_callback' => 'fabrique_core_sanitize_url_value'
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'navbar_offcanvas_cursor', array (
			'section' => 'fabrique_logo_section',
			'settings' => 'navbar_offcanvas_cursor',
			'label' => esc_html__( 'Navigation Offcanvas Cursor', 'fabrique-core' ),
			'description' => esc_html__( 'Image of cursor display when offcanvas menu open ,Suggested size 80x80px', 'fabrique-core' ),
			'priority' => 23
		) ) );


		$wp_customize->add_setting( 'navbar_logo_section', array(
			'default' => $defaults['navbar_logo_section'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Section_Control( $wp_customize, 'navbar_logo_section', array (
			'section' => 'fabrique_logo_section',
			'settings' => 'navbar_logo_section',
			'label' => esc_html__( 'Logo on Navigation Bar (Default)', 'fabrique-core' ),
			'priority' => 25
		) ) );


		$wp_customize->add_setting( 'logo_type', array(
			'default' => $defaults['logo_type'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'logo_type', array (
			'section' => 'fabrique_logo_section',
			'settings' => 'logo_type',
			'label' => esc_html__( 'Navigation Bar Logo Type', 'fabrique-core' ),
			'priority' => 30,
			'choices' => array(
				'image' => esc_html__( 'Image', 'fabrique-core' ),
				'text' => esc_html__( 'Text', 'fabrique-core' )
			),
			'children' => array(
				'image' => array(
					'logo',
					'logo_width'
				),
				'text' => array(
					'logo_text_title',
					'logo_typography',
					'logo_font_color',
					'logo_font_size',
					'logo_letter_spacing'
				)
			)
		) ) );


		$wp_customize->add_setting( 'logo', array(
			'default' => $defaults['logo'],
			'sanitize_callback' => 'fabrique_core_sanitize_url_value'
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo', array (
			'section' => 'fabrique_logo_section',
			'settings' => 'logo',
			'label' => esc_html__( 'Logo Image', 'fabrique-core' ),
			'priority' => 40
		) ) );


		$wp_customize->add_setting( 'logo_width', array(
			'default' => $defaults['logo_width'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'logo_width', array (
			'section' => 'fabrique_logo_section',
			'settings' => 'logo_width',
			'label' => esc_html__( 'Logo on Navigation Bar Width (px)', 'fabrique-core' ),
			'description' => esc_html__( 'Suggested width: Half size of logo image width.', 'fabrique-core' ),
			'priority' => 50,
			'min' => 20,
			'max' => 400
		) ) );


		$wp_customize->add_setting( 'logo_text_title', array(
			'default' => $defaults['logo_text_title'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'logo_text_title', array(
			'section' => 'fabrique_logo_section',
			'settings' => 'logo_text_title',
			'label' => esc_html__( 'Logo Text Title', 'fabrique-core' ),
			'priority' => 60,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'logo_typography', array(
			'default' => $defaults['logo_typography'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'logo_typography', array(
			'section' => 'fabrique_logo_section',
			'settings' => 'logo_typography',
			'label' => esc_html__( 'Typography', 'fabrique-core' ),
			'priority' => 70,
			'type' => 'select',
			'choices' => $fonts
		) );


		$wp_customize->add_setting( 'logo_font_color', array(
			'default' => $defaults['logo_font_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'logo_font_color', array (
			'section' => 'fabrique_logo_section',
			'settings' => 'logo_font_color',
			'label' => esc_html__( 'Font Color', 'fabrique-core' ),
			'priority' => 80
		) ) );


		$wp_customize->add_setting( 'logo_font_size', array(
			'default' => $defaults['logo_font_size'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'logo_font_size', array (
			'section' => 'fabrique_logo_section',
			'settings' => 'logo_font_size',
			'label' => esc_html__( 'Font Size (px)', 'fabrique-core' ),
			'priority' => 90,
			'min' => 10,
			'max' => 50
		) ) );


		$wp_customize->add_setting( 'logo_letter_spacing', array(
			'default' => $defaults['logo_letter_spacing'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Text_Control( $wp_customize, 'logo_letter_spacing', array (
			'section' => 'fabrique_logo_section',
			'settings' => 'logo_letter_spacing',
			'label' => esc_html__( 'Letter Spacing (em)', 'fabrique-core' ),
			'priority' => 100
		) ) );


		$wp_customize->add_setting( 'mobile_navbar_logo_section', array(
			'default' => $defaults['mobile_navbar_logo_section'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Section_Control( $wp_customize, 'mobile_navbar_logo_section', array (
			'section' => 'fabrique_logo_section',
			'settings' => 'mobile_navbar_logo_section',
			'label' => esc_html__( 'Logo on Mobile Navigation Bar', 'fabrique-core' ),
			'priority' => 105
		) ) );


		$wp_customize->add_setting( 'mobile_navbar_logo', array(
			'default' => $defaults['mobile_navbar_logo'],
			'sanitize_callback' => 'fabrique_core_sanitize_url_value'
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mobile_navbar_logo', array (
			'section' => 'fabrique_logo_section',
			'settings' => 'mobile_navbar_logo',
			'label' => esc_html__( 'Logo on Mobile Navigation Bar', 'fabrique-core' ),
			'description' => esc_html__( 'Leave blank to use default navigation bar logo', 'fabrique-core' ),
			'priority' => 110
		) ) );


		$wp_customize->add_setting( 'mobile_navbar_logo_width', array(
			'default' => $defaults['mobile_navbar_logo_width'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'mobile_navbar_logo_width', array (
			'section' => 'fabrique_logo_section',
			'settings' => 'mobile_navbar_logo_width',
			'label' => esc_html__( 'Logo on Mobile Navigation Bar Width (px)', 'fabrique-core' ),
			'description' => esc_html__( 'Suggested width: Half size of logo image width.', 'fabrique-core' ),
			'priority' => 120,
			'min' => 20,
			'max' => 300
		) ) );


		$wp_customize->add_setting( 'fixed_navbar_logo_section', array(
			'default' => $defaults['fixed_navbar_logo_section'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Section_Control( $wp_customize, 'fixed_navbar_logo_section', array (
			'section' => 'fabrique_logo_section',
			'settings' => 'fixed_navbar_logo_section',
			'label' => esc_html__( 'Logo on Fixed Navigation Bar', 'fabrique-core' ),
			'priority' => 125
		) ) );


		$wp_customize->add_setting( 'fixed_navbar_logo', array(
			'default' => $defaults['fixed_navbar_logo'],
			'sanitize_callback' => 'fabrique_core_sanitize_url_value'
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'fixed_navbar_logo', array (
			'section' => 'fabrique_logo_section',
			'settings' => 'fixed_navbar_logo',
			'label' => esc_html__( 'Logo on Fixed Navigation', 'fabrique-core' ),
			'description' => esc_html__( 'This will apply with logo on "custom mode" top fixed navigation bar and also "full" style side navigation bar, leave blank to use the default navigation bar logo image.', 'fabrique-core' ),
			'priority' => 130
		) ) );


		$wp_customize->add_setting( 'fixed_navbar_logo_light_scheme', array(
			'default' => $defaults['fixed_navbar_logo_light_scheme'],
			'sanitize_callback' => 'fabrique_core_sanitize_url_value'
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'fixed_navbar_logo_light_scheme', array (
			'section' => 'fabrique_logo_section',
			'settings' => 'fixed_navbar_logo_light_scheme',
			'label' => esc_html__( 'Light Scheme Logo Image', 'fabrique-core' ),
			'description' => esc_html__( 'This will apply only when "Dark Scheme Logo Image" has also been uploaded and apply with only fixed navbar transparent.', 'fabrique-core' ),
			'priority' => 133
		) ) );


		$wp_customize->add_setting( 'fixed_navbar_logo_dark_scheme', array(
			'default' => $defaults['fixed_navbar_logo_dark_scheme'],
			'sanitize_callback' => 'fabrique_core_sanitize_url_value'
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'fixed_navbar_logo_dark_scheme', array (
			'section' => 'fabrique_logo_section',
			'settings' => 'fixed_navbar_logo_dark_scheme',
			'label' => esc_html__( 'Dark Scheme Logo Image', 'fabrique-core' ),
			'description' => esc_html__( 'This will apply only when "Light Scheme Logo Image" has also been uploaded and apply with only fixed navbar transparent.', 'fabrique-core' ),
			'priority' => 135
		) ) );


		$wp_customize->add_setting( 'fixed_navbar_logo_width', array(
			'default' => $defaults['fixed_navbar_logo_width'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'fixed_navbar_logo_width', array (
			'section' => 'fabrique_logo_section',
			'settings' => 'fixed_navbar_logo_width',
			'label' => esc_html__( 'Logo on Fixed Navigation Width (px)', 'fabrique-core' ),
			'description' => esc_html__( 'Suggested width: Half size of image file width. Note: this will not take effect with width of logo on "full" style side navigation bar which has constant width 60px.', 'fabrique-core' ),
			'priority' => 140,
			'min' => 20,
			'max' => 300
		) ) );


		$wp_customize->add_setting( 'site_layout', array(
			'default' => $defaults['site_layout'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'site_layout', array (
			'section' => 'fabrique_layout_section',
			'settings' => 'site_layout',
			'label' => esc_html__( 'Site Layout', 'fabrique-core' ),
			'radio_type' => 'image',
			'radio_style' => 'box',
			'names' => array(
				'boxed' => esc_html__( 'Boxed', 'fabrique-core' ),
				'wide' => esc_html__( 'Wide', 'fabrique-core' ),
				'frame' => esc_html__( 'Frame', 'fabrique-core' )
			),
			'choices' => array(
				'boxed' => 'customize-layout-boxed',
				'wide' => 'customize-layout-wide',
				'frame' => 'customize-layout-frame'
			),
			'priority' => 20,
			'children' => array(
				'boxed' => array(
					'body_background'
				),
				'frame' => array(
					'frame_width',
					'frame_color',
					'header_on_frame'
				)
			)
		) ) );


		$wp_customize->add_setting( 'frame_color', array(
			'default' => $defaults['frame_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'frame_color', array (
			'section' => 'fabrique_layout_section',
			'settings' => 'frame_color',
			'label' => esc_html__( 'Frame Color', 'fabrique-core' ),
			'priority' => 30
		) ) );


		$wp_customize->add_setting( 'frame_width', array(
			'default' => $defaults['frame_width'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'frame_width', array (
			'section' => 'fabrique_layout_section',
			'settings' => 'frame_width',
			'label' => esc_html__( 'Frame Width', 'fabrique-core' ),
			'priority' => 40,
			'min' => 1,
			'max' => 200
		) ) );


		$wp_customize->add_setting( 'content_max_width', array(
			'default' => $defaults['content_max_width'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'content_max_width', array (
			'section' => 'fabrique_layout_section',
			'settings' => 'content_max_width',
			'label' => esc_html__( 'Site Area Max Width (px)', 'fabrique-core' ),
			'priority' => 50,
			'min' => 320,
			'max' => 2000
		) ) );


		$wp_customize->add_setting( 'side_padding', array(
			'default' => $defaults['side_padding'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'side_padding', array (
			'section' => 'fabrique_layout_section',
			'settings' => 'side_padding',
			'label' => esc_html__( 'Side Padding (%)', 'fabrique-core' ),
			'priority' => 60,
			'min' => 0,
			'max' => 50
		) ) );


		$wp_customize->add_setting( 'header_on_frame', array(
			'default' => $defaults['header_on_frame'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'header_on_frame', array (
			'section' => 'fabrique_layout_section',
			'settings' => 'header_on_frame',
			'label' => esc_html__( 'Header Cover on Frame', 'fabrique-core' ),
			'description' => esc_html__( 'Header will cover on top frame', 'fabrique-core' ),
			'priority' => 70
		) ) );


		$wp_customize->add_setting( 'sidebar', array(
			'default' => $defaults['sidebar'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'sidebar', array (
			'section' => 'fabrique_layout_section',
			'settings' => 'sidebar',
			'label' => esc_html__( 'Sidebar', 'fabrique-core' ),
			'priority' => 80,
			'children' => array(
				'sidebar_position',
				'sidebar_select',
				'sidebar_fixed',
				'sidebar_background_color',
				'sidebar_width',
				'sidebar_top_padding'
			)
		) ) );


		$wp_customize->add_setting( 'sidebar_position', array(
			'default' => $defaults['sidebar_position'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'sidebar_position', array (
			'section' => 'fabrique_layout_section',
			'settings' => 'sidebar_position',
			'label' => esc_html__( 'Sidebar Position', 'fabrique-core' ),
			'priority' => 90,
			'choices' => array(
				'left' => esc_html__( 'Left', 'fabrique-core' ),
				'right' => esc_html__( 'Right', 'fabrique-core' )
			)
		) ) );


		$wp_customize->add_setting( 'sidebar_select', array(
			'default' => $defaults['sidebar_select'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Select_Control( $wp_customize, 'sidebar_select', array (
			'select_type' => 'sidebar',
			'section' => 'fabrique_layout_section',
			'settings' => 'sidebar_select',
			'label' => esc_html__( 'Select A Sidebar', 'fabrique-core' ),
			'priority' => 100
		) ) );


		$wp_customize->add_setting( 'sidebar_fixed', array(
			'default' => $defaults['sidebar_fixed'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'sidebar_fixed', array (
			'section' => 'fabrique_layout_section',
			'settings' => 'sidebar_fixed',
			'label' => esc_html__( 'Fixed Sidebar', 'fabrique-core' ),
			'priority' => 110
		) ) );


		$wp_customize->add_setting( 'sidebar_background_color', array(
			'default' => $defaults['sidebar_background_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'sidebar_background_color', array (
			'section' => 'fabrique_layout_section',
			'settings' => 'sidebar_background_color',
			'label' => esc_html__( 'Sidebar Background Color', 'fabrique-core' ),
			'priority' => 120
		) ) );


		$wp_customize->add_setting( 'sidebar_width', array(
			'default' => $defaults['sidebar_width'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'sidebar_width', array (
			'section' => 'fabrique_layout_section',
			'settings' => 'sidebar_width',
			'label' => esc_html__( 'Sidebar Width (%)', 'fabrique-core' ),
			'priority' => 130,
			'min' => 10,
			'max' => 50
		) ) );


		$wp_customize->add_setting( 'sidebar_top_padding', array(
			'default' => $defaults['sidebar_top_padding'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'sidebar_top_padding', array (
			'section' => 'fabrique_layout_section',
			'settings' => 'sidebar_top_padding',
			'label' => esc_html__( 'Sidebar Top Padding (px)', 'fabrique-core' ),
			'description' => esc_html__( "This won't effect with sidebar in single post.", 'fabrique-core' ),
			'priority' => 140,
			'min' => 0,
			'max' => 100
		) ) );


		$wp_customize->add_setting( 'content_background', array(
			'default' => $defaults['content_background'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'content_background', array (
			'section' => 'fabrique_layout_section',
			'settings' => 'content_background',
			'label' => esc_html__( 'Content Background', 'fabrique-core' ),
			'priority' => 150,
			'advance' => true,
			'children' => array(
				'content_background_color',
				'content_background_image',
				'content_background_repeat',
				'content_background_size',
				'content_background_position',
				'content_background_attachment'
			)
		) ) );


		$wp_customize->add_setting( 'content_background_color', array(
			'default' => $defaults['content_background_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'content_background_color', array (
			'section' => 'fabrique_layout_section',
			'settings' => 'content_background_color',
			'label' => esc_html__( 'Background Color', 'fabrique-core' ),
			'priority' => 160
		) ) );


		$wp_customize->add_setting( 'content_background_image', array(
			'default' => $defaults['content_background_image'],
			'sanitize_callback' => 'fabrique_core_sanitize_url_value'
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'content_background_image', array (
			'section' => 'fabrique_layout_section',
			'settings' => 'content_background_image',
			'label' => esc_html__( 'Background Image', 'fabrique-core' ),
			'priority' => 170
		) ) );


		$wp_customize->add_setting( 'content_background_repeat', array(
			'default' => $defaults['content_background_repeat'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'content_background_repeat', array(
			'section' => 'fabrique_layout_section',
			'settings' => 'content_background_repeat',
			'label' => esc_html__( 'Background Repeat', 'fabrique-core' ),
			'priority' => 180,
			'type' => 'select',
			'choices' => array(
				'repeat' => esc_html__( 'Repeat', 'fabrique-core' ),
				'repeat-x' => esc_html__( 'Repeat-x', 'fabrique-core' ),
				'repeat-y' => esc_html__( 'Repeat-y', 'fabrique-core' ),
				'no-repeat' => esc_html__( 'No Repeat', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'content_background_size', array(
			'default' => $defaults['content_background_size'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'content_background_size', array(
			'section' => 'fabrique_layout_section',
			'settings' => 'content_background_size',
			'label' => esc_html__( 'Background Size', 'fabrique-core' ),
			'priority' => 190,
			'type' => 'select',
			'choices' => array(
				'auto' => esc_html__( 'Auto', 'fabrique-core' ),
				'cover' => esc_html__( 'Cover', 'fabrique-core' ),
				'contain' => esc_html__( 'Contain', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'content_background_position', array(
			'default' => $defaults['content_background_position'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'content_background_position', array(
			'section' => 'fabrique_layout_section',
			'settings' => 'content_background_position',
			'label' => esc_html__( 'Background Position', 'fabrique-core' ),
			'priority' => 200,
			'type' => 'select',
			'choices' => array(
				'left top' => esc_html__( 'Left Top', 'fabrique-core' ),
				'left center' => esc_html__( 'Left Center', 'fabrique-core' ),
				'left bottom' => esc_html__( 'Left Bottom', 'fabrique-core' ),
				'right top' => esc_html__( 'Right Top', 'fabrique-core' ),
				'right center' => esc_html__( 'Right Center', 'fabrique-core' ),
				'right bottom' => esc_html__( 'Right Bottom', 'fabrique-core' ),
				'center top' => esc_html__( 'Center Top', 'fabrique-core' ),
				'center center' => esc_html__( 'Center Center', 'fabrique-core' ),
				'center bottom' => esc_html__( 'Center Bottom', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'content_background_attachment', array(
			'default' => $defaults['content_background_attachment'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'content_background_attachment', array (
			'section' => 'fabrique_layout_section',
			'settings' => 'content_background_attachment',
			'label' => esc_html__( 'Background Attachment Fixed', 'fabrique-core' ),
			'priority' => 210
		) ) );


		$wp_customize->add_setting( 'body_background', array(
			'default' => $defaults['body_background'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'body_background', array (
			'section' => 'fabrique_layout_section',
			'settings' => 'body_background',
			'label' => esc_html__( 'Body Background', 'fabrique-core' ),
			'priority' => 220,
			'advance' => true,
			'children' => array(
				'body_background_color',
				'body_background_image',
				'body_background_repeat',
				'body_background_size',
				'body_background_position',
				'body_background_attachment',
				'boxed_shadow'
			)
		) ) );


		$wp_customize->add_setting( 'body_background_color', array(
			'default' => $defaults['body_background_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'body_background_color', array (
			'section' => 'fabrique_layout_section',
			'settings' => 'body_background_color',
			'label' => esc_html__( 'Background Color', 'fabrique-core' ),
			'priority' => 230
		) ) );


		$wp_customize->add_setting( 'body_background_image', array(
			'default' => $defaults['body_background_image'],
			'sanitize_callback' => 'fabrique_core_sanitize_url_value'
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'body_background_image', array (
			'section' => 'fabrique_layout_section',
			'settings' => 'body_background_image',
			'label' => esc_html__( 'Background Image', 'fabrique-core' ),
			'priority' => 240
		) ) );


		$wp_customize->add_setting( 'body_background_repeat', array(
			'default' => $defaults['body_background_repeat'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'body_background_repeat', array(
			'section' => 'fabrique_layout_section',
			'settings' => 'body_background_repeat',
			'label' => esc_html__( 'Background Repeat', 'fabrique-core' ),
			'priority' => 250,
			'type' => 'select',
			'choices' => array(
				'repeat' => esc_html__( 'Repeat', 'fabrique-core' ),
				'repeat-x' => esc_html__( 'Repeat-x', 'fabrique-core' ),
				'repeat-y' => esc_html__( 'Repeat-y', 'fabrique-core' ),
				'no-repeat' => esc_html__( 'No Repeat', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'body_background_size', array(
			'default' => $defaults['body_background_size'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'body_background_size', array(
			'section' => 'fabrique_layout_section',
			'settings' => 'body_background_size',
			'label' => esc_html__( 'Background Size', 'fabrique-core' ),
			'priority' => 260,
			'type' => 'select',
			'choices' => array(
				'auto' => esc_html__( 'Auto', 'fabrique-core' ),
				'cover' => esc_html__( 'Cover', 'fabrique-core' ),
				'contain' => esc_html__( 'Contain', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'body_background_position', array(
			'default' => $defaults['body_background_position'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'body_background_position', array(
			'section' => 'fabrique_layout_section',
			'settings' => 'body_background_position',
			'label' => esc_html__( 'Background Position', 'fabrique-core' ),
			'priority' => 270,
			'type' => 'select',
			'choices' => array(
				'left top' => esc_html__( 'Left Top', 'fabrique-core' ),
				'left center' => esc_html__( 'Left Center', 'fabrique-core' ),
				'left bottom' => esc_html__( 'Left Bottom', 'fabrique-core' ),
				'right top' => esc_html__( 'Right Top', 'fabrique-core' ),
				'right center' => esc_html__( 'Right Center', 'fabrique-core' ),
				'right bottom' => esc_html__( 'Right Bottom', 'fabrique-core' ),
				'center top' => esc_html__( 'Center Top', 'fabrique-core' ),
				'center center' => esc_html__( 'Center Center', 'fabrique-core' ),
				'center bottom' => esc_html__( 'Center Bottom', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'body_background_attachment', array(
			'default' => $defaults['body_background_attachment'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'body_background_attachment', array (
			'section' => 'fabrique_layout_section',
			'settings' => 'body_background_attachment',
			'label' => esc_html__( 'Background Attachment Fixed', 'fabrique-core' ),
			'priority' => 280
		) ) );


		$wp_customize->add_setting( 'boxed_shadow', array(
			'default' => $defaults['boxed_shadow'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'boxed_shadow', array(
			'section' => 'fabrique_layout_section',
			'settings' => 'boxed_shadow',
			'label' => esc_html__( 'Boxed Shadow', 'fabrique-core' ),
			'description' => 'ex: 0 0 20px rgba(0, 0, 0, 0.33)',
			'priority' => 290,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'site_responsive', array(
			'default' => $defaults['site_responsive'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'site_responsive', array (
			'section' => 'fabrique_responsive_section',
			'settings' => 'site_responsive',
			'label' => esc_html__( 'Responsive', 'fabrique-core' ),
			'priority' => 10
		) ) );


		$wp_customize->add_setting( 'enable_mobile_parallax', array(
			'default' => $defaults['enable_mobile_parallax'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'enable_mobile_parallax', array (
			'section' => 'fabrique_responsive_section',
			'settings' => 'enable_mobile_parallax',
			'label' => esc_html__( 'Parallax Background in mobile', 'fabrique-core' ),
			'description' => esc_html__( 'Enable Parallax Background in mobile/tablet device', 'fabrique-core' ),
			'priority' => 20
		) ) );


		$wp_customize->add_setting( 'style_typography', array(
			'default' => $defaults['style_typography'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'style_typography', array(
			'section' => 'fabrique_style_typography_section',
			'settings' => 'style_typography',
			'label' => esc_html__( 'Global Typography', 'fabrique-core' ),
			'priority' => 10,
			'type' => 'select',
			'choices' => $fonts
		) );


		$wp_customize->add_setting( 'style_font_size', array(
			'default' => $defaults['style_font_size'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'style_font_size', array (
			'section' => 'fabrique_style_typography_section',
			'settings' => 'style_font_size',
			'label' => esc_html__( 'Global Font Size (px)', 'fabrique-core' ),
			'priority' => 20,
			'min' => 10,
			'max' => 24
		) ) );


		$wp_customize->add_setting( 'style_line_height', array(
			'default' => $defaults['style_line_height'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Text_Control( $wp_customize, 'style_line_height', array (
			'section' => 'fabrique_style_typography_section',
			'settings' => 'style_line_height',
			'label' => esc_html__( 'Global Line Height', 'fabrique-core' ),
			'description' => esc_html__( 'Leave blank for default.', 'fabrique-core' ),
			'priority' => 30,
		) ) );


		$wp_customize->add_setting( 'heading_style', array(
			'default' => $defaults['heading_style'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'heading_style', array (
			'radio_type' => 'image',
			'section' => 'fabrique_style_heading_section',
			'settings' => 'heading_style',
			'label' => esc_html__( 'Heading Style', 'fabrique-core' ),
			'description' => esc_html__( 'Apply to: Sidebar, Footer, Comment, Related Post Title', 'fabrique-core' ),
			'priority' => 10,
			'names' => array(
				'plain' => esc_html__( 'Plain', 'fabrique-core' ),
				'underline' => esc_html__( 'Underline', 'fabrique-core' ),
				'breakline' => esc_html__( 'Breakline', 'fabrique-core' ),
				'shade' => esc_html__( 'Shade', 'fabrique-core' ),
				'fill' => esc_html__( 'Fill', 'fabrique-core' ),
				'leadline' => esc_html__( 'Leadline', 'fabrique-core' )
			),
			'choices' => array(
				'plain' => 'customize-heading-plain',
				'underline' => 'customize-heading-underline',
				'breakline' => 'customize-heading-breakline',
				'shade' => 'customize-heading-shade',
				'fill' => 'customize-heading-fill',
				'leadline' => 'customize-heading-leadline'
			)
		) ) );


		$wp_customize->add_setting( 'heading_typography', array(
			'default' => $defaults['heading_typography'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'heading_typography', array(
			'section' => 'fabrique_style_heading_section',
			'settings' => 'heading_typography',
			'label' => esc_html__( 'Typography', 'fabrique-core' ),
			'priority' => 30,
			'type' => 'select',
			'choices' => $fonts
		) );


		$wp_customize->add_setting( 'heading_size_h1', array(
			'default' => $defaults['heading_size_h1'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Text_Control( $wp_customize, 'heading_size_h1', array (
			'section' => 'fabrique_style_heading_section',
			'settings' => 'heading_size_h1',
			'label' => 'H1 (px)',
			'description' => esc_html__( 'Apply to: Page Title', 'fabrique-core' ),
			'priority' => 60
		) ) );


		$wp_customize->add_setting( 'heading_size_h2', array(
			'default' => $defaults['heading_size_h2'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Text_Control( $wp_customize, 'heading_size_h2', array (
			'section' => 'fabrique_style_heading_section',
			'settings' => 'heading_size_h2',
			'label' => 'H2 (px)',
			'priority' => 70
		) ) );


		$wp_customize->add_setting( 'heading_size_h3', array(
			'default' => $defaults['heading_size_h3'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Text_Control( $wp_customize, 'heading_size_h3', array (
			'section' => 'fabrique_style_heading_section',
			'settings' => 'heading_size_h3',
			'label' => 'H3 (px)',
			'priority' => 80
		) ) );


		$wp_customize->add_setting( 'heading_size_h4', array(
			'default' => $defaults['heading_size_h4'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Text_Control( $wp_customize, 'heading_size_h4', array (
			'section' => 'fabrique_style_heading_section',
			'settings' => 'heading_size_h4',
			'label' => 'H4 (px)',
			'priority' => 90
		) ) );


		$wp_customize->add_setting( 'heading_size_h5', array(
			'default' => $defaults['heading_size_h5'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Text_Control( $wp_customize, 'heading_size_h5', array (
			'section' => 'fabrique_style_heading_section',
			'settings' => 'heading_size_h5',
			'label' => 'H5 (px)',
			'priority' => 100
		) ) );


		$wp_customize->add_setting( 'heading_size_h6', array(
			'default' => $defaults['heading_size_h6'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Text_Control( $wp_customize, 'heading_size_h6', array (
			'section' => 'fabrique_style_heading_section',
			'settings' => 'heading_size_h6',
			'label' => 'H6 (px)',
			'priority' => 110
		) ) );


		$wp_customize->add_setting( 'button_style', array(
			'default' => $defaults['button_style'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'button_style', array (
			'section' => 'fabrique_style_button_section',
			'settings' => 'button_style',
			'label' => esc_html__( 'Button Style', 'fabrique-core' ),
			'priority' => 10,
			'radio_type' => 'image',
			'radio_style' => 'box',
			'names' => array(
				'fill' => esc_html__( 'Fill', 'fabrique-core' ),
				'border' => esc_html__( 'Border', 'fabrique-core' ),
			),
			'choices' => array(
				'fill' => 'customize-button-fill',
				'border' => 'customize-button-border',
			)
		) ) );


		$wp_customize->add_setting( 'button_hover_style', array(
			'default' => $defaults['button_hover_style'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'button_hover_style', array(
			'section' => 'fabrique_style_button_section',
			'settings' => 'button_hover_style',
			'label' => esc_html__( 'Button Hover Style', 'fabrique-core' ),
			'priority' => 20,
			'type' => 'select',
			'choices' => array(
				'none' => esc_html__( 'None', 'fabrique-core' ),
				'inverse' => esc_html__( 'Inverse', 'fabrique-core' ),
				'brand' => esc_html__( 'Brand Color', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'button_size', array(
			'default' => $defaults['button_size'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'button_size', array(
			'section' => 'fabrique_style_button_section',
			'settings' => 'button_size',
			'label' => esc_html__( 'Button Size', 'fabrique-core' ),
			'priority' => 30,
			'type' => 'select',
			'choices' => array(
				'small' => esc_html__( 'Small', 'fabrique-core' ),
				'medium' => esc_html__( 'Medium', 'fabrique-core' ),
				'large' => esc_html__( 'Large', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'button_typography', array(
			'default' => $defaults['button_typography'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'button_typography', array(
			'section' => 'fabrique_style_button_section',
			'settings' => 'button_typography',
			'label' => esc_html__( 'Typography', 'fabrique-core' ),
			'priority' => 35,
			'type' => 'select',
			'choices' => $fonts
		) );


		$wp_customize->add_setting( 'button_uppercase', array(
			'default' => $defaults['button_uppercase'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'button_uppercase', array (
			'section' => 'fabrique_style_button_section',
			'settings' => 'button_uppercase',
			'label' => esc_html__( 'Uppercase', 'fabrique-core' ),
			'priority' => 37
		) ) );


		$wp_customize->add_setting( 'button_border', array(
			'default' => $defaults['button_border'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'button_border', array (
			'section' => 'fabrique_style_button_section',
			'settings' => 'button_border',
			'label' => esc_html__( 'Button Border Thickness (px)', 'fabrique-core' ),
			'priority' => 40,
			'min' => 0,
			'max' => 5
		) ) );


		$wp_customize->add_setting( 'button_radius', array(
			'default' => $defaults['button_radius'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'button_radius', array (
			'section' => 'fabrique_style_button_section',
			'settings' => 'button_radius',
			'label' => esc_html__( 'Button Radius (px)', 'fabrique-core' ),
			'priority' => 50,
			'min' => 0,
			'max' => 35
		) ) );


		$wp_customize->add_setting( 'carousel_arrow_background', array(
			'default' => $defaults['carousel_arrow_background'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'carousel_arrow_background', array (
			'radio_type' => 'image',
			'radio_style' => 'box',
			'section' => 'fabrique_style_carousel_section',
			'settings' => 'carousel_arrow_background',
			'label' => esc_html__( 'Carousel Arrow Background', 'fabrique-core' ),
			'priority' => 10,
			'names' => array(
				'square' => esc_html__( 'Square', 'fabrique-core' ),
				'transparent' => esc_html__( 'Transparent', 'fabrique-core' ),
			),
			'choices' => array(
				'square' => 'customize-arrow-background-square',
				'transparent' => 'customize-arrow-background-transparent',
			)
		) ) );


		$wp_customize->add_setting( 'carousel_arrow_style', array(
			'default' => $defaults['carousel_arrow_style'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'carousel_arrow_style', array (
			'radio_type' => 'image',
			'radio_style' => 'box',
			'section' => 'fabrique_style_carousel_section',
			'settings' => 'carousel_arrow_style',
			'label' => esc_html__( 'Carousel Arrow Style', 'fabrique-core' ),
			'priority' => 20,
			'names' => array(
				'ln-arrow' => esc_html__( 'Thin Arrow', 'fabrique-core' ),
				'arrow-bold' => esc_html__( 'Arrow', 'fabrique-core' ),
				'ln-chevron' => esc_html__( 'Thin Chevron', 'fabrique-core' ),
				'chevron' => esc_html__( 'Chevron', 'fabrique-core' ),
				'angle' => esc_html__( 'Angle', 'fabrique-core' ),
				'angle-double' => esc_html__( 'Double Angle', 'fabrique-core' )
			),
			'choices' => array(
				'ln-arrow' => 'customize-arrow-style-ln-arrow',
				'arrow-bold' => 'customize-arrow-style-arrow-bold',
				'ln-chevron' => 'customize-arrow-style-ln-chevron',
				'chevron' => 'customize-arrow-style-chevron',
				'angle' => 'customize-arrow-style-angle',
				'angle-double' => 'customize-arrow-style-angle-double'
			)
		) ) );


		$wp_customize->add_setting( 'cookies_notice', array(
			'default' => $defaults['cookies_notice'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'cookies_notice', array (
			'section' => 'fabrique_style_cookies_section',
			'settings' => 'cookies_notice',
			'label' => esc_html__( 'Cookies Notice Message', 'fabrique-core' ),
			'description' => esc_html__( 'This cookies will expire in 30 days. To change expiration time, use add_filter "cookies_notice_expiration"', 'fabrique-core' ),
			'priority' => 10,
			'children' => array(
				'cookies_notice_color_scheme',
				'cookies_notice_background_color',
				'cookies_notice_background_opacity',
				'cookies_notice_message'
			)
		) ) );


		$wp_customize->add_setting( 'cookies_notice_color_scheme', array(
			'default' => $defaults['cookies_notice_color_scheme'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'cookies_notice_color_scheme', array (
			'section' => 'fabrique_style_cookies_section',
			'settings' => 'cookies_notice_color_scheme',
			'label' => esc_html__( 'Cookies Notice Box Color Scheme', 'fabrique-core' ),
			'priority' => 20,
			'choices' => array(
				'light' => esc_html__( 'Light', 'fabrique-core' ),
				'dark' => esc_html__( 'Dark', 'fabrique-core' )
			)
		) ) );


		$wp_customize->add_setting( 'cookies_notice_background_color', array(
			'default' => $defaults['cookies_notice_background_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'cookies_notice_background_color', array (
			'section' => 'fabrique_style_cookies_section',
			'settings' => 'cookies_notice_background_color',
			'label' => esc_html__( 'Cookies Notice Background Color', 'fabrique-core' ),
			'priority' => 30
		) ) );


		$wp_customize->add_setting( 'cookies_notice_background_opacity', array(
			'default' => $defaults['cookies_notice_background_opacity'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'cookies_notice_background_opacity', array (
			'section' => 'fabrique_style_cookies_section',
			'settings' => 'cookies_notice_background_opacity',
			'label' => esc_html__( 'Background Opacity', 'fabrique-core' ),
			'description' => esc_html__( "This option will not take effect on 'default' background color" , 'fabrique-core' ),
			'priority' => 40,
			'min' => 0,
			'max' => 100
		) ) );


		$wp_customize->add_setting( 'cookies_notice_message', array(
			'default' => $defaults['cookies_notice_message'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'cookies_notice_message', array(
			'section' => 'fabrique_style_cookies_section',
			'settings' => 'cookies_notice_message',
			'label' => esc_html__( 'Cookies Notice Message', 'fabrique-core' ),
			'priority' => 50,
			'type' => 'textarea'
		) );


		$wp_customize->add_setting( 'preload_style', array(
			'default' => $defaults['preload_style'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'preload_style', array(
			'section' => 'fabrique_style_preload_section',
			'settings' => 'preload_style',
			'label' => esc_html__( 'Preload Style', 'fabrique-core' ),
			'priority' => 10,
			'type' => 'select',
			'choices' => array(
				'none' => esc_html__( 'None', 'fabrique-core' ),
				'fading-circle' => esc_html__( 'Fading Circle', 'fabrique-core' ),
				'double-bounce' => esc_html__( 'Double Bounce', 'fabrique-core' ),
				'three-bounce' => esc_html__( 'Three Bounce', 'fabrique-core' ),
				'wave' => esc_html__( 'Wave', 'fabrique-core' ),
				'ring' => esc_html__( 'Ring', 'fabrique-core' ),
				'ripple' => esc_html__( 'Ripple', 'fabrique-core' ),
				'logo' => esc_html__( 'Logo', 'fabrique-core' ),
				'fade-logo' => esc_html__( 'Fading Logo', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'preload_background_color', array(
			'default' => $defaults['preload_background_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'preload_background_color', array (
			'section' => 'fabrique_style_preload_section',
			'settings' => 'preload_background_color',
			'label' => esc_html__( 'Preload Background Color', 'fabrique-core' ),
			'priority' => 20
		) ) );


		$wp_customize->add_setting( 'preload_logo', array(
			'default' => $defaults['preload_logo'],
			'sanitize_callback' => 'fabrique_core_sanitize_url_value'
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'preload_logo', array (
			'section' => 'fabrique_style_preload_section',
			'settings' => 'preload_logo',
			'label' => esc_html__( 'Preload Logo', 'fabrique-core' ),
			'priority' => 30
		) ) );


		$wp_customize->add_setting( 'preload_logo_width', array(
			'default' => $defaults['preload_logo_width'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'preload_logo_width', array (
			'section' => 'fabrique_style_preload_section',
			'settings' => 'preload_logo_width',
			'label' => esc_html__( 'Preload Logo Width (px)', 'fabrique-core' ),
			'description' => esc_html__( 'Suggested width: Half size of above uploaded logo image width.', 'fabrique-core' ),
			'priority' => 40,
			'min' => 20,
			'max' => 400
		) ) );


		$wp_customize->add_setting( 'back_to_top', array(
			'default' => $defaults['back_to_top'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'back_to_top', array (
			'section' => 'fabrique_style_back_to_top_section',
			'settings' => 'back_to_top',
			'label' => esc_html__( 'Back To Top Button', 'fabrique-core' ),
			'description' => esc_html__( 'This will apply site wide, you can enable/disable this button of individual page in blueprint "page-setting"', 'fabrique-core' ),
			'priority' => 10
		) ) );


		$wp_customize->add_setting( 'back_to_top_background', array(
			'default' => $defaults['back_to_top_background'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'back_to_top_background', array (
			'radio_type' => 'image',
			'radio_style' => 'box',
			'section' => 'fabrique_style_back_to_top_section',
			'settings' => 'back_to_top_background',
			'label' => esc_html__( 'Back To Top Button Background Style', 'fabrique-core' ),
			'priority' => 20,
			'names' => array(
				'square' => esc_html__( 'Square', 'fabrique-core' ),
				'circle' => esc_html__( 'Circle', 'fabrique-core' )
			),
			'choices' => array(
				'square' => 'customize-btt-arrow-background-square',
				'circle' => 'customize-btt-arrow-background-circle'
			)
		) ) );


		$wp_customize->add_setting( 'back_to_top_background_color', array(
			'default' => $defaults['back_to_top_background_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'back_to_top_background_color', array (
			'section' => 'fabrique_style_back_to_top_section',
			'settings' => 'back_to_top_background_color',
			'label' => esc_html__( 'Back To Top Button Background Color', 'fabrique-core' ),
			'priority' => 30
		) ) );


		$wp_customize->add_setting( 'back_to_top_style', array(
			'default' => $defaults['back_to_top_style'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'back_to_top_style', array (
			'radio_type' => 'image',
			'radio_style' => 'box',
			'section' => 'fabrique_style_back_to_top_section',
			'settings' => 'back_to_top_style',
			'label' => esc_html__( 'Back To Top Button Arrow Style', 'fabrique-core' ),
			'priority' => 40,
			'names' => array(
				'ln-arrow' => esc_html__( 'Thin Arrow', 'fabrique-core' ),
				'arrow-bold' => esc_html__( 'Arrow', 'fabrique-core' ),
				'ln-chevron' => esc_html__( 'Thin Chevron', 'fabrique-core' ),
				'chevron' => esc_html__( 'Chevron', 'fabrique-core' ),
				'angle' => esc_html__( 'Angle', 'fabrique-core' ),
				'angle-double' => esc_html__( 'Double Angle', 'fabrique-core' )
			),
			'choices' => array(
				'ln-arrow' => 'customize-btt-arrow-style-ln-arrow',
				'arrow-bold' => 'customize-btt-arrow-style-arrow-bold',
				'ln-chevron' => 'customize-btt-arrow-style-ln-chevron',
				'chevron' => 'customize-btt-arrow-style-chevron',
				'angle' => 'customize-btt-arrow-style-angle',
				'angle-double' => 'customize-btt-arrow-style-angle-double'
			)
		) ) );


		$wp_customize->add_setting( 'back_to_top_arrow_color', array(
			'default' => $defaults['back_to_top_arrow_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'back_to_top_arrow_color', array (
			'section' => 'fabrique_style_back_to_top_section',
			'settings' => 'back_to_top_arrow_color',
			'label' => esc_html__( 'Back To Top Button Arrow Color', 'fabrique-core' ),
			'priority' => 50
		) ) );


		$wp_customize->add_setting( 'navbar_position', array(
			'default' => $defaults['navbar_position'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'navbar_position', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_position',
			'label' => esc_html__( 'Navigation Position', 'fabrique-core' ),
			'priority' => 10,
			'choices' => array(
				'top' => esc_html__( 'Top', 'fabrique-core' ),
				'left' => esc_html__( 'Left', 'fabrique-core' ),
				'right' => esc_html__( 'Right', 'fabrique-core' )
			),
			'children' => array(
				'top' => array(
					'navbar_style',
					'navbar_fullwidth',
					'navbar_menu_border',
					'navbar_menu_border_thickness',
					'navbar_menu_border_color',
					'mega_menu_separator',
					'navbar_logo_offset_top',
					'navbar_background_custom',
					'navbar_menu_custom',
					'dropdown_menu'
				),
				'left' => array(
					'side_navbar_style',
					'side_navbar_menu_alignment',
					'sidenav_background_custom',
					'sidenav_logo_offset_top',
					'sidenav_menu_offset_top',
					'sidenav_menu_custom',
					'sidenav_menu_offset_top'
				),
				'right' => array(
					'side_navbar_style',
					'side_navbar_menu_alignment',
					'sidenav_background_custom',
					'sidenav_logo_offset_top',
					'sidenav_menu_offset_top',
					'sidenav_menu_custom',
					'sidenav_menu_offset_top'
				)
			)
		) ) );


		$wp_customize->add_setting( 'navbar_style', array(
			'default' => $defaults['navbar_style'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'navbar_style', array (
			'radio_type' => 'image',
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_style',
			'label' => esc_html__( 'Navigation Style', 'fabrique-core' ),
			'priority' => 20,
			'names' => array(
				'standard'=> esc_html__( 'Standard', 'fabrique-core' ),
				'inline' => esc_html__( 'Inline', 'fabrique-core' ),
				'stacked' => esc_html__( 'Stacked', 'fabrique-core' ),
				'minimal' => esc_html__( 'Minimal', 'fabrique-core' ),
				'split' => esc_html__( 'Split', 'fabrique-core' )
			),
			'choices' => array(
				'standard' => 'customize-navbar-standard',
				'inline' => 'customize-navbar-inline',
				'stacked' => 'customize-navbar-stacked',
				'minimal' => 'customize-navbar-minimal',
				'split' => 'customize-navbar-split'
			),
			'children' => array(
				'standard' => array(
					'navbar_menu_position',
					'navbar_size',
					'navbar_logo_offset_top',
					'navbar_menu_offset_top'
				),
				'inline' => array(
					'inline_navbar_menu_position',
					'navbar_size',
					'navbar_logo_offset_top',
					'navbar_menu_offset_top'
				),
				'stacked' => array(
					'navbar_menu_position',
					'navbar_stacked_options',
					'navbar_stacked_overlap',
					'navbar_stacked_lineheight',
					'navbar_stacked_background_color',
					'navbar_stacked_opacity',
					'navbar_stacked_logo_offset_top',
					'navbar_stacked_menu_offset_top'
				),
				'minimal' => array(
					'minimal_navbar_menu_style',
					'navbar_size',
					'navbar_logo_offset_top',
					'navbar_menu_offset_top'
				),
				'split' => array(
					'minimal_navbar_menu_style',
					'navbar_size',
					'navbar_logo_offset_top',
					'navbar_menu_offset_top'
				)
			)
		) ) );


		$wp_customize->add_setting( 'navbar_fullwidth', array(
			'default' => $defaults['navbar_fullwidth'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'navbar_fullwidth', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_fullwidth',
			'label' => esc_html__( 'Fullwidth Navigation', 'fabrique-core' ),
			'priority' => 25
		) ) );


		$wp_customize->add_setting( 'side_navbar_style', array(
			'default' => $defaults['side_navbar_style'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'side_navbar_style', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'side_navbar_style',
			'label' => esc_html__( 'Side Navigation Style', 'fabrique-core' ),
			'priority' => 30,
			'radio_type' => 'image',
			'radio_style' => 'box',
			'names' => array(
				'fixed' => esc_html__( 'Fixed', 'fabrique-core' ),
				'full' => esc_html__( 'Full', 'fabrique-core' ),
				'minimal' => esc_html__( 'Minimal', 'fabrique-core' )
			),
			'choices' => array(
				'fixed' => 'customize-sidenav-fixed',
				'full' => 'customize-sidenav-full',
				'minimal' => 'customize-sidenav-minimal'
			)
		) ) );


		$wp_customize->add_setting( 'navbar_menu_position', array(
			'default' => $defaults['navbar_menu_position'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'navbar_menu_position', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_menu_position',
			'label' => esc_html__( 'Navigation Menu Position', 'fabrique-core' ),
			'priority' => 40,
			'choices' => array(
				'left' => esc_html__( 'Left', 'fabrique-core' ),
				'center' => esc_html__( 'Center', 'fabrique-core' ),
				'right' => esc_html__( 'Right', 'fabrique-core' )
			)
		) ) );


		$wp_customize->add_setting( 'side_navbar_menu_alignment', array(
			'default' => $defaults['side_navbar_menu_alignment'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'side_navbar_menu_alignment', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'side_navbar_menu_alignment',
			'label' => esc_html__( 'Sidenav Menu Alignment', 'fabrique-core' ),
			'priority' => 50,
			'choices' => array(
				'left' => esc_html__( 'Left', 'fabrique-core' ),
				'center' => esc_html__( 'Center', 'fabrique-core' ),
				'right' => esc_html__( 'Right', 'fabrique-core' )
			)
		) ) );


		$wp_customize->add_setting( 'inline_navbar_menu_position', array(
			'default' => $defaults['inline_navbar_menu_position'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'inline_navbar_menu_position', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'inline_navbar_menu_position',
			'label' => esc_html__( 'Inline Navigation Menu Position', 'fabrique-core' ),
			'priority' => 60,
			'choices' => array(
				'inner' => esc_html__( 'Inner', 'fabrique-core' ),
				'outer' => esc_html__( 'Outer', 'fabrique-core' )
			)
		) ) );


		$wp_customize->add_setting( 'minimal_navbar_menu_style', array(
			'default' => $defaults['minimal_navbar_menu_style'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'minimal_navbar_menu_style', array(
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'minimal_navbar_menu_style',
			'label' => esc_html__( 'Minimal Navigation Menu Style', 'fabrique-core' ),
			'priority' => 70,
			'type' => 'select',
			'choices' => array(
				'full' => esc_html__( 'Full Screen', 'fabrique-core' ),
				'right' => esc_html__( 'Slide From Right', 'fabrique-core' ),
				'offcanvas' => esc_html__( 'Off Canvas', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'navbar_size', array(
			'default' => $defaults['navbar_size'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'navbar_size', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_size',
			'label' => esc_html__( 'Navigation Size', 'fabrique-core' ),
			'priority' => 80,
			'choices' => array(
				'small' => esc_html__( 'Small', 'fabrique-core' ),
				'large' => esc_html__( 'Large', 'fabrique-core' ),
				'custom' => esc_html__( 'Custom', 'fabrique-core' )
			),
			'children' => array(
				'custom' => array(
					'navbar_height'
				)
			)
		) ) );


		$wp_customize->add_setting( 'navbar_height', array(
			'default' => $defaults['navbar_height'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'navbar_height', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_height',
			'label' => esc_html__( 'Navigation Height (px)', 'fabrique-core' ),
			'priority' => 90,
			'min' => 0,
			'max' => 200
		) ) );


		$wp_customize->add_setting( 'navbar_menu_hover_style', array(
			'default' => $defaults['navbar_menu_hover_style'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'navbar_menu_hover_style', array(
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_menu_hover_style',
			'label' => esc_html__( 'Navigation Hover Style', 'fabrique-core' ),
			'description' => esc_html__( '"Underline" will only work with "top" menu position', 'fabrique-core' ),
			'priority' => 95,
			'type' => 'select',
			'choices' => array(
				'default' => esc_html__( 'Highlight', 'fabrique-core' ),
				'fade' => esc_html__( 'Fade', 'fabrique-core' ),
				'border' => esc_html__( 'Bottom Border', 'fabrique-core' ),
				'underline' => esc_html__( 'Underline', 'fabrique-core' ),
				'fill' => esc_html__( 'Fill', 'fabrique-core' ),
			)
		) );


		$wp_customize->add_setting( 'navbar_stacked_options', array(
			'default' => $defaults['navbar_stacked_options'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Section_Control( $wp_customize, 'navbar_stacked_options', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_stacked_options',
			'label' => esc_html__( 'Navbar Stacked Extra Options', 'fabrique-core' ),
			'priority' => 96
		) ) );


		$wp_customize->add_setting( 'navbar_stacked_overlap', array(
			'default' => $defaults['navbar_stacked_overlap'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'navbar_stacked_overlap', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_stacked_overlap',
			'label' => esc_html__( 'Stacked Overlap', 'fabrique-core' ),
			'priority' => 97
		) ) );


		$wp_customize->add_setting( 'navbar_stacked_lineheight', array(
			'default' => $defaults['navbar_stacked_lineheight'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'navbar_stacked_lineheight', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_stacked_lineheight',
			'label' => esc_html__( 'Stacked Navigation Menu Height (px)', 'fabrique-core' ),
			'priority' => 97,
			'min' => 0,
			'max' => 100
		) ) );


		$wp_customize->add_setting( 'navbar_stacked_background_color', array(
			'default' => $defaults['navbar_stacked_background_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'navbar_stacked_background_color', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_stacked_background_color',
			'label' => esc_html__( 'Stacked Navbar Background Color', 'fabrique-core' ),
			'priority' => 98
		) ) );


		$wp_customize->add_setting( 'navbar_stacked_opacity', array(
			'default' => $defaults['navbar_stacked_opacity'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'navbar_stacked_opacity', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_stacked_opacity',
			'label' => esc_html__( 'Stacked Navbar Background Opacity (%)', 'fabrique-core' ),
			'description' => esc_html__( "This option will not take effect on 'default' background color" , 'fabrique-core' ),
			'priority' => 99,
			'min' => 0,
			'max' => 100
		) ) );


		$wp_customize->add_setting( 'navbar_menu_border', array(
			'default' => $defaults['navbar_menu_border'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Section_Control( $wp_customize, 'navbar_menu_border', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_menu_border',
			'label' => esc_html__( 'Bottom Border', 'fabrique-core' ),
			'priority' => 100
		) ) );


		$wp_customize->add_setting( 'navbar_menu_border_thickness', array(
			'default' => $defaults['navbar_menu_border_thickness'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'navbar_menu_border_thickness', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_menu_border_thickness',
			'label' => esc_html__( 'Border Thickness (px)', 'fabrique-core' ),
			'priority' => 110,
			'min' => 0,
			'max' => 10
		) ) );


		$wp_customize->add_setting( 'navbar_menu_border_color', array(
			'default' => $defaults['navbar_menu_border_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'navbar_menu_border_color', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_menu_border_color',
			'label' => esc_html__( 'Navigation Border Color', 'fabrique-core' ),
			'priority' => 120
		) ) );


		$wp_customize->add_setting( 'navbar_offset', array(
			'default' => $defaults['navbar_offset'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Section_Control( $wp_customize, 'navbar_offset', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_offset',
			'label' => esc_html__( 'Offset', 'fabrique-core' ),
			'description' => esc_html__( 'For top-navigation non-stacked style: leave blank to vertical align middle', 'fabrique-core' ),
			'priority' => 125
		) ) );


		$wp_customize->add_setting( 'navbar_logo_offset_top', array(
			'default' => $defaults['navbar_logo_offset_top'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Text_Control( $wp_customize, 'navbar_logo_offset_top', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_logo_offset_top',
			'label' => esc_html__( 'Logo Offset Top (px)', 'fabrique-core' ),
			'priority' => 130
		) ) );


		$wp_customize->add_setting( 'navbar_menu_offset_top', array(
			'default' => $defaults['navbar_menu_offset_top'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Text_Control( $wp_customize, 'navbar_menu_offset_top', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_menu_offset_top',
			'label' => esc_html__( 'Menu Offset Top (px)', 'fabrique-core' ),
			'priority' => 135
		) ) );


		$wp_customize->add_setting( 'navbar_stacked_logo_offset_top', array(
			'default' => $defaults['navbar_stacked_logo_offset_top'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Text_Control( $wp_customize, 'navbar_stacked_logo_offset_top', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_stacked_logo_offset_top',
			'label' => esc_html__( 'Stacked Logo Offset Top (px)', 'fabrique-core' ),
			'priority' => 140
		) ) );


		$wp_customize->add_setting( 'navbar_stacked_menu_offset_top', array(
			'default' => $defaults['navbar_stacked_menu_offset_top'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Text_Control( $wp_customize, 'navbar_stacked_menu_offset_top', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_stacked_menu_offset_top',
			'label' => esc_html__( 'Stacked Menu Offset Top (px)', 'fabrique-core' ),
			'priority' => 145
		) ) );


		$wp_customize->add_setting( 'sidenav_logo_offset_top', array(
			'default' => $defaults['sidenav_logo_offset_top'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Text_Control( $wp_customize, 'sidenav_logo_offset_top', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'sidenav_logo_offset_top',
			'label' => esc_html__( 'Side Logo Offset Top (px)', 'fabrique-core' ),
			'priority' => 150
		) ) );


		$wp_customize->add_setting( 'sidenav_menu_offset_top', array(
			'default' => $defaults['sidenav_menu_offset_top'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Text_Control( $wp_customize, 'sidenav_menu_offset_top', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'sidenav_menu_offset_top',
			'label' => esc_html__( 'Side Menu Offset Top (px)', 'fabrique-core' ),
			'priority' => 155
		) ) );


		$wp_customize->add_setting( 'navbar_component', array(
			'default' => $defaults['navbar_component'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Section_Control( $wp_customize, 'navbar_component', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_component',
			'label' => esc_html__( 'Component', 'fabrique-core' ),
			'priority' => 160
		) ) );


		$wp_customize->add_setting( 'mega_menu_separator', array(
			'default' => $defaults['mega_menu_separator'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'mega_menu_separator', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'mega_menu_separator',
			'label' => esc_html__( 'Mega Menu Separator', 'fabrique-core' ),
			'priority' => 165
		) ) );


		$wp_customize->add_setting( 'navbar_search', array(
			'default' => $defaults['navbar_search'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'navbar_search', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_search',
			'label' => esc_html__( 'Search', 'fabrique-core' ),
			'priority' => 170
		) ) );


		$wp_customize->add_setting( 'navbar_cart', array(
			'default' => $defaults['navbar_cart'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'navbar_cart', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_cart',
			'label' => esc_html__( 'Cart', 'fabrique-core' ),
			'priority' => 180,
			'children' => array(
				'navbar_cart_icon'
			)
		) ) );


		$wp_customize->add_setting( 'navbar_cart_icon', array(
			'default' => $defaults['navbar_cart_icon'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'navbar_cart_icon', array(
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_cart_icon',
			'label' => esc_html__( 'Cart Icon', 'fabrique-core' ),
			'priority' => 190,
			'type' => 'select',
			'choices' => array(
				'et-basket' => esc_html__( 'Basket', 'fabrique-core' ),
				'cart' => esc_html__( 'Cart 1', 'fabrique-core' ),
				'ln-cart' => esc_html__( 'Cart 2', 'fabrique-core' ),
				'et-bag' => esc_html__( 'Shopping Bag 1', 'fabrique-core' ),
				'bag' => esc_html__( 'Shopping Bag 2', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'navbar_background_custom', array(
			'default' => $defaults['navbar_background_custom'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'navbar_background_custom', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_background_custom',
			'label' => esc_html__( 'Top Menu Background Custom', 'fabrique-core' ),
			'priority' => 200,
			'advance' => true,
			'children' => array(
				'navbar_background_color',
				'navbar_opacity'
			)
		) ) );


		$wp_customize->add_setting( 'navbar_background_color', array(
			'default' => $defaults['navbar_background_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'navbar_background_color', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_background_color',
			'label' => esc_html__( 'Background Color', 'fabrique-core' ),
			'priority' => 210
		) ) );


		$wp_customize->add_setting( 'navbar_opacity', array(
			'default' => $defaults['navbar_opacity'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'navbar_opacity', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_opacity',
			'label' => esc_html__( 'Background Opacity (%)', 'fabrique-core' ),
			'description' => esc_html__( "This option will not take effect on 'default' background color" , 'fabrique-core' ),
			'priority' => 220,
			'min' => 0,
			'max' => 100
		) ) );


		$wp_customize->add_setting( 'navbar_menu_custom', array(
			'default' => $defaults['navbar_menu_custom'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'navbar_menu_custom', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_menu_custom',
			'label' => esc_html__( 'Top Menu Custom', 'fabrique-core' ),
			'priority' => 270,
			'advance' => true,
			'children' => array(
				'navbar_menu_color',
				'navbar_menu_active_color',
				'navbar_menu_hover_color',
				'navbar_menu_typography',
				'navbar_menu_uppercase',
				'navbar_menu_font_size',
				'navbar_menu_letter_spacing',
				'navbar_menu_separator'
			)
		) ) );


		$wp_customize->add_setting( 'navbar_menu_color', array(
			'default' => $defaults['navbar_menu_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'navbar_menu_color', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_menu_color',
			'label' => esc_html__( 'Menu Color', 'fabrique-core' ),
			'priority' => 280
		) ) );


		$wp_customize->add_setting( 'navbar_menu_active_color', array(
			'default' => $defaults['navbar_menu_active_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'navbar_menu_active_color', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_menu_active_color',
			'label' => esc_html__( 'Menu Active Color', 'fabrique-core' ),
			'priority' => 290
		) ) );


		$wp_customize->add_setting( 'navbar_menu_hover_color', array(
			'default' => $defaults['navbar_menu_hover_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'navbar_menu_hover_color', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_menu_hover_color',
			'label' => esc_html__( 'Menu Hover Color', 'fabrique-core' ),
			'priority' => 300
		) ) );


		$wp_customize->add_setting( 'navbar_menu_typography', array(
			'default' => $defaults['navbar_menu_typography'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'navbar_menu_typography', array(
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_menu_typography',
			'label' => esc_html__( 'Typography', 'fabrique-core' ),
			'priority' => 310,
			'type' => 'select',
			'choices' => $fonts
		) );


		$wp_customize->add_setting( 'navbar_menu_uppercase', array(
			'default' => $defaults['navbar_menu_uppercase'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'navbar_menu_uppercase', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_menu_uppercase',
			'label' => esc_html__( 'Menu Uppercase', 'fabrique-core' ),
			'priority' => 315
		) ) );


		$wp_customize->add_setting( 'navbar_menu_font_size', array(
			'default' => $defaults['navbar_menu_font_size'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'navbar_menu_font_size', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_menu_font_size',
			'label' => esc_html__( 'Menu Font Size (px)', 'fabrique-core' ),
			'priority' => 320,
			'min' => 10,
			'max' => 30
		) ) );


		$wp_customize->add_setting( 'navbar_menu_letter_spacing', array(
			'default' => $defaults['navbar_menu_letter_spacing'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Text_Control( $wp_customize, 'navbar_menu_letter_spacing', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_menu_letter_spacing',
			'label' => esc_html__( 'Menu Letter Spacing (em)', 'fabrique-core' ),
			'priority' => 330,
		) ) );


		$wp_customize->add_setting( 'navbar_menu_separator', array(
			'default' => $defaults['navbar_menu_separator'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'navbar_menu_separator', array(
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_menu_separator',
			'label' => esc_html__( 'Separator', 'fabrique-core' ),
			'priority' => 340,
			'type' => 'select',
			'choices' => array(
				'none' => esc_html__( 'None', 'fabrique-core' ),
				'•' => '•',
				':' => ':',
				'/' => '/',
				'|' => '|',
			)
		) );


		$wp_customize->add_setting( 'dropdown_menu', array(
			'default' => $defaults['dropdown_menu'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'dropdown_menu', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'dropdown_menu',
			'label' => esc_html__( 'Dropdown Menu', 'fabrique-core' ),
			'priority' => 350,
			'advance' => true,
			'children' => array(
				'dropdown_menu_uppercase',
				'dropdown_menu_font_size',
				'dropdown_menu_letter_spacing',
				'dropdown_menu_min_width',
				'dropdown_color_scheme',
				'dropdown_background_color',
				'dropdown_opacity',
				'dropdown_menu_color',
				'dropdown_hover_color'
			)
		) ) );


		$wp_customize->add_setting( 'dropdown_menu_uppercase', array(
			'default' => $defaults['dropdown_menu_uppercase'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'dropdown_menu_uppercase', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'dropdown_menu_uppercase',
			'label' => esc_html__( 'Menu Uppercase', 'fabrique-core' ),
			'priority' => 360
		) ) );


		$wp_customize->add_setting( 'dropdown_menu_font_size', array(
			'default' => $defaults['dropdown_menu_font_size'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'dropdown_menu_font_size', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'dropdown_menu_font_size',
			'label' => esc_html__( 'Menu Font Size (px)', 'fabrique-core' ),
			'priority' => 370,
			'min' => 10,
			'max' => 30
		) ) );


		$wp_customize->add_setting( 'dropdown_menu_letter_spacing', array(
			'default' => $defaults['dropdown_menu_letter_spacing'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Text_Control( $wp_customize, 'dropdown_menu_letter_spacing', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'dropdown_menu_letter_spacing',
			'label' => esc_html__( 'Menu Letter Spacing (em)', 'fabrique-core' ),
			'priority' => 375,
		) ) );


		$wp_customize->add_setting( 'dropdown_menu_min_width', array(
			'default' => $defaults['dropdown_menu_min_width'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'dropdown_menu_min_width', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'dropdown_menu_min_width',
			'label' => esc_html__( 'Sub Menu Min Width (px)', 'fabrique-core' ),
			'priority' => 380,
			'min' => 100,
			'max' => 400
		) ) );


		$wp_customize->add_setting( 'dropdown_color_scheme', array(
			'default' => $defaults['dropdown_color_scheme'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'dropdown_color_scheme', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'dropdown_color_scheme',
			'label' => esc_html__( 'Dropdown Color Scheme', 'fabrique-core' ),
			'priority' => 390,
			'choices' => array(
				'default' => esc_html__( 'Default', 'fabrique-core' ),
				'light' => esc_html__( 'Light', 'fabrique-core' ),
				'dark' => esc_html__( 'Dark', 'fabrique-core' ),
			)
		) ) );


		$wp_customize->add_setting( 'dropdown_background_color', array(
			'default' => $defaults['dropdown_background_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'dropdown_background_color', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'dropdown_background_color',
			'label' => esc_html__( 'Background Color', 'fabrique-core' ),
			'priority' => 400
		) ) );


		$wp_customize->add_setting( 'dropdown_opacity', array(
			'default' => $defaults['dropdown_opacity'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'dropdown_opacity', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'dropdown_opacity',
			'label' => esc_html__( 'Background Opacity (%)', 'fabrique-core' ),
			'description' => esc_html__( "This option will not take effect on 'default' background color" , 'fabrique-core' ),
			'priority' => 410,
			'min' => 0,
			'max' => 100
		) ) );


		$wp_customize->add_setting( 'dropdown_menu_color', array(
			'default' => $defaults['dropdown_menu_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'dropdown_menu_color', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'dropdown_menu_color',
			'label' => esc_html__( 'Menu Color', 'fabrique-core' ),
			'priority' => 420
		) ) );


		$wp_customize->add_setting( 'dropdown_hover_color', array(
			'default' => $defaults['dropdown_hover_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'dropdown_hover_color', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'dropdown_hover_color',
			'label' => esc_html__( 'Menu Hover Color', 'fabrique-core' ),
			'priority' => 430
		) ) );


		$wp_customize->add_setting( 'sidenav_background_custom', array(
			'default' => $defaults['sidenav_background_custom'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'sidenav_background_custom', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'sidenav_background_custom',
			'label' => esc_html__( 'Side Menu Background Custom', 'fabrique-core' ),
			'priority' => 440,
			'advance' => true,
			'children' => array(
				'sidenav_background_color',
				'sidenav_background_image',
				'sidenav_background_repeat',
				'sidenav_background_size',
				'sidenav_background_position',
				'sidenav_background_attachment'
			)
		) ) );


		$wp_customize->add_setting( 'sidenav_background_color', array(
			'default' => $defaults['sidenav_background_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'sidenav_background_color', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'sidenav_background_color',
			'label' => esc_html__( 'Background Color', 'fabrique-core' ),
			'priority' => 450
		) ) );


		$wp_customize->add_setting( 'sidenav_background_image', array(
			'default' => $defaults['sidenav_background_image'],
			'sanitize_callback' => 'fabrique_core_sanitize_url_value'
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sidenav_background_image', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'sidenav_background_image',
			'label' => esc_html__( 'Background Image', 'fabrique-core' ),
			'priority' => 460
		) ) );


		$wp_customize->add_setting( 'sidenav_background_repeat', array(
			'default' => $defaults['sidenav_background_repeat'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'sidenav_background_repeat', array(
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'sidenav_background_repeat',
			'label' => esc_html__( 'Background Repeat', 'fabrique-core' ),
			'priority' => 470,
			'type' => 'select',
			'choices' => array(
				'repeat' => esc_html__( 'Repeat', 'fabrique-core' ),
				'repeat-x' => esc_html__( 'Repeat-x', 'fabrique-core' ),
				'repeat-y' => esc_html__( 'Repeat-y', 'fabrique-core' ),
				'no-repeat' => esc_html__( 'No Repeat', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'sidenav_background_size', array(
			'default' => $defaults['sidenav_background_size'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'sidenav_background_size', array(
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'sidenav_background_size',
			'label' => esc_html__( 'Background Size', 'fabrique-core' ),
			'priority' => 480,
			'type' => 'select',
			'choices' => array(
				'auto' => esc_html__( 'Auto', 'fabrique-core' ),
				'cover' => esc_html__( 'Cover', 'fabrique-core' ),
				'contain' => esc_html__( 'Contain', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'sidenav_background_position', array(
			'default' => $defaults['sidenav_background_position'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'sidenav_background_position', array(
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'sidenav_background_position',
			'label' => esc_html__( 'Background Position', 'fabrique-core' ),
			'priority' => 490,
			'type' => 'select',
			'choices' => array(
				'left top' => esc_html__( 'Left Top', 'fabrique-core' ),
				'left center' => esc_html__( 'Left Center', 'fabrique-core' ),
				'left bottom' => esc_html__( 'Left Bottom', 'fabrique-core' ),
				'right top' => esc_html__( 'Right Top', 'fabrique-core' ),
				'right center' => esc_html__( 'Right Center', 'fabrique-core' ),
				'right bottom' => esc_html__( 'Right Bottom', 'fabrique-core' ),
				'center top' => esc_html__( 'Center Top', 'fabrique-core' ),
				'center center' => esc_html__( 'Center Center', 'fabrique-core' ),
				'center bottom' => esc_html__( 'Center Bottom', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'sidenav_background_attachment', array(
			'default' => $defaults['sidenav_background_attachment'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'sidenav_background_attachment', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'sidenav_background_attachment',
			'label' => esc_html__( 'Background Attachment Fixed', 'fabrique-core' ),
			'priority' => 500
		) ) );


		$wp_customize->add_setting( 'sidenav_menu_custom', array(
			'default' => $defaults['sidenav_menu_custom'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'sidenav_menu_custom', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'sidenav_menu_custom',
			'label' => esc_html__( 'Side Menu Custom', 'fabrique-core' ),
			'priority' => 510,
			'advance' => true,
			'children' => array(
				'sidenav_menu_color',
				'sidenav_menu_active_color',
				'sidenav_menu_hover_color',
				'sidenav_menu_typography',
				'sidenav_menu_uppercase',
				'sidenav_menu_font_size',
				'sidenav_menu_letter_spacing'
			)
		) ) );


		$wp_customize->add_setting( 'sidenav_menu_color', array(
			'default' => $defaults['sidenav_menu_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'sidenav_menu_color', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'sidenav_menu_color',
			'label' => esc_html__( 'Menu Color', 'fabrique-core' ),
			'priority' => 520
		) ) );


		$wp_customize->add_setting( 'sidenav_menu_active_color', array(
			'default' => $defaults['sidenav_menu_active_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'sidenav_menu_active_color', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'sidenav_menu_active_color',
			'label' => esc_html__( 'Menu Active Color', 'fabrique-core' ),
			'priority' => 530
		) ) );


		$wp_customize->add_setting( 'sidenav_menu_hover_color', array(
			'default' => $defaults['sidenav_menu_hover_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'sidenav_menu_hover_color', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'sidenav_menu_hover_color',
			'label' => esc_html__( 'Menu Hover Color', 'fabrique-core' ),
			'priority' => 540
		) ) );


		$wp_customize->add_setting( 'sidenav_menu_typography', array(
			'default' => $defaults['sidenav_menu_typography'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'sidenav_menu_typography', array(
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'sidenav_menu_typography',
			'label' => esc_html__( 'Typography', 'fabrique-core' ),
			'priority' => 550,
			'type' => 'select',
			'choices' => $fonts
		) );


		$wp_customize->add_setting( 'sidenav_menu_uppercase', array(
			'default' => $defaults['sidenav_menu_uppercase'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'sidenav_menu_uppercase', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'sidenav_menu_uppercase',
			'label' => esc_html__( 'Menu Uppercase', 'fabrique-core' ),
			'priority' => 560
		) ) );


		$wp_customize->add_setting( 'sidenav_menu_font_size', array(
			'default' => $defaults['sidenav_menu_font_size'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'sidenav_menu_font_size', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'sidenav_menu_font_size',
			'label' => esc_html__( 'Menu Font Size (px)', 'fabrique-core' ),
			'priority' => 570,
			'min' => 10,
			'max' => 30
		) ) );


		$wp_customize->add_setting( 'sidenav_menu_letter_spacing', array(
			'default' => $defaults['sidenav_menu_letter_spacing'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Text_Control( $wp_customize, 'sidenav_menu_letter_spacing', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'sidenav_menu_letter_spacing',
			'label' => esc_html__( 'Menu Letter Spacing (em)', 'fabrique-core' ),
			'priority' => 580,
		) ) );


		$wp_customize->add_setting( 'navbar_full_background', array(
			'default' => $defaults['navbar_full_background'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'navbar_full_background', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_full_background',
			'label' => esc_html__( 'Full Menu Background', 'fabrique-core' ),
			'priority' => 590,
			'advance' => true,
			'children' => array(
				'navbar_full_background_color',
				'navbar_full_opacity',
				'navbar_full_background_image',
				'navbar_full_background_repeat',
				'navbar_full_background_size',
				'navbar_full_background_position'
			)
		) ) );


		$wp_customize->add_setting( 'navbar_full_background_color', array(
			'default' => $defaults['navbar_full_background_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'navbar_full_background_color', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_full_background_color',
			'label' => esc_html__( 'Background Color', 'fabrique-core' ),
			'priority' => 600
		) ) );


		$wp_customize->add_setting( 'navbar_full_opacity', array(
			'default' => $defaults['navbar_full_opacity'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'navbar_full_opacity', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_full_opacity',
			'label' => esc_html__( 'Background Opacity (%)', 'fabrique-core' ),
			'description' => esc_html__( "This option will not take effect on 'default' background color" , 'fabrique-core' ),
			'priority' => 610,
			'min' => 0,
			'max' => 100
		) ) );


		$wp_customize->add_setting( 'navbar_full_background_image', array(
			'default' => $defaults['navbar_full_background_image'],
			'sanitize_callback' => 'fabrique_core_sanitize_url_value'
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'navbar_full_background_image', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_full_background_image',
			'label' => esc_html__( 'Background Image', 'fabrique-core' ),
			'priority' => 620
		) ) );


		$wp_customize->add_setting( 'navbar_full_background_repeat', array(
			'default' => $defaults['navbar_full_background_repeat'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'navbar_full_background_repeat', array(
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_full_background_repeat',
			'label' => esc_html__( 'Background Repeat', 'fabrique-core' ),
			'priority' => 630,
			'type' => 'select',
			'choices' => array(
				'repeat' => esc_html__( 'Repeat', 'fabrique-core' ),
				'repeat-x' => esc_html__( 'Repeat-x', 'fabrique-core' ),
				'repeat-y' => esc_html__( 'Repeat-y', 'fabrique-core' ),
				'no-repeat' => esc_html__( 'No Repeat', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'navbar_full_background_size', array(
			'default' => $defaults['navbar_full_background_size'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'navbar_full_background_size', array(
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_full_background_size',
			'label' => esc_html__( 'Background Size', 'fabrique-core' ),
			'priority' => 640,
			'type' => 'select',
			'choices' => array(
				'auto' => esc_html__( 'Auto', 'fabrique-core' ),
				'cover' => esc_html__( 'Cover', 'fabrique-core' ),
				'contain' => esc_html__( 'Contain', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'navbar_full_background_position', array(
			'default' => $defaults['navbar_full_background_position'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'navbar_full_background_position', array(
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_full_background_position',
			'label' => esc_html__( 'Background Position', 'fabrique-core' ),
			'priority' => 650,
			'type' => 'select',
			'choices' => array(
				'left top' => esc_html__( 'Left Top', 'fabrique-core' ),
				'left center' => esc_html__( 'Left Center', 'fabrique-core' ),
				'left bottom' => esc_html__( 'Left Bottom', 'fabrique-core' ),
				'right top' => esc_html__( 'Right Top', 'fabrique-core' ),
				'right center' => esc_html__( 'Right Center', 'fabrique-core' ),
				'right bottom' => esc_html__( 'Right Bottom', 'fabrique-core' ),
				'center top' => esc_html__( 'Center Top', 'fabrique-core' ),
				'center center' => esc_html__( 'Center Center', 'fabrique-core' ),
				'center bottom' => esc_html__( 'Center Bottom', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'navbar_full_menu_custom', array(
			'default' => $defaults['navbar_full_menu_custom'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'navbar_full_menu_custom', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_full_menu_custom',
			'label' => esc_html__( 'Full Menu Custom', 'fabrique-core' ),
			'priority' => 660,
			'advance' => true,
			'children' => array(
				'navbar_full_menu_axis',
				'navbar_full_menu_color',
				'navbar_full_menu_active_color',
				'navbar_full_menu_hover_color',
				'navbar_full_menu_typography',
				'navbar_full_menu_font_size',
				'navbar_full_menu_letter_spacing'
			)
		) ) );


		$wp_customize->add_setting( 'navbar_full_menu_axis', array(
			'default' => $defaults['navbar_full_menu_axis'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'navbar_full_menu_axis', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_full_menu_axis',
			'label' => esc_html__( 'Full Screen Minimal Navigation Axis', 'fabrique-core' ),
			'description' => esc_html__( 'Only work with full screen minimal navigation', 'fabrique-core' ),
			'priority' => 670,
			'choices' => array(
				'horizontal' => esc_html__( 'Horizontal', 'fabrique-core' ),
				'vertical' => esc_html__( 'Vertical', 'fabrique-core' )
			)
		) ) );


		$wp_customize->add_setting( 'navbar_full_menu_color', array(
			'default' => $defaults['navbar_full_menu_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'navbar_full_menu_color', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_full_menu_color',
			'label' => esc_html__( 'Menu Color', 'fabrique-core' ),
			'priority' => 680
		) ) );


		$wp_customize->add_setting( 'navbar_full_menu_active_color', array(
			'default' => $defaults['navbar_full_menu_active_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'navbar_full_menu_active_color', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_full_menu_active_color',
			'label' => esc_html__( 'Menu Active Color', 'fabrique-core' ),
			'priority' => 690
		) ) );


		$wp_customize->add_setting( 'navbar_full_menu_hover_color', array(
			'default' => $defaults['navbar_full_menu_hover_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'navbar_full_menu_hover_color', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_full_menu_hover_color',
			'label' => esc_html__( 'Menu Hover Color', 'fabrique-core' ),
			'priority' => 700
		) ) );


		$wp_customize->add_setting( 'navbar_full_menu_typography', array(
			'default' => $defaults['navbar_full_menu_typography'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'navbar_full_menu_typography', array(
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_full_menu_typography',
			'label' => esc_html__( 'Typography', 'fabrique-core' ),
			'priority' => 710,
			'type' => 'select',
			'choices' => $fonts
		) );


		$wp_customize->add_setting( 'navbar_full_menu_font_size', array(
			'default' => $defaults['navbar_full_menu_font_size'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'navbar_full_menu_font_size', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_full_menu_font_size',
			'label' => esc_html__( 'Menu Font Size (px)', 'fabrique-core' ),
			'priority' => 720,
			'min' => 10,
			'max' => 30
		) ) );


		$wp_customize->add_setting( 'navbar_full_menu_letter_spacing', array(
			'default' => $defaults['navbar_full_menu_letter_spacing'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Text_Control( $wp_customize, 'navbar_full_menu_letter_spacing', array (
			'section' => 'fabrique_header_navigation_section',
			'settings' => 'navbar_full_menu_letter_spacing',
			'label' => esc_html__( 'Menu Letter Spacing (em)', 'fabrique-core' ),
			'priority' => 730,
		) ) );


		$wp_customize->add_setting( 'mobile_navbar_style', array(
			'default' => $defaults['mobile_navbar_style'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'mobile_navbar_style', array (
			'section' => 'fabrique_header_mobile_navigation_section',
			'settings' => 'mobile_navbar_style',
			'label' => esc_html__( 'Mobile Navigation Style', 'fabrique-core' ),
			'description' => esc_html__( '"Full" style will use the styling from settings in "Navigation Bar" section.' ),
			'priority' => 10,
			'radio_type' => 'image',
			'radio_style' => 'box',
			'names' => array(
				'classic' => esc_html__( 'Classic', 'fabrique-core' ),
				'full' => esc_html__( 'Full', 'fabrique-core' ),
			),
			'choices' => array(
				'classic' => 'customize-mobile-navbar-classic',
				'full' => 'customize-mobile-navbar-full',
			),
			'children' => array(
				'classic' => array(
					'mobile_navbar_advance'
				)
			)
		) ) );


		$wp_customize->add_setting( 'mobile_navbar_menu_typography', array(
			'default' => $defaults['mobile_navbar_menu_typography'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'mobile_navbar_menu_typography', array(
			'section' => 'fabrique_header_mobile_navigation_section',
			'settings' => 'mobile_navbar_menu_typography',
			'label' => esc_html__( 'Menu Typography', 'fabrique-core' ),
			'priority' => 20,
			'type' => 'select',
			'choices' => $fonts
		) );


		$wp_customize->add_setting( 'mobile_navbar_menu_uppercase', array(
			'default' => $defaults['mobile_navbar_menu_uppercase'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'mobile_navbar_menu_uppercase', array (
			'section' => 'fabrique_header_mobile_navigation_section',
			'settings' => 'mobile_navbar_menu_uppercase',
			'label' => esc_html__( 'Menu Uppercase', 'fabrique-core' ),
			'priority' => 30
		) ) );


		$wp_customize->add_setting( 'mobile_navbar_menu_font_size', array(
			'default' => $defaults['mobile_navbar_menu_font_size'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'mobile_navbar_menu_font_size', array (
			'section' => 'fabrique_header_mobile_navigation_section',
			'settings' => 'mobile_navbar_menu_font_size',
			'label' => esc_html__( 'Menu Font Size (px)', 'fabrique-core' ),
			'priority' => 40,
			'min' => 10,
			'max' => 30
		) ) );


		$wp_customize->add_setting( 'mobile_navbar_menu_letter_spacing', array(
			'default' => $defaults['mobile_navbar_menu_letter_spacing'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Text_Control( $wp_customize, 'mobile_navbar_menu_letter_spacing', array (
			'section' => 'fabrique_header_mobile_navigation_section',
			'settings' => 'mobile_navbar_menu_letter_spacing',
			'label' => esc_html__( 'Menu Letter Spacing (em)', 'fabrique-core' ),
			'priority' => 50,
		) ) );


		$wp_customize->add_setting( 'mobile_navbar_advance', array(
			'default' => $defaults['mobile_navbar_advance'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'mobile_navbar_advance', array (
			'section' => 'fabrique_header_mobile_navigation_section',
			'settings' => 'mobile_navbar_advance',
			'label' => esc_html__( 'Classic Navbar Advance', 'fabrique-core' ),
			'priority' => 60,
			'advance' => true,
			'children' => array(
				'mobile_navbar_background_color',
				'mobile_navbar_opacity',
				'mobile_navbar_background_image',
				'mobile_navbar_background_repeat',
				'mobile_navbar_background_size',
				'mobile_navbar_background_position',
				'mobile_navbar_menu_color',
				'mobile_navbar_menu_active_color',
				'mobile_navbar_menu_hover_color'
			)
		) ) );


		$wp_customize->add_setting( 'mobile_navbar_background_color', array(
			'default' => $defaults['mobile_navbar_background_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'mobile_navbar_background_color', array (
			'section' => 'fabrique_header_mobile_navigation_section',
			'settings' => 'mobile_navbar_background_color',
			'label' => esc_html__( 'Background Color', 'fabrique-core' ),
			'priority' => 70
		) ) );


		$wp_customize->add_setting( 'mobile_navbar_opacity', array(
			'default' => $defaults['mobile_navbar_opacity'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'mobile_navbar_opacity', array (
			'section' => 'fabrique_header_mobile_navigation_section',
			'settings' => 'mobile_navbar_opacity',
			'label' => esc_html__( 'Background Opacity (%)', 'fabrique-core' ),
			'description' => esc_html__( "This option will not take effect on 'default' background color" , 'fabrique-core' ),
			'priority' => 80,
			'min' => 0,
			'max' => 100
		) ) );


		$wp_customize->add_setting( 'mobile_navbar_background_image', array(
			'default' => $defaults['mobile_navbar_background_image'],
			'sanitize_callback' => 'fabrique_core_sanitize_url_value'
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mobile_navbar_background_image', array (
			'section' => 'fabrique_header_mobile_navigation_section',
			'settings' => 'mobile_navbar_background_image',
			'label' => esc_html__( 'Background Image', 'fabrique-core' ),
			'priority' => 90
		) ) );


		$wp_customize->add_setting( 'mobile_navbar_background_repeat', array(
			'default' => $defaults['mobile_navbar_background_repeat'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'mobile_navbar_background_repeat', array(
			'section' => 'fabrique_header_mobile_navigation_section',
			'settings' => 'mobile_navbar_background_repeat',
			'label' => esc_html__( 'Background Repeat', 'fabrique-core' ),
			'priority' => 100,
			'type' => 'select',
			'choices' => array(
				'repeat' => esc_html__( 'Repeat', 'fabrique-core' ),
				'repeat-x' => esc_html__( 'Repeat-x', 'fabrique-core' ),
				'repeat-y' => esc_html__( 'Repeat-y', 'fabrique-core' ),
				'no-repeat' => esc_html__( 'No Repeat', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'mobile_navbar_background_size', array(
			'default' => $defaults['mobile_navbar_background_size'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'mobile_navbar_background_size', array(
			'section' => 'fabrique_header_mobile_navigation_section',
			'settings' => 'mobile_navbar_background_size',
			'label' => esc_html__( 'Background Size', 'fabrique-core' ),
			'priority' => 110,
			'type' => 'select',
			'choices' => array(
				'auto' => esc_html__( 'Auto', 'fabrique-core' ),
				'cover' => esc_html__( 'Cover', 'fabrique-core' ),
				'contain' => esc_html__( 'Contain', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'mobile_navbar_background_position', array(
			'default' => $defaults['mobile_navbar_background_position'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'mobile_navbar_background_position', array(
			'section' => 'fabrique_header_mobile_navigation_section',
			'settings' => 'mobile_navbar_background_position',
			'label' => esc_html__( 'Background Position', 'fabrique-core' ),
			'priority' => 120,
			'type' => 'select',
			'choices' => array(
				'left top' => esc_html__( 'Left Top', 'fabrique-core' ),
				'left center' => esc_html__( 'Left Center', 'fabrique-core' ),
				'left bottom' => esc_html__( 'Left Bottom', 'fabrique-core' ),
				'right top' => esc_html__( 'Right Top', 'fabrique-core' ),
				'right center' => esc_html__( 'Right Center', 'fabrique-core' ),
				'right bottom' => esc_html__( 'Right Bottom', 'fabrique-core' ),
				'center top' => esc_html__( 'Center Top', 'fabrique-core' ),
				'center center' => esc_html__( 'Center Center', 'fabrique-core' ),
				'center bottom' => esc_html__( 'Center Bottom', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'mobile_navbar_menu_color', array(
			'default' => $defaults['mobile_navbar_menu_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'mobile_navbar_menu_color', array (
			'section' => 'fabrique_header_mobile_navigation_section',
			'settings' => 'mobile_navbar_menu_color',
			'label' => esc_html__( 'Menu Color', 'fabrique-core' ),
			'priority' => 130
		) ) );


		$wp_customize->add_setting( 'mobile_navbar_menu_active_color', array(
			'default' => $defaults['mobile_navbar_menu_active_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'mobile_navbar_menu_active_color', array (
			'section' => 'fabrique_header_mobile_navigation_section',
			'settings' => 'mobile_navbar_menu_active_color',
			'label' => esc_html__( 'Menu Active Color', 'fabrique-core' ),
			'priority' => 140
		) ) );


		$wp_customize->add_setting( 'mobile_navbar_menu_hover_color', array(
			'default' => $defaults['mobile_navbar_menu_hover_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'mobile_navbar_menu_hover_color', array (
			'section' => 'fabrique_header_mobile_navigation_section',
			'settings' => 'mobile_navbar_menu_hover_color',
			'label' => esc_html__( 'Menu Hover Color', 'fabrique-core' ),
			'priority' => 150
		) ) );


		$wp_customize->add_setting( 'fixed_navbar', array(
			'default' => $defaults['fixed_navbar'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'fixed_navbar', array (
			'section' => 'fabrique_header_fixed_navigation_section',
			'settings' => 'fixed_navbar',
			'label' => esc_html__( 'Fixed Navigation Bar', 'fabrique-core' ),
			'priority' => 10,
			'children' => array(
				'fixed_navbar_hide',
				'fixed_navbar_style'
			)
		) ) );


		$wp_customize->add_setting( 'fixed_navbar_hide', array(
			'default' => $defaults['fixed_navbar_hide'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'fixed_navbar_hide', array (
			'section' => 'fabrique_header_fixed_navigation_section',
			'settings' => 'fixed_navbar_hide',
			'label' => esc_html__( 'Auto Hide', 'fabrique-core' ),
			'description' => esc_html__( 'Hide when scroll down, show when scroll up', 'fabrique-core' ),
			'priority' => 20
		) ) );


		$wp_customize->add_setting( 'fixed_navbar_style', array(
			'default' => $defaults['fixed_navbar_style'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'fixed_navbar_style', array (
			'section' => 'fabrique_header_fixed_navigation_section',
			'settings' => 'fixed_navbar_style',
			'label' => esc_html__( 'Fixed Navigation Bar Mode', 'fabrique-core' ),
			'priority' => 30,
			'choices' => array(
				'default' => esc_html__( 'Default', 'fabrique-core' ),
				'custom' => esc_html__( 'Custom', 'fabrique-core' )
			),
			'children' => array(
				'custom' => array(
					'fixed_navbar_height',
					'fixed_navbar_transition',
					'fixed_navbar_transition_point',
					'fixed_navbar_bottom_border',
					'fixed_navbar_bottom_border_thickness',
					'fixed_navbar_bottom_border_color',
					'fixed_navbar_advance'
				)
			)
		) ) );


		$wp_customize->add_setting( 'fixed_navbar_height', array(
			'default' => $defaults['fixed_navbar_height'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'fixed_navbar_height', array (
			'section' => 'fabrique_header_fixed_navigation_section',
			'settings' => 'fixed_navbar_height',
			'label' => esc_html__( 'Height', 'fabrique-core' ),
			'priority' => 40,
			'min' => 40,
			'max' => 200
		) ) );


		$wp_customize->add_setting( 'fixed_navbar_transition', array(
			'default' => $defaults['fixed_navbar_transition'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'fixed_navbar_transition', array(
			'section' => 'fabrique_header_fixed_navigation_section',
			'settings' => 'fixed_navbar_transition',
			'label' => esc_html__( 'Fixed Navigation Bar Transition Mode', 'fabrique-core' ),
			'type' => 'select',
			'priority' => 60,
			'choices' => array(
				'show' => esc_html__( 'Show at point', 'fabrique-core' ),
				'change' => esc_html__( 'Change style at point', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'fixed_navbar_transition_point', array(
			'default' => $defaults['fixed_navbar_transition_point'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Text_Control( $wp_customize, 'fixed_navbar_transition_point', array (
			'section' => 'fabrique_header_fixed_navigation_section',
			'settings' => 'fixed_navbar_transition_point',
			'label' => esc_html__( 'Transition Point (px)', 'fabrique-core' ),
			'description' => esc_html__( 'Fixed Navigation will show/change at this position. Leave this blank for auto transition point.', 'fabrique-core' ),
			'priority' => 70
		) ) );


		$wp_customize->add_setting( 'fixed_navbar_bottom_border', array(
			'default' => $defaults['fixed_navbar_bottom_border'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Section_Control( $wp_customize, 'fixed_navbar_bottom_border', array (
			'section' => 'fabrique_header_fixed_navigation_section',
			'settings' => 'fixed_navbar_bottom_border',
			'label' => esc_html__( 'Bottom Border', 'fabrique-core' ),
			'priority' => 80
		) ) );


		$wp_customize->add_setting( 'fixed_navbar_bottom_border_thickness', array(
			'default' => $defaults['fixed_navbar_bottom_border_thickness'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'fixed_navbar_bottom_border_thickness', array (
			'section' => 'fabrique_header_fixed_navigation_section',
			'settings' => 'fixed_navbar_bottom_border_thickness',
			'label' => esc_html__( 'Border Thickness (px)', 'fabrique-core' ),
			'priority' => 90,
			'min' => 0,
			'max' => 10
		) ) );


		$wp_customize->add_setting( 'fixed_navbar_bottom_border_color', array(
			'default' => $defaults['fixed_navbar_bottom_border_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'fixed_navbar_bottom_border_color', array (
			'section' => 'fabrique_header_fixed_navigation_section',
			'settings' => 'fixed_navbar_bottom_border_color',
			'label' => esc_html__( 'Bottom Border Color', 'fabrique-core' ),
			'priority' => 100
		) ) );


		$wp_customize->add_setting( 'fixed_navbar_advance', array(
			'default' => $defaults['fixed_navbar_advance'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'fixed_navbar_advance', array (
			'section' => 'fabrique_header_fixed_navigation_section',
			'settings' => 'fixed_navbar_advance',
			'label' => esc_html__( 'Fixed Navigation Bar Advance', 'fabrique-core' ),
			'priority' => 110,
			'advance' => true,
			'children' => array(
				'fixed_navbar_background_color',
				'fixed_navbar_opacity',
				'fixed_navbar_menu_font_size',
				'fixed_navbar_menu_color',
				'fixed_navbar_menu_active_color',
				'fixed_navbar_menu_hover_color'
			)
		) ) );


		$wp_customize->add_setting( 'fixed_navbar_background_color', array(
			'default' => $defaults['fixed_navbar_background_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'fixed_navbar_background_color', array (
			'section' => 'fabrique_header_fixed_navigation_section',
			'settings' => 'fixed_navbar_background_color',
			'label' => esc_html__( 'Background Color', 'fabrique-core' ),
			'priority' => 120
		) ) );


		$wp_customize->add_setting( 'fixed_navbar_opacity', array(
			'default' => $defaults['fixed_navbar_opacity'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'fixed_navbar_opacity', array (
			'section' => 'fabrique_header_fixed_navigation_section',
			'settings' => 'fixed_navbar_opacity',
			'label' => esc_html__( 'Background Opacity', 'fabrique-core' ),
			'priority' => 130,
			'min' => 0,
			'max' => 100
		) ) );


		$wp_customize->add_setting( 'fixed_navbar_menu_font_size', array(
			'default' => $defaults['fixed_navbar_menu_font_size'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'fixed_navbar_menu_font_size', array (
			'section' => 'fabrique_header_fixed_navigation_section',
			'settings' => 'fixed_navbar_menu_font_size',
			'label' => esc_html__( 'Menu Font Size (px)', 'fabrique-core' ),
			'priority' => 140,
			'min' => 10,
			'max' => 30
		) ) );


		$wp_customize->add_setting( 'fixed_navbar_menu_color', array(
			'default' => $defaults['fixed_navbar_menu_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'fixed_navbar_menu_color', array (
			'section' => 'fabrique_header_fixed_navigation_section',
			'settings' => 'fixed_navbar_menu_color',
			'label' => esc_html__( 'Menu Color', 'fabrique-core' ),
			'priority' => 150
		) ) );


		$wp_customize->add_setting( 'fixed_navbar_menu_active_color', array(
			'default' => $defaults['fixed_navbar_menu_active_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'fixed_navbar_menu_active_color', array (
			'section' => 'fabrique_header_fixed_navigation_section',
			'settings' => 'fixed_navbar_menu_active_color',
			'label' => esc_html__( 'Menu Active Color', 'fabrique-core' ),
			'priority' => 160
		) ) );


		$wp_customize->add_setting( 'fixed_navbar_menu_hover_color', array(
			'default' => $defaults['fixed_navbar_menu_hover_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'fixed_navbar_menu_hover_color', array (
			'section' => 'fabrique_header_fixed_navigation_section',
			'settings' => 'fixed_navbar_menu_hover_color',
			'label' => esc_html__( 'Menu Hover Color', 'fabrique-core' ),
			'priority' => 170
		) ) );


		$wp_customize->add_setting( 'topbar', array(
			'default' => $defaults['topbar'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'topbar', array (
			'section' => 'fabrique_header_topbar_section',
			'settings' => 'topbar',
			'label' => esc_html__( 'Topbar', 'fabrique-core' ),
			'priority' => 5,
			'children' => array(
				'enable_mobile_topbar',
				'topbar_column',
				'topbar_height',
				'topbar_separator',
				'topbar_bottom_border',
				'topbar_bottom_border_thickness',
				'topbar_bottom_border_color',
				'topbar_advance'
			)
		) ) );


		$wp_customize->add_setting( 'enable_mobile_topbar', array(
			'default' => $defaults['enable_mobile_topbar'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'enable_mobile_topbar', array (
			'section' => 'fabrique_header_topbar_section',
			'settings' => 'enable_mobile_topbar',
			'label' => esc_html__( 'Topbar in mobile', 'fabrique-core' ),
			'description' => esc_html__( 'Enable Topbar in mobile/tablet device', 'fabrique-core' ),
			'priority' => 7
		) ) );


		$wp_customize->add_setting( 'topbar_column', array(
			'default' => $defaults['topbar_column'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'topbar_column', array(
			'section' => 'fabrique_header_topbar_section',
			'settings' => 'topbar_column',
			'label' => esc_html__( 'Topbar Column', 'fabrique-core' ),
			'priority' => 10,
			'type' => 'select',
			'choices' => array(
				1 => '1',
				2 => '2',
				3 => '3',
				4 => '4'
			)
		) );


		$wp_customize->add_setting( 'topbar_height', array(
			'default' => $defaults['topbar_height'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'topbar_height', array (
			'section' => 'fabrique_header_topbar_section',
			'settings' => 'topbar_height',
			'label' => esc_html__( 'Height (px)', 'fabrique-core' ),
			'priority' => 20,
			'min' => 1,
			'max' => 200
		) ) );


		$wp_customize->add_setting( 'topbar_separator', array(
			'default' => $defaults['topbar_separator'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'topbar_separator', array (
			'section' => 'fabrique_header_topbar_section',
			'settings' => 'topbar_separator',
			'label' => esc_html__( 'Topbar Separator', 'fabrique-core' ),
			'priority' => 25
		) ) );


		$wp_customize->add_setting( 'topbar_bottom_border', array(
			'default' => $defaults['topbar_bottom_border'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Section_Control( $wp_customize, 'topbar_bottom_border', array (
			'section' => 'fabrique_header_topbar_section',
			'settings' => 'topbar_bottom_border',
			'label' => esc_html__( 'Bottom Border', 'fabrique-core' ),
			'priority' => 30
		) ) );


		$wp_customize->add_setting( 'topbar_bottom_border_thickness', array(
			'default' => $defaults['topbar_bottom_border_thickness'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'topbar_bottom_border_thickness', array (
			'section' => 'fabrique_header_topbar_section',
			'settings' => 'topbar_bottom_border_thickness',
			'label' => esc_html__( 'Border Thickness (px)', 'fabrique-core' ),
			'priority' => 40,
			'min' => 0,
			'max' => 5
		) ) );


		$wp_customize->add_setting( 'topbar_bottom_border_color', array(
			'default' => $defaults['topbar_bottom_border_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'topbar_bottom_border_color', array (
			'section' => 'fabrique_header_topbar_section',
			'settings' => 'topbar_bottom_border_color',
			'label' => esc_html__( 'Border Color', 'fabrique-core' ),
			'priority' => 50
		) ) );


		$wp_customize->add_setting( 'topbar_advance', array(
			'default' => $defaults['topbar_advance'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'topbar_advance', array (
			'section' => 'fabrique_header_topbar_section',
			'settings' => 'topbar_advance',
			'label' => esc_html__( 'Topbar Advance', 'fabrique-core' ),
			'priority' => 60,
			'advance' => true,
			'children' => array(
				'topbar_background_color',
				'topbar_background_opacity',
				'topbar_text_color',
				'topbar_link_color',
				'topbar_link_hover_color'
			)
		) ) );


		$wp_customize->add_setting( 'topbar_background_color', array(
			'default' => $defaults['topbar_background_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'topbar_background_color', array (
			'section' => 'fabrique_header_topbar_section',
			'settings' => 'topbar_background_color',
			'label' => esc_html__( 'Background Color', 'fabrique-core' ),
			'priority' => 70
		) ) );


		$wp_customize->add_setting( 'topbar_background_opacity', array(
			'default' => $defaults['topbar_background_opacity'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'topbar_background_opacity', array (
			'section' => 'fabrique_header_topbar_section',
			'settings' => 'topbar_background_opacity',
			'label' => esc_html__( 'Background Opacity', 'fabrique-core' ),
			'description' => esc_html__( "This option will not take effect on 'default' background color" , 'fabrique-core' ),
			'priority' => 80,
			'min' => 0,
			'max' => 100
		) ) );


		$wp_customize->add_setting( 'topbar_text_color', array(
			'default' => $defaults['topbar_text_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'topbar_text_color', array (
			'section' => 'fabrique_header_topbar_section',
			'settings' => 'topbar_text_color',
			'label' => esc_html__( 'Text Color', 'fabrique-core' ),
			'priority' => 90
		) ) );


		$wp_customize->add_setting( 'topbar_link_color', array(
			'default' => $defaults['topbar_link_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'topbar_link_color', array (
			'section' => 'fabrique_header_topbar_section',
			'settings' => 'topbar_link_color',
			'label' => esc_html__( 'Link Color', 'fabrique-core' ),
			'priority' => 100
		) ) );


		$wp_customize->add_setting( 'topbar_link_hover_color', array(
			'default' => $defaults['topbar_link_hover_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'topbar_link_hover_color', array (
			'section' => 'fabrique_header_topbar_section',
			'settings' => 'topbar_link_hover_color',
			'label' => esc_html__( 'Link Hover Color', 'fabrique-core' ),
			'priority' => 110
		) ) );


		$wp_customize->add_setting( 'header_action_button', array(
			'default' => $defaults['header_action_button'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'header_action_button', array (
			'section' => 'fabrique_header_action_button_section',
			'settings' => 'header_action_button',
			'label' => esc_html__( 'Header Action', 'fabrique-core' ),
			'priority' => 10,
			'children' => array(
				'fixed_nav_action_button',
				'action_type',

			)
		) ) );


		$wp_customize->add_setting( 'fixed_nav_action_button', array(
			'default' => $defaults['fixed_nav_action_button'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'fixed_nav_action_button', array (
			'section' => 'fabrique_header_action_button_section',
			'settings' => 'fixed_nav_action_button',
			'label' => esc_html__( 'Show On Fixed Navigation', 'fabrique-core' ),
			'priority' => 20
		) ) );


		$wp_customize->add_setting( 'action_type', array(
			'default' => $defaults['action_type'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'action_type', array (
			'section' => 'fabrique_header_action_button_section',
			'settings' => 'action_type',
			'label' => esc_html__( 'Action Type', 'fabrique-core' ),
			'priority' => 30,
			'choices' => array(
				'social' => esc_html__( 'Social', 'fabrique-core' ),
				'link' => esc_html__( 'Link', 'fabrique-core' ),
				'headerwidget' => esc_html__( 'Widgets', 'fabrique-core' )
			),
			'children' => array(
				'social' => array(
					'action_mobile_display',
					'action_social_component'
				),
				'link' => array(
					'action_mobile_display',
					'action_button_style_section',
					'action_button_text',
					'action_button_icon',
					'action_button_icon_position',
					'action_button_style',
					'action_button_hover_style',
					'action_button_border',
					'action_button_radius',
					'action_button_setting_section',
					'action_link',
					'action_target_self'
				),
				'headerwidget' => array(
					'action_button_style_section',
					'action_button_text',
					'action_button_icon',
					'action_button_icon_position',
					'action_button_style',
					'action_button_hover_style',
					'action_button_border',
					'action_button_radius',
					'action_button_setting_section',
					'header_widget_column',
					'header_widget_alignment',
					'header_widget_max_height',
					'header_widget_advance'
				)
			)
		) ) );


		$wp_customize->add_setting( 'action_mobile_display', array(
			'default' => $defaults['action_mobile_display'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'action_mobile_display', array (
			'section' => 'fabrique_header_action_button_section',
			'settings' => 'action_mobile_display',
			'label' => esc_html__( 'Display on mobile', 'fabrique-core' ),
			'priority' => 35
		) ) );


		$wp_customize->add_setting( 'action_button_style_section', array(
			'default' => $defaults['action_button_style_section'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Section_Control( $wp_customize, 'action_button_style_section', array (
			'section' => 'fabrique_header_action_button_section',
			'settings' => 'action_button_style_section',
			'label' => esc_html__( 'Action Button Style', 'fabrique-core' ),
			'priority' => 40
		) ) );


		$wp_customize->add_setting( 'action_button_text', array(
			'default' => $defaults['action_button_text'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'action_button_text', array(
			'section' => 'fabrique_header_action_button_section',
			'settings' => 'action_button_text',
			'label' => esc_html__( 'Action Button Label', 'fabrique-core' ),
			'priority' => 50,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'action_button_icon', array(
			'default' => $defaults['action_button_icon'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'action_button_icon', array(
			'section' => 'fabrique_header_action_button_section',
			'settings' => 'action_button_icon',
			'label' => esc_html__( 'Action Button Icon', 'fabrique-core' ),
			'priority' => 60,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'action_button_icon_position', array(
			'default' => $defaults['action_button_icon_position'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'action_button_icon_position', array (
			'section' => 'fabrique_header_action_button_section',
			'settings' => 'action_button_icon_position',
			'label' => esc_html__( 'Action Button Icon Position', 'fabrique-core' ),
			'priority' => 70,
			'choices' => array(
				'before' => esc_html__( 'Before', 'fabrique-core' ),
				'after' => esc_html__( 'After', 'fabrique-core' )
			)
		) ) );


		$wp_customize->add_setting( 'action_button_style', array(
			'default' => $defaults['action_button_style'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'action_button_style', array (
			'radio_type' => 'image',
			'radio_style' => 'box',
			'section' => 'fabrique_header_action_button_section',
			'settings' => 'action_button_style',
			'label' => esc_html__( 'Button Style', 'fabrique-core' ),
			'priority' => 80,
			'names' => array(
				'fill' => esc_html__( 'Fill', 'fabrique-core' ),
				'border' => esc_html__( 'Border', 'fabrique-core' ),
			),
			'choices' => array(
				'fill' => 'customize-button-fill',
				'border' => 'customize-button-border',
			)
		) ) );


		$wp_customize->add_setting( 'action_button_hover_style', array(
			'default' => $defaults['action_button_hover_style'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'action_button_hover_style', array(
			'section' => 'fabrique_header_action_button_section',
			'settings' => 'action_button_hover_style',
			'label' => esc_html__( 'Button Hover Style', 'fabrique-core' ),
			'priority' => 90,
			'type' => 'select',
			'choices' => array(
				'none' => esc_html__( 'None', 'fabrique-core' ),
				'inverse' => esc_html__( 'Inverse', 'fabrique-core' ),
				'brand' => esc_html__( 'Brand Color', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'action_button_border', array(
			'default' => $defaults['action_button_border'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'action_button_border', array (
			'section' => 'fabrique_header_action_button_section',
			'settings' => 'action_button_border',
			'label' => esc_html__( 'Border Thickness (px)', 'fabrique-core' ),
			'priority' => 100,
			'min' => 0,
			'max' => 5
		) ) );


		$wp_customize->add_setting( 'action_button_radius', array(
			'default' => $defaults['action_button_radius'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'action_button_radius', array (
			'section' => 'fabrique_header_action_button_section',
			'settings' => 'action_button_radius',
			'label' => esc_html__( 'Button Radius (px)', 'fabrique-core' ),
			'priority' => 110,
			'min' => 0,
			'max' => 35
		) ) );


		$wp_customize->add_setting( 'action_button_setting_section', array(
			'default' => $defaults['action_button_setting_section'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Section_Control( $wp_customize, 'action_button_setting_section', array (
			'section' => 'fabrique_header_action_button_section',
			'settings' => 'action_button_setting_section',
			'label' => esc_html__( 'Action Setting', 'fabrique-core' ),
			'priority' => 120
		) ) );


		$wp_customize->add_setting( 'action_link', array(
			'default' => $defaults['action_link'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'action_link', array(
			'section' => 'fabrique_header_action_button_section',
			'settings' => 'action_link',
			'label' => esc_html__( 'Link', 'fabrique-core' ),
			'priority' => 130,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'action_target_self', array(
			'default' => $defaults['action_target_self'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'action_target_self', array (
			'section' => 'fabrique_header_action_button_section',
			'settings' => 'action_target_self',
			'label' => esc_html__( 'Open link in same tab', 'fabrique-core' ),
			'description' => esc_html__( 'to disable opening link in new tab', 'fabrique-core' ),
			'priority' => 140
		) ) );


		$wp_customize->add_setting( 'header_widget_column', array(
			'default' => $defaults['header_widget_column'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'header_widget_column', array(
			'section' => 'fabrique_header_action_button_section',
			'settings' => 'header_widget_column',
			'label' => esc_html__( 'Header Widget Column', 'fabrique-core' ),
			'priority' => 160,
			'type' => 'select',
			'choices' => array(
				1 => '1',
				2 => '2',
				3 => '3',
				4 => '4'
			)
		) );


		$wp_customize->add_setting( 'header_widget_alignment', array(
			'default' => $defaults['header_widget_alignment'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'header_widget_alignment', array (
			'section' => 'fabrique_header_action_button_section',
			'settings' => 'header_widget_alignment',
			'label' => esc_html__( 'Content Alignment', 'fabrique-core' ),
			'priority' => 170,
			'choices' => array(
				'left' => esc_html__( 'Left', 'fabrique-core' ),
				'center' => esc_html__( 'Center', 'fabrique-core' ),
				'right' => esc_html__( 'Right', 'fabrique-core' )
			)
		) ) );


		$wp_customize->add_setting( 'header_widget_max_height', array(
			'default' => $defaults['header_widget_max_height'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Text_Control( $wp_customize, 'header_widget_max_height', array (
			'section' => 'fabrique_header_action_button_section',
			'settings' => 'header_widget_max_height',
			'label' => esc_html__( 'Header Widget Max Height (px)', 'fabrique-core' ),
			'description' => esc_html__( 'Leave this blank for auto.', 'fabrique-core' ),
			'priority' => 180
		) ) );


		$wp_customize->add_setting( 'header_widget_separator', array(
			'default' => $defaults['header_widget_separator'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'header_widget_separator', array (
			'section' => 'fabrique_header_action_button_section',
			'settings' => 'header_widget_separator',
			'label' => esc_html__( 'Header Widget Separator', 'fabrique-core' ),
			'priority' => 190
		) ) );


		$wp_customize->add_setting( 'header_widget_advance', array(
			'default' => $defaults['header_widget_advance'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'header_widget_advance', array (
			'section' => 'fabrique_header_action_button_section',
			'settings' => 'header_widget_advance',
			'label' => esc_html__( 'Header Widgets Advanced', 'fabrique-core' ),
			'priority' => 200,
			'advance' => true,
			'children' => array(
				'header_widget_background_color',
				'header_widget_background_opacity',
				'header_widget_background_image',
				'header_widget_background_repeat',
				'header_widget_background_size',
				'header_widget_background_position',
				'header_widget_text_color',
				'header_widget_link_color',
				'header_widget_link_hover_color'
			)
		) ) );


		$wp_customize->add_setting( 'header_widget_background_color', array(
			'default' => $defaults['header_widget_background_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'header_widget_background_color', array (
			'section' => 'fabrique_header_action_button_section',
			'settings' => 'header_widget_background_color',
			'label' => esc_html__( 'Background Color', 'fabrique-core' ),
			'priority' => 210
		) ) );


		$wp_customize->add_setting( 'header_widget_background_opacity', array(
			'default' => $defaults['header_widget_background_opacity'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'header_widget_background_opacity', array (
			'section' => 'fabrique_header_action_button_section',
			'settings' => 'header_widget_background_opacity',
			'label' => esc_html__( 'Background Opacity (%)', 'fabrique-core' ),
			'description' => esc_html__( "This option will not take effect on 'default' background color" , 'fabrique-core' ),
			'priority' => 220,
			'min' => 0,
			'max' => 100
		) ) );


		$wp_customize->add_setting( 'header_widget_background_image', array(
			'default' => $defaults['header_widget_background_image'],
			'sanitize_callback' => 'fabrique_core_sanitize_url_value'
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_widget_background_image', array (
			'section' => 'fabrique_header_action_button_section',
			'settings' => 'header_widget_background_image',
			'label' => esc_html__( 'Background Image', 'fabrique-core' ),
			'priority' => 230
		) ) );


		$wp_customize->add_setting( 'header_widget_background_repeat', array(
			'default' => $defaults['header_widget_background_repeat'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'header_widget_background_repeat', array(
			'section' => 'fabrique_header_action_button_section',
			'settings' => 'header_widget_background_repeat',
			'label' => esc_html__( 'Background Repeat', 'fabrique-core' ),
			'priority' => 240,
			'type' => 'select',
			'choices' => array(
				'repeat' => esc_html__( 'Repeat', 'fabrique-core' ),
				'repeat-x' => esc_html__( 'Repeat-x', 'fabrique-core' ),
				'repeat-y' => esc_html__( 'Repeat-y', 'fabrique-core' ),
				'no-repeat' => esc_html__( 'No Repeat', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'header_widget_background_size', array(
			'default' => $defaults['header_widget_background_size'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'header_widget_background_size', array(
			'section' => 'fabrique_header_action_button_section',
			'settings' => 'header_widget_background_size',
			'label' => esc_html__( 'Background Size', 'fabrique-core' ),
			'priority' => 250,
			'type' => 'select',
			'choices' => array(
				'auto' => esc_html__( 'Auto', 'fabrique-core' ),
				'cover' => esc_html__( 'Cover', 'fabrique-core' ),
				'contain' => esc_html__( 'Contain', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'header_widget_background_position', array(
			'default' => $defaults['header_widget_background_position'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'header_widget_background_position', array(
			'section' => 'fabrique_header_action_button_section',
			'settings' => 'header_widget_background_position',
			'label' => esc_html__( 'Background Position', 'fabrique-core' ),
			'priority' => 260,
			'type' => 'select',
			'choices' => array(
				'left top' => esc_html__( 'Left Top', 'fabrique-core' ),
				'left center' => esc_html__( 'Left Center', 'fabrique-core' ),
				'left bottom' => esc_html__( 'Left Bottom', 'fabrique-core' ),
				'right top' => esc_html__( 'Right Top', 'fabrique-core' ),
				'right center' => esc_html__( 'Right Center', 'fabrique-core' ),
				'right bottom' => esc_html__( 'Right Bottom', 'fabrique-core' ),
				'center top' => esc_html__( 'Center Top', 'fabrique-core' ),
				'center center' => esc_html__( 'Center Center', 'fabrique-core' ),
				'center bottom' => esc_html__( 'Center Bottom', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'header_widget_text_color', array(
			'default' => $defaults['header_widget_text_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'header_widget_text_color', array (
			'section' => 'fabrique_header_action_button_section',
			'settings' => 'header_widget_text_color',
			'label' => esc_html__( 'Text Color', 'fabrique-core' ),
			'priority' => 270
		) ) );


		$wp_customize->add_setting( 'header_widget_link_color', array(
			'default' => $defaults['header_widget_link_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'header_widget_link_color', array (
			'section' => 'fabrique_header_action_button_section',
			'settings' => 'header_widget_link_color',
			'label' => esc_html__( 'Link Color', 'fabrique-core' ),
			'priority' => 280
		) ) );


		$wp_customize->add_setting( 'header_widget_link_hover_color', array(
			'default' => $defaults['header_widget_link_hover_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'header_widget_link_hover_color', array (
			'section' => 'fabrique_header_action_button_section',
			'settings' => 'header_widget_link_hover_color',
			'label' => esc_html__( 'Link Hover Color', 'fabrique-core' ),
			'priority' => 290
		) ) );


		$wp_customize->add_setting( 'action_social_component', array(
			'default' => $defaults['action_social_component'],
			'sanitize_callback' => 'fabrique_core_sanitize_component_value'
		) );

		$wp_customize->add_control( new Fabrique_Component_Control( $wp_customize, 'action_social_component', array (
			'section' => 'fabrique_header_action_button_section',
			'settings' => 'action_social_component',
			'label' => esc_html__( 'Social Component', 'fabrique-core' ),
			'description' => esc_html__( 'This will use the link from social section' ),
			'choices' => array(
				'facebook' => esc_html__( 'Facebook', 'fabrique-core' ),
				'twitter' => esc_html__( 'Twitter', 'fabrique-core' ),
				'instagram' => esc_html__( 'Instagram', 'fabrique-core' ),
				'youtube' => esc_html__( 'Youtube', 'fabrique-core' ),
				'vimeo' => esc_html__( 'Vimeo', 'fabrique-core' ),
				'linkedin' => esc_html__( 'Linkedin', 'fabrique-core' ),
				'google-plus' => esc_html__( 'Google+', 'fabrique-core' ),
				'skype' => esc_html__( 'Skype', 'fabrique-core' ),
				'pinterest' => esc_html__( 'Pinterest', 'fabrique-core' ),
				'tripadvisor' => esc_html__( 'Tripadvisor', 'fabrique-core' ),
				'flickr' => esc_html__( 'Flickr', 'fabrique-core' ),
				'tumblr' => esc_html__( 'Tumblr', 'fabrique-core' ),
				'dribbble' => esc_html__( 'Dribbble', 'fabrique-core' ),
				'behance' => esc_html__( 'Behance', 'fabrique-core' ),
				'stumbleupon' => esc_html__( 'StumbleUpon', 'fabrique-core' ),
				'email' => esc_html__( 'Email', 'fabrique-core' ),
				'phone' => esc_html__( 'Phone', 'fabrique-core' ),
				'line' => esc_html__( 'Line', 'fabrique-core' ),
				'xing' => esc_html__( 'Xing', 'fabrique-core' )
			),
			'priority' => 300
		) ) );


		$wp_customize->add_setting( 'footer', array(
			'default' => $defaults['footer'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'footer', array (
			'section' => 'fabrique_footer_section',
			'settings' => 'footer',
			'label' => esc_html__( 'Footer', 'fabrique-core' ),
			'description' => esc_html__( 'Enable Footer to apply with pages that are not created from blueprint', 'fabrique-core' ),
			'priority' => 10
		) ) );


		$wp_customize->add_setting( 'footer_parallax', array(
			'default' => $defaults['footer_parallax'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'footer_parallax', array (
			'section' => 'fabrique_footer_section',
			'settings' => 'footer_parallax',
			'label' => esc_html__( 'Enable Parallax Footer', 'fabrique-core' ),
			'priority' => 10
		) ) );


		$wp_customize->add_setting( 'footer_id', array(
			'default' => $defaults['footer_id'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Select_Control( $wp_customize, 'footer_id', array (
			'select_type' => 'blueprint',
			'section' => 'fabrique_footer_section',
			'settings' => 'footer_id',
			'label' => esc_html__( 'Select Footer', 'fabrique-core' ),
			'priority' => 30
		) ) );


		$wp_customize->add_setting( 'page_title_full_width', array(
			'default' => $defaults['page_title_full_width'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'page_title_full_width', array (
			'section' => 'fabrique_page_title_section',
			'settings' => 'page_title_full_width',
			'label' => esc_html__( 'Full Width', 'fabrique-core' ),
			'priority' => 5
		) ) );


		$wp_customize->add_setting( 'breadcrumb_setting_section', array(
			'default' => $defaults['breadcrumb_setting_section'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Section_Control( $wp_customize, 'breadcrumb_setting_section', array (
			'section' => 'fabrique_page_title_section',
			'settings' => 'breadcrumb_setting_section',
			'label' => esc_html__( 'Breadcrumb Setting', 'fabrique-core' ),
			'priority' => 10
		) ) );


		$wp_customize->add_setting( 'breadcrumb', array(
			'default' => $defaults['breadcrumb'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'breadcrumb', array (
			'section' => 'fabrique_page_title_section',
			'settings' => 'breadcrumb',
			'label' => esc_html__( 'Show Breadcrumb', 'fabrique-core' ),
			'priority' => 15,
			'children' => array(
				'breadcrumb_separator',
				'breadcrumb_text_color',
				'breadcrumb_background_color',
				'breadcrumb_background_opacity'
			)
		) ) );


		$wp_customize->add_setting( 'breadcrumb_separator', array(
			'default' => $defaults['breadcrumb_separator'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'breadcrumb_separator', array(
			'section' => 'fabrique_page_title_section',
			'settings' => 'breadcrumb_separator',
			'label' => esc_html__( 'Separator Style', 'fabrique-core' ),
			'priority' => 20,
			'type' => 'select',
			'choices' => array(
				'ln-arrow-right' => esc_html__( 'Thin Arrow', 'fabrique-core' ),
				'arrow-right' => esc_html__( 'Arrow', 'fabrique-core' ),
				'arrow-bold-right' => esc_html__( 'Bold Arrow', 'fabrique-core' ),
				'ln-chevron-right' => esc_html__( 'Thin Chevron', 'fabrique-core' ),
				'chevron-right' => esc_html__( 'Chevron', 'fabrique-core' ),
				'angle-right' => esc_html__( 'Angle', 'fabrique-core' ),
				'angle-double-right' => esc_html__( 'Double Angle', 'fabrique-core' ),
				'caret-right' => esc_html__( 'Caret', 'fabrique-core' ),
				'hand-o-right' => esc_html__( 'Finger', 'fabrique-core' ),
				'custom' => esc_html__( 'Custom', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'breadcrumb_text_color', array(
			'default' => $defaults['breadcrumb_text_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'breadcrumb_text_color', array (
			'section' => 'fabrique_page_title_section',
			'settings' => 'breadcrumb_text_color',
			'label' => esc_html__( 'Breadcrumb Text Color', 'fabrique-core' ),
			'priority' => 25
		) ) );


		$wp_customize->add_setting( 'breadcrumb_background_color', array(
			'default' => $defaults['breadcrumb_background_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'breadcrumb_background_color', array (
			'section' => 'fabrique_page_title_section',
			'settings' => 'breadcrumb_background_color',
			'label' => esc_html__( 'Breadcrumb Background Color', 'fabrique-core' ),
			'priority' => 30
		) ) );


		$wp_customize->add_setting( 'breadcrumb_background_opacity', array(
			'default' => $defaults['breadcrumb_background_opacity'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'breadcrumb_background_opacity', array (
			'section' => 'fabrique_page_title_section',
			'settings' => 'breadcrumb_background_opacity',
			'label' => esc_html__( 'Breadcrumb Background Opacity (%)', 'fabrique-core' ),
			'description' => esc_html__( "This option will not take effect on 'default' background color" , 'fabrique-core' ),
			'priority' => 40,
			'min' => 0,
			'max' => 100
		) ) );


		$wp_customize->add_setting( 'page_title_setting_section', array(
			'default' => $defaults['page_title_setting_section'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Section_Control( $wp_customize, 'page_title_setting_section', array (
			'section' => 'fabrique_page_title_section',
			'settings' => 'page_title_setting_section',
			'label' => esc_html__( 'Page Title Setting', 'fabrique-core' ),
			'priority' => 45
		) ) );


		$wp_customize->add_setting( 'page_title', array(
			'default' => $defaults['page_title'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'page_title', array (
			'section' => 'fabrique_page_title_section',
			'settings' => 'page_title',
			'label' => esc_html__( 'Show Page Title', 'fabrique-core' ),
			'priority' => 50,
			'children' => array(
				'breadcrumb_position',
				'breadcrumb_alignment',
				'page_title_alignment',
				'page_title_text_color',
				'page_title_background_custom',
				'page_title_label_section'
			)
		) ) );


		$wp_customize->add_setting( 'breadcrumb_position', array(
			'default' => $defaults['breadcrumb_position'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'breadcrumb_position', array (
			'section' => 'fabrique_page_title_section',
			'settings' => 'breadcrumb_position',
			'label' => esc_html__( 'Breadcrumb Position', 'fabrique-core' ),
			'priority' => 55,
			'choices' => array(
				'top' => esc_html__( 'Top', 'fabrique-core' ),
				'bottom' => esc_html__( 'Bottom', 'fabrique-core' ),
				'inline' => esc_html__( 'Inline', 'fabrique-core' )
			)
		) ) );


		$wp_customize->add_setting( 'breadcrumb_alignment', array(
			'default' => $defaults['breadcrumb_alignment'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'breadcrumb_alignment', array (
			'section' => 'fabrique_page_title_section',
			'settings' => 'breadcrumb_alignment',
			'label' => esc_html__( 'Breadcrumb Alignment', 'fabrique-core' ),
			'priority' => 60,
			'choices' => array(
				'left' => esc_html__( 'Left', 'fabrique-core' ),
				'center' => esc_html__( 'Center', 'fabrique-core' ),
				'right' => esc_html__( 'Right', 'fabrique-core' )
			)
		) ) );


		$wp_customize->add_setting( 'page_title_alignment', array(
			'default' => $defaults['page_title_alignment'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'page_title_alignment', array (
			'section' => 'fabrique_page_title_section',
			'settings' => 'page_title_alignment',
			'label' => esc_html__( 'Alignment', 'fabrique-core' ),
			'priority' => 70,
			'choices' => array(
				'left' => esc_html__( 'Left', 'fabrique-core' ),
				'center' => esc_html__( 'Center', 'fabrique-core' ),
				'right' => esc_html__( 'Right', 'fabrique-core' )
			)
		) ) );


		$wp_customize->add_setting( 'page_title_text_color', array(
			'default' => $defaults['page_title_text_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'page_title_text_color', array (
			'section' => 'fabrique_page_title_section',
			'settings' => 'page_title_text_color',
			'label' => esc_html__( 'Page Title Text Color', 'fabrique-core' ),
			'priority' => 80
		) ) );


		$wp_customize->add_setting( 'page_title_background_custom', array(
			'default' => $defaults['page_title_background_custom'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'page_title_background_custom', array (
			'section' => 'fabrique_page_title_section',
			'settings' => 'page_title_background_custom',
			'label' => esc_html__( 'Page Title Background', 'fabrique-core' ),
			'priority' => 85,
			'advance' => true,
			'children' => array(
				'page_title_background_color',
				'page_title_background_opacity',
				'page_title_background_image',
				'page_title_background_repeat',
				'page_title_background_size',
				'page_title_background_position'
			)
		) ) );


		$wp_customize->add_setting( 'page_title_background_color', array(
			'default' => $defaults['page_title_background_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'page_title_background_color', array (
			'section' => 'fabrique_page_title_section',
			'settings' => 'page_title_background_color',
			'label' => esc_html__( 'Page Title Background Color', 'fabrique-core' ),
			'priority' => 90
		) ) );


		$wp_customize->add_setting( 'page_title_background_opacity', array(
			'default' => $defaults['page_title_background_opacity'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'page_title_background_opacity', array (
			'section' => 'fabrique_page_title_section',
			'settings' => 'page_title_background_opacity',
			'label' => esc_html__( 'Page Title Background Opacity (%)', 'fabrique-core' ),
			'description' => esc_html__( "This option will not take effect on 'default' background color" , 'fabrique-core' ),
			'priority' => 100,
			'min' => 0,
			'max' => 100
		) ) );


		$wp_customize->add_setting( 'page_title_background_image', array(
			'default' => $defaults['page_title_background_image'],
			'sanitize_callback' => 'fabrique_core_sanitize_url_value'
		) );

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'page_title_background_image', array (
			'section' => 'fabrique_page_title_section',
			'settings' => 'page_title_background_image',
			'label' => esc_html__( 'Background Image', 'fabrique-core' ),
			'priority' => 110
		) ) );


		$wp_customize->add_setting( 'page_title_background_repeat', array(
			'default' => $defaults['page_title_background_repeat'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'page_title_background_repeat', array(
			'section' => 'fabrique_page_title_section',
			'settings' => 'page_title_background_repeat',
			'label' => esc_html__( 'Background Repeat', 'fabrique-core' ),
			'priority' => 120,
			'type' => 'select',
			'choices' => array(
				'repeat' => esc_html__( 'Repeat', 'fabrique-core' ),
				'repeat-x' => esc_html__( 'Repeat-x', 'fabrique-core' ),
				'repeat-y' => esc_html__( 'Repeat-y', 'fabrique-core' ),
				'no-repeat' => esc_html__( 'No Repeat', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'page_title_background_size', array(
			'default' => $defaults['page_title_background_size'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'page_title_background_size', array(
			'section' => 'fabrique_page_title_section',
			'settings' => 'page_title_background_size',
			'label' => esc_html__( 'Background Size', 'fabrique-core' ),
			'priority' => 130,
			'type' => 'select',
			'choices' => array(
				'auto' => esc_html__( 'Auto', 'fabrique-core' ),
				'cover' => esc_html__( 'Cover', 'fabrique-core' ),
				'contain' => esc_html__( 'Contain', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'page_title_background_position', array(
			'default' => $defaults['page_title_background_position'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'page_title_background_position', array(
			'section' => 'fabrique_page_title_section',
			'settings' => 'page_title_background_position',
			'label' => esc_html__( 'Background Position', 'fabrique-core' ),
			'priority' => 140,
			'type' => 'select',
			'choices' => array(
				'left top' => esc_html__( 'Left Top', 'fabrique-core' ),
				'left center' => esc_html__( 'Left Center', 'fabrique-core' ),
				'left bottom' => esc_html__( 'Left Bottom', 'fabrique-core' ),
				'right top' => esc_html__( 'Right Top', 'fabrique-core' ),
				'right center' => esc_html__( 'Right Center', 'fabrique-core' ),
				'right bottom' => esc_html__( 'Right Bottom', 'fabrique-core' ),
				'center top' => esc_html__( 'Center Top', 'fabrique-core' ),
				'center center' => esc_html__( 'Center Center', 'fabrique-core' ),
				'center bottom' => esc_html__( 'Center Bottom', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'page_title_label_section', array(
			'default' => $defaults['page_title_label_section'],
			'transport' => 'postMessage',
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'page_title_label_section', array (
			'section' => 'fabrique_page_title_section',
			'settings' => 'page_title_label_section',
			'label' => esc_html__( 'Page Title Label', 'fabrique-core' ),
			'priority' => 150,
			'advance' => true,
			'children' => array(
				'page_title_blog_label',
				'page_title_shop_label',
				'page_title_archive_label',
				'page_title_category_label',
				'page_title_tag_label',
				'page_title_search_label',
				'page_title_author_label',
				'page_title_day_label',
				'page_title_month_label',
				'page_title_year_label'
			)
		) ) );


		$wp_customize->add_setting( 'page_title_blog_label', array(
			'default' => $defaults['page_title_blog_label'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'page_title_blog_label', array(
			'section' => 'fabrique_page_title_section',
			'settings' => 'page_title_blog_label',
			'label' => esc_html__( 'Blog Page Title', 'fabrique-core' ),
			'priority' => 160,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'page_title_shop_label', array(
			'default' => $defaults['page_title_shop_label'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'page_title_shop_label', array(
			'section' => 'fabrique_page_title_section',
			'settings' => 'page_title_shop_label',
			'label' => esc_html__( 'Shop Page Title', 'fabrique-core' ),
			'priority' => 180,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'page_title_archive_label', array(
			'default' => $defaults['page_title_archive_label'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'page_title_archive_label', array(
			'section' => 'fabrique_page_title_section',
			'settings' => 'page_title_archive_label',
			'label' => esc_html__( 'Archive/Taxonomy Page Title', 'fabrique-core' ),
			'priority' => 190,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'page_title_category_label', array(
			'default' => $defaults['page_title_category_label'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'page_title_category_label', array(
			'section' => 'fabrique_page_title_section',
			'settings' => 'page_title_category_label',
			'label' => esc_html__( 'Category Page Title', 'fabrique-core' ),
			'priority' => 200,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'page_title_tag_label', array(
			'default' => $defaults['page_title_tag_label'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'page_title_tag_label', array(
			'section' => 'fabrique_page_title_section',
			'settings' => 'page_title_tag_label',
			'label' => esc_html__( 'Tag Page Title', 'fabrique-core' ),
			'priority' => 210,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'page_title_search_label', array(
			'default' => $defaults['page_title_search_label'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'page_title_search_label', array(
			'section' => 'fabrique_page_title_section',
			'settings' => 'page_title_search_label',
			'label' => esc_html__( 'Search Result Page Title', 'fabrique-core' ),
			'priority' => 215,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'page_title_author_label', array(
			'default' => $defaults['page_title_author_label'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'page_title_author_label', array(
			'section' => 'fabrique_page_title_section',
			'settings' => 'page_title_author_label',
			'label' => esc_html__( 'Author Page Title', 'fabrique-core' ),
			'priority' => 220,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'page_title_day_label', array(
			'default' => $defaults['page_title_day_label'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'page_title_day_label', array(
			'section' => 'fabrique_page_title_section',
			'settings' => 'page_title_day_label',
			'label' => esc_html__( 'Day Page Title', 'fabrique-core' ),
			'priority' => 230,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'page_title_month_label', array(
			'default' => $defaults['page_title_month_label'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'page_title_month_label', array(
			'section' => 'fabrique_page_title_section',
			'settings' => 'page_title_month_label',
			'label' => esc_html__( 'Month Page Title', 'fabrique-core' ),
			'priority' => 240,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'page_title_year_label', array(
			'default' => $defaults['page_title_year_label'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'page_title_year_label', array(
			'section' => 'fabrique_page_title_section',
			'settings' => 'page_title_year_label',
			'label' => esc_html__( 'Year Page Title', 'fabrique-core' ),
			'priority' => 250,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'blog_subtitle', array(
			'default' => $defaults['blog_subtitle'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'blog_subtitle', array(
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_subtitle',
			'label' => esc_html__( "Page title's subtitle", 'fabrique-core' ),
			'description' => esc_html__( "Tip: Leave this blank to disable", 'fabrique-core' ),
			'priority' => 5,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'blog_custom_archive', array(
			'default' => $defaults['blog_custom_archive'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Text_Control( $wp_customize, 'blog_custom_archive', array (
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_custom_archive',
			'label' => esc_html__( 'Custom Blog Page ID', 'fabrique-core' ),
			'description' => esc_html__( 'Leave blank to use default blog index page with below settings.', 'fabrique-core' ),
			'priority' => 7,
		) ) );


		$wp_customize->add_setting( 'blog_full_width', array(
			'default' => $defaults['blog_full_width'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'blog_full_width', array (
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_full_width',
			'label' => esc_html__( 'Full Width', 'fabrique-core' ),
			'priority' => 9
		) ) );


		$wp_customize->add_setting( 'blog_style', array(
			'default' => $defaults['blog_style'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'blog_style', array (
			'radio_type' => 'image',
			'radio_style' => 'box',
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_style',
			'label' => esc_html__( 'Style', 'fabrique-core' ),
			'priority' => 10,
			'names' => array (
				'plain' => esc_html__( 'Plain', 'fabrique-core' ),
				'shadow' => esc_html__( 'Shadow', 'fabrique-core' ),
				'gradient' => esc_html__( 'Gradient', 'fabrique-core' )
			),
			'choices' => array(
				'plain' => 'customize-blog-plain',
				'shadow' => 'customize-blog-shadow',
				'gradient' => 'customize-blog-gradient'
			)
		) ) );


		$wp_customize->add_setting( 'blog_layout', array(
			'default' => $defaults['blog_layout'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'blog_layout', array (
			'radio_type' => 'image',
			'radio_style' => 'box',
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_layout',
			'label' => esc_html__( 'Layout', 'fabrique-core' ),
			'priority' => 20,
			'names' => array (
				'grid' => esc_html__( 'Grid', 'fabrique-core' ),
				'masonry' => esc_html__( 'Masonry', 'fabrique-core' ),
				'list' => esc_html__( 'List', 'fabrique-core' )
			),
			'choices' => array(
				'grid' => 'customize-blog-grid',
				'masonry' =>  'customize-blog-masonry',
				'list' => 'customize-blog-list'
			),
			'children' => array(
				'list' => array(
					'blog_list_thumbnail_size'
				),
				'grid' => array(
					'blog_columns'
				),
				'masonry' => array(
					'blog_columns'
				)
			)
		) ) );


		$wp_customize->add_setting( 'blog_list_thumbnail_size', array(
			'default' => $defaults['blog_list_thumbnail_size'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'blog_list_thumbnail_size', array(
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_list_thumbnail_size',
			'label' => esc_html__( 'List thumbnail size', 'fabrique-core' ),
			'priority' => 25,
			'type' => 'select',
			'choices' => array(
				'small' => esc_html__( 'Small', 'fabrique-core' ),
				'medium' => esc_html__( 'Medium', 'fabrique-core' ),
				'large' => esc_html__( 'Large', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'blog_columns', array(
			'default' => $defaults['blog_columns'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'blog_columns', array(
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_columns',
			'label' => esc_html__( 'No. Of Columns', 'fabrique-core' ),
			'priority' => 30,
			'type' => 'select',
			'choices' => array(
				1 => '1',
				2 => '2',
				3 => '3',
				4 => '4',
				5 => '5',
				6 => '6'
			)
		) );


		$wp_customize->add_setting( 'blog_alignment', array(
			'default' => $defaults['blog_alignment'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'blog_alignment', array (
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_alignment',
			'label' => esc_html__( 'Entry Alignment', 'fabrique-core' ),
			'priority' => 40,
			'choices' => array(
				'left' => esc_html__( 'Left', 'fabrique-core' ),
				'center' => esc_html__( 'Center', 'fabrique-core' ),
				'right' => esc_html__( 'Right', 'fabrique-core' )
			)
		) ) );


		$wp_customize->add_setting( 'blog_featured_media', array(
			'default' => $defaults['blog_featured_media'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'blog_featured_media', array (
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_featured_media',
			'label' => esc_html__( 'Featured Media', 'fabrique-core' ),
			'priority' => 50,
			'choices' => array(
				'auto' => esc_html__( 'Auto', 'fabrique-core' ),
				'image' => esc_html__( 'Image', 'fabrique-core' )
			)
		) ) );


		$wp_customize->add_setting( 'blog_image_size', array(
			'default' => $defaults['blog_image_size'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'blog_image_size', array(
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_image_size',
			'label' => esc_html__( 'Image Size', 'fabrique-core' ),
			'description' => esc_html__( "see the size's detail in admin panel settings > media", 'fabrique-core' ),
			'priority' => 60,
			'type' => 'select',
			'choices' => $image_sizes
		) );


		$wp_customize->add_setting( 'blog_image_ratio', array(
			'default' => $defaults['blog_image_ratio'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'blog_image_ratio', array(
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_image_ratio',
			'label' => esc_html__( 'Image Ratio', 'fabrique-core' ),
			'priority' => 70,
			'type' => 'select',
			'choices' => array(
				'auto' => esc_html__( 'Original', 'fabrique-core' ),
				'1x1' => '1 : 1',
				'3x2' => '3 : 2',
				'2x3' => '2 : 3',
				'4x3' => '4 : 3',
				'3x4' => '3 : 4',
				'16x9' => '16 : 9'
			)
		) );


		$wp_customize->add_setting( 'blog_image_hover', array(
			'default' => $defaults['blog_image_hover'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'blog_image_hover', array(
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_image_hover',
			'label' => esc_html__( 'Image Hover Effect', 'fabrique-core' ),
			'priority' => 80,
			'type' => 'select',
			'choices' => array(
				'none' => esc_html__( 'None', 'fabrique-core' ),
				'zoom' => esc_html__( 'Zoom', 'fabrique-core' ),
				'slowzoom' => esc_html__( 'Slow Zoom', 'fabrique-core' ),
				'blur' => esc_html__( 'Blur', 'fabrique-core' ),
				'rotate' => esc_html__( 'Rotate', 'fabrique-core' ),
				'colorize' => esc_html__( 'Colorize', 'fabrique-core' ),
				'greyscale' => esc_html__( 'Greyscale', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'blog_border', array(
			'default' => $defaults['blog_border'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'blog_border', array (
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_border',
			'label' => esc_html__( 'Entry Border', 'fabrique-core' ),
			'priority' => 100
		) ) );


		$wp_customize->add_setting( 'blog_color_section', array(
			'default' => $defaults['blog_color_section'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Section_Control( $wp_customize, 'blog_color_section', array (
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_color_section',
			'label' => esc_html__( 'Color', 'fabrique-core' ),
			'priority' => 110
		) ) );


		$wp_customize->add_setting( 'blog_color_scheme', array(
			'default' => $defaults['blog_color_scheme'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'blog_color_scheme', array (
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_color_scheme',
			'label' => esc_html__( 'Entry Color Scheme', 'fabrique-core' ),
			'priority' => 120,
			'choices' => array(
				'default' => esc_html__( 'Default', 'fabrique-core' ),
				'light' => esc_html__( 'Light', 'fabrique-core' ),
				'dark' => esc_html__( 'Dark', 'fabrique-core' ),
			)
		) ) );


		$wp_customize->add_setting( 'blog_background', array(
			'default' => $defaults['blog_background'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'blog_background', array (
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_background',
			'label' => esc_html__( 'Background Color', 'fabrique-core' ),
			'priority' => 130
		) ) );


		$wp_customize->add_setting( 'blog_opacity', array(
			'default' => $defaults['blog_opacity'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'blog_opacity', array (
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_opacity',
			'label' => esc_html__( 'Background Opacity (%)', 'fabrique-core' ),
			'priority' => 140,
			'min' => 0,
			'max' => 100
		) ) );

		$wp_customize->add_setting( 'blog_spacing_section', array(
			'default' => $defaults['blog_spacing_section'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Section_Control( $wp_customize, 'blog_spacing_section', array (
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_spacing_section',
			'label' => esc_html__( 'Spacing', 'fabrique-core' ),
			'priority' => 150
		) ) );


		$wp_customize->add_setting( 'blog_spacing', array(
			'default' => $defaults['blog_spacing'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'blog_spacing', array (
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_spacing',
			'label' => esc_html__( 'Entry Gutter Spacing (px)', 'fabrique-core' ),
			'description' => esc_html__( 'Spacing between each entry.', 'fabrique-core' ),
			'priority' => 160,
			'min' => 0,
			'max' => 100
		) ) );


		$wp_customize->add_setting( 'blog_inner_spacing', array(
			'default' => $defaults['blog_inner_spacing'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'blog_inner_spacing', array (
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_inner_spacing',
			'label' => esc_html__( 'Entry Inner Spacing (px)', 'fabrique-core' ),
			'description' => esc_html__( 'Spacing inside each entry content.', 'fabrique-core' ),
			'priority' => 170,
			'min' => 0,
			'max' => 100
		) ) );


		$wp_customize->add_setting( 'blog_typography_section', array(
			'default' => $defaults['blog_typography_section'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Section_Control( $wp_customize, 'blog_typography_section', array (
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_typography_section',
			'label' => esc_html__( 'Typography', 'fabrique-core' ),
			'priority' => 180
		) ) );


		$wp_customize->add_setting( 'blog_title_uppercase', array(
			'default' => $defaults['blog_title_uppercase'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'blog_title_uppercase', array (
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_title_uppercase',
			'label' => esc_html__( 'Title Uppercase', 'fabrique-core' ),
			'priority' => 190
		) ) );


		$wp_customize->add_setting( 'blog_title_font_size', array(
			'default' => $defaults['blog_title_font_size'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'blog_title_font_size', array (
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_title_font_size',
			'label' => esc_html__( 'Entry Title Font Size (px)', 'fabrique-core' ),
			'priority' => 200,
			'min' => 10,
			'max' => 60
		) ) );


		$wp_customize->add_setting( 'blog_title_letter_spacing', array(
			'default' => $defaults['blog_title_letter_spacing'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Text_Control( $wp_customize, 'blog_title_letter_spacing', array (
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_title_letter_spacing',
			'label' => esc_html__( 'Title Letter Spacing (em)', 'fabrique-core' ),
			'description' => esc_html__( 'Leave blank for default.', 'fabrique-core' ),
			'priority' => 210,
		) ) );


		$wp_customize->add_setting( 'blog_title_line_height', array(
			'default' => $defaults['blog_title_line_height'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Text_Control( $wp_customize, 'blog_title_line_height', array (
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_title_line_height',
			'label' => esc_html__( 'Title Line Height', 'fabrique-core' ),
			'description' => esc_html__( 'Leave blank for default.', 'fabrique-core' ),
			'priority' => 220,
		) ) );


		$wp_customize->add_setting( 'blog_advance_section', array(
			'default' => $defaults['blog_advance_section'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Section_Control( $wp_customize, 'blog_advance_section', array (
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_advance_section',
			'label' => esc_html__( 'Blog Advance', 'fabrique-core' ),
			'priority' => 225
		) ) );


		$wp_customize->add_setting( 'blog_load', array(
			'default' => $defaults['blog_load'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'blog_load', array(
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_load',
			'label' => esc_html__( 'Pagination Style', 'fabrique-core' ),
			'priority' => 230,
			'type' => 'select',
			'choices' => array(
				'pagination' => esc_html__( 'Pagination', 'fabrique-core' ),
				'click' => esc_html__( 'Click To Load', 'fabrique-core' ),
				'scroll' => esc_html__( 'Scroll To Load', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'blog_filter', array(
			'default' => $defaults['blog_filter'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'blog_filter', array (
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_filter',
			'label' => esc_html__( 'Show Filter Bar', 'fabrique-core' ),
			'priority' => 240,
			'children' => array(
				'blog_filter_alignment',
				'blog_filter_sorting'
			)
		) ) );


		$wp_customize->add_setting( 'blog_filter_alignment', array(
			'default' => $defaults['blog_filter_alignment'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'blog_filter_alignment', array (
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_filter_alignment',
			'label' => esc_html__( 'Blog Filter Alignment', 'fabrique-core' ),
			'priority' => 250,
			'choices' => array(
				'left' => esc_html__( 'Left', 'fabrique-core' ),
				'center' => esc_html__( 'Center', 'fabrique-core' ),
				'right' => esc_html__( 'Right', 'fabrique-core' )
			)
		) ) );


		$wp_customize->add_setting( 'blog_filter_sorting', array(
			'default' => $defaults['blog_filter_sorting'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'blog_filter_sorting', array(
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_filter_sorting',
			'label' => esc_html__( 'Filter Sorting', 'fabrique-core' ),
			'priority' => 260,
			'type' => 'select',
			'choices' => array(
				'default' => esc_html__( 'Post Order', 'fabrique-core' ),
				'char_asc' => esc_html__( 'A - Z', 'fabrique-core' ),
				'char_desc' => esc_html__( 'Z - A', 'fabrique-core' ),
				'custom_order' => esc_html__( 'Custom Order', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'blog_excerpt_content', array(
			'default' => $defaults['blog_excerpt_content'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'blog_excerpt_content', array(
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_excerpt_content',
			'label' => esc_html__( 'Excerpt Message', 'fabrique-core' ),
			'description' => esc_html__( "Use post excerpt or post content as an entry's excerpt. Don't forget to put <!--more--> in the post when use the content.", 'fabrique-core' ),
			'priority' => 270,
			'type' => 'select',
			'choices' => array(
				'excerpt' => esc_html__( 'Use Excerpt', 'fabrique-core' ),
				'content' => esc_html__( 'Use Content', 'fabrique-core' ),
			)
		) );


		$wp_customize->add_setting( 'blog_excerpt_length', array(
			'default' => $defaults['blog_excerpt_length'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Text_Control( $wp_customize, 'blog_excerpt_length', array (
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_excerpt_length',
			'label' => esc_html__( 'Excerpt Length', 'fabrique-core' ),
			'description' => esc_html__( "Input no. of characters to limit excerpt length", 'fabrique-core' ),
			'priority' => 280
		) ) );


		$wp_customize->add_setting( 'blog_more_icon_position', array(
			'default' => $defaults['blog_more_icon_position'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'blog_more_icon_position', array (
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_more_icon_position',
			'label' => esc_html__( 'Read More Icon Position', 'fabrique-core' ),
			'priority' => 285,
			'choices' => array(
				'before' => esc_html__( 'Before', 'fabrique-core' ),
				'after' => esc_html__( 'After', 'fabrique-core' )
			)
		) ) );


		$wp_customize->add_setting( 'blog_more_message', array(
			'default' => $defaults['blog_more_message'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'blog_more_message', array(
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_more_message',
			'label' => esc_html__( 'Read More Message', 'fabrique-core' ),
			'description' => esc_html__( "change to your own 'Read More' link message", 'fabrique-core' ),
			'priority' => 290,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'blog_link', array(
			'default' => $defaults['blog_link'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'blog_link', array(
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_link',
			'label' => esc_html__( 'Entry Link To', 'fabrique-core' ),
			'priority' => 300,
			'type' => 'select',
			'choices' => array(
				'post' => esc_html__( 'Single Post', 'fabrique-core' ),
				'alternate' => esc_html__( 'Alternate Link', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'blog_link_new_tab', array(
			'default' => $defaults['blog_link_new_tab'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'blog_link_new_tab', array (
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_link_new_tab',
			'label' => esc_html__( 'Open link in new tab', 'fabrique-core' ),
			'priority' => 305
		) ) );


		$wp_customize->add_setting( 'blog_component', array(
			'default' => $defaults['blog_component'],
			'sanitize_callback' => 'fabrique_core_sanitize_component_value'
		) );

		$wp_customize->add_control( new Fabrique_Component_Control( $wp_customize, 'blog_component', array (
			'section' => 'fabrique_blog_section',
			'settings' => 'blog_component',
			'label' => esc_html__( 'Entry Component', 'fabrique-core' ),
			'choices' => array(
				'media' => esc_html__( 'Media', 'fabrique-core' ),
				'author' => esc_html__( 'Author', 'fabrique-core' ),
				'category' => esc_html__( 'Category', 'fabrique-core' ),
				'tag' => esc_html__( 'Tag', 'fabrique-core' ),
				'title' => esc_html__( 'Title', 'fabrique-core' ),
				'excerpt' => esc_html__( 'Excerpt', 'fabrique-core' ),
				'comment' => esc_html__( 'Comment', 'fabrique-core' ),
				'date' => esc_html__( 'Date', 'fabrique-core' ),
				'link' => esc_html__( 'Link', 'fabrique-core' ),
			),
			'priority' => 310
		) ) );


		$wp_customize->add_setting( 'project_slug', array(
			'default' => $defaults['project_slug'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'project_slug', array(
			'section' => 'fabrique_project_section',
			'settings' => 'project_slug',
			'label' => esc_html__( 'Custom Slug', 'fabrique-core' ),
			'description' => esc_html__( 'After update this option, go to Setting -> Permalinks and "save" to update', 'fabrique-core' ),
			'priority' => 10,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'project_custom_archive', array(
			'default' => $defaults['project_custom_archive'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Text_Control( $wp_customize, 'project_custom_archive', array (
			'section' => 'fabrique_project_section',
			'settings' => 'project_custom_archive',
			'label' => esc_html__( 'Custom Project Page ID', 'fabrique-core' ),
			'description' => esc_html__( 'Leave blank to use default archive page with below settings.', 'fabrique-core' ),
			'priority' => 20
		) ) );


		$wp_customize->add_setting( 'project_subtitle', array(
			'default' => $defaults['project_subtitle'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'project_subtitle', array(
			'section' => 'fabrique_project_section',
			'settings' => 'project_subtitle',
			'label' => esc_html__( "Page title's subtitle", 'fabrique-core' ),
			'description' => esc_html__( "Tip: Leave this blank to disable", 'fabrique-core' ),
			'priority' => 30,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'project_items', array(
			'default' => $defaults['project_items'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Text_Control( $wp_customize, 'project_items', array (
			'section' => 'fabrique_project_section',
			'settings' => 'project_items',
			'label' => esc_html__( 'No. of Project per page', 'fabrique-core' ),
			'priority' => 40,
		) ) );


		$wp_customize->add_setting( 'project_full_width', array(
			'default' => $defaults['project_full_width'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'project_full_width', array (
			'section' => 'fabrique_project_section',
			'settings' => 'project_full_width',
			'label' => esc_html__( 'Full Width', 'fabrique-core' ),
			'priority' => 50
		) ) );


		$wp_customize->add_setting( 'project_style', array(
			'default' => $defaults['project_style'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'project_style', array (
			'radio_type' => 'image',
			'radio_style' => 'box',
			'section' => 'fabrique_project_section',
			'settings' => 'project_style',
			'label' => esc_html__( 'Style', 'fabrique-core' ),
			'priority' => 60,
			'names' => array (
				'plain' => esc_html__( 'Plain', 'fabrique-core' ),
				'shadow' => esc_html__( 'Shadow', 'fabrique-core' ),
				'gradient' => esc_html__( 'Gradient', 'fabrique-core' )
			),
			'choices' => array(
				'plain' => 'customize-blog-plain',
				'shadow' => 'customize-blog-shadow',
				'gradient' => 'customize-blog-gradient'
			)
		) ) );


		$wp_customize->add_setting( 'project_layout', array(
			'default' => $defaults['project_layout'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'project_layout', array (
			'radio_type' => 'image',
			'radio_style' => 'box',
			'section' => 'fabrique_project_section',
			'settings' => 'project_layout',
			'label' => esc_html__( 'Layout', 'fabrique-core' ),
			'priority' => 70,
			'names' => array (
				'grid' => esc_html__( 'Grid', 'fabrique-core' ),
				'masonry' => esc_html__( 'Masonry', 'fabrique-core' ),
				'list' => esc_html__( 'List', 'fabrique-core' )
			),
			'choices' => array(
				'grid' => 'customize-blog-grid',
				'masonry' =>  'customize-blog-masonry',
				'list' => 'customize-blog-list'
			),
			'children' => array(
				'list' => array(
					'project_list_thumbnail_size'
				),
				'grid' => array(
					'project_columns'
				),
				'masonry' => array(
					'project_columns'
				)
			)
		) ) );


		$wp_customize->add_setting( 'project_list_thumbnail_size', array(
			'default' => $defaults['project_list_thumbnail_size'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'project_list_thumbnail_size', array(
			'section' => 'fabrique_project_section',
			'settings' => 'project_list_thumbnail_size',
			'label' => esc_html__( 'List thumbnail size', 'fabrique-core' ),
			'priority' => 75,
			'type' => 'select',
			'choices' => array(
				'small' => esc_html__( 'Small', 'fabrique-core' ),
				'medium' => esc_html__( 'Medium', 'fabrique-core' ),
				'large' => esc_html__( 'Large', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'project_columns', array(
			'default' => $defaults['project_columns'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'project_columns', array(
			'section' => 'fabrique_project_section',
			'settings' => 'project_columns',
			'label' => esc_html__( 'No. Of Columns', 'fabrique-core' ),
			'priority' => 80,
			'type' => 'select',
			'choices' => array(
				1 => '1',
				2 => '2',
				3 => '3',
				4 => '4',
				5 => '5',
				6 => '6'
			)
		) );


		$wp_customize->add_setting( 'project_alignment', array(
			'default' => $defaults['project_alignment'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'project_alignment', array (
			'section' => 'fabrique_project_section',
			'settings' => 'project_alignment',
			'label' => esc_html__( 'Entry Alignment', 'fabrique-core' ),
			'priority' => 90,
			'choices' => array(
				'left' => esc_html__( 'Left', 'fabrique-core' ),
				'center' => esc_html__( 'Center', 'fabrique-core' ),
				'right' => esc_html__( 'Right', 'fabrique-core' )
			)
		) ) );


		$wp_customize->add_setting( 'project_image_size', array(
			'default' => $defaults['project_image_size'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'project_image_size', array(
			'section' => 'fabrique_project_section',
			'settings' => 'project_image_size',
			'label' => esc_html__( 'Image Size', 'fabrique-core' ),
			'description' => esc_html__( "see the size's detail in admin panel settings > media", 'fabrique-core' ),
			'priority' => 100,
			'type' => 'select',
			'choices' => $image_sizes
		) );


		$wp_customize->add_setting( 'project_image_ratio', array(
			'default' => $defaults['project_image_ratio'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'project_image_ratio', array(
			'section' => 'fabrique_project_section',
			'settings' => 'project_image_ratio',
			'label' => esc_html__( 'Image Ratio', 'fabrique-core' ),
			'priority' => 110,
			'type' => 'select',
			'choices' => array(
				'auto' => esc_html__( 'Original', 'fabrique-core' ),
				'1x1' => '1 : 1',
				'3x2' => '3 : 2',
				'2x3' => '2 : 3',
				'4x3' => '4 : 3',
				'3x4' => '3 : 4',
				'16x9' => '16 : 9'
			)
		) );


		$wp_customize->add_setting( 'project_image_hover', array(
			'default' => $defaults['project_image_hover'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'project_image_hover', array(
			'section' => 'fabrique_project_section',
			'settings' => 'project_image_hover',
			'label' => esc_html__( 'Image Hover Effect', 'fabrique-core' ),
			'priority' => 120,
			'type' => 'select',
			'choices' => array(
				'none' => esc_html__( 'None', 'fabrique-core' ),
				'zoom' => esc_html__( 'Zoom', 'fabrique-core' ),
				'slowzoom' => esc_html__( 'Slow Zoom', 'fabrique-core' ),
				'blur' => esc_html__( 'Blur', 'fabrique-core' ),
				'rotate' => esc_html__( 'Rotate', 'fabrique-core' ),
				'colorize' => esc_html__( 'Colorize', 'fabrique-core' ),
				'greyscale' => esc_html__( 'Greyscale', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'project_border', array(
			'default' => $defaults['project_border'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'project_border', array (
			'section' => 'fabrique_project_section',
			'settings' => 'project_border',
			'label' => esc_html__( 'Entry Border', 'fabrique-core' ),
			'priority' => 140
		) ) );


		$wp_customize->add_setting( 'project_sidebar', array(
			'default' => $defaults['project_sidebar'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'project_sidebar', array (
			'section' => 'fabrique_project_section',
			'settings' => 'project_sidebar',
			'label' => esc_html__( 'Sidebar', 'fabrique-core' ),
			'priority' => 150,
			'children' => array(
				'project_sidebar_position',
				'project_sidebar_select',
				'project_sidebar_fixed'
			)
		) ) );


		$wp_customize->add_setting( 'project_sidebar_position', array(
			'default' => $defaults['project_sidebar_position'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'project_sidebar_position', array (
			'section' => 'fabrique_project_section',
			'settings' => 'project_sidebar_position',
			'label' => esc_html__( 'Sidebar Position', 'fabrique-core' ),
			'priority' => 160,
			'choices' => array(
				'left' => esc_html__( 'Left', 'fabrique-core' ),
				'right' => esc_html__( 'Right', 'fabrique-core' )
			)
		) ) );


		$wp_customize->add_setting( 'project_sidebar_select', array(
			'default' => $defaults['project_sidebar_select'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Select_Control( $wp_customize, 'project_sidebar_select', array (
			'select_type' => 'sidebar',
			'section' => 'fabrique_project_section',
			'settings' => 'project_sidebar_select',
			'label' => esc_html__( 'Select A Sidebar', 'fabrique-core' ),
			'priority' => 170
		) ) );


		$wp_customize->add_setting( 'project_sidebar_fixed', array(
			'default' => $defaults['project_sidebar_fixed'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'project_sidebar_fixed', array (
			'section' => 'fabrique_project_section',
			'settings' => 'project_sidebar_fixed',
			'label' => esc_html__( 'Fixed Sidebar', 'fabrique-core' ),
			'priority' => 180
		) ) );


		$wp_customize->add_setting( 'project_color_section', array(
			'default' => $defaults['project_color_section'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Section_Control( $wp_customize, 'project_color_section', array (
			'section' => 'fabrique_project_section',
			'settings' => 'project_color_section',
			'label' => esc_html__( 'Color', 'fabrique-core' ),
			'priority' => 190
		) ) );


		$wp_customize->add_setting( 'project_color_scheme', array(
			'default' => $defaults['project_color_scheme'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'project_color_scheme', array (
			'section' => 'fabrique_project_section',
			'settings' => 'project_color_scheme',
			'label' => esc_html__( 'Entry Color Scheme', 'fabrique-core' ),
			'priority' => 200,
			'choices' => array(
				'default' => esc_html__( 'Default', 'fabrique-core' ),
				'light' => esc_html__( 'Light', 'fabrique-core' ),
				'dark' => esc_html__( 'Dark', 'fabrique-core' ),
			)
		) ) );


		$wp_customize->add_setting( 'project_background', array(
			'default' => $defaults['project_background'],
			'sanitize_callback' => 'fabrique_core_sanitize_color_value'
		) );

		$wp_customize->add_control( new Fabrique_Color_Control( $wp_customize, 'project_background', array (
			'section' => 'fabrique_project_section',
			'settings' => 'project_background',
			'label' => esc_html__( 'Background Color', 'fabrique-core' ),
			'priority' => 210
		) ) );


		$wp_customize->add_setting( 'project_opacity', array(
			'default' => $defaults['project_opacity'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'project_opacity', array (
			'section' => 'fabrique_project_section',
			'settings' => 'project_opacity',
			'label' => esc_html__( 'Background Opacity (%)', 'fabrique-core' ),
			'priority' => 220,
			'min' => 0,
			'max' => 100
		) ) );

		$wp_customize->add_setting( 'project_spacing_section', array(
			'default' => $defaults['project_spacing_section'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Section_Control( $wp_customize, 'project_spacing_section', array (
			'section' => 'fabrique_project_section',
			'settings' => 'project_spacing_section',
			'label' => esc_html__( 'Spacing', 'fabrique-core' ),
			'priority' => 230
		) ) );


		$wp_customize->add_setting( 'project_spacing', array(
			'default' => $defaults['project_spacing'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'project_spacing', array (
			'section' => 'fabrique_project_section',
			'settings' => 'project_spacing',
			'label' => esc_html__( 'Entry Gutter Spacing (px)', 'fabrique-core' ),
			'description' => esc_html__( 'Spacing between each entry.', 'fabrique-core' ),
			'priority' => 240,
			'min' => 0,
			'max' => 100
		) ) );


		$wp_customize->add_setting( 'project_inner_spacing', array(
			'default' => $defaults['project_inner_spacing'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'project_inner_spacing', array (
			'section' => 'fabrique_project_section',
			'settings' => 'project_inner_spacing',
			'label' => esc_html__( 'Entry Inner Spacing (px)', 'fabrique-core' ),
			'description' => esc_html__( 'Spacing inside each entry content.', 'fabrique-core' ),
			'priority' => 250,
			'min' => 0,
			'max' => 100
		) ) );


		$wp_customize->add_setting( 'project_typography_section', array(
			'default' => $defaults['project_typography_section'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Section_Control( $wp_customize, 'project_typography_section', array (
			'section' => 'fabrique_project_section',
			'settings' => 'project_typography_section',
			'label' => esc_html__( 'Typography', 'fabrique-core' ),
			'priority' => 260
		) ) );


		$wp_customize->add_setting( 'project_title_uppercase', array(
			'default' => $defaults['project_title_uppercase'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'project_title_uppercase', array (
			'section' => 'fabrique_project_section',
			'settings' => 'project_title_uppercase',
			'label' => esc_html__( 'Title Uppercase', 'fabrique-core' ),
			'priority' => 270
		) ) );


		$wp_customize->add_setting( 'project_title_font_size', array(
			'default' => $defaults['project_title_font_size'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'project_title_font_size', array (
			'section' => 'fabrique_project_section',
			'settings' => 'project_title_font_size',
			'label' => esc_html__( 'Entry Title Font Size (px)', 'fabrique-core' ),
			'priority' => 280,
			'min' => 10,
			'max' => 60
		) ) );


		$wp_customize->add_setting( 'project_title_letter_spacing', array(
			'default' => $defaults['project_title_letter_spacing'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Text_Control( $wp_customize, 'project_title_letter_spacing', array (
			'section' => 'fabrique_project_section',
			'settings' => 'project_title_letter_spacing',
			'label' => esc_html__( 'Title Letter Spacing (em)', 'fabrique-core' ),
			'description' => esc_html__( 'Leave blank for default.', 'fabrique-core' ),
			'priority' => 290,
		) ) );


		$wp_customize->add_setting( 'project_title_line_height', array(
			'default' => $defaults['project_title_line_height'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Text_Control( $wp_customize, 'project_title_line_height', array (
			'section' => 'fabrique_project_section',
			'settings' => 'project_title_line_height',
			'label' => esc_html__( 'Title Line Height', 'fabrique-core' ),
			'description' => esc_html__( 'Leave blank for default.', 'fabrique-core' ),
			'priority' => 300,
		) ) );


		$wp_customize->add_setting( 'project_advance_section', array(
			'default' => $defaults['project_advance_section'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Section_Control( $wp_customize, 'project_advance_section', array (
			'section' => 'fabrique_project_section',
			'settings' => 'project_advance_section',
			'label' => esc_html__( 'Typography', 'fabrique-core' ),
			'priority' => 310
		) ) );


		$wp_customize->add_setting( 'project_load', array(
			'default' => $defaults['project_load'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'project_load', array(
			'section' => 'fabrique_project_section',
			'settings' => 'project_load',
			'label' => esc_html__( 'Pagination Style', 'fabrique-core' ),
			'priority' => 320,
			'type' => 'select',
			'choices' => array(
				'pagination' => esc_html__( 'Pagination', 'fabrique-core' ),
				'click' => esc_html__( 'Click To Load', 'fabrique-core' ),
				'scroll' => esc_html__( 'Scroll To Load', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'project_filter', array(
			'default' => $defaults['project_filter'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'project_filter', array (
			'section' => 'fabrique_project_section',
			'settings' => 'project_filter',
			'label' => esc_html__( 'Show Filter Bar', 'fabrique-core' ),
			'priority' => 330,
			'children' => array(
				'project_filter_alignment',
				'project_filter_sorting'
			)
		) ) );


		$wp_customize->add_setting( 'project_filter_alignment', array(
			'default' => $defaults['project_filter_alignment'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'project_filter_alignment', array (
			'section' => 'fabrique_project_section',
			'settings' => 'project_filter_alignment',
			'label' => esc_html__( 'Filter Alignment', 'fabrique-core' ),
			'priority' => 340,
			'choices' => array(
				'left' => esc_html__( 'Left', 'fabrique-core' ),
				'center' => esc_html__( 'Center', 'fabrique-core' ),
				'right' => esc_html__( 'Right', 'fabrique-core' )
			)
		) ) );


		$wp_customize->add_setting( 'project_filter_sorting', array(
			'default' => $defaults['project_filter_sorting'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'project_filter_sorting', array(
			'section' => 'fabrique_project_section',
			'settings' => 'project_filter_sorting',
			'label' => esc_html__( 'Filter Sorting', 'fabrique-core' ),
			'priority' => 350,
			'type' => 'select',
			'choices' => array(
				'default' => esc_html__( 'Post Order', 'fabrique-core' ),
				'char_asc' => esc_html__( 'A - Z', 'fabrique-core' ),
				'char_desc' => esc_html__( 'Z - A', 'fabrique-core' ),
				'custom_order' => esc_html__( 'Custom Order', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'project_excerpt_content', array(
			'default' => $defaults['project_excerpt_content'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'project_excerpt_content', array(
			'section' => 'fabrique_project_section',
			'settings' => 'project_excerpt_content',
			'label' => esc_html__( 'Excerpt Message', 'fabrique-core' ),
			'description' => esc_html__( "Use post excerpt or post content as an entry's excerpt. Don't forget to put <!--more--> in the post when use the content.", 'fabrique-core' ),
			'priority' => 360,
			'type' => 'select',
			'choices' => array(
				'excerpt' => esc_html__( 'Use Excerpt', 'fabrique-core' ),
				'content' => esc_html__( 'Use Content', 'fabrique-core' ),
			)
		) );


		$wp_customize->add_setting( 'project_excerpt_length', array(
			'default' => $defaults['project_excerpt_length'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Text_Control( $wp_customize, 'project_excerpt_length', array (
			'section' => 'fabrique_project_section',
			'settings' => 'project_excerpt_length',
			'label' => esc_html__( 'Excerpt Length', 'fabrique-core' ),
			'description' => esc_html__( "Input no. of characters to limit excerpt length", 'fabrique-core' ),
			'priority' => 370
		) ) );


		$wp_customize->add_setting( 'project_more_icon_position', array(
			'default' => $defaults['project_more_icon_position'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'project_more_icon_position', array (
			'section' => 'fabrique_project_section',
			'settings' => 'project_more_icon_position',
			'label' => esc_html__( 'Read More Icon Position', 'fabrique-core' ),
			'priority' => 375,
			'choices' => array(
				'before' => esc_html__( 'Before', 'fabrique-core' ),
				'after' => esc_html__( 'After', 'fabrique-core' )
			)
		) ) );


		$wp_customize->add_setting( 'project_more_message', array(
			'default' => $defaults['project_more_message'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'project_more_message', array(
			'section' => 'fabrique_project_section',
			'settings' => 'project_more_message',
			'label' => esc_html__( 'Read More Message', 'fabrique-core' ),
			'description' => esc_html__( "change to your own 'Read More' link message", 'fabrique-core' ),
			'priority' => 380,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'project_link', array(
			'default' => $defaults['project_link'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'project_link', array(
			'section' => 'fabrique_project_section',
			'settings' => 'project_link',
			'label' => esc_html__( 'Entry Link To', 'fabrique-core' ),
			'priority' => 390,
			'type' => 'select',
			'choices' => array(
				'post' => esc_html__( 'Single Post', 'fabrique-core' ),
				'alternate' => esc_html__( 'Alternate Link', 'fabrique-core' )
			)
		) );


		$wp_customize->add_setting( 'project_link_new_tab', array(
			'default' => $defaults['project_link_new_tab'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'project_link_new_tab', array (
			'section' => 'fabrique_project_section',
			'settings' => 'project_link_new_tab',
			'label' => esc_html__( 'Open link in new tab', 'fabrique-core' ),
			'priority' => 400
		) ) );


		$wp_customize->add_setting( 'project_component', array(
			'default' => $defaults['project_component'],
			'sanitize_callback' => 'fabrique_core_sanitize_component_value'
		) );

		$wp_customize->add_control( new Fabrique_Component_Control( $wp_customize, 'project_component', array (
			'section' => 'fabrique_project_section',
			'settings' => 'project_component',
			'label' => esc_html__( 'Entry Component', 'fabrique-core' ),
			'choices' => array(
				'media' => esc_html__( 'Media', 'fabrique-core' ),
				'author' => esc_html__( 'Author', 'fabrique-core' ),
				'category' => esc_html__( 'Category', 'fabrique-core' ),
				'tag' => esc_html__( 'Tag', 'fabrique-core' ),
				'title' => esc_html__( 'Title', 'fabrique-core' ),
				'excerpt' => esc_html__( 'Excerpt', 'fabrique-core' ),
				'comment' => esc_html__( 'Comment', 'fabrique-core' ),
				'date' => esc_html__( 'Date', 'fabrique-core' ),
				'link' => esc_html__( 'Link', 'fabrique-core' )
			),
			'priority' => 410
		) ) );


		$wp_customize->add_setting( 'shop_subtitle', array(
			'default' => $defaults['shop_subtitle'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'shop_subtitle', array(
			'section' => 'fabrique_shop_section',
			'settings' => 'shop_subtitle',
			'label' => esc_html__( "Shop title's subtitle", 'fabrique-core' ),
			'description' => esc_html__( "Tip: Leave this blank to disable", 'fabrique-core' ),
			'priority' => 10,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'shop_full_width', array(
			'default' => $defaults['shop_full_width'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'shop_full_width', array (
			'section' => 'fabrique_shop_section',
			'settings' => 'shop_full_width',
			'label' => esc_html__( 'Full Width', 'fabrique-core' ),
			'priority' => 20
		) ) );


		$wp_customize->add_setting( 'shop_style', array(
			'default' => $defaults['shop_style'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'shop_style', array (
			'radio_type' => 'image',
			'radio_style' => 'box',
			'section' => 'fabrique_shop_section',
			'settings' => 'shop_style',
			'label' => esc_html__( 'Style', 'fabrique-core' ),
			'priority' => 25,
			'names' => array (
				'plain' => esc_html__( 'Plain', 'fabrique-core' ),
				'shadow' => esc_html__( 'Shadow', 'fabrique-core' ),
				'gradient' => esc_html__( 'Gradient', 'fabrique-core' )
			),
			'choices' => array(
				'plain' => 'customize-blog-plain',
				'shadow' => 'customize-blog-shadow',
				'gradient' => 'customize-blog-gradient'
			)
		) ) );


		$wp_customize->add_setting( 'shop_product', array(
			'default' => $defaults['shop_product'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Text_Control( $wp_customize, 'shop_product', array (
			'section' => 'fabrique_shop_section',
			'settings' => 'shop_product',
			'label' => esc_html__( 'No. of Products per Page', 'fabrique-core' ),
			'description' => esc_html__( 'No. of Products show in shop, archive page.', 'fabrique-core' ),
			'priority' => 30,
		) ) );


		$wp_customize->add_setting( 'shop_column', array(
			'default' => $defaults['shop_column'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'shop_column', array(
			'section' => 'fabrique_shop_section',
			'settings' => 'shop_column',
			'label' => esc_html__( 'No. of Columns', 'fabrique-core' ),
			'priority' => 40,
			'type' => 'select',
			'choices' => array(
				1 => '1',
				2 => '2',
				3 => '3',
				4 => '4',
				5 => '5',
				6 => '6'
			)
		) );


		$wp_customize->add_setting( 'shop_spacing', array(
			'default' => $defaults['shop_spacing'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'shop_spacing', array (
			'section' => 'fabrique_shop_section',
			'settings' => 'shop_spacing',
			'label' => esc_html__( 'Gutter Spacing (px)', 'fabrique-core' ),
			'description' => esc_html__( 'Spacing between each entry.', 'fabrique-core' ),
			'priority' => 50,
			'min' => 0,
			'max' => 100
		) ) );


		$wp_customize->add_setting( 'shop_image_size', array(
			'default' => $defaults['shop_image_size'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'shop_image_size', array(
			'section' => 'fabrique_shop_section',
			'settings' => 'shop_image_size',
			'label' => esc_html__( 'Image Size', 'fabrique-core' ),
			'description' => esc_html__( "see the size's detail in admin panel settings > media", 'fabrique-core' ),
			'priority' => 60,
			'type' => 'select',
			'choices' => $image_sizes
		) );


		$wp_customize->add_setting( 'shop_image_ratio', array(
			'default' => $defaults['shop_image_ratio'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'shop_image_ratio', array(
			'section' => 'fabrique_shop_section',
			'settings' => 'shop_image_ratio',
			'label' => esc_html__( 'Image Ratio', 'fabrique-core' ),
			'priority' => 70,
			'type' => 'select',
			'choices' => array(
				'auto' => esc_html__( 'Original', 'fabrique-core' ),
				'1x1' => '1 : 1',
				'3x2' => '3 : 2',
				'2x3' => '2 : 3',
				'4x3' => '4 : 3',
				'3x4' => '3 : 4',
				'16x9' => '16 : 9'
			)
		) );


		$wp_customize->add_setting( 'shop_sidebar', array(
			'default' => $defaults['shop_sidebar'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'shop_sidebar', array (
			'section' => 'fabrique_shop_section',
			'settings' => 'shop_sidebar',
			'label' => esc_html__( 'Sidebar', 'fabrique-core' ),
			'priority' => 80,
			'children' => array(
				'shop_sidebar_position',
				'shop_sidebar_select',
				'shop_sidebar_fixed'
			)
		) ) );


		$wp_customize->add_setting( 'shop_sidebar_position', array(
			'default' => $defaults['shop_sidebar_position'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'shop_sidebar_position', array (
			'section' => 'fabrique_shop_section',
			'settings' => 'shop_sidebar_position',
			'label' => esc_html__( 'Sidebar Position', 'fabrique-core' ),
			'priority' => 90,
			'choices' => array(
				'left' => esc_html__( 'Left', 'fabrique-core' ),
				'right' => esc_html__( 'Right', 'fabrique-core' )
			)
		) ) );


		$wp_customize->add_setting( 'shop_sidebar_select', array(
			'default' => $defaults['shop_sidebar_select'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Select_Control( $wp_customize, 'shop_sidebar_select', array (
			'select_type' => 'sidebar',
			'section' => 'fabrique_shop_section',
			'settings' => 'shop_sidebar_select',
			'label' => esc_html__( 'Select A Sidebar', 'fabrique-core' ),
			'priority' => 100
		) ) );


		$wp_customize->add_setting( 'shop_sidebar_fixed', array(
			'default' => $defaults['shop_sidebar_fixed'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'shop_sidebar_fixed', array (
			'section' => 'fabrique_shop_section',
			'settings' => 'shop_sidebar_fixed',
			'label' => esc_html__( 'Fixed Sidebar', 'fabrique-core' ),
			'priority' => 110
		) ) );


		$wp_customize->add_setting( 'shop_typography_section', array(
			'default' => $defaults['shop_typography_section'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Section_Control( $wp_customize, 'shop_typography_section', array (
			'section' => 'fabrique_shop_section',
			'settings' => 'shop_typography_section',
			'label' => esc_html__( 'Typography', 'fabrique-core' ),
			'priority' => 120
		) ) );


		$wp_customize->add_setting( 'shop_title_uppercase', array(
			'default' => $defaults['shop_title_uppercase'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'shop_title_uppercase', array (
			'section' => 'fabrique_shop_section',
			'settings' => 'shop_title_uppercase',
			'label' => esc_html__( 'Title Uppercase', 'fabrique-core' ),
			'priority' => 130
		) ) );


		$wp_customize->add_setting( 'shop_title_letter_spacing', array(
			'default' => $defaults['shop_title_letter_spacing'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Text_Control( $wp_customize, 'shop_title_letter_spacing', array (
			'section' => 'fabrique_shop_section',
			'settings' => 'shop_title_letter_spacing',
			'label' => esc_html__( 'Title Letter Spacing (em)', 'fabrique-core' ),
			'description' => esc_html__( 'Leave blank for default.', 'fabrique-core' ),
			'priority' => 140,
		) ) );


		$wp_customize->add_setting( 'shop_title_font_size', array(
			'default' => $defaults['shop_title_font_size'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'shop_title_font_size', array (
			'section' => 'fabrique_shop_section',
			'settings' => 'shop_title_font_size',
			'label' => esc_html__( 'Entry Title Font Size (px)', 'fabrique-core' ),
			'priority' => 150,
			'min' => 10,
			'max' => 60
		) ) );


		$wp_customize->add_setting( 'shop_price_font_size', array(
			'default' => $defaults['shop_price_font_size'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'shop_price_font_size', array (
			'section' => 'fabrique_shop_section',
			'settings' => 'shop_price_font_size',
			'label' => esc_html__( 'Entry Price Font Size (px)', 'fabrique-core' ),
			'priority' => 155,
			'min' => 10,
			'max' => 60
		) ) );


		$wp_customize->add_setting( 'shop_component', array(
			'default' => $defaults['shop_component'],
			'sanitize_callback' => 'fabrique_core_sanitize_component_value'
		) );

		$wp_customize->add_control( new Fabrique_Component_Control( $wp_customize, 'shop_component', array (
			'section' => 'fabrique_shop_section',
			'settings' => 'shop_component',
			'label' => esc_html__( 'Entry Component', 'fabrique-core' ),
			'choices' => array(
				'media' => esc_html__( 'Media', 'fabrique-core' ),
				'title' => esc_html__( 'Title', 'fabrique-core' ),
				'excerpt' => esc_html__( 'Excerpt', 'fabrique-core' ),
				'rating' => esc_html__( 'Rating', 'fabrique-core' ),
				'addtocart' => esc_html__( 'Add To Cart', 'fabrique-core' ),
				'price' => esc_html__( 'Price', 'fabrique-core' )
			),
			'priority' => 160
		) ) );


		$wp_customize->add_setting( 'product_image_action', array(
			'default' => $defaults['product_image_action'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'product_image_action', array (
			'section' => 'fabrique_product_section',
			'settings' => 'product_image_action',
			'label' => esc_html__( 'Action On Image', 'fabrique-core' ),
			'description' => esc_html__( 'Gallery image action, click to open light box or hover to zoom' ),
			'priority' => 40,
			'choices' => array(
				'lightbox' => esc_html__( 'Light Box', 'fabrique-core' ),
				'zoom' => esc_html__( 'Zoom', 'fabrique-core' ),
				'both' => esc_html__( 'Both', 'fabrique-core' )
			)
		) ) );


		$wp_customize->add_setting( 'product_variation_mode', array(
			'default' => $defaults['product_variation_mode'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'product_variation_mode', array (
			'section' => 'fabrique_product_section',
			'settings' => 'product_variation_mode',
			'label' => esc_html__( 'Variation Mode', 'fabrique-core' ),
			'description' => esc_html__( 'Variable product select style, "radio" mode can upload thumbnail image in "product attribute" edit page' ),
			'priority' => 45,
			'choices' => array(
				'select' => esc_html__( 'Select', 'fabrique-core' ),
				'radio' => esc_html__( 'Radio', 'fabrique-core' )
			)
		) ) );


		$wp_customize->add_setting( 'product_thumbnail_position', array(
			'default' => $defaults['product_thumbnail_position'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'product_thumbnail_position', array (
			'section' => 'fabrique_product_section',
			'settings' => 'product_thumbnail_position',
			'label' => esc_html__( 'Thumbnail Position', 'fabrique-core' ),
			'priority' => 50,
			'choices' => array(
				'bottom' => esc_html__( 'Bottom', 'fabrique-core' ),
				'left' => esc_html__( 'Left', 'fabrique-core' ),
				'right' => esc_html__( 'Right', 'fabrique-core' )
			)
		) ) );


		$wp_customize->add_setting( 'product_thumbnail_item', array(
			'default' => $defaults['product_thumbnail_item'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'product_thumbnail_item', array(
			'section' => 'fabrique_product_section',
			'settings' => 'product_thumbnail_item',
			'label' => esc_html__( 'No. of Thumbnail Display', 'fabrique-core' ),
			'priority' => 60,
			'type' => 'select',
			'choices' => array(
				1 => '1',
				2 => '2',
				3 => '3',
				4 => '4',
				5 => '5',
				6 => '6'
			)
		) );


		$wp_customize->add_setting( 'product_detail_position', array(
			'default' => $defaults['product_detail_position'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'product_detail_position', array (
			'section' => 'fabrique_product_section',
			'settings' => 'product_detail_position',
			'label' => esc_html__( 'Product Detail Section Position', 'fabrique-core' ),
			'priority' => 70,
			'choices' => array(
				'left' => esc_html__( 'Left', 'fabrique-core' ),
				'right' => esc_html__( 'Right', 'fabrique-core' )
			)
		) ) );


		$wp_customize->add_setting( 'product_detail_width', array(
			'default' => $defaults['product_detail_width'],
			'sanitize_callback' => 'fabrique_core_sanitize_number_value'
		) );

		$wp_customize->add_control( new Fabrique_Slider_Control( $wp_customize, 'product_detail_width', array (
			'section' => 'fabrique_product_section',
			'settings' => 'product_detail_width',
			'label' => esc_html__( 'Product Detail Section Width (%)', 'fabrique-core' ),
			'priority' => 80,
			'min' => 30,
			'max' => 70
		) ) );


		$wp_customize->add_setting( 'product_component', array(
			'default' => $defaults['product_component'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Section_Control( $wp_customize, 'product_component', array (
			'section' => 'fabrique_product_section',
			'settings' => 'product_component',
			'label' => esc_html__( 'Components', 'fabrique-core' ),
			'priority' => 90
		) ) );


		$wp_customize->add_setting( 'product_related', array(
			'default' => $defaults['product_related'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'product_related', array (
			'section' => 'fabrique_product_section',
			'settings' => 'product_related',
			'label' => esc_html__( 'Show Related Product', 'fabrique-core' ),
			'priority' => 100,
			'children' => array(
				'product_related_column'
			)
		) ) );


		$wp_customize->add_setting( 'product_related_column', array(
			'default' => $defaults['product_related_column'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'product_related_column', array(
			'section' => 'fabrique_product_section',
			'settings' => 'product_related_column',
			'label' => esc_html__( 'Related Product Columns', 'fabrique-core' ),
			'priority' => 110,
			'type' => 'select',
			'choices' => array(
				1 => '1',
				2 => '2',
				3 => '3',
				4 => '4',
				5 => '5',
				6 => '6'
			)
		) );


		$wp_customize->add_setting( 'product_share', array(
			'default' => $defaults['product_share'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'product_share', array (
			'section' => 'fabrique_product_section',
			'settings' => 'product_share',
			'label' => esc_html__( 'Show Social Share', 'fabrique-core' ),
			'priority' => 120
		) ) );


		$wp_customize->add_setting( 'product_sidebar', array(
			'default' => $defaults['product_sidebar'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'product_sidebar', array (
			'section' => 'fabrique_product_section',
			'settings' => 'product_sidebar',
			'label' => esc_html__( 'Sidebar', 'fabrique-core' ),
			'priority' => 130,
			'children' => array(
				'product_sidebar_position',
				'product_sidebar_select',
				'product_sidebar_fixed'
			)
		) ) );


		$wp_customize->add_setting( 'product_sidebar_position', array(
			'default' => $defaults['product_sidebar_position'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'product_sidebar_position', array (
			'section' => 'fabrique_product_section',
			'settings' => 'product_sidebar_position',
			'label' => esc_html__( 'Sidebar Position', 'fabrique-core' ),
			'priority' => 140,
			'choices' => array(
				'left' => esc_html__( 'Left', 'fabrique-core' ),
				'right' => esc_html__( 'Right', 'fabrique-core' )
			)
		) ) );


		$wp_customize->add_setting( 'product_sidebar_select', array(
			'default' => $defaults['product_sidebar_select'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Select_Control( $wp_customize, 'product_sidebar_select', array (
			'select_type' => 'sidebar',
			'section' => 'fabrique_product_section',
			'settings' => 'product_sidebar_select',
			'label' => esc_html__( 'Select A Sidebar', 'fabrique-core' ),
			'priority' => 150
		) ) );


		$wp_customize->add_setting( 'product_sidebar_fixed', array(
			'default' => $defaults['product_sidebar_fixed'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'product_sidebar_fixed', array (
			'section' => 'fabrique_product_section',
			'settings' => 'product_sidebar_fixed',
			'label' => esc_html__( 'Fixed Sidebar', 'fabrique-core' ),
			'priority' => 160
		) ) );


		$wp_customize->add_setting( 'social_auto_color', array(
			'default' => $defaults['social_auto_color'],
			'sanitize_callback' => 'fabrique_core_sanitize_boolean_value'
		) );

		$wp_customize->add_control( new Fabrique_Switch_Control( $wp_customize, 'social_auto_color', array (
			'section' => 'fabrique_social_section',
			'settings' => 'social_auto_color',
			'label' => esc_html__( 'Social Auto Color', 'fabrique-core' ),
			'description' => esc_html__( 'Auto color will apply each social brand color to icon', 'fabrique-core' ),
			'priority' => 5
		) ) );


		$wp_customize->add_setting( 'social_icon_style', array(
			'default' => $defaults['social_icon_style'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'social_icon_style', array (
			'radio_type' => 'image',
			'section' => 'fabrique_social_section',
			'settings' => 'social_icon_style',
			'label' => esc_html__( 'Icon Style', 'fabrique-core' ),
			'priority' => 10,
			'names' => array (
				'plain' => esc_html__( 'Plain', 'fabrique-core' ),
				'border' => esc_html__( 'Border', 'fabrique-core' ),
				'fill' => esc_html__( 'Circle', 'fabrique-core' ),
				'border-square' => esc_html__( 'Border Square', 'fabrique-core' ),
				'fill-square' => esc_html__( 'Fill Square', 'fabrique-core' )
			),
			'choices' => array(
				'plain' => 'customize-social-plain',
				'border' => 'customize-social-border',
				'fill' => 'customize-social-circle',
				'border-square' => 'customize-social-border-square',
				'fill-square' => 'customize-social-fill-square'
			)
		) ) );


		$wp_customize->add_setting( 'social_icon_hover_style', array(
			'default' => $defaults['social_icon_hover_style'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( new Fabrique_Radio_Control( $wp_customize, 'social_icon_hover_style', array (
			'radio_type' => 'image',
			'section' => 'fabrique_social_section',
			'settings' => 'social_icon_hover_style',
			'label' => esc_html__( 'Icon Hover Style', 'fabrique-core' ),
			'priority' => 20,
			'names' => array (
				'plain' => esc_html__( 'Plain', 'fabrique-core' ),
				'border' => esc_html__( 'Border', 'fabrique-core' ),
				'fill' => esc_html__( 'Circle', 'fabrique-core' ),
				'border-square' => esc_html__( 'Border Square', 'fabrique-core' ),
				'fill-square' => esc_html__( 'Fill Square', 'fabrique-core' )
			),
			'choices' => array(
				'plain' => 'customize-social-plain',
				'border' => 'customize-social-border',
				'fill' => 'customize-social-circle',
				'border-square' => 'customize-social-border-square',
				'fill-square' => 'customize-social-fill-square'
			)
		) ) );


		$wp_customize->add_setting( 'social_facebook', array(
			'default' => $defaults['social_facebook'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'social_facebook', array(
			'section' => 'fabrique_social_section',
			'settings' => 'social_facebook',
			'label' => esc_html__( 'Facebook', 'fabrique-core' ),
			'priority' => 60,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'social_twitter', array(
			'default' => $defaults['social_twitter'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'social_twitter', array(
			'section' => 'fabrique_social_section',
			'settings' => 'social_twitter',
			'label' => esc_html__( 'Twitter', 'fabrique-core' ),
			'priority' => 70,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'social_instagram', array(
			'default' => $defaults['social_instagram'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'social_instagram', array(
			'section' => 'fabrique_social_section',
			'settings' => 'social_instagram',
			'label' => esc_html__( 'Instagram', 'fabrique-core' ),
			'priority' => 80,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'social_youtube', array(
			'default' => $defaults['social_youtube'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'social_youtube', array(
			'section' => 'fabrique_social_section',
			'settings' => 'social_youtube',
			'label' => esc_html__( 'Youtube', 'fabrique-core' ),
			'priority' => 90,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'social_vimeo', array(
			'default' => $defaults['social_vimeo'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'social_vimeo', array(
			'section' => 'fabrique_social_section',
			'settings' => 'social_vimeo',
			'label' => esc_html__( 'Vimeo', 'fabrique-core' ),
			'priority' => 100,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'social_linkedin', array(
			'default' => $defaults['social_linkedin'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'social_linkedin', array(
			'section' => 'fabrique_social_section',
			'settings' => 'social_linkedin',
			'label' => esc_html__( 'Linkedin', 'fabrique-core' ),
			'priority' => 110,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'social_google-plus', array(
			'default' => $defaults['social_google-plus'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'social_google-plus', array(
			'section' => 'fabrique_social_section',
			'settings' => 'social_google-plus',
			'label' => esc_html__( 'Google+', 'fabrique-core' ),
			'priority' => 120,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'social_skype', array(
			'default' => $defaults['social_skype'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'social_skype', array(
			'section' => 'fabrique_social_section',
			'settings' => 'social_skype',
			'label' => esc_html__( 'Skype', 'fabrique-core' ),
			'priority' => 130,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'social_pinterest', array(
			'default' => $defaults['social_pinterest'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'social_pinterest', array(
			'section' => 'fabrique_social_section',
			'settings' => 'social_pinterest',
			'label' => esc_html__( 'Pinterest', 'fabrique-core' ),
			'priority' => 140,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'social_tripadvisor', array(
			'default' => $defaults['social_tripadvisor'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'social_tripadvisor', array(
			'section' => 'fabrique_social_section',
			'settings' => 'social_tripadvisor',
			'label' => esc_html__( 'Tripadvisor', 'fabrique-core' ),
			'priority' => 145,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'social_flickr', array(
			'default' => $defaults['social_flickr'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'social_flickr', array(
			'section' => 'fabrique_social_section',
			'settings' => 'social_flickr',
			'label' => esc_html__( 'Flickr', 'fabrique-core' ),
			'priority' => 150,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'social_tumblr', array(
			'default' => $defaults['social_tumblr'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'social_tumblr', array(
			'section' => 'fabrique_social_section',
			'settings' => 'social_tumblr',
			'label' => esc_html__( 'Tumblr', 'fabrique-core' ),
			'priority' => 160,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'social_dribbble', array(
			'default' => $defaults['social_dribbble'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'social_dribbble', array(
			'section' => 'fabrique_social_section',
			'settings' => 'social_dribbble',
			'label' => esc_html__( 'dribbble', 'fabrique-core' ),
			'priority' => 170,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'social_behance', array(
			'default' => $defaults['social_behance'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'social_behance', array(
			'section' => 'fabrique_social_section',
			'settings' => 'social_behance',
			'label' => esc_html__( 'Behance', 'fabrique-core' ),
			'priority' => 180,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'social_stumbleupon', array(
			'default' => $defaults['social_stumbleupon'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'social_stumbleupon', array(
			'section' => 'fabrique_social_section',
			'settings' => 'social_stumbleupon',
			'label' => esc_html__( 'StumbleUpon', 'fabrique-core' ),
			'priority' => 190,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'social_email', array(
			'default' => $defaults['social_email'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'social_email', array(
			'section' => 'fabrique_social_section',
			'settings' => 'social_email',
			'label' => esc_html__( 'Email', 'fabrique-core' ),
			'priority' => 200,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'social_phone', array(
			'default' => $defaults['social_phone'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'social_phone', array(
			'section' => 'fabrique_social_section',
			'settings' => 'social_phone',
			'label' => esc_html__( 'Phone', 'fabrique-core' ),
			'priority' => 210,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'social_line', array(
			'default' => $defaults['social_line'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'social_line', array(
			'section' => 'fabrique_social_section',
			'settings' => 'social_line',
			'label' => esc_html__( 'Line', 'fabrique-core' ),
			'priority' => 200,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'social_xing', array(
			'default' => $defaults['social_xing'],
			'sanitize_callback' => 'fabrique_core_sanitize_text_value'
		) );

		$wp_customize->add_control( 'social_xing', array(
			'section' => 'fabrique_social_section',
			'settings' => 'social_xing',
			'label' => esc_html__( 'Xing', 'fabrique-core' ),
			'priority' => 210,
			'type' => 'text'
		) );


		$wp_customize->add_setting( 'social_share_component', array(
			'default' => $defaults['social_share_component'],
			'sanitize_callback' => 'fabrique_core_sanitize_component_value'
		) );

		$wp_customize->add_control( new Fabrique_Component_Control( $wp_customize, 'social_share_component', array (
			'section' => 'fabrique_social_share_section',
			'settings' => 'social_share_component',
			'label' => esc_html__( 'Social Share Component', 'fabrique-core' ),
			'choices' => array(
				'facebook' => esc_html__( 'Facebook', 'fabrique-core' ),
				'twitter' => esc_html__( 'Twitter', 'fabrique-core' ),
				'pinterest' => esc_html__( 'Pinterest', 'fabrique-core' ),
				'google-plus' => esc_html__( 'Google+', 'fabrique-core' ),
				'email' => esc_html__( 'Email', 'fabrique-core' ),
				'tumblr' => esc_html__( 'Tumblr', 'fabrique-core' ),
				'linkedin' => esc_html__( 'Linkedin', 'fabrique-core' ),
				'stumbleupon' => esc_html__( 'StumbleUpon', 'fabrique-core' )
			),
			'priority' => 10
		) ) );

		do_action( 'fabrique_customize_register', $wp_customize );
	}

	private function font_options()
	{
		$fonts = array(
			'primary' => get_theme_mod( 'font_primary' ),
			'secondary' => get_theme_mod( 'font_secondary' ),
			'custom_a' => get_theme_mod( 'font_custom_a' ),
			'custom_b' => get_theme_mod( 'font_custom_b' ),
			'custom_c' => get_theme_mod( 'font_custom_c' ),
			'custom_d' => get_theme_mod( 'font_custom_d' ),
			'custom_e' => get_theme_mod( 'font_custom_e' ),
			'custom_f' => get_theme_mod( 'font_custom_f' ),
			'custom_g' => get_theme_mod( 'font_custom_g' ),
			'custom_h' => get_theme_mod( 'font_custom_h' )
		);

		$choices = array();
		foreach ( $fonts as $key => $font ) {
			if ( !empty( $font ) ) {
				$choices[$key] = $font['family'] . ' / ' . $font['style'];
			}
		}
		return $choices;
	}

	private function image_size_options()
	{
 		return array(
			'thumbnail' => esc_html__( 'Thumbnail', 'fabrique-core' ),
			'medium' => esc_html__( 'Medium', 'fabrique-core' ),
			'twist_medium' => esc_html__( 'Twist Medium', 'fabrique-core' ),
			'medium_large' => esc_html__( 'Medium Large', 'fabrique-core' ),
			'large' => esc_html__( 'Large', 'fabrique-core' ),
			'twist_large' => esc_html__( 'Twist Large', 'fabrique-core' ),
			'full' => esc_html__( 'Full', 'fabrique-core' )
		);
	}

	public function get_default_options()
	{
		if ( $this->customize_defaults ) {
			return $this->customize_defaults;
		}

		$this->customize_defaults = array(
			'default_color_scheme' => 'light',
			'topbar_color_scheme' => 'dark',
			'navbar_color_scheme' => 'light',
			'header_widget_color_scheme' => 'dark',
			'page_title_color_scheme' => 'dark',
			'sidebar_color_scheme' => 'default',
			'navbar_offcanvas_cursor' => '',
			'navbar_logo_section' => '',
			'logo_type' => 'text',
			'logo' => '',
			'logo_width' => 120,
			'logo_text_title' => 'FABRIQUÉ',
			'logo_typography' => 'secondary',
			'logo_font_color' => 'bp_color_1',
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
			)
		);

		$this->customize_defaults['font_primary'] = array(
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

		$this->customize_defaults['font_secondary'] = array(
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

		$theme_colors = $this->get_default_theme_colors();

		foreach ( $theme_colors as $key => $value ) {
			$this->customize_defaults[$key] = $value;
		}

		return $this->customize_defaults;
	}

	public function get_default_theme_colors()
	{
		return array(
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
			'bp_color_14' => '#363636'
		);
	}
}
