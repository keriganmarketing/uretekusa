<?php
global $wpdb, $current_user;
$limit = 20;
 
$_GET['paged'] = isset($_GET['paged'])?(int)$_GET['paged']:1;
$start = isset($_GET['paged'])?(($_GET['paged']-1)*$limit):0;
$field = isset($_GET['sfield'])?$_GET['sfield']:'id';
$ord = isset($_GET['sorder'])?$_GET['sorder']:'desc';
$pid = isset($_GET['pid'])?(int)$_GET['pid']:0;
if($pid > 0) $cond = " and e.pid=$pid";
if(isset($_GET['uniq'])) $group = " group by e.email";

 
?>

<div class="wrap w3eden">
    <div class="panel panel-default" id="wpdm-wrapper-panel">
        <div class="panel-heading">
            <b><i class="fa fa-users color-purple"></i> &nbsp; <?php echo __("Subscribers", "wpdmpro"); ?></b>
            <a style="margin-left: 10px" id="basic" href="edit.php?post_type=wpdmpro&page=wpdm-subscribers&task=export<?php echo (wpdm_query_var('lockOption') != ''?'&lockOption='.wpdm_query_var('lockOption'):''); ?>" class="btn btn-sm btn-default pull-right"><i class="fa fa-table color-green"></i> <?php echo __('Export All','wpdmpro'); ?></a>
            <a id="basic" href="edit.php?post_type=wpdmpro&page=wpdm-subscribers&task=export&uniq=1<?php echo (wpdm_query_var('lockOption') != ''?'&lockOption='.wpdm_query_var('lockOption'):''); ?>" class="btn btn-sm btn-default pull-right"><i class="fa fa-bars color-purple"></i> <?php echo __('Export Unique Emails','wpdmpro'); ?></a>&nbsp;
        </div>

        <ul id="tabs" class="nav nav-tabs nav-wrapper-tabs" style="padding: 60px 10px 0 10px;background: #f5f5f5">
            <li <?php if(wpdm_query_var('lockOption') == 'email' || wpdm_query_var('lockOption') == ''){ ?>class="active"<?php } ?>><a href="edit.php?post_type=wpdmpro&page=wpdm-subscribers&lockOption=email" id="basic"><?php _e('Email Lock','wpdmpro'); ?></a></li>
            <li <?php if(wpdm_query_var('lockOption') == 'google'){ ?>class="active"<?php } ?>><a href="edit.php?post_type=wpdmpro&page=wpdm-subscribers&lockOption=google" id="basic"><?php _e('Google','wpdmpro'); ?></a></li>
            <li <?php if(wpdm_query_var('lockOption') == 'linkedin'){ ?>class="active"<?php } ?>><a href="edit.php?post_type=wpdmpro&page=wpdm-subscribers&lockOption=linkedin" id="basic"><?php _e('LinkedIn','wpdmpro'); ?></a></li>
        </ul>


    <?php
    $lockoption = wpdm_query_var('lockOption');
    $lockoption = $lockoption?$lockoption:'email';
    $lockoption = str_replace(array("/","\\"), "", $lockoption);
    include WPDM_BASE_DIR."/admin/tpls/subscribers/{$lockoption}.php"; ?>

</div>
</div>
<style>
    .dropdown-menu .list-group{
        margin: 0 5px;
        font-size: 8pt;
        border-radius: 0;
    }
    .dropdown-menu .list-group .list-group-item{
        padding: 5px;
        border-radius: 0;
    }
</style>