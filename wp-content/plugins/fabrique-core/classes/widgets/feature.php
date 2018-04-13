<?php

class Fabrique_Widget_Feature extends Fabrique_Widget_Base
{
	protected function get_widget_options()
	{
		return array(
			'id' => 'fabrique_widget_feature',
			'title' => esc_html__( 'Fabrique Feature', 'fabrique-core' ),
			'widget_options' => array(
				'description' => esc_html__( 'Fabrique Feature', 'fabrique-core' ),
				'classname' => 'fbq-widget fbq-widget-feature'
			),
		);
	}

	public function widget( $args, $instance )
	{
		$default = array(
			'alignment' => 'left',
			'image_url' => '',
			'image_size' => 'medium_large',
			'icon' => '',
			'icon_color' => 'default',
			'feature_title' => '',
			'feature_description' => '',
			'link_url' => '/',
			'link_label' => ''
		);

		$instance = array_merge( $default, $instance );

		$widget = '';
		$classes = array( 'fbq-widget-item' );
		$classes[] = 'fbq-' . $instance['alignment'] . '-align';

		if ( !empty( $instance['image_url'] ) || !empty( $icon ) || !empty( $instance['feature_title'] ) || !empty( $instance['feature_description'] ) || !empty( $instance['link_label'] ) ) {
			$widget .= '<div class="' . esc_attr( implode( ' ', $classes ) ) . '">';

			if ( !empty( $instance['image_url'] ) || !empty( $instance['icon'] ) ) {
				$widget .=    '<div class="fbq-widget-media">';
				if ( !empty( $instance['image_url'] ) ) {
					$widget .= fabrique_template_media( array(
						'image_url' => $instance['image_url'],
						'image_size' => $instance['image_size']
					) );
				} else {
					$widget .= fabrique_template_icon( array(
						'icon' => $instance['icon'],
						'icon_color' => $instance['icon_color'],
						'icon_size' => 'medium'
					) );
				}
				$widget .=    '</div>';
			}

			$widget .=    '<div class="fbq-widget-body">';
			if ( !empty( $instance['feature_title'] ) ) {
				$widget .=      '<h4 class="fbq-widget-title">' . do_shortcode( $instance['feature_title'] ) . '</h4>';
			}

			if ( !empty( $instance['feature_description'] ) ) {
				$widget .=      '<div class="fbq-widget-description">' . do_shortcode( $instance['feature_description'] ) . '</div>';
			}

			if ( !empty( $instance['link_label'] ) ) {
				$widget .=      '<a href="' . fabrique_escape_url( $instance['link_url'] ) . '">';
				$widget .=         do_shortcode( $instance['link_label'] );
				$widget .=      '</a>';
			}
			$widget .=    '</div>';
			$widget .= '</div>';
		}

		$this->display_widget( $widget, $args, $instance );
	}

	public function form( $instance )
	{
		$title = ( !empty( $instance['title'] ) ) ? $instance['title'] : null;
		$output  = $this->render_text( 'title', $title, array(
			'label' => esc_html__( 'Title', 'fabrique-core' )
		));

		$field = 'image_url';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : '';

		$output .= $this->render_media( $field, $value, array(
			'label' => esc_html__( 'Image Url', 'fabrique-core' )
		));

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

		$field = 'icon';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : '';

		$output .= $this->render_icon( $field, $value, array(
			'label' => esc_html__( 'Icon', 'fabrique-core' )
		));

		$field = 'icon_color';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : 'default';
		$output .= $this->render_color( $field, $value, array(
			'label' => esc_html__( 'Icon Color', 'fabrique-core' )
		));

		$field = 'feature_title';
		$value =  ( !empty( $instance[$field] ) ) ? $instance[$field] : '';

		$output .= $this->render_text( $field, $value, array(
			'label' => esc_html__( 'Feature Title', 'fabrique-core' )
		));

		$field = 'feature_description';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : '';

		$output .= $this->render_textarea( $field, $value, array(
			'label' => esc_html__( 'Feature Description', 'fabrique-core' )
		));

		$field = 'link_label';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : '';

		$output .= $this->render_text( $field, $value, array(
			'label' => esc_html__( 'Link Label', 'fabrique-core' )
		));

		$field = 'link_url';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : '';

		$output .= $this->render_text( $field, $value, array(
			'label' => esc_html__( 'Link URL', 'fabrique-core' )
		));

		$field = 'alignment';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : 'center';

		$output .= $this->render_select( $field, $value, array(
			'label' => esc_html__( 'Alignment', 'fabrique-core' ),
			'choices' => array(
				'left'   => esc_html__( 'Left', 'fabrique-core' ),
				'center' => esc_html__( 'Center', 'fabrique-core' ),
				'right'  => esc_html__( 'Right', 'fabrique-core' )
			)
		));

		echo fabrique_core_escape_content( $output );
	}

}
