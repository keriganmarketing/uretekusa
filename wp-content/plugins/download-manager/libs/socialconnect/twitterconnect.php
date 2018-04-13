<?php
namespace WPDM;
if(!isset($_SESSION))
	session_start();
require_once dirname( __FILE__ ) . '/Twitter/autoload.php';


class TwitterConnect {

	function __construct() {
		add_action( 'init', array( $this, 'ConnectHelper' ) );
	}

	public static function loginURL($pid = '', $do = 'tweet'){
		$connection = new \TwitterOAuth\TwitterOAuth(get_option('_wpdm_twitter_api_key'), get_option('_wpdm_twitter_api_secret'), get_option('_wpdm_twitter_access_token'), get_option('_wpdm_twitter_access_token_secret'));
		$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => home_url('/?connect=twitter&package='.$pid.'&do='.$do)));
		$_SESSION['oauth_token'] = $request_token['oauth_token'];
		$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
		$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
		return $url;
	}

	function connectHelper() {

		if(!isset($_GET['connect']) || $_GET['connect'] != 'twitter') return;

		$settings['oauth_access_token'] = get_option('_wpdm_twitter_access_token');
		$settings['oauth_access_token_secret'] = get_option('_wpdm_twitter_access_token_secret');
		$settings['consumer_key'] = get_option('_wpdm_twitter_api_key');
		$settings['consumer_secret'] = get_option('_wpdm_twitter_api_secret');

		$do = isset($_GET['do'])?$_GET['do']:'tweet';
		//print_r($_GET); die();
		if(isset($_GET['package']) && ($do === 'tweet' && isset($_SESSION['__twitted_'.$_GET['package']]))){
			echo "Already twitted once, starting download...";
			$this->download($_GET['package']);
		}

		if(isset($_GET['package']) && ($do == 'follow' && isset($_SESSION['__followed_'.$_GET['package']]))){
			echo "Already following, starting download...";
			$this->download($_GET['package']);
		}

		if(!isset($_GET['oauth_token'])) {
			$loginurl = TwitterConnect::loginURL($_GET['package'], $_GET['do']);
			$try = isset($_GET['try'])?$_GET['try']+1:1;
			if($try > 2){
				$this->closePopup();
				die();
			}
			header("location: ". $loginurl."&try=".$try."&package=".(int)$_GET['package']."&do=".$_GET['do']);
			die();
		}

		$connection = new \TwitterOAuth\TwitterOAuth(get_option('_wpdm_twitter_api_key'), get_option('_wpdm_twitter_api_secret'), $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
		$request_token = $connection->oauth('oauth/access_token', array('oauth_verifier' => $_GET['oauth_verifier']));
		$oauth_token = $request_token['oauth_token'];
		$oauth_token_secret = $request_token['oauth_token_secret'];
		$_SESSION['__tw_oauth_token'] = $oauth_token;
		$_SESSION['__tw_oauth_token_secret'] = $oauth_token_secret;

		if($do == 'follow') {
			$this->follow((int)$_GET['package']);
		}
		else
		$this->tweet((int)$_GET['package']);
		$this->download((int)$_GET['package']);
		die();
	}

	function tweet($pid){
		$connection = new \TwitterOAuth\TwitterOAuth(get_option('_wpdm_twitter_api_key'), get_option('_wpdm_twitter_api_secret'), $_SESSION['__tw_oauth_token'], $_SESSION['__tw_oauth_token_secret']);
		$tweet = get_post_meta($pid, '__wpdm_tweet_message', true);
		if ($tweet == '') {
			$pack = get_post($pid);
			$tweet = $pack->post_title;
		}
		$tweet = substr($tweet, 0, 100) . " " . get_permalink($pid);
		$status = $connection->post("statuses/update", array("status" => $tweet));
		$_SESSION['__twitted_'.$pid] = 1;
	}

	function follow($pid){
		$connection = new \TwitterOAuth\TwitterOAuth(get_option('_wpdm_twitter_api_key'), get_option('_wpdm_twitter_api_secret'), $_SESSION['__tw_oauth_token'], $_SESSION['__tw_oauth_token_secret']);
		$handle = get_post_meta($pid, '__wpdm_twitter_handle', true);
		$status = $connection->post("friendships/create", array("screen_name" => $handle, 'follow' => true));
		//echo "<pre>";print_r($status);die();
		$_SESSION['__followed_'.$pid] = 1;
	}

	function download($pid){
		$key = uniqid();
		update_post_meta($pid, "__wpdmkey_".$key, apply_filters('wpdm_download_link_expiration_limit', 3, $pid));
		$_SESSION['_wpdm_unlocked_'.$pid] = 1;
		$downloadurl = wpdm_download_url($pid, "_wpdmkey={$key}");
		$this->redirect($downloadurl);
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

new TwitterConnect();