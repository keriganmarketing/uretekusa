<?php

class Fabrique_Theme_Color_Control extends WP_Customize_Control
{
	public function __construct( $manager, $id, $args = array(), $options = array() )
	{

		parent::__construct( $manager, $id, $args );
	}

	public function render_content()
	{
		$output = '';

		if ( !empty( $this->label ) ) {
			$output .= '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
		}

		if ( !empty( $this->description ) ) {
			$output .= '<span class="description customize-control-description">' . esc_html( $this->description ) . '</span>';
		}

		$output .= '<div class="customize-control-content customize-control-preset-color">';

		foreach ( $this->color_presets() as $key => $preset ) {
			$output .= '<label class="js-input-label  bp-radio-image" data-preset="' . esc_attr( $preset ) . '">';
			$output .=   '<span class="icon icon-customize-color-' . esc_attr( $key ) . '"></span>';
			$output .=   '<input type="radio" />';
			$output .= '</label>';
		}

		$output .= '</div>';

		$output .= '<div class="customize-control-content customize-control-color-list">';
		$color_names = $this->color_names();

		foreach ( $this->settings as $key => $setting ) {
			$index = array_search( $key, array_keys( $this->settings ) );

			if ( 0 == $index ) {
				$output .= '<div class="customize-control-color-section customize-cotrol-color-section--brand">';
				$output .=    '<div class="customize-control customize-control-twist-section">';
				$output .=        '<span class="customize-control-title">' . esc_html__( 'Brand Color', 'fabrique-core' ) . '</span>';
				$output .=    '</div>';
			} elseif ( 2 == $index ) {
				$output .= '</div><div class="customize-control-color-section customize-cotrol-color-section--light">';
				$output .=    '<div class="customize-control customize-control-twist-section">';
				$output .=        '<span class="customize-control-title">' . esc_html__( 'Light Scheme', 'fabrique-core' ) . '</span>';
				$output .=    '</div>';
			} elseif ( 7 == $index ) {
				$output .= '</div><div class="customize-control-color-section customize-cotrol-color-section--dark">';
				$output .=    '<div class="customize-control customize-control-twist-section">';
				$output .=        '<span class="customize-control-title">' . esc_html__( 'Dark Scheme', 'fabrique-core' ) . '</span>';
				$output .=    '</div>';
			} elseif ( 12 == $index ) {
				$output .= '</div><div class="customize-control-color-section customize-cotrol-color-section--custom">';
				$output .=    '<div class="customize-control customize-control-twist-section">';
				$output .=        '<span class="customize-control-title">' . esc_html__( 'Custom Color', 'fabrique-core' ) . '</span>';
				$output .=    '</div>';
			}

			$output .= '<span class="customize-control-title">' . esc_html( $color_names[$setting->id] ) . '</span>';
			$output .= '<input type="text" class="js-customize-color" ' . fabrique_core_escape_content( $this->get_link( $key ) ) . ' data-default-color="' . esc_attr( $setting->default ) . '" />';

			if ( 14 == $index ) {
				$output .= '</div>';
			}
		}

		$output .= '</div>';

		echo fabrique_core_escape_content( $output );
	}

	protected function color_presets()
	{
		return array(
			'default' => '#56a9aa,#0e8a8c,#788791,#283035,#ffffff,#ebf0f5,#e3e3e3,#6a8985,#ffffff,#333333,#1d1d1d,#4f4f4f,#fafafa,#363636'
		);
	}

	protected function color_names()
	{
		return array(
			'bp_color_1' => esc_html__( 'Primary Brand', 'fabrique-core' ),
			'bp_color_2' => esc_html__( 'Secondary Brand', 'fabrique-core' ),
			'bp_color_3' => esc_html__( 'Primary Text', 'fabrique-core' ),
			'bp_color_4' => esc_html__( 'Secondary Text', 'fabrique-core' ),
			'bp_color_5' => esc_html__( 'Primary Background', 'fabrique-core' ),
			'bp_color_6' => esc_html__( 'Secondary Background', 'fabrique-core' ),
			'bp_color_7' => esc_html__( 'Border', 'fabrique-core' ),
			'bp_color_8' => esc_html__( 'Primary Text', 'fabrique-core' ),
			'bp_color_9' => esc_html__( 'Secondary Text', 'fabrique-core' ),
			'bp_color_10' => esc_html__( 'Primary Background', 'fabrique-core' ),
			'bp_color_11' => esc_html__( 'Secondary Background', 'fabrique-core' ),
			'bp_color_12' => esc_html__( 'Border', 'fabrique-core' ),
			'bp_color_13' => esc_html__( 'Custom 1 Color', 'fabrique-core' ),
			'bp_color_14' => esc_html__( 'Custom 2 Color', 'fabrique-core' ),
		);
	}
}
