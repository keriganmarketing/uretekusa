<?php

class Fabrique_Core_Admin_Menu extends Fabrique_Core_Admin_Page
{
	public $manage_options = 'manage_options';

	public function add_admin_menu()
	{
		$callback = isset( $this->callback_action ) ? 'print_custom_menu_page' : 'display_menu_page';

		add_menu_page(
			$this->title,
			$this->title,
			$this->manage_options,
			$this->id,
			array( $this, $callback ),
			$this->icon,
			$this->position
		);
	}
}
