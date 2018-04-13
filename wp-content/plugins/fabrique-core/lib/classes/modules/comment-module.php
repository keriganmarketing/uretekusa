<?php

class Fabrique_Comment_Module extends Fabrique_Base_Module
{
	public function get_name()
	{
		return 'comment';
	}

	public function start()
	{
		// Add rating field after other fields
		add_action( 'comment_form_logged_in_after', array( $this, 'add_rating_field' ) );
		add_action( 'comment_form_after_fields', array( $this, 'add_rating_field' ) );

		// Save comment meta data
		add_action( 'comment_post', array( $this, 'save_comment_meta_data' ) );

		// Verify if comment is rated
		add_filter( 'preprocess_comment', array( $this, 'verify_comment_meta_data' ), 10 );

		//Add an edit option in comment edit screen
		add_action( 'add_meta_boxes_comment', array( $this, 'extend_comment_add_meta_box' ) );

		// Update comment meta data from comment edit screen
		add_action( 'wp_insert_comment',  array( $this, 'extend_comment_edit_metafields' ), 10 );
		add_action( 'edit_comment', array( $this, 'extend_comment_edit_metafields' ), 10 );

		// Add the comment meta to the comment text
		add_filter( 'comment_text', array( $this, 'display_comment_content' ) );

		// Add review to comment
		add_action( 'before_each_comment_body', array( $this, 'display_comment_rating' ) );

		// Add hidden review average before comment list to make google detect schema
		add_action( 'before_comment_list', array( $this, 'add_hidden_average_rating' ) );

		// Add like/dislike to comment
		add_action( 'after_each_comment_body', array( $this, 'display_comment_like_dislike' ) );

		// Ajax like/dislike comment
		add_action( 'wp_ajax_comment_like_dislike', array( $this, 'comment_like_dislike_ajax' ) );
		add_action( 'wp_ajax_nopriv_comment_like_dislike', array( $this, 'comment_like_dislike_ajax' ) );
	}


	public function support_rating_types()
	{
		return apply_filters( 'support_rating_post_types', array() );
	}


	public function is_support_rating_type( $post_type = null )
	{
		$supported_types = $this->support_rating_types();
		$post_type = !empty( $post_type ) ? $post_type : get_post_type();

		return in_array( $post_type, $supported_types );
	}


	public function support_comment_like_types()
	{
		return apply_filters( 'support_comment_like_dislike_post_types', array() );
	}


	public function is_support_comment_like_type( $post_type = null )
	{
		$supported_types = $this->support_comment_like_types();
		$post_type = !empty( $post_type ) ? $post_type : get_post_type();

		return in_array( $post_type, $supported_types );
	}


	public function is_rating_required_field()
	{
		return apply_filters( 'comment_rating_required_field', true );
	}


	public function add_rating_field()
	{
		if ( $this->is_support_rating_type() ) {
			?>
				<div class="js-comment-form-rating comment-form-rating">
					<label><?php esc_html_e( 'Your Rating', 'fabrique-core' ); ?></label>
					<p class="stars">
						<span>
							<a class="star-5" href="#">5</a>
							<a class="star-4" href="#">4</a>
							<a class="star-3" href="#">3</a>
							<a class="star-2" href="#">2</a>
							<a class="star-1" href="#">1</a>
						</span>
					</p>
					<input type="hidden" name="rating" id="rating" value="" />
				</div>
			<?php
		}
	}


	public function save_comment_meta_data( $comment_id )
	{
		if ( isset( $_POST['rating'] ) && !empty( $_POST['rating'] ) ) {
			$rating = wp_filter_nohtml_kses( $_POST['rating'] );
			add_comment_meta( $comment_id, 'rating', $rating );
		}
	}


	public function verify_comment_meta_data( $comment )
	{
		$comment_post_type = get_post_type( $comment['comment_post_ID'] );
		$is_reply_comment = !empty( $comment['comment_parent'] );

		if ( $this->is_support_rating_type( $comment_post_type ) && !$is_reply_comment && $this->is_rating_required_field() ) {
			if ( !is_admin() && ( !isset( $_POST['rating'] ) || empty( $_POST['rating'] ) ) ) {
				wp_die( __( 'You did not add your rating. Please go back to resubmit your comment with rating.', 'fabrique-core' ) );
				return $comment;
			} else {
				return $comment;
			}
		} else {
			return $comment;
		}
	}


	public function extend_comment_add_meta_box()
	{
		$comment_id = get_comment_ID();
		$comment = get_comment( $comment_id );
		$comment_post_type = get_post_type( $comment->comment_post_ID );

		if ( $this->is_support_rating_type( $comment_post_type ) ) {
			add_meta_box(
				'title',
				__( 'Rating' ),
				array( $this, 'extend_comment_meta_box' ),
				'comment',
				'normal',
				'high'
			);
		}
	}


