<?php
/**
 * The template file
 *
 * @package fabrique/templates
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'side-navbar-minimal' );
	$opts = fabrique_side_navbar_options( $args );
	$menu = fabrique_template_nav_menu( $opts['nav_menu_args'] );

	if ( 'text' === $opts['logo_type'] ) {
		$logo = $opts['logo_text_title'];
	} else {
		$logo_image = fabrique_convert_image( $opts['logo'], 'full' );
		$logo = $logo_image['url'];
	}
?>

<nav <?php echo fabrique_a( $opts['navbar_attribute'] ); ?>>
	<div class="fbq-navbar-inner fbq-<?php echo esc_attr( $opts['navbar_color_scheme'] ); ?>-scheme">
		<div class="fbq-side-navbar-nav">
			<?php if ( 'left' === $opts['navbar_position'] ) : ?>
				<a class="fbq-collapsed-button fbq-collapsed-button--minimal" href="#" data-target=".fbq-collapsed-menu"><span class="fbq-lines"></span></a>
			<?php endif; ?>
				<div class="fbq-side-navbar-logo">
					<a class="fbq-navbar-brand" href="<?php echo esc_url( get_home_url() ); ?>">

					<?php if ( 'text' === $opts['logo_type'] ) : ?>
						<span class="fbq-navbar-logo fbq-navbar-logo--text"><?php echo esc_html( $logo ); ?></span>
					<?php else : ?>
						<img class="fbq-navbar-logo fbq-navbar-logo--image" src="<?php echo esc_url( $logo ); ?>" alt="<?php esc_attr_e( 'logo', 'fabrique' ); ?>" />
					<?php endif; ?>

					<?php if ( $opts['two_schemes_logo'] ) : ?>
						<?php $fixed_logo_image_light = fabrique_convert_image( $opts['fixed_navbar_logo_light'], 'full' ); ?>
						<?php $fixed_logo_image_dark = fabrique_convert_image( $opts['fixed_navbar_logo_dark'], 'full' ); ?>
						<img class="fbq-fixed-nav-logo fbq-fixed-nav-logo--light" src="<?php echo esc_url( $fixed_logo_image_light['url'] ); ?>" alt="<?php esc_attr_e( 'logo light scheme', 'fabrique' ); ?>" />
						<img class="fbq-fixed-nav-logo fbq-fixed-nav-logo--dark" src="<?php echo esc_url( $fixed_logo_image_dark['url'] ); ?>" alt="<?php esc_attr_e( 'logo dark scheme', 'fabrique' ); ?>" />
					<?php endif; ?>

				</a>
				</div>
			<?php if ( 'right' === $opts['navbar_position'] ) : ?>
				<a class="fbq-collapsed-button" href="#" data-target=".fbq-collapsed-menu"><span class="fbq-lines"></span></a>
			<?php endif; ?>
		</div>
		<div class="fbq-navbar-wrapper">
			<div class="<?php echo esc_attr( implode( ' ', $opts['collapsed_classes'] ) ); ?>">
				<div class="fbq-navbar-header">
					<a class="fbq-navbar-brand" href="<?php echo esc_url( get_home_url() ); ?>">
						<?php if ( 'text' === $opts['logo_type'] ) : ?>
							<span class="fbq-navbar-logo fbq-navbar-logo--text"><?php echo esc_html( $logo ); ?></span>
						<?php else : ?>
							<img class="fbq-navbar-logo fbq-navbar-logo--image" src="<?php echo esc_url( $logo ); ?>" alt="<?php esc_attr_e( 'logo', 'fabrique' ); ?>" />
						<?php endif; ?>
					</a>
				</div>
				<?php if ( !empty( $menu ) ) : ?>
					<div class="fbq-navbar-body">
						<div class="fbq-navbar-body-inner">
							<?php echo fabrique_escape_content( $menu ); ?>
						</div>
					</div>
				<?php endif; ?>
				<?php if ( is_active_sidebar( 'fabrique-navbar-side' ) ) : ?>
					<div class="fbq-navbar-footer">
						<div class="fbq-widgets">
							<ul class="fbq-widgets-list">
								<?php dynamic_sidebar( 'fabrique-navbar-side' ); ?>
							</ul>
						</div>
					</div>
				<?php endif ;?>
			</div><?php // Close collapsed menu ?>
		</div><?php // Close navbar wrapper ?>
	</div><?php // Close navbar inner ?>
</nav>
