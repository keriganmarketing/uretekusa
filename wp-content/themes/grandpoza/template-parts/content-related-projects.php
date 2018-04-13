
<div class="container pb-60">

    <div class="t-left mb-40">

        <h2 class="section-title mb-15 font-22 t-uppercase">
            <?php esc_html_e( "RELATED PROJECTS" , "grandpoza"); ?>
        </h2>

        <div class="m-0 line"></div>
    </div>

    <div class="portfolio-wrapper row row-tb-15 portfolio-area-4 portfolio-area">

        <?php

        $categories =  get_the_terms( get_the_ID() , 'project_category');

        //GET PROJECTS IN THE SAME CATEGORY
        $cat = isset($categories) ? $categories[0]->slug  : 0;

        $args = array(
            "post_type"          => "project",
            "project_category"   => $cat ,
            "post__not_in"       => array( get_the_ID() ),
            "posts_per_page"     => 4
            );

        $related_projects = new WP_Query( $args );

        while($related_projects->have_posts()) :
            $related_projects->the_post()

        ?>

        <div class="col-md-3 col-sm-6">

            <div class="portfolio-single">

                <figure class="work-img">
                    <img src="<?php echo get_the_post_thumbnail_url( get_the_ID() , "grandpoza-rectangular-md-thumb" ) ?>" alt="<?php the_title(); ?>" />
                </figure>

                <div class="portfolio-hover">

                    <div class="inner-hover pos-tb-center">
                        <h5 class="t-uppercase mb-20">
                            <?php the_title(); ?>
                        </h5>
                        <div class="portfolio-icons">
                            <a class="portfolio-icon" href="<?php echo get_the_post_thumbnail_url( get_the_ID() , "original") ?>">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </a>
                            <a class="portfolio-icon" href="<?php the_permalink(); ?>">
                                <i class="fa fa-link" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <?php endwhile; ?>

        <?php wp_reset_query(); ?>

    </div>
</div>