	public function extend_comment_meta_box( $comment )
	{
		$rating_labels = array(
			1 => __( 'Very Poor', 'fabrique-core' ),
			2 => __( 'Not too bad', 'fabrique-core' ),
			3 => __( 'Average', 'fabrique-core' ),
			4 => __( 'Good', 'fabrique-core' ),
			5 => __( 'Perfect', 'fabrique-core' )
		);
		$rating = get_comment_meta( $comment->comment_ID, 'rating', true );
		wp_nonce_field( 'extend_comment_update', 'extend_comment_update', false );
		?>
		<p>
			<style type="text/css">
				.commentrating-label {
					display: inline-block;
					min-width: 100px;
					vertical-align: middle;
				}
				.commentratingbox input[type="radio"] {
					display: none;
				}
				.commentrating-icons .dashicons {
					vertical-align: middle;
				}
				.commentratingbox input[type="radio"]:checked + .commentrating-icons {
					color: #d98500;
				}
			</style>
			<div class="commentratingbox">
			<?php for ( $i = 5; $i >= 1; $i-- ) : ?>
				<?php $checked = ( $rating == $i ) ? ' checked="checked"' : ''; ?>
				<div class="commentrating">
					<label>
						<span class="commentrating-label"><?php echo esc_html( $rating_labels[$i] ); ?></span>
						<input type="radio" name="rating" id="rating" value="<?php echo esc_attr( $i ); ?>"<?php echo fabrique_core_escape_content( $checked ); ?> />
						<span class="commentrating-icons">
						<?php for ( $j = 0; $j < $i; $j++ ) : ?>
							<span class="dashicons dashicons-star-filled"></span>
						<?php endfor; ?>
						</span>
					</label>
				</div>
			<?php endfor; ?>
			</div>
		</p>
		<?php
	}


	public function extend_comment_edit_metafields( $comment_id )
	{
		if ( !isset( $_POST['extend_comment_update'] ) || ! wp_verify_nonce( $_POST['extend_comment_update'], 'extend_comment_update' ) ) {
			return;
		}

		if ( isset( $_POST['rating'] ) && !empty( $_POST['rating'] ) ) {
			$rating = wp_filter_nohtml_kses( $_POST['rating'] );
			update_comment_meta( $comment_id, 'rating', $rating );
		} else {
			delete_comment_meta( $comment_id, 'rating');
		}
	}


	public function display_comment_content( $text )
	{
		$plugin_url_path = WP_PLUGIN_URL;
		$comment_id = get_comment_ID();

		if ( $rating = get_comment_meta( $comment_id, 'rating', true ) ) {
			$text .= '<p class="bp-comment-rating">';
			$text .= 	esc_html__( 'Rating :', 'fabrique-core' );

			for ( $i = 0; $i < (int)$rating; $i++ ) {
				$text .= '<span class="dashicons dashicons-star-filled" style="font-size: 1.25em; color:#d98500;"></span>';
			}

			$text .= '</p>';
		}

		if ( $likes = get_comment_meta( $comment_id, 'comment_likes', true ) ) {
			$text .= '<p class="bp-comment-like">';
			$text .= 	'<span class="dashicons dashicons-thumbs-up" style="font-size: 1.25em;"></span>';
			$text .=	esc_html( ' : ' . $likes );
			$text .= '</p>';
		}

		if ( $dislikes = get_comment_meta( $comment_id, 'comment_dislikes', true ) ) {
			$text .= '<p class="bp-comment-like">';
			$text .= 	'<span class="dashicons dashicons-thumbs-down" style="font-size: 1.25em; -moz-transform: scaleX(-1); -o-transform: scaleX(-1); -webkit-transform: scaleX(-1); transform: scaleX(-1);"></span>';
			$text .=	esc_html( ' : ' . $dislikes );
			$text .= '</p>';
		}

		return $text;
	}


	public function display_comment_rating( $comment )
	{
		if ( $rating = get_comment_meta( $comment->comment_ID, 'rating', true ) ) {
			$rating = (int)$rating;
			?>
			<div class="comment-rating" itemprop="reviewRating" itemscope="itemscope" itemtype="http://schema.org/Rating" title="<?php echo sprintf( esc_attr__( 'Rated %s out of 5', 'fabrique-core' ), $rating ); ?>">
				<span style="width:<?php echo esc_attr( $rating/5*100 ); ?>%;">
					<strong itemprop="ratingValue"><?php echo esc_attr( $rating ); ?></strong>
					<?php esc_html_e( ' out of 5', 'fabrique-core' ); ?>
				</span>
			</div>
			<?php
		} else {
			return;
		}
	}


	public function add_hidden_average_rating( $post_id )
	{
		$rating = $this->get_average_ratings( $post_id );
		if ( $rating ) {
			?>
			<div class="comment-rating average" itemprop="aggregateRating" itemscope="itemscope" itemtype="http://schema.org/AggregateRating">
				<span style="width:<?php echo esc_attr( $rating['value']/5*100 ); ?>%;">
					<strong itemprop="ratingValue"><?php echo esc_html( $rating['value'] ); ?></strong>
					<?php esc_html_e( ' out of ', 'fabrique-core' ); ?>
					<span itemprop="bestRating">5</span>
					<?php esc_html_e( ' based on ', 'fabrique-core' ); ?>
					<span itemprop="reviewCount"><?php echo esc_html( $rating['comments'] ); ?></span>
				</span>
			</div>
			<?php
		}
	}


