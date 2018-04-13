<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package commercegurus
 */

$allowed_args = array(
	//formatting
	'span' => array(
		'class' => array()
	),
);

if ( ! function_exists( 'factorycommercegurus_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function factorycommercegurus_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	$time_string = sprintf( $time_string, esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ), esc_attr( get_the_modified_date( 'c' ) ), esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
	esc_html_x( '%s', 'post date', 'factory' ), '' . $time_string . ''
	);

	$byline = sprintf(
	esc_html_x( 'by %s', 'post author', 'factory' ), '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="author-meta"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( !function_exists( 'factorycommercegurus_content_nav' ) ) :

	/**
	 * Display navigation to next/previous pages when applicable
	 */
	function factorycommercegurus_content_nav( $nav_id ) {
		global $wp_query, $post;

		// Don't print empty markup on single pages if there's nowhere to navigate.
		if ( is_single() ) {
			$previous	 = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
			$next		 = get_adjacent_post( false, '', false );

			if ( !$next && !$previous )
				return;
		}

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
			return;

		$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';
		?>
		<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo esc_attr( $nav_class ); ?>">
			<h1 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'factory' ); ?></h1>

			<?php if ( is_single() ) : // navigation links for single posts  ?>

				<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'factory' ) . '</span> %title' ); ?>
				<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'factory' ) . '</span>' ); ?>

			<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages  ?>

				<?php if ( get_next_posts_link() ) : ?>
					<div class="nav-previous"><?php next_posts_link( wp_kses( __( '<span class="meta-nav">&larr;</span> Older posts', 'factory' ), $allowed_args ) ); ?></div>
																		
				<?php endif; ?>

				<?php if ( get_previous_posts_link() ) : ?>
					<div class="nav-next"><?php previous_posts_link( wp_kses( __( 'Newer posts <span class="meta-nav">&larr;</span>', 'factory' ), $allowed_args )); ?></div>
				<?php endif; ?>

			<?php endif; ?>

		</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
		<?php
	}

endif; // factorycommercegurus_content_nav

