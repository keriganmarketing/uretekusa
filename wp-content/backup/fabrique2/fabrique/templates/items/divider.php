<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/divider' );
	$opts = fabrique_item_divider_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>
	<div <?php echo fabrique_a( $opts['line_attr'] ); ?>>
	<?php if ( $opts['text_on'] ) : ?>
		<span <?php echo fabrique_a( $opts['text_attr'] ); ?>>
			<?php echo do_shortcode( $opts['text'] ); ?>
		</span>
	<?php endif; ?>
	</div>
</div>
