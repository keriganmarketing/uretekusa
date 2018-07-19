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

class Ai1wmge_Import_Settings {

	public static function execute( $params ) {

		// Set progress
		Ai1wm_Status::info( __( 'Getting Google Drive settings...', AI1WMGE_PLUGIN_NAME ) );

		$settings = array(
			'ai1wmge_gdrive_cron'                 => get_option( 'ai1wmge_gdrive_cron', array() ),
			'ai1wmge_gdrive_token'                => get_option( 'ai1wmge_gdrive_token', false ),
			'ai1wmge_gdrive_ssl'                  => get_option( 'ai1wmge_gdrive_ssl', false ),
			'ai1wmge_gdrive_backups'              => get_option( 'ai1wmge_gdrive_backups', false ),
			'ai1wmge_gdrive_total'                => get_option( 'ai1wmge_gdrive_total', false ),
			'ai1wmge_gdrive_notify_toggle'        => get_option( 'ai1wmge_gdrive_notify_toggle', false ),
			'ai1wmge_gdrive_notify_error_toggle'  => get_option( 'ai1wmge_gdrive_notify_error_toggle', false ),
			'ai1wmge_gdrive_notify_error_subject' => get_option( 'ai1wmge_gdrive_notify_error_subject', false ),
			'ai1wmge_gdrive_notify_email'         => get_option( 'ai1wmge_gdrive_notify_email', false ),
		);

		// Save settings.json file
		$handle = ai1wm_open( ai1wm_settings_path( $params ), 'w' );
		ai1wm_write( $handle, json_encode( $settings ) );
		ai1wm_close( $handle );

		// Set progress
		Ai1wm_Status::info( __( 'Done getting Google Drive settings.', AI1WMGE_PLUGIN_NAME ) );

		return $params;
	}
}
