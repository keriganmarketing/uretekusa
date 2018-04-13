<?php

class Fabrique_Woocommerce_Module extends Fabrique_Base_Module
{
	const API_WOOCOMMECE_PRODUCT_CATEGORIES = 'woocommerce/product-categories';

	public function get_name()
	{
		return 'woocommerce';
	}

	public function start()
	{
		add_filter( 'loop_shop_columns', array( $this, 'woocommerce_loop_shop_columns' ) );
		add_filter( 'loop_shop_per_page', array( $this, 'woocommerce_loop_shop_per_page' ), 20 );
		add_filter( 'woocommerce_output_related_products_args', array( $this, 'woocommerce_related_products_args' ) );
		add_filter( 'woocommerce_get_catalog_ordering_args', array( $this, 'woocommerce_get_catalog_ordering_args' ) );
		add_filter( 'woocommerce_catalog_orderby', array( $this, 'woocommerce_shop_catalog_orderby' ) );
		add_filter( 'woocommerce_default_catalog_orderby_options', array( $this, 'woocommerce_shop_catalog_orderby' ) );
		add_filter( 'woocommerce_cross_sells_columns', array( $this, 'woocommerce_cross_sells_columns' ) );
		add_filter( 'woocommerce_cross_sells_total', array( $this, 'woocommerce_cross_sells_total' ) );

		$product_taxonomies = get_object_taxonomies( 'product', 'names' );
		$color_fields_attr = apply_filters( 'color_field_apply_attribute', array( 'pa_color', 'pa_colour' ) );
		foreach ( $product_taxonomies as $taxonomy ) {
			if ( in_array( $taxonomy, $color_fields_attr ) ) {
				// Add form to input color code
				add_action( $taxonomy . '_add_form_fields', array( $this, 'add_color_code_fields' ) );
				add_action( $taxonomy . '_edit_form_fields', array( $this, 'edit_color_code_fields' ), 10 );
				add_action( 'created_term', array( $this, 'save_color_code_fields' ), 10, 3 );
				add_action( 'edit_term', array( $this, 'save_color_code_fields' ), 10, 3 );

				// Add color code columns to product tag
				add_filter( 'manage_edit-' . $taxonomy . '_columns', array( $this, 'taxonomy_color_code_columns' ) );
				add_filter( 'manage_' . $taxonomy . '_custom_column', array( $this, 'taxonomy_color_code_column' ), 10, 3 );
			} else if ( 'product_tag' === $taxonomy || 'pa_' === substr( $taxonomy, 0, 3 ) ) {
				// Enque Script for wp.media in product tag page
				add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_media' ) );

				// Add form to upload image in product tag page
				add_action( $taxonomy . '_add_form_fields', array( $this, 'add_thumbnail_fields' ) );
				add_action( $taxonomy . '_edit_form_fields', array( $this, 'edit_thumbnail_fields' ), 10 );
				add_action( 'created_term', array( $this, 'save_thumbnail_fields' ), 10, 3 );
				add_action( 'edit_term', array( $this, 'save_thumbnail_fields' ), 10, 3 );

				// Add thumbnail columns to product tag
				add_filter( 'manage_edit-' . $taxonomy . '_columns', array( $this, 'taxonomy_thumbnail_columns' ) );
				add_filter( 'manage_' . $taxonomy . '_custom_column', array( $this, 'taxonomy_thumbnail_column' ), 10, 3 );
			}
		}

		// variation product add to cart
		add_action( 'wp_ajax_woocommerce_variable_add_to_cart', array( $this, 'woocommerce_variable_add_to_cart_callback' ) );
		add_action( 'wp_ajax_nopriv_woocommerce_variable_add_to_cart', array( $this, 'woocommerce_variable_add_to_cart_callback' ) );
	}


	public function handle_api_action( $endpoint, $params )
	{
		switch ( $endpoint ) {
			case self::API_WOOCOMMECE_PRODUCT_CATEGORIES:
				return $this->get_product_categories();
			default:
				return false;
		}
	}

	public function get_product_categories()
	{
		return get_terms( 'product_cat', array(
			'hide_empty' => false
		) );
	}

	public function admin_enqueue_media()
	{
		$screen = get_current_screen();
		$screen_id = $screen ? $screen->id : '';

		if ( in_array( $screen_id, array( 'edit-product_tag' ) ) || 'edit-pa_' === substr( $screen_id, 0, 8 ) ) {
			do_action( 'fabrique_core_taxonomy_scripts', array(
				'jquery',
				'underscore',
				'backbone'
			) );
		}
	}

