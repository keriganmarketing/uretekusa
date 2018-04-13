<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'title'    => array(
		'type'  => 'text',
		'label' => esc_html__( 'Heading Title', 'grandpoza' ),
		'desc'  => esc_html__( 'Write the heading title content', 'grandpoza' ),
	),
	'subtitle' => array(
		'type'  => 'text',
		'label' => esc_html__( 'Heading Subtitle', 'grandpoza' ),
		'desc'  => esc_html__( 'Write the heading subtitle content', 'grandpoza' ),
	),
	'heading' => array(
		'type'    => 'select',
		'label'   => esc_html__('Heading Size', 'grandpoza'),
		'choices' => array(
			'h1' => 'H1',
			'h2' => 'H2',
			'h3' => 'H3',
			'h4' => 'H4',
			'h5' => 'H5',
			'h6' => 'H6',
		)
	),
	'centered' => array(
		'type'    => 'switch',
		'label'   => esc_html__('Centered', 'grandpoza'),
	),
    'text_color' => array(
		'type'    => 'color-picker',
        'value'   => '',
		'label'   => esc_html__('Color', 'grandpoza'),
	),
      'enable_margin_bottom' => array(
		'type'    => 'switch',
        'value'   => true,
		'label'   => esc_html__('Add Bottom space', 'grandpoza'),
	),
    'underline' => array(
		'type'  => 'switch',
        'value' => false,
		'label' => esc_html__('Underlined', 'grandpoza'),
	)
);
