<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$args = array('post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1);
$cf7_contact_forms  = array();
$cf7_posts = get_posts($args);

foreach($cf7_posts as $form){
    $cf7_contact_forms[$form->ID] = $form->ID." ".$form->post_tile;
}

$options = array(
    'contact_form'=> array(
        'label'     => esc_html__( 'Choose Contact form', 'grandpoza'  ),
        'type'      => 'select',
        'choices'   => $cf7_contact_forms
    )

);
