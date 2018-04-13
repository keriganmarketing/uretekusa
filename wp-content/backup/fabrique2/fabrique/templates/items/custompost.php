<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/custompost' );
	$opts = fabrique_item_custompost_options( $args );

	if ( is_single() ) {
		$opts['query_args']['post__not_in'] = array( get_the_ID() );
	}
?>

<?php if ( !empty( $opts['post_type'] ) ) : ?>
	<?php if ( post_type_exists( $opts['post_type'] ) ) : ?>
		<?php $query = new WP_Query( $opts['query_args'] ); ?>
		<?php if ( $query->have_posts() ): ?>
			<div <?php echo fabrique_a( $opts ); ?>>
				<?php if ( 'carousel' !== $opts['layout'] && $opts['filter'] ): ?>
					<?php fabrique_template_filter( $query, $opts['filter_args'] ); ?>
				<?php endif; ?>

				<div <?php echo fabrique_a( $opts['content_attr'] ); ?>>
					<?php while( $query->have_posts() ) : $query->the_post(); ?>
						<?php $opts['index'] = $query->current_post; ?>
						<?php fabrique_template( 'entry', $opts ); ?>
					<?php endwhile; ?>
				</div>

				<?php if ( 'carousel' !== $opts['layout'] && $opts['pagination'] ) : ?>
					<?php fabrique_template_pagination( $query, $opts ); ?>
				<?php endif; ?>

				<?php wp_reset_postdata(); ?>
			</div>
		<?php else : ?>
			<?php echo fabrique_get_dummy_template( esc_html__( 'custom post type', 'fabrique' ), esc_html__( 'Custom post type is now empty.', 'fabrique' ) ); ?>
		<?php endif; ?>
	<?php else : ?>
		<?php echo fabrique_get_dummy_template( esc_html__( 'custom post type', 'fabrique' ), esc_html__( 'Custom post type you entered does not exist.', 'fabrique' ) ); ?>
	<?php endif; ?>
<?php else : ?>
	<?php echo fabrique_get_dummy_template( esc_html__( 'custom post type', 'fabrique' ), esc_html__( 'Please input custom post type name.', 'fabrique' ) ); ?>
<?php endif; ?>
