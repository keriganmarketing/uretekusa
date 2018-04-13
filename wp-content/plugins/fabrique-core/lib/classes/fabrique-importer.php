<?php

class Fabrique_Importer
{
	protected $options;

	private $prefix;
	private $asset_path;
	private $import_map;
	private $widgets_data;
	private $import_timeout;
	private $demo_data;
	private $started_at;

	protected $bp_asset_attributes = array(
		'poster_id',
		'poster_url',
		'background_id',
		'background_url',
		'background_poster_id',
		'background_poster_url',
		'background_video_id',
		'background_video_url',
		'image_id',
		'image_url',
		'video_id',
		'video_url',
		'footer_id',
		'blueprintblock_id',
		'nav_menu',
		'nav_menu_mobile',
		'nav_menu_mega_blueprint',
		'nav_menu_sub_sidebar'
	);

	protected $registered_terms = array(
		'post_tag',
		'category',
		'fbq_project_tag',
		'fbq_project_category',
		'fbq_page_category',
		'fbq_page_tag'
	);

	protected $registered_sidebars = array(
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

	public function __construct( $options = array() )
	{
		$this->prefix = $options['prefix'];
		$this->asset_path = $options['asset_path'];

		$this->sidebar_data = array();
		$this->import_map = array(
			'counter' => 0,
			'import_objects' => false,
			'import_attachment_files' => false,
			'import_cleanup' => false,
			'import_settings' => false
		);

		$this->import_timeout = ini_get( 'max_execution_time' ) - 2;
		$this->options = $options;
	}

	public function import_demo( $demo )
	{
		$this->load_data( $demo );

		$this->import_map['id'] = substr( md5( 'bp_import_' . time() ), 0, 10 );
		$this->import_map['demo'] = $demo;
		$this->import_map['counter'] = 0;

		return $this->import();
	}

	public function resume_import( $import_id )
	{
		$this->import_map = get_transient( 'bp_import_' . $import_id . '_map' );

		if ( $this->import_map && isset( $this->import_map['id'] ) && $this->import_map['id'] == $import_id ) {
			$this->load_data( $this->import_map['demo'] );
			return $this->import();
		} else {
			return array(
				'error' => 'invalid_import_id',
				'error_message' => 'Invalid import_id : ' . $import_id
			);
		}
	}

	protected function import()
	{
		wp_suspend_cache_invalidation( true );
		wp_defer_term_counting( true );
		wp_defer_comment_counting( true );

		$this->started_at = time();

		if ( !$this->import_map['import_objects'] ) {
			$this->import_objects( $this->demo_data['objects'] );
		} else if ( !$this->import_map['import_attachment_files'] ) {
			$this->import_attachment_files();
		} else if ( !$this->import_map['import_cleanup'] ) {
			$this->import_map['import_cleanup'] = true;
		}

		if ( $this->import_map['import_objects'] && !$this->import_map['import_settings'] ) {
			$this->import_settings();
		}

		wp_suspend_cache_invalidation( false );
		wp_defer_term_counting( false );
		wp_defer_comment_counting( false );

		set_transient( 'bp_import_' . $this->import_map['id'] . '_map', $this->import_map, 3600 );

		return $this->import_map;
	}

	protected function import_settings()
	{
		$homepage = $this->demo_data['homepage'];
		$theme_mods = $this->demo_data['theme_mods'];
		$nav_menu_locations = $this->demo_data['nav_menu_locations'];

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $this->import_map[$homepage] );

		$theme_mods['footer_id'] = $this->import_map[$theme_mods['footer_id']];
		update_option( 'theme_mods_fabrique', $theme_mods, true );

		$locations = array();

		foreach ( $nav_menu_locations as $location => $exported_menu_id ) {
			$locations[$location] = $this->import_map[$exported_menu_id];
		}

		set_theme_mod( 'nav_menu_locations', $locations );

		$this->import_map['nav_menu_locations'] = true;
		$this->import_map['import_settings'] = true;
	}

