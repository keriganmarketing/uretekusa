<?php

class Fabrique_Core_Admin_Page
{
	public $title;
	public $id;
	public $sections = array();
	public $default_tab = '';

	public function __construct( $args )
	{
		foreach ( $args as $key => $val ) {
			$this->{$key} = $val;
		}
	}

	// Add section
	public function add_page_section( $section )
	{
		$this->sections[$section->id] = $section;
	}

	// Register settings
	public function register_admin_menu()
	{
		foreach ( $this->sections as $section ) {
			$section->register_section_settings();

			foreach ( $section->settings as $setting ) {
				$setting->add_settings_field();
			}
		}

		register_setting(
			$this->id,
			$this->id,
			array( $this, 'sanitize_data' )
		);
	}

	// Sanitize data saved in each page/tab settings
	public function sanitize_data( $value )
	{
		parse_str( $_POST['_wp_http_referer'], $referrer );
		$current_page = $this->get_current_page( $referrer );
		$old_value = get_option( $this->id );
		$current_value = array();

		foreach ( $this->sections as $section ) {
			foreach ( $section->settings as $setting ) {
				if ( $current_page === $setting->section ) {
					$setting_value = isset( $value[$setting->id] ) ? $value[$setting->id] : '';
					$current_value[$setting->id] = $setting->sanitize_setting( $setting_value );
				}
			}
		}

		return ( is_array( $old_value ) ) ? array_merge( $old_value, $current_value ) : $current_value;
	}

	// Get current page or tab
	public function get_current_page( $request )
	{
		if ( !empty( $request['tab'] ) ) {
			return $request['tab'];
		} elseif ( !empty( $this->default_tab ) ) {
			return $this->default_tab;
		} else {
			return $this->id;
		}
	}

	// Display menu/submenu page
	public function display_menu_page()
	{
		$current_page = $this->get_current_page( $_GET );
		?>
			<div class="wrap">
				<?php if ( isset( $this->default_tab ) && !empty( $this->default_tab ) ) : ?>
					<h2 class="nav-tab-wrapper">
				<?php
					foreach( $this->sections as $section ) {
						if ( isset( $section->is_tab ) && $section->is_tab ) {
							$tab_url = add_query_arg( array( 'tab' => $section->id ) );
							$active = ( $current_page == $section->id ) ? ' nav-tab-active' : '';
							echo '<a href="' . esc_url( $tab_url ) . '" class="nav-tab' . $active . '">' . esc_html( $section->title ) . '</a>';
						}
					}
				?>
				</h2>
				<?php endif; ?>

				<form method="post" action="options.php">
					<?php
						settings_fields( $this->id );
						do_settings_sections( $current_page );
						submit_button();
					?>
				 </form>
			</div>
		<?php
	}

	// Display custom menu/submenu page by adding action
	public function display_custom_menu_page()
	{
		do_action( $this->callback_action, $this );
	}
}
