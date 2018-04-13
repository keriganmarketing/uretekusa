<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/image' );
	$opts = fabrique_item_image_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>
	<div class="fbq-image-container">
		<?php echo fabrique_template_media( $opts ); ?>
	</div>
</div>
