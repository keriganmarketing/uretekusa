<?php  
$count = 1;
$query_args = array('post_type' => 'bunch_team' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);

if( $cat ) $query_args['team_category'] = $cat;
$query = new WP_Query($query_args); ?>

<?php if($query->have_posts()): ?>

<section class="team style-2 sec-padd">
    <div class="container">

        <div class="row">
        	<?php while($query->have_posts()): $query->the_post();
			global $post;
			$team_meta = _WSH()->get_meta(); ?>
            <article class="col-md-3 col-sm-6 col-xs-12">
                <div class="item tran5">
                    <div class="team-member">
                        <figure class="img-box">
                            <?php the_post_thumbnail('titan_220x300'); ?>
                        </figure>
                        <div class="member-info">
                            <h5><a href="<?php echo esc_url(titan_set($team_meta, 'team_link')); ?>"><?php the_title(); ?></a></h5>
                            <p><?php echo wp_kses_post(titan_set($team_meta, 'designation')); ?></p>
                        </div>
                    </div> 
                </div>
                    
            </article>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<?php endif; wp_reset_postdata(); ?>