<?php $count = 1;
$query_args = array('post_type' => 'bunch_services' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);

if( $cat ) $query_args['services_category'] = $cat;
$query = new WP_Query($query_args); ?>

<?php if($query->have_posts()): ?>

<section id="construction-welcome">
    <div class="container">
        <div class="row">
        	<?php while($query->have_posts()): $query->the_post();
			global $post;
			$services_meta = _WSH()->get_meta(); ?>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 single-construction-welcome">
                <div class="img-holder hvr-rectangle-out">
                    <?php the_post_thumbnail('titan_370x182'); ?>
                </div>
                <h2><?php the_title(); ?></h2>
                <p><?php echo wp_kses_post(titan_trim(get_the_content(), $text_limit)); ?></p>
            </div>
            <?php endwhile; ?>
            
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-lg-offset-0 col-md-offset-0 col-sm-offset-3 col-xs-offset-0 single-construction-welcome">
                <h1><?php echo wp_kses_post($title); ?></h1>
                <?php echo wp_kses_post($text); ?>
            </div>
        </div>
    </div>
</section>

<?php endif; wp_reset_postdata(); ?>