<?php

class Fabrique_Color_Control extends WP_Customize_Control
{
	public $type = 'twist-color';

	public function enqueue()
	{
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_style( 'wp-color-picker' );
	}

	public function render_content()
	{
		$output  = '';

		if ( !empty( $this->description ) ) {
			$output .= '<span class="description customize-control-description">' . esc_html( $this->description ) . '</span>';
		}

		if ( !empty( $this->label ) ) {
			$output .= '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
		}

		$output .= '<div class="js-customize-color-control customize-control-twist-color">';
		$output .=   '<input type="hidden" ' . fabrique_core_escape_content( $this->get_link() ) . ' />';
		$output .=   '<div class="js-color-input bp-customize-color-input" data-value="' . esc_attr( $this->value() ) . '"></div>';
		$output .= '</div>';

		echo fabrique_core_escape_content( $output );
	}
}
