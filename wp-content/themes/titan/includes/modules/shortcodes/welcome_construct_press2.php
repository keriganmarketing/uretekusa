<section id="welcome-to-construct" style="background-image: url(<?php echo esc_url($bg_img); ?>);">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <div class="img-holder hvr-rectangle-out pull-right">
                    <img src="<?php echo esc_url($img); ?>" alt="">
                </div>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                <h2><?php echo wp_kses_post($title); ?></h2>
                <?php echo wp_kses_post($text); ?>
            </div>              
        </div>
    </div>
</section>
