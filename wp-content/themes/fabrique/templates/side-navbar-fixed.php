<?php
/**
 * The template file
 *
 * @package fabrique/templates
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'side-navbar-fixed' );
	$opts = fabrique_side_navbar_options( $args );
	$menu = fabrique_template_nav_menu( $opts['nav_menu_args'] );
?>

<nav <?php echo fabrique_a( $opts['navbar_attribute'] ); ?>>
	<div class="fbq-navbar-inner fbq-<?php echo esc_attr( $opts['navbar_color_scheme'] ); ?>-scheme">
		<div class="fbq-navbar-wrapper">
			<div class="fbq-navbar-header">
				<a class="fbq-navbar-brand" href="<?php echo esc_url( get_home_url() ); ?>">
					<?php if ( 'text' === $opts['logo_type'] ) : ?>
						<span class="fbq-navbar-logo fbq-navbar-logo--text"><?php echo esc_html( $opts['logo_text_title'] ); ?></span>
					<?php elseif ( !empty( $opts['logo'] ) ) : ?>
						<?php $logo_image = fabrique_convert_image( $opts['logo'], 'full' ); ?>
						<img class="fbq-navbar-logo fbq-navbar-logo--image" src="<?php echo esc_url( $logo_image['url'] ); ?>" alt="<?php esc_attr_e( 'logo', 'fabrique' ); ?>" />
					<?php endif; ?>
				</a>
			</div>
			<?php if ( !empty( $menu ) ) : ?>
				<div class="fbq-navbar-body">
					<div class="fbq-navbar-body-inner">
						<?php echo fabrique_template_nav_menu( $opts['nav_menu_args'] ); ?>
					</div>
				</div>
			<?php endif ;?>
			<?php if ( is_active_sidebar( 'fabrique-navbar-side' ) ) : ?>
				<div class="fbq-navbar-footer">
					<div class="fbq-widgets">
						<ul class="fbq-widgets-list">
							<?php dynamic_sidebar( 'fabrique-navbar-side' ); ?>
						</ul>
					</div>
				</div>
			<?php endif ;?>
		</div><?php // Close navbar wrapper ?>
	</div><?php // Close navbar inner ?>
</nav>
