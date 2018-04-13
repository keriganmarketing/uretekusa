<?php
require_once( ABSPATH . 'wp-admin/includes/file.php' );

class Fabrique_Util
{
	public static function can_write_file( $path, $filepath )
	{
		$writable = false;

		$access_type = get_filesystem_method();

		if ( 'direct' === $access_type ) {
			$credentials = request_filesystem_credentials( site_url() . '/' . $path , false );

			if ( WP_Filesystem( $credentials ) ) {
				$writable = true;
			}
		}

		return $writable;
	}

	public static function write_file( $path, $filepath, $content )
	{
		global $wp_filesystem;
		$wp_filesystem->put_contents( $filepath, $content, FS_CHMOD_FILE );
	}
}