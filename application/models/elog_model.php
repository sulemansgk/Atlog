<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Elog_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
	
	public function insertgeneralentry($data){
		$this->db->insert("generalentry",$data);
		return $this->db->insert_id();
	}
	
	public function insertcontrolmobilein($data){
		$this->db->insert("controlmobile",$data);
		return $this->db->insert_id();
	}
	public function insertcontrolmobileout($data){
		$this->db->insert("controlmobile",$data);
		return $this->db->insert_id();
	}
		
	public function insertformlog($data){
		$data["unit_id"] = $this->userdetails["agentunit"];
		$this->db->insert("form_logs",$data);
		return $this->db->insert_id();		
	}
	
	public function faultrepclose($data){
		$this->db->insert("close_details",$data);
		return $this->db->insert_id();		
	}
	
	public function senditbck($data){
		$this->db->insert("sendit_bck",$data);
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

	public function count_recs($table){
		$res = $this->db->count_all_results($table);
		return $res;
	}
	
	public function getalljobcard(){
		$this->db->order_by("id", "desc"); 
		return $this->db->get("jobcard")->result_array();
	}
	
	public function getalljobcardss($limit, $start){
		
		$this->db->limit($limit, $start);
        $query = $this->db->get("jobcard");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;

	}

	public function agentcode($data){
		return  $this->db->get_where('fault_reporting',array('id'=>$data))->result_array();
	}

	public function agentemail($data){
			return  $this->db->get_where('tblagent',array('agentcode'=>$data))->result_array();
	}
	
	public function getAllcust(){
		return $this->db->get("latest_customer")->result_array();
	}

	public function getAlllru(){
		return $this->db->get("latest_lru")->result_array();
	}
	
	public function insertlru($data){
		$this->db->insert("latest_lru",$data);
		return $this->db->insert_id();
	}
	
	public function getAllLogs($limit = NULL, $offset = NULL,$accesslogs_filter){		
		$from_date = ($accesslogs_filter['from'] ? date('Y-m-d',strtotime($accesslogs_filter['from'])) : '');
		$to_date = ($accesslogs_filter['to'] ? date('Y-m-d',strtotime($accesslogs_filter['to'])) : '');
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
		$like = "";
		if(!empty($accesslogs_filter['subject'])){
			$like = "`form_logs`.`log_type` LIKE '%\"".$accesslogs_filter['subject']."\"%'";
		}
			
		if(!empty($from_date) && !empty($to_date)){
			$query_str = "SELECT * FROM form_logs WHERE DATE(`datetime`) >= '$from_date' AND DATE(`datetime`) <= '$to_date'";		
			$query=$this->db->query($query_str);
            $logs = $query->result_array();
			
			
		}elseif($from_date == '' || $to_date == ''){
				$logs = $this->db->get("form_logs")->result_array();
		 }
			
		if(!empty($logs)){
			foreach($logs as $key=>$log){
				
				if(!empty($accesslogs_filter['frnstatus']) && $log['log_table'] == 'fault_reporting' ){
				
				$this->db->select("*");
				$this->db->from($log["log_table"]);
				$this->db->where("id",$log["log_id"]);
				$this->db->where("frnstatus",$accesslogs_filter['frnstatus']);
				$res = $this->db->get()->result_array();
				if(!empty($res)){
					$logs[$key]["details"] = $res[0];
 				}
				}elseif(!empty($accesslogs_filter['unit_id']) && $log['log_table'] == 'met_condition'  || $log['log_table'] == 'rwy'){
				
				$this->db->select("*");
				$this->db->from($log["log_table"]);
				$this->db->where("id",$log["log_id"]);
				if(!empty($accesslogs_filter['unit_id'])){
				$this->db->where("unit_id",$accesslogs_filter['unit_id']);
				}
				$res = $this->db->get()->result_array();
				if(!empty($res)){
					$logs[$key]["details"] = $res[0];
 				}
					
				}elseif($accesslogs_filter['frnstatus'] == '' && $accesslogs_filter['unit_id'] == ''){
                
				$this->db->select("*");
				$this->db->from($log["log_table"]);
				$this->db->where("id",$log["log_id"]);
				$res = $this->db->get()->result_array();
				
				if(!empty($res)){
					$logs[$key]["details"] = $res[0];
 				}
				
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

	public function insertmetcondition($data){
		$this->db->insert("met_condition",$data);
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

	public function getAllJobs(){
		return $this->db->get("latest_parajob")->result_array();
	}
	
	public function getAllcalibrationitem(){
		return $this->db->get("latest_calibrationitem")->result_array();
	}
	
	public function insertparacustomer($data){
		$this->db->insert("latest_customer",$data);
		return $this->db->insert_id();
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
	
	public function cancellvo($data){
		$this->db->insert("cancel_lvo",$data);
		return $this->db->insert_id();		
	}
	
	public function cancellvos($log_id,$data){
		$this->db->insert("cancel_lvo",$data);
		return $this->db->insert_id();
	}
	
	
    public function cancel_lvo_safeguarding($data){
 		$this->db->insert("cancel_lvo_safeguarding",$data);
        return $this->db->insert_id();
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

	public function getclosedetails($id){		
		$id = $id['id'];
		return $this->db->get_where("close_details",array("faultrep"=>$id))->result_array();
	}
	
	public function getNewjob($id){
		return $this->db->get_where("fault_reporting",array("id"=>$id))->result_array();
	}
	
	
	public function getothersection($id){
		return $this->db->get_where("other_section",array("id"=>$id))->result_array();
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

	public function actionperfomed($id){
		$this->db->update('fault_reporting', $id,array('id' => $id['id']));	
		return true;
	}
	
	public function sentBackFaultReport($data){
		$this->db->where("id",$data["id"]);
		unset($data["id"]);
		$this->db->update("fault_reporting",$data);
		return $this->db->affected_rows();
	}
	public function faultReport_SendBack_Notification($fault_rep,$notiat,$error_text){
		$this->db->insert("aceptance_noti",array(
																							"fault_rep" 	=> $fault_rep,
																							"accepted_by"	=> $this->userdetails["agentcode"],
																							"date"				=> date("Y-m-d H:i:s"),
																							"notiat"			=> $notiat,
																							"error_text"	=> $error_text,
																							"status"			=> "Sent Back"
																							));
		return $this->db->insert_id();																					
	}

	public function insertnewjob($log_id,$data){
				$this->db->insert("new_job",$data);
				return $this->db->insert_id();

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

	public function getMetCondition($id){
		return $this->db->get_where("met_condition",array("id"=>$id))->result_array();
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

	public function updateMetCondition($log_id,$data){
       
		$this->db->where("id",$log_id);
		if($this->db->update('met_condition',array('ate' =>$data['ate'],'management' =>$data['management'],'initial' =>$data['initial'],'actions' =>$data['actions'],'roci' =>$data['roci'],'subject' =>$data['subject'],'datetime' =>$data['datetime'],'unit_id' =>$data['unit_id']))){
			$this->db->where(array("log_id"=>$log_id,"log_table"=>"met_condition"));
			if($this->db->update("form_logs",array("datetime"=>$data["datetime"]))){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	public function insertdetails($log_id,$data){
		$this->db->where("id",$log_id);
		$this->db->update("fault_reporting",$data);
		return true;
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

	public function updateAirCraftDiversion($log_id,$data){
		$this->db->where("id",$log_id);
		if($this->db->update("aircraftdiversion",$data)){
			$this->db->where(array("log_id"=>$log_id,"log_table"=>"aircraftdiversion"));
			if($this->db->update("form_logs",array("datetime"=>$data["datetime"]))){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	public function getControlMobile1(){
		$this->db->limit(1,0);
		$this->db->where("mobile_type","control mobile 1");
		$this->db->order_by("id","desc");
		$res = $this->db->get("controlmobile")->result_array();
		if(empty($res)){
			return array();
		}else{
			return $res[0];
		}
	}

	public function getControlMobile2(){
		$this->db->limit(1,0);
		$this->db->where("mobile_type","control mobile 2");
		$this->db->order_by("id","desc");
		$res = $this->db->get("controlmobile")->result_array();
		if(empty($res)){
			return array();
		}else{
			return $res[0];
		}
	}
	
	public function getAllShifts(){
		return $this->db->get("shift")->result_array();
	}

	public function getAllSubjects(){
		$this->db->like("active","on");
		return $this->db->order_by('subject')->get("subjectform")->result_array();
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
									"equip_notif_id"		=>	"",
									"datetime"				=>	date("Y-m-d H:i:s"),
									"approved"				=>	0,
									"equipment_release_id"	=> 	$equipment_release_id,
									"unit_id"				=> 	$this->userdetails["agentunit"]
									);
		$this->db->insert("equipment_notifications",$data);
		return $this->db->insert_id();
	}
	public function insertEquipmentReleaseNotificationATC($equipment_release_id){
		$data = array(
									"equip_notif_id"		=>	"",
									"datetime"				=>	date("Y-m-d H:i:s"),
									"approved"				=>	0,
									"equipment_release_id"	=> $equipment_release_id,
									"atc_report"			=> 1
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

	public function insertcalibrationitem($data){
		$this->db->insert("latest_calibrationitem",$data);
		return $this->db->insert_id();
	}

    public function insertfrequency($data){
		$this->db->insert("latest_frequency",$data);
		return $this->db->insert_id();
	}

	public function getAllEquipments(){
		return $this->db->order_by('name','asc')->get("system_equipment")->result_array();
	}

	public function getAllfrequency(){
		return $this->db->get("latest_frequency")->result_array();
	}

	public function getAllPositions(){
		return $this->db->order_by('name','asc')->get("positionname")->result_array();
	}

	public function getAllConsoleNumbers(){
		return $this->db->order_by('name','asc')->get("consolenumber")->result_array();
	}

	public function getAllUnits(){
		if($this->userdetails["agentrole"] != 1){
			$this->db->where_in("unit_id",unserialize($this->userdetails["agentunit"]));
		}
		return $this->db->get("units")->result_array();
	}
	
	public function insertNewJobx($data){
		$this->db->insert("new_job",$data);
		return $this->db->insert_id();
	}
	
	public function insertlvo($data){
		$this->db->insert("initiate_lvo",$data);
		return $this->db->insert_id();
	}
	
	
	public function insertsafeguardinglvo($data){
		$this->db->insert("lvo_safeguarding",$data);
		return $this->db->insert_id();
	}

	public function getinsertsafeguardinglvo($id){
		return $this->db->get_where("lvo_safeguarding",array("id"=>$id))->result_array();
	}
	
	public function getinitiatelvo_edit($id){
		return $this->db->get_where("initiate_lvo",array("id"=>$id))->result_array();
	}

	public function canceledlvo($id){
		return $this->db->get_where("cancel_lvo",array("id"=>$id))->result_array();
	}

	public function deletesafeLVO($id){
		$this->db->where("id",$id);
		if($this->db->delete("lvo_safeguarding")){
			$where = array(
		  'log_table' => "lvo_safeguarding",
		  'log_id'   => $id
		);
			$this->db->where($where);
			$this->db->delete("form_logs");
			return true;
		}else{
			return false;
		}
	}
	
	public function canceledlvosafeguarding($id){
		return $this->db->get_where("cancel_lvo_safeguarding",array("id"=>$id))->result_array();
	}

	public function addevent($id){
		return $this->db->get_where("addevent",array("id"=>$id))->result_array();
	}

	public function getjobcard($id){
		return $this->db->get_where("jobcard",array("id"=>$id))->result_array();
	}

	public function allevents($id){
		return $this->db->get_where("addevent",array("jobcard"=>$id))->result_array();
	}

	public function gettheevents($id){
		return $this->db->get_where("addevent",array("id"=>$id))->result_array();
	}
	
	public function getallotherSec(){
		return $this->db->get_where("other_section")->result_array();
	}

	public function insertevents($data){
		$this->db->insert("addevent",$data);
		return $this->db->insert_id();
	}
	
	public function jobcard($data){
		$this->db->insert("jobcard",$data);
		return $this->db->insert_id();
	}
	
	public function insertparajob($data){
		$this->db->insert("latest_parajob",$data);
		return $this->db->insert_id();
	}
	
	public function insertothersection($data){
		$this->db->insert("other_section",$data);
		return $this->db->insert_id();
	}
	
	public function transferd($data){
		$this->db->insert("transfered_jobs",$data);
		return $this->db->insert_id();
	}
	
	public function canceljob($data){
		$this->db->insert("cancel_jobs",$data);
		return $this->db->insert_id();
	}
	public function acepteddata($data){
		$this->db->insert("aceptance_noti",$data);
		return $this->db->insert_id();
	}
}
?>