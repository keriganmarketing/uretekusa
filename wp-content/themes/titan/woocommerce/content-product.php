<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product, $woocommerce_loop;
// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}
// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}
// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}
// Increase loop count
$woocommerce_loop['loop']++;
// Extra post classes
$classes = array();
if ( 0 === ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 === $woocommerce_loop['columns'] ) {
	$classes[] = 'first1';
}
if ( 0 === $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last1';
}
$meta = _WSH()->get_meta('_bunch_layout_settings', get_option( 'woocommerce_shop_page_id' ));
$meta1 = _WSH()->get_meta('_bunch_header_settings', get_option( 'woocommerce_shop_page_id' ));
$layout = titan_set( $meta, 'layout', 'right' );
$layout = titan_set( $_GET, 'layout' ) ? $_GET['layout'] : $layout; 
if(titan_set($_GET, 'layout_style')) $layout = titan_set($_GET, 'layout_style'); else
$layout = titan_set( $meta, 'layout', 'right' );
$sidebar = titan_set( $meta, 'sidebar', 'blog-sidebar' );

$layout = ($layout) ? $layout : 'right';
$sidebar = ($sidebar) ? $sidebar : 'blog-sidebar';
$sidebar = titan_set( $meta, 'sidebar', 'blog-sidebar' );

if( !$layout || $layout == 'full' || titan_set($_GET, 'layout_style')=='full' ) $classes[] = 'col-lg-3 col-md-3 col-sm-3 col-xs-12'; else $classes[] = 'col-md-4 col-sm-4 col-xs-12'; 

?>
<div <?php post_class( $classes ); ?>>
	<div class="inner-box">
	<?php
	/**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	//do_action( 'woocommerce_before_shop_loop_item' );
	/**
	 * woocommerce_before_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */?>
	 
	<?php do_action( 'woocommerce_before_shop_loop_item_title' );
	/**
	 * woocommerce_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	//do_action( 'woocommerce_shop_loop_item_title' );
	/**
	 * woocommerce_after_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item_title' );?>
		
        
        <!--Start single product item-->
        <div class="single-product-item">
            <div class="img-holder">
                <?php woocommerce_template_loop_product_thumbnail(); ?>
                <div class="overlay-style-one">
                    <div class="box">
                        <div class="content">
                            <div class="icon-holder">
                                <a class="thm-btn bg-clr1" href="<?php echo esc_url(get_permalink(get_the_id())); ?>"><?php esc_html_e('Add to Cart', 'titan');?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="title-holder">
                <div class="top clearfix">
                    <div class="product-title pull-left">
                        <h5><a href="<?php echo esc_url(get_permalink(get_the_id())); ?>"><?php the_title(); ?></a></h5>
                    </div>
                    <div class="review-box pull-right">
                        <?php woocommerce_template_loop_rating(); ?>
                    </div>
                </div>
                <div class="rate"><?php woocommerce_template_loop_price(); ?></div>
            </div>
        </div>
		
	<?php
	/**
	 * woocommerce_after_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	//do_action( 'woocommerce_after_shop_loop_item' );
	?>
    </div>
</div>
