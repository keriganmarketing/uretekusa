<?php

/**
 * Porfolio shortcode Extention Class
 * @package Grandpoza Theme
 */

class FW_Shortcode_Portfolio extends FW_Shortcode {

    public function _init() {
		add_action('wp_ajax_nopriv_kapp_load_projects_ajax', array( $this, 'grandpoza_load_projects_ajax') );
        add_action('wp_ajax_kapp_load_projects_ajax', array( $this, 'grandpoza_load_projects_ajax') );
	}

    /**
     * Get project categories
     * @return array|integer|WP_Error
     */
    public static function get_categories()
    {
        $terms = get_terms( array(
            'taxonomy' => 'project_category',
            'hide_empty' => false
        ) );

        return $terms;
    }

    /**
     * AJAX Project loading
     */
    function grandpoza_load_projects_ajax()
    {
        $template = isset($_POST['template']) && is_numeric($_POST['template']) ? $_POST['template'] : 1;

        $args = array(
            "posts_per_page"    => $_POST["posts_to_pull"],
            "cat"               => $_POST['category'],
            "post_type"         => "project",
            "offset"            => $_POST['offset']
            );

        $portfolio_posts = new WP_Query($args);

        $file =  dirname(__FILE__)."/views/templates/content-template-{$template}.php";

        if(file_exists($file))
        {
            require $file;
        }

        die();
    }

    /**
     * Render Frontend
     * @param mixed $atts 
     * @param mixed $content 
     * @param mixed $tag 
     * @return mixed
     */
    protected function _render($atts, $content = NULL, $tag = '')
    {
        $atts['categories'] = self::get_categories();
        return parent::_render($atts, $content, $tag );
    }
}