	public function add_thumbnail_fields()
	{
		?>
		<div class="form-field term-thumbnail-wrap">
			<label><?php esc_html_e( 'Thumbnail', 'fabrique-core' ); ?></label>
			<div class="js-media-picker" style="line-height: 60px;">
				<img style="margin-right:10px;" src="<?php echo esc_url( fabrique_placeholder() ); ?>" width="60px" height="60px" />
				<input type="hidden" id="taxonomy_thumbnail_id" name="taxonomy_thumbnail_id" />
				<button type="button" class="upload-button button"><?php esc_html_e( 'Upload', 'fabrique-core' ); ?></button>
				<button type="button" class="remove-button button"><?php esc_html_e( 'Remove', 'fabrique-core' ); ?></button>
			</div>
			<p><?php esc_html_e( 'Upload thumbnail to use as a variation. Recommended size 80x80.', 'fabrique-core' ); ?></p>
			<div class="clear"></div>
		</div>
		<?php
	}

	public function edit_thumbnail_fields( $term )
	{
		$thumbnail_id = absint( get_term_meta( $term->term_id, 'thumbnail_id', true ) );
		$image = $thumbnail_id ? wp_get_attachment_thumb_url( $thumbnail_id ) : fabrique_placeholder();
		?>
		<tr class="form-field">
			<th scope="row" valign="top"><label><?php esc_html_e( 'Thumbnail', 'fabrique-core' ); ?></label></th>
			<td>
				<div id="taxonomy_thumbnail" style="float: left; margin-right: 10px;"></div>
				<div class="js-media-picker" style="line-height: 60px;">
					<img style="margin-right:10px;" src="<?php echo esc_url( $image ); ?>" width="60px" height="60px" />
					<input type="hidden" id="taxonomy_thumbnail_id" name="taxonomy_thumbnail_id" value="<?php echo esc_attr( $thumbnail_id ); ?>" />
					<button type="button" class="upload-button button"><?php esc_html_e( 'Upload', 'fabrique-core' ); ?></button>
					<button type="button" class="remove-button button"><?php esc_html_e( 'Remove', 'fabrique-core' ); ?></button>
				</div>
				<p><?php esc_html_e( 'Upload thumbnail to use as a variation. Recommended size 80x80.', 'fabrique-core' ); ?></p>
				<div class="clear"></div>
			</td>
		</tr>
		<?php
	}


	public function save_thumbnail_fields( $term_id, $tt_id = '', $taxonomy = '' )
	{
		if ( isset( $_POST['taxonomy_thumbnail_id'] ) && ( 'product_tag' === $taxonomy  || 'pa_' === substr( $taxonomy, 0, 3 ) ) ) {
			update_term_meta( $term_id, 'thumbnail_id', absint( $_POST['taxonomy_thumbnail_id'] ), '' );
		}
	}


	public function taxonomy_thumbnail_columns( $columns )
	{
		$new_columns = array();

		if ( isset( $columns['cb'] ) ) {
			$new_columns['cb'] = $columns['cb'];
			unset( $columns['cb'] );
		}

		$new_columns['thumb'] = __( 'Image', 'fabrique-core' );

		return array_merge( $new_columns, $columns );
	}


	public function taxonomy_thumbnail_column( $columns, $column, $id )
	{
		if ( 'thumb' == $column ) {

			$thumbnail_id = get_term_meta( $id, 'thumbnail_id', true );

			if ( $thumbnail_id ) {
				$image = wp_get_attachment_thumb_url( $thumbnail_id );
			} else {
				$image = fabrique_placeholder();
			}

			$image = str_replace( ' ', '%20', $image );
			$columns .= '<img src="' . esc_url( $image ) . '" alt="' . esc_attr__( 'Thumbnail', 'fabrique-core' ) . '" class="wp-post-image" height="48" width="48" />';

		}

		return $columns;
	}

	public function add_color_code_fields()
	{
		?>
		<div class="form-field term-color-wrap">
			<label for="color_code"><?php esc_html_e( 'Color', 'fabrique-core' ); ?></label>
			<input class="js-color-picker" name="color_code" id="color_code" type="text" value="" size="40">
			<p><?php esc_html_e( 'Input color code or color name to display as a variation.', 'fabrique-core' ); ?></p>
		</div>
		<?php
	}

