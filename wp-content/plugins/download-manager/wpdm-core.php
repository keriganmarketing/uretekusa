<?php

/**
 * Warning!!!
 * Don't change any function from here
 *
 */

global $stabs, $package, $wpdm_package;


/**
 * @param $tablink
 * @param $newtab
 * @param $func
 * @deprecated Deprecated from v4.2, use filter hook 'add_wpdm_settings_tab'
 * @usage Deprecated: From v4.2, use filter hook 'add_wpdm_settings_tab'
 */
function add_wdm_settings_tab($tablink, $newtab, $func)
{
    global $stabs;
    $stabs["{$tablink}"] = array('id' => $tablink, 'icon' => 'fa fa-cog', 'link' => 'edit.php?post_type=wpdmpro&page=settings&tab=' . $tablink, 'title' => $newtab, 'callback' => $func);
}

function wpdm_create_settings_tab($tabid, $tabtitle, $callback, $icon = 'fa fa-cog')
{
    return \WPDM\admin\menus\Settings::createMenu($tabid, $tabtitle, $callback, $icon);
}


/**
 * @usage Check user's download limit
 * @param $id
 * @return bool
 */
function wpdm_is_download_limit_exceed($id)
{
    return \WPDM\Package::userDownloadLimitExceeded($id);
}


/**
 * @param (int|array) $package Package ID (INT) or Complete Package Data (Array)
 * @param string $ext
 * @return string|void
 */
function wpdm_download_url($package, $ext = '')
{
    if (!is_array($package)) $package = intval($package);
    $id = is_int($package) ? $package : $package['ID'];
    return \WPDM\Package::getDownloadURL($id, $ext);
}


/**
 * @usage Check if a download manager category has child
 * @param $parent
 * @return bool
 */

function wpdm_cat_has_child($parent)
{
    $termchildren = get_term_children($parent, 'wpdmcategory');
    if (count($termchildren) > 0) return count($termchildren);
    return false;
}

/**
 * @usage Get category checkbox list
 * @param int $parent
 * @param int $level
 * @param array $sel
 */
function wpdm_cblist_categories($parent = 0, $level = 0, $sel = array())
{
    $cats = get_terms('wpdmcategory', array('hide_empty' => false, 'parent' => $parent));
    if (!$cats) $cats = array();
    if ($parent != '') echo "<ul>";
    foreach ($cats as $cat) {
        $id = $cat->slug;
        $pres = $level * 5;

        if (in_array($id, $sel))
            $checked = 'checked=checked';
        else
            $checked = '';
        echo "<li style='margin-left:{$pres}px;padding-left:0'><label><input id='c$id' type='checkbox' name='file[category][]' value='$id' $checked /> " . $cat->name . "</label></li>\n";
        wpdm_cblist_categories($cat->term_id, $level + 1, $sel);

    }
    if ($parent != '') echo "</ul>";
}

/**
 * @usage Get category dropdown list
 * @param string $name
 * @param string $selected
 * @param string $id
 * @param int $echo
 * @return string
 */
function wpdm_dropdown_categories($name = '', $selected = '', $id = '', $echo = 1)
{
    return wp_dropdown_categories(array('show_option_none' => __('Select category', 'wpdmpro'), 'show_count' => 0, 'orderby' => 'name', 'echo' => $echo, 'class' => 'form-control selectpicker', 'taxonomy' => 'wpdmcategory', 'hide_empty' => 0, 'name' => $name, 'id' => $id, 'selected' => $selected));

}


/**
 * @usage Post with cURL
 * @param $url
 * @param $data
 * @return bool|mixed|string
 */
function remote_post($url, $data)
{

    $response = wp_remote_post($url, array(
            'method' => 'POST',
            'timeout' => 45,
            'redirection' => 5,
            'httpversion' => '1.0',
            'blocking' => true,
            'headers' => array(),
            'body' => $data,
            'cookies' => array()
        )
    );
    if (is_wp_error($response)) {
        $error_message = $response->get_error_message();
        return $error_message;
    } else {
        return $response['body'];
    }
}

/**
 * @usage Get with cURL
 * @param $url
 * @return bool|mixed|string
 */
