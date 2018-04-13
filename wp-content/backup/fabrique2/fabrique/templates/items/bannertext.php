<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/bannertext' );
	$opts = fabrique_item_bannertext_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>

	<?php if ( $opts['fronttext_on'] ) : ?>
		<span <?php echo fabrique_a( $opts['static_attr'] ); ?>><?php echo do_shortcode( $opts['fronttext'] ); ?></span>
	<?php endif; ?>

	<span <?php echo fabrique_a( $opts['dynamic_attr'] ); ?>>
		<span class="fbq-bannertext-dynamic-inner"></span>
	</span>

	<?php if ( $opts['backtext_on'] ) : ?>
		<span <?php echo fabrique_a( $opts['static_attr'] ); ?>><?php echo do_shortcode( $opts['backtext'] ); ?></span>
	<?php endif; ?>

</div>
