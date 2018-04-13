<?php if (!defined('FW')) {
	die('Forbidden');
}

$options = array(
    'layout' => array(
			'title' => esc_html__( 'Layout', 'grandpoza' ),
			'type' => 'tab',
			'options' => array(
	            'is_fullwidth' => array(
		            'label'        => esc_html__('Full Width', 'grandpoza'),
		            'type'         => 'switch',
	            ),
                 'center_mobile' => array(
		            'label'        => esc_html__('Center content on small device', 'grandpoza'),
		            'type'         => 'switch',
                    'value'=> false,
	            ),

                'class'=> array(
		            'label' => esc_html__('CSS Class', 'grandpoza'),
		            'desc'  => esc_html__('CSS class of the section', 'grandpoza'),
		            'type'  => 'text',
	            ),

               )
            ),

        'background'=> array(
            'title' => esc_html__( 'Background', 'grandpoza' ),
			'type' => 'tab',
			'options' => array(
                'background_color' => array(
		            'label' => esc_html__('Background Color', 'grandpoza'),
		            'desc'  => esc_html__('Please select the background color', 'grandpoza'),
		            'type'  => 'color-picker',
	            ),
                'background_image' => array(
		            'label'   => esc_html__('Background Image', 'grandpoza'),
		            'desc'    => esc_html__('Please select the background image', 'grandpoza'),
		            'type'    => 'background-image',
	            ),
	            'video' => array(
		            'label' => esc_html__('Background Video', 'grandpoza'),
		            'desc'  => esc_html__('Insert Video URL to embed this video', 'grandpoza'),
		            'type'  => 'text',
	            ),
        )
        ),
        'margin_padding'=> array(
            'title' => esc_html__( 'Margin and Padding', 'grandpoza' ),
			'type' => 'tab',
			'options' => array(
                 'padding' => array(
		            'label'        => esc_html__('Padding', 'grandpoza'),
		            'type'         => 'text',
                    'value'        => '30px 0',
                    'desc'         => esc_html__('e.g 30px 10px 25px 0px', 'grandpoza'),
	            ),
                'margin' => array(
		            'label'        => esc_html__('Margin', 'grandpoza'),
		            'type'         => 'text',
                    'value'        => '0',
                    'desc'         => esc_html__('e.g 20px 30px 25px 0px', 'grandpoza'),
	            ),
        )
        )


);
