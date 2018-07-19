<?php $query_args = array('post_type' => 'bunch_team' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);

if( $cat ) $query_args['team_category'] = $cat;
$query = new WP_Query($query_args); ?>

<?php if($query->have_posts()): ?>

<section id="our-team-construct" style="background-image: url(<?php echo esc_url($bg_img); ?>);">
    <div class="container">
        <div class="section-title2">
            <span class="double-line"></span>   <h1><?php echo wp_kses_post($title); ?></h1>   <span class="double-line"></span>
        </div>
        <div class="owl-carousel owl-theme">
            <?php while($query->have_posts()): $query->the_post();
			global $post;
			$team_meta = _WSH()->get_meta(); ?>
            <div class="item">
                <div class="single-construct-member">
                    <div class="img-holder">
                        <?php the_post_thumbnail('titan_165x165'); ?>
                    </div>
                    <div class="content hvr-bounce-to-bottom">
                        <h2><?php the_title(); ?></h2>
                        <p><?php echo wp_kses_post(titan_trim(get_the_content(), $text_limit)); ?></p>
                        <?php if($socials = titan_set($team_meta, 'bunch_team_social')):?>
                        <ul>
                            <?php foreach($socials as $key => $value): ?>
                            <li><a href="<?php echo esc_url(titan_set($value, 'social_link')); ?>" target="_blank"><i class="fa <?php echo esc_attr(titan_set($value, 'social_icon'));?>"></i></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<?php endif; wp_reset_postdata(); ?>