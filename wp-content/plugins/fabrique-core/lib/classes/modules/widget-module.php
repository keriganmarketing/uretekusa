<?php

class Fabrique_Widget_Module extends Fabrique_Base_Module
{
	const API_WIDGET_SIDEBAR_CREATE = 'widget/sidebar-create';
	const API_WIDGET_SIDEBAR_DELETE = 'widget/sidebar-delete';

	protected $sidebar_names;

	public function __construct( $fabrique_core, $options = array() )
	{
		parent::__construct( $fabrique_core, $options );

		$this->sidebar_names = array();
	}

	public function get_name()
	{
		return 'widget';
	}

	public function start()
	{
		if ( function_exists( 'fabrique_get_title' ) ) {
			$title = fabrique_get_title( array( 'size' => 'h3' ), false );
		} else {
			$title = array(
				'prefix' => '',
				'suffix' => ''
			);
		}

		$prefix = isset( $title['prefix'] ) ? $title['prefix'] : '';
		$suffix = isset( $title['suffix'] ) ? $title['suffix'] : '';

		$sidebar = array(
			'class' => 'fabrique_theme js-dynamic-sidebar',
			'description' => esc_html__( 'Custom Widget', 'fabrique-core' ),
			'before_title' => $prefix,
			'after_title' => $suffix
		);

		$sidebar['class'] = 'fabrique_core-dynamic js-dynamic-sidebar';
		$dynamic_sidebars = get_option( 'fabrique_core_widget_dynamic_sidebars', array() );

		foreach ( $dynamic_sidebars as $sidebar_name ) {
			$sidebar['name'] = $sidebar_name;
			$sidebar['id'] = $this->process_sidebar_name( $sidebar_name );

			$this->widget_register_sidebar( $sidebar );
		}

		add_action( 'admin_enqueue_scripts', array( $this, 'widgets_admin_enqueue_scripts' ) );
		add_action( 'wp_ajax_fabrique_core_widget_api', array( $this, 'widget_api' ) );

		// Enable shortcode in widget_text
		add_filter( 'widget_text', 'do_shortcode' );
		// Add extra optiom to WP existing widget
		add_filter( 'in_widget_form', array( $this, 'add_menu_widget_extra_options' ), 10, 3 );
		// Save extra options for menu widget
		add_filter( 'widget_update_callback', array( $this, 'save_widget_menu_extra_options' ), 10, 2 );
		// Add class to menu widget according to the extra options
		add_filter( 'dynamic_sidebar_params', array( $this, 'widget_menu_extra_control' ) );
	}

	public function widgets_admin_enqueue_scripts( $hook )
	{
		if ( $hook !== 'widgets.php' ) {
			return;
		}

		$options = apply_filters( 'blueprint_options', null );

		wp_enqueue_media();
		do_action( 'fabrique_core_widgets_scripts', array(
			'jquery',
			'underscore',
			'backbone'
		), $options, fabrique_core_translation() );
	}

	public function widget_register_sidebar( $sidebar, $theme_sidebar = false )
	{
		if ( false === isset( $sidebar['name'] ) ) {
			return false;
		}

		if ( false === ( $theme_sidebar || $this->is_valid_sidebar_name( $sidebar['name'] ) ) ) {
			return false;
		}


		register_sidebar( $sidebar );

		if ( !$theme_sidebar ) {
			$this->sidebar_names[] = $sidebar['name'];
		}
	}

