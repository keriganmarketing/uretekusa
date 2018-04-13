<?php
#--------------------------------------------------------------------------------------#
/**
 * ----------------------------------
 * TEMPLATE TAGS
 * @author KappStudio
 * @version 1.0
 * @package Grandpoza WP Theme
 * --------------------------------
 * */
#--------------------------------------------------------------------------------------#

$grandpoza_page_content_wrapper_class = "page-content col-xs-12 ptb-60";

 /**
  * Comments list
  * @param mixed $comment
  * @param mixed $args
  * @param mixed $depth
  */
 function grandpoza_comment ($comment, $args, $depth) {

     if ( $comment->comment_approved == '0' ) {
         printf( '<p>%</p>' , esc_html__( 'Your comment is awaiting moderation', 'grandpoza' ) );
     }

     if ( 'div' === $args['style'] ) {
         $tag       = 'div';
         $add_below = 'comment';
     } else {
         $tag       = 'li';
         $add_below = 'div-comment';
     }

     $add_below = 'comment-wrapper';
?>

<?php echo '<'.$tag; ?> <?php comment_class( empty( $args['has_children'] ) ? 'comment' : 'parent comment' ) ?> id="comment-<?php comment_ID() ?>">

    <div class="comment-wrapper"  id="comment-wrapper-<?php comment_ID() ?>">
     
        <div class="comment-avatar">
            <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
        </div>
      

        <div class="comment-content">

            <div class="comment-meta">
                <a href="#" class="mr-20">
                    <i class="fa fa-clock-o mr-5"></i><?php comment_date("M d, Y"); ?>
                </a>

                <?php comment_reply_link( array_merge( $args, array( 'before'=>'<i class="fa fa-comments mr-5"></i>' , 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div>

            <h5 class="mb-15 color-theme"><?php comment_author(); ?></h5>
            <?php echo get_comment_text(); ?>
            <br />
        </div>
    </div>

<?php

 }

/**
 *  PAGINATION LINKS
 * @param mixed $query
 */
function grandpoza_pagination($query = null)
{
    global $paged,$wp_query;
    if($query == null)
    {
        $query = &$wp_query;
    }

    $query_vars = array();

    $base_url  = html_entity_decode( get_pagenum_link() );

    $vars = explode( '?' , $base_url );

    if( isset($vars[1]) ){
        wp_parse_str( $vars[1] , $query_vars );
    }

    $query_var_keys = array_keys( $query_vars );
    $base_url  = esc_url( remove_query_arg( $query_var_keys , $base_url ) );


   $args =  array(
        'base'            => $base_url . '%_%',
        'total'           => $query->max_num_pages,
        'current'         => $paged == 0 ? 1 : $paged,
        'show_all'        => False,
        'end_size'        => 1,
        'mid_size'        => 1,
        'before_page_number'=>'<span>',
        'after_page_number'=>'</span>',
        'prev_next'       => True,
        'prev_text'       => esc_html__('Previous','grandpoza'),
        'next_text'       => esc_html__('Next','grandpoza'),
        'type'            => 'plain',
        'add_args'        => false,
        'add_fragment'    => ''
     );

   echo '<nav><div class="page-pagination">'. paginate_links($args). '</div></nav>';
}

/**
 * PAGE LAYOUT OPENING TAGS
 */
function grandpoza_before_pagelayout()
{
    global $post;
    global $grandpoza_page_layout;
    global $grandpoza_page_content_wrapper_class;

    if( 'full' != $grandpoza_page_layout )
    {
        $container_class = 'wr-sidebar' == $grandpoza_page_layout || 'wl-sidebar' == $grandpoza_page_layout  ? "" :"prl-0";
        echo '<div class="container '.$container_class.'">';

        if( 'wr-sidebar' == $grandpoza_page_layout || 'wl-sidebar' == $grandpoza_page_layout)
        {
            $grandpoza_page_content_wrapper_class = 'page-content col-xs-12 col-md-9 col-sm-8 ptb-60';
            echo "<div class='row row-rl-20 prl-0'>";
        }

    }else {
        $grandpoza_page_content_wrapper_class = 'page';
    }
}

/**
 * PAGELAYOUT CLOSING TAGS
 */
function grandpoza_after_pagelayout()
{
    global $post;
    global $grandpoza_page_layout;
    if( 'full' != $grandpoza_page_layout )
    {
        if( 'wr-sidebar' == $grandpoza_page_layout || 'wl-sidebar' == $grandpoza_page_layout)
        {
            echo "</div>";
        }

        echo '</div>';

    }


}