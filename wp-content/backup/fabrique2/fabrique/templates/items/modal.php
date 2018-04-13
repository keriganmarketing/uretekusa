<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/modal' );
	$opts = fabrique_item_modal_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>
	<div class="fbq-modal-inner" <?php echo fabrique_s( $opts['inner_style'] ); ?>>
		<div class="fbq-modal-overlay js-close"></div>
		<div class="fbq-modal-wrapper" <?php echo fabrique_s( $opts['wrapper_style'] ); ?>>
			<?php fabrique_template_background( $opts, 'fbq-p-bg-bg' ); ?>
			<div class="fbq-modal-content">
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
	<div class="fbq-modal-close js-close"><i class="twf twf-ln-cross"></i></div>
</div>
