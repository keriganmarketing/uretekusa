<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/banner' );
	$opts = fabrique_item_banner_options( $args );
?>

<?php if ( !empty( $opts['banner_link'] ) ): ?>
	<a href="<?php echo fabrique_escape_url( $opts['banner_link'] ); ?>" <?php echo fabrique_a( $opts ); ?> target="<?php echo esc_attr( $opts['link_target'] ); ?>">
<?php else : ?>
	<div <?php echo fabrique_a( $opts ); ?>>
<?php endif; ?>
	<?php fabrique_template_background( $opts ); ?>
	<div class="fbq-banner-content" <?php echo fabrique_s( $opts['content_style'] ); ?>>
		<div <?php echo fabrique_a( $opts['content_inner_attr'] ); ?>>
			<?php if ( $opts['media_on'] ) : ?>
				<div class="fbq-banner-media">
					<?php echo fabrique_template_media( $opts ); ?>
				</div>
			<?php endif; ?>
			<?php if ( $opts['title_on'] ) : ?>
				<div <?php echo fabrique_a( $opts['title_attr'] ); ?>>
					<?php echo do_shortcode( $opts['title'] ); ?>
				</div>
			<?php endif; ?>
			<?php if ( $opts['subtitle_on'] ) : ?>
				<div <?php echo fabrique_a( $opts['subtitle_attr'] ); ?>>
					<?php echo do_shortcode( $opts['subtitle'] ); ?>
				</div>
			<?php endif; ?>
			<?php if ( $opts['button_on'] ) : ?>
				<div class="fbq-banner-button">
					<?php fabrique_template_button( $opts ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php if ( !empty( $opts['banner_link'] ) ): ?>
	</a>
<?php else : ?>
	</div>
<?php endif; ?>
