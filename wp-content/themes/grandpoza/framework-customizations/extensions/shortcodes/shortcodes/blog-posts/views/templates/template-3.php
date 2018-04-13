
<div class="row row-tb-15 blog-area blog-grid">

    <?php while( $blog_kapp_posts->have_posts() ) : $blog_kapp_posts->the_post(); ?>

    <div class="col-md-4 col-sm-6">
        <div class="entry">

            <figure class="entry-media post-thumbnail embed-responsive embed-responsive-16by9" data-bg-img="<?php echo get_the_post_thumbnail_url( get_the_ID() , "grandpoza-rectangular-sm-thumb"); ?>">
                <div class="entry-media-overlay">
                    <div class="pos-center">
                        <a class="link" href="<?php the_permalink(); ?>">
                            <i class="fa fa-link"></i>
                        </a>
                    </div>
                </div>

                <div class="entry-date"><?php echo get_the_date("d"); ?>
                    <span class="month"><?php echo get_the_date("M"); ?>
                    </span>
                </div>

            </figure>

            <div class="entry-content">
                <h2 class="entry-title h6">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
                <span class="entry-info is-block mb-10">
                    <span class="mr-10">
                        <i class="fa fa-clock-o mr-5"></i><?php echo get_the_date(); ?>
                    </span>
                    <span>
                        <i class="fa fa-comment-o mr-5"></i> 
                        <?php printf( _n( "%s Comment", "%s Comments" , $blog_kapp_posts->comment_count , "grandpoza" ) , $blog_kapp_posts->comment_count ); ?>
                    </span>
                </span>
                <p class="color-mid mb-20"><?php echo Kapp_Helpers::shorten_excerpt( get_the_excerpt(), 165 ); ?></p>
                <div class="entry-more">
                    <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-rounded btn-o">
                        <?php esc_html_e( "Read More" , "grandpoza" ); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php endwhile; ?>
</div>