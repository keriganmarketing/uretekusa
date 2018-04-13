<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
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
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>

<main id="mainContent" class="main-content">
    <section class="section breadcrumb-area pt-100 pb-70 bg-ct" data-bg-img="<?php echo esc_url( get_the_post_thumbnail_url(  wc_get_page_id("shop"), "original" ) ); ?>">
        <div class="container t-center">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-xs-12 text-center">
                    <div class="section-top-title">
                        <h1 class="t-uppercase font-45">
                            <?php woocommerce_page_title(); ?>
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
    <section class="section shop-area ptb-60">
        <div class="container">

            <?php if ( have_posts() ) : ?>

            <div class="shop-control clearfix mb-40">
                <?php
                      /**
                       * woocommerce_before_shop_loop hook.
                       *
                       * @hooked wc_print_notices - 10
                       * @hooked woocommerce_result_count - 20
                       * @hooked woocommerce_catalog_ordering - 30
                       */
                      do_action( 'woocommerce_before_shop_loop' );
                ?>
            </div>
            <?php woocommerce_product_loop_start(); ?>
           
            <?php woocommerce_product_subcategories(); ?>
            <div class="row products product-archive">
                <?php while ( have_posts() ) :
                      the_post(); ?>

                <?php
                      /**
                       * woocommerce_shop_loop hook.
                       *
                       * @hooked WC_Structured_Data::generate_product_data() - 10
                       */
                      do_action( 'woocommerce_shop_loop' );
                ?>
                <div class="col-md-3 col-sm-6">

                    <div class="product-item">
                        <figure class="product-img">
                            <?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
                            <div class="product-hover">
                                <div class="inner-hover pos-tb-center t-center p-30">
                                    <h5 class="color-theme mb-10">
                                        <?php the_title(); ?>
                                    </h5>
                                    <p class="mb-20">
                                        <?php echo get_the_excerpt(); ?>
                                    </p>
                                    <a href="<?php the_permalink(); ?>" class="btn"><?php esc_html_e( "Read More" , "grandpoza" ); ?></a>
                                </div>
                            </div>
                        </figure>
                        <div class="product-content">
                            <a href="<?php the_permalink(); ?>">
                                <h6 class="mt-5">
                                    <?php the_title(); ?>
                                </h6>
                            
                            <?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
                            <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
                        </div>

                    </div>
                </div>

                <?php endwhile; // end of the loop. ?>
            </div>

            <?php
      
                grandpoza_pagination();
            ?>

            <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

            <?php
                      /**
                       * woocommerce_no_products_found hook.
                       *
                       * @hooked wc_no_products_found - 10
                       */
                      do_action( 'woocommerce_no_products_found' );
            ?>

            <?php endif; ?>
            </div>
        </div>

    </section>
</main>
<?php get_footer(); ?>
