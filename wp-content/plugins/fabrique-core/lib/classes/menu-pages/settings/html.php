<?php

class Fabrique_Core_Admin_Setting_Html extends Fabrique_Core_Admin_Setting
{
	public function render_setting()
	{
		$this->render_description();
		echo fabrique_core_escape_content( $this->html );
	}
}
