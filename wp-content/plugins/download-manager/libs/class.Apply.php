<?php

namespace WPDM\libs;

use WPDM\FileSystem;
use WPDM\Package;

class Apply {

    function __construct(){

        add_filter('wpdm_custom_data', array( $this, 'SR_CheckPackageAccess' ), 10, 2);

        //add_action('save_post', array( $this, 'SavePackage' ));
        add_action('publish_wpdmpro', array( $this, 'customPings' ));

        add_action( 'after_switch_theme', array($this, 'flashRules') );


        $this->adminActions();
        $this->frontendActions();

    }

    function frontendActions(){
        add_action("wp_ajax_nopriv_updatePassword", array($this, 'updatePassword'));
        add_action("wp_ajax_nopriv_resetPassword", array($this, 'resetPassword'));
        add_action("wp_ajax_nopriv_showLockOptions", array($this, 'showLockOptions'));
        add_action("wp_ajax_showLockOptions", array($this, 'showLockOptions'));
        add_action("wp_ajax_wpdm_addtofav", array($this, 'addToFav'));
        add_filter("login_url", array($this, 'loginURL'), 999999, 3);
        add_filter("logout_url", array($this, 'logoutURL'), 999999, 2);
        add_filter("init", array($this, 'loginURLRedirect'));
        add_action('wp', array($this, 'wpdmIframe'));
        add_filter("template_include", array($this, 'interimLogin'), 9999);
        if(is_admin()) return;
        add_action("init", array($this, 'triggerDownload'));
        add_filter('widget_text', 'do_shortcode');
        add_action('query_vars', array( $this, 'DashboardPageVars' ));
        add_action('init', array( $this, 'addWriteRules' ), 999999 );
        add_action('wp', array( $this, 'savePackage' ));
        add_action('init', array($this, 'Login'));
        add_action('init', array($this, 'Register'));
        add_action('wp', array($this, 'updateProfile'));
        //add_action('wp', array($this, 'docStream'));
        add_action('init', array($this, 'Logout'));
        add_action('request', array($this, 'rssFeed'));
        add_filter( 'ajax_query_attachments_args', array($this, 'usersMediaQuery') );
        add_action( 'init', array($this, 'sfbAccess'));
        remove_action('wp_head', 'wp_generator');
        add_action( 'wp_head', array($this, 'addGenerator'), 9);
        add_filter('pre_get_posts', array($this, 'queryTag'));
        add_filter('the_excerpt_embed', array($this, 'oEmbed'));
        add_action('init', array($this, 'checkFilePassword'));
        add_action('registration_errors', array($this, 'verifyEmail'), 10, 3);

    }

    function adminActions(){
        if(!is_admin()) return;
        add_action('save_post', array( $this, 'DashboardPages' ));
        add_action( 'admin_init', array($this, 'sfbAccess'));
        add_action( 'wp_ajax_clear_cache', array($this, 'clearCache'));
        add_action( 'wp_ajax_clear_stats', array($this, 'clearStats'));
        add_action( 'wp_ajax_generate_tdl', array($this, 'generateTDL'));

    }

    function SR_CheckPackageAccess($data, $id){
        global $current_user;
        $skiplocks = maybe_unserialize(get_option('__wpdm_skip_locks', array()));
        if( is_user_logged_in() ){
            foreach($skiplocks as $lock){
                unset($data[$lock."_lock"]); // = 0;
            }
        }

        return $data;
    }

    function docStream(){
        if(strstr($_SERVER['REQUEST_URI'], 'wpdm-doc-preview')){
            preg_match("/wpdm\-doc\-preview\/([0-9]+)/", $_SERVER['REQUEST_URI'], $mat );
            $file_id = $mat[1];
            $files = Package::getFiles($file_id);
            if(count($files) ==0) die('No file found!');
            $sfile = '';
            foreach($files as $i=>$sfile){
                $ifile = $sfile;
                $sfile = explode(".", $sfile);
                $fext = end($sfile);
                if(in_array(end($sfile),array('pdf','doc','docx','xls','xlsx','ppt','pptx'))) { $sfile = $ifile; break; }
            }
            if($sfile =='') die('No supported document found!');
            if(file_exists(UPLOAD_DIR.$sfile)) $sfile =  UPLOAD_DIR.$sfile;
            if(!file_exists($sfile)) die('No supported document found!');
             
            if(strstr($sfile, '://')) header("location: {$sfile}");
            else
            FileSystem::donwloadFile($sfile, basename($sfile));
            die();
        }
    }

