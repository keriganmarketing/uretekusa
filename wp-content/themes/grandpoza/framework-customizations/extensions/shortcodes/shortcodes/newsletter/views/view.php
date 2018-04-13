<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

/**
 * @var array $atts
 */
?>

<div class="get-quotes-content text-center color-white">
    <div class="col-lg-7 col-md-8 col-sm-10 col-xs-center">
        <h2 class="mb-20"><?php echo esc_attr($atts["title"]); ?></h2>
        <h6 class="mb-30"><?php echo esc_attr($atts["subtitle"]); ?></h6>
        <div class="row">
            <div class="col-lg-10 col-md-11 col-xs-center">
                <?php echo do_shortcode('[mc4wp_form id="'.esc_attr($atts['form']).'""]'); ?>
            </div>
        </div>
    </div>
</div>