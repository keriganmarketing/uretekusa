<?php
/**
 * The Template for displaying all single posts.
 *
 * @package commercegurus
 */
$factorycommercegurus_post_sidebar = '';
$factorycommercegurus_post_sidebar = factorycommercegurus_getoption( 'factorycommercegurus_post_sidebar' );

get_header();
?>

<?php factorycommercegurus_get_page_title(); ?>

<div class="container">
    <div class="content">
        <div class="row row-eq-height">
			<?php if ( ( $factorycommercegurus_post_sidebar == 'default' ) || ( $factorycommercegurus_post_sidebar == '' ) ) { ?>
				<div class="col-lg-9 col-md-9 col-md-push-3 col-lg-push-3">
					<div id="primary" class="content-area">
						<main id="main" class="site-main" role="main">
							
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part( 'content', 'single' ); ?>
								<?php factorycommercegurus_content_nav( 'nav-below' ); ?>

								<?php
								// If comments are open or we have at least one comment, load up the comment template
								if ( comments_open() || '0' != get_comments_number() )
									comments_template();
								?>
							<?php endwhile; // end of the loop.  ?>
						</main><!-- #main -->
					</div><!-- #primary -->
				</div>
				<div class="col-lg-3 col-md-3 col-md-pull-9 col-lg-pull-9 sidebar">
					<?php get_sidebar(); ?>
				</div>
			<?php } else if ( $factorycommercegurus_post_sidebar == 'right' ) { ?>
				<div class="col-lg-9 col-md-9">
					<div id="primary" class="content-area">
						<main id="main" class="site-main" role="main">
							
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part( 'content', 'single' ); ?>
								<?php factorycommercegurus_content_nav( 'nav-below' ); ?>

								<?php
								// If comments are open or we have at least one comment, load up the comment template
								if ( comments_open() || '0' != get_comments_number() )
									comments_template();
								?>
							<?php endwhile; // end of the loop.  ?>
						</main><!-- #main -->
					</div><!-- #primary -->
				</div>
				<div class="col-lg-3 col-md-3 sidebar right">
					<?php get_sidebar(); ?>
				</div>
			<?php } else if ( $factorycommercegurus_post_sidebar == 'none' ) { ?>
				<div class="col-lg-12 col-md-12">
					<div id="primary" class="content-area">
						<main id="main" class="site-main" role="main">
	
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part( 'content', 'single' ); ?>
								<?php factorycommercegurus_content_nav( 'nav-below' ); ?>
								

								<?php
								// If comments are open or we have at least one comment, load up the comment template
								if ( comments_open() || '0' != get_comments_number() )
									comments_template();
								?>
							<?php endwhile; // end of the loop.  ?>
						</main><!-- #main -->
					</div><!-- #primary -->
				</div>
			<?php } ?>
        </div><!--/row -->
    </div><!--/content -->
</div><!--/container -->

<?php get_footer(); ?>