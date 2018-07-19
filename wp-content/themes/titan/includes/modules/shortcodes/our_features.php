<section class="two-column">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-sm-12 column1" style="background-image: url(<?php echo esc_url($bg_img); ?>);">
                <div class="content">
                    <h2><?php echo wp_kses_post($title); ?></h2>
                    <p><?php echo wp_kses_post($text); ?></p>
                    <a href="<?php echo esc_url($btn_link); ?>" class="thm-btn bg-clr2"><?php echo wp_kses_post($btn_title); ?></a>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 column2">
                <div class="content">
                    <h2><?php echo wp_kses_post($title_r); ?></h2>
                    <p><?php echo wp_kses_post($text_r); ?></p>
                    <a href="<?php echo esc_url($btn_link_r); ?>" class="thm-btn bg-clr1"><?php echo wp_kses_post($btn_title_r); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>
