<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/comment' );
	$opts = fabrique_item_comment_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>
	<?php if ( comments_open() || get_comments_number() ): ?>
		<?php comments_template(); ?>
	<?php else : ?>
		<?php echo fabrique_get_dummy_template( esc_html__( 'comment', 'fabrique' ), esc_html__( 'Please activate comment.', 'fabrique' ) ); ?>
	<?php endif; ?>
</div>
