<?php
/**
 * Partial template file
 *
 * @package fabrique/templates/partials
 * @version 1.0.0
 */
?>

<?php $opts = fabrique_template_args( 'featured-media' ); ?>

<?php if ( 'video' == $opts['post_format'] && ( $opts['video'] || !empty( $opts['video-external'] ) ) ) : ?>
	<?php fabrique_template_item( array(
		'type' => 'video',
		'video_type' => ( $opts['video'] ) ? 'self-hosted' : 'external',
		'video_url' => wp_get_attachment_url( $opts['video'] ),
		'external_url' => $opts['video-external'],
		'width' => 2560,
		'itemprop' => 'video'
	) ); ?>
<?php elseif ( 'audio' == $opts['post_format'] ) : ?>
	<?php if ( !empty( $opts['audio'] ) ) : ?>
		<?php if ( !empty( $opts['image_id'] ) || !empty( $opts['image_url'] ) ) : ?>
			<div class="fbq-audio with-background" itemprop="audio">
				<div class="fbq-audio-player pause" <?php echo fabrique_s( array( 'background' => fabrique_get_background_image( array( 'id' => $opts['image_id'], 'url' => $opts['image_url'] ) ) ) ); ?>>
					<div class="fbq-audio-button twf twf-play twf-2x"></div>
				</div>
		<?php else : ?>
			<div class="fbq-audio" itemprop="audio">
		<?php endif; ?>
			<?php echo do_shortcode( '[audio src="' . wp_get_attachment_url( $opts['audio'] ) . '"]' ); ?>
		</div><?php // close audio ?>
	<?php elseif ( !empty( $opts['audio-external'] ) ) : ?>
		<?php echo fabrique_escape_content( $opts['audio-external'] ); ?>
	<?php endif; ?>
<?php elseif ( 'gallery' == $opts['post_format'] && !empty( $opts['gallery'] ) ) : ?>
	<?php fabrique_template_item( array(
		'type' => 'gallery',
		'style' => 'carousel',
		'no_of_columns' => 1,
		'image_size' => $opts['image_size'],
		'image_ratio' => $opts['image_ratio'],
		'image_lazy_load' => $opts['image_lazy_load'],
		'spacing' => 0,
		'adaptive_height' => true,
		'images' => $opts['gallery'],
		'responsive' => $opts['responsive']
	) ); ?>
<?php elseif ( 'quote' == $opts['post_format'] && !empty( $opts['quote'] ) ) : ?>
	<?php fabrique_template_item( array(
		'type' => 'quote',
		'background_id' => $opts['image_id'],
		'background_url' => $opts['image_url'],
		'background_color' => '#222222',
		'background_opacity' => 50,
		'text' => $opts['quote'],
		'author' => '&#8211;&nbsp;' . $opts['author']
	) ); ?>
<?php else : ?>
	<?php $opts['itemprop'] = 'image'; ?>
	<?php echo fabrique_template_media( $opts, false, $opts['responsive'] ); ?>
<?php endif; ?>
