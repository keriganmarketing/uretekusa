<?php
/**
 * Partial template file
 *
 * @package fabrique/templates/partials
 * @version 1.0.0
 */
?>


<?php
	$opts = fabrique_template_args( 'post-meta' );
	$title = get_the_title();
?>

<?php if ( !empty( $title ) || $opts['category'] || $opts['date'] || $opts['author'] || $opts['social'] ) : ?>
	<?php
		$title_style = array(
			'font-size' => $opts['title_size'] . 'px',
			'letter-spacing' =>  is_numeric( $opts['title_letter_spacing'] ) ? $opts['title_letter_spacing'] . 'px' : $opts['title_letter_spacing'],
			'max-width' => is_numeric( $opts['title_max_width'] ) ? $opts['title_max_width'] . 'px' : $opts['title_max_width'],
			'line-height' => $opts['title_line_height']
		);
	?>
	<?php if ( !empty( $title ) ) : ?>
		<h1 itemprop="headline" class="fbq-post-title post-title fbq-<?php echo esc_attr( $opts['title_font'] ); ?>-font" <?php echo fabrique_s( $title_style ); ?>>
			<?php echo esc_html( $title ); ?>
		</h1>
	<?php endif; ?>
	<div class="fbq-post-meta fbq-<?php echo esc_attr( apply_filters( 'single_post_meta_font', 'primary' ) ); ?>-font">
	<?php if ( $opts['date'] ) : ?>
		<div itemprop="datePublished" class="fbq-post-date post-date date updated"><?php echo get_the_date(); ?></div>
	<?php endif; ?>
	<?php if ( $opts['category'] ) : ?>
		<?php $categories = fabrique_term_names( fabrique_get_taxonomy() ); ?>
		<?php if ( !empty( $categories['link'] ) ) : ?>
			<div class="fbq-post-category fbq-s-text-color-hover">
				<?php foreach ( $categories['link'] as $cat ) : ?>
					<?php echo fabrique_escape_content( $cat ); ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>
	<?php if ( $opts['author'] ) : ?>
		<div class="author fbq-post-author fbq-s-text-color-hover">
			<?php echo esc_html_e( 'By', 'fabrique' ); ?>
			<a itemprop="author" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
				<?php echo get_the_author(); ?>
			</a>
		</div>
	<?php endif; ?>
	<?php if ( $opts['comment'] ) : ?>
		<?php $comments = get_comments_number(); ?>
		<?php if ( 1 <= $comments ) : ?>
			<div class="fbq-post-comment fbq-s-text-color-hover">
				<a href="#comments" class="fbq-post-comment">
					<?php echo esc_html( $comments ); ?>
					<?php ( 1 == $comments ) ? esc_html_e( ' comment', 'fabrique' ) : esc_html_e( ' comments', 'fabrique' ); ?>
				</a>
			</div>
		<?php endif; ?>
	<?php endif; ?>
	<?php if ( $opts['social'] ) : ?>
		<div class="fbq-post-share fbq-post-share--top">
			<div class="fbq-post-share-button fbq-p-brand-color twf twf-share-alt"></div>
			<div class="fbq-post-share-box fbq-p-border-border fbq-p-bg-bg">
				<?php fabrique_template_share( array(
					'style' => 'box',
					'components' => $opts['social_components'],
					'auto_color' => true
				) ); ?>
				<div class="fbq-triangle-border up"></div>
				<div class="fbq-triangle up"></div>
			</div>
		</div>
	<?php endif; ?>
	</div>
<?php endif; ?>
