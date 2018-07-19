<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header( 'shop' );

$sidebar = fabrique_mod( 'shop_sidebar' );
$sidebar_position = fabrique_mod( 'shop_sidebar_position' );
$sidebar_select = fabrique_mod( 'shop_sidebar_select' );
$sidebar_fixed = fabrique_mod( 'shop_sidebar_fixed' );
$content_class = 'fbq-content';
$content_class .= ( fabrique_mod( 'page_title' ) ) ? ' fbq-content--with-header' : ' fbq-content--no-header';
$container_class = ( fabrique_mod( 'shop_full_width' ) ) ? 'fbq-container--fullwidth' : 'fbq-container';

?>
	<?php
	 /**
	  * Hook: woocommerce_before_main_content.
	  *
	  * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
	  * @hooked woocommerce_breadcrumb - 20
	  * @hooked WC_Structured_Data::generate_website_data() - 30
	  */
	 // do_action( 'woocommerce_before_main_content' );
	?>
	<div class="<?php echo esc_attr( $content_class ); ?>">
		<div class="fbq-content-wrapper">


			<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
				<?php
					// Replace all WooCommerce Breadcrumb and Page Title by Theme default page title.
					// Remove action of description and replace in function 'archive_title_options'
					get_template_part( 'templates/archive-title' );
				?>
				<?php
					/**
					 * Hook: woocommerce_archive_description.
					 *
					 * @hooked woocommerce_taxonomy_archive_description - 10
					 * @hooked woocommerce_product_archive_description - 10
					 */
					// do_action( 'woocommerce_archive_description' );
				?>
			<?php endif; ?>

			<div class="<?php echo esc_attr( $container_class ); ?>">
				<main id="main" class="<?php echo esc_attr( fabrique_main_page_class( $sidebar, $sidebar_position ) ); ?> blueprint-inactive">
					<div class="fbq-shop">
					<?php if ( woocommerce_product_loop() ) : ?>

						<div class="fbq-products-nav">
							<?php
								/**
								 * Hook: woocommerce_before_shop_loop.
								 *
								 * @hooked wc_print_notices - 10
								 * @hooked woocommerce_result_count - 20
								 * @hooked woocommerce_catalog_ordering - 30
								 */
								do_action( 'woocommerce_before_shop_loop' );
							?>
						</div>

						<?php
							woocommerce_product_loop_start();

							if ( wc_get_loop_prop( 'total' ) ) {
								while ( have_posts() ) {
									the_post();

									/**
									 * Hook: woocommerce_shop_loop.
									 *
									 * @hooked WC_Structured_Data::generate_product_data() - 10
									 */
									do_action( 'woocommerce_shop_loop' );

									wc_get_template_part( 'content', 'product' );
								}
							}

							woocommerce_product_loop_end();

							/**
							 * Hook: woocommerce_after_shop_loop.
							 *
							 * @hooked woocommerce_pagination - 10
							 */
							do_action( 'woocommerce_after_shop_loop' );
						?>

					<?php else : ?>

						<?php
						/**
						 * Hook: woocommerce_no_products_found.
						 *
						 * @hooked wc_no_products_found - 10
						 */
						do_action( 'woocommerce_no_products_found' );
						?>

					<?php endif; ?>
					</div>
				</main>

				<?php if ( $sidebar ) : ?>
					<aside class="<?php echo esc_attr( fabrique_sidebar_class( $sidebar_position, $sidebar_fixed ) ); ?>" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
						<?php fabrique_template_sidebar_background(); ?>
						<div class="fbq-widgets">
				  <?php if ( is_active_sidebar( $sidebar_select ) ) : ?>
					<ul class="fbq-widgets-list">
					  <?php dynamic_sidebar( $sidebar_select ); ?>
					</ul>
				  <?php endif; ?>
				</div>
					</aside>
				<?php endif ; ?>

			</div>

		</div>
	</div>
	<?php
		 /**
		 * Hook: woocommerce_after_main_content.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 *
		 * Remove loop end */
		// do_action( 'woocommerce_after_main_content' );

		/**
		 * Hook: woocommerce_sidebar.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		// do_action( 'woocommerce_sidebar' );
	?>

<?php get_footer( 'shop' ); ?>
