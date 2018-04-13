<?php if (!defined('FW')) die('Forbidden');

$shortcodes_extension = fw_ext('shortcodes');
$uri = fw_get_template_customizations_directory_uri('/extensions/shortcodes/shortcodes/portfolio/static/js/ajax-load-projects.js');
wp_register_script(
	'kapp-ajax-load-projects',
	$uri,
	array()
);

wp_localize_script( 'kapp-ajax-load-projects',"kappProject", array(
	'ajaxurl'       =>  admin_url( 'admin-ajax.php'),
    'label'         => esc_html__( "Loading" , "grandpoza" ),
	'no_posts_msg'  => esc_html__( 'No more projects found', 'grandpoza' ),
) );

wp_enqueue_script('kapp-ajax-load-projects');