    function addWriteRules(){
        global $wp_rewrite;
        $udb_page_id = get_option('__wpdm_user_dashboard', 0);
        if($udb_page_id) {
            $page_name = get_post_field("post_name", $udb_page_id);
            add_rewrite_rule('^' . $page_name . '/(.+)/?', 'index.php?page_id=' . $udb_page_id . '&udb_page=$matches[1]', 'top');
            //dd($wp_rewrite);
        }
        $adb_page_id = get_option('__wpdm_author_dashboard', 0);

        if($adb_page_id) {
            $page_name = get_post_field("post_name", $adb_page_id);
            add_rewrite_rule('^' . $page_name . '/(.+)/?', 'index.php?page_id=' . $adb_page_id . '&adb_page=$matches[1]', 'top');
        }

        $ap_page_id = get_option('__wpdm_author_profile', 0);

        if($ap_page_id) {
            $page_name = get_post_field("post_name", $ap_page_id);
            add_rewrite_rule('^' . $page_name . '/(.+)/?', 'index.php?page_id=' . $ap_page_id . '&profile=$matches[1]', 'top');
        }

        //add_rewrite_rule('^wpdmdl/([0-9]+)/?', 'index.php?wpdmdl=$matches[1]', 'top');
        //add_rewrite_rule('^wpdmdl/([0-9]+)/ind/([^\/]+)/?', 'index.php?wpdmdl=$matches[1]&ind=$matches[2]', 'top');
        //if(is_404()) dd('404');
        //$wp_rewrite->flush_rules();
        //dd($wp_rewrite);
    }

    function flashRules(){
        $this->addWriteRules();
        global $wp_rewrite;
        $wp_rewrite->flush_rules();
    }

    function DashboardPages($post_id){
        if ( wp_is_post_revision( $post_id ) )  return;
        $page_id = get_option('__wpdm_user_dashboard', 0);
        $post = get_post($post_id);
        $flush = 0;
        if((int)$page_id > 0 && has_shortcode($post->post_content, "wpdm_user_dashboard")) {
            update_option('__wpdm_user_dashboard', $post_id);
            $flush = 1;
        }

        if(has_shortcode($post->post_content, "wpdm_package_form")) {
            update_option('__wpdm_package_form', $post_id);
        }

        $page_id = get_option('__wpdm_author_dashboard', 0);
        $post = get_post($post_id);

        if((int)$page_id > 0 && has_shortcode($post->post_content, "wpdm_frontend")) {
            update_option('__wpdm_author_dashboard', $post_id);
            $flush = 1;
        }

        $page_id = get_option('__wpdm_author_profile', 0);
        $post = get_post($post_id);

        if((int)$page_id > 0 && has_shortcode($post->post_content, "wpdm_user_profile")) {
            update_option('__wpdm_author_profile', $post_id);
            $flush = 1;
        }

        if($flush == 1) {
            $this->addWriteRules();
            global $wp_rewrite;
            $wp_rewrite->flush_rules();
        }

    }

    function DashboardPageVars( $vars ){
        array_push($vars, 'udb_page', 'adb_page','page_id', 'wpdmdl', 'ind', 'profile');
        return $vars;
    }

    /**
     * @usage Save Package Data
     */

    function savePackage()
    {
        global  $current_user, $wpdb;

        if(!is_user_logged_in()) return;
        $allowed_roles = get_option('__wpdm_front_end_access');
        $allowed_roles = maybe_unserialize($allowed_roles);
        $allowed_roles = is_array($allowed_roles)?$allowed_roles:array();
        $allowed =  array_intersect($allowed_roles, $current_user->roles);
        if (isset($_REQUEST['act']) && in_array($_REQUEST['act'], array('_ap_wpdm', '_ep_wpdm')) && count($allowed) > 0) {

            $pack = $_POST['pack'];
            $pack['post_type'] = 'wpdmpro';

            if ($_POST['act'] == '_ep_wpdm') {

                $p = get_post($_POST['id']);
                if($current_user->ID != $p->post_author && !current_user_can('manage_options')) return;

                $hook = "edit_package_frontend";
                $pack['ID'] = (int)$_POST['id'];
                unset($pack['post_status']);
                unset($pack['post_author']);
                $post = get_post($pack['ID']);

                $ostatus = $post->post_status=='publish'?'publish':get_option('__wpdm_ips_frontend','publish');
                $status = isset($_POST['status']) && $_POST['status'] == 'draft'?'draft': $ostatus;
                $pack['post_status'] = $status;
                $id = wp_update_post($pack);
                if(isset($_POST['cats']))
                    $ret = wp_set_post_terms($pack['ID'], $_POST['cats'], 'wpdmcategory' );

            }
            if ($_POST['act'] == '_ap_wpdm'){
                $hook = "create_package_frontend";
                $status = isset($_POST['status']) && $_POST['status'] == 'draft'?'draft': get_option('__wpdm_ips_frontend','publish');
                $pack['post_status'] = $status;
                $pack['post_author'] = $current_user->ID;
                $id = wp_insert_post($pack);
                if(isset($_POST['cats']))
                    wp_set_post_terms( $id, $_POST['cats'], 'wpdmcategory' );
            }

            // Save Package Meta
            $cdata = get_post_custom($id);
            foreach ($cdata as $k => $v) {
                $tk = str_replace("__wpdm_", "", $k);
                if (!isset($_POST['file'][$tk]) && $tk != $k)
                    delete_post_meta($id, $k);

            }

            if(isset($_POST['file']['preview'])){
                $preview = $_POST['file']['preview'];
                $attachment_id = $wpdb->get_var($wpdb->prepare("SELECT ID FROM {$wpdb->posts} WHERE guid='%s';", $preview ));
                set_post_thumbnail($id, $attachment_id);
                unset($_POST['file']['preview']);
            } else {
                delete_post_thumbnail($id);
            }

            foreach ($_POST['file'] as $meta_key => $meta_value) {
                if($meta_key == 'package_size' && doubleval($meta_value) == 0) $meta_value = "";
                $key_name = "__wpdm_" . $meta_key;
                update_post_meta($id, $key_name, $meta_value);
            }

            update_post_meta($id, '__wpdm_masterkey', uniqid());

            if (isset($_POST['reset_key']) && $_POST['reset_key'] == 1)
                update_post_meta($id, '__wpdm_masterkey', uniqid());

            if(get_option('__wpdm_disable_new_package_email') == 0)
            \WPDM\Email::send("new-package-frontend", array( 'package_name' => $pack['post_title'], 'name' => $current_user->user_nicename, 'author' => "<a href='".admin_url('user-edit.php?user_id='.$current_user->ID)."'>{$current_user->user_nicename}</a>", 'edit_url' => admin_url('post.php?action=edit&post='.$id)));

            do_action($hook, $id, get_post($id));

            $data = array('result' => $_POST['act'], 'id' => $id);

            header('Content-type: application/json');
            echo json_encode($data);
            die();


        }
    }

