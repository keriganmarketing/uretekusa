
<div class="row testimonials-area testimonials-area-3 testimonial-slider owl-carousel" data-loop="true" data-autoplay="true" data-autoplay-timeout="10000" data-smart-speed="1000" data-nav-speed="false" data-margin="25" data-dots="false" data-nav="false" data-lg-nav="false" data-md-nav="false" data-sm-nav="false" data-xs-nav="false" data-xxs-nav="false" data-lg-items="3" data-md-items="3" data-sm-items="2" data-xs-items="1" data-xxs-items="1">

    <?php foreach($testimonials as $testimonial) { ?>

    <div class="item">

        <div class="testimonial-thumb">
            <img src="<?php echo esc_url($testimonial['avatar']['url']);?>" alt="<?php echo esc_attr( $testimonial["author"] ); ?>" />
        </div>

        <div class="testimonial-info">
            <p class="testimonial-text"><?php echo esc_attr( $testimonial['content'] ); ?></p>
            <h5 class="client-name t-uppercase"><?php echo esc_attr( $testimonial["author"] ); ?></h5>
            <h6 class="client-designation"><?php echo esc_attr( $testimonial['job_title'] );?></h6>
        </div>

    </div>

    <?php } ?>

</div>