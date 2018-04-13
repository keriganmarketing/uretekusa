<?php

class Fabrique_Section_Control extends WP_Customize_Control
{
	public $type = 'twist-section';

	public function render_content()
	{
		$output = '';

		if ( !empty( $this->label ) ) {
			$output .= '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
		}

		if ( !empty( $this->description ) ) {
			$output .= '<span class="description customize-control-description">' . esc_html( $this->description ) . '</span>';
		}

		echo fabrique_core_escape_content( $output );
	}
}
