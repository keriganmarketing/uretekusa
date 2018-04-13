<?php
/**
 * Template Name: WooCommerce full width
 * @package commercegurus
 */
get_header();
?>
<?php factorycommercegurus_get_page_title(); ?>

<div class="container">
    <div class="content">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main" role="main">

						<?php while ( have_posts() ) : the_post(); ?>

							<?php get_template_part( 'content', 'page' ); ?>

						<?php endwhile; // end of the loop.  ?>

                    </main><!-- #main -->
                </div><!-- #primary -->
            </div>
          
        </div><!--/row -->
    </div><!--/content -->
</div><!--/container -->

<?php get_footer(); ?>
