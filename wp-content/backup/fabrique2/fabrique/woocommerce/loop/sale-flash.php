<?php
/**
 * Product loop sale flash
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/sale-flash.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

?>
<?php if ( $product->is_featured() ) : ?>
	<div class="fbq-entry-flash">
		<?php echo apply_filters( 'woocommerce_featured_flash', '<span class="featured-label fbq-p-brand-bg fbq-p-brand-contrast-color">' . esc_html__( 'Featured', 'fabrique' ) . '</span>', $post, $product ); ?>
	</div>
<?php elseif ( $product->is_on_sale() ) : ?>
	<div class="fbq-entry-flash">
		<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', 'fabrique' ) . '</span>', $post, $product ); ?>
	</div>
<?php endif; ?>
