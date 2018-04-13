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

class ServMaskGdriveCurl {

	protected $baseURL = null;

	protected $path    = null;

	protected $ssl     = true;

	protected $handler = null;

	protected $options = array();

	protected $headers = array('User-Agent' => 'All-in-One WP Migration');

	public function __construct() {
		// Check the cURL extension is loaded
		if (!extension_loaded('curl')) {
			throw new Exception(__('Google Drive Factory requires cURL extension', AI1WMGE_PLUGIN_NAME));
		}

		// Default configuration
		$this->setOption(CURLOPT_HEADER, false);
		$this->setOption(CURLOPT_RETURNTRANSFER, true);
		$this->setOption(CURLOPT_CONNECTTIMEOUT, 120);
		$this->setOption(CURLOPT_TIMEOUT, 0);

		// Enable SSL support
		$this->setOption(CURLOPT_CAINFO, dirname(__FILE__) . '/../certs/cacert.pem');
		$this->setOption(CURLOPT_CAPATH, dirname(__FILE__) . '/../certs/');

		// Limit vulnerability surface area.  Supported in cURL 7.19.4+
		if (defined('CURLOPT_PROTOCOLS')) {
			$this->setOption(CURLOPT_PROTOCOLS, CURLPROTO_HTTPS);
		}

		if (defined('CURLOPT_REDIR_PROTOCOLS')) {
			$this->setOption(CURLOPT_REDIR_PROTOCOLS, CURLPROTO_HTTPS);
		}
	}

	/**
	 * Set access token
	 *
	 * @param  string             $value Resouse path
	 * @return ServMaskGdriveCurl
	 */
	public function setAccessToken($value) {
		$this->setHeader('Authorization', "Bearer $value");
		return $this;
	}

	/**
	 * Get access token
	 *
	 * @return string
	 */
	public function getAccessToken() {
		return $this->getHeader('Authorization');
	}

	/**
	 * Set SSL mode
	 *
	 * @param  boolean    $value SSL Mode
	 * @return GdriveCurl
	 */
	public function setSSL($value) {
		$this->ssl = $value;
		return $this;
	}

	/**
	 * Get SSL Mode
	 *
	 * @return boolean
	 */
	public function getSSL() {
		return $this->ssl;
	}

	/**
	 * Set cURL base URL
	 *
	 * @param  string             $value Base URL
	 * @return ServMaskGdriveCurl
	 */
	public function setBaseURL($value) {
		$this->baseURL = $value;
		return $this;
	}

	/**
	 * Get cURL base URL
	 *
	 * @return string
	 */
	public function getBaseURL() {
		return $this->baseURL;
	}

	/**
	 * Set cURL path
	 *
	 * @param  string             $value Resource path
	 * @return ServMaskGdriveCurl
	 */
	public function setPath($value) {
		$this->path = $value;
		return $this;
	}

	/**
	 * Get cURL path
	 *
	 * @return string
	 */
	public function getPath() {
		return $this->path;
	}

	/**
	 * Set cURL option
	 *
	 * @param  int                $name  cURL option name
	 * @param  mixed              $value cURL option value
	 * @return ServMaskGdriveCurl
	 */
	public function setOption($name, $value) {
		$this->options[$name] = $value;
		return $this;
	}

	/**
	 * Get cURL option
	 *
	 * @param  int   $name cURL option name
	 * @return mixed
	 */
	public function getOption($name) {
		return $this->options[$name];
	}

	/**
	 * Set cURL header
	 *
	 * @param  string             $name  cURL header name
	 * @param  string             $value cURL header value
	 * @return ServMaskGdriveCurl
	 */
	public function setHeader($name, $value) {
		$this->headers[$name] = $value;
		return $this;
	}

	/**
	 * Get cURL header
	 *
	 * @param  string $name cURL header name
	 * @return string
	 */
	public function getHeader($name) {
		return $this->headers[$name];
	}

	/**
	 * Make cURL request
	 *
	 * @return array
	 */
	public function makeRequest() {
		// cURL handler
		$this->handler = curl_init($this->getBaseURL() . $this->getPath());

		// Apply cURL headers
		$httpHeaders = array();
		foreach ($this->headers as $name => $value) {
			$httpHeaders[] = "$name: $value";
		}

		// Set headers
		$this->setOption(CURLOPT_HTTPHEADER, $httpHeaders);

		// SSL verify peer
		$this->setOption(CURLOPT_SSL_VERIFYPEER, $this->getSSL());

		// Apply cURL options
		foreach ($this->options as $name => $value) {
			curl_setopt($this->handler, $name, $value);
		}

		// HTTP request
		$response = curl_exec($this->handler);
		if ($response === false) {
			throw new Ai1wmge_Connect_Exception(sprintf(__('Unable to connect to Google Drive. Error code: %d', AI1WMGE_PLUGIN_NAME), curl_errno($this->handler)), curl_getinfo($this->handler, CURLINFO_HTTP_CODE));
		}

		// Get JSON data
		$data = json_decode($response, true);

		// Handle errors
		if (isset($data['error']['code']) && ($code = $data['error']['code'])) {
			if (isset($data['error']['message']) && ($message = $data['error']['message'])) {
				throw new Exception(sprintf(__('%s. <a href="https://help.servmask.com/knowledgebase/google-drive-error-codes/" target="_blank">Technical details</a>', AI1WMGE_PLUGIN_NAME), $message), $code);
			}
		}

		// HTTP headers
		if ($this->getOption(CURLOPT_HEADER)) {
			return $this->httpParseHeaders($response);
		}

		return $data;
	}

	/**
	 * Parse HTTP headers
	 *
	 * @param  string $headers HTTP headers
	 * @return array
	 */
	public function httpParseHeaders($headers) {
		$headers = preg_split("/(\r|\n)+/", $headers, -1, PREG_SPLIT_NO_EMPTY);

		$parseHeaders = array();
		for ($i = 1; $i < count($headers); $i++) {
			if (strpos($headers[$i], ':') !== false) {
				list($key, $rawValue) = explode(':', $headers[$i], 2);
				$key = trim($key);
				$value = trim($rawValue);
				if (array_key_exists($key, $parseHeaders)) {
					// See HTTP RFC Sec 4.2 Paragraph 5
					// http://www.w3.org/Protocols/rfc2616/rfc2616-sec4.html#sec4.2
					// If a header appears more than once, it must also be able to
					// be represented as a single header with a comma-separated
					// list of values.  We transform accordingly.
					$parseHeaders[$key] .= ',' . $value;
				} else {
					$parseHeaders[$key] = $value;
				}
			}
		}

		return $parseHeaders;
	}

	/**
	 * Destroy cURL handler
	 *
	 * @return void
	 */
	public function __destruct() {
		if ($this->handler !== null) {
			curl_close($this->handler);
		}
	}
}
