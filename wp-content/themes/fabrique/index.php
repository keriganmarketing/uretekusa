<?php
/**
 * The main template file
 *
 * @package fabrique
 * @version 1.0.0
 */
?>

<?php $custom_archive = fabrique_mod( 'blog_custom_archive' ); ?>
<?php if ( is_home() && $custom_archive && $page = get_post( $custom_archive ) ) : ?>
	<?php fabrique_set_global_post( $page ); ?>
	<?php get_header(); ?>
	<?php get_template_part( 'templates/page-content' ); ?>
	<?php get_footer(); ?>
<?php else : ?>
	<?php $opts = fabrique_index_options(); ?>
	<?php get_header(); ?>
	<div class="<?php echo esc_attr( $opts['content_class'] ); ?>">
		<div class="fbq-content-wrapper">
			<?php get_template_part( 'templates/archive-title' ); ?>
			<div class="<?php echo esc_attr( $opts['container_class'] ); ?> js-dynamic-navbar">
				<main id="main" class="<?php echo esc_attr( fabrique_main_page_class( $opts['sidebar'], $opts['sidebar_position'] ) ); ?> blueprint-inactive" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
					<?php fabrique_template_item( $opts['entries_args'] ); ?>
				</main>
				<?php if ( $opts['sidebar'] ) : ?>
					<?php get_sidebar(); ?>
				<?php endif; ?>
			</div>
		</div>
	</div><!-- #primary -->
	<?php get_footer(); ?>
<?php endif; ?>
