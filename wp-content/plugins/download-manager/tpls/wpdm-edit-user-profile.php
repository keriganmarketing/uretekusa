<?php
global $current_user;
if(!defined('ABSPATH')) die('!');
$store = get_user_meta(get_current_user_id(), '__wpdm_public_profile', true);

?><form method="post" id="edit_profile" name="edit-profile" action="" class="form">
    <div class="panel panel-default dashboard-panel">
        <div class="panel-heading">
            <a target="_blank" href="<?php echo get_option('__wpdm_author_profile') > 0?get_permalink(get_option('__wpdm_author_profile'))."?user=".$current_user->user_login:get_author_posts_url($current_user->ID);?>" class="btn btn-link pull-right" style="margin: 0;"><?php _e('View Profile','wpdmpro'); ?></a>
            <?php _e('Public Profile Info','wpdmpro'); ?>
        </div>
        <div class="panel-body">

            <div class="form-group">
                <label><?php _e("Title", "wpdmpro"); ?></label>
                <input type="text" value="<?php if (isset($store['title'])) echo $store['title']; ?>" placeholder="" id="" name="__wpdm_public_profile[title]" class="form-control">
            </div>
            <div class="form-group">
                <label><?php _e("Short Intro", "wpdmpro"); ?></label>
                <input type="text" value="<?php if (isset($store['intro'])) echo $store['intro']; ?>" placeholder="" id="" name="__wpdm_public_profile[intro]" class="form-control">
            </div>
            <div class="form-group">
                <label for="store-logo"><?php _e('Logo URL','wpdmpro'); ?></label>
                <div class="input-group">
                    <input type="text" name="__wpdm_public_profile[logo]" id="store-logo" class="form-control" value="<?php echo isset($store['logo']) ? $store['logo'] : ''; ?>"/>
                    <span class="input-group-btn">
                        <button class="btn btn-default wpdm-media-upload" type="button" rel="#store-logo"><i class="fa fa-picture-o"></i></button>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="store-banner"><?php _e('Banner URL','wpdmpro'); ?></label>
                <div class="input-group">
                    <input type="text" name="__wpdm_public_profile[banner]" id="store-banner" class="form-control" value="<?php echo isset($store['banner']) ? $store['banner'] : ''; ?>"/>
                    <span class="input-group-btn">
                        <button class="btn btn-default wpdm-media-upload" type="button" rel="#store-banner"><i class="fa fa-picture-o"></i></button>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="store-banner"><?php _e('Profile Header Text Color','wpdmpro'); ?></label>

                    <input type="text" name="__wpdm_public_profile[txtcolor]" id="store-banner" class="form-control" value="<?php echo isset($store['txtcolor']) ? $store['txtcolor'] : '#333333'; ?>"/>

            </div>
            <div class="form-group">
                <label><?php _e("Description", "wpdmpro"); ?></label>
                <textarea type="text" data-placeholder="<?php _e("Description", "wpdmpro"); ?>" id="" name="__wpdm_public_profile[description]" class="form-control"><?php if (isset($store['description'])) echo $store['description']; ?></textarea>
            </div>
        </div>
        <div class="panel-footer text-right">
            <button id="edit_profile_btn" style="width:150px;" type="submit" data-value="<?php _e("Save Changes", "wpdmpro"); ?>" class="btn btn-inverse"><i class="fa fa-save icon-white"></i> <?php _e("Save Changes", "wpdmpro"); ?></button>
        </div>
    </div></form>
<style>
    .supports-drag-drop{ z-index: 99999999 !important; }
</style>
<script>
    jQuery(function ($) {

        $('#edit_profile').submit(function (e) {
            e.preventDefault();
            $('#edit_profile_btn').html("<i class='fa fa-spinner fa-spin'></i> Please Wait...");
            $(this).ajaxSubmit({
                url: '<?php echo admin_url('admin-ajax.php?action=wpdm_update_public_profile') ?>',
                success: function (res) {
                    $('#edit_profile_btn').html("<i class='fa fa-save'></i> "+$('#edit_profile_btn').data('value'));
                }
            });
        });
    });
</script>
