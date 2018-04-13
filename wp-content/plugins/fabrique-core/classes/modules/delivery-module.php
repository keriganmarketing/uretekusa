<?php

class Fabrique_Delivery_Module extends Fabrique_Base_Module
{
	public function get_name()
	{
		return 'delivery';
	}

	public function start()
	{
		// add new tab to woocommerce setting page
		add_action( 'init', array( $this, 'load_settings_panel' ) );

		// Sanitize settings
		add_filter( 'sanitize_option_delivery-settings', array( $this, 'sanitize_delivery_setting' ), 100 );

		if ( $this->get_delivery_setting( 'delivery-enable' ) ) {
			// Add fields to checkout page
			add_action( 'woocommerce_after_order_notes', array( $this, 'delivery_checkout_field' ) );
			add_action( 'woocommerce_checkout_process',  array( $this, 'delivery_checkout_field_process' ) );
			add_action( 'woocommerce_checkout_update_order_meta', array( $this, 'delivery_checkout_field_update' ) );
			add_action( 'woocommerce_admin_order_data_after_billing_address', array( $this, 'delivery_checkout_field_display_meta' ), 10, 1 );
			add_action( 'woocommerce_order_details_after_order_table', array( $this, 'delivery_checkout_order_detail_display' ), 10, 1 );
			add_filter( 'woocommerce_email_order_meta_keys', array( $this, 'delivery_checkout_field_order_meta_keys' ) );

			// Add sortable columns of delivery date and time
			add_filter( 'manage_edit-shop_order_columns', array( $this, 'columns_head' ) );
			add_action( 'manage_shop_order_posts_custom_column', array( $this, 'columns_content' ), 10, 2 );
			add_filter( 'manage_edit-shop_order_sortable_columns', array( $this, 'sortable_column' ) );

			if ( $this->get_delivery_setting( 'admin-email-notification' ) ) {
				// hook after order complete or processing in case of pay cash on delivery
				add_action( 'woocommerce_order_status_processing', array( $this, 'processing_delivery_notification' ) );
				add_action( 'woocommerce_order_status_completed', array( $this, 'complete_delivery_notification' ) );
				add_action( 'delivery_notify_email', array( $this, 'send_notify_email' ) );
			}
		}
	}

