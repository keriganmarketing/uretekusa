<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/message' );
	$opts = fabrique_item_message_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>
	<div class="fbq-message-content">

		<?php if ( $opts['icon_on'] ): ?>
			<div class="fbq-message-icon"><?php echo fabrique_template_media( $opts ); ?></div>
		<?php endif; ?>

		<div class="fbq-message-text"><?php echo do_shortcode( $opts['text'] ); ?></div>
	</div>

	<?php if ( $opts['button_on'] ): ?>
		<a href="#js-close-all" class="fbq-message-close-button twf twf-times"></a>
	<?php endif; ?>

</div>
