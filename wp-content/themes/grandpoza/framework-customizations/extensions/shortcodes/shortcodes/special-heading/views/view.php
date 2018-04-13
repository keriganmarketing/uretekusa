<?php if (!defined('FW')) die( 'Forbidden' );
/**
 * @var $atts
 */

$additional_css_class = $atts['underline'] ? 'h-title ' : '';
$additional_css_class .= $atts['enable_margin_bottom'] ? 'mb-20' : '' ;
$inline_styles = isset($atts['text_color']) &&  '' !== $atts['text_color'] ? 'style="color:'.$atts['text_color'].';"' : '';
?>


<?php $kapp_heading_subtitle = empty($atts['subtitle']) ? '' : ' <span class="color-theme">'.($atts['subtitle']).'</span>' ; ?>

<?php echo "<{$atts['heading']} {$inline_styles} class='{$additional_css_class}".(!empty($atts['centered']) ? " text-center" :" is-table-fixed")."'>{$atts['title']}{$kapp_heading_subtitle}</{$atts['heading']}>"; ?>