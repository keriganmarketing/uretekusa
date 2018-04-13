<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/text' );
	$opts = fabrique_item_text_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>
	<div class="fbq-row" <?php echo fabrique_s( $opts['row_style'] ); ?>>

		<?php foreach ( $opts['data'] as $index => $data ) : ?>
			<div class="fbq-text-content <?php echo esc_attr( $opts['item_class'][$index] ); ?>" <?php echo fabrique_s( $opts['content_style'] );?>>
				<div class="fbq-text-content-inner">
					<?php if ( $opts['bullet'] ) : ?>
						<?php
							$filter_text = str_replace( '<br></span>', '</span>', $data['text'] );
							$filter_text = str_replace( '<br></a>', '</a><br>', $filter_text );
							$content_array = explode( '<br>', $filter_text );
							$span_tag = array();
							$close_span_tag = array();
							$bullet = str_replace( '<br>', '</li><li>', $filter_text );

							if ( '<span' === substr( $bullet, 0, 5 ) ) {
								$close_span_position = strpos( $bullet, '>' );
								$first_span = substr( $bullet, 0, $close_span_position + 1 );

								if ( strpos( $first_span, 'font-size' ) !== false ) {
									$bullet = $first_span;
									$bullet .= '<ul class="fbq-text-bullet fbq-p-border-border ' . esc_attr( $opts['bullet_style'] ) . '"><li>' . fabrique_escape_content( substr( $bullet, $close_span_position + 1, -7 ) ) . '</li></ul>';
									$bullet .= '</span>';
								} else {
									$bullet = '<ul class="fbq-text-bullet fbq-p-border-border ' . esc_attr( $opts['bullet_style'] ) . '"><li>' . fabrique_escape_content( $bullet ) . '</li></ul>';
								}
							} else {
								$bullet = '<ul class="fbq-text-bullet fbq-p-border-border ' . esc_attr( $opts['bullet_style'] ) . '"><li>' . fabrique_escape_content( $bullet ) . '</li></ul>';
							}

							$bullet = str_replace( '<li></li>', '', $bullet );
							echo do_shortcode( html_entity_decode( $bullet ) );
						?>
					<?php else : ?>
						<?php echo do_shortcode( $data['text'] ); ?>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>

	</div>
</div>
