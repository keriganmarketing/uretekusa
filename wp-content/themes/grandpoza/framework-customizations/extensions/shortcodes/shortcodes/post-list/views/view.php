<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
      $args = array( 
          "posts_per_page"  => $atts["posts_count"],
          'cat'             => $atts['category'] 
          );

      $kapp_posts = new WP_Query($args);

?>

<div class="row-tb-15 row  mt-xs-5 clearfix">

    <?php while($kapp_posts->have_posts()) {  $kapp_posts->the_post(); ?>
    <div class="col-md-3 col-sm-6">
        <div class="about-us-box">
            <figure class="embed-responsive embed-responsive-4by3 mb-15" data-bg-img="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID() , "grandpoza-rectangular-sm-thumb" )); ?>">
                <a href="<?php the_permalink(); ?>" class="link-overlay t-center">
                    <i class="fa fa-link pos-center"></i>
                </a>
            </figure>
            <h6 class="mb-10 t-uppercase">
                <?php the_title(); ?>
            </h6>
            <p class="color-mid mb-10">
                <?php echo Kapp_Helpers::shorten_excerpt( get_the_excerpt() , 100 ); ?>
            </p>
            <a href="<?php the_permalink(); ?>" class="read-more">
                <?php esc_html_e( "Read More" , "grandpoza" ); ?>
            </a>
        </div>
    </div>
    <?php } ?>

</div>