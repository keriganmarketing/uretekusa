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

class Ai1wmge_Main_Controller {

	/**
	 * Main Application Controller
	 *
	 * @return Ai1wmge_Main_Controller
	 */
	public function __construct() {
		register_activation_hook( AI1WMGE_PLUGIN_BASENAME, array( $this, 'activation_hook' ) );

		// Activate hooks
		$this->activate_actions()
			->activate_filters()
			->activate_textdomain();
	}

	/**
	 * Activation hook callback
	 *
	 * @return Object Instance of this class
	 */
	public function activation_hook() {

	}

	/**
	 * Initializes language domain for the plugin
	 *
	 * @return Object Instance of this class
	 */
	private function activate_textdomain() {
		load_plugin_textdomain( AI1WMGE_PLUGIN_NAME, false, false );

		return $this;
	}

	/**
	 * Register plugin menus
	 *
	 * @return void
	 */
	public function admin_menu() {
		// Sub-level Settings menu
		add_submenu_page(
			'ai1wm_export',
			__( 'Google Drive Settings', AI1WMGE_PLUGIN_NAME ),
			__( 'Google Drive Settings', AI1WMGE_PLUGIN_NAME ),
			'export',
			'ai1wmge_settings',
			'Ai1wmge_Settings_Controller::index'
		);
	}

	/**
	 * Enqueue scripts and styles for Export Controller
	 *
	 * @param  string $hook Hook suffix
	 * @return void
	 */
	public function enqueue_export_scripts_and_styles( $hook ) {
		if ( stripos( 'toplevel_page_ai1wm_export', $hook ) === false ) {
			return;
		}

		if ( is_rtl() ) {
			wp_enqueue_style(
				'ai1wmge_export',
				Ai1wm_Template::asset_link( 'css/export.min.rtl.css', 'AI1WMGE' ),
				array( 'ai1wm_export' )
			);
		} else {
			wp_enqueue_style(
				'ai1wmge_export',
				Ai1wm_Template::asset_link( 'css/export.min.css', 'AI1WMGE' ),
				array( 'ai1wm_export' )
			);
		}

		wp_enqueue_script(
			'ai1wmge_export',
			Ai1wm_Template::asset_link( 'javascript/export.min.js', 'AI1WMGE' ),
			array( 'ai1wm_export' )
		);
	}

	/**
	 * Enqueue scripts and styles for Import Controller
	 *
	 * @param  string $hook Hook suffix
	 * @return void
	 */
	public function enqueue_import_scripts_and_styles( $hook ) {
		if ( stripos( 'all-in-one-wp-migration_page_ai1wm_import', $hook ) === false ) {
			return;
		}

		if ( is_rtl() ) {
			wp_enqueue_style(
				'ai1wmge_import',
				Ai1wm_Template::asset_link( 'css/import.min.rtl.css', 'AI1WMGE' ),
				array( 'ai1wm_import' )
			);
		} else {
			wp_enqueue_style(
				'ai1wmge_import',
				Ai1wm_Template::asset_link( 'css/import.min.css', 'AI1WMGE' ),
				array( 'ai1wm_import' )
			);
		}

		wp_enqueue_script(
			'ai1wmge_import',
			Ai1wm_Template::asset_link( 'javascript/import.min.js', 'AI1WMGE' ),
			array( 'ai1wm_import' )
		);

		wp_localize_script( 'ai1wmge_import', 'ai1wmge_import', array(
			'ajax' => array(
				'browser_url' => wp_make_link_relative( admin_url( 'admin-ajax.php?action=ai1wmge_gdrive_browser' ) ),
			),
		) );
	}

	/**
	 * Enqueue scripts and styles for Settings Controller
	 *
	 * @param  string $hook Hook suffix
	 * @return void
	 */
	public function enqueue_settings_scripts_and_styles( $hook ) {
		if ( stripos( 'all-in-one-wp-migration_page_ai1wmge_settings', $hook ) === false ) {
			return;
		}

		if ( is_rtl() ) {
			wp_enqueue_style(
				'ai1wmge_settings',
				Ai1wm_Template::asset_link( 'css/settings.min.rtl.css', 'AI1WMGE' ),
				array( 'ai1wm_servmask' )
			);
		} else {
			wp_enqueue_style(
				'ai1wmge_settings',
				Ai1wm_Template::asset_link( 'css/settings.min.css', 'AI1WMGE' ),
				array( 'ai1wm_servmask' )
			);
		}

		wp_enqueue_script(
			'ai1wmge_settings',
			Ai1wm_Template::asset_link( 'javascript/settings.min.js', 'AI1WMGE' ),
			array( 'ai1wm_feedback', 'ai1wm_report' )
		);

		wp_localize_script( 'ai1wmge_settings', 'ai1wm_feedback', array(
			'ajax'       => array(
				'url' => wp_make_link_relative( admin_url( 'admin-ajax.php?action=ai1wm_feedback' ) ),
			),
			'secret_key' => get_option( AI1WM_SECRET_KEY ),
		) );

		wp_localize_script( 'ai1wmge_settings', 'ai1wm_report', array(
			'ajax'       => array(
				'url' => wp_make_link_relative( admin_url( 'admin-ajax.php?action=ai1wm_report' ) ),
			),
			'secret_key' => get_option( AI1WM_SECRET_KEY ),
		) );

		wp_localize_script( 'ai1wmge_settings', 'ai1wmge_settings', array(
			'ajax'  => array(
				'folder_url'   => wp_make_link_relative( admin_url( 'admin-ajax.php?action=ai1wmge_gdrive_folder' ) ),
				'account_url'  => wp_make_link_relative( admin_url( 'admin-ajax.php?action=ai1wmge_gdrive_account' ) ),
				'selector_url' => wp_make_link_relative( admin_url( 'admin-ajax.php?action=ai1wmge_gdrive_selector' ) ),
			),
			'token' => get_option( 'ai1wmge_gdrive_token' ),
		) );
	}

