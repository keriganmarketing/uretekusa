<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/blueprintblock' );
	$opts = fabrique_item_blueprintblock_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>
	<?php if ( !empty( $opts['blueprintblock_id'] ) && $opts['is_publish'] ) : ?>
		<?php $blocks = $opts['bp_data']['sections'][0]['blocks']; ?>
		<?php if ( !empty( $blocks ) && is_array( $blocks ) ) : ?>
			<?php foreach ( $blocks as $index => $block ) : ?>
				<?php
					$row_class = 'fbq-row';
					if ( isset( $block['gutter_space'] ) && !empty( $block['gutter_space'] ) ) {
						$row_class .= ' fbq-row--' . $block['gutter_space'];
					}
				?>
				<div class="<?php echo esc_attr( $row_class ); ?>">
					<?php if ( !empty( $block['spaces'] ) && is_array( $block['spaces'] ) ) : ?>
						<?php foreach ( $block['spaces'] as $space_index => $space ) : ?>
							<?php $layout = isset( $block['layout'] ) ? $block['layout'] : '1'; ?>
							<div class="<?php echo esc_attr( fabrique_space_class( $layout, $space_index ) ); ?>"><?php foreach ( $space['items'] as $item ) { fabrique_template_item( $item ); } ?></div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		<?php else : ?>
			<?php echo fabrique_get_dummy_template( esc_html__( 'blueprint block', 'fabrique' ), esc_html__( 'Selected blueprint block is empty.', 'fabrique' ) ); ?>
		<?php endif; ?>
	<?php else : ?>
		<?php echo fabrique_get_dummy_template( esc_html__( 'blueprint block', 'fabrique' ), esc_html__( 'Please select a blueprint block.', 'fabrique' ) ); ?>
	<?php endif; ?>
</div>
