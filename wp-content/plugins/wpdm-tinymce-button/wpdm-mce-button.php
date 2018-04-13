<?php
/*
Plugin Name: WPDM - TinyMce Button
Plugin URI: http://www.wpdownloadmanager.com/
Description: TinyMCE Button add-on for WordPress Download Manager
Author: Shaon
Version: 2.7.1
Author URI: http://www.wpdownloadmanager.com/
*/



function wpdm_init_tree()
{
    if(!current_user_can('edit_posts')) return;
    if (!isset($_GET['task']) || $_GET['task'] != 'wpdm_init_tree') return;
    global $wpdb;

    echo "<ul class=\"jqueryFileTree\" style=\"display: none;\">";
    // All Cats
    $_POST['dir'] = !isset($_POST['dir']) || $_POST['dir'] == '/' ? null : $_POST['dir'];
    $cats = get_terms('wpdmcategory', array('hide_empty' => false, 'parent' => $_POST['dir']));

    foreach ($cats as $cat) {

            echo "<li class=\"directory collapsed\"><a href=\"#\" rel=\"" . $cat->term_id . "\">" . $cat->name . "</a></li>";
    }

    // All files

    $qparams = array('post_type'=>'wpdmpro', 'posts_per_page'=>9999,'post_status'=>array('publish','private'));

    if ($_POST['dir'])
        $qparams['tax_query'] = array(array('taxonomy'=>'wpdmcategory','terms'=>array($_POST['dir']), 'include_children'=>false));

    $ndata = get_posts($qparams);


    $sap = '?'; //count($_GET)>0?'&':'?';

    foreach ($ndata as $data) {
        $html = '';

        //$link = "<a href='" . get_permalink($data->ID) . "' >".$data->post_title."</a>";
        $exts = function_exists('wpdm_package_filetypes')?wpdm_package_filetypes($data->ID, false):array();
        $ext = (count($exts)>1)?'zip':((count($exts)==0)?"":$exts[0]);
        $template = "<li class=\"wpdm_clink file ext_$ext\"><a href='#' rel='".$data->ID."' >".$data->post_title."</a></li>";
        $html .= $template;


        echo $html;


    }
    echo "</ul>";
    die();


}

add_action('init', 'wpdm_init_tree');

if (get_post_type() != 'wpdmpro') {
    add_filter('mce_external_plugins', "wpdm_tinyplugin_register");
    add_filter('mce_buttons', 'wpdm_tinyplugin_add_button', 0);
}
function wpdm_tinyplugin_add_button($buttons)
{
    array_push($buttons, "separator", "wpdm_tinyplugin");
    return $buttons;
}

function wpdm_tinyplugin_register($plugin_array)
{
    $url = plugins_url('/wpdm-tinymce-button/editor_plugin.js');

    $plugin_array['wpdm_tinyplugin'] = $url;
    return $plugin_array;
}

function wpdm_mce_tree()
{

    $siteurl = site_url();
    $data = <<<TREE


    <script language="JavaScript">
    <!--
      jQuery(document).ready( function() {
            jQuery('#tree').fileTree({
                script: '{$siteurl}/?task=wpdm_init_tree',
                expandSpeed: 1000,
                collapseSpeed: 1000,
                multiFolder: false
            }, function(file) {
                //alert(file);
                //var sfilename = file.split('/');
                //var filename = sfilename[sfilename.length-1];
                //tb_show(jQuery(this).html(),'{$siteurl}/?download='+file+'&modal=1&width=600&height=400');
               var win = window.dialogArguments || opener || parent || top;
               var ltpl = jQuery('#plnk_tpl').val()!=""?' template="'+jQuery('#plnk_tpl').val()+'"':"";
               win.send_to_editor('[wpdm_package id=' + file + ltpl +']');
               tinyMCEPopup.close();
               return false;
               //location.href=    file; // jQuery(this).attr('data-url');
            });


      });
    //-->
    </script>
TREE;

    return $data;
}