	public function load_settings_panel()
	{
		require_once( CORE_PLUGIN_DIR . '/lib/classes/fabrique-menu-pages.php' );
		$admin_page = new Fabrique_Core_Menu_Pages;

		$admin_page->add_submenu(
			array(
				'id' => 'delivery-settings',
				'title' => __( 'Delivery', 'fabrique-core' ),
				'parent_menu' => 'woocommerce',
				'description' => '',
				'default_tab' => 'delivery-general'
			)
		);

		$admin_page->add_section(
			array(
				'id' => 'delivery-general',
				'page' => 'delivery-settings',
				'title' => __( 'General', 'fabrique-core' ),
				'is_tab' => true
			)
		);

		$admin_page->add_setting(
			array(
				'id' => 'delivery-enable',
				'page' => 'delivery-settings',
				'section' => 'delivery-general',
				'type' => 'checkbox',
				'title' => __( 'Enable Delivery', 'fabrique-core' ),
				'label' => __( 'Check this option to enable delivery.', 'fabrique-core' ),
				'description' => __( 'This will allow customer to select delivery date and time in WooCommerce checkout page.' )
			)
		);

		$admin_page->add_setting(
			array(
				'id' => 'date-format',
				'page' => 'delivery-settings',
				'section' => 'delivery-general',
				'type' => 'text',
				'title' => __( 'Date Format', 'fabrique-core' ),
				'description' => sprintf(
					__( 'Define how the date is formatted on the delivery form. %sFormatting rules%s.', 'fabrique-core' ),
					'<a target="_blank" href="http://amsul.ca/pickadate.js/date/#formats">',
					'</a>'
				),
				'placeholder' => $this->get_default_setting( 'date-format' )
			)
		);

		$admin_page->add_setting(
			array(
				'id' => 'time-format',
				'page' => 'delivery-settings',
				'section' => 'delivery-general',
				'type' => 'select',
				'title' => __( 'Time Format', 'fabrique-core' ),
				'blank_option' => false,
				'options' => apply_filters( 'delivery_time_formats_options', array(
					'h:i A' => __( '12h', 'fabrique-core' ),
					'HH:i' => __( '24h', 'fabrique-core' )
				) )
			)
		);

		$admin_page->add_setting(
			array(
				'id' => 'early-delivery',
				'page' => 'delivery-settings',
				'section' => 'delivery-general',
				'type' => 'select',
				'title' => __( 'Early Delivery', 'fabrique-core' ),
				'blank_option' => false,
				'options' => apply_filters( 'fabrique_early_delivery_options', array(
					'365' => __( 'Any time', 'fabrique-core' ),
					'1' => __( '1 day', 'fabrique-core' ),
					'3' => __( '3 days', 'fabrique-core' ),
					'5' => __( '5 days', 'fabrique-core' ),
					'7' => __( '1 week', 'fabrique-core' ),
					'10' => __( '10 days', 'fabrique-core' ),
					'14' => __( '2 weeks', 'fabrique-core' ),
					'21' => __( '3 weeks', 'fabrique-core' ),
					'30' => __( '30 days', 'fabrique-core' ),
					'60' => __( '60 days', 'fabrique-core' ),
					'90' => __( '90 days', 'fabrique-core' )
				) )
			)
		);

		$admin_page->add_setting(
			array(
				'id' => 'late-delivery',
				'page' => 'delivery-settings',
				'section' => 'delivery-general',
				'type' => 'select',
				'title' => __( 'Late Delivery', 'fabrique-core' ),
				'description' => __( 'Select how late customers can order delivery.', 'fabrique-core' ),
				'blank_option' => false,
				'options' => array(
					'' => __( 'No limit', 'fabrique-core' ),
					'30' => __( '30 minutes in advance', 'fabrique-core' ),
					'60' => __( '1 hour in advance', 'fabrique-core' ),
					'120' => __( '2 hours in advance', 'fabrique-core' ),
					'240' => __( '4 hours in advance', 'fabrique-core' ),
					'360' => __( '6 hours in advance', 'fabrique-core' ),
					'720' => __( '12 hours in advance', 'fabrique-core' ),
					'10080' => __( '1 week in advance', 'fabrique-core' ),
					'sameday' => __( 'Block same-day delivery', 'fabrique-core' ),
				)
			)
		);

		$admin_page->add_setting(
			array(
				'id' => 'time-interval',
				'page' => 'delivery-settings',
				'section' => 'delivery-general',
				'type' => 'select',
				'title' => __( 'Time Interval', 'fabrique-core' ),
				'blank_option' => false,
				'options' => array(
					'60' => __( '60 minutes', 'fabrique-core' ),
					'30' => __( '30 minutes', 'fabrique-core' ),
					'15' => __( '15 minutes', 'fabrique-core' )
				)
			)
		);

		$admin_page->add_section(
			array(
				'id' => 'delivery-schedule',
				'page' => 'delivery-settings',
				'title' => __( 'Schedule', 'fabrique-core' ),
				'is_tab' => true
			)
		);

		$admin_page->add_setting(
			array(
				'id' => 'scheduleopen',
				'page' => 'delivery-settings',
				'section' => 'delivery-schedule',
				'type' => 'timetable',
				'title' => __( 'Delivery Hours', 'fabrique-core' ),
				'description' => sprintf( __( 'Add schedule during which time you deliver. %s**This require at least one rule.%s', 'fabrique-core' ), '<strong style="color:red;">', '</strong>' ),
				'schedule_type' => 'weekday',
				'extra_class' => 'opening-hour',
				'all_day' => __( 'deliver all day', 'fabrique-core' )
			)
		);

		$admin_page->add_setting(
			array(
				'id' => 'scheduleclose',
				'page' => 'delivery-settings',
				'section' => 'delivery-schedule',
				'type' => 'timetable',
				'title' => __( 'Delivery Off Hours', 'fabrique-core' ),
				'description' => __( "Define special delivery hours or leave time empty for disable delivery all day.", 'fabrique-core' ),
				'schedule_type' => 'date',
				'extra_class' => 'off-hour',
				'all_day' => __( 'close all day', 'fabrique-core' )
			)
		);

		$admin_page->add_section(
			array(
				'id' => 'delivery-notifications',
				'page' => 'delivery-settings',
				'title' => __( 'Notifications', 'fabrique-core' ),
				'is_tab' => true
			)
		);

		$admin_page->add_setting(
			array(
				'id' => 'admin-email-notification',
				'page' => 'delivery-settings',
				'section' => 'delivery-notifications',
				'type' => 'checkbox',
				'title' => __( 'Admin Notification', 'fabrique-core' ),
				'label' => __( 'Send notification email to admin before delivery.', 'fabrique-core' )
			)
		);

		$admin_page->add_setting(
			array(
				'id' => 'admin-email-address',
				'page' => 'delivery-settings',
				'section' => 'delivery-notifications',
				'type' => 'text',
				'title' => __( 'Admin Email Address', 'fabrique-core' ),
				'description' => __( 'The email address where delivery notifications should be sent.', 'fabrique-core' ),
				'placeholder' => $this->get_default_setting( 'admin-email-address' ),
				'class' => 'regular-text'
			)
		);

		$admin_page->add_setting(
			array(
				'id' => 'delivery-notify-time',
				'page' => 'delivery-settings',
				'section' => 'delivery-notifications',
				'type' => 'select',
				'title' => __( 'Notify Time', 'fabrique-core' ),
				'description' => __( 'Select time to send notify email prior to delivery time.', 'fabrique-core' ),
				'blank_option' => false,
				'options' => array(
					'' => __( 'On Time', 'fabrique-core' ),
					'1800' => __( '30 minutes in advance', 'fabrique-core' ),
					'3600' => __( '1 hour in advance', 'fabrique-core' ),
					'7200' => __( '2 hours in advance', 'fabrique-core' ),
					'14400' => __( '4 hours in advance', 'fabrique-core' ),
					'43200' => __( '12 hours in advance', 'fabrique-core' ),
					'86400' => __( '1 day in advance', 'fabrique-core' ),
					'172800' => __( '2 days in advance', 'fabrique-core' ),
				)
			)
		);

		$admin_page->add_admin_pages();
	}

