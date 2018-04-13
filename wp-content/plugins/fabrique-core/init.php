<?php

/**
 * Plugin Name: Fabrique Core
 * Plugin URI: http://www.twisttheme.com
 * Description: FabriqueCore
 * Author: Twisttheme
 * Version: 1.0.11
 * Author URI: http://www.twisttheme.com
 */

define( 'CORE_PLUGIN_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'CORE_PLUGIN_URL', untrailingslashit( plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) ) ) );

require_once CORE_PLUGIN_DIR . '/lib/fabrique-core.php';

// Plugins
require_once CORE_PLUGIN_DIR . '/classes/modules/contact-module.php';
require_once CORE_PLUGIN_DIR . '/classes/modules/delivery-module.php';
require_once CORE_PLUGIN_DIR . '/classes/modules/project-module.php';
require_once CORE_PLUGIN_DIR . '/classes/modules/shortcode-module.php';

require_once CORE_PLUGIN_DIR . '/includes/blueprint.php';
require_once CORE_PLUGIN_DIR . '/includes/blueprint-template.php';
require_once CORE_PLUGIN_DIR . '/includes/widgets.php';

function fabrique_core_version()
{
	return '1.0.11';
}

/**
 * Initialize Fabrique Core plugin
 **/
add_action( 'init', 'fabrique_core_init', 9 );


/**
 * Load plugin textdomain.
 */
function myplugin_load_textdomain() {
	load_plugin_textdomain( 'fabrique-core', false, basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'myplugin_load_textdomain' );


function fabrique_core_register_modules( $fabrique_core )
{
	$fabrique_core->register_module( new Fabrique_Shortcode_Module( $fabrique_core ) );
	$fabrique_core->register_module( new Fabrique_Project_Module( $fabrique_core ) );
	$fabrique_core->register_module( new Fabrique_Contact_Module( $fabrique_core ) );

	if ( fabrique_core_woocommerce_activated() ) {
		$fabrique_core->register_module( new Fabrique_Delivery_Module( $fabrique_core ) );
	}
}
add_action( 'fabrique_core_init', 'fabrique_core_register_modules' );


function fabrique_core_importer_options( $options )
{
	$options['prefix'] = 'fbq';
	$options['asset_path'] = CORE_PLUGIN_DIR . '/lib/assets';

	return $options;
}
add_filter( 'fabrique_core_importer_options', 'fabrique_core_importer_options' );
