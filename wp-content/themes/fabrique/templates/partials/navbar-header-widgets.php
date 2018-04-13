<?php
/**
 * Partial template file
 *
 * @package fabrique/templates/partials
 * @version 1.0.0
 */
?>


<?php $opts = fabrique_template_args( 'navbar-header-widgets' ); ?>

<?php if ( $opts && is_array( $opts ) && !empty( $opts ) ) : ?>
	<div class="<?php echo esc_attr( implode( ' ', $opts['header_widgets_class'] ) ); ?>">
		<div class="fbq-header-widgets-content">
			<div class="<?php echo esc_attr( $opts['container_class'] ); ?>">
				<div class="fbq-row">
					<?php for ( $i = 1; $i <= $opts['header_widget_col']; $i++ ) : ?>
						<div class="fbq-header-widgets-column fbq-p-border-border fbq-col-<?php echo esc_attr( 12 / $opts['header_widget_col'] ); ?>">
							<?php if ( is_active_sidebar( 'fabrique-headerwidget-' . $i ) ) : ?>
								<div class="fbq-widgets">
									<ul class="fbq-widgets-list">
										<?php dynamic_sidebar( 'fabrique-headerwidget-' . $i ); ?>
									</ul>
								</div>
							<?php endif; ?>
						</div>
					<?php endfor; ?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
