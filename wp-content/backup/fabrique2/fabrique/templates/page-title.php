<?php
/**
 * The template file
 *
 * @package fabrique/templates
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'page-title' );
	$opts = fabrique_page_title_options( $args );
?>

<?php if ( $opts['breadcrumb_on'] || $opts['title_on'] ) : ?>
	<?php $page_title = isset( $opts['title_content'] ) ? $opts['title_content'] : get_the_title( fabrique_get_page_id() ); ?>
	<header <?php echo fabrique_a( $opts ); ?>>
		<?php fabrique_template_background( $opts, 'fbq-s-bg-bg' ); ?>

		<?php if ( !is_front_page() && $opts['breadcrumb_on'] && 'top' === $opts['breadcrumb_position'] ): ?>
			<div class="<?php echo esc_attr( $opts['breadcrumb_class'] ); ?>" <?php echo fabrique_s( $opts['breadcrumb_style'] ); ?>>
				<div class="<?php echo esc_attr( $opts['container_class'] ); ?>">
					<?php get_template_part( 'templates/breadcrumb' ); ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( $opts['title_on'] ) : ?>
			<div class="<?php echo esc_attr( $opts['container_class'] ); ?>">
				<div class="fbq-page-title-wrapper">

					<?php if ( !is_front_page() && $opts['breadcrumb_on'] && 'inline' === $opts['breadcrumb_position'] ): ?>
						<div class="<?php echo esc_attr( $opts['breadcrumb_class'] ); ?>" <?php echo fabrique_s( $opts['breadcrumb_style'] ); ?>>
							<?php get_template_part('templates/breadcrumb'); ?>
						</div>
					<?php endif; ?>
					<div class="fbq-page-title-content fbq-s-text-color" <?php echo fabrique_s( $opts['title_style'] ); ?>>
						<?php if ( !empty( $page_title ) ): ?>
							<h1 class="fbq-<?php echo esc_attr( $opts['title_font'] ); ?>-font" itemprop="headline">
								<?php echo do_shortcode( $page_title ); ?>
							</h1>
						<?php endif; ?>

						<?php if ( $opts['subtitle_on'] && !empty( $opts['subtitle'] ) ): ?>
							<div class="fbq-page-title-subtitle fbq-<?php echo esc_attr( $opts['subtitle_font'] ); ?>-font" itemprop="description">
								<?php echo do_shortcode( $opts['subtitle'] ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( !is_front_page() && $opts['breadcrumb_on'] && 'bottom' === $opts['breadcrumb_position'] ): ?>
			<div class="<?php echo esc_attr( $opts['breadcrumb_class'] ); ?>" <?php echo fabrique_s( $opts['breadcrumb_style'] ); ?>>
				<div class="<?php echo esc_attr( $opts['container_class'] ); ?>">
					<?php get_template_part( 'templates/breadcrumb' ); ?>
				</div>
			</div>
		<?php endif; ?>

	</header>
<?php endif; ?>
