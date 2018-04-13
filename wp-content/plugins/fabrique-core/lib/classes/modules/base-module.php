<?php

abstract class Fabrique_Base_Module
{
	/**
	 * Twist Core
	 */
	protected $fabrique_core;

	/**
	 * Module options
	 **/
	protected $options;

	/**
	 * Start module
	 **/
	abstract public function start();

	/**
	 * Get module name
	 **/
	abstract public function get_name();

	public function __construct( $fabrique_core, $options = array() )
	{
		$this->fabrique_core = $fabrique_core;
		$this->options = array_merge( $this->get_default_options(), $options );
	}

	/**
	 * Get module default options
	 **/
	public function get_default_options()
	{
		return array();
	}

	public function handle_api_action( $action, $params )
	{
		return false;
	}

	protected function add_action( $tag, $callback, $priority = 10, $accepted_args = 1)
	{
		$app_name = $this->fabrique_core->get_app_name();
		add_action( $app_name . '_' . $tag, $callback, $priority, $accepted_args );
	}

	protected function add_filter( $tag, $callback, $priority = 10, $accepted_args = 1)
	{
		$app_name = $this->fabrique_core->get_app_name();
		add_filter( $app_name . '_' . $tag, $callback, $priority, $accepted_args );
	}

	protected function apply_filters( $tag, $value )
	{
		$app_name = $this->fabrique_core->get_app_name();
		return apply_filters( $app_name . '_' . $tag, $value );
	}

	public function base_admin_redirect( $page, $notice_type = false, $notice_message = '' )
	{
		if ( $notice_type && !empty( $notice_message ) ) {
			set_transient( 'bp_admin_notice', array(
				'type' => $notice_type,
				'message' => $notice_message
			), 60 );
		}

		return wp_redirect( admin_url( 'admin.php?page=' . $page ) );
	}
}
