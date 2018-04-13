<?php

class Fabrique_Api_Module extends Fabrique_Base_Module
{
	private $error;

	public function get_name()
	{
		return 'api';
	}

	public function start()
	{
		add_action( 'wp_ajax_bp_api', array( $this, 'api_controller' ) );
	}

	public function api_controller()
	{
		if ( false === $this->validate_api_request() ) {
			$this->api_error_response();
		}

		$components = explode( '/', $_POST['endpoint'] );
		$module_name = $components[0];

		$module = $this->fabrique_core->get_module( $module_name );

		if ( $module ) {
			$params = isset( $_POST['params'] ) ? $_POST['params'] : array();
			$result = $module->handle_api_action( $_POST['endpoint'], $params );
		} else {
			$this->api_error_response( array(
				'error' => 'invalid_module',
				'error_message' => 'Invalid Module.'
			) );
		}

		if ( isset( $result['error'] ) ) {
			$this->api_error_response( $result['error'] );
		} else if ( false === $result || is_null( $result ) ) {
			$this->api_error_response( array(
				'error' => 'invalid_module_action',
				'error_message' => 'Invalid Module Action'
			) );
		}

		wp_send_json_success( $result );
	}

	private function api_error_response( $error = null )
	{
		if ( $this->error ) {
			$error = $this->error;
		} else if ( !$error && !$this->error ) {
			$error = array(
				'error' => 'api_fatal_error',
				'error_message' => 'API Fatal Error'
			);
		}

		wp_send_json_error( $error );
	}

	private function validate_api_request()
	{
		if ( !isset( $_POST['endpoint'] ) ) {
			$this->error = array(
				'error' => 'invalid_api_request',
				'error_message' => 'Invalid Endpoint.'
			);

			return false;
		}

		return true;
	}
}
