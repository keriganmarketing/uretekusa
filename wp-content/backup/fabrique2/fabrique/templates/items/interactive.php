<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/interactive' );
	$opts = fabrique_item_interactive_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>
	<div class="fbq-interactive-space fbq-interactive-space--normal <?php echo esc_attr( $opts['normal_class'] ); ?>">
		<?php fabrique_template_background( $opts['data'][0] ); ?>
		<div class="fbq-interactive-content" <?php echo fabrique_s( $opts['space_style'] ); ?>>
			<?php if ( !empty( $opts['spaces'][0]['items'] ) && is_array( $opts['spaces'][0]['items'] ) ) : ?>
				<?php foreach ( $opts['spaces'][0]['items'] as $items ) : ?>
					<?php fabrique_template_item( $items ); ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
	<div class="fbq-interactive-space fbq-interactive-space--hover <?php echo esc_attr( $opts['hover_class'] ); ?>">
		<?php fabrique_template_background( $opts['data'][1] ); ?>
		<div class="fbq-interactive-content" <?php echo fabrique_s( $opts['space_style'] ); ?>>
			<?php if ( !empty( $opts['spaces'][1]['items'] ) && is_array( $opts['spaces'][1]['items'] ) ) : ?>
				<?php foreach ( $opts['spaces'][1]['items'] as $items ) : ?>
					<?php fabrique_template_item( $items ); ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</div>
