<?php if ( ! defined( 'FW' ) ) {
          die( 'Forbidden' );
      }

      $options = array(
          'col_style'=> array(
             'label'    => esc_html__( 'Column Style', 'grandpoza'  ),
             'type'     => 'select',
             'choices'  => array( '3/1' , '6/1' ),
             'value'    => '0'
          ),
          'logos' => array (
		        'label'         => esc_html__( 'Logos', 'grandpoza'  ),
		        'popup-title'   => esc_html__( 'Add/Edit Logo', 'grandpoza'  ),
		        'desc'          => esc_html__( 'Here you can add, remove logos.', 'grandpoza'  ),
		        'type'          => 'addable-popup',
		        'template'      => '{{=title}}',
		        'popup-options' => array(
		              'logo'  => array(
                          'type'    => 'upload',
                          'label'   => esc_html__( 'Image / Logo', 'grandpoza'  )
                      ),
                      'title'   => array(
                          'type'    => 'text',
                          'label'   => esc_html__( 'Image name / Logo Name', 'grandpoza'  )
                      )
	            )
            )

      );
