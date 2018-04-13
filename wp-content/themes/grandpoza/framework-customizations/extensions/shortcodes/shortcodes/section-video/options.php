<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
    'title'    => array(
		'type'  => 'text',
		'label' => esc_html__( 'Insert Video URL', 'grandpoza'  ),
		'desc'  => esc_html__( 'Insert Video URL to embed this video', 'grandpoza'  )
	),
    'inner_title'    => array(
		'type'  => 'text',
		'label' => esc_html__( 'Inner Title', 'grandpoza'  ),
		'desc'  => esc_html__( 'Colored text in the title', 'grandpoza'  )
	),
    'description'    => array(
		'type'  => 'textarea',
		'label' => esc_html__( 'Video Description', 'grandpoza'  ),
		'desc'  => esc_html__( 'General Description of the video', 'grandpoza'  )
	),
	'url'    => array(
		'type'  => 'text',
		'label' => esc_html__( 'Insert Video URL', 'grandpoza'  ),
		'desc'  => esc_html__( 'Insert Video URL to embed this video', 'grandpoza'  )
	)
);
