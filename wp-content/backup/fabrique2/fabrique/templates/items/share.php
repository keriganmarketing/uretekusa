<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/share' );
	$opts = fabrique_item_share_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>
	<?php fabrique_template_share( $opts ); ?>
</div>
