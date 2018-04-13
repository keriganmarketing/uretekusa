<?php

abstract class Fabrique_Core_Admin_Setting
{
	public $id;
	public $title;
	public $description;
	public $value;

	// Render setting template
	abstract public function render_setting();

	public function __construct( $args )
	{
		foreach ( $args as $key => $val ) {
			$this->{$key} = $val;
		}

		// get setting value from page settings
		$page_settings = get_option( $this->page );
		$this->value = isset( $page_settings[$this->id] ) ? $page_settings[$this->id] : '';
	}

	// Render description
	public function render_description()
	{
		if ( !empty( $this->description ) ) {
			echo '<p class="description">' . $this->description . '</p>';
		}
	}

	// Sanitize the output
	public function sanitize_setting( $value )
	{
		return sanitize_text_field( $value );
	}

	// Add setting fields
	public function add_settings_field()
	{
		add_settings_field(
			$this->id,
			$this->title,
			array( $this, 'render_setting' ),
			$this->tab,
			$this->section
		);
	}
}