	public function get_average_ratings( $post_id )
	{
		if ( empty( $post_id ) )
			return false;

		$count = 1;
		if ( $comment_array = get_approved_comments( $post_id ) ) {
			$i = 0;
			$total = 0;
			foreach ( $comment_array as $comment ) {
				$rating = get_comment_meta( $comment->comment_ID, 'rating', true );
				if ( isset( $rating ) && !empty( $rating ) ) {
					$i++;
					$total += (int)$rating;
				}
			}

			if ( 0 == $i ) {
				return false;
			} else {
				return array( 'value' => $total/$i, 'comments' => count( $comment_array ) );
			}
		} else {
			return false;
		}
	}


	public function display_comment_like_dislike( $comment )
	{
		if ( $this->is_support_comment_like_type() ) {
			$comment_id = $comment->comment_ID;
			$likes = get_comment_meta( $comment_id, 'comment_likes', true );
			$likes = $likes ? $likes : 0;
			$dislikes = get_comment_meta( $comment_id, 'comment_dislikes', true );
			$dislikes = $dislikes ? $dislikes : 0;

			$like_ips = get_comment_meta( $comment_id, 'comment_like_ips', true );
			$like_ips = ( !empty( $like_ips ) && is_array( $like_ips ) ) ? $like_ips : array();
			$user_ip = $this->get_user_ip();
			$user_clicked = in_array( $user_ip, $like_ips );

			$like_icon = apply_filters( 'comment_like_icon', 'ln-thumbs-up' );
			$dislike_icon = apply_filters( 'comment_dislike_icon', 'ln-thumbs-down' );
			?>

			<div class="comment-like-dislike">
				<div class="comment-like">
					<a href="#" class="comment-like-dislike-button" data-type="like" data-comment="<?php echo esc_attr( $comment_id ); ?>" data-user="<?php echo esc_attr( $user_ip ); ?>" data-clicked="<?php echo esc_attr( $user_clicked ); ?>">
						<i class="twf twf-<?php echo esc_attr( $like_icon ); ?>"></i>
					</a>
					<span class="comment-like-dislike-number"><?php echo esc_attr( $likes ); ?></span>
				</div>
				<div class="comment-dislike">
					<a href="#" class="comment-like-dislike-button" data-type="dislike" data-comment="<?php echo esc_attr( $comment_id ); ?>" data-user="<?php echo esc_attr( $user_ip ); ?>" data-clicked="<?php echo esc_attr( $user_clicked ); ?>">
						<i class="twf twf-<?php echo esc_attr( $dislike_icon ); ?>"></i>
					</a>
					<span class="comment-like-dislike-number"><?php echo esc_attr( $dislikes ); ?></span>
				</div>
			</div>
		<?php
		}
	}


	function comment_like_dislike_ajax()
	{
		if ( isset( $_POST['_wpnonce'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'ajax-nonce' ) ) {
			$comment_id = sanitize_text_field( $_POST['comment'] );
			$type = sanitize_text_field( $_POST['type'] );
			$user_ip = sanitize_text_field( $_POST['user'] );

			if ( 'like' === $type ) {
				$likes = get_comment_meta( $comment_id, 'comment_likes', true );

				if ( empty( $like_count ) ) {
					$likes = 0;
				}

				$likes++;
				$success = ( $check = update_comment_meta( $comment_id, 'comment_likes', $likes ) ) ? true : false;
				$response_array = array(
					'success' => $success,
					'latest_count' => $likes
				);
			} else {
				$dislikes = get_comment_meta( $comment_id, 'comment_dislikes', true );

				if ( empty( $dislike_count ) ) {
					$dislikes = 0;
				}

				$dislikes++;
				$success = ( $check = update_comment_meta( $comment_id, 'comment_dislikes', $dislikes ) ) ? true : false;
				$response_array = array(
					'success' => $success,
					'latest_count' => $dislikes
				);
			}

			$liked_ips = get_comment_meta( $comment_id, 'comment_like_ips', true );
			if ( empty( $liked_ips ) ) {
				$liked_ips = array();
			}

			if ( !in_array( $user_ip, $liked_ips ) ){
				$liked_ips[] = $user_ip;
			}

			update_comment_meta( $comment_id, 'comment_like_ips', $liked_ips );
			echo json_encode( $response_array );
			die();
		} else {
			die( __( 'Error, please check if the script has been enququed.', 'fabrique-core' ) );
		}
	}


	public function get_user_ip()
	{
		$client = @$_SERVER['HTTP_CLIENT_IP'];
		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote = $_SERVER['REMOTE_ADDR'];

		if ( filter_var( $client, FILTER_VALIDATE_IP ) ) {
			$ip = $client;
		} elseif ( filter_var( $forward, FILTER_VALIDATE_IP ) ) {
			$ip = $forward;
		} else {
			$ip = $remote;
		}

		return $ip;
	}
}
