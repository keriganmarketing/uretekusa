<?php if (!defined('FW')) die('Forbidden');

      $class = fw_ext_builder_get_item_width('page-builder', $atts['width'] . '/frontend_class');
      if($atts["is_offset"])
      {
          $class .=" col-sm-offset-6 col-video";
      }

      if( '' != $atts['additional_css_classes'] )
      {
          $class .= " ".esc_attr($atts['additional_css_classes']);
      }
?>
<div class="<?php echo esc_attr($class); ?>">
    <?php echo do_shortcode($content); ?>
</div>
