<?php
/**
 * The template file
 *
 * @package fabrique/templates
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'entry-gallery' );
	$opts = fabrique_entry_gallery_options( $args );
?>

<div <?php echo fabrique_a( $opts['item_attr'] ); ?>>
	<div <?php echo fabrique_a( $opts['body_attr'] ); ?>>
		<?php if ( 'none' ===  $opts['on_image_click'] && 'teaser' !== $opts['style'] ) : ?>
			<div class="fbq-gallery-media">
				<?php echo fabrique_template_media( $opts['image_args'], false, $opts['responsive'] ); ?>
			</div>
		<?php elseif ( 'teaser' === $opts['style'] ) : ?>
			<?php
				if ( 0 == $opts['image_index'] ) {
					$opts['image_args']['image_caption'] = true;
					$opts['image_args']['image_caption_text'] = $opts['caption'];
					$opts['image_args']['image_caption_icon'] = 'gallery';
				} else {
					$opts['image_args']['image_lazy_load'] = true;
				}
				$media = fabrique_template_media( $opts['image_args'], true, $opts['responsive'] );
			?>
			<a class="fbq-gallery-media" href="<?php echo esc_url( $media['image_url'] ); ?>" data-index="<?php echo esc_attr( $opts['image_index'] ); ?>">
				<?php echo fabrique_escape_content( $media['html'] ); ?>
			</a>
		<?php else : ?>
			<?php $media = fabrique_template_media( $opts['image_args'], true, $opts['responsive'] ); ?>
			<a class="fbq-gallery-media" href="<?php echo esc_url( $media['image_url'] ); ?>" data-index="<?php echo esc_attr( $opts['image_index'] ); ?>">
				<?php echo fabrique_escape_content( $media['html'] ); ?>
			</a>
		<?php endif; ?>

		<?php if ( 'teaser' !== $opts['style'] && ( ( $opts['title_on'] && !empty( $opts['image_title'] ) ) || ( $opts['caption_on'] && !empty( $opts['image_caption'] ) ) ) ) : ?>
			<div class="fbq-gallery-description">
				<div class="fbq-gallery-description-inner">

					<?php if ( $opts['title_on'] && !empty( $opts['image_title'] ) ) : ?>
						<div class="fbq-gallery-title">
							<?php echo esc_html( $opts['image_title'] ); ?>
						</div>
					<?php endif; ?>

					<?php if ( $opts['caption_on'] && !empty( $opts['image_caption'] ) ) : ?>
						<div class="fbq-gallery-subtitle">
							<?php echo esc_html( $opts['image_caption'] ); ?>
						</div>
					<?php endif; ?>

				</div>
			</div>
		<?php endif; ?>
	</div>
</div>
