<?php if (!defined('FW')) die('Forbidden'); ?>
<?php if (isset($data['slides'])) { ?>

<div id="heroArea" class="hero-area owl-carousel" data-loop="true" data-autoplay="true" data-autoplay-timeout="4000" data-smart-speed="1000" data-nav-speed="false" data-nav="false" data-items="1">
    <?php
          foreach ($data['slides'] as $id => $slide){
    ?>
   
    <div class="hero-content is-table" data-bg-img="<?php  echo esc_attr(fw_resize($slide['src'], $dimensions['width'], $dimensions['height'], true)); ?>">
        <div class="container is-table-cell">
            
                <div class="container">
                    <div class="row row-xs-cell">
                        <div class="col-xs-12">
                            <?php echo $slide['content']; ?>
                        </div>
                    </div>
                </div>
          
        </div>
    </div>
    <?php } ?>
    
</div>

<?php } ?>
