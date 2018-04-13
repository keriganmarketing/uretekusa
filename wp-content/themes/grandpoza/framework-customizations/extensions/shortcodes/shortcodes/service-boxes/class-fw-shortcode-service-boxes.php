<?php

/**
 * Service Boxes shortcode Extention Class
 * @package Grandpoza Theme
 */

class FW_Shortcode_Service_Boxes extends FW_Shortcode {

    public static function get_categories()
    {
        $terms = get_terms( array(
            'taxonomy' => 'service_category',
            'hide_empty' => false
        ) );

        return $terms;
    }

    protected function _render($atts, $content = NULL, $tag = '')
    {
        $atts['categories'] = self::get_categories();
        return parent::_render($atts, $content, $tag );
    }
}