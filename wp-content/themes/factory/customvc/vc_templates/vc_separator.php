<?php

$output = '';
extract( shortcode_atts( array(
	'el_class'	 => '',
	'type'		 => '',
	'position'	 => '',
	'color'		 => '',
	'up'		 => '',
	'down'		 => '',
	'thickness'	 => '',
), $atts ) );

$factorycommercegurus_css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'separator ', $this->settings['base'] );

$factorycommercegurus_separator_classes = "";

$factorycommercegurus_separator_classes .= $factorycommercegurus_css_class . " ";
$factorycommercegurus_separator_classes .= $type . " ";
$factorycommercegurus_separator_classes .= $position . " ";
$factorycommercegurus_margin_top = '';
$factorycommercegurus_margin_bottom = '';
$factorycommercegurus_background_color = '';
$factorycommercegurus_height = '';

if ( $up != "" ) {
	$factorycommercegurus_margin_top = 'margin-top:' . $up . 'px; ';
}

if ( $down != "" ) {
	$factorycommercegurus_margin_bottom = 'margin-bottom:' . $down . 'px; ';
}

if ( $color != "" ) {
	$factorycommercegurus_background_color = 'background-color:' . $color . ';';
}

if ( $thickness != "" ) {
	$factorycommercegurus_height .= 'height:' . $thickness . 'px;';
}

?>

<div class="<?php echo esc_attr( $factorycommercegurus_separator_classes ); ?>" style="<?php echo esc_attr( $factorycommercegurus_margin_top) . esc_attr( $factorycommercegurus_margin_bottom ) . esc_attr( $factorycommercegurus_background_color ) . esc_attr( $factorycommercegurus_height ); ?>">
</div>
<?php echo esc_attr( $this->endBlockComment( 'separator' ) ); ?>
