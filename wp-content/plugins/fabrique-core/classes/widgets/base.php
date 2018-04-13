<?php

abstract class Fabrique_Widget_Base extends WP_Widget
{
	public function __construct()
	{
		$options = array(
			'widget_options' => array(),
			'control_options' => array()
		);

		$options = array_merge( $options, $this->get_widget_options() );

		parent::__construct( $options['id'], $options['title'], $options['widget_options'] );
	}

	abstract protected function get_widget_options();

	protected function display_widget( $widget, $args, $instance )
	{
		$title = '';

		if ( !empty( $instance['title'] ) ) {
			$title .= $args['before_title'];
			$title .= $instance['title'];
			$title .= $args['after_title'];
		} else {
			$title .= '';
		}

		$output = $args['before_widget'];
		$output .= $title;
		$output .= $widget;
		$output .= $args['after_widget'];

		echo fabrique_core_escape_content( $output );
	}

	protected function render_media( $field, $value, $options=array() )
	{
		$label = ( isset( $options['label'] ) ) ? $options['label'] : $field;

		$field_id = $this->get_field_id( $field );
		$field_name = $this->get_field_name( $field );

		$output  = '<p>';
		$output .= '<label for="' . esc_attr( $field_id ) . '">' . fabrique_core_escape_content( $label ) . ' </label>';
		$output .= '<span class="js-widget-media bp-input-group">';
		$output .=   '<input type="text" name="' . esc_attr( $field_name ) . '" class="js-media-input bp-input" value="' . esc_attr( $value ) .'" />';
		$output .=   '<span class="js-media-library bp-input-group-addon" data-type="image">' . esc_html__( 'Choose', 'fabrique-core' ) . '</span>';
		$output .= '</span>';
		$output .= '</p>';

		return $output;
	}

	protected function render_icon( $field, $value, $options=array() )
	{
		$label = ( isset( $options['label'] ) ) ? $options['label'] : $field;

		$field_id = $this->get_field_id( $field );
		$field_name = $this->get_field_name( $field );

		$output  = '<p>';
		$output .= 		'<label for="' . esc_attr( $field_id ) . '">' . fabrique_core_escape_content( $label ) . ' </label>';
		$output .= 		'<span class="js-general-icon-chooser bp-input-group bp-icon-chooser" data-input-name="' . esc_attr( $field_name ) . '" data-value="' . esc_attr( $value ) . '"></span>';
		$output .= '</p>';

		return $output;
	}

	protected function render_color( $field, $value, $options=array() )
	{
		$label = ( isset( $options['label'] ) ) ? $options['label'] : $field;

		$field_id = $this->get_field_id( $field );
		$field_name = $this->get_field_name( $field );

		$output  = '<p>';
		$output .= 		'<label for="' . esc_attr( $field_id ) . '">' . fabrique_core_escape_content( $label ) . ' </label>';
		$output .= 		'<span class="js-widget-color bp-widget-color">';
		$output .= 			'<input type="hidden" id="' . esc_attr( $field_id ) . '" name="' . esc_attr( $field_name ) . '" value="' . esc_attr( $value ) . '" />';
		$output .= 			'<span class="js-color-control" data-value="' . esc_attr( $value ) . '"></span>';
		$output .= 		'</span>';
		$output .= '</p>';

		return $output;
	}

	protected function render_text( $field, $value, $options=array() )
	{
		$label = ( isset( $options['label'] ) ) ? $options['label'] : $field;

		// label, select_options, class=
		$field_id = $this->get_field_id( $field );
		$field_name = $this->get_field_name( $field );

		$output  = '<p>';
		$output .= 	'<label for="' . esc_attr( $field_id ) . '">' . esc_attr( $label ) . ' </label>';
		$output .= 	'<input type="text" class="widefat" id="' . esc_attr( $field_id ) . '" name="' . esc_attr( $field_name ) . '" value="' . esc_attr( $value ) . '" />';
		$output .= '</p>';

		return $output;
	}

	protected function render_checkbox( $field, $value, $options=array() )
	{
		$label = ( isset( $options['label'] ) ) ? $options['label'] : $field;

		$field_id = $this->get_field_id( $field );
		$field_name = $this->get_field_name( $field );

		$output  = '<p>';

		if ( 'on' === $value ) {
			$output .= '<input type="checkbox" class="checkbox" id="' . esc_attr( $field_id ) . '" name="' . esc_attr( $field_name ) . '" checked /> ';
		} else {
			$output .= '<input type="checkbox" class="checkbox" id="' . esc_attr( $field_id ) . '" name="' . esc_attr( $field_name ) . '" /> ';
		}

		$output .= 	'<label for="' . esc_attr( $field_id ) . '">' . esc_html( $label ) . '</label>';
		$output .= '</p>';

		return $output;
	}

	protected function render_select( $field, $value, $options=array() )
	{
		$label = ( isset( $options['label'] ) ) ? $options['label'] : $field;
		$choices = ( isset( $options['choices'] ) ) ? $options['choices'] : array();

		$field_id = $this->get_field_id( $field );
		$field_name = $this->get_field_name( $field );

		$attributes = array();
		$attributes[] = 'id="' . esc_attr( $field_id ) . '"';

		if ( isset( $options['class'] ) ) {
			$attributes[] = 'class="' . esc_attr( $options['class'] ) . '"';
		}

		if ( isset( $options['multiple'] ) && $options['multiple'] ) {
			$attributes[] = 'name="' . esc_attr( $field_name ) . '[]" multiple="multiple"';
		} else {
			$attributes[] = 'name="' . esc_attr( $field_name ) . '"';
		}

		$output  = '<p>';
		$output .= 	'<label for="' . esc_attr( $field_id ) . '">' . esc_html( $label ) . ' </label>';
		$output .= 	'<select ' . implode( ' ', $attributes ) . '>';

		foreach ( $choices as $key => $choice ) {
			if ( ( is_array( $value ) && in_array( $key, $value ) ) || ( $key == $value ) )  {
				$output .= '<option value="' . esc_attr( $key ) . '" selected>' . esc_html( $choice ) . '</option>';
			} else {
				$output .= '<option value="' . esc_attr( $key ) . '">' . esc_html( $choice ) . '</option>';
			}
		}

		$output .= 	'</select>';
		$output .= '</p>';

		return $output;
	}

	protected function render_textarea( $field, $value, $options=array() )
	{
		$label = ( isset( $options['label'] ) ) ? $options['label'] : $field;

		$field_id = $this->get_field_id( $field );
		$field_name = $this->get_field_name( $field );

		$output  = '<p>';
		$output .= 	'<label for="' . esc_attr( $field_id ) . '">' . esc_html( $label ) . ' </label>';
		$output .= 	'<textarea class="widefat" id="' . esc_attr( $field_id ) . '" name="' . esc_attr( $field_name ) . '">';
		$output .= 		esc_html( $value );
		$output .= 	'</textarea>';
		$output .= '</p>';

		return $output;
	}

}
