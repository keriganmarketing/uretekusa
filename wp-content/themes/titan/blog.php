<!--Start single latest blog-->
<div class="single-blog-post">
    <div class="img-holder">
        <?php the_post_thumbnail('titan_1200x450'); ?>
        <div class="published-date">
            <h3><?php echo get_the_date('d M'); ?></h3>
        </div> 
    </div>
    <div class="text-holder">
        <h3 class="blog-title"><a href="<?php echo esc_url(get_permalink(get_the_id())); ?>"><?php the_title(); ?></a></h3>
        <div class="text">
            <?php the_excerpt(); ?>
        </div> 
        <div class="meta-info clearfix">
            <div class="left pull-left">
                <ul class="post-info">
                    <li><?php esc_html_e('By', 'titan'); ?> <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>"><?php the_author();?></a></li>
                    <li><?php the_category(', '); ?></li>
                    <li><a href="<?php echo esc_url(get_permalink(get_the_id()).'#comments');?>"> <?php comments_number( '0 comment', '1 comment', '% comments' ); ?></a></li>
                </ul>    
            </div>
        </div>
    </div>
</div>
<!--End single latest blog-->