	// call back function for sanitize_delivery_setting
	public function sort_by_date( $x, $y )
	{
		$x_date = empty( $x['date'] ) ? 0 : strtotime( $x['date'] );
		$y_date = empty( $y['date'] ) ? 0 : strtotime( $y['date'] );

		return $x_date - $y_date;
	}

	// Sort off hours schedule and remove old schedule
	public function sanitize_delivery_setting( $val )
	{
		if ( empty( $val['scheduleclose'] ) ) {
			return $val;
		}

		// Sort by date
		$schedule_close = $val['scheduleclose'];
		usort( $schedule_close, array( $this, 'sort_by_date' ) );

		$oldest_time = time() - 86400;

		for ( $i = 0; $i < count( $schedule_close ); $i++ ) {
			if ( strtotime( $schedule_close[$i]['date'] ) > $oldest_time ) {
				break;
			}
		}

		if ( $i > 0 ) {
			$schedule_close = array_slice( $schedule_close, $i );
		}

		$val['scheduleclose'] = $schedule_close;

		return $val;
	}

	// Add delivery fields to checkout page
	public function delivery_checkout_field( $checkout )
	{
		echo '<div class="checkout-delivery" id="delivery_checkout_field">';
		echo '<input class="js-picker-object" type="hidden" value="' . esc_attr( json_encode( $this->delivery_get_picker_object() ) ) . '" />';
		echo '<h3 class="with-description">' . __( 'Delivery Schedule', 'fabrique-core' ) . '</h3>';
		echo '<p class="description">Enter your desired delivery time or leave blank, if you don\'t have one.</p>';

		woocommerce_form_field( 'delivery_date', array(
			'type'          => 'text',
			'class'         => array( 'delivery-field form-row-first' ),
			'label'         => __( 'Delivery Date' ),
			'placeholder'   => __( 'Enter delivery date.' ),
		), $checkout->get_value( 'delivery_date' ) );

		woocommerce_form_field( 'delivery_time', array(
			'type'          => 'text',
			'class'         => array( 'delivery-field form-row-last' ),
			'label'         => __( 'Delivery Time' ),
			'placeholder'   => __( 'Enter delivery time.' ),
		), $checkout->get_value( 'delivery_time' ) );


		echo '</div>';
	}

