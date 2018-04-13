<?php $query_args = array('post_type' => 'bunch_team' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);

if( $cat ) $query_args['team_category'] = $cat;
$query = new WP_Query($query_args); ?>

<?php if($query->have_posts()): ?>

<section class="our-team home-page anim-5-all sec-padd">
    <div class="container">
        <div class="content-box">
                
            <header class="section-title2">
                <span class="double-line"></span>   <h1><?php echo wp_kses_post($title); ?></h1>   <span class="double-line"></span>
            </header>
            <div class="clearfix"></div>
            
            <?php while($query->have_posts()): $query->the_post();
			global $post;
			$team_meta = _WSH()->get_meta(); ?>
            <article class="member col-md-3 col-sm-6 col-xs-12">
                <figure class="image">
                    <?php the_post_thumbnail('titan_250x200'); ?>
                    <div class="overlay anim-5-all"><div class="link-icon"><a href="<?php echo esc_url(titan_set($team_meta, 'team_link')); ?>" class="fa fa-link"></a></div></div>
                </figure>
                <h3><?php the_title(); ?></h3>
                <h4><?php echo wp_kses_post(titan_set($team_meta, 'designation')); ?></h4>
                <div class="description"><?php echo wp_kses_post(titan_trim(get_the_content(), $text_limit)); ?></div>
                <?php if($socials = titan_set($team_meta, 'bunch_team_social')):?>
                <div class="social">
                	<?php foreach($socials as $key => $value): ?>
                    <a href="<?php echo esc_url(titan_set($value, 'social_link')); ?>" class="fa <?php echo esc_attr(titan_set($value, 'social_icon'));?>" target="_blank"></a>   
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </article>
            <?php endwhile; ?>
            <div class="clearfix"></div>
        </div>
    </div>
    
</section>

<?php endif; ?>
<?php wp_reset_postdata(); ?>