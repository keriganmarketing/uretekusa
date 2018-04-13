<?php

class Fabrique_Core_Admin_Setting_Text extends Fabrique_Core_Admin_Setting
{
	public function render_setting()
	{
		$class = ( isset( $this->class ) && !empty( $this->class ) ) ? ' class="' . esc_attr( $this->class ) . '"' : '';
		$placeholder = ( isset( $this->placeholder ) && !empty( $this->placeholder ) ) ? ' placeholder="' . esc_attr( $this->placeholder ) . '"' : '';
		?>

		<input<?php echo fabrique_core_escape_content( $class ); ?> name="<?php echo esc_attr( $this->input_name ); ?>" type="text" id="<?php echo esc_attr( $this->input_name ); ?>" value="<?php echo fabrique_core_escape_content( $this->value ); ?>"<?php echo fabrique_core_escape_content( $placeholder ); ?>/>

		<?php
		$this->render_description();
	}
}
