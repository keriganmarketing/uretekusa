<?php

class Fabrique_Core_Module extends Fabrique_Base_Module
{
	const MENU_SLUG = 'fabrique_core';

	public function get_name()
	{
		return 'core';
	}

	public function start()
	{
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

		// Manage Nonce
		add_action( 'admin_post_bp_admin', array( $this, 'core_admin_home' ) );

		// Redirect page to maintenance page or custom 404
		add_action( 'template_redirect', array( $this, 'fabrique_core_template_redirect' ) );

		add_action( 'wp_update_nav_menu_item', array( $this, 'core_update_nav_menu_item' ), 9, 3 );
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'core_edit_nav_menu_walker' ), 9 );
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'core_setup_nav_menu_item' ), 9 );

		// Add extra fields to attachment edit
		add_filter( 'attachment_fields_to_edit', array( $this, 'core_attachment_fields_to_edit' ), 9, 2 );
		add_filter( 'attachment_fields_to_save', array( $this, 'core_attachment_fields_to_save' ), 9, 2 );
	}

	public function admin_enqueue_scripts( $hook )
	{
		if ( 'nav-menus.php' === $hook ) {
			$options = array(
				'page' => 'menu',
				'post_url' => admin_url( 'admin-post.php' ),
				'ajax_url' => admin_url( 'admin-ajax.php' )
			);

			wp_enqueue_media();
			do_action( 'fabrique_core_admin_scripts', array(
				'jquery',
				'underscore',
				'backbone'
			), $options, fabrique_core_translation() );
		}
	}

	public function admin_menu()
	{
		add_menu_page(
			__( 'Fabrique Core', 'fabrique-core'),
			__( 'Fabrique', 'fabrique-core'),
			'switch_themes',
			self::MENU_SLUG,
			array( $this, 'render_admin_app' ),
			'dashicons-admin-home',
			2
		);

		add_submenu_page(
			self::MENU_SLUG,
			__( 'Demos', 'fabrique-core' ),
			__( 'Demos', 'fabrique-core' ),
			'switch_themes',
			'demos',
			array( $this, 'render_admin_app' )
		);

		add_submenu_page(
			self::MENU_SLUG,
			__( 'Customizer Manager', 'fabrique-core' ),
			__( 'Customizer Manager', 'fabrique-core' ),
			'switch_themes',
			'customizer',
			array( $this, 'render_admin_app' )
		);

		add_submenu_page(
			self::MENU_SLUG,
			__( 'Font Manager', 'fabrique-core' ),
			__( 'Font Manager', 'fabrique-core' ),
			'switch_themes',
			'font-manager',
			array( $this, 'render_admin_app' )
		);

		add_submenu_page(
			self::MENU_SLUG,
			__( 'System Status', 'fabrique-core' ),
			__( 'System Status', 'fabrique-core' ),
			'switch_themes',
			'system-status',
			array( $this, 'render_admin_app' )
		);
	}

	private function check_admin_post_nonce( $action )
	{
		if ( empty( $_POST ) ) {
			$this->base_admin_redirect( 'admin', 'error', __( 'invalid admin nonce', 'fabrique-core' ) );
		}

		check_admin_referer( $action, 'bp_admin_nonce' );
	}

	public function core_admin_home()
	{
		$this->check_admin_post_nonce( 'bp_admin' );

		if ( isset( $_POST['maintenance_mode'] ) ) {
			update_option( 'bp_maintenance_mode', true, true );
		} else {
			update_option( 'bp_maintenance_mode', false, true );
		}

		if ( isset( $_POST['maintenance_page_id'] ) && !empty( $_POST['maintenance_page_id'] ) ) {
			update_option( 'bp_maintenance_page_id', $_POST['maintenance_page_id'], true );
		}

		if ( isset( $_POST['404_page_id'] ) ) {
			update_option( 'bp_404_page_id', $_POST['404_page_id'], true );
		}

		$this->base_admin_redirect( self::MENU_SLUG, 'success', __( 'Settings Updated', 'fabrique-core' ) );
	}

	public function render_admin_app()
	{
		$screen = get_current_screen();
		$menu_slug = self::MENU_SLUG;

		$current_page = str_replace( 'fabrique_page_' , '', $screen->id );
		if ( $current_page === 'toplevel_page_' . $menu_slug ) {
			$current_page = $menu_slug;
		}

		$options = apply_filters( 'blueprint_options', array(
			'page' => $current_page,
			'post_url' => admin_url( 'admin-post.php' ),
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'all_slug' => array(
				$menu_slug => array(
					'name' => esc_html__( 'Home', 'fabrique-core' ),
					'template' => 'home',
					'icon' => 'ln-home'
				),
				'demos' => array(
					'name' => esc_html__( 'Demo', 'fabrique-core' ),
					'template' => 'demos',
					'icon' => 'et-layers'
				),
				'customizer' => array(
					'name' => esc_html__( 'Customizer', 'fabrique-core' ),
					'template' => 'customizer',
					'icon' => 'et-adjustments'
				),
				'font-manager' => array(
					'name' => esc_html__( 'Fonts', 'fabrique-core' ),
					'icon' => 'ln-text-size'
				),
				'system-status' => array(
					'name' => esc_html__( 'System', 'fabrique-core' ),
					'template' => 'system',
					'icon' => 'et-speedometer'
				),
				'tgmpa-install-plugins' => array(
					'name' => esc_html__( 'Plugins', 'fabrique-core' ),
					'icon' => 'et-puzzle'
				)
			)
		) );

		do_action( 'fabrique_core_admin_scripts', array(
			'jquery',
			'underscore',
			'backbone'
		), $options, fabrique_core_translation() );

		fabrique_core_template( 'admin_app', $options );
	}

	public function fabrique_core_template_redirect()
	{
		$maintenance_mode = get_option( 'bp_maintenance_mode' );
		$maintenance_page_id = get_option( 'bp_maintenance_page_id' );
		$error_page_id = get_option( 'bp_404_page_id' );
		$error_page_id = !empty( $error_page_id ) ? $error_page_id : 'default';

		if ( $maintenance_mode && !empty( $maintenance_page_id ) ) {
			if ( ( !current_user_can( 'edit_themes' ) || !is_user_logged_in() ) && !is_page( $maintenance_page_id ) ) {
				wp_redirect( home_url( 'index.php?page_id=' . $maintenance_page_id ) );
				exit;
			}
		}

		if ( 'default' !== $error_page_id && is_404() ) {
			wp_redirect( home_url( 'index.php?page_id=' . $error_page_id ) );
			exit;
		}
	}

	public function core_edit_nav_menu_walker()
	{
		return 'Fabrique_Nav_Menu_Edit';
	}

	private function core_nav_menu_extra_options()
	{
		return apply_filters( 'nav_menu_extra_options', array(
			'nav_menu_icon',
			'nav_menu_icon_position',
			'nav_menu_mega_columns',
			'nav_menu_mega_blueprint',
			'nav_menu_sub_background',
			'nav_menu_sub_sidebar'
		) );
	}

	public function core_setup_nav_menu_item( $menu_item )
	{
		$extra_options = $this->core_nav_menu_extra_options();

		foreach ( $extra_options as $option ) {
			if ( isset( $menu_item->post_type ) && $menu_item->post_type == 'nav_menu_item' ) {
				$menu_item->$option = get_post_meta( $menu_item->ID, $option, true );
			}
		}

		return $menu_item;
	}

	public function core_update_nav_menu_item( $menu_id, $menu_item_db_id, $args )
	{
		$extra_options = $this->core_nav_menu_extra_options();

		foreach ( $extra_options as $option ) {
			if ( isset( $_REQUEST[$option] ) && is_array( $_REQUEST[$option] ) && isset( $_REQUEST[$option][$menu_item_db_id] ) ) {
				$value = $_REQUEST[$option][$menu_item_db_id];
				update_post_meta( $menu_item_db_id, $option, $value );
			}
		}
	}

	public function core_attachment_fields_to_edit( $form_fields, $post = null )
	{
		foreach ( $this->core_attachment_fields() as $field => $values ) {
			$match_mime_type = preg_match( "/" . $values['application'] . "/", $post->post_mime_type );

			if ( $match_mime_type && ! in_array( $post->post_mime_type, $values['exclusions'] ) ) {
				$html = '';
				$meta = get_post_meta( $post->ID, '_' . $field, true );
				$values['input'] = 'html';

				if ( isset( $values['options'] ) ) {
					$html .= '<select name="attachments[' . $post->ID . '][' . $field . ']">';
					foreach ( $values['options'] as $key => $value ) {
						$selected = ( $meta == $key ) ? ' selected="selected"' : '';
						$html .= '<option' . $selected . ' value="' . $key . '">' . $value . '</option>';
					}
					$html .= '</select>';
				}

				$values['html'] = $html;
				$values['value'] = $meta;
				$form_fields[$field] = $values;
			}
		}

		return $form_fields;
	}

	public function core_attachment_fields_to_save( $post, $attachment )
	{
		foreach ( $this->core_attachment_fields() as $field => $values ) {
			if ( isset( $attachment[$field] ) ) {
				update_post_meta( $post['ID'], '_' . $field, $attachment[$field] );
			} else {
				delete_post_meta( $post['ID'], $field );
			}
		}

		return $post;
	}

	protected function core_attachment_fields()
	{
		return array(
			'masonry_width' => array(
				'label'       => esc_html__( 'Masonry Width', 'fabrique-core' ),
				'options' => array(
					1 => '1',
					2 => '2',
					3 => '3',
					4 => '4',
					5 => '5',
					6 => '6'
				),
				'application' => 'image',
				'exclusions'   => array( 'audio', 'video' )
			),
			'masonry_height' => array(
				'label'       => esc_html__( 'Masonry Height', 'fabrique-core' ),
				'options' => array(
					1 => '1',
					2 => '2',
					3 => '3',
					4 => '4',
					5 => '5',
					6 => '6'
				),
				'application' => 'image',
				'exclusions'   => array( 'audio', 'video' )
			)
		);
	}
}