    function Login()
    {

        global $wp_query, $post, $wpdb;
        if (!isset($_POST['wpdm_login'])) return;
        $_SESSION['login_try'] = isset( $_SESSION['login_try'])?$_SESSION['login_try'] + 1:1;
        if($_SESSION['login_try'] > 30) wp_die("Slow Down!");

        if(isset($_SESSION['login_error'])) unset($_SESSION['login_error']);
        $creds = array();
        $creds['user_login'] = $_POST['wpdm_login']['log'];
        $creds['user_password'] = $_POST['wpdm_login']['pwd'];
        $creds['remember'] = isset($_POST['rememberme']) ? $_POST['rememberme'] : false;
        $user = wp_signon($creds, false);
        if (is_wp_error($user)) {
            $_SESSION['login_error'] = $user->get_error_message();

            if(wpdm_is_ajax()) die('failed');

            header("location: " . $_SERVER['HTTP_REFERER']);
            die();
        } else {
            wp_set_auth_cookie($user->ID);
            $_SESSION['login_try'] = 0;
            do_action('wp_login', $creds['user_login'], $user);
            if(wpdm_is_ajax()) die('success');

            header("location: " . $_POST['redirect_to']);
            die();
        }
    }

    /**
     * @usage Logout an user
     */

    function Logout()
    {

        if (wp_verify_nonce(wpdm_query_var('logout'), NONCE_KEY)) {
            wp_logout();
            header("location: " . wpdm_login_url());
            die();
        }
    }

