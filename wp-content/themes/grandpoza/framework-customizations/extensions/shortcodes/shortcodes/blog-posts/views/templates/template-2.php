
<div class="row pt-0 team-area blog-area blog-grid">

    <?php while( $blog_kapp_posts->have_posts() ) : $blog_kapp_posts->the_post(); ?>

    <div class="col-md-6 entry-list">
        <div class="row row-rl-10 entry-list-item mb-20">

            <div class="col-xs-5">
                <figure class="entry-img">
                    <img src="<?php echo get_the_post_thumbnail_url( get_the_ID() , "grandpoza-rectangular-sms-thumb" ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" />
                </figure>
            </div>

            <div class="col-xs-7">
                <div class="entry-content">
                    <h2 class="entry-title h6 mb-10">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <span class="entry-info color-dark is-block mb-15 hidden-xs">
                        <span class="mr-10">
                            <i class="fa fa-clock-o mr-5"></i> <?php echo get_the_date(); ?>
                        </span>
                        <span>
                            <i class="fa fa-comment-o mr-5"></i> <?php printf( _n( "%s Comment", "%s Comments" , $blog_kapp_posts->comment_count , "grandpoza" ) , $blog_kapp_posts->comment_count ); ?>
                        </span>
                    </span>
                    <p class="color-mid hidden-xs"><?php echo Kapp_Helpers::shorten_excerpt( get_the_excerpt(), 60); ?></p>
                </div>
            </div>

        </div>
    </div>

    <?php endwhile; ?>
</div>