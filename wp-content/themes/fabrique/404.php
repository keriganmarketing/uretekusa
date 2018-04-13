<?php
/**
 * The main template file
 *
 * @package fabrique
 * @version 1.0.0
 */
?>


<?php get_header(); ?>

<div class="fbq-content fbq-content--no-header">
	<div class="fbq-content-wrapper">
		<main class="fbq-404-page">
			<div class="fbq-404-header fbq-s-text-color"><?php esc_html_e( '404', 'fabrique' ); ?></div>
			<?php fabrique_get_title( array(
					'style' => 'plain',
					'size' => 'h2',
					'text' => esc_html__( 'PAGE NOT FOUND', 'fabrique' )
			) ); ?>
			<div class="fbq-404-content">
				<?php esc_html_e( 'The page you are looking for does not exist. It may have been moved, or removed. Perhaps you can return back to the homepage and see if you can find what you are looking for.', 'fabrique' ); ?>
			</div>
			<?php fabrique_template_button( array(
				'button_size' => 'medium',
				'button_link' => get_home_url(),
				'button_label' => esc_html__( 'GO TO HOMEPAGE', 'fabrique' ),
				'button_target_self' => true
			) ); ?>
		</main>
	</div>
</div><!-- #primary -->

<?php get_footer(); ?>
