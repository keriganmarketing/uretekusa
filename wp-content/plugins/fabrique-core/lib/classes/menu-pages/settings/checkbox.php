<?php

class Fabrique_Core_Admin_Setting_Checkbox extends Fabrique_Core_Admin_Setting
{
	public function render_setting()
	{
		?>
			<input type="checkbox" name="<?php echo esc_attr( $this->input_name ); ?>" id="<?php echo esc_attr( $this->input_name ); ?>" value="1"<?php echo ( '1' === $this->value ) ? ' checked="checked"' : ''; ?>>
			<label for="<?php echo esc_attr( $this->input_name ); ?>">
				<?php echo fabrique_core_escape_content( $this->label ); ?>
			</label>
		<?php

		if ( !empty( $this->description ) ) {
			echo '<hr>';
		}

		$this->render_description();
	}
}
