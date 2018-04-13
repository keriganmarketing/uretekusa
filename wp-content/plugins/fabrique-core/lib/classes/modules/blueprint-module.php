<?php

class Fabrique_Blueprint_Module extends Fabrique_Base_Module
{
	const API_BLUEPRINT_LINK = 'blueprint/link';
	const API_BLUEPRINT_LOAD = 'blueprint/load';
	const API_BLUEPRINT_SAVE = 'blueprint/save';
	const API_BLUEPRINT_BLOCKS = 'blueprint/blocks';
	const API_BLUEPRINT_SIDEBARS = 'blueprint/sidebars';
	const API_BLUEPRINT_MENUS = 'blueprint/menus';
	const API_BLUEPRINT_PAGES = 'blueprint/pages';
	const API_BLUEPRINT_WPCONTENT = 'blueprint/wpcontent';
	const API_BLUEPRINT_CATEGORIES = 'blueprint/categories';
	const API_BLUEPRINT_PRESET_TEMPLATES = 'blueprint/preset-templates';
	const API_BLUEPRINT_TEMPLATE_CONTENT = 'blueprint/template-content';
	const API_BLUEPRINT_TEMPLATES = 'blueprint/templates';
	const API_BLUEPRINT_TEMPLATE_CREATE = 'blueprint/template-create';
	const API_BLUEPRINT_TEMPLATE_DELETE = 'blueprint/template-delete';

	public function get_name()
	{
		return 'blueprint';
	}

	public function start()
	{
		add_action( 'add_meta_boxes', array( $this, 'blueprint_meta_boxes') );
		add_action( 'save_post', array( $this, 'save_post' ), 10, 3 );

		add_filter( 'blueprint_options', array( $this, 'blueprint_options' ) );
		add_filter( 'fabrique_core_blueprint_meta_boxes', array( $this, 'blueprint_meta_boxes' ) );
		add_filter( 'fabrique_core_blueprint_post_types', array( $this, 'supported_post_types' ) );
	}

	public function supported_post_types()
	{
		return apply_filters(
			'support_blueprint_post_types',
			array(
				'page',
				'post',
				'twcbp_block',
				'product'
			)
		);
	}

	public function blueprint_meta_boxes()
	{
		add_meta_box(
			'blueprint',
			'Twist Blueprint',
			array( $this, 'blueprint_builder'),
			$this->supported_post_types()
		);

		add_meta_box(
			'bpformatdiv',
			'Format Settings',
			array( $this, 'post_format_settings_builder' ),
			'post',
			'side'
		);
	}

	public function save_post( $post_id, $post, $update )
	{
		$post_type = get_post_type( $post_id );

		if ( !in_array( $post_type, $this->supported_post_types() ) ) {
			return;
		}

		if ( isset( $_POST['bp_data'] ) ) {
			$data = json_decode( stripslashes_deep($_POST['bp_data'] ), true );
			$this->save_blueprint_data( $post_id, $data );
		}
	}

	public function blueprint_builder( $post )
	{
		global $fabrique_core;

		$type = get_post_type( $post );
		$screen = get_current_screen();
		$dependencies = $this->blueprint_dependencies();
		$options = apply_filters( 'blueprint_options', null );

		$options['mode'] = ( 'twcbp_block' === $type ) ? 'block' : 'blueprint';
		$options['postType'] = $post->post_type;
		$options['postFormat'] = get_post_format( $post->ID );

		if ( 'add' !== $screen->action ) {
			$options['postId'] = $post->ID;
			$options['data'] = $this->get_blueprint_data( $post->ID );

			if ( 'post' === $post->post_type ) {
				$options['postFormatSettings'] = get_post_meta( $post->ID, 'bp_post_format_settings', true );

				$mode = get_post_meta( $post->ID, 'bp_post_settings_mode', true );

				if ( empty( $mode ) ) {
					$mode = 'global';
				}

				if ( 'custom' === $mode ) {
					$options['postSettings'] = get_post_meta( $post->ID, 'bp_post_settings', true );
				} else {
					$options['postSettings'] = get_theme_mod( 'post_settings' );
				}

				$options['postSettingsMode'] = $mode;
			}

		}

		do_action(
			'fabrique_core_blueprint_scripts',
			$dependencies,
			$options,
			fabrique_core_translation()
		);

		echo '<div id="bp-builder" class="bp bp--edit"></div>';

		$module = $this->fabrique_core->get_module( 'customize' );
		$values = $module->get_customize_values();

		echo '<style>' . fabrique_core_template_blueprint_style_custom( $values ) . '</style>';
	}