	// Save delivery data
	public function delivery_checkout_field_update( $order_id )
	{
		if ( !empty( $_POST['delivery_date'] ) ) {
			update_post_meta(
				$order_id,
				'Delivery Date',
				sanitize_text_field( $_POST['delivery_date'] )
			);
		}

		if ( !empty( $_POST['delivery_time'] ) ) {
			update_post_meta(
				$order_id,
				'Delivery Time',
				sanitize_text_field( $_POST['delivery_time'] )
			);
		}
	}

	// Display delivery detail in order admin page
	public function delivery_checkout_field_display_meta( $order )
	{
		echo '<p><strong>' . __( 'Delivery', 'fabrique-core' ) . ':</strong> ';
		echo 	fabrique_core_escape_content( $this->get_delivery_date_and_time( $order->get_id() ) );
		echo '</p>';
		echo '<p><strong>' . __( 'Delivery Status', 'fabrique-core' ) . ':</strong> ';
		echo 	get_post_meta( $order->get_id(), 'Delivery Status', true );
		echo '</p>';
	}

	// Display delivery detail in order summary page
	public function delivery_checkout_order_detail_display( $order )
	{
		echo '<p><strong>' . __( 'Delivery', 'fabrique-core' ) . ':</strong> ' . $this->get_delivery_date_and_time( $order->get_id() ). '</p>';
	}

	// Display delivery detail in email
	public function delivery_checkout_field_order_meta_keys( $keys )
	{
		$keys[] = 'Delivery Date';
		$keys[] = 'Delivery Time';

		return $keys;
	}

	public function columns_head( $columns )
	{
		$columns['delivery'] = esc_html__( 'Delivery', 'fabrique-core' );

		return $columns;
	}

	public function columns_content( $column_name, $post_id )
	{
		if ( 'delivery' === $column_name ) {
			echo esc_html( $this->get_delivery_date_and_time( $post_id ) );

			$delivery_status = get_post_meta( $post_id, 'Delivery Status', true );
			if ( !empty( $delivery_status ) ) {
				if ( 'pending' === $delivery_status ) {
					$color = '#a00';
				} elseif ( 'cancel' === $delivery_status ) {
					$color = 'red';
				} else {
					$color = '#7ad03a';
				}
				echo sprintf( esc_html__( '%sStatus: %s', 'fabrique-core' ), '<br>', '<strong style="color:' . esc_attr( $color ) . ';">' . $delivery_status . '</strong>' );
			}
		}
	}

	// Sort delivery column
	public function sortable_column( $columns )
	{
		$columns['delivery'] = 'meta_value';

		return $columns;
	}

	// Display delivery date and time
	public function get_delivery_date_and_time( $post_id )
	{
		$output = '';
		$date = get_post_meta( $post_id, 'Delivery Date', true );
		$time = get_post_meta( $post_id, 'Delivery Time', true );

		if ( !empty( $date ) ) {
			$output .= $date;

			if ( !empty( $time ) ) {
				$output .= ' ' . $time;
			}
		}

		return $output;
	}

