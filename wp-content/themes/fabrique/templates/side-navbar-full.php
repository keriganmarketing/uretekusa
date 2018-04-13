<?php
/**
 * The template file
 *
 * @package fabrique/templates
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'side-navbar-full' );
	$opts = fabrique_side_navbar_options( $args );
	$menu = fabrique_template_nav_menu( $opts['nav_menu_args'] );
?>

<nav <?php echo fabrique_a( $opts['navbar_attribute'] ); ?>>
	<div class="fbq-navbar-inner fbq-<?php echo esc_attr( $opts['navbar_color_scheme'] ); ?>-scheme">
		<div class="fbq-side-navbar-nav">
			<a class="fbq-collapsed-button fbq-collapsed-button--full" href="#" data-target=".fbq-collapsed-menu">
				<span class="fbq-lines"></span>
			</a>
			<div class="fbq-side-navbar-logo">
				<a class="fbq-navbar-brand" href="<?php echo esc_url( get_home_url() ); ?>">
					<?php if ( 'text' === $opts['logo_type'] ) : ?>
						<span class="fbq-nabar-logo fbq-navbar-logo--text"><?php echo esc_html( substr( $opts['logo_text_title'], 0, 1 ) ); ?></span>
					<?php else : ?>
						<?php if ( !empty( $opts['fixed_navbar_logo'] ) ): ?>
							<?php $logo_image = fabrique_convert_image( $opts['fixed_navbar_logo'], 'full' ); ?>
							<img class="fbq-navbar-logo fbq-navbar-logo--image" src="<?php echo esc_url( $logo_image['url'] ); ?>" alt="<?php esc_attr_e( 'logo', 'fabrique' ); ?>" />
						<?php elseif ( !empty( $opts['logo'] ) ) : ?>
							<?php $logo_image = fabrique_convert_image( $opts['logo'], 'full' ); ?>
							<img class="fbq-navbar-logo fbq-navbar-logo--image" src="<?php echo esc_url( $logo_image['url'] ); ?>" alt="<?php esc_attr_e( 'logo', 'fabrique' ); ?>" />
						<?php endif; ?>
					<?php endif; ?>
				</a>
			</div>
		</div><?php // Close sidenav nav ?>
		<?php if ( !empty( $menu ) ) : ?>
			<div class="fbq-navbar-wrapper">
				<div class="fbq-navbar-body">
					<div class="fbq-navbar-body-inner">
						<div class="<?php echo esc_attr( implode( ' ', $opts['collapsed_classes'] ) ); ?>">
							<div class="fbq-collapsed-menu-inner">
								<div class="fbq-collapsed-menu-wrapper">
									<div class="fbq-collapsed-menu-content">
										<?php echo fabrique_escape_content( $menu ); ?>
									</div>
								</div>
								<?php if ( is_active_sidebar( 'fabrique-navbar-full' ) ): ?>
									<div class="fbq-widgets">
										<ul class="fbq-widgets-list">
											<?php dynamic_sidebar( 'fabrique-navbar-full' ); ?>
										</ul>
									</div>
								<?php endif ;?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endif ;?>
	</div><?php // Close navbar inner ?>
</nav>
