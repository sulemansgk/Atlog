<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Domain_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}

	public function InsertSubjectForm($data){
		$res = $this->db->get_where("subjectform",array("subject"=>$data["subject"],"unit_id"=>$data["unit_id"]))->result_array();
		if(empty($res)){
			if($this->db->insert("subjectform",$data)){
				return true;
			}else{
				return false;
			}
		}else{
			redirect("domainparameters/viewSubjects?msg=danger");
		}
	}

	public function InsertPositionName($data){
		$res = $this->db->get_where("positionname",array("name"=>$data["name"],"unit_id"=>$data["unit_id"]))->result_array();
		if(empty($res)){
			if($this->db->insert("positionname",$data)){
				return true;
			}else{
				return false;
			}
		}else{
			redirect("domainparameters/viewPositionNames?msg=danger");
		}
	}

	public function getallagents(){
		return $this->db->get("tblagent")->result_array();
	
	}

	public function InsertEquipmentName($data){
		$res = $this->db->get_where("system_equipment",array("name"=>$data["name"],"unit_id"=>$data["unit_id"]))->result_array();
		if(empty($res)){
			if($this->db->insert("system_equipment",$data)){
				return true;
			}else{
				return false;
			}
		}else{
			redirect("domainparameters/viewEquipmentNames?msg=danger");
		}
	}

	public function InsertConsoleNumber($data){
		$res = $this->db->get_where("consolenumber",array("name"=>$data["name"],"unit_id"=>$data["unit_id"]))->result_array();
		if(empty($res)){
			if($this->db->insert("consolenumber",$data)){
				return true;
			}else{
				return false;
			}
		}else{
			redirect("domainparameters/viewConsoleNumbers?msg=danger");
		}
	}

	public function InsertReleasePurpose($data){
		$res = $this->db->get_where("purposeofrelease",array("name"=>$data["name"]))->result_array();
		if(empty($res)){
			if($this->db->insert("purposeofrelease",$data)){
				return true;
			}else{
				return false;
			}
		}else{
			redirect("domainparameters/viewReleasePurposes?msg=danger");
		}
	}

	public function InsertAircraftType($data){
		$res = $this->db->get_where("aircrafttype",array("name"=>$data["name"]))->result_array();
		if(empty($res)){
			if($this->db->insert("aircrafttype",$data)){
				return true;
			}else{
				return false;
			}
		}else{
			redirect("domainparameters/viewAircraftTypes?msg=danger");
		}
	}

	public function InsertAirport($data){
		$res = $this->db->get_where("airport",array("airport"=>$data["airport"]))->result_array();
		if(empty($res)){
			if($this->db->insert("airport",$data)){
				return true;
			}else{
				return false;
			}
		}else{
			redirect("domainparameters/viewAirports?msg=danger");
		}
	}

	public function InsertShift($data){
		$res = $this->db->get_where("shift",array("shift"=>$data["shift"]))->result_array();
		if(empty($res)){
			if($this->db->insert("shift",$data)){
				return true;
			}else{
				return false;
			}
		}else{
			redirect("domainparameters/viewShifts?msg=danger");
		}
	}

	public function InsertStaffAbsenseReason($data){
		$res = $this->db->get_where("staffabsensereason",array("reason"=>$data["reason"]))->result_array();
		if(empty($res)){
			if($this->db->insert("staffabsensereason",$data)){
				return true;
			}else{
				return false;
			}
		}else{
			redirect("domainparameters/viewStaffAbsenseReasons?msg=danger");
		}
	}

	public function InsertRunwayManoeuvringArea($data){
		$res = $this->db->get_where("runwaymanoeuvringarea",array("areaname"=>$data["areaname"]))->result_array();
		if(empty($res)){
			if($this->db->insert("runwaymanoeuvringarea",$data)){
				return true;
			}else{
				return false;
			}
		}else{
			redirect("domainparameters/viewRunwayManoeuvringAreas?msg=danger");
		}
	}

	public function InsertUserRights($data){
		$res = $this->db->get_where("subjectform",array("subject"=>$data["subject"]))->result_array();
		if(empty($res)){
			if($this->db->insert("subjectform",$data)){
				return true;
			}else{
				return false;
			}
		}else{
			return true;
		}
	}

	public function InsertUserRole($data){
		$res = $this->db->get_where("subjectform",array("subject"=>$data["subject"]))->result_array();
		if(empty($res)){
			if($this->db->insert("subjectform",$data)){
				return true;
			}else{
				return false;
			}
		}else{
			return true;
		}
	}

	public function InsertNationality($data){
		$res = $this->db->get_where("nationality",array("nationality"=>$data["nationality"]))->result_array();
		if(empty($res)){
			if($this->db->insert("nationality",$data)){
				return true;
			}else{
				return false;
			}
		}else{
			redirect("domainparameters/viewNationalities?msg=danger");
		}
	}

	public function InsertDesignation($data){
		$res = $this->db->get_where("designation",array("designation"=>$data["designation"]))->result_array();
		if(empty($res)){
			if($this->db->insert("designation",$data)){
				return true;
			}else{
				return false;
			}
		}else{
			redirect("domainparameters/viewDesignations?msg=danger");
		}
	}	

	public function InsertCompany($data){
		$res = $this->db->get_where("company",array("name"=>$data["name"]))->result_array();
		if(empty($res)){
			if($this->db->insert("company",$data)){
				return true;
			}else{
				return false;
			}
		}else{
			redirect("domainparameters/viewCompanies?msg=danger");
		}
	}

	public function insertInstructionType($data){
		$res = $this->db->get_where("instruction_type",array("name"=>$data["name"]))->result_array();
		if(empty($res)){
			if($this->db->insert("instruction_type",$data)){
				return true;
			}else{
				return false;
			}
		}else{
			redirect("domainparameters/viewInstructionTypes?msg=danger");
		}
	}

	public function getAllSubjects(){
		return $this->db->get("subjectform")->result_array();
	}

	public function getAllJobs(){
		return $this->db->get("latest_parajob")->result_array();
	}
	
	public function getAllSubjectsOfSection(){
		return $this->db->get("other_section")->result_array();
	}
	
	public function getallparafrequency(){
		return $this->db->get("latest_frequency")->result_array();
	}
	
	public function getallViewparaLRU(){
		return $this->db->get("latest_lru")->result_array();
	}

	public function getallviewparacalibrationitem(){
		return $this->db->get("latest_calibrationitem")->result_array();
	}
	
	public function getSubject($id){
		return $this->db->get_where("subjectform",array("id"=>$id))->result_array();
	}

	public function updateSubject($log_id,$data){
		
		$this->db->where("id",$log_id);
		if($this->db->update("subjectform",$data)){
			return true;
		}else{
			return false;
		}
	}

	public function deleteSubject($id){
		$this->db->where("id",$id);
		if($this->db->delete("subjectform")){
			return true;
		}else{
			return false;
		}
	}

	public function deleteRolee($id){
		$this->db->where("id",$id);
		if($this->db->delete("agentroles")){
			return true;
		}else{
			return false;
		}
	}

	public function getAllPositions($positions_filter){
		if(!empty($positions_filter)){
			if(!empty($positions_filter["agentunit"])){
				$this->db->where("unit_id",$positions_filter["agentunit"]);							
			}
			if(!empty($positions_filter["keyword"])){
				$this->db->like("name",$positions_filter["keyword"]);							
			}
		}
		return $this->db->get("positionname")->result_array();
	}
	
	public function getAllJob($positions_filter){
		if(!empty($positions_filter)){
			if(!empty($positions_filter["agentunit"])){
				$this->db->where("unit_id",$positions_filter["agentunit"]);							
			}
			if(!empty($positions_filter["keyword"])){
				$this->db->like("name",$positions_filter["keyword"]);							
			}
		}
		return $this->db->get("positionname")->result_array();
	}
	
	public function getPosition($id){
		return $this->db->get_where("positionname",array("id"=>$id))->result_array();
	}

	public function getFrequency($id){
		return $this->db->get_where("latest_frequency",array("id"=>$id))->result_array();
	}

	public function getLRU($id){
		return $this->db->get_where("latest_lru",array("id"=>$id))->result_array();
	}

	public function getCalibration($id){
		return $this->db->get_where("latest_calibrationitem",array("id"=>$id))->result_array();
	}

	public function getJobCard($id){
		return $this->db->get_where("latest_parajob",array("id"=>$id))->result_array();
	}

	public function getOtherSection($id){
		return $this->db->get_where("other_section",array("id"=>$id))->result_array();
	}

	public function updateFrequency($log_id,$data){
		$this->db->where("id",$log_id);
		if($this->db->update("latest_frequency",$data)){
			return true;
		}else{
			return false;
		}
	}

	public function updateLRU($log_id,$data){
		$this->db->where("id",$log_id);
		if($this->db->update("latest_lru",$data)){
			return true;
		}else{
			return false;
		}
	}

	public function updateCalibration($log_id,$data){
		$this->db->where("id",$log_id);
		if($this->db->update("latest_calibrationitem",$data)){
			return true;
		}else{
			return false;
		}
	}

	public function updateJobCard($log_id,$data){
		$this->db->where("id",$log_id);
		if($this->db->update("latest_parajob",$data)){
			return true;
		}else{
			return false;
		}
	}

	public function updateOtherSection($log_id,$data){
		
		$this->db->where("id",$log_id);
		if($this->db->update("other_section",$data)){
			return true;
		}else{
			return false;
		}
	}

	public function updatePosition($log_id,$data){
		$this->db->where("id",$log_id);
		if($this->db->update("positionname",$data)){
			return true;
		}else{
			return false;
		}
	}

	public function deletePosition($id){
		$this->db->where("id",$id);
		if($this->db->delete("positionname")){
			return true;
		}else{
			return false;
		}
	}

	public function getAllEquipments($equipments_filter){
		if(!empty($equipments_filter)){
			if(!empty($equipments_filter["agentunit"])){
				$this->db->where("unit_id",$equipments_filter["agentunit"]);							
			}
			if(!empty($equipments_filter["keyword"])){
				$this->db->like("name",$equipments_filter["keyword"]);							
			}
		
		}
		return $this->db->get("system_equipment")->result_array();
	}

	public function getEquipment($id){
		return $this->db->get_where("system_equipment",array("id"=>$id))->result_array();
	}

	public function updateEquipment($log_id,$data){
		$this->db->where("id",$log_id);
		if($this->db->update("system_equipment",$data)){
			return true;
		}else{
			return false;
		}
	}

	public function deleteEquipment($id){
		$this->db->where("id",$id);
		if($this->db->delete("system_equipment")){
			return true;
		}else{
			return false;
		}
	}

	public function getAllConsoleNumbers($console_filter){
		if(!empty($console_filter)){
			if(!empty($console_filter["agentunit"])){
				$this->db->where("unit_id",$console_filter["agentunit"]);							
			}
			if(!empty($console_filter["keyword"])){
				$this->db->like("name",$console_filter["keyword"]);							
			}
		}
		return $this->db->get("consolenumber")->result_array();
	}

	public function getConsoleNumber($id){
		return $this->db->get_where("consolenumber",array("id"=>$id))->result_array();
	}

	public function updateConsoleNumber($log_id,$data){
		$this->db->where("id",$log_id);
		if($this->db->update("consolenumber",$data)){
			return true;
		}else{
			return false;
		}
	}

	public function deleteConsoleNumber($id){
		$this->db->where("id",$id);
		if($this->db->delete("consolenumber")){
			return true;
		}else{
			return false;
		}
	}

	public function deleteFrequency($id){
		$this->db->where("id",$id);
		if($this->db->delete("latest_frequency")){
			return true;
		}else{
			return false;
		}
	}

	public function deleteLRU($id){
		$this->db->where("id",$id);
		if($this->db->delete("latest_lru")){
			return true;
		}else{
			return false;
		}
	}

	public function deleteCalibration($id){
		$this->db->where("id",$id);
		if($this->db->delete("latest_calibrationitem")){
			return true;
		}else{
			return false;
		}
	}

	public function deleteJobCard($id){
		$this->db->where("id",$id);
		if($this->db->delete("latest_parajob")){
			return true;
		}else{
			return false;
		}
	}

	public function deleteOtherSection($id){
		$this->db->where("id",$id);
		if($this->db->delete("other_section")){
			return true;
		}else{
			return false;
		}
	}

	public function getAllReleasePurposes(){
		return $this->db->get("purposeofrelease")->result_array();
	}

	public function getReleasePurpose($id){
		return $this->db->get_where("purposeofrelease",array("id"=>$id))->result_array();
	}

	public function updateReleasePurpose($log_id,$data){
		$this->db->where("id",$log_id);
		if($this->db->update("purposeofrelease",$data)){
			return true;
		}else{
			return false;
		}
	}

	public function deleteReleasePurpose($id){
		$this->db->where("id",$id);
		if($this->db->delete("purposeofrelease")){
			return true;
		}else{
			return false;
		}
	}

	public function getAllAircraftTypes(){
		$this->db->order_by("name", "DESC");
		$this->db->limit(100);
	    return $this->db->get("aircrafttype")->result_array();
	}

	public function getAircraftType($id){
		return $this->db->get_where("aircrafttype",array("id"=>$id))->result_array();
	}

	public function updateAircraftType($log_id,$data){
		$this->db->where("id",$log_id);
		if($this->db->update("aircrafttype",$data)){
			return true;
		}else{
			return false;
		}
	}

	public function deleteAircraftType($id){
		$this->db->where("id",$id);
		if($this->db->delete("aircrafttype")){
			return true;
		}else{
			return false;
		}
	}

	public function getAllAirports(){
		return $this->db->get("airport")->result_array();
	}

	public function getAirport($id){
		return $this->db->get_where("airport",array("id"=>$id))->result_array();
	}

	public function updateAirport($log_id,$data){
		$this->db->where("id",$log_id);
		if($this->db->update("airport",$data)){
			return true;
		}else{
			return false;
		}
	}

	public function deleteAirport($id){
		$this->db->where("id",$id);
		if($this->db->delete("airport")){
			return true;
		}else{
			return false;
		}
	}

	public function getAllShifts(){
		return $this->db->get("shift")->result_array();
	}

	public function getShift($id){
		return $this->db->get_where("shift",array("id"=>$id))->result_array();
	}

	public function updateShift($log_id,$data){
		$this->db->where("id",$log_id);
		if($this->db->update("shift",$data)){
			return true;
		}else{
			return false;
		}
	}

	public function deleteShift($id){
		$this->db->where("id",$id);
		if($this->db->delete("shift")){
			return true;
		}else{
			return false;
		}
	}

	public function getAllStaffAbsenseReasons(){
		return $this->db->get("staffabsensereason")->result_array();
	}

	public function getStaffAbsenseReason($id){
		return $this->db->get_where("staffabsensereason",array("id"=>$id))->result_array();
	}

	public function updateStaffAbsenseReason($log_id,$data){
		$this->db->where("id",$log_id);
		if($this->db->update("staffabsensereason",$data)){
			return true;
		}else{
			return false;
		}
	}

	public function deleteStaffAbsenseReason($id){
		$this->db->where("id",$id);
		if($this->db->delete("staffabsensereason")){
			return true;
		}else{
			return false;
		}
	}

	public function getAllRunwayManoeuvringAreas($rma_filter){
		if(!empty($rma_filter)){
			if(!empty($rma_filter["agentunit"])){
				$this->db->where("unit_id",$rma_filter["agentunit"]);
			}
			if(!empty($rma_filter["keyword"])){
				$this->db->like("areaname",$rma_filter["keyword"]);							
			}
		}
		return $this->db->get("runwaymanoeuvringarea")->result_array();
	}

	public function getRunwayManoeuvringArea($id){
		return $this->db->get_where("runwaymanoeuvringarea",array("id"=>$id))->result_array();
	}

	public function updateRunwayManoeuvringArea($log_id,$data){
		$this->db->where("id",$log_id);
		if($this->db->update("runwaymanoeuvringarea",$data)){
			return true;
		}else{
			return false;
		}
	}

	public function deleteRunwayManoeuvringArea($id){
		$this->db->where("id",$id);
		if($this->db->delete("runwaymanoeuvringarea")){
			return true;
		}else{
			return false;
		}
	}

	public function getAllNationalities(){
		return $this->db->get("nationality")->result_array();
	}

	public function getNationality($id){
		return $this->db->get_where("nationality",array("id"=>$id))->result_array();
	}

	public function updateNationality($log_id,$data){
		$this->db->where("id",$log_id);
		if($this->db->update("nationality",$data)){
			return true;
		}else{
			return false;
		}
	}

	public function deleteNationality($id){
		$this->db->where("id",$id);
		if($this->db->delete("nationality")){
			return true;
		}else{
			return false;
		}
	}

	public function getAllDesignations(){
		return $this->db->get("designation")->result_array();
	}

	public function getDesignation($id){
		return $this->db->get_where("designation",array("id"=>$id))->result_array();
	}

	public function updateDesignation($log_id,$data){
		$this->db->where("id",$log_id);
		if($this->db->update("designation",$data)){
			return true;
		}else{
			return false;
		}
	}

	public function deleteDesignation($id){
		$this->db->where("id",$id);
		if($this->db->delete("designation")){
			return true;
		}else{
			return false;
		}
	}

	public function getAllCompanies(){
		return $this->db->get("company")->result_array();
	}

	public function getCompany($id){
		return $this->db->get_where("company",array("id"=>$id))->result_array();
	}

	public function updateCompany($log_id,$data){
		$this->db->where("id",$log_id);
		if($this->db->update("company",$data)){
			return true;
		}else{
			return false;
		}
	}

	public function deleteCompany($id){
		$this->db->where("id",$id);
		if($this->db->delete("company")){
			return true;
		}else{
			return false;
		}
	}

	public function getAllInstructionTypes(){
		return $this->db->get("instruction_type")->result_array();
	}

	public function getInstructionType($id){
		return $this->db->get_where("instruction_type",array("id"=>$id))->result_array();
	}

	public function updateInstructionType($log_id,$data){
		$this->db->where("id",$log_id);
		if($this->db->update("instruction_type",$data)){
			return true;
		}else{
			return false;
		}
	}

	public function deleteInstructionType($id){
		$this->db->where("id",$id);
		if($this->db->delete("instruction_type")){
			return true;
		}else{
			return false;
		}
	}

	public function insertEmail($data){
		$res = $this->db->get_where("email",array("email_address"=>$data["email_address"]))->result_array();
		if(empty($res)){
			if($this->db->insert("email",$data)){
				return true;
			}else{
				return false;
			}
		}else{
			redirect("domainparameters/viewEmails?msg=danger");
		}
	}
	
	public function getAllEmails($emails_filter){
		if(!empty($emails_filter)){
			if(!empty($emails_filter["agentunit"])){
				$this->db->where("unit_id",$emails_filter["agentunit"]);							
			}
			if(!empty($emails_filter["keyword"])){
				$this->db->like("email_address",$emails_filter["keyword"]);							
			}
		}
		return $this->db->get("email")->result_array();
	}
	
	public function getEmail($email_id){
		return $this->db->get_where("email",array("email_id"=>$email_id))->result_array();
	}
	
	public function updateEmail($email_id,$data){
		$this->db->where("email_id",$email_id);
		if($this->db->update("email",$data)){
			return true;
		}else{
			return false;
		}
	}

	public function deleteEmail($email_id){
		$this->db->where("email_id",$email_id);
		if($this->db->delete("email")){
			return true;
		}else{
			return false;
		}
	}

	public function insertPhone($data){
		$res = $this->db->get_where("phone",array("phone_number"=>$data["phone_number"]))->result_array();
		if(empty($res)){
			if($this->db->insert("phone",$data)){
				return true;
			}else{
				return false;
			}
		}else{
			redirect("domainparameters/viewPhones?msg=danger");
		}
	}

	public function insertRunway($data){
		$res = $this->db->get_where("runway",array("runway"=>$data["runway"]))->result_array();
		if(empty($res)){
			if($this->db->insert("runway",$data)){
				return true;
			}else{
				return false;
			}
		}else{
			redirect("domainparameters/viewRunways?msg=danger");
		}
	}

	public function getAllPhones($phone_filter){
		if(!empty($phone_filter)){
			if(!empty($phone_filter["agentunit"])){
				$this->db->where("unit_id",$phone_filter["agentunit"]);							
			}
			if(!empty($phone_filter["keyword"])){
				$this->db->like("phone_number",$phone_filter["keyword"]);							
			}
		}
		return $this->db->get("phone")->result_array();
	}

	public function getAllRunways($runway_filter){
		if(!empty($runway_filter)){
			if(!empty($runway_filter["agentunit"])){
				$this->db->where("runway.unit_id",$runway_filter["agentunit"]);							
			}
			if(!empty($runway_filter["keyword"])){
				$this->db->like("runway.runway",$runway_filter["keyword"]);							
			}
		}
		$res = $this->db->get("runway")->result_array();
		return $res;
	}
	
	public function getPhone($phone_id){
		return $this->db->get_where("phone",array("phone_id"=>$phone_id))->result_array();
	}

	public function getRunway($runway_id){
		return $this->db->get_where("runway",array("runway_id"=>$runway_id))->result_array();
	}
	
	public function updatePhone($phone_id,$data){
		$this->db->where("phone_id",$phone_id);
		if($this->db->update("phone",$data)){
			return true;
		}else{
			return false;
		}
	}

	public function updateRunway($runway_id,$data){
		$this->db->where("runway_id",$runway_id);
		if($this->db->update("runway",$data)){
			return true;
		}else{
			return false;
		}
	}

	public function deletePhone($phone_id){
		$this->db->where("phone_id",$phone_id);
		if($this->db->delete("phone")){
			return true;
		}else{
			return false;
		}
	}

	public function deleteRunway($runway_id){
		$this->db->where("runway_id",$runway_id);
		if($this->db->delete("runway")){
			return true;
		}else{
			return false;
		}
	}

	public function getFormEmails($for_form){
		if($this->userdetails["agentrole"] != 1){
			$units = unserialize($this->userdetails["agentunit"]);
			$this->db->where_in("agentunit",$units);
		}
		$this->db->like("for_form",$for_form);
		$res = $this->db->get("email")->result_array();
		return $res;
	}
	
	public function getFormPhones($for_form){
		$units = unserialize($this->userdetails["agentunit"]);
		$this->db->where_in("agentunit",$units);		
		$this->db->like("for_form",$for_form);
		return $this->db->get("phone")->result_array();
	}
	
	public function getInstructionTypeById($instruction_type_id){
		$res = $this->db->get_where("instruction_type",array("id"=>$instruction_type_id))->result_array();	
		return $res[0]["name"];
	}
	
}
?>