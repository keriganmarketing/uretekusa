<?php

namespace WPDM\admin;

use WPDM\Email;

class WordPressDownloadManagerAdmin {

    function __construct() {
        new \WPDM\admin\menus\Welcome();
        new \WPDM\admin\menus\Packages();
        new \WPDM\admin\menus\Categories();
        new \WPDM\admin\menus\BulkImport();
        new \WPDM\admin\menus\Templates();
        new \WPDM\admin\menus\Subscribers();
        new \WPDM\admin\menus\Addons();
        new \WPDM\admin\menus\Stats();
        new \WPDM\admin\menus\Settings();
        new \WPDM\libs\DashboardWidgets();

        $this->Actions();
    }

    function Actions() {
        add_action('admin_enqueue_scripts', array($this, 'enqueueScripts'),999999999);
        add_action('admin_init', array($this, 'metaBoxes'), 0);
        add_action('admin_init', array(new \WPDM\Email(), 'preview'));
        add_action('admin_head', array($this, 'adminHead'));

        add_action('wp_ajax_updatenow', array($this, 'updateNow'));

        add_action('wp_ajax_wpdm_email_package_link', array($this, 'emailPackageLink'));

        add_action('wp_ajax_updateaddon', array($this, 'updateAddon'));
        add_action('wp_ajax_installaddon', array($this, 'installAddon'));
 
    }

    /**
     * Enqueue admin scripts & styles
     */
    function enqueueScripts() {

        if (wpdm_query_var('post_type') == 'wpdmpro' || get_post_type() == 'wpdmpro' || in_array(wpdm_query_var('page'), array('', 'settings', 'emails', 'wpdm-stats', 'templates', 'importable-files', 'wpdm-addons', 'orders', 'pp-license'))) {
            //dd("OK");
            wp_enqueue_script('jquery');
            wp_enqueue_script('jquery-form');
            wp_enqueue_script('jquery-ui-core');
            //wp_enqueue_script('jquery-ui-dialog');
            wp_enqueue_script('jquery-ui-tabs');
            wp_enqueue_script('jquery-ui-datepicker');
            wp_enqueue_script('jquery-ui-slider');
            wp_enqueue_script('jquery-ui-sortable');
            wp_enqueue_script('jquery-ui-timepicker', WPDM_BASE_URL . 'assets/js/jquery-ui-timepicker-addon.js', array('jquery', 'jquery-ui-core', 'jquery-ui-datepicker', 'jquery-ui-slider'));
            wp_enqueue_script('thickbox');
            wp_enqueue_style('thickbox');
            wp_enqueue_script('media-upload');
            wp_enqueue_media();

            wp_enqueue_script('chosen', plugins_url('/download-manager/assets/js/chosen.jquery.min.js'), array('jquery'));
            wp_enqueue_style('chosen-css', plugins_url('/download-manager/assets/css/chosen.css'));
            wp_enqueue_style('jqui-css', plugins_url('/download-manager/assets/jqui/theme/jquery-ui.css'));

            wp_enqueue_script('wpdm-bootstrap', plugins_url('/download-manager/assets/bootstrap/js/bootstrap.min.js'), array('jquery'));
            wp_enqueue_script('wpdm-admin', plugins_url('/download-manager/assets/js/wpdm-admin.js'), array('jquery'));
            wp_enqueue_style('font-awesome', WPDM_BASE_URL . 'assets/font-awesome/css/font-awesome.min.css');
            wp_enqueue_style('wpdm-bootstrap', plugins_url('/download-manager/assets/bootstrap/css/bootstrap.css'));
            //wp_enqueue_style('wpdm-bootstrap-theme', plugins_url('/download-manager/assets/css/front.css'));
            wp_enqueue_style('wpdm-admin-styles', plugins_url('/download-manager/assets/css/admin-styles.css'));
        }
    }

    /**
     * @usage mail package link to specified email address
     * @since 4.6.9
     */
    function emailPackageLink(){
        if(!wp_verify_nonce(wpdm_query_var('__edlnonce'), NONCE_KEY)) die('!!error!!');
        $data = isset($_POST['emldllink'])?$_POST['emldllink']:array();
        if(!isset($data['email']) || empty($data['email']))  die('!!error!!');
        $user_emails = explode(",", $data['email']);
        $pack = get_post($data['pid']);
        $subject = !isset($data['subject']) || empty($data['subject'])? 'Download: '.$pack->post_title:$data['subject'];
        $data['message'] = !isset($data['message']) || empty($data['message'])? 'Please click on following link to start download:':$data['message'];
        foreach ($user_emails as $user_email) {
            $download_link = \WPDM\Package::expirableDownloadLink($data['pid'], 3);
            $message = $data['message'] . "<br/><a style='text-decoration: none;margin: 20px 0 !important;display:block;' href='{$download_link}'><img src='https://www.evernote.com/l/AV1OgnhmFJxIFZ7AbOtxSLW3E5HPzQKnOikB/image.png' alt='Download' /></a><br/>";
            $params = array('subject' => $subject, 'to_email' => trim($user_email), 'message' => $message, 'banner' => get_the_post_thumbnail_url($pack->ID, array(600, 400)));
            \WPDM\Email::send("default", $params);
        }
        die('!!sent!!');

    }

