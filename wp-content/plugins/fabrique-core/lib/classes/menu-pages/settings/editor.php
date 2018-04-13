<?php

class Fabrique_Core_Admin_Setting_Editor extends Fabrique_Core_Admin_Setting
{
	public $args = array();

	public function render_setting()
	{
		$this->args['textarea_name'] = $this->input_name;
		$value = empty( $this->value ) && !empty( $this->default ) ? $this->default : $this->value;
		wp_editor( $value, preg_replace( '/[^\da-z]/i', '', $this->id), $this->args );
		$this->render_description();
	}

	public function sanitize_setting( $value )
	{
		return wp_kses_post( $value );
	}
}
