<?php
/**
 * The main template file
 *
 * @package fabrique
 * @version 1.0.0
 */
?>

<?php $post_id = fabrique_get_page_id(); ?>
<?php $opts = fabrique_footer_options( array(), $post_id ); ?>

		<?php if ( $opts['back_to_top'] ) : ?>
			<div class="js-back-to-top fbq-back-to-top <?php echo esc_attr( $opts['back_to_top_background'] ); ?> fbq-s-text-contrast-color">
				<div class="fbq-back-to-top-background fbq-s-text-bg"></div>
				<i class="twf twf-<?php echo esc_attr( $opts['back_to_top_style'] ); ?>-up"></i>
			</div>
		<?php endif; ?>
		<?php if ( $opts['cookies_notice'] ) : ?>
			<div class="js-cookies-notice js-close-all fbq-cookies-notice fbq-<?php echo esc_attr( $opts['cookies_notice_color_scheme'] ); ?>-scheme" data-expire="<?php echo apply_filters( 'cookies_notice_expiration' , 30 ); ?>">
				<div class="fbq-container fbq-s-bg-bg" <?php echo fabrique_s( $opts['cookies_notice_style_attr'] ); ?>>
					<div class="fbq-cookies-notice-content">
						<div class="fbq-cookies-notice-message"><?php echo do_shortcode( $opts['cookies_notice_message'] ); ?></div>
						<div class="fbq-cookies-notice-close fbq-p-brand-contrast-color">
							<a href="#js-close-all" class="fbq-p-brand-bg"><?php esc_html_e( 'Got it', 'fabrique' ); ?></a>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
			<?php if ( $opts['footer_active'] && !empty( $opts['footer_id'] ) ) : ?>
				<?php $blueprint_block_content = get_post_meta( $opts['footer_id'], 'bp_data', true ); ?>
				<?php if ( !empty( $blueprint_block_content ) && 'publish' === get_post_status( $opts['footer_id'] ) && isset( $blueprint_block_content['sections'] ) ) : ?>
					<?php $section = $blueprint_block_content['sections']; ?>
					<footer class="fbq-footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
						<?php
							foreach ( $section as $s_index => $section_content ) {
								$section_args = array(
									'section' => $section_content,
									'index' => $s_index
								);
								fabrique_template( 'section-content.php', $section_args );
							}
						?>
					</footer>
				<?php endif; ?>
			<?php endif; ?>
		</div>
		<?php get_template_part( 'templates/partials/photoswipe' ); ?>
		<?php wp_footer(); ?>
	</body>
</html>
