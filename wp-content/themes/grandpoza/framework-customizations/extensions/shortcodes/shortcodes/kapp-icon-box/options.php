<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
    'icon'       => array(
        'type'  => 'icon',
        'label' => esc_html__( 'Icon', 'grandpoza'  )
    ),
    'title'    => array(
        'type'  => 'text',
        'label' => esc_html__( 'Title', 'grandpoza'  ),
        'desc'  => esc_html__( 'Icon title', 'grandpoza'  ),
    ),
    'description' => array(
        'type'  => 'textarea',
        'label' => esc_html__( 'Description' , 'grandpoza' ),
    )
);