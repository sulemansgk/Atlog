<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Elog extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("elog_model");
		$this->load->model("base_model");
		$this->load->model("user_model");
		$this->load->model("emergency_model");
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
		
	
	public function generalentry(){
		$viewData = array();
		$viewData["allusers"] = $this->user_model->getUnitUsers();
		$viewData["subjects"] = $this->elog_model->getAllSubjects();
		$this->load->view("header",array("page"=>"General Entry"));
		$this->load->view("generalentry",$viewData);
		$this->load->view("footer");
	}
	
		
	
	public function newjob(){
		$viewData = array();
		$viewData["allusers"] = $this->user_model->getUnitUsers();
		$viewData["subjects"] = $this->elog_model->getAllSubjects();
		$this->load->view("header",array("page"=>"General Entry"));
		$this->load->view("generalentry",$viewData);
		$this->load->view("footer");
	}
	
	
	public function insertgeneralentry(){
		$viewData = array();
		$insert_id = $this->elog_model->insertgeneralentry($_POST);
		if(!empty($insert_id) && ( $insert_id != 0 )){
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"generalentry",
								"log_table"=> 	"generalentry",
								"log_id"	 => 	$insert_id,
								"datetime" =>		$_POST["datetime"],
							);
			$log_insert_id = $this->elog_model->insertformlog($log_data);
			if(!empty($log_insert_id) && ( $log_insert_id != 0 )){
				$acceslog_data = array(
								"agentcode"		=>	$this->userdetails["agentcode"],
								"message"			=>	"Inserted General Entry log.",
								"log_datetime"=> 	date("Y-m-d H:i:s"),
								"form_log_id"	=>	$log_insert_id
							);
				$this->base_model->insertAccessLog($acceslog_data);
				$this->base_model->insertKeywords($_POST);
				redirect("elog/mainview/success");
				$viewData["success_msg"] = "Added Successfully.";
				$this->load->view('header');
				$this->load->view("success_view",$viewData);
				$this->load->view("footer");
			}else{
				$viewData["error_msg"] = "Some error occured please try again.";
				$this->load->view('header');
				$this->load->view("error_view",$viewData);
				$this->load->view("footer");			
			}
		}else{
			$viewData["error_msg"] = "Some error occured please try again.";
			$this->load->view('header');
			$this->load->view("error_view",$viewData);
			$this->load->view("footer");					
		}
	}
	public function controlmobile(){
		$data = array();
		$data["allusers"] = $this->user_model->getUnitUsers();
		$cm1 = $this->elog_model->getControlMobile1();
		$cm2 = $this->elog_model->getControlMobile2();
		$data["cm1"] = $cm1;
		$data["cm2"] = $cm2;
		$this->load->view("header",array("page"=>"Control Mobile"));
		$this->load->view("controlmobile",$data);
		$this->load->view("footer");
	}
	
	public function insertfrequency(){
		$viewData = array();
		$insert_id = $this->latest_elog_model->insertfrequency($_POST);
		if(!empty($insert_id) && ( $insert_id != 0 )){
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"Inserting Lastest parameter domain Frequency ",
								"log_table"=> 	"latest_Frequency",
								"log_id"	 => 	$insert_id,
								"datetime" =>		$_POST["datetime"],
							);
			$log_insert_id = $this->latest_elog_model->insertformlog($log_data);
			if(!empty($log_insert_id) && ( $log_insert_id != 0 )){
				$acceslog_data = array(
								"agentcode"		=>	$this->userdetails["agentcode"],
								"message"		=>	"inserted Lastest domain parameter  Frequency  ",
								"log_datetime"	=> 	date("Y-m-d H:i:s"),
								"form_log_id"	=>	$log_insert_id
							);
				$this->base_model->insertAccessLog($acceslog_data);
				$this->base_model->insertKeywords($_POST);
				redirect("instructions/Viewparafrequency");
				$viewData["success_msg"] = "Added Successfully.";
				$this->load->view('header');
				$this->load->view("success_view",$viewData);
				$this->load->view("footer");
			}else{
				$viewData["error_msg"] = "Some error occured please try again.";
				$this->load->view('header');
				$this->load->view("error_view",$viewData);
				$this->load->view("footer");			
			}
		}else{
			$viewData["error_msg"] = "Some error occured please try again.";
			$this->load->view('header');
			$this->load->view("error_view",$viewData);
			$this->load->view("footer");					
		}
	}
	
	
	public function insertlru(){
		$viewData = array();
		$insert_id = $this->latest_elog_model->insertlru($_POST);
		if(!empty($insert_id) && ( $insert_id != 0 )){
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"Inserting latest parameter domain LRU ",
								"log_table"=> 	"latest_LRU",
								"log_id"	 => 	$insert_id,
								"datetime" =>		$_POST["datetime"],
							);
			$log_insert_id = $this->latest_elog_model->insertformlog($log_data);
			if(!empty($log_insert_id) && ( $log_insert_id != 0 )){
				$acceslog_data = array(
								"agentcode"		=>	$this->userdetails["agentcode"],
								"message"		=>	"inserted latest domain parameter  LRU  ",
								"log_datetime"	=> 	date("Y-m-d H:i:s"),
								"form_log_id"	=>	$log_insert_id
							);
				$this->base_model->insertAccessLog($acceslog_data);
				$this->base_model->insertKeywords($_POST);
				redirect("instructions/ViewparaLRU");
				$viewData["success_msg"] = "Added Successfully.";
				$this->load->view('header');
				$this->load->view("success_view",$viewData);
				$this->load->view("footer");
			}else{
				$viewData["error_msg"] = "Some error occured please try again.";
				$this->load->view('header');
				$this->load->view("error_view",$viewData);
				$this->load->view("footer");			
			}
		}else{
			$viewData["error_msg"] = "Some error occured please try again.";
			$this->load->view('header');
			$this->load->view("error_view",$viewData);
			$this->load->view("footer");					
		}
	}
	
	public function insertparajob(){
		$viewData = array();
		$insert_id = $this->latest_elog_model->insertparajob($_POST);
		
		if(!empty($insert_id) && ( $insert_id != 0 )){
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"Inserting latest parameter domain Jobs",
								"log_table"=> 	"latest_parajob",
								"log_id"	 => 	$insert_id,
								"datetime" =>		$_POST["datetime"],
							);
			$log_insert_id = $this->latest_elog_model->insertformlog($log_data);
			
			if(!empty($log_insert_id) && ( $log_insert_id != 0 )){
				$acceslog_data = array(
								"agentcode"		=>	$this->userdetails["agentcode"],
								"message"		=>	"Inserting latest parameter domain Jobs",
								"log_datetime"	=> 	date("Y-m-d H:i:s"),
								"form_log_id"	=>	$log_insert_id
							);
				$this->base_model->insertAccessLog($acceslog_data);
				$this->base_model->insertKeywords($_POST);
				redirect("instructions/ViewparaJob");
				$viewData["success_msg"] = "Added Successfully.";
				$this->load->view('header');
				$this->load->view("success_view",$viewData);
				$this->load->view("footer");
			}else{
				$viewData["error_msg"] = "Ssssome error occured please try again.";
				$this->load->view('header');
				$this->load->view("error_view",$viewData);
				$this->load->view("footer");			
			}
		}else{
			$viewData["error_msg"] = "Somaaaaaae error occured please try again.";
			$this->load->view('header');
			$this->load->view("error_view",$viewData);
			$this->load->view("footer");					
		}
	}
	
	
	public function mainview(){
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
			if($_POST["faultreports"] == "faultreports"){
				redirect("elog/mainview/faultreports");
			}
		}else if(empty($order)){
			$this->session->set_userdata(array("order"=>"desc"));		
		}
		$order = $this->session->userdata("order");
		$data = array();
		$this->load->library("pagination");
		$per_page = 20;
		$total = $this->elog_model->count_rec("form_logs");  //total post
		if($this->uri->segment(3) == "faultreports"){
			
			$data['logs'] = $this->elog_model->getAllLogs($per_page, $this->uri->segment(4));
			$config['base_url'] = $this->config->item('base_url').'elog/mainview/faultreports';
			$config['uri_segment'] = '4';
		}else{
			$data['logs'] = $this->elog_model->getAllLogs($per_page, $this->uri->segment(3));
			$config['base_url'] = $this->config->item('base_url').'elog/mainview/';
			$config['uri_segment'] = '3';
		}
		$config['total_rows'] = $total;
		$config['per_page'] =   $per_page;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$config['cur_tag_open'] = '<b> &nbsp;';
		$config['cur_tag_close'] = '</b>';
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config);
		$data["pagination_links"] = trim($this->pagination->create_links());
		
		$this->load->view("header",array("page"=>"Main View"));
		$this->load->view("mainview",$data);
		$this->load->view("footer");
	}
	

	public function generateFaultReportAtcVcr($post_data){
		if(!isset($post_data["119_2Mhz"])){
			$fault_report = array();
			$datetime = date("Y-m-d H:i:s");
			$fault_report["subject"] = "Fault Reporting";
			$fault_report["initial"] = $this->userdetails["agentcode"];
			$fault_report["datetime"] = $datetime;
			$fault_report["form_datetime"] = $datetime;
			$fault_report["system_equipment"] = "119.200 Mhz";
			$fault_report["any_other_details"] = "TERMINAL 1 (T1) ATC FACILITY INSPECTION";
			$insert_id = $this->elog_model->insertFaultReporting($fault_report);
			if(!empty($insert_id) && ( $insert_id != 0 )){
				$equip_notif_id = $this->elog_model->insertEquipmentReleaseNotificationATC($insert_id);
				$log_data = array(
									"id"			 => 	"",
									"log_type" => 	"Fault Reporting",
									"log_table"=> 	"fault_reporting",
									"log_id"	 => 	$insert_id,
									"datetime" =>		$datetime,
								);
				$log_insert_id = $this->elog_model->insertformlog($log_data);
			}
		}
		if(!isset($post_data["118_6Mhz"])){
			$fault_report = array();
			$datetime = date("Y-m-d H:i:s");
			$fault_report["subject"] = "Fault Reporting";
			$fault_report["initial"] = $this->userdetails["agentcode"];
			$fault_report["datetime"] = $datetime;
			$fault_report["form_datetime"] = $datetime;
			$fault_report["system_equipment"] = "118.675 Mhz ";
			$fault_report["any_other_details"] = "TERMINAL 1 (T1) ATC FACILITY INSPECTION";
			$insert_id = $this->elog_model->insertFaultReporting($fault_report);
			if(!empty($insert_id) && ( $insert_id != 0 )){
				$equip_notif_id = $this->elog_model->insertEquipmentReleaseNotificationATC($insert_id);
				$log_data = array(
									"id"			 => 	"",
									"log_type" => 	"Fault Reporting",
									"log_table"=> 	"fault_reporting",
									"log_id"	 => 	$insert_id,
									"datetime" =>		$datetime,
								);
				$log_insert_id = $this->elog_model->insertformlog($log_data);
			}
		}
		if(!isset($post_data["123_9Mhz"])){
			$fault_report = array();
			$datetime = date("Y-m-d H:i:s");
			$fault_report["subject"] = "Fault Reporting";
			$fault_report["initial"] = $this->userdetails["agentcode"];
			$fault_report["datetime"] = $datetime;
			$fault_report["form_datetime"] = $datetime;
			$fault_report["system_equipment"] = "123.975 Mhz";
			$fault_report["any_other_details"] = "TERMINAL 1 (T1) ATC FACILITY INSPECTION";
			$insert_id = $this->elog_model->insertFaultReporting($fault_report);
			if(!empty($insert_id) && ( $insert_id != 0 )){
				$equip_notif_id = $this->elog_model->insertEquipmentReleaseNotificationATC($insert_id);
				$log_data = array(
									"id"			 => 	"",
									"log_type" => 	"Fault Reporting",
									"log_table"=> 	"fault_reporting",
									"log_id"	 => 	$insert_id,
									"datetime" =>		$datetime,
								);
				$log_insert_id = $this->elog_model->insertformlog($log_data);
			}
		}
		if(!isset($post_data["121_9Mhz"])){
			$fault_report = array();
			$datetime = date("Y-m-d H:i:s");
			$fault_report["subject"] = "Fault Reporting";
			$fault_report["initial"] = $this->userdetails["agentcode"];
			$fault_report["datetime"] = $datetime;
			$fault_report["form_datetime"] = $datetime;
			$fault_report["system_equipment"] = "121.950 Mhz";
			$fault_report["any_other_details"] = "TERMINAL 1 (T1) ATC FACILITY INSPECTION";
			$insert_id = $this->elog_model->insertFaultReporting($fault_report);
			if(!empty($insert_id) && ( $insert_id != 0 )){
				$equip_notif_id = $this->elog_model->insertEquipmentReleaseNotificationATC($insert_id);
				$log_data = array(
									"id"			 => 	"",
									"log_type" => 	"Fault Reporting",
									"log_table"=> 	"fault_reporting",
									"log_id"	 => 	$insert_id,
									"datetime" =>		$datetime,
								);
				$log_insert_id = $this->elog_model->insertformlog($log_data);
			}
		}
		if(!isset($post_data["125_1Mhz"])){
			$fault_report = array();
			$datetime = date("Y-m-d H:i:s");
			$fault_report["subject"] = "Fault Reporting";
			$fault_report["initial"] = $this->userdetails["agentcode"];
			$fault_report["datetime"] = $datetime;
			$fault_report["form_datetime"] = $datetime;
			$fault_report["system_equipment"] = "125.100 Mhz";
			$fault_report["any_other_details"] = "TERMINAL 1 (T1) ATC FACILITY INSPECTION";
			$insert_id = $this->elog_model->insertFaultReporting($fault_report);
			if(!empty($insert_id) && ( $insert_id != 0 )){
				$equip_notif_id = $this->elog_model->insertEquipmentReleaseNotificationATC($insert_id);
				$log_data = array(
									"id"			 => 	"",
									"log_type" => 	"Fault Reporting",
									"log_table"=> 	"fault_reporting",
									"log_id"	 => 	$insert_id,
									"datetime" =>		$datetime,
								);
				$log_insert_id = $this->elog_model->insertformlog($log_data);
			}
		}
		if(!isset($post_data["SMGC"])){
			$fault_report = array();
			$datetime = date("Y-m-d H:i:s");
			$fault_report["subject"] = "Fault Reporting";
			$fault_report["initial"] = $this->userdetails["agentcode"];
			$fault_report["datetime"] = $datetime;
			$fault_report["form_datetime"] = $datetime;
			$fault_report["system_equipment"] = "SMGC";
			$fault_report["any_other_details"] = "TERMINAL 1 (T1) ATC FACILITY INSPECTION";
			$insert_id = $this->elog_model->insertFaultReporting($fault_report);
			if(!empty($insert_id) && ( $insert_id != 0 )){
				$equip_notif_id = $this->elog_model->insertEquipmentReleaseNotificationATC($insert_id);
				$log_data = array(
									"id"			 => 	"",
									"log_type" => 	"Fault Reporting",
									"log_table"=> 	"fault_reporting",
									"log_id"	 => 	$insert_id,
									"datetime" =>		$datetime,
								);
				$log_insert_id = $this->elog_model->insertformlog($log_data);
			}
		}
		if(!isset($post_data["Binoculars"])){
			$fault_report = array();
			$datetime = date("Y-m-d H:i:s");
			$fault_report["subject"] = "Fault Reporting";
			$fault_report["initial"] = $this->userdetails["agentcode"];
			$fault_report["datetime"] = $datetime;
			$fault_report["form_datetime"] = $datetime;
			$fault_report["system_equipment"] = "Binoculars";
			$fault_report["any_other_details"] = "TERMINAL 1 (T1) ATC FACILITY INSPECTION";
			$insert_id = $this->elog_model->insertFaultReporting($fault_report);
			if(!empty($insert_id) && ( $insert_id != 0 )){
				$equip_notif_id = $this->elog_model->insertEquipmentReleaseNotificationATC($insert_id);
				$log_data = array(
									"id"			 => 	"",
									"log_type" => 	"Fault Reporting",
									"log_table"=> 	"fault_reporting",
									"log_id"	 => 	$insert_id,
									"datetime" =>		$datetime,
								);
				$log_insert_id = $this->elog_model->insertformlog($log_data);
			}
		}
		if(!isset($post_data["SignalGun"])){
			$fault_report = array();
			$datetime = date("Y-m-d H:i:s");
			$fault_report["subject"] = "Fault Reporting";
			$fault_report["initial"] = $this->userdetails["agentcode"];
			$fault_report["datetime"] = $datetime;
			$fault_report["form_datetime"] = $datetime;
			$fault_report["system_equipment"] = "SignalGun";
			$fault_report["any_other_details"] = "TERMINAL 1 (T1) ATC FACILITY INSPECTION";
			$insert_id = $this->elog_model->insertFaultReporting($fault_report);
			if(!empty($insert_id) && ( $insert_id != 0 )){
				$equip_notif_id = $this->elog_model->insertEquipmentReleaseNotificationATC($insert_id);
				$log_data = array(
									"id"			 => 	"",
									"log_type" => 	"Fault Reporting",
									"log_table"=> 	"fault_reporting",
									"log_id"	 => 	$insert_id,
									"datetime" =>		$datetime,
								);
				$log_insert_id = $this->elog_model->insertformlog($log_data);
			}
		}
		if(!isset($post_data["air_conditioning"])){
			$fault_report = array();
			$datetime = date("Y-m-d H:i:s");
			$fault_report["subject"] = "Fault Reporting";
			$fault_report["initial"] = $this->userdetails["agentcode"];
			$fault_report["datetime"] = $datetime;
			$fault_report["form_datetime"] = $datetime;
			$fault_report["system_equipment"] = "Air-Conditioning";
			$fault_report["any_other_details"] = "TERMINAL 1 (T1) ATC FACILITY INSPECTION";
			$insert_id = $this->elog_model->insertFaultReporting($fault_report);
			if(!empty($insert_id) && ( $insert_id != 0 )){
				$equip_notif_id = $this->elog_model->insertEquipmentReleaseNotificationATC($insert_id);
				$log_data = array(
									"id"			 => 	"",
									"log_type" => 	"Fault Reporting",
									"log_table"=> 	"fault_reporting",
									"log_id"	 => 	$insert_id,
									"datetime" =>		$datetime,
								);
				$log_insert_id = $this->elog_model->insertformlog($log_data);
			}
		}
		if(!isset($post_data["atcc_sup"])){
			$fault_report = array();
			$datetime = date("Y-m-d H:i:s");
			$fault_report["subject"] = "Fault Reporting";
			$fault_report["initial"] = $this->userdetails["agentcode"];
			$fault_report["datetime"] = $datetime;
			$fault_report["form_datetime"] = $datetime;
			$fault_report["system_equipment"] = "ATCC SUP";
			$fault_report["any_other_details"] = "TERMINAL 1 (T1) ATC FACILITY INSPECTION";
			$insert_id = $this->elog_model->insertFaultReporting($fault_report);
			if(!empty($insert_id) && ( $insert_id != 0 )){
				$equip_notif_id = $this->elog_model->insertEquipmentReleaseNotificationATC($insert_id);
				$log_data = array(
									"id"			 => 	"",
									"log_type" => 	"Fault Reporting",
									"log_table"=> 	"fault_reporting",
									"log_id"	 => 	$insert_id,
									"datetime" =>		$datetime,
								);
				$log_insert_id = $this->elog_model->insertformlog($log_data);
			}
		}
		if(!isset($post_data["atcc_arr"])){
			$fault_report = array();
			$datetime = date("Y-m-d H:i:s");
			$fault_report["subject"] = "Fault Reporting";
			$fault_report["initial"] = $this->userdetails["agentcode"];
			$fault_report["datetime"] = $datetime;
			$fault_report["form_datetime"] = $datetime;
			$fault_report["system_equipment"] = "ATCC ARR";
			$fault_report["any_other_details"] = "TERMINAL 1 (T1) ATC FACILITY INSPECTION";
			$insert_id = $this->elog_model->insertFaultReporting($fault_report);
			if(!empty($insert_id) && ( $insert_id != 0 )){
				$equip_notif_id = $this->elog_model->insertEquipmentReleaseNotificationATC($insert_id);
				$log_data = array(
									"id"			 => 	"",
									"log_type" => 	"Fault Reporting",
									"log_table"=> 	"fault_reporting",
									"log_id"	 => 	$insert_id,
									"datetime" =>		$datetime,
								);
				$log_insert_id = $this->elog_model->insertformlog($log_data);
			}
		}
		if(!isset($post_data["atcc_info"])){
			$fault_report = array();
			$datetime = date("Y-m-d H:i:s");
			$fault_report["subject"] = "Fault Reporting";
			$fault_report["initial"] = $this->userdetails["agentcode"];
			$fault_report["datetime"] = $datetime;
			$fault_report["form_datetime"] = $datetime;
			$fault_report["system_equipment"] = "ATCC INFO";
			$fault_report["any_other_details"] = "TERMINAL 1 (T1) ATC FACILITY INSPECTION";
			$insert_id = $this->elog_model->insertFaultReporting($fault_report);
			if(!empty($insert_id) && ( $insert_id != 0 )){
				$equip_notif_id = $this->elog_model->insertEquipmentReleaseNotificationATC($insert_id);
				$log_data = array(
									"id"			 => 	"",
									"log_type" => 	"Fault Reporting",
									"log_table"=> 	"fault_reporting",
									"log_id"	 => 	$insert_id,
									"datetime" =>		$datetime,
								);
				$log_insert_id = $this->elog_model->insertformlog($log_data);
			}
		}
		if(!isset($post_data["atcc_adcs"])){
			$fault_report = array();
			$datetime = date("Y-m-d H:i:s");
			$fault_report["subject"] = "Fault Reporting";
			$fault_report["initial"] = $this->userdetails["agentcode"];
			$fault_report["datetime"] = $datetime;
			$fault_report["form_datetime"] = $datetime;
			$fault_report["system_equipment"] = "ATCC ADCS";
			$fault_report["any_other_details"] = "TERMINAL 1 (T1) ATC FACILITY INSPECTION";
			$insert_id = $this->elog_model->insertFaultReporting($fault_report);
			if(!empty($insert_id) && ( $insert_id != 0 )){
				$equip_notif_id = $this->elog_model->insertEquipmentReleaseNotificationATC($insert_id);
				$log_data = array(
									"id"			 => 	"",
									"log_type" => 	"Fault Reporting",
									"log_table"=> 	"fault_reporting",
									"log_id"	 => 	$insert_id,
									"datetime" =>		$datetime,
								);
				$log_insert_id = $this->elog_model->insertformlog($log_data);
			}
		}
		if(!isset($post_data["atcc_aadn"])){
			$fault_report = array();
			$datetime = date("Y-m-d H:i:s");
			$fault_report["subject"] = "Fault Reporting";
			$fault_report["initial"] = $this->userdetails["agentcode"];
			$fault_report["datetime"] = $datetime;
			$fault_report["form_datetime"] = $datetime;
			$fault_report["system_equipment"] = "ATCC AADN";
			$fault_report["any_other_details"] = "TERMINAL 1 (T1) ATC FACILITY INSPECTION";
			$insert_id = $this->elog_model->insertFaultReporting($fault_report);
			if(!empty($insert_id) && ( $insert_id != 0 )){
				$equip_notif_id = $this->elog_model->insertEquipmentReleaseNotificationATC($insert_id);
				$log_data = array(
									"id"			 => 	"",
									"log_type" => 	"Fault Reporting",
									"log_table"=> 	"fault_reporting",
									"log_id"	 => 	$insert_id,
									"datetime" =>		$datetime,
								);
				$log_insert_id = $this->elog_model->insertformlog($log_data);
			}
		}
		if(!isset($post_data["aes_mfc"])){
			$fault_report = array();
			$datetime = date("Y-m-d H:i:s");
			$fault_report["subject"] = "Fault Reporting";
			$fault_report["initial"] = $this->userdetails["agentcode"];
			$fault_report["datetime"] = $datetime;
			$fault_report["form_datetime"] = $datetime;
			$fault_report["system_equipment"] = "AES,MFC";
			$fault_report["any_other_details"] = "TERMINAL 1 (T1) ATC FACILITY INSPECTION";
			$insert_id = $this->elog_model->insertFaultReporting($fault_report);
			if(!empty($insert_id) && ( $insert_id != 0 )){
				$equip_notif_id = $this->elog_model->insertEquipmentReleaseNotificationATC($insert_id);
				$log_data = array(
									"id"			 => 	"",
									"log_type" => 	"Fault Reporting",
									"log_table"=> 	"fault_reporting",
									"log_id"	 => 	$insert_id,
									"datetime" =>		$datetime,
								);
				$log_insert_id = $this->elog_model->insertformlog($log_data);
			}
		}
		if(!isset($post_data["cleaning"])){
			$fault_report = array();
			$datetime = date("Y-m-d H:i:s");
			$fault_report["subject"] = "Fault Reporting";
			$fault_report["initial"] = $this->userdetails["agentcode"];
			$fault_report["datetime"] = $datetime;
			$fault_report["form_datetime"] = $datetime;
			$fault_report["system_equipment"] = "Cleaning Required";
			$fault_report["any_other_details"] = "TERMINAL 1 (T1) ATC FACILITY INSPECTION";
			$insert_id = $this->elog_model->insertFaultReporting($fault_report);
			if(!empty($insert_id) && ( $insert_id != 0 )){
				$equip_notif_id = $this->elog_model->insertEquipmentReleaseNotificationATC($insert_id);
				$log_data = array(
									"id"			 => 	"",
									"log_type" => 	"Fault Reporting",
									"log_table"=> 	"fault_reporting",
									"log_id"	 => 	$insert_id,
									"datetime" =>		$datetime,
								);
				$log_insert_id = $this->elog_model->insertformlog($log_data);
			}
		}
	}
	
	public function insertAtcAcrFacility(){
		$viewData = array();
		
		$this->generateFaultReportAtcAcr($_POST);
		$insert_id = $this->elog_model->insertAtcFacility($_POST);
		if(!empty($insert_id) && ( $insert_id != 0 )){
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"TERMINAL 1 (T1) ATC FACILITY INSPECTION",
								"log_table"=> 	"atcfacility",
								"log_id"	 => 	$insert_id,
								"datetime" =>		$_POST["datetime"],
							);
			$log_insert_id = $this->elog_model->insertformlog($log_data);
			if(!empty($log_insert_id) && ( $log_insert_id != 0 )){
				$acceslog_data = array(
								"agentcode"		=>	$this->userdetails["agentcode"],
								"message"		=>	"Inserted Terminal 1 (T1) ATC Facility Inspection: ACR Room.",
								"log_datetime"	=> 	date("Y-m-d H:i:s"),
								"form_log_id"	=>	$log_insert_id
							);
				$this->base_model->insertAccessLog($acceslog_data);
				$this->base_model->insertKeywords($_POST);
				redirect("elog/mainview/success");
				$viewData["success_msg"] = "Added Successfully.";
				$this->load->view('header');
				$this->load->view("success_view",$viewData);
				$this->load->view("footer");
			}else{
				$viewData["error_msg"] = "Some error occured please try again.";
				$this->load->view('header');
				$this->load->view("error_view",$viewData);
				$this->load->view("footer");			
			}
		}else{
			$viewData["error_msg"] = "Some error occured please try again.";
			$this->load->view('header');
			$this->load->view("error_view",$viewData);
			$this->load->view("footer");					
		}
	}
	public function insertAtcVcrFacility(){
		$viewData = array();
		$this->generateFaultReportAtcVcr($_POST);
		$insert_id = $this->elog_model->insertAtcFacility($_POST);
		if(!empty($insert_id) && ( $insert_id != 0 )){
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"TERMINAL 1 (T1) ATC FACILITY INSPECTION",
								"log_table"=> 	"atcfacility",
								"log_id"	 => 	$insert_id,
								"datetime" =>		$_POST["datetime"],
							);
			$log_insert_id = $this->elog_model->insertformlog($log_data);
			if(!empty($log_insert_id) && ( $log_insert_id != 0 )){
				$acceslog_data = array(
								"agentcode"		=>	$this->userdetails["agentcode"],
								"message"		=>	"Inserted Terminal 1 (T1) ATC Facility Inspection: VCR Room.",
								"log_datetime"	=> 	date("Y-m-d H:i:s"),
								"form_log_id"	=>	$log_insert_id
							);
				$this->base_model->insertAccessLog($acceslog_data);
				$this->base_model->insertKeywords($_POST);
				redirect("elog/mainview/success");
				$viewData["success_msg"] = "Added Successfully.";
				$this->load->view('header');
				$this->load->view("success_view",$viewData);
				$this->load->view("footer");
			}else{
				$viewData["error_msg"] = "Some error occured please try again.";
				$this->load->view('header');
				$this->load->view("error_view",$viewData);
				$this->load->view("footer");			
			}
		}else{
			$viewData["error_msg"] = "Some error occured please try again.";
			$this->load->view('header');
			$this->load->view("error_view",$viewData);
			$this->load->view("footer");					
		}
	}
	
	public function runwayInUse(){
		$viewData = array();
		$viewData["allusers"] = $this->user_model->getUnitUsers();
		$viewData["countries"] = $this->elog_model->getAllCountries();
		$this->load->view("header",array("page"=>"Runway In Use"));
		$this->load->view("runwayInUse",$viewData);
		$this->load->view("footer");
	}
	
	public function runwayInUse2(){
		$viewData = array();
		$viewData["allusers"] = $this->user_model->getUnitUsers();
		$viewData["countries"] = $this->elog_model->getAllCountries();
		$viewData["runways"] = $this->elog_model->getMyRunways();
		$this->load->view("header",array("page"=>"Runway In Use"));
		$this->load->view("runwayInUse2",$viewData);
		$this->load->view("footer");
	}
	
	public function insertRunwayInUse(){
		$viewData = array();
                $_POST["datetime"] = $_POST["rwy_datetime"];
		$insert_id = $this->elog_model->insertRunwayInUse($_POST);
		if(!empty($insert_id) && ( $insert_id != 0 )){
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"Runway In Use",
								"log_table"=> 	"rwy",
								"log_id"	 => 	$insert_id,
								"datetime" =>		date("Y-m-d H:i:s"),
							);
			$log_insert_id = $this->elog_model->insertformlog($log_data);
			if(!empty($log_insert_id) && ( $log_insert_id != 0 )){
				$acceslog_data = array(
								"agentcode"		=>	$this->userdetails["agentcode"],
								"message"		=>	"Inserted Runway In Use.",
								"log_datetime"	=> 	date("Y-m-d H:i:s"),
								"form_log_id"	=>	$log_insert_id
							);
				$this->base_model->insertAccessLog($acceslog_data);
				$this->base_model->insertKeywords($_POST);
				redirect("elog/mainview/success");
				$viewData["success_msg"] = "Added Successfully.";
				$this->load->view('header');
				$this->load->view("success_view",$viewData);
				$this->load->view("footer");
			}else{
				$viewData["error_msg"] = "Some error occured please try again.";
				$this->load->view('header');
				$this->load->view("error_view",$viewData);
				$this->load->view("footer");			
			}
		}else{
			$viewData["error_msg"] = "Some error occured please try again.";
			$this->load->view('header');
			$this->load->view("error_view",$viewData);
			$this->load->view("footer");					
		}
	}
	public function faultReporting(){
		$viewData = array();
		$viewData["countries"] = $this->elog_model->getAllCountries();
		$viewData["allUsers"] = $this->user_model->getUnitUsers();
		$this->load->view("header",array("page"=>"Fault Reporting"));
		$this->load->view("faultReporting",$viewData);
		$this->load->view("footer");
	}
	public function equipmentRelease(){
		$viewData = array();
		$viewData["countries"] = $this->elog_model->getAllCountries();
		$viewData["allUsers"] = $this->user_model->getUnitUsers();
		$this->load->view("header",array("page"=>"Equipment Release"));
		$this->load->view("equipmentRelease",$viewData);
		$this->load->view("footer");
	}
	
	public function insertFaultReporting(){
		$viewData = array();
		$insert_id = $this->elog_model->insertFaultReporting($_POST);
		if(!empty($insert_id) && ( $insert_id != 0 )){
			if( ( isset($this->userdetails["permissions"]["getApprovedNotifications"]) ) && ( $_POST["subject"] == "Equipment Release" ) ){
				$equip_notif_id = $this->elog_model->insertEquipmentReleaseNotification($insert_id);
				
			}
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"Fault Reporting",
								"log_table"=> 	"fault_reporting",
								"log_id"	 => 	$insert_id,
								"datetime" =>		date("Y-m-d H:i:s"),
							);
			$log_insert_id = $this->elog_model->insertformlog($log_data);
			if(!empty($log_insert_id) && ( $log_insert_id != 0 )){
				$message = "";
				if($_POST["subject"] == "Equipment Release"){
					$message = "Inserted Equipment release.";
				}else if($_POST["subject"] == "Fault Reporting"){
					$message = "Inserted Fault Reporting.";
				}
				$acceslog_data = array(
								"agentcode"		=>	$this->userdetails["agentcode"],
								"message"		=>	$message,
								"log_datetime"	=> 	date("Y-m-d H:i:s"),
								"form_log_id"	=>	$log_insert_id
							);
				$this->base_model->insertAccessLog($acceslog_data);
				$this->base_model->insertKeywords($_POST);
				if( ($this->userdetails["role"] == "engineer" ) || ($this->userdetails["role"] == "normal" ) ){
					redirect("elog/mainview/faultreports/success");
				}else{
					redirect("elog/mainview/success");
				}
				$viewData["success_msg"] = "Added Successfully.";
				$this->load->view('header');
				$this->load->view("success_view",$viewData);
				$this->load->view("footer");
			}else{
				$viewData["error_msg"] = "Some error occured please try again.";
				$this->load->view('header');
				$this->load->view("error_view",$viewData);
				$this->load->view("footer");			
			}
		}else{
			$viewData["error_msg"] = "Some error occured please try again.";
			$this->load->view('header');
			$this->load->view("error_view",$viewData);
			$this->load->view("footer");					
		}
	}



	public function agl(){
		$viewData = array();
		$viewData["countries"] = $this->elog_model->getAllCountries();
		$this->load->view("header",array("page"=>"AGL Inspection"));
		$this->load->view("agl",$viewData);
		$this->load->view("footer");
	}
	
	public function insertAgl(){
		$viewData = array();
		$insert_id = $this->elog_model->insertAgl($_POST);
		if(!empty($insert_id) && ( $insert_id != 0 )){
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"AIRFIELD GROUND LIGHTING (AGL) INSPECTION",
								"log_table"=> 	"agl",
								"log_id"	 => 	$insert_id,
								"datetime" =>		$_POST["datetime"],
							);
			$log_insert_id = $this->elog_model->insertformlog($log_data);
			if(!empty($log_insert_id) && ( $log_insert_id != 0 )){
				$acceslog_data = array(
								"agentcode"		=>	$this->userdetails["agentcode"],
								"message"		=>	"Inserted AGL Inspection.",
								"log_datetime"	=> 	date("Y-m-d H:i:s"),
								"form_log_id"	=>	$log_insert_id
							);
				$this->base_model->insertAccessLog($acceslog_data);
				$this->base_model->insertKeywords($_POST);
				redirect("elog/mainview/success");
				$viewData["success_msg"] = "Added Successfully.";
				$this->load->view('header');
				$this->load->view("success_view",$viewData);
				$this->load->view("footer");
			}else{
				$viewData["error_msg"] = "Some error occured please try again.";
				$this->load->view('header');
				$this->load->view("error_view",$viewData);
				$this->load->view("footer");			
			}
		}else{
			$viewData["error_msg"] = "Some error occured please try again.";
			$this->load->view('header');
			$this->load->view("error_view",$viewData);
			$this->load->view("footer");					
		}
	}
	public function RunwayManoeuvringArea(){
		$viewData = array();
		$viewData["areanames"] = $this->elog_model->getAllAreaNames();
		$this->load->view("header",array("page"=>"Runway Manoeuvring Area Inspection"));
		$this->load->view("RunwayManoeuvringArea",$viewData);
		$this->load->view("footer");
	}
	
	public function insertRunwayManoeuvringArea(){
		$viewData = array();
		$insert_id = $this->elog_model->insertRunwayManoeuvringArea($_POST);
		if(!empty($insert_id) && ( $insert_id != 0 )){
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"Runway Manoeuvring Area Inspection",
								"log_table"=> 	"rwy_area_inspection",
								"log_id"	 => 	$insert_id,
								"datetime" =>		$_POST["datetime"],
							);
			$log_insert_id = $this->elog_model->insertformlog($log_data);
			if(!empty($log_insert_id) && ( $log_insert_id != 0 )){
				$acceslog_data = array(
								"agentcode"		=>	$this->userdetails["agentcode"],
								"message"		=>	"Inserted Runway / Manoeuvring Area Inspection",
								"log_datetime"	=> 	date("Y-m-d H:i:s"),
								"form_log_id"	=>	$log_insert_id
							);
				$this->base_model->insertAccessLog($acceslog_data);
				$this->base_model->insertKeywords($_POST);
				redirect("elog/mainview/success");
				$viewData["success_msg"] = "Added Successfully.";
				$this->load->view('header');
				$this->load->view("success_view",$viewData);
				$this->load->view("footer");
			}else{
				$viewData["error_msg"] = "Some error occured please try again.";
				$this->load->view('header');
				$this->load->view("error_view",$viewData);
				$this->load->view("footer");			
			}
		}else{
			$viewData["error_msg"] = "Some error occured please try again.";
			$this->load->view('header');
			$this->load->view("error_view",$viewData);
			$this->load->view("footer");					
		}
	}

	public function generalentry_edit(){
		$rec = $this->elog_model->getGeneralEntry($_POST["id"]);
		$viewData["allusers"] = $this->user_model->getAllUsers();
		$viewData["log"] = $rec[0];
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$this->load->view("generalentry_edit",$viewData);
	}
	public function updateGeneralEntry(){
		$log_id = $_GET["log_id"];
		if($this->elog_model->updateGeneralEntry($log_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated General Entry log.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$log_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		}else{
			print("error");
		}
		
	}
	public function runwaymanoeuvringareainspection_edit(){
		$rec = $this->elog_model->getrunwaymanoeuvringareainspection($_POST["id"]);
		$viewData["allusers"] = $this->user_model->getAllUsers();
		$viewData["log"] = $rec[0];
		$viewData["areanames"] = $this->elog_model->getAllAreaNames();
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$this->load->view("runwaymanoeuvringareainspection_edit",$viewData);
	}
	public function updaterunwaymanoeuvringareainspection(){
		$log_id = $_GET["log_id"];
		if($this->elog_model->updaterunwaymanoeuvringareainspection($log_id,$_POST)){
			// print_r($_POST);
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated  RWY/Manoeuvring Inspection log.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$log_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		}else{
			print("error");
		}
		
	}
	public function faultreporting_edit(){
		$rec = $this->elog_model->getFaultReporting($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$this->load->view("faultreporting_edit",$viewData);
	}
	public function updateFaultReporting(){
		$log_id = $_GET["log_id"];
		if($this->elog_model->updateFaultReporting($log_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated ".$_POST["subject"]." log.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$log_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		}else{
			print("error");
		}
		
	}
	public function aircraftdiversion_edit(){
		$rec = $this->elog_model->getAircraftDiversion($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["allusers"] = $this->user_model->getUnitUsers();
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$this->load->view("aircraftdiversion_edit",$viewData);
	}	
	public function controlmobile1_edit(){
		$rec = $this->elog_model->getControlMobile($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$this->load->view("controlmobile1_edit",$viewData);
	}
	public function controlmobile2_edit(){
		$rec = $this->elog_model->getControlMobile($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$this->load->view("controlmobile2_edit",$viewData);
	}
	public function updateControlMobile(){
		$log_id = $_GET["log_id"];
		if($this->elog_model->updateControlMobile($log_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated ".$_POST["subject"]." log.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$log_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		}else{
			print("error");
		}
		
	}	
	public function runwayinuse_edit(){
		$rec = $this->elog_model->getRunwayInUse($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$viewData["runways"] = $this->elog_model->getMyRunways();
		$this->load->view("runwayInUse_edit",$viewData);
	}
	public function updateRunwayInUse(){
		$log_id = $_GET["log_id"];
		if($this->elog_model->updateRunwayInUse($log_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated Runway In Use log.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$log_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		}else{
			print("error");
		}
		
	}
	public function agl_edit(){
		$rec = $this->elog_model->getAGL($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$this->load->view("agl_edit",$viewData);
	}
	public function updateAGL(){
		$log_id = $_GET["log_id"];
		if($this->elog_model->updateAGL($log_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated ".$_POST["subject"]." log.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$log_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		}else{
			print("error");
		}
		
	}
	public function atc_edit(){
		$rec = $this->elog_model->getATC($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		if($viewData["log"]["atc_type"] == "Approach Control Room"){
			$this->load->view("acr_edit",$viewData);
		}else{
			$this->load->view("vcr_edit",$viewData);			
		}
	}
	public function updateATC(){
		$log_id = $_GET["log_id"];
		if($this->elog_model->updateATC($log_id,$_POST)){
			print("updated");
		}else{
			print("error");
		}
		
	}
	public function updateAirCraftDiversion(){
		$log_id = $_GET["log_id"];
		if($this->elog_model->updateAirCraftDiversion($log_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated ".$_POST["subject"]." log.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$log_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		}else{
			print("error");
		}
		
	}

	public function NoShow(){	
		$viewData = array();
		$viewData["allusers"] = $this->user_model->getUnitUsers();
		$viewData["shiftnames"] = $this->elog_model->getAllShifts();
		$this->load->view("header",array("page"=>"No Show"));
		$this->load->view("lvp/NoShow",$viewData);
		$this->load->view("footer");
	}
	public function LateForDuty(){
		$viewData = array();
		$viewData["allusers"] = $this->user_model->getUnitUsers();
		$viewData["absenceReasons"] = $this->elog_model->getAllStaffAbsenceReasons();
		$this->load->view("header",array("page"=>"Late For Duty"));
		$this->load->view("lvp/LateForDuty",$viewData);
		$this->load->view("footer");
	}
	public function SentHome(){
		$viewData = array();
		$viewData["allusers"] = $this->user_model->getUnitUsers();
		$viewData["shiftnames"] = $this->elog_model->getAllShifts();
		$viewData["absenceReasons"] = $this->elog_model->getAllStaffAbsenceReasons();
		$this->load->view("header",array("page"=>"Sent Home"));
		$this->load->view("lvp/SentHome",$viewData);
		$this->load->view("footer");
	}
	public function UnavailableForDuty(){
		$viewData = array();
		$viewData["allusers"] = $this->user_model->getUnitUsers();
		$viewData["shiftnames"] = $this->elog_model->getAllShifts();
		$viewData["absenceReasons"] = $this->elog_model->getAllStaffAbsenceReasons();
		$this->load->view("header",array("page"=>"Unavailable For Duty"));
		$this->load->view("lvp/UnavailableForDuty",$viewData);
		$this->load->view("footer");
	}
	public function SicknessForDuty(){
		$viewData = array();
		$viewData["allusers"] = $this->user_model->getUnitUsers();
		$viewData["shiftnames"] = $this->elog_model->getAllShifts();
		$viewData["absenceReasons"] = $this->elog_model->getAllStaffAbsenceReasons();
		$this->load->view("header",array("page"=>"Sickness For Duty"));
		$this->load->view("lvp/SicknessForDuty",$viewData);
		$this->load->view("footer");
	}
	public function FitnessOrReturnForDuty(){
		$viewData = array();
		$viewData["allusers"] = $this->user_model->getUnitUsers();
		$viewData["shiftnames"] = $this->elog_model->getAllShifts();
		$viewData["absenceReasons"] = $this->elog_model->getAllStaffAbsenceReasons();
		$this->load->view("header",array("page"=>"Fitness Or Return For Duty"));
		$this->load->view("lvp/FitnessOrReturnForDuty",$viewData);
		$this->load->view("footer");
	}

	public function insertlvp(){
		$viewData = array();
		$insert_id = $this->elog_model->insertlvp($_POST);
		if(!empty($insert_id) && ( $insert_id != 0 )){
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	$_POST["subject"],
								"log_table"=> 	"lvp",
								"log_id"	 => 	$insert_id,
								"datetime" =>		$_POST["datetime"],
							);
			$log_insert_id = $this->emergency_model->insertformlog($log_data);
			if(!empty($log_insert_id) && ( $log_insert_id != 0 )){
				$message = "";
				$acceslog_data = array(
								"agentcode"		=>	$this->userdetails["agentcode"],
								"message"		=>	"Inserted Staff Absence: ".$_POST["subject"],
								"log_datetime"	=> 	date("Y-m-d H:i:s"),
								"form_log_id"	=>	$log_insert_id
							);
				$this->base_model->insertAccessLog($acceslog_data);

				$this->base_model->insertKeywords($_POST);
				redirect("elog/mainview/success");
				$viewData["success_msg"] = "Added Successfully.";
				$this->load->view('header');
				$this->load->view("success_view",$viewData);
				$this->load->view("footer");
			}else{
				$viewData["error_msg"] = "Some error occured please try again.";
				$this->load->view('header');
				$this->load->view("error_view",$viewData);
				$this->load->view("footer");			
			}
		}else{
			$viewData["error_msg"] = "Some error occured please try again.";
			$this->load->view('header');
			$this->load->view("error_view",$viewData);
			$this->load->view("footer");					
		}
	}

	/* Functions for staff absence forms */


	public function noshow_edit(){
		$rec = $this->elog_model->getnoshow($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$viewData["allusers"] = $this->user_model->getUnitUsers();
		$viewData["shiftnames"] = $this->elog_model->getAllShifts();
		$viewData["absenceReasons"] = $this->elog_model->getAllStaffAbsenceReasons();
		$this->load->view("sa_edit/noshow_edit",$viewData);
	}
	public function updatenoshow(){
		$log_id = $_GET["log_id"];
		if($this->elog_model->updatenoshow($log_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated ".$_POST["subject"]." log.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$log_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		}else{
			print("error");
		}
		
	}
	public function lateforduty_edit(){
		$rec = $this->elog_model->getlateforduty($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$viewData["allusers"] = $this->user_model->getUnitUsers();
		$viewData["shiftnames"] = $this->elog_model->getAllShifts();
		$viewData["absenceReasons"] = $this->elog_model->getAllStaffAbsenceReasons();
		$this->load->view("sa_edit/lateforduty_edit",$viewData);
	}
	public function updatelateforduty(){
		$log_id = $_GET["log_id"];
		if($this->elog_model->updatelateforduty($log_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated ".$_POST["subject"]." log.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$log_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		}else{
			print("error");
		}
		
	}

	public function senthome_edit(){
		$rec = $this->elog_model->getsenthome($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$viewData["allusers"] = $this->user_model->getUnitUsers();
		$viewData["shiftnames"] = $this->elog_model->getAllShifts();
		$viewData["absenceReasons"] = $this->elog_model->getAllStaffAbsenceReasons();
		$this->load->view("sa_edit/senthome_edit",$viewData);
	}
	public function updatesenthome(){
		$log_id = $_GET["log_id"];
		if($this->elog_model->updatesenthome($log_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated ".$_POST["subject"]." log.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$log_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		}else{
			print("error");
		}
		
	}
	public function unavailableforduty_edit(){
		$rec = $this->elog_model->getunavailableforduty($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$viewData["allusers"] = $this->user_model->getUnitUsers();
		$viewData["shiftnames"] = $this->elog_model->getAllShifts();
		$viewData["absenceReasons"] = $this->elog_model->getAllStaffAbsenceReasons();
		$this->load->view("sa_edit/unavailableforduty_edit",$viewData);
	}
	public function updateunavailableforduty(){
		$log_id = $_GET["log_id"];
		if($this->elog_model->updateunavailableforduty($log_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated ".$_POST["subject"]." log.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$log_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		}else{
			print("error");
		}
		
	}

	public function sicknessforduty_edit(){
		$rec = $this->elog_model->getsicknessforduty($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$viewData["allusers"] = $this->user_model->getUnitUsers();
		$viewData["shiftnames"] = $this->elog_model->getAllShifts();
		$viewData["absenceReasons"] = $this->elog_model->getAllStaffAbsenceReasons();
		$this->load->view("sa_edit/sicknessforduty_edit",$viewData);
	}
	public function updatesicknessforduty(){
		$log_id = $_GET["log_id"];
		if($this->elog_model->updatesicknessforduty($log_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated ".$_POST["subject"]." log.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$log_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		}else{
			print("error");
		}
		
	}
	public function fitnessorreturnforduty_edit(){
		$rec = $this->elog_model->getfitnessorreturnforduty($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$viewData["allusers"] = $this->user_model->getUnitUsers();
		$viewData["shiftnames"] = $this->elog_model->getAllShifts();
		$viewData["absenceReasons"] = $this->elog_model->getAllStaffAbsenceReasons();
		$this->load->view("sa_edit/fitnessorreturnforduty_edit",$viewData);
	}
	public function updatefitnessorreturnforduty(){
		$log_id = $_GET["log_id"];
		if($this->elog_model->updatefitnessorreturnforduty($log_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated ".$_POST["subject"]." log.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$log_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		}else{
			print("error");
		}
		
	}

	public function testGET(){
		print_r($_GET);
	}
	public function testPOST(){
		print_r($_POST);
	}

	/* Functions for staff absence forms */
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
