<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product;
// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>


<div class="product media">
    <div class="media-left">
        <a href="<?php the_permalink(); ?>"><img class="product-thumb" src="<?php echo get_the_post_thumbnail_url( $product->get_id() , 'grandpoza-square-thumb' ); ?>" alt="<?php echo get_the_title(); ?>" /></a>
    </div>
    <div class="media-body"><h6 class="font-15 mb-5"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h6><?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?></div>
</div>