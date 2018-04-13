<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

      $options = array(
          'picture'  => array(
              'type'  => 'upload',
              'label' => esc_html__( 'Picture', 'grandpoza' )
          ),
          'name'       => array(
              'type'  => 'text',
              'label' => esc_html__( 'Name', 'grandpoza'  )
          ),
          'title'       => array(
              'type'  => 'text',
              'label' => esc_html__( 'Job Title', 'grandpoza'  )
          ),
          'description'       => array(
              'type'  => 'textarea',
              'label' => esc_html__( 'Member description', 'grandpoza'  )
          ),
              'Profile' => array(
              'label'         => esc_html__( 'Profile', 'grandpoza'  ),
              'popup-title'   => esc_html__( 'Edit Profile', 'grandpoza'  ),
              'desc'          => esc_html__( 'Edit Member profile : Social Media & Contacts', 'grandpoza'  ),
              'type'          => 'popup',
              'template'      => '{{=name}}',
              'popup-options' => array(

                  'facebook_id'   => array(
                      'label' => esc_html__( 'Facebook', 'grandpoza'  ),
                      'type'  => 'text'
                  ),
                  'twitter_id'    => array(
                      'label' => esc_html__( 'Twitter', 'grandpoza'  ),
                      'type'  => 'text'
                  ),
                  'linkedin_id'     => array(
                      'label' => esc_html__( 'Linkedin', 'grandpoza'  ),
                      'type'  => 'text'
                  ),
                  'google_id'      => array(
                      'label' => esc_html__( 'Google Plus', 'grandpoza'  ),
                      'type'  => 'text'
                  )
              )
          )
      );
