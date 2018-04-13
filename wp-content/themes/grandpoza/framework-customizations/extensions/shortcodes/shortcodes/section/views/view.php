<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$bg_color = '';
if ( ! empty( $atts['background_color'] ) ) {
	$bg_color = 'background-color:' . $atts['background_color'] . ';';
}

$bg_image = '';
if ( ! empty( $atts['background_image'] ) && ! empty( $atts['background_image']['data']['icon'] ) ) {
	$bg_image = 'background-image:url(' . $atts['background_image']['data']['icon'] . ');';
}

$bg_video_data_attr    = '';
$section_extra_classes = '';
if ( ! empty( $atts['video'] ) ) {
	$filetype           = wp_check_filetype( $atts['video'] );
	$filetypes          = array( 'mp4' => 'mp4', 'ogv' => 'ogg', 'webm' => 'webm', 'jpg' => 'poster' );
	$filetype           = array_key_exists( (string) $filetype['ext'], $filetypes ) ? $filetypes[ $filetype['ext'] ] : 'video';
	$data_name_attr = version_compare( fw_ext('shortcodes')->manifest->get_version(), '1.3.9', '>=' ) ? 'data-background-options' : 'data-wallpaper-options';
	$bg_video_data_attr = $data_name_attr.'="' . fw_htmlspecialchars( json_encode( array( 'source' => array( $filetype => $atts['video'] ) ) ) ) . '"';
	$section_extra_classes .= ' background-video';
}

$section_extra_classes .= $atts["class"];


$layout_padding = "padding:".esc_attr($atts['padding']).";";
$layout_margin = "margin:".esc_attr($atts['margin']);

$section_style   = ( $bg_color || $bg_image ) ? 'style="' . esc_attr($bg_color . $bg_image): '';
$section_style  .= "" == $section_style ? 'style="'.$layout_padding.'"' : $layout_padding . '"';
$container_style =  'style="'.$layout_margin.';margin-left:auto;margin-right:auto;"';

$container_class = ( isset( $atts['is_fullwidth'] ) && $atts['is_fullwidth'] ) ? 'fw-container-fluid' : 'container';


if(isset($atts['center_mobile']) && $atts['center_mobile'])
{
    $section_extra_classes .= " t-xs-center t-sm-left";
    $container_class .= " is-inline-block is-block-sm";
}

?>
<section class="section <?php echo esc_attr($section_extra_classes) ?>" <?php echo $section_style; ?> <?php echo $bg_video_data_attr; ?>>
    <div <?php echo $container_style; ?> class="<?php echo esc_attr($container_class); ?>">
		<?php echo do_shortcode( $content ); ?>
	</div>
</section>
