<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/slider' );
	$opts = fabrique_item_slider_options( $args );
?>

<?php if ( !$opts['is_header'] ) : ?>
	<div <?php echo fabrique_a( $opts ); ?>>
<?php else : ?>
	<header <?php echo fabrique_a( $opts ); ?>>
<?php endif; ?>

	<?php foreach ( $opts['data'] as $index => $data ) : ?>
		<div <?php echo fabrique_a( $opts['item_attribute'][$index] ); ?>>
			<?php fabrique_template_background( $data, 'fbq-p-bg-bg' ); ?>
			<div class="fbq-slider-inner <?php echo esc_attr( $opts['inner_class'] ); ?>">
				<div class="fbq-slider-wrapper">
					<div class="fbq-slider-content fbq-<?php echo esc_attr( $data['vertical'] ); ?>-vertical" <?php echo fabrique_s( $opts['content_style'] ); ?>>
						<div class="fbq-slider-content-wrapper fbq-<?php echo esc_attr( $data['alignment'] ); ?>-align" <?php echo fabrique_s( $opts['content_wrapper_style'] ); ?>>

							<?php if ( $opts['image_on'][$index] ) : ?>
								<div class="fbq-slider-media">
									<?php echo fabrique_template_media( $data ); ?>
								</div>
							<?php endif; ?>
							<div class="fbq-slider-body fbq-s-text-color">

								<?php if ( $opts['topsubtitle_on'][$index] ) : ?>
									<div class="fbq-slider-subtitle--top fbq-<?php echo esc_attr( $opts['topsubtitle_font'] ); ?>-font">
										<?php echo do_shortcode( $data['topsubtitle'] ); ?>
									</div>
								<?php endif; ?>

								<?php if ( $opts['title_on'][$index] ) : ?>
									<div class="fbq-slider-title fbq-<?php echo esc_attr( $opts['title_font'] ); ?>-font" <?php echo fabrique_s( $opts['title_style'] ); ?>>
										<?php echo do_shortcode( $data['title'] ); ?>
									</div>
								<?php endif; ?>

								<?php if ( $opts['subtitle_on'][$index] ) : ?>
									<div class="fbq-slider-subtitle fbq-<?php echo esc_attr( $opts['subtitle_font'] ); ?>-font">
										<?php echo do_shortcode( $data['subtitle'] ); ?>
									</div>
								<?php endif; ?>

								<?php if ( $opts['divider_on'][$index] ) : ?>
									<div class="fbq-slider-divider">
										<div class="fbq-slider-divider-inner fbq-s-text-bg" <?php echo fabrique_s( $opts['divider_style'][$index] ); ?>></div>
									</div>
								<?php endif; ?>

								<?php if ( $opts['firstbutton_on'][$index] || $opts['secondbutton_on'][$index] ) : ?>
									<div class="fbq-slider-footer">

										<?php if ( $opts['firstbutton_on'][$index] ) : ?>
											<?php fabrique_template_button( $data, 'firstbutton' ); ?>
										<?php endif; ?>

										<?php if ( $opts['secondbutton_on'][$index] ) : ?>
											<?php fabrique_template_button( $data, 'secondbutton' ); ?>
										<?php endif; ?>

									</div>
								<?php endif; ?>
							</div><?php // close body fbq-slider-body ?>
						</div><?php // close content wrapper fbq-slider-content-wrapper ?>
					</div><?php // close content fbq-slider-content ?>
				</div><?php // close wrapper fbq-slider-wrapper ?>
			</div><?php // close inner fbq-slider-inner ?>
		</div><?php // close item fbq-slider-item ?>
	<?php endforeach; ?>

<?php if ( !$opts['is_header'] ) : ?>
	</div>
<?php else : ?>
	</header>
<?php endif; ?>
