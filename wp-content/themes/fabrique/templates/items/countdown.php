<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/countdown' );
	$opts = fabrique_item_countdown_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>

	<?php if ( $opts['week_on'] ) : ?>
		<div class="fbq-countdown-item fbq-countdown-week" data-label="week">
			<div <?php echo fabrique_a( $opts['number_attr'] ); ?>></div>
			<span <?php echo fabrique_a( $opts['label_attr'] ); ?>><?php esc_html_e( 'weeks', 'fabrique' ); ?></span>
		</div>
	<?php endif; ?>

	<div class="fbq-countdown-item fbq-countdown-day" data-label="day">
		<div <?php echo fabrique_a( $opts['number_attr'] ); ?>></div>
		<span <?php echo fabrique_a( $opts['label_attr'] ); ?>>
			<?php esc_html_e( 'days', 'fabrique' ); ?>
		</span>
	</div>
	<div class="fbq-countdown-item fbq-countdown-hour" data-label="hour">
		<div <?php echo fabrique_a( $opts['number_attr'] ); ?>></div>
		<span <?php echo fabrique_a( $opts['label_attr'] ); ?>>
			<?php esc_html_e( 'hours', 'fabrique' ); ?>
		</span>
	</div>
	<div class="fbq-countdown-item fbq-countdown-minute" data-label="minute">
		<div <?php echo fabrique_a( $opts['number_attr'] ); ?>></div>
		<span <?php echo fabrique_a( $opts['label_attr'] ); ?>>
			<?php esc_html_e( 'minutes', 'fabrique' ); ?>
		</span>
	</div>
	<div class="fbq-countdown-item fbq-countdown-second" data-label="second">
		<div <?php echo fabrique_a( $opts['number_attr'] ); ?>></div>
		<span <?php echo fabrique_a( $opts['label_attr'] ); ?>>
			<?php esc_html_e( 'seconds', 'fabrique' ); ?>
		</span>
	</div>
</div>
