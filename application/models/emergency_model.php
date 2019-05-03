<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Emergency_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}

	public function insertlog($data){
		$this->db->insert("emergency_formdata",$data);
		return $this->db->insert_id();
	}
	
	public function insertformlog($data){
		$data["unit_id"] = $this->userdetails["agentunit"];		
		$this->db->insert("form_logs",$data);
		return $this->db->insert_id();		
	}
	public function getlocations($term){
		//sleep( 3 );
		// no term passed - just exit early with no response
		if (empty($_GET['term'])) exit ;
		$q = strtolower($term);
		// remove slashes if they were magically added
		if (get_magic_quotes_gpc()) $q = stripslashes($q);
		$items = array();
		
		$this->db->like("name",$term);
		$res = $this->db->get("location")->result_array();
		if(!empty($res)){
			foreach($res as $row){
				$items[$row["name"]] = $row["name"];
			}
		}
		
		$result = array();
		foreach ($items as $key=>$value) {
			if (strpos(strtolower($key), $q) !== false) {
				array_push($result, array("id"=>$value, "label"=>$key, "value" => strip_tags($key)));
			}
			if (count($result) > 11)
				break;
		}
		// json_encode is available in PHP 5.2 and above, or you can install a PECL module in earlier versions
		return json_encode($result);
	}

	public function aircrafttype($term){
		//sleep( 3 );
		// no term passed - just exit early with no response
		if (empty($_GET['term'])) exit ;
		$q = strtolower($term);
		// remove slashes if they were magically added
		if (get_magic_quotes_gpc()) $q = stripslashes($q);
		$items = array();
		
		$this->db->like("name",$term);
		$res = $this->db->get("aircrafttype")->result_array();
		if(!empty($res)){
			foreach($res as $row){
				$items[$row["name"]] = $row["name"];
			}
		}
		
		$result = array();
		foreach ($items as $key=>$value) {
			if (strpos(strtolower($key), $q) !== false) {
				array_push($result, array("id"=>$value, "label"=>$key, "value" => strip_tags($key)));
			}
			if (count($result) > 11)
				break;
		}
		// json_encode is available in PHP 5.2 and above, or you can install a PECL module in earlier versions
		return json_encode($result);
	}

	public function aircraft_operator($term){
		//sleep( 3 );
		// no term passed - just exit early with no response
		if (empty($_GET['term'])) exit ;
		$q = strtolower($term);
		// remove slashes if they were magically added
		if (get_magic_quotes_gpc()) $q = stripslashes($q);
		$items = array();
		
		$this->db->like("name",$term);
		$res = $this->db->get("aircraftoperator")->result_array();
		if(!empty($res)){
			foreach($res as $row){
				$items[$row["name"]] = $row["name"];
			}
		}
		$result = array();
		foreach ($items as $key=>$value) {
			if (strpos(strtolower($key), $q) !== false) {
				array_push($result, array("id"=>$value, "label"=>$key, "value" => strip_tags($key)));
			}
			if (count($result) > 11)
				break;
		}
		// json_encode is available in PHP 5.2 and above, or you can install a PECL module in earlier versions
		return json_encode($result);
	}

	public function callsign($term){
		//sleep( 3 );
		// no term passed - just exit early with no response
		if (empty($_GET['term'])) exit ;
		$q = strtolower($term);
		// remove slashes if they were magically added
		if (get_magic_quotes_gpc()) $q = stripslashes($q);
		$items = array();
		
		$this->db->like("name",$term);
		$res = $this->db->get("callsign")->result_array();
		if(!empty($res)){
			foreach($res as $row){
				$items[$row["name"]] = $row["name"];
			}
		}
		$result = array();
		foreach ($items as $key=>$value) {
			if (strpos(strtolower($key), $q) !== false) {
				array_push($result, array("id"=>$value, "label"=>$key, "value" => strip_tags($key)));
			}
			if (count($result) > 11)
				break;
		}
		// json_encode is available in PHP 5.2 and above, or you can install a PECL module in earlier versions
		return json_encode($result);
	}

	public function dangerous_goods($term){
		//sleep( 3 );
		// no term passed - just exit early with no response
		if (empty($_GET['term'])) exit ;
		$q = strtolower($term);
		// remove slashes if they were magically added
		if (get_magic_quotes_gpc()) $q = stripslashes($q);
		$items = array();
		
		$this->db->like("name",$term);
		$res = $this->db->get("dangerousgood")->result_array();
		if(!empty($res)){
			foreach($res as $row){
				$items[$row["name"]] = $row["name"];
			}
		}
		$result = array();
		foreach ($items as $key=>$value) {
			if (strpos(strtolower($key), $q) !== false) {
				array_push($result, array("id"=>$value, "label"=>$key, "value" => strip_tags($key)));
			}
			if (count($result) > 11)
				break;
		}
		// json_encode is available in PHP 5.2 and above, or you can install a PECL module in earlier versions
		return json_encode($result);
	}

	public function point_of_departure($term){
		//sleep( 3 );
		// no term passed - just exit early with no response
		if (empty($_GET['term'])) exit ;
		$q = strtolower($term);
		// remove slashes if they were magically added
		if (get_magic_quotes_gpc()) $q = stripslashes($q);
		$items = array();
		
		$this->db->like("name",$term);
		$res = $this->db->get("pointofdeparture")->result_array();
		if(!empty($res)){
			foreach($res as $row){
				$items[$row["name"]] = $row["name"];
			}
		}
		$result = array();
		foreach ($items as $key=>$value) {
			if (strpos(strtolower($key), $q) !== false) {
				array_push($result, array("id"=>$value, "label"=>$key, "value" => strip_tags($key)));
			}
			if (count($result) > 11)
				break;
		}
		// json_encode is available in PHP 5.2 and above, or you can install a PECL module in earlier versions
		return json_encode($result);
	}

	public function destination($term){
		//sleep( 3 );
		// no term passed - just exit early with no response
		if (empty($_GET['term'])) exit ;
		$q = strtolower($term);
		// remove slashes if they were magically added
		if (get_magic_quotes_gpc()) $q = stripslashes($q);
		$items = array();
		
		$this->db->like("name",$term);
		$res = $this->db->get("destination")->result_array();
		if(!empty($res)){
			foreach($res as $row){
				$items[$row["name"]] = $row["name"];
			}
		}
		$result = array();
		foreach ($items as $key=>$value) {
			if (strpos(strtolower($key), $q) !== false) {
				array_push($result, array("id"=>$value, "label"=>$key, "value" => strip_tags($key)));
			}
			if (count($result) > 11)
				break;
		}
		// json_encode is available in PHP 5.2 and above, or you can install a PECL module in earlier versions
		return json_encode($result);
	}	

	public function reason($term){
		//sleep( 3 );
		// no term passed - just exit early with no response
		if (empty($_GET['term'])) exit ;
		$q = strtolower($term);
		// remove slashes if they were magically added
		if (get_magic_quotes_gpc()) $q = stripslashes($q);
		$items = array();
		
		$this->db->like("name",$term);
		$res = $this->db->get("reason")->result_array();
		if(!empty($res)){
			foreach($res as $row){
				$items[$row["name"]] = $row["name"];
			}
		}
		$result = array();
		foreach ($items as $key=>$value) {
			if (strpos(strtolower($key), $q) !== false) {
				array_push($result, array("id"=>$value, "label"=>$key, "value" => strip_tags($key)));
			}
			if (count($result) > 11)
				break;
		}
		// json_encode is available in PHP 5.2 and above, or you can install a PECL module in earlier versions
		return json_encode($result);
	}	

	public function runway_in_use($term){
		//sleep( 3 );
		// no term passed - just exit early with no response
		if (empty($_GET['term'])) exit ;
		$q = strtolower($term);
		// remove slashes if they were magically added
		if (get_magic_quotes_gpc()) $q = stripslashes($q);
		$items = array();
		
		$this->db->like("name",$term);
		$res = $this->db->get("runwayinuse")->result_array();
		if(!empty($res)){
			foreach($res as $row){
				$items[$row["name"]] = $row["name"];
			}
		}
		
		$result = array();
		foreach ($items as $key=>$value) {
			if (strpos(strtolower($key), $q) !== false) {
				array_push($result, array("id"=>$value, "label"=>$key, "value" => strip_tags($key)));
			}
			if (count($result) > 11)
				break;
		}
		// json_encode is available in PHP 5.2 and above, or you can install a PECL module in earlier versions
		return json_encode($result);
	}

	public function nature_of_accident($term){
		//sleep( 3 );
		// no term passed - just exit early with no response
		if (empty($_GET['term'])) exit ;
		$q = strtolower($term);
		// remove slashes if they were magically added
		if (get_magic_quotes_gpc()) $q = stripslashes($q);
		$items = array();
		
		$this->db->like("name",$term);
		$res = $this->db->get("natureofaccident")->result_array();
		if(!empty($res)){
			foreach($res as $row){
				$items[$row["name"]] = $row["name"];
			}
		}
		
		$result = array();
		foreach ($items as $key=>$value) {
			if (strpos(strtolower($key), $q) !== false) {
				array_push($result, array("id"=>$value, "label"=>$key, "value" => strip_tags($key)));
			}
			if (count($result) > 11)
				break;
		}
		// json_encode is available in PHP 5.2 and above, or you can install a PECL module in earlier versions
		return json_encode($result);
	}

	public function position_name($term){
		
		$this->db->where_in("unit_id",unserialize($this->userdetails["agentunit"]));
		
		if (empty($_GET['term'])) exit ;
		$q = strtolower($term);
		if (get_magic_quotes_gpc()) $q = stripslashes($q);
		$items = array();
		$this->db->like("name",$term);
		$res = $this->db->get("positionname")->result_array();
		if(!empty($res)){
			foreach($res as $row){
				$items[$row["name"]] = $row["name"];
			}
		}
		$result = array();
		foreach ($items as $key=>$value) {
			if (strpos(strtolower($key), $q) !== false) {
				array_push($result, array("id"=>$value, "label"=>$key, "value" => strip_tags($key)));
			}
			if (count($result) > 11)
				break;
		}
		return json_encode($result);
	}

	public function console_number($term){
		
		$this->db->where_in("unit_id",unserialize($this->userdetails["agentunit"]));
		
		if (empty($_GET['term'])) exit ;
		$q = strtolower($term);
		if (get_magic_quotes_gpc()) $q = stripslashes($q);
		$items = array();
		$this->db->like("name",$term);
		$res = $this->db->get("consolenumber")->result_array();
		if(!empty($res)){
			foreach($res as $row){
				$items[$row["name"]] = $row["name"];
			}
		}
		$result = array();
		foreach ($items as $key=>$value) {
			if (strpos(strtolower($key), $q) !== false) {
				array_push($result, array("id"=>$value, "label"=>$key, "value" => strip_tags($key)));
			}
			if (count($result) > 11)
				break;
		}
		return json_encode($result);
	}

	public function system_equipment($term){
	
		$this->db->where_in("unit_id",unserialize($this->userdetails["agentunit"]));

		if (empty($_GET['term'])) exit ;
		$q = strtolower($term);
		if (get_magic_quotes_gpc()) $q = stripslashes($q);
		$items = array();
		$this->db->like("name",$term);
		$res = $this->db->get("system_equipment")->result_array();
		if(!empty($res)){
			foreach($res as $row){
				$items[$row["name"]] = $row["name"];
			}
		}
		$result = array();
		foreach ($items as $key=>$value) {
			if (strpos(strtolower($key), $q) !== false) {
				array_push($result, array("id"=>$value, "label"=>$key, "value" => strip_tags($key)));
			}
			if (count($result) > 11)
				break;
		}
		return json_encode($result);
	}
	public function purpose_of_release($term){
		if (empty($_GET['term'])) exit ;
		$q = strtolower($term);
		if (get_magic_quotes_gpc()) $q = stripslashes($q);
		$items = array();
		$this->db->like("name",$term);
		$res = $this->db->get("purposeofrelease")->result_array();
		if(!empty($res)){
			foreach($res as $row){
				$items[$row["name"]] = $row["name"];
			}
		}
		$result = array();
		foreach ($items as $key=>$value) {
			if (strpos(strtolower($key), $q) !== false) {
				array_push($result, array("id"=>$value, "label"=>$key, "value" => strip_tags($key)));
			}
			if (count($result) > 11)
				break;
		}
		return json_encode($result);
	}
	
	public function getEmergencyLog($id){
		$this->db->select("*");
		$this->db->from("emergency_formdata");
		$this->db->where("id",$id);
		$this->db->join("tblformdata","tblformdata.emergency_id=emergency_formdata.id");
		$res = $this->db->get()->result_array();
		
		if(!empty($res)){
			$res[0]["phone_numbers"] = $this->db->get_where("tblformdata_phone",array("tblformdata_id"=>$res[0]["t_id"]))->result_array();
			$emails = $this->domain_model->getFormEmails($res[0]["type_of_incident"]);			
			$email_str = "";
			foreach($emails as $key=>$email){
				$email_str = $email_str.$email["email_address"].",";
			}
			$res[0]["t_emails"] = $email_str;
		}
		return $res;
	}

	public function getAllFrnStatuses(){
		return $this->db->get("frnstatus")->result_array();
	}

	public function getAlldep(){
		return $this->db->get("department")->result_array();
	}

	public function acceptfrn($log_id,$table){
		$last_frn = 0;
		$this->db->select("frn");
		$this->db->limit(1,0);
		$this->db->where("`frn` != 'pending'");
		$this->db->order_by("frn_update_time","desc");
		$res = $this->db->get($table)->result_array();
		if(!empty($res)){
			$last_frn = ((int)$res[0]["frn"])+1;
		}

		$this->db->where("id",$log_id);
		$this->db->update($table,array("frn"=>$last_frn,"frnstatus"=>6,"frn_update_time" => date("Y-m-d H:i:s")));
		$res = $this->db->get_where($table,array("id"=>$log_id))->result_array();
		if(empty($res)){
			return "error";
		}else{
			return $res[0]["frn"];
		}
	}
	
	public function updatelog($log_id,$data){
		$this->db->where("id",$log_id);
		if($this->db->update("emergency_formdata",$data)){
			$this->db->where(array("log_id"=>$log_id,"log_table"=>"emergency_formdata"));
			if($this->db->update("form_logs",array("datetime"=>$data["datetime"]))){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	public function insertTblFormData($strForm,$log_insert_id,$emails_str,$phones){
		$this->db->insert("tblformdata",array(
																					"t_id"=>"",
																					"form_value"=>$strForm,
																					"cdate"=>date("Y-m-d H:i:s"),
																					"isemailed"=>"1",
																					"isphoned"=>"0",
																					"emergency_id"=>$log_insert_id,
																					"t_emails"=>$emails_str
																				)
																			);
		$tblformdata_id = $this->db->insert_id();
		foreach($phones as $key=>$phone){
			$this->db->insert("tblformdata_phone",array(
																				"p_id"=>"",
																				"tblformdata_id"=>$tblformdata_id,
																				"cdate"=>date("Y-m-d H:i:s"),
																				"status"=>"calling",
																				"t_phone" => $phone["phone_number"]
																				)
												);		
		}
	}
	
	public function changeCallStatus($p_id){
		$this->db->where("p_id",$p_id);
		$res = $this->db->update("tblformdata_phone",array("status"=>"calling"));
		return $this->db->affected_rows();
	}
}
?>