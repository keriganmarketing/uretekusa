<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/button' );
	$opts = fabrique_item_button_options( $args );
	fabrique_template_button( $opts );
?>
