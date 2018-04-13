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
	<?php $post_id = get_the_ID(); ?>
	<?php $opts = fabrique_post_options( array(), $post_id ); ?>

	<?php if ( $opts['blueprint_active'] && !post_password_required() ) : ?>
		<?php fabrique_template( 'blueprint-content.php', $opts ); ?>
	<?php else: ?>
		<main <?php echo fabrique_a( $opts ); ?>>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'fbq-content-wrapper' ); ?>>
				<div class="<?php echo esc_attr( implode( ' ', $opts['layout_class'] ) ); ?>">
					<?php //Fullwidth size featured media ?>
					<?php if ( 'fullwidth' === $opts['featured_media_layout'] ) : ?>
						<div <?php echo fabrique_a( $opts['featured_media_attr'] ); ?>>
							<?php fabrique_template( 'page-title.php', $opts['breadcrumb_args'] ); ?>
							<?php if ( 'standard' === $opts['featured_post_format'] ) : ?>
								<?php // Standard Post Format use background as featured image ?>
								<?php fabrique_template_background( $opts['featured_background_attr'] ); ?>
								<?php // If gradient then title is on background ?>
								<?php if ( 'fullwidth' === $opts['featured_media_layout'] ) : ?>
									<div class="fbq-post-headline fbq-<?php echo esc_attr( $opts['header_alignment'] ); ?>-align">
										<div class="fbq-container">
											<div class="fbq-post-headline-inner">
												<div class="fbq-post-headline-content">
													<?php fabrique_template_partial( 'post-meta', $opts ); ?>
												</div>
											</div>
										</div>
									</div>
								<?php endif; ?>
							<?php else : ?>
								<?php // If not standard post format then use normal featured media ?>
								<?php fabrique_template_featured_media( $opts['featured_media_args'] ); ?>
							<?php endif; ?>
						</div>
					<?php endif; ?>

					<?php if ( 'fullwidth' !== $opts['featured_media_layout'] ) : ?>
						<?php fabrique_template( 'page-title.php', $opts['breadcrumb_args'] ); ?>
					<?php endif; ?>

					<div class="fbq-container js-dynamic-navbar"><?php // open container ?>
						<?php // If no sidebar ?>
						<?php if ( !$opts['sidebar'] ) : ?>
							<?php // Non fullwidth featured media size or not standard post format ?>
							<?php if ( 'fullwidth' !== $opts['featured_media_layout'] || ( 'fullwidth' === $opts['featured_media_layout'] && 'standard' !== $opts['featured_post_format'] ) ) : ?>
								<div class="fbq-post-headline fbq-<?php echo esc_attr( $opts['header_alignment'] ); ?>-align">
									<?php fabrique_template_partial( 'post-meta', $opts ); ?>
								</div>
							<?php endif; ?>
							<?php if ( 'standard' === $opts['featured_media_layout'] ) : ?>
								<div <?php echo fabrique_a( $opts['featured_media_attr'] ); ?>>
									<?php fabrique_template_featured_media( $opts['featured_media_args'] ); ?>
								</div>
							<?php endif; ?>
						<?php endif; ?>

						<div class="<?php echo esc_attr( fabrique_main_page_class( $opts['sidebar'], $opts['sidebar_position'], $opts['sidebar_background_color'] ) ); ?>"><?php // start main ?>
							<?php // If has sidebar and not gradient standard type ?>
							<?php if ( $opts['sidebar'] && !( 'standard' === $opts['featured_post_format'] && 'fullwidth' === $opts['featured_media_layout'] ) ) : ?>
								<div class="fbq-post-headline fbq-<?php echo esc_attr( $opts['header_alignment'] ); ?>-align">
									<?php fabrique_template_partial( 'post-meta', $opts ); ?>
								</div>
								<?php // standard layout then add normal featured media ?>
								<?php if ( 'standard' === $opts['featured_media_layout'] ) : ?>
									<div <?php echo fabrique_a( $opts['featured_media_attr'] ); ?>>
										<?php fabrique_template_featured_media( $opts['featured_media_args'] ); ?>
									</div>
								<?php endif; ?>
							<?php endif; ?>

							<div class="fbq-main-wrapper"><?php // start main wrapper ?>
								<?php // begin main post part ?>
								<div class="fbq-post-body">

								<?php $content = get_the_content(); ?>
								<?php if ( !empty( $content ) ) : ?>
									<?php // content part ?>
									<div class="fbq-post-content" itemprop="text">
										<?php the_content(); ?>
										<?php wp_link_pages(); ?>
									</div>
								<?php endif; ?>

								<?php // tag part ?>
								<?php if ( $opts['tag'] ) : ?>
									<?php $tags = fabrique_term_names( fabrique_get_taxonomy( '', true ), 'fbq-s-bg-bg fbq-p-text-color fbq-p-brand-bg-hover' ); ?>
									<?php if ( !empty( $tags['name'] ) ) : ?>
										<div class="fbq-post-tag with-margin fbq-<?php echo esc_attr( apply_filters( 'single_post_tag_font', 'secondary' ) ); ?>-font">
											<span itemprop="keywords"><?php echo fabrique_escape_content( implode( '', $tags['link'] ) ); ?></span>
										</div>
									<?php endif; ?>
								<?php endif; ?>

								<?php if ( $opts['social'] || $opts['print_button'] ) : ?>
									<div class="fbq-post-control">
										<?php // social share bottom part ?>
										<?php if ( $opts['social'] ) : ?>
											<div class="fbq-post-share fbq-post-share--bottom fbq-s-text-color fbq-share fbq-share--icon">
												<?php fabrique_template_share( $opts['social_args'] ); ?>
											</div>
										<?php endif; ?>
										<?php if ( $opts['print_button'] ) : ?>
											<div class="fbq-post-control-button fbq-p-text-color">
												<a href="#" class="fbq-post-print fbq-p-text-color fbq-p-text-border">
													<i class="twf twf-print"></i><?php esc_html_e( 'Print', 'fabrique' ); ?>
												</a>
												<a class="fbq-post-email fbq-p-text-color" href="mailto:?subject=<?php echo get_the_title(); ?>&amp;body=<?php echo esc_html__( 'Check out this site', 'fabrique' ); ?>-<?php echo esc_url( get_permalink() ); ?>">
													<i class="twf twf-envelope-o"></i><?php esc_html_e( 'Email', 'fabrique' ); ?>
												</a>
											</div>
										<?php endif; ?>
									</div>
								<?php endif; ?>

								<?php // author box part ?>
								<?php if ( $opts['author_box'] ) : ?>
									<div class="fbq-post-authorbox fbq-s-bg-bg fbq-p-border-border" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person">
										<div class="fbq-author-avatar image-circle" itemprop="image">
											<?php echo get_avatar( get_the_author_meta( 'ID' ), 60 ); ?>
										</div>
										<div class="fbq-author-body">
											<h4 itemprop="name"><?php echo get_the_author_meta( 'display_name' ); ?></h4>
											<p itemprop="description"><?php echo get_the_author_meta( 'description' ); ?></p>
										</div>
									</div>
								<?php endif; ?>

								</div><?php // Close post body ?>

							<?php // post navigation part ?>
							<?php if ( $opts['navigation'] ) : ?>
								<?php fabrique_template_item( $opts['nav_args'] ); ?>
							<?php endif; ?>

					<?php if ( !$opts['sidebar'] ) : ?>
						<?php // If no sidebar then comment and related post are outside container ?>
								</div><?php // Close main wrapper ?>
							</div><?php // Close fbq-main ?>
						</div><?php // Close container ?>

						<?php // comment part ?>
						<?php if ( comments_open() || get_comments_number() ): ?>
							<div <?php echo fabrique_a( $opts['comment_attr'] ); ?>>
								<div class="fbq-container js-dynamic-navbar">
									<div class="fbq-comment-inner">
										<?php comments_template(); ?>
									</div>
								</div>
							</div>
						<?php endif; ?>

						<?php // related post part ?>
						<?php if ( $opts['related'] ) : ?>
							<div <?php echo fabrique_a( $opts['related_attr'] ); ?>>
								<div class="fbq-container js-dynamic-navbar">
									<?php fabrique_template_item( $opts['related_post_args'] ); ?>
								</div>
							</div>
						<?php endif; ?>
					<?php else : ?><?php // if has sidebar comment and related post are inside container ?>
						<?php // comment part ?>
						<?php if ( comments_open() || get_comments_number() ): ?>
							<div <?php echo fabrique_a( $opts['comment_attr'] ); ?>>
								<?php comments_template(); ?>
							</div>
						<?php endif; ?>

						<?php // related post part ?>
						<?php if ( $opts['related'] ) : ?>
							<?php fabrique_template_item( $opts['related_post_args'] ); ?>
						<?php endif; ?>

							</div><?php // Close main wrapper ?>
						</div><?php // Close fbq-main ?>

						<?php // sidebar part ?>
						<aside class="<?php echo fabrique_sidebar_class( $opts['sidebar_position'], $opts['sidebar_fixed'], $opts['sidebar_color_scheme'] ); ?>" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
							<?php fabrique_template_sidebar_background( $opts['sidebar_background_color'] ); ?>
							<?php if ( is_active_sidebar( $opts['sidebar_id'] ) ) : ?>
								<div class="fbq-widgets">
									<ul class="fbq-widgets-list">
										<?php dynamic_sidebar( $opts['sidebar_id'] ); ?>
									</ul>
								</div>
							<?php endif; ?>
						</aside>
					</div><?php // Close container ?>
					<?php endif; ?><?php // end if sidebar ?>
				</div><?php // Close fbq-post ?>
			</article>
		</main>
	<?php endif; ?>
<?php endwhile; ?>

<?php get_footer(); ?>