	public function import_objects( $objects )
	{
		foreach ( $objects as $object ) {
			if ( isset( $this->import_map[$object['e_id']] ) ) {
				continue;
			}

			if ( $this->get_remaining_time() < 2 ) {
				break;
			}

			switch ( $object['e_type'] ) {
				case 'attachment':
					$this->import_attachment( $object );
					break;
				case 'term':
					$this->import_term( $object );
					break;
				case 'nav_menu':
					$this->import_nav_menu( $object );
					break;
				case 'nav_menu_item':
					$this->import_nav_menu_item( $object );
					break;
				case 'bp_data':
					$this->import_bp_data( $object );
					break;
				case 'sidebar_widget':
					$this->import_sidebar_widget( $object );
					break;
				default:
					$this->import_post( $object );
					break;
			}

			$this->import_map['counter']++;
		}

		if ( (int)$this->import_map['counter'] >= count( $objects ) ) {
			$this->import_map['import_objects'] = true;
		}

		if ( !empty( $this->sidebar_data ) ) {
			$dynamic_sidebars = get_option( 'fabrique_core_widget_dynamic_sidebars', array() );
			$sidebars_widgets = get_option( 'sidebars_widgets', array() );

			foreach ( $this->sidebar_data as $sidebar) {
				$id = $sidebar['id'];
				$name = $sidebar['name'];

				if ( !in_array( $sidebar, $this->registered_sidebars ) ) {
					$dynamic_sidebars[] = $name;
				}

				if ( !empty( $sidebars_widgets[$id] ) ) {
					$sidebars_widgets[$id] = array_merge( $sidebars_widgets[$id], $sidebar['widgets'] );
				} else {
					$sidebars_widgets[$id] = $sidebar['widgets'];
				}
			}

			$dynamic_sidebars = array_unique( $dynamic_sidebars );

			update_option( 'fabrique_core_widget_dynamic_sidebars', $dynamic_sidebars );
			update_option( 'sidebars_widgets', $sidebars_widgets );
		}
	}

	public function import_attachment_files()
	{
		if ( !isset( $this->import_map['attachments'] ) ) {
			return false;
		}

		if ( !isset( $this->import_map['attachment_files'] ) ) {
			$this->import_map['attachment_files'] = array();
		}

		$error = null;

		foreach ( $this->import_map['attachments'] as $attachment_id ) {
			if ( in_array( $attachment_id, $this->import_map['attachment_files'] ) ) {
				continue;
			}

			$file = get_attached_file( $attachment_id );
			$data = get_post_meta( $attachment_id, '_attachment_data', true );

			if ( $data ) {
				$fetch_result = $this->fetch_remote_file( $data['attachment_src'], $file, 3 );

				if ( is_wp_error( $fetch_result ) ) {
					if ( 'import_timeout' === $fetch_result->get_error_code() ) {
						$error = $fetch_result;
						break;
					} else {
						$placeholder_file = $this->asset_path . '/images/fabrique-placeholder.png';
						copy( $placeholder_file, $file );
					}
				}

				$metadata = wp_generate_attachment_metadata( $attachment_id, $file );
				wp_update_attachment_metadata( $attachment_id, $metadata );

				$this->import_map['attachment_files'][] = $attachment_id;
				delete_post_meta( $attachment_id, '_attachment_data' );
			}
		}

		if ( $error ) {
			if ( 'import_timeout' === $error->get_error_code() ) {
				if ( !isset( $this->import_map['import_attachment_files_count'] ) ) {
					$this->import_map['import_attachment_files_count'] = 0;
				}

				$this->import_map['import_attachment_files_count']++;
				$this->import_map['import_attachment_files'] = false;
			} else {
				$this->import_map['error'] = array(
					'error' => $error->get_error_code(),
					'error_message' => $error->get_error_message()
				);
			}
		} else {
			$this->import_map['import_attachment_files'] = true;
		}
	}

