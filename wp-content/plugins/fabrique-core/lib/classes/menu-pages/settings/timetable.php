<?php

class Fabrique_Core_Admin_Setting_timetable extends Fabrique_Core_Admin_Setting
{
	public $extra_class = null;
	public $all_day = 'all day';
	public $schedule_type = 'date';
	public $multiple_selection = false;
	public $selection_key = null;

	public function localize_script()
	{
		global $timetable_settings;

		if ( !isset( $timetable_settings ) ) {
			$timetable_settings = array();
		}

		$timetable_settings[$this->id] = apply_filters( 'timetable_default_format' ,array(
			'timeInterval' 		=> 30,
			'timeFormat'		=> 'h:i A',
			'dateFormat'		=> 'yyyy/mm/dd',
			'template'			=> $this->get_each_template(),
		), $this );

		wp_localize_script(
			'fabrique-admin',
			'timetableArgs',
			array( 'settings' => $timetable_settings )
		);
	}


	public function get_weekdays()
	{
		return apply_filters( 'timetable_default_weekdays', array(
			'monday'	=> __( 'Mo', 'fabrique-core' ),
			'tuesday'	=> __( 'Tu', 'fabrique-core' ),
			'wednesday'	=> __( 'We', 'fabrique-core' ),
			'thursday'	=> __( 'Th', 'fabrique-core' ),
			'friday'	=> __( 'Fr', 'fabrique-core' ),
			'saturday'	=> __( 'Sa', 'fabrique-core' ),
			'sunday'	=> __( 'Su', 'fabrique-core' )
		) );
	}

	public function render_setting()
	{
		$this->render_description();
		$this->localize_script();

		?>
			<div class="bp-timetable" id="<?php echo esc_attr( $this->id ); ?>">
				<?php
					if ( !empty( $this->value ) ) {
						foreach ( $this->value as $id => $rule ) {
							echo fabrique_core_escape_content( $this->get_each_template( $id, $rule ) );
						}
					}
				?>
				<a href="#" class="bp-timetable-add button">
					<div class="dashicons dashicons-plus"></div><?php esc_html_e( 'Add rule', 'fabrique-core' ); ?>
				</a>
			</div>
		<?php
	}

	public function enable_multiple_select()
	{
		return ( $this->multiple_selection && !empty( $this->selection_key ) && is_array( $this->selection_options ) && !empty( $this->selection_options ) ) ? true : false;
	}

