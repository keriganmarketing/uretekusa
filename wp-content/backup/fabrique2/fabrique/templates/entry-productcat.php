<?php
/**
 * The template file
 *
 * @package fabrique/templates
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'entry-productcat' );
	$opts = fabrique_entry_productcat_options( $args );
	$category = $opts['category_obj'];
	$thumbnail_args = $opts['media_args'];
	$thumbnail_args['image_id'] = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );
?>

<?php if ( $category ) : ?>
	<article <?php wc_product_cat_class( $opts['entry_class'], $category ); ?> <?php echo fabrique_s( $opts['entry_style'] ) . ' data-filter="' . esc_attr( strtolower( $category->name ) ) . '"'; ?>>
		<a href="<?php echo esc_url( get_term_link( $category->slug, $opts['taxonomy'] ) ); ?>" class="<?php echo esc_attr( implode( ' ', $opts['entry_inner_class'] ) ); ?>">
			<div class="fbq-entry-header">
				<?php echo fabrique_template_media( $thumbnail_args ); ?>
			</div>
			<div class="fbq-entry-body">
				<div class="fbq-entry-body-inner">
					<h4 <?php echo fabrique_a( $opts['title_attr'] ); ?>>
						<?php echo esc_html( $category->name ); ?>
					</h4>
				</div>
			</div><?php // close entry body ?>
		</a><?php // close entry inner ?>
	</article><?php // close entry ?>
<?php endif; ?>