	public function edit_color_code_fields( $term )
	{
		$color = get_term_meta( $term->term_id, 'color_code', true );

		?>
		<tr class="form-field term-color-wrap">
			<th scope="row">
				<label for="color_code"><?php esc_html_e( 'Color', 'fabrique-core' ); ?></label>
			</th>
			<td>
				<input class="js-color-picker" name="color_code" id="color_code" type="text" value="<?php echo esc_attr( $color ); ?>" size="40">
				<p class="description">
					<?php esc_html_e( 'Input color code or color name to display as a variation.', 'fabrique-core' ); ?>
				</p>
			</td>
		</tr>
		<?php
	}


	public function save_color_code_fields( $term_id, $tt_id = '', $taxonomy = '' )
	{
		if ( isset( $_POST['color_code'] ) && ( 'product_tag' === $taxonomy  || 'pa_color' === $taxonomy || 'pa_colour' === $taxonomy ) ) {
			update_term_meta( $term_id, 'color_code', $_POST['color_code'], '' );
		}
	}


	public function taxonomy_color_code_columns( $columns )
	{
		$new_columns = array();

		if ( isset( $columns['cb'] ) ) {
			$new_columns['cb'] = $columns['cb'];
			unset( $columns['cb'] );
		}

		$new_columns['color'] = __( 'Color', 'fabrique-core' );

		return array_merge( $new_columns, $columns );
	}


	public function taxonomy_color_code_column( $columns, $column, $id )
	{
		if ( 'color' === $column ) {
			$color = get_term_meta( $id, 'color_code', true );
			if ( !empty( $color ) ) {
				$columns .= '<div style="width: 30px; height: 30px; border: 2px solid #0073aa; border-radius: 50%; background-color:' . $color . '">';
			} else {
				$columns .= '<div>' . esc_html__( 'Empty', 'fabrique-core' ) . '</div>';
			}
		}

		return $columns;
	}

	public function woocommerce_loop_shop_columns()
	{
		$columns = 1;

		if ( is_shop() || is_product_category() || is_product_tag() ) {
			$columns = get_theme_mod( 'shop_column', $columns );
		}

		return $columns;
	}

	public function woocommerce_loop_shop_per_page()
	{
		$products = 12;

		if ( is_shop() || is_product_category() || is_product_tag() ) {
			$products = get_theme_mod( 'shop_product', $products );
		}

		return $products;
	}

	public function woocommerce_related_products_args()
	{
		$args['posts_per_page'] = apply_filters( 'fabrique_woocommerce_related_products_posts', 12 );

		return $args;
	}

	public function woocommerce_get_catalog_ordering_args( $args )
	{
		if ( isset( $_GET['orderby'] ) ) {
			$orderby_value = wc_clean( $_GET['orderby'] );
		} else {
			$default = get_option( 'woocommerce_default_catalog_orderby' );
			$orderby_value = apply_filters( 'woocommerce_default_catalog_orderby', $default );
		}

		if ( 'on_sale' === $orderby_value ) {
			$args['orderby'] = 'meta_value_num';
			$args['order'] = 'DESC';
			$args['meta_key'] = '_sale_price';
		}

		return $args;
	}

	public function woocommerce_shop_catalog_orderby( $orderby )
	{
		$orderby['on_sale'] = esc_html__( 'Biggest Saving', 'fabrique-core' );
		return $orderby;
	}

	public function woocommerce_cross_sells_columns()
	{
		return apply_filters( 'fabrique_woocommerce_cross_sells_columns', 4 );
	}

	public function woocommerce_cross_sells_total()
	{
		return apply_filters( 'fabrique_woocommerce_cross_sells_total', 4 );
	}

	public function woocommerce_variable_add_to_cart_callback() {
		ob_start();

		$product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
		$quantity = empty( $_POST['quantity'] ) ? 1 : apply_filters( 'woocommerce_stock_amount', $_POST['quantity'] );
		$variation_id = $_POST['variation_id'];
		$variation  = $_POST['variation'];
		$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );

		if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variation ) ) {
			do_action( 'woocommerce_ajax_added_to_cart', $product_id );

			if ( 'yes' === get_option( 'woocommerce_cart_redirect_after_add' ) ) {
				wc_add_to_cart_message( $product_id );
			}

			WC_AJAX::get_refreshed_fragments();
		} else {
			$this->json_headers();
			$data = array(
				'error' => true,
				'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id )
				);

			echo json_encode( $data );
		}

		die();
	}
}
