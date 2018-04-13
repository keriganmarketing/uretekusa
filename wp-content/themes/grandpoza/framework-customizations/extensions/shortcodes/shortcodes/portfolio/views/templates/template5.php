
<div class="portfolio-area portfolio-area-4 prl-15">

    <div class="portfolio-filter">
        <div>
            <a href="#" class="filter" data-filter="all"><?php esc_html_e( "All" , "grandpoza" ); ?></a>
        </div>
        <?php foreach($atts['categories'] as $portfolio_category){  ?>
        <div>
            <a href="#" class="filter" data-filter=".<?php echo strtolower($portfolio_category->slug); ?>">
                <?php echo $portfolio_category->name; ?>
            </a>
        </div>
        <?php } ?>
    </div>

    <div class="portfolio-wrapper row">

        <?php
        
        while( $portfolio_posts->have_posts() ) {
                  $portfolio_posts->the_post();

                  $terms = get_the_terms( get_the_ID() , 'project_category');
                  $c = "";

                  foreach($terms as $term)
                  {
                      $c .= $term->slug." ";
                  }

                  $c = trim($c);

        ?>
        <div class="portfolio-single mix col-xs-12 col-sm-6 col-md-4 <?php echo esc_attr($c); ?>">
            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID() , "grandpoza-rectangular-md-thumb" ); ?>" alt="<?php echo get_the_title(); ?>" />

            <div class="portfolio-hover">
                <div class="inner-hover pos-tb-center t-left p-30">
                    <h5 class="color-theme mb-10"><?php the_title(); ?></h5>
                    <p class="mb-20"><?php echo get_the_excerpt(); ?></p>
                    <a href="<?php the_permalink(); ?>" class="btn"><?php esc_html_e( "Read More" , "grandpoza" ); ?></a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

    <div class="ptb-60">
        <?php grandpoza_pagination($portfolio_posts); ?>
    </div>
    <?php wp_reset_query(); ?>
</div>