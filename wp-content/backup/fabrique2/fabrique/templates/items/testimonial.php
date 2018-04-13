<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/testimonial' );
	$opts = fabrique_item_testimonial_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>

	<?php for ( $i = 0; $i < $opts['no_of_data']; $i++ ) : ?>
		<div class="fbq-testimonial-item fbq-p-bg-bg fbq-p-border-border" <?php echo fabrique_s( $opts['item_style'] ); ?>>
			<div class="fbq-testimonial-item-inner" <?php echo fabrique_s( $opts['inner_style'] ); ?>>
				<div class="fbq-testimonial-item-wrapper">
					<?php $content_style = array(); ?>
					<?php if ( $opts['avatar_on'] ) : ?>
						<div class="fbq-testimonial-avatar"><?php echo fabrique_template_media( $opts['data'][$i] ); ?></div>
						<?php
							if ( ( 'left' === $opts['avatar_position'] || 'right' === $opts['avatar_position'] ) && isset( $opts['data'][$i]['image_max_width'] ) && !empty( $opts['data'][$i]['image_max_width'] ) ) {
								$content_style['padding-' . $opts['avatar_position']] = ( (int)( $opts['data'][$i]['image_max_width'] ) + 20 ) . 'px';
							}
						?>
					<?php endif; ?>
					<div class="fbq-testimonial-content" <?php echo fabrique_s( $content_style ); ?>>
						<blockquote class="fbq-p-brand-color fbq-<?php echo esc_attr( $opts['text_font'] ); ?>-font">
							<?php echo do_shortcode( $opts['data'][$i]['quote'] ); ?>
						</blockquote>
						<div class="fbq-testimonial-author">

							<?php if ( $opts['author_on'] || $opts['title_on'] ) : ?>
								<?php if ( $opts['author_on'] ) : ?>
									<div class="fbq-testimonial-author-name">
										<?php echo do_shortcode( $opts['data'][$i]['author'] ); ?>
									</div>
								<?php endif; ?>

								<?php if ( $opts['title_on'] ) : ?>
									<div class="fbq-testimonial-author-title fbq-p-text-color">
										<?php echo do_shortcode( $opts['data'][$i]['title'] ); ?>
									</div>
								<?php endif; ?>
							<?php endif; ?>
						</div><?php // close author fbq-testimonial-author ?>
					</div><?php // close content fbq-testimonial-content ?>
				</div><?php // close item inner fbq-testimonial-item-wrapper ?>
			</div><?php // close item inner fbq-testimonial-item-inner ?>
		</div><?php // close item fbq-testimonial-item ?>
	<?php endfor; ?>

</div>
