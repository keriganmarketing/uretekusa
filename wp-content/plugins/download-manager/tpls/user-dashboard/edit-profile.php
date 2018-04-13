<?php
global $current_user, $wpdb;
$user = get_userdata($current_user->ID);


?>

    <div id="edit-profile-form">

        <?php if(isset($_SESSION['member_error'])){ ?>
            <div class="alert alert-error"><b><?php _e('Save Failed!', 'wpdmpro');?></b><br/><?php echo implode('<br/>',$_SESSION['member_error']); unset($_SESSION['member_error']); ?></div>
        <?php } ?>
        <?php if(isset($_SESSION['member_success'])){ ?>
            <div class="alert alert-success"><b><?php _e('Done!', 'wpdmpro');?>Done!</b><br/><?php echo $_SESSION['member_success']; unset($_SESSION['member_success']); ?></div>
        <?php } ?>


        <form method="post" id="edit_profile" name="contact_form" action="" class="form">
            <div class="panel panel-default dashboard-panel">
            <div class="panel-heading"><?php _e('Basic Profile','wpdmpro'); ?></div>
                <div class="panel-body">
            <div class="row">
                <div class="col-md-6"><label for="name"><?php _e('Display name:', 'wpdmpro');?> </label><input type="text" class="required form-control" value="<?php echo $user->display_name;?>" name="wpdm_profile[display_name]" id="name"></div>
                <div class="col-md-6"><label for="payment_account"><?php _e('PayPal Email:', 'wpdmpro');?></label><input type="text" value="<?php echo get_user_meta($user->ID,'payment_account',true); ?>" class="form-control" name="payment_account" id="payment_account"> </div>

                <div class="col-md-6"><label for="username"><?php _e('Username:', 'wpdmpro');?></label><input type="text" class="required form-control" value="<?php echo $user->user_login;?>" id="username" readonly="readonly"></div>
                <div class="col-md-6"><label for="email"><?php _e('Email:', 'wpdmpro');?></label><input type="text" class="required form-control" value="<?php echo $user->user_email;?>" id="email" readonly="readonly"></div>

                <div class="col-md-6"><label for="new_pass"><?php _e('New Password:', 'wpdmpro');?> </label><input placeholder="<?php _e('Use nothing if you don\'t want to change old password', 'wpdmpro');?>" type="password" class="form-control" value="" name="password" id="new_pass"> </div>
                <div class="col-md-6"><label for="re_new_pass"><?php _e('Re-type New Password:', 'wpdmpro');?> </label><input type="password" value="" class="form-control" name="cpassword" id="re_new_pass"> </div>


                <?php do_action('wpdm_update_profile_filed_html', $user); ?>


                <div class="col-md-12 wpdm-clear"><label for="message"><?php _e('Description:', 'wpdmpro');?></label><textarea class="text form-control" cols="40" rows="8" name="wpdm_profile[description]" id="message"><?php echo htmlspecialchars(stripslashes($current_user->description));?></textarea></div>


            </div>
            </div>
            </div>

            <?php do_action("wpdm_edit_profile_form"); ?>

            <div class="row">
                <div class="col-md-12 wpdm-clear"><button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;<?php _e('Save Changes', 'wpdmpro');?></button></div>
            </div>


        </form>
    </div>
