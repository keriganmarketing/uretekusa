<?php
/**
 * The template file
 *
 * @package fabrique/templates
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'page-hero' );
	$opts = fabrique_page_hero_options( $args );
?>

<header <?php echo fabrique_a( $opts ); ?>>
	<?php fabrique_template_background( $opts, 'fbq-p-bg-bg' ); ?>
	<div class="fbq-page-hero-inner <?php echo esc_attr( $opts['container_class'] ); ?>">
		<div class="fbq-page-hero-wrapper fbq-<?php echo esc_attr( $opts['horizontal'] ); ?>-align">
			<div class="fbq-page-hero-content fbq-<?php echo esc_attr( $opts['vertical'] ); ?>-vertical" <?php echo fabrique_s( $opts['content_style'] ); ?>>
				<div class="fbq-page-hero-content-wrapper fbq-<?php echo esc_attr( $opts['alignment'] ); ?>-align" <?php echo fabrique_s( $opts['content_wrapper_style'] ); ?>>

					<?php if ( $opts['image_on'] ): ?>
						<div class="fbq-page-hero-media">
							<?php echo fabrique_template_media( $opts ); ?>
						</div>
					<?php endif; ?>

					<?php if ( $opts['body_on'] ) : ?>
						<div class="fbq-page-hero-body">

							<?php if ( $opts['topsubtitle_on'] ): ?>
								<div class="fbq-page-hero-subtitle fbq-page-hero-subtitle--top fbq-<?php echo esc_attr( $opts['topsubtitle_font'] ); ?>-font">
									<?php echo do_shortcode( $opts['topsubtitle'] ); ?>
								</div>
							<?php endif; ?>

							<?php if ( $opts['title_on'] || $opts['bannertext_on'] ) : ?>
								<div class="fbq-page-hero-body-title">
									<?php if ( $opts['title_on'] ) : ?>
										<h1 class="fbq-page-hero-title fbq-s-text-color fbq-<?php echo esc_attr( $opts['title_font'] ); ?>-font" <?php echo fabrique_s( $opts['title_style'] ); ?> itemprop="headline">
											<?php echo do_shortcode( $opts['title'] ); ?>
										</h1>
									<?php endif; ?>
									<?php if ( $opts['bannertext_on'] ) : ?>
										<h1 <?php echo fabrique_a( $opts['bannertext_attr'] ); ?>>
											<span class="<?php echo esc_attr( implode( ' ', $opts['bannertext_dynamic_class'] ) ); ?>" <?php echo fabrique_s( $opts['bannertext_dynamic_style'] ); ?>>
												<span class="fbq-bannertext-dynamic-inner"></span>
											</span>
										</h1>
									<?php endif; ?>
								</div>
							<?php endif; ?>

							<?php if ( $opts['subtitle_on'] ): ?>
								<div class="fbq-page-hero-subtitle fbq-page-hero-subtitle--bottom fbq-<?php echo esc_attr( $opts['subtitle_font'] ); ?>-font" itemprop="description">
									<?php echo do_shortcode( $opts['subtitle'] ); ?>
								</div>
							<?php endif; ?>

							<?php if ( $opts['divider_on'] ): ?>
								<div class="fbq-page-hero-divider"><div class="fbq-page-hero-divider-inner fbq-s-text-bg" <?php echo fabrique_s( $opts['divider_style'] ); ?>></div></div>
							<?php endif; ?>

							<?php if ( $opts['firstbutton_on'] || $opts['secondbutton_on'] ) : ?>
								<div class="fbq-page-hero-buttons">

									<?php if ( $opts['firstbutton_on'] ) : ?>
										<?php fabrique_template_button( $opts, 'firstbutton' ); ?>
									<?php endif; ?>

									<?php if ( $opts['secondbutton_on'] ) : ?>
										<?php fabrique_template_button( $opts, 'secondbutton' ); ?>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</div><?php // close body ?>
					<?php endif; ?>
				</div><?php // close content wrapper ?>
			</div><?php // close content ?>
		</div><?php // close wrapper ?>
	</div><?php // close inner ?>
</header>
