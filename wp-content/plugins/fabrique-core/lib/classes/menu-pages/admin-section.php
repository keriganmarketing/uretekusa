<?php

class Fabrique_Core_Admin_Section
{
	public $id;
	public $title;
	public $description;
	public $settings = array();

	public function __construct( $args )
	{
		foreach ( $args as $key => $val ) {
			$this->{$key} = $val;
		}
	}

	// Add a setting to this section
	public function add_section_setting( $setting )
	{
		$this->settings[$setting->id] = $setting;
	}

	// Display description
	public function display_section_description()
	{
		if ( !empty( $this->description ) ) {
			echo '<p class="description">' . $this->description . '</p>';
		}
	}

	// Add the settings section
	public function register_section_settings()
	{
		add_settings_section(
			$this->id,
			$this->title,
			array( $this, 'display_section_description' ),
			$this->get_section_page_slug()
		);
	}

	// Get page slug
	public function get_section_page_slug()
	{
		return ( isset( $this->is_tab ) && $this->is_tab ) ? $this->id : $this->page;
	}
}
