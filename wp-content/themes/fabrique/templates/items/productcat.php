<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/productcat' );
	$opts = fabrique_item_productcat_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>
	<?php if ( fabrique_is_woocommerce_activated() ) : ?>
		<?php if ( !empty( $opts['filters'] ) ) : ?>
			<div <?php echo fabrique_a( $opts['content_attr'] ); ?>>
				<?php
					$categories = get_terms( $opts['taxonomy'], $opts['category_args'] );
					if ( is_array( $categories ) ) {
						foreach ( $categories as $category ) {
							$slug = $category->slug;
							if ( in_array( 'all', $opts['filters'] ) || in_array( $slug, $opts['filters'] ) ) {
								$opts['category_obj'] = $category;
								fabrique_template( 'entry-productcat', $opts );
							}
						}
					} else {
						echo fabrique_get_dummy_template( esc_html__( 'product category', 'fabrique' ), esc_html__( 'Product Category is now empty.', 'fabrique' ) );
					}
				?>
			</div><?php // close content ?>

		<?php else : ?>
			<?php echo fabrique_get_dummy_template( esc_html__( 'product category', 'fabrique' ), esc_html__( 'Please choose categories.', 'fabrique' ) ); ?>
		<?php endif; ?>

	<?php else : ?>
		<?php echo fabrique_get_dummy_template( esc_html__( 'product category', 'fabrique' ), esc_html__( 'Please install and activate Woocommerce Plugin.', 'fabrique' ) ); ?>
	<?php endif; ?>
</div><?php // close element ?>
