<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
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
 * @version 3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

	<?php do_action( 'woocommerce_before_cart_table' ); ?>

    <table class="table table-bordered cart-list mb-40">
        <thead>
            <tr class="t-uppercase">

                <th class="product-name">
                    <?php esc_html_e( 'Product', 'grandpoza' ); ?>
                </th>
                <th class="product-price">
                    <?php esc_html_e( 'Price', 'grandpoza' ); ?>
                </th>
                <th class="product-quantity">
                    <?php esc_html_e( 'Quantity', 'grandpoza' ); ?>
                </th>
                <th class="product-subtotal">
                    <?php esc_html_e( 'Total', 'grandpoza' ); ?>
                </th>
                <th class="product-remove">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php do_action( 'woocommerce_before_cart_contents' ); ?>

            <?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
            ?>
            <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">


                <td class="product-name" data-title="<?php esc_attr_e( 'Product', 'grandpoza' ); ?>">


                    <?php
                    $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                    if ( ! $product_permalink ) {
                        echo $thumbnail;
                    } else {

                        printf( '<div class="media-left is-hidden-sm-down"><figure class="product-thumb">%s</figure></div>',  $thumbnail );
                    }
                    ?>

                    <?php
                    $product_avg_rating = ceil( $_product->get_average_rating());
                    $product_rating = $_product->get_rating_count();
								if ( ! $product_permalink ) {
									echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;';
								} else {


									echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<div class="media-body valign-middle">
                                    <h5 class="title mb-10 t-uppercase"><a href="%s">%s</a></h5>
                                       <div class="rating mb-10">
                                                            <span class="rating-stars" data-rating="%s">
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                            </span>
                                                            <span class="rating-reviews">
                                                                (
                                                                <span class="rating-count">
                                                                   %s
                                                                </span>rates )
                                                            </span>
                                                        </div>
                                    </div>', esc_url( $product_permalink ), $_product->get_name(),$product_avg_rating,$product_rating ), $cart_item, $cart_item_key );
								}


								// Meta data
								echo WC()->cart->get_item_data( $cart_item );

								// Backorder notification
								if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
									echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'grandpoza' ) . '</p>';
								}
                    ?>
                </td>

                <td class="product-price" data-title="<?php esc_attr_e( 'Price', 'grandpoza' ); ?>">
                    <?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                    ?>
                </td>

                <td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'grandpoza' ); ?>">
                    <?php
								if ( $_product->is_sold_individually() ) {
									$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
								} else {
                    ?>


                    <?php
									$product_quantity = woocommerce_quantity_input( array(
										'input_name'  => "cart[{$cart_item_key}][qty]",
										'input_value' => $cart_item['quantity'],
										'max_value'   => $_product->get_max_purchase_quantity(),
										'min_value'   => '0',
									), $_product, false );
								}

								echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
                    ?>
                </td>

                <td class="product-subtotal color-theme" data-title="<?php esc_attr_e( 'Total', 'grandpoza' ); ?>">
                    <h5 class="sub-total">
                        <?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
                        ?>
                    </h5>
                </td>

                <td class="product-remove">
                    <?php
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
									'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="fa fa-trash"></i></a>',
									esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
									esc_html__( 'Remove this item', 'grandpoza' ),
									esc_attr( $product_id ),
									esc_attr( $_product->get_sku() )
								), $cart_item_key );
                    ?>
                </td>

            </tr>
            <?php
				}
			}
            ?>

            <?php do_action( 'woocommerce_cart_contents' ); ?>

            <tr>
                <td colspan="5" class="actions text-right">

                    <?php if ( wc_coupons_enabled() ) { ?>
                    <div class="coupon pull-left">
                        <label for="coupon_code">
                            <?php esc_html_e( 'Coupon:', 'grandpoza' ); ?>
                        </label>
                        <input type="text" name="coupon_code" class="form-control mr-10 is-inline-block w-auto valign-middle" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'grandpoza' ); ?>" />
                        <input type="submit" class="btn" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'grandpoza' ); ?>" />
                        <?php do_action( 'woocommerce_cart_coupon' ); ?>
                    </div>
                    <?php } ?>

                    <input type="hidden" name="_wpnonce" value="<?php  echo wp_create_nonce( 'woocommerce-cart' ); ?>" />

                    <div class="text-right">
                        <input type="submit" class="btn" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'grandpoza' ); ?>" />
                    </div>
                    <?php do_action( 'woocommerce_cart_actions' ); ?>

                </td>
            </tr>

            <?php do_action( 'woocommerce_after_cart_contents' ); ?>
        </tbody>
    </table>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<div class="row">

    <div class="col-md-6 ptb-20 pull-right">

        <?php
		/**
		 * woocommerce_cart_collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
        do_action( 'woocommerce_cart_collaterals' );
        ?>

    </div>
</div>
<?php do_action( 'woocommerce_after_cart' ); ?>
