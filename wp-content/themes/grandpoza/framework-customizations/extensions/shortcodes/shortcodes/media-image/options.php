<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'image'            => array(
		'type'  => 'upload',
		'label' => esc_html__( 'Choose Image', 'grandpoza'  ),
		'desc'  => esc_html__( 'Center the image', 'grandpoza'  )
	),
	'size'             => array(
		'type'    => 'group',
		'options' => array(
			'width'  => array(
				'type'  => 'text',
				'label' => esc_html__( 'Width', 'grandpoza'  ),
				'desc'  => esc_html__( 'Set image width', 'grandpoza'  ),
				'value' => 300
			),
			'height' => array(
				'type'  => 'text',
				'label' => esc_html__( 'Height', 'grandpoza'  ),
				'desc'  => esc_html__( 'Set image height', 'grandpoza'  ),
				'value' => 200
			)
		)
	),
    'centered'=> array(
         'label'        =>  esc_html__( 'Center Image', 'grandpoza'  ),
         'type'         => 'switch',
         'value'        => true,
    ),
	'image-link-group' => array(
		'type'    => 'group',
		'options' => array(
			'link'   => array(
				'type'  => 'text',
				'label' => esc_html__( 'Image Link', 'grandpoza'  ),
				'desc'  => esc_html__( 'Where should your image link to?', 'grandpoza'  )
			),
			'target' => array(
				'type'         => 'switch',
				'label'        => esc_html__( 'Open Link in New Window', 'grandpoza'  ),
				'desc'         => esc_html__( 'Select here if you want to open the linked page in a new window', 'grandpoza'  ),
				'right-choice' => array(
					'value' => '_blank',
					'label' => esc_html__( 'Yes', 'grandpoza'  ),
				),
				'left-choice'  => array(
					'value' => '_self',
					'label' => esc_html__( 'No', 'grandpoza'  ),
				),
			),
		)
	)
);

