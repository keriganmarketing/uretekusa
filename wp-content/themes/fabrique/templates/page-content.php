<?php
/**
 * The template file
 *
 * @package fabrique/templates
 * @version 1.0.0
 */
?>


<?php
	$post_id = fabrique_get_page_id();
	$opts = fabrique_page_content_options( $post_id );
?>

<?php if ( $opts['blueprint_active'] && !post_password_required() ) : ?>
	<?php fabrique_template( 'blueprint-content.php', $opts ); ?>
<?php else: ?>
	<main <?php echo fabrique_a( $opts ); ?>>
		<article id="post-<?php echo esc_attr( $post_id ); ?>" <?php post_class( 'fbq-content-wrapper' ); ?>>
			<?php fabrique_template_blueprint_page_title( $opts['builder'] ); ?>
			<div id="main" class="fbq-main fbq-main--single blueprint-inactive">
				<div class="fbq-main-wrapper">
					<div class="fbq-container">
						<?php the_content(); ?>
						<?php wp_link_pages(); ?>
					</div>
				</div>
				<?php if ( comments_open() || get_comments_number() ): ?>
					<div class="fbq-container">
						<div class="fbq-row">
							<div class="fbq-col-12">
								<div id="comments" class="fbq-comment">
									<?php comments_template(); ?>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</article>
	</main>
<?php endif; ?>