	/**
	 * Outputs menu icon between head tags
	 *
	 * @return void
	 */
	public function admin_head() {
		?>
		<style type="text/css" media="all">
			.ai1wm-label {
				border: 1px solid #5cb85c;
				background-color: transparent;
				color: #5cb85c;
				cursor: pointer;
				text-transform: uppercase;
				font-weight: 600;
				outline: none;
				transition: background-color 0.2s ease-out;
				padding: .2em .6em;
				font-size: 0.8em;
				border-radius: 5px;
				text-decoration: none !important;
			}

			.ai1wm-label:hover {
				background-color: #5cb85c;
				color: #fff;
			}
		</style>
		<?php
	}

	/**
	 * Register listeners for actions
	 *
	 * @return Object Instance of this class
	 */
	private function activate_actions() {
		// Init
		add_action( 'admin_init', array( $this, 'init' ) );

		// Router
		add_action( 'admin_init', array( $this, 'router' ) );

		// Admin header
		add_action( 'admin_head', array( $this, 'admin_head' ) );

		// All in One WP Migration
		add_action( 'plugins_loaded', array( $this, 'ai1wm_loaded' ), 10 );

		// Export and import commands
		add_action( 'plugins_loaded', array( $this, 'ai1wm_commands' ), 20 );

		// Enable notifications
		add_action( 'plugins_loaded', array( $this, 'ai1wm_notification' ), 20 );

		// Enqueue export scripts and styles
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_export_scripts_and_styles' ), 20 );

		// Enqueue import scripts and styles
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_import_scripts_and_styles' ), 20 );

		// Enqueue settings scripts and styles
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_settings_scripts_and_styles' ), 20 );

		return $this;
	}

	/**
	 * Register listeners for filters
	 *
	 * @return Object Instance of this class
	 */
	private function activate_filters() {
		// Add links to plugin list page
		add_filter( 'plugin_row_meta', array( $this, 'plugin_row_meta' ), 5, 2 );

		return $this;
	}

	/**
	 * Enable notifications
	 *
	 * @return void
	 */
	public function ai1wm_notification() {
		if ( isset( $_GET['gdrive'] ) || isset( $_POST['gdrive'] ) ) {
			// Add ok notifications
			add_filter( 'ai1wm_notification_ok_toggle', 'Ai1wmge_Settings_Controller::notify_ok_toggle' );
			add_filter( 'ai1wm_notification_ok_email', 'Ai1wmge_Settings_Controller::notify_email' );

			// Add error notifications
			add_filter( 'ai1wm_notification_error_toggle', 'Ai1wmge_Settings_Controller::notify_error_toggle' );
			add_filter( 'ai1wm_notification_error_subject', 'Ai1wmge_Settings_Controller::notify_error_subject' );
			add_filter( 'ai1wm_notification_error_email', 'Ai1wmge_Settings_Controller::notify_email' );
		}
	}

	/**
	 * Export and import commands
	 *
	 * @return void
	 */
	public function ai1wm_commands() {
		if ( isset( $_GET['gdrive'] ) || isset( $_POST['gdrive'] ) ) {
			// Add export commands
			add_filter( 'ai1wm_export', 'Ai1wmge_Export_GDrive::execute', 250 );
			add_filter( 'ai1wm_export', 'Ai1wmge_Export_Upload::execute', 260 );
			add_filter( 'ai1wm_export', 'Ai1wmge_Export_Retention::execute', 270 );
			add_filter( 'ai1wm_export', 'Ai1wmge_Export_Done::execute', 280 );

			// Add import commands
			add_filter( 'ai1wm_import', 'Ai1wmge_Import_GDrive::execute', 20 );
			add_filter( 'ai1wm_import', 'Ai1wmge_Import_Download::execute', 30 );
			add_filter( 'ai1wm_import', 'Ai1wmge_Import_Settings::execute', 290 );
			add_filter( 'ai1wm_import', 'Ai1wmge_Import_Database::execute', 310 );

			// Remove export commands
			remove_filter( 'ai1wm_export', 'Ai1wm_Export_Download::execute', 250 );

			// Remove import commands
			remove_filter( 'ai1wm_import', 'Ai1wm_Import_Upload::execute', 5 );
		}
	}

