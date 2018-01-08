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
class CastroCC_Data {

	protected $charset_collate;
	protected $fellowshipsTableName;
	protected $meetingsTableName;
	protected $appsTableName;

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );	

		$this->charset_collate = $wpdb->get_charset_collate();
		$this->fellowshipsTableName = $wpdb->prefix . "ccc_fellowships";
		$this->meetingsTableName = $wpdb->prefix . "ccc_meetings";
		$this->appsTableTame = $wpdb->prefix . "ccc_applications";


	}

	public function createTables(){
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );		
		error_log('CastroCC_Activator->createTables');

		// create meeting type table"
		$createMeetingTypesTable = "CREATE TABLE $this->fellowshipsTableName  ( 
			id int(10) NOT NULL AUTO_INCREMENT , 
			short_name CHAR(6) NOT NULL , 
			full_name VARCHAR(60) NOT NULL , 
			url VARCHAR(256) NOT NULL , 
			color CHAR(7) NOT NULL , 
			details TEXT , 
			PRIMARY KEY (id) 
			) $this->charset_collate;";

		dbDelta( $createMeetingTypesTable );

		// create meetings table
		$createMeetingsTable = "CREATE TABLE $this->meetingsTableName  ( 
			id int(10) NOT NULL AUTO_INCREMENT,
			name VARCHAR(60) NOT NULL , 
			meeting_type_id INT NOT NULL , 
			start_time TIME NOT NULL , 
			end_time TIME NOT NULL , 
			day_of_week INT NOT NULL , 
			details VARCHAR(256) NULL,
			PRIMARY KEY (id) FOREIGN KEY (meeting_type_id) REFERENCES $this->fellowshipsTableName(PersonID)
		) $this->charset_collate;";
		
		dbDelta( $createMeetingsTable );

		$createApplicationsTable  = "CREATE TABLE $this->appsTableTame ( 
			id INT(6) NOT NULL AUTO_INCREMENT , 
			cname VARCHAR(60) NOT NULL , 
			cemail VARCHAR(60) NOT NULL , 
			cphone1 VARCHAR(12) NOT NULL , 
			cphone2 VARCHAR(12) NOT NULL , 
			caddress VARCHAR(256) NOT NULL , 
			interest VARCHAR(60) NOT NULL , 
			sunday VARCHAR(8) NOT NULL , 
			monday VARCHAR(8) NOT NULL , 
			tuesday VARCHAR(8) NOT NULL , 
			wednesday VARCHAR(8) NOT NULL , 
			thursday VARCHAR(8) NOT NULL , 
			friday VARCHAR(8) NOT NULL , 
			saturday VARCHAR(8) NOT NULL , 
			rname1 VARCHAR(60) NOT NULL , 
			rphone1 VARCHAR(12) NOT NULL , 
			rname2 VARCHAR(60) NOT NULL , 
			rphone2 VARCHAR(12) NOT NULL , 
			ename VARCHAR(60) NOT NULL , 
			eemail VARCHAR(60) NOT NULL , 
			ephone1 VARCHAR(12) NOT NULL , 
			ephone2 VARCHAR(12) NOT NULL , 
			eaddress VARCHAR(256) NOT NULL , 
			agreement INT(1) NOT NULL , 
			prc INT(1) NOT NULL , 
			notes TEXT,
			PRIMARY KEY (id)
		) $this->charset_collate;";

		dbDelta ( $createApplicationsTable);


	}

	/**
	*
	*	Function to get all the current meetings with their associated meeting abbreviations and color coding
	*
	**/
	public function getMeetingsWithLegends(){
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		//error_log("schedule-data: getMeetingsWithLegends");

		
		$sql = "select m.id as id, mt.id as mt_id, name, color, short_name as meeting_type, start_time, end_time, day_of_week, m.details from $this->meetingsTableName m, $this->fellowshipsTableName mt where m.meeting_type_id = mt.id order by 
			day_of_week, start_time;";

		$result = $wpdb->get_results($sql);

		
		//error_log("getMeetingsWithLegends:" . print_r($result, true));

		return $result;

	}

	public function getTodaysMeetings(){
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		$day_of_week =  date("w");

		$sql = "select m.id as id, mt.id as mt_id, name, color, short_name as meeting_type, start_time, end_time, day_of_week, m.details from $this->meetingsTableName m, $this->fellowshipsTableName mt where m.meeting_type_id = mt.id and day_of_week=$day_of_week order by start_time;";

		$result = $wpdb->get_results($sql);

		
		//error_log("getMeetingsWithLegends:" . print_r($result, true));

		return $result;
	}

	/**
	*
	*	Function to get all the possible meeting types
	*
	**/
	public function getMeetingTypes(){
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		//error_log("schedule-data: getMeetingTypes");

		
		$sql = "select * from $this->fellowshipsTableName;";

		$result = $wpdb->get_results($sql);


		return $result;

	}

	public function getApplication($id){
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		//error_log("schedule-data: getMeetingTypes");

		
		$sql = "select * from $this->appsTableTame where id = $id;";

		$result = $wpdb->get_results($sql);

		

		return $result;
	}

	public function getApplicationsList(){
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		//error_log("schedule-data: getMeetingTypes");

		
		$sql = "select cname, cphone1, cemail, status, id from $this->appsTableTame;";

		$result = $wpdb->get_results($sql);

		

		return $result;
	}

	public function processApplication($id){
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		error_log("processapplication, id is $id");


		$result = $wpdb->update($this->appsTableTame, array("status"=>"1"), array("id"=>$id));

		
		//error_log("processApplication results: " . print_r($result, true));

		return $result;
	}

	public function deleteApplication($id){
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		error_log("deleteApplication, id is $id");

		

		$result = $wpdb->delete($this->appsTableTame, array("id"=>$id));

		
		//error_log("deleteApplication results: " . print_r($result, true));

		return $result;
	}

	public function getFilteredApplicationsList($filters){
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		//error_log("getFilteredApplication: interests are " . print_r($filters, true));

		$dayFilter = "";
		$where = "";


		if(array_key_exists('status', $filters)){

			$status = $filters['status'];
			if($status !=='')
				$where .= " and status like '%$status%'";
		}


		if($dayFilter !== "")
			$where .= " and (". substr($dayFilter, 3) .")";
		

		if ($where !== ""){
			$where = substr($where, 5);
			$where = " where " . $where;

		}
		
		//error_log( "inside getFilteredApplication, where clause is " . $where);

		$sql = "select cname, cphone1, cemail, status, id from $this->appsTableTame " . $where;

		$result = $wpdb->get_results($sql);

		
		//error_log("getFilteredApplications: " . print_r($result, true));

		if(!$result){

			$result = array ( 'error' => "Internal error saving application. ");
			error_log("getFilteredApplications: could filter applications due to " . $wpdb->last_error);

		}
		return $result;

	}

	protected function parseDayFilter($dayArray, $day){
			//error_log("$day array is " . print_r($day, true));

			$temp = "";
			foreach($dayArray as $value){
				$temp .= " or $day like '%$value%' ";
			}

			return $temp;
	}
	public function insertMeetingType($input){
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );


		$valueArray = array( 
				'short_name' => $input['short_name'], 
				'full_name' => $input['full_name'] ,
				'url' => $input['url'], 
				'color' => $input['color'],
				'details' => $input['details']
			);

		//error_log(" updateMeetingType: array is " . print_r($valueArray, true));

		$result = $wpdb->insert( $this->fellowshipsTableName , $valueArray );


		return $result;		
	}

	public function insertMeetingEntry($input){
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );


		$valueArray = array( 
				'name' => $input['name'], 
				'start_time' => $input['startTime'] ,
				'end_time' => $input['endTime'], 
				'details' => $input['details'],
				'meeting_type_id' => $input['meetingTypeId'], 
				'day_of_week' => $input['day']
			);

		//error_log(" updateMeetingEntry: array is " . print_r($valueArray, true));

		$result = $wpdb->insert( $this->meetingsTableName , $valueArray );


		return $result;		
	}

	public function insertApplicationEntry($input){
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		$result = $wpdb->insert( $this->appsTableTame  , $input );

		if(!$result){

			$result = array ( 'error' => "Internal error saving application. ");
		}
		return $result;
	
	}

	public function updateMeetingType($input){
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );


		$valueArray = array( 
				'short_name' => $input['short_name'], 
				'full_name' => $input['full_name'] ,
				'url' => $input['url'], 
				'color' => $input['color'],
				'details' => $input['details']
			);

		$whereArray = array (
				'id' => $input[id]
			);
		//error_log(" updateMeetingType: array is " . print_r($valueArray, true));

		$result = $wpdb->update( $this->fellowshipsTableName , $valueArray , $whereArray);


		return $result;		
	}

	public function updateMeetingEntry($input){
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );


		$valueArray = array( 
				'name' => $input['name'], 
				'start_time' => $input['startTime'] ,
				'end_time' => $input['endTime'], 
				'details' => $input['details'],
				'meeting_type_id' => $input['meetingTypeId'], 
				'day_of_week' => $input['day']
			);

		$whereArray = array (
				'id' => $input['id']
			);
		//error_log(" updateMeetingType: array is " . print_r($input, true));

		$result = $wpdb->update( $this->meetingsTableName , $valueArray , $whereArray);


		return $result;		
	}
	public function deleteMeetingType($input){
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );


		$result = $wpdb->delete($this->fellowshipsTableName, array( 'id' => $input));
		//error_log("deleteMeetingType: cont, result is " . $result);

		if(!isset($result)  || $result==null){
			error_log("couldn't delete row id " .$input . ", exception follows: " . $wpdb->last_error);
			$result = array ( 'error' => "Cannot delete a fellowship with meetings in the schedule. Please delete all meetings first. ");
		}
		return $result;
	}

	public function deleteMeetingEntry($input){
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );


		$result = $wpdb->delete($this->meetingsTableName, array( 'id' => $input));
		//error_log("deleteMeetingEntry: cont, result is " . $result);

		if(!isset($result)  || $result==null){
			error_log("couldn't delete row id " .$input . ", exception follows: " . $wpdb->last_error);
			$result = array ( 'error' => "Cannot delete this meeting, call system admin ");
		}
		return $result;
	}	



}