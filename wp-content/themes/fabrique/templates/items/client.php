<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/client' );
	$opts = fabrique_item_client_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>
	<div <?php echo fabrique_a( $opts['content_attr'] ); ?>>
		<?php foreach ( $opts['formatted'] as $i => $row ) : ?>
			<?php if ( 'grid' === $opts['style'] ) : ?>
				<?php
					if ( $i == ceil( $opts['no_of_items'] / $opts['no_of_columns'] ) - 1 ) {
						$row_style = array( 'margin' => '0 '. -$opts['spacing'] / 2 .'px' );
					} else {
						$row_style = array( 'margin' => '0 '. -$opts['spacing'] / 2 .'px ' . $opts['spacing'] . 'px' );
					}
				?>
				<div class="fbq-row" <?php echo fabrique_s( $row_style ); ?>>
			<?php endif; ?>

				<?php foreach ( $row as $index => $data ): ?>
					<?php
						$data['image_hover'] = $opts['image_hover'];
						$data['image_column_width'] = $opts['column_width'];
					?>
					<div <?php echo fabrique_a( $opts['item_attr'] );?>>
						<div class="fbq-client-media">
							<?php echo fabrique_template_media( $data ); ?>
						</div>
					</div>
				<?php endforeach; ?>

			<?php if ( 'grid' === $opts['style'] ) : ?>
				</div><?php // close row ?>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
</div>
