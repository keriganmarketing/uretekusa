<?php
/**
 * The template file
 *
 * @package fabrique/templates
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'navbar-mobile' );
	$opts = fabrique_navbar_mobile_options( $args );
	$menu = fabrique_template_nav_menu( $opts['nav_menu_args'], true );
?>

<nav <?php echo fabrique_a( $opts['navbar_mobile_attr'] ); ?>>
	<div class="fbq-navbar-inner fbq-<?php echo esc_attr( $opts['navbar_color_scheme'] ); ?>-scheme" <?php echo fabrique_s( $opts['navbar_inner_style'] ); ?>>
		<div class="<?php echo esc_attr( $opts['container_class'] ); ?>">
			<div class="fbq-navbar-wrapper">
				<?php if ( $opts['logo_on'] ) : ?>
					<div class="fbq-navbar-header">
						<?php fabrique_template_partial( 'navbar-logo', $opts ); ?>
					</div>
				<?php endif; ?>
				<div class="fbq-navbar-content">
					<div class="fbq-navbar-content-inner">
						<?php if ( !empty( $menu ) ) : ?>
							<div class="fbq-navbar-body">
								<div class="fbq-navbar-body-inner">
									<a class="fbq-collapsed-button fbq-collapsed-button--<?php echo esc_attr( $opts['mobile_navbar_style'] ); ?>" href="#" data-target=".fbq-collapsed-menu">
										<span class="fbq-lines"></span>
									</a>
									<?php if ( !$opts['is_item'] && is_active_sidebar( 'fabrique-navbar-mobile' ) ) : ?>
										<div class="fbq-widgets navbar-widgets right">
											<ul class="fbq-widgets-list">
												<?php dynamic_sidebar( 'fabrique-navbar-mobile' ); ?>
											</ul>
										</div>
									<?php endif ;?>
									<?php if ( 'full' === $opts['mobile_navbar_style'] ) : ?>
										<div class="fbq-collapsed-menu fbq-collapsed-menu--<?php echo esc_attr( $opts['mobile_navbar_style'] ); ?> fbq-p-bg-bg" data-style="<?php echo esc_attr( $opts['mobile_navbar_style'] ); ?>">
											<div class="fbq-collapsed-menu-inner">
												<div class="fbq-collapsed-menu-wrapper">
													<div class="fbq-collapsed-menu-content">
														<?php echo fabrique_escape_content( $menu ); ?>
													</div>
												</div>
											</div>
										</div>
									<?php endif; ?>
								</div><?php // Close navbar body inner ?>
							</div><?php // Close navbar body  ?>
						<?php endif; ?>
						<?php if ( $opts['header_action_button'] && 'headerwidget' !== $opts['action_type'] && $opts['action_mobile_display'] ) : ?>
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
					</div><?php // Close navbar content inner ?>
				</div><?php // Close navbar content ?>
			</div><?php // Close navbar wrapper ?>
		</div><?php // Close navbar container ?>
		<?php if ( !empty( $menu ) && 'classic' === $opts['mobile_navbar_style'] ) : ?>
			<div class="fbq-collapsed-menu fbq-collapsed-menu--<?php echo esc_attr( $opts['mobile_navbar_style'] ); ?> fbq-p-bg-bg" data-style="<?php echo esc_attr( $opts['mobile_navbar_style'] ); ?>">
				<div class="fbq-collapsed-menu-inner">
					<div class="fbq-collapsed-menu-wrapper">
						<div class="fbq-collapsed-menu-content fbq-container">
							<?php echo fabrique_escape_content( $menu ); ?>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div><?php // Close navbar inner ?>
</nav>
