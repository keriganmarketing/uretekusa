<?php
#--------------------------------------------------------------------------------------#
/**
 * ----------------------------------
 * 404 TEMPLATE
 * @author KappStudio
 * @version 1.0
 * @package Grandpoza WP Theme
 * --------------------------------
 * */
#--------------------------------------------------------------------------------------#

get_header();

?>

<main id="mainContent" class="main-content">
  
    <?php get_template_part( "template-parts/content-page", "cover" ); ?>

    <section class="section error-404-area pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset2 col-sm-10 col-sm-offset-1 col-xs-12">
                    <div class="not-found-content text-center">
                        <h1><?php esc_html_e( '404' , 'grandpoza' ); ?></h1>
                        <?php get_template_part( "template-parts/content" , "none" ); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
