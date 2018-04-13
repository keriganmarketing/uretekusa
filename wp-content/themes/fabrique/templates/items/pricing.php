<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/pricing' );
	$opts = fabrique_item_pricing_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>
	<div class="fbq-row">

		<?php foreach ( $opts['data'] as $index => $data ) : ?>
			<div class="fbq-pricing-item fbq-p-border-border <?php echo esc_attr( implode( ' ', $opts['item_class'][$index] ) ); ?>" <?php echo fabrique_s( $opts['item_style'][$index] ); ?>>
				<div class="fbq-pricing-header <?php echo esc_attr( implode( ' ', $opts['heading_class'][$index] ) ); ?>" <?php echo fabrique_s( $opts['heading_style'][$index] ); ?>>

					<?php if ( !empty( $data['top_title'] ) ) : ?>
						<div class="fbq-pricing-top-title fbq-<?php echo esc_attr( $opts['toptitle_font'] ); ?>-font">
							<?php echo do_shortcode( $data['top_title'] ); ?>
						</div>
					<?php endif; ?>

					<?php if ( $opts['image_on'] ) : ?>
						<div class="fbq-pricing-media">
							<?php $data['image_column_width'] = $opts['column_width']; ?>
							<?php echo fabrique_template_media( $data ); ?>
						</div>
					<?php endif; ?>

					<div class="fbq-pricing-price fbq-<?php echo esc_attr( $opts['price_font'] ); ?>-font">

						<?php if ( $data['currency'] ) : ?>
							<span class="fbq-pricing-currency">
								<?php echo esc_html( $opts['currency'] ); ?>
							</span>
						<?php endif; ?>

						<?php if ( !empty( $data['value'] ) || 0 == $data['value'] ) : ?>
							<?php $decimal = explode( '.', $data['value'] ); ?>
							<?php if ( !empty( $decimal[1] ) ) : ?>
								<span class="fbq-pricing-value"><?php echo esc_html( $decimal[0] ); ?></span>
								<span class="fbq-pricing-decimal">.<?php echo esc_html( $decimal[1] ); ?></span>
							<?php else : ?>
								<span class="fbq-pricing-value"><?php echo esc_html( $data['value'] ); ?></span>
							<?php endif; ?>
						<?php endif; ?>

						<?php if ( !empty( $data['unit'] ) ) : ?>
							<span class="fbq-pricing-unit"><?php echo do_shortcode( $data['unit'] ); ?></span>
						<?php endif; ?>

					</div><?php // close price fbq-pricing-price ?>
					<?php if ( !empty( $data['title'] ) ) : ?>
						<div class="fbq-pricing-title fbq-<?php echo esc_attr( $opts['subtitle_font'] ); ?>-font">
							<?php echo do_shortcode( $data['title'] ); ?>
						</div>
					<?php endif; ?>
				</div><?php // close header fbq-pricing-header ?>

				<?php if ( count( $data['content'] ) > 0 ) : ?>
					<div class="fbq-pricing-body fbq-<?php echo esc_attr( $opts['content_font'] ); ?>-font">

						<?php foreach ( $data['content'] as $i => $content ) : ?>
							<div class="fbq-pricing-body-content" <?php echo fabrique_s( $opts['alternate_style'][$i] ); ?>>
								<div class="fbq-pricing-body-text"><?php echo do_shortcode( $content ); ?></div>
							</div>
						<?php endforeach; ?>

					</div><?php // close body fbq-pricing-body ?>
				<?php endif; ?>

				<?php if ( $opts['button_on'] ) : ?>
					<div class="fbq-pricing-footer">
						<?php fabrique_template_button( $data ); ?>
					</div>
				<?php endif; ?>

			</div><?php // close item fbq-pricing-item ?>

		<?php endforeach; ?>
	</div><?php // close row fbq-row ?>
</div>
