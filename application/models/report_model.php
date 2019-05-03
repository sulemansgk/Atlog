<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}

	public function getGeneralEntryLogs($param){
		$this->db->select("generalentry.id as ge_id,generalentry.initial as ge_initial, generalentry.onbehalf as ge_onbehalf, 
											generalentry.subject as ge_subject, generalentry.description as ge_description,
											generalentry.datetime as ge_datetime, generalentry.actions as ge_actions, 
											generalentry.management as ge_management,
											subjectform.id as subject_id, subjectform.subject as subject_subject,
											tblagent.agentcode as onbehalf_agentcode, tblagent.agentname as onbehalf_agentname");
		$this->db->from("generalentry");
		$this->db->join("subjectform","generalentry.subject=subjectform.id","left");
		$this->db->join("tblagent","generalentry.onbehalf=tblagent.agentcode","left");
		
		if( ($param["from"] != "") && ($param["to"] != "") ){
			$this->db->where("`generalentry.datetime` between '".$param["from"]." 00:00:00' AND '".$param["to"]." 23:59:59'");		
		}else if( ($param["from"] == "") && ($param["to"] != "") ){
			$this->db->where("`generalentry.datetime` < '".$param["to"]." 23:59:59'");				
		}else if( ($param["from"] != "") && ($param["to"] == "") ){
			$this->db->where("`generalentry.datetime` > '".$param["from"]." 00:00:00'");				
		}
		
		if(!empty($param["initial"])){
			$this->db->where("generalentry.initial",$param["initial"]);
		}
		if(!empty($param["subject"])){
			$this->db->where("generalentry.subject",$param["subject"]);
		}
		if(!empty($param["onbehalf"])){
			$this->db->where("generalentry.onbehalf",$param["onbehalf"]);
		}
		if(!empty($param["initial"])){
			$this->db->where("generalentry.initial",$param["initial"]);
		}
		$res = $this->db->get()->result_array();
		if(!empty($res)){
			foreach($res as $key=>$row){
				$initial_details = $this->db->get_where("tblagent",array("agentcode"=>$row["ge_initial"]))->result_array();
				if(!empty($initial_details)){
					$res[$key]["initial_details"] = $initial_details[0];
				}else{
					$res[$key]["initial_details"] = array();				
				}
			}
		}
		return $res;
	}

	public function getFormLogs($param){
		$from =  date('Y-m-d',strtotime($param['from']));
		$to =  date('Y-m-d',strtotime($param['to']));
		
		$sql_datetime = "";
		if( ($from != "") && ($to != "") ){		
			$sql_datetime = "`datetime` between '".$from." 00:00:00' AND '".$to." 23:59:59'";		
		}else if( ($from == "") && ($to != "") ){				
			$sql_datetime = "`datetime` < '".$to." 23:59:59'";				
		}else if( ($from != "") && ($to == "") ){			
			$sql_datetime = "`datetime` > '".$from." 00:00:00'";				
		}
		
		$like = "";
		if(!empty($param["unit_id"])){
			$like = " AND `form_logs`.`unit_id` LIKE '%\"".$param["unit_id"]."\"%'";
		}
		
		$res = $this->db->query("SELECT * FROM (`form_logs`) WHERE $sql_datetime AND ( 
																	  `log_table` = 'generalentry' 
																	   OR `log_table` = 'aircraftdiversion' 
																	   OR `log_table` = 'controlmobile' 
																	   OR `log_table` = 'rwy' 
															           OR `log_table` = 'rwy_area_inspection' 
																       OR `log_table` = 'atcfacility' 
																	   OR `log_table` = 'agl' 
																	   OR `log_table` = 'lvp' 
																	   OR `log_table` = 'emergency_formdata'
                             										   OR `log_table` = 'met_condition' )
																	$like")->result_array();
		
		foreach($res as $key=>$row){
			$this->db->select("*");
			$this->db->from($row["log_table"]);
			$this->db->where($row["log_table"].".id",$row["log_id"]);
			
			if(!empty($param["initial"])){
				$this->db->where($row["log_table"].".initial",$param["initial"]);
			}
			
			if(!empty($param["subject"])){
				if($row["log_table"] == "generalentry"){
					$this->db->where_in($row["log_table"].".subject",$param["subject"]);
					$this->db->join("subjectform",$row["log_table"].".subject=subjectform.id","left");
				}else if($row["log_table"] == "emergency_formdata"){			
					$this->db->where_in($row["log_table"].".type_of_incident",$param["subject"]);					
				}else{								
					$this->db->where_in($row["log_table"].".subject",$param["subject"]);									
				}
			}
			$this->db->join("tblagent",$row["log_table"].".initial=tblagent.agentcode","left");
			$log_details = $this->db->get()->result_array();
			if(!empty($log_details)){
				$res[$key]["details"] = $log_details[0];			
			}else{
				unset($res[$key]);
			}
		}
		return $res;
	}

	public function getSupervisorLogs($param){
		$from =  date('Y-m-d',strtotime($param['from']));
		$to =  date('Y-m-d',strtotime($param['to']));
		$this->db->select("generalentry.id as ge_id,generalentry.initial as ge_initial, generalentry.onbehalf as ge_onbehalf, 
											generalentry.subject as ge_subject, generalentry.description as ge_description,
											generalentry.datetime as ge_datetime, generalentry.actions as ge_actions, 
											generalentry.management as ge_management,
											subjectform.id as subject_id, subjectform.subject as subject_subject,
											tblagent.agentcode as onbehalf_agentcode, tblagent.agentname as onbehalf_agentname,
											form_logs.unit_id, form_logs.log_id,form_logs.log_type");
		$this->db->from("generalentry");
		$this->db->join("subjectform","generalentry.subject=subjectform.id","left");
		$this->db->join("tblagent","generalentry.onbehalf=tblagent.agentcode","left");
		$this->db->join("form_logs","generalentry.id=form_logs.log_id","left");

		if( ($from != "") && ($to != "") ){
			$this->db->where("`generalentry.datetime` between '".$from." 00:00:00' AND '".$to." 23:59:59'");		
		}else if( ($from == "") && ($to != "") ){
			$this->db->where("`generalentry.datetime` < '".$to." 23:59:59'");				
		}else if( ($from != "") && ($to == "") ){
			$this->db->where("`generalentry.datetime` > '".$from." 00:00:00'");				
		}
		
		$this->db->where("subjectform.supervisor_report = 'on'");
		if(!empty($param["initial"])){
			$this->db->where("generalentry.initial",$param["initial"]);
		}
		if(!empty($param["subject"])){
			$this->db->where("generalentry.subject",$param["subject"]);
		}
		if(!empty($param["onbehalf"])){
			$this->db->where("generalentry.onbehalf",$param["onbehalf"]);
		}
		if(!empty($param["initial"])){
			$this->db->where("generalentry.initial",$param["initial"]);
		}
		if(!empty($param["unit_id"])){
			$this->db->like("form_logs.unit_id",'"'.$param["unit_id"].'"');
		}
		$this->db->like("form_logs.log_type","generalentry");
		$res = $this->db->get()->result_array();
	
		if(!empty($res)){
			foreach($res as $key=>$row){
				$initial_details = $this->db->get_where("tblagent",array("agentcode"=>$row["ge_initial"]))->result_array();
				if(!empty($initial_details)){
					$res[$key]["initial_details"] = $initial_details[0];
				}else{
					$res[$key]["initial_details"] = array();				
				}
			}
		}
		
		
		return $res;
	}

	public function getManagementLogs($param){
		$from =  date('Y-m-d',strtotime($param['from']));
		$to =  date('Y-m-d',strtotime($param['to']));

		$this->db->select("generalentry.id as ge_id,generalentry.initial as ge_initial, generalentry.onbehalf as ge_onbehalf, 
											generalentry.subject as ge_subject, generalentry.description as ge_description,
											generalentry.datetime as ge_datetime, generalentry.actions as ge_actions, 
											generalentry.management as ge_management,
											subjectform.id as subject_id, subjectform.subject as subject_subject,
											tblagent.agentcode as onbehalf_agentcode, tblagent.agentname as onbehalf_agentname,
											form_logs.unit_id, form_logs.log_id,form_logs.log_type");
		$this->db->from("generalentry");
		$this->db->join("subjectform","generalentry.subject=subjectform.id","left");
		$this->db->join("tblagent","generalentry.onbehalf=tblagent.agentcode","left");
		$this->db->join("form_logs","generalentry.id=form_logs.log_id","left");
		
		if( ($from != "") && ($to != "") ){
			$this->db->where("`generalentry.datetime` between '".$from." 00:00:00' AND '".$to." 23:59:59'");		
		}else if( ($from == "") && ($to != "") ){
			$this->db->where("`generalentry.datetime` < '".$to." 23:59:59'");				
		}else if( ($from != "") && ($to == "") ){
			$this->db->where("`generalentry.datetime` > '".$from." 00:00:00'");				
		}
		
		$this->db->where("subjectform.management_report = 'on'");
		if(!empty($param["initial"])){
			$this->db->where("generalentry.initial",$param["initial"]);
		}
		if(!empty($param["subject"])){
			$this->db->where("generalentry.subject",$param["subject"]);
		}
		if(!empty($param["onbehalf"])){
			$this->db->where("generalentry.onbehalf",$param["onbehalf"]);
		}
		if(!empty($param["unit_id"])){
			$this->db->like("form_logs.unit_id",'"'.$param["unit_id"].'"');
		}
		$this->db->like("form_logs.log_type","generalentry");
		$res = $this->db->get()->result_array();
		if(!empty($res)){
			foreach($res as $key=>$row){
				$initial_details = $this->db->get_where("tblagent",array("agentcode"=>$row["ge_initial"]))->result_array();
				if(!empty($initial_details)){
					$res[$key]["initial_details"] = $initial_details[0];
				}else{
					$res[$key]["initial_details"] = array();				
				}
			}
		}
		return $res;
	}

	public function getFaultReportingLogs($param){
		$from =  date('Y-m-d',strtotime($param['from']));
		$to =  date('Y-m-d',strtotime($param['to']));
		
		/* generalentry.id as ge_id,generalentry.initial as ge_initial, generalentry.onbehalf as ge_onbehalf, 
		generalentry.subject as ge_subject, generalentry.description as ge_description,
		generalentry.datetime as ge_datetime, generalentry.actions as ge_actions, 
		generalentry.management as ge_management, */
		$this->db->select("fault_reporting.id as fr_id, fault_reporting.datetime as fr_datetime,fault_reporting.initial as fr_initial,fault_reporting.faultNum as fr_faultNum,
												fault_reporting.onbehalf as fr_onbehalf, fault_reporting.actions as fr_actions,
												fault_reporting.management as fr_management,
												fault_reporting.ate as fr_ate, fault_reporting.position_name as fr_position_name,
												fault_reporting.console_number as fr_console_number, fault_reporting.system_equipment as fr_system_equipment,
												fault_reporting.purpose_of_release as fr_purpose_of_release, fault_reporting.form_datetime as fr_form_date_time,
												fault_reporting.frn as fr_frn, fault_reporting.error_text as fr_error_text, fault_reporting.frnstatus as fr_frnstatus,fault_reporting.any_other_details as fr_any_other_details,
												tblagent.agentcode as onbehalf_agentcode, tblagent.agentname as onbehalf_agentname,
												form_logs.unit_id, form_logs.log_id, form_logs.log_type");
		$this->db->from("fault_reporting");
		
		$this->db->join("tblagent","fault_reporting.onbehalf=tblagent.agentcode","left");
		$this->db->join("form_logs","fault_reporting.id=form_logs.log_id");
		
		if( ($from != "") && ($to != "") ){
			$this->db->where("`fault_reporting.datetime` between '".$from." 00:00:00' AND '".$to." 23:59:59'");		
		}else if( ($from == "") && ($to != "") ){
			$this->db->where("`fault_reporting.datetime` < '".$to." 23:59:59'");				
		}else if( ($from != "") && ($to == "") ){
			$this->db->where("`fault_reporting.datetime` > '".$from." 00:00:00'");				
		}
		
		if(!empty($param["initial"])){
			$this->db->where("fault_reporting.initial",$param["initial"]);
		}
		if(!empty($param["onbehalf"])){
			$this->db->where("fault_reporting.onbehalf",$param["onbehalf"]);
		}
		if(!empty($param["position_name"])){
			$this->db->like("fault_reporting.position_name",$param["position_name"]);
		}
		if(!empty($param["console_number"])){
			$this->db->like("fault_reporting.console_number",$param["console_number"]);
		}
		if(!empty($param["system_equipment"])){
			$this->db->like("fault_reporting.system_equipment",$param["system_equipment"]);
		}
		if(!empty($param["purpose_of_release"])){
			$this->db->like("fault_reporting.purpose_of_release",$param["purpose_of_release"]);
		}
		if(!empty($param["frnstatus"])){
			$this->db->where("fault_reporting.frnstatus",$param["frnstatus"]);
		}
		if(!empty($param["unit_id"])){
			$this->db->like("form_logs.unit_id",'"'.$param["unit_id"].'"');
		}
		$this->db->like("form_logs.log_type","fault");
		$res = $this->db->get()->result_array();

		if(!empty($res)){
			foreach($res as $key=>$row){
				$initial_details = $this->db->get_where("tblagent",array("agentcode"=>$row["fr_initial"]))->result_array();
				if(!empty($initial_details)){
					$res[$key]["initial_details"] = $initial_details[0];
				}else{
					$res[$key]["initial_details"] = array();				
				}
			}
		}
		
		return $res;
	}
	
	public function getjobsearch($param){
	
		$this->db->select("*");
		$this->db->from("jobcard");

		if( ($param["from"] != "") && ($param["to"] != "") ){
			$this->db->where("`jobcard.datetime` between '".$param["from"]." 00:00:00' AND '".$param["to"]." 23:59:59'");		
		}else if( ($param["from"] == "") && ($param["to"] != "") ){
			$this->db->where("`jobcard.datetime` < '".$param["to"]." 23:59:59'");				
		}else if( ($param["from"] != "") && ($param["to"] == "") ){
			$this->db->where("`jobcard.datetime` > '".$param["from"]." 00:00:00'");				
		}
		
		if(!empty($param["initial"])){
			$this->db->where("fault_reporting.initial",$param["initial"]);
		}
		if(!empty($param["onbehalf"])){
			$this->db->where("fault_reporting.onbehalf",$param["onbehalf"]);
		}
		if(!empty($param["position_name"])){
			$this->db->like("fault_reporting.position_name",$param["position_name"]);
		}
		if(!empty($param["console_number"])){
			$this->db->like("fault_reporting.console_number",$param["console_number"]);
		}
		if(!empty($param["system_equipment"])){
			$this->db->like("fault_reporting.system_equipment",$param["system_equipment"]);
		}
		if(!empty($param["purpose_of_release"])){
			$this->db->like("fault_reporting.purpose_of_release",$param["purpose_of_release"]);
		}
		if(!empty($param["frnstatus"])){
			$this->db->where("fault_reporting.frnstatus",$param["frnstatus"]);
		}
		if(!empty($param["unit_id"])){
			$this->db->like("form_logs.unit_id",'"'.$param["unit_id"].'"');
		}
	
		$res = $this->db->get()->result_array();
		
		if(!empty($res)){
			foreach($res as $key=>$row){
				$initial_details = $this->db->get_where("tblagent",array("agentcode"=>$row["initial"]))->result_array();
				if(!empty($initial_details)){
					$res[$key]["initial_details"] = $initial_details[0];
				}else{
					$res[$key]["initial_details"] = array();				
				}
			}
		}
		return $res;
	}
	
	public function getAllEquipments(){
		return $this->db->get("system_equipment")->result_array();
	}

	public function getAllPositions(){
		return $this->db->get("positionname")->result_array();
	}

	public function getAllConsoleNumbers(){
		return $this->db->get("consolenumber")->result_array();
	}
	
	public function getAllUnits(){
		if($this->userdetails["agentrole"] != 1){
			$this->db->where_in("unit_id",unserialize($this->userdetails["agentunit"]));
		}
		return $this->db->get("units")->result_array();
	}
}
?>