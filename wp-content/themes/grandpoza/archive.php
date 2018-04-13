<?php

#--------------------------------------------------------------------------------------#
/**
 * ----------------------------------
 * ARCHIVE TEMPLATE
 * @author KappStudio
 * @version 1.0
 * @package Grandpoza WP Theme
 * --------------------------------
 * */
#--------------------------------------------------------------------------------------#

get_header(); 

?>

<main id="mainContent" class="main-content">

    <?php get_template_part( "template-parts/content", "page-cover" ); ?>
   
    <?php

    /* === OPENING DIV === */
    grandpoza_before_pagelayout();

    ?>

    <?php
    #---------------------------------- #
    # LEFT SIDEBAR
    #-----------------------------------#
    global $grandpoza_page_layout;
    if( 'wl-sidebar' == $grandpoza_page_layout)
    {
        get_sidebar();
    }
    ?>

    <div class="<?php echo esc_attr( $grandpoza_page_content_wrapper_class ); ?> blog-area blog-list">

        <?php if(have_posts()) {  ?>

        <?php while(have_posts()) : the_post(); ?>

        <div class="row prl-0 row-tb-20">
            <?php get_template_part( "template-parts/content" , "list-blog" ); ?>
        </div>

        <?php endwhile; ?>

        <div class="ptb-60">
            <?php grandpoza_pagination(); ?>
        </div>

        <?php }else { ?>

        <div class="row">
            <div class="container text-center ptb-60 col-lg-6 col-lg-offset-3 col-md-8 col-md-offset2 col-sm-10 col-sm-offset-1 col-xs-12">
                <?php get_template_part( "template-parts/content" , "none" ); ?>
            </div>
        </div>

        <?php } ?>
    </div>


    <?php
    #---------------------------------- #
    # RIGHT SIDEBAR
    #-----------------------------------#
    if( 'wr-sidebar' == $grandpoza_page_layout)
    {
        get_sidebar();
    }
    ?>

    <?php

    /* === CLOSING DIV === */
    grandpoza_after_pagelayout();

    ?>

</main>

<?php get_footer(); ?>