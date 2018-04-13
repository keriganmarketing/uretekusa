<?php

class Fabrique_Select_Control extends WP_Customize_Control
{
	public function __construct( $manager, $id, $args = array(), $options = array() )
	{
		$this->select_type = isset( $args['select_type'] ) ? $args['select_type'] : 'menu';

		parent::__construct( $manager, $id, $args );
	}

	public function render_content()
	{
		$output = '<label>';

		if ( !empty( $this->label ) ) {
			$output .= '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
		}

		if ( !empty( $this->description ) ) {
			$output .= '<span class="description customize-control-description">' . esc_html( $this->description ) . '</span>';
		}

		if ( 'blueprint' === $this->select_type ) {
			$bp_args = array(
				'post_type' => 'twcbp_block',
				'posts_per_page' => -1
			);
			$bp_args_loop = new WP_Query( $bp_args );

			if ( empty( $bp_args_loop->posts ) ) {
				$output .= '<p>' . esc_html__( 'You have not created any blueprint block yet. Go to Blueprint Block in dashboard to create one.', 'fabrique-core' ) . '</p>';
			} else {
				$output .= '<select name="'. esc_attr( $this->id ) .'" id="'. esc_attr( $this->id ) .'" '. fabrique_core_escape_content( $this->get_link() ) .'>';

				foreach ( $bp_args_loop->posts as $bp_block ) {
					$output .= '<option value="'. esc_attr( $bp_block->ID ) .'" '. selected( $this->value(), $bp_block->ID, false ) .'>';
					$output .=    esc_html( $bp_block->post_title );
					$output .= '</option>';
				}

				$output .= '</select>';
			}
		} elseif ( 'sidebar' === $this->select_type ) {
			global $wp_registered_sidebars;

			$output .= '<select name="'. esc_attr( $this->id ) .'" id="'. esc_attr( $this->id ) .'" '. fabrique_core_escape_content( $this->get_link() ) .'>';

			foreach ( $wp_registered_sidebars as $sidebar ) {
				$output .= '<option value="'. esc_attr( $sidebar['id'] ) .'" '. selected( $this->value(), $sidebar['id'], false ) .'>';
				$output .=    esc_html( $sidebar['name'] );
				$output .= '</option>';
			}

			$output .= '</select>';
		} else {
			$menus = wp_get_nav_menus( $options );

			if ( empty( $this->$menus ) ) {
				$output .= '<p>' . esc_html__( 'You have not created any menu yet. Go to Appearance > Menu to create.', 'fabrique-core' ) . '</p>';
			} else {
				$output .= '<select name="'. esc_attr( $this->id ) .'" id="'. esc_attr( $this->id ) .'" '. fabrique_core_escape_content( $this->get_link() ) .'>';

				foreach ( $menus as $menu ) {
					$output .= '<option value="'. esc_attr( $menu->term_id ) .'" '. selected( $this->value(), $menu->term_id, false ) .'>';
					$output .=    esc_html( $menu->name );
					$output .= '</option>';
				}

				$output .= '</select>';
			}
		}

		$output .= '</label>';

		echo fabrique_core_escape_content( $output );
	}
}
