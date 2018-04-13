
<div class="portfolio-area portfolio-area-4 pb-10">

    <div class="portfolio-wrapper row row-tb-15" id="portfolio-wrapper-area-4">
        <?php include dirname( __FILE__) ."/content-template-2.php"; ?>
    </div>

    <?php
    if($portfolio_posts->max_num_pages>1) { ?>
    <div class="pt-60">
        <button data-category="<?php echo esc_attr( $atts["category"] ); ?>" data-template="2" data-pull="<?php echo esc_attr( $atts["posts_count"] ); ?>" data-container="#portfolio-wrapper-area-4" class="btn btn-lg ajax-load-projects-btn">
            <?php esc_html_e( "Load More" , "grandpoza" ); ?>
            <i class="fa fa-refresh ml-10"></i>
        </button>
    </div>
    <?php  } ?>

</div>