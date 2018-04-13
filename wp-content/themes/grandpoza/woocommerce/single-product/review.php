<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$verified = wc_review_is_from_verified_owner( $comment->comment_ID );
?>
    <li <?php comment_class( "review-single pt-30" ); ?> id="comment-<?php comment_ID() ?>">
        <div class="media">
            <div class="media-left">

                <?php 
                
                echo get_avatar( $comment , 90 , 'mysteryman' ,'' , array( 
                "width" => 90,
                "class" => array(
                    "media-object",
                    "mr-10",
                    "radius-4"
                    )
                )); 
                
                ?>

            </div>

            <div class="media-body">
                <div class="review-wrapper clearfix">

                    <ul class="list-inline">
                        <li>
                            <span class="review-holder-name h5">
                                <?php
                                comment_author();
                                if ( 'yes' === get_option( 'woocommerce_review_rating_verification_label' ) && $verified ) {
                                    echo '<em class="woocommerce-review__verified verified">(' . esc_attr__( 'verified owner', 'grandpoza' ) . ')</em> ';
                                }
                                ?>
                            </span>
                        </li>

                        <li><?php do_action( 'woocommerce_review_before_comment_meta', $comment ); ?></li>
                        <?php do_action( 'woocommerce_review_before_comment_text', $comment ); ?>
                    </ul>

                    <p class="review-date mb-5"><?php echo get_comment_date( wc_date_format() ); ?></p>
                    
                    <?php do_action( 'woocommerce_review_comment_text', $comment ); ?>
                    <?php do_action( 'woocommerce_review_after_comment_text', $comment ); ?>

                </div>
            </div>
        </div>
   
