<?php

class Fabrique_Widget_Banner extends Fabrique_Widget_Base
{
	protected function get_widget_options()
	{
		return array(
			'id' => 'fabrique_widget_banner',
			'title' => esc_html__( 'Fabrique Banner', 'fabrique-core' ),
			'widget_options' => array(
				'description' => esc_html__( 'Fabrique Banner', 'fabrique-core' ),
				'classname' => 'fbq-widget fbq-widget-banner'
			),
		);
	}

	public function widget( $args, $instance )
	{
		$default = array(
			'no_of_columns' => 2,
			'no_of_items' => 2,
			'image_size' => 'medium_large'
		);

		$instance = array_merge( $default, $instance );

		$widget = '';
		$column_class = ( 2 == (int)$instance['no_of_columns'] ) ? 'col-6' : 'col-12';

		$link = isset( $instance['banner_link_1'] ) ? $instance['banner_link_1'] : '/';
		$label = isset( $instance['banner_label_1'] ) ? $instance['banner_label_1'] : '';
		$image_url = ( isset( $instance['banner_image_1'] ) && !empty( $instance['banner_image_1'] ) ) ? $instance['banner_image_1'] : '';

		$widget .= '<div class="fbq-widget-item">';

		if ( !empty( $image_url ) || !empty( $label ) ) {
			$widget .=   '<div class="' . esc_attr( $column_class ) . '">';

			if ( empty( $link ) ) {
				$widget .=    fabrique_template_media( array(
					'image_url' => $image_url,
					'image_size' => $instance['image_size']
				) );
			} else {
				$widget .=    '<a class="fbq-widget-media" href="' . fabrique_escape_url( $link ) . '">';
				$widget .=      fabrique_template_media( array(
					'image_url' => $image_url,
					'image_size' => $instance['image_size']
				) );
				$widget .=    '</a>';
			}

			if ( !empty( $label ) ) {
				$widget .=    '<div class="fbq-widget-body">';
				$widget .=      '<h4 class="fbq-widget-title">' . do_shortcode( $label ) . '</h4>';
				$widget .=    '</div>';
			}

			$widget .=   '</div>';
		}

		if ( 2 == (int)$instance['no_of_items'] ) {
			$link_2 = isset( $instance['banner_link_2'] ) ? $instance['banner_link_2'] : '/';
			$label_2 = isset( $instance['banner_label_2'] ) ? $instance['banner_label_2'] : '';
			$image_url_2 = ( isset( $instance['banner_image_2'] ) && !empty( $instance['banner_image_2'] ) ) ? $instance['banner_image_2'] : '';

			if ( !empty( $image_url_2 ) || !empty( $label_2 ) ) {
				$widget .= '<div class="'. esc_attr( $column_class ) .'">';

				if ( empty( $link_2 ) ) {
					$widget .=   fabrique_template_media( array(
						'image_url' => $image_url_2,
						'image_size' => $instance['image_size']
					) );
				} else {
					$widget .=   '<a class="fbq-widget-media" href="' . fabrique_escape_url( $link_2 ) . '">';
					$widget .=     fabrique_template_media( array(
						'image_url' => esc_url( $image_url_2 ),
						'image_size' => $instance['image_size']
					) );
					$widget .=   '</a>';
				}

				if ( !empty( $label_2 ) ) {
					$widget .=   '<div class="fbq-widget-body">';
					$widget .=     '<h4 class="fbq-widget-title">' . do_shortcode( $label_2 ) . '</h4>';
					$widget .=   '</div>';
				}

				$widget .= '</div>';
			}
		}

		$widget .= '</div>';


		$this->display_widget( $widget, $args, $instance );
	}

	public function form( $instance )
	{
		// Title
		$field = 'title';
		$value =  ( !empty( $instance[$field] ) ) ? $instance[$field] : null;

		$output  = $this->render_text( $field, esc_attr( $value ), array(
			'label' => esc_html__( 'Title', 'fabrique-core' )
		));

		// Banner Image 1
		$field = 'banner_image_1';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : '';

		$output .= $this->render_media( $field, $value, array(
			'label' => esc_html__( 'Banner Image 1', 'fabrique-core' )
		));

		// Banner Label 1
		$field = 'banner_label_1';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : '';

		$output .= $this->render_text( $field, $value, array(
			'label' => esc_html__( 'Banner Label 1', 'fabrique-core' )
		));

		// Banner Link 1
		$field = 'banner_link_1';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : '';

		$output .= $this->render_text( $field, $value, array(
			'label' => esc_html__('Banner Link 1', 'fabrique-core')
		));

		// Banner Image 2
		$field = 'banner_image_2';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : '';

		$output .= $this->render_media( $field, $value, array(
			'label' => esc_html__( 'Banner Image 2', 'fabrique-core' )
		));

		// Banner Label 2
		$field = 'banner_label_2';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : '';

		$output .= $this->render_text($field, $value, array(
			'label' => esc_html__( 'Banner Label 2', 'fabrique-core' )
		));

		// Banner Link 2
		$field = 'banner_link_2';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : '';

		$output .= $this->render_text( $field, $value, array(
			'label' => esc_html__( 'Banner Link 2', 'fabrique-core' )
		));

		// No of Diaplay Items
		$field = 'no_of_items';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : 2;

		$output .= $this->render_select( $field, $value, array(
			'label' => esc_html__( 'No. of Display Items', 'fabrique-core'),
			'choices' => array(
				'1' => 1,
				'2' => 2
			)
		));

		// No of Columns
		$field = 'no_of_columns';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : 2;

		$output .= $this->render_select( $field, $value, array(
			'label' => esc_html__( 'No. of Columns', 'fabrique-core' ),
			'choices' => array(
				'1' => 1,
				'2' => 2
			)
		));

		// Image Size
		$field = 'image_size';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : 'medium_large';

		$output .= $this->render_select( $field, $value, array(
			'label' => esc_html__( 'Image Size', 'fabrique-core' ),
			'choices' => array(
				'thumbnail' => esc_html__( 'Thumbnail', 'fabrique-core' ),
				'medium' => esc_html__( 'Medium', 'fabrique-core' ),
				'twist_medium' => esc_html__( 'Twist Medium', 'fabrique-core' ),
				'medium_large' => esc_html__( 'Medium Large', 'fabrique-core' ),
				'large' => esc_html__( 'Large', 'fabrique-core' ),
				'twist_large' => esc_html__( 'Twist Large', 'fabrique-core' ),
				'full' => esc_html__( 'Full', 'fabrique-core' )
			)
		));

		echo fabrique_core_escape_content( $output );
	}
}
