<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/milestone' );
	$opts = fabrique_item_milestone_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>
	<div class="fbq-row">

		<?php foreach ( $opts['data'] as $index => $data ) : ?>
			<?php
				$item_class = $opts['item_class'];
				if ( isset( $opts['animation'] ) && 'none' !== $opts['animation'] ) {
					$item_class .= ' anmt-item anmt-' . $opts['animation'];

					if ( isset( $opts['stagger'] ) && $opts['stagger'] ) {
						$item_class .= ' stagger';
					}
				}
			?>
			<div class="<?php echo esc_attr( $item_class ); ?>">
				<div class="fbq-milestone-wrapper fbq-p-border-border" <?php echo fabrique_s( $opts['wrapper_style'] );?>>
					<div class="fbq-milestone-body">
						<div class="fbq-milestone-body-inner">
							<div class="fbq-milestone-content">
								<?php if ( 'top' === $opts['title_position'] && 'stacked' === $opts['style'] ) : ?>
									<div class="fbq-milestone-title fbq-<?php echo esc_attr( $opts['title_font'] ); ?>-font fbq-s-text-color" <?php echo fabrique_s( $opts['title_style'] ); ?>>
										<?php echo do_shortcode( $data['title'] ); ?>
									</div>
								<?php endif; ?>
								<div class="fbq-milestone-number fbq-p-brand-color fbq-<?php echo esc_attr( $opts['number_font'] ); ?>-font" <?php echo fabrique_s( $opts['number_style'] ); ?>>
									<?php echo esc_html( $data['number'] ); ?>
								</div>
								<div class="fbq-milestone-text">
									<?php if ( 'bottom' === $opts['title_position'] || 'inline' === $opts['style'] ) : ?>
										<div class="fbq-milestone-title fbq-<?php echo esc_attr( $opts['title_font'] ); ?>-font fbq-s-text-color" <?php echo fabrique_s( $opts['title_style'] ); ?>>
											<?php echo do_shortcode( $data['title'] ); ?>
										</div>
									<?php endif; ?>
									<?php if ( $opts['subtitle_on'] ): ?>
										<div class="fbq-milestone-subtitle fbq-<?php echo esc_attr( $opts['subtitle_font'] ); ?>-font" <?php echo fabrique_s( $opts['subtitle_style'] ); ?>>
											<?php echo do_shortcode( $data['subtitle'] ); ?>
										</div>
									<?php endif; ?>

								</div><?php // close text fbq-milestone-text ?>
							</div><?php // close content fbq-milestone-content ?>
						</div><?php // close body inner fbq-milestone-body-inner ?>
					</div><?php // close body fbq-milestone-body ?>
				</div><?php // close wrapper fbq-milestone-wrapper ?>
			</div><?php // close item fbq-milestone-item ?>
		<?php endforeach; ?>

	</div><?php // close row fbq-row ?>
</div>
