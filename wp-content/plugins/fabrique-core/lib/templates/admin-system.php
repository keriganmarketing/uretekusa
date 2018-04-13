<?php $style_dir = fabrique_core_style_custom_dir(); ?>
<?php $style_custom_writable = Fabrique_Util::can_write_file( 'wp-admin/customize.php', $style_dir['path'] ); ?>

<div class="bp-status-title"><?php esc_html_e( 'WordPress Environment', 'fabrique-core' ); ?></div>
<table class="bp-status-content">
	<tbody>
		<tr>
			<td class="bp-status-label"><?php esc_html_e( 'Home URL', 'fabrique-core' ); ?>:</td>
			<td class="bp-status-help"><?php echo '<a href="#" class="bp-help" data-tooltip="' . esc_attr__( 'The URL of your site\'s homepage.', 'fabrique-core' ) . '">[?]</a>'; ?></td>
			<td class="bp-status-detail"><?php echo esc_url( home_url( '/' ) ); ?></td>
		</tr>
		<tr>
			<td class="bp-status-label"><?php esc_html_e( 'Site URL', 'fabrique-core' ); ?>:</td>
			<td class="bp-status-help"><?php echo '<a href="#" class="bp-help" data-tooltip="' . esc_attr__( 'The root URL of your site.', 'fabrique-core' ) . '">[?]</a>'; ?></td>
			<td class="bp-status-detail"><?php echo site_url(); ?></td>
		</tr>
		<tr>
			<?php $tooltip_text = 'Theme generats a stylesheet when the options are saved. The file must be writtable.'; ?>
			<td class="bp-status-label"><?php esc_html_e( 'Custom Stylesheet', 'fabrique-core' ); ?>:</td>
			<td class="bp-status-help"><?php echo '<a href="#" class="bp-help" data-tooltip="' . esc_attr__( $tooltip_text, 'fabrique-core' ) . '">[?]</a>'; ?></td>
			<td class="bp-status-detail">
			<?php if ( $style_custom_writable ) : ?>
				<mark class="yes">&#10004; <code><?php echo esc_html( $style_dir['path'] ); ?></code></mark>
			<?php else : ?>
				<mark class="error">
				<?php echo esc_html( 'WordPress doesn\'t have direct access to this file', 'fabrique-core' ); ?>
				<code><?php echo esc_html( $style_dir['style_path'] ); ?></code>
				<?php echo esc_html( 'Please make sure that wordpress has permission over the file', 'fabrique-core' ); ?>
				</mark>
			<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td class="bp-status-label"><?php esc_html_e( 'WP Version', 'fabrique-core' ); ?>:</td>
			<td class="bp-status-help"><?php echo '<a href="#" class="bp-help" data-tooltip="' . esc_attr__( 'The version of WordPress installed on your site.', 'fabrique-core' ) . '">[?]</a>'; ?></td>
			<td class="bp-status-detail"><?php bloginfo('version'); ?></td>
		</tr>
		<tr>
			<td class="bp-status-label"><?php esc_html_e( 'WP Multisite', 'fabrique-core' ); ?>:</td>
			<td class="bp-status-help"><?php echo '<a href="#" class="bp-help" data-tooltip="' . esc_attr__( 'Whether or not you have WordPress Multisite enabled.', 'fabrique-core' ) . '">[?]</a>'; ?></td>
			<td class="bp-status-detail"><?php if ( is_multisite() ) echo '&#10004;'; else echo '&ndash;'; ?></td>
		</tr>
		<tr>
			<td class="bp-status-label"><?php esc_html_e( 'WP Memory Limit', 'fabrique-core' ); ?>:</td>
			<td class="bp-status-help"><?php echo '<a href="#" class="bp-help" data-tooltip="' . esc_attr__( 'The maximum amount of memory (RAM) that your site can use at one time.', 'fabrique-core' ) . '">[?]</a>'; ?></td>
			<td class="bp-status-detail"><?php
				$memory = fabrique_core_let_to_num( WP_MEMORY_LIMIT );

				if ( $memory < 67108864 ) {
					echo '<mark class="error">' . esc_html( size_format( $memory ) ) . ' - ' . esc_html__( 'We recommend setting memory to at least 64MB. See: ', 'fabrique-core' ) . '<a href="http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP" target="_blank">' . esc_html__( 'Increasing memory allocated to PHP', 'fabrique-core' ) . '</a></mark>';
				} else {
					echo '<mark class="yes">' . size_format( $memory ) . '</mark>';
				}
			?></td>
		</tr>
		<tr>
			<td class="bp-status-label"><?php esc_html_e( 'WP Debug Mode', 'fabrique-core' ); ?>:</td>
			<td class="bp-status-help"><?php echo '<a href="#" class="bp-help" data-tooltip="' . esc_attr__( 'Displays whether or not WordPress is in Debug Mode.', 'fabrique-core' ) . '">[?]</a>'; ?></td>
			<td class="bp-status-detail"><?php if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) echo '<mark class="yes">' . '&#10004;' . '</mark>'; else echo '&ndash;'; ?></td>
		</tr>
		<tr>
			<td class="bp-status-label"><?php esc_html_e( 'Language', 'fabrique-core' ); ?>:</td>
			<td class="bp-status-help"><?php echo '<a href="#" class="bp-help" data-tooltip="' . esc_attr__( 'The current language used by WordPress. Default = English', 'fabrique-core' ) . '">[?]</a>'; ?></td>
			<td class="bp-status-detail"><?php echo get_locale() ?></td>
		</tr>
	</tbody>
