<?php
namespace WPDM;
require_once dirname( __FILE__ ) . '/Google/autoload.php';


class GoogleConnect {

	function __construct() {
		add_action( 'init', array( $this, 'ConnectHelper' ) );
	}

	public static function LoginURL(){
		$loginUrl    = home_url('/?connect=google');
		echo $loginUrl;
	}

	function ConnectHelper() {

		if(!isset($_GET['connect']) || $_GET['connect'] != 'google') return;

		if(wpdm_query_var('package') != '')
		$_SESSION['google_pid'] = wpdm_query_var('package');

		$client = new \Google_Client();
		$client->setApplicationName('Connect with Google');
		$client->setClientId(get_option('_wpdm_google_client_id', '929236958124-ccbmdk7rlvoss4is6ndarb83nd96lc02.apps.googleusercontent.com'));
		$client->setClientSecret(get_option('_wpdm_google_client_secret', '0lZ7zaXRwXuFwjletA6vxj3W'));
		$client->setRedirectUri(home_url('/?connect=google'));

		$scopes = array(
		'https://www.googleapis.com/auth/plus.login',
			'https://www.googleapis.com/auth/userinfo.email',
			'https://www.googleapis.com/auth/plus.me',
			//'https://www.googleapis.com/auth/plus.stream.write'
		);

		if(isset($_SESSION['google_pid']) && get_post_meta($_SESSION['google_pid'],'__wpdm_gc_scopes_contacts', true) == 1)
			$scopes[] = 'https://www.googleapis.com/auth/contacts.readonly';

		$client->setScopes($scopes);

		//unset($_SESSION['access_token']);

		if (isset($_GET['code'])) {
			$client->authenticate($_GET['code']);
			$_SESSION['access_token'] = $client->getAccessToken();
			//dd($_SESSION);
			//header('Location: ' . home_url('/?connect=google'));
		}

		if (isset($_SESSION['access_token']) && $_SESSION['access_token'] != '') {
            try {
			    $client->setAccessToken($_SESSION['access_token']);
            } catch (\Exception $e){
                unset($_SESSION['access_token']);
                $authUrl = $client->createAuthUrl();
                header("location: ".$authUrl);
                die();
            }
		} else {
			$authUrl = $client->createAuthUrl();
			header("location: ".$authUrl);
			die();
		}

		if ($client->getAccessToken()) {
			$_SESSION['access_token'] = $client->getAccessToken();
            try {
                $token_data = $client->verifyIdToken()->getAttributes();
                $oauth2 = new \Google_Service_Oauth2($client);
                $user = $oauth2->userinfo->get();
            } catch (\Exception $e){
			    unset($_SESSION['access_token']);
                $authUrl = $client->createAuthUrl();
                header("location: ".$authUrl);
                die();
            }

		}


		/*
		$plusdomains = new \Google_Service_PlusDomains($client);

		$activityObject = new \Google_Service_PlusDomains_ActivityObject();
		$activityObject->setContent("Testing....");
		$activityAccess = new \Google_Service_PlusDomains_Acl();
		$activityAccess->setDomainRestricted(true);

		$resource = new \Google_Service_PlusDomains_PlusDomainsAclentryResource();

		$resource->setType("public");

		$resources = array();
		$resources[] = $resource;

		$activityAccess->setItems($resources);

		$activity = new \Google_Service_PlusDomains_Activity();
		$activity->setObject($activityObject);
		$activity->setAccess($activityAccess);

		$plusdomains->activities->insert("me", $activity);


		$access_token = json_decode($client->getAccessToken())->access_token;
		$url = 'https://www.google.com/m8/feeds/contacts/default/full?alt=json&v=3.0&oauth_token='.$access_token;
		*/

		//if(isset($_SESSION['google_pid']) && get_post_meta($_SESSION['google_pid'],'__wpdm_gc_scopes_contacts', true) == 1)
		//	self::getContacts($client);

		global $wpdb;
		$prsd = get_post_meta($_SESSION['google_pid'], '__wpdm_gc_scopes_contacts', true)?0:2;
		$wpdb->delete("{$wpdb->prefix}ahm_social_conns", array('email' => $user->getEmail(), 'source' => 'google'));
		$wpdb->insert("{$wpdb->prefix}ahm_social_conns", array('source' => 'google', 'name' => $user->getName(), 'email' => $user->getEmail(), 'user_data' => serialize($user), 'access_token' => $_SESSION['access_token'], 'timestamp' => time(), 'pid' => $_SESSION['google_pid'], 'processed' => $prsd));

		$downloadURL = \WPDM\Package::expirableDownloadLink($_SESSION['google_pid'], 3);
		$this->closePopup($downloadURL);

		die();

	}


