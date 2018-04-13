
<div class="blog-post col-xs-12">

    <article id="post-<?php the_ID(); ?>" <?php post_class("entry"); ?>>

        <?php

        $post_format = get_post_format() == "" ? "standard" : get_post_format();

        get_template_part("post-formats/{$post_format}");

        ?>
        <div class="entry-wrapper pt-20 <?php has_post_thumbnail() ? 'pt-md-30' : ''; ?> pb-15">
            <header class="entry-header">
                <h4 class="entry-title mb-10 mb-md-10 t-uppercase">
                    <a title="<?php echo esc_attr( get_the_title() ); ?>" href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h4>
                <div class="entry-meta mb-10">
                    <ul class="tag-info list-inline">
                        <li>
                            <i class="mr-5 fa fa-calendar"></i> <?php echo get_the_date(); ?>
                        </li>
                        <li>
                            <i class="mr-5 fa fa-user"></i> <?php esc_html_e( 'By' , 'grandpoza' ); ?> : <?php the_author(); ?>
                        </li>
                        <li>
                            <i class="mr-5 fa fa-user"></i> <?php esc_html_e( 'In' , 'grandpoza' ); ?> : <?php the_category( ', '); ?>
                        </li>
                        <li>
                            <i class="mr-5 fa fa-comments"></i> <?php echo  get_comments_number( get_the_ID() ); ?> <?php echo esc_html( _n( 'Comment' , 'Comments' , get_comments_number( get_the_ID() ) , 'grandpoza' ) ); ?>
                        </li>
                    </ul>
                </div>


            </header>
            <div class="entry-content">
                <p class="entry-summary mb-20">
                    <?php echo get_the_excerpt(); ?>
                </p>
            </div>
            <footer class="entry-footer">
                <a href="<?php the_permalink(); ?>" class="more-link btn btn-sm btn-o">
                    <?php esc_html_e( "Continue reading" , "grandpoza" ); ?>
                    <i class="icon fa fa-long-arrow-right"></i>
                </a>
            </footer>
        </div>
    </article>
</div>
