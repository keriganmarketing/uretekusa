<?php
/**
 * Template Name: Full width page
 * @package commercegurus
 */

get_header();
?>

<div class="content-area">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'content', 'fullwidthpage' ); ?>
		<div class="container">
			<?php
				if ( comments_open() || '0' != get_comments_number() ) {
					comments_template();
				}
			?>
		</div>
	<?php endwhile; // end of the loop.   ?>
</div><!-- #primary -->
<?php get_footer(); ?>