	public function blueprint_options( $options = array() )
	{
		$options['homepage'] = get_home_url();
		$options['apiEndpoint'] = admin_url( 'admin-ajax.php' );
		$options['assetUri'] = apply_filters( 'fabrique_asset_uri', get_template_directory_uri() );
		return $options;
	}

	public function post_format_settings_builder( $post )
	{
		echo '<div id="post-format-settings"></div>';
	}

	public function handle_api_action( $endpoint, $params )
	{
		switch ( $endpoint ) {
			case self::API_BLUEPRINT_LINK:
				return $this->get_blueprint_link( $params['post_id'] );
			case self::API_BLUEPRINT_LOAD:
				return $this->get_blueprint_data( $params['post_id'] );
			case self::API_BLUEPRINT_SAVE:
				$data = json_decode( stripslashes_deep($params['data'] ), true );
				return $this->save_blueprint_data( $params['post_id'], $data );
			case self::API_BLUEPRINT_SIDEBARS:
				return $this->get_sidebars();
			case self::API_BLUEPRINT_MENUS:
				return $this->get_menus();
			case self::API_BLUEPRINT_WPCONTENT:
				return $this->get_wp_content( $params['post_id'] );
			case self::API_BLUEPRINT_PAGES:
				return $this->get_pages();
			case self::API_BLUEPRINT_BLOCKS:
				return $this->get_blueprint_blocks();
			case self::API_BLUEPRINT_CATEGORIES:
				return $this->get_blueprint_categories();
			case self::API_BLUEPRINT_PRESET_TEMPLATES:
				return $this->get_blueprint_preset_templates();
			case self::API_BLUEPRINT_TEMPLATE_CONTENT:
				return $this->get_blueprint_template_content( $params['id'] );
			case self::API_BLUEPRINT_TEMPLATES:
				return $this->get_blueprint_user_templates( $params['mode'] );
			case self::API_BLUEPRINT_TEMPLATE_CREATE:
				return $this->create_blueprint_user_template( $params['name'], $params['data'], $params['mode'] );
			case self::API_BLUEPRINT_TEMPLATE_DELETE:
				return $this->delete_blueprint_user_template( $params['templateId'], $params['mode'] );
			default:
				return false;
		}
	}


	public function get_sidebars()
	{
		global $wp_registered_sidebars;

		$sidebars = array();

		foreach ( $wp_registered_sidebars as $sidebar ) {
			if ( preg_match("/fabrique-(navbar|footer|topbar|headerwidget)/", $sidebar['id'] ) ) {
				continue;
			}

			$sidebars[] = array( 'id' => $sidebar['id'], 'name' => $sidebar['name'] );
		}

		return $sidebars;
	}

	public function get_pages()
	{
		$data = array();
		$pages = get_pages( array(
			'post_status' => 'publish',
			'sort_column' => 'post_modified',
		) );

		foreach ( $pages as $page ) {
			$data[] = array(
				'id' => $page->ID,
				'title' => $page->post_title,
				'link' => get_permalink( $page->ID )
			);
		}

		return $data;
	}

	public function get_wp_content( $post_id )
	{
		$post = get_post( $post_id );
		return apply_filters( 'the_content', $post->post_content );
	}

	public function get_menus()
	{
		$menus = array();
		$registered_menus = wp_get_nav_menus();

		if ( $registered_menus ) {
			foreach ( $registered_menus as $menu ) {
				$menus[] = array( 'id' => $menu->term_id, 'name' => $menu->name );
			}
		}

		return $menus;
	}

