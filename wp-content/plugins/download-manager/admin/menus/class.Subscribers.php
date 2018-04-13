<?php

namespace WPDM\admin\menus;


class Subscribers
{

    function __construct()
    {
        add_action( "admin_init", array($this, 'exportEmails') );
        add_action( "admin_init", array($this, 'deleteEmails') );
        add_action( "admin_init", array($this, 'saveMailTemplate') );
        add_action( "admin_menu", array($this, 'Menu') );
    }

    function Menu()
    {
        add_submenu_page('edit.php?post_type=wpdmpro', __('Subscribers &lsaquo; Download Manager', "wpdmpro"), __('Subscribers', "wpdmpro"), WPDM_MENU_ACCESS_CAP, 'wpdm-subscribers', array($this, 'UI'));
    }


    function UI()
    {
        if (isset($_GET['task']) && $_GET['task'] == 'template')
            \WPDM\admin\menus\Subscribers::mailTemplates();
        else
            \WPDM\admin\menus\Subscribers::Emails();
    }

    public static function Emails(){
        include(WPDM_BASE_DIR . "admin/tpls/subscribers.php");
    }

    public static function mailTemplates(){
        include(WPDM_BASE_DIR . "admin/tpls/emails-template.php");
    }


    function exportEmails()
    {
        global $wpdb;
        if(!current_user_can(WPDM_ADMIN_CAP)) return;
        $task = isset($_GET['task']) ? $_GET['task'] : '';
        if ($task == 'export' && isset($_GET['page']) && $_GET['page'] == 'wpdm-subscribers') {
            $custom_fields = array();
            $csv = '';

            if(wpdm_query_var('lockOption') == 'email' || wpdm_query_var('lockOption') == '') {
                if (isset($_GET['uniq']) && $_GET['uniq'] == 1)
                    $res = $wpdb->get_results("select * from {$wpdb->prefix}ahm_emails group by email", ARRAY_A);
                else
                    $res = $wpdb->get_results("select e.* from {$wpdb->prefix}ahm_emails e order by id desc", ARRAY_A);
                $custom_fields = apply_filters('wpdm_export_custom_form_fields', $custom_fields);
            } else {
                $source = wpdm_query_var('lockOption');
                if (isset($_GET['uniq']) && $_GET['uniq'] == 1)
                    $res = $wpdb->get_results("select * from {$wpdb->prefix}ahm_social_conns where source = '{$source}' group by email", ARRAY_A);
                else
                    $res = $wpdb->get_results("select * from {$wpdb->prefix}ahm_social_conns where source = '{$source}' order by ID desc", ARRAY_A);

            }
            $csv .= "\"package\", \"email\", \"" . ($custom_fields?implode("\", \"", $custom_fields):'') . "\", \"date\"\r\n";
            $source = wpdm_query_var('lockOption');
            foreach ($res as $row) {
                $data = array();
                $data['package'] = get_the_title($row['pid']);
                $data['email'] = $row['email'];
                if(isset($row['custom_data'])) {
                    $cf_data = unserialize($row['custom_data']);
                    foreach ($custom_fields as $c) {
                        $index = isset($data[$c]) ? "_" . $c : $c;
                        $data[$index] = isset($cf_data[$c]) ? $cf_data[$c] : "";
                        if (is_array($data[$c])) $data[$c] = implode(", ", $data[$c]);
                    }
                }
                $data['date'] = isset($row['date'])?date("Y-m-d H:i", $row['date']):"";
                $csv .= '"' . @implode('","', $data) . '"' . "\r\n";
            }
            header("Content-Description: File Transfer");
            header("Content-Type: text/csv; charset=UTF-8");
            header("Content-Disposition: attachment; filename=\"emails.csv\"");
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: " . strlen($csv));
            echo $csv;
            die();
        }
    }


    function deleteEmails()
    {
        global $wpdb;
        if(!current_user_can(WPDM_ADMIN_CAP)) return;
        $task = isset($_GET['task']) ? $_GET['task'] : '';
        $page = isset($_GET['page']) ? $_GET['page'] : '';
        if ($task == 'delete' && $page == 'wpdm-subscribers') {
            $ids = implode(",", $_POST['id']);
            if(wpdm_query_var('lockOption') == 'email' || wpdm_query_var('lockOption') == '')
                $wpdb->query("delete from {$wpdb->prefix}ahm_emails where id in ($ids)");
            else
                $wpdb->query("delete from {$wpdb->prefix}ahm_social_conns where ID in ($ids)");

            header("location: edit.php?post_type=wpdmpro&page=wpdm-subscribers".(wpdm_query_var('lockOption') != ''?'&lockOption='.wpdm_query_var('lockOption'):''));
            die();
        }
    }


    function saveMailTemplate()
    {
        if(!current_user_can(WPDM_ADMIN_CAP)) return;
        if (isset($_POST['task']) && $_POST['task'] == 'save-etpl') {
            update_option('_wpdm_etpl', $_POST['et']);
            header("location: edit.php?post_type=wpdmpro&page=emails&task=template");
            die();
        }

    }

}