<?php
#--------------------------------------------------------------------------------------#
/**
 * ----------------------------------
 * DEFAULT TEMPLATE FILE
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

    <div class="container">
     
        <div class="row row-rl-20">
            <?php
            global $grandpoza_page_layout;

            if( 'wl-sidebar' == $grandpoza_page_layout)
            {
                get_sidebar( 'blog');
            }
            ?>

            <div class="<?php echo ( "wl-sidebar" == $grandpoza_page_layout || "wr-sidebar" == $grandpoza_page_layout ) ? 'col-md-9' : 'col-md-12'; ?> blog-area ptb-60 blog-classic">
                <div class="row row-tb-20">
                    <?php

                    while( have_posts() )
                    {
                        the_post();
                        get_template_part( "template-parts/content" , "classic-blog" );
                    }

                    ?>

                </div>

                <div class="pt-40">
                    <?php grandpoza_pagination(); ?>
                </div>
            </div>

            <?php
            if( 'wr-sidebar' == $grandpoza_page_layout) {
                get_sidebar( 'blog' );
            }
            ?>
        </div>
       
    </div>
</main>

<?php get_footer(); ?>
