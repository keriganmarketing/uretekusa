<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/instagram' );
	$opts = fabrique_item_instagram_options( $args );
?>

<?php if ( function_exists( 'fabrique_core_scrape_instagram' ) ) : ?>
	<?php
		$ig_images = fabrique_core_scrape_instagram( $opts['username'], $opts['access_token'], (int)$opts['no_of_query'] );
		$enable_pagination = $opts['pagination'] && 'carousel' !== $opts['style'];
	?>
	<?php if ( $ig_images && is_array( $ig_images ) ) : ?>
		<div <?php echo fabrique_a( $opts ); ?>>
			<?php
				// random order
				if ( $opts['random_order'] ) {
					shuffle( $ig_images );
				}

				// filter image from hashtag & get image tags to display in filter bar
				$filter_bar_tags = array();
				if ( !empty( $opts['hashtag'] ) || $opts['filter'] ) {
					$hashtags = explode( ',', str_replace( ' ', '', $opts['hashtag'] ) );
					$hashtags_count = count( $hashtags );
					$filtered_images = array();
					$filter_index = 0;
					foreach ( $ig_images as $ig_image ) {
						if ( empty( $opts['hashtag'] ) || ( $hashtags_count == count( array_intersect( $hashtags, $ig_image['tags'] ) ) ) ) {
							$filtered_images[] = $ig_image;
							if ( $enable_pagination ) {
								if ( $filter_index < $opts['no_of_items'] ) {
									$filter_bar_tags = array_merge( $ig_image['tags'], $filter_bar_tags );
									$filter_index++;
								}
							} else {
								$filter_bar_tags = array_merge( $ig_image['tags'], $filter_bar_tags );
							}
						}
					}
					$ig_images = $filtered_images;
				}

				// get filter bar argument
				if ( 'carousel' !== $opts['style'] && $opts['filter'] && !empty( $filter_bar_tags ) ) {
					if ( 'char_asc' === $opts['filter_sorting'] ) {
						natcasesort( $filter_bar_tags );
					} elseif ( 'char_desc' === $opts['filter_sorting'] ) {
						natcasesort( $filter_bar_tags );
						$filter_bar_tags = array_reverse( $filter_bar_tags );
					}

					$filter_bar_args = array(
						'base_class' => 'js-filter-list fbq-p-text-color',
						'filter_disable_all' => $opts['filter_disable_all'],
						'filter_alignment' => $opts['filter_alignment'],
						'filter_initial' => '',
						'categories' => array_unique( $filter_bar_tags )
					);
					fabrique_template_partial( 'filter', $filter_bar_args );
				}

				// for pagination
				$all_posts = sizeof( $ig_images );
				if ( get_query_var( 'paged' ) ) {
					$paged = get_query_var( 'paged' );
				} else if ( get_query_var( 'page' ) ) {
					$paged = get_query_var( 'page' );
				} else {
					$paged = 1;
				}

				$opts['query_args'] = array(
					'posts' => $ig_images,
					'all_posts' => $all_posts,
					'paged' => $paged
				);

				if ( !empty( $opts['no_of_items'] ) && 0 != (int)( $opts['no_of_items'] ) ) {
					$opts['query_args']['posts_per_page'] = $opts['no_of_items'];
					$opts['query_args']['max_num_page'] = ceil( $all_posts / $opts['no_of_items'] );
				}

				$images = $enable_pagination ? array_slice( $ig_images, ( $opts['query_args']['paged'] - 1 ) * $opts['no_of_items'], $opts['no_of_items'] ) : $ig_images;
			?>
			<div <?php echo fabrique_a( $opts['content_attr'] ); ?>>
				<?php
					foreach ( $images as $index => $image ) {
						$opts['image'] = $image;
						$opts['image_index'] = $index;
						// to link with
						$query_post_args = $opts['query_post_args'];
						if ( !empty( $opts['link_taxonomy'] ) && !empty( $image['tags'] ) ) {
							$query_post_args['tax_query'] = array(
								'relation' => 'OR',
								array(
									'taxonomy' => $opts['link_taxonomy'],
									'field' => 'slug',
									'terms' => array_values( $image['tags'] )
								)
							);
						}
						$post_query = new WP_Query( $query_post_args );
						if ( !$post_query->have_posts() ) {
							$post_query = new WP_Query( $opts['query_post_args'] );
						} // fall back when can't find post from tags

						if ( $post_query->have_posts() ) {
							$posts = $post_query->posts;
							$opts['post'] = $posts[0];
							$opts['query_post_args']['post__not_in'][] = $opts['post']->ID;
						}
						wp_reset_postdata();
						fabrique_template( 'entry-instagram.php', $opts );
						unset( $opts['post'] );
					}
				?>
			</div>
			<?php if ( $enable_pagination ) : ?>
				<?php fabrique_template_pagination( $opts['query_args'], $opts ); ?>
			<?php endif; ?>
		</div>
	<?php else : ?>
		<?php echo fabrique_get_dummy_template( esc_html__( 'There is an error with instagram', 'fabrique' ) ); ?>
	<?php endif; ?>
<?php else : ?>
	<?php echo fabrique_get_dummy_template( esc_html__( 'Please activate core plugin', 'fabrique' ) ); ?>
<?php endif; ?>
