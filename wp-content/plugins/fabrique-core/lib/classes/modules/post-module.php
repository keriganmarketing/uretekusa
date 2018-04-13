<?php

class Fabrique_Post_Module extends Fabrique_Base_Module
{
	const API_POST_SETTINGS = 'post/settings';
	const API_POST_SETTINGS_SAVE = 'post/settings-save';

	public function get_name()
	{
		return 'post';
	}

	public function start()
	{
		add_action( 'save_post', array( $this, 'save_post_type_settings' ), 10, 2 );
	}

	public function post_settings( $params )
	{
		$settings = null;

		if ( 'global' === $params['mode'] ) {
			$settings = get_theme_mod( 'post_settings' );
		} else {
			if ( isset( $params['postId'] ) ) {
				$settings = get_post_meta( $params['postId'], 'bp_post_settings', true );
			}	

			if ( empty( $settings ) ) {
				$settings = get_theme_mod( 'post_settings' );
			}
		}

		return $settings;
	}

	public function save_post_settings( $params )
	{
		$data = $params['data'];

		if ( 'global' === $params['mode'] ) {
			set_theme_mod( 'post_settings', $params['data'] );

			if ( isset( $params['postId'] ) && $params['postId'] ) {
				delete_post_meta( $params['postId'], 'bp_post_settings' );
			}
		} else {
			update_post_meta( $params['postId'], 'bp_post_settings', $data );
		}

		update_post_meta( $params['postId'], 'bp_post_settings_mode', $params['mode'] );

		return $params;
	}

	public function save_post_type_settings( $post_id, $post )
	{
		if ( isset( $_POST['bp_post_format_settings'] ) ) {
			$data = json_decode( stripslashes_deep($_POST['bp_post_format_settings'] ), true );
			update_post_meta( $post_id, 'bp_post_format_settings', $data );
		}
	}

	public function handle_api_action( $endpoint, $params )
	{
		switch ( $endpoint ) {
			case self::API_POST_SETTINGS:
				return $this->post_settings( $params );
			case self::API_POST_SETTINGS_SAVE:
				return $this->save_post_settings( $params );
			default:
				return false;
		}
	}
}
