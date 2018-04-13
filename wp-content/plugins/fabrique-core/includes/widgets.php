<?php

$widgets_directory = CORE_PLUGIN_DIR . '/classes/widgets';
require_once $widgets_directory . '/lib/twitter-oauth.php';
require_once $widgets_directory . '/base.php';
require_once $widgets_directory . '/banner.php';
require_once $widgets_directory . '/contact.php';
require_once $widgets_directory . '/feature.php';
require_once $widgets_directory . '/flickr.php';
require_once $widgets_directory . '/highlight-post.php';
require_once $widgets_directory . '/html.php';
require_once $widgets_directory . '/instagram.php';
require_once $widgets_directory . '/post.php';
require_once $widgets_directory . '/project.php';
require_once $widgets_directory . '/social.php';
require_once $widgets_directory . '/twitter.php';

/**
 * Register Widgets
 */
function fabrique_widgets_init()
{
	register_widget( 'Fabrique_Widget_Banner' );
	register_widget( 'Fabrique_Widget_Contact' );
	register_widget( 'Fabrique_Widget_Feature' );
	register_widget( 'Fabrique_Widget_Flickr' );
	register_widget( 'Fabrique_Widget_Highlight_Post' );
	register_widget( 'Fabrique_Widget_Html' );
	register_widget( 'Fabrique_Widget_Instagram' );
	register_widget( 'Fabrique_Widget_Post' );
	register_widget( 'Fabrique_Widget_Project' );
	register_widget( 'Fabrique_Widget_Social' );
	register_widget( 'Fabrique_Widget_Twitter' );
}
add_action( 'widgets_init', 'fabrique_widgets_init', 9 );
