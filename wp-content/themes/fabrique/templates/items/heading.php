<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/heading' );
	$opts = fabrique_item_heading_options( $args );
	fabrique_get_title( $opts );
?>