	public function fetch_remote_file( $url, $file, $retry = 0 )
	{
		$remaining_time = $this->get_remaining_time();
		$file_name = basename( $url );

		if ( $remaining_time < 5 ) {
			return new WP_Error( 'import_timeout', esc_html__( 'Import timeout', 'fabrique' ) );
		}

		$timeout = $remaining_time - 1;

		// fetch the remote url and write it to the placeholder file
		$response = wp_remote_get( $url, array(
			'timeout' => $timeout,
			'stream' => true,
			'filename' => $file
		) );

		if ( is_wp_error( $response ) && 'http_request_failed' === $response->get_error_code() && $retry > 0 ) {
			return $this->fetch_remote_file( $url, $file, --$retry );
		}

		if ( is_wp_error( $response ) ) {
			@unlink( $file );
			return $response;
		}

		$code = (int) wp_remote_retrieve_response_code( $response );

		if ( $code !== 200 ) {
			@unlink( $file );
			$message = sprintf( esc_html__( 'Remote server returned %1$d %2$s for %3$s', 'fabrique' ), $code, get_status_header_desc( $code ), $url );
			return new WP_Error( 'import_file_error', $message );
		}

		$filesize = filesize( $file );
		$headers = wp_remote_retrieve_headers( $response );

		if ( isset( $headers['content-length'] ) && $filesize != $headers['content-length'] ) {
			@unlink( $file );
			return new WP_Error( 'import_file_error',esc_html__('Remote file is incorrect size', 'fabrique') );
		}

		if ( 0 == $filesize ) {
			@unlink( $file );
			return new WP_Error( 'import_file_error',esc_html__( 'Zero size file downloaded', 'fabrique' ) );
		}

		$max_size = apply_filters( 'import_attachment_size_limit', 0 );

		if ( ! empty( $max_size ) && $filesize > $max_size ) {
			@unlink( $file );
			return new WP_Error( 'import_file_error', sprintf( esc_html__( 'Remote file is too large, limit is %s', 'fabrique'), size_format( $max_size ) ) );
		}

		return true;
	}

	public function import_attachment( $object, $retry = 0 )
	{
		$filename = $this->prefix . '-'. basename( $object['attachment_src'] );
		$filetype = wp_check_filetype( $filename, null );
		$upload = wp_upload_bits( $filename, 0, '', date( "Y-m-d H:i:s" ) );

		$attachment = $this->extract_post_object( $object );
		$attachment['post_mime_type'] = $filetype['type'];

		$attachment_id = wp_insert_attachment( $attachment, $upload['file'] );
		update_post_meta( $attachment_id, '_attachment_data', $object );

		if ( isset( $object['alt'] ) && count( $object['alt'] ) ) {
			update_post_meta( $attachment_id, '_wp_attachment_image_alt', $object['alt'] );
		}

		if ( isset( $object['masonry_height'] ) && isset( $object['masonry_width'] ) ) {
			update_post_meta( $attachment_id, '_masonry_height', $object['masonry_height'] );
			update_post_meta( $attachment_id, '_masonry_width', $object['masonry_width'] );
		}

		$this->import_map[$filename] = $attachment_id;
		$this->import_map[$object['e_id'] . '_url'] = $upload['url'];

		if ( !isset( $this->import_map['attachments'] ) ) {
			$this->import_map['attachments'] = array();
		}

		$this->import_map['attachments'][] = $attachment_id;

		return $this->register_imported_object( $object['e_id'], $attachment_id );
	}

	public function load_data( $demo )
	{
		$demo_file = $this->asset_path . '/demos/' . $demo . '.json';

		if ( !file_exists ( $demo_file ) ) {
			return array(
				'error' => 'invalid_demo',
				'error_message' => 'Invalid Demo : ' . $demo
			);
		}

		$handle = fopen( $demo_file, "r" );
		$content = fread( $handle, filesize( $demo_file ) );
		fclose( $handle );

		$data = json_decode( $content, true );

		if ( !$data ) {
			return array(
				'error' => 'invalid_demo_content',
				'error_message' => 'Invalid demo content : ' . json_last_error_msg()
			);
		}

		$this->demo_data = $data;

		return $data;
	}

