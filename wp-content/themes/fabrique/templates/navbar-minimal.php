<?php
/**
 * The template file
 *
 * @package fabrique/templates
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'navbar-minimal' );
	$opts = fabrique_navbar_options( $args );
	$menu = fabrique_template_nav_menu( $opts['nav_menu_args'] );
?>

<nav <?php echo fabrique_a( $opts['navbar_attribute'] ); ?>>
	<div class="fbq-navbar-inner fbq-<?php echo esc_attr( $opts['navbar_color_scheme'] ); ?>-scheme" <?php echo fabrique_s( $opts['navbar_inner_style'] ); ?>>
		<div class="fbq-navbar-wrapper">
			<div class="<?php echo esc_attr( $opts['container_class'] ); ?>">
				<?php if ( $opts['logo_on'] ) : ?>
					<div class="fbq-navbar-header">
						<?php fabrique_template_partial( 'navbar-logo', $opts ); ?>
					</div>
				<?php endif; ?>
				<div class="fbq-navbar-content">
					<div class="fbq-navbar-content-inner">
						<?php if ( $opts['header_action_button'] && 'right' === $opts['minimal_navbar_menu_style'] ) : ?>
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
									<a class="fbq-collapsed-button fbq-collapsed-button--<?php echo esc_attr( $opts['minimal_navbar_menu_style'] ); ?>" href="#" data-target=".fbq-collapsed-menu">
										<span class="fbq-lines"></span>
									</a>
									<?php if ( 'offcanvas' !== $opts['minimal_navbar_menu_style'] ) : ?>
										<div class="<?php echo esc_attr( implode( ' ', $opts['collapsed_classes'] ) ); ?>">
											<div class="fbq-collapsed-menu-inner">
												<div class="fbq-collapsed-menu-wrapper">
													<div class="fbq-collapsed-menu-content">
														<?php echo fabrique_escape_content( $menu ); ?>
													</div>
												</div>
												<?php if ( 'full' === $opts['minimal_navbar_menu_style'] && is_active_sidebar( 'fabrique-navbar-full' ) ) : ?>
													<div class="fbq-widgets">
														<ul class="fbq-widgets-list">
															<?php dynamic_sidebar( 'fabrique-navbar-full' ); ?>
														</ul>
													</div>
												<?php endif ;?>
											</div>
										</div>
									<?php endif ;?>
								</div><?php // Close navbar body inner ?>
							</div><?php // Close navbar body ?>
						<?php endif; ?>

						<?php if ( $opts['header_action_button'] && 'right' !== $opts['minimal_navbar_menu_style'] ) : ?>
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
			</div><?php // Close navbar container ?>
		</div><?php // Close navbar wrapper ?>
	</div><?php // Close navbar inner ?>
	<?php if ( $opts['header_action_button'] && 'headerwidget' === $opts['action_type'] ) : ?>
		<?php fabrique_template_partial( 'navbar-header-widgets', $opts ); ?>
	<?php endif ;?>
	<?php if ( 'right' === $opts['minimal_navbar_menu_style'] && $opts['search_on'] ) : ?>
		<?php fabrique_template_partial( 'navbar-search', $opts['container_class'] ); ?>
	<?php endif; ?>
</nav>

<?php if ( 'offcanvas' === $opts['minimal_navbar_menu_style'] ) : ?>
	<div class="fbq-offcanvas-overlay"></div>
	<div class="<?php echo esc_attr( implode( ' ', $opts['collapsed_classes'] ) ); ?>" data-style="<?php echo esc_attr( $opts['minimal_navbar_menu_style'] ); ?>">
		<div class="fbq-collapsed-menu-inner fbq-p-bg-bg">
			<div class="fbq-collapsed-menu-wrapper">
				<div class="fbq-collapsed-menu-content">
					<?php echo fabrique_escape_content( $menu ); ?>
				</div>
				<?php if ( is_active_sidebar( 'fabrique-navbar-offcanvas' ) ) : ?>
					<div class="fbq-widgets">
						<ul class="fbq-widgets-list">
							<?php dynamic_sidebar( 'fabrique-navbar-offcanvas' ); ?>
						</ul>
					</div>
				<?php endif ;?>
			</div>
		</div>
	</div>
<?php endif ;?>