	public function get_blueprint_data( $post_id )
	{
		return get_post_meta( $post_id, 'bp_data', true );
	}

	public function get_blueprint_link( $post_id )
	{
		return get_edit_post_link( $post_id );
	}

	public function get_blueprint_blocks()
	{
		$blocks = array();

		$posts = get_posts( array(
			'post_type' => 'twcbp_block',
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'orderby'=>'title',
			'order' => 'asc'
		) );

		foreach ( $posts as $post ) {
			$blocks[] = array(
				'id' => $post->ID,
				'title' => $post->post_title
			);
		}

		return array( 'blocks' => $blocks );
	}

	public function get_blueprint_categories()
	{
		return get_terms( 'category', array(
			'hide_empty' => false
		) );
	}

	public function save_blueprint_data( $post_id, $data = array() )
	{
		$updated = update_post_meta( $post_id, 'bp_data', $data );
		return array( 'post_id' => $post_id, 'updated' => $updated );
	}

	public function get_blueprint_template_content( $id )
	{
		return file_get_contents( CORE_PLUGIN_DIR . '/lib/assets/blueprint-templates/' . esc_attr( $id ) . '.json' );
	}

	public function get_blueprint_preset_templates()
	{
		return get_option( 'bp_preset_templates', array() );
	}

	public function get_blueprint_user_templates( $mode = null )
	{
		$templates = get_option( 'bp_templates', array() );

		if ( $mode ) {
			if ( !isset( $templates[$mode] ) ) {
				$templates[$mode] = array();
			}

			return $templates[$mode];
		}

		return $templates;
	}

	public function create_blueprint_user_template( $name, $data, $mode )
	{
		if ( !preg_match( '/^([a-zA-Z1-9\s-_]*)$/', $name, $matches ) ) {
			return false;
		}

		$templates = $this->get_blueprint_user_templates();

		if ( !isset( $templates[$mode] ) ) {
			$templates[$mode] = array();
		}

		$result = $this->process_user_template_name( $name, $mode );
		$template_id = $result['template_id'];
		$template_name = $result['template_name'];

		$templates[$mode][$template_id] = array(
			'id' => $template_id,
			'name' => $template_name,
			'data' => $data
		);

		if ( update_option( 'bp_templates', $templates ) ) {
			return $templates[$mode][$template_id];
		} else {
			return $false;
		}
	}

	public function delete_blueprint_user_template( $template_id, $mode )
	{
		$templates = $this->get_blueprint_user_templates();

		if ( !isset( $templates[$mode][$template_id] ) ) {
			return array(
				'error' => 'invalid_template_id',
				'message' => 'Invalid Template.'
			);
		}

		unset( $templates[$mode][$template_id] );

		if ( update_option( 'bp_templates', $templates ) ) {
			return $template_id;
		} else {
			return false;
		}
	}

	private function process_user_template_name( $template_name, $mode )
	{
		$templates = $this->get_blueprint_user_templates( $mode );

		$template_id = str_replace( array( ' ', '-', '\'', '"' ), '_', strtolower( $template_name ) );
		$original_template_name = $template_name;

		if ( isset( $templates[$template_id] ) ) {
			$template_id = $template_id . '-1';
			$template_name = $template_name . ' (1)';
		}

		while( isset( $templates[$template_id] ) ) {
			preg_match("/(.*)-+(\d+)$/", $template_id, $matches );

			if ( !empty( $matches ) ) {
				$template_id = $matches[1] . '-' . ( (int)$matches[2] + 1 );
				$template_name = $original_template_name . ' (' . ( (int)$matches[2] + 1 ) . ')';
			} else {
				$template_id = $template_id . '-' . 1;
				$template_name = $template_name . ' (1)';
			}
		}

		return array( 'template_id' => $template_id, 'template_name' => $template_name );
	}

	private function blueprint_dependencies()
	{
		return array(
			'jquery',
			'jquery-ui-widget',
			'jquery-ui-draggable',
			'jquery-ui-droppable',
			'jquery-ui-sortable',
			'jquery-ui-slider',
			'underscore',
			'backbone'
		);
	}
}