    /**
     * @usage Register an user
     */
    function Register()
    {
        global $wp_query, $wpdb;
        if (!isset($_POST['wpdm_reg'])) return;

        $shortcode_params = \WPDM_Crypt::Decrypt($_REQUEST['phash']);

        if(!isset($shortcode_params['captcha']) || $shortcode_params['captcha'] == 'true') {
            if(isset($_REQUEST['g-recaptcha-response'])) {
                $p = array('secret' => get_option('_wpdm_recaptcha_secret_key'), 'response' => $_REQUEST['g-recaptcha-response']);
                $recap = remote_post('https://www.google.com/recaptcha/api/siteverify', $p);
                $recap = json_decode($recap);
            } else {
                $recap = new \stdClass();
                $recap->success = false;
            }
            if ($recap->success == false) {
                $_SESSION['reg_error'] = __('Captcha Verification Failed!', 'wpdmpro');
                if (wpdm_is_ajax()) die('Error: ' . $_SESSION['reg_error']);
                header("location: " . $_POST['permalink']);
                die();
            }
        }

        if(!get_option('users_can_register') && isset($_POST['wpdm_reg'])){
            if(wpdm_is_ajax()) die(__('Error: User registration is disabled!','wpdmpro'));
            else $_SESSION['reg_error'] = __('Error: User registration is disabled!','wpdmpro');
            header("location: " . $_POST['permalink']);
            die();
        }

        extract($_POST['wpdm_reg']);
        $_SESSION['tmp_reg_info'] = $_POST['wpdm_reg'];
        $user_id = username_exists($user_login);
        $loginurl = $_POST['permalink'];
        if ($user_login == '') {
            $_SESSION['reg_error'] = __('Username is Empty!','wpdmpro');

            if(wpdm_is_ajax()) die('Error: '.$_SESSION['reg_error']);


            header("location: " . $_POST['permalink']);
            die();
        }
        if (!isset($user_email) || !is_email($user_email)) {
            $_SESSION['reg_error'] = __('Invalid Email Address!','wpdmpro');

            if(wpdm_is_ajax()) die($_SESSION['reg_error']);

            header("location: " . $_POST['permalink']);
            die();
        }

        if (!$user_id) {
            $user_id = email_exists($user_email);
            if (!$user_id) {
                
                $auto_login = 0;
                if(isset($shortcode_params['autologin']) && $shortcode_params['autologin'] == 'true')
                $auto_login = 1;

                $user_pass = (isset($shortcode_params['verifyemail']) && $shortcode_params['verifyemail'] == 'true')?wp_generate_password(12, false):$user_pass;

                $errors = new \WP_Error();

                do_action( 'register_post', $user_login, $user_email, $errors );

                $errors = apply_filters( 'registration_errors', $errors, $user_login, $user_email );

                if ( $errors->get_error_code() ) {
                    if(wpdm_is_ajax()) die('Error: ' . $errors->get_error_message() );
                    else $_SESSION['reg_error'] = $errors->get_error_message();
                    header("location: " . $_POST['permalink']);
                    die();
                }

                $user_id = wp_create_user($user_login, $user_pass, $user_email);
                $name = explode(" ", $display_name);
                if(!isset($name[1])) $name[1] = '';
                wp_update_user(array('ID' => $user_id, 'display_name' => $display_name, 'first_name' => $name[0], 'last_name' => $name[1]));
                $display_name = isset($display_name)?$display_name:$user_id;

                \WPDM\Email::send("user-signup", array('to_email' => $user_email, 'name' => $display_name, 'username' => $user_login, 'password' => $user_pass));

                unset($_SESSION['guest_order']);
                unset($_SESSION['login_error']);
                unset($_SESSION['tmp_reg_info']);
                //if(!isset($_SESSION['reg_warning']))
                $creds['user_login'] = $user_login;
                $creds['user_password'] = $user_pass;
                $creds['remember'] = true;
                $_SESSION['sccs_msg'] = "Your account has been created successfully and login info sent to your mail address.";
                if($auto_login==1) {
                    $_SESSION['sccs_msg'] = "Your account has been created successfully";
                    wp_signon($creds);
                    wp_set_current_user($user_id);
                    wp_set_auth_cookie($user_id);

                }

                if(wpdm_is_ajax()) die('success');

                header("location: " . $loginurl);
                die();
            } else {
                $_SESSION['reg_error'] = __('Email already exists.');
                $plink = $_POST['permalink'] ? $_POST['permalink'] : $_SERVER['HTTP_REFERER'];

                if(wpdm_is_ajax()) die('Error: '.$_SESSION['reg_error']);

                header("location: " . $loginurl);
                die();
            }
        } else {
            $_SESSION['reg_error'] = __('User already exists.');
            $plink = $_POST['permalink'] ? $_POST['permalink'] : $_SERVER['HTTP_REFERER'];

            if(wpdm_is_ajax()) die('Error: '.$_SESSION['reg_error']);

            header("location: " . $loginurl);
            die();
        }
        die();
    }

    function updateProfile()
    {
        global $current_user;

        if (isset($_POST['wpdm_profile']) && is_user_logged_in()) {

            $error = 0;

            $pfile_data['display_name'] = $_POST['wpdm_profile']['display_name'];
            $pfile_data['description'] = $_POST['wpdm_profile']['description'];


            if ($_POST['password'] != $_POST['cpassword']) {
                $_SESSION['member_error'][] = 'Password not matched';
                $error = 1;
            }
            if (!$error) {
                $pfile_data['ID'] = $current_user->ID;
                if ($_POST['password'] != '')
                    $pfile_data['user_pass'] = $_POST['password'];

                wp_update_user($pfile_data);

                update_user_meta($current_user->ID, 'payment_account', $_POST['payment_account']);
                $_SESSION['member_success'] = 'Profile data updated successfully.';
            }

            do_action("wpdm_update_profile");

            if(wpdm_is_ajax()){
                if($error == 1){
                    $msg['type'] = 'danger';
                    $msg['msg'] = $_SESSION['member_error'];
                    unset($_SESSION['member_error']);
                    echo json_encode($msg);
                    die();
                } else {
                    $msg['type'] = 'success';
                    $msg['msg'] = $_SESSION['member_success'];
                    unset($_SESSION['member_success']);
                    echo json_encode($msg);
                    die();
                }
            }
            header("location: " . $_SERVER['HTTP_REFERER']);
            die();
        }
    }


