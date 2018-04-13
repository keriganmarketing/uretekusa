<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
    'icon'  => array(
        'type'  => 'flaticon',
        'label' => esc_html__( 'Icon', 'grandpoza'  )
    ),
    'title' => array(
        'type'  => 'text',
        'label' => esc_html__( 'Title', 'grandpoza'  ),
        'desc'  => esc_html__( 'Icon title', 'grandpoza'  ),
    ),
    'subtitle' => array(
        'type'  => 'text',
        'label' => esc_html__( 'Subtitle' , 'grandpoza' ),
    )
);