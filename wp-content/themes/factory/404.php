<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package commercegurus
 */
get_header();
?>

<div class="container">
    <div class="content">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="content-area entry-content">
                    <main id="main" class="site-main" role="main">
                        <section class="error-404 not-found">
                            
                                <h1 class="page-title"><?php esc_html_e( '404', 'factory' ); ?></h1>
                            
                            <div class="page-content">
                                <p><?php esc_html_e( 'Sorry but the page you are looking for cannot be found. Please make sure you have typed the current url.', 'factory' ); ?></p>
                                <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html__( 'Back to Homepage', 'factory' ); ?></a></p>
                            </div><!-- .page-content -->
                        </section><!-- .error-404 -->

                    </main><!-- #main -->
                </div><!-- #primary -->
            </div><!--/row -->
        </div><!--/content -->
    </div><!--/container -->
</div>
<?php get_footer(); ?>