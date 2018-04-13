<?php

class Fabrique_Core_Menu_Pages
{
	public $pages = array();

	public function __construct()
	{
		if ( !defined( 'CORE_MENU_PAGES_CLASSES' ) ) {
			define( 'CORE_MENU_PAGES_CLASSES', untrailingslashit( plugin_dir_path( __FILE__ ) ) . '/menu-pages/' );
		}

		require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
		require_once( CORE_MENU_PAGES_CLASSES . 'admin-page.php' ); // to be a base of add_menu and add_submenu function
		require_once( CORE_MENU_PAGES_CLASSES . 'admin-section.php' );
		require_once( CORE_MENU_PAGES_CLASSES . 'admin-setting.php' );

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_script' ) );
	}

	// Add menu page
	public function add_menu( $args )
	{
		$class = 'Fabrique_Core_Admin_Menu';
		if ( !class_exists( $class ) ) {
			require_once( CORE_MENU_PAGES_CLASSES . 'admin-menu.php' );
		}
		$this->pages[$args['id']] = new $class( $args );
	}

	// Add submenu page
	public function add_submenu( $args )
	{
		$class = 'Fabrique_Core_Admin_Submenu';
		if ( !class_exists( $class ) ) {
			require_once( CORE_MENU_PAGES_CLASSES . 'admin-submenu.php' );
		}
		$this->pages[$args['id']] = new $class( $args );
	}

	// Add section to page
	public function add_section( $args )
	{
		$this->pages[$args['page']]->add_page_section( new Fabrique_Core_Admin_Section( $args ) );
	}

	// Add setting to section
	public function add_setting( $args )
	{
		$args['input_name'] = $args['page'] . '[' . $args['id'] . ']';
		$args['tab'] = $this->pages[$args['page']]->sections[$args['section']]->get_section_page_slug();
		$class = 'Fabrique_Core_Admin_Setting_' . ucfirst( $args['type'] );

		if ( !class_exists( $class ) ) {
			require_once( CORE_MENU_PAGES_CLASSES . '/settings/' . $args['type'] . '.php' );
		}

		$this->pages[$args['page']]->sections[$args['section']]->add_section_setting( new $class( $args ) );
	}

	// Add pages
	public function add_admin_pages()
	{
		foreach ( $this->pages as $id => $page ) {
			add_action( 'admin_menu', array( $page, 'add_admin_menu' ) );
			add_action( 'admin_init', array( $page, 'register_admin_menu' ) );
		}
	}

	// Enqueue the style and script
	public function enqueue_script()
	{
		$screen = get_current_screen();
		foreach ( $this->pages as $id => $page ) {
			if ( strpos( $screen->base, $id ) !== false ) {
				$options = apply_filters( 'menu_pages_options', null );
				do_action( 'fabrique_core_menu_pages_scripts', array(
					'jquery',
					'underscore',
					'backbone'
				), $options );
			}
		}
	}
}
