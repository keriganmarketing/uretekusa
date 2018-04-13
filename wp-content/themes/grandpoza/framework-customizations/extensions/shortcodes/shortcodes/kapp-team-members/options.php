<?php if ( ! defined( 'FW' ) ) {
          die( 'Forbidden' );
      }

      $options = array(

        'style' => array(
           'label'      => esc_html__( 'Style', 'grandpoza' ),
           'desc'       => esc_html__( 'Display Style', 'grandpoza' ),
           'type'       => 'select',
           'choices'    => array( esc_html__( 'Style 1' , 'grandpoza' ) , esc_html__( 'Style 2' , 'grandpoza' ) , esc_html__( 'Style 3' , 'grandpoza' ) , esc_html__( 'Style 4' , 'grandpoza' ) , esc_html__( 'Style 5' , 'grandpoza' ) ),
           'value'      => 0,
        ),

        'team_members'=> array(
           'label'         => esc_html__( 'Team Member', 'grandpoza' ),
           'popup-title'   => esc_html__( 'Edit Member', 'grandpoza' ),
           'desc'          => esc_html__( 'Edit Member profile : Social Media & Contacts', 'grandpoza' ),
           'type'          => 'addable-popup',
           'template'      => '{{=name}}',
           'popup-options' => array(
                  'picture' => array(
                      'type'    => 'upload',
                      'label'   => esc_html__( 'Picture', 'grandpoza' )
                  ),
                  'name'       => array(
                      'type'     => 'text',
                      'label'    => esc_html__( 'Name', 'grandpoza' )
                  ),
                  'title'       => array(
                      'type'  => 'text',
                      'label' => esc_html__( 'Job Title', 'grandpoza' )
                  ),
                  'experience' => array(
                      'type'    => 'text',
                      'label'   => esc_html__( 'Work experience', 'grandpoza' )
                  ),
                   'training'=> array(
                      'type'    => 'text',
                      'label'   => esc_html__( 'Training', 'grandpoza' )
                  ),
                  'description'       => array(
                      'type' => 'textarea',
                      'label' => esc_html__( 'Member description', 'grandpoza' )
                  ),
                  'profile' => array(
                  'label'         => esc_html__( 'Profile', 'grandpoza' ),
                  'popup-title'   => esc_html__( 'Edit Profile', 'grandpoza' ),
                  'desc'          => esc_html__( 'Edit Member profile : Social Media & Contacts', 'grandpoza' ),
                  'type'          => 'popup',
                  'template'      => '{{=name}}',
                  'popup-options' => array(

                      'facebook_id'   => array(
                          'label' => esc_html__( 'Facebook', 'grandpoza' ),
                          'desc'  => esc_html__( 'Facebook Page Url', 'grandpoza' ),
                          'type'  => 'text'
                      ),
                      'twitter_id'    => array(
                          'label' => esc_html__( 'Twitter', 'grandpoza' ),
                          'desc'  => esc_html__( '', 'grandpoza' ),
                          'type'  => 'text'
                      ),
                      'linkedin_id'     => array(
                          'label' => esc_html__( 'Linkedin', 'grandpoza' ),
                          'desc'  => esc_html__( '', 'grandpoza' ),
                          'type'  => 'text'
                      ),
                      'google_id'      => array(
                          'label' => esc_html__( 'Google Plus', 'grandpoza' ),
                          'desc'  => esc_html__( 'Google Plus Page', 'grandpoza' ),
                          'type'  => 'text'
                      ),
                       'phone'      => array(
                          'label' => esc_html__( 'Phone Number', 'grandpoza' ),
                          'desc'  => esc_html__( 'Telephone', 'grandpoza' ),
                          'type'  => 'text'
                      ),
                       'email'      => array(
                          'label' => esc_html__( 'Email', 'grandpoza' ),
                          'desc'  => esc_html__( 'Email Address', 'grandpoza' ),
                          'type'  => 'text'
                      ),
                  )
              )

          )
      )
    );
