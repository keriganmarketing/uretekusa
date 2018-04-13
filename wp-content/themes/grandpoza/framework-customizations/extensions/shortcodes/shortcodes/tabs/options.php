<?php if ( ! defined( 'FW' ) ) {
          die( 'Forbidden' );
      }

      $options = array(
 
          'tabs' => array (
		        'label'         => esc_html__( 'Tabs', 'grandpoza'  ),
		        'popup-title'   => esc_html__( 'Add/Edit Tab', 'grandpoza'  ),
		        'desc'          => esc_html__( 'Here you can add, remove and edit your tabs from the accordion.', 'grandpoza'  ),
		        'type'          => 'addable-popup',
		        'template'      => '{{=tab_title}}',
		        'popup-options' => array(
                     'tab_title'       => array(
                          'type'  => 'text',
                          'label' => esc_html__( 'Title', 'grandpoza'  )
                      ),
                      'description'       => array(
                          'type'  => 'wp-editor',
                          'label' => esc_html__( 'Tab Description', 'grandpoza'  )
                      )
	            )
            )

      );
