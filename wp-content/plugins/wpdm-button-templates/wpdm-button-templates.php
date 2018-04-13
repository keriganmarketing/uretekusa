<?php
/*
Plugin Name: WPDM - Button Templates
Description: Button Styles Link Templates For WPDM
Plugin URI: http://www.wpdownloadmanager.com/
Author: Shaon
Version: 1.2.0
Author URI: http://www.wpdownloadmanager.com/
*/


class WPDM_Button_Templates {

    function __construct(){
        add_action('wp_enqueue_scripts', array($this, 'enqueue_style'));
        add_shortcode('wpdm_button_template', array($this, 'template'));
        add_action('wpdm_ext_shortcode', array($this, 'MCEButtonHelper'));

    }

    function template($params){
        $style = isset($params['style'])?$params['style']:'light';
        $id = isset($params['id'])?$params['id']:false;
        extract($params);
        if(!isset($align)) $align = "center";
        if(!$id) return "";
        $package = get_post($id, ARRAY_A);
        $package = wpdm_setup_package_data($package);
        $link_label = $package['link_label'];
        $file_size = get_post_meta($id, '__wpdm_package_size', true);
        $icon = get_post_meta($id, '__wpdm_icon', true);
        $icon = get_post_meta($id, '__wpdm_icon', true);
        $html = <<<HTML
        <div class="w3eden">
<div class="link-btn {$style}  p{$align}">
    <div class="media">
        <div class="pull-left wbt-left"><div class="wbt-icon">{$package['icon']}</div></div>
        <div class="media-body text-left wbt-content"><strong class="ptitle">
                {$package['title']}
            </strong>

            <div style="font-size: 8pt;padding-top: 1px">{$link_label} <i style="margin: 4px 0 0 5px;opacity:0.5"
                                                           class="fa fa-th-large"></i> {$package['file_size']}
            </div>
        </div>
    </div>
</div>
<div style="clear: both;"></div>
</div>

<script>
jQuery(function(){
jQuery('.link-btn a.wpdm-download-link img').after('{$link_label}');
jQuery('.link-btn a.wpdm-download-link img').remove();
});
</script>
HTML;
        $html = str_replace(array("\r","\n"), "", $html);

        if(!wpdm_is_locked($id) && wpdm_user_has_access($id)){
            return "<a href='".wpdm_download_url($package)."'>{$html}</a>";
        } else
            return FetchTemplate("[download_link]", $package);


    }

    function enqueue_style(){
        wp_enqueue_style("wpdm-button-templates",plugins_url("wpdm-button-templates/buttons.css"));
    }

    /**
     * @usage Add short-code generator function with tinymce button add-on
     */
    function MCEButtonHelper(){
        ?>

        <div class="panel panel-default">
            <div class="panel-heading">Button Templates</div>
            <div class="panel-body">
                <select id="btpls_style">
                    <option value="light">Style</option>
                    <option value="light">Light</option>
                    <option value="green">Green</option>
                    <option value="blue">Blue</option>
                    <option value="lightblue">Light Blue</option>
                    <option value="coffee">Coffee</option>
                    <option value="xmas">Christmas</option>
                    <option value="instagram">Instagram</option>
                </select>
                <select style="margin-left: 5px;" id="btpls_align">
                    <option value="center">Align:</option>
                    <option value="left">Left</option>
                    <option value="right">Right</option>
                    <option value="center">Center</option>
                    </select>
                <div style="clear: both;margin-bottom: 5px"></div>
                <b>Select Package</b>
                <div id="btpls_tree" style="height: 300px;overflow: auto;border: 1px solid #eeeeee;padding-left: 10px"></div>
                <script language="JavaScript">
                    <!--
                    jQuery(document).ready( function() {
                        jQuery('#btpls_tree').fileTree({
                            script: '<?php echo site_url(); ?>/?task=wpdm_init_tree',
                            expandSpeed: 1000,
                            collapseSpeed: 1000,
                            multiFolder: false
                        }, function(file) {
                            var win = window.dialogArguments || opener || parent || top;
                            var btpls_style = jQuery('#btpls_style').val()!=""?' style="'+jQuery('#btpls_style').val()+'"':"";
                            var btpls_align = jQuery('#btpls_align').val()!=""?' align="'+jQuery('#btpls_align').val()+'"':"";
                            win.send_to_editor('[wpdm_button_template id=' + file + btpls_style + btpls_align +']');
                            tinyMCEPopup.close();
                            return false;
                            //location.href=    file; // jQuery(this).attr('data-url');
                        });


                    });
                    //-->
                </script>
                <script>
                    jQuery('#acps').click(function(){

                        var cats = jQuery('#apc').val()!='-1'?' category="' + jQuery('#apc').val() + '" ':'';
                        var bts = ' button_style="' + jQuery('#btns_ap').val() + '" ';
                        var catvw = ' cat_view="' + jQuery('#catvw_ap').val() + '" ';
                        var linkt = ' link_template="' + jQuery('#plnk_tpl_ap').val() + '" ';
                        var acob = ' order_by="' + jQuery('#acob').val() + '" order="' + jQuery('#acobs').val() + '"';
                        var win = window.dialogArguments || opener || parent || top;
                        win.send_to_editor('[wpdm-archive' + cats + catvw + bts + linkt + acob + ' items_per_page="10"]');
                        tinyMCEPopup.close();
                        return false;
                    });
                </script>
            </div>

        </div>

        <?php
    }



}

new WPDM_Button_Templates();
 