function remote_get($url)
{
    $content = "";
    $response = wp_remote_get($url);
    if (is_array($response)) {
        $content = $response['body'];
    }
    return $content;
}


function is_valid_license_key()
{
    $key = isset($_POST['_wpdm_license_key']) ? $_POST['_wpdm_license_key'] : get_option('_wpdm_license_key');
    update_option("__wpdm_nlc", strtotime('+7 days'));
    $domain = strtolower(str_replace("www.", "", $_SERVER['HTTP_HOST']));
    if (file_exists(dirname(__FILE__) . "/cache/wpdm_{$domain}")) {
        $data = unserialize(base64_decode(file_get_contents(dirname(__FILE__) . "/cache/wpdm_{$domain}")));
        if ($data[0] == md5($domain . $key) && $data[1] > time())
            return true;
        else
            @unlink(dirname(__FILE__) . "/cache/wpdm_{$domain}");
    }
    $res = remote_post('https://www.wpdownloadmanager.com/', array('action' => 'wpdm_pp_ajax_call', 'execute' => 'verifylicense', 'domain' => $domain, 'key' => $key, 'product' => 'wpdmpro'));

    if ($res === 'valid') {
        file_put_contents(dirname(__FILE__) . "/cache/wpdm_{$domain}", base64_encode(serialize(array(md5($domain . $key), strtotime("+30 days")))));
        return true;
    }
    if (get_option('settings_ok') == '')
        update_option('settings_ok', strtotime('+30 days'));
    else {
        $page = isset($_GET['page']) ? $_GET['page'] : "";
        $time = (int)get_option('settings_ok');
        if ($time < time() && $page == 'settings' && (!isset($_GET['tab']) || $_GET['tab'] != 'license')) {
            die("<script>location.href='edit.php?post_type=wpdmpro&page=settings&tab=license';</script>");
        }
    }
    return false;
}


