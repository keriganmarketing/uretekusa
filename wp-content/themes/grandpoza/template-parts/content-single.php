<article <?php post_class(); ?> id="post-<?php echo get_the_ID(); ?>">
    <?php 

    the_content();

    wp_link_pages( array(
        'before' => '<div class="page-links mb-20">' . esc_html__( 'Pages:', 'grandpoza' ),
        'after'  => '</div>',
    ) );

    ?>
</article>