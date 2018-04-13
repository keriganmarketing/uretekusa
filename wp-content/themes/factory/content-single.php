<?php
/**
 * @package commercegurus
 */
?>
<?php 		
$allowed_args = array(
	//formatting
	'span' => array(
		'class' => array()
	),
);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="structured-metadata">
		<div class="entry-title"><?php factorycommercegurus_get_page_title(); ?></div>
		<div class="entry-posted"><?php factorycommercegurus_posted_on(); ?></div>
	</div>
    <div class="blog-meta">
		<span class="cg-blog-date">
			<?php factorycommercegurus_posted_on(); ?>
		</span> <?php factorycommercegurus_get_author_name(); ?> <?php echo factorycommercegurus_get_number_comments(); ?>
	</div>

    <div class="entry-content">
		<?php the_content(); ?>
		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'factory' ),
			'after'	 => '</div>',
		) );
		?>
    </div><!-- .entry-content -->
    <footer class="entry-meta">
		<?php
		/* translators: used between list items, there is a space after the comma */
		$category_list	 = get_the_category_list( esc_html__( ', ', 'factory' ) );

		/* translators: used between list items, there is a space after the comma */
		$tag_list = get_the_tag_list( '', esc_html__( ', ', 'factory' ) );

		if ( !factorycommercegurus_categorized_blog() ) {
			// This blog only has 1 category so we just need to worry about tags in the meta text
			if ( '' != $tag_list ) {
				$meta_text = wp_kses( __( '<span class="tags">%2$s</span>', 'factory' ), $allowed_args );
			} else {
				$meta_text = wp_kses( __( '<span class="tags">%2$s</span>', 'factory' ), $allowed_args );
			}
		} else {
			// But this blog has loads of categories so we should probably display them here
			if ( '' != $tag_list ) {
				$meta_text = wp_kses( __( '<span class="categories">%1$s</span> <span class="tags">%2$s</span>', 'factory' ), $allowed_args );
			} else {
				$meta_text = wp_kses( __( '<span class="categories">%1$s</span> <span class="tags">%2$s</span>', 'factory' ), $allowed_args );
			}
		} // end check for categories on this blog

		printf(
		$meta_text, $category_list, $tag_list, get_permalink()
		);
		?>

    </footer><!-- .entry-meta -->

</article><!-- #post-## -->
