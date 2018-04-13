<?php
/**
 * The main template file
 *
 * @package fabrique
 * @version 1.0.0
 */
?>

<?php
if ( post_password_required() )
	return;

if ( have_comments() ) {
	$comment_heading = get_comments_number() . ' ';
	$comment_heading .= ( get_comments_number() <= 1 ) ? esc_html__( 'Comment', 'fabrique' ) : esc_html__( 'Comments', 'fabrique' );
	fabrique_get_title( array( 'text' => $comment_heading ) );
	do_action( 'before_comment_list', fabrique_get_page_id() );
?>
	<ul class="fbq-comment-list fbq-p-border-border">
		<?php wp_list_comments( array( 'callback' => 'fabrique_template_comment_list', 'style' => 'ul' ) ); ?>
	</ul>
	<?php if ( get_comment_pages_count() > 1 ) : ?>
		<ul id="comment-nav-below" class="comment-navigation" role="navigation">
			<li class="comment-nav-button fbq-p-border-border"><?php previous_comments_link( esc_html__( 'Previous', 'fabrique' ) ); ?></li>
			<li class="comment-nav-button fbq-p-border-border"><?php next_comments_link( esc_html__( 'Next', 'fabrique' ) ); ?></li>
		</ul>
	<?php endif;
	do_action( 'after_comment_list', fabrique_get_page_id() );
} else {
	fabrique_get_title( array( 'text' => esc_html__( 'Comment', 'fabrique' ) ) ); ?>
	<div class="fbq-comment-list fbq-center-align fbq-no-comment">
		<span><?php esc_html_e( 'Be the first one who leave the comment.', 'fabrique' ); ?></span>
	</div>
<?php }
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = $req ? " aria-required='true'" : '';

	$author =	'<div class="fbq-row">';
	$author .=		'<div class="fbq-col-4">';
	$author .=			'<div class="form-container">';
	$author .=				'<input id="author" name="author" type="text" placeholder="' . esc_attr__( 'Name', 'fabrique' ) . '" value="' . esc_attr( $commenter['comment_author'] ) .'" ' . $aria_req . '/>';
	$author .=   		'</div>';
	$author .= 		'</div>';

	$email =		'<div class="fbq-col-4">';
	$email .=			'<div class="form-container">';
	$email .=				'<input id="email" name="email" type="text" placeholder="' . esc_attr__( 'Email', 'fabrique' ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) .'" ' . $aria_req . '/>';
	$email .=   		'</div>';
	$email .= 		'</div>';

	$url =			'<div class="fbq-col-4">';
	$url .=				'<div class="form-container">';
	$url .=					'<input id="url" name="url" type="text" placeholder="' . esc_attr__( 'Website', 'fabrique' ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) . '"/>';
	$url .=				'</div>';
	$url .=			'</div>';
	$url .=		'</div>';

	$comment_field =	'<div class="form-container">';
	$comment_field .=		'<textarea id="comment" placeholder="' . esc_attr__( 'Leave your comment here', 'fabrique' ) . '" name="comment" cols="45" rows="8" aria-required="true"></textarea>';
	$comment_field .=	'</div>';

	$args = array(
		'logged_in_as' => '',
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'fields' => array(
			'author' => $author,
			'email' => $email,
			'url' => $url
		),
		'comment_field' => $comment_field
	);
?>

<?php comment_form( $args ); ?>
