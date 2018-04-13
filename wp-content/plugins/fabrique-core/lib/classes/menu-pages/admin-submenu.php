<?php

class Fabrique_Core_Admin_Submenu extends Fabrique_Core_Admin_Page
{
	public $parent_menu = null; // parent page slug
	public $manage_options = 'manage_options';

	public function add_admin_menu()
	{
		$callback = isset( $this->callback_action ) ? 'display_custom_menu_page' : 'display_menu_page';
		add_submenu_page(
			$this->parent_menu,
			$this->title,
			$this->title,
			$this->manage_options,
			$this->id,
			array( $this, $callback )
		);
	}
}