    /**
     * @usage Process Download Request from lock options
     */
    function triggerDownload()
    {

        global $wpdb, $current_user, $wp_query;
        if(preg_match("/\/wpdmdl\//", $_SERVER['REQUEST_URI'])){
            $uri = trim($_SERVER['REQUEST_URI'], '/');
            $uri = explode("/", $uri);
            $_GET['wpdmdl'] = (int)end($uri);
            $wp_query->query_vars['wpdmdl'] = (int)end($uri);
        }
        if (!isset($wp_query->query_vars['wpdmdl']) && !isset($_GET['wpdmdl'])) return;
        $id = isset($_GET['wpdmdl']) ? (int)$_GET['wpdmdl'] : (int)$wp_query->query_vars['wpdmdl'];
        if ($id <= 0) return;
        $key = array_key_exists('_wpdmkey', $_GET) ? $_GET['_wpdmkey'] : '';
        $key = $key == '' && array_key_exists('_wpdmkey', $wp_query->query_vars) ? $wp_query->query_vars['_wpdmkey'] : $key;
        $key = preg_replace("/[^_a-z|A-Z|0-9]/i", "", $key);
        $key = "__wpdmkey_".$key;
        $package = get_post($id, ARRAY_A);

        $package = array_merge($package, wpdm_custom_data($package['ID']));
        if (isset($package['files']))
            $package['files'] = maybe_unserialize($package['files']);
        else
            $package['files'] = array();
        //$package = wpdm_setup_package_data($package);

        $package['access'] = wpdm_allowed_roles($id);

        if (is_array($package)) {
            $role = @array_shift(@array_keys($current_user->caps));
            $cpackage = apply_filters('before_download', $package);
            $lock = '';
            $package = $cpackage ? $cpackage : $package;
            if (isset($package['email_lock']) && $package['email_lock'] == 1) $lock = 'locked';
            if (isset($package['password_lock']) && $package['password_lock'] == 1) $lock = 'locked';
            if (isset($package['gplusone_lock']) && $package['gplusone_lock'] == 1) $lock = 'locked';
            if (isset($package['twitterfollow_lock']) && $package['twitterfollow_lock'] == 1) $lock = 'locked';
            if (isset($package['facebooklike_lock']) && $package['facebooklike_lock'] == 1) $lock = 'locked';
            if (isset($package['tweet_lock']) && $package['tweet_lock'] == 1) $lock = 'locked';
            if (isset($package['captcha_lock']) && $package['captcha_lock'] == 1) $lock = 'locked';

            if ($lock !== 'locked')
                $lock = apply_filters('wpdm_check_lock', $lock, $id);

            if (isset($_GET['masterkey']) && esc_attr($_GET['masterkey']) == $package['masterkey']) {
                $lock = 0;
            }


            $xlimit = $key != '' ? get_post_meta($package['ID'], $key, true) : '';
            $xlimit = maybe_unserialize($xlimit);
            $limit = !is_array($xlimit)?$xlimit:$xlimit['use'];


            if ($limit <= 0 && $key != '') delete_post_meta($package['ID'], $key);
            else if ($key != '') {
                $limit --;
                if(is_array($xlimit)) $xlimit['use'] = $limit;
                else $xlimit = $limit;
                if(is_array($xlimit) && $xlimit['expire'] < time()){
                    $xlimit['use'] = $limit = 0;
                }
                update_post_meta($package['ID'], $key, $xlimit);
            }

            $matched = (is_array(@maybe_unserialize($package['access'])) && is_user_logged_in())?array_intersect($current_user->roles, @maybe_unserialize($package['access'])):array();

            /**
             * It is custom generated temporary download link when $xlimit is an array, $xlimit = integer when it is generated from lock option
             * custom generated download link precedes over user role selection in allow access, anyone have a valid custom generated download link is allowed to download
             **/
            if (!is_array($xlimit) && (($id != '' && is_user_logged_in() && count($matched) < 1 && !@in_array('guest', $package['access'])) || (!is_user_logged_in() && !@in_array('guest', $package['access']) && $id != ''))) {
                do_action("wpdm_download_permission_denied", $id);
                wpdm_download_data("permission-denied.txt", __("You don't have permission to download this file", 'wpdmpro'));
                die();
            } else {

                if ($lock === 'locked' && $limit <= 0) {
                    do_action("wpdm_invalid_download_link", $id, $key);
                    if ($key != '')
                        wpdm_download_data("link-expired.txt", __("Download link is expired. Please get new download link.", 'wpdmpro'));
                    else
                        wpdm_download_data("invalid-link.txt", __("Download link is expired or not valid. Please get new download link.", 'wpdmpro'));
                    die();
                } else
                    if ($package['ID'] > 0) {
                        if((int)$package['quota'] == 0 || $package['quota'] > $package['download_count'])
                            include(WPDM_BASE_DIR . "wpdm-start-download.php");
                        else
                            wpdm_download_data("stock-limit-reached.txt", __("Stock Limit Reached", 'wpdmpro'));

                    }

            }
        } else
            wpdm_notice(__("Invalid download link.", 'wpdmpro'));
    }


    /**
     * @usage Add with main RSS feed
     * @param $query
     * @return mixed
     */
    function rssFeed($query) {
        if ( isset($query['feed'])  && !isset($query['post_type']) &&  get_option('__wpdm_rss_feed_main', 0) == 1 ){
            $query['post_type'] = array('post','wpdmpro');
        }
        return $query;
    }

    /**
     * @usage Schedule custom ping
     * @param $post_id
     */
    function customPings($post_id){
        wp_schedule_single_event(time()+5000, 'do_pings', array($post_id));
    }

    /**
     * @usage Allow access to server file browser for selected user roles
     */
    function sfbAccess(){

        global $wp_roles;
        if(!is_array($wp_roles->roles)) return;
        $roleids = array_keys($wp_roles->roles);
        $roles = get_option('_wpdm_file_browser_access',array('administrator'));
        $naroles = array_diff($roleids, $roles);
        foreach($roles as $role) {
            $role = get_role($role);
            if(is_object($role) && !is_wp_error($role))
                $role->add_cap('access_server_browser');
        }

        foreach($naroles as $role) {
            $role = get_role($role);
            if(is_object($role) && !is_wp_error($role))
                $role->remove_cap('access_server_browser');
        }

    }

