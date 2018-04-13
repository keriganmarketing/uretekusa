<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$post_id = get_the_ID();
$opts = fabrique_product_options( array(), $post_id );

get_header('shop'); ?>

	<?php if ( $opts['builder']['active'] ) : ?>
		<div <?php echo fabrique_a( $opts ); ?>>
			<div class="fbq-content-wrapper" <?php echo fabrique_s( $opts['content_wrapper_style'] ); ?>>
				<?php if ( 'none' !== $opts['builder']['header'] ) : ?>
					<?php fabrique_template_blueprint_page_title( $opts['builder'] ); ?>
				<?php else : ?>
					<?php woocommerce_breadcrumb(); ?>
				<?php endif; ?>
	<?php else : ?>
		<?php
			/**
			* woocommerce_before_main_content hook
			*
			* @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
			* @hooked woocommerce_breadcrumb - 20
			*/
			do_action( 'woocommerce_before_main_content' );
		?>
	<?php endif; ?>
		<?php $main_class = fabrique_main_page_class( $opts['sidebar'], $opts['sidebar_position'], $opts['sidebar_background_color'] ); ?>
		<?php if ( !$opts['sidebar'] ) : ?>
			<main id="main" class="fbq-single-product <?php echo esc_attr( $main_class ); ?>">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php wc_get_template_part( 'content', 'single-product' ); ?>
				<?php endwhile; // end of the loop. ?>
			</main>
		<?php else: ?>
			<div class="<?php echo esc_attr( $opts['main_container_class'] ); ?>">
				<main id="main" class="fbq-single-product <?php echo esc_attr( $main_class ); ?>">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php wc_get_template_part( 'content', 'single-product' ); ?>
					<?php endwhile; // end of the loop. ?>
				</main>
				<aside class="<?php echo fabrique_sidebar_class( $opts['sidebar_position'], $opts['sidebar_fixed'], $opts['sidebar_color_scheme'] ); ?>" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
					<?php fabrique_template_sidebar_background( $opts['sidebar_background_color'] ); ?>
					<div class="fbq-widgets">
						<?php if ( is_active_sidebar( $opts['sidebar_select'] ) ) : ?>
							<ul class="fbq-widgets-list">
								<?php dynamic_sidebar( $opts['sidebar_select'] ); ?>
							</ul>
						<?php endif; ?>
					</div>
				</aside>
			</div><!-- .container -->
		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

<?php get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
