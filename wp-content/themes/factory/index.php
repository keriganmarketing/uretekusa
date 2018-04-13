<?php
/**
 * The main template file.
 * @package commercegurus
 */

$factorycommercegurus_blog_sidebar = '';
$factorycommercegurus_blog_sidebar = factorycommercegurus_getoption( 'factorycommercegurus_blog_sidebar' );

$factorycommercegurus_news_layout	 = '';
$factorycommercegurus_news_layout	 = 'default-news';
$factorycommercegurus_islayout		 = '';

if ( isset( $_GET['blogsidebar'] ) ) {
	$factorycommercegurus_blog_sidebar = $_GET['blogsidebar'];
}

if ( isset( $factorycommercegurus_options['factorycommercegurus_news_layout'] ) ) {
	$factorycommercegurus_news_layout = $factorycommercegurus_options['factorycommercegurus_news_layout'];
}

if ( isset( $_GET['newslayout'] ) ) {
	$factorycommercegurus_news_layout = $_GET['newslayout'];
}

?>

<?php 
if ( $factorycommercegurus_news_layout == 'grid-news' ) {
	$factorycommercegurus_islayout = 'grid-news';
}

if ( $factorycommercegurus_news_layout == 'grid-news-two' ) {
	$factorycommercegurus_islayout = 'grid-news';
} 

get_header();
?>
<?php echo factorycommercegurus_get_blog_page_title(); ?>

<div class="container">
    <div class="content">

        <div class="row row-eq-height">
			<?php if ( ( $factorycommercegurus_blog_sidebar == 'default' ) || ( $factorycommercegurus_blog_sidebar == '' ) ) { ?>
				<div class="col-lg-9 col-md-9 col-sm-12 col-md-push-3 col-lg-push-3">
					<div id="primary" class="content-area cg-blog-layout <?php echo $factorycommercegurus_islayout ?>">
						<main id="main" class="site-main <?php echo $factorycommercegurus_islayout ?>" role="main">
							<?php if ( have_posts() ) : ?>
								<?php /* Start the Loop */ ?>
								<?php while ( have_posts() ) : the_post(); ?>
									<?php
									/* Include the Post-Format-specific template for the content.
									 * If you want to override this in a child theme, then include a file
									 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
									 */
									get_template_part( 'content', get_post_format() );
									?>
								<?php endwhile; ?>
								<?php factorycommercegurus_numeric_posts_nav(); ?>
							<?php else : ?>
								<?php get_template_part( 'no-results', 'index' ); ?>
							<?php endif; ?>
						</main><!-- #main -->
					</div><!-- #primary -->
				</div><!--/9 -->
				<div class="col-lg-3 col-md-3 col-sm-12 col-md-pull-9 col-lg-pull-9 sidebar">
					<?php get_sidebar(); ?>
				</div>
			<?php } else if ( $factorycommercegurus_blog_sidebar == 'right' ) { ?>
				<div class="col-lg-9 col-md-9 col-sm-12">
					<div id="primary" class="content-area cg-blog-layout">
						<main id="main" class="site-main <?php echo $factorycommercegurus_islayout ?>" role="main">
							<?php if ( have_posts() ) : ?>
								<?php /* Start the Loop */ ?>
								<?php while ( have_posts() ) : the_post(); ?>
									<?php
									/* Include the Post-Format-specific template for the content.
									 * If you want to override this in a child theme, then include a file
									 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
									 */
									get_template_part( 'content', get_post_format() );
									?>
								<?php endwhile; ?>
								<?php factorycommercegurus_numeric_posts_nav(); ?>
							<?php else : ?>
								<?php get_template_part( 'no-results', 'index' ); ?>
							<?php endif; ?>
						</main><!-- #main -->
					</div><!-- #primary -->
				</div><!--/9 -->
				<div class="col-lg-3 col-md-3 col-sm-12 sidebar right">
					<?php get_sidebar(); ?>
				</div>
			<?php } else if ( $factorycommercegurus_blog_sidebar == 'none' ) { ?>
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div id="primary" class="content-area cg-blog-layout">
						<main id="main" class="site-main <?php echo $factorycommercegurus_islayout ?>" role="main">
							<?php if ( have_posts() ) : ?>
								<?php /* Start the Loop */ ?>
								<?php while ( have_posts() ) : the_post(); ?>
									<?php
									/* Include the Post-Format-specific template for the content.
									 * If you want to override this in a child theme, then include a file
									 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
									 */
									get_template_part( 'content', get_post_format() );
									?>
								<?php endwhile; ?>
								<?php factorycommercegurus_numeric_posts_nav(); ?>
							<?php else : ?>
								<?php get_template_part( 'no-results', 'index' ); ?>
							<?php endif; ?>
						</main><!-- #main -->
					</div><!-- #primary -->
				</div><!--/12 -->
			<?php } ?>
        </div><!--/row -->
    </div><!--/content -->
</div><!--/container -->

<?php get_footer(); ?>