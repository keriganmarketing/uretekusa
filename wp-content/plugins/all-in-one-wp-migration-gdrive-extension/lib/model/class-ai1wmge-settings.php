<?php
/**
 * Copyright (C) 2014-2018 ServMask Inc.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * ███████╗███████╗██████╗ ██╗   ██╗███╗   ███╗ █████╗ ███████╗██╗  ██╗
 * ██╔════╝██╔════╝██╔══██╗██║   ██║████╗ ████║██╔══██╗██╔════╝██║ ██╔╝
 * ███████╗█████╗  ██████╔╝██║   ██║██╔████╔██║███████║███████╗█████╔╝
 * ╚════██║██╔══╝  ██╔══██╗╚██╗ ██╔╝██║╚██╔╝██║██╔══██║╚════██║██╔═██╗
 * ███████║███████╗██║  ██║ ╚████╔╝ ██║ ╚═╝ ██║██║  ██║███████║██║  ██╗
 * ╚══════╝╚══════╝╚═╝  ╚═╝  ╚═══╝  ╚═╝     ╚═╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝
 */

class Ai1wmge_Settings {

	public function revoke() {
		// Set Gdrive client
		$gdrive = new ServMaskGdriveClient(
			get_option( 'ai1wmge_gdrive_token' ),
			get_option( 'ai1wmge_gdrive_ssl', true )
		);

		// Revoke token
		$gdrive->revoke();

		// Remove token option
		delete_option( 'ai1wmge_gdrive_token' );

		// Remove cron option
		delete_option( 'ai1wmge_gdrive_cron' );

		// Reset cron schedules
		Ai1wm_Cron::clear( 'ai1wmge_gdrive_hourly_export' );
		Ai1wm_Cron::clear( 'ai1wmge_gdrive_daily_export' );
		Ai1wm_Cron::clear( 'ai1wmge_gdrive_weekly_export' );
		Ai1wm_Cron::clear( 'ai1wmge_gdrive_monthly_export' );
	}

	public function get_last_backup_date( $last_backup_timestamp ) {
		if ( $last_backup_timestamp ) {
			$last_backup_date = get_date_from_gmt( date( 'Y-m-d H:i:s', $last_backup_timestamp ), 'F j, Y g:i a' );
		} else {
			$last_backup_date = __( 'None', AI1WMGE_PLUGIN_NAME );
		}

		return $last_backup_date;
	}

	public function get_next_backup_date( $schedules ) {
		$future_backup_timestamps = array();

		foreach ( $schedules as $schedule ) {
			$future_backup_timestamps[] = wp_next_scheduled( "ai1wmge_gdrive_{$schedule}_export", array(
				array(
					'secret_key' => get_option( AI1WM_SECRET_KEY ),
					'gdrive'     => 1,
				),
			) );
		}

		sort( $future_backup_timestamps );

		if ( isset( $future_backup_timestamps[0] ) ) {
			$next_backup_date = get_date_from_gmt( date( 'Y-m-d H:i:s', $future_backup_timestamps[0] ), 'F j, Y g:i a' );
		} else {
			$next_backup_date = __( 'None', AI1WMGE_PLUGIN_NAME );
		}

		return $next_backup_date;
	}

	public function get_account() {
		// Set Gdrive client
		$gdrive = new ServMaskGdriveClient(
			get_option( 'ai1wmge_gdrive_token' ),
			get_option( 'ai1wmge_gdrive_ssl', true )
		);

		// Get account info
		$account = $gdrive->getAccountInfo();

		// Set account name
		$name = null;
		if ( isset( $account['name'] ) ) {
			$name = $account['name'];
		}

		// Set used quota
		$used = null;
		if ( isset( $account['quotaBytesUsed'] ) ) {
			$used = $account['quotaBytesUsed'];
		}

		// Set total quota
		$total = null;
		if ( isset( $account['quotaBytesTotal'] ) ) {
			$total = $account['quotaBytesTotal'];
		}

		// Set total quota
		$email = null;
		if ( isset( $account['user']['emailAddress'] ) ) {
			$email = $account['user']['emailAddress'];
		}

		return array(
			'name'     => $name,
			'email'    => $email,
			'used'     => size_format( $used ),
			'total'    => size_format( $total ),
			'progress' => ceil( ( $used / $total ) * 100 ),
		);
	}

	public function set_cron( $schedules ) {
		// Reset cron schedules
		Ai1wm_Cron::clear( 'ai1wmge_gdrive_hourly_export' );
		Ai1wm_Cron::clear( 'ai1wmge_gdrive_daily_export' );
		Ai1wm_Cron::clear( 'ai1wmge_gdrive_weekly_export' );
		Ai1wm_Cron::clear( 'ai1wmge_gdrive_monthly_export' );

		// Update cron schedules
		foreach ( $schedules as $schedule ) {
			Ai1wm_Cron::add( "ai1wmge_gdrive_{$schedule}_export", $schedule, array(
				'secret_key' => get_option( AI1WM_SECRET_KEY ),
				'gdrive'     => 1,
			) );
		}

		// Update cron options
		return update_option( 'ai1wmge_gdrive_cron', $schedules );
	}

	public function get_cron() {
		return get_option( 'ai1wmge_gdrive_cron', array() );
	}

	public function set_ssl( $mode ) {
		return update_option( 'ai1wmge_gdrive_ssl', $mode );
	}

	public function get_ssl() {
		return get_option( 'ai1wmge_gdrive_ssl', false );
	}

	public function set_backups( $number ) {
		return update_option( 'ai1wmge_gdrive_backups', $number );
	}

	public function get_backups() {
		return get_option( 'ai1wmge_gdrive_backups', false );
	}

	public function set_total( $size ) {
		return update_option( 'ai1wmge_gdrive_total', $size );
	}

	public function get_total() {
		return get_option( 'ai1wmge_gdrive_total', false );
	}

	public function set_notify_ok_toggle( $toggle ) {
		return update_option( 'ai1wmge_gdrive_notify_toggle', $toggle );
	}

	public function get_notify_ok_toggle() {
		return get_option( 'ai1wmge_gdrive_notify_toggle', false );
	}

	public function set_notify_error_toggle( $toggle ) {
		return update_option( 'ai1wmge_gdrive_notify_error_toggle', $toggle );
	}

	public function get_notify_error_toggle() {
		return get_option( 'ai1wmge_gdrive_notify_error_toggle', false );
	}

	public function set_notify_email( $email ) {
		return update_option( 'ai1wmge_gdrive_notify_email', $email );
	}

	public function get_notify_email() {
		return get_option( 'ai1wmge_gdrive_notify_email', false );
	}
}
