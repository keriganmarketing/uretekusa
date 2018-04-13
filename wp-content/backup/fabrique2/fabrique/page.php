<?php
/**
 * The main template file
 *
 * @package fabrique
 * @version 1.0.0
 */
?>

<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
	<?php get_template_part( 'templates/page-content' ); ?>
<?php endwhile; ?>

<?php get_footer(); ?>
