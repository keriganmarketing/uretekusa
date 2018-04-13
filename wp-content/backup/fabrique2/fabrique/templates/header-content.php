<?php
/**
 * The template file
 *
 * @package fabrique/templates
 * @version 1.0.0
 */
?>


<?php $post_id = fabrique_get_page_id(); ?>
<?php $opts = fabrique_header_content_options( array(), $post_id ); ?>

<?php if ( 'frame' === $opts['site_layout'] ) : ?>
	<span class="fbq-frame fbq-s-bg-bg fbq-frame--top"></span>
	<span class="fbq-frame fbq-s-bg-bg fbq-frame--right"></span>
	<span class="fbq-frame fbq-s-bg-bg fbq-frame--bottom"></span>
	<span class="fbq-frame fbq-s-bg-bg fbq-frame--left"></span>
<?php endif; ?>

<body <?php body_class(); ?> <?php echo fabrique_d( $opts['body_data'] ); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">
	<?php if ( !empty( $opts['preload_style'] ) && 'none' !== $opts['preload_style'] ) : ?>
		<div class="fbq-page-load fbq-p-bg-bg">
			<div class="fbq-page-load-spinner">
				<?php echo fabrique_template_preload( $opts['preload_style'], $opts['preload_logo'] ); ?>
			</div>
		</div>
	<?php endif; ?>

	<div <?php echo fabrique_a( $opts['wrapper_attr'] ); ?>>

		<?php if ( 'none' !== $opts['nav_menu'] ) : ?>
			<?php if ( 'none' !== $opts['nav_menu'] && 'top' !== $opts['navbar_position'] ) : ?>
				<?php fabrique_template( 'side-navbar-' . $opts['sidenav_style'], $opts ); ?>
			<?php endif; ?>

			<header class="fbq-header" data-transparent="<?php echo esc_attr( $opts['header_transparent'] ); ?>" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
				<?php if ( $opts['topbar'] ) : ?>
					<div <?php echo fabrique_a( $opts['topbar_attr'] ); ?>>
						<div class="fbq-topbar-inner">
							<div class="<?php echo esc_attr( $opts['container_class'] ); ?>">
								<div class="fbq-row">

									<?php for ( $i = 1; $i <= $opts['topbar_column']; $i++ ) : ?>
									<div class="fbq-topbar-column fbq-p-border-border fbq-col-<?php echo esc_attr( 12 / $opts['topbar_column'] ); ?>">
										<?php if ( is_active_sidebar( 'fabrique-topbar-' . $i ) ) : ?>
											<div class="fbq-widgets">
												<ul class="fbq-widgets-list">
													<?php dynamic_sidebar( 'fabrique-topbar-' . $i ); ?>
												</ul>
											</div>
										<?php endif; ?>
									</div>
									<?php endfor; ?>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>

				<?php if ( 'none' !== $opts['nav_menu'] && 'top' === $opts['navbar_position'] ) : ?>
					<?php fabrique_template( 'navbar-' . $opts['navbar_style'], $opts ); ?>
				<?php endif; ?>
				<?php if ( $opts['responsive'] ) : ?>
					<?php fabrique_template( 'navbar-mobile', $opts ); ?>
				<?php endif; ?>
			</header>

		<?php endif; ?>
