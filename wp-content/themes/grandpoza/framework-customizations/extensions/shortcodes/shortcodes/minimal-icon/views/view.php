<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

/**
 * @var array $atts
 */
?>

<div class="contact-details-item">
    <div class="contact-details-item-inner">
        <i class="<?php echo esc_attr($atts["icon"]); ?>"></i>
        <h5>
            <?php echo esc_attr($atts["title"]); ?>
        </h5>
        <p>
            <?php echo esc_attr($atts["subtitle"]); ?>
        </p>
    </div>
</div>