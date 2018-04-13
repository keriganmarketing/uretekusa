<?php if(!defined('ABSPATH')) die();

$uid = $user->ID;
$store = get_user_meta($uid, '__wpdm_public_profile', true);
$store['logo'] = isset($store['logo'])?$store['logo']:get_avatar_url($uid);
$store['title'] = isset($store['title']) && $store['title'] != '' ? $store['title'] : $user->display_name;
$store['intro'] = isset($store['intro']) && $store['intro'] != '' ? $store['intro'] : '';
$store['description'] = isset($store['description']) && $store['description'] != '' ? $store['description'] : '';
$store['banner'] = isset($store['banner']) && $store['banner'] != '' ? $store['banner'] : '';
$store['txtcolor'] = isset($store['txtcolor']) && $store['txtcolor'] != '' ? $store['txtcolor'] : '#333333';
$myfavs = maybe_unserialize(get_user_meta($uid, '__wpdm_favs', true));
$ps = isset($_GET['ps']) && $_GET['ps'] != ''?"&s=".esc_attr($_GET['ps']):'';
$pgd = isset($_GET['pg']) && $_GET['pg'] != ''?"&paged=".esc_attr($_GET['pg']):'';
$q = new WP_Query("post_type=wpdmpro&post_status=publish&posts_per_page={$items_per_page}{$pgd}&author=".$user->ID.$ps); ;

?>
<div class="w3eden">

    <div class="row">
        <div class="col-md-12">
            <div id="profile-header">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="media" style="margin: 10px">
                            <div class="pull-left">
                                <img style="max-width: 128px;border-radius: 500px" src="<?php echo $store['logo']; ?>" />
                            </div>
                            <div class="media-body">
                                <h3 id="profile-title"><?php echo $store['title']; ?></h3>
                                <?php echo $store['intro']; ?>
                                 <br/>
                                    <small><?php echo $store['description']; ?></small>

                            </div>
                        </div>

                    </div>
                    <div class="panel-footer">
                        <!-- Nav tabs -->
                        <ul class="nav nav-pills" role="tablist">
                            <?php if($q->post_count > 0){ ?>
                                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-download"></i> &nbsp;<?php _e('Downloads', 'wpdmpro'); ?></a></li>
                            <?php } ?>
                            <!-- li role="presentation" <?php if($q->post_count == 0) echo 'class="active"'; ?>><a href="#activities" aria-controls="activities" role="tab" data-toggle="tab"><i class="fa fa-bars"></i> &nbsp; <?php _e('Activities', 'wpdmpro'); ?></a></li -->
                            <li role="presentation"><a href="#favourites" aria-controls="favourites" role="tab" data-toggle="tab"><i class="fa fa-heart"></i> &nbsp; <?php _e('Favourites', 'wpdmpro'); ?></a></li>
                            <li class="pull-right">
                                <form>
                                <div class="input-group" style="border-radius: 500px !important;background: #ffffff;overflow: hidden;width:180px;">
                                <input type="search" value="<?php echo isset($_GET['ps']) && $_GET['ps'] != ''?esc_attr($_GET['ps']):''; ?>" class="form-control input-sm" name="ps" style="width: 150px;border: 0" />
                                    <div class="input-group-addon" style="font-size: 10pt;background: #ffffff;border: 0;padding: 8px 10px"><i class="fa fa-search"></i></div>
                                </div>
                                </form>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="profile-body">


                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <div class="row">
                            <?php

                            while ($q->have_posts()){ $q->the_post();
                                global $post;
                            if(wpdm_user_has_access(get_the_ID())){
                                ?>

                                <div class="col-md-<?php echo $cols; ?>">
                                    <?php echo \WPDM\Package::fetchTemplate($template, (array)$post); ?>
                                </div>

                                <?php
                            }}
                            ?>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php

                                global $wp_rewrite;
                                wpdm_query_var('pg') > 1 ? $current = wpdm_query_var('pg') : $current = 1;

                                $pagination = array(
                                    'base' => @add_query_arg('pg','%#%'),
                                    'format' => '',
                                    'total' => $q->max_num_pages,
                                    'current' => $current,
                                    'show_all' => false,
                                    'type' => 'list',
                                    'prev_next'    => True,
                                    'prev_text' => '<i class="icon icon-angle-left"></i> Previous',
                                    'next_text' => 'Next <i class="icon icon-angle-right"></i>',
                                );


                                if( !empty($q->query_vars['ps']) )
                                    $pagination['add_args'] = array('s'=>wpdm_query_var('ps'));

                                echo '<div class="text-center">' . str_replace('<ul class=\'page-numbers\'>','<ul class="pagination pagination-centered page-numbers">', paginate_links($pagination)) . '</div>';

                                ?>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="activities">...</div>
                    <div role="tabpanel" class="tab-pane" id="favourites">

                        <div class="row">
                            <?php if(is_array($myfavs)) foreach ($myfavs as $fav){

                                if(wpdm_user_has_access($fav)){

                                ?>
                                <div class="col-md-<?php echo $cols; ?>"><?php echo \WPDM\Package::fetchTemplate($template, array('ID' => $fav)); ?></div>
                            <?php }} ?>
                        </div>

                </div>

            </div>
        </div>
    </div>

</div>

</div>
<style>

    #profile-header .panel{
        background: rgba(62, 42, 247, 0.27) url("<?php echo $store['banner'] ?>");

        border: 0;
    }

    #profile-header .panel h3#profile-title{
        margin-top: 20px;
    }
    #profile-header .panel-footer{
        background: rgba(255,255,255,0.7);
        border: 0;
    }

    #profile-header .panel .media-body{
        padding-left: 15px;
        color: <?php echo $store['txtcolor']; ?>;
    }

    #profile-header .panel .media-body *{
        color: <?php echo $store['txtcolor']; ?>;
    }

    #profile-header .nav-pills{
        padding: 0 !important;
    }
    #profile-header .nav-pills li{
        border: 0 !important;
        padding: 0 !important;

    }

    #profile-header .nav-pills li a{
        border: 0 !important;
        font-size: 8pt;
        font-weight: 400 !important;
        padding: 8px 14px;
        border-radius: 2px !important;
        color: #2C3E50;
    }
    #profile-header .nav-pills li.active a{
        color: #ffffff;
    }
    .w3eden .entry-content .tab-content{
        background: transparent;
        border: 0;
        padding: 0;
    }
</style>