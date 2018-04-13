<?php
/**
 * The main template file
 *
 * @package fabrique
 * @version 1.0.0
 */
?>


<?php $custom_archive = fabrique_mod( 'project_custom_archive' ); ?>
<?php if ( $custom_archive && $page = get_post( $custom_archive ) ) : ?>
	<?php fabrique_set_global_post( $page ); ?>
	<?php get_header(); ?>
	<?php get_template_part( 'templates/page-content' ); ?>
	<?php get_footer(); ?>
<?php else : ?>
	<?php $opts = fabrique_archive_project_options(); ?>
	<?php get_header(); ?>
	<div class="<?php echo esc_attr( $opts['content_class'] ); ?>">
		<div class="fbq-content-wrapper">
			<?php get_template_part( 'templates/archive-title' ); ?>
			<div class="<?php echo esc_attr( $opts['container_class'] ); ?> js-dynamic-navbar">
				<main id="main" class="<?php echo esc_attr( fabrique_main_page_class( $opts['sidebar'], $opts['sidebar_position'] ) ); ?> blueprint-inactive" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
					<?php fabrique_template_item( $opts['entries_args'] ); ?>
				</main>
				<?php if ( $opts['sidebar'] ) : ?>
					<aside class="<?php echo fabrique_sidebar_class( $opts['sidebar_position'], $opts['sidebar_fixed'] ); ?>" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
						<?php fabrique_template_sidebar_background(); ?>
						<div class="fbq-widgets">
							<?php if ( is_active_sidebar( $opts['sidebar_select'] ) ) : ?>
								<ul class="fbq-widgets-list">
									<?php dynamic_sidebar( $opts['sidebar_select'] ); ?>
								</ul>
							<?php endif; ?>
						</div>
					</aside>
				<?php endif; ?>
			</div>
		</div>
	</div><!-- #primary -->
	<?php get_footer(); ?>
<?php endif; ?>
