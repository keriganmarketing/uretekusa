<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$attribute_keys = array_keys( $attributes );
$variable_mode = fabrique_mod( 'product_variation_mode' );
$enable_radio = 'radio' === $variable_mode ? true : false;

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo htmlspecialchars( wp_json_encode( $available_variations ) ) ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php esc_html_e( 'This product is currently out of stock and unavailable.', 'fabrique' ); ?></p>
	<?php else : ?>
		<table class="variations" cellspacing="0">
			<tbody>
				<?php foreach ( $attributes as $attribute_name => $options ) : ?>
					<tr>
						<td class="label"><label for="<?php echo sanitize_title( $attribute_name ); ?>"><?php echo wc_attribute_label( $attribute_name ); ?></label></td>
						<td class="value">

						<?php if ( $enable_radio ) : ?>
							<div class="variations-radio">
								<?php foreach ( $options as $option ) : ?>
									<label>
										<?php
											$checked = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? checked( wc_clean( urldecode( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ), $option, false ) : checked( $product->get_variation_default_attribute( $attribute_name ), $option, false );
											$term = get_term_by( 'name', $option, $attribute_name, true );
										?>
										<input class="variations-radio-input" type='radio' name='<?php echo esc_attr( $attribute_name ); ?>' value="<?php echo esc_attr( $option ); ?>" <?php echo esc_attr( $checked ); ?>>
										<?php if ( 'pa_color' === $attribute_name || 'pa_colour' === $attribute_name ) : ?>
											<?php $color = get_term_meta( $term['term_id'], 'color_code', true ); ?>
											<?php if ( $color ) : ?>
												<div class="variations-radio-option">
													<div class="variations-radio-color" style="background-color: <?php echo esc_attr( $color ); ?>"></div>
												</div>
											<?php else : ?>
												<div class="variations-radio-option">
													<div class="variations-radio-text"><?php echo esc_html( $option ); ?></div>
												</div>
											<?php endif; ?>
										<?php else : ?>
											<?php
												$thumbnail_id = get_term_meta( $term['term_id'], 'thumbnail_id', true );
												$attachment = wp_get_attachment_image_src( $thumbnail_id, 'medium' );
											?>
											<?php if ( $attachment ) : ?>
												<?php
													$thumbnail_url = $attachment[0];
													$thumbnail_width = $attachment[1];
													$thumbnail_height = $attachment[2];
												?>
												<div class="variations-radio-option variations-radio-image">
													<img src="<?php echo esc_url( $thumbnail_url ); ?>" width="<?php echo esc_attr( $thumbnail_width ); ?>" height="<?php echo esc_attr( $thumbnail_height ); ?>">
												</div>
											<?php else : ?>
												<div class="variations-radio-option">
													<div class="variations-radio-text"><?php echo esc_html( $option ); ?></div>
												</div>
											<?php endif; ?>
										<?php endif; ?>
									</label>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>

						<?php
							$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( urldecode( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ) : $product->get_variation_default_attribute( $attribute_name );
							wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected ) );
							echo end( $attribute_keys ) === $attribute_name ? apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . __( 'Clear', 'fabrique' ) . '</a>' ) : '';
						?>
						</td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>

		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<div class="single_variation_wrap">
			<?php
				/**
				 * woocommerce_before_single_variation Hook.
				 */
				do_action( 'woocommerce_before_single_variation' );

				/**
				 * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				do_action( 'woocommerce_single_variation' );

				/**
				 * woocommerce_after_single_variation Hook.
				 */
				do_action( 'woocommerce_after_single_variation' );
			?>
		</div>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
