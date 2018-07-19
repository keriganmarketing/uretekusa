<?php

// Remove tag <a> of product entry
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10, 0 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5, 0 );
remove_action( 'woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10, 0 );
remove_action( 'woocommerce_after_subcategory', 'woocommerce_template_loop_category_link_close', 10, 0 );
remove_theme_support( 'wc-product-gallery-zoom' );
remove_theme_support( 'wc-product-gallery-lightbox' );

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

if ( !function_exists( 'fabrique_wc_dropdown_variation_attribute_options_html' ) ) :
function fabrique_wc_dropdown_variation_attribute_options_html( $html, $args )
{
	$output = '';
	$special_radio_attributes = apply_filters( 'radio_product_attributes', array() );
	$options               = $args['options'];
	$product               = $args['product'];
	$attribute             = $args['attribute'];
	$name                  = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title( $attribute );
	$id                    = $args['id'] ? $args['id'] : sanitize_title( $attribute );
	$class                 = $args['class'];

	if ( empty( $options ) && ! empty( $product ) && ! empty( $attribute ) ) {
		$attributes = $product->get_variation_attributes();
		$options    = $attributes[$attribute];
	}

	if ( !empty( $options ) ) {
		if ( 'radio' === fabrique_mod( 'product_variation_mode' ) || in_array( $args['attribute'], $special_radio_attributes ) ) {
			$output .= '<div class="variations-radio" name="' . esc_attr( $id ) . '">';
			if ( $product && taxonomy_exists( $attribute ) ) {
				$terms = wc_get_product_terms( $product->get_id(), $attribute, array(
					'fields' => 'all',
				) );
				foreach ( $terms as $term ) {
					if ( in_array( $term->slug, $options ) ) {
						$output .= '<label data-value="' . esc_attr( $term->slug ) . '">';
						$output .=   '<input class="variations-radio-input" type="radio" name="' . esc_attr( $id ) . '" value="' . esc_attr( $term->slug ) . '" ' . checked( sanitize_title( $args['selected'] ), $term->slug, false ) . '>';
						$output .= 	 '<div class="variations-radio-option">';
						if ( strpos( $attribute, 'color' ) || strpos( $attribute, 'colour' ) ) {
							$color = get_term_meta( $term->term_id, 'color_code', true );
							if ( $color ) {
								$output .= '<div class="variations-radio-color" style="background-color:' . esc_attr( $color ) . '"></div>';
							} else {
								$output .= '<div class="variations-radio-text">' . esc_html( apply_filters( 'woocommerce_variation_option_name', $term->name ) ) . '</div>';
							}
						} else {
							$thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
							$attachment = wp_get_attachment_image_src( $thumbnail_id, 'thumbnail' );
							if ( $attachment ) {
								$thumbnail_url = $attachment[0];
								$thumbnail_width = $attachment[1];
								$thumbnail_height = $attachment[2];
								$output .= '<img src="' . esc_url( $thumbnail_url ) . '" width="' . esc_attr( $thumbnail_width ) . '" height="' . esc_attr( $thumbnail_height ) . '">';
							} else {
								$output .= '<div class="variations-radio-text">' . esc_html( apply_filters( 'woocommerce_variation_option_name', $term->name ) ) . '</div>';
							}
						}
						$output .=   '</div>';
						$output .= '</label>';
					}
				}
			} else {
				foreach ( $options as $option ) {
					$output .= '<label data-value="' . esc_attr( $option ) . '">';
					$output .=   '<input class="variations-radio-input" type="radio" name="' . esc_attr( $id ) . '" value="' . esc_attr( $option ) . '" ' . checked( sanitize_title( $args['selected'] ), $option, false ) . '>';
					$output .=   '<div class="variations-radio-option"><div class="variations-radio-text">' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</div></div>';
					$output .= '</label>';
				}
			}
			$output .= '</div>';
			$output .=  $html;
		}
	}

	return $output;
}
endif;
add_filter( 'woocommerce_dropdown_variation_attribute_options_html', 'fabrique_wc_dropdown_variation_attribute_options_html', 10, 2 );
