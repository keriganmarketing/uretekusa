<section class="home-google-map">
    <div 
        class="google-map" 
        id="contact-google-map" 
        data-map-lat="<?php echo wp_kses_post($latitude); ?>" 
		data-map-lng="<?php echo wp_kses_post($longitude); ?>" 
		data-icon-path="<?php echo esc_url(get_template_directory_uri()); ?>/images/icon/marker.png"
		data-map-title="<?php echo wp_kses_post($map_title); ?>"
		data-map-zoom="<?php echo wp_kses_post($zoom); ?>">
    </div>
    
    <div class="container">
        <div class="map-container">
            <div class="map-info">
                <h3><?php echo wp_kses_post($title); ?></h3>
                <ul class="contact-infos">
                    <li>
                        <div class="icon_box">
                            <i class="flaticon-construction-4"></i>
                        </div><!-- /.icon-box -->
                        <div class="text-box">
                            <p><?php echo wp_kses_post($address); ?></p>
                        </div><!-- /.text-box -->
                    </li>
                    <li>
                        <div class="icon_box">
                            <i class="flaticon-mail"></i>
                        </div><!-- /.icon-box -->
                        <div class="text-box">
                            <p><a href="mailto:<?php echo sanitize_email($email); ?>"><?php echo wp_kses_post($email); ?></a></p>
                        </div><!-- /.text-box -->
                    </li>
                    <li>
                        <div class="icon_box">
                            <i class="icon-technology"></i>
                        </div><!-- /.icon-box -->
                        <div class="text-box">
                            <p><?php echo wp_kses_post($phone); ?></p>
                        </div>
                    </li>
                </ul>

                <div class="social-icon">
                    <ul class="list-inline">
                    	<?php foreach( $atts['social_icons'] as $key => $item ): ?>
                        <li><a href="<?php echo esc_url($item->url); ?>" target="_blank"><i class="fa <?php echo esc_attr($item->icon); ?>"></i></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
