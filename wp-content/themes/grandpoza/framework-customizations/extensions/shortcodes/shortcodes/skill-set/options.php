<?php if ( ! defined( 'FW' ) ) {
          die( 'Forbidden' );
      }

      $options = array(
          'title' => array (
		        'label'         => esc_html__( 'Title', 'grandpoza'  ),
		        'type'   =>  "text",
                ),
          'skills' => array (
		        'label'         => esc_html__( 'Skills', 'grandpoza'  ),
		        'popup-title'   => esc_html__( 'Add/Edit Skills', 'grandpoza'  ),
		        'type'          => 'addable-popup',
		        'template'      => '{{=skill_title}} {{=skill_percent}}%',
		        'popup-options' => array(
                     'skill_title'       => array(
                          'type' => 'text',
                          'label' => esc_html__( 'Title', 'grandpoza'  )
                      ),
                      'skill_percent'       => array(
                          'type' => 'text',
                          'label' => esc_html__( 'Percentage 0-100 without % symbol', 'grandpoza'  )
                      )
	            )
            )

      );
