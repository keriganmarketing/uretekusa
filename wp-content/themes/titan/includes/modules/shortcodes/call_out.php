<section class="call-out sec-padd center" style="background-image: url(<?php echo esc_url($bg_img); ?>);">
    <div class="container">
        <div class="content">
            <h2><?php echo wp_kses_post($editor); ?></h2>
            <p><?php echo wp_kses_post($text); ?></p>
            <a href="<?php echo esc_url($btn_link); ?>" class="thm-btn bg-clr1"><span class="flaticon-mail"></span><?php echo wp_kses_post($btn_title); ?></a>
        </div>
    </div>
</section>
