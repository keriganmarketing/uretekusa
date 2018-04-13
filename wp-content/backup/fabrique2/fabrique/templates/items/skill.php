<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/skill' );
	$opts = fabrique_item_skill_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>
	<div class="fbq-row">
		<?php foreach ( $opts['data'] as $index => $data ) : ?>
			<div class="fbq-skill-item <?php echo esc_attr( $opts['item_class'] ); ?>" <?php echo fabrique_d( $opts['item_data'][$index] ); ?>>
				<?php if ( 'bar' === $opts['style'] ) : ?>
					<?php if ( 'horizontal' === $opts['axis'] ) : ?>
						<div class="fbq-skill-heading">

							<?php if ( $opts['icon_on'] ) : ?>
								<span class="fbq-skill-icon fbq-s-text-color twf-<?php echo esc_attr( $data['icon'] ); ?>" <?php echo fabrique_s( $opts['icon_style'][$index] ); ?>></span>
							<?php endif; ?>

							<?php if ( !empty( $data['title'] ) ) : ?>
								<span class="fbq-skill-title fbq-s-text-color"><?php echo do_shortcode( $data['title'] ); ?></span>
							<?php endif; ?>

							<?php if ( $opts['percentage_on'] ) : ?>
								<div class="fbq-skill-percentage fbq-s-text-color"><?php echo esc_html( $data['percent'] . '%' ); ?></div>
							<?php endif; ?>

						</div><?php // close heading fbq-skill-heading ?>
						<div class="fbq-skill-bar fbq-s-bg-bg" <?php echo fabrique_s( $opts['bar_style'][$index] ); ?>>
							<div class="fbq-skill-progress fbq-p-brand-bg" <?php echo fabrique_s( $opts['progress_style'][$index] ); ?>></div>
						</div>
					<?php else : ?>
						<div class="fbq-skill-item-inner" <?php echo fabrique_s( $opts['inner_style'] ); ?>>
							<div class="fbq-skill-bar fbq-p-brand-bg" <?php echo fabrique_s( $opts['bar_style'][$index] ); ?>>
								<div class="fbq-skill-progress fbq-s-bg-bg fbq-" <?php echo fabrique_s( $opts['progress_style'][$index] ); ?>></div>
							</div>
							<div class="fbq-skill-heading">

								<?php if ( $opts['icon_on'] ) : ?>
									<span class="fbq-skill-icon fbq-s-text-color twf-<?php echo esc_attr( $data['icon'] ); ?>" <?php echo fabrique_s( $opts['icon_style'][$index] ); ?>></span>
								<?php endif; ?>

								<?php if ( !empty( $data['title'] ) ) : ?>
									<span class="fbq-skill-title"><?php echo do_shortcode( $data['title'] ); ?></span>
								<?php endif; ?>

								<?php if ( $opts['percentage_on'] ) : ?>
									<div class="fbq-skill-percentage fbq-s-text-color"><?php echo esc_html( $data['percent'] . '%' ); ?></div>
								<?php endif; ?>

							</div><?php // close heading fbq-skill-heading ?>
						</div><?php // close inner fbq-skill-item-inner ?>
					<?php endif; ?>
				<?php else : ?>
					<div class="fbq-skill-piechart" <?php echo fabrique_s( $opts['piechart_style'] ); ?>>
						<div class="easyPieChart"></div>
						<div class="fbq-skill-heading">
							<?php if ( $opts['icon_on'] ) : ?>
								<div class="fbq-skill-icon fbq-s-text-color twf-<?php echo esc_attr( $data['icon'] ); ?>" <?php echo fabrique_s( $opts['icon_style'][$index] ); ?>></div>
							<?php endif; ?>
							<?php if ( $opts['percentage_on'] ) : ?>
								<div class="fbq-skill-percentage fbq-secondary-font fbq-p-brand-color" <?php echo fabrique_s( $opts['percent_style'][$index] ); ?>><?php echo esc_html( $data['percent'] . '%' ); ?></div>
							<?php endif; ?>
						</div><?php // close heading fbq-skill-heading ?>
					</div><?php // close piechart fbq-skill-piechart ?>
					<?php if ( !empty( $data['title'] ) ) : ?>
						<div class="fbq-skill-title fbq-s-text-color"><?php echo do_shortcode( $data['title'] ); ?></div>
					<?php endif; ?>
				<?php endif; ?>
			</div><?php // close item fbq-skill-item ?>
		<?php endforeach; ?>
	</div><?php // close row fbq-row ?>
</div>
