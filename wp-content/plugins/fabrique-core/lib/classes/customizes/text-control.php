<?php

class Fabrique_Text_Control extends WP_Customize_Control
{
	public $type = 'twist-text';

	public function render_content()
	{
		$output = '<label>';

		if ( !empty( $this->label ) ) {
			$output .= '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
		}

		$attributes = array();
		$attributes[] = 'type="text"';
		$attributes[] = 'class="bp-input"';
		$attributes[] = 'value="' . esc_attr( $this->value() ) . '"';
		$attributes[] = fabrique_core_escape_content( $this->get_link() );

		$output .= '<input ' . implode( ' ', $attributes ) . ' />';

		if ( !empty( $this->description ) ) {
			$output .= '<span class="description customize-control-description">' . esc_html( $this->description ) . '</span>';
		}

		$output .= '</label>';

		echo fabrique_core_escape_content( $output );
	}
}
