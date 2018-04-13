<?php if (!defined('FW')) {
          die('Forbidden');
      }

$options = array(
    'additional_css_classes' => array(
        'label'        => esc_html__( 'Additional CSS Classes' , 'grandpoza' ),
        'desc'         => esc_html__( 'CSS class names separated by space' , 'grandpoza' ),
        'type'         => 'text',
    ),
    'is_offset' => array(
        'label'        => esc_html__('1/2 Offset Column', 'grandpoza'),
        'type'         => 'switch',
    )
);
