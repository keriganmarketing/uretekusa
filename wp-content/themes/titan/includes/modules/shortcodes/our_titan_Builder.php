<?php $count = 1;
$query_args = array('post_type' => 'bunch_services' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);

if( $cat ) $query_args['services_category'] = $cat;
$query = new WP_Query($query_args); ?>

<?php if($query->have_posts()): ?>

<section class="why-chooseus">
    <div class="container">
        <div class="section-title2">
            <span class="double-line"></span>   <h1><?php echo wp_kses_post($title); ?></h1>   <span class="double-line"></span>
        </div>
        
        <div class="row">
        	<?php while($query->have_posts()): $query->the_post();
			global $post;
			$services_meta = _WSH()->get_meta(); ?>
            <div class="item col-lg-4 col-md-6 col-sm-12 col-xs-12">
                <!--inner-box-->
                <div class="inner-box wow fadeIn  animated animated" data-wow-delay="0ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeIn;">
   
                    <!--icon-box-->
                    <div class="icon_box">
                        <span class="<?php echo wp_kses_post(titan_set($services_meta, 'fontawesome')); ?>"></span>
                    </div>
                    
                    <h4><?php the_title(); ?></h4>
                    <div class="text"><p><?php echo wp_kses_post(titan_trim(get_the_content(), $text_limit)); ?></p></div>
                </div>
            </div>
            <?php $count++; endwhile; ?>
        </div>
    </div>
</section>

<?php endif; wp_reset_postdata(); ?>