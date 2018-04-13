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

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'ServMaskGdriveCurl.php';

class ServMaskGdriveClient {

	const API_URL         = 'https://www.googleapis.com/drive/v2';

	const API_UPLOAD_URL  = 'https://www.googleapis.com/upload/drive/v2';

	const API_ACCOUNT_URL = 'https://accounts.google.com/o/oauth2';

	const API_TOKEN_URL   = 'https://servmask.com/redirect/gdrive';

	const CHUNK_SIZE      = 5242880; // 5 MB

	/**
	 * OAuth Refresh Token
	 *
	 * @var string
	 */
	protected $refreshToken = null;

	/**
	 * SSL Mode
	 *
	 * @var boolean
	 */
	protected $ssl = null;

	/**
	 * Chunk stream
	 *
	 * @var resource
	 */
	protected $chunkStream = null;

	public function __construct($refreshToken, $ssl = true) {
		$this->refreshToken = $refreshToken;
		$this->ssl = $ssl;
	}

	/**
	 * Upload file
	 *
	 * @param  array    $query      Google Drive query path.
	 * @param  resource $fileStream File stream.
	 * @param  int      $filesize   File size.
	 * @return mixed
	 */
	public function uploadFile($query, $fileStream, $fileSize) {
		// Set boundary
		$boundary = mt_rand();

		// Set post data
		$post = null;
		$post .= "--$boundary\r\n";
		$post .= "Content-Type: application/json\r\n\r\n";
		$post .= json_encode($query) . "\r\n";
		$post .= "--$boundary\r\n";
		$post .= "Content-Type: application/octet-stream\r\n\r\n";
		$post .= fread($fileStream, $fileSize) . "\r\n";
		$post .= "--$boundary--";

		// Multipart request
		$api = new ServMaskGdriveCurl;
		$api->setHeader('Content-Type', "multipart/related; boundary=$boundary");
		$api->setAccessToken($this->getAccessToken());
		$api->setSSL($this->ssl);
		$api->setBaseURL(self::API_UPLOAD_URL);
		$api->setPath('/files?uploadType=multipart');
		$api->setOption(CURLOPT_POST, true);
		$api->setOption(CURLOPT_POSTFIELDS, $post);

		return $api->makeRequest();
	}

	/**
	 * Upload resumable file on Google Drive
	 *
	 * @param  string $name     Google Drive file name.
	 * @param  int    $fileSize File size.
	 * @return string
	 */
	public function uploadResumable($name, $fileSize, $folderId = null) {
		$api = new ServMaskGdriveCurl;
		$api->setHeader('Content-Type', 'application/json');
		$api->setHeader('X-Upload-Content-Type', 'application/octet-stream');
		$api->setHeader('X-Upload-Content-Length', $fileSize);
		$api->setAccessToken($this->getAccessToken());
		$api->setSSL($this->ssl);
		$api->setBaseURL(self::API_UPLOAD_URL);
		$api->setPath('/files?uploadType=resumable');
		$api->setOption(CURLOPT_POST, true);
		$api->setOption(CURLOPT_HEADER, true);
		$api->setOption(CURLOPT_POSTFIELDS, json_encode(array(
			'title'   => $name,
			'parents' => array(
				array('id' => $folderId),
			),
		)));

		// Get upload URL
		if (($response = $api->makeRequest())) {
			if (isset($response['Location']) && ($uploadUrl = $response['Location'])) {
				return $uploadUrl;
			}
		}
	}

	/**
	 * Upload file chunk
	 *
	 * @param  string $chunk  File chunk data.
	 * @param  array  $params Google Drive query params.
	 * @return array
	 */
	public function uploadFileChunk($chunk, &$params = array()) {
		// Upload URL
		if (!isset($params['uploadUrl'])) {
			throw new Exception('Parameter "uploadUrl" is required.');
		}

		// Chunk size
		if (!isset($params['chunkSize'])) {
			throw new Exception('Parameter "chunkSize" is required.');
		}

		// Set file size
		if (!isset($params['fileSize'])) {
			throw new Exception('Parameter "fileSize" is required.');
		}

		// Set offset
		if (!isset($params['offset'])) {
			throw new Exception('Parameter "offset" is required.');
		}

		// Gdrive client
		$api = new ServMaskGdriveCurl;
		$api->setAccessToken($this->getAccessToken());
		$api->setSSL($this->ssl);
		$api->setBaseURL($params['uploadUrl']);
		$api->setOption(CURLOPT_CUSTOMREQUEST, 'PUT');
		$api->setHeader('Content-Type', 'application/octet-stream');

		// Set end range
		$endBytes = $params['offset'] + $params['chunkSize'] - 1;

		// Upload chunk
		$api->setHeader('Content-Length', $params['chunkSize']);
		$api->setHeader('Content-Range', "bytes {$params['offset']}-$endBytes/{$params['fileSize']}");
		$api->setOption(CURLOPT_POSTFIELDS, $chunk);
		$api->setOption(CURLOPT_HEADER, true);

		// Make request
		$response = $api->makeRequest();

		// Set start range
		if (isset($response['Range']) && ($range = explode('-', $response['Range']))) {
			$params['offset'] = $range[1] + 1;
		} else {
			$params['offset'] += $params['chunkSize'];
		}

		return $response;
	}

