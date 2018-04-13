<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/navigationmenu' );
	$opts = fabrique_item_navigation_menu_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>
	<div class="fbq-navigationmenu-inner">
		<?php fabrique_template( 'navbar-' . $opts['style'], $opts ); ?>
		<?php fabrique_template( 'navbar-mobile', $opts ); ?>
	</div>
</div>
