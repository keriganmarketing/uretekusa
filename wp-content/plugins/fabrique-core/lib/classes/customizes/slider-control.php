<?php

class Fabrique_Slider_Control extends WP_Customize_Control
{
	public $type = 'twist-slider';

	public function __construct( $manager, $id, $args = array() )
	{
		$this->min = isset( $args['min'] ) ? $args['min'] : 0;
		$this->max = isset( $args['max'] ) ? $args['max'] : 100;

		parent::__construct( $manager, $id, $args );
	}

	public function render_content()
	{
		$output = '<label>';

		if ( !empty( $this->label ) ) {
			$output .= '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
		}

		$attributes = array();
		$attributes[] = 'class="customize-bp-slider js-customize-slider"';
		$attributes[] = 'data-min="' . esc_attr( $this->min ) . '"';
		$attributes[] = 'data-max="' . esc_attr( $this->max ) . '"';
		$attributes[] = 'data-value="'. esc_attr ( $this->value() ) . '"';

		$input_attributes = array();
		$input_attributes[] = 'type="text"';
		$input_attributes[] = 'class="js-slider-input bp-input"';
		$input_attributes[] = 'name="'. esc_attr( '_customize-slider-' . $this->id ) .'"';
		$input_attributes[] = fabrique_core_escape_content( $this->get_link() );

		$output .= '<div ' . implode( ' ', $attributes ) . '>';
		$output .=   '<div class="js-slider-widget bp-slider-widget"></div>';
		$output .=   '<input ' . implode( ' ', $input_attributes ) . ' /> ';
		$output .= '</div>';

		if ( !empty( $this->description ) ) {
			$output .= '<span class="description customize-control-description">' . esc_html( $this->description ) . '</span>';
		}

		$output .= '</label>';

		echo fabrique_core_escape_content( $output );
	}
}
