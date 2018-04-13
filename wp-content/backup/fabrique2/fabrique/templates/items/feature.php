<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/feature' );
	$opts = fabrique_item_feature_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>
	<div class="fbq-feature-content">
		<?php foreach ( $opts['formatted'] as $i => $row ) : ?>
			<?php
				if ( $i == ceil( $opts['no_of_items'] / $opts['no_of_columns'] ) - 1 ) {
					$row_style = array( 'margin' => '0 '. -$opts['spacing'] / 2 .'px' );
				} else {
					$row_style = array( 'margin' => '0 '. -$opts['spacing'] / 2 .'px ' . $opts['spacing'] . 'px' );
				}
			?>
			<div class="fbq-row" <?php echo fabrique_s( $row_style ); ?>>
				<?php foreach ( $row as $index => $data ): ?>
					<?php $item_attr = $opts['item_attr']; ?>
					<?php if ( 'image' === $data['media_type'] ) : ?>
						<?php $item_attr['class'][] = 'with-image'; ?>
					<?php endif; ?>
					<div <?php echo fabrique_a( $item_attr );?>>
						<div <?php echo fabrique_a( $opts['item_inner_attr'] );?>>

							<?php if ( $opts['media_on'] && 'right' !== $opts['style'] ): ?>
								<div class="fbq-feature-media">
									<?php $data['image_column_width'] = $opts['column_width']; ?>
									<?php echo fabrique_template_media( $data ); ?>
								</div>
							<?php endif; ?>

							<?php if ( $opts['title_on'] && 'inline' === $opts['style'] ): ?>
								<div class="fbq-feature-title fbq-s-text-color fbq-<?php echo esc_attr( $opts['title_font'] ); ?>-font" <?php echo fabrique_s( $opts['title_style'] ); ?>><?php echo do_shortcode( $data['title'] ); ?></div>
							<?php endif; ?>

							<?php if ( ( $opts['title_on'] && 'inline' !== $opts['style'] ) || $opts['description_on'] || $opts['button_on'] ) : ?>
								<div <?php echo fabrique_a( $opts['item_body_attr'] );?>>

									<?php if ( $opts['title_on'] && 'inline' !== $opts['style'] ): ?>
										<div class="fbq-feature-title fbq-s-text-color fbq-<?php echo esc_attr( $opts['title_font'] ); ?>-font" <?php echo fabrique_s( $opts['title_style'] ); ?>><?php echo do_shortcode( $data['title'] ); ?></div>
									<?php endif; ?>

									<?php if ( $opts['description_on'] ): ?>
										<div class="fbq-feature-description"><?php echo do_shortcode( $data['description'] ); ?></div>
									<?php endif; ?>

									<?php if ( $opts['button_on'] ): ?>
										<div class="fbq-feature-button">
											<?php
												$data['button_style'] = 'plain';
												$data['button_hover'] = 'brand';
												$data['button_size'] = 'small';
												fabrique_template_button( $data );
											?>
										</div>
									<?php endif; ?>

								</div><?php // close fbq-feature-body ?>
							<?php endif; ?>
							<?php if ( $opts['media_on'] && 'right' === $opts['style'] ): ?>
								<div class="fbq-feature-media">
									<?php $data['image_column_width'] = $opts['column_width']; ?>
									<?php echo fabrique_template_media( $data ); ?>
								</div>
							<?php endif; ?>
						</div><?php // close item inner ?>
					</div><?php // close item ?>
				<?php endforeach;?>
			</div><?php // close row ?>
		<?php endforeach;?>
	</div><?php // close fbq-feature-content ?>
</div>
