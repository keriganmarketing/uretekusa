<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/team' );
	$opts = fabrique_item_team_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>
	<div class="fbq-team-inner">
		<div class="fbq-team-media">
			<?php echo fabrique_template_media( $opts ); ?>
		</div>
		<div class="fbq-team-body <?php echo esc_attr( implode( ' ', $opts['body_class'] ) ); ?>" <?php echo fabrique_s( $opts['body_style'] ); ?>>

			<?php if ( 'hover' === $opts['style'] ) : ?>
				<?php if ( 'flip' === $opts['mouseover_effect'] ) : ?>
					<?php echo fabrique_template_media( $opts ); ?>
				<?php endif; ?>
				<?php if ( !empty( $opts['image_link'] ) ) : ?>
					<?php $link_target = $opts['media_target_self'] ? '_blank' : '_self'; ?>
					<?php $link_target = ( '#' !== substr( $opts['image_link'], 0 , 1 ) ) ? $link_target : '_self'; ?>
					<a class="fbq-team-background fbq-s-bg-bg fbq-p-border-border" href="<?php echo fabrique_escape_url( $opts['image_link'] ); ?>" target="<?php echo esc_attr( $link_target ); ?>" <?php echo fabrique_s( $opts['hover_style'] ); ?>></a>
				<?php else : ?>
					<div class="fbq-team-background fbq-s-bg-bg fbq-p-border-border" <?php echo fabrique_s( $opts['hover_style'] ); ?>></div>
				<?php endif; ?>
			<?php endif; ?>

			<div class="fbq-team-body-wrapper">
				<div class="fbq-team-body-inner">
					<div class="fbq-team-body-content" <?php echo fabrique_s( $opts['content_style'] ); ?>>
						<div class="fbq-team-header">
							<div class="fbq-team-name fbq-s-text-color fbq-<?php echo esc_attr( $opts['name_font'] ); ?>-font">
								<?php echo do_shortcode( $opts['name'] ); ?>
							</div>
							<div class="fbq-team-title fbq-<?php echo esc_attr( $opts['title_font'] ); ?>-font">
								<?php echo do_shortcode( $opts['title'] ); ?>
							</div>
						</div>

						<?php if ( $opts['description_on'] ) : ?>
							<div class="fbq-team-description">
								<?php echo do_shortcode( $opts['description'] ); ?>
							</div>
						<?php endif; ?>

						<?php if ( $opts['social_on'] && !empty( $opts['socials'] ) ) : ?>
							<div class="fbq-team-socials">
								<div class="fbq-team-socials-inner">
									<div class="fbq-social fbq-social--<?php echo esc_attr( $opts['social_style'] ); ?>">
										<div class="fbq-social-inner">
											<?php echo fabrique_get_social_icon( $opts['social_args'] ); ?>
										</div>
									</div>
								</div>
							</div>
						<?php endif; ?>

					</div><?php // close body content fbq-team-body-content ?>
				</div><?php // close body inner fbq-team-body-inner ?>
			</div><?php // close body wrapper fbq-team-body-wrapper ?>
		</div><?php // close body fbq-team-body ?>
	</div><?php // close inner fbq-team-inner ?>
</div>
