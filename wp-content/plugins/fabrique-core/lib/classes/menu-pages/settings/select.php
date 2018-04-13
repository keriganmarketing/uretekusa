<?php

class Fabrique_Core_Admin_Setting_Select extends Fabrique_Core_Admin_Setting
{
	public $blank_option = true;
	public $options = array();

	public function render_setting()
	{
		?>
			<select name="<?php echo esc_attr( $this->input_name ); ?>" id="<?php echo esc_attr( $this->id ); ?>">
				<?php if ( $this->blank_option === true ) : ?>
					<option></option>
				<?php endif; ?>
				<?php foreach ( $this->options as $id => $title  ) : ?>
					<option value="<?php echo esc_attr( $id ); ?>"<?php echo ( $this->value == $id ) ? ' selected="selected"' : ''; ?>>
						<?php echo esc_html( $title ); ?>
					</option>
				<?php endforeach; ?>
			</select>
		<?php
		$this->render_description();
	}
}
