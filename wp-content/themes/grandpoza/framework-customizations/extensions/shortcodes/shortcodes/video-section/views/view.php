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

    <div class="container company-video-area">
        <div class="row">
            <div class="col-sm-6 col-content ptb-60 pl-30">
                <?php echo $atts["description"]; ?>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-sm-offset-6 col-video" data-bg-img="<?php echo esc_url($atts["thumbnail"]["url"]); ?>">
        <a href="<?php echo esc_url( $atts['url'] ); ?>" class="play video-lightbox iframe-lightbox video-link"></a>
    </div>
