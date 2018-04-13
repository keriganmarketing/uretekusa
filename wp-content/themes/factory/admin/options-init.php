<?php
/*
 * @package CommerceGurus
 * @subpackage Factory
 * */

if ( ! class_exists( 'factorycommercegurus_Redux_Framework_config' ) ) {

	class Factorycommercegurus_Redux_Framework_config {

		public $args	 = array();
		public $sections = array();
		public $theme;
		public $ReduxFramework;

		public function __construct() {

			if ( ! class_exists( 'ReduxFramework' ) ) {
				return;
			}

			// This is needed. Bah WordPress bugs.  ;)
			if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
				$this->initSettings();
			} else {
				add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
			}
		}

		public function initSettings() {

			// Just for demo purposes. Not needed per say.
			$this->theme = wp_get_theme();

			// Set the default arguments
			$this->setArguments();

			// Set a few help tabs so you can see how it's done
			$this->setHelpTabs();

			// Create the sections and fields
			$this->setSections();

			if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
				return;
			}

			// If Redux is running as a plugin, this will remove the demo notice and links
			add_action( 'redux/loaded', array( $this, 'remove_demo' ) );

			$this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
		}

		/**
		 * This is a test function that will let you see when the compiler hook occurs.
		 * It only runs if a field   set with compiler=>true is changed.
		 * */
		function compiler_action( $options, $css ) {

		}

		/**
		 * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
		 * Simply include this function in the child themes functions.php file.
		 * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
		 * so you must use get_template_directory_uri() if you want to use any of the built in icons
		 * */
		function dynamic_section( $sections ) {
			// $sections = array();
			$sections[] = array(
				'title'	 => esc_html__( 'Section via hook', 'redux-framework-demo' ),
				'desc'	 => esc_html__( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo' ),
				'icon'	 => 'el-icon-paper-clip',
				// Leave this as a blank section, no options just some intro text set above.
				'fields' => array(),
			);

			return $sections;
		}

		/**
		 * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
		 * */
		function change_arguments( $args ) {
			// $args['dev_mode'] = true;
			return $args;
		}

		/**
		 * Filter hook for filtering the default value of any given field. Very useful in development mode.
		 * */
		function change_defaults( $defaults ) {
			$defaults['str_replace'] = 'Testing filter hook!';

			return $defaults;
		}

		// Remove the demo link and the notice of integrated demo from the redux-framework plugin
		function remove_demo() {

			// Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
			if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
				remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::instance(), 'plugin_metalinks' ), null, 2 );

				// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
				remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
			}
		}

		public function setSections() {

			/**
			 * Theme Options sections
			 * */
			$this->sections[] = array(
				'title'	 => esc_html__( 'Global Settings', 'factory' ),
				'desc'	 => esc_html__( 'Changes to major global elements.', 'factory' ),
				'icon'	 => 'el-icon-home',
				'fields' => array(
					array(
						'desc'		 => esc_html__( 'Select a container layout style', 'factory' ),
						'id'		 => 'container_style',
						'type'		 => 'select',
						'options'	 => array(
							'full-width' => esc_html__( 'Full Width Layout', 'factory' ),
							'boxed'		 => esc_html__( 'Boxed Layout', 'factory' ),
						),
						'title'		 => esc_html__( 'Container layout style', 'factory' ),
						'default'	 => 'full-width',
					),
					array(
						'desc'		 => esc_html__( 'Enable or disable responsiveness on smartphones', 'factory' ),
						'id'		 => 'factorycommercegurus_responsive',
						'type'		 => 'select',
						'options'	 => array(
							'enabled'	 => esc_html__( 'Enabled', 'factory' ),
							'disabled'	 => esc_html__( 'Disabled', 'factory' ),
						),
						'title'		 => esc_html__( 'Responsive', 'factory' ),
						'default'	 => 'enabled',
					),
					array(
						'desc' => esc_html__( 'Enable or disable the Page preloader', 'factory' ),
						'id' => 'factorycommercegurus_preloader',
						'type' => 'select',
						'options' => array(
							'enabled' => esc_html__( 'Enabled', 'factory' ),
							'disabled' => esc_html__( 'Disabled', 'factory' ),
						),
						'title' => esc_html__( 'Page Preloader', 'factory' ),
						'default' => 'enabled',
					),
					array(
						'id'					 => 'factorycommercegurus_background',
						'type'					 => 'background',
						'title'					 => esc_html__( 'Body Background - Color and image', 'factory' ),
						'subtitle'				 => esc_html__( 'Configure your theme background.', 'factory' ),
						'background-position'	 => false,
						'background-size'		 => false,
						'background-attachment'	 => false,
						'default'				 => array(
							'background-color' => '#f8f8f8',
						),
					),
					array(
						'id'					 => 'factorycommercegurus_pattern_background',
						'type'					 => 'background',
						'title'					 => esc_html__( 'Body Background - Pattern', 'factory' ),
						'subtitle'				 => esc_html__( 'Use this option if you want to use a repeating pattern for your background. Note: Do not try to use both a pattern background and a full size image background! ', 'factory' ),
						'background-position'	 => false,
						'background-size'		 => false,
						'background-attachment'	 => false,
						'default'				 => array(
							'background-color' => '#efefef',
						),
					),
					array(
						'id'		 => 'factorycommercegurus_page_wrapper_color',
						'type'		 => 'color',
						'title'		 => esc_html__( 'Main body wrapper color', 'factory' ),
						'subtitle'	 => esc_html__( 'Configure your theme wrapper.', 'factory' ),
						'default'	 => '#ffffff',
					),
				),
			);

			$this->sections[] = array(
				'title'	 => esc_html__( 'Colors', 'factory' ),
				'desc'	 => esc_html__( 'Customize your theme color palette.', 'factory' ),
				'icon'	 => 'el-icon-tint',
				'fields' => array(
					array(
						'desc'		 => esc_html__( 'Select from one of the predefined color skins, or have your own colors by selecting "No Skin" and choosing colors below.', 'factory' ),
						'id'		 => 'factorycommercegurus_skin_color',
						'type'		 => 'select',
						'options'	 => array(
							'none'	 => esc_html__( 'No skin - use custom', 'factory' ),
							'red'	 => esc_html__( 'Red', 'factory' ),
							'green'	 => esc_html__( 'Green', 'factory' ),
							'blue' 	 => esc_html__( 'Blue', 'factory' ),
						),
						'title'		 => esc_html__( 'Color Skin', 'factory' ),
						'default'	 => 'none',
					),
					array(
						'id'		 => 'factorycommercegurus_primary_color',
						'type'		 => 'color',
						'title'		 => esc_html__( 'Primary theme color', 'factory' ),
						'subtitle'	 => esc_html__( 'This should be something unique about your site.', 'factory' ),
						'default'	 => '#fdc900',
					),
					array(
						'id'		 => 'link-colors-start',
						'type'		 => 'section',
						'title'		 => esc_html__( 'Link Colors', 'factory' ),
						'subtitle'	 => esc_html__( 'Define your link colors.', 'factory' ),
						'indent'	 => true,
					),
					array(
						'id'		 => 'factorycommercegurus_active_link_color',
						'type'		 => 'color',
						'title'		 => esc_html__( 'Active link color', 'factory' ),
						'subtitle'	 => esc_html__( 'The color of active links.', 'factory' ),
						'default'	 => '#117abc',
					),
					array(
						'id'		 => 'factorycommercegurus_link_hover_color',
						'type'		 => 'color',
						'title'		 => esc_html__( 'Link hover color', 'factory' ),
						'subtitle'	 => esc_html__( 'The color of your links in the hover state.', 'factory' ),
						'default'	 => '#000000',
					),
					array(
						'id'	 => 'link-colors-end',
						'type'	 => 'section',
						'indent' => false,
					),
					array(
						'id'		 => 'header-colors-start',
						'type'		 => 'section',
						'title'		 => esc_html__( 'Header Colors', 'factory' ),
						'subtitle'	 => esc_html__( 'Define your header colors. Note: not all color options apply to all header styles.', 'factory' ),
						'indent'	 => true,
					),
					array(
						'id'		 => 'factorycommercegurus_header_bg_color',
						'type'		 => 'color',
						'title'		 => esc_html__( 'Header Background Color', 'factory' ),
						'indent'	 => true,
						'subtitle'	 => esc_html__( 'The Color of the Header Background.', 'factory' ),
						'default'	 => '#ffffff',
						'output'	 => array(
							'background-color' => '.cg-transparent-header, .cg-logo-center, .cg-logo-left',
						),
					),
					array(
						'id'		 => 'factorycommercegurus_header_text_color',
						'type'		 => 'color',
						'title'		 => esc_html__( 'Header Text Color', 'factory' ),
						'subtitle'	 => esc_html__( 'The color of the Header Text.', 'factory' ),
						'default'	 => '#444444',
					),
					array(
						'id'		 => 'factorycommercegurus_navigation_bg_color',
						'type'		 => 'color',
						'title'		 => esc_html__( 'Navigation Background Color', 'factory' ),
						'indent'	 => true,
						'subtitle'	 => esc_html__( 'The Color of the Navigation Background.', 'factory' ),
						'default'	 => '#292929',
						'output'	 => array(
				'color' => '
						.cg-primary-menu-below-wrapper .menu > li.current_page_item > a, 
						.cg-primary-menu-below-wrapper .menu > li.current_page_item > a:hover, 
						.cg-primary-menu-below-wrapper .menu > li.current_page_item:hover > a, 
						.cg-primary-menu-below-wrapper .menu > li.current-menu-ancestor > a,
						body .cg-primary-menu-left.cg-primary-menu .menu > li.current_page_item:hover > a, 
						.cg-primary-menu-left.cg-primary-menu .menu > li.current-menu-ancestor:hover > a, 
						.cg-primary-menu-below-wrapper .menu > li.current-menu-ancestor > a:hover,  
						.cg-primary-menu-below-wrapper .menu > li.current_page_parent > a, 
						.cg-primary-menu-below-wrapper .menu > li.secondary.current-menu-ancestor a:before',
						'background-color' => '.cg-primary-menu-center ul.menu, .cg-primary-menu-left ul.menu',
					),
					),
					array(
						'id'		 => 'factorycommercegurus_navigation_sec_bg_color',
						'type'		 => 'color',
						'title'		 => esc_html__( 'Navigation Background Secondary Color', 'factory' ),
						'indent'	 => true,
						'subtitle'	 => esc_html__( 'The Color of the Secondary Navigation Background.', 'factory' ),
						'default'	 => '#474747',
						'output'	 => array(
							'background-color' => '.cg-primary-menu-below-wrapper .menu > li.secondary > a',
						),
					),
					array(
						'id'		 => 'factorycommercegurus_navigation_text_color',
						'type'		 => 'color',
						'title'		 => esc_html__( 'Navigation Text Color', 'factory' ),
						'subtitle'	 => esc_html__( 'The color of the Navigation', 'factory' ),
						'default'	 => '#ffffff',
					),
					array(
						'id'		 => 'factorycommercegurus_navigation_text_hover_color',
						'type'		 => 'color',
						'title'		 => esc_html__( 'Navigation Text Hover Color', 'factory' ),
						'subtitle'	 => esc_html__( 'The color of the main Navigation on hover.', 'factory' ),
						'default'	 => '#cccccc',
						'output'	 => array(
							'color' => '.cg-primary-menu-left.cg-primary-menu .menu > li:not(.current_page_parent) > a:hover, .cg-primary-menu-left.cg-primary-menu .menu > li:not(.current_page_parent):hover > a',
						),
					),
					array(
						'id'		 => 'factorycommercegurus_header_fixed_bg_color',
						'type'		 => 'color',
						'title'		 => esc_html__( 'Sticky Header Background Color', 'factory' ),
						'subtitle'	 => esc_html__( 'The Color of the Sticky Header Background.', 'factory' ),
						'default'	 => '#ffffff',
						'output'	 => array(
							'background-color' => '.cg-header-fixed-wrapper.cg-is-fixed',
						),
					),
					array(
						'id'		 => 'factorycommercegurus_header_fixed_text_color',
						'type'		 => 'color',
						'title'		 => esc_html__( 'Sticky Header Text Color', 'factory' ),
						'subtitle'	 => esc_html__( 'The color of the Sticky Header Text.', 'factory' ),
						'default'	 => '#222222',
					),
					array(
						'id'		 => 'factorycommercegurus_mobile_header_bg_color',
						'type'		 => 'color',
						'title'		 => esc_html__( 'Mobile Header Background Color', 'factory' ),
						'subtitle'	 => esc_html__( 'The color of the Mobile Header Background.', 'factory' ),
						'default'	 => '#ffffff',
					),
					array(
						'id'		 => 'factorycommercegurus_mobile_header_elements_color',
						'type'		 => 'color',
						'title'		 => esc_html__( 'Mobile Header Elements Color', 'factory' ),
						'indent'	 => true,
						'subtitle'	 => esc_html__( 'The color of the Mobile search and hamburger menu.', 'economist' ),
						'default'	 => '#000',
						'output'	 => array(
							'background-color' => '.mean-container a.meanmenu-reveal span',
							'color' => '.mobile-search i',
						),
					),
					array(
						'id'	 => 'header-colors-end',
						'type'	 => 'section',
						'indent' => false,
					),

					array(
						'id'		 => 'footer-colors-start',
						'type'		 => 'section',
						'title'		 => esc_html__( 'Footer Colors', 'factory' ),
						'subtitle'	 => esc_html__( 'Define your footer colors.', 'factory' ),
						'indent'	 => true,
					),
					array(
						'id'		 => 'factorycommercegurus_first_footer_bg',
						'type'		 => 'color',
						'title'		 => esc_html__( 'First footer background color', 'factory' ),
						'subtitle'	 => esc_html__( 'The background color of the first (top) footer.', 'factory' ),
						'default'	 => '#222222',
					),
					array(
						'id'		 => 'factorycommercegurus_first_footer_text',
						'type'		 => 'color',
						'title'		 => esc_html__( 'First footer text color', 'factory' ),
						'subtitle'	 => esc_html__( 'The text color of the first (top) footer.', 'factory' ),
						'default'	 => '#f2f2f2',
					),
					array(
						'id'		 => 'factorycommercegurus_first_footer_link',
						'type'		 => 'color',
						'title'		 => esc_html__( 'First footer link color', 'factory' ),
						'subtitle'	 => esc_html__( 'The link color of the first (top) footer.', 'factory' ),
						'default'	 => '#ffffff',
					),
					array(
						'id'		 => 'factorycommercegurus_second_footer_bg',
						'type'		 => 'color',
						'title'		 => esc_html__( 'Second footer background color', 'factory' ),
						'subtitle'	 => esc_html__( 'The background color of the second (bottom) footer.', 'factory' ),
						'default'	 => '#eeeeee',
					),
					array(
						'id'		 => 'factorycommercegurus_second_footer_text',
						'type'		 => 'color',
						'title'		 => esc_html__( 'Second footer text color', 'factory' ),
						'subtitle'	 => esc_html__( 'The text color of the second (bottom) footer.', 'factory' ),
						'default'	 => '#333333',
					),
					array(
						'id'	 => 'footer-colors-end',
						'type'	 => 'section',
						'indent' => false,
					),
				),
			);

			$this->sections[] = array(
				'title'	 => esc_html__( 'Logos', 'factory' ),
				'desc'	 => esc_html__( 'Update your Logos.', 'factory' ),
				'icon'	 => 'el-icon-photo',
				'fields' => array(
					array(
						'id'		 => 'standard-logo-start',
						'type'		 => 'section',
						'title'		 => esc_html__( 'Logos', 'factory' ),
						'subtitle'	 => esc_html__( 'Set your Logo', 'factory' ),
						'indent'	 => true,
					),
					array(
						'desc'	 => esc_html__( 'Upload your Logo.', 'factory' ),
						'id'	 => 'site_logo',
						'type'	 => 'media',
						'title'	 => esc_html__( 'Logo', 'factory' ),
						'url'	 => true,
					),
					array(
						'title'			 => esc_html__( 'Logo Height', 'factory' ),
						'subtitle'		 => esc_html__( 'Set your Logo Height in pixels', 'factory' ),
						'id'			 => 'factorycommercegurus_logo_height',
						'type'			 => 'slider',
						'default'		 => 48,
						'min'			 => 0,
						'step'			 => 1,
						'max'			 => 200,
						'display_value'	 => 'text',
					),
					array(
						'title'			 => esc_html__( 'Padding around Logo', 'factory' ),
						'subtitle'		 => esc_html__( 'Set some padding around your logo', 'factory' ),
						'id'			 => 'factorycommercegurus_padding_below_logo',
						'type'			 => 'slider',
						'default'		 => 70,
						'min'			 => 0,
						'step'			 => 1,
						'max'			 => 200,
						'display_value'	 => 'text',
					),
					array(
						'id'	 => 'standard-logo-end',
						'type'	 => 'section',
						'indent' => false,
					),
					array(
						'id'		 => 'sticky-logo-start',
						'type'		 => 'section',
						'title'		 => esc_html__( 'Sticky Logo', 'factory' ),
						'subtitle'	 => esc_html__( 'Set your Sticky Logo', 'factory' ),
						'indent'	 => true,
					),
					array(
						'desc'	 => esc_html__( 'Upload a Logo which appears within a Sticky Header.', 'factory' ),
						'id'	 => 'factorycommercegurus_alt_site_logo',
						'type'	 => 'media',
						'title'	 => esc_html__( 'Sticky Logo (optional)', 'factory' ),
						'url'	 => true,
					),
					array(
						'id'	 => 'sticky-logo-end',
						'type'	 => 'section',
						'indent' => false,
					),
					array(
						'id'		 => 'dynamic-width-logo-start',
						'type'		 => 'section',
						'title'		 => esc_html__( 'Logo Container Width', 'factory' ),
						'subtitle'	 => esc_html__( 'Set the Container width of the Logo - the default is 20%. Unless you have a very wide logo you should not need to adjust this.', 'factory' ),
						'indent'	 => true,
					),
					array(
						'title'			 => esc_html__( 'Logo Container Width', 'factory' ),
						'subtitle'	 	 => esc_html__( 'Set in %', 'factory' ),
						'desc'		 	 => esc_html__( 'You may need to remove or adjust your Header Details Widgets if you increase this.', 'factory' ),
						'id'			 => 'factorycommercegurus_dynamic_logo_width',
						'type'			 => 'slider',
						'default'		 => 20,
						'min'			 => 10,
						'step'			 => 1,
						'max'			 => 50,
						'display_value'	 => 'text',
					),
					array(
						'id'	 => 'dynamic-width-logo-end',
						'type'	 => 'section',
						'indent' => false,
					),
					array(
						'id'		 => 'mobile-header-start',
						'type'		 => 'section',
						'title'		 => esc_html__( 'Mobile Header Height', 'factory' ),
						'subtitle'	 => esc_html__( 'Set the mobile header height', 'factory' ),
						'indent'	 => true,
					),
					array(
						'title'			 => esc_html__( 'Mobile Header Height', 'factory' ),
						'subtitle'	 	 => esc_html__( 'Set in px', 'factory' ),
						'desc'		 	 => esc_html__( 'Increase the Mobile Header Height if you wish (Default is 60px)', 'factory' ),
						'id'			 => 'factorycommercegurus_mobile_header_height',
						'type'			 => 'slider',
						'default'		 => 60,
						'min'			 => 60,
						'step'			 => 1,
						'max'			 => 150,
						'display_value'	 => 'text',
					),
					array(
						'title'			 => esc_html__( 'Mobile Logo Height', 'factory' ),
						'subtitle'	 	 => esc_html__( 'Set in px', 'factory' ),
						'desc'		 	 => esc_html__( 'This should be set to be roughly half the Mobile Header Height. A little whitespace is good. (Default is 35px)', 'factory' ),
						'id'			 => 'factorycommercegurus_mobile_logo_height',
						'type'			 => 'slider',
						'default'		 => 35,
						'min'			 => 25,
						'step'			 => 1,
						'max'			 => 150,
						'display_value'	 => 'text',
					),
					array(
						'id'	 => 'mobile-header-end',
						'type'	 => 'section',
						'indent' => false,
					),
				),
			);

			$this->sections[] = array(
				'title'	 => esc_html__( 'Header Settings', 'factory' ),
				'desc'	 => esc_html__( 'Manage your header.', 'factory' ),
				'icon'	 => 'el-icon-hand-up',
				'fields' => array(
					array(
						'id'		 => 'factorycommercegurus_logo_position',
						'type'		 => 'image_select',
						'compiler'	 => true,
						'title'		 => esc_html__( 'Header Layout', 'factory' ),
						'subtitle'	 => esc_html__( 'Select the Header Layout.', 'factory' ),
						'options'	 => array(

							'left'	 => array(
							'alt'	 => 'Layout 4',
							'img'	 => get_template_directory_uri() . '/images/theme_options/header_4.png',
							),
						),
						'default'	 => 'left',
					),

					array(
						'id'		 => 'factorycommercegurus_topbar',
						'type'		 => 'switch',
						'title'		 => esc_html__( 'Top Bar', 'factory' ),
						'subtitle'	 => esc_html__( 'Enable the Top Bar?', 'factory' ),
						'on'		 => esc_html__( 'Enable', 'factory' ),
						'off'		 => esc_html__( 'Disable', 'factory' ),
						'default'	 => 1,
					),
					array(
						'id'		 => 'factorycommercegurus_mobile_visible',
						'type'		 => 'switch',
						'title'		 => esc_html__( 'Top Bar Mobile Visibility', 'factory' ),
						'subtitle'	 => esc_html__( 'If Top Bar is enabled, display on mobile?', 'factory' ),
						'on'		 => esc_html__( 'Enable', 'factory' ),
						'off'		 => esc_html__( 'Disable', 'factory' ),
						'default'	 => 1,
					),
					array(
						'title'		 => esc_html__( 'Sticky Menu', 'factory' ),
						'desc'		 => esc_html__( 'A sticky menu is a menu which fixes itself to the top as you scroll.', 'factory' ),
						'id'		 => 'factorycommercegurus_sticky_menu',
						'type'		 => 'switch',
						'subtitle'	 => esc_html__( 'Enable Sticky Menu?', 'factory' ),
						'on'		 => esc_html__( 'Enable', 'factory' ),
						'off'		 => esc_html__( 'Disable', 'factory' ),
						'default'	 => 1,
					),

					array(
						'id'		 => 'factorycommercegurus_show_search',
						'type'		 => 'switch',
						'title'		 => esc_html__( 'Search', 'factory' ),
						'subtitle'	 => esc_html__( 'Show Search?', 'factory' ),
						'on'		 => esc_html__( 'Enable', 'factory' ),
						'off'		 => esc_html__( 'Disable', 'factory' ),
						'default'	 => 1,
					),
					array(
						'id'		 => 'factorycommercegurus_announcements_bg',
						'type'		 => 'color',
						'title'		 => esc_html__( 'Top Bar Background Color', 'factory' ),
						'subtitle'	 => esc_html__( 'The color of the Top Bar background.', 'factory' ),
						'default'	 => '#434752',
					),
					array(
						'id'		 => 'factorycommercegurus_announcements_text',
						'type'		 => 'color',
						'title'		 => esc_html__( 'Top Bar Text Color', 'factory' ),
						'subtitle'	 => esc_html__( 'The color of the Top Bar text.', 'factory' ),
						'default'	 => '#ffffff',
					),
				),
			);

			$this->sections[] = array(
				'title'	 => esc_html__( 'Main Menu Settings', 'factory' ),
				'desc'	 => esc_html__( 'Manage your main menu.', 'factory' ),
				'icon'	 => 'el-icon-cog-alt',
				'fields' => array(
					array(
						'id'			 => 'factorycommercegurus_level1_font',
						'type'			 => 'typography',
						'title'			 => esc_html__( 'Level 1 Typeface', 'factory' ),
						'text-transform' => true,
						'google'		 => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'	 => true, // Select a backup non-google font in addition to a google font
						'line-height'	 => false,
						'letter-spacing' => true, // Defaults to false
						'all_styles'	 => true, // Enable all Google Font style/weight variations to be added to the page
						'output'		 => array( '.cg-primary-menu .menu > li > a', 'ul.tiny-cart > li > a', '.rightnav .cart_subtotal' ), // An array of CSS selectors to apply this font style to dynamically
						'units'			 => 'px', // Defaults to px
						'subtitle'		 => esc_html__( 'Each property can be called individually.', 'factory' ),
						'default'		 => array(
							'font-weight'	 => '400',
							'font-family'	 => 'Roboto Condensed',
							'google'		 => true,
							'font-size'		 => '15px',
							'text-transform' => 'uppercase',
						),
					),
					array(
						'id'			 => 'factorycommercegurus_level2_heading_font',
						'type'			 => 'typography',
						'title'			 => esc_html__( 'Level 2 Heading Typeface', 'factory' ),
						'text-transform' => true,
						'google'		 => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'	 => true, // Select a backup non-google font in addition to a google font
						'line-height'	 => false,
						'letter-spacing' => true, // Defaults to false
						'all_styles'	 => true, // Enable all Google Font style/weight variations to be added to the page
						'output'		 => array( '.cg-header-fixed .menu > li.menu-full-width .cg-submenu-ddown .container > ul > li > a, .cg-primary-menu .menu > li.menu-full-width .cg-submenu-ddown .container > ul > li > a, .menu-full-width .cg-menu-title, .cg-header-fixed .menu > li.menu-full-width .cg-submenu-ddown .container > ul .menu-item-has-children > a, .cg-primary-menu .menu > li .cg-submenu-ddown ul li.image-item-title a, .cg-primary-menu .menu > li .cg-submenu-ddown ul li.image-item-title ul a,
.cg-primary-menu .menu > li.menu-full-width .cg-submenu-ddown .container > ul .menu-item-has-children > a, .cg-header-fixed .menu > li.menu-full-width .cg-submenu-ddown .container > ul > li .cg-submenu ul li.title a, .cg-primary-menu .menu > li.menu-full-width .cg-submenu-ddown .container > ul > li .cg-submenu ul li.title a, .cg-primary-menu .menu > li.menu-full-width .cg-submenu-ddown .container > ul > li > a:hover'
					), // An array of CSS selectors to apply this font style to dynamically
						'units'			 => 'px', // Defaults to px
						'subtitle'		 => esc_html__( 'Typography option with each property can be called individually.', 'factory' ),
						'default'		 => array(
							'color'			 => '#333333',
							'font-weight'	 => '300',
							'font-family'	 => 'Roboto',
							'google'		 => true,
							'font-size'		 => '15px',
						),
					),
					array(
						'id'			 => 'factorycommercegurus_level2_font',
						'type'			 => 'typography',
						'title'			 => esc_html__( 'Level 2 Typeface', 'factory' ),
						'text-transform' => true,
						// 'compiler'      => true,  // Use if you want to hook in your own CSS compiler
						'google'		 => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'	 => true, // Select a backup non-google font in addition to a google font
						// 'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
						// 'subsets'       => false, // Only appears if google is true and subsets not set to false
						// 'font-size'     => false,
						'line-height'	 => false,
						// 'word-spacing'  => true,  // Defaults to false
						'letter-spacing' => true, // Defaults to false
						// 'color'         => false,
						// 'preview'       => false, // Disable the previewer
						'all_styles'	 => true, // Enable all Google Font style/weight variations to be added to the page
						'output'		 => array( '.cg-primary-menu .menu > li .cg-submenu-ddown .container > ul > li a, .cg-submenu-ddown .container > ul > li > a, .cg-header-fixed .menu > li.menu-full-width .cg-submenu-ddown .container > ul > li .cg-submenu ul li ul li a, .cg-primary-menu .menu > li.menu-full-width .cg-submenu-ddown .container > ul > li .cg-submenu ul li ul li a, body .cg-primary-menu .menu > li .cg-submenu-ddown .container > ul > li a:hover' ), // An array of CSS selectors to apply this font style to dynamically
						'units'			 => 'px', // Defaults to px
						'subtitle'		 => esc_html__( 'Typography option with each property can be called individually.', 'factory' ),
						'default'		 => array(
							'color'			 => '#333333',
							'font-weight'	 => '300',
							'font-family'	 => 'Roboto',
							'google'		 => true,
							'font-size'		 => '14px',
							'text-transform' => 'none',
						),
					),

					array(
						'id'		 => 'factorycommercegurus_main_menu_dropdown_bg_hover',
						'type'		 => 'color',
						'title'		 => esc_html__( 'Dropdown menu background hover color', 'factory' ),
						'default'	 => '#fec900',
					),
				),
			);

			// Page Settings
			$this->sections[] = array(
				'title'	 => esc_html__( 'Page Options', 'factory' ),
				'desc'	 => esc_html__( 'Extra Page Options', 'factory' ),
				'icon'	 => 'el-icon-list-alt',
				'fields' => array(

					array(
						'id'		 => 'page-heading-start',
						'type'		 => 'section',
						'title'		 => esc_html__( 'Page Heading', 'factory' ),
						'subtitle'	 => esc_html__( '', 'factory' ),
						'indent'	 => true,
					),
					array(

						'id'		 => 'factorycommercegurus_page_heading_alignment',
						'type'		 => 'select',
						'title'		 => esc_html__( 'Heading Alignment', 'factory' ),
						'options'	 => array(
							'center' => esc_html__( 'Center', 'factory' ),
							'left'	 => esc_html__( 'Left', 'factory' ),
						),
						'default'	 => 'center',
					),

					array(
						'title'			 => esc_html__( 'Heading Top Margin', 'factory' ),
						'subtitle'	 	 => esc_html__( 'Set in px', 'factory' ),
						'id'			 => 'factorycommercegurus_page_heading_top_margin',
						'type'			 => 'slider',
						'default'		 => 155,
						'min'			 => 0,
						'step'			 => 1,
						'max'			 => 300,
						'display_value'	 => 'text',
					),
					array(
						'title'			 => esc_html__( 'Heading Bottom Margin', 'factory' ),
						'subtitle'	 	 => esc_html__( 'Set in px', 'factory' ),
						'id'			 => 'factorycommercegurus_page_heading_bottom_margin',
						'type'			 => 'slider',
						'default'		 => 125,
						'min'			 => 0,
						'step'			 => 1,
						'max'			 => 300,
						'display_value'	 => 'text',
					),
					array(
						'subtitle' 		 => esc_html__( 'Should be at least 1200px wide', 'commercegurus' ),
						'id' 			 => 'factorycommercegurus_page_header_bg',
						'type' 			 => 'media',
						'title' 		 => esc_html__( 'Default Background Image', 'factory' ),
						'url' 			 => true,
						'default'  		 => array(
							'url' 		 => get_template_directory_uri() . '/images/default-heading-bg.jpg',
						),
					),
					array(
						'id'	 => 'page-heading-end',
						'type'	 => 'section',
						'indent' => false,
					),
					array(
						'id'		 => 'share-heading-start',
						'type'		 => 'section',
						'title'		 => esc_html__( 'Share', 'factory' ),
						'subtitle'	 => esc_html__( '', 'factory' ),
						'indent'	 => true,
					),
					array(
						'desc'		 => esc_html__( 'Display share buttons below page heading?', 'factory' ),
						'id'		 => 'factorycommercegurus_share_options',
						'type'		 => 'select',
						'title'		 => esc_html__( 'Show Share Buttons', 'factory' ),
						'options'	 => array(
							'yes'	 => esc_html__( 'Yes', 'factory' ),
							'no'	 => esc_html__( 'No', 'factory' ),
						),
						'default'	 => 'yes',
					),
					array(
						'id'	 => 'share-heading-end',
						'type'	 => 'section',
						'indent' => false,
					),

				),
			);

			// End Main/Primary menu image uploads
			$this->sections[] = array(
				'title'	 => esc_html__( 'Footer Settings', 'factory' ),
				'desc'	 => esc_html__( 'Manage your footer.', 'factory' ),
				'icon'	 => 'el-icon-hand-down',
				'fields' => array(

					array(
						'desc'		 => esc_html__( 'Show Top Footer?', 'factory' ),
						'id'		 => 'factorycommercegurus_footer_top_active',
						'type'		 => 'select',
						'title'		 => esc_html__( 'Show top footer', 'factory' ),
						'options'	 => array(
							'yes'	 => esc_html__( 'Yes', 'factory' ),
							'no'	 => esc_html__( 'No', 'factory' ),
						),
						'default'	 => 'yes',
					),
					array(
						'desc'		 => esc_html__( 'Show Bottom Footer?', 'factory' ),
						'id'		 => 'factorycommercegurus_footer_bottom_active',
						'type'		 => 'select',
						'title'		 => esc_html__( 'Show bottom footer', 'factory' ),
						'options'	 => array(
							'yes'	 => esc_html__( 'Yes', 'factory' ),
							'no'	 => esc_html__( 'No', 'factory' ),
						),
						'default'	 => 'yes',
					),
					array(
						'desc'		 => esc_html__( 'Show Back to Top?', 'factory' ),
						'id'		 => 'factorycommercegurus_back_to_top',
						'type'		 => 'select',
						'title'		 => esc_html__( 'Show back to top?', 'factory' ),
						'options'	 => array(
							'yes'	 => esc_html__( 'Yes', 'factory' ),
							'no'	 => esc_html__( 'No', 'factory' ),
						),
						'default'	 => 'yes',
					),
				),
			);

			$this->sections[] = array(
				'title'	 => esc_html__( 'Typography', 'factory' ),
				'desc'	 => esc_html__( 'Manage your fonts and typefaces.', 'factory' ),
				'icon'	 => 'el-icon-fontsize',
				'fields' => array(
					array(
						'id'			 => 'opt-typography-body',
						'type'			 => 'typography',
						'title'			 => esc_html__( 'Body/Main text font', 'factory' ),
						'google'		 => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'	 => true, // Select a backup non-google font in addition to a google font
						'letter-spacing' => true, // Defaults to false
						'all_styles'	 => true, // Enable all Google Font style/weight variations to be added to the page
						'output'		 => array( 'body', 'select', 'input', 'textarea', 'button', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ), // An array of CSS selectors to apply this font style to dynamically
						'units'			 => 'px', // Defaults to px
						'subtitle'		 => esc_html__( 'Each property can be called individually.', 'factory' ),
						'default'		 => array(
							'color'			 => '#333333',
							'font-weight'	 => '300',
							'font-family'	 => 'Roboto',
							'google'		 => true,
							'font-size'		 => '16px',
							'line-height'	 => '26px',
						),
					),
					array(
						'id'			 => 'opt-typography-secondary',
						'type'			 => 'typography',
						'title'			 => esc_html__( 'Secondary font', 'factory' ),
						'google'		 => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'	 => true, // Select a backup non-google font in addition to a google font
						'letter-spacing' => true, // Defaults to false
						'text-transform' => true,
						'all_styles'	 => true, // Enable all Google Font style/weight variations to be added to the page
						'output'		 => array(
							'.container .mc4wp-form input[type="submit"]',
							'.text-logo a',

						),
						'compiler'		 => array( 'h2.site-description-compiler' ), // An array of CSS selectors to apply this font style to dynamically
						'units'			 => 'px', // Defaults to px
						'subtitle'		 => esc_html__( 'Each property can be called individually.', 'factory' ),
						'default'		 => array(
							'font-weight'	 => '400',
							'font-family'	 => 'Pathway Gothic One',
							'google'		 => true,
							'text-transform' => 'uppercase',
						),
					),
					array(
						'id'			 => 'opt-typography-p',
						'type'			 => 'typography',
						'title'			 => esc_html__( 'Paragraph Style', 'factory' ),
						'google'		 => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'	 => true, // Select a backup non-google font in addition to a google font
						'text-transform' => true,
						'letter-spacing' => true, // Defaults to false
						'all_styles'	 => true, // Enable all Google Font style/weight variations to be added to the page
						'output'		 => array( '.content-area .entry-content p', '.product p', '.content-area .vc_toggle_title h4', '.content-area ul', '.content-area ol', '.vc_figure-caption', '.authordescription p', 'body.page-template-template-home-default .wpb_text_column p' ), // An array of CSS selectors to apply this font style to dynamically
						'units'			 => 'px', // Defaults to px
						'subtitle'		 => esc_html__( 'Typography option with each property can be called individually.', 'factory' ),
						'default'		 => array(
							'color'			 => '#343e47',
							'font-weight'	 => '300',
							'font-family'	 => 'Roboto',
							'google'		 => true,
							'font-size'		 => '16px',
							'line-height'	 => '26px',
						),
					),
					array(
						'id'			 => 'opt-typography-h1',
						'type'			 => 'typography',
						'title'			 => esc_html__( 'Heading 1 Style', 'factory' ),
						'google'		 => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'	 => true, // Select a backup non-google font in addition to a google font
						'text-transform' => true,
						'letter-spacing' => true, // Defaults to false
						'all_styles'	 => true, // Enable all Google Font style/weight variations to be added to the page
						'output'		 => array( 'h1', '.content-area h1', 'h1.cg-page-title', '.summary h1', '.content-area .summary h1' ), // An array of CSS selectors to apply this font style to dynamically
						'units'			 => 'px', // Defaults to px
						'subtitle'		 => esc_html__( 'Typography option with each property can be called individually.', 'factory' ),
						'default'		 => array(
							'color'			 => '#111',
							'font-weight'	 => '300',
							'font-family'	 => 'Roboto',
							'google'		 => true,
							'font-size'		 => '55px',
							'line-height'	 => '70px',
						),
					),
					array(
						'id'			 => 'opt-typography-h2',
						'type'			 => 'typography',
						'title'			 => esc_html__( 'Heading 2 Style', 'factory' ),
						'google'		 => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'	 => true, // Select a backup non-google font in addition to a google font
						'text-transform' => true,
						'letter-spacing' => true, // Defaults to false
						'all_styles'	 => true, // Enable all Google Font style/weight variations to be added to the page
						'output'		 => array( 'h2', '.content-area h2' ), // An array of CSS selectors to apply this font style to dynamically
						'units'			 => 'px', // Defaults to px
						'subtitle'		 => esc_html__( 'Each property can be called individually.', 'factory' ),
						'default'		 => array(
							'color'			 => '#222',
							'font-weight'	 => '300',
							'font-family'	 => 'Roboto',
							'google'		 => true,
							'font-size'		 => '34px',
							'line-height'	 => '44px',
						),
					),
					array(
						'id'			 => 'opt-typography-h3',
						'type'			 => 'typography',
						'title'			 => esc_html__( 'Heading 3 Style', 'factory' ),
						'google'		 => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'	 => true, // Select a backup non-google font in addition to a google font
						'text-transform' => true,
						'letter-spacing' => true, // Defaults to false
						'all_styles'	 => true, // Enable all Google Font style/weight variations to be added to the page
						'output'		 => array( 'h3', '.content-area h3' ), // An array of CSS selectors to apply this font style to dynamically
						'units'			 => 'px', // Defaults to px
						'subtitle'		 => esc_html__( 'Each property can be called individually.', 'factory' ),
						'default'		 => array(
							'color'			 => '#222',
							'font-weight'	 => '300',
							'font-family'	 => 'Roboto',
							'google'		 => true,
							'font-size'		 => '28px',
							'line-height'	 => '42px',
						),
					),
					array(
						'id'			 => 'opt-typography-h4',
						'type'			 => 'typography',
						'title'			 => esc_html__( 'Heading 4 Style', 'factory' ),
						'google'		 => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'	 => true, // Select a backup non-google font in addition to a google font
						'text-transform' => true,
						'letter-spacing' => true, // Defaults to false
						'all_styles'	 => true, // Enable all Google Font style/weight variations to be added to the page
						'output'		 => array( 'h4', '.content-area h4', 'body .vc_separator h4' ), // An array of CSS selectors to apply this font style to dynamically
						'units'			 => 'px', // Defaults to px
						'subtitle'		 => esc_html__( 'Each property can be called individually.', 'factory' ),
						'default'		 => array(
							'color'			 => '#222',
							'font-weight'	 => '300',
							'font-family'	 => 'Roboto',
							'google'		 => true,
							'font-size'		 => '22px',
							'line-height'	 => '32px',
						),
					),
					array(
						'id'			 => 'opt-typography-h5',
						'type'			 => 'typography',
						'title'			 => esc_html__( 'Heading 5 Style', 'factory' ),
						'google'		 => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'	 => true, // Select a backup non-google font in addition to a google font
						'text-transform' => true,
						'letter-spacing' => true, // Defaults to false
						'all_styles'	 => true, // Enable all Google Font style/weight variations to be added to the page
						'output'		 => array( 'h5', '.content-area h5' ), // An array of CSS selectors to apply this font style to dynamically
						'units'			 => 'px', // Defaults to px
						'subtitle'		 => esc_html__( 'Each property can be called individually.', 'factory' ),
						'default'		 => array(
							'color'			 => '#222',
							'font-weight'	 => '300',
							'font-family'	 => 'Roboto',
							'google'		 => true,
							'font-size'		 => '20px',
							'line-height'	 => '30px',
						),
					),
					array(
						'id'			 => 'opt-typography-h6',
						'type'			 => 'typography',
						'title'			 => esc_html__( 'Heading 6 Style', 'factory' ),
						'google'		 => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'	 => true, // Select a backup non-google font in addition to a google font
						'text-transform' => true,
						'letter-spacing' => true, // Defaults to false
						'all_styles'	 => true, // Enable all Google Font style/weight variations to be added to the page
						'output'		 => array( 'h6', '.content-area h6' ), // An array of CSS selectors to apply this font style to dynamically
						'units'			 => 'px',
						'subtitle'		 => esc_html__( 'Each property can be called individually.', 'factory' ),
						'default'		 => array(
							'color'			 => '#343e47',
							'font-weight'	 => '300',
							'font-family'	 => 'Roboto',
							'google'		 => true,
							'font-size'		 => '15px',
							'line-height'	 => '23px',
						),
					),
					array(
						'id'			 => 'cg-type-widget-title',
						'type'			 => 'typography',
						'title'			 => esc_html__( 'Widget Title Typeface', 'factory' ),
						'google'		 => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'	 => true, // Select a backup non-google font in addition to a google font
						'text-transform' => true,
						'letter-spacing' => true, // Defaults to false
						'all_styles'	 => true, // Enable all Google Font style/weight variations to be added to the page
						'output'		 => array( 'h4.widget-title', '#secondary h4.widget-title a', '.subfooter h4' ), // An array of CSS selectors to apply this font style to dynamically
						'units'			 => 'px',
						'subtitle'		 => esc_html__( 'Each property can be called individually.', 'factory' ),
						'default'		 => array(
							'color'			 => '#222',
							'font-weight'	 => '400',
							'font-family'	 => 'Roboto Condensed',
							'google'		 => true,
							'font-size'		 => '17px',
							'line-height'	 => '23px',
							'text-transform' => 'uppercase',
						),
					),
				),
			);

			$this->sections[] = array(
				'title'	 => esc_html__( 'News Settings', 'factory' ),
				'desc'	 => esc_html__( 'Manage your news settings.', 'factory' ),
				'icon'	 => 'el-icon-file-edit',
				'fields' => array(
					array(
						'id'		 => 'factorycommercegurus_blog_page_title',
						'type'		 => 'text',
						'title'		 => esc_html__( 'News Page Title', 'factory' ),
						'default'	 => esc_html__( 'News', 'factory' ),
					),

					array(
						'desc' => esc_html__( 'Upload an optional background image for your news archives page title. The image should be at least 1200px wide.', 'commercegurus' ),
						'id' => 'factorycommercegurus_blog_archive_title_bg_img',
						'type' => 'media',
						'title' => esc_html__( 'News Archive Title Background Image', 'factory' ),
						'url' => true,
					),

					array(
						'id' 		 => 'factorycommercegurus_news_layout',
						'type' 		 => 'select',
						'options' 	 => array(
							'default-news' 		=> 'Default',
							'grid-news' 		=> 'Grid (3 columns)',
							'grid-news-two' 	=> 'Grid (2 columns)',
						),
						'title'		 => esc_html__( 'News Layout', 'factory' ),
						'default' => 'default-news',
					),

					array(
						'id'		 => 'factorycommercegurus_blog_sidebar',
						'type'		 => 'select',
						'options'	 => array(
							'default'	 => esc_html__( 'Left sidebar', 'factory' ),
							'right'		 => esc_html__( 'Right sidebar', 'factory' ),
							'none'		 => esc_html__( 'No sidebar', 'factory' ),
						),
						'title'		 => esc_html__( 'Choose a sidebar position for the news archive page', 'factory' ),
						'default'	 => 'default',
					),

					array(
						'id'		 => 'factorycommercegurus_post_sidebar',
						'type'		 => 'select',
						'options'	 => array(
							'default'	 => esc_html__( 'Left sidebar', 'factory' ),
							'right'		 => esc_html__( 'Right sidebar', 'factory' ),
							'none'		 => esc_html__( 'No sidebar', 'factory' ),
						),
						'title'		 => esc_html__( 'Choose a sidebar position for an individual post', 'factory' ),
						'default'	 => 'default',
					),
				),
			);

			$this->sections[] = array(
				'title'	 => esc_html__( 'Custom Code', 'factory' ),
				'desc'	 => esc_html__( 'Add some custom code.', 'factory' ),
				'fields' => array(
					array(
						'title'	 => esc_html__( 'Custom CSS', 'factory' ),
						'desc'	 => esc_html__( 'Add some custom css to your site?', 'factory' ),
						'id'	 => 'factorycommercegurus_custom_css',
						'type'	 => 'ace_editor',
						'mode'	 => 'css',
						'theme'	 => 'monokai',
					),
				),
			);
		}

		public function setHelpTabs() {

			// Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
			$this->args['help_tabs'][] = array(
				'id'		 => 'redux-help-tab-1',
				'title'		 => esc_html__( 'Theme Information 1', 'redux-framework-demo' ),
				'content'	 => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' ),
			);

			$this->args['help_tabs'][] = array(
				'id'		 => 'redux-help-tab-2',
				'title'		 => esc_html__( 'Theme Information 2', 'redux-framework-demo' ),
				'content'	 => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' ),
			);

			// Set the help sidebar
			$this->args['help_sidebar'] = esc_html__( '<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo' );
		}

		/**
		 * Redux config
		 * */
		public function setArguments() {

			$theme = wp_get_theme(); // For use with some settings. Not necessary.

			$this->args = array(
				// TYPICAL -> Change these values as you need/desire
				'opt_name'				 => 'factorycommercegurus_reduxopt', // This is where your data is stored in the database and also becomes your global variable name.
				'display_name'			 => $theme->get( 'Name' ), // Name that appears at the top of your panel
				'display_version'		 => $theme->get( 'Version' ), // Version that appears at the top of your panel
				'menu_type'				 => 'menu', // Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
				'allow_sub_menu'		 => true, // Show the sections below the admin menu item or not
				'menu_title'			 => esc_html__( 'Theme Options', 'factory' ),
				'page_title'			 => esc_html__( 'Theme Options', 'factory' ),
				// You will need to generate a Google API key to use this feature.
				// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
				'google_api_key'		 => 'AIzaSyB9TDy0IOriQpR8gt2TmoaZ070oWgIhvcs', // Must be defined to add google fonts to the typography module
				'google_update_weekly'	 => true,
				'async_typography'		 => false, // Use a asynchronous font on the front end or font string
				'admin_bar'				 => true, // Show the panel pages on the admin bar
				'global_variable'		 => 'factorycommercegurus_options', // Set a different name for your global variable other than the opt_name
				'dev_mode'				 => false, // Show the time the page took to load, etc
				'customizer'			 => true, // Enable basic customizer support
				// 'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
				// 'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
				// OPTIONAL -> Give you extra features
				'page_priority'			 => null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
				'page_parent'			 => 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
				'page_permissions'		 => 'manage_options', // Permissions needed to access the options panel.
				'menu_icon'				 => '', // Specify a custom URL to an icon
				'last_tab'				 => '', // Force your panel to always open to a specific tab (by id)
				'page_icon'				 => 'icon-themes', // Icon displayed in the admin panel next to your menu_title
				'page_slug'				 => 'factorycommercegurus_reduxopt', // Page slug used to denote the panel
				'save_defaults'			 => true, // On load save the defaults to DB before user clicks save or not
				'default_show'			 => false, // If true, shows the default value next to each field that is not the default value.
				'default_mark'			 => '*', // What to print by the field's title if the value shown is default. Suggested: *
				'show_import_export'	 => true, // Shows the Import/Export panel when not used as a field.
				// CAREFUL -> These options are for advanced use only
				'transient_time'		 => 60 * MINUTE_IN_SECONDS,
				'output'				 => true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
				'output_tag'			 => true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
				'footer_credit'			 => false, // Disable the footer credit of Redux. Please leave if you can help it.
				// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
				'database'				 => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
				'system_info'			 => false, // REMOVE
				// HINTS
				'hints'					 => array(
					'icon'			 => 'icon-question-sign',
					'icon_position'	 => 'right',
					'icon_color'	 => 'lightgray',
					'icon_size'		 => 'normal',
					'tip_style'		 => array(
						'color'		 => 'light',
						'shadow'	 => true,
						'rounded'	 => false,
						'style'		 => '',
					),
					'tip_position'	 => array(
						'my' => 'top left',
						'at' => 'bottom right',
					),
					'tip_effect'	 => array(
						'show'	 => array(
							'effect'	 => 'slide',
							'duration'	 => '500',
							'event'		 => 'mouseover',
						),
						'hide'	 => array(
							'effect'	 => 'slide',
							'duration'	 => '500',
							'event'		 => 'click mouseleave',
						),
					),
				),
			);

			// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
			// $this->args[ 'share_icons' ][] = array(
			// 'url' => 'https://github.com/ReduxFramework/ReduxFramework',
			// 'title' => 'Visit us on GitHub',
			// 'icon' => 'el-icon-github'
			// 'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
			// );
			$this->args['share_icons'][] = array(
			    'url' => 'https://www.facebook.com/CommerceGurus-1687149888185740',
			    'title' => 'Like us on Facebook',
			    'icon' => 'el-icon-facebook',
			);
			$this->args['share_icons'][] = array(
				'url'	 => esc_html__( 'http://twitter.com/commercegurus', 'factory' ),
				'title'	 => esc_html__( 'Follow us on Twitter', 'factory' ),
				'icon'	 => 'el-icon-twitter',
			);
			// Panel Intro text -> before the form
			if ( ! isset( $this->args['global_variable'] ) || $this->args['global_variable'] !== false ) {
				if ( ! empty( $this->args['global_variable'] ) ) {
					$v = $this->args['global_variable'];
				} else {
					$v = str_replace( '-', '_', $this->args['opt_name'] );
				}
			} else {
			}

		}

	}

	global $reduxConfig;
	$reduxConfig = new Factorycommercegurus_Redux_Framework_config();
}// End if().

/**
 * Custom function for the callback referenced above
 */
if ( ! function_exists( 'redux_theme_my_custom_field' ) ) :

	function redux_theme_my_custom_field( $field, $value ) {
		print_r( $field );
		echo '<br/>';
		print_r( $value );
	}

endif;

/**
 * Custom function for the callback validation referenced above
 * */
if ( ! function_exists( 'redux_theme_validate_callback_function' ) ) :

	function redux_theme_validate_callback_function( $field, $value, $existing_value ) {
		$error	 = false;
		$value	 = 'just testing';

		$return['value'] = $value;
		if ( $error == true ) {
			$return['error'] = $field;
		}
		return $return;
	}

endif;