function wpdm_tinymce()
{

    ?>
    <html><head>
        <title>Download Manager</title>
        <link rel="stylesheet" href="<?php echo plugins_url('/download-manager/assets/bootstrap/css/bootstrap.css'); ?>"/>
        <link rel="stylesheet" href="<?php echo plugins_url('/download-manager/assets/font-awesome/css/font-awesome.min.css'); ?>"/>
        <link rel="stylesheet" href="<?php echo plugins_url('/download-manager/assets/css/chosen.css'); ?>"/>
        <script type="text/javascript" src="<?php echo includes_url('/js/jquery/jquery.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo plugins_url('/download-manager/assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo plugins_url('/download-manager/assets/js/chosen.jquery.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo includes_url('/js/tinymce/tiny_mce_popup.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo includes_url('/js/plupload/handlers.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo includes_url('/js/plupload/moxie.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo includes_url('/js/plupload/plupload.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo includes_url('/js/plupload/wp-plupload.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo includes_url('/js/jquery/jquery.form.min.js'); ?>"></script>
        <link href="https://fonts.googleapis.com/css?family=Overpass:400,700" rel="stylesheet">
        <style type="text/css">
            body{
                color: #444;
                font-family: 'Overpass', sans-serif;
            }
            UL.jqueryFileTree a{
                font-family: 'Overpass', sans-serif !important;
                font-size: 12px !important;
            }
            .tab-content{
                background: #ffffff;
            }
            a{
                color: #333333 !important;
            }
            .w3eden .nav.nav-tabs > li > a {
                background: rgba(0, 0, 0, 0.05) none repeat scroll 0 0;
                border: 1px solid #dddddd;
                border-bottom: 1px solid transparent;
                margin-right: 3px;
                border-radius: 2px 2px 0 0;
                font-size: 8pt;
                padding: 7px 15px;
                text-transform: uppercase;
            }
            .w3eden .nav.nav-tabs > li.active > a{
                background: #ffffff;
            }
            .chosen-container, .chosen-single{
                border-radius: 0 !important;
            }
            .bc{margin-bottom: 5px;clear: both;display: block;}
            .tab-content{
                height: 552px;
                overflow-y: auto;
            }
            .w3eden legend {
                font-size: 10pt;
            }

            .w3eden .nav a:active,
            .w3eden .nav a:hover,
            .w3eden .nav a {
                outline: none !important;
            }

            .w3eden .btn small {
                font-size: 65%;
            }

            .wpdm-cats,
            #wpdmacats,
            #wpdmcats {
                height: 280px;
                overflow: hidden;
                border: 1px solid #ddd;
                margin: 0px;
                padding: 10px;
            }

            .wpdm-cats:hover,
            #wpdmacats:hover,
            #wpdmcats:hover{
                overflow: auto;
            }
            .wpdm-cats li label,
            #wpdmacats li label ,
            #wpdmcats li label {
                display: inline;
                font-size: 11px;
                font-weight: normal;
            }

            .wpdm-cats li,
            #wpdmacats li ,
            #wpdmcats li {
                list-style: none;
            }

            .nav-tabs li a {
                font-weight: 700;
                font-size: 9pt;
            }
            .form-control{ border-radius: 0 !important; }

            #wpdm-files{
                font-size: 9pt;
            }


            #filelist {
                margin-top: 10px;
            }

            #filelist .file {
                margin-top: 5px;
                padding: 0px 10px;
                color: #444;
                display: block;
                margin-bottom: 5px;
                font-weight: normal;
            }


            #access {
                width: 250px;
            }


            .action #nxt {
                width: 100%;
                position: fixed;
                top: 0px;
                left: 0px;
                z-index: 999999;
            }

            #nxt a {
                font-weight: bold;
                color: #0C490C;
            }


            .wpdm-accordion div {
                padding: 10px;
            }

            .w3eden select{
                border-radius: 3px;
            }

            .wpdmlock {
                opacity: 0;
            }

            .wpdmlock + label {

                width: 16px;
                height: 16px;
                vertical-align: middle;
            }


            .drag-drop-inside {
                text-align: center;
                padding: 40px 10px;
                border: 1px dashed #ccc;
                margin: 10px 0px;
            }

            #wpdm-files,
            #wpdm-files li {
                list-style: none;
                margin-left: 0;
                min-height: 5px;
            }

            .w3eden select{
                padding: 5px;
            }

            .nav-tabs{ margin: 0 !important; }

            .tab-content{
                border: 1px solid #dddddd;
                border-top: 0;
                padding: 10px;
            }
            .tab-content .panel, .tab-content .panel-heading{  border-radius: 0;  box-shadow: none;  }

            #plnk_tpl_pl_chosen{ min-width: 200px; }
            #packlist .chosen-container, #plnk_tpl_chosen{ min-width: 100% !important; }
            #packlist .row{ margin-bottom: 10px; }
            #lnk_tpl_chosen{ min-width: 280px; }
            #lnk_tpl__chosen{ min-width: 100%; }
            #plnk_tpl_pl_chosen{ min-width: 150px; }
            .chosen-container{ margin-right: 4px; }
            .tab-content{ overflow-x: hidden; }
            #srcrs_tpl_chosen.chosen-container{
                width: 100% !important;
                min-width: 100% !important;
            }
            #srcpkg .btn{
                width: 100%;
            }



        </style>
    </head>
    <body class="w3eden">

    <div class='w3eden'>

    <div class="tabbable">
    <ul class="nav nav-tabs" style="margin-bottom: 20px">
        <li class="active"><a href="#pkg" data-toggle="tab">Insert Package</a></li>
        <li><a href="#ctg" data-toggle="tab">Insert Category</a></li>
        <li><a href="#osc" data-toggle="tab">Other Short-codes</a></li>
        <li><a href="#qbtn" data-toggle="tab">Quick Add</a></li>
    </ul>
    <div class="tab-content">
    <div id="pkg" class="tab-pane active">
        <?php echo \WPDM\admin\menus\Templates::Dropdown(array('id'=>'plnk_tpl')); ?>
        <br class="bc"/>
        <b>Select Package</b>
        <div id="tree" style="height: 400px;overflow: auto;border: 1px solid #dddddd;padding-left: 10px;margin-top: 3px"></div>
        <br>
    </div>


    <div id="ctg" class="tab-pane">

        <?php echo \WPDM\admin\menus\Templates::Dropdown(array('id' => 'lnk_tpl', 'css' => 'min-width: 298px;')); ?>

        <select id="ipp" style="padding: 5px;margin-right: 5px">
            <option value="10">Items Per Page</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="30">30</option>
        </select>
        <select id="cols" style="padding: 5px;margin-right: 5px">
            <option value="1">Columns</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select><br><br>

        <b>Select Categories</b><br class="bc">
        <ul id="wpdmcats">
            <?php
            wpdm_cblist_categories();
            ?>
        </ul>
        <br/>

        <label><input type="checkbox" value="1" id="ctitle"> Show Toolbar &nbsp; </label>
        <label><input type="checkbox" value="1" id="cdesc"> Show Category Description</label>
        <br class="bc">
        <br class="bc">

        <input type="submit" id="addtopostc" class="btn btn-primary" name="addtopost" value="Insert into post"/>
    </div>


    <div id="qbtn" class="tab-pane">
    <form action="admin-ajax.php" id="wpdm-pf" method="post">
    <input type="hidden" name="action" value="quick_add_package"/>
    <input type="hidden" name="file[access][]" value="guest"/>
    <input type="hidden" name="file[page_template]" value="page-template-default.php"/>
    <input type="hidden" name="file[icon]" value="<?php echo WPDM_BASE_URL.'assets/file-type-icons/download_box.png';?>"/>

        <div class="form-group">
            <input type="text" placeholder="Title" class="form-control input-lg" name="file[post_title]"/>
        </div>
        <div class="row">
            <div class="col-xs-5"><input type="text" id="act" placeholder="Download Link Label" class="form-control" name="file[link_label]" value=""/></div>
            <div class="col-xs-7"><?php echo \WPDM\admin\menus\Templates::Dropdown(array('id' => 'lnk_tpl_', 'name' => 'file[template]')); ?></div>
        </div>

        <div style="clear: both;margin-bottom: 10px"></div>
        <div>
            <div class="panel panel-default">
                <div class="panel-heading">Attached Files</div>
                <ul id="wpdm-files" class="list-group">
                    <li class="list-group-item" id="nfa">No File Attached Yet!</li>
                </ul>
            </div>
            <div id="filelist"></div>


        </div>
        <div class="postbox " id="upload_meta_box">

            <?php //include wpdm_tpl_path('attached-files-front.php', WPDM_BASE_DIR.'tpls/metaboxes/');?>
            <div id="upload">
                <div id="plupload-upload-ui" class="hide-if-no-js">
                    <div id="drag-drop-area">
                        <div class="drag-drop-inside">
                            <p class="drag-drop-info"><?php _e('Drop files here'); ?></p>
                            <p><?php _ex('&mdash; or &mdash;', 'Uploader: Drop files here - or - Select Files'); ?></p>
                            <p class="drag-drop-buttons"><input id="plupload-browse-button" type="button" value="<?php esc_attr_e('Select Files'); ?>" class="btn btn-default btn-sm" /></p>
                        </div>
                    </div>
                </div>

                <?php

                $plupload_init = array(
                    'runtimes'            => 'html5,silverlight,flash,html4',
                    'browse_button'       => 'plupload-browse-button',
                    'container'           => 'plupload-upload-ui',
                    'drop_element'        => 'drag-drop-area',
                    'file_data_name'      => 'package_file',
                    'multiple_queues'     =>  version_compare(WPDM_Version, '4.0.0', '>'),
                    'max_file_size'       => wp_max_upload_size().'b',
                    'url'                 => admin_url('admin-ajax.php'),
                    'flash_swf_url'       => includes_url('js/plupload/plupload.flash.swf'),
                    'silverlight_xap_url' => includes_url('js/plupload/plupload.silverlight.xap'),
                    'filters'             => array(array('title' => __('Allowed Files'), 'extensions' => '*')),
                    'multipart'           => true,
                    'urlstream_upload'    => true,

                    // additional post data to send to our ajax hook
                    'multipart_params'    => array(
                        '_ajax_nonce' => wp_create_nonce('wpdm_admin_upload_file'),
                        'action'      => 'wpdm_admin_upload_file',            // the ajax action name
                    ),
                );

                // we should probably not apply this filter, plugins may expect wp's media uploader...
                $plupload_init = apply_filters('plupload_init', $plupload_init); ?>

                <script type="text/javascript">

                    jQuery(document).ready(function($){

                        // create the uploader and pass the config from above
                        var uploader = new plupload.Uploader(<?php echo json_encode($plupload_init); ?>);

                        // checks if browser supports drag and drop upload, makes some css adjustments if necessary
                        uploader.bind('Init', function(up){
                            var uploaddiv = jQuery('#plupload-upload-ui');

                            if(up.features.dragdrop){
                                uploaddiv.addClass('drag-drop');
                                jQuery('#drag-drop-area')
                                    .bind('dragover.wp-uploader', function(){ uploaddiv.addClass('drag-over'); })
                                    .bind('dragleave.wp-uploader, drop.wp-uploader', function(){ uploaddiv.removeClass('drag-over'); });

                            }else{
                                uploaddiv.removeClass('drag-drop');
                                jQuery('#drag-drop-area').unbind('.wp-uploader');
                            }
                        });

                        uploader.init();

                        // a file was added in the queue
                        uploader.bind('FilesAdded', function(up, files){
                            //var hundredmb = 100 * 1024 * 1024, max = parseInt(up.settings.max_file_size, 10);



                            plupload.each(files, function(file){
                                jQuery('#filelist').append(
                                    '<div class="file" id="' + file.id + '"><b>' +

                                    file.name + '</b> (<span>' + plupload.formatSize(0) + '</span>/' + plupload.formatSize(file.size) + ') ' +
                                    '<div class="progress progress-success progress-striped active"><div class="bar fileprogress"></div></div></div>');
                            });

                            up.refresh();
                            up.start();
                        });

                        uploader.bind('UploadProgress', function(up, file) {

                            jQuery('#' + file.id + " .fileprogress").width(file.percent + "%");
                            jQuery('#' + file.id + " span").html(plupload.formatSize(parseInt(file.size * file.percent / 100)));
                        });


                        // a file was uploaded
                        uploader.bind('FileUploaded', function(up, file, response) {

                            // this is your ajax response, update the DOM with it or something...
                            //console.log(response);
                            //response
                            jQuery('#' + file.id ).remove();
                            var d = new Date();
                            var ID = d.getTime();
                            response = response.response;
                            response = response.split("|||");
                            response = response[1];
                            //var nm = response;
                            //if(response.length>20) nm = response.substring(0,7)+'...'+response.substring(response.length-10);

                            //var html = jQuery('#wpdm-file-entry').html();
                            //var ext = response.split('.');
                            //ext = ext[ext.length-1];
                            //var icon = "<?php echo WPDM_BASE_URL; ?>file-type-icons/"+ext+".png";
                            //html = html.replace(/##filepath##/g, response);
                            //html = html.replace(/##fileindex##/g, ID);
                            //html = html.replace(/##preview##/g, icon);
                            jQuery('#nfa').hide();
                            <?php if(version_compare(WPDM_Version, '4.0.0', '>')){ ?>
                            jQuery('#wpdm-files').prepend("<li class='list-group-item'><input type='hidden' name='file[files][]' value='"+response+"'><i class='fa fa-trash-o text-danger pull-right'></i> "+response+"</li>");
                            <?php } else { ?>
                            jQuery('#wpdm-files').html("<li class='list-group-item'><input type='hidden' name='file[files][]' value='"+response+"'><i class='fa fa-trash-o text-danger pull-right'></i> "+response+"</li>");
                            <?php } ?>


                        });

                    });

                </script>

                <div class="clear"></div>
            </div>
        </div>
        <div class="form-group text-right">
            <button type="submit" class="btn btn-success" id="cpb">Create Package & Insert Shortcode</button>
        </div>

        <div id="sving"
             style="float: right;margin-right:10px;padding-left: 20px;background:url('<?php echo admin_url('images/loading.gif'); ?>') left center no-repeat;display: none;">
            Please Wait...
        </div>

    </form>
    </div>

    <div class="tab-pane" id="osc">
        <div class="panel panel-default">
            <div class="panel-heading"><b>All Packages Table</b></div>

   <div class="panel-body">
        <span class="note" style="color: #777777">if you select one or more categories then short-code will show packaged from selected categories only, otherwise all packages</span>
        <ul id="wpdmacats" style="height: 160px !important;">
            <?php
            wpdm_cblist_categories('', 0);
            ?>
        </ul><Br/>
        <select id="iapp" style="width: 200px">
            <option value="10">Items Per Page</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="30">30</option>
        </select>&nbsp;
    <button class="btn btn-primary" id="ads">Insert to Post</button>
   </div></div>

        <div class="panel panel-default" id="packlist">
            <div class="panel-heading"><b>Package List</b></div>
            <div class="panel-body">


                <div class="row">
                    <div class="col-xs-6"><?php echo \WPDM\admin\menus\Templates::Dropdown(array('id'=>'plnk_tpl_pl')) ?></div>
                    <div class="col-xs-6"><select id="plob" style="margin-right: 5px">
                            <option value="post_title">Order By:</option>
                            <option value="post_title">Title</option>
                            <option value="download_count">Downloads</option>
                            <option value="package_size_b">Package Size</option>
                            <option value="view_count">Views</option>
                            <option value="date">Publish Date</option>
                            <option value="modified">Update Date</option>
                        </select></div>
                    </div><div class="row">
                    <div class="col-xs-6"><select id="plobs" style="margin-right: 5px">
                            <option value="asc">Order:</option>
                            <option value="asc">Asc</option>
                            <option value="desc">Desc</option>
                        </select></div>
                    <div class="col-xs-6"><select id="plpg">
                            <option value="asc">Paging:</option>
                            <option value="1">Show</option>
                            <option value="0">Hide</option>
                        </select></div>
                </div>



                <br style="display: block;clear: both;margin-top: 5px"/>
                <button class="btn btn-primary btn-sm" id="plps">Insert to Post</button>
                <button class="btn btn-default btn-sm" id="plmd">Most Downloads</button>
                <button class="btn btn-default btn-sm" id="plmv">Most Viewed</button>
                <button class="btn btn-default btn-sm" id="plnp">New Packages</button>
                <script>
                    jQuery('#plps').click(function(){

                        var linkt = ' link_template="' + jQuery('#plnk_tpl_pl').val() + '" ';
                        var acob = ' order_by="' + jQuery('#plob').val() + '" order="' + jQuery('#plobs').val() + '"';
                        var paging = ' paging="' + jQuery('#plpg').val() + '"';
                        var win = window.dialogArguments || opener || parent || top;
                        win.send_to_editor('[wpdm_packages' + linkt + acob + paging + ' items_per_page="10" title="" desc="" cols=1 colsphone=1 colspad=1]');
                        tinyMCEPopup.close();
                        return false;
                    });

                    jQuery('#plmd').click(function(){
                        var win = window.dialogArguments || opener || parent || top;
                        win.send_to_editor('[wpdm_packages link_template="link-template-panel" order_by="download_count" order="desc" paging="0" items_per_page="10" cols=1 colsphone=1 colspad=1 title="Most Downloaded Packages" desc=""]');
                        tinyMCEPopup.close();
                        return false;
                    });

                    jQuery('#plmv').click(function(){
                        var win = window.dialogArguments || opener || parent || top;
                        win.send_to_editor('[wpdm_packages link_template="link-template-panel" order_by="view_count" order="desc" paging="0" items_per_page="10" cols=1 colsphone=1 colspad=1 title="Most Viewed Packages" desc=""]');
                        tinyMCEPopup.close();
                        return false;
                    });

                    jQuery('#plnp').click(function(){
                        var win = window.dialogArguments || opener || parent || top;
                        win.send_to_editor('[wpdm_packages link_template="link-template-panel" order_by="date" order="desc" paging="0" items_per_page="10" cols=1 colsphone=1 colspad=1 title="New Packages" desc=""]');
                        tinyMCEPopup.close();
                        return false;
                    });

                </script>
            </div>

        </div>
        <div class="panel panel-default" id="srcpkg">
            <div class="panel-heading"><b>Search Page Shortcode</b></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-5">
                    <?php echo \WPDM\admin\menus\Templates::Dropdown(array('id'=>'srcrs_tpl')); ?>
                    </div>
                    <div class="col-xs-4"><label><input id="rsinit" type="checkbox"> Show Initial Results</label></div>
                    <div class="col-xs-3">
                        <button type="button" class="btn btn-primary" id="ins_srcrs_sc">Insert</button>
                    </div>
                </div>
            </div>

        </div>
        <div class="panel panel-default">
            <div class="panel-heading"><b>Dashboard</b></div>

   <div class="panel-body">

    <button class="btn btn-primary btn-sm" id="fui">[wpdm_frontend] Insert to Post</button>
    <button class="btn btn-success btn-sm" id="uui">[wpdm_user_dashboard] Insert to Post</button>
   </div></div>

        <?php do_action('wpdm_ext_shortcode'); ?>

    </div>

    </div>
    </div>


    <?php
    $treejs = plugins_url() . '/wpdm-tinymce-button/js/jqueryFileTree.js';
    $treecss = plugins_url() . '/wpdm-tinymce-button/css/jqueryFileTree.css';
    $siteurl = site_url();
    $data = <<<TREE
    <script language="JavaScript" src="{$treejs}"></script>
    <link rel="stylesheet" href="{$treecss}" />
