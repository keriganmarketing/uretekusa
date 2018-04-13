<?php

class Fabrique_Widget_Flickr extends Fabrique_Widget_Base
{
	protected function get_widget_options()
	{
		return array(
			'id' => 'fabrique_widget_flickr',
			'title' => esc_html__( 'Fabrique Flickr', 'fabrique-core' ),
			'widget_options' => array(
				'description' => esc_html__( 'Fabrique Flickr', 'fabrique-core' ),
				'classname' => 'fbq-widget fbq-widget-flickr'
			),
		);
	}

	public function widget( $args, $instance )
	{
		$default = array(
			'no_spacing' => false,
			'no_of_columns' => 4,
			'hover' => 'none',
			'id' => '',
			'no_of_items' => 8,
			'orderby' => 'latest'
		);

		$instance = array_merge( $default, $instance );

		$classes = array( 'fbq-widget-item' );
		$classes[] = 'fbq-widget-item--' . $instance['no_of_columns'];
		if ( 'none' !== $instance['hover'] ) $classes[] = 'hover-' . $instance['hover'];
		if ( isset( $instance['no_spacing'] ) && $instance['no_spacing'] ) $classes[] = 'no-spacing';

		if ( !empty( $instance['id'] ) ) {
			$widget .= '<div class="' . esc_attr( implode( ' ', $classes ) ) . '">';
			$widget .=    '<div class="fbq-widget-row">';

			if ( !empty( $instance['id'] ) ) {
				$flickr = '?count=' . esc_attr( $instance['no_of_items'] );
				$flickr .= '&amp;display=' . esc_attr( $instance['orderby'] );
				$flickr .= '&amp;user=' . esc_attr( $instance['id'] );
				$flickr .= '&amp;size=m&amp;layout=x&amp;source=user';

				$widget .= '<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne' . fabrique_core_escape_content( $flickr ) . '"></script>';
			} else {
				$widget .= '<div>Invalid ID</div>';
			}

			$widget .=    '</div>';
			$widget .= '</div>';
		}

		$this->display_widget( $widget, $args, $instance );
	}

	public function form( $instance )
	{
		$title =  ( !empty( $instance['title'] ) ) ? $instance['title'] : null;
		$output  = $this->render_text( 'title', $title, array(
			'label' => esc_html__( 'Title', 'fabrique-core' )
		));

		$field = 'id';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : '';

		$output .= $this->render_text( $field, $value, array(
			'label' => esc_html__('Flickr ID', 'fabrique-core' )
		));

		$field = 'no_spacing';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : false;

		$output .= $this->render_checkbox( $field, $value, array(
			'label' => esc_html__( 'No Spacing', 'fabrique-core' )
		) );

		$field = 'no_of_columns';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : 4;

		$output .= $this->render_select( $field, $value, array(
			'label' => esc_html__( 'No. of Columns', 'fabrique-core' ),
			'choices' => array(
				'1' => 1,
				'2' => 2,
				'3' => 3,
				'4' => 4,
				'6' => 6,
				'8' => 8
			)
		));

		$field = 'no_of_items';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : 8;

		$output .= $this->render_select( $field, $value, array(
			'label' => esc_html__( 'No. of Items', 'fabrique-core' ),
			'choices' => array(
				'1' => 1,
				'2' => 2,
				'3' => 3,
				'4' => 4,
				'5' => 5,
				'6' => 6,
				'7' => 7,
				'8' => 8,
				'9' => 9,
				'10' => 10,
				'11' => 11,
				'12' => 12
			)
		));


		$field = 'orderby';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : 'latest';

		$output .= $this->render_select( $field, $value, array(
			'label' => esc_html__( 'No. of Items', 'fabrique-core'),
			'choices' => array(
				'latest' => esc_html__( 'Latest', 'fabrique-core' ),
				'random' => esc_html__( 'Random', 'fabrique-core' )
			)
		));


		$field = 'hover';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : 'none';

		$output .= $this->render_select( $field, $value, array(
			'label' => esc_html__( 'Hover Animation', 'fabrique-core'),
			'choices' => array(
				'none' => esc_html__( 'None', 'fabrique-core' ),
				'zoom' => esc_html__( 'Zoom', 'fabrique-core' ),
				'slowzoom' => esc_html__( 'Slow Zoom', 'fabrique-core' ),
				'rotate' => esc_html__( 'Rotate', 'fabrique-core' ),
				'colorize' => esc_html__( 'Colorize', 'fabrique-core' ),
				'greyscale' => esc_html__( 'Greyscale', 'fabrique-core' )
			)
		));

		echo fabrique_core_escape_content( $output );
	}
}
