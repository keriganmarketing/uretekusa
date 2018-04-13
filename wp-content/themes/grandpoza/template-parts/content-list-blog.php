<div class="blog-post col-xs-12">
    <article id="post-<?php the_ID(); ?>" <?php post_class("entry"); ?>>
        <div class="row row-rl-0 row-tb-0 row-md-cell">
            <div class="col-xs-12 col-md-6 col-lg-5">
                <figure class="entry-media post-thumbnail embed-responsive embed-responsive-16by9 col-absolute-cell" data-bg-img="<?php echo get_the_post_thumbnail_url(get_the_ID(),"original"); ?>"></figure>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-7 prl-15 prl-md-20 ptb-20 ptb-md-30">
                <div class="entry-wrapper">
                    <header class="entry-header">
                        <div class="entry-meta mb-10">
                            <ul class="tag-info list-inline">
                                <li>
                                    <i class="mr-5 fa fa-calendar"></i><?php echo get_the_date(); ?>
                                </li>
                                <li>
                                    <i class="mr-5 fa fa-user"></i><?php esc_html_e( 'By: ' , 'grandpoza' ); ?> <?php the_author(); ?>
                                </li>
                                <li class="is-hidden-xs">
                                    <i class="mr-5 fa fa-comments"></i> <?php printf( _n( "%s Comment", "%s Comments" , get_comments_number() , "grandpoza" ) , get_comments_number() ); ?>
                                </li>
                            </ul>
                        </div>
                        <h4 class="entry-title mb-10 mb-md-15">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h4>
                    </header>
                    <div class="entry-content">
                        <p class="entry-summary mb-20 color-mid">
                            <?php echo get_the_excerpt(); ?>
                        </p>
                    </div>
                    <footer class="entry-footer text-right">
                        <a href="<?php the_permalink();?>" class="more-link btn btn-sm btn-o">
                            <?php esc_html_e( "Continue reading", "grandpoza" ); ?>
                            <i class="icon fa fa-long-arrow-right"></i>
                        </a>
                    </footer>
                </div>
            </div>
        </div>
    </article>
</div>