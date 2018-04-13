<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
      $args = array( 
          "posts_per_page"  => $atts["posts_count"],
          'post_type'       => 'service',
          'cat'             => $atts['category']);

      $kapp_services = new WP_Query( $args );

      $classes = "";

      if($atts['style']=="0"){
          $classes= "services-area";
      }else {
          $classes = "services-area services-area-3";
      }
?>


<div class="owl-carousel <?php echo esc_attr($classes); ?> services-slider" data-margin="25" data-loop="true" data-autoplay="true" data-autoplay-timeout="5000" data-smart-speed="1000" data-nav-speed="false" <?php if($atts['style']==0){ ?> data-dots="true"  <?php } ?> data-nav="false" data-lg-nav="false" data-md-nav="false" data-sm-nav="false" data-xs-nav="false" data-xxs-nav="false" data-lg-items="3" data-md-items="3" data-sm-items="2" data-xs-items="1" data-xxs-items="1">
    <?php while($kapp_services->have_posts()) {
              $kapp_services->the_post(); ?>
    <div class="item">
        <div class="service-single">
            <div class="service-thumb">
                <?php the_post_thumbnail( "grandpoza-rectangular-sm-thumb" , array( "class" => "img-responsive" )); ?>
            </div>
            <div class="service-content">
                <h5 class="mb-10 t-uppercase">
                    <?php the_title(); ?>
                </h5>
                <p class="color-mid mb-15">
                    <?php echo get_the_excerpt(); ?>
                </p>
                <a class="read-more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more' , 'grandpoza' ); ?></a>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

