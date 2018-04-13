<?php

class Fabrique_Theme implements ArrayAccess
{
	/**
	 * @var string
	 */
	protected $app_name;

	/**
	 * @var array
	 */
	protected $options;

	/**
	 * @var array
	 */
	protected $template_args;

	/**
	 * @var array
	 **/
	protected $modules;

	public function __construct( $app_name, $options = array() )
	{
		$this->app_name = $app_name;
		$this->options = $options;
		$this->modules = array();
		$this->template_args = array();
	}

	public function offsetSet( $offset, $value )
	{
		if ( is_null( $offset ) ) {
			$this->options[] = $value;
		} else {
			$this->options[$offset] = $value;
		}
	}

	public function offsetExists( $offset )
	{
		return isset($this->options[$offset]);
	}

	public function offsetUnset( $offset )
	{
		unset($this->options[$offset]);
	}

	public function offsetGet( $offset )
	{
		return isset($this->options[$offset]) ? $this->options[$offset] : null;
	}

	public function start()
	{
		foreach ( $this->modules as $module ) {
			$module->start();
		}
	}

	public function register_module( $module )
	{
		$this->modules[$module->get_name()] = $module;
	}

	public function get_module( $name )
	{
		return ( isset( $this->modules[$name] ) ) ? $this->modules[$name] : null;
	}

	public function get_app_name()
	{
		return $this->app_name;
	}

	public function set_template_args( $template , $args )
	{
		$this->template_args[$template] = $args;
	}

	public function get_template_args( $template )
	{
		return $this->template_args[$template];
	}
}
