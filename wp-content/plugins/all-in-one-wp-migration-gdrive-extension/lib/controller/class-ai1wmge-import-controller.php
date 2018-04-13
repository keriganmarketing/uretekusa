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

class Ai1wmge_Import_Controller {

	public static function button() {
		return Ai1wm_Template::get_content(
			'import/button',
			array( 'token' => get_option( 'ai1wmge_gdrive_token' ) ),
			AI1WMGE_TEMPLATES_PATH
		);
	}

	public static function picker() {
		Ai1wm_Template::render(
			'import/picker',
			array(),
			AI1WMGE_TEMPLATES_PATH
		);
	}

	public static function folder() {
		// Set folder ID
		$folder_id = null;
		if ( isset( $_GET['folderId'] ) ) {
			$folder_id = $_GET['folderId'];
		}

		// Set Gdrive client
		$gdrive = new ServMaskGdriveClient(
			get_option( 'ai1wmge_gdrive_token' ),
			get_option( 'ai1wmge_gdrive_ssl', true )
		);

		// List folder
		$folder = $gdrive->listFolder( null, $folder_id, array(
			'orderBy' => 'folder,title',
		) );

		// Set folder structure
		$response = array(
			'id'             => null,
			'items'          => array(),
			'numHiddenFiles' => 0,
		);

		// Set folder ID
		if ( isset( $folder['id'] ) ) {
			$response['id'] = $folder['id'];
		}

		// Set folder items
		if ( isset( $folder['items'] ) && ( $items = $folder['items'] ) ) {
			foreach ( $items as $item ) {
				if ( $item['fileExtension'] === 'wpress' || $item['mimeType'] === 'application/vnd.google-apps.folder' ) {
					$response['items'][] = array(
						'id'    => isset( $item['id'] ) ? $item['id'] : null,
						'name'  => isset( $item['title'] ) ? $item['title'] : null,
						'date'  => isset( $item['createdDate'] ) ? human_time_diff( strtotime( $item['createdDate'] ) ) : null,
						'type'  => isset( $item['mimeType'] ) ? $item['mimeType'] : null,
						'size'  => isset( $item['fileSize'] ) ? size_format( $item['fileSize'] ) : null,
						'bytes' => isset( $item['fileSize'] ) ? $item['fileSize'] : null,
						'ext'   => isset( $item['fileExtension'] ) ? $item['fileExtension'] : null,
					);
				} else {
					$response['numHiddenFiles']++;
				}
			}
		}

		echo json_encode( $response );
		exit;
	}
}
