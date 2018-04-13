<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/meta' );
	$opts = fabrique_item_meta_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>
	<ul class="fbq-meta-list">
	<?php foreach ( $opts['data'] as $index => $data ) : ?>
		<li class="fbq-meta-item">
			<?php if ( $opts['title_on'] || $opts['icon_on'] ) : ?>
				<div class="fbq-meta-header  fbq-<?php echo esc_attr( $opts['title_font'] ); ?>-font">
					<?php if ( $opts['icon_on'] ) : ?>
						<div class="fbq-meta-icon twf twf-<?php echo esc_attr( $data['icon'] ); ?>" <?php echo fabrique_s( $opts['icon_style'] ); ?>></div>
					<?php endif; ?>
					<?php if ( $opts['title_on'] ) : ?>
						<div class="fbq-meta-title" <?php echo fabrique_s( $opts['title_style'] ); ?>>
							<?php echo do_shortcode( $data['title'] ); ?>
						</div>
					<?php endif; ?>
				</div>
		<?php endif; ?>
			<div class="fbq-meta-body fbq-<?php echo esc_attr( $opts['detail_font'] ); ?>-font">
				<div class="fbq-meta-detail" <?php echo fabrique_s( $opts['detail_style'] ); ?>>
					<?php echo do_shortcode( $data['detail'] ); ?>
				</div>
			</div>
		</li>
	<?php endforeach; ?>
	</ul>
</div>
