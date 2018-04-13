<?php if (!defined('FW')) die('Forbidden'); ?>
<?php if (isset($data['slides'])):
?>
<!-- Owl Slider-->
<div class="owl-carousel" data-loop="true" data-autoplay="true" data-autoplay-timeout="5000" data-smart-speed="1000" data-nav-speed="false" data-nav="true">
   
    <?php
        foreach ($data['slides'] as $id => $slide){
    ?>
        <img class="img-responsive" src="<?php  echo esc_url( fw_resize($slide['src'], $dimensions['width'], $dimensions['height']+20, true) ); ?>" alt="<?php echo esc_attr($slide['src']); ?>" />
    <?php } ?>
</div>
<!--/ Owl Slider-->
<?php endif; ?>
