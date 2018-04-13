
<div class="services-area row row-tb-15">

    <?php while($kapp_services->have_posts()) { $kapp_services->the_post(); ?>

    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="item">
            <div class="service-single">
                <div class="service-thumb">
                    <?php the_post_thumbnail( 'grandpoza-rectangular-sm-thumb', array( "class" => "img-responsive") );?>
                </div>
                <div class="service-content">
                    <h5 class="mb-10 t-uppercase">
                        <?php the_title(); ?>
                    </h5>
                    <p class="color-mid mb-15">
                        <?php echo get_the_excerpt(); ?>
                    </p>
                    <a class="read-more" href="<?php the_permalink(); ?>"><?php esc_html_e( "Read more" , "grandpoza" ); ?></a>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

</div>
