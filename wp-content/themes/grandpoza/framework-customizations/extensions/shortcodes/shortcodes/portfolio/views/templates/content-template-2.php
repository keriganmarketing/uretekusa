
<?php

while( $portfolio_posts->have_posts() ) {

          $portfolio_posts->the_post();
          $project_details = get_post_meta(get_the_ID(),'kapp-project-details');
          $project_details = isset($project_details[0]) ? $project_details[0] : $project_details;
?>
<div class="col-sm-6 col-xs-12 single-project-post">
    <div class="gallery-img">
        <img src="<?php echo get_the_post_thumbnail_url( get_the_ID() , "grandpoza-rectangular-md-thumb" ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" />
    </div>
    <div class="gallery-footer t-left pt-15">
        <a href="<?php the_permalink(); ?>" class="title h6">
            <?php echo get_the_title(); ?>
        </a>
        <div class="color-mid pt-10">
            <span class="portfolio-date mr-20">
                <i class="fa fa-calendar mr-5"></i> <?php echo isset($project_details["completion_date"]) ? esc_attr($project_details["completion_date"]) : ""; ?>
            </span>
            <span class="portfolio-tag">
                <i class="fa fa-map-marker mr-5"></i> <?php echo isset($project_details["completion_date"]) ? esc_attr($project_details["location"]) : ""; ?>
            </span>
        </div>
    </div>
</div>

<?php }  wp_reset_query(); ?>