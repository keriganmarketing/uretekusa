<?php
global $current_user, $wpdb;
?><div class="row">
    <div class="col-md-4">
        <div class="panel panel-default dashboard-panel">
            <div class="panel-heading"><?php _e('User Level','wpdmpro'); ?></div>
            <div class="panel-body">
                <h3><?php
                    $val = get_option( 'wp_user_roles' );
                    $level = $val[$current_user->roles[0]]['name'];
                    $level = $level==''?ucfirst($current_user->roles[0]):$level;
                    echo apply_filters("wpdm_udb_user_level",$level); ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default dashboard-panel">
            <div class="panel-heading"><?php _e('Total Downloads','wpdmpro'); ?></div>
            <div class="panel-body">
                <h3><?php echo number_format($wpdb->get_var("select count(*) from {$wpdb->prefix}ahm_download_stats where uid = '{$current_user->ID}'"),0,'.',','); ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default dashboard-panel">
            <div class="panel-heading"><?php _e("Today's Download",'wpdmpro'); ?></div>
            <div class="panel-body">
                <h3><?php echo number_format($wpdb->get_var("select count(*) from {$wpdb->prefix}ahm_download_stats where uid = '{$current_user->ID}' and `year` = YEAR(CURDATE()) and `month` = MONTH(CURDATE()) and `day` = DAY(CURDATE())"),0,'.',','); ?></h3>
            </div>
        </div>
    </div>
</div>
<?php
if(isset($params['recommended']) && ( term_exists($params['recommended'], 'wpdmcategory') || $params['recommended'] == 'recent')) {
    ?>
    <div class="panel panel-default dashboard-panel">
        <div class="panel-heading"><?php _e('Recommended Downloads', 'wpdmpro'); ?></div>
        <div class="panel-body">
            <div class="panel-row">
                <?php
                $rc = 0;
                $qparams = array(
                    'post_type' => 'wpdmpro',
                    'posts_per_page' => 20,
                    'orderby' => 'rand'
                );

                if($params['recommended'] != 'recent')
                    $qparams['tax_query'] = array(array('taxonomy' => 'wpdmcategory', 'field' => 'slug', 'terms' => $params['recommended']));
                else
                    $qparams['orderby'] = 'date';


                $q = new WP_Query($qparams);
                while ($q->have_posts()) {
                    $q->the_post();
                    if (\WPDM\Package::userCanAccess(get_the_ID())) {
                        ?>
                        <div class="col-md-4">
                            <div class="panel panel-default">

                                <div class="panel-body">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php wpdm_post_thumb(array(400, 300)); ?>
                                    </a>
                                </div>
                                <div class="panel-footer">
                                    <a title="<?php the_title(); ?>" class="ttip" href="<?php the_permalink(); ?>" style="display: block;text-overflow: ellipsis;max-width: 100%; white-space: nowrap; overflow: hidden;">
                                        <?php the_title(); ?>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <?php
                        $rc++;
                        if ($rc >= 3) break;
                    }
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
    <?php
}
?>
<?php
if(isset($params['fav']) && (int)$params['fav'] == 1) {
    $myfavs = maybe_unserialize(get_user_meta(get_current_user_id(), '__wpdm_favs', true));
    $template = '<div class="panel panel-default"><div class="panel-body"><div class="media">   <a class="pull-left" href="[page_url]">   [thumb_40x40]   </a>   <div class="media-body">   <strong style="font-weight: bold">[page_link]</strong><br/>[file_size]</div></div></div><div class="panel-footer">[fav_button_sm]</div></div>';
    ?>
    <div class="panel panel-default dashboard-panel">
        <div class="panel-heading"><?php _e('My Favourites', 'wpdmpro'); ?></div>

            <table class="table">
                <thead>
                <tr>
                    <th><?php _e('Package Name','wpdmpro'); ?></th>
                    <th width="50px"><?php _e('Remove','wpdmpro'); ?></th>
                </tr>
                </thead>

                <tbody>
                    <?php if(is_array($myfavs)) foreach ($myfavs as $fav){ $fav_post = get_post($fav); if(is_object($fav_post) && $fav_post->post_type == 'wpdmpro'){ ?>

                            <?php //echo \WPDM\Package::fetchTemplate($template, array('ID' => $fav)); ?>
                        <tr id="fav_<?php echo $fav; ?>">
                            <td><a target="_blank" href="<?php echo get_permalink($fav_post->ID); ?>"><?php echo $fav_post->post_title; ?></a></td>
                            <td class="text-right"><?php echo \WPDM\Package::favBtn($fav, array('size' => 'btn-xs rem-fav fav_'.$fav, 'a2f_label' => "<i class='fa fa-trash-o'></i>", 'rff_label' => "<i class='fa fa-trash-o'></i>")); ?></td>
                        </tr>

                    <?php
                    }}
                    wp_reset_postdata();
                    ?>
                </tbody>
            </table>

    </div>
    <?php
}
?>
<div class="panel panel-default dashboard-panel">
    <div class="panel-heading"><?php _e('Last 5 Downloads','wpdmpro'); ?></div>
    <table class="table">
        <thead>
        <tr>
            <th><?php _e('Package Name','wpdmpro'); ?></th>
            <th><?php _e('Download Time','wpdmpro'); ?></th>
            <th><?php _e('IP','wpdmpro'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $res = $wpdb->get_results("select p.post_title,s.* from {$wpdb->prefix}posts p, {$wpdb->prefix}ahm_download_stats s where s.uid = '{$current_user->ID}' and s.pid = p.ID order by `timestamp` desc limit 0,5");
        foreach($res as $stat){
            ?>
            <tr>
                <td><a href="<?php echo get_permalink($stat->pid); ?>"><?php echo $stat->post_title; ?></a></td>
                <td><?php echo date_i18n(get_option('date_format')." H:i",$stat->timestamp); ?></td>
                <td><?php echo $stat->ip; ?></td>
            </tr>
            <?php
        }
        ?>

        </tbody>
    </table>
</div>
<script>
    jQuery(function ($) {
        $('.rem-fav').on('click', function () {
            var ret = $(this).attr('class').match(/fav_([0-9]+)/);
            if(ret[0] != undefined && ret[0] == 'fav_'+ret[1])
                $('#'+ret[0]).slideUp();
        });
    })
</script>
