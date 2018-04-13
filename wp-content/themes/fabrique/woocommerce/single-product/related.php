<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
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

global $woocommerce_loop;

$found_product = count( $related_products );
$related_columns = fabrique_mod( 'product_related_column' );
$woocommerce_loop['columns'] = $related_columns;
$layout = ( $found_product > $related_columns ) ? 'carousel' : 'grid';

if ( fabrique_mod( 'product_related' ) ) :
	if ( $related_products ) : ?>
		<div class="related products fbq-item js-item-product fbq-product fbq-product--plain fbq-entries fbq-entries--plain fbq-entries--grid fbq-p-border-border" data-layout="<?php echo esc_attr( $layout ); ?>">
			<div class="fbq-container">
				<h3><?php esc_html_e( 'Related Products', 'fabrique' ); ?></h3>
				<div class="fbq-entries-content" data-display="<?php echo esc_attr( $related_columns ); ?>" data-indicator="false" data-loop="false">
					<?php foreach ( $related_products as $related_product ) : ?>

					<?php
						$post_object = get_post( $related_product->get_id() );

						setup_postdata( $GLOBALS['post'] =& $post_object );

						wc_get_template_part( 'content', 'product' ); ?>

					<?php endforeach; ?>
					
				</div>
			</div><?php // close container ?>
		</div><?php // close product ?>

	<?php endif;
	wp_reset_postdata();
endif ; ?>
