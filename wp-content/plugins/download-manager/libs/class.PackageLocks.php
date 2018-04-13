<?php

namespace WPDM;

global $gp1c, $tbc;


class PackageLocks
{

    public function __construct(){
        global $post;
        //if(has_shortcode($post->post_content, "[wpdm_package]"))
        add_action('wp_enqueue_scripts', array($this, 'Enqueue'));
    }

    function Enqueue(){
       // wp_enqueue_script('wpdm-fb', 'http://connect.facebook.net/en_US/all.js?ver=3.1.3#xfbml=1');
    }

    public static function LinkedInShare($package)
    {

        return "<button class='wpdm-social-lock btn wpdm-linkedin' data-url='".SocialConnect::LinkedinAuthUrl($package['ID'])."'><i class='fa fa-linkedin'></i> Share</button>";


    }

    public static function GooglePlusShare($package){

        $tmpid = "gps_".uniqid();
        $var = md5('li_visitor.' . $_SERVER['REMOTE_ADDR'] . '.' . $tmpid . '.' . md5(get_permalink($package['ID'])));
        $req = home_url('/?pid=' . $package['ID'] . '&var=' . $var);
        $home = home_url('/');
        $force = str_replace("=", "", base64_encode("unlocked|" . date("Ymdh")));
        $href = $package['google_plus_share'];
        $href = $href ? $href : get_permalink($package['ID']);
        $msg = ""; //isset($package['linkedin_message']) && $package['linkedin_message'] !=''? $package['linkedin_message']:$package['post_title'];
        $msg .= " ".$href;
        ob_start();

        ?>

        <!-- Place this tag in your head or just before your close body tag. -->
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <div id="lin_<?php echo $tmpid; ?>"></div>
        <div id="wpdm_dlbtn_<?php echo $tmpid; ?>"></div>
        <!-- Place this tag where you want the share button to render. -->
        <div class="g-plus" data-href="<?php echo $href; ?>" data-action="share" data-onendinteraction="download_file_<?php echo $tmpid; ?>"></div>

        <script>
            function download_file_<?php echo $tmpid; ?>(data) {
                if(data.type != 'confirm') return;
                console.log(data);
                var ctz = new Date().getMilliseconds();
                jQuery.post("<?php echo $home; ?>?nocache="+ctz,{id:<?php echo $package['ID']; ?>,dataType:'json',execute:'wpdm_getlink',force:'<?php echo $force; ?>',social:'l',action:'wpdm_ajax_call'},function(res){
                    if(res.downloadurl!=""&&res.downloadurl!=undefined) {
                        jQuery('#wpdmslb-googleshare-<?php echo $package['ID']; ?>').addClass('wpdm-social-lock-unlocked').html('<a href="'+res.downloadurl+'" class="wpdm-download-button btn btn-inverse btn-block">Download</a>');
                        window.open(res.downloadurl);
                    } else {
                        jQuery("#lin_<?php echo $tmpid; ?>").html(""+res.error);
                    }
                }, "json");
            }
        </script>

        <?php
        $data = ob_get_clean();
        return $data;
    }

    public static function GooglePlusOne($package, $buttononly = false)
    {
        global $gp1c;

        return "<button class='wpdm-social-lock btn wpdm-google-plus' data-url='".SocialConnect::GooglePlusUrl($package['ID'])."'><i class='fa fa-google-plus'></i> Connect</button>";

    }

