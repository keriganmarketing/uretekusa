<?php if ( ! defined( 'FW' ) ) { die( 'Forbidden' ); }

/**
 * @var array $atts
 */
?>

<div class="row mb-10 pb-5">
    <div class="col-lg-7 col-md-8 col-sm-10 col-xs-12 col-xs-center t-center mb-30">
        <h6 class="section-subtitle mb-10 t-uppercase color-mid"><?php echo esc_attr($atts["subtitle"]); ?></h6>
        <h2 class="section-title mb-20 font-22 t-uppercase"><?php echo esc_attr($atts["title"]); ?></h2>
        <div class="line"></div>
    </div>
</div>