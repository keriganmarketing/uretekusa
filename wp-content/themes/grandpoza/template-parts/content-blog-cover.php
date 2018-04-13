<?php
if( !(is_page() && is_front_page() ) ) {

$grandpoza_cover_image = get_theme_mod( "blog_page_cover" );

$_thumbnail = get_the_post_thumbnail_url( get_the_ID() , "original" );

if( $_thumbnail != false )
{
    $grandpoza_cover_image = $_thumbnail;
}

?>

<section class="section breadcrumb-area pt-100 pb-70 bg-ct" data-bg-img="<?php echo esc_url( $grandpoza_cover_image ) ; ?>">
    <div class="container t-center">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-xs-12 text-center">
                <div class="section-top-title">

                    <h1 class="t-uppercase font-45">

                        <?php

                        /* === TITLE DISKPLAYED ON THE COVER ==== */

                        if( is_home() ){
                            bloginfo( "name" );
                        }

                        if( is_singular() )
                        {
                            echo get_the_title();
                        }

                        if( is_search() )
                        {
                            printf( esc_html__( 'Search Results for: %s', 'grandpoza' ), '<span>' . get_search_query() . '</span>' );
                        }

                        if(is_404())
                        {
                            esc_html_e( "NOT FOUND" , "grandpoza" );
                        }

                        if( is_category() || is_tag() || is_archive() )
                        {
                            echo get_the_archive_title();
                        }

                        ?>

                    </h1>

                    <?php if( function_exists( 'kapp_breadcrumb' ) && !is_front_page() ) kapp_breadcrumb(); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php } ?>