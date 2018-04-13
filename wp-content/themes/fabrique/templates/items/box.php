<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/box' );
	$opts = fabrique_item_box_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>
	<?php fabrique_template_background( $opts ); ?>
	<div <?php echo fabrique_a( $opts['inner_attr'] ); ?>>
		<div class="fbq-box-content fbq-<?php echo esc_attr( $opts['vertical_align'] ); ?>-vertical" <?php echo fabrique_s( $opts['content_style'] ); ?>>
			<div class="fbq-box-body" <?php echo fabrique_s( $opts['body_style'] ); ?>>
				<?php if ( !empty( $opts['spaces'] ) && is_array( $opts['spaces'] ) ) : ?>
					<?php foreach( $opts['spaces'] as $space ) : ?>
						<?php if ( !empty( $space['items'] ) && is_array( $space['items'] ) ) : ?>
							<?php foreach( $space['items'] as $item ) : ?>
								<?php fabrique_template_item( $item ); ?>
							<?php endforeach; ?>
						<?php endif; ?>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