	public function widget_api()
	{
		if ( false === ( isset( $_POST['api_action'] ) && isset( $_POST['sidebar_name'] ) ) ) {
			return $this->api_error_response( array(
				'error' => esc_html__( 'bad_request', 'fabrique-core' ),
				'message' => esc_html__( 'Bad Request', 'fabrique-core' )
			) );
		}

		$api_action = $_POST['api_action'];
		$sidebar_name = $_POST['sidebar_name'];

		if ( 'create' === $api_action ) {
			$error = $this->widget_create_sidebar( $sidebar_name );

			if ( $error ) {
				$this->api_error_response( array(
					'api_action' => $api_action,
					'sidebar_name' => $sidebar_name,
					'error' => $error['error'],
					'message' => $error['message']
				) );
			} else {
				wp_send_json_success( array( 'api_action' => $api_action, 'result' => $sidebar_name ) );
			}
		} else if ( 'delete' === $api_action ) {
			$error = $this->widget_delete_sidebar( $sidebar_name );

			if ( $error ) {
				$this->api_error_response(array(
					'api_action' => $api_action,
					'sidebar_name' => $sidebar_name,
					'error' => $error['error'],
					'message' => $error['message']
				));
			} else {
				wp_send_json_success( array( 'api_action' => $api_action, 'result' => $sidebar_name ) );
			}
		}
	}

	public function widget_create_sidebar( $sidebar_name )
	{
		$error = null;

		if ( $this->is_valid_sidebar_name( $sidebar_name ) ) {
			$this->sidebar_names[] = $sidebar_name;

			$result = update_option( 'fabrique_core_widget_dynamic_sidebars', $this->sidebar_names, true );

			if ( !$result ) {
				$error = array(
					'error' => esc_html__( 'update_option_failed', 'fabrique-core' ),
					'message' => esc_html__( 'Failed to update sidebar', 'fabrique-core' )
				);
			}

			return $result;
		} else {
			$error = array(
				'error' => esc_html__( 'invalid_sidebar_name', 'fabrique-core' ),
				'message' => esc_html__( 'Please try a different sidebar name', 'fabrique-core' )
			);
		}

		return $error;
	}

	public function widget_delete_sidebar( $sidebar_name )
	{
		$error = null;

		$is_theme_sidebar = $this->is_theme_sidebar( $sidebar_name );
		$is_sidebar = in_array( $sidebar_name, $this->sidebar_names );

		if ( $is_theme_sidebar || ( false === $is_sidebar ) ) {
			$error = array(
				'error' => esc_html__( 'invalid_sidebar_name', 'fabrique-core' ),
				'message' => esc_html__( 'Please try a different sidebar name', 'fabrique-core' )
			);
		} else {
			$key = array_search( $sidebar_name, $this->sidebar_names );
			unset( $this->sidebar_names[$key] );

			$result = update_option( 'fabrique_core_widget_dynamic_sidebars', $this->sidebar_names, true );

			if ( !$result ) {
				$error = array(
					'error' => esc_html__( 'update_option_failed', 'fabrique-core' ),
					'message' => esc_html__( 'Failed to update sidebar', 'fabrique-core' )
				);
			}

			return $result;
		}

		return $error;
	}

	/**
	 * These sidebar names are not able to be translated, since "name" can also be used to call dynamic sidebar.
	 */
	protected function get_default_sidebars()
	{
		return array(
			'fabrique-sidebar',
			'fabrique-topbar-1',
			'fabrique-topbar-2',
			'fabrique-topbar-3',
			'fabrique-topbar-4',
			'fabrique-navbar-stacked-left',
			'fabrique-navbar-stacked-right',
			'fabrique-navbar-standard-right',
			'fabrique-navbar-mobile',
			'fabrique-navbar-full',
			'fabrique-navbar-offcanvas',
			'fabrique-navbar-side',
			'fabrique-headerwidget-1',
			'fabrique-headerwidget-2',
			'fabrique-headerwidget-3',
			'fabrique-headerwidget-4'
		);
	}

	protected function process_sidebar_name( $sidebar_name )
	{
		return str_replace( ' ', '-', strtolower( $sidebar_name ) );
	}

	protected function is_valid_sidebar_name( $sidebar_name )
	{
		if ( empty( $sidebar_name ) )
			return false;

		if ( $this->is_theme_sidebar( $sidebar_name ) )
			return false;

		$processed_name = $this->process_sidebar_name( $sidebar_name );
		$processed_sidebar_names = array_map( array( $this, 'process_sidebar_name' ), $this->sidebar_names );

		if ( in_array( $processed_name, $processed_sidebar_names ) ) {
			return false;
		}

		return true;
	}

