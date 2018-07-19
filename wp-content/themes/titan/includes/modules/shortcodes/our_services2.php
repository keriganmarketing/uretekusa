<?php $count = 1;
$query_args = array('post_type' => 'bunch_services' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);

if( $cat ) $query_args['services_category'] = $cat;
$query = new WP_Query($query_args); ?>

<?php if($query->have_posts()): ?>

<section class="featured-services">
    <div class="container">
        
        <!--Box Container-->
        <div class="container-box anim-5-all">
            <div class="bar bg-white"></div>
            <header class="section-title2">
                <span class="double-line"></span>   <h1><?php echo wp_kses_post($title); ?></h1>   <span class="double-line"></span>
                <p><?php echo wp_kses_post($text); ?></p>
            </header>
			
            <?php while($query->have_posts()): $query->the_post();
			global $post;
			$services_meta = _WSH()->get_meta(); ?>
            <div class="col-lg-6 single-what-we-do clearfix <?php if($count == 3) { echo 'content-left'; } elseif($count == 4) { echo 'content-left'; } ?>">
                <div class="img-wrap ">
                    <?php the_post_thumbnail('titan_285x220'); ?>
                    <div class="overlay">
                        <div class="link">
                            <a href="<?php echo esc_url(titan_set($services_meta, 'ext_url')); ?>" class="fa fa-link"></a>
                        </div>
                    </div>
                </div>
                <div class="content">
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo wp_kses_post(titan_trim(get_the_content(), $text_limit)); ?></p>
                    <a href="<?php echo esc_url(titan_set($services_meta, 'ext_url')); ?>"><?php esc_html_e('Read More', 'titan'); ?></a>
                </div>
            </div>
            <?php $count++; endwhile; ?>
            <div class="clearfix"></div>
        </div>
        <!--Box Container End-->
            
    </div>
</section>

<?php endif; ?>
<?php wp_reset_postdata(); ?>