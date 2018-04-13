<?php
/**
 * The main template file
 *
 * @package fabrique
 * @version 1.0.0
 */
?>

<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="fbq-search-form">
		<input type="text" value="" placeholder="<?php esc_html_e( 'Search', 'fabrique' ); ?>" name="s" />
	</div>
</form>
