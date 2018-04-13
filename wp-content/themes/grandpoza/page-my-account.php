<?php
#--------------------------------------------------------------------------------------#
/**
 * ----------------------------------
 * THE THEME'S WOOCOMMERCE MY ACCOUNT PAGE
 * @author KappStudio
 * @version 1.0
 * @package Grandpoza WP Theme
 * --------------------------------
 * */
#--------------------------------------------------------------------------------------#

get_header(); 

?>

<main id="mainContent" class="main-content">

    <?php get_template_part( "template-parts/content" , "page-cover" ); ?>

    <div class="container ptb-60">
        <?php 
        while ( have_posts() ) :
               the_post(); 
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php the_content(); ?>
        </article>

        <?php endwhile; ?>

    </div>
</main>

<?php get_footer(); ?>
