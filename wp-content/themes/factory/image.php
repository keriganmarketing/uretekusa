<?php
/**
 * The template for displaying image attachments.
 *
 * @package commercegurus
 */
get_header();
?>
<div class="container">
    <div class="content">
        <div class="row row-eq-height">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div id="primary" class="content-area image-attachment">
                    <main id="main" class="site-main" role="main">
						<?php while ( have_posts() ) : the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<header class="entry-header">
									<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
									<div class="entry-meta">
										<?php
										$metadata = wp_get_attachment_metadata();
										printf( __( 'Published <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span> at <a href="%3$s">%4$s &times; %5$s</a> in <a href="%6$s" rel="gallery">%7$s</a>', 'factory' ), esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ), esc_url( wp_get_attachment_url() ), $metadata['width'], $metadata['height'], esc_url( get_permalink( $post->post_parent ) ), get_the_title( $post->post_parent )
										);

										?>
									</div><!-- .entry-meta -->

								</header><!-- .entry-header -->
								<div class="entry-content">
									<div class="entry-attachment">
										<div class="attachment">
											<?php factorycommercegurus_the_attached_image(); ?>


										</div><!-- .attachment -->
										<?php if ( has_excerpt() ) : ?>
											<div class="entry-caption">
												<?php the_excerpt(); ?>
											</div><!-- .entry-caption -->
										<?php endif; ?>
									</div><!-- .entry-attachment -->
									<?php
									the_content();
									wp_link_pages( array(
										'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'factory' ),
										'after'	 => '</div>',
									) );
									?>
								</div><!-- .entry-content -->
								<?php edit_post_link( esc_html__( 'Edit', 'factory' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
							</article><!-- #post-## -->
							<?php
								if ( comments_open() || '0' != get_comments_number() ) {
									comments_template();
								}
							?>

						<?php endwhile; // end of the loop. ?>
                    </main><!-- #main -->
                </div><!-- #primary -->
            </div><!--/12 -->

        </div><!--/content -->
    </div>
</div><!--/container -->

<?php get_footer(); ?>
