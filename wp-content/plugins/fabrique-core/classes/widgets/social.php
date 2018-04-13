<?php

class Fabrique_Widget_Social extends Fabrique_Widget_Base
{
	protected function get_widget_options()
	{
		return array(
			'id' => 'fabrique_widget_social',
			'title' => esc_html__( 'Fabrique Social', 'fabrique-core' ),
			'widget_options' => array(
				'description' => esc_html__( 'Fabrique Social', 'fabrique-core' ),
				'classname' => 'fbq-widget fbq-widget-social'
			),
		);
	}

	public function widget( $args, $instance )
	{
		$widget = '';
		$social_class  = 'fbq-social';
		$instance['default_color'] = true;

		$widget .= '<div class="fbq-social">';
		$widget .=    '<div class="fbq-social-inner">';
		$widget .=        fabrique_get_social_icon( $instance );
		$widget .=    '</div>';
		$widget .= '</div>';

		$this->display_widget( $widget, $args, $instance );
	}

	public function form( $instance )
	{
		// Title
		$field = 'title';
		$value =  ( !empty( $instance[$field] ) ) ? $instance[$field] : null;

		$output  = $this->render_text( $field, $value, array(
			'label' => esc_html__( 'Title', 'fabrique-core' )
		));

		$field = 'icon_size';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : 'small';

		$output .= $this->render_select( 'icon_size', $value, array(
			'label' => esc_html__( 'Icon Size', 'fabrique-core' ),
			'choices' => array(
				'small' => esc_html__( 'Small', 'fabrique-core' ),
				'medium' => esc_html__( 'Medium', 'fabrique-core' ),
				'large' => esc_html__( 'Large', 'fabrique-core' ),
				'x-large' => esc_html__( 'X-Large', 'fabrique-core' )
			)
		));

		echo fabrique_core_escape_content( $output );
	}
}
