<?php

#--------------------------------------------------------------------------------------#
/**
 * ----------------------------------
 * THE THEME'S PAGE TEMPLATE
 * @author KappStudio
 * @version 1.0
 * @package Grandpoza WP Theme
 * --------------------------------
 * */
#--------------------------------------------------------------------------------------#

get_header(); 

?>

<main id="mainContent" class="main-content">

    <?php get_template_part( "template-parts/content" , "page-cover" ); ?>

    <?php
    /** OPENING DIV **/
    grandpoza_before_pagelayout(); ?>

    <?php
    #---------------------------------- #
    # LEFT SIDEBAR
    #-----------------------------------#
    global $grandpoza_page_layout;
    global $grandpoza_page_content_wrapper_class;

    if( 'wl-sidebar' == $grandpoza_page_layout )
    {
        get_sidebar();
    }
    ?>

    <div class="<?php echo esc_attr($grandpoza_page_content_wrapper_class); ?>">

        <?php if( have_posts()) { the_post(); ?>

        <div <?php post_class(); ?> id="post-<?php echo get_the_ID(); ?>">

            <?php the_content(); ?>

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
    /** CLOSING DIV **/
    grandpoza_after_pagelayout();
    ?>

</main>

<?php get_footer(); ?>
