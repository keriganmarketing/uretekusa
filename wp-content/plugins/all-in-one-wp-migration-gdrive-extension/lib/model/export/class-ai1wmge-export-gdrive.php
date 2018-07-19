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

class Ai1wmge_Export_GDrive {

	public static function execute( $params, Ai1wmge_GDrive_Client $gdrive = null ) {

		// Set progress
		Ai1wm_Status::info( __( 'Connecting to Google Drive...', AI1WMGE_PLUGIN_NAME ) );

		// Open the archive file for writing
		$archive = new Ai1wm_Compressor( ai1wm_archive_path( $params ) );

		// Append EOF block
		$archive->close( true );

		// Set GDrive client
		if ( is_null( $gdrive ) ) {
			$gdrive = new Ai1wmge_GDrive_Client(
				get_option( 'ai1wmge_gdrive_token', false ),
				get_option( 'ai1wmge_gdrive_ssl', true )
			);
		}

		// Get folder ID
		$folder_id = get_option( 'ai1wmge_gdrive_folder_id', false );

		// Create folder
		if ( ! ( $folder_id = $gdrive->get_folder_id_by_id( $folder_id ) ) ) {
			if ( ! ( $folder_id = $gdrive->get_folder_id_by_name( ai1wm_archive_folder() ) ) ) {
				$folder_id = $gdrive->create_folder( ai1wm_archive_folder() );
			}
		}

		// Set folder ID
		update_option( 'ai1wmge_gdrive_folder_id', $folder_id );

		// Set upload URL
		$params['upload_url'] = $gdrive->upload_resumable( ai1wm_archive_name( $params ), ai1wm_archive_bytes( $params ), $folder_id );

		// Set progress
		Ai1wm_Status::info( __( 'Done connecting to Google Drive.', AI1WMGE_PLUGIN_NAME ) );

		return $params;
	}
}
