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

class Ai1wmge_Import_Database {

	public static function execute( $params ) {

		$model = new Ai1wmge_Settings;

		// Set progress
		Ai1wm_Status::info( __( 'Updating Google Drive settings...', AI1WMGE_PLUGIN_NAME ) );

		// Read settings.json file
		$handle = ai1wm_open( ai1wm_settings_path( $params ), 'r' );

		// Parse settings.json file
		$settings = ai1wm_read( $handle, filesize( ai1wm_settings_path( $params ) ) );
		$settings = json_decode( $settings, true );

		// Close handle
		ai1wm_close( $handle );

		// Update Google Drive settings
		$model->set_cron( $settings['ai1wmge_gdrive_cron'] );
		$model->set_token( $settings['ai1wmge_gdrive_token'] );
		$model->set_ssl( $settings['ai1wmge_gdrive_ssl'] );
		$model->set_backups( $settings['ai1wmge_gdrive_backups'] );
		$model->set_total( $settings['ai1wmge_gdrive_total'] );
		$model->set_notify_ok_toggle( $settings['ai1wmge_gdrive_notify_toggle'] );
		$model->set_notify_error_toggle( $settings['ai1wmge_gdrive_notify_error_toggle'] );
		$model->set_notify_error_subject( $settings['ai1wmge_gdrive_notify_error_subject'] );
		$model->set_notify_email( $settings['ai1wmge_gdrive_notify_email'] );

		// Set progress
		Ai1wm_Status::info( __( 'Done updating Google Drive settings.', AI1WMGE_PLUGIN_NAME ) );

		return $params;
	}
}
