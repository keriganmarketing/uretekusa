<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

/**
 * @var array $atts
 */
?>

<div class="contact-box contact-us-area t-center p-20">
    <div class="contact-icon">
        <i class="<?php echo esc_attr($atts["icon"]); ?>"></i>
    </div>
    <h5 class="t-uppercase mb-10"><?php echo esc_attr($atts["title"]); ?></h5>
    <p class="color-mid mb-0"><?php echo esc_attr($atts["desc_1"]); ?></p>
    <p class="color-mid"><?php echo esc_attr($atts["desc_2"]); ?></p>
</div>