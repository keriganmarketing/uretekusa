<div class="portfolio-area prl-15 portfolio-area-1 pb-20">

    <div class="portfolio-filter">
        <div>
            <a href="#" class="filter" data-filter="all"><?php esc_html_e( "All" , "grandpoza"); ?></a>
        </div>
        <?php foreach($atts['categories'] as $portfolio_category){  ?>
        <div>
            <a href="#" class="filter" data-filter=".<?php echo strtolower($portfolio_category->slug); ?>">
                <?php echo $portfolio_category->name; ?>
            </a>
        </div>
        <?php } ?>
    </div>

    <div class="portfolio-wrapper row" id="portfolio-wrapper-area-1">
        <?php include dirname( __FILE__) ."/content-template-1.php"; ?>
    </div>

    <?php
    if( $portfolio_posts->max_num_pages > 1 ) { ?>
    <div class="pt-60">
        <button data-category="<?php echo esc_attr( $atts["category"] ); ?>" data-template="1" data-pull="<?php echo esc_attr($atts["posts_count"]); ?>" data-container="#portfolio-wrapper-area-1" class="btn btn-lg ajax-load-projects-btn">
            <?php esc_html_e( "Load More" , "grandpoza" ); ?>
            <i class="fa fa-refresh ml-10"></i>
        </button>
    </div>
    <?php  } ?>
</div>