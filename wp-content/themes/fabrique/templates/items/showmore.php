<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/showmore' );
	$opts = fabrique_item_showmore_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>
	<?php fabrique_template_background( $opts, 'fbq-p-bg-bg' ); ?>
	<div <?php echo fabrique_a( $opts['inner_attr'] ); ?>>
		<?php if ( !empty( $opts['spaces'] ) && is_array( $opts['spaces'] ) ) : ?>
			<?php foreach( $opts['spaces'] as $space ) : ?>
				<?php if ( !empty( $space['items'] ) && is_array( $space['items'] ) ) : ?>
					<?php foreach( $space['items'] as $item ) : ?>
						<?php fabrique_template_item( $item ); ?>
					<?php endforeach; ?>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
	<a class="fbq-showmore-button js-showmore-button" href="#" <?php echo fabrique_s( $opts['more_button_style'] ); ?>>
		<div class="fbq-overlay" <?php echo fabrique_s( $opts['overlay_style'] ); ?>></div>
		<div class="fbq-showmore-button-inner">
			<i class="twf twf-chevron-up up"></i>
			<div class="fbq-showless-button-text"><?php echo esc_html( $opts['less_button_label'] ); ?></div>
			<div class="fbq-showmore-button-text"><?php echo esc_html( $opts['more_button_label'] ); ?></div>
			<i class="twf twf-chevron-down down"></i>
		</div>
	</a>
</div>
