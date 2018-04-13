<?php
/**
 * The main template file
 *
 * @package fabrique
 * @version 1.0.0
 */
?>

<?php $opts = fabrique_search_result_options(); ?>
<?php get_header(); ?>
<div class="<?php echo esc_attr( $opts['content_class'] ); ?>">
	<div class="fbq-content-wrapper">
		<?php fabrique_template( 'page-title', array(
			'breadcrumb_on' => true,
			'breadcrumb_color' => fabrique_mod( 'breadcrumb_text_color' ),
			'alignment' => 'left',
			'full_width' => fabrique_mod( 'page_title_full_width' ),
			'color_scheme' => fabrique_mod( 'page_title_color_scheme' ),
			'title_on' => false
		) ); ?>
		<div class="<?php echo esc_attr( $opts['container_class'] ); ?> js-dynamic-navbar">
			<main id="main" class="<?php echo esc_attr( fabrique_main_page_class( $opts['sidebar'], $opts['sidebar_position'] ) ); ?> blueprint-inactive" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
				<div class="fbq-search-title">
					<h1><?php echo fabrique_mod( 'page_title_search_label' ) . get_search_query(); ?></h1>
					<form class="fbq-form-group" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<div class="fbq-search-form">
							<input type="text" value="" name="s" />
						</div>
						<input type="submit" value="Search">
					</form>
				</div>
				<?php fabrique_template_item( $opts['entries_args'] ); ?>
			</main>
			<?php if ( $opts['sidebar'] ) : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
		</div>
	</div>
</div><!-- #primary -->
<?php get_footer(); ?>
