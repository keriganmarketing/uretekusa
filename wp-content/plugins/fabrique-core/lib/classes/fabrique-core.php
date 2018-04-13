<?php

class Fabrique_Core implements ArrayAccess
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

		$this->register_module( new Fabrique_Core_Module( $this ) );
		$this->register_module( new Fabrique_Api_Module( $this ) );
		$this->register_module( new Fabrique_Blueprint_Module( $this ) );
		$this->register_module( new Fabrique_Comment_Module ( $this ) );
		$this->register_module( new Fabrique_Customize_Module( $this ) );
		$this->register_module( new Fabrique_Font_Module( $this ) );
		$this->register_module( new Fabrique_Post_Module( $this ) );
		$this->register_module( new Fabrique_Widget_module( $this ) );
		$this->register_module( new Fabrique_Import_Module( $this ) );

		if ( fabrique_core_woocommerce_activated() ) {
			$this->register_module( new Fabrique_Woocommerce_Module ( $this ) );
		}
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
