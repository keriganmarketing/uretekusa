
<div class="testimonials-area testimonials-area-4 row">

    <div class="container">
        <div class="testimonial-list owl-carousel" data-dots="true" data-loop="true" data-autoplay="true" data-autoplay-timeout="4000" data-nav-speed="false">
            <?php foreach($testimonials as $testimonial) { ?>

            <div class="single-testimonial">
                <div class="testimonial-author">
                    <img src="<?php echo esc_url($testimonial['avatar']['url']);?>" alt="<?php echo esc_attr( $testimonial["author"] ); ?>" />
                </div>
                <p class="color-white font-15 mb-30">
                    <?php echo esc_attr( $testimonial['content'] ); ?>
                </p>
                <h4 class="color-white">
                    <?php echo esc_attr( $testimonial["author"] ); ?>
                </h4>
                <h6 class="color-white t-bold">
                    <?php echo esc_attr( $testimonial['job_title'] ); ?>
                </h6>
            </div>

            <?php } ?>
        </div>
    </div>
</div>