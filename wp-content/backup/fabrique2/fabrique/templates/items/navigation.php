<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/navigation' );
	$opts = fabrique_item_navigation_options( $args );

	$taxonomy_name = fabrique_get_post_taxonomy_name();
	$prev_post = get_adjacent_post( $opts['same_term'], '', true, $taxonomy_name );
	$next_post = get_adjacent_post( $opts['same_term'], '', false, $taxonomy_name );
	$has_prev_post = !empty( $prev_post ) ? true : false;
	$has_next_post = !empty( $next_post ) ? true : false;
?>

<?php if ( $has_prev_post || $has_next_post ) : ?>
	<div <?php echo fabrique_a( $opts ); ?>>
		<?php if ( $has_prev_post ) : ?>
			<div class="fbq-navigation-previous">
				<div class="<?php echo esc_attr( $opts['link_class'] ); ?>">
					<?php previous_post_link(
						'%link',
						'<div class="fbq-navigation-content">
							<i class="twf twf-arrow-bold-left twf-lg"></i>%title
						</div>',
						$opts['same_term'],
						'',
						$taxonomy_name
					); ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( $has_next_post ) : ?>
			<div class="fbq-navigation-next">
				<div class="<?php echo esc_attr( $opts['link_class'] ); ?>">
					<?php next_post_link(
						'%link',
						'<div class="fbq-navigation-content">
							%title<i class="twf twf-arrow-bold-right twf-lg"></i>
					 	</div>',
						$opts['same_term'],
						'',
						$taxonomy_name
					); ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>
