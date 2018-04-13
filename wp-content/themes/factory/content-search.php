<?php
/**
 * @package commercegurus
 */
?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="structured-metadata">
		<div class="entry-title"><?php factorycommercegurus_get_page_title(); ?></div>
		<div class="entry-posted"><?php factorycommercegurus_posted_on(); ?></div>
	</div>
					<div class="cg-blog-article">

					<header class="entry-header">

						<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>   
						
					</header><!-- .entry-header -->
					<?php if ( is_search() ) { // Only display Excerpts for Search   ?>
						<div class="entry-summary">
							<?php the_excerpt(); ?>
						</div><!-- .entry-summary -->
					<?php } else { ?>
						<div class="entry-content">
							<?php
							the_content( esc_html__( 'Read more', 'factory' ) );
							wp_link_pages( array(
								'before'		 => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'factory' ) . '</span>',
								'after'			 => '</div>',
								'link_before'	 => '<span>',
								'link_after'	 => '</span>',
							) );
							?>
						</div><!-- .entry-content -->
					<?php } ?>
					
				<footer class="entry-meta">
				</footer><!-- .entry-meta -->



					</div><!--/cg-blog-article -->
			    </article><!-- only-regular-post #post-## -->