<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/action' );
	$opts = fabrique_item_action_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>
	<?php if ( 'inline' === $opts['style'] && 'right' === $opts['image_position'] ): ?>
		<div class="fbq-action-button">
			<?php fabrique_template_button( $opts ); ?>
		</div>
		<div class="fbq-action-body" <?php echo fabrique_s( $opts['body_style'] ); ?>>
			<div class="fbq-action-title fbq-s-text-color fbq-<?php echo esc_attr( $opts['title_font'] ); ?>-font">
				<?php echo do_shortcode( $opts['title'] ); ?>
			</div>

			<?php if ( $opts['subtitle_on'] ): ?>
				<div class="fbq-action-subtitle">
					<?php echo do_shortcode( $opts['subtitle'] ); ?>
				</div>
			<?php endif; ?>
		</div>
		<?php if ( $opts['image_on'] ): ?>
			<div class="fbq-action-media" <?php echo fabrique_s( $opts['action_media_style'] ); ?>>
				<?php echo fabrique_template_media( $opts ); ?>
			</div>
		<?php endif; ?>

	<?php else: ?>

		<?php if ( $opts['image_on'] ): ?>
			<div class="fbq-action-media" <?php echo fabrique_s( $opts['action_media_style'] ); ?>>
				<?php echo fabrique_template_media( $opts ); ?>
			</div>
		<?php endif; ?>
		<div class="fbq-action-body" <?php echo fabrique_s( $opts['body_style'] ); ?>>
			<div class="fbq-action-title fbq-s-text-color fbq-<?php echo esc_attr( $opts['title_font'] ); ?>-font">
				<?php echo do_shortcode( $opts['title'] ); ?>
			</div>

			<?php if ( $opts['subtitle_on'] ): ?>
				<div class="fbq-action-subtitle">
					<?php echo do_shortcode( $opts['subtitle'] ); ?>
				</div>
			<?php endif; ?>
		</div>
		<div class="fbq-action-button">
			<?php fabrique_template_button( $opts ); ?>
		</div>
	<?php endif; ?>
</div>
