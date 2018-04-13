<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$sliders = array();

if ( class_exists( 'RevSlider' ) ) {
    $rev_slider = new RevSlider();
    foreach($rev_slider->getAllSliderAliases() as $alias){
        $sliders[$alias] = $alias;
    }
}

$options = array(

    'slider'    => array(
        'type'      => 'select',
        'label'     => esc_html__( 'Title', 'grandpoza'  ),
        'desc'      => esc_html__( 'Icon title', 'grandpoza'  ),
        'choices'   => $sliders,
    )
);