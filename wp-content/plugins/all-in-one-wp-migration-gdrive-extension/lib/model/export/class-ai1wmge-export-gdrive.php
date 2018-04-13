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

class Ai1wmge_Export_Gdrive {

	public static function execute( $params ) {

		// Set progress
		Ai1wm_Status::info( __( 'Connecting to Google Drive...', AI1WMGE_PLUGIN_NAME ) );

		// Open achive file
		$archive = new Ai1wm_Compressor( ai1wm_archive_path( $params ) );

		// Append EOF block
		$archive->close( true );

		// Set Gdrive client
		$gdrive = new ServMaskGdriveClient(
			get_option( 'ai1wmge_gdrive_token' ),
			get_option( 'ai1wmge_gdrive_ssl', true )
		);

		// Get or Create folder
		$folder = $gdrive->listFolder( ai1wm_archive_folder() );
		if ( isset( $folder['items'] ) && ( $item = array_shift( $folder['items'] ) ) ) {
			$folder = $item;
		} else {
			$folder = $gdrive->createFolder( ai1wm_archive_folder() );
		}

		// Upload resumable
		$params['uploadUrl'] = $gdrive->uploadResumable(
			ai1wm_archive_name( $params ),
			ai1wm_archive_bytes( $params ),
			$folder['id']
		);

		return $params;
	}
}
