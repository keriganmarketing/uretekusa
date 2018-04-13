<?php $gallery_images = get_post_gallery_images( get_the_ID() ); ?>

<div class="owl-carousel" data-loop="true" data-autoplay="true" data-autoplay-timeout="10000" data-smart-speed="1000" data-nav-speed="false" data-nav="true" data-xxs-items="1" data-xxs-nav="true" data-xs-items="1" data-xs-nav="true" data-sm-items="1" data-sm-nav="true" data-md-items="1" data-md-nav="true" data-lg-items="1" data-lg-nav="true">
    <?php foreach($gallery_images as $img){ ?>
    <figure class="item embed-responsive embed-responsive-16by9" data-bg-img="<?php echo esc_url( $img ); ?>"></figure>
    <?php } ?>
</div>