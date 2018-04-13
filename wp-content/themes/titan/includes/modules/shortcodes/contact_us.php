<!--Start contact form area-->
<section class="contact-form-area sec-padd-top">
    <div class="container">
        <div class="row">
           
            <div class="col-md-8">
                <div class="section-title">
                    <h2><?php echo wp_kses_post($editor); ?></h2>
                    <p><?php echo wp_kses_post($text); ?></p>
                </div>
                <div class="contact-form">
                    <?php echo do_shortcode($contact_shortcode); ?>
                </div>
            </div>
            
            <div class="col-md-4">
                <figure class="img-box">
                    <img src="<?php echo esc_url($img); ?>" alt="">
                </figure>
            </div>
                
        </div>
    </div>
</section>
<!--End contact form area-->
