<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Elog_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
	
	public function insertfrequency($data){
		$this->db->insert("latest_frequency",$data);
		return $this->db->insert_id();
	}
	
	public function insertlru($data){
		$this->db->insert("latest_lru",$data);
		return $this->db->insert_id();
	}
	
    public function insertparajob($data){
		$this->db->insert("latest_parajob",$data);
		return $this->db->insert_id();
	}
	
	public function insertformlog($data){
		$data["unit_id"] = $this->userdetails["agentunit"];
		
		$this->db->insert("form_logs",$data);
		return $this->db->insert_id();		
	}

	public function count_rec($table){
		if($table = "form_logs"){
			if($this->userdetails["agentrole"] != 1){
				$units = unserialize($this->userdetails["agentunit"]);
				$units_size = sizeof($units);
				$this->db->like("unit_id",'"'.$units[0].'"');
				if($units_size > 1){
					for($i = 1; $i < $units_size; $i++){
						$this->db->or_like("unit_id",'"'.$units[$i].'"');			
					}
				}		
			}		
		}
		
			if($this->uri->segment(3) == "faultreports"){
				$this->db->where("log_table","fault_reporting");
			}
		
	  $res = $this->db->count_all_results($table);
	  return $res;
		
	}

	public function getAllLogs($limit = NULL, $offset = NULL){
		if($this->uri->segment(3) == "faultreports"){
			$this->db->where("log_table","fault_reporting");
		}
		if($this->userdetails["agentrole"] != 1){
			$units = unserialize($this->userdetails["agentunit"]);
			$units_size = sizeof($units);
			$this->db->like("unit_id",'"'.$units[0].'"');
			if($units_size > 1){
				for($i = 1; $i < $units_size; $i++){
					$this->db->or_like("unit_id",'"'.$units[$i].'"');			
				}
			}		
		}
		$this->db->limit($limit, $offset);
		$order = $this->session->userdata("order");
		$this->db->order_by("datetime",$order);
		$logs = $this->db->get("form_logs")->result_array();
		
		if(!empty($logs)){
			foreach($logs as $key=>$log){
				$this->db->select("*");
				$this->db->from($log["log_table"]);
				$this->db->where("id",$log["log_id"]);
				$res = $this->db->get()->result_array();
				if(!empty($res)){
					$logs[$key]["details"] = $res[0];
 				}
			}
		}
		return $logs;
	}

	public function getAllAccessLogs($limit = NULL, $offset = NULL,$accesslogs_filter){
		
		if(!empty($accesslogs_filter)){
			if( !empty($accesslogs_filter["from"]) && !empty($accesslogs_filter["to"]) ){
				$this->db->where("log_datetime BETWEEN '".$accesslogs_filter["from"]."' and '".$accesslogs_filter["to"]."'");			
			}else if( empty($accesslogs_filter["from"]) && !empty($accesslogs_filter["to"]) ){
				$this->db->where("log_datetime BETWEEN '1940-01-01' and '".$accesslogs_filter["to"]."'");			
			}else if( !empty($accesslogs_filter["from"]) && empty($accesslogs_filter["to"]) ){
				$this->db->where("log_datetime BETWEEN '".$accesslogs_filter["from"]."' and '".date("Y-m-d")."'");			
			}
			if(!empty($accesslogs_filter["keyword"])){
				$this->db->like("message",$accesslogs_filter["keyword"]);							
			}
			if(!empty($accesslogs_filter["agentunit"])){
				$this->db->like("unit_id",'"'.$accesslogs_filter["agentunit"].'"');					
			}
		}
		$this->db->limit($limit, $offset);
		$order = $this->session->userdata("order");
		$this->db->order_by("log_datetime",$order);
		$this->db->join("tblagent","tblagent.agentcode = access_logs.agentcode");
		$logs = $this->db->get("access_logs")->result_array();
		
		return $logs;
	}

	public function insertlog($data){
		$this->db->insert("aircraftdiversion",$data);
		return $this->db->insert_id();
	}

	public function insertAtcFacility($data){
		$this->db->insert("atcfacility",$data);
		return $this->db->insert_id();
	}

	public function insertRunwayInUse($data){
		$this->db->insert("rwy",$data);
		return $this->db->insert_id();
	}

	public function insertFaultReporting($data){
		$this->db->insert("fault_reporting",$data);
		return $this->db->insert_id();
	}

	public function insertAgl($data){
		$this->db->insert("agl",$data);
		return $this->db->insert_id();
	}

	public function insertRunwayManoeuvringArea($data){
		$this->db->insert("rwy_area_inspection",$data);
		return $this->db->insert_id();
	}

	public function getAllCountries(){
		return $this->db->get("countries")->result_array();
	}

	public function getAllUsers(){
		return $this->db->get("tblagent")->result_array();
	}

	public function getAllAreaNames(){
		if($this->userdetails["agentrole"] != 1){
			$units = implode(",",unserialize($this->userdetails["agentunit"]));
			$this->db->where_in("unit_id",$units);
		}
		$res = $this->db->get("runwaymanoeuvringarea")->result_array();
		return $res;
	}
	
	
	public function getGeneralEntry($id){
		return $this->db->get_where("generalentry",array("id"=>$id))->result_array();
	}
	
	public function updateGeneralEntry($log_id,$data){
		$this->db->where("id",$log_id);
		if($this->db->update("generalentry",$data)){
			$this->db->where(array("log_id"=>$log_id,"log_table"=>"generalentry"));
			if($this->db->update("form_logs",array("datetime"=>$data["datetime"]))){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function getrunwaymanoeuvringareainspection($id){
		return $this->db->get_where("rwy_area_inspection",array("id"=>$id))->result_array();
	}
	
	public function updaterunwaymanoeuvringareainspection($log_id,$data){
		$this->db->where("id",$log_id);
		if($this->db->update("rwy_area_inspection",$data)){
			$this->db->where(array("log_id"=>$log_id,"log_table"=>"rwy_area_inspection"));
			if($this->db->update("form_logs",array("datetime"=>$data["datetime"]))){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function getFaultReporting($id){
		return $this->db->get_where("fault_reporting",array("id"=>$id))->result_array();
	}
	
	public function updateFaultReporting($log_id,$data){
		$this->db->where("id",$log_id);
		if($this->db->update("fault_reporting",$data)){
			$this->db->where(array("log_id"=>$log_id,"log_table"=>"fault_reporting"));
			if($this->db->update("form_logs",array("datetime"=>$data["datetime"]))){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function getAircraftDiversion($id){
		return $this->db->get_where("aircraftdiversion",array("id"=>$id))->result_array();
	}	

	public function getControlMobile($id){
		return $this->db->get_where("controlmobile",array("id"=>$id))->result_array();
	}
	
	public function updateControlMobile($log_id,$data){
		$this->db->where("id",$log_id);
		if($this->db->update("controlmobile",$data)){
			$this->db->where(array("log_id"=>$log_id,"log_table"=>"controlmobile"));
			if($this->db->update("form_logs",array("datetime"=>$data["datetime"]))){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function getRunwayInUse($id){
		return $this->db->get_where("rwy",array("id"=>$id))->result_array();
	}
	
	public function updateRunwayInUse($log_id,$data){
		$this->db->where("id",$log_id);
		if($this->db->update("rwy",$data)){
			$this->db->where(array("log_id"=>$log_id,"log_table"=>"rwy"));
			if($this->db->update("form_logs",array("datetime"=>$data["datetime"]))){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function getAGL($id){
		return $this->db->get_where("agl",array("id"=>$id))->result_array();
	}
	
	public function updateAGL($log_id,$data){
		$this->db->where("id",$log_id);
		if($this->db->update("agl",$data)){
			$this->db->where(array("log_id"=>$log_id,"log_table"=>"agl"));
			if($this->db->update("form_logs",array("datetime"=>$data["datetime"]))){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function getATC($id){
		return $this->db->get_where("atcfacility",array("id"=>$id))->result_array();
	}
	
	public function updateATC($log_id,$data){
		$this->db->where("id",$log_id);
		if($this->db->update("atcfacility",$data)){
			$this->db->where(array("log_id"=>$log_id,"log_table"=>"atcfacility"));
			if($this->db->update("form_logs",array("datetime"=>$data["datetime"]))){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}


	public function getAllShifts(){
		return $this->db->get("shift")->result_array();
	}

	public function getAllSubjects(){
		$this->db->like("active","on");
		return $this->db->get("subjectform")->result_array();
	}

	public function getAllActiveSubjects(){
		$this->db->where("active","on");
		return $this->db->get("subjectform")->result_array();
	}

	public function getAllStaffAbsenceReasons(){
		return $this->db->get("staffabsensereason")->result_array();
	}

	public function insertlvp($data){
		$this->db->insert("lvp",$data);
		return $this->db->insert_id();
	}

	public function getnoshow($id){
		return $this->db->get_where("lvp",array("id"=>$id))->result_array();
	}
	
	public function updatenoshow($log_id,$data){
		$this->db->where("id",$log_id);
		if($this->db->update("lvp",$data)){
			$this->db->where(array("log_id"=>$log_id,"log_table"=>"lvp"));
			if($this->db->update("form_logs",array("datetime"=>$data["datetime"]))){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function getlateforduty($id){
		return $this->db->get_where("lvp",array("id"=>$id))->result_array();
	}
	
	public function updatelateforduty($log_id,$data){
		$this->db->where("id",$log_id);
		if($this->db->update("lvp",$data)){
			$this->db->where(array("log_id"=>$log_id,"log_table"=>"lvp"));
			if($this->db->update("form_logs",array("datetime"=>$data["datetime"]))){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function getsenthome($id){
		return $this->db->get_where("lvp",array("id"=>$id))->result_array();
	}
	
	public function updatesenthome($log_id,$data){
		$this->db->where("id",$log_id);
		if($this->db->update("lvp",$data)){
			$this->db->where(array("log_id"=>$log_id,"log_table"=>"lvp"));
			if($this->db->update("form_logs",array("datetime"=>$data["datetime"]))){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function getunavailableforduty($id){
		return $this->db->get_where("lvp",array("id"=>$id))->result_array();
	}
	
	public function updateunavailableforduty($log_id,$data){
		$this->db->where("id",$log_id);
		if($this->db->update("lvp",$data)){
			$this->db->where(array("log_id"=>$log_id,"log_table"=>"lvp"));
			if($this->db->update("form_logs",array("datetime"=>$data["datetime"]))){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function getsicknessforduty($id){
		return $this->db->get_where("lvp",array("id"=>$id))->result_array();
	}
	
	public function updatesicknessforduty($log_id,$data){
		$this->db->where("id",$log_id);
		if($this->db->update("lvp",$data)){
			$this->db->where(array("log_id"=>$log_id,"log_table"=>"lvp"));
			if($this->db->update("form_logs",array("datetime"=>$data["datetime"]))){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function getfitnessorreturnforduty($id){
		return $this->db->get_where("lvp",array("id"=>$id))->result_array();
	}
	
	public function updatefitnessorreturnforduty($log_id,$data){
		$this->db->where("id",$log_id);
		if($this->db->update("lvp",$data)){
			$this->db->where(array("log_id"=>$log_id,"log_table"=>"lvp"));
			if($this->db->update("form_logs",array("datetime"=>$data["datetime"]))){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function insertEquipmentReleaseNotification($equipment_release_id){
		$data = array(
									"equip_notif_id"										=>	"",
									"datetime"							=>	date("Y-m-d H:i:s"),
									"approved"							=>	0,
									"equipment_release_id"	=> 	$equipment_release_id,
									"unit_id"								=> 	$this->userdetails["agentunit"]
									);
		$this->db->insert("equipment_notifications",$data);
		return $this->db->insert_id();
	}
	
	public function insertEquipmentReleaseNotificationATC($equipment_release_id){
		$data = array(
									"equip_notif_id"										=>	"",
									"datetime"							=>	date("Y-m-d H:i:s"),
									"approved"							=>	0,
									"equipment_release_id"	=> $equipment_release_id,
									"atc_report"	=> 1
									);
		$this->db->insert("equipment_notifications",$data);
		return $this->db->insert_id();
	}
	
	public function getMyRunways(){
		if($this->userdetails["agentrole"] != 1){	
			$this->db->where_in("unit_id",unserialize($this->userdetails["agentunit"]));
		}
		return $this->db->get("runway")->result_array();
	}
	
}
?>