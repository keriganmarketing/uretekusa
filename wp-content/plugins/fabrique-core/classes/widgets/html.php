<?php

class Fabrique_Widget_Html extends Fabrique_Widget_Base
{
	protected function get_widget_options()
	{
		return array(
			'id' => 'fabrique_widget_html',
			'title' => esc_html__( 'Fabrique HTML', 'fabrique-core' ),
			'widget_options' => array(
				'description' => esc_html__( 'Fabrique HTML', 'fabrique-core' ),
				'classname' => 'fbq-widget fbq-widget-html'
			),
		);
	}

	public function widget( $args, $instance )
	{
		$default = array( 'html' => '' );
		$instance = array_merge( $default, $instance );
		$widget = do_shortcode( html_entity_decode( $instance['html'] ) );

		$this->display_widget( $widget, $args, $instance );
	}

	public function form( $instance )
	{
		$title = ( !empty( $instance['title'] ) ) ? $instance['title'] : null;
		$output  = $this->render_text( 'title', $title, array(
			'label' => esc_html__( 'Title', 'fabrique-core' )
		));

		$field = 'html';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : '';

		$output .= $this->render_textarea( $field, $value, array(
			'label' => esc_html__( 'HTML', 'fabrique-core' )
		));

		echo fabrique_core_escape_content( $output );
	}

}
