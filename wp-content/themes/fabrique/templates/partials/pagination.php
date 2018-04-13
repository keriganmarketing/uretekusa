<?php
/**
 * Partial template file
 *
 * @package fabrique/templates/partials
 * @version 1.0.0
 */
?>


<?php $opts = fabrique_template_args( 'pagination' ); ?>

<div class="<?php echo esc_attr( $opts['pagination_class'] ); ?>">

<?php if ( 'pagination' === $opts['pagination_style'] ) : ?>
	<div class="fbq-pagination-inner">
		<?php echo paginate_links( $opts['pagination_link_args'] ); ?>
	</div>
<?php else : ?>
	<input type="hidden" value="<?php echo esc_attr( json_encode( $opts ) ); ?>" data-posts="<?php echo esc_attr( $opts['all_posts'] ); ?>" />
	<a href="#" class="btnx fbq-s-bg-bg fbq-p-border-border fbq-s-text-color" data-ajax="<?php echo admin_url( 'admin-ajax.php' ); ?>">
		<span class="btnx-text" data-label="<?php esc_attr_e( 'Load More', 'fabrique' ); ?>" data-loading_label="<?php esc_attr_e( 'Loading', 'fabrique' ); ?>">
			<?php esc_html_e( 'Load More', 'fabrique' ); ?>
		</span>
		<?php if ( 'click' === $opts['pagination_style'] ) : ?>
			<?php echo fabrique_template_preload( 'three-bounce' ); ?>
		<?php endif; ?>
	</a>
	<?php if ( 'scroll' === $opts['pagination_style'] ) : ?>
		<?php echo fabrique_template_preload( 'three-bounce' ); ?>
	<?php endif; ?>
	<div class="fbq-pagination-error-msg">
		<?php esc_html_e( 'Fail to load posts. Try to refresh page.', 'fabrique' ); ?>
	</div>
<?php endif; ?>
</div>
