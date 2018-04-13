<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/widgets' );
	$opts = fabrique_template_widgets_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>
	<?php if ( !empty( $opts['sidebar_id'] ) ) : ?>
		<ul class="fbq-widgets-list">
			<?php dynamic_sidebar( $opts['sidebar_id'] ); ?>
		</ul>
	<?php else : ?>
		<?php echo fabrique_get_dummy_template( esc_html__( 'widgets', 'fabrique' ), esc_html__( 'Please choose a sidebar.', 'fabrique' ) ); ?>
	<?php endif; ?>
</div>
