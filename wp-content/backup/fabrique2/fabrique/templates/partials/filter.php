<?php
/**
 * Partial template file
 *
 * @package fabrique/templates/partials
 * @version 1.0.0
 */
?>


<?php $opts = fabrique_template_args( 'filter' ); ?>

<ul class="fbq-filter-bar fbq-<?php echo esc_attr( $opts['filter_alignment'] ); ?>-align fbq-secondary-font">
	<?php if ( !$opts['filter_disable_all'] ) : ?>
		<?php
			$filter_class = $opts['base_class'];
			if ( empty( $opts['filter_initial'] ) || 'all' === $opts['filter_initial'] ) {
				$filter_class .= ' active';
			}
		?>
		<li class="fbq-filter-list fbq-filter-list--all">
			<a href="#" class="<?php echo esc_attr( $filter_class ); ?>" data-filter="all"><?php esc_html_e( 'All', 'fabrique' ); ?></a>
		</li>
	<?php endif; ?>
	<?php foreach ( $opts['categories'] as $index => $category ) : ?>
		<?php
			$filter_class = $opts['base_class'];
			if ( strtolower( $category ) === strtolower( $opts['filter_initial'] ) || ( $opts['filter_disable_all'] && 0 == $index ) ) {
				$filter_class .= ' active';
			}
		?>
		<li class="fbq-filter-list">
			<a href="#" class="<?php echo esc_attr( $filter_class ); ?>" data-filter="<?php echo esc_attr( $opts['categories_slug'][$category] ); ?>"><?php echo esc_html( $category );; ?></a>
		</li>
	<?php endforeach; ?>
</ul>
