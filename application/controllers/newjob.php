<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class domainparameters extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("emergency_model");
		$this->load->model("base_model");
		$this->load->model("domain_model");
		$this->load->library("session");
		$this->load->model("instructions_model");		
		$this->userdetails = $this->session->userdata("userdetails");
		if(empty($this->userdetails)){
			redirect(base_url());
		}
		$this->load->model("user_model");
		if(!empty($this->userdetails)){
			$this->userdetails["permissions"] = $this->user_model->getUserPermissions($this->userdetails["role_id"]);
		}
		
	}
	public function SubjectForm(){
		$this->load->view('header',array("page"=>"Subject Form"));
		$this->load->view("DomainParameters/SubjectForm");
		$this->load->view("footer");
	}
	public function PositionName(){
		$viewData = array();
		$viewData["units"] = $this->user_model->getAllUnits();
		$this->load->view('header',array("page"=>"Position Name"));
		$this->load->view("DomainParameters/PositionName",$viewData);
		$this->load->view("footer");
	}
	public function EquipmentName(){
		$viewData = array();
		$viewData["units"] = $this->user_model->getAllUnits();
		$this->load->view('header',array("page"=>"Equipment Name"));
		$this->load->view("DomainParameters/EquipmentName",$viewData);
		$this->load->view("footer");
	}
	public function ConsoleNumber(){
		$viewData = array();
		$viewData["units"] = $this->user_model->getAllUnits();
		$this->load->view('header',array("page"=>"Console Number"));
		$this->load->view("DomainParameters/ConsoleNumber",$viewData);
		$this->load->view("footer");
	}
	public function ReleasePurpose(){
		$this->load->view('header',array("page"=>"Release purpose"));
		$this->load->view("DomainParameters/ReleasePurpose");
		$this->load->view("footer");
	}
	public function AircraftType(){
		$this->load->view('header',array("page"=>"AirCraft Type"));
		$this->load->view("DomainParameters/AircraftType");
		$this->load->view("footer");
	}
	public function Airport(){
		$this->load->view('header',array("page"=>"Airport"));
		$this->load->view("DomainParameters/Airport");
		$this->load->view("footer");
	}
	public function Shift(){
		$this->load->view('header',array("page"=>"Shift"));
		$this->load->view("DomainParameters/Shift");
		$this->load->view("footer");
	}
	public function StaffAbsenseReason(){
		$this->load->view('header',array("page"=>"Staff Absence Reason"));
		$this->load->view("DomainParameters/StaffAbsenseReason");
		$this->load->view("footer");
	}
	public function RunwayManoeuvringArea(){
		$viewData = array();
		$viewData["units"] = $this->user_model->getAllUnits();
		$this->load->view('header',array("page"=>"Runway Manoeuvring Area"));
		$this->load->view("DomainParameters/RunwayManoeuvringArea",$viewData);
		$this->load->view("footer");
	}
	public function UserRights(){
		$this->load->view('header',array("page"=>"User Rights"));
		$this->load->view("DomainParameters/UserRights");
		$this->load->view("footer");
	}
	public function UserRole(){
		$this->load->view('header',array("page"=>"User Role"));
		$this->load->view("DomainParameters/UserRole");
		$this->load->view("footer");
	}
	public function Nationality(){
		$this->load->view('header',array("page"=>"Nationality"));
		$this->load->view("DomainParameters/Nationality");
		$this->load->view("footer");
	}
	public function Designation(){
		$this->load->view('header',array("page"=>"Designation"));
		$this->load->view("DomainParameters/Designation");
		$this->load->view("footer");
	}
	public function Company(){
		$this->load->view('header',array("page"=>"Company"));
		$this->load->view("DomainParameters/Company");
		$this->load->view("footer");
	}
		
	public function newjob(){
		if($this->domain_model->InsertAircraftType($_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"		=>	"Insert Aircraft Type Domain Parameter: ".$_POST["name"],
							"log_datetime"	=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	""
						);
			$this->base_model->insertAccessLog($acceslog_data);
			$this->load->view("header");
			$this->load->view("success_view");
			$this->load->view("footer");
		}else{
			$this->load->view("header");
			$this->load->view("error_view");
			$this->load->view("footer");		
		}
	}
	
	public function latestparacustomer() {
		$this->load->view("header",array("page"=>"Domain Parameter Customer"));
		$this->load->view("latestdomain/paracustomer");
		$this->load->view("footer");	
	}
	
	public function latestfrequency() {
		$this->load->view("header",array("page"=>"Domain Parameter frequency"));
		$this->load->view("latestdomain/frequency");
		$this->load->view("footer");	
	}
	public function latestLRU() {
		$this->load->view("header",array("page"=>"Domain Parameter frequency"));
		$this->load->view("latestdomain/LRU");
		$this->load->view("footer");	
	}
	public function latestcalibrationitem() {
		$this->load->view("header",array("page"=>"Domain Parameter frequency"));
		$this->load->view("latestdomain/calibrationitem");
		$this->load->view("footer");	
	}
	public function latestparappe() {
		$this->load->view("header",array("page"=>"PPE ( Personal Protection Equipment)"));
		$this->load->view("latestdomain/parappe");
		$this->load->view("footer");	
	}
	public function latestparajob() {
		$this->load->view("header",array("page"=>"PPE ( Personal Protection Equipment)"));
		$this->load->view("latestdomain/parajob");
		$this->load->view("footer");	
	}
	
	public function instructionType(){
		$this->load->view('header',array("page"=>"Instruction Type"));
		$this->load->view("DomainParameters/instructionType");
		$this->load->view("footer");
	}
	public function insertInstructionType(){
		if($this->domain_model->insertInstructionType($_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"		=>	"Insert Instruction Type Domain Parameter: ".$_POST["name"],
							"log_datetime"	=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	""
						);
			$this->base_model->insertAccessLog($acceslog_data);
			$this->load->view("header");
			$this->load->view("success_view");
			$this->load->view("footer");
		}else{
			$this->load->view("header");
			$this->load->view("error_view");
			$this->load->view("footer");		
		}
	}	
	public function InsertSubjectForm(){
		if($this->domain_model->InsertSubjectForm($_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"		=>	"Insert Subject Domain Parameter: ".$_POST["subject"],
							"log_datetime"	=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	""
						);
			$this->base_model->insertAccessLog($acceslog_data);
			$this->load->view("header");
			$this->load->view("success_view");
			$this->load->view("footer");
		}else{
			$this->load->view("header");
			$this->load->view("error_view");
			$this->load->view("footer");		
		}
	}
	public function InsertPositionName(){
		if($this->domain_model->InsertPositionName($_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"		=>	"Insert Position Name Domain Parameter: ".$_POST["name"],
							"log_datetime"	=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	""
						);
			$this->base_model->insertAccessLog($acceslog_data);
			$this->load->view("header");
			$this->load->view("success_view");
			$this->load->view("footer");
		}else{
			$this->load->view("header");
			$this->load->view("error_view");
			$this->load->view("footer");		
		}
	}
	public function InsertEquipmentName(){
		if($this->domain_model->InsertEquipmentName($_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"		=>	"Insert Equipment Name Domain Parameter: ".$_POST["name"],
							"log_datetime"	=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	""
						);
			$this->base_model->insertAccessLog($acceslog_data);
			$this->load->view("header");
			$this->load->view("success_view");
			$this->load->view("footer");
		}else{
			$this->load->view("header");
			$this->load->view("error_view");
			$this->load->view("footer");		
		}
	}
	public function InsertConsoleNumber(){
		if($this->domain_model->InsertConsoleNumber($_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"		=>	"Insert Console Number Domain Parameter: ".$_POST["name"],
							"log_datetime"	=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	""
						);
			$this->base_model->insertAccessLog($acceslog_data);
			$this->load->view("header");
			$this->load->view("success_view");
			$this->load->view("footer");
		}else{
			$this->load->view("header");
			$this->load->view("error_view");
			$this->load->view("footer");		
		}
	}
	public function InsertReleasePurpose(){
		if($this->domain_model->InsertReleasePurpose($_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"		=>	"Insert Release Purpose Domain Parameter: ".$_POST["name"],
							"log_datetime"	=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	""
						);
			$this->base_model->insertAccessLog($acceslog_data);
			$this->load->view("header");
			$this->load->view("success_view");
			$this->load->view("footer");
		}else{
			$this->load->view("header");
			$this->load->view("error_view");
			$this->load->view("footer");		
		}
	}
	public function InsertAircraftType(){
		if($this->domain_model->InsertAircraftType($_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"		=>	"Insert Aircraft Type Domain Parameter: ".$_POST["name"],
							"log_datetime"	=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	""
						);
			$this->base_model->insertAccessLog($acceslog_data);
			$this->load->view("header");
			$this->load->view("success_view");
			$this->load->view("footer");
		}else{
			$this->load->view("header");
			$this->load->view("error_view");
			$this->load->view("footer");		
		}
	}
	public function InsertAirport(){
		if($this->domain_model->InsertAirport($_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"		=>	"Insert Airport Domain Parameter: ".$_POST["airport"],
							"log_datetime"	=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	""
						);
			$this->base_model->insertAccessLog($acceslog_data);
			$this->load->view("header");
			$this->load->view("success_view");
			$this->load->view("footer");
		}else{
			$this->load->view("header");
			$this->load->view("error_view");
			$this->load->view("footer");		
		}
	}
	public function InsertShift(){
		if($this->domain_model->InsertShift($_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"		=>	"Insert Shift Domain Parameter: ".$_POST["shift"],
							"log_datetime"	=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	""
						);
			$this->base_model->insertAccessLog($acceslog_data);
			$this->load->view("header");
			$this->load->view("success_view");
			$this->load->view("footer");
		}else{
			$this->load->view("header");
			$this->load->view("error_view");
			$this->load->view("footer");		
		}
	}
	public function InsertStaffAbsenseReason(){
		if($this->domain_model->InsertStaffAbsenseReason($_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"		=>	"Insert Staff Absence Reason Domain Parameter: ".$_POST["reason"],
							"log_datetime"	=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	""
						);
			$this->base_model->insertAccessLog($acceslog_data);
			$this->load->view("header");
			$this->load->view("success_view");
			$this->load->view("footer");
		}else{
			$this->load->view("header");
			$this->load->view("error_view");
			$this->load->view("footer");		
		}
	}
	public function InsertRunwayManoeuvringArea(){
		if($this->domain_model->InsertRunwayManoeuvringArea($_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"		=>	"Insert Runway Manoeuvoring Area Domain Parameter: ".$_POST["areaname"],
							"log_datetime"	=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	""
						);
			$this->base_model->insertAccessLog($acceslog_data);
			$this->load->view("header");
			$this->load->view("success_view");
			$this->load->view("footer");
		}else{
			$this->load->view("header");
			$this->load->view("error_view");
			$this->load->view("footer");		
		}
	}
	public function InsertUserRights(){
		if($this->domain_model->InsertUserRights($_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"		=>	"Insert User Rights Domain Parameter: ".$_POST["name"],
							"log_datetime"	=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	""
						);
			$this->base_model->insertAccessLog($acceslog_data);
			$this->load->view("header");
			$this->load->view("success_view");
			$this->load->view("footer");
		}else{
			$this->load->view("header");
			$this->load->view("error_view");
			$this->load->view("footer");		
		}
	}
	public function InsertUserRole(){
		if($this->domain_model->InsertUserRole($_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"		=>	"Insert User Role Domain Parameter: ".$_POST["name"],
							"log_datetime"	=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	""
						);
			$this->base_model->insertAccessLog($acceslog_data);
			$this->load->view("header");
			$this->load->view("success_view");
			$this->load->view("footer");
		}else{
			$this->load->view("header");
			$this->load->view("error_view");
			$this->load->view("footer");		
		}
	}
	public function InsertNationality(){
		if($this->domain_model->InsertNationality($_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"		=>	"Insert Nationality Domain Parameter: ".$_POST["nationality"],
							"log_datetime"	=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	""
						);
			$this->base_model->insertAccessLog($acceslog_data);
			$this->load->view("header");
			$this->load->view("success_view");
			$this->load->view("footer");
		}else{
			$this->load->view("header");
			$this->load->view("error_view");
			$this->load->view("footer");		
		}
	}
	public function InsertDesignation(){
		if($this->domain_model->InsertDesignation($_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"		=>	"Insert Designation Domain Parameter: ".$_POST["designation"],
							"log_datetime"	=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	""
						);
			$this->base_model->insertAccessLog($acceslog_data);
			$this->load->view("header");
			$this->load->view("success_view");
			$this->load->view("footer");
		}else{
			$this->load->view("header");
			$this->load->view("error_view");
			$this->load->view("footer");		
		}
	}
	public function InsertCompany(){
		if($this->domain_model->InsertCompany($_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"		=>	"Insert Company Domain Parameter: ".$_POST["name"],
							"log_datetime"	=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	""
						);
			$this->base_model->insertAccessLog($acceslog_data);
			$this->load->view("header");
			$this->load->view("success_view");
			$this->load->view("footer");
		}else{
			$this->load->view("header");
			$this->load->view("error_view");
			$this->load->view("footer");		
		}
	}
	public function viewSubjects(){
		$data = array();
		$data["subjects"] = $this->domain_model->getAllSubjects();
		$this->load->view("header",array("page"=>"Subject Listing"));
		$this->load->view("dm-listing/subject_listing",$data);
		$this->load->view("footer");		
	}
	public function editSubject(){
		$res = $this->domain_model->getSubject($_POST["id"]);
		$data["subject"] = $res[0];
		$this->load->view("dp_edit/editSubject",$data);
	}
	public function updateSubject(){
		$log_id = $_GET["log_id"];
		if($this->domain_model->updateSubject($log_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated subject domain parameter.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$log_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		}else{
			print("error");
		}
	}
	public function deleteSubject(){
		if($this->domain_model->deleteSubject($_POST["id"])){
			print("deleted");
		}else{
			print("error");
		}
	}
	public function viewPositionNames(){
		$order = $this->session->userdata("order");
		if(!empty($_POST)){
			if(isset($_POST["order"])){
				$set_order = "";
				if($_POST["order"] == "Ascending"){
					$set_order = "asc";
				}else{
					$set_order = "desc";				
				}
				$this->session->set_userdata(array("order"=>$set_order));
			}
			if(isset($_POST["al-filter"])){
				$this->session->set_userdata(array(
																			"positions_filter"=>array(
																															"agentunit"=>$_POST["agentunit"],
																															"keyword"=>$_POST["keyword"],
																															)
																			)
																		);
			}
			if(isset($_POST["al-filter-reset"])){
				$this->session->set_userdata(array(
																			"positions_filter"=>array(
																															"agentunit"=>"",
																															"keyword"=>"",
																															)
																			)
																		);
			}
		}else if(empty($order)){
			$this->session->set_userdata(array("order"=>"desc"));		
		}
		$order = $this->session->userdata("order");
		$data = array();
		$data["positions_filter"] = $this->session->userdata("positions_filter");
		$data["units"] = $this->user_model->getAllUnits();
		$data["positions"] = $this->domain_model->getAllPositions($data["positions_filter"]);
		$this->load->view("header",array("page"=>"Positions Listing"));
		$this->load->view("dm-listing/position_listing",$data);
		$this->load->view("footer");		
	}
	public function editPosition(){
		$res = $this->domain_model->getPosition($_POST["id"]);
		$data["units"] = $this->user_model->getAllUnits();
		$data["position"] = $res[0];
		$this->load->view("dp_edit/editPosition",$data);
	}
	public function updatePosition(){
		$log_id = $_GET["log_id"];
		if($this->domain_model->updatePosition($log_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated Position Name domain parameter.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$log_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		}else{
			print("error");
		}
	}
	public function deletePosition(){
		if($this->domain_model->deletePosition($_POST["id"])){
			print("deleted");
		}else{
			print("error");
		}
	}
	public function viewEquipmentNames(){
		$order = $this->session->userdata("order");
		if(!empty($_POST)){
			if(isset($_POST["order"])){
				$set_order = "";
				if($_POST["order"] == "Ascending"){
					$set_order = "asc";
				}else{
					$set_order = "desc";				
				}
				$this->session->set_userdata(array("order"=>$set_order));
			}
			if(isset($_POST["al-filter"])){
				$this->session->set_userdata(array(
																			"equipments_filter"=>array(
																															"agentunit"=>$_POST["agentunit"],
																															"keyword"=>$_POST["keyword"],
																															)
																			)
																		);
			}
			if(isset($_POST["al-filter-reset"])){
				$this->session->set_userdata(array(
																			"equipments_filter"=>array(
																															"agentunit"=>"",
																															"keyword"=>"",
																															)
																			)
																		);
			}
		}else if(empty($order)){
			$this->session->set_userdata(array("order"=>"desc"));		
		}
		$order = $this->session->userdata("order");
		$data = array();
		$data["equipments_filter"] = $this->session->userdata("equipments_filter");
		$data["units"] = $this->user_model->getAllUnits();
		$data["equipments"] = $this->domain_model->getAllEquipments($data["equipments_filter"]);
		$this->load->view("header",array("page"=>"Equipments Listing"));
		$this->load->view("dm-listing/equipment_listing",$data);
		$this->load->view("footer");		
	}
	public function editEquipment(){
		$res = $this->domain_model->getEquipment($_POST["id"]);
		$data["units"] = $this->user_model->getAllUnits();
		$data["equipment"] = $res[0];
		$this->load->view("dp_edit/editEquipment",$data);
	}
	public function updateEquipment(){
		$log_id = $_GET["log_id"];
		if($this->domain_model->updateEquipment($log_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated Equipment Name domain parameter.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$log_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		}else{
			print("error");
		}
	}
	public function deleteEquipment(){
		if($this->domain_model->deleteEquipment($_POST["id"])){
			print("deleted");
		}else{
			print("error");
		}
	}
	public function viewConsoleNumbers(){
		$order = $this->session->userdata("order");
		if(!empty($_POST)){
			if(isset($_POST["order"])){
				$set_order = "";
				if($_POST["order"] == "Ascending"){
					$set_order = "asc";
				}else{
					$set_order = "desc";				
				}
				$this->session->set_userdata(array("order"=>$set_order));
			}
			if(isset($_POST["al-filter"])){
				$this->session->set_userdata(array(
																			"console_filter"=>array(
																															"agentunit"=>$_POST["agentunit"],
																															"keyword"=>$_POST["areaname"],
																															)
																			)
																		);
			}
			if(isset($_POST["al-filter-reset"])){
				$this->session->set_userdata(array(
																			"console_filter"=>array(
																															"agentunit"=>"",
																															"keyword"=>"",
																															)
																			)
																		);
			}
		}else if(empty($order)){
			$this->session->set_userdata(array("order"=>"desc"));		
		}
		$order = $this->session->userdata("order");
		$data = array();
		$data["console_filter"] = $this->session->userdata("console_filter");
		$data["units"] = $this->user_model->getAllUnits();
		$data["consolenumbers"] = $this->domain_model->getAllConsoleNumbers($data["console_filter"]);
		$this->load->view("header",array("page"=>"Console Numbers Listing"));
		$this->load->view("dm-listing/consolenumber_listing",$data);
		$this->load->view("footer");		
	}
	public function editConsoleNumber(){
		$res = $this->domain_model->getConsoleNumber($_POST["id"]);
		$data["units"] = $this->user_model->getAllUnits();
		$data["consolenumber"] = $res[0];
		$this->load->view("dp_edit/editConsoleNumber",$data);
	}
	public function updateConsoleNumber(){
		$log_id = $_GET["log_id"];
		if($this->domain_model->updateConsoleNumber($log_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated Console Number domain parameter.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$log_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		}else{
			print("error");
		}
	}
	public function deleteConsoleNumber(){
		if($this->domain_model->deleteConsoleNumber($_POST["id"])){
			print("deleted");
		}else{
			print("error");
		}
	}
	public function viewReleasePurposes(){
		$data = array();
		$data["releasepurposes"] = $this->domain_model->getAllReleasePurposes();
		$this->load->view("header",array("page"=>"Release Purposes Listing"));
		$this->load->view("dm-listing/releasepurpose_listing",$data);
		$this->load->view("footer");		
	}
	public function editReleasePurpose(){
		$res = $this->domain_model->getReleasePurpose($_POST["id"]);
		$data["releasepurpose"] = $res[0];
		$this->load->view("dp_edit/editReleasePurpose",$data);
	}
	public function updateReleasePurpose(){
		$log_id = $_GET["log_id"];
		if($this->domain_model->updateReleasePurpose($log_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated Release Purpose domain parameter.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$log_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		}else{
			print("error");
		}
	}
	public function deleteReleasePurpose(){
		if($this->domain_model->deleteReleasePurpose($_POST["id"])){
			print("deleted");
		}else{
			print("error");
		}
	}
	public function viewAircraftTypes(){
		$data = array();
		$data["aircrafttypes"] = $this->domain_model->getAllAircraftTypes();
		$this->load->view("header",array("page"=>"Aircraft Types Listing"));
		$this->load->view("dm-listing/aircrafttypes_listing",$data);
		$this->load->view("footer");		
	}
	public function editAircraftType(){
		$res = $this->domain_model->getAircraftType($_POST["id"]);
		$data["aircrafttype"] = $res[0];
		$this->load->view("dp_edit/editAircraftType",$data);
	}
	public function updateAircraftType(){
		$log_id = $_GET["log_id"];
		if($this->domain_model->updateAircraftType($log_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated Aircraft Type domain parameter.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$log_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		}else{
			print("error");
		}
	}
	public function deleteAircraftType(){
		if($this->domain_model->deleteAircraftType($_POST["id"])){
			print("deleted");
		}else{
			print("error");
		}
	}
	public function viewAirports(){
		$data = array();
		$data["airports"] = $this->domain_model->getAllAirports();
		$this->load->view("header",array("page"=>"Airports Listing"));
		$this->load->view("dm-listing/airports_listing",$data);
		$this->load->view("footer");		
	}
	public function editAirport(){
		$res = $this->domain_model->getAirport($_POST["id"]);
		$data["airport"] = $res[0];
		$this->load->view("dp_edit/editAirport",$data);
	}
	public function updateAirport(){
		$log_id = $_GET["log_id"];
		if($this->domain_model->updateAirport($log_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated Airport domain parameter.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$log_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		}else{
			print("error");
		}
	}
	public function deleteAirport(){
		if($this->domain_model->deleteAirport($_POST["id"])){
			print("deleted");
		}else{
			print("error");
		}
	}
	public function viewShifts(){
		$data = array();
		$data["Shifts"] = $this->domain_model->getAllShifts();
		$this->load->view("header",array("page"=>"Shifts Listing"));
		$this->load->view("dm-listing/Shifts_listing",$data);
		$this->load->view("footer");		
	}
	public function editShift(){
		$res = $this->domain_model->getShift($_POST["id"]);
		$data["Shift"] = $res[0];
		$this->load->view("dp_edit/editShift",$data);
	}
	public function updateShift(){
		$log_id = $_GET["log_id"];
		if($this->domain_model->updateShift($log_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated Shift domain parameter.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$log_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		}else{
			print("error");
		}
	}
	public function deleteShift(){
		if($this->domain_model->deleteShift($_POST["id"])){
			print("deleted");
		}else{
			print("error");
		}
	}
	public function viewStaffAbsenseReasons(){
		$data = array();
		$data["StaffAbsenseReasons"] = $this->domain_model->getAllStaffAbsenseReasons();
		$this->load->view("header");
		$this->load->view("dm-listing/StaffAbsenseReasons_listing",$data);
		$this->load->view("footer");		
	}
	public function editStaffAbsenseReason(){
		$res = $this->domain_model->getStaffAbsenseReason($_POST["id"]);
		$data["StaffAbsenseReason"] = $res[0];
		$this->load->view("dp_edit/editStaffAbsenseReason",$data);
	}
	public function updateStaffAbsenseReason(){
		$log_id = $_GET["log_id"];
		if($this->domain_model->updateStaffAbsenseReason($log_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated Staff Absence Reason domain parameter.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$log_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		}else{
			print("error");
		}
	}
	public function deleteStaffAbsenseReason(){
		if($this->domain_model->deleteStaffAbsenseReason($_POST["id"])){
			print("deleted");
		}else{
			print("error");
		}
	}
	public function viewRunwayManoeuvringAreas(){
		$order = $this->session->userdata("order");
		if(!empty($_POST)){
			if(isset($_POST["order"])){
				$set_order = "";
				if($_POST["order"] == "Ascending"){
					$set_order = "asc";
				}else{
					$set_order = "desc";				
				}
				$this->session->set_userdata(array("order"=>$set_order));
			}
			if(isset($_POST["al-filter"])){
				$this->session->set_userdata(array(
																			"rma_filter"=>array(
																															"agentunit"=>$_POST["agentunit"],
																															"keyword"=>$_POST["keyword"],
																															)
																			)
																		);
			}
			if(isset($_POST["al-filter-reset"])){
				$this->session->set_userdata(array(
																			"rma_filter"=>array(
																															"agentunit"=>"",
																															"keyword"=>"",
																															)
																			)
																		);
			}
		}else if(empty($order)){
			$this->session->set_userdata(array("order"=>"desc"));		
		}
		$order = $this->session->userdata("order");
		$data = array();
		$data["rma_filter"] = $this->session->userdata("rma_filter");
		$data["units"] = $this->user_model->getAllUnits();
		$data["RunwayManoeuvringAreas"] = $this->domain_model->getAllRunwayManoeuvringAreas($data["rma_filter"]);
		$this->load->view("header");
		$this->load->view("dm-listing/RunwayManoeuvringAreas_listing",$data);
		$this->load->view("footer");		
	}
	public function editRunwayManoeuvringArea(){
		$res = $this->domain_model->getRunwayManoeuvringArea($_POST["id"]);
		$data["units"] = $this->user_model->getAllUnits();
		$data["RunwayManoeuvringArea"] = $res[0];
		$this->load->view("dp_edit/editRunwayManoeuvringArea",$data);
	}
	public function updateRunwayManoeuvringArea(){
		$log_id = $_GET["log_id"];
		if($this->domain_model->updateRunwayManoeuvringArea($log_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated Runway/Manoeuvoring Area domain parameter.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$log_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		}else{
			print("error");
		}
	}
	public function deleteRunwayManoeuvringArea(){
		if($this->domain_model->deleteRunwayManoeuvringArea($_POST["id"])){
			print("deleted");
		}else{
			print("error");
		}
	}
	public function viewNationalities(){
		$data = array();
		$data["nationalities"] = $this->domain_model->getAllNationalities();
		$this->load->view("header",array("page"=>"Nationalities Listing"));
		$this->load->view("dm-listing/nationalities_listing",$data);
		$this->load->view("footer");		
	}
	public function editNationality(){
		$res = $this->domain_model->getNationality($_POST["id"]);
		$data["nationality"] = $res[0];
		$this->load->view("dp_edit/editNationality",$data);
	}
	public function updateNationality(){
		$log_id = $_GET["log_id"];
		if($this->domain_model->updateNationality($log_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated Nationality domain parameter.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$log_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		}else{
			print("error");
		}
	}
	public function deleteNationality(){
		if($this->domain_model->deleteNationality($_POST["id"])){
			print("deleted");
		}else{
			print("error");
		}
	}
	public function viewDesignations(){
		$data = array();
		$data["Designations"] = $this->domain_model->getAllDesignations();
		$this->load->view("header",array("page"=>"Designations Listing"));
		$this->load->view("dm-listing/Designations_listing",$data);
		$this->load->view("footer");		
	}
	public function editDesignation(){
		$res = $this->domain_model->getDesignation($_POST["id"]);
		$data["Designation"] = $res[0];
		$this->load->view("dp_edit/editDesignation",$data);
	}
	public function updateDesignation(){
		$log_id = $_GET["log_id"];
		if($this->domain_model->updateDesignation($log_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated Designation domain parameter.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$log_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		}else{
			print("error");
		}
	}
	public function deleteDesignation(){
		if($this->domain_model->deleteDesignation($_POST["id"])){
			print("deleted");
		}else{
			print("error");
		}
	}
	public function viewCompanies(){
		$data = array();
		$data["Companies"] = $this->domain_model->getAllCompanies();
		$this->load->view("header",array("page"=>"Companies Listing"));
		$this->load->view("dm-listing/Companies_listing",$data);
		$this->load->view("footer");		
	}
	public function editCompany(){
		$res = $this->domain_model->getCompany($_POST["id"]);
		$data["Company"] = $res[0];
		$this->load->view("dp_edit/editCompany",$data);
	}
	public function updateCompany(){
		$log_id = $_GET["log_id"];
		if($this->domain_model->updateCompany($log_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated Company domain parameter.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$log_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		}else{
			print("error");
		}
	}
	public function deleteCompany(){
		if($this->domain_model->deleteCompany($_POST["id"])){
			print("deleted");
		}else{
			print("error");
		}
	}
	public function viewInstructionTypes(){
		$data = array();
		$data["InstructionTypes"] = $this->domain_model->getAllInstructionTypes();
		$this->load->view("header",array("page"=>"Instruction Types Listing"));
		$this->load->view("dm-listing/InstructionTypes_listing",$data);
		$this->load->view("footer");		
	}
	public function editInstructionType(){
		$res = $this->domain_model->getInstructionType($_POST["id"]);
		$data["InstructionType"] = $res[0];
		$this->load->view("dp_edit/editInstructionType",$data);
	}
	public function updateInstructionType(){
		$log_id = $_GET["log_id"];
		if($this->domain_model->updateInstructionType($log_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated Insrtuction Type domain parameter.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$log_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		}else{
			print("error");
		}
	}
	public function deleteInstructionType(){
		if($this->domain_model->deleteInstructionType($_POST["id"])){
			print("deleted");
		}else{
			print("error");
		}
	}
	
	public function email(){
		$viewData = array();
		$viewData["units"] = $this->user_model->getAllUnits();
		$this->load->view("header",array("page"=>"Email / Phone"));
		$this->load->view("DomainParameters/email",$viewData);
		$this->load->view("footer");
	}
	public function insertEmail(){
		$_POST["for_form"] = serialize($_POST["for_form"]);
		if($this->domain_model->insertEmail($_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"		=>	"Insert Email Domain Parameter: ".$_POST["email_address"],
							"log_datetime"	=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	""
						);
			$this->base_model->insertAccessLog($acceslog_data);
			$this->load->view("header");
			$this->load->view("success_view");
			$this->load->view("footer");
		}else{
			$this->load->view("header");
			$this->load->view("error_view");
			$this->load->view("footer");		
		}
	}	
	public function viewEmails(){
		$order = $this->session->userdata("order");
		if(!empty($_POST)){
			if(isset($_POST["order"])){
				$set_order = "";
				if($_POST["order"] == "Ascending"){
					$set_order = "asc";
				}else{
					$set_order = "desc";				
				}
				$this->session->set_userdata(array("order"=>$set_order));
			}
			if(isset($_POST["al-filter"])){
				$this->session->set_userdata(array(
																			"emails_filter"=>array(
																															"agentunit"=>$_POST["agentunit"],
																															"keyword"=>$_POST["keyword"],
																															)
																			)
																		);
			}
			if(isset($_POST["al-filter-reset"])){
				$this->session->set_userdata(array(
																			"emails_filter"=>array(
																															"agentunit"=>"",
																															"keyword"=>"",
																															)
																			)
																		);
			}
		}else if(empty($order)){
			$this->session->set_userdata(array("order"=>"desc"));		
		}
		$order = $this->session->userdata("order");
		$data = array();
		$data["emails_filter"] = $this->session->userdata("emails_filter");
		$data["units"] = $this->user_model->getAllUnits();
		$data["emails"] = $this->domain_model->getAllEmails($data["emails_filter"]);
		$this->load->view("header",array("page"=>"Emails Listing"));
		$this->load->view("dm-listing/emails_listing",$data);
		$this->load->view("footer");		
	}
	public function editEmail(){
		$res = $this->domain_model->getEmail($_POST["email_id"]);
		$data["units"] = $this->user_model->getAllUnits();
		$data["email"] = $res[0];
		$this->load->view("dp_edit/editEmail",$data);
	}
	public function updateEmail(){
		$_POST["for_form"] = serialize($_POST["for_form"]);
		$email_id = $_GET["email_id"];
		if($this->domain_model->updateEmail($email_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated Email domain parameter.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$email_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		}else{
			print("error");
		}
	}
	public function deleteEmail(){
		if($this->domain_model->deleteEmail($_POST["email_id"])){
			print("deleted");
		}else{
			print("error");
		}
	}
	public function phone(){
		$viewData = array();
		$viewData["units"] = $this->user_model->getAllUnits();
		$this->load->view("header",array("page"=>"Email / Phone"));
		$this->load->view("DomainParameters/phone",$viewData);
		$this->load->view("footer");
	}
	public function insertPhone(){
		$_POST["for_form"] = serialize($_POST["for_form"]);
		if($this->domain_model->insertPhone($_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"		=>	"Insert Phone Domain Parameter: ".$_POST["phone_number"],
							"log_datetime"	=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	""
						);
			$this->base_model->insertAccessLog($acceslog_data);
			$this->load->view("header");
			$this->load->view("success_view");
			$this->load->view("footer");
		}else{
			$this->load->view("header");
			$this->load->view("error_view");
			$this->load->view("footer");		
		}
	}	
	public function viewPhones(){
		$order = $this->session->userdata("order");
		if(!empty($_POST)){
			if(isset($_POST["order"])){
				$set_order = "";
				if($_POST["order"] == "Ascending"){
					$set_order = "asc";
				}else{
					$set_order = "desc";				
				}
				$this->session->set_userdata(array("order"=>$set_order));
			}
			if(isset($_POST["al-filter"])){
				$this->session->set_userdata(array(
																			"phone_filter"=>array(
																															"agentunit"=>$_POST["agentunit"],
																															"keyword"=>$_POST["keyword"],
																															)
																			)
																		);
			}
			if(isset($_POST["al-filter-reset"])){
				$this->session->set_userdata(array(
																			"phone_filter"=>array(
																															"agentunit"=>"",
																															"keyword"=>"",
																															)
																			)
																		);
			}
		}else if(empty($order)){
			$this->session->set_userdata(array("order"=>"desc"));		
		}
		$order = $this->session->userdata("order");
		$data = array();
		$data["phone_filter"] = $this->session->userdata("phone_filter");
		$data["units"] = $this->user_model->getAllUnits();
		$data["phones"] = $this->domain_model->getAllPhones($data["phone_filter"]);
		$this->load->view("header",array("page"=>"Phones Listing"));
		$this->load->view("dm-listing/phones_listing",$data);
		$this->load->view("footer");		
	}
	public function editPhone(){
		$res = $this->domain_model->getPhone($_POST["phone_id"]);
		$data["units"] = $this->user_model->getAllUnits();
		$data["phone"] = $res[0];
		$this->load->view("dp_edit/editPhone",$data);
	}
	public function updatePhone(){
		// print_r($_POST);
		// exit;
		$_POST["for_form"] = serialize($_POST["for_form"]);
		$phone_id = $_GET["phone_id"];
		if($this->domain_model->updatePhone($phone_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated Phone domain parameter.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$phone_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		}else{
			print("error");
		}
	}
	public function deletePhone(){
		if($this->domain_model->deletePhone($_POST["phone_id"])){
			print("deleted");
		}else{
			print("error");
		}
	}
	public function runway(){
		$viewData = array();
		$viewData["units"] = $this->user_model->getAllUnits();
		$this->load->view("header",array("page"=>"Email / Phone"));
		$this->load->view("DomainParameters/runway",$viewData);
		$this->load->view("footer");
	}
	public function insertRunway(){
		if($this->domain_model->insertRunway($_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"		=>	"Insert Runway Domain Parameter: ".$_POST["runway"],
							"log_datetime"	=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	""
						);
			$this->base_model->insertAccessLog($acceslog_data);
			$this->load->view("header");
			$this->load->view("success_view");
			$this->load->view("footer");
		}else{
			$this->load->view("header");
			$this->load->view("error_view");
			$this->load->view("footer");		
		}
	}	
	public function viewRunways(){
		$order = $this->session->userdata("order");
		if(!empty($_POST)){
			if(isset($_POST["order"])){
				$set_order = "";
				if($_POST["order"] == "Ascending"){
					$set_order = "asc";
				}else{
					$set_order = "desc";				
				}
				$this->session->set_userdata(array("order"=>$set_order));
			}
			if(isset($_POST["al-filter"])){
				$this->session->set_userdata(array(
																			"runway_filter"=>array(
																															"agentunit"=>$_POST["agentunit"],
																															"keyword"=>$_POST["keyword"],
																															)
																			)
																		);
			}
			if(isset($_POST["al-filter-reset"])){
				$this->session->set_userdata(array(
																			"runway_filter"=>array(
																															"agentunit"=>"",
																															"keyword"=>"",
																															)
																			)
																		);
			}
		}else if(empty($order)){
			$this->session->set_userdata(array("order"=>"desc"));		
		}
		$order = $this->session->userdata("order");
		$data = array();
		$data["runway_filter"] = $this->session->userdata("runway_filter");
		$data["units"] = $this->user_model->getAllUnits();
		$data["runways"] = $this->domain_model->getAllRunways($data["runway_filter"]);
		$this->load->view("header",array("page"=>"Runways Listing"));
		$this->load->view("dm-listing/runway_listing",$data);
		$this->load->view("footer");		
	}
	public function editRunway(){
		$res = $this->domain_model->getRunway($_POST["runway_id"]);
		$data["units"] = $this->user_model->getAllUnits();
		$data["runway"] = $res[0];
		$this->load->view("dp_edit/editRunway",$data);
	}
	public function updateRunway(){
		$runway_id = $_GET["runway_id"];
		if($this->domain_model->updateRunway($runway_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated Runway domain parameter.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$runway_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		}else{
			print("error");
		}
	}
	public function deleteRunway(){
		if($this->domain_model->deleteRunway($_POST["runway_id"])){
			print("deleted");
		}else{
			print("error");
		}
	}
	
}