<?php while($portfolio_posts->have_posts()) {

          $portfolio_posts->the_post();


          $terms = get_the_terms( get_the_ID() , 'project_category');
          $post_categories_string = "";

          foreach($terms as $term)
          {
              $post_categories_string .= $term->slug." ";
          }

          $post_categories_string = trim($post_categories_string);

?>
<div class="mix col-xs-12 col-sm-6 col-md-4 pb-30 <?php echo esc_attr( $post_categories_string ); ?>">
    <div class="portfolio-single single-project-post">
        <img src="<?php echo get_the_post_thumbnail_url( get_the_ID() , "grandpoza-rectangular-md-thumb" ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" />

        <div class="portfolio-hover">
            <div class="inner-hover pos-tb-center">
                <h4 class="t-uppercase mb-20">
                    <?php echo get_the_title(); ?>
                </h4>
                <div class="portfolio-icons">
                    <a class="portfolio-icon" href="<?php echo get_the_post_thumbnail_url( get_the_ID() , "original"); ?>">
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
<?php } ?>