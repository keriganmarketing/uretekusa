<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/quote' );
	$opts = fabrique_item_quote_options( $args );
?>

<blockquote <?php echo fabrique_a( $opts ); ?>>
	<?php fabrique_template_background( $opts ); ?>
	<?php if ( 'icon' === $opts['style'] ) : ?>
		<div <?php echo fabrique_a( $opts['quote_icon_attr'] ); ?>><?php esc_html_e( '“', 'fabrique' ); ?></div>
	<?php endif; ?>
	<div class="fbq-quote-inner">
		<div <?php echo fabrique_a( $opts['quote_text_attr'] ); ?>>
			<?php echo do_shortcode( $opts['text'] ); ?>
		</div>

		<?php if ( $opts['author_on'] && !empty( $opts['author'] ) ) : ?>
			<div class="fbq-quote-author">
				<?php echo do_shortcode( $opts['author'] ); ?>
			</div>
		<?php endif; ?>
	</div><?php // close inner ?>
</blockquote>
