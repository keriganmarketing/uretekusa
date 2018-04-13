<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/tab' );
	$opts = fabrique_item_tab_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>
	<ul <?php echo fabrique_a( $opts['nav_attr'] ); ?>>
		<?php if ( !empty( $opts['data'] ) && is_array( $opts['data'] ) ) : ?>
			<?php foreach ( $opts['data'] as $index => $data ) : ?>
				<?php
					$nav_list_attr = $opts['nav_list_attr'];
					if ( 0 == $index ) {
						$nav_list_attr['class'][] = 'active';
					}
				?>
				<li <?php echo fabrique_a( $nav_list_attr ); ?> data-index="<?php echo esc_attr( $index + 1 ); ?>">
					<?php if ( $opts['media_on'] && 'right' !== $opts['tab_position'] ): ?>
						<span class="fbq-tab-nav-media">
							<?php echo fabrique_template_media( $data ); ?>
						</span>
					<?php endif; ?>
					<span class="fbq-tab-nav-title">
						<?php echo do_shortcode( $data['label'] ); ?>
					</span>
					<?php if ( $opts['media_on'] && 'right' === $opts['tab_position'] ): ?>
						<span class="fbq-tab-nav-media">
							<?php echo fabrique_template_media( $data ); ?>
						</span>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		<?php endif; ?>
	</ul>
	<div class="<?php echo esc_attr( $opts['body_class'] ); ?>" <?php echo fabrique_s( $opts['body_style'] ); ?>>
		<?php fabrique_template_background( $opts ); ?>
		<div class="fbq-tab-wrapper">
			<?php if ( !empty( $opts['spaces'] ) && is_array( $opts['spaces'] ) ) : ?>
				<?php foreach ( $opts['spaces'] as $i => $space ) : ?>
					<?php
						$content_class = $opts['content_class'];
						if ( 0 == $i ) {
							$content_class .= ' active';
						}
					?>
					<div class="<?php echo esc_attr( $content_class ); ?>" data-index="<?php echo esc_attr( $i + 1 ); ?>">
						<div class="fbq-tab-pane">
							<?php if ( !empty( $space['items'] ) && is_array( $space['items'] ) ) : ?>
								<?php foreach ( $space['items'] as $item ) : ?>
									<?php fabrique_template_item( $item ); ?>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</div>
