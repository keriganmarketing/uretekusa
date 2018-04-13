<?php if ( ! defined( 'FW' ) ) {
          die( 'Forbidden' );
      }

      $options = array(
          'style'=> array(
                'label'     => esc_html__( 'Style', 'grandpoza'  ),
                'desc'      => esc_html__( 'Features', 'grandpoza'  ),
                'type'      => 'select',
                'choices'   => array( esc_html__( 'Style 1' , 'grandpoza' ) , esc_html__( 'Style 2' , 'grandpoza' ) , esc_html__( 'Style 3' , 'grandpoza' ) )
          ),
          'features' => array (
		        'label'         => esc_html__( 'Features', 'grandpoza'  ),
		        'popup-title'   => esc_html__( 'Add/Edit Feature', 'grandpoza'  ),
		        'desc'          => esc_html__( 'Here you can add, remove and edit your features.', 'grandpoza'  ),
		        'type'          => 'addable-popup',
		        'template'      => '{{=feature_title}}',
		        'popup-options' => array(
		              'icon'  => array(
                          'type'    => 'flaticon',
                          'label'   => esc_html__( 'Icon', 'grandpoza'  )
                      ),
                     'feature_title'=> array(
                          'type'    => 'text',
                          'label'   => esc_html__( 'Title', 'grandpoza'  )
                      ),
                      'description' => array(
                          'type'  => 'textarea',
                          'label' => esc_html__( 'Description of the Feature', 'grandpoza'  )
                      )
	            )
            )

      );
