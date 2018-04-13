<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

<section class="section breadcrumb-area pt-100 pb-70 bg-ct" data-bg-img="<?php echo get_theme_mod("shop_page_cover"); ?>">
    <div class="container t-center">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-xs-12 text-center">
                <div class="section-top-title">
                    <h1 class="t-uppercase font-45">
                        <?php echo get_the_title(); ?>
                    </h1>
                    
                    <?php woocommerce_breadcrumb( array( 
                        'wrap_before'   => '<nav class="breadcrumb">' ,
                        'wrapper_after' => '</nav>', 
                        'delimiter'     => '',
                        'before'        => '<span>' , 
                        'after'         => '</span>' ,
                     ) 
                    ); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container">
    
    <div class="row row-rl-20">
        <div class="page-content col-xs-12 col-sm-8 col-md-9 ptb-60">
            <?php while ( have_posts() ) : the_post(); ?>

            <?php wc_get_template_part( 'content', 'single-product' ); ?>

            <?php endwhile; // end of the loop. ?>

        </div>
        <?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
        do_action( 'woocommerce_sidebar' );
        ?>

    </div>
</div>
<?php get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
