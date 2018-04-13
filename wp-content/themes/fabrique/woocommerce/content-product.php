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

global $product, $woocommerce_loop;

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

$columns = ( isset( $woocommerce_loop['columns'] ) && !empty( $woocommerce_loop['columns'] ) && is_numeric( $woocommerce_loop['columns'] ) ) ? (int)$woocommerce_loop['columns'] : fabrique_mod( 'shop_column' );
$entry_components = fabrique_mod( 'shop_component' );
$entry_components = !empty( $entry_components ) ? $entry_components : array();
$entry_args = array(
	'type' => 'product',
	'post_type' => 'product',
	'post_taxonomy' => 'product_cat',
	'post_tag' => 'product_tag',
	'layout' => 'grid',
	'style' => fabrique_mod( 'shop_style' ),
	'spacing' => fabrique_mod( 'shop_spacing' ),
	'enable_link' => true,
	'no_of_columns' => $columns,
	'media_on' => in_array( 'media', $entry_components ),
	'excerpt_on' => in_array( 'excerpt', $entry_components ),
	'title_on' => in_array( 'title', $entry_components ),
	'price_on' => in_array( 'price', $entry_components ),
	'rating_on' => in_array( 'rating', $entry_components ),
	'addtocart_on' => in_array( 'addtocart', $entry_components ),
	'image_size' => fabrique_mod( 'shop_image_size' ),
	'image_ratio' => fabrique_mod( 'shop_image_ratio' ),
	'title_size' => fabrique_mod( 'shop_title_font_size' ),
	'price_font_size' => fabrique_mod( 'shop_price_font_size' ),
	'title_uppercase' => fabrique_mod( 'shop_title_uppercase' ),
	'title_letter_spacing' => fabrique_mod( 'shop_title_letter_spacing' ) . 'em'
);

fabrique_template( 'entry', $entry_args );
?>
