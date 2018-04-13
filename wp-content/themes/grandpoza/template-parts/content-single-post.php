<?php $post_format = '' == get_post_format() ? 'standard' : get_post_format(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class("entry {$post_format}-post-format"); ?>>

    <?php if( 'standard' == $post_format && has_post_thumbnail() ) : ?>

    <figure class="entry-media post-thumbnail embed-responsive embed-responsive-16by9" data-bg-img="<?php  echo get_the_post_thumbnail_url( get_the_ID() , "grandpoza-rectangular-lg-thumb"); ?>">

        <div class="entry-date">
            <?php echo get_the_date(); ?>
        </div>

    </figure>

    <?php endif; ?>

    <div class="entry-wrapper <?php echo has_post_thumbnail() ? 'pt-20 pt-md-30' : ''; ?> pb-15">
        <header class="entry-header">

            <h4 class="entry-title mb-10 t-uppercase">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?>
                </a>
            </h4>

            <div class="entry-meta mb-20">
                <ul class="tag-info list-inline">
                    <li>
                        <i class="mr-5 fa fa-calendar"></i><?php echo get_the_date(); ?>
                    </li>
                    <li>
                        <i class="mr-5 fa fa-user"></i><?php esc_html_e( 'By : ' , 'grandpoza') . get_the_author(); ?>
                    </li>
                    <li>
                        <i class="mr-5 fa fa-user"></i><?php esc_html_e( 'In' , 'grandpoza' ); ?> : <?php the_category( ', '); ?>
                    </li>
                    <li>
                        <i class="mr-5 fa fa-comments"></i><?php printf ( _n( " %s Comment" , "%s Comments" , get_comments_number() ,  "grandpoza") , get_comments_number() ); ?>
                    </li>

                    <?php if( is_sticky() ) : ?>

                    <li>
                        <i class="mr-5 fa fa-thumb-tack"></i><?php esc_html_e( "Featured" , "grandpoza" ); ?>
                    </li>

                    <?php endif; ?>
                </ul>
            </div>
            
        </header>
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
    </div>

    <div class="tags-list mb-30">
        
        <?php
        if($post_tags = get_the_tags()): ?>

        <span class="color-theme mr-10">
            <i class="fa fa-tag"></i> <?php esc_html_e( 'Tags :' , 'grandpoza' ); ?>
        </span>

        <?php foreach($post_tags as $tag) : ?>
            <a href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo esc_attr($tag->name); ?></a>
        <?php endforeach; ?>

        <?php endif; ?>
    </div>

    <?php

        wp_link_pages( array(
		    'before'            => '<div class="page-links mb-20 list-inline">' . esc_html__( 'Pages :', 'grandpoza' ),
            'link_before'       => '<span class="color-theme">',
		    'link_after'        => '</span>',
		    'after'             => '</div>',
	    ) );

        posts_nav_link();
    ?>

    <div class="entry-next-pre">
        <div class="row">
            <div class="hidden-xs col-sm-5">
                <div class="entry-next-pre-left">
                    
                    <span class="prev-link pr-15">
                        <i class="fa fa-long-arrow-left mr-15"></i> <?php  previous_post_link('%link', esc_html__( 'PREVIOUS' , 'grandpoza' ) ); ?>
                    </span>
                    <span class="next-link ml-15">
                        <?php next_post_link( '%link', esc_html__( 'NEXT' , 'grandpoza' )); ?> <i class="fa fa-long-arrow-right mr-15"></i>
                    </span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-7">
                <div class="entry-next-pre-right">
                    <ul class="list-inline entry-social-share">
                        <li><?php  esc_html_e( "SHARE" , "grandpoza" ) ;?> :</li>
                        <li>
                            <a href="//www.facebook.com/sharer.php?u=<?php echo urlencode( get_the_permalink() ); ?>">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="//twitter.com/share?text=<?php echo urlencode( get_the_title() ); ?>&url=<?php echo urlencode( get_the_permalink() ); ?>">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="//plus.google.com/share?url=<?php echo urlencode( get_the_permalink() ); ?>">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </li>
                        <li>
                            <a href="//www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode( get_the_permalink() ); ?>&title=<?php echo urlencode( get_the_title() ); ?>">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</article>

<div class="post-author row mt-30 mb-40">
    <div class="post-author-img top-0 mb-xs-15 left-0 col-md-3">
        <img src="<?php echo get_avatar_url( get_the_author_meta("ID"), array( "size" => 120 ) ); ?>" alt="<?php echo esc_attr( get_the_author_meta( 'nickname' ) ); ?>" />
    </div>

    <div class="post-author-details mt-xs-10 col-md-9">
        <h5 class="t-uppercase mb-5"><?php echo get_the_author_meta( 'nickname' ); ?></h5>
        <p class="color-mid">
            <?php echo get_the_author_meta('description'); ?>
        </p>
    </div>

    <div class="clearfix"></div>
</div>


<hr />