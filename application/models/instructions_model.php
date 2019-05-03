<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class instructions_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}

	public function getInstructions($inst_type){
		
		if($inst_type != "all"){
			$this->db->like("instruction_type",$inst_type);
		}
		$this->db->where("publish_date <=",date("Y-m-d"));
		$this->db->where("expiry_date >=",date("Y-m-d"));
		$this->db->order_by("creation_date","desc");
		return $this->db->get("instructions")->result_array();
		
	}
	
	public function getapctancenoti(){
		$id= 0 ;
		return $this->db->get_where("aceptance_noti",array("readed"=>$id,"notiat"=>$this->userdetails["agentcode"] ))->result_array();
	
	}
	
	public function getapctancenotis($id){
			$data = array(
   							'readed' => '1' ,
   							);
			$this->db->update('aceptance_noti', $data,array('id' => $id));
			return $this->db->get_where("aceptance_noti",array("id"=>$id))->result_array();
	}
	
	
	public function getInstructions_ajax($data){
		
		if($data["last_inst_id"] != ""){
			$this->db->where("id > ".$data["last_inst_id"]);
		}
		$this->db->where("publish_date <=",date("Y-m-d H:i:s"));
		$this->db->where("expiry_date >=",date("Y-m-d H:i:s"));
		$this->db->like('issue_to','"'.$this->userdetails["designation"].'"');
		$this->db->order_by("creation_date","asc");
		if($this->userdetails["agentrole"] != 1){
			$units = implode(",",unserialize($this->userdetails["agentunit"]));
			$this->db->where_in("unit_id",$units);
		}
		$res = $this->db->get("instructions")->result_array();
		return $res;
	}
	
	public function getInstructions2($inst_type){
		$this->db->like("instruction_type",$inst_type);
		$this->db->order_by("creation_date","desc");
		return $this->db->get("instructions")->result_array();
	}

	public function getAllInstructionsAccessLogs($limit = NULL, $offset = NULL,$accesslogs_filter){
		if(!empty($accesslogs_filter)){
			
			if( !empty($accesslogs_filter["from"]) && !empty($accesslogs_filter["to"]) ){
				$this->db->where("datetime BETWEEN '".$accesslogs_filter["from"]."' and '".$accesslogs_filter["to"]."'");			
			}else if( empty($accesslogs_filter["from"]) && !empty($accesslogs_filter["to"]) ){
				$this->db->where("datetime BETWEEN '1940-01-01' and '".$accesslogs_filter["to"]."'");			
			}else if( !empty($accesslogs_filter["from"]) && empty($accesslogs_filter["to"]) ){
				$this->db->where("datetime BETWEEN '".$accesslogs_filter["from"]."' and '".date("Y-m-d")."'");			
			}
			if(!empty($accesslogs_filter["agentcode"])){
				$this->db->where("instructions_track.agentcode",$accesslogs_filter["agentcode"]);							
			}
			if(!empty($accesslogs_filter["unit_id"])){
				$this->db->where("instructions.unit_id",$accesslogs_filter["unit_id"]);
			}
		}
		$this->db->limit($limit, $offset);
		$order = $this->session->userdata("order");
		$this->db->order_by("datetime",$order);
		$this->db->join("instructions","instructions.id = instructions_track.instruction_id");
		$this->db->join("instruction_type","instruction_type.id = instructions.instruction_type");
		$this->db->join("tblagent","tblagent.agentcode = instructions_track.agentcode");
		$logs = $this->db->get("instructions_track")->result_array();
		return $logs;
	}

	public function countInstructionsAccessLogs($instructions_filter){
		
		if(!empty($instructions_filter)){
			if( !empty($instructions_filter["from"]) && !empty($instructions_filter["to"]) ){
				$this->db->where("datetime BETWEEN '".$instructions_filter["from"]."' and '".$instructions_filter["to"]."'");			
			}else if( empty($instructions_filter["from"]) && !empty($instructions_filter["to"]) ){
				$this->db->where("datetime BETWEEN '1940-01-01' and '".$instructions_filter["to"]."'");			
			}else if( !empty($instructions_filter["from"]) && empty($instructions_filter["to"]) ){
				$this->db->where("datetime BETWEEN '".$instructions_filter["from"]."' and '".date("Y-m-d")."'");
			}
			if(!empty($instructions_filter["unit_id"])){
				$this->db->where("instructions.unit_id",$instructions_filter["unit_id"]);
			}
		}
		$order = $this->session->userdata("order");
		$this->db->order_by("datetime",$order);
		$this->db->join("instructions","instructions.id = instructions_track.instruction_id");
		$this->db->join("instruction_type","instruction_type.id = instructions.instruction_type");
		$this->db->join("tblagent","tblagent.agentcode = instructions_track.agentcode");
		$res = $this->db->count_all_results("instructions_track");
		return $res;
	}
	
	public function getAllDesignations(){
		return $this->db->get("designation")->result_array();
	}

	public function getAllUserRoles(){
		return $this->db->get("agentroles")->result_array();
	}

	public function getAllInstructionsTypes(){
		return $this->db->get("instruction_type")->result_array();
	}

	public function getInstruction($id){
		return $this->db->get_where("instructions",array("id"=>$id))->result_array();
	}

	public function getNotification($id){
		return $this->db->get_where("fault_reporting",array("id"=>$id))->result_array();
	}

	public function markAppprovedNotifAsRead($equip_notif_id){
		$this->db->where("equip_notif_id",$equip_notif_id);
		$this->db->update("equipment_notifications",array("read"=>1,"read_time"=>date("Y-m-d H:i:s"),"read_by_user"=>$this->userdetails["agentcode"]));
	}

	public function approveNotification($equip_notif_id){
		$notttt = $this->db->query("select * from equipment_notifications where equip_notif_id =  $equip_notif_id")->row()->equipment_release_id;
		if(!empty($notttt)){
		$this->db->where("id",$notttt);
		$data1 = array("frnstatus"=>12);
		$this->db->update("fault_reporting",$data1);
		}
		$this->db->where("equip_notif_id",$equip_notif_id);
		$data = array("approved"=>1,"approval_time"=>date("Y-m-d H:i:s"));
		if($this->db->update("equipment_notifications",$data)){
			return 'success';
		}else{
			return 'unsuccess';
		}
	}
	public function rejectNotification($equip_notif_id){
		
		$notttt = $this->db->query("select * from equipment_notifications where equip_notif_id =  $equip_notif_id")->row()->equipment_release_id;
		if(!empty($notttt)){
			$this->db->where("id",$notttt);
			$data1 = array("frnstatus"=>13);
			$this->db->update("fault_reporting",$data1);
		}
		$this->db->where("equip_notif_id",$equip_notif_id);
		$data = array("rejected"=>1,"reject_time"=>date("Y-m-d H:i:s"));
		if($this->db->update("equipment_notifications",$data)){
			return true;
		}else{
			return false;
		}
	}
	
	public function addyInstruction($data){
		if($this->db->insert("instructions",$data)){
			return true;
		}else{
			return false;
		}
	}

	public function recordRead($data){
		if($this->db->insert("instructions_track",$data)){
			return true;
		}else{
			return false;
		}
	}
	
	public function aceptRead($data){
		if($this->db->insert("aceptance_track",$data)){
			return true;
		}else{
			return false;
		}
	}

	public function updateInstruction($inst_id,$data){
		
		$this->db->where("id",$inst_id);
		if($this->db->update("instructions",$data)){
				return true;
			}else{
				return false;
			}
	}

	public function deleteInstruction($id){
		$this->db->where("id",$id);
		if($this->db->delete("instructions")){
			return true;
		}else{
			return false;
		}
	}

	public function getInstructionTypeDetails($inst_type_id){
		return $this->db->get_where("instruction_type",array("id"=>$inst_type_id))->result_array();
	}

	public function getDesignation($desig_id){
		return $this->db->get_where("designation",array("id"=>$desig_id))->result_array();
	}
	
	public function getInstTack($id,$agentcode){
		$this->db->order_by("datetime","desc");
		$this->db->limit(1,0);
		$res = $this->db->get_where("instructions_track",array("instruction_id"=>$id,"agentcode"=>$agentcode))->result_array();
		
		return $res;
	}
	
	public function getAllEquipmentNotifications(){
		$this->db->select("*");
		$this->db->from("equipment_notifications");
		$this->db->join("fault_reporting","fault_reporting.id = equipment_notifications.equipment_release_id");
		$this->db->order_by("approval_time","desc");
		$res = $this->db->get()->result_array();
		return $res;
		
	}

	public function getApprovedNotifications(){
		$like = "";
		if($this->userdetails["agentrole"] != 1){
			$units = unserialize($this->userdetails["agentunit"]);
			$units_size = sizeof($units);
			$like = $like."`equipment_notifications`.`unit_id` LIKE '%\"".$units[0]."\"%'";
			
			if($units_size > 1){
				for($i = 1; $i < $units_size; $i++){
					$like = $like." OR `equipment_notifications`.`unit_id` LIKE '%\"".$units[$i]."\"%'";
				
				}
			}		
		}
		$query = $this->db->query("SELECT * 
								FROM (
								`equipment_notifications`
								)
								JOIN  `fault_reporting` ON  `fault_reporting`.`id` =  `equipment_notifications`.`equipment_release_id` 
								WHERE  `equipment_notifications`.`atc_report` =0
								AND (
								`equipment_notifications`.`approved` LIKE  '%1%'
								OR  `equipment_notifications`.`rejected` LIKE  '%1%'
								)
								AND `read` = 0 AND `read_time` IS NULL AND `read_by_user` IS NULL
								 AND ($like)
								ORDER BY  `equip_notif_id` DESC ");
		
		$res = $query->result_array();
		return $res;
	}

	public function getApprovedNotifications_ajax($data){
		$like = "";
		if($this->userdetails["agentrole"] != 1){
			$units = unserialize($this->userdetails["agentunit"]);
			$units_size = sizeof($units);
			$like = $like."`equipment_notifications`.`unit_id` LIKE '%\"".$units[0]."\"%'";
			
			if($units_size > 1){
				for($i = 1; $i < $units_size; $i++){
					$like = $like." OR `equipment_notifications`.`unit_id` LIKE '%\"".$units[$i]."\"%'";
						
				}
			}		
		}
		$where = "";
		if($data["last_approved_notif_id"] != ""){
			$where = "AND equip_notif_id > ".$data["last_approved_notif_id"];
		}
		$query = $this->db->query("SELECT * 
								FROM (
								`equipment_notifications`
								)
								JOIN  `fault_reporting` ON  `fault_reporting`.`id` =  `equipment_notifications`.`equipment_release_id` 
								WHERE  `equipment_notifications`.`atc_report` =0
								".$where."
								AND (
								`equipment_notifications`.`approved` LIKE  '%1%'
								OR  `equipment_notifications`.`rejected` LIKE  '%1%'
								)
								AND `read` = 0 AND `read_time` IS NULL AND `read_by_user` IS NULL
								 AND ($like)
								ORDER BY  `equip_notif_id` ASC ");
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
		$res = $query->result_array();
		
		return $res;
	}

	public function getATCNotifications_ajax($data){
		
		$this->db->select("*");
		$this->db->from("equipment_notifications");
		$this->db->join("fault_reporting","fault_reporting.id = equipment_notifications.equipment_release_id");
		$this->db->where("equipment_notifications.atc_report",1);
		$this->db->where("equipment_notifications.read",0);
		if($data["last_atc_notif_id"] != ""){
			$this->db->where("equip_notif_id > ".$data["last_atc_notif_id"]);
		}
		$this->db->order_by("equip_notif_id","asc");
		$like = "";
		if($this->userdetails["agentrole"] != 1){
			$units = unserialize($this->userdetails["agentunit"]);
			$units_size = sizeof($units);
			$like = $like."`equipment_notifications`.`unit_id` LIKE '%\"".$units[0]."\"%'";
			if($units_size > 1){
				for($i = 1; $i < $units_size; $i++){
					$like = $like." OR `equipment_notifications`.`unit_id` LIKE '%\"".$units[$i]."\"%'";
				}
			}		
		}
		$this->db->where("(".$like.")");
		$res = $this->db->get()->result_array();
		return $res;
	}

	public function getATCNotifications(){
		$this->db->select("*");
		$this->db->from("equipment_notifications");
		$this->db->join("fault_reporting","fault_reporting.id = equipment_notifications.equipment_release_id");
		$this->db->where("equipment_notifications.atc_report",1);
		$this->db->where("equipment_notifications.read",0);
		$this->db->order_by("id","desc");
		
		$like = "";
		if($this->userdetails["agentrole"] != 1){
			$units = unserialize($this->userdetails["agentunit"]);
			$units_size = sizeof($units);
			$like = $like."`equipment_notifications`.`unit_id` LIKE '%\"".$units[0]."\"%'";
			
			if($units_size > 1){
				for($i = 1; $i < $units_size; $i++){
					$like = $like." OR `equipment_notifications`.`unit_id` LIKE '%\"".$units[$i]."\"%'";
				}
			}		
		}
		
		$this->db->where("(".$like.")");
		$res = $this->db->get()->result_array();
		return $res;
		
	}

	public function getUnApprovedNotifications(){
		$like = "";
		if($this->userdetails["agentrole"] != 1){
			$units = unserialize($this->userdetails["agentunit"]);
			$units_size = sizeof($units);
			$like = $like."`equipment_notifications`.`unit_id` LIKE '%\"".$units[0]."\"%'";
			if($units_size > 1){
				for($i = 1; $i < $units_size; $i++){
					$like = $like." OR `equipment_notifications`.`unit_id` LIKE '%\"".$units[$i]."\"%'";
				
				}
			}		
		}
		$this->db->like("(".$like.")");
		$this->db->select("*");
		$this->db->from("equipment_notifications");
		$this->db->join("fault_reporting","fault_reporting.id = equipment_notifications.equipment_release_id");
		$this->db->where("approved",0);
		$this->db->where("rejected",0);
		$this->db->where("atc_report",0);
		$this->db->order_by("equip_notif_id","desc");
		$res = $this->db->get()->result_array();
		return $res;
		
	}

	public function getUnApprovedNotifications_ajax($data){
		$this->db->select("*");
		$this->db->from("equipment_notifications");
		$this->db->join("fault_reporting","fault_reporting.id = equipment_notifications.equipment_release_id");
		$this->db->where("approved",0);
		$this->db->where("rejected",0);
		$this->db->where("atc_report",0);
		if($data["last_unapproved_notif_id"] != ""){
			$this->db->where("equip_notif_id > ".$data["last_unapproved_notif_id"]);
		}
		$this->db->order_by("equip_notif_id","asc");
		$like = "";
		if($this->userdetails["agentrole"] != 1){
			$units = unserialize($this->userdetails["agentunit"]);
			$units_size = sizeof($units);
			$like = $like."`equipment_notifications`.`unit_id` LIKE '%\"".$units[0]."\"%'";
			
			if($units_size > 1){
				for($i = 1; $i < $units_size; $i++){
					$like = $like." OR `equipment_notifications`.`unit_id` LIKE '%\"".$units[$i]."\"%'";
				}
			}		
		}
		$this->db->like("(".$like.")");
		$res = $this->db->get()->result_array();
		return $res;
	}
	
	public function updateATCReport($equip_notif_id,$curr_user_id){
		$this->db->where("equip_notif_id",$equip_notif_id);
		$this->db->update("equipment_notifications",array("read"=>1,"approved"=>0,"rejected"=>0,"read_by_user"=>$curr_user_id,"read_time"=>date("Y-m-d H:i:s")));
	}
}
?>