if ( !function_exists( 'factorycommercegurus_comment' ) ) :

	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 */
	function factorycommercegurus_comment( $comment, $args, $depth ) {
	$allowed_args = array(
	//formatting
	'span' => array(
		'class' => array()
	),
	);
		$GLOBALS['comment'] = $comment;

		if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) :
			?>

			<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
				<div class="comment-body">
					<?php esc_html_e( 'Pingback:', 'factory' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( 'Edit', 'factory' ), '<span class="edit-link">', '</span>' ); ?>
				</div>

			<?php else : ?>

			<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent'  ); ?>>
				<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
					<footer class="comment-meta">
						<div class="comment-author vcard">
							<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
							<?php printf( wp_kses( '%s <span class="says">says:</span>', $allowed_args ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
						
						</div><!-- .comment-author -->

						<div class="comment-metadata">
							<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
								<time datetime="<?php comment_time( 'c' ); ?>">
									<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'factory' ), get_comment_date(), get_comment_time() ); ?>
								</time>
							</a>
							<?php edit_comment_link( esc_html__( 'Edit', 'factory' ), '<span class="edit-link">', '</span>' ); ?>
						</div><!-- .comment-metadata -->

						<?php if ( '0' == $comment->comment_approved ) : ?>
							<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'factory' ); ?></p>
						<?php endif; ?>
					</footer><!-- .comment-meta -->

					<div class="comment-content">
						<?php comment_text(); ?>
					</div><!-- .comment-content -->

					<?php
					comment_reply_link( array_merge( $args, array(
						'add_below'	 => 'div-comment',
						'depth'		 => $depth,
						'max_depth'	 => $args['max_depth'],
						'before'	 => '<div class="reply">',
						'after'		 => '</div>',
					) ) );
					?>
				</article><!-- .comment-body -->

			<?php
			endif;
		}

	endif; // ends check for cg_comment()

	if ( !function_exists( 'factorycommercegurus_the_attached_image' ) ) :

		/**
		 * Prints the attached image with a link to the next attached image.
		 */
		function factorycommercegurus_the_attached_image() {
			$post				 = get_post();
			$attachment_size	 = apply_filters( 'factorycommercegurus_attachment_size', array( 1200, 1200 ) );
			$next_attachment_url = wp_get_attachment_url();

			/**
			 * Grab the IDs of all the image attachments in a gallery so we can get the
			 * URL of the next adjacent image in a gallery, or the first image (if
			 * we're looking at the last image in a gallery), or, in a gallery of one,
			 * just the link to that image file.
			 */
			$attachment_ids = get_posts( array(
				'post_parent'	 => $post->post_parent,
				'fields'		 => 'ids',
				'numberposts'	 => -1,
				'post_status'	 => 'inherit',
				'post_type'		 => 'attachment',
				'post_mime_type' => 'image',
				'order'			 => 'ASC',
				'orderby'		 => 'menu_order ID'
			) );

			// If there is more than 1 attachment in a gallery...
			if ( count( $attachment_ids ) > 1 ) {
				foreach ( $attachment_ids as $attachment_id ) {
					if ( $attachment_id == $post->ID ) {
						$next_id = current( $attachment_ids );
						break;
					}
				}

				// get the URL of the next image attachment...
				if ( $next_id )
					$next_attachment_url = get_attachment_link( $next_id );

				// or get the URL of the first image attachment.
				else
					$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
			}

			printf( '<a href="%1$s" rel="attachment">%2$s</a>', esc_url( $next_attachment_url ), wp_get_attachment_image( $post->ID, $attachment_size )
			);
		}

	endif;


	/**
	 * Returns true if a blog has more than 1 category
	 */
	function factorycommercegurus_categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
			// Create an array of all the categories that are attached to posts
			$all_the_cool_cats = get_categories( array(
				'hide_empty' => 1,
			) );

			// Count the number of categories that are attached to the posts
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'all_the_cool_cats', $all_the_cool_cats );
		}

		if ( '1' != $all_the_cool_cats ) {
			// This blog has more than 1 category so factorycommercegurus_categorized_blog should return true
			return true;
		} else {
			// This blog has only 1 category so factorycommercegurus_categorized_blog should return false
			return false;
		}
	}

	/**
	 * Flush out the transients used in factorycommercegurus_categorized_blog
	 */
	function factorycommercegurus_category_transient_flusher() {
		// Like, beat it. Dig?
		delete_transient( 'all_the_cool_cats' );
	}

	add_action( 'edit_category', 'factorycommercegurus_category_transient_flusher' );
	add_action( 'save_post', 'factorycommercegurus_category_transient_flusher' );

// Wraps a span around category widget count
	add_filter( 'wp_list_categories', 'factorycommercegurus_add_span_cat_count' );

	function factorycommercegurus_add_span_cat_count( $links ) {
		$links	 = str_replace( '</a> (', '</a> <span class="count">(', $links );
		$links	 = str_replace( ')', ')</span>', $links );
		return $links;
	}

// Wraps a span around archive widget count
	add_filter( 'get_archives_link', 'factorycommercegurus_archive_count_no_brackets' );

	function factorycommercegurus_archive_count_no_brackets( $links ) {
		$links	 = str_replace( '</a>&nbsp;', '</a><span class="count">', $links );
		$links	 = str_replace( '', '</span>', $links );
		return $links;
	}

