<?php if ( ! defined( 'FW' ) ) {
          die( 'Forbidden' );
      }

      $options = array(
          'title'=> array(
               'label'         => esc_html__( 'Title', 'grandpoza'  ),
               'type' => 'text',
          ),
          'subtitle'=> array(
               'label'         => esc_html__( 'Subtitle', 'grandpoza'  ),
               'type'=>'text',
          ),
          'events' => array (
		        'label'         => esc_html__( 'Event', 'grandpoza'  ),
		        'popup-title'   => esc_html__( 'Add/Edit Timeline events', 'grandpoza'  ),
		        'desc'          => esc_html__( 'Timeline events', 'grandpoza'  ),
		        'type'          => 'addable-popup',
		        'template'      => '{{=title}}',
		        'popup-options' => array(

                      'title'       => array(
                          'type'    => 'text',
                          'label'   => esc_html__( 'Title', 'grandpoza'  )
                      ),
                      'description'       => array(
                          'type'    => 'textarea',
                          'label'   => esc_html__( 'Description of the event', 'grandpoza'  )
                      ),
                      'period'  => array(
                          'type'    => 'text',
                          'label'   => esc_html__( 'Period', 'grandpoza'  ),
                          'desc'    => esc_html__( 'E.g : 2017-2018' , 'grandpoza' ),
                      )
	            )
            )

      );