	protected function register_imported_object( $export_id, $object_id )
	{
		$this->import_map[$export_id] = $object_id;
		return $object_id;
	}

	protected function extract_post_object( $object )
	{
		return array(
			'post_type'=> $object['post_type'],
			'post_title' => $object['post_title'],
			'post_name' => $object['post_name'],
			'post_status' => $object['post_status'],
			'post_content' => $object['post_content'],
			'post_excerpt' => $object['post_excerpt'],
			'post_date' => $object['post_date']
		);
	}

	protected function import_term( $object )
	{
		$data = array(
			'description' => $object['description'],
			'slug' => $object['slug']
		);

		if ( isset( $object['e_parent'] ) ) {
			$data['parent'] = $this->import_map[$object['e_parent']];
		}

		$result = wp_insert_term( $object['name'], $object['taxonomy'], $data );

		if ( $result instanceof WP_Error ) {
			if ( 'term_exists' === $result->get_error_code() ) {
				$term_id = $result->get_error_data();
				return $this->register_imported_object( $object['e_id'], $term_id );
			} else {
				return false;
			}
		} else {
			return $this->register_imported_object( $object['e_id'], $result['term_id'] );
		}
	}

	protected function import_nav_menu( $object )
	{
		$result = wp_create_nav_menu( $object['name'] );

		if ( $result instanceof WP_Error ) {
			if ( 'menu_exists' === $result->get_error_code() ) {
				$nav_menu = wp_get_nav_menu_object( $object['name'] );
				$nav_menu_id = $nav_menu->term_id;

				$this->register_imported_object( $object['e_id'], $nav_menu_id );
			} else {
				$nav_menu_id = false;
			}
		} else {
			$nav_menu_id = $result;
			$this->register_imported_object( $object['e_id'], $result );
		}

		if ( !isset( $this->import_map['nav_menu_items'] ) ) {
			$this->import_map['nav_menu_items'] = array();
		}

		if ( $nav_menu_id && count( $object['nav_menu_items'] ) ) {
			foreach ( $object['nav_menu_items'] as $nav_menu_item_id ) {
				$this->import_map['nav_menu_items'][$nav_menu_item_id] = $nav_menu_id;
			}
		}
	}

	protected function import_nav_menu_item( $object )
	{
		$e_id = $object['e_id'];

		if ( !isset( $this->import_map['nav_menu_items'][$e_id] ) ) {
			return false;
		}

		$nav_menu_id = $this->import_map['nav_menu_items'][$e_id];

		if ( $nav_menu_id ) {
			$nav_menu_item_data = array(
				'menu-item-position' => $object['menu_order'],
				'menu-item-description' => $object['post_content'],
				'menu-item-attr-title' => $object['post_excerpt'],
				'menu-item-title' => $object['post_title'],
				'menu-item-status' => $object['post_status']
			);

			if ( isset( $object['menu_item_parent'] ) && $object['menu_item_parent'] > 0 ) {
				$nav_menu_item_data['menu-item-parent-id'] = $this->import_map[$object['menu_item_parent']];
			}

			if ( 'custom' === $object['object'] ) {
				$nav_menu_item_data['menu-item-url'] = $object['url'];
			} else {
				$post_id = $this->import_map[$object['e_object_id']];
				$nav_menu_item_data['menu-item-type'] = $object['object_type'];
				$nav_menu_item_data['menu-item-object'] = $object['object'];
				$nav_menu_item_data['menu-item-object-id'] = $post_id;
				$nav_menu_item_data['menu-item-url'] = get_permalink( $post_id );
			}

			$result = wp_update_nav_menu_item( $nav_menu_id, 0, $nav_menu_item_data );

			if ( isset( $object['nav_menu_icon'] ) ) {
				update_post_meta( $result, 'nav_menu_icon', $object['nav_menu_icon'] );
			}

			if ( isset( $object['nav_menu_icon_position'] ) ) {
				update_post_meta( $result, 'nav_menu_icon_position', $object['nav_menu_icon_position'] );
			}

			if ( isset( $object['nav_menu_mega_columns'] ) ) {
				update_post_meta( $result, 'nav_menu_mega_columns', $object['nav_menu_mega_columns'] );
			}

			if ( isset( $object['nav_menu_mega_columns'] ) ) {
				update_post_meta( $result, 'nav_menu_mega_columns', $object['nav_menu_mega_columns'] );
			}

			if ( isset( $object['nav_menu_mega_blueprint'] ) ) {
				update_post_meta( $result, 'nav_menu_mega_blueprint', $object['nav_menu_mega_blueprint'] );
			}

			if ( isset( $object['nav_menu_sub_sidebar'] ) ) {
				update_post_meta( $result, 'nav_menu_sub_sidebar', $object['nav_menu_sub_sidebar'] );
			}

			$this->register_imported_object( $object['e_id'], $result );
		}
	}

