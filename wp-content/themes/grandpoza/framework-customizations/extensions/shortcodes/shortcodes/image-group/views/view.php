<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
      $css_class ="";
      $parent_cc_class = "";

      if($atts['col_style']=="0"){
          $parent_cc_class = "brands-area row-tb-15";
          $css_class = 'col-xs-12 col-sm-6 col-md-4';
      }else {
          $parent_cc_class = "";
          $css_class = 'col-md-2 col-sm-2 col-xs-6';
      }
?>

<div class="row <?php echo esc_attr($parent_cc_class); ?>">
    <?php foreach ( fw_akg( 'logos', $atts, array() ) as $logo ) { ?>
    <div class="<?php echo $css_class; ?>">
        <div class="client">
            <img src="<?php echo esc_url( $logo['logo']['url'] );?>" alt="<?php echo esc_attr( $logo['title'] ); ?>" />
        </div>
    </div>
    <?php } ?>

</div>