</table>
<div class="bp-status-title"><?php esc_html_e( 'Server Environment', 'fabrique-core' ); ?></div>
<table class="bp-status-content">
	<tbody>
		<tr>
			<td class="bp-status-label"><?php esc_html_e( 'Server Info', 'fabrique-core' ); ?>:</td>
			<td class="bp-status-help"><?php echo '<a href="#" class="bp-help" data-tooltip="' . esc_attr__( 'Information about the web server that is currently hosting your site.', 'fabrique-core' ) . '">[?]</a>'; ?></td>
			<td class="bp-status-detail"><?php echo esc_html( $_SERVER['SERVER_SOFTWARE'] ); ?></td>
		</tr>
		<tr>
			<td class="bp-status-label"><?php esc_html_e( 'PHP Version', 'fabrique-core' ); ?>:</td>
			<td class="bp-status-help"><?php echo '<a href="#" class="bp-help" data-tooltip="' . esc_attr__( 'The version of PHP installed on your hosting server.', 'fabrique-core' ) . '">[?]</a>'; ?></td>
			<td class="bp-status-detail"><?php
				// Check if phpversion function exists
				if ( function_exists( 'phpversion' ) ) {
					$php_version = phpversion();
					echo '<mark class="yes">' . esc_html( $php_version ) . '</mark>';
				} else {
					esc_html_e( "Couldn't determine PHP version because phpversion() doesn't exist.", 'fabrique-core' );
				}
				?></td>
		</tr>
		<?php if ( function_exists( 'ini_get' ) ) : ?>
			<tr>
				<td class="bp-status-label"><?php esc_html_e( 'PHP Post Max Size', 'fabrique-core' ); ?>:</td>
				<td class="bp-status-help"><?php echo '<a href="#" class="bp-help" data-tooltip="' . esc_attr__( 'The largest filesize that can be contained in one post.', 'fabrique-core' ) . '">[?]</a>'; ?></td>
				<td class="bp-status-detail"><?php
				$php_max_size = (int) ini_get( 'post_max_size' );

				if ( $php_max_size < 32 ) {
					echo '<mark class="error">' . esc_html( size_format( fabrique_core_let_to_num( ini_get('post_max_size') ) ) ) . ' - ' . esc_html__( 'Reccomended value is at least 32. ', 'fabrique-core' ) . '<a href="https://www.a2hosting.com/kb/developer-corner/php/using-php-directives-in-custom-htaccess-files/setting-the-php-maximum-upload-file-size-in-an-htaccess-file" target="_blank">' . esc_html__( 'Please increase it.', 'fabrique-core' ) . '</a></mark>';
				} else {
					echo '<mark class="yes">' . size_format( fabrique_core_let_to_num( ini_get('post_max_size') ) ) . '</mark>';
				}
				?></td>
			</tr>
			<tr>
				<td class="bp-status-label"><?php esc_html_e( 'PHP Time Limit', 'fabrique-core' ); ?>:</td>
				<td class="bp-status-help"><?php echo '<a href="#" class="bp-help" data-tooltip="' . esc_attr__( 'The amount of time (in seconds) that your site will spend on a single operation before timing out (to avoid server lockups)', 'fabrique-core' ) . '">[?]</a>'; ?></td>
				<td class="bp-status-detail"><?php
				$php_max_time = ini_get('max_execution_time');

				if ( $php_max_time < 120 ) {
					echo '<mark class="error">' . esc_html( $php_max_time ) . ' - ' . esc_html__( 'Reccomended value is at least 120. ', 'fabrique-core' ) . '<a href="http://codex.wordpress.org/Common_WordPress_Errors#Maximum_execution_time_exceeded" target="_blank">' . esc_html__( 'Please increase it.', 'fabrique-core' ) . '</a></mark>';
				} else {
					echo '<mark class="yes">' . esc_html( $php_max_time ) . '</mark>';
				}
				?></td>
			</tr>
			<tr>
			<?php
				$max_input = ini_get('max_input_vars');
				if ( $max_input < 3000 ) {
					$max_input = '<span class="error">' . $max_input . '  -  ' . esc_html__( 'Reccomended value is at least 3000. ', 'fabrique-core' ) . '<a href="http://docs.woothemes.com/document/problems-with-large-amounts-of-data-not-saving-variations-rates-etc/#section-2" target="_blank">' . esc_html__( 'Please increase it.', 'fabrique-core' ) . '</a></span>';
				}
			?>
				<td class="bp-status-label"><?php esc_html_e( 'PHP Max Input Vars', 'fabrique-core' ); ?>:</td>
				<td class="bp-status-help"><?php echo '<a href="#" class="bp-help" data-tooltip="' . esc_attr__( 'The maximum number of variables your server can use for a single function to avoid overloads.', 'fabrique-core' ) . '">[?]</a>'; ?></td>
				<td class="bp-status-detail"><?php echo wp_kses_post( $max_input ); ?></td>
			</tr>
			<tr>
				<td class="bp-status-label"><?php esc_html_e( 'SUHOSIN Installed', 'fabrique-core' ); ?>:</td>
				<td class="bp-status-help"><?php echo '<a href="#" class="bp-help" data-tooltip="' . esc_attr__( 'Suhosin is an advanced protection system for PHP installations. It was designed to protect your servers on the one hand against a number of well known problems in PHP applications and on the other hand against potential unknown vulnerabilities within these applications or the PHP core itself. If enabled on your server, Suhosin may need to be configured to increase its data submission limits.', 'fabrique-core' ) . '">[?]</a>'; ?></td>
				<td class="bp-status-detail"><?php echo extension_loaded( 'suhosin' ) ? '&#10004;' : '&ndash;'; ?></td>
			</tr>
		<?php endif; ?>
		<tr>
			<td class="bp-status-label"><?php esc_html_e( 'MySQL Version', 'fabrique-core' ); ?>:</td>
			<td class="bp-status-help"><?php echo '<a href="#" class="bp-help" data-tooltip="' . esc_attr__( 'The version of MySQL installed on your hosting server.', 'fabrique-core' ) . '">[?]</a>'; ?></td>
			<td class="bp-status-detail"><?php
				/** @global wpdb $wpdb */
				global $wpdb;
				echo esc_html( $wpdb->db_version() );
				?></td>
		</tr>
		<tr>
			<td class="bp-status-label"><?php esc_html_e( 'Max Upload Size', 'fabrique-core' ); ?>:</td>
			<td class="bp-status-help"><?php echo '<a href="#" class="bp-help" data-tooltip="' . esc_attr__( 'The largest filesize that can be uploaded to your WordPress installation.', 'fabrique-core' ) . '">[?]</a>'; ?></td>
			<td class="bp-status-detail"><?php
			$php_max_size = (int) size_format( wp_max_upload_size() );

			if ( $php_max_size < 10 ) {
				echo '<mark class="error">' . size_format( wp_max_upload_size() ) . ' - ' . esc_html__( 'Reccomended value is at least 10. ', 'fabrique-core' ) . '<a href="https://www.a2hosting.com/kb/developer-corner/php/using-php-directives-in-custom-htaccess-files/setting-the-php-maximum-upload-file-size-in-an-htaccess-file" target="_blank">' . esc_html__( 'Please increase it.', 'fabrique-core' ) . '</a></mark>';
			} else {
				echo '<mark class="yes">' . size_format( wp_max_upload_size() ) . '</mark>';
			}
			?></td>
		</tr>
		<tr>
			<td class="bp-status-label"><?php esc_html_e( 'Default Timezone is UTC', 'fabrique-core' ); ?>:</td>
			<td class="bp-status-help"><?php echo '<a href="#" class="bp-help" data-tooltip="' . esc_attr__( 'The default timezone for your server.', 'fabrique-core' ) . '">[?]</a>'; ?></td>
			<td class="bp-status-detail"><?php
				$default_timezone = date_default_timezone_get();
				if ( 'UTC' !== $default_timezone ) {
					echo '<mark class="error">' . '&#10005; ' . sprintf( esc_html__( 'Default timezone is %s - it should be UTC', 'fabrique-core' ), $default_timezone ) . '</mark>';
				} else {
					echo '<mark class="yes">' . '&#10004;' . '</mark>';
				} ?>
			</td>
		</tr>
	</tbody>
