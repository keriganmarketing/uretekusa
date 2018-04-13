

<div class="row row-tb-10 pt-0 blog-area blog-grid row-md-cell">

    <?php 

    $i=0;
    
    while($blog_kapp_posts->have_posts()) : 
        $blog_kapp_posts->the_post(); 
        
    ?>

    <?php if($i==0){ ?>

    <div class="col-md-6 entry-details prl-0 mb-15">

        <figure 
            class="entry-img embed-responsive embed-responsive-16by9 col-absolute-cell"  
            data-bg-img="<?php echo get_the_post_thumbnail_url( get_the_ID() , "grandpoza-rectangular-lg-thumb" ); ?>">
        </figure>

        <div class="entry-content">
            <span class="is-block mb-15">
                <span class="mr-10">
                    <i class="fa fa-clock-o mr-5"></i><?php echo get_the_date(); ?>
                </span>
                <span>
                    <i class="fa fa-comment-o mr-5"></i> <?php printf( _n( "%s Comment", "%s Comments" , $blog_kapp_posts->comment_count , "grandpoza" ) , $blog_kapp_posts->comment_count ); ?>
                </span>
            </span>
            <h2 class="entry-title h3 mb-10">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
        </div>

    </div>
    <?php } ?>

    <?php if($i==1){ ?>
    <div class="col-md-6 entry-list pt-md-0">
        <?php } ?>
        
        <?php if($i>0){ ?>

        <div class="row row-rl-5 entry-list-item<?php echo $blog_kapp_posts->post_count != $i + 1 ? " mb-20" : ""; ?>">

            <div class="col-xs-5">
                <figure class="entry-img">
                    <img src="<?php echo get_the_post_thumbnail_url( get_the_ID() ,"grandpoza-rectangular-sms-thumb"); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" />
                </figure>
            </div>

            <div class="col-xs-7">
                <div class="entry-content">
                    <h2 class="entry-title h6 mb-10">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <span class="entry-info color-dark is-block mb-15 hidden-xs">
                        <span class="mr-10">
                            <i class="fa fa-clock-o mr-5"></i><?php echo get_the_date(); ?>
                        </span>
                        <span>
                            <i class="fa fa-comment-o mr-5"></i>  <?php printf( _n( "%s Comment", "%s Comments" , $blog_kapp_posts->comment_count , "grandpoza" ) , $blog_kapp_posts->comment_count ); ?>
                        </span>
                    </span>
                    <p class="color-mid mb-0 hidden-xs">
                        <?php echo Kapp_Helpers::shorten_excerpt( get_the_excerpt(), 75); ?>
                    </p>
                </div>
            </div>

        </div>
        <?php } ?>
        
    <?php if($blog_kapp_posts->post_count == $i+1) :  ?>
    </div>
    <?php endif; ?>


    <?php
          $i++;
          endwhile;
    ?>

</div>