function check_license()
{
    if ((int)get_option('__wpdm_nlc') > time()) return true;
    if ($_SERVER['HTTP_HOST'] == 'localhost') return true;
    if (isset($_SESSION['__key_valid']) && $_SESSION['__key_valid'] == 1) return true;
    //if (!isAjax()) {
    if (!is_valid_license_key()) {
        $time = (int)get_option('settings_ok');
        if ($time > time())
            wp_die("
        <div id=\"warning\" class=\"error fade\"><p>
        Please enter a valid <a href='edit.php?post_type=wpdmpro&page=settings&tab=license'>license key</a> for <b>Download Manager</b> 
        </div>
        ");
        else
            wp_die("
        <div id=\"warning\" class=\"error fade\"><p>
        Trial period for <b>Download Manager</b> is expired.<br/>
        Please enter a valid <a href='edit.php?post_type=wpdmpro&page=settings&tab=license'>license key</a> for <b>Download Manager</b> to reactivate it.<br/>
        <a href='https://www.wpdownloadmanager.com/'>Buy your copy now only at 45.00 usd</a>
        </div>
        ");
    } else {
        $_SESSION['__key_valid'] = 1;
    }
    //}
}

function wpdm_license_notice()
{
    if ((int)get_option('__wpdm_nlc') > time()) return '';
    if ($_SERVER['HTTP_HOST'] == 'localhost') return '';
    //if (!isAjax()) {
    if (!is_valid_license_key()) {
        $time = (int)get_option('settings_ok');
        if ($time > time())
            return "
        <div class='w3eden'><div id=\"warning\" class=\"alert alert-danger\"><p>
        Please enter a valid <a href='edit.php?post_type=wpdmpro&page=settings&tab=license'>license key</a> for <b>Download Manager</b>
        </div></div>
        ";
        else
            return ("
        <div class='w3eden'><div id=\"warning\" class=\"alert alert-danger\"><p>
        Trial period for <b>Download Manager</b> is expired.<br/>
        Please enter a valid <a style='font-weight: 900;text-decoration: underline' href='edit.php?post_type=wpdmpro&page=settings&tab=license'>license key</a> for Download Manager to reactivate it.<br/>
        <a href='https://www.wpdownloadmanager.com/'>Buy your copy now only at 45.00 usd</a>
        </div></div>
        ");
    }
    //}
    return '';
}

function wpdm_admin_license_notice()
{
    if (basename($_SERVER['REQUEST_URI']) != 'plugins.php' && basename($_SERVER['REQUEST_URI']) != 'index.php' && get_post_type() != 'wpdmpro') return '';
    if ((int)get_option('__wpdm_nlc') > time()) return '';
    if ($_SERVER['HTTP_HOST'] == 'localhost') return '';
    //if (!isAjax()) {
    if (!is_valid_license_key()) {
        $time = (int)get_option('settings_ok');
        if ($time > time())
            echo "
        <div id=\"error\" class=\"error\" style='border-left: 0 !important;border-top: 3px solid #dd3d36 !important;'><p>
        Please enter a valid <a href='edit.php?post_type=wpdmpro&page=settings&tab=license'>license key</a> for <b>Download Manager</b></p>
        </div>
        ";
        else
            echo("
        <div id=\"error\" class=\"error\" style='border-left: 0 !important;border-top: 3px solid #dd3d36 !important;'><p>
        Trial period for <b>Download Manager</b> is expired.<br/>
        Please enter a valid <a style='font-weight: 900;text-decoration: underline' href='edit.php?post_type=wpdmpro&page=settings&tab=license'>license key</a> for Download Manager to reactivate it.<br/>
        <a href='https://www.wpdownloadmanager.com/'>Buy your copy now only at 45.00 usd</a></p>
        </div>
        ");
    }
    //}
}


function wpdm_ajax_call_exec()
{
    if (isset($_POST['action']) && $_POST['action'] == 'wpdm_ajax_call') {
        if ($_POST['execute'] == 'wpdm_getlink')
            wpdm_getlink();
        die();
    }
}


function wpdm_plugin_data($dir)
{
    $plugins = get_plugins();
    foreach ($plugins as $plugin => $data) {
        $data['plugin_index_file'] = $plugin;
        $plugin = explode("/", $plugin);
        if ($plugin[0] == $dir) return $data;
    }
    return false;
}

function wpdm_plugin_update_email($plugin_name, $version, $update_url)
{

    $admin_email = get_option('admin_email');
    $hash = "__wpdm_" . md5($plugin_name . $version);
    $sent = get_option($hash, false);
    if (!$sent) {
        $email = array(
            'label' => __('New Package Notification', 'wpdmpro'),
            'for' => 'admin',
            'default' => array('subject' => __($plugin_name . ': Update Available', 'wpdmpro'),
                'from_name' => "WordPress Download Manager",
                'from_email' => "support@wpdownloadmanager.com",
                'to_email' => $admin_email,
                'message' => ''
            ));
        $main_content = 'New version available. Please update your copy.<br/><br/><table class="table" style="width: 100%" cellpadding="10px"><tr><td width="120px">Plugin Name:</td><td>' . $plugin_name . '</td></tr><tr><td width="120px">Version:</td><td>' . $version . '</td></tr><tr><td width="120px"></td><td><div style="padding-top: 10px;"><a style="border:1px solid #5f9f60 !important;color: #ffffff;background: #5f9f60;padding:10px 25px;text-decoration:none;font-weight:bold !important;text-transform:uppercase" class="btn" href="' . $update_url . '">Update Now</a></div></td></tr></table>';
        $template = $email['default'];
        $template_file = "default.html";
        $template_data = file_get_contents(wpdm_tpl_path($template_file, WPDM_BASE_DIR . 'email-templates/'));
        $message = str_replace(array("[#sitename#]", "[#site_url#]", "[#site_tagline#]", "[#message#]", "[#facebook#]"), array("WordPress Download Manager", "https://www.wpdownloadmanager.com/", "Plugin Update Available", $main_content, "https://www.facebook.com/wpdownloadmanager/"), $template_data);

        $headers = "From: WordPress Download Manager <support@wpdownloadmanager.com>\r\nContent-type: text/html\r\n";

        wp_mail($admin_email, $plugin_name . ': Update Available', $message, $headers);
        update_option($hash, 1);

    }
}

function wpdm_check_update()
{

    if (!current_user_can(WPDM_ADMIN_CAP)) die();

    include_once(ABSPATH . 'wp-admin/includes/plugin.php');

    $latest = get_option('wpdm_latest');
    $latest_check = get_option('wpdm_latest_check');
    $time = time() - intval($latest_check);
    $plugins = get_plugins();

    $latest_v_url = 'https://www.wpdownloadmanager.com/versions.php';

    if ($latest == '' || $time > 86400) {
        $latest = remote_get($latest_v_url);
        update_option('wpdm_latest', $latest);
        update_option('wpdm_latest_check', time());

    }
    $latest = maybe_unserialize($latest);


    $page = isset($_REQUEST['page']) ? esc_attr($_REQUEST['page']) : '';
    $plugin_info_url = isset($_REQUEST['plugin_url']) ? $_REQUEST['plugin_url'] : 'https://www.wpdownloadmanager.com/purchases/';
    if (is_array($latest)) {
        foreach ($latest as $plugin_dir => $latestv) { 
            if ($plugin_dir != 'download-manager') {
                if (get_option('wpdm_update_notice') == 'disabled' || !($page == 'plugins' || get_post_type() == 'wpdmpro')) die('');
                $plugin_data = wpdm_plugin_data($plugin_dir);

                if (version_compare($plugin_data['Version'], $latestv, '<') == true) {
                    $plugin_name = $plugin_data['Name'];
                    $plugin_info_url = $plugin_data['PluginURI'];
                    $active = is_plugin_active($plugin_data['plugin_index_file']) ? 'active' : '';
                    $trid = sanitize_title($plugin_name);
                    $plugin_update_url = admin_url('/edit.php?post_type=wpdmpro&page=settings&tab=plugin-update&plugin=' . $plugin_dir); //'https://www.wpdownloadmanager.com/purchases/?'; //
                    if ($trid != '') {
                        wpdm_plugin_update_email($plugin_name, $latestv, $plugin_update_url);
                        if ($page == 'plugins') {
                            echo <<<NOTICE
     <script type="text/javascript">
      jQuery(function(){
        jQuery('tr:data[data-slug={$trid}]').addClass('update').after('<tr class="plugin-update-tr {$active} update"><td colspan=3 class="plugin-update colspanchange"><div class="update-message notice inline notice-warning notice-alt"><p>There is a new version of <strong>{$plugin_name}</strong> available. <a href="{$plugin_update_url}&v={$latestv}" style="margin-left:10px" target=_blank>Update now ( v{$latestv} )</a></p></div></td></tr>');
      });
      </script>
NOTICE;
                        } else {
                            echo <<<NOTICE
     <script type="text/javascript">
      jQuery(function(){
        jQuery('.wrap > h2').after('<div class="updated error" style="margin:10px 0px;padding:10px;border-left:2px solid #dd3d36;background: #ffffff"><div style="float:left;"><b style="color:#dd3d36;">Important!</b><br/>There is a new version of <u>{$plugin_name}</u> available.</div> <a style="border-radius:0; float:right;;color:#ffffff; background: #D54E21;padding:10px 15px;text-decoration: none;font-weight: bold;font-size: 9pt;letter-spacing:1px" href="{$plugin_update_url}&v={$latestv}"  target=_blank><i class="fa fa-refresh"></i> update v{$latestv}</a><div style="clear:both"></div></div>');
         });
         </script>
NOTICE;
                        }
                    }
                }
            } else {
                $os = 'Completed';
                $license_key = get_option('_wpdm_license_key', '');
                if($license_key != '') {
                    $item = remote_get('https://www.wpdownloadmanager.com/?wpdmppaction=getlicensedetails&license=' . $license_key);
                    $item = json_decode($item);
                    $os = $item->order_status;
                    $oid = $item->order_id;
                    $valid = is_valid_license_key();
                } else {
                    $os = 'Invalid';
                    $oid = '0';
                    $valid = false;
                }
                $plugin_data = wpdm_plugin_data($plugin_dir);
                if (version_compare($plugin_data['Version'], $latestv, '<') == true) {
                    $plugin_name = $plugin_data['Name'];
                    $plugin_info_url = $plugin_data['PluginURI'];
                    $active = is_plugin_active($plugin_data['plugin_index_file']) ? 'active' : '';
                    wpdm_plugin_update_email($plugin_name, $latestv, admin_url('plugins.php'));
                }
                $trid = 'download-manager-pro';

                $vlic = admin_url('edit.php?post_type=wpdmpro&page=settings&tab=license');
                if($page == 'plugins') {
                    if (!$valid) {
                        echo <<<NOTICE
     <script type="text/javascript">
      jQuery(function(){
        if(jQuery('#download-manager-pro-update').html() != undefined ) {       
            jQuery('#download-manager-pro-update td').append('<div class="update-message notice inline notice-error notice-alt"><p>Please activate <strong>{$plugin_name}</strong> license for automatic update. <a href="{$vlic}" target=_blank>Validate license key</a></p></div>');
            }
        else {
       
            if(jQuery('tr:data[data-slug={$trid}]').html() != undefined)
                jQuery('tr:data[data-slug={$trid}]').addClass('update').after('<tr class="plugin-update-tr {$active} active update" id="{$trid}-expired"><td colspan=3 class="plugin-update colspanchange"><div class="update-message notice inline notice-error notice-alt"><p>Please activate <strong>{$plugin_name}</strong> license for automatic update. <a href="{$vlic}" target=_blank>Validate license key</a></p></div></td></tr>');
            else    
                jQuery('tr:data[data-slug=download-manager]').addClass('update').after('<tr class="plugin-update-tr {$active} active update" id="{$trid}-expired"><td colspan=3 class="plugin-update colspanchange"><div class="update-message notice inline notice-error notice-alt"><p>Please activate <strong>{$plugin_name}</strong> license for automatic update. <a href="{$vlic}" target=_blank>Validate license key</a></p></div></td></tr>');
           }
      });
      </script>
NOTICE;

                    } else if ($os == 'Expired') {
                        echo <<<NOTICE
     <script type="text/javascript">
      jQuery(function(){
        if(jQuery('#download-manager-pro-update').html() !='' ) 
            jQuery('#download-manager-pro-update td').append('<div class="update-message notice inline notice-error notice-alt"><p><strong>{$plugin_name}</strong> support and update period is expired. <a href="https://www.wpdownloadmanager.com/user-dashboard/purchases/order/{$oid}/" target=_blank>Renew now</a></p></div>');
        else {
            jQuery('tr:data[data-slug={$trid}]:last-child').addClass('update').after('<tr class="plugin-update-tr {$active} update" id="{$trid}-expired"><td colspan=3 class="plugin-update colspanchange"><div class="update-message notice inline notice-error notice-alt"><p><strong>{$plugin_name}</strong> support and update period is expired. <a href="https://www.wpdownloadmanager.com/user-dashboard/purchases/order/{$oid}/" target=_blank>Renew now ( v{$latestv} )</a></p></div></td></tr>');
            jQuery('tr:data[data-slug=download-manager]:last-child').addClass('update').after('<tr class="plugin-update-tr {$active} update" id="{$trid}-expired"><td colspan=3 class="plugin-update colspanchange"><div class="update-message notice inline notice-error notice-alt"><p><strong>{$plugin_name}</strong> support and update period is expired. <a href="https://www.wpdownloadmanager.com/user-dashboard/purchases/order/{$oid}/" target=_blank>Renew now ( v{$latestv} )</a></p></div></td></tr>');
           }
      });
      </script>
NOTICE;

                    }
                }
            }
        }
    }
    if (wpdm_is_ajax())
        die('ok');
}

function wpdm_newversion_check()
{

    if (!current_user_can(WPDM_ADMIN_CAP)) return;

    $tmpvar = explode("?", basename($_SERVER['REQUEST_URI']));
    $page = array_shift($tmpvar);
    $page = explode(".", $page);
    $page = array_shift($page);


    $page = $page == 'plugins' ? $page : get_post_type();

    ?>
    <script type="text/javascript">
        jQuery(function () {

            jQuery.post(ajaxurl, {
                action: 'wpdm_check_update',
                page: '<?php echo $page; ?>'
            }, function (res) {
                jQuery('#wpfooter').after(res);
            });


        });
    </script>

    <div class="w3eden">
        <div class="modal fade" tabindex="-1" role="dialog" id="edlModal" style="display: none">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>
                        <h4 class="modal-title"><?php _e('Email Download Link', 'wpdmpro'); ?></h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="edlfrm">
                            <input type="hidden" name="action" value="wpdm_email_package_link" />
                            <?php wp_nonce_field(NONCE_KEY, '__edlnonce'); ?>
                            <input type="hidden" name="emldllink[pid]" id="edlpid" value="" />
                            <div class="form-group" id="edlemail_fg">
                                <label><?php _e('Emails:', 'wpdmpro'); ?><span class="color-red">*</span> </label>
                                <input type="text" required="required" class="form-control" id="edlemail" name="emldllink[email]" placeholder="<?php _e('Multiple emails separated by comma(,)', 'wpdmpro'); ?>" />
                            </div>
                            <div class="form-group">
                                <label><?php _e('Subject:', 'wpdmpro'); ?></label>
                                <input type="text" class="form-control" id="edlsubject" name="emldllink[subject]" />
                            </div>

                            <div class="form-group">
                            <label><?php _e('Message:', 'wpdmpro'); ?></label>

                            <textarea id="edlmsg" name="emldllink[msg]" class="form-control"></textarea>

                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php _e('Close', 'wpdmpro'); ?></button>
                        <button type="button" class="btn btn-primary" id="__wpdmseln"><i class="fa fa-paper-plane"></i> &nbsp;<?php _e('Send Now', 'wpdmpro'); ?></button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal fade" tabindex="-1" role="dialog" id="gdluModal" style="display: none">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>
                        <h4 class="modal-title"><?php _e('Genrate Download Link', 'wpdmpro'); ?></h4>
                    </div>
                    <div class="modal-body">


                        <div class="panel panel-default">
                            <div class="panel-heading"><?php _e('Master Download Link:', 'wpdmpro'); ?></div>
                            <div class="panel-body"><input readonly="readonly" onclick="this.select()" type="text" class="form-control color-purple" style="background: #fdfdfd;font-size: 10px;text-align: center;font-family: monospace;font-weight: bold;" id="mdl" /></div>
                        </div>

                       <div class="panel panel-default">
                            <div class="panel-heading">Generate Temporary Download Link</div>
                            <div class="panel-body">

                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Usage Limit:</label>
                                        <div class="input-group">
                                        <input min="1" class="form-control" id="ulimit" type="number" value="3">
                                            <div class="input-group-addon">times</div>
                                            </div>
                                    </div>
                                    <div class="col-md-5">
                                        <label>Expire After:</label>
                                        <div class="input-group">
                                            <input id="exmisd" min="0.5" step="0.5" class="form-control" type="number" value="600">
                                            <div class="input-group-addon">mins</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>&nbsp;</label><br/>
                                        <button id="gdlbtn" class="btn btn-default btn-block" style="height: 34px" type="button">Generate</button>
                                    </div>
                                </div>

                            </div>
                           <div class="panel-footer">
                               <input type="text" id="tmpgdl" value="" class="form-control color-green"  readonly="readonly" onclick="this.select()"  style="background: #fdfdfd;font-size: 10px;text-align: center;font-family: monospace;font-weight: bold;" placeholder="Click Generate Button">
                           </div>
                        </div>



                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </div>
    <script>
        jQuery(function ($) {
            $('.email_dllink').on('click', function () {
                $('#edlpid').val($(this).attr('data-pid'));
            });
            $('body').on('click', '#__wpdmseln', function () {
                if($('#edlemail').val() == ''){
                    $('#edlemail_fg').addClass('has-error');
                    return false;
                } else
                    $('#edlemail_fg').removeClass('has-error');
                var __bl = $(this).html();
                $(this).html("<i class='fa fa-refresh fa-spin'></i> &nbsp;Sending...").attr('disabled', 'disabled');
                $.post(ajaxurl, $('#edlfrm').serialize(), function (res) {
                    $('#__wpdmseln').html(__bl).removeAttr('disabled');
                })
            });

            var tdlpid;
            $('.gdl_action').on('click', function () {
                tdlpid = $(this).attr('data-pid');
                $('#mdl').val($(this).attr('data-mdlu'));
                $('#tmpgdl').val('');
            });

            $('#gdlbtn').on('click', function () {
                $('#gdlbtn').html("<i class='fa fa-refresh fa-spin'></i>");
                $.post(ajaxurl, {action: 'generate_tdl', pid: tdlpid, ulimit: $('#ulimit').val(), exmisd: $('#exmisd').val(), __tdlnonce: '<?php echo wp_create_nonce(NONCE_KEY); ?>'}, function (res) {
                    $('#tmpgdl').val(res);
                    $('#gdlbtn').html("Generate");
                });
            });

        });
    </script>
    <?php
}

function wpdm_core_update_plugin($update_plugins){

    if ( ! is_object( $update_plugins ) )
        return $update_plugins;
    if ( ! isset( $update_plugins->response ) || ! is_array( $update_plugins->response ) )
        $update_plugins->response = array();

    $latest = get_option('wpdm_latest', '');
    $latest_check = get_option('wpdm_latest_check');
    $time = time() - intval($latest_check);

    if ($latest == '' || $time > 86400) {
        $latest_v_url = 'https://www.wpdownloadmanager.com/versions.php';
        $latest = remote_get($latest_v_url);
        update_option('wpdm_latest', $latest);
        update_option('wpdm_latest_check', time());
    }
    $latest = maybe_unserialize($latest);

    //$pluign = wpdm_plugin_data('download-manager');
    $wpdm_current = WPDM_Version;
    $wpdm_latest = is_array($latest) && isset($latest['download-manager'])?$latest['download-manager']:WPDM_Version;

    if(version_compare($wpdm_current, $wpdm_latest, '>=')) return $update_plugins;

    $upcheck = get_option('__wpdm_core_update_check', false);

    if(($upcheck && (time() - $upcheck) < 86400) && isset($update_plugins->response['download-manager/download-manager.php'])) return $update_plugins;

    if(isset($_SESSION['__wpdm_download_url'])) $download_url = $_SESSION['__wpdm_download_url'];
    else {
        $valid = is_valid_license_key();
        $download_url = '';
        if ($valid === true) {
            $item = remote_get('https://www.wpdownloadmanager.com/?wpdmppaction=getlicensedetails&license=' . get_option('_wpdm_license_key'));
            $item = json_decode($item);
            $download_url = is_object($item) && isset($item->download_url)?$item->download_url:'';
            if ($download_url != '' && get_option('__wpdm_suname') != '') $download_url .= '&preact=login&user=' . get_option('__wpdm_suname') . '&pass=' . get_option('__wpdm_supass');
            else $download_url = '';
            update_option("__wpdm_core_update_check", time());
        }
    }

    $update_plugins->response['download-manager/download-manager.php'] = (object)array(
        'slug'         => 'download-manager-pro',
        'plugin'         => 'download-manager/download-manager.php',
        'new_version'  => $latest['download-manager'],
        'url'          => 'https://www.wpdownloadmanager.com/',
        'package'      => $download_url,
    );

    $_SESSION['__wpdm_download_url'] = $download_url;

    return $update_plugins;

}

add_action('admin_notices', 'wpdm_admin_license_notice');
add_filter( 'site_transient_update_plugins', 'wpdm_core_update_plugin' );
add_filter( 'transient_update_plugins', 'wpdm_core_update_plugin' );




if (!isset($_REQUEST['P3_NOCACHE'])) {

    include(dirname(__FILE__) . "/wpdm-hooks.php");

    $files = scandir(dirname(__FILE__) . '/modules/');
    foreach ($files as $file) {
        $tmpdata = explode(".", $file);
        if ($file != '.' && $file != '..' && !@is_dir($file) && end($tmpdata) == 'php')
            include(dirname(__FILE__) . '/modules/' . $file);
    }
}


