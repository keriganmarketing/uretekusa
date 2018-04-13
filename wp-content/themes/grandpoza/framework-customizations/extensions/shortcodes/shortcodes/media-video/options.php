<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
    'thumbnail' => array(
		'type'  => 'upload',
		'label' => esc_html__( 'Video Thumbnail', 'grandpoza'  ),
		'desc'  => esc_html__( 'Choose thumbnail image', 'grandpoza'  )
	),
	'url'    => array(
		'type'  => 'text',
		'label' => esc_html__( 'Insert Video URL', 'grandpoza'  ),
		'desc'  => esc_html__( 'Insert Video URL to embed this video', 'grandpoza'  )
	),
	'width'  => array(
		'type'  => 'text',
		'label' => esc_html__( 'Video Width', 'grandpoza'  ),
		'desc'  => esc_html__( 'Enter a value for the width', 'grandpoza'  ),
		'value' => 300
	),
	'height' => array(
		'type'  => 'text',
		'label' => esc_html__( 'Video Height', 'grandpoza'  ),
		'desc'  => esc_html__( 'Enter a value for the height', 'grandpoza'  ),
		'value' => 200
	)
);
