<?php

// Remove tag <a> of product entry
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10, 0 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5, 0 );
remove_action( 'woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10, 0 );
remove_action( 'woocommerce_after_subcategory', 'woocommerce_template_loop_category_link_close', 10, 0 );

function fabrique_woocommerce_product_share()
{
	if ( fabrique_mod( 'product_share' ) ) {
		echo '<div class="fbq-product-share fbq-share">';
		fabrique_template_share( array( 'style' => 'icon' ) );
		echo '</div>';
	}
}
add_action( 'woocommerce_share', 'fabrique_woocommerce_product_share' );


function fabrique_woocommerce_cart_fragments( $fragments )
{
	global $woocommerce;

	ob_start();
	$fragments['span.fbq-menu-cart-count'] = '<span class="fbq-menu-cart-count">' . esc_html( $woocommerce->cart->cart_contents_count ) . '</span>';
	ob_end_clean();

	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'fabrique_woocommerce_cart_fragments' );


function fabrique_woocommerce_breadcrumb( $defaults )
{
	$page_id = fabrique_get_page_id();
	$bp_data = fabrique_bp_data( $page_id );

	if ( fabrique_is_blueprint_active( $bp_data ) ) {
		$builder = $bp_data['builder'];
		$container_class =  ( $builder['sidebar_full'] && 'none' !== $builder['sidebar'] && isset( $builder['sidebar_id'] ) ) ? 'fbq-container--fullwidth' : 'fbq-container';
	} else {
		$container_class = 'fbq-container';
	}

	$defaults['delimiter'] = '<span class="twf twf-angle-right"></span>';
	$defaults['wrap_after'] = '</div></header>';
	$defaults['wrap_before'] = '<header class="woocommerce-breadcrumb fbq-content-header"><div class="' . esc_attr( $container_class ) . '">';

	return $defaults;
}
add_filter( 'woocommerce_breadcrumb_defaults', 'fabrique_woocommerce_breadcrumb' );
