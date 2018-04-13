<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/space' );
	$opts = fabrique_item_space_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>></div>
