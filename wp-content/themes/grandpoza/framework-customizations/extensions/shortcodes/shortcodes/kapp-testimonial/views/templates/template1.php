
<div class="testimonials-area testimonials-area-1 testimonial-list owl-carousel" data-margin="15" data-loop="true" data-autoplay="true" data-autoplay-timeout="4000" data-smart-speed="1000" data-nav-speed="false" data-dots="true" data-nav="false" data-items="1">

    <?php foreach($testimonials as $testimonial) { ?>

    <div class="testimonial-panel">
        <div class="testimonial-icon">
            <i class="fa fa-quote-left"></i>
        </div>
        <div class="testimonial-body">
            <p class="mb-20 font-14">
                <?php echo $testimonial['content']; ?>
            </p>
            <div class="testimonial-meta">
                <div class="testimonial-img">
                    <img src="<?php echo esc_url( $testimonial['avatar']['url'] );?>" alt="<?php echo esc_attr( $testimonial['author'] ); ?>" />
                </div>
                <h5 class="ptb-5 t-uppercase color-theme">
                    <?php echo esc_attr( $testimonial["author"] ); ?>
                </h5>
                <h6 class="mb-0 color-mid">
                    <?php echo esc_attr( $testimonial['job_title'] );?>
                </h6>
            </div>
        </div>
    </div>

    <?php } ?>

</div>