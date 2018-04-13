<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
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
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>
<div class="product_meta fbq-p-border-border">
	<div class="fbq-container">
		<?php do_action( 'woocommerce_product_meta_start' ); ?>

		<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

			<div class="sku_wrapper">
				<div class="fbq-single-product-meta-label"><?php esc_html_e( 'SKU :', 'fabrique' ); ?></div>
				<span class="sku fbq-s-text-color" itemprop="sku">
					<?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'fabrique' ); ?>
				</span>
			</div>

		<?php endif; ?>

		<?php echo wc_get_product_category_list( $product->get_id(), '', '<div class="posted_in fbq-s-text-color"><div class="fbq-single-product-meta-label fbq-p-text-color">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'fabrique' ) . '</div> ', '</div>' ); ?>
		<?php do_action( 'woocommerce_product_meta_end' ); ?>
	</div><?php //close container ?>
</div>
