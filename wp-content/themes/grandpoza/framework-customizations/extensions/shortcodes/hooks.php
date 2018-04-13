<?php if (!defined('FW')) die('Forbidden');


/**
 * Disable builtin shortcodes
 * @param mixed $to_disable
 * @return string[]
 */
function _filter_theme_disable_default_shortcodes($to_disable) {

    $to_disable= array( 'button', 'accordion' , 'calendar' , 'special-heading' ,'testimonials' );
    return $to_disable;

}


/**
 * Demo content Installation
 * @param mixed $demos
 * @return mixed
 */
function _filter_theme_fw_ext_backups_demos($demos) {

    $demos_array = array(
        'grandpoza-demo' => array(
            'title'         => esc_html__('Grandpoza theme demo', 'grandpoza'),
            'screenshot'    => 'http://themes.kapp.rw/demo/grandpoza.png',
            'preview_link'  => 'http://themes.kapp.rw/grandpoza',
        ),
    );

    $download_url = 'http://themes.kapp.rw/demo/get_demo.php';

    foreach ($demos_array as $id => $data) {
        $demo = new FW_Ext_Backups_Demo($id, 'piecemeal' , array(
            'url'       => $download_url,
            'file_id'   => $id,
        ));

        $demo->set_title( $data['title'] );
        $demo->set_screenshot( $data['screenshot'] );
        $demo->set_preview_link( $data['preview_link'] );

        $demos[ $demo->get_id() ] = $demo;
        unset($demo);
    }

    return $demos;
}

/**
 * Remove Built-in sliders that are not needed
 * @param mixed $sliders
 * @return mixed
 */
function remove_slider($sliders){
    $key = array_search('owl-carousel', $sliders);
    unset($sliders[$key]);
    return $sliders;
}

/**
 * REGISTER THEME ICON POST TYPE
 */
function _action_theme_include_custom_option_types() {
    require_once fw_get_template_customizations_directory() . '/option-types/flaticon/class-kapp-option-type-flaticon.php';
}

add_action( 'fw_option_types_init', '_action_theme_include_custom_option_types' );
add_filter( 'fw:ext:backups-demo:demos', '_filter_theme_fw_ext_backups_demos' );
add_filter( 'fw_ext_shortcodes_disable_shortcodes', '_filter_theme_disable_default_shortcodes' );
add_filter( 'fw_ext_slider_activated', 'remove_slider' );


