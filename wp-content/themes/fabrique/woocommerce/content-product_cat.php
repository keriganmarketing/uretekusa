<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce_loop;

$columns = ( isset( $woocommerce_loop['columns'] ) && !empty( $woocommerce_loop['columns'] ) && is_numeric( $woocommerce_loop['columns'] ) ) ? (int)$woocommerce_loop['columns'] : fabrique_mod( 'shop_column' );
$entry_args = array(
	'style' => apply_filters( 'fbq_productcat_style', 'overlay' ),
	'category_obj' => $category,
	'no_of_columns' => $columns,
	'image_size' => fabrique_mod( 'shop_image_size' ),
	'image_ratio' => fabrique_mod( 'shop_image_ratio' ),
	'hover' => apply_filters( 'fbq_productcat_hover', 'none' ),
	'title_size' => fabrique_mod( 'shop_title_font_size' ),
	'title_uppercase' => fabrique_mod( 'shop_title_uppercase' ),
	'title_letter_spacing' => fabrique_mod( 'shop_title_letter_spacing' ) . 'em'
);

fabrique_template( 'entry-productcat', $entry_args );
?>