// Use shortcodes in text widgets.
	add_filter( 'widget_text', 'do_shortcode' );

	/* pagination */

	function factorycommercegurus_numeric_posts_nav() {

		if ( is_singular() ) {
			return;
		}

		global $wp_query;

		/** Stop execution if there's only 1 page */
		if ( $wp_query->max_num_pages <= 1 ) {
			return;
		}

		$paged	 = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
		$max	 = intval( $wp_query->max_num_pages );

		/** 	Add current page to the array */
		if ( $paged >= 1 )
			$links[] = $paged;

		/** 	Add the pages around the current page to the array */
		if ( $paged >= 3 ) {
			$links[] = $paged - 1;
			$links[] = $paged - 2;
		}

		if ( ( $paged + 2 ) <= $max ) {
			$links[] = $paged + 2;
			$links[] = $paged + 1;
		}

		echo '<div class="blog-pagination"><ul>' . "\n";

		/** 	Previous Post Link */
		if ( get_previous_posts_link() )
			printf( '<li class="prev">%s</li>' . "\n", get_previous_posts_link() );

		/** 	Link to first page, plus ellipses if necessary */
		if ( !in_array( 1, $links ) ) {
			$class = 1 == $paged ? ' class="active"' : '';

			printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

			if ( !in_array( 2, $links ) )
				echo '<li>…</li>';
		}

		/** 	Link to current page, plus 2 pages in either direction if necessary */
		sort( $links );
		foreach ( (array) $links as $link ) {
			$class = $paged == $link ? ' class="active"' : '';
			printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
		}

		/** 	Link to last page, plus ellipses if necessary */
		if ( !in_array( $max, $links ) ) {
			if ( !in_array( $max - 1, $links ) )
				echo '<li>…</li>' . "\n";

			$class = $paged == $max ? ' class="active"' : '';
			printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
		}

		/** 	Next Post Link */
		if ( get_next_posts_link() )
			printf( '<li class="next">%s</li>' . "\n", get_next_posts_link() );

		echo '</ul></div>' . "\n";
	}

// Display Header Cart
	if ( !function_exists( 'factorycommercegurus_header_cart' ) ) {

		function factorycommercegurus_header_cart() {
			if ( is_wc_active() ) {
				if ( is_cart() ) {
					$class = 'current-menu-item';
				} else {
					$class = '';
				}
				?>
				<ul class="cg-site-header-cart menu">
					<li class="<?php echo esc_attr( $class ); ?>">
			<?php factorycommercegurus_cart_link(); ?>
					</li>
						<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
				</ul>
					<?php
				}
			}

		}


// Cart Link
		if ( !function_exists( 'factorycommercegurus_cart_link' ) ) {

			function factorycommercegurus_cart_link() {
				?>
			<a class="cart-contents" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php esc_html_e( 'View your shopping cart', 'factory' ); ?>">
			<?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?> <span class="count"><?php echo wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'factory' ), WC()->cart->get_cart_contents_count() ) ); ?></span>
			</a>
				<?php
			}

		}

// Cart Link
		if ( !function_exists( 'factorycommercegurus_cart_link_fragment' ) ) {

			function factorycommercegurus_cart_link_fragment( $fragments ) {
				global $woocommerce;

				ob_start();

				factorycommercegurus_cart_link();

				$fragments['a.cart-contents'] = ob_get_clean();

				return $fragments;
			}

		}

// Display product search
		if ( !function_exists( 'factorycommercegurus_product_search' ) ) {

			function factorycommercegurus_product_search() {
				if ( is_wc_active() ) {
					?>
				<div class="site-search">
				<?php the_widget( 'WC_Widget_Product_Search', 'title=' ); ?>
				</div>
					<?php
				}
			}

		}

// Display regular search
		if ( !function_exists( 'factorycommercegurus_search' ) ) {

			function factorycommercegurus_search() {
					?>
				<div class="site-search">
				<?php the_widget( 'WP_Widget_Search', 'title=' ); ?>
				</div>
					<?php
				}
		}
		
// Get Post Author
		if ( !function_exists( 'factorycommercegurus_get_author_name' ) ) {

			function factorycommercegurus_get_author_name( $format = 'span' ) {
				$factorycommercegurus_author_name = get_the_author();
				if ( $factorycommercegurus_author_name ) {
					if ( $format == 'plain' ) {
						echo wp_kses_post( $factorycommercegurus_author_name) ;
					} else {
						echo '<span class="cg-blog-author author vcard"> ' . wp_kses_post( $factorycommercegurus_author_name ) . ' </span>';
					}
				}
			}

		}

// Get Number of Comments
		if ( !function_exists( 'factorycommercegurus_get_number_comments' ) ) {
			function factorycommercegurus_get_number_comments() {
				if ( comments_open() ) {
					?>
						<span class="comments"><a href="<?php comments_link(); ?>"><?php comments_number(); ?></a></span>
					<?php
				}
			}
		}