	// Get default setting value
	public function get_default_setting( $key )
	{
		$default_settings = apply_filters( 'delivery_default_settings' ,array(
			'date-format' => 'mmmm d, yyyy',
			'time-format' => 'h:i A',
			'time-interval' => '30',
			'admin-email-address' => get_option( 'admin_email' )
		) );

		return isset( $default_settings[$key] ) ? $default_settings[$key] : null;
	}

	// Get setting value
	public function get_delivery_setting( $key )
	{
		$settings = get_option( 'delivery-settings' );
		$default = $this->get_default_setting( $key );

		if ( is_array( $settings ) && !empty( $settings[$key] ) ) {
			return !is_numeric( $settings[$key] ) ? $settings[$key] : (int)( $settings[$key] );
		} elseif ( !empty( $default ) ) {
			return !is_numeric( $default ) ? $default : (int)( $default );;
		} else {
			return null;
		}
	}

	// Disable rules of delivery
	public function delivery_disable_rules( $first_day )
	{
		$disable_rules = array();
		$disabled_weekdays = array(
			'sunday'	=> ( 1 - $first_day ) === 0 ? 7 : 1,
			'monday'	=> 2 - $first_day,
			'tuesday'	=> 3 - $first_day,
			'wednesday'	=> 4 - $first_day,
			'thursday'	=> 5 - $first_day,
			'friday'	=> 6 - $first_day,
			'saturday'	=> 7 - $first_day,
		);

		$enabled_dates = array();
		// Get disabled weekday
		$schedule_open = $this->get_delivery_setting( 'scheduleopen' );
		if ( is_array( $schedule_open ) ) {
			foreach ( $schedule_open as $rule ) {
				if ( !empty( $rule['weekdays'] ) ) {
					foreach ( $rule['weekdays'] as $weekday => $value ) {
						unset( $disabled_weekdays[$weekday] );
					}
				}
			}

			if ( count( $disabled_weekdays ) < 7 ) {
				foreach ( $disabled_weekdays as $weekday ) {
					$disable_rules[] = $weekday;
				}
			}
		}

		// Get exception
		$schedule_close = $this->get_delivery_setting( 'scheduleclose' );
		if ( is_array( $schedule_close ) ) {
			foreach ( $schedule_close as $rule ) {
				// Clost all day
				if ( !empty( $rule['date'] ) && empty( $rule['time'] ) ) {
					$date = new DateTime( $rule['date'] );
					$disable_rules[] = array( $date->format( 'Y' ), ( $date->format( 'n' ) - 1 ), $date->format( 'j' ) );
				// Open in specific time
				} elseif ( !empty( $rule['date'] ) ) {
					$date = new DateTime( $rule['date'] );
					$disable_rules[] = array( $date->format( 'Y' ), ( $date->format( 'n' ) - 1 ), $date->format( 'j' ), 'inverted' );
				}
			}
		}
		return $disable_rules;
	}


	public function delivery_get_picker_object()
	{
		$first_day = (int)apply_filters( 'delivery_schedule_start_day', 0 );

		return array(
			'dateSelector' => '#delivery_date',
			'timeSelector' => '#delivery_time',
			'dateFormat' => $this->get_delivery_setting( 'date-format' ),
			'timeFormat' => $this->get_delivery_setting( 'time-format' ),
			'scheduleOpen' => $this->get_delivery_setting( 'scheduleopen' ),
			'scheduleClose' => $this->get_delivery_setting( 'scheduleclose' ),
			'disableDates' => $this->delivery_disable_rules( $first_day ),
			'earlyBooking' => $this->get_delivery_setting( 'early-delivery' ),
			'lateBooking' => $this->get_delivery_setting( 'late-delivery' ),
			'timeInterval' => $this->get_delivery_setting( 'time-interval' ),
			'firstDay' => $first_day,
			'allowPast' => 'false'
		);
	}

