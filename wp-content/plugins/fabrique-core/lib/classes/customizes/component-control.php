<?php

class Fabrique_Component_Control extends WP_Customize_Control
{
	public $type = 'twist-component';

	public function __construct( $manager, $id, $args = array() )
	{
		parent::__construct( $manager, $id, $args );
	}

	public function render_content()
	{
		$control_value = $this->value();

		$output  = '';

		if ( !empty( $this->label ) ) {
			$output .= '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
		}

		if ( !empty( $this->description ) ) {
			$output .= '<span class="description customize-control-description">' . esc_html( $this->description ) . '</span>';
		}

		$attributes = array();
		$attributes[] = 'class="js-customize-component"';
		$attributes[] = 'data-controller="' . esc_attr( $this->id  ) . '"';

		$output .= '<div ' . implode( ' ' , $attributes ) . '>';
		$output .= 	'<ul>';

		$multi_values = !is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value();

		foreach ( $this->choices as $value => $label ) {
			$output .= '<li>';
			$output .=	'<label class="js-input-label js-component bp-checkbox">';
			$output .=		'<input type="checkbox" value="' . esc_attr( $value ) . '" ' . checked( in_array( $value, $multi_values ), true, false ) . ' />';
			$output .=		'<span class="fcon"></span>' . $label;
			$output .=	'</label>';
			$output .= '</li>';
		}

		$output .= 	'</ul>';
		$output .= 	'<input type="hidden" ' . fabrique_core_escape_content( $this->get_link() ) . ' value="' . esc_attr( implode( ',', $multi_values ) ) . '" />';
		$output .= '</div>';

		echo fabrique_core_escape_content( $output );
	}
}
