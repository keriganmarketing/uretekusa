<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

      $args = array('post_type' => 'mc4wp-form', 'posts_per_page' => -1);


      $mchimp_forms = array();
      $_mchimp_forms = get_posts($args);

      foreach($_mchimp_forms as $form){
          $mchimp_forms[$form->ID] = $form->post_title;
      }

$options = array(
    'title'    => array(
        'type'  => 'text',
        'label' => esc_html__( 'Title', 'grandpoza'  ),
        'desc'  => esc_html__( 'Form Title', 'grandpoza'  ),
    ),
    'subtitle' => array(
        'type'  =>'text',
        'label' => esc_html__( 'Subtitle', 'grandpoza'  ),
        'desc'  => esc_html__( 'Subtitle', 'grandpoza'  )
    ),
    'form'=> array(
        'type'      =>'select',
        'label'     => esc_html__( 'Subtitle', 'grandpoza'  ),
        'desc'      => esc_html__( 'Subtitle', 'grandpoza'  ),
        'choices'   => $mchimp_forms
    ),
);