<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

/**
 * @var array $atts
 */

echo do_shortcode('[rev_slider alias="'.esc_attr($atts['slider']).'"]'); 