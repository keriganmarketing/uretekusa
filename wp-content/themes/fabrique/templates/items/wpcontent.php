<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/wpcontent' );
	$opts = fabrique_item_default_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>
	<?php the_content(); ?>
</div>
