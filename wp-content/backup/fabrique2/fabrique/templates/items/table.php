<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/table' );
	$opts = fabrique_item_table_options( $args );
?>


<div <?php echo fabrique_a( $opts ); ?>>
	<table>

		<?php if ( $opts['header_row'] ) : ?>
			<thead class="<?php echo esc_attr( implode( ' ', $opts['header_class'] ) ); ?>" <?php echo fabrique_s( $opts['header_style'] ); ?>>
				<tr>

					<?php foreach ( $opts['data_header'] as $data ) : ?>
						<th <?php echo fabrique_s( $opts['th_style'] ); ?>><?php echo do_shortcode( $data ); ?></th>
					<?php endforeach; ?>

				</tr>
			</thead>
		<?php endif; ?>

		<tbody class="fbq-p-brand-border" <?php echo fabrique_s( $opts['body_style'] ); ?>>

			<?php foreach ( $opts['formatted'] as $index => $row ) : ?>
				<tr class="fbq-table-body-row <?php echo esc_attr( $opts['tr_class'][$index] ); ?>" <?php echo fabrique_s( $opts['tr_style'][$index] ); ?>>

					<?php foreach ( $row as $i => $data ): ?>
						<td <?php echo fabrique_s( $opts['td_style'][$i] ); ?>><?php echo do_shortcode( $data ); ?></td>
					<?php endforeach; ?>

				</tr>
			<?php endforeach; ?>

		</tbody>
	</table>
</div>
