<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/accordion' );
	$opts = fabrique_item_accordion_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>
	<?php if ( !empty( $opts['data'] ) && is_array( $opts['data'] ) ) : ?>
		<?php foreach ( $opts['data'] as $index => $data ): ?>
			<?php
				$panel_class = 'fbq-accordion-panel fbq-p-border-border';
				if ( $opts['default_active'] == $index + 1 && !$opts['close_by_default'] ) {
					$panel_class .= ' active';
				}
			?>
			<div class="<?php echo esc_attr( $panel_class ); ?>" <?php echo fabrique_s( $opts['panel_style'] ); ?> data-index="<?php echo esc_attr( $index + 1 ); ?>">
				<a href="#" <?php echo fabrique_a( $opts['heading_attr'] ); ?> data-index="<?php echo esc_attr( $index + 1 ); ?>">
					<?php if ( $opts['icon_on'] ): ?>
						<span class="fbq-accordion-icon twf twf-<?php echo esc_attr( $opts['icon_style'] ); ?>"></span>
					<?php endif; ?>
					<span class="fbq-accordion-title fbq-<?php echo esc_attr( $opts['title_font'] ); ?>-font"><?php echo do_shortcode( $data['label'] ); ?></span>
				</a>
				<?php $content = $opts['spaces'][$index]; ?>
				<div <?php echo fabrique_a( $opts['body_attr'] ); ?> data-index="<?php echo esc_attr( $index + 1 ); ?>">
					<?php fabrique_template_background( $opts ); ?>
					<?php if ( !empty( $content['items'] ) && is_array( $content['items'] ) ) : ?>
						<?php foreach( $content['items'] as $item ) : ?>
							<?php fabrique_template_item( $item ); ?>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>

		<?php endforeach; ?>
	<?php endif; ?>
</div>
