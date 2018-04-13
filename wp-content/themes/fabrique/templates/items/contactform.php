<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/contactform' );
	$opts = fabrique_item_contactform_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>
	<?php
		if ( shortcode_exists( 'contact-form-7' ) ) {
			if ( !empty( $opts['contactform'] ) ) {
				echo do_shortcode( $opts['contactform'] );
			} else {
				echo fabrique_get_dummy_template( esc_html__( 'contact form', 'fabrique' ), esc_html__( 'Please input Contact Form Shortcode.', 'fabrique' ) );
			}
		} else {
			echo fabrique_get_dummy_template( esc_html__( 'contact form', 'fabrique' ), esc_html__( 'Please activate Contact Form 7 plug in.', 'fabrique' ) );
		}
	?>
</div>
