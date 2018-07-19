<?php global $post;
$query_args = array('post_type' => 'post' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
if( $cat ) $query_args['category_name'] = $cat;
$query = new WP_Query($query_args); ?>
   
<?php if($query->have_posts()): ?>

<section class="latest-blog bg-grey">
    <div class="container">
        <div class="row clearfix">
            <!--Section Title-->
            <header class="section-title2 clearfix">
                <span class="double-line"></span>   <h1><?php echo wp_kses_post($title); ?></h1>   <span class="double-line"></span>
            </header>
            <?php while($query->have_posts()): $query->the_post();
			global $post;
			$posts_meta = _WSH()->get_meta(); ?>
            <!--Blog Post-->
            <article class="blog-post col-md-4 col-sm-6 col-xs-12">
                <div class="post-inner anim-5-all">
                    <figure class="image">
                        <?php the_post_thumbnail('titan_310x200'); ?>
                        <div class="overlay anim-5-all"><div class="link-icon"><a href="<?php echo esc_url(get_permalink(get_the_id())); ?>" class="fa fa-link"></a></div></div>
                    </figure>
                    <div class="content">
                        <h3><a href="<?php echo esc_url(get_permalink(get_the_id())); ?>"><?php the_title(); ?></a></h3>
                        <div class="description"><p><?php echo wp_kses_post(titan_trim(get_the_content(), $text_limit)); ?></p></div>
                        <div class="info clearfix">
                            <p class="more pull-right text-right"><a href="<?php echo esc_url(get_permalink(get_the_id())); ?>"><?php esc_html_e('Read More', 'titan'); ?></a></p>
                            <p class="date pull-left"><?php esc_html_e('posted on', 'titan'); ?> <?php echo get_the_date('M d, Y'); ?></p>
                        </div>
                    </div>
                    
                </div>
            </article>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<?php endif; wp_reset_postdata(); ?>