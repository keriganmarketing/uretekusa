<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/gallery' );
	$opts = fabrique_item_gallery_options( $args );
?>
<?php if ( !empty( $opts['image_id'] ) ) : ?>
	<div <?php echo fabrique_a( $opts ); ?>>
		<div <?php echo fabrique_a( $opts['content_attr'] ); ?>>
			<?php
				if ( !$opts['pagination'] || 'false' === $opts['pagination'] || 'carousel' === $opts['style'] || 'teaser' === $opts['style'] ) {
					$images = $opts['image_id'];
				} else {
					$images = array_slice( $opts['image_id'], ( $opts['query_args']['paged'] - 1 ) * $opts['no_of_items'], $opts['no_of_items'] );
				}

				foreach ( $images as $index => $image_id ) {
					$opts['image'] = $image_id;
					$opts['image_index'] = $index;
					fabrique_template( 'entry-gallery.php', $opts );
				}
			?>
		</div>

		<?php if ( $opts['thumbnail'] && 'carousel' === $opts['style'] ) : ?>
			<div class="fbq-gallery-thumbnail fbq-gallery-thumbnail--bottom" data-thumbnail='<?php echo esc_attr( $opts['thumbnail_columns'] ); ?>'>
				<?php foreach ( $opts['image_id'] as $index => $image_id ): ?>
					<?php $thumbnail_image_args = array(
						'image_id' => $image_id,
						'image_ratio' => '1x1',
						'image_column_width' => $opts['thumbnail_column_width']
					); ?>
					<div class="fbq-gallery-thumbnail-item fbq-col-<?php echo esc_attr( $opts['thumbnail_column_width'] ); ?>">
						<?php echo fabrique_template_media( $thumbnail_image_args ); ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php if ( 'teaser' !== $opts['style'] && !empty( $opts['caption'] ) && $opts['gallery_caption_on'] ) : ?>
			<?php // this is gallery caption not image caption ?>
			<div class="fbq-gallery-caption">
				<?php echo do_shortcode( $opts['caption'] ); ?>
			</div>
		<?php endif; ?>

		<?php if ( $opts['pagination'] && 'carousel' !== $opts['style'] && 'teaser' !== $opts['style'] ) : ?>
			<?php fabrique_template_pagination( $opts['query_args'], $opts ); ?>
		<?php endif; ?>
	</div>
<?php else :?>
		<?php echo fabrique_get_dummy_template( esc_html__( 'gallery', 'fabrique' ), esc_html__( 'Gallery is now empty, please upload images.', 'fabrique' ) ); ?>
<?php endif; ?>
