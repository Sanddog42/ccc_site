<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.castrocountryclub.org
 * @since      1.0.0
 *
 * @package    CastroCC
 * @subpackage CastroCC/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    CastroCC
 * @subpackage CastroCC/public
 * @author     Mario Hernandez <mario.hernandez@gmail.com>
 */
class CastroCC_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
     *
     *
     */
    protected $dataManager;
    protected $dataValidator;
    protected $meetingTypes;
    protected $meetings;
    protected $bridge; 

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;

		/// EMERGENCY: please remove this before going to production or you will always get new fetches
		/// for css and jsp
		$this->version = $version;

		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-castrocc-data.php';
        $this->dataManager = new CastroCC_Data();

        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-castrocc-validator.php';
        $this->dataValidator = new CastroCC_Validator();

        require_once plugin_dir_path(dirname(__FILE__)) .  'includes/class-castrocc-facebook.php';
		$this->bridge = new FacebookAdapter();

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in CastroCC_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The CastroCC_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */


		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/castrocc.css', array(), $this->version, 'all', true );


	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in CastroCC_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The CastroCC_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/meeting-schedule-public.js', array( 'jquery' ), $this->version, false );

	}

	public function sidebarContent($args){
		if(isset($args)&&isset($args['content'])){
		//	error_log('sidebarContent: replacing the sidebar' . print_r($args, true));
			$contentList = explode(",", $args['content']);
			echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>';
			echo '<script>';
			echo '$(document).ready(function() {';

			$output = "";

			foreach ($contentList as $value) {
			//	error_log('sidebarContent: foreach content is: ' . $value);
				if($value == "fellowship"){
					$output = $output . $this->buildFellowshipSidebar();
				//	error_log('sidebarContent: match fellowship: ' . $value);
				} else if($value == "hours"){
					$output = $output . $this->buildHoursSidebar();
				//	error_log('sidebarContent: match hours ' . $value);
				}



			}
			// error_log('sidebarContent: final output is  ' . $output);
			echo "  $('#sidebar').html('".$output."'); ";
			echo '}); </script>';
		}
		else{

			// error_log('sidebarContent: hiding sidebar');

			echo '<style type="text/css" media="screen"> #sidebar {display: none;} .site-main {float: none;width: 	auto;margin: auto;}</style>';
		}
	}

	public function displayMeetings(){

		$this->meetingTypes = stripslashes_deep($this->dataManager->getMeetingTypes());
    	$this->meetings = stripslashes_deep($this->dataManager->getMeetingsWithLegends());

		// error_log("!!!!displayMeetings called: " . print_r($this->meetings, true));

    	///error_log("admin.display_plugin_setup_page.meetingTypes:" . print_r($this->meetingTypes, true));
    	//error_log("admin.display_plugin_setup_page.meetings:" . print_r($this->meetings, true));
        include_once 'partials/meeting-schedule-public-display.php';

	}

	public function displayFellowships(){

		$this->meetingTypes = stripslashes_deep($this->dataManager->getMeetingTypes());

		// error_log("!!!!success called the display meeting with short code");

    	///error_log("admin.display_plugin_setup_page.meetingTypes:" . print_r($this->meetingTypes, true));
    	//error_log("admin.display_plugin_setup_page.meetings:" . print_r($this->meetings, true));
        include_once 'partials/fellowships.php';

	}

	private function buildHoursSidebar(){
		return '<h3 id="sidebarTitle" class="widget-title">Hours</h3><aside id="sidebarContent" class="widget"><ul><li>Monday: 10am - 10pm </li><li>Tuesday: 7am - 10pm </li><li>Wednesday: 7am - 10pm </li><li>Thursday: 7am - 10pm </li><li>Friday: 7am - 11pm </li><li>Saturday: 9am - 11pm </li><li>Sunday: 8:30am - 10pm </li></ul></aside>';
	}
	private function buildFellowshipSidebar(){

		$this->meetingTypes = stripslashes_deep($this->dataManager->getMeetingTypes());
		$return = '';
		$return = '<h3 id="sidebarTitle" class="widget-title">Fellowship</h3><aside id="sidebarContent" class="widget"><table style="text-align: left; ">';


            // output all the fellowship types
            foreach ($this->meetingTypes as $type) {
                $return = $return . '<tr style="border-right: 1px solid black;">'
                .'<td id="' .$type->id .'_color" style="background-color: ' .$type->color.'">&nbsp</td>'
                .'<td style="text-align: left;" id="' .$type->id .'_short_name">' .$type->short_name .'</td>'
                .'<td style="text-align: left;" id="' .$type->id .'_full_name">' .$type->full_name .'</td>'
                .'</tr>';
			}
		$return = $return . "</table></aside>";

        return $return;	
	}

	public function displayFacebookEvents($args){

		$size;
		$contentList;
		if(isset($args)){
			// error_log('complex facebook events' . print_r($args, true));
			if(isset($args['content']))
				$contentList = explode(",", $args['content']);
			if(isset($args['size']))
				$size = $args['size'];

		}
		$this->events = $this->bridge->getCurrentEvents();
		//echo ('FacebookEventsPublic: events is ' . print_r($this->events, true));
		include_once 'partials/facebookevents-public-display.php';
	}

	public function displayVolunteerApplication(){
		include_once 'partials/application.php';
	}

	public function processApplication(){
		error_log("processApplication: dump of post data: " . print_r($_POST, true));

		// first check to see if this is a form submission
        $applicationEntry = $_POST['application'] ;

        $this->flattenArray($applicationEntry);

        $error = array();
        // error_log("processApplication: input array prior to validation and clean: " . print_r($applicationEntry, true));

        $isValid = $this->dataValidator->validateAndCleanApplication($applicationEntry, $error);

        error_log("processApplication: input array after validation and clean: " . print_r($applicationEntry, true));

        // error_log("processApplication: validation results are " . print_r($error , true));

        $response = "";
        // if this is set then this is the result of a form submission
        if($isValid)
        {
        	$result = $this->dataManager->insertApplicationEntry($applicationEntry);
        	$name = $applicationEntry['cname'];
        	if($result == 1){


        		$response = array("success"=> "Application Saved");
        		$sendList = $this->getAdminEmails();
        		error_log("submitting application, the list of emails is as follows: ".print_r($sendList, true));
        		$subject = "CCC Applcation Recieved";
        		$message = "A new application from $name. Please log into http://www.castrocountryclub.org/wp-admin/admin.php?page=meeting-schedule_applications to retrieve the application.";
        		wp_mail( $sendList, $subject, $message );
        	}
        	else{
        		$response = array("error"=> array("message"=>"Internal server error, application could not be saved. If this continues please contact the Castro Country Club directly.") );
        	}

        }else {
			$response = array("error"=>$error);

        }
        echo json_encode($response);
        wp_die();

	}

	public function getAdminEmails(){
		$blogusers = get_users('role=Administrator');
		$return ="";
    	//print_r($blogusers);
    	foreach ($blogusers as $user) {
      	  $return .= "," .$user->user_email;
      	}  

      	if($return!==""){
      		$return = substr($return, 1);
      	}
      	return $return;

	}

	public function flattenArray(&$input){

	//	// error_log("flattenArray: starting the flat");
		foreach($input as $key => $val){
			if (is_array($val)){
				$temp = "";
				foreach ($val as $insideVal){
					$temp .= "$insideVal,"; 
				}
				$input[$key] = $temp;
			}
		}

		return;
	}

}
