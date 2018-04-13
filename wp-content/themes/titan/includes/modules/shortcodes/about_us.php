<div class="about-us sec-padd">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <figure class="about-img">
                    <img src="<?php echo esc_url($img); ?>" alt="<?php esc_html_e('about titan builders photo', 'titan'); ?>">
                </figure>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="about-text">
                    <h1><?php echo wp_kses_post($editor); ?></h1>
                    <div class="text">
                    	<?php echo wp_kses_post($text); ?>
                    </div>
                    <ul class="work-process">
                    	<?php foreach( $atts['about_us'] as $key => $item ): ?>
                        <li><span class="<?php echo wp_kses_post($item->icon); ?>"></span><?php echo wp_kses_post($item->title); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="link"><a href="<?php echo esc_url($btn_link); ?>" class="thm-btn bg-clr1"><?php echo wp_kses_post($btn_title); ?></a></div>
                </div>
            </div>
        </div>
    </div>
</div>
