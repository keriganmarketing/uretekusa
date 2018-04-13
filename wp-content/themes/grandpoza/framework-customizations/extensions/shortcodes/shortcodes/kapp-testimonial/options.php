<?php if ( ! defined( 'FW' ) ) {
          die( 'Forbidden' );
      }

      $options = array(
          'style'=> array(
                'label'     =>  esc_html__( 'Style', 'grandpoza'  ),
                'type'      => 'select',
                'choices'   => array( esc_html__( 'Style 1' , 'grandpoza' ) , esc_html__( 'Style 2' , 'grandpoza' ) , esc_html__( 'Style 3' , 'grandpoza' ) , esc_html__( 'Style 4' , 'grandpoza' ) ),
                'value'     => 0,
          ),
          'testimonials' => array (
		        'label'         => esc_html__( 'Testimonials', 'grandpoza'  ),
		        'popup-title'   => esc_html__( 'Add/Edit Testimonial', 'grandpoza'  ),
		        'desc'          => esc_html__( 'Here you can add, remove and edit your Testimonials.', 'grandpoza'  ),
		        'type'          => 'addable-popup',
		        'template'      => '{{=author}}',
		        'popup-options' => array(
		              'avatar'  => array(
                          'type'  => 'upload',
                          'label' => esc_html__( 'Picture', 'grandpoza'  )
                      ),
                      'author'  => array(
                          'type'    => 'text',
                          'label'   => esc_html__( 'Name', 'grandpoza'  )
                      ),
                     'job_title' => array(
                          'type'    => 'text',
                          'label'   => esc_html__( 'Title', 'grandpoza'  )
                      ),
                      'content'  => array(
                          'type'     => 'textarea',
                          'label'    => esc_html__( 'Testimonial', 'grandpoza'  )
                      )
	            )
            )

      );