    /**
     * @usage Single click add-on update
     */
    function updateAddon() {
        if (isset($_POST['updateurl']) && current_user_can(WPDM_ADMIN_CAP)) {
            include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
            include_once ABSPATH . 'wp-admin/includes/plugin-install.php';
            $upgrader = new \Plugin_Upgrader(new \Plugin_Installer_Skin(compact('title', 'url', 'nonce', 'plugin', 'api')));
            $downloadlink = $_POST['updateurl'] . '&preact=login&user=' . get_option('__wpdm_suname') . '&pass=' . get_option('__wpdm_supass') . '&__wpdmnocache=' . uniqid();
            $update = new \stdClass();
            $plugininfo = wpdm_plugin_data($_POST['plugin']);
            deactivate_plugins($plugininfo['plugin_index_file'], true);
            delete_plugins(array($plugininfo['plugin_index_file']));
            $upgrader->install($downloadlink);
            if (file_exists(dirname(WPDM_BASE_DIR) . '/' . $plugininfo['plugin_index_file']))
                activate_plugin($plugininfo['plugin_index_file']);
            die("Updated Successfully");
        } else {
            die("Only site admin is authorized to install add-on");
        }
    }

    /**
     * @usage Single click add-on install
     */
    function installAddon() {
        if (isset($_POST['updateurl']) && current_user_can(WPDM_ADMIN_CAP)) {
            include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
            include_once ABSPATH . 'wp-admin/includes/plugin-install.php';
            $upgrader = new \Plugin_Upgrader(new \Plugin_Installer_Skin(compact('title', 'url', 'nonce', 'plugin', 'api')));
            $downloadlink = $_POST['updateurl'] . '&preact=login&user=' . get_option('__wpdm_suname') . '&pass=' . get_option('__wpdm_supass');
            $upgrader->install($downloadlink);
            $plugininfo = wpdm_plugin_data($_POST['plugin']);
            if (file_exists(dirname(WPDM_BASE_DIR) . '/' . $plugininfo['plugin_index_file']))
                activate_plugin($plugininfo['plugin_index_file']);
            die("Installed Successfully");
        } else {
            die("Only site admin is authorized to install add-on");
        }
    }

    function adminHead() {
        remove_submenu_page('index.php', 'wpdm-welcome');
        ?>
        <script type="text/javascript">
            jQuery(function () {

                jQuery('table.users tbody tr').each(function (index) {
                    var uid = this.id.split('-')[1];
                    var cell = jQuery(this).find('td.sports_data');
                    jQuery('#' + this.id + ' .row-actions').append(' | <a href="edit.php?post_type=wpdmpro&page=wpdm-stats&type=pvdpu&uid=' + uid + '">Download Stats</a>');
                });

                jQuery('#TB_closeWindowButton').click(function () {
                    tb_remove();
                });

            });
        </script>
        <?php

    }


    function metaBoxes() {

        if(get_post_type(wpdm_query_var('post')) != 'wpdmpro' && wpdm_query_var('post_type') != 'wpdmpro') return;

        $meta_boxes = array(
            'wpdm-attached-files' => array('title' => __('Attached Files', "wpdmpro"), 'callback' => array($this, 'Files'), 'position' => 'normal', 'priority' => 'core'),
            'wpdm-attached-dir' => array('title' => __('Attach Dir', "wpdmpro"), 'callback' => 'wpmp_dir_browser_metabox', 'position' => 'side', 'priority' => 'core'),
            'wpdm-settings' => array('title' => __('Package Settings', "wpdmpro"), 'callback' => array($this, 'packageSettings'), 'position' => 'normal', 'priority' => 'low'),
            'wpdm-upload-file' => array('title' => __('Attach File', "wpdmpro"), 'callback' => array($this, 'uploadFiles'), 'position' => 'side', 'priority' => 'core'),
        );


        $meta_boxes = apply_filters("wpdm_meta_box", $meta_boxes);
        foreach ($meta_boxes as $id => $meta_box) {
            extract($meta_box);
            if (!isset($position))
                $position = 'normal';
            if (!isset($priority))
                $priority = 'core';
            add_meta_box($id, $title, $callback, 'wpdmpro', $position, $priority);
        }
    }

    function Files($post) {
        include(WPDM_BASE_DIR . "admin/tpls/metaboxes/attached-files.php");
    }

    function packageSettings($post) {
        include(WPDM_BASE_DIR . "admin/tpls/metaboxes/package-settings.php");
    }

    function uploadFiles($post) {
        include(WPDM_BASE_DIR . "admin/tpls/metaboxes/attach-file.php");
    }

}
