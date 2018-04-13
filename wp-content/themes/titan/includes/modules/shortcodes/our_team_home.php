<?php $query_args = array('post_type' => 'bunch_team' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);

if( $cat ) $query_args['team_category'] = $cat;
$query = new WP_Query($query_args); ?>

<?php if($query->have_posts()): ?>

<section class="team sec-padd">
    <div class="container">
        <div class="section-title center decoration">
            <h2><?php echo wp_kses_post($title); ?></h2>
        </div>
        <div class="team-carousel">
        	<?php while($query->have_posts()): $query->the_post();
			global $post;
			$team_meta = _WSH()->get_meta(); ?>
            <article class="item tran5">
                <div class="team-member">
                    <figure class="img-box">
                        <?php the_post_thumbnail('titan_220x300'); ?>
                    </figure>
                    <div class="member-info">
                        <h5><a href="<?php echo esc_url(titan_set($team_meta, 'team_link')); ?>"><?php the_title(); ?></a></h5>
                        <p><?php echo wp_kses_post(titan_set($team_meta, 'designation')); ?></p>
                    </div>
                </div> 
            </article>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<?php endif; ?>
<?php wp_reset_postdata(); ?>