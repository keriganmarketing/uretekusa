<?php
#--------------------------------------------------------------------------------------#
/**
 * ----------------------------------
 * DEFAULT SINGLE TEMPLATE
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
    /* === OPENING DIV === */
    grandpoza_before_pagelayout(); ?>

    <?php
    #---------------------------------- #
    # LEFT SIDEBAR
    #-----------------------------------#
    global $grandpoza_page_layout;
    if( 'wl-sidebar' == $grandpoza_page_layout)
    {
        get_sidebar( 'blog' );
    }
    ?>

    <div class="<?php echo esc_attr($grandpoza_page_content_wrapper_class); ?>">
        <div class="blog-area blog-classic blog-single">

            <?php
            if ( have_posts() ) {

                the_post();
                get_template_part( "template-parts/content", "single-post" );

                if ( comments_open() || get_comments_number() ) {
                    comments_template();
                }
            }
            ?>

        </div>
    </div>


    <?php
    #---------------------------------- #
    # RIGHT SIDEBAR
    #-----------------------------------#
    if( 'wr-sidebar' == $grandpoza_page_layout )
    {
        get_sidebar( 'blog' );
    }
    ?>

    <?php
    /* === CLOSING DIV === */
    grandpoza_after_pagelayout();
    ?>

</main>

<?php get_footer(); ?>