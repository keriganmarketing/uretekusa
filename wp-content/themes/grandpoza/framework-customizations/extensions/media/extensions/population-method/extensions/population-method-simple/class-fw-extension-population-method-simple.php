<?php if (!defined('FW')) die('Forbidden');

class FW_Extension_Population_Method_Simple extends FW_Extension implements Population_Method_Interface
{
	private $multimedia_types = array('image', 'video');
    protected function _init()
    {

    }
	public function get_multimedia_types()
	{
		return $this->multimedia_types;
	}


	public function get_population_method()
	{
		return array('simple' =>"simple");
	}

	public function get_population_options($multimedia_types, $custom_options)
	{
		$media_type_choices = $this->transform_multimedia_types_array($multimedia_types);
		$media_type_values = array_keys($media_type_choices);
		$media_type_values = array_shift($media_type_values);

		$options = array(

			'wrapper-population-method-custom' => array(
				'title' => esc_html__( 'Click to edit / Drag to reorder' , 'grandpoza' ) . ' <span class="fw-slide-spinner spinner"></span>',
				'type' => 'box',
				'options' => array(
					'custom-slides' =>
						array(
							'label' => false,
							'desc' => false,
							'type' => 'slides',
							'multimedia_type' => array_keys($media_type_choices),
							'thumb_size' => array('height' => 75, 'width' => 138),
							'slides_options' => array(
								'multimedia' => array(
									'type'  => 'multi-picker',
									'desc'  => false,
									'label' => false,
									'hide_picker' => true,
									'show_borders'=>true,
									'picker' => array(
										'selected'      => array(
											'type'      => 'radio',
											'attr'      => array( 'class' => 'multimedia-radio-controls' ),
											'label'     => esc_html__('Choose', 'grandpoza'),
											'choices'   => $media_type_choices,
											'value'     => $media_type_values
										)),
									'choices' => $this->get_multimedia_types_sets($multimedia_types)
								),

                        	    'content'   => array(
				                        'type'  => 'wp-editor',
				                        'label' => esc_html__( 'Slider Text' , 'grandpoza' ),
				                        'value' => '',
                                        'size'=>'large',
                                        'media_buttons'=> false
			                    )
							)
						)
				)
			)
		);

		if (!empty($custom_options)) {
			$options['wrapper-population-method-custom']['options']['custom-slides']['slides_options']['extra-options'] =
				array(
					'type' => 'multi',
					'attr' => array('class' => 'fw-no-border'),
					'label' => false,
					'desc' => false,
					'inner-options' => $custom_options,
				);
		}

		return $options;
	}

	private function transform_multimedia_types_array($multimedia_types)
	{
		return array_combine(
			array_values($multimedia_types),
			array_map('ucfirst', $multimedia_types)
		);
	}

	private function get_multimedia_types_sets($multimedia_types)
	{
		$options = array(
			'image' => array(
				'src' => array(
					'label' => esc_html__('Image', 'grandpoza'),
					'type' => 'upload',
				)
			),
			'video' => array(
				'src' => array(
					'label' => esc_html__('Video', 'grandpoza'),
					'type' => 'text'
				)
			),
		);

		$filtered_options = array();

		$filtered_multimedia_types = array_intersect($this->multimedia_types, $multimedia_types);

		foreach ($filtered_multimedia_types as $multimedia_type) {
			$filtered_options[$multimedia_type] = $options[$multimedia_type];
		}

		return $filtered_options;
	}

	public function get_number_of_images($post_id)
	{
		return count(fw_get_db_post_option($post_id, 'custom-slides', array()));
	}

	public function get_frontend_data( $post_id ) {
		$meta        = fw_get_db_post_option( $post_id );
		$post_status = get_post_status( $post_id );

		$collector = array();

		if ( 'publish' === $post_status and isset( $meta['populated'] ) ) {

			$slider_name       = $meta['slider']['selected'];
			$population_method = $meta['slider'][ $slider_name ]['population-method'];

			$collector = array(
				'slides'   => array(),
				'settings' => array(
					'title'             => $meta['title'],
					'slider_type'       => $slider_name,
					'population_method' => $population_method,
					'post_id'           => $post_id,
					'extra'             => isset( $meta['custom-settings'] ) ? $meta['custom-settings'] : array(),
				)
			);


			foreach ( $meta['custom-slides'] as $slide ) {

				$collector_slide = array(
					'multimedia_type' => $slide['multimedia']['selected'],
					'src'             =>
						( $slide['multimedia']['selected'] === 'image' && ! empty( $slide['multimedia'][ $slide['multimedia']['selected'] ]['src']['url'] ) ) ?
							$slide['multimedia'][ $slide['multimedia']['selected'] ]['src']['url'] :
							$slide['multimedia'][ $slide['multimedia']['selected'] ]['src'],
					'attachment_id'   =>
						( $slide['multimedia']['selected'] === 'image' && ! empty( $slide['multimedia'][ $slide['multimedia']['selected'] ]['src']['attachment_id'] ) ) ?
							$slide['multimedia'][ $slide['multimedia']['selected'] ]['src']['attachment_id'] :
							'',
					'content'            => ! empty( $slide['content'] ) ? $slide['content'] : '',
					'extra'              => isset( $slide['extra-options'] ) ? $slide['extra-options'] : array()
				);

				array_push( $collector['slides'], $collector_slide );
			}
		}

		return $collector;
	}

}
