<?php
/**
 * User: shahnuralam
 * Date: 5/7/17
 * Time: 2:19 AM
 */
global $wpdb;
if(!defined('ABSPATH')) die('!');
?>
<div class="w3eden">
<div class="list-group" style="margin: 0">

    <div class="list-group-item">
        <span class="badge pull-right"><?php $packs = wp_count_posts('wpdmpro'); echo $packs->publish; ?></span>
        <?php _e('Total Packages','wpdmpro'); ?>
    </div>

    <div class="list-group-item">
        <span class="badge pull-right"><?php echo $wpdb->get_var("select sum(meta_value) from {$wpdb->prefix}postmeta where meta_key='__wpdm_download_count'"); ?></span>
        <?php _e('Total Downloads','wpdmpro'); ?>
    </div>
    <div class="list-group-item">
        <span class="badge pull-right"><?php echo wp_count_terms('wpdmcategory'); ?></span>
        <?php _e('Total Categories','wpdmpro'); ?>
    </div>
    <div class="list-group-item">
        <span class="badge pull-right"><?php echo count($wpdb->get_results("select count(email) from {$wpdb->prefix}ahm_emails group by email")); ?></span>
        <?php _e('Total Subscribers','wpdmpro'); ?>
    </div>
    <div class="list-group-item">
        <span class="badge pull-right"><?php $s = strtotime(date("Y-m-d 0:0:0"));
            $e = time();
            echo count($wpdb->get_results("select count(email) from {$wpdb->prefix}ahm_emails where date > $s and date < $e group by email")); ?></span>
        <?php _e('Subscribed Today','wpdmpro'); ?>
    </div>

</div>
</div>