    /**
     * @usage Validate individual file password
     */
    function checkFilePassword(){
        if (isset($_POST['actioninddlpvr'], $_POST['wpdmfileid']) && $_POST['actioninddlpvr'] != '') {

            $fileid = intval($_POST['wpdmfileid']);
            $data = get_post_meta($_POST['wpdmfileid'], '__wpdm_fileinfo', true);
            $data = $data ? $data : array();
            $package = get_post($fileid);
            $packagemeta = wpdm_custom_data($fileid);
            $password = isset($data[$_POST['wpdmfile']]['password']) && $data[$_POST['wpdmfile']]['password'] != "" ? $data[$_POST['wpdmfile']]['password'] : $packagemeta['password'];
            $pu = isset($packagemeta['password_usage']) && is_array($packagemeta['password_usage'])?$packagemeta['password_usage']:array();
            if ($password == $_POST['filepass'] || strpos($password, "[" . $_POST['filepass'] . "]") !== FALSE) {
                $pul = $packagemeta['password_usage_limit'];
                if (is_array($pu) && isset($pu[$password]) && $pu[$password] >= $pul && $pul > 0) {
                    $data['error'] = __('Password usages limit exceeded', 'wpdmpro');
                    die('|error|');
                }
                else {
                    if(!is_array($pu)) $pu = array();
                    $pu[$password] = isset($pu[$password])?$pu[$password]+1:1;
                    update_post_meta($fileid, '__wpdm_password_usage', $pu);
                }

                $id = uniqid();
                $_SESSION['_wpdm_unlocked_'.$_POST['wpdmfileid']] = 1;
                update_post_meta($fileid, "__wpdmkey_".$id, 8);

                die("|ok|$id|");
            } else
                die('|error|');
        }
    }

    /**
     * @usage Allow front-end users to access their own files only
     * @param $query_params
     * @return string
     */
    function usersMediaQuery( $query_params ){
        global $current_user;

        if(current_user_can('edit_posts')) return $query_params;

        if( is_user_logged_in() ){
            $query_params['author'] = $current_user->ID;
        }
        return $query_params;
    }

    /**
     * @usage Add packages wth tag query
     * @param $query
     * @return mixed
     */
    function queryTag($query)
    {

        if (is_tag() && $query->is_main_query()) {
            $post_type = get_query_var('post_type');
            if (!is_array($post_type))
                $post_type = array('post', 'wpdmpro', 'nav_menu_item');
            else
                $post_type = array_merge($post_type, array('post', 'wpdmpro', 'nav_menu_item'));
            $query->set('post_type', $post_type);
        }
        return $query;
    }

    function clearCache(){
        if(!current_user_can('manage_options')) return;
        \WPDM\FileSystem::deleteFiles(WPDM_CACHE_DIR, false);
        \WPDM\FileSystem::deleteFiles(WPDM_CACHE_DIR.'pdfthumbs/', false);
        die('ok');
    }

    function clearStats(){
        if(!current_user_can('manage_options')) return;
        global $wpdb;
        $wpdb->query('truncate table '.$wpdb->prefix.'ahm_download_stats');
        die('ok');
    }


    /**
     * @usage Add generator tag
     */
    function addGenerator(){
        echo '<meta name="generator" content="WordPress Download Manager '.WPDM_Version.'" />'."\r\n";
    }

