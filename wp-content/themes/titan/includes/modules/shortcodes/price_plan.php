<section id="pricing-content">
    <div class="container">
        <div class="section-title2">
            <span class="double-line"></span>   <h1><?php echo wp_kses_post($title); ?></h1>   <span class="double-line"></span>
        </div>

        <div class="row price-table-wrap pt0">
        	<?php $i=0; foreach( $atts['pricing_plan'] as $key => $item ): ?>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 price-table wow zoomIn" data-wow-duration=".5s" data-wow-delay="<?php echo esc_attr($i.'s'); ?>" style="visibility: visible; animation-duration: 0.5s; animation-delay: 0s; animation-name: zoomIn;">
                <div class="price-content">
                    <div class="price-table-top">
                        <h3><?php echo wp_kses_post($item->price_title); ?></h3>
                    </div>
                    <div class="price-box">
                        <?php echo wp_kses_post($item->sign); ?> <span><?php echo wp_kses_post($item->amount); ?></span> <?php esc_html_e('/', 'titan'); ?><?php echo wp_kses_post($item->month); ?>
                    </div>
                    <ul class="price-info">
                        <?php $fearures = explode("\n", ($item->text));
						foreach($fearures as $feature): ?>
						<li><?php echo wp_kses_post($feature); ?></li>
						<?php endforeach; ?>
                    </ul>
                    <a href="<?php echo esc_url($item->btn_link); ?>" class="hvr-bounce-to-right"><?php echo wp_kses_post($item->btn_title); ?></a>
                </div>
            </div>
            <?php $i++; endforeach; ?>
        </div>
    </div>
</section>
