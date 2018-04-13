<?php

class Fabrique_Switch_Control extends WP_Customize_Control
{
	public $type = 'twist-switch';

	public function __construct( $manager, $id, $args = array() )
	{
		$this->children = isset( $args['children'] ) ? $args['children'] : array();
		$this->advance = isset( $args['advance'] ) ? $args['advance'] : false;

		parent::__construct( $manager, $id, $args );
	}

	public function render_content()
	{
		$attributes = array();
		$attributes[] = 'class="js-customize-switch bp-switch"';

		if ( !empty( $this->children ) ) {
			$attributes[] = 'data-parent="1"';
			$attributes[] = "data-children='[\"" . implode( '","', $this->children ) . "\"]'";

			if ( $this->advance ) {
				$attributes[] = 'data-advance="1"';
			}
		}

		$output  = '<label ' . implode( ' ', $attributes ) . '>';

		if ( !empty( $this->label ) ) {
			$output .= '<div class="customize-control-title bp-switch-title">' . esc_html( $this->label ) . '</div>';
		}

		$output .=   '<input type="checkbox" ' . fabrique_core_escape_content( $this->get_link() ) . ' ' . checked( $this->value(), true, false ) . ' />';
		$output .=   '<span></span>';
		$output .= '</label>';

		if ( !empty( $this->description ) ) {
			$output .= '<span class="description customize-control-description">' . esc_html( $this->description ) . '</span>';
		}

		echo fabrique_core_escape_content( $output );
	}
}