	protected function import_post( $object )
	{
		$data = $this->extract_post_object( $object );
		$data['tax_input'] = array();
		$matched_terms = array();

		foreach ( $this->registered_terms as $term ) {
			$terms = array();

			if ( isset( $object[$term] ) && is_array( $object[$term] ) ) {
				foreach ( $object[$term] as $object_term ) {
					$terms[] = $this->import_map[$object_term];
				}
			}

			if ( !empty( $terms ) ) {
				$matched_terms[$term] = $terms;
				$data['tax_input'][$term] = $terms;
			}
		}

		if ( isset( $object['post_parent'] ) && $object['post_parent'] > 0 ) {
			$data['post_parent'] = $this->import_map[$object['post_parent']];
		}

		$this->process_post_content( $data['post_content'] );

		$result = wp_insert_post( $data, true );

		if ( $result instanceof WP_Error ) {
			return false;
		}

		if ( isset( $object['featured_image'] ) ) {
			$featured_image_id = $this->import_map[$object['featured_image']];
			set_post_thumbnail( $result, $featured_image_id );
		}

		if ( 'product' === $object['post_type'] && isset( $object['price'] ) ) {
			update_post_meta( $result, '_price', $object['price'] );
		}

		foreach ( $matched_terms as $term => $values ) {
			wp_set_object_terms( $result, $values, $term );
		}

		$this->register_imported_object( $object['e_id'], $result );
	}


	public function process_post_content( &$content )
	{
		$image_pattern = '/\[bp_image\simage_id="e_asset_id:(\d+)"\s[^\]]*\].*?\[\/bp_image\]/';
		$gallery_pattern = '/\[bp_gallery\simages="e_assets:(\S+)"\s[^\]]*\]?/';

		if ( preg_match_all( $image_pattern, $content, $matches, PREG_SET_ORDER ) ) {
			foreach ( $matches as $match ) {
				if ( isset( $this->import_map[$match[1]] ) ) {
					$attachment_id = $this->import_map[$match[1]];
					$attachment_url = $this->import_map[$match[1] . '_url'];

					$patterns = array();
					$patterns[0] = '/image_id="e_asset_id:' . $match[1] . '"/';

					$replacements = array();
					$replacements[0] = 'image_id="' . $attachment_id . '"';

					$content = preg_replace( $patterns, $replacements, $content );
				}
			}
		} else if ( preg_match_all( $gallery_pattern, $content, $matches, PREG_SET_ORDER ) ) {
			foreach ( $matches as $match ) {
				$images = array();
				$e_assets = explode( ',', $match[1] );

				foreach ( $e_assets as $e_asset ) {
					if ( isset( $this->import_map[$e_asset] ) ) {
						$images[] = $this->import_map[$e_asset];
					}
				}

				$content = preg_replace( '/images="e_assets:' . $match[1] . '"/', 'images="' . implode( ',', $images ) . '"', $content );
			}
		}
	}

