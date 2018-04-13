<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
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
 * @version     3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $max_value && $min_value === $max_value ) {
?>
<div class="quantity hidden">
    <input type="hidden" id="<?php echo esc_attr( $input_id ); ?>" class="qty" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $min_value ); ?>" />
</div>
<?php
} else {
?>
<div class="quantity bootstrap-touchspin">
    <label class="screen-reader-text">
        <?php esc_html_e( 'Quantity', 'grandpoza' ); ?>
    </label>
    <input class="quantity-spinner form-control" title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'grandpoza' ) ?>" pattern="<?php echo esc_attr( $pattern ); ?>" inputmode="<?php echo esc_attr( $inputmode ); ?>" name="<?php echo esc_attr( $input_name ); ?>" type="text" value="<?php echo esc_attr( $input_value ); ?>" />
</div>
<?php
}
