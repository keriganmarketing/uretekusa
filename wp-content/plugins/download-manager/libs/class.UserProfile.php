<?php
namespace WPDM;

class UserProfile
{

    public $profile_menu;
    public $profile_menu_actions;

    function __construct(){
        add_action("wp", array($this, 'profileMenuInit'));
        add_shortcode("wpdm_user_profile", array($this, 'Profile'));
    }

    function profileMenuInit(){
        $this->profile_menu[''] = array('name'=> __('Profile','wpdmpro'), 'callback' => array($this, 'Profile'));
        $this->profile_menu = apply_filters("wpdm_user_profile_menu", $this->profile_menu);
        $this->profile_menu_actions = apply_filters("wpdm_profile_menu_actions", $this->profile_menu_actions);
    }

    function Profile($params = array()){
        global $wp_query;


        if(!isset($params) || !is_array($params)) $params = array();

        ob_start();
        global $current_user;
        $username = get_query_var('profile');
        if(is_author())
            $username = get_query_var('author_name');
        if($username)
            $user = get_user_by('login', $username);
        else
            $user = $current_user;

        $cols = isset($params['cols'])?$params['cols']:3;
        $items_per_page = isset($params['items_per_page'])?$params['items_per_page']:$cols*3;
        $cols = 12/$cols;
        $template = isset($params['template'])?$params['template']:'link-template-panel.php';

        include_once wpdm_tpl_path('user-profile/profile.php');
        return ob_get_clean();
    }


}

