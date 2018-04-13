<?php
/**
 * The template file
 *
 * @package fabrique/templates
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'blueprint-content' );
	$opts = fabrique_blueprint_content_options( $args );
?>

<main <?php echo fabrique_a( $opts ); ?>>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'fbq-content-wrapper' ); ?> <?php echo fabrique_s( $opts['content_wrapper_style'] ); ?>>
		<?php if ( !$opts['scroll_page'] ) : ?>
			<?php fabrique_template_blueprint_page_title( $opts['builder'] ); ?>
		<?php endif; ?>

		<?php if ( $opts['sidebar'] ) : ?>
			<div class="fbq-content-wrapper-inner">
				<div class="<?php echo esc_attr( $opts['main_container_class'] ); ?>">
		<?php endif; ?>

		<div class="<?php echo esc_attr( fabrique_main_page_class( $opts['sidebar'], $opts['sidebar_position'], $opts['sidebar_background_color'] ) ); ?>">
			<div class="<?php echo esc_attr( implode( ' ', $opts['main_wrapper_class'] ) ); ?>">
				<?php
					$s_index = 0;
					foreach( $opts['sections'] as $section ) {
						$section = fabrique_filter_section_content( $section );

						foreach ( $section as $section_content ) {
							$section_args = array(
								'section' => $section_content,
								'index' => $s_index,
								'sidebar' => $opts['sidebar'],
								'scroll_page' => $opts['scroll_page'],
								'half_page_scroll' => $opts['half_page_scroll']
							);
							fabrique_template( 'section-content.php', $section_args );
							$s_index++;
						}
					}
				?>
			</div>
		</div>

		<?php if ( $opts['sidebar'] ) : ?>
					<aside class="<?php echo fabrique_sidebar_class( $opts['sidebar_position'], $opts['sidebar_fixed'], $opts['sidebar_color_scheme'] ); ?>" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
						<?php fabrique_template_sidebar_background( $opts['sidebar_background_color'] ); ?>
						<div class="fbq-widgets">
							<ul class="fbq-widgets-list">
								<?php dynamic_sidebar( $opts['sidebar_select'] ); ?>
							</ul>
						</div>
					</aside>
				</div>
			</div>
		<?php endif; ?>

	</article>
</main>