	static function getContacts($client){

		$client = new \Google_Client();
		$client->setApplicationName('Connect with Google');
		$client->setClientId(get_option('_wpdm_google_client_id', '929236958124-ccbmdk7rlvoss4is6ndarb83nd96lc02.apps.googleusercontent.com'));
		$client->setClientSecret(get_option('_wpdm_google_client_secret', '0lZ7zaXRwXuFwjletA6vxj3W'));

		$req = new \Google_Http_Request('https://www.google.com/m8/feeds/contacts/default/full?max-results=10000&updated-min=2007-03-16T00:00:00');
		$val = $client->getAuth()->authenticatedRequest($req);
		$response = $val->getResponseBody();
		$xmlContacts = simplexml_load_string($response);
		$xmlContacts->registerXPathNamespace('gd', 'http://schemas.google.com/g/2005');
		$contactsArray = array();
		foreach ($xmlContacts->entry as $xmlContactsEntry) {
			$contactDetails = array();
			$contactDetails['id'] = (string) $xmlContactsEntry->id;
			$contactDetails['name'] = (string) $xmlContactsEntry->title;
			foreach ($xmlContactsEntry->children() as $key => $value) {
				$attributes = $value->attributes();
				if ($key == 'link') {
					if ($attributes['rel'] == 'edit') {
						$contactDetails['editURL'] = (string) $attributes['href'];
					} elseif ($attributes['rel'] == 'self') {
						$contactDetails['selfURL'] = (string) $attributes['href'];
					} elseif ($attributes['rel'] == 'http://schemas.google.com/contacts/2008/rel#edit-photo') {
						$contactDetails['photoURL'] = (string) $attributes['href'];
					}
				}
			}
			$contactGDNodes = $xmlContactsEntry->children('http://schemas.google.com/g/2005');
			foreach ($contactGDNodes as $key => $value) {
				switch ($key) {
					case 'organization':
						$contactDetails[$key]['orgName'] = (string) $value->orgName;
						$contactDetails[$key]['orgTitle'] = (string) $value->orgTitle;
						break;
					case 'email':
						$attributes = $value->attributes();
						$emailadress = (string) $attributes['address'];
						$emailtype = substr(strstr($attributes['rel'], '#'), 1);
						$contactDetails[$key][] = ['type' => $emailtype, 'email' => $emailadress];
						break;
					case 'phoneNumber':
						$attributes = $value->attributes();
						//$uri = (string) $attributes['uri'];
						$type = substr(strstr($attributes['rel'], '#'), 1);
						//$e164 = substr(strstr($uri, ':'), 1);
						$contactDetails[$key][] = ['type' => $type, 'number' => $value->__toString()];
						break;
					default:
						$contactDetails[$key] = (string) $value;
						break;
				}
			}
			$contactsArray[] = $contactDetails;
		}


		dd($contactsArray);
	}

	function closePopup($downloadURL){
		?>

		<script>
			window.opener.location.href = "<?php echo $downloadURL; ?>";
			window.close();
		</script>

		<?php
		die();
	}



}

new GoogleConnect();
 