    function oEmbed($content){
        if(get_post_type(get_the_ID()) != 'wpdmpro') return $content;
        if(function_exists('wpdmpp_effective_price') && wpdmpp_effective_price(get_the_ID()) > 0)
        $template = '<table class="table table-bordered"><tbody><tr><td colspan="2">[excerpt_200]</td></tr><tr><td>Price</td><td>[currency][effective_price]</td></tr><tr><td>Version</td><td>[version]</td></tr><tr><td>Total Files</td><td>[file_count]</td></tr><tr><td>File Size</td><td>[file_size]</td></tr><tr><td>Create Date</td><td>[create_date]</td></tr><tr><td>Last Updated</td><td>[update_date]</td><tr><td colspan="2" style="text-align: right;border-bottom: 0"><a class="wpdmdlbtn" href="[page_url]" target="_parent">&#x1F4B3; &nbsp; Buy Now</a></td></tr></tbody></table><br/><style> .wpdmdlbtn {-moz-box-shadow:inset 0px 1px 0px 0px #9acc85;-webkit-box-shadow:inset 0px 1px 0px 0px #9acc85;box-shadow:inset 0px 1px 0px 0px #9acc85;background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #74ad5a), color-stop(1, #68a54b));background:-moz-linear-gradient(top, #74ad5a 5%, #68a54b 100%);background:-webkit-linear-gradient(top, #74ad5a 5%, #68a54b 100%);background:-o-linear-gradient(top, #74ad5a 5%, #68a54b 100%);background:-ms-linear-gradient(top, #74ad5a 5%, #68a54b 100%);background:linear-gradient(to bottom, #74ad5a 5%, #68a54b 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=\'#74ad5a\', endColorstr=\'#68a54b\',GradientType=0);background-color:#74ad5a;-moz-border-radius:3px;-webkit-border-radius:3px;border-radius:3px;border:1px solid #3b6e22;display:inline-block;cursor:pointer;color:#ffffff !important; font-size:12px;font-weight:bold;padding:10px 20px;text-transform: uppercase;text-decoration:none !important;}.wpdmdlbtn:hover {background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #68a54b), color-stop(1, #74ad5a));background:-moz-linear-gradient(top, #68a54b 5%, #74ad5a 100%);background:-webkit-linear-gradient(top, #68a54b 5%, #74ad5a 100%);background:-o-linear-gradient(top, #68a54b 5%, #74ad5a 100%);background:-ms-linear-gradient(top, #68a54b 5%, #74ad5a 100%);background:linear-gradient(to bottom, #68a54b 5%, #74ad5a 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=\'#68a54b\', endColorstr=\'#74ad5a\',GradientType=0);background-color:#68a54b;}.wpdmdlbtn:active {position:relative;top:1px;} .table{width:100%;border: 1px solid #eeeeee;} .table td{ padding:10px;border-bottom:1px solid #eee;}</style>'; else $template = '<table class="table table-bordered"><tbody><tr><td colspan="2">[excerpt_200]</td></tr><tr><td>Version</td><td>[version]</td></tr><tr><td>Total Files</td><td>[file_count]</td></tr><tr><td>File Size</td><td>[file_size]</td></tr><tr><td>Create Date</td><td>[create_date]</td></tr><tr><td>Last Updated</td><td>[update_date]</td><tr><td colspan="2" style="text-align: right;border-bottom: 0"><a class="wpdmdlbtn" href="[page_url]" target="_parent">&#x2b07; &nbsp; Download</a></td></tr></tbody></table><br/><style> .wpdmdlbtn {-moz-box-shadow:inset 0px 1px 0px 0px #9acc85;-webkit-box-shadow:inset 0px 1px 0px 0px #9acc85;box-shadow:inset 0px 1px 0px 0px #9acc85;background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #74ad5a), color-stop(1, #68a54b));background:-moz-linear-gradient(top, #74ad5a 5%, #68a54b 100%);background:-webkit-linear-gradient(top, #74ad5a 5%, #68a54b 100%);background:-o-linear-gradient(top, #74ad5a 5%, #68a54b 100%);background:-ms-linear-gradient(top, #74ad5a 5%, #68a54b 100%);background:linear-gradient(to bottom, #74ad5a 5%, #68a54b 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=\'#74ad5a\', endColorstr=\'#68a54b\',GradientType=0);background-color:#74ad5a;-moz-border-radius:3px;-webkit-border-radius:3px;border-radius:3px;border:1px solid #3b6e22;display:inline-block;cursor:pointer;color:#ffffff !important; font-size:12px;font-weight:bold;padding:10px 20px;text-transform: uppercase;text-decoration:none !important;}.wpdmdlbtn:hover {background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #68a54b), color-stop(1, #74ad5a));background:-moz-linear-gradient(top, #68a54b 5%, #74ad5a 100%);background:-webkit-linear-gradient(top, #68a54b 5%, #74ad5a 100%);background:-o-linear-gradient(top, #68a54b 5%, #74ad5a 100%);background:-ms-linear-gradient(top, #68a54b 5%, #74ad5a 100%);background:linear-gradient(to bottom, #68a54b 5%, #74ad5a 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=\'#68a54b\', endColorstr=\'#74ad5a\',GradientType=0);background-color:#68a54b;}.wpdmdlbtn:active {position:relative;top:1px;} .table{width:100%; border: 1px solid #eeeeee; } .table td{ padding:10px;border-bottom:1px solid #eee;}</style>';
        return \WPDM\Package::fetchTemplate($template, get_the_ID());
    }

    function showLockOptions(){
        if(!isset($_REQUEST['id'])) die('ID Missing!');
        echo \WPDM\Package::downloadLink((int)$_REQUEST['id'], 1);
        die();
    }

    function addToFav(){
        if(!is_user_logged_in()) die('error');
        $myfavs = maybe_unserialize(get_user_meta(get_current_user_id(), '__wpdm_favs', true));
        if(is_array($myfavs) && ($key = array_search($_REQUEST['pid'], $myfavs)) !== false) unset($myfavs[$key]);
        else $myfavs[] = $_REQUEST['pid'];
        update_user_meta(get_current_user_id(), '__wpdm_favs', $myfavs);
        die('ok');
    }


    function loginURL($login_url, $redirect, $force_reauth){
        $id = get_option('__wpdm_login_url', 0);
        if($id > 0) {
            $page = get_post($id);
            if($page->post_status == 'publish') {
                $url = get_permalink($id);
                if ($redirect != '')
                    $url = add_query_arg(array('redirect_to' => $redirect), $url);
            }
            else $url = $login_url;
        }
        else $url = $login_url;
        return $url;
    }

