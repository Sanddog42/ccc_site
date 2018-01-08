<?php
/**
 * Fired during plugin activation
 *
 * @link       http://www.castrocountryclub.org
 * @since      1.0.0
 *
 * @package    CastroCC
 * @subpackage CastroCC/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    CastroCC
 * @subpackage CastroCC/includes
 * @author     Mario Hernandez <mario.hernandez@gmail.com>
 */
class CastroCC_Validator {


	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

	}   /**
    *
    * Validate the form for type submission
    */
    public function validateAndCleanFellowshipType($input){

        error_log("inside isValidTypeForm");

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
            error_log("full name is not valid");
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

        error_log("validateAndCleanFellowshipType: color is: " . $input['color']);

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


        return $valid;
    }

    public function validateAndCleanApplication(&$input, &$error){

    	$this->validateStringLength($input, "cname", 60, true, "Contact name", $error);
    	$this->validateEmailAddress($input,'cemail', 60, true, "Contact email address", $error);
    	$this->validatePhoneNumber($input, 'cphone1', true, "Contact phone number", $error);
    	$this->validatePhoneNumber($input, 'cphone2', false, "Alternate contact phone number", $error);
    	$this->validateStringLength($input,'caddress', 256, true, "Contact address", $error);
    	$this->validateStringLength($input, 'interest', 60, false, "Intrests", $error);
    	$this->validateStringLength($input, 'sunday', 8, false, "Sunday hours", $error, "are invalid due to improper submission");
    	$this->validateStringLength($input, 'monday', 8, false, "Monday hours", $error, "are invalid due to improper submission");
    	$this->validateStringLength($input, 'tuesday', 8, false, "Tuesday hours", $error,"are invalid due to improper submission");
    	$this->validateStringLength($input, 'wednesday', 8, false, "Wednesday hours", $error,"are invalid due to improper submission");
    	$this->validateStringLength($input, 'thursday', 8, false, "Thursday hours", $error,"are invalid due to improper submission");
    	$this->validateStringLength($input, 'friday', 8, false, "Friday hours", $error,"are invalid due to improper submission");
    	$this->validateStringLength($input, 'saturday', 8, false, "Saturday hours", $error,"are invalid due to improper submission");
    	$this->validateStringLength($input, "rname1", 60, true, "First reference name", $error);
    	$this->validatePhoneNumber($input, 'rphone1', true, "First reference phone number", $error);
    	$this->validateStringLength($input, "rname2", 60, true, "Second reference name", $error);
    	$this->validatePhoneNumber($input, 'rphone2', true, "Second reference phone number", $error);
    	$this->validateStringLength($input, "ename", 60, true, "Emergency contact name", $error);
    	$this->validatePhoneNumber($input, 'ephone1', true, "Emergency contact phone number", $error);
    	$this->validatePhoneNumber($input, 'ephone2', false, "Emergency alternate contact phone number", $error);
    	$this->validateEmailAddress($input,'eemail', 60, false, "Emergency contact email address", $error);
    	$this->validateStringLength($input,'eaddress', 256, false, "Contact address", $error);
    	$this->validateStringLength($input,'agreement', 1, true, "Terms", $error, "must be accepted");
    	$this->validateStringLength($input, 'prc', 1, false, "PRC", $error);


    	return (count($error)==0);
    }

    private function validateStringLength(&$array, $key, $length, $required, $fieldName, &$error, $messageOverride = ""){
    	$requiredMessage = "";

    	$isEmpty = !isset($array[$key])|| empty($array[$key]);

    	if(!$required ){
    		if($isEmpty)  // if the field isn't required and not set then don't do any validation
    			return;
    	}else {
    		$requiredMessage =" filled and";
    	}

    	if(!$isEmpty){

    		$array[$key] = sanitize_text_field($array[$key]);
    	}

    	if($isEmpty ||
            strlen($array[$key]) > $length){
	        if(!empty($messageOverride)){
	        	$error = array_merge($error, array($key=>"$fieldName $messageOverride"));
	        }else{
	            $error = array_merge($error,  array($key=>"$fieldName must be$requiredMessage less than $length characters"));
	        } 
	    }
        return $error;
    }

    private function validatePhoneNumber(&$array, $key, $required, $fieldName, &$error){
    	$requiredMessage = "";

    	$isEmpty = !isset($array[$key])|| empty($array[$key]);
    	$patternMatch = preg_match("/^[0-9]{3}-{0,1}[0-9]{3}-{0,1}[0-9]{4}$/", $array[$key]);

    	if(!$required ){
    		if($isEmpty)  // if the field isn't required and not set then don't do any validation
    			return;
    	}else {
    		$requiredMessage =" filled and";
    	}

    	if($isEmpty || 
            !preg_match("/^[0-9]{3}-{0,1}[0-9]{3}-{0,1}[0-9]{4}$/", $array[$key])){
            $error = array_merge($error,  array($key=>"$fieldName must be$requiredMessage in ###-###-#### format"));
        } 
        return;
    }

    private function validateEmailAddress(&$array, $key, $length, $required, $fieldName, &$error){
    	$requiredMessage = "";

    	$array[$key] = sanitize_text_field($array[$key]);

    	$isEmpty = !isset($array[$key])|| empty($array[$key]);

    	if(!$required ){
    		if($isEmpty)  // if the field isn't required and not set then don't do any validation
    			return;
    	}else {
    		$requiredMessage =" filled";
    	}

    	if($isEmpty ||
            strlen($array[$key]) > $length ||
            !filter_var($array[$key], FILTER_VALIDATE_EMAIL)){
            $error = array_merge($error,  array($key=>"$fieldName must be$requiredMessage, less than $length characters and in the format of somewhere@email.com"));
        } 
        return $error;
    }
}
?>