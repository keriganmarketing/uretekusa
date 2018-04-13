<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */

global $wp_embed;

$width  = ( is_numeric( $atts['width'] ) && ( $atts['width'] > 0 ) ) ? $atts['width'] : '300';
$height = ( is_numeric( $atts['height'] ) && ( $atts['height'] > 0 ) ) ? $atts['height'] : '200';
$iframe = $wp_embed->run_shortcode( '[embed  width="' . $width . '" height="' . $height . '"]' . trim( $atts['url'] ) . '[/embed]' );
?>
<div class="video-wrapper shortcode-container" style="height:<?php echo $height; ?>px;background-image:url('<?php echo isset($atts["thumbnail"]["url"]) ? esc_attr($atts["thumbnail"]["url"]) : ''; ?>')">
    <a class="play iframe-lightbox video-link" href="<?php echo trim( $atts['url'] ); ?>"></a>
</div>
