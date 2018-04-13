<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/html' );
	$opts = fabrique_item_default_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>
	<?php echo do_shortcode( html_entity_decode( $opts['html'] ) ); ?>
</div>
