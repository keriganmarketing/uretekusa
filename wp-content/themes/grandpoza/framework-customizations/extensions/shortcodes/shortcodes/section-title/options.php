<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(

    'title'    => array(
        'type'  => 'text',
        'label' => esc_html__( 'Title', 'grandpoza'  ),
        'desc'  => esc_html__( 'Section title', 'grandpoza'  ),
    ),
    'subtitle' => array(
        'type'  =>'text',
        'label' => esc_html__( 'Subtitle' , 'grandpoza' ),
        'desc'  => esc_html__( 'Section Subtitle' , 'grandpoza' )
    ),
    'is_centralized' => array(
		'label'        => esc_html__('Align Center', 'grandpoza'),
		'type'         => 'switch',
	)
);