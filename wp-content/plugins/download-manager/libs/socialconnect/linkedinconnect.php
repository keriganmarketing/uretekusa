<?php
namespace WPDM;
require_once dirname( __FILE__ ) . '/LinkedIn/LinkedIn.php';


class LinkedInConnect {

	function __construct() {
		add_action( 'init', array( $this, 'ConnectHelper' ) );

	}

	public static function LoginURL($pid, $direct = 0){
		if($direct == 0){
			return home_url('/?connect=linkedin&__plin=0&package=' . $pid);
		} else {
			$li = new \LinkedIn(array(
				'api_key' => get_option('_wpdm_linkedin_client_id'),
				'api_secret' => get_option('_wpdm_linkedin_client_secret'),
				'callback_url' => home_url('/?connect=linkedin&package=' . $pid)
			));


			$loginUrl = $li->getLoginUrl(
				array(
					\LinkedIn::SCOPE_BASIC_PROFILE,
					\LinkedIn::SCOPE_EMAIL_ADDRESS,
					\LinkedIn::SCOPE_WRITE_SHARE
				)
			);
			return $loginUrl;
		}
	}

	function ConnectHelper() {

		if(!isset($_GET['connect']) || $_GET['connect'] != 'linkedin') return;

		if(isset($_REQUEST['__plin']) && wpdm_query_var('__plin') == 0){
			$jquery = includes_url("/js/jquery/jquery.js");
			$pid = wpdm_query_var('package');
			$url = get_post_meta($pid,'__wpdm_linkedin_url', true);
			$msg = get_post_meta($pid,'__wpdm_linkedin_message', true);
			$href = $url ? $url : get_permalink($pid);
			$msg = trim($msg) !=''? $msg:get_the_title($pid);
			?>
			<!DOCTYPE html>
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
			<body style="padding: 50px 80px;margin: 0" class="w3eden">
			<div id="fb-root"></div>

			<div class="page-info">
				<div class="panel panel-default" style="margin: 0">
					<div class="panel-body">
						<blockquote>
							<?php echo $msg; ?>
						</blockquote>
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

						 <a class="wpdm-social-lock btn wpdm-linkedin" href="<?php echo self::LoginURL($pid, 1); ?>"><i class="fa fa-share-alt"></i> Share in LinkedIn</a>

					</div>
				</div>
			</div>
			</body>
			</html>
			<?php
			die();
		}
		if(wpdm_query_var('__plin') == 1){
			header("location: ".self::LoginURL($_REQUEST['package'], 1));
			die();
		}

		$li = new \LinkedIn( array(
            'api_key'                => get_option('_wpdm_linkedin_client_id'),
            'api_secret'            => get_option('_wpdm_linkedin_client_secret'),
            'callback_url' => home_url('/?connect=linkedin&package='.$_GET['package'])
        ) );

        $token = $li->getAccessToken($_REQUEST['code']);
		$token_expires = $li->getAccessTokenExpiration();
		/*
        $user = $li->get('/people/~:(id,num-connections,picture-url,first-name,last-name,headline,email-address,summary)');
        $user_email = $user['emailAddress'];
		$user_id = email_exists($user_email);
		if(intval($user_id) > 0) {
			$euser = get_user_by( 'id', $user_id );
			if( $euser ) {
				wp_set_current_user( $user_id, $euser->user_login );
				wp_set_auth_cookie( $user_id );
				do_action( 'wp_login', $euser->user_login );
			}
		} else {

			$user_pass = wp_generate_password(12, false);
			$user_login = sanitize_user($user['firstName'].$user['lastName'], true);
			$sfx = '';
			$user_login_orgn = $user_login;
			while(username_exists($user_login_orgn.$sfx)){
				$user_login = $user_login_orgn.$sfx;
				if($sfx == '') $sfx = 0;
				else $sfx++;
			}

			$user_id = wp_create_user($user_login, $user_pass, $user_email);
			$display_name = $user['firstName']." ".$user['lastName'];
			wp_update_user( array( 'ID' => $user_id, 'display_name' => $display_name ) );
			update_user_meta($user_id, 'first_name', $user['firstName']);
			update_user_meta($user_id, 'last_name', $user['lastName']);
			update_user_meta($user_id, 'nickname', $display_name);
			update_user_meta($user_id, 'description', $user['summery']);
			$headers = "From: " . get_option('sitename') . " <" . get_option('admin_email') . ">\r\nContent-type: text/html\r\n";
			$message = file_get_contents(dirname(__FILE__) . '/templates/wpdm-new-user.html');
			$loginurl = $_POST['permalink'];
			$message = str_replace(array("[#support_email#]", "[#homeurl#]", "[#sitename#]", "[#loginurl#]", "[#name#]", "[#username#]", "[#password#]", "[#date#]"), array(get_option('admin_email'), site_url('/'), get_option('blogname'), $loginurl, $display_name, $user_login, $user_pass, date("M d, Y")), $message);

			if ($user_id) {
				wp_mail($user_email, "Welcome to " . get_option('sitename'), $message, $headers);

			}

			wp_set_current_user( $user_id, $user_login );
			wp_set_auth_cookie( $user_id );
			do_action( 'wp_login', $user_login );


		}
		*/

		$user = $li->get('people/~:(id,email-address,first-name,last-name)');

		$package = get_post($_GET['package']);
		$force = str_replace("=", "", base64_encode("unlocked|" . date("Ymdh")));
		$href = get_post_meta($package->ID,'__wpdm_linkedin_url', true);
		$msg = get_post_meta($package->ID,'__wpdm_linkedin_message', true);
		$href = $href ? $href : get_permalink($package->ID);
		$msg = trim($msg) !=''? $msg:$package->post_title;
		$msg .= " ".$href;
		try {
			$ret = $li->post("/people/~/shares", array('comment' => $msg, 'visibility' => array('code' => 'anyone')));
		}catch (\Exception $e){
		}

		global $wpdb;
		$wpdb->delete("{$wpdb->prefix}ahm_social_conns", array('email' => $user['emailAddress'], 'source' => 'linkedin'));
		$wpdb->insert("{$wpdb->prefix}ahm_social_conns", array('source' => 'linkedin', 'name' => $user['firstName'].' '.$user['lastName'], 'email' => $user['emailAddress'], 'user_data' => serialize($user), 'access_token' => maybe_serialize($token), 'timestamp' => time(), 'pid' => $package->ID, 'processed' => 1));

		$this->download($package->ID);

	}

	function post($pid){
		$connection = new \TwitterOAuth\TwitterOAuth(get_option('_wpdm_twitter_api_key'), get_option('_wpdm_twitter_api_secret'), $_SESSION['__tw_oauth_token'], $_SESSION['__tw_oauth_token_secret']);
		$tweet = get_post_meta($pid, '__tweet_message', true);
		if ($tweet == '') {
			$pack = get_post($pid);
			$tweet = $pack->post_title;
		}
		$tweet = substr($tweet, 0, 100) . " " . get_permalink($pid);
		$status = $connection->post("statuses/update", array("status" => $tweet));
		$_SESSION['__twitted_'.$pid] = 1;
	}

	function download($pid){
		$downloadURL = \WPDM\Package::expirableDownloadLink($pid, 3);
		$this->redirect($downloadURL);
	}

	function redirect($url){
		?>

		<script>
			window.opener.location.href = "<?php echo $url; ?>";
			document.write('You may close the window now.');
			setTimeout("window.close();", 2000);
		</script>

		<?php
		die();
	}

	function closePopup(){
		?>

		<script>
			document.write('You may close the window now.');
			window.close();
		</script>

		<?php
		die();
	}



}

new LinkedInConnect();