	public function get_each_template( $id = 0, $value = array() )
	{
		$enable_multiple_select = $this->enable_multiple_select();
		$selection_title = !empty( $this->selection_title ) ? $this->selection_title : $this->selection_key;
		$timetable_class = $enable_multiple_select ? 'bp-timetable-rule multiple-selection ' . $this->extra_class : 'bp-timetable-rule ' . $this->extra_class;

		ob_start();
		?>
		<div class="<?php echo esc_attr( $timetable_class ); ?>">
			<?php if ( !empty( $value ) ) : ?>
			<div class="bp-timetable-summary wp-clearfix">
				<strong class="bp-timetable-summary-date">
					<?php
						if ( isset( $value['date'] ) && !empty( $value['date'] ) ) {
							echo esc_html( $value['date'] );
						} elseif ( isset( $value['weekdays'] ) && is_array( $value['weekdays'] ) && !empty( $value['weekdays'] ) ) {
							if ( count( $value['weekdays'] ) < 7 ) {
								foreach ( array_keys( $value['weekdays'] ) as $index => $day ) {
									$day = ucfirst( substr( $day, 0, 3 ) );
									echo ( 0 != $index ) ? ', ' . $day : $day;
								}
							} else {
								esc_html_e( 'Every day', 'fabrique-core' );
							}
						}
					?>
				</strong>
				<div class="bp-timetable-summary-time">
					<div class="dashicons dashicons-clock"></div>
					<?php
						if ( empty( $value['time']['start'] ) && empty( $value['time']['end'] ) ) {
							echo esc_html( ucfirst( $this->all_day ) );
						} elseif ( empty( $value['time']['start'] ) ) {
							echo sprintf( __( 'End at %s', 'fabrique-core' ), $value['time']['end'] );
						} elseif ( empty( $value['time']['end'] ) ) {
							echo sprintf( __( 'Start at %s', 'fabrique-core' ), $value['time']['start'] );
						} else {
							echo sprintf( __( 'Open at %s &rsaquo; %s', 'fabrique-core' ), $value['time']['start'], $value['time']['end'] );
						}
					?>
				</div>
			<?php else : ?>
			<div class="bp-timetable-summary pending">
				<?php echo sprintf( esc_html__( "Select date and time below, and don't forget to click %s**SAVE**%s", 'fabrique-core' ), '<strong>', '</strong>' ); ?>
			<?php endif; ?>
				<a href="#" class="bp-timetable-delete">
					<div class="dashicons dashicons-no"></div>
				</a>
			</div>
			<div class="bp-timetable-detail">
				<div class="bp-timetable-detail-inner">
					<div class="bp-timetable-date">
						<?php if ( 'weekday' === $this->schedule_type ) : ?>
							<ul class="bp-timetable-weekdays">
							<?php foreach ( $this->get_weekdays() as $key => $label ) : ?>
							<?php $input_name = $this->input_name . '[' . $id . '][weekdays][' . $key . ']'; ?>
								<li>
									<input type="checkbox" name="<?php echo esc_attr( $input_name ); ?>" id="<?php echo esc_attr( $input_name ); ?>" value="1"<?php echo empty( $value['weekdays'][$key] ) ? '' : ' checked="checked"'; ?> data-day="<?php echo esc_attr( $key ); ?>">
									<label for="<?php echo esc_attr( $input_name ); ?>"><?php echo ucfirst( $label ); ?></label>
								</li>
							<?php endforeach; ?>
							</ul>
						<?php else : ?>
							<div class="bp-timetable-date-input">
								<?php $input_name = $this->input_name . '[' . $id . '][date]'; ?>
								<input type="text" name="<?php echo esc_attr( $input_name ); ?>" id="<?php echo esc_attr( $input_name ); ?>" placeholder="<?php esc_attr_e( 'Select Date', 'fabrique-core' ); ?>" value="<?php echo empty( $value['date'] ) ? '' : $value['date']; ?>">
							</div>
						<?php endif; ?>
					</div>
					<div class="bp-timetable-time">
						<div class="bp-timetable-note">
							<?php echo esc_html__( '*Leave time blank for ', 'fabrique-core' ) . esc_html( $this->all_day ); ?>
						</div>
						<div class="bp-timetable-time-input wp-clearfix">
							<div class="bp-timetable-time-start">
								<input type="text"
									name="<?php echo esc_attr( $this->input_name . '[' . $id . '][time][start]' ); ?>"
									id="<?php echo esc_attr( $this->input_name . '[' . $id . '][time][start]' ); ?>"
									placeholder="<?php esc_attr_e( 'Start Time', 'fabrique-core' ); ?>"
									value="<?php echo empty( $value['time']['start'] ) ? '' : $value['time']['start']; ?>"
								>
							</div>
							<div class="dashicons dashicons-arrow-right-alt2"></div>
							<div class="bp-timetable-time-end">
								<input type="text"
									name="<?php echo esc_attr( $this->input_name . '[' . $id . '][time][end]' ); ?>"
									id="<?php echo esc_attr( $this->input_name . '[' . $id . '][time][end]' ); ?>"
									placeholder="<?php esc_attr_e( 'End Time', 'fabrique-core' ); ?>"
									value="<?php echo empty( $value['time']['end'] ) ? '' : $value['time']['end']; ?>"
								>
							</div>
						</div>
					</div>
					<?php if ( $enable_multiple_select ) : ?>
						<div class="bp-timetable-selection">
							<div class="bp-timetable-note"><?php echo sprintf( esc_html__( 'Select %s', 'fabrique-core' ), $selection_title ); ?></div>
							<select id="<?php echo esc_attr( $this->input_name . '[' . $id . '][' . $this->selection_key . '][]' ); ?>"
								name="<?php echo esc_attr( $this->input_name . '[' . $id . '][' . $this->selection_key . '][]' ); ?>"
								multiple="multiple"
							>
								<?php foreach ( $this->selection_options as $key => $option ) : ?>
									<?php $selected = isset( $value[$this->selection_key] ) && is_array( $value[$this->selection_key] ) ? in_array( $key, $value[$this->selection_key] ) : false; ?>
									<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $selected ); ?>>
										<?php echo esc_html( $option ); ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<?php
		$output = ob_get_clean();

		return $output;
	}


	public function sanitize_setting( $value )
	{
		$output = array();

		if ( !is_array( $value ) || !count( $value ) ) {
			return $output;
		}

		foreach ( $value as $index => $rule ) {
			if ( !empty( $rule['weekdays'] ) ) {
				$output[$index]['weekdays'] = array();

				foreach ( $rule['weekdays'] as $day => $flag ) {
					if ( '1' !== $flag ||
					( 'monday' !== $day && 'tuesday' !== $day && 'wednesday' !== $day && 'thursday' !== $day && 'friday' !== $day && 'saturday' !== $day && 'sunday' !== $day ) ) {
						continue;
					}

					$output[$index]['weekdays'][$day] = $flag;
				}
			}

			if ( !empty( $rule['date'] ) ) {
				$date = new DateTime( $rule['date'] );
				if ( checkdate( $date->format( 'n' ), $date->format( 'j' ), $date->format( 'Y' ) ) ) {
					$output[$index]['date'] = sanitize_text_field( $rule['date'] );
				}
			}

			if ( !empty( $rule['time']['start'] ) ) {
				$output[$index]['time']['start'] = sanitize_text_field( $rule['time']['start'] );
			}

			if ( !empty( $rule['time']['end'] ) ) {
				$output[$index]['time']['end'] = sanitize_text_field( $rule['time']['end'] );
			}

			if ( $this->enable_multiple_select() ) {
				$output[$index][$this->selection_key] = !empty( $rule[$this->selection_key] ) ? array_unique( $rule[$this->selection_key] ) : array();
			}
		}

		return $output;
	}
}
