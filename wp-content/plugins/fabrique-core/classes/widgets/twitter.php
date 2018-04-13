<?php

class Fabrique_Widget_Twitter extends Fabrique_Widget_Base
{
	protected function get_widget_options()
	{
		return array(
			'id' => 'fabrique_widget_twitter',
			'title' => esc_html__( 'Fabrique Twitter', 'fabrique-core' ),
			'widget_options' => array(
				'description' => 'Fabrique Twitter',
				'classname' => 'fbq-widget fbq-widget-twitter'
			),
		);
	}

	public function widget( $args, $instance )
	{
		$twitter_username = $instance['twitter_username'];
		$display_num = $instance['display_num'];
		$consumer_key = $instance['consumer_key'];
		$consumer_secret = $instance['consumer_secret'];
		$access_token = $instance['access_token'];
		$access_token_secret = $instance['access_token_secret'];
		$cache_time = $instance['cache_time'];
		$fbq_twitter = get_option( 'fbq_twitter', array() );

		if ( !is_array( $fbq_twitter ) && !empty( $fbq_twitter ) ) {
			$fbq_twitter = unserialize( $fbq_twitter );
		}

		if ( !is_array($fbq_twitter) ) {
			$fbq_twitter = array();
		}

		if ( empty( $fbq_twitter[$twitter_username][$display_num]['data'] ) ||
		empty( $fbq_twitter[$twitter_username][$display_num]['cache_time'] ) ||
		time() - intval( $fbq_twitter[$twitter_username][$display_num]['cache_time'] ) >= ( $cache_time * 3600 ) ) {

			$tweets_data = fabrique_get_tweets( $consumer_key, $consumer_secret, $access_token, $access_token_secret, $twitter_username, $display_num );

			if ( !empty( $tweets_data ) ) {
				$fbq_twitter[$twitter_username][$display_num]['data'] = $tweets_data;
				$fbq_twitter[$twitter_username][$display_num]['cache_time'] = time();
				update_option( 'fbq_twitter', $fbq_twitter );
			}
		} else {
			$tweets_data = $fbq_twitter[$twitter_username][$display_num]['data'];
		}

		$widget = '<div class="fbq-widget-item fbq-twitter">';

		if ( is_string( $tweets_data ) ) {
			$widget .= $tweets_data;
		} else {
			foreach( $tweets_data as $tweet_data ){
				$widget .= '<div class="fbq-twitter-item">';
				$widget .=   '<div class="fbq-twitter-media"><i class="twf twf-twitter"></i></div>';
				$widget .=   '<div class="fbq-twitter-body">' . utf8_decode( $tweet_data ) . '</div>';
				$widget .= '</div>';
			}
		}

		$widget .= '</div>';

		$this->display_widget ( $widget, $args, $instance );
	}

	public function form( $instance )
	{
		// Title
		$field = 'title';
		$value =  ( !empty( $instance[$field] ) ) ? $instance[$field] : null;

		$output  = $this->render_text( $field, esc_attr( $value ), array(
			'label' => esc_html__( 'Title', 'fabrique-core' )
		));

		// Username
		$field = 'twitter_username';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : '';

		$output .= $this->render_text( $field, $value, array(
			'label' => esc_html__( 'Username', 'fabrique-core' )
		));

		// No. Of Tweets
		$field = 'display_num';
		$value = ( !empty($instance[$field] ) ) ? $instance[$field] : '';

		$output .= $this->render_text( $field, $value, array(
			'label' => esc_html__( 'No. of Tweets to display', 'fabrique-core' )
		));

		// Consumer Key
		$field = 'consumer_key';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : '';

		$output .= $this->render_text( $field, $value, array(
			'label' => esc_html__( 'Consumer Key', 'fabrique-core' )
		));

		// Consumer Secret
		$field = 'consumer_secret';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : '';

		$output .= $this->render_text( $field, $value, array(
			'label' => esc_html__( 'Consumer Secret', 'fabrique-core' )
		));

		// Access Token
		$field = 'access_token';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : '';

		$output .= $this->render_text( $field, $value, array(
			'label' => esc_html__( 'Access Token', 'fabrique-core' )
		));

		// Access Token Secret
		$field = 'access_token_secret';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : '';

		$output .= $this->render_text( $field, $value, array(
			'label' => esc_html__( 'Access Token Secret', 'fabrique-core' )
		));

		// Cache Time
		$field = 'cache_time';
		$value = ( !empty( $instance[$field] ) ) ? $instance[$field] : '';

		$output .= $this->render_text( $field, $value, array(
			'label' => esc_html__( 'Cache Time (hour)', 'fabrique-core' )
		));

		echo fabrique_core_escape_content( $output );
	}
}