	protected function is_theme_sidebar( $sidebar_name )
	{
		$processed_name = $this->process_sidebar_name( $sidebar_name );

		$theme_sidebars = $this->get_default_sidebars();

		if ( in_array( $processed_name, $theme_sidebars ) )
			return true;

		return false;
	}

	public function handle_api_action( $endpoint, $params )
	{
		switch ( $endpoint ) {
			case self::API_WIDGET_SIDEBAR_CREATE:
				if ( !isset( $params['name'] ) ) {
					return array(
						'error' => 'bad_request',
						'error_message' => 'Bad Request : missing name parameter'
					);
				}

				return $this->widget_create_sidebar( $params['name'] );
			case self::API_WIDGET_SIDEBAR_DELETE:
				if ( !isset( $params['name'] ) ) {
					return array(
						'error' => 'bad_request',
						'error_message' => 'Bad Request : missing name parameter'
					);
				}

				return $this->widget_delete_sidebar( $params['name'] );
			default:
				return false;
		}
	}

	public function add_menu_widget_extra_options( $widget, $return, $instance )
	{
		if ( 'nav_menu' == $widget->id_base ) {
			$output = '';
			$style = isset( $instance['style'] ) ? $instance['style'] : '';

			$output .= '<p>';
			$output .= 	'<label for="' . $widget->get_field_id( 'style' ) . '">' . esc_html__( 'Menu Style: ', 'fabrique-core' ) . '</label>';
			$output .= 	'<select id="' . $widget->get_field_id( 'style' ) . '" name="' . $widget->get_field_name( 'style' ) . '">';
			$output .= 		'<option value="" ' . selected( $style, '', false ) . '>' . esc_html( 'Standard', 'fabrique-core' ) . '</option>';
			$output .= 		'<option value="link" ' . selected( $style, 'link', false ) . '>' . esc_html( 'Link', 'fabrique-core' ) . '</option>';
			$output .= 		'<option value="inline" ' . selected( $style, 'inline', false ) . '>' . esc_html( 'Inline', 'fabrique-core' ) . '</option>';
			$output .= 		'<option value="side" ' . selected( $style, 'side', false ) . '>' . esc_html( 'Side', 'fabrique-core' ) . '</option>';
			$output .= 		'<option value="anchor" ' . selected( $style, 'anchor', false ) . '>' . esc_html( 'Anchor', 'fabrique-core' ) . '</option>';
			$output .= 	'</select>';
			$output .= '</p>';

			echo fabrique_core_escape_content( $output );
		}
	}

	public function save_widget_menu_extra_options( $instance, $new_instance )
	{
		// Is the instance a nav menu and are inline enabled?
		if ( isset( $new_instance['nav_menu'] ) ) {
			if ( !empty( $new_instance['style'] ) ) {
				$new_instance['style'] = $new_instance['style'];
			}
		}

		return $new_instance;
	}

	public function add_widget_menu_extra_class( $nav_menu_args, $nav_menu, $args, $instance )
	{
		$nav_menu_args['menu_class'] = 'menu ' . esc_attr( $instance['style'] );
		if ( 'side' === $instance['style'] ) {
			$nav_menu_args['menu_class'] .= ' fbq-p-border-border';
		}

		return $nav_menu_args;
	}

	public function widget_menu_extra_control( $params )
	{
		$widget_settings = get_option( 'widget_nav_menu' );
		if ( !empty( $widget_settings[$params[1]['number']]['style'] ) ) {
			add_filter( 'widget_nav_menu_args', array( $this, 'add_widget_menu_extra_class' ), 10, 4 );
		} else {
			remove_filter( 'widget_nav_menu_args', array( $this, 'add_widget_menu_extra_class' ), 10, 4 );
		}

		return $params;
	}
}
