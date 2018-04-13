<?php
/**
 * The template file
 *
 * @package fabrique/templates
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'entry-instagram' );
	$opts = fabrique_entry_instagram_options( $args );
?>

<div <?php echo fabrique_a( $opts['item_attr'] ); ?> data-filter="<?php echo esc_attr( strtolower( implode( ', ', $opts['image']['tags'] ) ) ); ?>">
	<div <?php echo fabrique_a( $opts['body_attr'] ); ?>>
		<?php
			$image = $opts['image'];
			$image['link'] = null;
			$image['ratio'] = $opts['image_ratio'];
			$image['hover'] = $opts['image_hover'];
			$image['wrapper_style'] = $opts['media_wrapper_style'];
			$image['lazy_load'] = $opts['image_lazy_load'];
			if ( $opts['caption_on'] && isset( $image['caption'] ) ) {
				$image['title'] = $image['caption'];
			}
		?>
		<?php if ( 'none' ===  $opts['on_image_click'] ) : ?>
			<div class="fbq-gallery-media">
				<?php echo fabrique_template_external_media( $image ); ?>
			</div>
		<?php else : ?>
			<?php if ( 'link' === $opts['on_image_click'] ) : ?>
				<?php $link = $opts['image']['link']; ?>
				<?php $target = '_blank'; ?>
			<?php else : ?>
				<?php $link = $opts['image']['url']; ?>
				<?php $target = '_self'; ?>
				<?php if ( 'content' === $opts['on_image_click'] && isset( $opts['post'] ) ) : ?>
					<div class="fbq-content-modal fbq-p-bg-bg">
						<div class="fbq-ig-popup">
							<div class="fbq-ig-popup-image">
								<img src="<?php echo esc_url( $image['url'] ); ?>" width="<?php echo esc_attr( $image['width'] ); ?>" height="<?php echo esc_attr( $image['height'] ); ?>" alt="<?php echo esc_attr( $image['caption'] ); ?>" />
							</div>
							<div class="fbq-ig-popup-detail">
								<h4><?php echo( $opts['post']->post_title ); ?></h4>
								<?php if ( !empty( $opts['post']->post_excerpt ) ) : ?>
									<p><?php echo do_shortcode( $opts['post']->post_excerpt ); ?></p>
								<?php endif; ?>
								<?php if ( !empty( $opts['link_label'] ) && isset( $opts['post']->guid ) ) : ?>
									<a href="<?php echo esc_url( $opts['post']->guid ); ?>" target="_blank"><?php echo do_shortcode( $opts['link_label'] ); ?></a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
			<?php endif; ?>
			<a class="fbq-gallery-media" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>" data-index="<?php echo esc_attr( $opts['image_index'] ); ?>">
				<?php echo fabrique_template_external_media( $image ); ?>
			</a>
		<?php endif; ?>
	</div>
</div>
