<?php
/**
 * Partial template file
 *
 * @package fabrique/templates/partials
 * @version 1.0.0
 */
?>

<?php
	$container_class = fabrique_template_args( 'navbar-search' );
	$container_class = ( $container_class ) ? $container_class : 'fbq-container';
?>

<div class="fbq-navbar-search fbq-p-text-color fbq-s-bg-bg">
	<div class="<?php echo esc_attr( $container_class ); ?>">
		<form class="fbq-search-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<input type="text" placeholder="<?php esc_html_e( 'Search', 'fabrique' ); ?>" value="" name="s" />
			<span class="js-search-close fbq-search-close twf twf-ln-cross"></span>
		</form>
	</div>
</div>
