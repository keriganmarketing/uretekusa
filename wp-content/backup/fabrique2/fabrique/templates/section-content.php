<?php
/**
 * The template file
 *
 * @package fabrique/templates
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'section-content' );
	$opts = fabrique_section_content_options( $args );
?>

<div <?php echo fabrique_a( $opts['section_attr'] ); ?>>
	<?php fabrique_template_background( $opts['section'], 'fbq-p-bg-bg' ); ?>
	<div <?php echo fabrique_a( $opts['section_wrapper_attr'] ); ?>><?php if ( !empty( $opts['section']['blocks'] ) && is_array( $opts['section']['blocks'] ) ) : ?>
		<?php if ( !$opts['sidebar'] ) : ?>
			<div class="<?php echo esc_attr( $opts['container_class'] ); ?>">
		<?php endif; ?>
		<?php foreach ( $opts['section']['blocks'] as $index => $block ) : ?>
			<?php
				$row_class = 'fbq-row fbq-row--main';
				if ( $opts['half_page_scroll'] ) {
					$row_class .= ' fbq-row--no-space';
				} elseif ( isset( $block['gutter_space'] ) && !empty( $block['gutter_space'] ) ) {
					$row_class .= ' fbq-row--' . $block['gutter_space'];
				}
			?>
			<div class="<?php echo esc_attr( $row_class ); ?>">
				<?php if ( !empty( $block['spaces'] ) && is_array( $block['spaces'] ) ) : ?>
					<?php foreach ( $block['spaces'] as $space_index => $space ) : ?>
						<?php $layout = isset( $block['layout'] ) ? $block['layout'] : '1'; ?>
						<div class="<?php echo esc_attr( fabrique_space_class( $layout, $space_index ) ); ?>"><?php if ( !empty( $space['items'] ) && is_array( $space['items'] ) ) { foreach ( $space['items'] as $item ) { fabrique_template_item( $item ); } } ?></div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
		<?php if ( !$opts['sidebar'] ) : ?>
			</div>
		<?php endif; ?>
	<?php endif; ?></div>
</div>