    public static function TwitterFollow($package){

        return "<button class='wpdm-social-lock btn wpdm-twitter' data-url='".SocialConnect::TwitterAuthUrl($package['ID'], 'follow')."'><i class='fa fa-twitter'></i> Follow</button>";

        ob_start();
        $tmpid = "tf_".uniqid();
        $home = home_url('/');
        $twitter_handle = $package['twitter_handle'];
        $force = str_replace("=", "", base64_encode("unlocked|" . date("Ymdh")));
        ?>
        <div class="wpdm-social-lock-box wpdmslb-twitterfollow" id="wpdmslb-twitterfollow-<?php echo $package['ID']; ?>">
            <div class="placehold wpdmtwitter"><i class="fa fa-twitter"></i></div>
        <div id="lin_<?php echo $tmpid; ?>"></div>
        <div id="wpdm_dlbtn_<?php echo $tmpid; ?>"></div>
        <a href="https://twitter.com/<?php echo $twitter_handle; ?>" class="twitter-follow-button" id="follow-me-<?php echo $package['ID']; ?>" data-pid="<?php echo $package['ID']; ?>" data-show-count="false">Follow @<?php echo $twitter_handle; ?></a>
        <script src="//platform.twitter.com/widgets.js" type="text/javascript"></script>
        <script type="text/javascript">
        if(typeof twttr != 'undefined') {
            twttr.events.bind('follow', function (event) {
                console.log(event);
                var followed_user_id = event.data.user_id;
                var followed_screen_name = event.data.screen_name;
                var pid = localStorage.getItem('tfid');
                var ctz = new Date().getMilliseconds();
                jQuery.post("<?php echo $home; ?>?nocache=" + ctz, {
                    id: pid,
                    dataType: 'json',
                    execute: 'wpdm_getlink',
                    force: '<?php echo $force; ?>',
                    social: 'l',
                    action: 'wpdm_ajax_call'
                }, function (res) {
                    if (res.downloadurl != "" && res.downloadurl != undefined) {
                        jQuery('#wpdmslb-twitterfollow-' + pid).addClass('wpdm-social-lock-unlocked').html('<a href="' + res.downloadurl + '" class="wpdm-download-button btn btn-inverse btn-block">Download</a>');
                        window.open(res.downloadurl);
                    } else {
                        jQuery("#lin_<?php echo $tmpid; ?>").html("" + res.error);
                    }
                }, "json");

            });

            twttr.events.bind(
                'click',
                function (ev) {
                    var pid = jQuery('#'+ev.target.id).parent().attr('id').replace('wpdmslb-twitterfollow-', '');
                    localStorage.setItem('tfid', pid);

                }
            );
        }

        </script>
        </div>
        <?php

        $data = ob_get_clean();
        return $data;
    }

    public static function AskPassword($package){
        ob_start();
        $unqid = uniqid();
        $field_id = $unqid.'_'.$package['ID'];
        ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <?php _e('Enter Correct Password to Download','wpdmpro'); ?>
            </div>
            <div class="panel-body" id="wpdmdlp_<?php echo  $field_id; ?>">
                <div id="msg_<?php echo $package['ID']; ?>" style="display:none;"><?php _e('Processing...','wpdmpro'); ?></div>
                <form id="wpdmdlf_<?php echo $field_id; ?>" method=post action="<?php echo home_url('/'); ?>" style="margin-bottom:0px;">
                    <input type=hidden name="id" value="<?php echo $package['ID']; ?>" />
                    <input type=hidden name="dataType" value="json" />
                    <input type=hidden name="execute" value="wpdm_getlink" />
                    <input type=hidden name="action" value="wpdm_ajax_call" />
                    <div class="input-group input-group-lg">
                        <input type="password"  class="form-control" placeholder="<?php _e('Enter Password','wpdmpro'); ?>" size="10" id="password_<?php echo $field_id; ?>" name="password" />
                        <span class="input-group-btn"><input id="wpdm_submit_<?php echo $field_id; ?>" class="wpdm_submit btn btn-default" type="submit" value="<?php _e('Submit', 'wpdmpro'); ?>" /></span>
                    </div>

                </form>

                <script type="text/javascript">
                    jQuery("#wpdmdlf_<?php echo $field_id; ?>").submit(function(){
                        var ctz = new Date().getMilliseconds();
                        jQuery("#msg_<?php echo  $package['ID']; ?>").html('<div disabled="disabled" class="btn btn-lg btn-info btn-block"><?php _e('Processing...','wpdmpro'); ?></div>').show();
                        jQuery("#wpdmdlf_<?php echo  $field_id; ?>").hide();
                        jQuery(this).removeClass("wpdm_submit").addClass("wpdm_submit_wait");
                        jQuery(this).ajaxSubmit({
                            url: "<?php echo home_url('/?nocache='); ?>" + ctz,
                            success: function(res){

                                jQuery("#wpdmdlf_<?php echo  $field_id; ?>").hide();
                                jQuery("#msg_<?php echo  $package['ID']; ?>").html("verifying...").css("cursor","pointer").show().click(function(){ jQuery(this).hide();jQuery("#wpdmdlf_<?php echo  $field_id; ?>").show(); });
                                if(res.downloadurl!=""&&res.downloadurl!=undefined) {
                                    window.open(res.downloadurl, '_blank');
                                    jQuery("#wpdmdlf_<?php echo  $field_id; ?>").html("<a style='color:#ffffff !important' target='_blank' class='btn btn-success btn-block btn-lg' href='"+res.downloadurl+"'><?php _e('Download','wpdmpro'); ?></a>");
                                    jQuery("#msg_<?php echo  $package['ID']; ?>").hide();
                                    jQuery("#wpdmdlf_<?php echo  $field_id; ?>").show();
                                } else {
                                    jQuery("#msg_<?php echo $package['ID']; ?>").html('<div class="btn btn-lg btn-danger btn-block" style="font-size: 8pt">'+res.error+"</div>");
                                }
                            }
                        });
                        return false;
                    });
                </script>
            </div>
        </div>

        <?php
        $data = ob_get_clean();
        return $data;
    }

