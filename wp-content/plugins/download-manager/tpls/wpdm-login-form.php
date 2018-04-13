<?php if(!defined('ABSPATH')) die();
global $current_user;

$regurl = get_option('__wpdm_register_url');
if($regurl > 0)
    $regurl = get_permalink($regurl);
$log_redirect =  $_SERVER['REQUEST_URI'];
if(isset($params['redirect'])) $log_redirect = esc_url($params['redirect']);
if(isset($_GET['redirect_to'])) $log_redirect = esc_url($_GET['redirect_to']);

$up = parse_url($log_redirect);
if(isset($up['host']) && $up['host'] != $_SERVER['SERVER_NAME']) $log_redirect = $_SERVER['REQUEST_URI'];

$log_redirect = esc_attr(esc_url($log_redirect));

?>
<div class="w3eden">
<div id="wpdmlogin">
<?php if(isset($params['logo']) && $params['logo'] != '' && !is_user_logged_in()){ ?>
    <div class="text-center wpdmlogin-logo">
        <img src="<?php echo $params['logo'];?>" />
    </div>
<?php } ?>

    <?php if(isset($_SESSION['reg_warning'])&&$_SESSION['reg_warning']!=''): ?>  <br>

        <div class="alert alert-warning" align="center" style="font-size:10pt;">
            <?php echo $_SESSION['reg_warning']; unset($_SESSION['reg_warning']); ?>
        </div>

    <?php endif; ?>

    <?php if(isset($_SESSION['sccs_msg'])&&$_SESSION['sccs_msg']!=''): ?><br>

        <div class="alert alert-success" align="center" style="font-size:10pt;">
            <?php echo $_SESSION['sccs_msg'];  unset($_SESSION['sccs_msg']); ?>
        </div>

    <?php endif; ?>
    <?php if(is_user_logged_in()){
        ob_start();
        ?>
        <div class="media">
            <div class="pull-left">
                <?php echo get_avatar($current_user->ID, 64); ?>
            </div>
            <div class="media-body">

                <?php echo sprintf(__("Welcome, %s","wpdmpro"), $current_user->display_name)."<br style='clear:both;display:block;margin-top:10px'/> <a class='btn btn-xs btn-primary' href='".get_permalink(get_option('__wpdm_user_dashboard'))."'>".__("Dashboard","wpdmpro")."</a>  <a class='btn btn-xs btn-danger' href='".wpdm_logout_url()."'>".__("Logout","wpdmpro")."</a>"; ?>

            </div>
        </div>
        <?php
        $message = ob_get_clean();
        do_action("wpdm_user_logged_in", $message);

    } else {


        if(wpdm_query_var('action') != 'lostpassword' && wpdm_query_var('action') != 'rp'){
        ?>

        <?php do_action("wpdm_before_login_form"); ?>
        <form name="loginform" id="loginform" action="" method="post" class="login-form" >

            <input type="hidden" name="permalink" value="<?php the_permalink(); ?>" />

            <?php global $wp_query; if(isset($_SESSION['login_error'])&&$_SESSION['login_error']!='') {  ?>
                <div class="error alert alert-danger" >
                    <b><?php _e('Login Failed!','wpdmpro'); ?></b><br/>
                    <?php echo preg_replace("/<a.*?<\/a>\?/i","",$_SESSION['login_error']); $_SESSION['login_error']=''; ?>
                </div>
            <?php } ?>
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-user"></i></span>
                    <input placeholder="<?php _e('Username or Email','wpdmpro'); ?>" type="text" name="wpdm_login[log]" id="user_login" class="form-control input-lg required text" value="" size="20" tabindex="38" />
                </div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-key"></i></span>
                    <input type="password" placeholder="<?php _e('Password','wpdmpro'); ?>" name="wpdm_login[pwd]" id="user_pass" class="form-control input-lg required password" value="" size="20" tabindex="39" />
                </div>
            </div>

            <?php do_action("wpdm_login_form"); ?>
            <?php do_action("login_form"); ?>

            <div class="row" style="margin-bottom: 10px">
                <div class="col-md-6"><label class="eden-checkbox"><input name="rememberme" type="checkbox" id="rememberme" value="forever" /><span><i class="fa fa-check"></i></span> <?php _e('Remember Me','wpdmpro'); ?></label></div>
                <div class="col-md-6"><small class="pull-right"><?php _e('Forgot Password?','wpdmpro'); ?> <a href="<?php echo wpdm_lostpassword_url(); ?>"><?php _e('Request New','wpdmpro'); ?></a></small></div>
            </div>
            <div class="row">
                <div class="col-md-<?php echo ($regurl != '')?6:12; ?>"><button type="submit" name="wp-submit" id="loginform-submit" class="btn btn-block btn-primary btn-lg"><i class="fa fa-key"></i> &nbsp;<?php _e('Login','wpdmpro'); ?></button></div>
                <?php if($regurl != ''){ ?>
                <div class="col-md-6"><a href="<?php echo $regurl; ?>" name="wp-submit" id="loginform-submit" class="btn btn-block btn-default btn-lg"><i class="fa fa-user-plus"></i> &nbsp;<?php _e('Register','wpdmpro'); ?></a></div>
                <?php } ?>
            </div>

            <input type="hidden" name="redirect_to" value="<?php echo isset($log_redirect)?$log_redirect:$_SERVER['REQUEST_URI']; ?>" />



        </form>
        <?php do_action("wpdm_after_login_form"); ?>


        <script>
            jQuery(function ($) {
                var llbl = $('#loginform-submit').html();
                $('#loginform').submit(function () {
                    $('#loginform-submit').html("<i class='fa fa-spin fa-spinner'></i> Logging In...");
                    $(this).ajaxSubmit({
                        success: function (res) {
                            if (!res.match(/success/)) {
                                $('form .alert-danger').hide();
                                $('#loginform').prepend("<div class='alert alert-danger'><b>Error!</b><br/>Login failed! Please re-check login info.</div>");
                                $('#loginform-submit').html(llbl);
                            } else {
                                location.href = "<?php echo esc_attr($log_redirect); ?>";
                            }
                        }
                    });
                    return false;
                });

                $('body').on('click', 'form .alert-danger', function(){
                    $(this).slideUp();
                });

            });
        </script>

    <?php } else {


        if(wpdm_query_var('action') == 'lostpassword'){
        ?>
        <form name="loginform" id="resetPassword" action="<?php echo admin_url('/admin-ajax.php?action=resetPassword'); ?>" method="post" class="login-form" >
            <?php wp_nonce_field(NONCE_KEY,'__reset_pass' ); ?>
            <h3><?php _e('Lost Password?', 'wpdmpro'); ?></h3>
            <p>
                <?php _e('Please enter your username or email address. You will receive a link to create a new password via email.', 'wmdpro'); ?>
            </p>
            <div class="form-group">
                <input placeholder="<?php _e('Username or Email','wpdmpro'); ?>" type="text" name="user_login" id="user_login" class="form-control input-lg required text" value="" size="20" tabindex="38" />
            </div>

            <div class="row">
                <div class="col-md-12"><button type="submit" name="wp-submit" id="resetPassword-submit" class="btn btn-block btn-primary btn-lg"><i class="fa fa-key"></i> &nbsp; <?php _e('Reset Password','wpdmpro'); ?></button></div>
            </div>

        </form>
        <script>
            jQuery(function ($) {
                var llbl = $('#resetPassword-submit').html();
                $('#resetPassword').submit(function () {
                    $('#resetPassword-submit').html("<i class='fa fa-spin fa-spinner'></i> Please Wait...");
                    $(this).ajaxSubmit({
                        success: function (res) {

                            if (res.match(/error/)) {
                                $('form .alert').hide();
                                $('#resetPassword').prepend("<div class='alert alert-danger'><b><?php _e("Error!", "wpdmpro"); ?></b><br/><?php _e("Account not found.", "wpdmpro"); ?></div>");
                                $('#resetPassword-submit').html(llbl);
                            } else {
                                $('form .alert').hide();
                                $('#resetPassword').prepend("<div class='alert alert-success'><b><?php _e("Mail Sent!", "wpdmpro"); ?></b><br/><?php _e("Please check your inbox.", "wpdmpro"); ?></div>");
                                $('#resetPassword-submit').html(llbl);
                            }
                        }
                    });
                    return false;
                });

                $('body').on('click', 'form .alert-danger', function(){
                    $(this).slideUp();
                });

            });
        </script>
    <?php }

            if(wpdm_query_var('action') == 'rp'){

                $user = check_password_reset_key(wpdm_query_var('key'), wpdm_query_var('login'));
                if(!is_wp_error($user)){
                    $_SESSION['__up_user'] = $user;

    ?>

                <form name="loginform" id="updatePassword" action="<?php echo admin_url('/admin-ajax.php?action=updatePassword'); ?>" method="post" class="login-form" >
                    <?php wp_nonce_field(NONCE_KEY,'__update_pass' ); ?>
                    <h3><?php _e('New Password', 'wpdmpro'); ?></h3>
                    <p>
                        <?php _e('Please enter a new password', 'wmdpro'); ?>
                    </p>
                    <div class="form-group">
                        <input placeholder="<?php _e('New Password','wpdmpro'); ?>" type="password" name="password" id="password" class="form-control input-lg required text" value="" size="20" />
                    </div>

                    <div class="form-group">
                        <input placeholder="<?php _e('Confirm Password','wpdmpro'); ?>" type="password" name="cpassword" id="cpassword" class="form-control input-lg required text" value="" size="20" />
                    </div>

                    <div class="row">
                        <div class="col-md-12"><button type="submit" name="wp-submit" id="updatePassword-submit" class="btn btn-block no-radius btn-success btn-lg"><i class="fa fa-key"></i> &nbsp; <?php _e('Update Password','wpdmpro'); ?></button></div>
                    </div>

                </form>

        <script>
            jQuery(function ($) {
                var llbl = $('#updatePassword-submit').html();
                $('#updatePassword').submit(function () {
                    if($('#password').val() != $('#cpassword').val()) {
                        alert('<?php _e("Confirm password value must be same as the new password", "wpdmpro"); ?>')
                        return false;
                    }
                    $('#updatePassword-submit').html("<i class='fa fa-spin fa-spinner'></i> Please Wait...");
                    $(this).ajaxSubmit({
                        success: function (res) {

                            $('#updatePassword').html("<div class='alert alert-success'><b><?php _e("Password Updated", "wpdmpro"); ?></b><br/><a style='margin-top:5px;text-decoration:underline !important;' href='<?php echo wpdm_user_dashboard_url(); ?>'><?php _e("Go to your account dashboard", "wpdmpro"); ?></a></div>");
                            $('#updatePassword-submit').html(llbl);
                        }
                    });
                    return false;
                });

                $('body').on('click', 'form .alert-danger', function(){
                    $(this).slideUp();
                });

            });
        </script>



            <?php } else { ?>

                    <div class="alert alert-danger">
                        <strong>Error!</strong><br/>
                        <?php echo $user->get_error_message(); ?>
                    </div>

                <?php } }

    }} ?>
</div>
</div>
