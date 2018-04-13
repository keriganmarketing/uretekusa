<?php
namespace WPDM;

if (version_compare(PHP_VERSION, '5.4.0', '>='))
require_once dirname( __FILE__ ) . '/Facebook/autoload.php';



class FacebookConnect {

	function __construct() {
        if (version_compare(phpversion(), '5.4.0', '<')) return;
		add_action( 'init', array( $this, 'ConnectHelper' ) );
	}

	public static function LoginURL(){
        if (version_compare(phpversion(), '5.4.0', '<')) return;
		$fb = new \Facebook\Facebook( array(
			'app_id'                => get_option('_wpdm_facebook_app_id', 0),
			'app_secret'            => get_option('_wpdm_facebook_app_secret', 0),
			'default_graph_version' => 'v2.2',
        ) );

		$helper = $fb->getRedirectLoginHelper();

		$permissions = array( 'email' ); // Optional permissions
		$loginUrl    = $helper->getLoginUrl( home_url('/?connect=facebook'), $permissions );
		echo $loginUrl;
	}

	function ConnectHelper() {

		if(!isset($_GET['connect']) || $_GET['connect'] != 'facebook') return;

		if(isset($_GET['like'])){
			$this->likeButon($_GET['package']);
			die();
		}

		$fb = new \Facebook\Facebook(  array(
            'app_id'                => get_option('_wpdm_facebook_app_id', 0),
            'app_secret'            => get_option('_wpdm_facebook_app_secret', 0),
            'default_graph_version' => 'v2.2',
        ) );

		$helper = $fb->getRedirectLoginHelper();


		if(!isset($_GET['code']) && !isset($_GET['access_token'])){
			$permissions = array( 'email' ); // Optional permissions
			$loginUrl    = $helper->getLoginUrl( home_url('/?connect=facebook'), $permissions );
			header("Location: ".$loginUrl);
			die();
		}


		try {
			$accessToken = isset($_GET['access_token'])?$_GET['access_token']:$helper->getAccessToken();
		} catch ( \Facebook\Exceptions\FacebookResponseException $e ) {
			// When Graph returns an error
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch ( \Facebook\Exceptions\FacebookSDKException $e ) {
			// When validation fails or other local issues
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}

		if ( ! isset( $accessToken ) ) {
			if ( $helper->getError() ) {
				header( 'HTTP/1.0 401 Unauthorized' );
				echo "Error: " . $helper->getError() . "\n";
				echo "Error Code: " . $helper->getErrorCode() . "\n";
				echo "Error Reason: " . $helper->getErrorReason() . "\n";
				echo "Error Description: " . $helper->getErrorDescription() . "\n";
			} else {
				header( 'HTTP/1.0 400 Bad Request' );
				echo 'Bad request';
			}
			exit;
		}



		$_SESSION['fb_access_token'] = $accessToken->getValue();

		$data = $fb->get("/me?fields=id,name,email,picture,link,first_name,last_name",  $accessToken->getValue());

		$user = $data->getGraphUser();

		$user_email = $user->getField('email');
		$user_id = email_exists($user_email);
		if(intval($user_id) > 0) {
			$euser = get_user_by( 'id', $user_id );
			if( $user ) {
				wp_set_current_user( $user_id, $euser->user_login );
				wp_set_auth_cookie( $user_id );
				do_action( 'wp_login', $euser->user_login, $user );
			}
		} else {

			$user_pass = wp_generate_password(12, true);
			$user_login = sanitize_user($user->getFirstName().$user->getLastName(), true);
			$sfx = '';
			$user_login_orgn = $user_login;
			while(username_exists($user_login_orgn.$sfx)){
				$user_login = $user_login_orgn.$sfx;
				if($sfx == '') $sfx = 0;
				else $sfx++;
			}

			$user_id = wp_create_user($user_login, $user_pass, $user_email);
			$display_name = $user->getName();
			wp_update_user( array( 'ID' => $user_id, 'display_name' => $display_name ) );
			update_user_meta($user_id, 'first_name', $user->getFirstName());
			update_user_meta($user_id, 'last_name', $user->getLastName());
			update_user_meta($user_id, 'nickname', $display_name);
			update_user_meta($user_id, 'description', $user->getField('bio'));
			$headers = "From: " . get_option('sitename') . " <" . get_option('admin_email') . ">\r\nContent-type: text/html\r\n";
			$loginurl = $_POST['permalink'];

            \WPDM\Email::send("user-signup", array('to_email' => $user_email, 'name' => $display_name, 'username' => $user_login, 'password' => $user_pass));

            wp_set_current_user( $user_id, $user_login );
			wp_set_auth_cookie( $user_id );
			do_action( 'wp_login', $user_login, $user );


		}
        $redirect = isset($_REQUEST['redirect_to']) ? $_REQUEST['redirect_to'] : $_SERVER['REQUEST_URI'];
		header("location: ".$redirect);
		//$this->ClosePopup();

		die();

	}

	function likeButon($pid){
		$package = get_post_meta($pid);
		$url = get_post_meta($pid,'__wpdm_facebook_like', true);
		$url = $url ? $url : get_permalink($pid);
		$dlabel =  __('Download', 'wpdmpro');
		$force = str_replace("=", "", base64_encode("unlocked|" . date("Ymdh")));
		$unlockurl = home_url("/?id={$pid}&execute=wpdm_getlink&force={$force}&social=f");
		$jquery = includes_url("/js/jquery/jquery.js");

		?><!DOCTYPE html>
		<html style="padding: 0;margin: 0">
		<head>
			<title>Facebook Like</title>
			<script src="<?php echo $jquery; ?>"></script>
			<link rel="stylesheet" href="<?php echo WPDM_BASE_URL.'assets/bootstrap/css/bootstrap.css'; ?>">
			<link rel="stylesheet" href="<?php echo WPDM_BASE_URL.'assets/css/front.css'; ?>">
			<link rel="stylesheet" href="<?php echo WPDM_BASE_URL.'assets/font-awesome/css/font-awesome.min.css'; ?>">
			<link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
			<style>
				body{
					font-family: 'Slabo 27px', serif;
				}
			</style>
			<script>
				jQuery(function ($) {
					var target = '<?php echo $url; ?>';
					$.ajax({
						url: "https://api.linkpreview.net",
						dataType: 'jsonp',
						data: {q: target, key: '59fa36de8df86444d8477c9764f0afff3f91ee5165019'},
						success: function (response) {
							console.log(response);
							$('#title').html(response.title);
							if(response.description.indexOf('orbidden') < 1)
								$('#description').html(response.description);
							if(response.image != undefined && response.image != ''){
								$('#ppic').html('<img style="max-width: 64px" src="'+response.image+'" alt="'+response.title+'" />')
							}
						}
					});

				});
			</script>
		</head>
		<body style="padding: 80px;margin: 0" class="w3eden">
		<div id="fb-root"></div>

		<div class="page-info">
			<div class="panel panel-default" style="margin: 0">
				<div class="panel-body">
					<div class="media">
						<div id="ppic" class="pull-left"></div>
						<div class="media-body">
							<h3 id="title" style="margin-top: 0;font-size: 14pt"></h3>
							<div id="description" style="font-size: 9pt;margin-bottom: 10px">

							</div>
							<div class="color-green"><i class="fa fa-link"></i> <?php echo $url; ?></div>
						</div>
					</div>
				</div>
				<div class="panel-footer">

					<div id="wpdmslb-facebooklike-<?php echo $pid; ?>">
						<div class="labell">
							<script>

								window.fbAsyncInit = function() {
									console.log(FB);
									FB.Event.subscribe('edge.create', function(href) {
										console.log("FB Like");
										console.log(href);

										jQuery.post("<?php echo home_url("/?nocache=".uniqid()); ?>",{id:<?php echo $pid; ?>,dataType:'json',execute:'wpdm_getlink',force:"<?php echo $force; ?>",social:'f',action:'wpdm_ajax_call'},function(res){
											if(res.downloadurl!=''&&res.downloadurl!='undefined'&&res!='undefined') {
												location.href=res.downloadurl;
												jQuery('#wpdmslb-facebooklike-<?php echo $pid; ?>').addClass('wpdm-social-lock-unlocked').html('<a href="'+res.downloadurl+'" class="wpdm-download-button btn btn-inverse btn-block">Download</a>');
											} else {
												jQuery('#msg_<?php echo $pid; ?>').html(''+res.error);
											}
										});
										return false;
									});
								};

								(function(d, s, id) {
									if(typeof FB != "undefined") return;
									var js, fjs = d.getElementsByTagName(s)[0];
									if (d.getElementById(id)) return;
									js = d.createElement(s); js.id = id;
									js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo get_option('_wpdm_facebook_app_id', 0); ?>";
									fjs.parentNode.insertBefore(js, fjs);
								}(document, 'script', 'facebook-jssdk'));
							</script>
							<div class="fb-like" data-layout="standard" data-action="like" data-size="large" data-show-faces="false" data-href="<?php echo $url; ?>" data-send="false" data-width="300" data-font="arial">L o a d i n g . . .</div>

							<style>.fb_edge_widget_with_comment{ max-height:20px !important; overflow:hidden !important;}</style>
						</div>
					</div>

				</div>
			</div>
		</div>
		</body>
		</html>
		<?php

	}

	function ClosePopup(){
		?>
        <center>
            Logged In Successfully!<br/>
            <a href="javascript:enter();">Enter</a>
        </center>
		<script>
            function enter() {
                window.opener.location.reload();
                window.close();
            }

            enter();

		</script>

		<?php
		die();
	}



}

new FacebookConnect();