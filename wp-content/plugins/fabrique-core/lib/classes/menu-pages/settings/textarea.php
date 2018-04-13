<?php

class Fabrique_Core_Admin_Setting_Textarea extends Fabrique_Core_Admin_Setting
{
	public function render_setting()
	{
		?>
		<textarea name="<?php echo esc_attr( $this->input_name ); ?>" id="<?php echo esc_attr( $this->input_name ); ?>"<?php echo ( !empty( $this->placeholder ) ) ? ' placeholder="' . esc_attr( $this->placeholder ) . '"' : ''; ?>><?php echo esc_textarea( $this->value ); ?></textarea>
		<?php

		$this->render_description();
	}

	public function sanitize_setting( $value )
	{
		return wp_kses_post( $value );
	}
}