    public static  function AskEmail($package)
    {

        $data = '<div class="alert alert-danger">Email Lock Is Not Enabled for This Download!</div>';
        if (isset($package['email_lock']) && $package['email_lock'] == '1') {

            $lock = 'locked';
            $unqid = uniqid();
            $btitle = apply_filters("wpdm_email_lock_heading", __('Subscribe to download', 'wpdmpro'), $package);
            $blabel = isset($package['button_label']) ? $package['button_label'] : __('Download', 'wpdmpro');
            $dlabel =  __('Download Now', 'wpdmpro');
            $eeml =  __('Email Address', 'wpdmpro');
            $intro = isset($package['email_intro']) ? "<p>" . $package['email_intro'] . "</p>" : '';
            $field_id = $unqid.'_'.$package['ID'];
            $data = '
                <div id="emsg_' . $unqid . $package['ID'] . '" class="emsg_' . $unqid . $package['ID'] . '" style="display:none;">'.__('Processing...','wpdmpro').'</div>
               <form id="wpdmdlf_' . $field_id . '" class="wpdmdlf_' . $field_id . '" method=post action="' . home_url('/') . '" style="font-weight:normal;font-size:12px;padding:0px;margin:0px">
                 <div class="panel panel-default">
            <div class="panel-heading">
    ' . $btitle . '
  </div>
  <div class="panel-body">
        ' . $intro . '
        <input type=hidden name="id" value="' . $package['ID'] . '" />
        <input type=hidden name="dataType" value="json" />
        <input type=hidden name="execute" value="wpdm_getlink" />
        <input type=hidden name="verify" value="email" />
        <input type=hidden name="action" value="wpdm_ajax_call" />
        ';
            $html =  wpdm_render_custom_data('', $package['ID']);
            $html = apply_filters('wpdm_render_custom_form_fields', $html, $package['ID']);
            $data .= $html;
            $data .= '
        <label>'.apply_filters("send_download_link_to_label",__('Send Download Link To:','wpdmpro')).'</label>
        <input type="email" required="required" class="form-control group-item email-lock-mail" placeholder="'.$eeml.'" size="20" id="email_' . $field_id . '" name="email" style="margin:5px 0" />



</div><div class="panel-footer text-right"><button id="wpdm_submit_' . $field_id . '" class="wpdm_submit btn btn-success  group-item"  type=submit>'.$blabel.'</button></div></div>
        </form>

        <script type="text/javascript">
        jQuery(function($){
            var sname = localStorage.getItem("email_lock_name");
            var semail = localStorage.getItem("email_lock_mail");

            if(sname != "undefined")
            $(".email-lock-mail").val(semail);
            if(sname != "undefined")
            $(".email-lock-name").val(sname);
        });
        jQuery(".wpdmdlf_' . $field_id . '").submit(function(){
            var paramObj = {};
            localStorage.setItem("email_lock_mail", jQuery("#email_' . $field_id . '").val());
            localStorage.setItem("email_lock_name", jQuery("#wpdmdlf_' . $field_id . ' input.email-lock-name").val());
            jQuery(".emsg_' . $unqid . $package['ID'] . '").removeAttr("style").html("<div style=\'margin:10px 0\' data-title=\''.__('PLEASE WAIT','wpdmpro').'\' class=\'alert alert-info\'><i class=\'fa fa-refresh fa-spin\'></i> '.__('Verifying Request...','wpdmpro').'</div>").show();
            jQuery(".wpdmdlf_' . $field_id . '").hide();
            jQuery.each(jQuery(this).serializeArray(), function(_, kv) {
              paramObj[kv.name] = kv.value;
            });
            var ctz = new Date().getMilliseconds();
            jQuery(this).removeClass("wpdm_submit").addClass("wpdm_submit_wait");
            jQuery(this).ajaxSubmit({
            url: "'.home_url('/?nocache=').'" + ctz,
            success:function(res){
                jQuery(".wpdmdlf_' . $field_id . '").hide();
                jQuery(".emsg_' . $package['ID'] . '").html("<div style=\'margin:10px 0\' data-title=\''.__('PLEASE WAIT','wpdmpro').'\' class=\'alert alert-info\'><i class=\'fa fa-refresh fa-spin\'></i> '.__('Verifying Request...','wpdmpro').'</div>").css("cursor","pointer").show().click(function(){ jQuery(this).hide();jQuery(".wpdmdlf_' . $field_id . '").show(); });
                if(res.downloadurl!=""&&res.downloadurl!=undefined) {
                window.open(res.downloadurl);
                jQuery(".emsg_' . $unqid . $package['ID'] . '").html(res.msg+"<a target=_blank style=\'margin-top:5px;color:#fff !important\' class=\'btn btn-success btn-lg btn-block\' href=\'"+res.downloadurl+"\'>'.$dlabel.'</a>");                
                } else {
                    jQuery(".emsg_' . $unqid . $package['ID'] . '").html("<div style=\'margin:10px 0\'>"+res.error+"</div>");
                }

            }});

        return false;
         });
        </script>

        ';
        }
        return apply_filters("wpdm_email_lock_html", $data);
    }

