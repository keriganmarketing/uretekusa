<?php
/**
 * Partial template file
 *
 * @package fabrique/templates/partials
 * @version 1.0.0
 */
?>


<?php $opts = fabrique_template_args( 'social-share' ); ?>

<?php if ( !empty( $opts['components'] ) ) : ?>
	<ul <?php echo fabrique_a( $opts['share_attr'] ); ?>>
		<?php if ( $opts['counter'] ) : ?>
			<li class="fbq-social-share-count fbq-p-border-border fbq-s-text-color">
				<?php
					$page_id = fabrique_get_page_id();
					$social_count = get_transient( 'fbq-social-share-' . $page_id );
					if ( $social_count === false ) {
						$social_count = fabrique_get_share_count( $opts['components'], $opts['share_url'] );
						$expiration = 86400;
						set_transient( 'fbq-social-share-' . $page_id, $social_count, $expiration );
					}
				?>
				<span class="fbq-social-share-count-number"><?php echo esc_html( $social_count ); ?></span>
				<span class="fbq-social-share-count-suffix">
					<?php echo ( $social_count > 1 ) ? esc_html__( 'Shares', 'fabrique' ) : esc_html__( 'Share', 'fabrique' ); ?>
				</span>
			</li>
		<?php endif; ?>
		<?php foreach ( $opts['components'] as $option ) : ?>
			<?php $social_share_icon = ( 'email' === $option ) ? 'envelope' : $option; ?>
			<li class="<?php echo implode( ' ', $opts['item_class'] ); ?>">
				<?php $link_attr = $opts['link_attr']; ?>
				<?php $link_attr['class'][] = 'fbq-social-' . esc_attr( $option ); ?>
				<a <?php echo fabrique_a( $link_attr ); ?> href="<?php echo esc_url( $opts['social_share'][$option]['link'] ); ?>">
					<?php
						if ( 'minimal' === $opts['style'] ) {
							echo esc_html( $opts['social_share'][$option]['label'] );
						} else {
							$opts['icon_args']['icon'] = $social_share_icon;
							echo fabrique_template_icon( $opts['icon_args'] );

							if ( 'icon' !== $opts['style'] ) { ?>
								<span class="fbq-social-share-label">
									<?php echo esc_html( $opts['social_share'][$option]['label'] ); ?>
								</span>
							<?php }
						}
					?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
<?php else : ?>
	<?php echo fabrique_get_dummy_template( esc_html__( 'share', 'fabrique' ), esc_html__( 'Share component is now empty.', 'fabrique' ) ); ?>
<?php endif; ?>
