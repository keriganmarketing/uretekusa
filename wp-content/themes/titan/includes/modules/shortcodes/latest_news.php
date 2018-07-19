<?php global $post;
$query_args = array('post_type' => 'post' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
if( $cat ) $query_args['category_name'] = $cat;
$query = new WP_Query($query_args); ?>
   
<?php if($query->have_posts()): ?>

<section class="blog-section sec-padd2">
    <div class="container">
        <div class="section-title center decoration">
            <h2>latest news</h2>
        </div>
        <div class="row">
            <?php while($query->have_posts()): $query->the_post();
			global $post;
			$posts_meta = _WSH()->get_meta(); ?>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="default-blog-news wow fadeInUp animated animated" style="visibility: visible; animation-name: fadeInUp;">
                    <figure class="img-holder">
                        <a href="<?php echo esc_url(get_permalink(get_the_id())); ?>"><?php the_post_thumbnail('titan_350x251'); ?></a>
                        <figcaption class="overlay">
                            <div class="box">
                                <div class="content">
                                    <a href="<?php echo esc_url(get_permalink(get_the_id())); ?>"><i class="fa fa-link" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </figcaption>
                    </figure>
                    <div class="lower-content">
                        <div class="date"><?php echo get_the_date('F d, Y'); ?></div>
                        <h4><a href="<?php echo esc_url(get_permalink(get_the_id())); ?>"><?php the_title(); ?></a></h4>
                        <div class="text">
                            <p><?php echo wp_kses_post(titan_trim(get_the_content(), $text_limit)); ?></p>
                        </div>
                        <div class="link">
                            <a href="<?php echo esc_url(get_permalink(get_the_id())); ?>" class="default_link"><?php esc_html_e('Read More', 'titan'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<?php endif; wp_reset_postdata(); ?>