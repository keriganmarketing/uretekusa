<?php
namespace WPDM;

class AuthorDashboard
{
    function __construct(){

        add_shortcode("wpdm_frontend", array($this, 'Dashboard'));
        add_shortcode("wpdm_package_list", array($this, 'packageList'));
        add_shortcode("wpdm_package_form", array($this, 'packageForm'));
        add_shortcode("wpdm_profile_info", array($this, 'editProfile'));
        add_shortcode("wpdm_author_settings", array($this, 'Settings'));
        add_action('wp_ajax_delete_package_frontend', array($this, 'deletePackage'));
        add_action('wp_ajax_wpdm_frontend_file_upload', array($this, 'uploadFile'));
        add_action('wp_ajax_wpdm_update_public_profile', array($this, 'updateProfile'));
        add_action('wp_ajax_wpdm_author_settings', array($this, 'saveSettings'));        
    }

    /**
     * @usage Short-code function for front-end UI
     * @return string
     */
    function Dashboard($params = array())
    {

        global $current_user;

        if(!is_user_logged_in()) {
            ob_start();
            if(isset($params['signup']) && $params['signup'] == 1)
                include \WPDM\Template::Locate('wpdm-be-member.php');
            else
                include  \WPDM\Template::Locate('wpdm-login-form.php');
            return ob_get_clean();
        }

        $msg = get_option('__wpdm_front_end_access_blocked', __('Sorry, Your Are Not Allowed!','wpdmpro'));
        $msg = $msg != ''?$msg:__('Sorry, Your Are Not Allowed!','wpdmpro');

        wp_reset_query();
        $currentAccess = maybe_unserialize(get_option('__wpdm_front_end_access', array()));
        $urlfix = isset($params['flaturl']) && $params['flaturl'] == 0?1:0;
        update_post_meta(get_the_ID(), '__urlfix', $urlfix);
        $task = get_query_var('adb_page');
        if($urlfix == 1) $task = wpdm_query_var('adb_page');
        $task = explode("/", $task);

        if($task[0] == 'edit-package') $pid = $task[1];
        if($task[0] == 'page') { $task[0] = ''; set_query_var('paged', $task[1]); }
        $task = $task[0];

        if (!array_intersect($currentAccess, $current_user->roles) && is_user_logged_in())
            return "<div class='w3eden'><div class='alert alert-danger'>" . wpautop(stripslashes($msg)) . "</div></div>";

        $id = wpdm_query_var('ID');


        $tabs = array( //'sales' => array('label'=>'Sales','callback'=>'wpdm_sales_report')
        );
        $tabs = apply_filters('wpdm_frontend', $tabs);
        $burl = get_permalink();
        $sap = strpos($burl, '?') ? '&' : '?';
        ob_start();
        include \WPDM\Template::Locate('author-dashboard.php');
        $data = ob_get_clean();
        wp_reset_query();
        return $data;
    }

    /**
     * @usage Delete package from front-end
     */
    function deletePackage()
    {
        global $wpdb, $current_user;
        if (isset($_GET['ID']) && intval($_GET['ID'])>0) {
            $id = (int)$_GET['ID'];
            $uid = $current_user->ID;
            if ($uid == '') die('Error! You are not logged in.');
            $post = get_post($id);
            if($post->post_author==$uid)
                wp_delete_post($id, true);
            echo "deleted";
            die();
        }
    }

    /**
     * @usage Upload files
     */
    function uploadFile(){

        global $current_user;

        $currentAccess = maybe_unserialize(get_option( '__wpdm_front_end_access', array()));
        // Check if user is authorized to upload file from front-end
        if(!is_user_logged_in() || !array_intersect($currentAccess, $current_user->roles) ) die(__('Error! You are not allowed to upload files.', 'wpdmpro'));

        $upload_dir = current_user_can('manage_options')?UPLOAD_DIR:UPLOAD_DIR.$current_user->user_login.'/';

        check_ajax_referer(NONCE_KEY);

        $name = isset($_FILES['attach_file']['name']) && !isset($_REQUEST["chunks"])?$_FILES['attach_file']['name']:$_REQUEST['name'];

        if(file_exists($upload_dir.$name) && get_option('__wpdm_overwrite_file_frontend',0)==1 && !isset($_REQUEST["chunks"])){
            @unlink($upload_dir.$name);
        }
        if(file_exists($upload_dir.$name) && !isset($_REQUEST["chunks"]))
            $filename = time().'wpdm_'.$name;
        else
            $filename = $name;

        //move_uploaded_file($_FILES['attach_file']['tmp_name'],UPLOAD_DIR.$filename);
        //echo $filename;

        if(!file_exists($upload_dir)){
            mkdir($upload_dir);
            \WPDM\FileSystem::blockHTTPAccess($upload_dir);
        }
        if (isset($_POST['current_path']) && $_POST['current_path'] != ''){
            $user_upload_dir = $upload_dir;
            $upload_dir  = realpath($upload_dir.'/'.$_POST['current_path']).'/';
            if(!strstr($upload_dir, $user_upload_dir)) die('Error! '. $upload_dir);
        }

        if(get_option('__wpdm_sanitize_filename', 0) == 1)
            $filename = sanitize_file_name($filename);

        if(isset($_REQUEST["chunks"])) $this->chunkUploadFile($upload_dir.$filename);
        else {
            $ret = move_uploaded_file($_FILES['attach_file']['tmp_name'], $upload_dir . $filename);
            if(!$ret) debug_print_backtrace();
        }
        echo "|||".str_replace(UPLOAD_DIR, '', $upload_dir).$filename."|||";

        exit;
    }

