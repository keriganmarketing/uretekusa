<?php
/**
 * Item template file
 *
 * @package fabrique/templates/items
 * @version 1.0.0
 */
?>


<?php
	$args = fabrique_template_args( 'items/video' );
	$opts = fabrique_item_video_options( $args );
?>

<div <?php echo fabrique_a( $opts ); ?>>
	<?php if ( ( 'self-hosted' === $opts['video_type'] && !empty( $opts['video_url'] ) ) || ( 'external' === $opts['video_type'] && !empty( $opts['external_url'] ) ) ) : ?>
		<?php if ( 'standard' === $opts['style'] ) : ?>
			<div class="fbq-video-inner" <?php echo fabrique_s( $opts['inner_style'] ); ?>>
				<div class="fbq-video-content" <?php echo fabrique_s( $opts['content_style'] ); ?>>
					<?php echo fabrique_template_video( $opts ); ?>
				</div>
			</div>
		<?php else : ?>
			<?php
				if ( !empty( $opts['poster_url'] ) ) {
					$video_url = ( 'self-hosted' === $opts['video_type'] ) ? $opts['video_url'] : $opts['external_url'];
					$poster_args = array(
						'image_id' => $opts['poster_id'],
						'image_url' => $opts['poster_url'],
						'image_size' => $opts['poster_size'],
						'image_ratio' => $opts['poster_ratio'],
						'image_caption' => true,
						'image_caption_icon' => 'play',
						'image_link' => '#embed(' . esc_url( $video_url ) . ')'
					);

					if ( 'self-hosted' === $opts['video_type'] && !empty( $opts['video_id'] ) ) {
						$video_attachment = get_post( $opts['video_id'] );
						if ( $video_attachment && !empty( $video_attachment->post_excerpt ) ) {
							$poster_args['image_caption_text'] = $video_attachment->post_excerpt;
						}
					}
					echo fabrique_template_media( $poster_args );
				} else {
					echo fabrique_get_dummy_template( esc_html__( 'video', 'fabrique' ), esc_html__( 'Poster is now empty, please upload poster image.', 'fabrique' ) );
				}
			?>
		<?php endif; ?>
	<?php else : ?>
		<?php echo fabrique_get_dummy_template( esc_html__( 'video', 'fabrique' ), esc_html__( 'Video is now empty, please upload video.', 'fabrique' ) ); ?>
	<?php endif; ?>
</div>
