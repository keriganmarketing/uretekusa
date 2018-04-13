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

class Ai1wmge_Export_Upload {

	public static function execute( $params ) {

		// Set completed flag
		$params['completed'] = false;

		// Set offset
		if ( ! isset( $params['offset'] ) ) {
			$params['offset'] = 0;
		}

		// Set retry
		if ( ! isset( $params['retry'] ) ) {
			$params['retry'] = 0;
		}

		// Set Gdrive client
		$gdrive = new ServMaskGdriveClient(
			get_option( 'ai1wmge_gdrive_token' ),
			get_option( 'ai1wmge_gdrive_ssl', true )
		);

		// Get archive file
		$archive = fopen( ai1wm_archive_path( $params ), 'rb' );

		// Read file chunk
		if ( ( fseek( $archive, $params['offset'] ) !== -1 )
				&& ( $chunk = fread( $archive, ServMaskGdriveClient::CHUNK_SIZE ) ) ) {

			// Set chunk size
			$params['chunkSize'] = ftell( $archive ) - $params['offset'];

			// Set file size
			$params['fileSize'] = ai1wm_archive_bytes( $params );

			try {

				// Increase number of retries
				$params['retry'] += 1;

				// Upload file chunk
				$gdrive->uploadFileChunk( $chunk, $params );

			} catch ( Ai1wmge_Connect_Exception $e ) {
				// Retry 3 times
				if ( $params['retry'] <= 3 ) {
					return $params;
				}

				throw $e;
			}

			// Unset retry counter
			unset( $params['retry'] );

			// Set archive details
			$name  = ai1wm_archive_name( $params );
			$bytes = ai1wm_archive_bytes( $params );
			$size  = ai1wm_archive_size( $params );

			// Get progress
			if ( isset( $params['offset'] ) ) {
				$progress = (int) ( ( $params['offset'] / $bytes ) * 100 );
			} else {
				$progress = 100;
			}

			// Set progress
			Ai1wm_Status::info(
				sprintf(
					__(
						'<i class="ai1wmge-icon-gdrive"></i> ' .
						'Uploading <strong>%s</strong> (%s)<br />%d%% complete',
						AI1WMGE_PLUGIN_NAME
					),
					$name,
					$size,
					$progress
				)
			);

		} else {

			// Set last backup date
			update_option( 'ai1wmge_gdrive_timestamp', time() );

			// Set progress
			Ai1wm_Status::done(
				__( 'Your WordPress archive has been uploaded to Google Drive.', AI1WMGE_PLUGIN_NAME ),
				__( 'Google Drive', AI1WMGE_PLUGIN_NAME )
			);

			self::notify_admin_of_new_backup( $params );

			// Unset upload URL
			unset( $params['uploadUrl'] );

			// Unset offset
			unset( $params['offset'] );

			// Unset chunk size
			unset( $params['chunkSize'] );

			// Unset file size
			unset( $params['fileSize'] );

			// Unset completed flag
			unset( $params['completed'] );
		}

		// Close the archive file
		fclose( $archive );

		return $params;
	}

	public static function is_notification_enabled( $recipient ) {
		return (
			get_option( 'ai1wmge_gdrive_notify_toggle', false ) &&
			! empty( $recipient ) &&
			function_exists( 'wp_mail' )
		);
	}

	public static function notify_admin_of_new_backup( $params ) {
		$recipient = get_option( 'ai1wmge_gdrive_notify_email', get_option( 'admin_email', '' ) );

		if ( self::is_notification_enabled( $recipient ) ) {
			$subject  = sprintf(
				__( '%s backup to Google Drive completed', AI1WMGE_PLUGIN_NAME ),
				parse_url( site_url(), PHP_URL_HOST ) . parse_url( site_url(), PHP_URL_PATH )
			);
			$message  = sprintf( __( "Your site %s was successfully exported to GDrive.\n", AI1WMGE_PLUGIN_NAME ), site_url() );
			$message .= "\n\n";
			$message .= sprintf( __( "Date: %s\n", AI1WMGE_PLUGIN_NAME ), date( 'r' ) );
			$message .= sprintf( __( "Backup file: %s\n", AI1WMGE_PLUGIN_NAME ), ai1wm_archive_name( $params ) );
			$message .= sprintf( __( "Size: %s\n", AI1WMGE_PLUGIN_NAME ), ai1wm_archive_size( $params ) );
			wp_mail( $recipient, $subject, $message );
		}
	}
}
