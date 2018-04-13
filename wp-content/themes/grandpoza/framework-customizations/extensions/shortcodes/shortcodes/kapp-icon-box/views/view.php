<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

/**
 * @var array $atts
 */
?>

<div class="question bg-gray faqs-area-2">
    <h5 class="mb-10">
        <i class="<?php echo esc_attr($atts["icon"]); ?> bg-theme"></i>
        <?php echo esc_attr($atts["title"]); ?>
    </h5>
    <p class="color-mid">
        <?php echo esc_attr($atts["description"]); ?>
    </p>
</div>