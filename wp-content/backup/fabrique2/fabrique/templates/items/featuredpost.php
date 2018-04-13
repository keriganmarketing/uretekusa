<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/featuredpost' );
	$opts = fabrique_item_featuredpost_options( $args );
?>

<?php if ( 'header' === $opts['role'] ) : ?>
	<header <?php echo fabrique_a( $opts['header_attr'] ); ?>>
		<?php fabrique_template_background( $opts ); ?>
		<div class="<?php echo esc_attr( $opts['container_class'] ); ?>">
<?php endif; ?>

			<div <?php echo fabrique_a( $opts ); ?>>
				<?php if ( !empty( $opts['post_id'] ) ) : ?>
					<div <?php echo fabrique_a( $opts['content_attr'] ); ?>>

						<?php foreach ( $opts['post_id'] as $index => $post_id ) : ?>

								<?php if ( 'publish' === $opts['post_status'][$index] && !empty( $post_id ) ) : ?>
									<article class="fbq-entry">
										<div class="fbq-entry-inner fbq-p-border-border" <?php echo fabrique_s( $opts['entry_inner_style'] ); ?>>

											<div class="fbq-entry-header" <?php echo fabrique_s( $opts['header_style'][$index] ); ?>></div>
											<?php if ( 'overlay' === $opts['carousel_background_type'] ) : ?>
												<div class="fbq-overlay"></div>
											<?php endif; ?>
											<div class="fbq-entry-body" <?php echo fabrique_s( $opts['body_style'] ); ?>>
												<div class="fbq-entry-body-inner fbq-p-border-border">

													<?php if ( 'quote' === $opts['post_format'][$index] ) : ?>
														<a class="fbq-entry-content" href="<?php echo esc_url( $opts['post_link'][$index] ); ?>">
															<h2 <?php echo fabrique_a( $opts['title_attr'] ); ?>>
																<?php echo esc_html( $opts['post_meta'][$index]['quote'] ); ?>
															</h2>
															<div class="fbq-entry-author"><?php echo esc_html( $opts['post_meta'][$index]['author'] ); ?></div>
														</a>
													<?php else : ?>
														<?php if ( $opts['category_on'] ) : ?>
															<?php $category = get_the_category( $post_id ); ?>
															<?php if ( !empty( $category ) ) : ?>
																<div class="fbq-entry-category fbq-p-brand-color fbq-<?php echo esc_attr( $opts['meta_font'] ); ?>-font">
																	<?php the_category( ',&nbsp;', '', $post_id ); ?>
																</div>
															<?php endif; ?>
														<?php endif; ?>
														<div class="fbq-entry-content">
															<h2 <?php echo fabrique_a( $opts['title_attr'] ); ?>>
																<a href="<?php echo esc_url( $opts['post_link'][$index] ); ?>">
																	<?php echo fabrique_escape_content( $opts['post'][$index]->post_title ); ?>
																</a>
															</h2>
															<?php if ( $opts['author_on'] ) : ?>
																<div class="fbq-entry-author fbq-<?php echo esc_attr( $opts['meta_font'] ); ?>-font">
																	<i><?php esc_html_e( 'By', 'fabrique' ); ?></i>
																	<?php echo get_the_author_meta( 'display_name', $opts['post'][$index]->post_author ); ?>
																</div>
															<?php endif; ?>

															<?php if ( $opts['excerpt_on'] ) : ?>
																<?php $excerpt = !empty( $opts['post'][$index]->post_excerpt ) ? $opts['post'][$index]->post_excerpt : $opts['post'][$index]->post_content; ?>
																<?php if ( !empty( $excerpt ) ) : ?>
																	<div class="fbq-entry-excerpt">
																		<?php echo do_shortcode( $excerpt ); ?>
																	</div>
																<?php endif; ?>
															<?php endif; ?>
														</div><?php // close entry content fbq-entry-content ?>
													<?php endif; ?>
												</div><?php // close entry body inner fbq-entry-body-inner ?>
											</div><?php // close entry body fbq-entry-body ?>
										</div><?php // close entry inner fbq-entry-inner ?>
									</article><?php // close entry fbq-entry ?>
								<?php endif; ?>

						<?php endforeach; ?>
					</div><?php // close featuredpost content ?>
				<?php else : ?>
					<?php echo fabrique_get_dummy_template( esc_html__( 'featured post', 'fabrique' ), esc_html__( 'Please input post ID.', 'fabrique' ) ); ?>
				<?php endif; ?>
			</div><?php // close element ?>

<?php if ( 'header' === $opts['role'] ) : ?>
		</div><?php // close container ?>
	</header>
<?php endif; ?>