	// hook after processing order
	public function processing_delivery_notification( $order_id )
	{
		// if cash on delivery then set time sending delivery notification
		if ( 'cod' === get_post_meta( $order_id, '_payment_method', true ) ) {
			$this->send_delivery_notification( $order_id );
		}
	}

	// hook after complete order
	public function complete_delivery_notification( $order_id )
	{
		// if cash on delivery change delivery status to "complete"
		if ( 'cod' === get_post_meta( $order_id, '_payment_method', true ) ) {
			update_post_meta(
				$order_id,
				'Delivery Status',
				sanitize_text_field( 'complete' )
			);
		} else {
			// Set delivery status to pending
			update_post_meta(
				$order_id,
				'Delivery Status',
				sanitize_text_field( 'pending' )
			);
			$this->send_delivery_notification( $order_id );
		}
	}

	// set schedule event to send notify email
	public function send_delivery_notification( $order_id )
	{
		$delivery_date = strtotime( $this->get_delivery_date_and_time( $order_id ) );

		if ( !empty( $delivery_date ) ) {
			$notify_time = $delivery_date - (int)( $this->get_delivery_setting( 'delivery-notify-time' ) ) - get_option( 'gmt_offset' )*60*60;
			wp_schedule_single_event( $notify_time, 'delivery_notify_email', array( $order_id ) );
		}
	}

	// send email function
	public function send_notify_email( $order_id )
	{
		wp_mail(
			$this->get_delivery_setting( 'admin-email-address' ),
			apply_filters( 'delivery_notify_email_subject', sprintf( esc_html__( '%s Delivery order %s', 'fabrique-core' ), get_bloginfo( 'name' ), $order_id ) , $order_id ),
			apply_filters( 'delivery_notify_email_content', $this->notify_email_content( $order_id ), $order_id ),
			apply_filters( 'delivery_notify_email_heading', $this->notify_email_heading(), $order_id )
		);
	}


	// Get delivery notify email content
	public function notify_email_heading()
	{
		$name = get_bloginfo( 'name' );
		$email = get_option( 'admin_email' );
		$output = "From: " . stripslashes_deep( html_entity_decode( $name ), ENT_COMPAT, 'UTF-8' ) . " <" . $email . ">\r\n";
		$output .= "Reply-To: =?utf-8?Q?" . quoted_printable_encode( $name ) . "?= <" . $email . ">\r\n";
		$output .= "Content-Type: text/html; charset=utf-8\r\n";

		return $output;
	}

