<?php

class Fabrique_Radio_Control extends WP_Customize_Control
{
	public $type = 'twist-radio';

	public function __construct( $manager, $id, $args = array() )
	{
		$this->children = isset( $args['children'] ) ? $args['children'] : array();
		$this->names = isset( $args['names'] ) ? $args['names'] : array();
		$this->radio_type = isset( $args['radio_type'] ) ? $args['radio_type'] : 'button';
		$this->radio_style = isset( $args['radio_style'] ) ? $args['radio_style'] : 'full';

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

		if ( !empty( $this->children ) ) {
			$i = 0;
			$attributes[] = 'data-parent="1"';
			$data_children = "data-children='{";
			foreach ( $this->children as $key => $value ) {
				if ( 0 != $i ) {
					$data_children .= ',';
				}
				$data_children .= '"' . esc_attr( $key ) . '":["' . implode( '","', $value ) . '"]';
				$i++;
			}
			$data_children .= "}'";
			$attributes[] = $data_children;
		}

		if ( 'image' === $this->radio_type ) {
			$attributes[] = 'class="js-customize-radio"';
		} else {
			$attributes[] = 'class="js-customize-radio bp-btn-group"';
		}

		$output .= '<div ' . implode( ' ' , $attributes ) . '>';

		foreach ( $this->choices as $key => $value ) {
			$class = ( $control_value === $key ) ? 'active ' : ' ';

			if ( 'image' === $this->radio_type ) {
				$class  .= 'bp-radio-image--' . esc_attr( $this->radio_style );

				$output .= '<label class="js-input-label bp-radio-image ' . esc_attr( $class ) . '">';
				$output .=   '<span class="icon icon-' . esc_attr( $value ) . '"></span>';
				$output .=   '<input type="radio" ' . fabrique_core_escape_content( $this->get_link() ) . 'value="' . esc_attr( $key ) . '" name="' . esc_attr( '_customize-radio-' . $this->id ) . '" />';

				if ( 'box' === $this->radio_style && isset( $this->names[$key] ) ) {
					$output .= '<span class="bp-radio-image-label">' . esc_html( $this->names[$key] ) . '</span>';
				}

				$output .= '</label>';
			} else {
				$output .= '<label class="js-input-label bp-btn ' . $class . '">';
				$output .=   '<input type="radio" ' . fabrique_core_escape_content( $this->get_link() ) . 'value="' . esc_attr( $key ) . '" name="' . esc_attr( '_customize-radio-' . $this->id ) . '" />';
				$output .=   esc_html( $value );
				$output .= '</label>';
			}
		}

		$output .= '</div>';

		echo fabrique_core_escape_content( $output );
	}
}