    function logoutURL($logout_url, $redirect){
        $logout_url = wpdm_logout_url($redirect);
        return $logout_url;
    }

    function loginURLRedirect(){
        if ( isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' && strstr($_SERVER['REQUEST_URI'], 'wp-login.php') && !wpdm_query_var('skipwpdm')) {
            $id = get_option('__wpdm_login_url', 0);
            if($id > 0) {$page = get_post($id);
                if($page->post_status == 'publish') {
                    if (is_user_logged_in()) {
                        wp_redirect(wpdm_user_dashboard_url());
                    } else {
                        wp_redirect(add_query_arg($_GET, wpdm_login_url()));
                    }
                    die();
                }
            }
        }
    }

    function resetPassword(){
        if(wpdm_query_var('__reset_pass')){

            if ( empty( $_POST['user_login'] ) ) {
                die('error');
            } elseif ( strpos( $_POST['user_login'], '@' ) ) {
                $user_data = get_user_by( 'email', trim( wp_unslash( $_POST['user_login'] ) ) );
                if ( empty( $user_data ) )
                    die('error');
            } else {
                $login = trim($_POST['user_login']);
                $user_data = get_user_by('login', $login);
            }
            if(isset($_SESSION['__reset_time']) && time() - $_SESSION['__reset_time'] < 60){
                echo "toosoon";
                exit;
            }
            if(!is_object($user_data) || !isset($user_data->user_login)) die('error');
            $user_login = $user_data->user_login;
            $user_email = $user_data->user_email;
            $key = get_password_reset_key( $user_data );

            $message = __('Someone has requested a password reset for the following account:') . "<br/><br/>";
            $message .= network_home_url( '/' ) . "<br/>";
            $message .= sprintf(__('Username: %s'), $user_login) . "<br/>";
            $message .= __('If this was a mistake, just ignore this email and nothing will happen.') . "<br/><br/>";
            $message .= __('To reset your password, click following button') . "<br/><br/>";
            //$message .= '<' . network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . ">\r\n";

            if ( is_multisite() ) {
                $blogname = get_network()->site_name;
            } else {
                $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
            }

            $title = sprintf( __('[%s] Password Reset'), $blogname );

            $title = apply_filters( 'retrieve_password_title', $title, $user_login, $user_data );

            $message = apply_filters( 'retrieve_password_message', $message, $key, $user_login, $user_data );

            $keys = array("[#tag_line#]", "[#message#]", "[#action_url#]", "[#action_name#]");
            $vals = array("Password Reset Request", $message, home_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login)), "Reset Password");
            $reseturl = add_query_arg(array('action' => 'rp', 'key' => $key, 'login' => rawurlencode($user_login)), wpdm_login_url());
            $message .= "<br/><a href='{$reseturl}'>".__('Reset Password', 'wpdmpro')."</a> ";
            $params = array('subject' => __('Password Reset Request', 'wpdmpro'), 'to_email' => $user_email, 'message' => $message);

            \WPDM\Email::send('default', $params);
            $_SESSION['__reset_time'] = time();
            echo 'ok';
            exit;

        }
    }

    function updatePassword(){
        if(wpdm_query_var('__update_pass')){

            if(wp_verify_nonce(wpdm_query_var('__update_pass'), NONCE_KEY)){
                $pass = wpdm_query_var('password');
                if($pass == '') die('error');
                $user = $_SESSION['__up_user'];
                wp_set_current_user( $user->ID, $user->user_login );
                wp_set_auth_cookie( $user->ID );
                do_action( 'wp_login', $user->user_login );
                wp_set_password( $pass, $user->ID );
                print_r($user);
                die('ok');
            }
            else
                die('error');

        }
    }

    function interimLogin($template){
        if(isset($_REQUEST['interim-login']) && !isset($_POST['wpdm_login'])){
            $template = WPDM_BASE_DIR.'tpls/clean.php';
        }
        return $template;
    }


    function verifyEmail($errors, $sanitized_user_login, $user_email){
        if(!wpdm_verify_email($user_email))
            $errors->add( 'blocked_email', __( 'The email address is blocked.', 'wpdmpro' ) );
        return $errors;
    }

    function generateTDL(){
        if(current_user_can(WPDM_ADMIN_CAP) && wp_verify_nonce($_REQUEST['__tdlnonce'], NONCE_KEY)){
            $pid = (int)$_REQUEST['pid'];
            $_SESSION['_wpdm_unlocked_'.$pid] = 1;
            $key = uniqid();
            $expire = time() + ((int)$_REQUEST['exmisd']*60);
            update_post_meta($pid, "__wpdmkey_".$key, array('use' => (int)$_REQUEST['ulimit'], 'expire' => $expire));
            $download_url = wpdm_download_url($pid, "_wpdmkey={$key}");
            echo $download_url;
            die();
        }
        die('Error! Unauthorized Access');
    }

    function wpdmIframe(){
        if(isset($_REQUEST['__wpdmlo'])){
            include wpdm_tpl_path("lock-options-iframe.php");
            die();
        }
    }



}
