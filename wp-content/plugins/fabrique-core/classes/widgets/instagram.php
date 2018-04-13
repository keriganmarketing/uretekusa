<?php

class Fabrique_Widget_Instagram extends Fabrique_Widget_Base
{
	protected function get_widget_options()
	{
		return array(
			'id' => 'fabrique_widget_instagram',
			'title' => esc_html__( 'Fabrique Instagram', 'fabrique-core' ),
			'widget_options' => array(
				'description' => 'Fabrique Instagram',
				'classname' => 'fbq-widget fbq-widget-instagram'
			),
		);
	}

	public function widget( $args, $instance )
	{
		$default = array(
			'username' => '',
			'access_token' => '',
			'force_square' => false,
			'no_spacing' => false,
			'no_of_columns' => 4,
			'no_of_items' => 4,
			'size' => 'large',
			'hover' => 'none'
		);

		$instance = array_merge( $default, $instance );
		$widget = '';
		$size = $instance['size'];

		$classes = array( 'fbq-widget-item' );
		$classes[] = 'fbq-widget-item--' . $instance['no_of_columns'];
		if ( 'none' !== $instance['hover'] ) $classes[] = 'hover-' . $instance['hover'];
		if ( $instance['no_spacing'] ) $classes[] = 'no-spacing';

		if ( !empty( $instance['username'] ) && !empty( $instance['access_token'] ) ) {
			$widget .= '<div class="' . implode( ' ', $classes ) . '">';
			$widget .=    '<div class="fbq-widget-row">';

			$instagram = fabrique_core_scrape_instagram( $instance['username'], $instance['access_token'], $instance['no_of_items'] );

			if ( is_wp_error( $instagram ) ) {
				$widget .= '<div class="fbq-widget-instagram-item">';
				$widget .=   esc_html__( 'There is an error occur', 'fabrique-core' );
				$widget .= '</div>';
			} else {
				$base_item_class = 'fbq-widget-instagram-item';

				foreach ( $instagram as $i => $data ) {
					$item_class = $base_item_class;
					$image_style = '';
					$image_link = $data['link'];
					if ( 'thumbnail' === $size ) {
						$data = $data['thumbnail'];
					}

					if ( $instance['force_square'] ) {
						$item_class .= ' square';
						if ( $data['width'] > $data['height'] ) {
							$item_class .= ' landscape';
							$image_style .= ' style="left:' . ($data['height'] - $data['width'])/(2*$data['width'])*100 . '%;"';
						} elseif ( $data['width'] < $data['height'] ) {
							$item_class .= ' portrait';
							$image_style .= ' style="top:' . ($data['width'] - $data['height'])/(2*$data['height'])*100 . '%;"';
						}
					}

					$widget .= '<div class="' . esc_attr( $item_class ) . '">';
					$widget .=    '<a class="fbq-widget-media" href="' . $image_link . '" target="_blank" >';
					$widget .=      '<img src="' . $data['url'] . '" width="' . $data['width'] . '" height="' . $data['height'] . '" alt=""' . $image_style . '/>';
					$widget .=    '</a>';
					$widget .= '</div>';

					if ( 0 == ( ( $i + 1 ) % $instance['no_of_columns'] ) && $instance['no_of_items'] != $i + 1 ) {
						$widget .= '<div class="fbq-widget-break"></div>';
					}
				}
			}

			$widget .=    '</div>';
			$widget .= '</div>';
		}

		$this->display_widget( $widget, $args, $instance );
	}

	public function form( $instance )
	{
		$title =  (!empty($instance['title'])) ? $instance['title'] : null;
		$output  = $this->render_text( 'title', esc_attr( $title ), array(
			'label' => esc_html__( 'Title', 'fabrique-core' )
		));

		$field = 'username';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : '';

		$output .= $this->render_text( $field, $value, array(
			'label' => esc_html__( 'Username', 'fabrique-core' )
		));

		$field = 'access_token';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : '';

		$output .= $this->render_text($field, $value, array(
			'label' => esc_html__( 'Access Token', 'fabrique-core' )
		));

		$field = 'force_square';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : false;

		$output .= $this->render_checkbox( $field, $value, array(
			'label' => esc_html__( 'Force Square', 'fabrique-core' )
		) );


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


		$field = 'size';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : 'large';

		$output .= $this->render_select( $field, $value, array(
			'label' => esc_html__( 'Image Size', 'fabrique-core' ),
			'choices' => array(
				'thumbnail' => 'Thumbnail',
				'large' => 'Large',
			)
		));


		$field = 'hover';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : 'none';

		$output .= $this->render_select( $field, $value, array(
			'label' => esc_html__( 'Hover Animation', 'fabrique-core' ),
			'choices' => array(
				'none' => 'None',
				'zoom' => 'Zoom',
				'slowzoom' => 'Slow Zoom',
				'rotate' => 'Rotate',
				'colorize' => 'Colorize',
				'greyscale' => 'Greyscale'
			)
		));

		echo fabrique_core_escape_content( $output );
	}
}
