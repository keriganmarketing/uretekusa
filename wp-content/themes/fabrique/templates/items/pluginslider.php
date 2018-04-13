<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/pluginslider' );
	$opts = fabrique_item_pluginslider_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>
	<?php if ( !empty( $opts['pluginslider'] ) ) : ?>
		<?php
			$pluginsliders = explode( ' ', $opts['pluginslider'] );
			$prefix = $pluginsliders[0];
			$plugin = substr( $prefix, 1 );
		?>

		<?php if ( shortcode_exists( $plugin ) ) : ?>
			<?php echo do_shortcode( $opts['pluginslider'] ); ?>
		<?php else : ?>
			<?php echo fabrique_get_dummy_template( esc_html__( 'plug in slider', 'fabrique' ), esc_html__( 'Please activate plug-in slider.', 'fabrique' ) ); ?>
		<?php endif; ?>
	<?php else : ?>
		<?php echo fabrique_get_dummy_template( esc_html__( 'plug in slider', 'fabrique' ), esc_html__( 'Please input Slider Shortcode.', 'fabrique' ) ); ?>
	<?php endif; ?>
</div>
