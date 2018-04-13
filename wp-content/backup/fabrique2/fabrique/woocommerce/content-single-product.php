<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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
	exit; // Exit if accessed directly
}

?>

<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	do_action( 'woocommerce_before_single_product' );

	if ( post_password_required() ) {
		echo get_the_password_form();
		return;
	}

	$thumbnail_position = fabrique_mod( 'product_thumbnail_position' );
	$detail_position = fabrique_mod( 'product_detail_position' );
	$detail_position = !empty( $detail_position ) ? $detail_position : 'right';

	// Set product content background
	$post_id = get_the_ID();
	$bp_data = get_post_meta( $post_id, 'bp_data', true );
	$product_background = '';

	if ( fabrique_is_blueprint_active( $bp_data ) ) {
		$builder = $bp_data['builder'];
		if ( isset( $builder['product_content_background'] ) && 'default' !== $builder['product_content_background'] && 'transparent' !== $builder['product_content_background'] ) {
			$product_background .= '<div class="fbq-single-product-content-background" style="background-color:' . fabrique_c( $builder['product_content_background'] ) . ';"></div>';
		}
	}
?>

<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="fbq-single-product-content thumbnail-<?php echo esc_attr( $thumbnail_position ); ?> detail-<?php echo esc_attr( $detail_position ); ?>">
		<?php echo fabrique_escape_content( $product_background ); ?>
		<div class="fbq-single-product-content-wrapper">
			<div class="fbq-container">
				<div class="fbq-single-product-container-wrapper">
					<?php
						/**
						 * woocommerce_before_single_product_summary hook.
						 *
						 * @hooked woocommerce_show_product_sale_flash - 10
						 * @hooked woocommerce_show_product_images - 20
						 */
						do_action( 'woocommerce_before_single_product_summary' );
					?>

					<div class="summary entry-summary">

						<?php
							/**
							 * woocommerce_single_product_summary hook.
							 *
							 * @hooked woocommerce_template_single_title - 5
							 * @hooked woocommerce_template_single_rating - 10
							 * @hooked woocommerce_template_single_price - 10
							 * @hooked woocommerce_template_single_excerpt - 20
							 * @hooked woocommerce_template_single_add_to_cart - 30
							 * @hooked woocommerce_template_single_meta - 40
							 * @hooked woocommerce_template_single_sharing - 50
							 */
							do_action( 'woocommerce_single_product_summary' );
						?>

					</div><!-- .summary -->
				</div>
			</div><!-- .container -->
		</div><!-- .wrapper -->
	</div><!-- .content -->

	<?php
		/**
		 * woocommerce_after_single_product_summary hook.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