    public static function Tweet($package){
        return "<button class='wpdm-social-lock btn wpdm-twitter' data-url='".SocialConnect::TwitterAuthUrl($package['ID'])."'><i class='fa fa-twitter'></i> Tweet</button>";
    }

    public static function _Tweet($package, $buttononly = false)
    {
        global $tbc;

        $tbc++;
        $var = md5('tl_visitor.' . $_SERVER['REMOTE_ADDR'] . '.' . $tbc . '.' . md5(get_permalink($package['ID'])));
        $unlock_key = base64_encode(session_id());
        $tweet_message = $package['tweet_message'];
        $dlabel =  __('Download', 'wpdmpro');
        //$href = $href?$href:get_permalink(get_the_ID());
        $tmpid = uniqid();
        //update_post_meta(get_the_ID(),$var,$package['download_url']);
        $force = rtrim(base64_encode("unlocked|" . date("Ymdh")), '=');
        if (isset($_COOKIE[$var]) && $_COOKIE[$var] == 1)
            return $package['download_url'];
        else
            $data = '<div id="tweet_content_' . $package['ID'] . '" class="locked_ct"><a href="https://twitter.com/share?text=' . $tweet_message . '" class="twitter-share-button" data-via="w3eden">Tweet</a></div><div style="clear:both"></div>';
        $req = home_url('/?pid=' . $package['ID'] . '&var=' . $var);
        $home = home_url('/');
        $btitle = isset($package['tweet_heading']) ? $package['tweet_heading'] : __('Tweet to download', 'wpdmpro');
        $intro = isset($package['tweet_intro']) ? "<p>" . $package['tweet_intro'] . "</p>" : '';
        $html = <<<DATA

                <div class="panel panel-default">
            <div class="panel-heading">
    {$btitle}
  </div>
  <div class="panel-body" id="in_{$tmpid}">

                <div id="tl_$tbc" style="max-width:100%;overflow:hidden">
                {$intro}<Br/>
                $data
                </div>


                <script type="text/javascript" src="https://platform.twitter.com/widgets.js"></script>
                <script type="text/javascript">

                if(typeof twttr !== 'undefined'){
                twttr.ready(function (twttr) {

                    twttr.events.bind('tweet', function(event) {
                        console.log(event);
                        var data = {unlock_key : '{$unlock_key}'};
                        var ctz = new Date().getMilliseconds();

                        jQuery.post("{$home}?nocache="+ctz,{id:{$package['ID']},dataType:'json',execute:'wpdm_getlink',force:'$force',social:'t',action:'wpdm_ajax_call'},function(res){
                            if(res.downloadurl!=""&&res.downloadurl!=undefined) {
                            window.open(res.downloadurl);
                            jQuery('#in_{$tmpid}').html('<div style="padding:10px;text-align:center;"><a style="color:#fff" class="btn btn-success" href="'+res.downloadurl+'">{$dlabel}</a></div>');
                            } else {
                                jQuery("#msg_{$package['ID']}").html(""+res.error);
                            }
                    }, "json").error(function(xhr, ajaxOptions, thrownError) {

                        });
                    });

                });}

                </script>

           </div></div>

DATA;

        if($buttononly==true)
            $html = <<<DATA

<div class="placehold wpdmtwitter"><i class="fa fa-twitter"></i></div>
  <div class="labell" id="in_{$tmpid}">


                $data


                <script type="text/javascript" src="https://platform.twitter.com/widgets.js"></script>
                <script type="text/javascript">
                var ctz = new Date().getMilliseconds();

                if(typeof twttr !== 'undefined'){
                twttr.ready(function (twttr) {

                    twttr.events.bind('tweet', function(event) {
                        console.log(event);
                        var data = {unlock_key : '{$unlock_key}'};
                        var ctz = new Date().getMilliseconds();
                        jQuery.post("{$home}?nocache="+ctz,{id:{$package['ID']},dataType:'json',execute:'wpdm_getlink',force:'$force',social:'t',action:'wpdm_ajax_call'},function(res){
                            if(res.downloadurl!=""&&res.downloadurl!=undefined) {
                            window.open(res.downloadurl);
                            jQuery('#wpdmslb-tweet-{$package['ID']}').addClass('wpdm-social-lock-unlocked').html('<a href="'+res.downloadurl+'" class="wpdm-download-button btn btn-inverse btn-block">{$dlabel}</a>');
                            } else {
                                jQuery("#msg_{$package['ID']}").html(""+res.error);
                            }
                    }, "json").error(function(xhr, ajaxOptions, thrownError) {

                        });
                    });

                });}

                </script>

           </div>

DATA;
        return $html;
    }

