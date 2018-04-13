<?php
/**
 * Partial template file
 *
 * @package fabrique/templates/partials
 * @version 1.0.0
 */
?>


<?php $opts = fabrique_template_args( 'navbar-logo' ); ?>

<?php if ( $opts && is_array( $opts ) && !empty( $opts ) ) : ?>
	<a class="fbq-navbar-brand" href="<?php echo esc_url( get_home_url() ); ?>">
		<?php if ( empty( $opts['mobile_navbar_logo'] ) ) : ?>
			<?php if ( 'text' === $opts['logo_type'] && !empty( $opts['logo_text_title'] ) ) : ?>
				<span class="fbq-navbar-logo fbq-navbar-logo--text"><?php echo esc_html( $opts['logo_text_title'] ); ?></span>
			<?php elseif ( !empty( $opts['logo'] ) ) : ?>
				<?php $logo_image = fabrique_convert_image( $opts['logo'], 'full' ); ?>
				<img class="fbq-navbar-logo fbq-navbar-logo--image" src="<?php echo esc_url( $logo_image['url'] ); ?>" alt="<?php esc_attr_e( 'logo', 'fabrique' ); ?>" />
			<?php endif; ?>
		<?php else : ?>
			<?php $logo_image = fabrique_convert_image( $opts['mobile_navbar_logo'], 'full' ); ?>
			<img class="fbq-navbar-logo fbq-navbar-logo--image" src="<?php echo esc_url( $logo_image['url'] ); ?>" alt="<?php esc_attr_e( 'logo', 'fabrique' ); ?>" />
		<?php endif; ?>

		<?php if ( $opts['two_schemes_logo'] ) : ?>
			<?php $fixed_logo_image_light = fabrique_convert_image( $opts['fixed_navbar_logo_light'], 'full' ); ?>
			<?php $fixed_logo_image_dark = fabrique_convert_image( $opts['fixed_navbar_logo_dark'], 'full' ); ?>
			<img class="fbq-fixed-nav-logo fbq-fixed-nav-logo--light" src="<?php echo esc_url( $fixed_logo_image_light['url'] ); ?>" alt="<?php esc_attr_e( 'logo light scheme', 'fabrique' ); ?>" />
			<img class="fbq-fixed-nav-logo fbq-fixed-nav-logo--dark" src="<?php echo esc_url( $fixed_logo_image_dark['url'] ); ?>" alt="<?php esc_attr_e( 'logo dark scheme', 'fabrique' ); ?>" />
		<?php endif; ?>
		<?php if ( !empty( $opts['fixed_navbar_logo'] ) ) : ?>
			<?php $fixed_logo_image = fabrique_convert_image( $opts['fixed_navbar_logo'], 'full' ); ?>
			<img class="fbq-fixed-nav-logo fbq-fixed-nav-logo--default" src="<?php echo esc_url( $fixed_logo_image['url'] ); ?>" alt="<?php esc_attr_e( 'logo', 'fabrique' ); ?>" />
		<?php endif; ?>
	</a>
<?php endif; ?>
