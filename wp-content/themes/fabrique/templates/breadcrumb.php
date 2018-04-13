<?php
/**
 * The template file
 *
 * @package fabrique/templates
 * @version 1.0.0
 */
?>

<?php
	if ( is_front_page() )
		return;

	$i = 1;
	$separator = fabrique_mod( 'breadcrumb_separator' ) ? fabrique_mod( 'breadcrumb_separator' ) : 'angle-right';
?>

<ul class="fbq-breadcrumb" itemprop="breadcrumb" itemscope="itemscope" itemtype="http://schema.org/BreadcrumbList">
	<li itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
		<a itemprop="item" href="<?php echo esc_url( get_home_url() ); ?>">
			<span itemprop="name"><?php echo esc_html__( 'Home', 'fabrique' ); ?></span>
		</a>
		<meta itemprop="position" content="<?php echo esc_attr( $i++ ); ?>" />
	</li>
	<?php fabrique_template_breadcrumb_separator( $separator ); ?>
	<?php if ( is_home() ) : ?>
		<li class="fbq-breadcrumb-current fbq-s-text-color">
			<?php esc_html_e( 'Blog', 'fabrique' ); ?>
		</li>
	<?php elseif ( is_archive() && !( is_tax() || is_category() || is_tag() || is_author() || is_year() || is_month() || is_day() ) ) : ?>
		<li class="fbq-breadcrumb-current fbq-s-text-color">
			<?php post_type_archive_title(); ?>
		</li>
	<?php elseif ( is_single() || ( is_archive() && ( is_tax() || is_category() || is_tag() ) ) ) : ?>
		<?php
			if ( is_single() ) {
				$term = fabrique_get_taxonomy()[0];
				$tax_name = $term->taxonomy;
				$post_type = get_post_type();
			} else {
				$term = get_queried_object();
				$tax_name = $term->taxonomy;
				$post_type = ( is_category() || is_tag() ) ? 'post' : fabrique_get_post_types_by_taxonomy( $tax_name )[0];
			}

			$label = ( 'post' === $post_type ) ? esc_html__( 'Blog', 'fabrique' ) : get_post_type_object( $post_type )->label;
			$parent = $term->parent;
			$parents = array();
			while ( $parent ) {
				$parent = get_term( $parent, $tax_name );
				$parents[] = $parent;
				$parent = $parent->parent;
			}
		?>
		<li itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
			<a itemprop="item" href="<?php echo esc_url( get_post_type_archive_link( $post_type ) ); ?>">
				<span itemprop="name"><?php echo fabrique_escape_content( $label ); ?></span>
			</a>
			<meta itemprop="position" content="<?php echo esc_attr( $i++ ); ?>" />
		</li>
		<?php fabrique_template_breadcrumb_separator( $separator ); ?>
		<?php if ( !empty( $parents ) ) : ?>
			<?php foreach ( array_reverse( $parents ) as $parent_obj ) : ?>
				<li itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="<?php echo esc_url( get_term_link( $parent_obj, $tax_name ) ); ?>">
						<span itemprop="name"><?php echo fabrique_escape_content( $parent_obj->name ); ?></span>
					</a>
					<meta itemprop="position" content="<?php echo esc_attr( $i++ ); ?>" />
				</li>
				<?php fabrique_template_breadcrumb_separator( $separator ); ?>
			<?php endforeach; ?>
		<?php endif; ?>
		<?php if ( is_single() ) : ?>
			<?php if ( $term ) : ?>
				<li itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
					<a href="<?php echo esc_url( get_term_link( $term, $tax_name ) ); ?>">
						<span itemprop="name"><?php echo fabrique_escape_content( $term->name ); ?></span>
					</a>
					<meta itemprop="position" content="<?php echo esc_attr( $i++ ); ?>" />
				</li>
				<?php fabrique_template_breadcrumb_separator( $separator ); ?>
			<?php endif; ?>
			<li class="fbq-breadcrumbs-current fbq-s-text-color">
				<span itemprop="name"><?php the_title(); ?></span>
			</li>
		<?php else : ?>
			<li class="fbq-breadcrumbs-current fbq-s-text-color">
				<span itemprop="name"><?php echo fabrique_escape_content( $term->name ); ?></span>
			</li>
		<?php endif; ?>
	<?php elseif ( is_page() ) : ?>
		<?php $post = get_post(); ?>
		<?php if ( $post->post_parent ) : ?>
			<?php $ancestors = array_reverse( get_post_ancestors( $post->ID ) ); ?>
			<?php foreach ( $ancestors as $ancestor ) : ?>
				<li itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="<?php echo esc_url( get_permalink( $ancestor ) ); ?>">
						<span itemprop="name"><?php echo get_the_title( $ancestor ); ?></span>
					</a>
					<meta itemprop="position" content="<?php echo esc_attr( $i++ ); ?>" />
				</li>
				<?php fabrique_template_breadcrumb_separator( $separator ); ?>
			<?php endforeach; ?>
		<?php endif; ?>
		<li class="fbq-breadcrumb-current fbq-s-text-color">
			<?php the_title(); ?>
		</li>
	<?php elseif ( is_author() ) : ?>
		<li class="fbq-breadcrumb-current fbq-s-text-color">
			<?php the_author_meta( 'display_name' ); ?>
		</li>
	<?php elseif ( is_search() ) : ?>
		<li class="fbq-breadcrumb-current fbq-s-text-color">
			<?php echo fabrique_mod( 'page_title_search_label' ) . get_search_query(); ?>
		</li>
	<?php elseif ( get_query_var( 'paged' ) ) : ?>
		<li class="fbq-breadcrumb-current fbq-s-text-color">
			<?php echo ( esc_html__( 'Page ', 'fabrique' ) . get_query_var( 'paged' ) ); ?>
		</li>
	<?php elseif ( is_day() || is_month() || is_year() ) : ?>
		<?php $year = get_the_time( 'Y' ); ?>
		<?php $year_link = get_year_link( $year ); ?>
		<?php $month = get_the_time( 'F' ); ?>
		<?php $day = get_the_time( 'j' ); ?>

		<?php if ( is_year() ) : ?>
			<li class="fbq-breadcrumb-current fbq-s-text-color">
				<?php echo esc_html( $year ); ?>
			</li>
		<?php elseif ( is_month() ) : ?>
			<li itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
				<a itemprop="item" href="<?php echo esc_url( $year_link ); ?>">
					<span itemprop="name"><?php echo esc_html( $year ); ?></span>
				</a>
				<meta itemprop="position" content="<?php echo esc_attr( $i++ ); ?>" />
			</li>
			<?php fabrique_template_breadcrumb_separator( $separator ); ?>
			<li class="fbq-breadcrumb-current fbq-s-text-color">
				<?php echo esc_html( $month ); ?>
			</li>
		<?php elseif ( is_day() ) : ?>
			<li itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
				<a itemprop="item" href="<?php echo esc_url( $year_link ); ?>">
					<span itemprop="name"><?php echo esc_html( $year ); ?></span>
				</a>
				<meta itemprop="position" content="<?php echo esc_attr( $i++ ); ?>" />
			</li>
			<?php fabrique_template_breadcrumb_separator( $separator ); ?>
			<li itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
				<a itemprop="item" href="<?php echo esc_url( get_month_link( $year, $month ) ); ?>">
					<span itemprop="name"><?php echo esc_html( $month ); ?></span>
				</a>
				<meta itemprop="position" content="<?php echo esc_attr( $i++ ); ?>" />
			</li>
			<?php fabrique_template_breadcrumb_separator( $separator ); ?>
			<li class="fbq-breadcrumb-current fbq-s-text-color">
				<?php echo esc_html( $day ); ?>
			</li>
		<?php endif; ?>
	<?php endif; ?>
</ul>