    public static function FacebookLike($package, $buttononly = false)
    {


        return "<button class='wpdm-social-lock btn wpdm-facebook' data-url='".SocialConnect::FacebookLikeUrl($package['ID'])."'><i class='fa fa-facebook'></i> Like</button>";

        $url = $package['facebook_like'];
        $url = $url ? $url : get_permalink();
        $dlabel =  __('Download', 'wpdmpro');
        $force = str_replace("=", "", base64_encode("unlocked|" . date("Ymdh")));
        //return '<div class="fb-like" data-href="'.$url.'#'.$package['ID'].'" data-send="false" data-width="300" data-show-faces="false" data-font="arial"></div>';
        $unlockurl = home_url("/?id={$package['ID']}&execute=wpdm_getlink&force={$force}&social=f");
        $btitle = isset($package['facebook_heading']) ? $package['facebook_heading'] : __('Like on FB to Download', 'wpdmpro');
        $intro = isset($package['facebook_intro']) ? "<p>" . $package['facebook_intro'] . "</p>" : '';

        if($buttononly==true){
            return '<div id="wpdmslb-facebooklike-'.$package['ID'].'" class="wpdm-social-lock-box wpdmslb-facebooklike">' .'

    <div class="placehold wpdmfacebook"><i class="fa fa-thumbs-up"></i></div>
  <div class="labell">
     <div style="display:none" id="' . strtolower(str_replace(array("://", "/", "."), "", $url)) . '" >' . $package['ID'] . '</div>
     <script>
     var ctz = new Date().getMilliseconds();
            var siteurl = "' . home_url('/?nocache=') . '"+ctz,force="' . $force . '", appid="' . get_option('_wpdm_facebook_app_id', 0) . '";
            window.fbAsyncInit = function() {
                 console.log(FB);
                FB.Event.subscribe(\'edge.create\', function(href) {
                    console.log("FB Like");
                    console.log(href);
                    var id = href.replace(/[^0-9a-zA-Z-]/g,"");
                    id = id.toLowerCase();
                      var pkgid = jQuery(\'#\'+id).html();

                      jQuery.post(siteurl,{id:pkgid,dataType:\'json\',execute:\'wpdm_getlink\',force:force,social:\'f\',action:\'wpdm_ajax_call\'},function(res){
                                            if(res.downloadurl!=\'\'&&res.downloadurl!=\'undefined\'&&res!=\'undefined\') {
                                            window.open(res.downloadurl);
                                            jQuery(\'#wpdmslb-facebooklike-\'+pkgid).addClass(\'wpdm-social-lock-unlocked\').html(\'<a href="\'+res.downloadurl+\'" class="wpdm-download-button btn btn-inverse btn-block">'.$dlabel.'</a>\');
                                            } else {
                                                jQuery(\'#msg_\'+pkgid).html(\'\'+res.error);
                                            }
                                    });
                      return false;
                });
            };

            (function(d, s, id) {
             if(typeof FB != "undefined") return;
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id; /* js.async = true; */
              js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=' . get_option('_wpdm_facebook_app_id', 0) . '";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, \'script\', \'facebook-jssdk\'));
     </script>
     <div class="fb-like" data-href="' . $url . '" data-send="false" data-width="100" data-show-faces="false" data-layout="button_count" data-font="arial"></div>

     <style>.fb_edge_widget_with_comment{ max-height:20px !important; overflow:hidden !important;}</style>
     </div>
     </div>

     ';
        }

        return '
            <div class="panel panel-default">
            <div class="panel-heading">
    ' . $btitle . '
  </div>
  <div class="panel-body">

' . $intro . '<br/>
     <div id="fb-root"></div>
     <div style="display:none" id="' . str_replace(array("://", "/", "."), "", $url) . '" >' . $package['ID'] . '</div>
     <script>
            var siteurl = "' . home_url('/') . '",force="' . $force . '", appid="' . get_option('_wpdm_facebook_app_id', 0) . '";
            window.fbAsyncInit = function() {
               
                FB.Event.subscribe(\'edge.create\', function(href) {
                    var id = href.replace(/[^0-9a-z-]/g,"");
                      var pkgid = jQuery(\'#\'+id).html();

                      jQuery.post(siteurl,{id:pkgid,dataType:\'json\',execute:\'wpdm_getlink\',force:force,social:\'f\',action:\'wpdm_ajax_call\'},function(res){
                                            if(res.downloadurl!=\'\'&&res.downloadurl!=\'undefined\'&&res!=\'undefined\') {
                                            window.open(res.downloadurl);
                                            jQuery(\'#pkg_\'+pkgid).html(\'<a style="color:#000" href="\'+res.downloadurl+\'">'.$dlabel.'</a>\');                                             
                                            } else {
                                                jQuery(\'#msg_\'+pkgid).html(\'\'+res.error);
                                            }
                                    });
                      return false;
                });
            };

            (function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id; /* js.async = true; */
              js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=' . get_option('_wpdm_facebook_app_id', 0) . '";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, \'script\', \'facebook-jssdk\'));
     </script>
     <div class="fb-like" data-href="' . $url . '" data-send="false" data-width="100" data-show-faces="false" data-layout="button_count" data-font="arial"></div>

     <style>.fb_edge_widget_with_comment{ max-height:20px !important; overflow:hidden !important;}</style>
     </div>

</div>
     ';

    }

    public static function reCaptchaLock($package, $buttononly = false){
        ob_start();
        //wp_enqueue_script('wpdm-recaptcha', 'https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit');
        $force = str_replace("=", "", base64_encode("unlocked|" . date("Ymdh")));
        ?>
        <script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit'></script>
        <div  id="reCaptchaLock_<?php echo $package['ID']; ?>"></div>
        <div id="msg_<?php echo $package['ID']; ?>"></div>
        <script type="text/javascript">
            var ctz = new Date().getMilliseconds();
            var siteurl = "<?php echo home_url('/?nocache='); ?>"+ctz,force="<?php echo $force; ?>";
            var verifyCallback_<?php echo $package['ID']; ?> = function(response) {
                jQuery.post(siteurl,{id:<?php echo $package['ID'];?>,dataType:'json',execute:'wpdm_getlink',force:force,social:'c',reCaptchaVerify:response,action:'wpdm_ajax_call'},function(res){
                    if(res.downloadurl!='' && res.downloadurl != undefined && res!= undefined ) {

                        if(window.parent == undefined)
                            location.href = res.downloadurl;
                        else
                            window.parent.location.href = res.downloadurl;

                    jQuery('#reCaptchaLock_<?php echo $package['ID']; ?>').html('<a href="'+res.downloadurl+'" class="wpdm-download-button btn btn-inverse btn-lg"><?php _e('Download', 'wpdmpro'); ?></a>');
                    } else {
                        jQuery('#msg_<?php echo $package['ID']; ?>').html(''+res.error);
                    }
                });
            };
            var widgetId2;
            var onloadCallback = function() {
                grecaptcha.render('reCaptchaLock_<?php echo $package['ID']; ?>', {
                    'sitekey' : '<?php echo get_option('_wpdm_recaptcha_site_key'); ?>',
                    'callback' : verifyCallback_<?php echo $package['ID']; ?>,
                    'theme' : 'light'
                });
            };
        </script>

        <?php
        return ob_get_clean();
    }



}
