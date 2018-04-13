<?php

#--------------------------------------------------------------------------------------#
/**
 * ----------------------------------
 * THE THEME'S BLOG SIDEBAR
 * @author KappStudio
 * @version 1.0
 * @package Grandpoza WP Theme
 * --------------------------------
 * */
#--------------------------------------------------------------------------------------#

if ( ! is_active_sidebar( 'sidebar-blog' ) ) {
	return;
}

?>

<div class="page-sidebar pt-60 col-sm-4 col-md-3 col-xs-12">
    <aside class="sidebar">
        <?php dynamic_sidebar( 'sidebar-blog' ); ?>
    </aside>
</div>