	/**
	 * Check whether All in one WP Migration has been loaded
	 *
	 * @return void
	 */
	public function ai1wm_loaded() {
		if ( ! defined( 'AI1WM_PLUGIN_NAME' ) ) {
			if ( is_multisite() ) {
				add_action( 'network_admin_notices', array( $this, 'ai1wm_notice' ) );
			} else {
				add_action( 'admin_notices', array( $this, 'ai1wm_notice' ) );
			}
		} else {
			if ( is_multisite() ) {
				add_action( 'network_admin_menu', array( $this, 'admin_menu' ), 20 );
			} else {
				add_action( 'admin_menu', array( $this, 'admin_menu' ), 20 );
			}

			// Google Drive settings
			add_action( 'admin_post_ai1wmge_gdrive_settings', 'Ai1wmge_Settings_Controller::settings' );

			// Google Drive revoke
			add_action( 'admin_post_ai1wmge_gdrive_revoke', 'Ai1wmge_Settings_Controller::revoke' );

			// Cron settings
			add_action( 'ai1wmge_gdrive_hourly_export', 'Ai1wm_Export_Controller::export' );
			add_action( 'ai1wmge_gdrive_daily_export', 'Ai1wm_Export_Controller::export' );
			add_action( 'ai1wmge_gdrive_weekly_export', 'Ai1wm_Export_Controller::export' );
			add_action( 'ai1wmge_gdrive_monthly_export', 'Ai1wm_Export_Controller::export' );

			// Folder picker
			add_action( 'ai1wmge_settings_left_end', 'Ai1wmge_Settings_Controller::picker' );

			// File picker
			add_action( 'ai1wm_import_left_end', 'Ai1wmge_Import_Controller::picker' );

			// Add export button
			add_filter( 'ai1wm_export_gdrive', 'Ai1wmge_Export_Controller::button' );

			// Add import button
			add_filter( 'ai1wm_import_gdrive', 'Ai1wmge_Import_Controller::button' );

			// Add import unlimited
			add_filter( 'ai1wm_max_file_size', array( $this, 'max_file_size' ) );
		}
	}

	/**
	 * Display All in one WP Migration notice
	 *
	 * @return void
	 */
	public function ai1wm_notice() {
		?>
		<div class="error">
			<p>
				<?php
				_e(
					'Google Drive extension requires <a href="https://wordpress.org/plugins/all-in-one-wp-migration/" target="_blank">All-in-One WP Migration plugin</a> to be activated. ' .
					'<a href="https://help.servmask.com/knowledgebase/install-instructions-for-google-drive-extension/" target="_blank">Google Drive extension install instructions</a>',
					AI1WMGE_PLUGIN_NAME
				);
				?>
			</p>
		</div>
		<?php
	}

	/**
	 * Add links to plugin list page
	 *
	 * @return array
	 */
	public function plugin_row_meta( $links, $file ) {
		if ( $file == AI1WMGE_PLUGIN_BASENAME ) {
			$links[] = __( '<a href="https://help.servmask.com/knowledgebase/google-drive-extension-user-guide/" target="_blank">User Guide</a>', AI1WMGE_PLUGIN_NAME );
		}

		return $links;
	}

	/**
	 * Max file size callback
	 *
	 * @return string
	 */
	public function max_file_size() {
		return AI1WMGE_MAX_FILE_SIZE;
	}

	/**
	 * Register initial parameters
	 *
	 * @return void
	 */
	public function init() {
		// Set Google Drive Token
		if ( isset( $_GET['ai1wmge-token'] ) ) {
			update_option( 'ai1wmge_gdrive_token', trim( $_GET['ai1wmge-token'] ) );

			// Redirect
			wp_redirect( network_admin_url( 'admin.php?page=ai1wmge_settings' ) );
			exit;
		}

		// Set Purchase ID
		if ( ! get_option( 'ai1wmge_plugin_key' ) ) {
			update_option( 'ai1wmge_plugin_key', AI1WMGE_PURCHASE_ID );
		}
	}

	/**
	 * Register initial router
	 *
	 * @return void
	 */
	public function router() {
		// Export
		if ( current_user_can( 'export' ) ) {
			add_action( 'wp_ajax_ai1wmge_gdrive_folder', 'Ai1wmge_Settings_Controller::folder' );
			add_action( 'wp_ajax_ai1wmge_gdrive_account', 'Ai1wmge_Settings_Controller::account' );
			add_action( 'wp_ajax_ai1wmge_gdrive_selector', 'Ai1wmge_Settings_Controller::selector' );
		}

		// Import
		if ( current_user_can( 'import' ) ) {
			add_action( 'wp_ajax_ai1wmge_gdrive_browser', 'Ai1wmge_Import_Controller::browser' );
		}
	}
}