TREE;
    echo $data;
    echo wpdm_mce_tree();
    ?>

        <script type="text/javascript">
        jQuery(function(){
            jQuery('select').chosen();
            var cats = '';
            jQuery('#wpdm-pf').submit(function(){
                jQuery('#cpb').html('<i class="fa fa-refresh fa-spin"></i> Please Wait...');
                jQuery(this).ajaxSubmit({
                    success: function(res){
                        jQuery('#cpb').html('Create Package & Insert Shortcode');
                        var win = window.dialogArguments || opener || parent || top;
                        win.send_to_editor(res);
                        tinyMCEPopup.close();
                        return false;
                    }
                });
                return false;
            });
            jQuery('#ads').click(function(){
                var acts = '';
                jQuery('#wpdmacats input[type=checkbox]').each(function () {
                    if (this.checked) acts += jQuery(this).val() + ",";
                });
                cats = acts!=''?'categories="' + acts + '" ':'';
                var win = window.dialogArguments || opener || parent || top;
                win.send_to_editor('[wpdm-all-packages ' + cats + ' items_per_page=' + jQuery('#iapp').val() + ']');
                tinyMCEPopup.close();
                return false;
            });

            jQuery('#fui').click(function () {
                var win = window.dialogArguments || opener || parent || top;
                win.send_to_editor('[wpdm_frontend]');
                tinyMCEPopup.close();
                return false;
            });
            jQuery('#uui').click(function () {
                var win = window.dialogArguments || opener || parent || top;
                win.send_to_editor('[wpdm_user_dashboard]');
                tinyMCEPopup.close();
                return false;
            });

            jQuery('#addtopost').click(function () {
                var win = window.dialogArguments || opener || parent || top;
                var ltpl = jQuery('#plnk_tpl').val()!=""?' template='+jQuery('#plnk_tpl').val():"";
                win.send_to_editor('[wpdm_package id=' + jQuery('#wpdmfile').val() + ltpl + ']');
                tinyMCEPopup.close();
                return false;
            });

            jQuery('#ins_srcrs_sc').click(function () {
                var win = window.dialogArguments || opener || parent || top;
                var ltpl = jQuery('#srcrs_tpl').val()!=""?' template="'+jQuery('#srcrs_tpl').val()+'"':"";
                var rinit = jQuery('#rsinit').prop('checked') ? 'init=1' : '';
                win.send_to_editor('[wpdm_search_result cols=1 ' + rinit +  ltpl + ']');
                tinyMCEPopup.close();
                return false;
            });

            jQuery('#addtopostc').click(function () {
                var cts = '';
                jQuery('#wpdmcats input[type=checkbox]').each(function () {

                    if (this.checked) cts += jQuery(this).val() + ",";
                });
                var win = window.dialogArguments || opener || parent || top;
                if(cts=='') { alert('You must select one or more ctaegories!'); return false; }
                var ctitle = jQuery('#ctitle').prop('checked') ? 'toolbar=1' : 'toolbar=0';
                var cdesc = jQuery('#cdesc').prop('checked') ? 'desc=1' : '';
                win.send_to_editor('[wpdm_category id="' + cts + '" cols="' + jQuery('#cols').val() + '" ' + ctitle + ' ' + cdesc + ' item_per_page=' + jQuery('#ipp').val() + ' template="' + jQuery('#lnk_tpl').val() + '"]');
                tinyMCEPopup.close();
                return false;
            });
            jQuery('#addtoposth').click(function () {
                var win = window.dialogArguments || opener || parent || top;
                win.send_to_editor('[wpdm_direct_link id=' + jQuery('#pid4hl').val() + ' class="btn ' + jQuery('#color').val() + '" data_icon="' + jQuery('#icon').val() + '" link_label="' + jQuery('#hltitle').val() + '" link_slabel="' + jQuery('#hstitle').val() + '"]');
                tinyMCEPopup.close();
                return false;
            });
        });

        </script>

    </div>
    </body></html>

    <?php

    die();
}

function admin_tbcss(){

    ?>
<style>
    .wpdm-mce-ico{
        color: #3399ff !important;
    }
    .wpdm-mce-ico:hover,
    button:hover .wpdm-mce-ico{
        color: #3965ff !important;
    }


</style>
<?php
}

function wpdm_quick_pack(){
    $id = \WPDM\Package::Create($_POST['file']);
    echo "[wpdm_package id='{$id}']";
    die();
}


//add_action('wp_loaded', 'wpdm_tinymce');
add_action('admin_head', 'admin_tbcss');
add_action('wp_ajax_wpdm_tinymce_button', 'wpdm_tinymce');
add_action('wp_ajax_wpdm_tinymce_button', 'wpdm_tinymce');
add_action('wp_ajax_quick_add_package', 'wpdm_quick_pack');
//add_action("admin_enqueue_scripts", "wpdm_mce_enqueue");