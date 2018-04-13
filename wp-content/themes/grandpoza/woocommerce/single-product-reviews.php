<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.2.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! comments_open() ) {
	return;
}

?>
<div id="product-reviews" class="product-review-wrapper">
	<div id="comments">
		<h2 class="woocommerce-Reviews-title"><?php
			if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) ) {
				/* translators: 1: reviews count 2: product name */
				printf( esc_html( _n( '%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'grandpoza' ) ), esc_html( $count ), '<span>' . get_the_title() . '</span>' );
			} else {
				esc_html_e( 'Reviews', 'grandpoza' );
			}
        ?>
        </h2>

		<?php if ( have_comments() ) : ?>

			<ol class="commentlist comment-list">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
                      echo "<hr/>";
				echo '<nav class="comments-pagination">';
				paginate_comments_links( );
				echo '</nav>';
			endif; ?>

		<?php else : ?>

			<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet', 'grandpoza' ); ?></p>

		<?php endif; ?>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>

 
		<div id="review_form_wrapper" class="pt-30">
			<div class="post-review" id="review_form">
                <?php
              $commenter = wp_get_current_commenter();

              $comment_form = array(
                  'title_reply'          => have_comments() ? esc_html__( 'Add a review', 'grandpoza' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'grandpoza' ), get_the_title() ),
                  'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'grandpoza' ),
                  'title_reply_before'   => '<h3 id="reply-title" class="h-title">',
                  'title_reply_after'    => '</h3>',
                  'comment_notes_before' => '',
                  'comment_notes_after'  => '',
                  'class_form'           => 'horizontal-form pt-30',
                  'fields'               => array(
                      'author' => '',
                      'email'  => '',
                  ),
                  'id_submit'            =>'review-submit-btn',
                  'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="btn mt-20" value="'.esc_html__('POST REVIEW','grandpoza').'" />',
                  'submit_field'         => '<div class="form-group text-right">%1$s %2$s</div>',
                  'logged_in_as'         => '',
                  'comment_field'        => '',
              );

              if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
                  $comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be <a href="%s">logged in</a> to post a review.', 'grandpoza' ), esc_url( $account_page_url ) ) . '</p>';
              }

              if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
                  $comment_form['comment_field'] = '
                        <div class="row">
                            <div class="col-md-6">
                                <input id="author" name="author" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" required /></div>
                            <div class="col-md-6"> ' .
                                    '<input id="email" class="form-control" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-required="true" required />
                            </div>
                        </div>
                        <div class="rating pl-5 select-rate list-inline ptb-20"><label>' . esc_html__( 'Your rating', 'grandpoza' ) . ': </label>
                        <span class="rating-stars rate-allow" data-target="#review-rating" data-rating="0"><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></span>
                        <select name="rating" id="review-rating" class="hidden" aria-required="true" required>
							<option value="">' . esc_html__( 'Rate&hellip;', 'grandpoza' ) . '</option>
							<option value="5">' . esc_html__( 'Perfect', 'grandpoza' ) . '</option>
							<option value="4">' . esc_html__( 'Good', 'grandpoza' ) . '</option>
							<option value="3">' . esc_html__( 'Average', 'grandpoza' ) . '</option>
							<option value="2">' . esc_html__( 'Not that bad', 'grandpoza' ) . '</option>
							<option value="1">' . esc_html__( 'Very poor', 'grandpoza' ) . '</option>
						</select></div>';
					}

              $comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Your review', 'grandpoza' ) . ' <span class="required">*</span></label><textarea id="comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true" required></textarea></p>';
			comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
                ?>
			</div>
		</div>

	<?php else : ?>

		<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review', 'grandpoza' ); ?></p>

	<?php endif; ?>

	<div class="clear"></div>
</div>
