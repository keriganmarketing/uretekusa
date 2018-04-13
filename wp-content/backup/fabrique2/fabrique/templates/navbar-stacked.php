<?php
/**
 * The template file
 *
 * @package fabrique/templates
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'navbar-stacked' );
	$opts = fabrique_navbar_options( $args );
	$menu = fabrique_template_nav_menu( $opts['nav_menu_args'] );
?>

<nav <?php echo fabrique_a( $opts['navbar_attribute'] ); ?>>
	<div class="fbq-navbar-inner fbq-<?php echo esc_attr( $opts['navbar_color_scheme'] ); ?>-scheme" <?php echo fabrique_s( $opts['navbar_inner_style'] ); ?>>
		<div class="fbq-navbar-wrapper">
			<?php if ( $opts['logo_on'] ) : ?>
				<div class="fbq-navbar-header">
					<div class="<?php echo esc_attr( $opts['container_class'] ); ?>">
						<div class="fbq-navbar-header-inner">
							<?php if ( ( 'right' === $opts['navbar_menu_position'] || 'center' === $opts['navbar_menu_position'] ) && is_active_sidebar( 'fabrique-navbar-stacked-left' ) ) : ?>
								<div class="fbq-widgets navbar-widgets left">
									<ul class="fbq-widgets-list">
										<?php dynamic_sidebar( 'fabrique-navbar-stacked-left' ); ?>
									</ul>
								</div>
							<?php endif ;?>
							<?php fabrique_template_partial( 'navbar-logo', $opts ); ?>
							<?php if ( ( 'left' === $opts['navbar_menu_position'] || 'center' === $opts['navbar_menu_position'] ) && is_active_sidebar( 'fabrique-navbar-stacked-right' ) ) : ?>
								<div class="fbq-widgets navbar-widgets right">
									<ul class="fbq-widgets-list">
										<?php dynamic_sidebar( 'fabrique-navbar-stacked-right' ); ?>
									</ul>
								</div>
							<?php endif ;?>
						</div>
					</div>
				</div>
			<?php endif ;?>
			<div class="fbq-navbar-content">
				<div class="<?php echo esc_attr( $opts['container_class'] ); ?>">
					<div class="fbq-navbar-content-inner">
						<?php if ( $opts['header_action_button'] ) : ?>
							<div class="fbq-navbar-footer">
								<?php if ( 'social' !== $opts['action_type'] ) : ?>
									<?php fabrique_template_button( $opts['action_button_args'] ); ?>
								<?php else : ?>
									<div class="fbq-navbar-social">
										<?php echo fabrique_get_social_icon( array( 'components' => $opts['action_social_component'] ) ); ?>
									</div>
								<?php endif; ?>
							</div>
						<?php endif; ?>
						<?php if ( !empty( $menu ) ) : ?>
							<div class="fbq-navbar-body">
								<div class="fbq-navbar-body-inner">
									<?php echo fabrique_escape_content( $menu ); ?>
								</div>
							</div>
						<?php endif; ?>
					</div><?php // Close content inner ?>
				</div><?php // Close container ?>
			</div><?php // Close navbar content ?>
		</div><?php // Close navbar wrapper ?>
	</div><?php // Close navbar inner ?>
	<?php if ( $opts['header_action_button'] && 'headerwidget' === $opts['action_type'] ) : ?>
		<?php fabrique_template_partial( 'navbar-header-widgets', $opts ); ?>
	<?php endif ;?>
	<?php if ( $opts['search_on'] ) : ?>
		<?php fabrique_template_partial( 'navbar-search', $opts['container_class'] ); ?>
	<?php endif; ?>
</nav>
