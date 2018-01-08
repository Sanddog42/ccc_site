<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.castrocountryclub.org
 * @since      1.0.0
 *
 * @package    CastroCC
 * @subpackage CastroCC/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    CastroCC
 * @subpackage CastroCC/admin
 * @author     Mario Hernandez <mario.hernandez@gmail.com>
 */
class CastroCC_Admin
{

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
    protected $meetingTypes;
    protected $meetings;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-castrocc-data.php';
        $this->plugin_name = $plugin_name;
        $this->version     = $version;

        $this->dataManager = new CastroCC_Data();

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

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

        wp_enqueue_style('wp-color-picker');
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/meeting-schedule-admin.css', array('wp-color-picker'), $this->version, 'all');

        wp_enqueue_style( $this->plugin_name."_castrocc", plugin_dir_url(dirname(__FILE__)) . 'public/css/castrocc.css', array('wp-color-picker'), $this->version, 'all' );

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

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

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/meeting-schedule-admin.js', array('jquery', 'wp-color-picker'), $this->version, false);

    }

    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     *
     * @since    1.0.0
     */

    public function add_plugin_admin_menu()
    {

        global $accesslevelcheck, $ws_pagehooktop;
        /*
         * Add a settings page for this plugin to the Settings menu.
         *
         * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
         *
         *        Administration Menus: http://codex.wordpress.org/Administration_Menus
         *
         *
        add_options_page('Meeting Schedule Manager', 'Meeting Schedule',
            'manage_options',
            $this->plugin_name,
            array($this, 'display_plugin_setup_page')
        );
        */
   // $page = add_menu_page("Ninja Forms" , __( 'Forms', 'ninja-forms' ), apply_filters( 'ninja_forms_admin_parent_menu_capabilities', 'manage_options' ), "ninja-forms", "ninja_forms_admin", "dashicons-feedback", "35.1337" );

        // Add the menu to the left bar of the admin page
        add_menu_page("Castro Country Club",
            'Castro CC',
            'manage_options',
            $this->plugin_name,
            "display_castrocc_editor",
            plugin_dir_url(dirname(__FILE__)) . 'icons/calendar-icon-32.png', 
            "54.1337");
			
			//plugin_dir_path(dirname(__FILE__)) . 'includes/class-meeting-schedule-data.php';

         // add submenu pages to the left bar of the admin page
        add_submenu_page( $this->plugin_name, 
            'Dashboard', 
            'Dashboard',
            'manage_options', 
            $this->plugin_name,  
            array($this, 'display_castrocc_editor') );       

        // add submenu pages to the left bar of the admin page
        add_submenu_page( $this->plugin_name, 
            'Applications', 
            'Applications',
            'manage_options', 
            $this->plugin_name.'_applications',  
            array( $this, 'display_applications' ) );  

         // add submenu pages to the left bar of the admin page
        add_submenu_page( $this->plugin_name, 
            'Meeting Editor', 
            'Meeting Editor',
            'manage_options', 
            $this->plugin_name.'_meeting_editor',  
            array( $this, 'display_meeting_editor' ) );       

        // add submenu pages to the left bar of the admin page
        add_submenu_page( $this->plugin_name, 
        	'Fellowship Editor', 
        	'Fellowship Editor',
        	'manage_options', 
        	$this->plugin_name . '_fellowship_editor',  
        	array( $this, 'display_fellowship_editor' ) );



    }


    /*
     * Add settings action link to the plugins page.
     *
     * @since    1.0.0
     */

    public function add_action_links($links)
    {
        /*
         *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
         */
        $settings_link = array(
            '<a href="' . admin_url('options-general.php?page=' . $this->plugin_name) . '">' . __('Settings', $this->plugin_name) . '</a>',
        );

        return array_merge($settings_link, $links);

    }

    public function display_castrocc_editor(){
        include_once 'partials/castrocc-editor-display.php';    
    }   

    /**
    *   display the application admin page
    */
    public function display_applications(){

        $applications = $this->getApplicationsList();
        include_once 'partials/application.php';
    }

    /**
     * Render the settings page for this plugin.
     *
     * @since    1.0.0
     */

    public function display_meeting_editor()
    {

        // first check to see if this is a form submission
        $meetingEntry = $_POST['meetingEntry'] ;

        $validationResult =  array();

        // if this is set then this is the result of a form submission
        if(isset($meetingEntry) )
        {
            $validationResult = $this->validateAndCleanMeetingEntry($meetingEntry);

            // if after validating and cleaning the result is still empty then 
            if(count($validationResult)==0){
                if($meetingEntry['state']=='new') {

                  //  error_log("saving new type entry");
                    $this->dataManager->insertMeetingEntry($meetingEntry);


                } else if($meetingEntry['state']=='edit'){

                  //  error_log("updating type entry");
                    $this->dataManager->updateMeetingEntry($meetingEntry);

                } else if($meetingEntry['state']=='delete'){
                    $temp = $this->dataManager->deleteMeetingEntry($meetingEntry['id']);

                    // if the result is not 1 then there's not a problem. 
                    if($temp != 1){
                        $validationResult = array_merge($validationResult, $temp);
                    }
                }
            }
            // have to do if again becaseu sql errors are merged to the same array
            if(count($validationResult)!=0){
                error_log("meetingEntrys: some failure of the form submission " . print_r($validationResult, true));
            }

        // otherwise it's just a form get
        } else {
         //   error_log(" form is just being loaded");
        }
               
    	$this->meetingTypes = stripslashes_deep($this->getMeetingTypes());
    	$this->meetings = stripslashes_deep($this->getMeetings());
    	///error_log("admin.display_plugin_setup_page.meetingTypes:" . print_r($this->meetingTypes, true));
    	//error_log("admin.display_plugin_setup_page.meetings:" . print_r($this->meetings, true));
        include_once 'partials/meeting-editor-display.php';

    }

     /**
     * Render the settings page for this plugin.
     *
     * @since    1.0.0
     */

    public function display_fellowship_editor()
    {
    	

    	// first check to see if this is a form submission
        $fellowshipType = $_POST['fellowshipType'] ;

        $validationResult =  array();

        // if this is set then this is the result of a form submission
        if(isset($fellowshipType) )
        {
            $validationResult = $this->validateAndCleanFellowshipType($fellowshipType);

            // if after validating and cleaning the result is still empty then 
            if(count($validationResult)==0){
                if($fellowshipType['state']=='new') {

                   // error_log("saving new type entry");
                    $this->dataManager->insertMeetingType($fellowshipType);


                } else if($fellowshipType['state']=='edit'){

                   // error_log("updating type entry");
                    $this->dataManager->updateMeetingType($fellowshipType);

                } else if($fellowshipType['state']=='delete'){
                    $temp = $this->dataManager->deleteMeetingType($fellowshipType['id']);

                    // if the result is not 1 then there's not a problem. 
                    if($temp != 1){
                        $validationResult = array_merge($validationResult, $temp);
                    }
                }
            }
            // have to do if again becaseu sql errors are merged to the same array
            if(count($validationResult)!=0){
                error_log("fellowshipTypes: some failure of the form submission " . print_r($validationResult, true));
            }

        // otherwise it's just a form get
        } else {
          //  error_log(" form is just being loaded");
        }

    	// vaidate and save if it is

    	// then forward to the display page
        $this->meetingTypes = stripslashes_deep($this->getMeetingTypes());

    	///error_log("admin.display_plugin_setup_page.meetingTypes:" . print_r($this->meetingTypes, true));
    	//error_log("admin.display_plugin_setup_page.meetings:" . print_r($this->meetings, true));
        include_once 'partials/fellowship-editor-display.php';

    }   

    /**
     *
     * Get all the meeting details from the table
     */
    public function getMeetingTypes()
    {
        return $this->dataManager->getMeetingTypes();
    }

    /**
     *
     *
     */
    public function getMeetings()
    {
        return $this->dataManager->getMeetingsWithLegends();
    }

    /**
    * gets all the available applications
    */
    public function getApplicationsList(){
                $filter = array("status"=>"0");
        return $this->dataManager->getFilteredApplicationsList($filter);
    }

    /**
    * gets all the available applications
    */
    public function getApplication(){
        //error_log('inside getApplication');
        $id = $_POST['id'] ;

        echo json_encode($this->dataManager->getApplication($id));
        wp_die();
    }
       
    /**
    * gets all the available applications
    */
    public function filterApplicationsList(){

       // error_log('inside filterApplicationsList');
        $filters = $_POST['filters'] ;
        $apps = $this->dataManager->getFilteredApplicationsList($filters);

        echo json_encode($apps);
        wp_die();
    }

    public function processApplication(){
        $id = $_POST['id'] ;

        echo json_encode($this->dataManager->processApplication($id));
        wp_die();
    }

    public function deleteApplication(){
        $id = $_POST['id'] ;

        echo json_encode($this->dataManager->deleteApplication($id));
        wp_die();
    }
    /**
    * add the optiopns update 
    */
    public function options_update()
    {
        register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
    }

    /**
    *
    * Validate the form for type submission
    */
    public function validateAndCleanFellowshipType($input){

        //error_log("inside isValidTypeForm");

        // All checkboxes inputs
        $valid = array();

        if(!isset($input['id']) ||
            empty($input['id'])){
            $valid = array_merge($valid, array('id'=>'ID field must be set and as this is a hidden field you are probably doing something sneaky. Quit it!'));            
        }else {
            $input['id'] = sanitize_text_field($input['id']);
        }

        if(!isset($input['state']) ||
            empty($input['state'])){
            $valid = array_merge($valid, array('state'=>'State Field must be set and as this is a hidden field you are probably doing something sneaky. Quit it!'));
        } else {  // do a quick check for the delete state, if it is then no need to validate anything more than the id
            if($input['state']=='delete'){
                return $valid;
            }
        }
        //make full name is there and less than 60 chars
        if(!isset($input['full_name']) ||
            empty($input['full_name']) ||
            strlen($input['full_name']) > 60){
            //error_log("full name is not valid");
            $valid = array_merge($valid,  array('full_name'=>'Fellowship name must be filled and less than 60 characters'));
        }else {
            $input['full_name'] = sanitize_text_field($input['full_name']);
        }

        // make sure short name is there and less than 6 chars
        if(!isset($input['short_name']) ||
            empty($input['short_name']) ||
            strlen($input['short_name']) > 6){

            $valid = array_merge($valid, array('short_name'=> 'Fellowship abbreviation must be filled and less than 6 characters'));
        }else{
            $input['short_name'] = sanitize_text_field($input['short_name']);
        }

        // make sure url is there and less than 256 chars
        if(!isset($input['url']) ||
            empty($input['url']) ||
            strlen($input['url']) > 256) {
            $valid = array_merge($valid, array('url'=>'Fellowship URL must be filled and less than 256 characters'));
        }else{
            $input['url'] = esc_url_raw($input['url']);
        }

      //  error_log("validateAndCleanFellowshipType: color is: " . $input['color']);

        if(!isset($input['details']) ||
            empty($input['details']) ) {
            $valid = array_merge($valid, array('details'=>'Fellowship details must be filled in'));
        }else{
            $input['details'] = esc_url_raw($input['details']);
        }        

        // make sure color is there is exactly 6 chars for hex string and doesn't have any escape cars in the string
        if(!isset($input['color']) ||
            empty($input['color'])){
            $valid = array_merge($valid, array('color'=>'Color must be a filled and a hex code for colors'));
        }else if(!preg_match('/^#[a-f0-9]{6}$/i', $input['color'])){
            $valid = array_merge($valid, array('color'=>'Color must be a hex code for colors. Use the color picker in Chrome or Firefox for best results.'));
        }

        return $valid;
    }

    /**
    *
    * Validate the form for type submission
    */
    public function validateAndCleanMeetingEntry($input){

       // error_log("validateAndCleanMeetingEntry: preclean input: " . print_r($input, true));

        // All checkboxes inputs
        $valid = array();


        if(!isset($input['id']) ||
            empty($input['id'])){
            $valid = array_merge($valid, array('id'=>'ID field must be set and as this is a hidden field you are probably doing something sneaky. Quit it!'));            
        }else {
            $input['id'] = sanitize_text_field($input['id']);
        } 

        //make sure this submission has state
        if(!isset($input['state']) ||
            empty($input['state'])){
            $valid = array_merge($valid, array('state'=>'State Field must be set and as this is a hidden field you are probably doing something sneaky. Quit it!'));
        } else {  // do a quick check for the delete state, if it is then no need to validate anything more than the id
            if($input['state']=='delete'){
                return $valid;
            }
        }

        //make sure name is there and less than 60 chars
        if(!isset($input['name']) ||
            empty($input['name']) ||
            strlen($input['name']) > 60){
            error_log("isValidMeetingForm: name is not valid");
            $valid = array_merge($valid,  array('name'=>'Meeting name must be filled and less than 60 characters'));
        }else {
            $input['name'] = sanitize_text_field($input['name']);
            error_log("isValidMeetingForm: name escaped is: " . $input['name']);
        } 

        // make sure meeting type id is there and is an int
        if(!isset($input['meetingTypeId']) ||
            !is_numeric($input['meetingTypeId'])){
            $valid = array_merge($valid, array('typeId'=> 'Fellowship must be selected'));
        }

        // make sure the day of the week is selected
        if(!isset($input['day']) ||
            !is_numeric($input['day']) ) {

            $valid = array_merge($valid, array('day'=>'Day of week must be selected'));
        }

        // make sure the day of the week is selected
        if(isset($input['startTime'])) {
            $startTime =strtotime($input['startTime']);
  
            if($startTime==null){
                $valid = array_merge($valid, array('startTime'=>'Start Time not in valid HH:DD format'));
            }


        }else{
            $valid = array_merge($valid, array('startTime'=>'Start Time must be specified'));
        }

         // make sure the day of the week is selected
        if(isset($input['endTime'])) {
            $startTime =strtotime($input['endTime']);
  
            if($startTime==null){
                $valid = array_merge($valid, array('endTime'=>'End Time not in valid HH:DD format'));
            }


        }else{
            $valid = array_merge($valid, array('startTime'=>'Start Time must be specified'));
        }
        //if details are set make sure it is less than 256
        if(isset($input['details']) && strlen($input['details']) > 256){
            error_log("isValidMeetingForm: details is more than 256 chars");
            $valid = array_merge($valid,  array('details'=>'Meeting details must be less than 256 characters'));
        }else {
            $input['details'] = sanitize_text_field($input['details']);
        }

        error_log("validateAndCleanMeetingEntry: postclean input: " . print_r($input, true));

        return $valid;
    }
}
