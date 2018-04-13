<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

echo do_shortcode('[contact-form-7 id="'.($atts['contact_form']).'"]');