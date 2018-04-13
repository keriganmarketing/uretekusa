<?php
#--------------------------------------------------------------------------------------#
/**
 * ----------------------------------
 * THE THEME'S COMMENT TEMPLATE
 * @author KappStudio
 * @version 1.0
 * @package Grandpoza WP Theme
 * --------------------------------
 * */
#--------------------------------------------------------------------------------------#


if ( post_password_required() ) {
	return;
}

?>

<?php if ( have_comments() ) : ?>
<h3 class="h-title mb-30">
    <?php
          printf( esc_html( _nx( 'Comment (1)', 'comments (%1$s) ', get_comments_number(), 'comments title', 'grandpoza' ) ),
              number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
    ?>
</h3>

<ol class="comment-list">
    <?php
          wp_list_comments( array(
              'style'       => 'ol',
              'short_ping'  => true,
              'callback'    => 'grandpoza_comment',
              'avatar_size' => 100
          ) );
    ?>
</ol><!-- .comment-list -->

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' )) : ?>
<hr />

<nav role="navigation">
    <div class="row">
        <div class="col-sm-5">
            <h4>
                <?php esc_html_e( 'Comments Navigation', 'grandpoza' ); ?>
            </h4>
        </div>

        <div class="col-md-7 text-right">
            <div class="comments-pagination">
                <?php paginate_comments_links(); ?>
            </div>
        </div>
    </div>
</nav>
<hr />
<?php endif; ?>

<?php endif; // enf if have_comments() ?>

<div id="comments" class="comments-area"><?php
	
	if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
         <h3 class="mtb-30"><?php esc_html_e( 'Sorry comments are closed !', 'grandpoza' ); ?></h3>
    <?php endif; ?>

    <div class="leave-comment mt-40">
        <?php if(comments_open()) : ?>
        <h3 class="h-title mb-30"><?php esc_html_e( 'LEAVE A COMMNENT', 'grandpoza' ); ?></h3>
        <?php endif; ?>

        <?php

	    $commenter     = wp_get_current_commenter();
	    $req           = get_option( 'require_name_email' );
	    $aria_req      = ( $req ? " aria-required='true'" : '' );
	    $fields        = array(
		    'author' => '<div class="row"><div class="col-md-4 col-sm-6"><div class="comment-form-author form-group">' . '<label>'. esc_html__( 'Name *', 'grandpoza' ).'</label><input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div></div>',
		    'email'  => '<div class="col-md-4 col-sm-6"><div class="comment-form-email form-group">' . '<label>'. esc_html__( 'Email *', 'grandpoza' ).'</label> <input id="email" class="form-control" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div></div>',
		    'url'    => '<div class="col-md-4 col-sm-6"><div class="comment-form-url form-group">' . '<label>'. esc_html__( 'Website', 'grandpoza' ).'</label><input id="url" class="form-control" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div></div> </div>',
	    );
	    $comments_args = array(
		    // change the text of send button
		    'label_submit'          => esc_html__('POST COMMENT' , 'grandpoza' ),
		    'title_reply'           => '',
		    'comment_notes_after'   => '',
		    'comment_notes_before'  => '',
            'class_submit'          => 'btn msl-15',
            'class_form'            =>'',
		    'fields'                => apply_filters( 'comment_form_default_fields', $fields ),
		    'comment_field'         => '<div class="comment-form-comment form-group"><label>'. esc_html__( 'Comment *', 'grandpoza' ).'</label><textarea id="comment" rows="5" class="form-control" name="comment" aria-required="true"></textarea></div>',
	    );
	    comment_form( $comments_args );

        ?>
       
    </div>
</div>
