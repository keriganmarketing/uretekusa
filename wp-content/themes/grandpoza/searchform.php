<?php
#--------------------------------------------------------------------------------------#
/**
 * ----------------------------------
 * DISPLAYS SEARCH FORM
 * @author KappStudio
 * @version 1.0
 * @package Grandpoza WP Theme
 * --------------------------------
 * */
#--------------------------------------------------------------------------------------#

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="field-search">
        <input type="search" value="<?php echo get_search_query(); ?>" name="s" class="form-control input-lg" placeholder="<?php esc_html_e( 'Search for...' , 'grandpoza' ); ?>" />
        <a href="#" class="btn-search">
            <i class="fa fa-search font-16"></i>
        </a>
    </div>
</form>
