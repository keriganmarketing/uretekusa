<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

      $css_classes = "";
        switch($atts['style'])
        {
            case '0':
                $css_classes = "features-area features-area-1";
                break;
            case '1':
                $css_classes = "features-area features-area-2";
                break;
            case '2':
                $css_classes = "features-area-3";
                break;

        }

?>
 <div class="row row-tb-15 <?php echo esc_attr($css_classes) ; ?>">
    <?php foreach ( fw_akg( 'features', $atts, array() ) as $feature ) { ?>

    <div class="col-md-4 col-sm-6 col-xs-12">
        <article class="feature-single">
            <div class="feature-icon">
                <i class="<?php echo esc_attr($feature['icon']); ?>"></i>
            </div>
            <div class="feature-content">
                <h4 class="mb-10">
                    <?php echo esc_attr($feature['feature_title']); ?>
                </h4>
                <p class="color-mid">
                    <?php echo esc_attr($feature['description']); ?>
                </p>
            </div>
        </article>
    </div>

    <?php } ?>
</div>