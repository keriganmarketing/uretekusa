<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
?>

<div class="row mb-20">
    <div class="col-lg-7 col-md-8 col-sm-10 col-xs-12 col-xs-center t-center mb-40">
        <h2 class="mb-20 font-24 t-uppercase"><?php echo  esc_attr($atts["title"]); ?></h2>
        <p class="color-mid">
            <?php echo esc_html($atts["subtitle"]); ?>
        </p>
    </div>
</div>

<div class="timeline-area timeline"><?php $x=1; foreach ( fw_akg( 'events', $atts, array() ) as $event ) { ?>
    <div class="timeline-block row row-rl-0 mtb-20 mtb-md-10">
        <div class="timeline-block-wrapper col-md-6 col-sm-12<?php $x%2 == 0 ? print ' col-md-offset-6' : '';?>">
            <div class="timeline-content">
                <h6 class="t-uppercase mb-10"><?php echo esc_html($event["title"]); ?></h6>
                <p class="color-mid">
                    <?php echo esc_html($event["description"]); ?>
                </p>
            </div>
        </div>
        <span class="timeline-date"><?php echo esc_html($event["period"]); ?></span>
    </div><?php $x++;} ?>
</div>