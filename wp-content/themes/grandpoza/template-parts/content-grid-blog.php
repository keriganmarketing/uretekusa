
<?php $format = get_post_format() ? : 'standard'; ?>

<div class="blog-post col-md-4 col-sm-6">

    <article  id="post-<?php the_ID(); ?>" <?php post_class("entry"); ?>>

        <?php $embeds = get_media_embedded_in_content( get_the_content()) ; ?>

        <?php
            /*********************************
             *   QUOTE POST FORMAT
             **********************************/
        if($format=="quote") {

        ?>

        <figure class="entry-media">
            <blockquote class="blog-quote-section">
               <p>
                   <?php echo wp_strip_all_tags( get_the_content() ); ?>
               </p>
                <a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Continue &rarr;' , 'grandpoza' ); ?></a>
            </blockquote>
        </figure>

        <?php

        }


             /************************************
              * GALLERY POST FORMAT
              *********************************/
              elseif($format=="gallery") { 

              ?>

             <?php $gallery_image = get_post_gallery_images( get_the_ID() , 'grandpoza-rectangular-sm-thumb' ); ?>

        <div class="owl-carousel" data-loop="true" data-autoplay="true" data-autoplay-timeout="10000" data-smart-speed="1000" data-nav-speed="false" data-nav="true" data-xxs-items="1" data-xxs-nav="true" data-xs-items="1" data-xs-nav="true" data-sm-items="1" data-sm-nav="true" data-md-items="1" data-md-nav="true" data-lg-items="1" data-lg-nav="true">
            <?php foreach($gallery_image as $img){ ?>
            <figure class="item embed-responsive embed-responsive-16by9" data-bg-img="<?php echo esc_url( $img ); ?>"></figure>
            <?php } ?>
        </div>

        <?php

            /***************************************
            *  DEFAULT POST FORMAT
            * *************************************/

             }else { ?>

        <figure class="entry-media post-thumbnail embed-responsive embed-responsive-16by9" <?php if(count($embeds)==0){ ?> data-bg-img="<?php echo get_the_post_thumbnail_url( get_the_ID() , "grandpoza-rectangular-sm-thumb" ) ; ?>" <?php } ?>>
            <?php
                 if(count($embeds) > 0){
                     echo $embeds[0];
                 }
            ?>

            <div class="entry-date">
                <?php echo get_the_date("d"); ?>
                <span class="month">
                    <?php echo get_the_date("M"); ?>
                </span>
            </div>

        </figure>

        <?php } ?>
        <?php if( "quote" != $format ) : ?>
        <div class="entry-content">
            <h2 class="entry-title h6">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
           
            <span class="entry-info is-block mb-10">
                <span class="mr-10">
                    <i class="fa fa-clock-o mr-5"></i> <?php echo get_the_date(); ?>
                </span>
                <span>
                    <i class="fa fa-comment-o mr-5"></i> <?php printf( _n( "%s Comment", "%s Comments" , get_comments_number() , "grandpoza" ) , get_comments_number() ); ?>
                </span>
            </span>
            <p class="color-mid mb-20"><?php echo class_exists( 'Kapp_Helpers' ) ? Kapp_Helpers::shorten_excerpt( get_the_excerpt() , 220 ) : get_the_excerpt(); ?></p>
            <div class="entry-more">
                <a href="<?php the_permalink();?>" class="btn btn-sm btn-rounded btn-o"><?php esc_html_e("Read More","grandpoza"); ?></a>
            </div>
         
        </div>
        <?php endif; ?>
    </article>

</div>
