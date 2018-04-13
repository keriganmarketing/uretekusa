
<div class="services-area row row-tb-15">
    <?php while($kapp_services->have_posts()) {
              $kapp_services->the_post(); ?>

    <div class="col-sm-6">
        <div class="about-us-box">
            <figure class="embed-responsive embed-responsive-4by3 mb-15" data-bg-img="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID() , 'grandpoza-rectangular-sm-thumb' ) );?>">
                <a href="<?php the_permalink(); ?>" class="link-overlay t-center">
                    <i class="fa fa-link pos-center"></i>
                </a>
            </figure>
            <h6 class="mb-10 t-uppercase">
                <?php the_title(); ?>
            </h6>
            <p class="color-mid mb-10">
                <?php echo get_the_excerpt(); ?>
            </p>
            <a href="<?php the_permalink(); ?>" class="read-more"><?php esc_html_e( "Read More" , "grandpoza" ); ?></a>
        </div>
    </div>

    <?php } ?>
</div>
