<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
    'icon'  => array(
        'type'  => 'flaticon',
        'label' => esc_html__( 'Icon', 'grandpoza' )
    ),
    'title'     => array(
        'type'  => 'text',
        'label' => esc_html__( 'Title', 'grandpoza' ),
        'desc'  => esc_html__( 'Box title', 'grandpoza' ),
    ),
    'desc_1'    => array(
        'type'  => 'text',
        'label' => esc_html__( 'Description 1' , 'grandpoza' ),
    ),
    'desc_2'    => array(
        'type'  => 'text',
        'label' => esc_html__( 'Description 2' , 'grandpoza' ),
    )
);