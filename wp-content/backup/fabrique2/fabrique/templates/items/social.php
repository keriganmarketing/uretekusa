<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/social' );
	$opts = fabrique_item_social_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>
	<div class="fbq-social-inner">
		<?php echo fabrique_get_social_icon( $opts ); ?>
	</div>
</div>
