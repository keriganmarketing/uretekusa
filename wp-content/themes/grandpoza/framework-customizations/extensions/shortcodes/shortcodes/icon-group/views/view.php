<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

/**
 * @var array $atts
 */
?>


<article class="feature-single">
    <div class="feature-icon">
        <i class="<?php echo esc_attr($atts["icon"]); ?>"></i>
    </div>
    <div class="feature-content">
        <h4 class="mb-10"><?php echo esc_attr($atts["title"]); ?></h4>
        <p class="color-mid"><?php echo esc_attr($atts["description"]); ?></p>
    </div>
</article>