</table>
<div class="bp-status-title"><?php esc_html_e( 'Theme', 'fabrique-core' ); ?></div>
<?php
	$active_theme = wp_get_theme();
?>
<table class="bp-status-content">
	<tbody>
		<tr>
			<td class="bp-status-label"><?php esc_html_e( 'Name', 'fabrique-core' ); ?>:</td>
			<td class="bp-status-help"><?php echo '<a href="#" class="bp-help" data-tooltip="' . esc_attr__( 'The name of the current active theme.', 'fabrique-core' ) . '">[?]</a>'; ?></td>
			<td class="bp-status-detail"><?php echo esc_html($active_theme->Name); ?></td>
		</tr>
		<tr>
			<td class="bp-status-label"><?php esc_html_e( 'Version', 'fabrique-core' ); ?>:</td>
			<td class="bp-status-help"><?php echo '<a href="#" class="bp-help" data-tooltip="' . esc_attr__( 'The installed version of the current active theme.', 'fabrique-core' ) . '">[?]</a>'; ?></td>
			<td class="bp-status-detail"><?php
				echo esc_html( $active_theme->Version );

				if ( ! empty( $theme_version_data['version'] ) && version_compare( $theme_version_data['version'], $active_theme->Version, '!=' ) ) {
					echo ' &ndash; <strong style="color:red;">' . $theme_version_data['version'] . ' ' . esc_html__( 'is available', 'fabrique-core' ) . '</strong>';
				}
			?></td>
		</tr>
		<tr>
			<td class="bp-status-label"><?php esc_html_e( 'Author URL', 'fabrique-core' ); ?>:</td>
		  <td class="bp-status-help"><?php echo '<a href="#" class="bp-help" data-tooltip="' . esc_attr__( 'The theme developers URL.', 'fabrique-core' ) . '">[?]</a>'; ?></td>
			<td class="bp-status-detail"><?php echo wp_kses_post($active_theme->{'Author URI'}); ?></td>
		</tr>
		<tr>
			<td class="bp-status-label"><?php esc_html_e( 'Child Theme', 'fabrique-core' ); ?>:</td>
			<td class="bp-status-help"><?php echo '<a href="#" class="bp-help" data-tooltip="' . esc_attr__( 'Displays whether or not the current theme is a child theme.', 'fabrique-core' ) . '">[?]</a>'; ?></td>
			<td class="bp-status-detail"><?php
				echo is_child_theme() ? '<mark class="yes">' . '&#10004;' . '</mark>' : '&#10005; &ndash; ' . sprintf( wp_kses(__( 'If you\'re modifying theme source code, we recommend using child theme. See: <a href="%s" target="_blank">How to create a child theme</a>', 'fabrique-core' ), array( 'a' => array( 'href' => array(),'target' => array() ) ) ), 'http://codex.wordpress.org/Child_Themes' );
			?></td>
		</tr>
		<?php if( is_child_theme() ) : ?>
			<?php $parent_theme = wp_get_theme( $active_theme->Template ); ?>
			<tr>
				<td class="bp-status-label"><?php esc_html_e( 'Parent Theme Name', 'fabrique-core' ); ?>:</td>
				<td class="bp-status-help"><?php echo '<a href="#" class="bp-help" data-tooltip="' . esc_attr__( 'The name of the parent theme.', 'fabrique-core' ) . '">[?]</a>'; ?></td>
				<td class="bp-status-detail"><?php echo esc_html($parent_theme->Name); ?></td>
			</tr>
			<tr>
				<td class="bp-status-label"><?php esc_html_e( 'Parent Theme Version', 'fabrique-core' ); ?>:</td>
				<td class="bp-status-help"><?php echo '<a href="#" class="bp-help" data-tooltip="' . esc_attr__( 'The installed version of the parent theme.', 'fabrique-core' ) . '">[?]</a>'; ?></td>
				<td class="bp-status-detail"><?php echo esc_html($parent_theme->Version); ?></td>
			</tr>
			<tr>
				<td class="bp-status-label"><?php esc_html_e( 'Parent Theme Author URL', 'fabrique-core' ); ?>:</td>
				<td class="bp-status-help"><?php echo '<a href="#" class="bp-help" data-tooltip="' . esc_attr__( 'The parent theme developers URL.', 'fabrique-core' ) . '">[?]</a>'; ?></td>
				<td class="bp-status-detail"><?php echo wp_kses_post($parent_theme->{'Author URI'}); ?></td>
			</tr>
			<tr>
				<td class="bp-status-label"><?php esc_html_e( 'Overridden files', 'fabrique-core' ); ?>:</td>
				<td class="bp-status-help"><?php echo '<a href="#" class="bp-help" data-tooltip="' . esc_attr__( 'Templates which are overridden by child theme.', 'fabrique-core' ) . '">[?]</a>'; ?></td>
				<td class="bp-status-detail">
					<?php
						$parent_theme_path = get_template_directory();
						$child_theme_path = get_stylesheet_directory();

						$template_files = fabrique_core_scan_template_files( $child_theme_path );
						foreach ( $template_files as $file ) {
							$core_file = $parent_theme_path . '/' . $file;
							$child_template_file = $child_theme_path . '/' . $file;

							if ( file_exists( $core_file ) ) {
								$core_version = fabrique_core_get_template_file_version( $core_file );
								$child_template_version = fabrique_core_get_template_file_version( $child_template_file );

								if ( $core_version && ( empty( $child_template_version ) || version_compare( $child_template_version, $core_version, '<' ) ) ) {
									if ( $child_template_version && !empty( $child_template_version ) ) {
										echo sprintf(
											__( '<code>%s</code> version <strong style="color:red">%s</strong> is out of date. Current version is <strong style="color:#01a2dd">%s</strong>', 'fabrique-core' ),
											str_replace( WP_CONTENT_DIR . '/themes/', '', $child_template_file ),
											$child_template_version,
											$core_version
										) . '<br>';
									} else {
										echo sprintf(
											__( '<code>%s</code> <strong style="color:red">version is not defined</strong>', 'fabrique-core' ),
											str_replace( WP_CONTENT_DIR . '/themes/', '', $child_template_file )
										) . '<br>';
									}
								} else {
									echo sprintf(
										'<code>%s</code>',
										str_replace( WP_CONTENT_DIR . '/themes/', '', $child_template_file )
									) . '<br>';
								}
							}
						}
					?>
				</td>
			</tr>
		<?php endif; ?>
	</tbody>
</table>
