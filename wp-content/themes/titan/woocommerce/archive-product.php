<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$meta = _WSH()->get_meta('_bunch_layout_settings', get_option( 'woocommerce_shop_page_id' ));
$meta1 = _WSH()->get_meta('_bunch_header_settings', get_option( 'woocommerce_shop_page_id' ));
$layout = titan_set( $meta, 'layout', 'right' );
$layout = titan_set( $_GET, 'layout' ) ? $_GET['layout'] : $layout; 
if(titan_set($_GET, 'layout_style')) $layout = titan_set($_GET, 'layout_style'); else
$layout = titan_set( $meta, 'layout', 'right' );
$sidebar = titan_set( $meta, 'sidebar', 'blog-sidebar' );

$layout = ($layout) ? $layout : 'right';
$sidebar = ($sidebar) ? $sidebar : 'blog-sidebar';

$classes = ( !$layout || $layout == 'full' || titan_set($_GET, 'layout_style')=='full' ) ? ' col-lg-12 col-md-12 col-sm-12 col-xs-12 ' : ' col-lg-9 col-md-9 col-sm-12 col-xs-12 ' ;
  

$bg = titan_set($meta1, 'header_img');
$title = titan_set($meta1, 'header_title');

get_header( 'shop' ); ?>

<!--Page Title--> 
<section class="breadcrumb-area" <?php if($bg):?>style="background-image:url('<?php echo esc_url($bg)?>');"<?php endif;?>>
	<div class="container text-center">
		<h1><?php if($title) echo wp_kses_post($title); else wp_title(''); ?></h1>
	</div>
</section>
<!--End breadcrumb area-->

<section id="shop-area" class="main-shop-area">
    <div class="container">
        <div class="row">
			
			<!-- sidebar area -->
			<?php if( $layout == 'left' ): ?>
			<?php if ( is_active_sidebar( $sidebar ) ) { ?>
			<div class="col-lg-3 col-md-4 col-sm-7 col-xs-12">        
                <aside class="sidebar-wrapper">
                    <?php dynamic_sidebar( $sidebar ); ?>
                    <?php
                        /**
                         * woocommerce_sidebar hook
                         *
                         * @hooked woocommerce_get_sidebar - 10
                         */
                        do_action( 'woocommerce_sidebar' );
                    ?>
                </aside>
            </div>
			<?php } ?>
			<?php endif; ?>

			<!-- sidebar area -->
			
			<div class="<?php echo esc_attr($classes);?> products-section no-padd-top no-padd-bottom shop-page-content1">
                <div class="shop-content">
			<?php
				/**
				 * woocommerce_before_main_content hook
				 *
				 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
				 * @hooked woocommerce_breadcrumb - 20
				 */
				do_action( 'woocommerce_before_main_content' );
			?>
			
			<?php
				/**
				 * woocommerce_archive_description hook
				 *
				 * @hooked woocommerce_taxonomy_archive_description - 10
				 * @hooked woocommerce_product_archive_description - 10
				 */
				do_action( 'woocommerce_archive_description' );
			?>

		<?php if ( have_posts() ) : ?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
		</div>
	
	</div>

	<!-- sidebar area -->
	<?php if( $layout == 'right' ): ?>
    <?php if ( is_active_sidebar( $sidebar ) ) { ?>
    <div class="col-lg-3 col-md-4 col-sm-7 col-xs-12">        
        <aside class="sidebar-wrapper">
            <?php dynamic_sidebar( $sidebar ); ?>
            <?php
				/**
				 * woocommerce_sidebar hook
				 *
				 * @hooked woocommerce_get_sidebar - 10
				 */
				do_action( 'woocommerce_sidebar' );
			?>
        </aside>
    </div>
    <?php } ?>
    <?php endif; ?>
    <!--Sidebar-->
    
		</div>
	</div>
</section>
<?php get_footer( 'shop' ); ?>