	/**
	 * Downloads file from Google Drive
	 *
	 * @param  string   $fileId     Google Drive File ID.
	 * @param  resource $fileStream File Stream.
	 * @param  array    $params     Google Drive query params.
	 * @return mixed
	 */
	public function getFile($fileId, $fileStream, &$params = array()) {
		$this->chunkStream = fopen('php://temp', 'wb+');

		$api = new ServMaskGdriveCurl;
		$api->setAccessToken($this->getAccessToken());
		$api->setSSL($this->ssl);
		$api->setBaseURL(self::API_URL);
		$api->setPath("/files/$fileId");

		// Make request
		if (($data = $api->makeRequest())) {
			if (isset($data['downloadUrl']) && ($downloadUrl = $data['downloadUrl'])) {
				$download = new ServMaskGdriveCurl;
				$download->setAccessToken($this->getAccessToken());
				$download->setSSL($this->ssl);
				$download->setBaseURL($downloadUrl);
				$download->setOption(CURLOPT_WRITEFUNCTION, array($this, 'curlWriteFunction'));
				$download->setHeader('Range', "bytes={$params['startBytes']}-{$params['endBytes']}");

				// Make request
				$download->makeRequest();

				// Copy chunk data into file stream
				if (fwrite($fileStream, stream_get_contents($this->chunkStream, -1, 0)) === false) {
					throw new Exception('Unable to save the file from Google Drive');
				}

				// Close chunk stream
				fclose($this->chunkStream);

				// Next startBytes
				if ($params['totalBytes'] < ($params['startBytes'] + self::CHUNK_SIZE)) {
					$params['startBytes'] = $params['totalBytes'];
				} else {
					$params['startBytes'] = $params['endBytes'] + 1;
				}

				// Next endBytes
				if ($params['totalBytes'] < ($params['endBytes'] + self::CHUNK_SIZE)) {
					$params['endBytes'] = $params['totalBytes'];
				} else {
					$params['endBytes'] += self::CHUNK_SIZE;
				}
			}
		}

		return $params;
	}

	/**
	 * Curl write function callback
	 *
	 * @param  resource $ch   Curl handler
	 * @param  string   $data Curl data
	 * @return integer
	 */
	public function curlWriteFunction($ch, $data) {
		$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if ($code !== 200 && $code !== 206) {
			throw new Exception(sprintf('Unable to connect to Google Drive. Error code: %d', $code), $code);
		}

		// Write data to stream
		fwrite($this->chunkStream, $data);

		return strlen($data);
	}

	/**
	 * Creates a folder
	 *
	 * @param  string $name Google Drive Folder Name.
	 * @return mixed
	 */
	public function createFolder($name) {
		$api = new ServMaskGdriveCurl;
		$api->setHeader('Content-Type', 'application/json');
		$api->setAccessToken($this->getAccessToken());
		$api->setSSL($this->ssl);
		$api->setBaseURL(self::API_URL);
		$api->setPath('/files');
		$api->setOption(CURLOPT_POST, true);
		$api->setOption(CURLOPT_POSTFIELDS, json_encode(array(
			'title'    => $name,
			'mimeType' => 'application/vnd.google-apps.folder',
		)));

		return $api->makeRequest();
	}

	/**
	 * Retrieves file and folder metadata
	 *
	 * @param  string $name     Google Drive Folder Name.
	 * @param  string $folderId Google Drive Folder ID.
	 * @param  array  $args     Query arguments to append to the request
	 * @return mixed
	 */
	public function listFolder($name = null, $folderId = 'root', $args = null ) {
		// Set query
		if (!empty($name)) {
			$query = "title = '{$name}' and trashed = false";
		} else if (!empty($folderId)) {
			$query = "'{$folderId}' in parents and trashed = false";
		} else {
			$query = "'root' in parents and trashed = false";
		}

		$query = array(
			'q' => $query,
		);

		if (!is_null($args)) {
			$query = array_merge($query, $args);
		}

		$api = new ServMaskGdriveCurl;
		$api->setAccessToken($this->getAccessToken());
		$api->setSSL($this->ssl);
		$api->setBaseURL(self::API_URL);
		$api->setPath('/files?' . http_build_query($query, '', '&'));

		return $api->makeRequest();
	}

	/**
	 * Deletes a file or folder
	 *
	 * @param  string $fileId Google Drive File ID.
	 * @return mixed
	 */
	public function delete($fileId) {
		$api = new ServMaskGdriveCurl;
		$api->setAccessToken($this->getAccessToken());
		$api->setSSL($this->ssl);
		$api->setBaseURL(self::API_URL);
		$api->setPath("/files/$fileId");
		$api->setOption(CURLOPT_CUSTOMREQUEST, 'DELETE');

		return $api->makeRequest();
	}

	/**
	 * Get account info
	 *
	 * @return mixed
	 */
	public function getAccountInfo() {
		$api = new ServMaskGdriveCurl;
		$api->setAccessToken($this->getAccessToken());
		$api->setSSL($this->ssl);
		$api->setBaseURL(self::API_URL);
		$api->setPath('/about');

		return $api->makeRequest();
	}

	/**
	 * Revoke token
	 *
	 * @return mixed
	 */
	public function revoke() {
		$api = new ServMaskGdriveCurl;
		$api->setSSL($this->ssl);
		$api->setBaseURL(self::API_ACCOUNT_URL);
		$api->setPath('/revoke?' . http_build_query(array(
			'token' => $this->refreshToken,
		), '', '&'));

		return $api->makeRequest();
	}

	/**
	 * Get access token
	 *
	 * @return string
	 */
	protected function getAccessToken() {
		$api = new ServMaskGdriveCurl;
		$api->setHeader('Content-Type', 'application/json');
		$api->setSSL($this->ssl);
		$api->setBaseURL(self::API_TOKEN_URL);
		$api->setPath('/refresh');
		$api->setOption(CURLOPT_POST, true);
		$api->setOption(CURLOPT_POSTFIELDS, json_encode(array(
			'token' => $this->refreshToken,
		)));

		// Make request
		if (($data = $api->makeRequest())) {
			if (isset($data['access_token']) && ($accessToken = $data['access_token'])) {
				return $accessToken;
			}
		}
	}
}
