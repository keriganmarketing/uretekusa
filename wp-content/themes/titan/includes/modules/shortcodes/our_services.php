<?php $count = 1;
$query_args = array('post_type' => 'bunch_services' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);

if( $cat ) $query_args['services_category'] = $cat;
$query = new WP_Query($query_args); ?>

<?php if($query->have_posts()): ?>

<section class="service-section sec-padd-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-7"> 
                <div class="section-title">
                    <h2><?php echo wp_kses_post($title); ?></h2>
                    <p><?php echo wp_kses_post($text); ?></p>
                </div>
                
                <div class="service-area">
                    <div class="row-10">
                    	<?php while($query->have_posts()): $query->the_post();
						global $post;
						$services_meta = _WSH()->get_meta(); ?>
                        <div class="col-sm-4 co-x-6 column">
                            <div class="service-box">
                                <span class="fa <?php echo wp_kses_post(titan_set($services_meta, 'fontawesome')); ?>"></span>
                                <h5 class="service-name text-uppercase"><a href="<?php echo esc_url(titan_set($services_meta, 'ext_url')); ?>"><?php the_title(); ?></a></h5>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-lg-5">
                <div class="service-img">
                    <img src="<?php echo esc_url($img); ?>" alt="<?php esc_html_e('service image', 'titan'); ?>">
                </div>
            </div>
        </div>
    </div>
</section>

<?php endif; ?>
<?php wp_reset_postdata(); ?>