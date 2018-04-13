<?php
/**
 * Partial template file
 *
 * @package fabrique/templates/partials
 * @version 1.0.0
 */
?>

<?php $opts = fabrique_template_args( 'button' ); ?>

<div <?php echo fabrique_a( $opts['button_attr'] ); ?>>
	<?php if ( !empty( $opts['button_link'] ) ): ?>
		<a href="<?php echo fabrique_escape_url( $opts['button_link'] ); ?>" <?php echo fabrique_a( $opts['btnx_attr'] ); ?> target="<?php echo esc_attr( $opts['link_target'] ); ?>">
	<?php else : ?>
		<div <?php echo fabrique_a( $opts['btnx_attr'] ); ?>>
	<?php endif; ?>
		<?php if ( 'before' === $opts['icon_position'] && !empty( $opts['icon'] ) ) : ?>
			<i class="twf fbq-icon--before twf-<?php echo esc_attr( $opts['icon'] ); ?>"></i>
		<?php endif; ?>
		<span class="fbq-button-label"><?php echo do_shortcode( $opts['label'] ); ?></span>
		<?php if ( 'after' === $opts['icon_position'] && !empty( $opts['icon'] ) ) : ?>
			<i class="twf fbq-icon--after twf-<?php echo esc_attr( $opts['icon'] ); ?>"></i>
		<?php endif; ?>
	<?php if ( !empty( $opts['button_link'] ) ): ?>
		</a>
	<?php else : ?>
		</div>
	<?php endif; ?>
</div>