	// Get delivery notify email content
	public function notify_email_content( $order_id )
	{
		ob_start();
		?>
		<body offset="0" style="width:100%; height:100%; line-height:1.5em; padding:0; margin:0; background-color:#eee; color:#6f6f6f; font-family:\'Roboto\', \'Arial\', \'sans-serif\'; font-weight:400; font-size:18px; -webkit-font-smoothing:antialiased; -webkit-text-size-adjust:none;">
			<table style="width:90%; max-width:700px; margin:0 auto;">
				<tbody>
					<tr>
						<td>
							<table style="width:100%; background-color:#fbc140;">
								<tbody>
									<tr>
										<td style="line-height:1.2em; padding:1.5em 10% 0.5em; font-size:2.2em; text-align:center; color:#000;">
											<strong><?php esc_html_e( 'Delivery Alert', 'fabrique-core' ); ?></strong>
										</td>
									</tr>
								</tbody>
							</table>
							<table style="width:100%; line-height:2em; background-color:#ffffff;">
								<tbody>
									<tr>
										<td style="padding-top:2em; font-size:1.2em; text-align:center;">
											<strong>
												<?php echo sprintf(
													esc_html__( 'Order Detail %s', 'fabrique-core' ),
													'<a style="text-decoration:none;" href="' . admin_url( 'post.php?post=' . absint( $order_id ) . '&action=edit' ) . '">#' . $order_id . '</a>'
												); ?>
											</strong>
										</td>
									</tr>
									<tr>
										<td style="padding:1em 10% 2em; text-align:left;">
											<?php
												$order = wc_get_order( $order_id );
												$items = $order->get_items();
												$currency = get_woocommerce_currency_symbol();
											?>
											<?php if ( $items ) : ?>
												<table style="width:100%; line-height:2em; background-color:#ffffff; table-layout:fixed;">
													<tbody>
														<?php foreach ( $items as $item ) : ?>
															<tr>
																<?php
																	$product_id = ( 0 != $item['variation_id'] ) ? $item['variation_id'] : $item['product_id'];
																	$product = wc_get_product( $product_id );
																	$attributes = $product->get_attributes();
																?>
																<td style="padding:0.8em 0;">
																	<?php echo get_the_post_thumbnail( $product_id, array( 50, 50 ) ); ?>
																</td>
																<td style="line-height:1.5em">
																	<?php
																		echo esc_html( $item['name'] );
																		if ( !empty( $attributes ) ) {
																			echo '<br>';
																			echo '<span style="font-size:12px;">';
																			$i = 0;
																			foreach ( $attributes as $attr => $val ) {
																				echo ( 0 != $i ) ? esc_html( ', ' . $item[$attr] ) : esc_html( $item[$attr] );
																				$i++;
																			}
																			echo '</span>';
																		}
																	?>
																</td>
																<td style="text-align:right;">
																	<?php echo esc_html( 'x' . $item['qty'] ); ?>
																</td>
																<td style="text-align:right;">
																	<?php echo esc_html( $currency . $item['line_subtotal'] ); ?>
																</td>
															</tr>
														<?php endforeach; ?>
													</tbody>
												</table>
												<table style="width:100%;">
													<tbody>
														<tr>
															<td style="display:block; padding:0.5em 0; text-align:right;">
																<strong><?php esc_html_e( 'Total :', 'fabrique-core' ); ?></strong>
																<?php echo esc_html( $currency . $order->get_total() ); ?>
															</td>
															<td style="display:block; padding:0.5em 0;">
																<?php echo sprintf( esc_html__( '%sOrder Date:%s %s', 'fabrique-core' ), '<strong>', '</strong>', $order->order_date ); ?>
															</td>
															<td style="display:block; padding:0.5em 0;">
																<?php echo sprintf( esc_html__( '%sDelivery Date:%s %s', 'fabrique-core' ), '<strong>', '</strong>', $this->get_delivery_date_and_time( $order_id ) ); ?>
															</td>
														</tr>
													</tbody>
												</table>
												<table style="width:100%; padding-top: 2em; border-top:1px solid #ddd;">
													<thead>
														<tr>
															<th style="width:50%; padding-bottom:0.5em; text-align:left;"><?php esc_html_e( 'Billing Address', 'fabrique-core' ); ?></th>
															<th style="width:50%; padding-bottom:0.5em; text-align:left;"><?php esc_html_e( 'Shipping Address', 'fabrique-core' ); ?></th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td style="width:50%; padding:0.5em 0;"><?php echo fabrique_core_escape_content( $order->get_formatted_billing_address() ); ?></td>
															<td style="width:50%; padding:0.5em 0;"><?php echo fabrique_core_escape_content( $order->get_formatted_shipping_address() ); ?></td>
														</tr>
													</tbody>
												</table>
											<?php endif; ?>
										</td>
									</tr>
									<tr>
										<td style="padding:0.5em 10%; font-size:0.8em; text-align:center; color:#fff; background-color:#363636;">
											<?php echo sprintf( __( '© 2017 %s All Rights Reserved', 'fabrique-core' ), '<a style="color:inherit; text-decoration:none;" href="' . esc_url( home_url( '/' ) ) . '">' . get_bloginfo( 'name' ) . '</a>' ); ?>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
		</body>
		<?php
		return ob_get_clean();
	}
}
