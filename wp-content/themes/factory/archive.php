<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
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
<?php if ( have_posts() ) : ?>


		<div class="header-wrapper">
			<div class="cg-hero-bg" data-center-top="top:-10%;" data-top-top="top: 0%;"></div>
			<div class="overlay"></div> 
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<header class="entry-header">
							<h1 class="cg-page-title">
							<?php
							if ( is_category() ) :
								single_cat_title();

							elseif ( is_tag() ) :
								single_tag_title();

							elseif ( is_author() ) :
								/* Queue the first post, that way we know
								 * what author we're dealing with (if that is the case).
								 */
								the_post();
								printf( esc_html__( 'Author: %s', 'factory' ), '<span class="vcard">' . get_the_author() . '</span>' );
								/* Since we called the_post() above, we need to
								 * rewind the loop back to the beginning that way
								 * we can run the loop properly, in full.
								 */
								rewind_posts();

							elseif ( is_day() ) :
								printf( esc_html__( 'Day: %s', 'factory' ), '<span>' . get_the_date() . '</span>' );

							elseif ( is_month() ) :
								printf( esc_html__( 'Month: %s', 'factory' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

							elseif ( is_year() ) :
								printf( esc_html__( 'Year: %s', 'factory' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

							elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
								esc_html_e( 'Asides', 'factory' );

							elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
								esc_html_e( 'Images', 'factory' );

							elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
								esc_html_e( 'Videos', 'factory' );

							elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
								esc_html_e( 'Quotes', 'factory' );

							elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
								esc_html_e( 'Links', 'factory' );

							else :
								esc_html_e( 'Archives', 'factory' );

							endif;
							?>                            
						</h1>
						</header>
					</div>
					
					</div>
				</div>
			</div>
		</div>

		<?php echo factorycommercegurus_get_bcrumbs(); ?>

<?php endif; ?>

<div class="container">
    <div class="content">
        <div class="row">
<?php if ( ( $factorycommercegurus_blog_sidebar == 'default' ) || ( $factorycommercegurus_blog_sidebar == '' ) ) { ?>

				<div class="col-lg-9 col-md-9 col-sm-12 col-md-push-3 col-lg-push-3">
					<section id="primary" class="content-area">
						<main id="main" class="site-main <?php echo $factorycommercegurus_islayout ?>" role="main">
								<?php if ( have_posts() ) : ?>
								<div>
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
									<?php factorycommercegurus_content_nav( 'nav-below' ); ?>
								<?php else : ?>
									<?php get_template_part( 'no-results', 'archive' ); ?>
	<?php endif; ?>
							</div>
						</main><!-- #main -->
					</section><!-- #primary -->
				</div><!--/9 -->
				<div class="col-lg-3 col-md-3 col-sm-12 col-md-pull-9 col-lg-pull-9 sidebar">
	<?php get_sidebar(); ?>
				</div>

<?php } else if ( $factorycommercegurus_blog_sidebar == 'right' ) { ?>

				<div class="col-lg-9 col-md-9 col-sm-12">
					<section id="primary" class="content-area">
						<main id="main" class="site-main <?php echo $factorycommercegurus_islayout ?>" role="main">
								<?php if ( have_posts() ) : ?>
								<div>
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
									<?php factorycommercegurus_content_nav( 'nav-below' ); ?>
								<?php else : ?>
									<?php get_template_part( 'no-results', 'archive' ); ?>
	<?php endif; ?>
							</div>
						</main><!-- #main -->
					</section><!-- #primary -->
				</div><!--/9 -->
				<div class="col-lg-3 col-md-3 col-sm-12 sidebar right">
	<?php get_sidebar(); ?>
				</div>

<?php } else if ( $factorycommercegurus_blog_sidebar == 'none' ) { ?>
				<div class="col-lg-12 col-md-12 col-sm-12">
					<section id="primary" class="content-area">
						<main id="main" class="site-main <?php echo $factorycommercegurus_islayout ?>" role="main">
								<?php if ( have_posts() ) : ?>
								<div>
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
									<?php factorycommercegurus_content_nav( 'nav-below' ); ?>
								<?php else : ?>
									<?php get_template_part( 'no-results', 'archive' ); ?>
	<?php endif; ?>
							</div>
						</main><!-- #main -->
					</section><!-- #primary -->
				</div><!--/12 -->
<?php } ?>
        </div><!--/row -->
    </div><!--/content -->
</div><!--/container -->

<?php get_footer(); ?>