	public function process_bp_data( &$data )
	{
		array_walk_recursive( $data, array( $this, 'process_asset_attribute' ) );
	}

	protected function process_widget_data( &$data )
	{
		array_walk_recursive( $data, array( $this, 'process_asset_attribute' ) );
	}

	protected function process_asset_attribute( &$item, $key )
	{
		$index = array_search( $key, $this->bp_asset_attributes, true );

		if ( false !== $index && preg_match( "/^([^\s]*)_(id|url|Id|Url)$/", $key, $matches ) ) {
			$property = $matches[1];
			$property_type = strtolower( $matches[2] );

			switch ( $property ) {
				case 'footer':
				case 'blueprintblock':
					if ( isset( $this->import_map[$item] ) ) {
						$item = $this->import_map[$item];
					}
					break;
				default:
					switch ( $property_type ) {
						case 'id':
							$export_id = str_replace( 'e_asset_id:', '', $item );

							if ( isset( $this->import_map[$export_id] ) ) {
								$item = $this->import_map[$export_id];
							} else {
								$item = '';
							}

							break;
						case 'url':
							$export_id = str_replace( 'e_asset_url:', '', $item );

							if ( isset( $this->import_map[$export_id . '_url'] ) ) {
								$item = $this->import_map[$export_id . '_url'];
							} else {
								$item = '';
							}
					}
					break;
			}
		} else if ( 'nav_menu' === $key || 'nav_menu_mobile' === $key ) {
			if ( isset( $this->import_map[$item] ) ) {
				$item = $this->import_map[$item];
			}
		} else if ( 'images' === $key && substr( $item, 0, 9 ) === "e_assets:" ) {
			$images = array();
			$e_assets = explode( ',', substr( $item, 9 ) );

			foreach ( $e_assets as $e_asset ) {
				if ( isset( $this->import_map[$e_asset] ) ) {
					$images[] = $this->import_map[$e_asset];
				}
			}

			$item = implode( ',', $images );
		}
	}


	protected function import_sidebar_widget( $object )
	{
		$sidebar_name = $object['sidebar_name'];
		$widget_option_name = 'widget_' . $object['widget_type'];
		$widget_instances = get_option( $widget_option_name , array() );

		if ( isset( $this->sidebar_data[$sidebar_name] ) ) {
			$sidebar_widgets = $this->sidebar_data[$sidebar_name];
		} else {
			$sidebar_widgets = array();
		}

		$widget_instances_ids = array_keys( $widget_instances );

		if ( count( $widget_instances_ids ) > 0 ) {
			$new_instance_id = max( $widget_instances_ids ) + 1;
		} else {
			$new_instance_id = 1;
		}

		$this->process_widget_data( $object['widget_data'] );

		$widget_instances[$new_instance_id] = $object['widget_data'];

		update_option( $widget_option_name, $widget_instances );

		$sidebar_widgets[] = $object['widget_type'] . '-' . $new_instance_id;

		$this->sidebar_data[] = array(
			'id' => $object['sidebar_id'],
			'name' => $object['sidebar_name'],
			'widgets' => $sidebar_widgets
		);
	}

	protected function import_bp_data( $object )
	{
		if ( !isset( $this->import_map[$object['epost_id']] ) ) {
			return false;
		}

		$post_id = $this->import_map[$object['epost_id']];

		$this->process_bp_data( $object['data'] );

		if ( $post_id ) {
			update_post_meta( $post_id, 'bp_data', $object['data'] );
		}

		$this->register_imported_object( $object['e_id'], $post_id );

		return $post_id;
	}

	protected function get_remaining_time()
	{
		return $this->import_timeout - ( time() - $this->started_at );
	}
}
