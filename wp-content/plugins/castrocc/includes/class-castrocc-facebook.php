<?php


/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://www.castrocountryclub.com
 * @since      1.0.0
 *
 * @package    CastroCC
 * @subpackage CastroCC/includes
 */


/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    CastroCC
 * @subpackage CastroCC/includes
 * @author     Mario Hernandez <mario.hernandez@gmail.com>
 */
class FacebookAdapter {


	protected $fb;
	protected $pageId;


	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		require_once dirname( __FILE__ )  . '/Facebook/autoload.php';

		$this->fb = new Facebook\Facebook([
		  'app_id' => '137045663546938',
		  'app_secret' => '6b079a6780db5d7e88dcd6593378fb87',
		  'default_graph_version' => 'v2.2',
		  ]);

		$this->pageId = '157874804262908';

	}

	public function getCurrentEvents(){
		$app = $this->fb->getApp();

		error_log(' in the getCurrentEvents');

		try {
			$accessToken = $app->getAccessToken();
			$response = $this->fb->get($this->pageId .'/events?fields=start_time,end_time,cover,category,name,place,description&since=now', $accessToken);
			$response = $response->getDecodedBody();
			$response = array_reverse($response['data']);

		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  error_log('Graph returned an error: ' . $e->getMessage());
		  $response = array('error' => 'No events scheduled.');

		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  error_log('SDK returned an error: ' . $e->getMessage());
		  $response = array('error' => 'No events scheduled.');
		}
		

		

		return $response;
	}


}
