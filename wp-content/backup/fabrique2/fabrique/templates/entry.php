<?php
/**
 * The template file
 *
 * @package fabrique/templates
 * @version 1.0.0
 */
?>


<?php
	$post_id = get_the_ID();
	$args = fabrique_template_args( 'entry' );
	$opts = fabrique_entry_options( $args, $post_id );
	$title = get_the_title();
	$excerpt = get_the_excerpt();
	$excerpt = fabrique_limit_excerpt( $excerpt, $opts['excerpt_length'] );
	$post_taxonomy = fabrique_get_taxonomy( $opts['post_taxonomy'] );
	$categories = fabrique_term_names( $post_taxonomy );
	$article_filter = implode( ', ', $categories['slug'] );
?>

<article <?php post_class( $opts['entry_class'] ); ?> <?php echo fabrique_s( $opts['entry_style'] ) . ' data-filter="' . esc_attr( strtolower( $article_filter ) ) . '"'; ?>>
	<div <?php echo fabrique_a( $opts['inner_attr'] ); ?>>
		<?php if ( ( $opts['media_on'] || 'gradient' === $opts['style'] ) && $opts['featured_media_args']['image_id'] ) : ?>
			<div class="fbq-entry-header" <?php echo fabrique_s( $opts['header_style'] ); ?>>
				<?php $opts['media_empty_available'] = ( 'list' === $opts['layout'] ) ? false : true; ?>
				<?php fabrique_template_featured_media( $opts['featured_media_args'] ); ?>
				<?php if ( $opts['addtocart_on'] && 'gradient' !== $opts['style'] ) : ?>
					<div class="fbq-entry-addtocart">
						<a class="fbq-entry-overlay fbq-s-bg-bg" href="<?php echo esc_url( $opts['permalink'] ) ; ?>" target="<?php echo esc_attr( $opts['link_target'] ); ?>"></a>
						<?php woocommerce_template_loop_add_to_cart(); ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="fbq-entry-body" <?php echo fabrique_s( $opts['body_style'] ); ?>>
			<div class="fbq-entry-body-inner">
				<div class="fbq-entry-body-content">
					<?php if ( $opts['date_on'] || $opts['author_on'] || $opts['tag_on'] || ( $opts['category_on'] && !empty( $categories['link'] ) ) || $opts['comment_on'] ) : ?>
						<div class="fbq-entry-meta fbq-<?php echo esc_attr( $opts['meta_font'] ); ?>-font">
							<?php if ( $opts['category_on']  ) : ?>
								<div class="fbq-entry-category fbq-p-brand-color">
									<?php echo fabrique_escape_content( implode( ',&nbsp;', $categories['link'] ) ); ?>
								</div>
							<?php endif; ?>
							<?php if ( $opts['date_on'] ) : ?>
								<div class="fbq-entry-date">
									<?php echo get_the_date( apply_filters( 'fabrique_entry_date_format', 'F j, Y' ) ); ?>
								</div>
							<?php endif; ?>

							<?php if ( $opts['author_on'] ) : ?>
								<div class="fbq-entry-author">
									<?php the_author_posts_link(); ?>
								</div>
							<?php endif; ?>

							<?php if ( $opts['tag_on'] ) : ?>
								<?php $tags = get_the_term_list( $post_id, $opts['post_tag'], '', ', ', '' ); ?>
								<?php if ( $tags ) : ?>
									<div class="fbq-entry-tag">
										<i class="twf twf-bookmark-o"></i>
										<?php echo fabrique_escape_content( $tags ); ?>
									</div>
								<?php endif; ?>
							<?php endif; ?>

							<?php if ( $opts['comment_on'] ) : ?>
								<?php $comments = get_comments_number(); ?>
								<?php if ( 1 <= $comments ) : ?>
									<div class="fbq-entry-comment">
										<i class="twf twf-comment-o"></i>
										<?php echo esc_html( $comments ); ?>
										<?php ( 1 == $comments ) ? esc_html_e( ' comment', 'fabrique' ) : esc_html_e( ' comments', 'fabrique' ); ?>
									</div>
								<?php endif; ?>
							<?php endif; ?>

						</div><?php // close entry meta ?>
					<?php endif; ?>

					<?php if ( $opts['title_on'] && !empty( $title ) ) : ?>
						<h4 <?php echo fabrique_a( $opts['title_attr'] ); ?>>
							<a href="<?php echo esc_url( $opts['permalink'] ) ; ?>" target="<?php echo esc_attr( $opts['link_target'] ); ?>">
								<?php echo fabrique_escape_content( $title ); ?>
							</a>
							<?php if ( $opts['posttype_on'] ) : ?>
								<span class="fbq-enty-posttype">
									<?php $post_type_object = get_post_type_object( get_post_type() ); ?>
									<?php echo esc_html( $post_type_object->labels->singular_name ); ?>
								</span>
							<?php endif; ?>
						</h4>
					<?php endif; ?>

					<?php $rating = fabrique_get_average_ratings( $post_id ); ?>
					<?php if ( $opts['price_on'] || ( $rating && $opts['rating_on'] ) ) : ?>
						<div <?php echo fabrique_a( $opts['price_attr'] ); ?>>
							<?php
								if ( $opts['price_on'] ) {
									woocommerce_template_loop_price();
								}
							?>
							<?php if ( $rating && $opts['rating_on'] ) : ?>
								<div class="comment-rating">
									<span style="width:<?php echo esc_attr( $rating/5*100 ); ?>%;">
										<strong><?php echo esc_html( $rating ); ?></strong>
										<?php esc_html_e( ' out of ', 'fabrique' ); ?>
										<span>5</span>
									</span>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>

					<?php if ( $opts['excerpt_on'] ) : ?>
						<?php if ( 'content' === $opts['excerpt_content'] ) : ?>
							<?php $content = get_the_content(); ?>
							<?php if ( !empty( $content ) ) : ?>
								<div class="fbq-entry-excerpt"><?php the_content( esc_html( $opts['more_message'] ) ); ?></div>
							<?php endif; ?>
						<?php else : ?>
							<?php if ( !empty( $excerpt ) ) : ?>
								<div class="fbq-entry-excerpt"><?php echo do_shortcode( $excerpt ); ?></div>
							<?php else : ?>
								<?php $content = get_the_content(); ?>
								<?php if ( !empty( $content ) ) : ?>
									<div class="fbq-entry-excerpt"><?php the_content( esc_html( $opts['more_message'] ) ); ?></div>
								<?php endif; ?>
							<?php endif; ?>
						<?php endif; ?>
					<?php endif; ?>

					<?php if ( $opts['link_on'] ) : ?>
						<div class="fbq-entry-link fbq-p-brand-color <?php echo esc_attr( $opts['more_icon_position'] ); ?>">
							<a href="<?php echo esc_url( $opts['permalink'] ) ?>" target="<?php echo esc_attr( $opts['link_target'] ); ?>">
								<?php if ( $opts['more_icon_position'] === 'before' ) : ?>
									<i class="twf twf-arrow-bold-right-up"></i>
									<?php echo do_shortcode( $opts['more_message'] ); ?>
								<?php else : ?>
									<?php echo do_shortcode( $opts['more_message'] ); ?>
									<i class="twf twf-arrow-bold-right-up"></i>
								<?php endif; ?>
							</a>
						</div>
					<?php endif; ?>
					<?php if ( $opts['addtocart_on'] && 'gradient' === $opts['style'] ) : ?>
						<div class="fbq-entry-addtocart">
							<?php woocommerce_template_loop_add_to_cart(); ?>
						</div>
					<?php endif; ?>
				</div><?php // close entry body content ?>
			</div><?php // close entry body inner ?>
		</div><?php // close entry body ?>
		<?php if ( 'product' === $opts['post_type'] ) : ?>
			<?php woocommerce_show_product_loop_sale_flash(); ?>
		<?php endif; ?>
		<?php if ( is_sticky() ) : ?>
			<div class="fbq-sticky-tag fbq-p-brand-bg fbq-p-brand-contrast-color"><?php esc_html_e( 'Featured', 'fabrique' ); ?></div>
		<?php endif; ?>
	</div><?php // close entry inner ?>
</article><?php // close entry ?>
