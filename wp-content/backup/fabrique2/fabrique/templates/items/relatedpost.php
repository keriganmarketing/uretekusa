<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$post_id = get_the_ID();
	$args = fabrique_template_args( 'items/relatedpost' );
	$opts = fabrique_item_relatedpost_options( $args, $post_id );
?>

<div <?php echo fabrique_a( $opts ); ?>>
	<?php if ( $opts['categories'] ) : ?>
		<?php $query = new WP_Query( $opts['relatedpost_query_args'] ); ?>
		<?php if ( $opts['heading_on'] ) : ?>
			<div class="fbq-relatedpost-heading">
				<?php fabrique_get_title( array( 'text' => $opts['heading'] ) ); ?>
			</div>
		<?php endif; ?>

		<?php if ( $query->have_posts() ): ?>
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<?php $current_post = $query->current_post; ?>
				<?php $is_list_style = ( 'list' === $opts['style'] ); ?>
				<?php $is_row_first = ( !$is_list_style && 0 == $current_post % $opts['no_of_columns'] ); ?>
				<?php $is_row_last = ( !$is_list_style &&
					( $current_post % $opts['no_of_columns'] == $opts['no_of_columns'] - 1 || ( int )( $query->query['posts_per_page'] ) - 1 == $current_post ||
					( ( ( int )$query->found_posts < ( int )( $query->query['posts_per_page'] ) || -1 == ( int )$query->query['posts_per_page'] ) && ( int )$query->found_posts - 1 == $current_post )
				) ); ?>

				<?php if ( 'list' === $opts['style'] || $is_row_first ) : ?>
					<div class="fbq-row">
				<?php  endif; ?>

					<div class="fbq-entry <?php echo esc_attr( $opts['entry_class'] ); ?>">
						<a href="<?php the_permalink(); ?>" class="fbq-entry-inner">

							<?php if ( $opts['thumbnail_on'] ): ?>
								<div class="fbq-entry-header">
									<div class="fbq-entry-media fbq-s-text-color">
										<?php
											$image_args = array(
												'image_id' => get_post_thumbnail_id( get_the_ID() ),
												'image_ratio' => $opts['image_ratio'],
												'image_size' => $opts['image_size'],
												'image_column_width' => $opts['column_size']
											);
											echo fabrique_template_media( $image_args );
										?>
									</div>
								</div>
							<?php endif; ?>
							<div class="fbq-entry-content">
								<h4 class="fbq-entry-title fbq-s-text-color fbq-secondary-font">
									<?php the_title(); ?>
								</h4>

								<?php if ( $opts['date_on'] ): ?>
									<div class="fbq-entry-date">
										<?php echo get_the_date(); ?>
									</div>
								<?php endif; ?>
							</div><?php // close entry content fbq-entry-content ?>
						</a><?php // close entry inner fbq-entry-inner ?>
					</div><?php // close entry fbq-entry ?>

				<?php if ( 'list' === $opts['style'] || $is_row_last ) : ?>
					</div><?php // close row fbq-row ?>
				<?php endif; ?>

			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		<?php else : ?>
			<div class="fbq-text fbq-center-align">
				<h3><?php esc_html_e( 'No related post.', 'fabrique' ); ?></h3>
			</div>
		<?php endif; ?>
	<?php endif; ?>
</div>
