<?php $query_args = array('post_type' => 'bunch_services' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);

if( $cat ) $query_args['services_category'] = $cat;
$query = new WP_Query($query_args); ?>

<?php if($query->have_posts()): ?>

<section class="our-services style-three">
    <div class="container">
        <div class="container-box anim-5-all clearfix">
            <div class="col-lg-4">
                <img src="<?php echo esc_url($img); ?>" alt="">
            </div>
            <div class="col-lg-8">
                <header class="section-title2 text-left style-two">
                    <h1><?php echo wp_kses_post($editor); ?></h1>     <span class="double-line"></span>      <p><?php echo wp_kses_post($text); ?></p>
                </header>
                <div class="service-style-three-wrap">
                	<?php while($query->have_posts()): $query->the_post();
					global $post;
					$services_meta = _WSH()->get_meta(); ?>
                    <div class="col-lg-6 single-service-style-three">
                        <div class="border">                        
                            <i class="<?php echo str_replace("icon ", "", titan_set($services_meta, 'fontawesome')); ?>"></i>
                            <div class="content">
                                <h4><?php the_title(); ?></h4>
                                <p><?php echo wp_kses_post(titan_trim(get_the_content(), $text_limit)); ?></p>
                                <a href="<?php echo esc_url(titan_set($services_meta, 'ext_url')); ?>"><?php esc_html_e('Read More', 'titan'); ?></a>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php endif; ?>
<?php wp_reset_postdata(); ?>