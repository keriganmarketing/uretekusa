<?php
/**
 * The main template file
 *
 * @package fabrique
 * @version 1.0.0
 */
?>

<?php $sidebar_select = esc_attr( fabrique_mod( 'sidebar_select' ) ); ?>

<aside class="<?php echo fabrique_sidebar_class( fabrique_mod( 'sidebar_position' ), fabrique_mod( 'sidebar_fixed' ) ); ?>" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
	<?php fabrique_template_sidebar_background(); ?>
	<div class="fbq-widgets">
		<?php if ( is_active_sidebar( $sidebar_select ) ) : ?>
			<ul class="fbq-widgets-list">
				<?php dynamic_sidebar( $sidebar_select ); ?>
			</ul>
		<?php endif; ?>
	</div>
</aside>
