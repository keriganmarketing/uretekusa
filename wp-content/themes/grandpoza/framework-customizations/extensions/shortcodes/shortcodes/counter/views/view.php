<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

/**
 * @var array $atts
 */
?>


<div class="counter-wrapper mt-xs-20">
    <div class="counter-icon">
        <i class="<?php echo esc_attr($atts["icon"]); ?>"></i>
    </div>
    <div class="counter-number">
        <h2 class="count-text" data-speed="2000" data-stop="<?php echo esc_attr($atts["count"]); ?>">0</h2>
        <div class="line"></div>
        <h6 class="counter-title t-uppercase">
            <?php echo esc_attr($atts["title"]); ?>
        </h6>
    </div>
</div>
