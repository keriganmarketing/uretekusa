<?php

class Fabrique_Font_Module extends Fabrique_Base_Module
{
	const API_FONT_EDIT = 'font/edit';
	const API_FONT_DELETE = 'font/delete';

	protected $_registered_fonts;

	public function get_name()
	{
		return 'font';
	}

	public function start()
	{
		add_action( 'admin_post_bp_font_settings', array( $this, 'font_settings' ) );
		add_action( 'admin_post_bp_font_custom', array( $this, 'font_custom' ) );
		add_action( 'admin_post_bp_font_typekit', array( $this, 'font_typekit' ) );
		add_action( 'admin_post_bp_font_reload', array( $this, 'font_google_reload' ) );
		add_action( 'wp_ajax_fabrique_font_api', array( $this, 'font_api') );

		add_action( 'wp_head', array( $this, 'font_head' ) );
		add_action( 'admin_head', array( $this, 'font_head' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'font_enqueue_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'font_admin_enqueue_scripts' ) );

		add_filter( 'upload_mimes', array( $this, 'font_upload_mimes' ) );
		add_filter( 'blueprint_options', array( $this, 'blueprint_options' ), 8, 2 );
		// add_filter( 'fabrique_style_custom_values', array( $this, 'font_style_custom_values' ), 9 );
		add_filter( 'fabrique_customize_values', array( $this, 'customize_values' ), 9 );

		$this->add_filter( 'fonts', array( $this, 'get_sync_fonts' ), 9 );
	}

	public function set_module_defaults()
	{
		$this->register_default_fonts();
	}

	public function font_head()
	{
		if ( wp_script_is( 'fabrique-typekit', 'enqueued' ) ) {
			echo '<script type="text/javascript">try{Typekit.load({async:true});}catch(e){}</script>';
		}
	}

	public function font_enqueue_scripts()
	{
		$typekit = false;
		$google_fonts = array();
		$subset = array();
		$sync_fonts = $this->get_sync_fonts();

		if ( empty( $sync_fonts['primary'] ) ) {
			$google_fonts[] = get_option( 'default_google_fonts' );
		}

		foreach ( $sync_fonts as $index => $font ) {
			if ( empty( $font ) || !is_array( $font ) ) {
				continue;
			}

			switch ( $font['type'] ) {
				case 'google_font':
					$family = $font['family'];
					$style = ( 'regular' === $font['style'] ) ? '400' : $font['style'];
					$variants = ( isset( $font['variants'] ) && is_array( $font['variants'] ) )  ? $font['variants'] : array();
					$subset = ( isset( $font['subsets'] ) && is_array( $font['subsets'] ) ) ? array_merge( $font['subsets'], $subset ) : $subset;

					if ( !isset( $google_fonts[$family] ) ) {
						$styles = array( '400' );

						if ( in_array( 'italic', $variants ) ) {
							$styles[] = '400italic';
						}

						$bold = false;
						$bold_styles = array( 700, 800, 600, 900 );

						foreach( $bold_styles as $bold_style ) {
							if ( in_array( $bold_style, $variants ) ) {
								$bold = $bold_style;
								break;
							}
						}

						if ( $bold ) {
							$styles[] = $bold;
						}

						if ( $bold && in_array( $bold . 'italic', $variants ) ) {
							$styles[] = $bold . 'italic';
						}
					} else {
						$styles = $google_fonts[$family];
					}

					if ( in_array( $style, $variants ) ) {
						$styles[] = $style;
					}

					if ( in_array( $style . 'italic', $variants ) ) {
						$styles[] = $style . 'italic';
					}

					$google_fonts[$family] = array_unique( $styles );

					break;
				case 'typekit':
					$typekit = true;
					break;
			}
		}

		if ( !empty( $google_fonts ) ) {
			$font_set = array();

			$i = 0;

			foreach ( $google_fonts as $font => $style ) {
				$font_set[$i] = $font;

				if ( !empty( $style ) ) {
					$font_set[$i] .= ':' . implode( ',', $style );
				}

				$i++;
			}

			$unique_subset = array_unique( $subset );
			$fonts = implode( '|', $font_set );

			if ( !empty( $subset ) ) {
				$script = urlencode( $fonts ) . '&subset=' . implode( ',', $unique_subset );
			} else {
				$script = urlencode( $fonts );
			}

			$url = add_query_arg( 'family', $script, '//fonts.googleapis.com/css' );

			wp_enqueue_style( 'fabrique-google-fonts', $url, false );
		}

		if ( $typekit ) {
			$typekit_kit = get_option( 'bp_typekit_kit', '' );

			if ( !empty( $typekit_kit ) ) {
				wp_enqueue_script( 'fabrique-typekit', '//use.typekit.net/' . $typekit_kit . '.js', null, fabrique_version(), false );
			}
		}
	}

	public function font_admin_enqueue_scripts()
	{
		global $post_type;

		if ( false === get_current_screen() ) {
			return;
		}

		$blueprint_post_types = apply_filters(
			'support_blueprint_post_types',
			array(
				'page',
				'post',
				'twcbp_block',
				'product'
			)
		);
		$blueprint_post_types[] = 'fabrique_page_font-manager';

		$_post_type = ( !empty( $post_type ) ) ? $post_type : get_current_screen()->id;

		if ( in_array( $_post_type, $blueprint_post_types ) ) {
			$this->font_enqueue_scripts();
		}
	}

	public function font_settings()
	{
		$result = array();
		$indexes = array(
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

		$required_keys = array( 'family', 'style', 'type' );

		foreach ( $indexes as $index ) {
			$font_index = 'font_' . $index;

			if ( isset( $_POST[$font_index] ) && is_array( $_POST[$font_index] ) ) {
				$font_data = $_POST[$font_index];

				$result[$index] = $this->set_font_setting( $index, $font_data );
			}
		}

		$module = $this->fabrique_core->get_module( 'customize' );
		$module->write_style_custom();

		$this->base_admin_redirect( 'font-manager', 'success', __( 'Font settings has been updated', 'fabrique-core' ) );
	}

	public function font_custom()
	{
		if ( !( isset( $_FILES['custom_font_file'] ) && isset( $_POST['custom_font_family'] ) && !empty( $_POST['custom_font_family'] ) ) ) {
			return $this->base_admin_redirect( 'font-manager', 'error', __( 'Upload Failed, Please input font family name and upload again.', 'fabrique-core' ) );
		}

		$has_font = false;
		$registered_fonts = $this->get_registered_fonts();
		$custom_fonts = $registered_fonts['custom'];

		foreach ( $custom_fonts as $font ) {
			if ( $font['name'] === $_POST['custom_font_family'] ) {
				$has_font = true;
			}
		}

		if ( $has_font ) {
			$result = wp_handle_upload( $_FILES['custom_font_file'], array( 'test_form' => false ) );
			return $this->base_admin_redirect( 'font-manager', 'error', __( 'Custom font with same family name exists.', 'fabrique-core' ) );
		} else {
			$font_file = null;
			$font_file_eot = null;

			$result = wp_handle_upload( $_FILES['custom_font_file'], array( 'test_form' => false ) );

			if ( isset( $result['error'] ) ) {
				return $this->base_admin_redirect( 'font-manager', 'error', $result['error'] );
			}

			$font_file = $result['url'];

			if ( isset( $_FILES['custom_font_file_eot'] ) ) {
				$result = wp_handle_upload( $_FILES['custom_font_file_eot'], array( 'test_form' => false ) );

				if ( !isset( $result['error'] ) ) {
					$font_file_eot = $result['url'];
				}
			}

			$font = array(
				'type' => 'custom',
				'name' => $_POST['custom_font_family'],
				'family' => $_POST['custom_font_family'],
				'variants' => array( 'regular' ),
				'url' => $font_file
			);

			if ( $font_file_eot ) {
				$font['eot_url'] = $font_file_eot;
			}

			$custom_fonts[$font['family']] = $font;
			update_option( 'bp_custom_font', $custom_fonts );
			$this->update_registered_fonts( 'custom', $custom_fonts );

			return $this->base_admin_redirect( 'font-manager', 'success', __( 'Custom fonts updated.', 'fabrique-core' ) );
		}
	}

	public function font_typekit()
	{
		if ( !isset( $_POST['typekit_kit'] ) || !isset( $_POST['typekit_api_key'] ) ) {
			return $this->base_admin_redirect( 'font-manager', 'error', __( 'Please enter both API key and Kit ID.', 'fabrique-core' ) );
		}

		$kit = $_POST['typekit_kit'];
		$api_key = $_POST['typekit_api_key'];

		$typekit_url = 'https://typekit.com/api/v1/json/kits/' . $kit;

		$response = wp_remote_get( $typekit_url, array(
			'timeout' => 50,
			'headers' => array( 'X-Typekit-Token' => $api_key )
		) );

		if ( is_wp_error( $response ) ) {
			return $this->base_admin_redirect( 'font-manager', 'error', __( 'Fetch Typekit fonts error.', 'fabrique-core' ) );
		}

		if ( 200 === $response['response']['code'] ) {
			$typekit_fonts = array();
			$data = json_decode( $response['body'], true );

			if ( isset( $data['kit']['families'] ) && count( $data['kit']['families'] ) ) {
				foreach ( $data['kit']['families'] as $family ) {
					$typekit_fonts[]= $this->parse_typekit_font_data( $family );
				}
			}

			update_option( 'bp_typekit_kit', $kit );
			$this->update_registered_fonts( 'typekit', $typekit_fonts );
		} else {
			return $this->base_admin_redirect( 'font-manager', 'error', __( 'Unauthorized. Please check your typekit credentials', 'fabrique-core' ) );
		}

		return $this->base_admin_redirect( 'font-manager', 'success', __( 'Typekit fonts have been fetched.', 'fabrique-core' ) );
	}

	public function font_google_reload()
	{
		$google_fonts = $this->load_google_fonts();
		$this->update_registered_fonts( 'google_font', $google_fonts );

		return $this->base_admin_redirect( 'font-manager', 'success', __( 'Google font reloaded.', 'fabrique-core' ) );
	}

	public function font_upload_mimes( $mimes = array() )
	{
		$mimes['otf'] = 'application/x-font-opentype';
		$mimes['ttf'] = 'application/x-font-truetype';
		$mimes['woff'] = 'application/font-woff';
		$mimes['eot'] = 'application/vnd.ms-fontobject';

		return $mimes;
	}

	public function blueprint_options( $options )
	{
		if ( isset( $options['page'] ) && 'font-manager' === $options['page'] ) {
			$options['registered_fonts'] = $this->get_registered_fonts();
		}

		$options['fonts'] = $this->get_sync_fonts();

		return $options;
	}

	public function customize_values( $values )
	{
		$sync_fonts = $this->get_sync_fonts();

		foreach ( $sync_fonts as $font => $value ) {
			$key = 'font_' . $font;
			if ( !isset( $values[$key] ) ) {
				$values[$key] = $value;
			}
		}

		return $values;
	}

	public function font_admin_options( $options = array() )
	{
		$registered_fonts = $this->get_registered_fonts();

		$options['fonts'] = array_merge(
			$registered_fonts['google_font'],
			$registered_fonts['typekit'],
			$registered_fonts['custom']
		);

		return $options;
	}

	public function font_api( $options = array() )
	{
		if ( false === ( isset( $_POST['api_action'] ) ) ) {
			return $this->api_error_response(array(
				'error' => 'bad_request',
				'message' => 'Bad Request'
			) );
		}

		$api_action = $_POST['api_action'];

		if ( 'edit' === $api_action ) {
			$result = $this->font_api_edit( $_POST['name'], $_POST['value'] );

			if ( isset( $result['error'] ) ) {
				$this->api_error_response(array(
					'api_action' => $api_action,
					'custom_font_name' => $_POST['name'],
					'error' => $error['error'],
					'message' => $error['message']
				));
			}
		} else if ( 'delete' === $api_action ) {
			$result = $this->font_api_delete( $_POST['name'] );
		}

		$this->api_response( $api_action, $result );
	}

	protected function font_api_edit( $name, $value )
	{
		$registered_fonts = $this->get_registered_fonts();
		$custom_fonts = $registered_fonts['custom'];

		$font = null;
		$font_index = 0;

		foreach ( $custom_fonts as $index => $custom_font ) {
			if ( $name === $custom_font['name'] ) {
				$font = $custom_font;
				$font_index = $index;
			}
		}

		if ( $font ) {
			$font['name'] = $value;
			$custom_fonts[$font_index] = $font;

			$this->update_registered_fonts( 'custom', $custom_fonts );
			return array( 'name' => $value );
		} else {
			return array(
				'error' => 'invalid_custom_font_name',
				'message' => 'Please try a different custom font name'
			);
		}
	}

	protected function font_api_delete( $name )
	{
		$registered_fonts = $this->get_registered_fonts();
		$custom_fonts = $registered_fonts['custom'];

		$font = null;
		$font_index = 0;

		foreach ( $custom_fonts as $index => $custom_font ) {
			if ( $name === $custom_font['name'] ) {
				$font = $custom_font;
				$font_index = $index;
			}
		}

		if ( $font ) {
			unset( $custom_fonts[$font_index] );
			$this->update_registered_fonts( 'custom', $custom_fonts );
			return array( 'name' => $name );
		} else {
			return array(
				'error' => 'invalid_custom_font_name',
				'message' => 'Please try a different custom font name'
			);
		}
	}

	protected function set_font_setting( $font_index, $font_data )
	{
		$keys = array_keys( $font_data );

		if ( isset( $font_data['family'] ) && empty( $font_data['family'] ) ) {
			remove_theme_mod( 'font_' . $font_index );
			return true;
		}

		$required_keys = array( 'family', 'style', 'type' );

		$has_required_keys = ( count( array_intersect( $keys, $required_keys ) ) == count( $required_keys ) );

		if ( false === $has_required_keys ) {
			return false;
		}

		if ( 'custom' !== $font_data['type'] && isset( $font_data['url'] ) ) {
			unset( $font_data['url'] );
		}

		$has_empty_data = in_array( '', array_values( $font_data ) );

		$registered_fonts = $this->get_registered_fonts();
		$google_fonts = $registered_fonts['google_font'];

		$result = false;

		foreach( $google_fonts as $font ) {
			if ( $font_data['family'] === $font['family'] ) {
				$result = $font;
				break;
			}
		}

		if ( $result ) {
			$font_data['subsets'] = ( isset( $result['subsets'] ) ) ? $result['subsets'] : array();
			$font_data['variants'] = ( isset( $result['variants'] ) ) ? $result['variants'] : array( 'regular' );
			$font_data['category'] = ( isset( $result['category'] ) ) ? $result['category'] : null;
		}

		$font_data['family'] = stripslashes( $font_data['family'] );

		if ( false === $has_empty_data ) {
			set_theme_mod( 'font_'. $font_index, $font_data );
			return true;
		} else {
			return false;
		}
	}

	protected function get_registered_fonts()
	{
		if ( $this->_registered_fonts ) {
			return $this->_registered_fonts;
		}

		$registered_fonts = get_option( 'bp_registered_fonts' );

		if ( false === $registered_fonts ) {
			$registered_fonts = array(
				'google_font' => array(),
				'typekit' => array(),
				'custom' => array()
			);
		}

		$registered_fonts['default'] = $this->get_default_fonts();
		$this->_registered_fonts = $registered_fonts;

		return $this->_registered_fonts;
	}

	protected function update_registered_fonts( $type, $fonts )
	{
		$registered_fonts = $this->get_registered_fonts();
		$registered_fonts[$type] = $fonts;

		update_option( 'bp_registered_fonts', $registered_fonts );
	}

	public function get_sync_fonts( $options = array() )
	{
		$options = array(
			'primary' => get_theme_mod( 'font_primary' ),
			'secondary' => get_theme_mod( 'font_secondary' ),
			'custom_a' => get_theme_mod( 'font_custom_a' ),
			'custom_b' => get_theme_mod( 'font_custom_b' ),
			'custom_c' => get_theme_mod( 'font_custom_c' ),
			'custom_d' => get_theme_mod( 'font_custom_d' ),
			'custom_e' => get_theme_mod( 'font_custom_e' ),
			'custom_f' => get_theme_mod( 'font_custom_f' ),
			'custom_g' => get_theme_mod( 'font_custom_g' ),
			'custom_h' => get_theme_mod( 'font_custom_h' ),
		);

		if ( empty( $options['primary'] ) ) {
			$options['primary'] = $this->get_default_primary_font();
		}

		if ( empty( $options['secondary'] ) ) {
			$options['secondary'] = $this->get_default_secondary_font();
		}

		return $options;
	}

	public function handle_api_action( $endpoint, $params )
	{
		switch ( $endpoint ) {
			case self::API_FONT_EDIT:
				return $this->font_api_edit( $params['name'], $params['value'] );
			case self::API_FONT_DELETE:
				return $this->font_api_delete( $params['name'] );
			default:
				return false;
		}
	}

	protected function parse_google_font_data( $data )
	{
		$font = array(
			'type' => 'google_font',
			'name' => $data['family'],
			'variants' => $data['variants'],
			'family' => $data['family'],
			'category' => $data['category'],
			'subsets' => $data['subsets']
		);

		return $font;
	}

	protected function parse_typekit_font_data( $data )
	{
		$result =  array(
			'type' => 'typekit',
			'name' => $data['name'],
			'variants' => array(),
			'family' => $data['css_names'][0]
		);

		foreach ( $data['variations'] as $variant ) {
			$result['variants'][] = $this->parse_typekit_font_variant( $variant );
		}

		return $result;
	}

	protected function parse_typekit_font_variant( $variant )
	{
		if ( 'n4' === $variant ) {
			return 'regular';
		} else if ( 'i4' === $variant ) {
			return 'italic';
		} else {
			preg_match( '/(\S)(\d)/', $variant, $matches );

			$style = ( $matches[1] === 'i' ) ? 'italic' : '';
			$weight = $matches[2] . '00';

			return $weight . $style;
		}
	}

	protected function get_default_primary_font()
	{
		return array(
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

	protected function get_default_secondary_font()
	{
		return array(
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

	protected function get_default_fonts()
	{
		return array(
			array(
				'type' => 'default',
				'name' => 'Georgia, serif',
				'family' => 'Georgia, serif',
				'category' => 'serif'
			),
			array(
				'type' => 'default',
				'name' => 'Palatino Linotype, Book Antiqua, Palatino, serif',
				'family' => '"Palatino Linotype", "Book Antiqua", Palatino, serif',
				'category' => 'serif'
			),
			array(
				'type' => 'default',
				'name' => 'Times New Roman, Times, serif',
				'family' => '"Times New Roman", Times, serif',
				'category' => 'serif'
			),
			array(
				'type' => 'default',
				'name' => 'Arial, Helvetica, sans-serif',
				'family' => 'Arial, Helvetica, sans-serif',
				'category' => 'sans-serif'
			),
			array(
				'type' => 'default',
				'name' => 'Arial Black, Gadget, sans-serif',
				'family' => '"Arial Black", Gadget, sans-serif',
				'category' => 'sans-serif'
			),
			array(
				'type' => 'default',
				'name' => 'Comic Sans MS, cursive, sans-serif',
				'family' => '"Comic Sans MS", cursive, sans-serif',
				'category' => 'sans-serif'
			),
			array(
				'type' => 'default',
				'name' => 'Impact, Charcoal, sans-serif',
				'family' => 'Impact, Charcoal, sans-serif',
				'category' => 'sans-serif'
			),
			array(
				'type' => 'default',
				'name' => 'Lucida Sans Unicode, Lucida Grande, sans-serif',
				'family' => '"Lucida Sans Unicode", "Lucida Grande", sans-serif',
				'category' => 'sans-serif'
			),
			array(
				'type' => 'default',
				'name' => 'Tahoma, Geneva, sans-serif',
				'family' => 'Tahoma, Geneva, sans-serif',
				'category' => 'sans-serif'
			),
			array(
				'type' => 'default',
				'name' => 'Trebuchet MS, Helvetica, sans-serif',
				'family' => '"Trebuchet MS", Helvetica, sans-serif',
				'category' => 'sans-serif'
			),
			array(
				'type' => 'default',
				'name' => 'Verdana, Geneva, sans-serif',
				'family' => 'Verdana, Geneva, sans-serif',
				'category' => 'sans-serif'
			),
			array(
				'type' => 'default',
				'name' => 'Courier New, Courier, monospace',
				'family' => '"Courier New", Courier, monospace',
				'category' => 'monospace'
			),
			array(
				'type' => 'default',
				'name' => 'Lucida Console, Monaco, monospace',
				'family' => '"Lucida Console", Monaco, monospace',
				'category' => 'monospace'
			)
		);
	}

	protected function register_default_fonts()
	{
		$fonts = array(
			'typekit' => array(),
			'custom' => array()
		);

		$fonts['google_font'] = $this->load_google_fonts();

		$this->_registered_fonts = $fonts;
		update_option( 'bp_registered_fonts', $this->_registered_fonts );
	}

	protected function load_google_fonts()
	{
		$fonts = array();

		$google_font_file = fabrique_core_option( 'path' ) . '/assets/google_fonts.json';

		$handle = fopen( $google_font_file, "r" );
		$content = fread( $handle, filesize( $google_font_file ) );
		fclose( $handle );

		$data = json_decode( $content, true );

		if ( $data ) {
			foreach ( $data['items'] as $item ) {
				$fonts[] = $this->parse_google_font_data( $item );
			}
		}

		return $fonts;
	}
}