    function chunkUploadFile($destFilePath){

        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;

        $out = @fopen("{$destFilePath}.part", $chunk == 0 ? "wb" : "ab");
        if ($out) {
            // Read binary input stream and append it to temp file
            $in = @fopen($_FILES['attach_file']['tmp_name'], "rb");

            if ($in) {
                while ($buff = fread($in, 4096))
                    fwrite($out, $buff);
            } else
                die('-3');

            @fclose($in);
            @fclose($out);

            @unlink($_FILES['package_file']['tmp_name']);
        } else
            die('-3');

        if (!$chunks || $chunk == $chunks - 1) {
            // Strip the temp .part suffix off
            rename("{$destFilePath}.part", $destFilePath);
        }
    }

    function packageList($sparams = array()){

        global $current_user;

        if(!is_user_logged_in()) {
            ob_start();
            include  \WPDM\Template::Locate('wpdm-login-form.php');
            return ob_get_clean();
        }

        $msg = get_option('__wpdm_front_end_access_blocked', __('Sorry, Your Are Not Allowed!','wpdmpro'));
        $msg = $msg != ''?$msg:__('Sorry, Your Are Not Allowed!','wpdmpro');

        wp_reset_query();
        $currentAccess = maybe_unserialize(get_option('__wpdm_front_end_access', array()));

        if (!array_intersect($currentAccess, $current_user->roles) && is_user_logged_in())
            return "<div class='w3eden'><div class='alert alert-danger'>" . wpautop(stripslashes($msg)) . "</div></div>";


        ob_start();
        echo "<div class='w3eden'>";
        include wpdm_tpl_path("wpdm-ad-package-list.php");
        echo "</div>";
        return ob_get_clean();
    }

    function packageForm($sparams = array()){
        global $current_user;
        if(!is_user_logged_in()) {
            ob_start();
            include  \WPDM\Template::Locate('wpdm-login-form.php');
            return ob_get_clean();
        }

        $currentAccess = maybe_unserialize(get_option('__wpdm_front_end_access', array()));

        $msg = get_option('__wpdm_front_end_access_blocked', __('Sorry, Your Are Not Allowed!','wpdmpro'));
        $msg = $msg != ''?$msg:__('Sorry, Your Are Not Allowed!','wpdmpro');

        if (!array_intersect($currentAccess, $current_user->roles) && is_user_logged_in())
            return "<div class='w3eden'><div class='alert alert-danger'>" . wpautop(stripslashes($msg)) . "</div></div>";

        $currentAccess = maybe_unserialize(get_option('__wpdm_front_end_access', array()));

        $post = get_post(wpdm_query_var('id'));

        if(wpdm_query_var('id') > 0 && $current_user->ID != $post->post_author && !current_user_can('manage_options'))
            return "<div class='w3eden'><div class='alert alert-danger'>" . wpautop(stripslashes($msg)) . "</div></div>";

        ob_start();
        include wpdm_tpl_path("new-package-form.php");
        return ob_get_clean();
    }

    public static function hasAccess($uid = null){
        global $current_user;
        if(!$uid) $uid = $current_user->ID;
        $currentAccess = maybe_unserialize(get_option('__wpdm_front_end_access', array()));
        return array_intersect($currentAccess, $current_user->roles) && is_user_logged_in()?true:false;
    }

    function updateProfile(){
        if(!is_user_logged_in()) die('Error!');
        update_user_meta(get_current_user_id(), '__wpdm_public_profile', $_POST['__wpdm_public_profile']);
        die('OK');
    }

    function editProfile(){
        ob_start();
        include(wpdm_tpl_path('wpdm-edit-user-profile.php'));
        return ob_get_clean();
    }


    function Settings(){
        ob_start();
        $settings = get_user_meta(get_current_user_id(), '__wpdm_author_settings', true);
        include wpdm_tpl_path("author-settings.php");
        return ob_get_clean();
    }
    function saveSettings(){
        if(!self::hasAccess()) die('Error!');
        if(isset($_POST['__saveas']) && wp_verify_nonce($_POST['__saveas'], NONCE_KEY)){
            update_user_meta(get_current_user_id(), '__wpdm_author_settings', $_POST['__wpdm_author_settings']);
            do_action("wpdm_after_save_author_settings", $_POST['__wpdm_author_settings']);
            die('OK');

        }
        die('Error');
    }



}