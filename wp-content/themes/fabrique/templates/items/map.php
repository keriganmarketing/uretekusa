<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/map' );
	$opts = fabrique_item_map_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>
	<?php if ( shortcode_exists( 'wpgmza' ) ) : ?>

		<?php if ( !empty( $opts['map_id'] ) ) : ?>
			<?php echo do_shortcode( '[wpgmza id="'. $opts['map_id'] .'"]' ); ?>
		<?php else : ?>
			<?php echo fabrique_get_dummy_template( esc_html__( 'map', 'fabrique' ), esc_html__( 'Please input Map ID.', 'fabrique' ) ); ?>
		<?php endif; ?>
	<?php else : ?>
		<?php echo fabrique_get_dummy_template( esc_html__( 'map', 'fabrique' ), esc_html__( 'Please install plugin "WP Google Maps".', 'fabrique' ) ); ?>
	<?php endif; ?>
</div>
