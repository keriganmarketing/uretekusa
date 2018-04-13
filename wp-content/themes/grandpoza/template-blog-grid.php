<?php
/*
Template Name: Grid Style Blog
 */

get_header();

?>

<main id="mainContent" class="main-content">

    <?php 
    
    get_template_part( "template-parts/content" , "blog-cover" );

    /* === OPENING DIV === */
    grandpoza_before_pagelayout();

    #---------------------------------- #
    # LEFT SIDEBAR
    #-----------------------------------#

    global $grandpoza_page_layout;

    if( 'wl-sidebar' == $grandpoza_page_layout)
    {
        get_sidebar( 'blog' );
    }

    ?>

    <div class="<?php echo esc_attr( $grandpoza_page_content_wrapper_class ); ?> blog-area blog-grid page-blog-grid">

        <?php if ( have_posts() ) {  ?>
        <div class="row row-tb-15">
            <?php
                  global $paged;

                  $args= array(
                      'post_type'         => 'post',
                      'posts_per_page'    =>  get_option( 'posts_per_page' ),
                      'paged'             => $paged,
                      );
                  $wp_query = new WP_Query( $args );

                  while ( $wp_query->have_posts() ) {
                      $wp_query->the_post();
                      get_template_part( "template-parts/content", "grid-blog" );
                  }

            ?>

        </div>
        <?php }else { ?>

        <div class="row">
            <div class="container text-center ptb-60 col-lg-6 col-md-8 col-sm-10 col-xs-12">
                <?php get_template_part( "template-parts/content" , "none" ); ?>
            </div>
        </div>

        <?php } ?>

        <div class="ptb-50 clearfix">
            <?php grandpoza_pagination(); ?>
        </div>
    </div>



    <?php

    #---------------------------------- #
    # RIGHT SIDEBAR
    #-----------------------------------#

    if( 'wr-sidebar' == $grandpoza_page_layout)
    {
        get_sidebar( 'blog');
    }

    /* === CLOSING DIV === */
    grandpoza_after_pagelayout();

    ?>

</main>

<?php get_footer(); ?>