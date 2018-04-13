<?php

while($portfolio_posts->have_posts()) {

          $portfolio_posts->the_post();

          $terms = get_the_terms( get_the_ID() , 'project_category');
          $post_categories_string = "";

          foreach($terms as $term)
          {
              $post_categories_string .= $term->slug." ";
          }

          $post_categories_string = trim($post_categories_string);

?>
<div class="portfolio-single single-project-post mix col-xs-12 col-sm-6 col-md-4 <?php echo esc_attr($post_categories_string); ?>">
    <img src="<?php echo get_the_post_thumbnail_url( get_the_ID() , "grandpoza-rectangular-md-thumb" ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" />
    <div class="portfolio-hover">
        <div class="inner-hover">
            <h2 class="h5 t-uppercase pb-10 mb-5">
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h2>
            <span>
                <?php
                 $grandpoza_item_categories = get_the_category();
                 if(count($grandpoza_item_categories) > 0 )
                 {
                     echo $grandpoza_item_categories[0]->name;
                 }
                ?>
            </span>
        </div>
    </div>
</div>
<?php } wp_reset_query(); ?>