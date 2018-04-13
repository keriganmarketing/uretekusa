<div class="w3eden author-dashbboard">
    <?php if (is_user_logged_in()) {

        $menu_url = get_permalink(get_the_ID()).$sap.'adb_page=%s';

        if(isset($params['flaturl']) && $params['flaturl'] == 1)
            $menu_url = rtrim(get_permalink(get_the_ID()), '/').'/%s/';

        $store = get_user_meta(get_current_user_id(), '__wpdm_public_profile', true);

    ?>
<div class="row">
    <div class="col-md-2" id="wpdm-dashboard-sidebar">
    <?php if(isset($store['logo']) && $store['logo'] != ''){ ?>
        <img style="margin-bottom: 5px" class="thumbnail" src="<?php echo $store['logo']; ?>"/>
    <?php } ?>

    <div id="tabs" class="list-group" style="margin: 0;padding: 0">
        <a class="list-group-item <?php if ($task == '' || $task == 'edit-package') { ?>active<?php } ?>" href="<?php echo $burl; ?>"><?php _e('All Items','wpdmpro'); ?></a>
        <a class="list-group-item <?php if ($task == 'add-new') { ?>active<?php } ?>" href="<?php echo sprintf("$menu_url", "add-new"); ?>"><?php _e('Add New','wpdmpro'); ?></a>
        <?php foreach ($tabs as $tid => $tab): ?>
            <a class="list-group-item <?php if ($task == $tid) { ?>active<?php } ?>" href="<?php echo sprintf("$menu_url", $tid); ?>"><?php echo $tab['label']; ?></a>
        <?php endforeach; ?>
        
        <a class="list-group-item <?php if ($task == 'edit-profile') { ?>active<?php } ?>" href="<?php echo sprintf("$menu_url", "edit-profile"); ?>"><?php _e('Edit Public Profile','wpdmpro'); ?></a>

        <a class="list-group-item <?php if ($task == 'settings') { ?>active<?php } ?>" href="<?php echo sprintf("$menu_url", "settings"); ?>"><?php _e('Settings','wpdmpro'); ?></a>
        <a class="list-group-item" href="<?php echo wpdm_logout_url(); ?>"><?php _e('Logout','wpdmpro'); ?></a>
    </div>

    </div>
    <div class="col-md-10">

<?php

    if ($task == 'add-new' || $task == 'edit-package')
        include(wpdm_tpl_path('wpdm-add-new-file-front.php'));
    else if ($task == 'edit-profile')
        include(wpdm_tpl_path('wpdm-edit-user-profile.php'));
    else if ($task == 'settings')
       echo do_shortcode("[wpdm_author_settings]");
    else if ($task != '' && isset($tabs[$task]['callback']) && $tabs[$task]['callback'] != '')
        call_user_func($tabs[$task]['callback']);
    else if ($task != '' && isset($tabs[$task]['shortcode']) && $tabs[$task]['shortcode'] != '')
        echo do_shortcode($tabs[$task]['shortcode']);
    else
        include(wpdm_tpl_path('list-packages-table.php'));
?>

    </div>
    </div>
        <?php
} else {

    include(wpdm_tpl_path('wpdm-be-member.php'));
}
?>

    <script>jQuery(function($){ $("#tabs > li > a").click(function(){ location.href=this.href; });  });</script>

<?php if (is_user_logged_in()) echo "</div>";


