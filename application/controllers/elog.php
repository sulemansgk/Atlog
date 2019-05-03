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
		
	}

	public function SelectedUnit(){
		  $unit = $_POST['unit'];
		  $units_name = $this->db->get_where('runway', array('unit_id' => $unit))->result_array();
          $name = "<option value=''> NOT AVILABLE </option>";
          if(!empty($units_name)){
              $name = "<option value=''>Please Select</option>";
              foreach($units_name as $key){
                  $name .= "<option value='".$key['runway_id']."'>".$key['runway']."</option>";
              }
          }
          echo $name;
    }	

	public function generalentry(){
		$viewData = array();
		$viewData["allusers"] = $this->user_model->getUnitUsers();
		$viewData["subjects"] = $this->elog_model->getAllSubjects();
		$this->load->view("header_mat",array("page"=>"General Entry"));
		$this->load->view("generalentry",$viewData);
		$this->load->view("footer_mat");
	}

	public function insertgeneralentry(){
		$viewData = array();
		// Date Set Work
		$datee = (date('Y-m-d',strtotime($_POST['date'])) .' '. $_POST['time'] ? date('Y-m-d',strtotime($_POST['date'])) .' '. $_POST['time'] : date('Y-m-d H:i:s'));
		$new_array = array(
								"initial" => $_POST['initial'],
								"datetime" => $datee,
								"onbehalf"=> $_POST['onbehalf'],
								"subject"	 => $_POST['subject'],
								"description" => $_POST['description'],
							);
		// End 
		$insert_id = $this->elog_model->insertgeneralentry($new_array);
		if(!empty($insert_id) && ( $insert_id != 0 )){
		
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"generalentry",
								"log_table"=> 	"generalentry",
								"log_id"	 => 	$insert_id,
								"datetime" =>		$datee,
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
				$this->load->view('header_mat');
				$this->load->view("success_view",$viewData);
				$this->load->view("footer_mat");
			}else{
				$viewData["error_msg"] = "Some error occured please try again.";
				$this->load->view('header_mat');
				$this->load->view("error_view",$viewData);
				$this->load->view("footer_mat");			
			}
		}else{
			$viewData["error_msg"] = "Some error occured please try again.";
			$this->load->view('header_mat');
			$this->load->view("error_view",$viewData);
			$this->load->view("footer_mat");					
		}
	}

	public function controlmobile(){
		$data = array();
		$data["allusers"] = $this->user_model->getUnitUsers();
		$cm1 = $this->elog_model->getControlMobile1();
		$cm2 = $this->elog_model->getControlMobile2();
		$data["cm1"] = $cm1;
		$data["cm2"] = $cm2;
		$this->load->view("header_mat",array("page"=>"Control Mobile"));
		$this->load->view("controlmobile",$data);
		$this->load->view("footer_mat");
	}

	public function insertcontrolmobile1(){
		
		$viewData = array();
		$date1 = (date('Y-m-d',strtotime($_POST['date'])) .' '. $_POST['time'] ? date('Y-m-d',strtotime($_POST['date'])) .' '. $_POST['time'] : date('Y-m-d H:i:s'));
		$new_array = array(
								"initial" => $_POST['initial'],
								"datetime" => $date1,
								"subject"	 => $_POST['subject'],
								"remarks" => $_POST['remarks'],
								"mobile_type" => $_POST['mobile_type'],
								"to_from" => $_POST['to_from'],
								"control_mobile1" => $_POST['control_mobile1'],
							);
		
		$insert_id = $this->elog_model->insertcontrolmobilein($new_array);
		if(!empty($insert_id) && ( $insert_id != 0 )){
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"controlmobile1",
								"log_table"=> 	"controlmobile",
								"log_id"	 => 	$insert_id,
								"datetime" =>		$date1,
							);
			$log_insert_id = $this->elog_model->insertformlog($log_data);
			if(!empty($log_insert_id) && ( $log_insert_id != 0 )){
				$acceslog_data = array(
								"agentcode"		=>	$this->userdetails["agentcode"],
								"message"		=>	"Inserted Control Mobile 1",
								"log_datetime"	=> 	date("Y-m-d H:i:s"),
								"form_log_id"	=>	$log_insert_id
							);
				$this->base_model->insertAccessLog($acceslog_data);
				$this->base_model->insertKeywords($_POST);
				redirect("elog/mainview/success");
				$viewData["success_msg"] = "Added Successfully.";
				redirect("elog/mainview/success");
				$this->load->view('header_mat');
				$this->load->view("success_view",$viewData);
				$this->load->view("footer_mat");
			}else{
				$viewData["error_msg"] = "Some error occured please try again.";
				$this->load->view('header_mat');
				$this->load->view("error_view",$viewData);
				$this->load->view("footer_mat");			
			}
		}else{
			$viewData["error_msg"] = "Some error occured please try again.";
			$this->load->view('header_mat');
			$this->load->view("error_view",$viewData);
			$this->load->view("footer_mat");					
		}
	}

	public function insertcontrolmobile2(){
		
		$viewData = array();
		$date1 = (date('Y-m-d',strtotime($_POST['date'])) .' '. $_POST['time'] ? date('Y-m-d',strtotime($_POST['date'])) .' '. $_POST['time'] : date('Y-m-d H:i:s'));
		$new_array = array(
								"initial" => $_POST['initial'],
								"datetime" => $date1,
								"subject"	 => $_POST['subject'],
								"remarks" => $_POST['remarks'],
								"mobile_type" => $_POST['mobile_type'],
								"to_from" => $_POST['to_from'],
								"control_mobile1" => $_POST['control_mobile1'],
							);
		$insert_id = $this->elog_model->insertcontrolmobileout($new_array);
		if(!empty($insert_id) && ( $insert_id != 0 )){
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"controlmobile2",
								"log_table"=> 	"controlmobile",
								"log_id"	 => 	$insert_id,
								"datetime" =>		$date1,
							);
			$log_insert_id = $this->elog_model->insertformlog($log_data);
			if(!empty($log_insert_id) && ( $log_insert_id != 0 )){
				$acceslog_data = array(
								"agentcode"		=>	$this->userdetails["agentcode"],
								"message"		=>	"Inserted Control Mobile 2",
								"log_datetime"	=> 	date("Y-m-d H:i:s"),
								"form_log_id"	=>	$log_insert_id
							);
				$this->base_model->insertAccessLog($acceslog_data);
				$this->base_model->insertKeywords($_POST);
				redirect("elog/mainview/success");
				$viewData["success_msg"] = "Added Successfully.";
				$this->load->view('header_mat');
				$this->load->view("success_view",$viewData);
				$this->load->view("footer_mat");
			}else{
				$viewData["error_msg"] = "Some error occured please try again.";
				$this->load->view('header_mat');
				$this->load->view("error_view",$viewData);
				$this->load->view("footer_mat");			
			}
		}else{
			$viewData["error_msg"] = "Some error occured please try again.";
			$this->load->view('header_mat');
			$this->load->view("error_view",$viewData);
			$this->load->view("footer_mat");					
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
		
		if(isset($_GET["submit"])){
				$this->session->set_userdata(array(
				"accesslogs_filter"=>array(
				"frnstatus"=>$_GET["frnstatus"],
				"from"=>$_GET["from"],
				"to"=>$_GET["to"],
				"unit_id"=>$_GET["unit_id"],
				
				)
				));
				$accesslogs_filter = $_GET;
			}
		
		
		$order = $this->session->userdata("order");
		$data = array();
		$this->load->library("pagination");
		$per_page = 200; 	// how many pagination page show in Main View
		$total = $this->elog_model->count_rec("form_logs");  //total post
		if($this->uri->segment(3) == "faultreports"){
			$data['logs'] = $this->elog_model->getAllLogs($per_page, $this->uri->segment(4),$accesslogs_filter);
			$config['base_url'] = $this->config->item('base_url').'elog/mainview/faultreports';
			$config['uri_segment'] = '4';
			$data["subjects"] = $this->elog_model->getAllActiveSubjects();
		}else{
			$data['logs'] = $this->elog_model->getAllLogs($per_page, $this->uri->segment(3),$accesslogs_filter);
			$config['base_url'] = $this->config->item('base_url').'elog/mainview/';
			$config['uri_segment'] = '3';
			$data["subjects"] = $this->elog_model->getAllActiveSubjects();
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
		$data["accesslogs_filter"] = $accesslogs_filter;
		$this->load->view("header_mat",array("page"=>"Main View"));
		$this->load->view("mainview",$data);
		$this->load->view("footer_mat");
	}
	
	public function aircraftDiversion(){
		$viewData = array();
		$viewData["allusers"] = $this->user_model->getUnitUsers();
		$this->load->view("header_mat",array("page"=>"Aircraft Diversion"));
		$this->load->view("aircraftDiversion",$viewData);
		$this->load->view("footer_mat");	
	}
	
	public function insertAircraftDiversion(){
		$viewData = array();
		$date1 = (date('Y-m-d',strtotime($_POST['date'])) .' '. $_POST['time'] ? date('Y-m-d',strtotime($_POST['date'])) .' '. $_POST['time'] : date('Y-m-d H:i:s'));
		$new_array = array(
								"initial" => $_POST['initial'],
								"datetime" => $date1,
								"onbehalf"=> $_POST['onbehalf'],
								"subject"	 => $_POST['subject'],
								"any_other_details" => $_POST['any_other_details'],
								"time_aircraft_divert" => $_POST['time_aircraft_divert'],
								"callsign" => $_POST['callsign'],
								"aircraft_type" => $_POST['aircraft_type'],
								"ssr_transporter_code" => $_POST['ssr_transporter_code'],
								"point_of_departure" => $_POST['point_of_departure'],
								"original_destination" => $_POST['original_destination'],
								"new_destination" => $_POST['new_destination'],
								"time_of_arrival" => $_POST['time_of_arrival'],
								"TrafficOfficerInformedTime" => $_POST['TrafficOfficerInformedTime'],
								"AOCCInformedTime" => $_POST['AOCCInformedTime'],
							);
		$insert_id = $this->elog_model->insertlog($new_array);
		if(!empty($insert_id) && ( $insert_id != 0 )){
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"Aircraft Diversion",
								"log_table"=> 	"aircraftdiversion",
								"log_id"	 => 	$insert_id,
								"datetime" =>		$date1,
							);
			$log_insert_id = $this->elog_model->insertformlog($log_data);
			if(!empty($log_insert_id) && ( $log_insert_id != 0 )){
				$acceslog_data = array(
								"agentcode"		=>	$this->userdetails["agentcode"],
								"message"		=>	"Inserted Aircraft Diversion.",
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
	
	public function atcfacility(){
		$this->load->view('header_mat',array("page"=>"ATC Facility"));
		$this->load->view("atcfacility");
		$this->load->view("footer_mat");							
	}
	
	public function generateFaultReportAtcAcr($post_data){
		if(!isset($post_data["124_4Mhz"])){
			$fault_report = array();
			$datetime = date("Y-m-d H:i:s");
			$fault_report["subject"] = "Fault Reporting";
			$fault_report["initial"] = $this->userdetails["agentcode"];
			$fault_report["datetime"] = $datetime;
			$fault_report["form_datetime"] = $datetime;
			$fault_report["system_equipment"] = "124.400 Mhz";
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
		if(!isset($post_data["127_5Mhz"])){
			$fault_report = array();
			$datetime = date("Y-m-d H:i:s");
			$fault_report["subject"] = "Fault Reporting";
			$fault_report["initial"] = $this->userdetails["agentcode"];
			$fault_report["datetime"] = $datetime;
			$fault_report["form_datetime"] = $datetime;
			$fault_report["system_equipment"] = "127.500 Mhz";
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
		if(!isset($post_data["124_6Mhz"])){
			$fault_report = array();
			$datetime = date("Y-m-d H:i:s");
			$fault_report["subject"] = "Fault Reporting";
			$fault_report["initial"] = $this->userdetails["agentcode"];
			$fault_report["datetime"] = $datetime;
			$fault_report["form_datetime"] = $datetime;
			$fault_report["system_equipment"] = "124.625 Mhz";
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
		if(!isset($post_data["radar"])){
			$fault_report = array();
			$datetime = date("Y-m-d H:i:s");
			$fault_report["subject"] = "Fault Reporting";
			$fault_report["initial"] = $this->userdetails["agentcode"];
			$fault_report["datetime"] = $datetime;
			$fault_report["form_datetime"] = $datetime;
			$fault_report["system_equipment"] = "RADAR";
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
		if(!isset($post_data["awos"])){
			$fault_report = array();
			$datetime = date("Y-m-d H:i:s");
			$fault_report["subject"] = "Fault Reporting";
			$fault_report["initial"] = $this->userdetails["agentcode"];
			$fault_report["datetime"] = $datetime;
			$fault_report["form_datetime"] = $datetime;
			$fault_report["system_equipment"] = "AWOS";
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
			$fault_report["system_equipment"] = "ATCC ARR ";
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
		$this->load->view("header_mat",array("page"=>"Runway In Use"));
		$this->load->view("runwayInUse",$viewData);
		$this->load->view("footer_mat");
	}
	
	public function runwayInUse2(){
		$viewData = array();
		$viewData["allusers"] = $this->user_model->getUnitUsers();
		$viewData["countries"] = $this->elog_model->getAllCountries();
		$viewData["runways"] = $this->elog_model->getMyRunways();
		$viewData["units"] = $this->elog_model->getAllUnits();
		$this->load->view("header_mat",array("page"=>"Runway In Use"));
		$this->load->view("runwayInUse2",$viewData);
		$this->load->view("footer_mat");
	}
	
	public function MetCondition(){
		$viewData = array();
		$viewData["units"] = $this->elog_model->getAllUnits();
		$this->load->view("header_mat",array("page"=>"Met Condition"));
		$this->load->view("met_condition",$viewData);
		$this->load->view("footer_mat");
	}
	
	public function insertRunwayInUse(){
		$viewData = array();
		$date1 = (date('Y-m-d',strtotime($_POST['date'])) .' '. $_POST['time'] ? date('Y-m-d',strtotime($_POST['date'])) .' '. $_POST['time'] : date('Y-m-d H:i:s'));
		$new_array = array(
								"initial" => $_POST['initial'],
								"datetime" => $date1,
								"onbehalf"=> $_POST['onbehalf'],
								"subject"	 => $_POST['subject'],
								"description" => $_POST['description'],
								"unit_id" => $_POST['unit_id'],
								"runway_in_use" => $_POST['runway_in_use'],
								"runway_in_use_depart" => $_POST['runway_in_use_depart'],
							);
		$insert_id = $this->elog_model->insertRunwayInUse($new_array);
		if(!empty($insert_id) && ( $insert_id != 0 )){
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"Runway In Use",
								"log_table"=> 	"rwy",
								"log_id"	 => 	$insert_id,
								"datetime" =>		$date1,
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
	
	
	public function insertmetcondition(){
		if ($_POST['no_runway'] == 'on') {
			$no_runway = 1;
		} else{
			$no_runway = 0;
		}
		
		$date1 = (date('Y-m-d',strtotime($_POST['date'])) .' '. $_POST['time'] ? date('Y-m-d',strtotime($_POST['date'])) .' '. $_POST['time'] : date('Y-m-d H:i:s')); 
		$con = array(
			    "initial" => $_POST['initial'],
				"unit_id" => $_POST['unit_id'],
				"condition" => $_POST['condition'],
				"datetime" => $date1,
				"subject" => $_POST['subject'],
				"no_runway" => $no_runway,
			    );
					
		$viewData = array();
		$insert_id = $this->elog_model->insertmetcondition($con);
		if(!empty($insert_id) && ( $insert_id != 0 )){
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"MET Condition",
								"log_table"=> 	"met_condition",
								"log_id"	 => 	$insert_id,
								"datetime" =>		$date1,
							);
			$log_insert_id = $this->elog_model->insertformlog($log_data);
			if(!empty($log_insert_id) && ( $log_insert_id != 0 )){
				$acceslog_data = array(
								"agentcode"		=>	$this->userdetails["agentcode"],
								"message"		=>	"Inserted MET Condition",
								"log_datetime"	=> 	date("Y-m-d H:i:s"),
								"form_log_id"	=>	$log_insert_id
							);
				$this->base_model->insertAccessLog($acceslog_data);
				$this->base_model->insertKeywords($con);
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
		$viewData["allusers"] = $this->user_model->getAllUsers();
		$viewData["equipments"] = $this->elog_model->getAllEquipments();
		$viewData["positions"] = $this->elog_model->getAllPositions();
		$viewData["consoleNumbers"] = $this->elog_model->getAllConsoleNumbers();
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$viewData["allUsers"] = $this->user_model->getUnitUsers();
		$this->load->view("header_mat",array("page"=>"Fault Reporting"));
		$this->load->view("faultReporting",$viewData);
		$this->load->view("footer_mat");
	}
	public function equipmentRelease(){
		$viewData = array();
		$viewData["countries"] = $this->elog_model->getAllCountries();
		$viewData["allUsers"] = $this->user_model->getUnitUsers();
		$viewData["equipments"] = $this->elog_model->getAllEquipments();
		$viewData["positions"] = $this->elog_model->getAllPositions();
		$viewData["consoleNumbers"] = $this->elog_model->getAllConsoleNumbers();
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$this->load->view("header_mat",array("page"=>"Equipment Release"));
		$this->load->view("equipmentRelease",$viewData);
		$this->load->view("footer_mat");
	}
	
	public function insertFaultReporting(){
		$viewData = array();
		// Date Set Work
		$datee = (date('Y-m-d',strtotime($_POST['date'])) .' '. $_POST['time'] ? date('Y-m-d',strtotime($_POST['date'])) .' '. $_POST['time'] : date('Y-m-d H:i:s'));
		$new_array = array(
								"subject" => $_POST['subject'],
								"initial" => $_POST['initial'],
								"datetime" => $datee,
								"onbehalf"=> $_POST['onbehalf'],
								"position_name" => $_POST['position_name'],
								"console_number" => $_POST['console_number'],
								"system_equipment" => $_POST['system_equipment'],
								"purpose_of_release" => $_POST['purpose_of_release'],
								"error_text" => $_POST['error_text'],
								"any_other_details" => $_POST['any_other_details'],
								"frnstatus" => '',
							);
		// End 
		$insert_id = $this->elog_model->insertFaultReporting($new_array);
		//echo "<pre>"; print_r($this->userdetails["permissions"]["getApprovedNotifications"]); die();
		if(!empty($insert_id) && ( $insert_id != 0 )){
			if( ( isset($this->userdetails["permissions"]["getApprovedNotifications"]) ) && ( $_POST["subject"] == "Equipment Release" ) || ($_POST['subject'] == "Fault Reporting") ){
				$equip_notif_id = $this->elog_model->insertEquipmentReleaseNotification($insert_id);
			}
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"Fault Reporting",
								"log_table"=> 	"fault_reporting",
								"log_id"	 => 	$insert_id,
								"datetime" =>		$datee,
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
		$this->load->view("header_mat",array("page"=>"AGL Inspection"));
		$this->load->view("agl",$viewData);
		$this->load->view("footer_mat");
	}
	
	public function insertAgl(){
		$viewData = array();
		$date1 = (date('Y-m-d',strtotime($_POST['date'])) .' '. $_POST['time'] ? date('Y-m-d',strtotime($_POST['date'])) .' '. $_POST['time'] : date('Y-m-d H:i:s'));
		$new_array = array(
								"initial" => $_POST['initial'],
								"datetime" => $date1,
								"subject"	 => $_POST['subject'],
								"remarks" => $_POST['remarks'],
								"cat_routing" => $_POST['cat_routing'],
							);
		$insert_id = $this->elog_model->insertAgl($new_array);
		if(!empty($insert_id) && ( $insert_id != 0 )){
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"AIRFIELD GROUND LIGHTING (AGL) INSPECTION",
								"log_table"=> 	"agl",
								"log_id"	 => 	$insert_id,
								"datetime" =>		$date1,
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
		$this->load->view("header_mat",array("page"=>"Runway Manoeuvring Area Inspection"));
		$this->load->view("RunwayManoeuvringArea",$viewData);
		$this->load->view("footer_mat");
	}	

	public function insertdetails(){	 
		$id = $_POST["id"];
		$res = $this->elog_model->insertdetails($id,$_POST);	 	
		if($res){redirect("elog/mainview/success");
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
	}			
	
	public function insertRunwayManoeuvringArea(){
		$viewData = array();
		$date1 = (date('Y-m-d',strtotime($_POST['date'])) .' '. $_POST['time'] ? date('Y-m-d',strtotime($_POST['date'])) .' '. $_POST['time'] : date('Y-m-d H:i:s'));
		$new_array = array(
								"initial" => $_POST['initial'],
								"datetime" => $date1,
								"subject"	 => $_POST['subject'],
								"remarks" => $_POST['remarks'],
								"inspected_rwy_area" => $_POST['inspected_rwy_area'],
								"inspection_completed_time" => $_POST['inspection_completed_time'],
								"dailysafety_completed_time" => $_POST['dailysafety_completed_time'],
								"rwy_acceptable_foruse" => $_POST['rwy_acceptable_foruse'],
								"area_acceptable_foruse" => $_POST['area_acceptable_foruse'],
							);

		$insert_id = $this->elog_model->insertRunwayManoeuvringArea($new_array);
		if(!empty($insert_id) && ( $insert_id != 0 )){
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"Runway Manoeuvring Area Inspection",
								"log_table"=> 	"rwy_area_inspection",
								"log_id"	 => 	$insert_id,
								"datetime" =>		$date1,
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
		    $this->db->where("id",$log_id);
		    $this->db->update("generalentry",$_POST);
			$this->db->where(array("log_id"=>$log_id,"log_table"=>"generalentry"));
			$this->db->update("form_logs",array("datetime"=>$_POST["datetime"]));
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated General Entry log.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$log_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		
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

	public function enterdetails(){		
		$rec = $this->elog_model->getFaultReporting($_POST["id"]);
		$viewData["log"] = $rec[0];		
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();		
		$this->load->view("enterdetails",$viewData);	
	}		

	public function openclosedetails(){			
		$rec = $this->elog_model->getclosedetails($_POST);				
		$viewData["log"] = $rec[0];			
		$this->load->view("closedetails",$viewData);
	}		

	public function acceptJobClose(){						 
		$datas = array(		          
			"id" 			  => 	$_POST['id'],				 
			"action_perfomed" => 	5 , 				  
			"Remarks" 		  => 	"This Fault Is Closed",				 
			"frn" 	 		  => 	"This Fault Is Closed",				  
			"frnstatus" 	  => 	7,				  
			); 
		$response =$this->elog_model->actionperfomed($datas);
		$apptance_data = array(								
			"id"			  => 	"",								
			"accepted_by"	  => 	$this->userdetails["agentcode"],
			"readed"		  => 	0,	
			"fault_rep"	      => 	$_POST['id'],
			"date" 			  =>	date("Y-m-d H:i:s"),
			"notiat" 		  =>	$_POST['engcode'],								
			"error_text" 	  =>	"Job closed ",								
			"status" 	      => 	"Job Closed ",															
		);							
		$aceptedit = $this->elog_model->acepteddata($apptance_data);		
		print("updated");				
	}							

	public function cancelJobClose(){
		$apptance_data = array(								
			"id"			 => 	"",								
			"accepted_by"    => 	$this->userdetails["agentcode"],								
			"readed"         => 	0,								
			"fault_rep"	     =>     $_POST['id'],								
			"date"           =>		date("Y-m-d H:i:s"),								
			"notiat"         =>		$_POST['engcode'],								
			"error_text"     =>		"Job closed Canceled ",								
			"status"         =>     "Job Closed Canceled  ",															
		);							
		$aceptedit = $this->elog_model->acepteddata($apptance_data);		
		print("updated");				
	}								
	
	
	public function updateFaultReporting(){
		
		$log_id = $_GET["log_id"];
		if($this->elog_model->updateFaultReporting($log_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"		=>	"Updated ".$_POST["subject"]." log.",
							"log_datetime"  => 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$log_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		}else{
			print("error");
		}
		
	}
	
	
		public function insertNewjob(){

		$log_id = $_GET["log_id"];
		
		if($this->elog_model->insertNewjob($log_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Inserted New Job  ".$_POST["subject"]." log.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$log_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("inserted New Job");
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
	public function metcondition_edit(){
	
		$rec = $this->elog_model->getMetCondition($_POST["id"]);
		$viewData["log"] = $rec[0];
		$this->load->view("metcondition_edit",$viewData);
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
	public function updateMetCondition(){
		
		$log_id = $_GET["log_id"];
		
		if($this->elog_model->updateMetCondition($log_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated Met Condition.",
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
		$this->load->view("header_mat",array("page"=>"No Show"));
		$this->load->view("lvp/NoShow",$viewData);
		$this->load->view("footer_mat");
	}
	public function LateForDuty(){
		$viewData = array();
		$viewData["allusers"] = $this->user_model->getUnitUsers();
		$viewData["absenceReasons"] = $this->elog_model->getAllStaffAbsenceReasons();
		$this->load->view("header_mat",array("page"=>"Late For Duty"));
		$this->load->view("lvp/LateForDuty",$viewData);
		$this->load->view("footer_mat");
	}
	public function SentHome(){
		$viewData = array();
		$viewData["allusers"] = $this->user_model->getUnitUsers();
		$viewData["shiftnames"] = $this->elog_model->getAllShifts();
		$viewData["absenceReasons"] = $this->elog_model->getAllStaffAbsenceReasons();
		$this->load->view("header_mat",array("page"=>"Sent Home"));
		$this->load->view("lvp/SentHome",$viewData);
		$this->load->view("footer_mat");
	}
	public function UnavailableForDuty(){
		$viewData = array();
		$viewData["allusers"] = $this->user_model->getUnitUsers();
		$viewData["shiftnames"] = $this->elog_model->getAllShifts();
		$viewData["absenceReasons"] = $this->elog_model->getAllStaffAbsenceReasons();
		$this->load->view("header_mat",array("page"=>"Unavailable For Duty"));
		$this->load->view("lvp/UnavailableForDuty",$viewData);
		$this->load->view("footer_mat");
	}
	public function SicknessForDuty(){
		$viewData = array();
		$viewData["allusers"] = $this->user_model->getUnitUsers();
		$viewData["shiftnames"] = $this->elog_model->getAllShifts();
		$viewData["absenceReasons"] = $this->elog_model->getAllStaffAbsenceReasons();
		$this->load->view("header_mat",array("page"=>"Sickness For Duty"));
		$this->load->view("lvp/SicknessForDuty",$viewData);
		$this->load->view("footer_mat");
	}
	public function FitnessOrReturnForDuty(){
		$viewData = array();
		$viewData["allusers"] = $this->user_model->getUnitUsers();
		$viewData["shiftnames"] = $this->elog_model->getAllShifts();
		$viewData["absenceReasons"] = $this->elog_model->getAllStaffAbsenceReasons();
		$this->load->view("header_mat",array("page"=>"Fitness Or Return For Duty"));
		$this->load->view("lvp/FitnessOrReturnForDuty",$viewData);
		$this->load->view("footer_mat");
	}

	public function insertlvp(){
		
		$viewData = array();
		$date1 = (date('Y-m-d',strtotime($_POST['date'])) .' '. $_POST['time'] ? date('Y-m-d',strtotime($_POST['date'])) .' '. $_POST['time'] : date('Y-m-d H:i:s'));
		$new_array = array(
								"initial" => $_POST['initial'],
								"datetime" => $date1,
								"subject"	 => $_POST['subject'],
								"name" => $_POST['name'],
								"shift_duty" => $_POST['shift_duty'],
								"shift_duty2" => $_POST['shift_duty2'],
								"call_out_required" => $_POST['call_out_required'],
								"name2" => $_POST['name2'],
								"late_due_to" => $_POST['late_due_to'],
								"staff_instructed" => $_POST['staff_instructed'],
								"until_time" => $_POST['until_time'],
								"remarks" => $_POST['remarks'],
								"sent_home_time" => $_POST['sent_home_time'],
								"due_to" => $_POST['due_to'],
								"day_of_unavailibility" => $_POST['day_of_unavailibility'],
								"absence_reason_details" => $_POST['absence_reason_details'],
								"call_time" => $_POST['call_time'],
								"date_of_sickness" => $_POST['date_of_sickness'],
								"date_of_duty" => $_POST['date_of_duty'],
							);
		$insert_id = $this->elog_model->insertlvp($new_array);
		if(!empty($insert_id) && ( $insert_id != 0 )){
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	$_POST["subject"],
								"log_table"=> 	"lvp",
								"log_id"	 => 	$insert_id,
								"datetime" =>		$date1,
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
	public function newjob(){
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
		$this->load->view("header",array("page"=>"New Job"));
		$this->load->view("newjob",$data);
		$this->load->view("footer");
	}
	
	
	public function newjob_edit(){
		$rec = $this->elog_model->getNewjob($_POST["id"]);
		$viewData["log"] = $rec[0];
			$viewData["department"] = $this->emergency_model->getAlldep();
		
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$this->load->view("newjob_edit",$viewData);
	}
	
	public function CreateNewJob(){
		$viewData = array();
		$viewData["countries"] = $this->elog_model->getAllCountries();
		$viewData["allusers"] = $this->user_model->getAllUsers();
		$viewData["equipments"] = $this->elog_model->getAllEquipments();
		$viewData["positions"] = $this->elog_model->getAllPositions();
		$viewData["consoleNumbers"] = $this->elog_model->getAllConsoleNumbers();
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$viewData["allUsers"] = $this->user_model->getUnitUsers();
		$this->load->view("header",array("page"=>"Fault Reporting"));
		$this->load->view("faultreport/createjob",$viewData);
		$this->load->view("footer");
	}
	
	
	
		
	public function insertNewJobx(){
		$viewData = array();
		$insert_id = $this->elog_model->insertNewJobx($_POST);
		if(!empty($insert_id) && ( $insert_id != 0 )){
	
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"Insert New Job",
								"log_table"=> 	"New_job",
								"log_id"	 => 	$insert_id,
								"datetime" =>		date("Y-m-d H:i:s"),
							);
			$log_insert_id = $this->elog_model->insertformlog($log_data);
			if(!empty($log_insert_id) && ( $log_insert_id != 0 )){
				$message = "";
				if($_POST["subject"] == "Equipment Release"){
					$message = "Inserted New Job.";
				}else if($_POST["subject"] == "Fault Reporting"){
					$message = "Inserted New Job.";
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
	
	
	public function InitiateLVO(){
		$viewData = array();
		$viewData["countries"] = $this->elog_model->getAllCountries();
		$viewData["allusers"] = $this->user_model->getAllUsers();
		$viewData["equipments"] = $this->elog_model->getAllEquipments();
		$viewData["positions"] = $this->elog_model->getAllPositions();
		$viewData["consoleNumbers"] = $this->elog_model->getAllConsoleNumbers();
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$viewData["allUsers"] = $this->user_model->getUnitUsers();
		$this->load->view("header_mat",array("page"=>"InitiateLVO"));
		$this->load->view("lvo/initiatelvo",$viewData);
		$this->load->view("footer_mat");
	}
	
	
	/*************************inserting lvo *****************************************/
	
	public function insertlvo(){
		$viewData = array();
		$date1 = (date('Y-m-d',strtotime($_POST['date'])) .' '. $_POST['time'] ? date('Y-m-d',strtotime($_POST['date'])) .' '. $_POST['time'] : date('Y-m-d H:i:s'));
		$new_array = array(
								"initial" => $_POST['initial'],
								"datetime" => $date1,
								"subject"	 => $_POST['subject'],
								"intial" => $_POST['intial'],
								"form_datetime" => $_POST['form_datetime'],
								"onbehalf" => $_POST['onbehalf'],
								"Operate_AGL_Panel" => $_POST['Operate_AGL_Panel'],
								"Request_Weather_Standby" => $_POST['Request_Weather_Standby'],
								"Update_ATIS" => $_POST['Update_ATIS'],
							);
		//echo "<pre>"; print_r($new_array); die('h2');
		$insert_id = $this->elog_model->insertlvo($new_array);
		if(!empty($insert_id) && ( $insert_id != 0 )){
		
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"Initiate LVO",
								"log_table"=> 	"initiate_lvo",
								"log_id"	 => 	$insert_id,
								"datetime" =>		$date1,
							);
			$log_insert_id = $this->elog_model->insertformlog($log_data);
			if(!empty($log_insert_id) && ( $log_insert_id != 0 )){
					$message = "Inserted InitiateLVO.";
					//redirect("elog/mainview/success");
				
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

	
	/************************inserting lvo end here *********************************/
	
	public function LVOSafeguarding(){
		$viewData = array();
		$viewData["countries"] = $this->elog_model->getAllCountries();
		$viewData["allusers"] = $this->user_model->getAllUsers();
		$viewData["equipments"] = $this->elog_model->getAllEquipments();
		$viewData["positions"] = $this->elog_model->getAllPositions();
		$viewData["consoleNumbers"] = $this->elog_model->getAllConsoleNumbers();
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$viewData["allUsers"] = $this->user_model->getUnitUsers();
		$this->load->view("header_mat",array("page"=>"LVOSafeguarding"));
		$this->load->view("lvo/safeguardlvo",$viewData);
		$this->load->view("footer_mat");
	}
	
	public function insertcalibrationitem(){
		$viewData = array();
		$insert_id = $this->elog_model->insertcalibrationitem($_POST);
		if(!empty($insert_id) && ( $insert_id != 0 )){
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"Inserting latest parameter domain Calibration Item ",
								"log_table"=> 	"latest_calibrationitem",
								"log_id"	 => 	$insert_id,
								"datetime" =>		$_POST["datetime"],
							);
			$log_insert_id = $this->elog_model->insertformlog($log_data);
			if(!empty($log_insert_id) && ( $log_insert_id != 0 )){
				$acceslog_data = array(
								"agentcode"		=>	$this->userdetails["agentcode"],
								"message"		=>	"inserted latest  domain Para Calibration Item ",
								"log_datetime"	=> 	date("Y-m-d H:i:s"),
								"form_log_id"	=>	$log_insert_id
							);
				$this->base_model->insertAccessLog($acceslog_data);
				$this->base_model->insertKeywords($_POST);
				redirect("/domainparameters/Viewparacalibrationitem");
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
	
	
		/*************************insertsafeguardinglvo lvo *****************************************/
	
	public function insertsafeguardinglvo(){
		$viewData = array();
		$date1 = (date('Y-m-d',strtotime($_POST['date'])) .' '. $_POST['time'] ? date('Y-m-d',strtotime($_POST['date'])) .' '. $_POST['time'] : date('Y-m-d H:i:s'));
		$insert_id = $this->elog_model->insertsafeguardinglvo($_POST);
		if(!empty($insert_id) && ( $insert_id != 0 )){
		
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"Safe Guarding Lvo",
								"log_table"=> 	"lvo_safeguarding",
								"log_id"	 => 	$insert_id,
								"datetime" =>		$date1,
							);
			$log_insert_id = $this->elog_model->insertformlog($log_data);
			if(!empty($log_insert_id) && ( $log_insert_id != 0 )){
					$message = "Inserted lvo_safeguarding.";
				
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

	
	/************************insertsafeguardinglvo lvo end here *********************************/
	
		/*************************insertsafeguardinglvo_edit*****************************************/
	
	
	public function insertsafeguardinglvo_edit(){
		$rec = $this->elog_model->getinsertsafeguardinglvo($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$this->load->view("insertsafeguardinglvo_edit",$viewData);
	}
	
	/************************insertsafeguardinglvo_edit end here *********************************/
	
	public function canceledlvo(){
		$rec = $this->elog_model->canceledlvo($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$this->load->view("cancellvoss",$viewData);
	}
	
			/*************************insertsafeguardinglvo_edit*****************************************/
	
	
	public function initiatelvo_edit(){
		$rec = $this->elog_model->getinitiatelvo_edit($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$this->load->view("initiate_lvo",$viewData);
	}
	
	/************************insertsafeguardinglvo_edit end here *********************************/
	
	
			/*************************deletesafeLVO*****************************************/
	
	
	public function deletesafeLVO(){
		if($this->elog_model->deletesafeLVO($_POST["id"])){
			print("deleted");
		}else{
			print("error");
		}
	}
	
	/************************deletesafeLVO end here *********************************/
	
	
	
	public function cancelofinitiate(){
		$rec = $this->elog_model->getinitiatelvo_edit($_POST["id"]);

			
		$viewData["log"] = $rec[0];
		$viewData["PostId"] = $_POST["id"];
		$viewData["countries"] = $this->elog_model->getAllCountries();
		$viewData["allusers"] = $this->user_model->getAllUsers();
		$viewData["equipments"] = $this->elog_model->getAllEquipments();
		$viewData["positions"] = $this->elog_model->getAllPositions();
		$viewData["consoleNumbers"] = $this->elog_model->getAllConsoleNumbers();
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$viewData["allUsers"] = $this->user_model->getUnitUsers();

		$this->load->view("cancelation-of-lvo",$viewData);
	}
	
	
	public function cancellvo(){
		$date1 = (date('Y-m-d',strtotime($_POST['date'])) .' '. $_POST['time'] ? date('Y-m-d',strtotime($_POST['date'])) .' '. $_POST['time'] : date('Y-m-d H:i:s'));
		
		$insert_id= $this->elog_model->cancellvo($_POST);
			
				$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"Canceled Lvo ",
								"log_table"=> 	"cancel_lvo",
								"log_id"	 => 	$insert_id,
								"datetime" =>		$date1,
							);
			$log_insert_id = $this->elog_model->insertformlog($log_data);
			print("updated");
	}	
	
	
	public function cancelsafeLVO(){
		
			$insert_id= $this->elog_model->cancel_lvo_safeguarding($_POST);
		
				
				$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"Canceled Lvo SafeGuarding",
								"log_table"=> 	"cancel_lvo_safeguarding",
								"log_id"	 => 	$insert_id,
								"datetime" =>		date("Y-m-d H:i:s"),
							);
			$log_insert_id = $this->elog_model->insertformlog($log_data);
		
		        redirect("elog/mainview");
		        $viewData["success_msg"] = "Added Successfully.";
				$this->load->view('header');
				$this->load->view("success_view",$viewData);
				$this->load->view("footer");
		
	}
	
	public function cancelationoflvosafe(){
		$viewData = array();
		$rec = $this->elog_model->getinsertsafeguardinglvo($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["PostId"] = $_POST["id"];
		$viewData["countries"] = $this->elog_model->getAllCountries();
		$viewData["allusers"] = $this->user_model->getAllUsers();
		$viewData["equipments"] = $this->elog_model->getAllEquipments();
		$viewData["positions"] = $this->elog_model->getAllPositions();
		$viewData["consoleNumbers"] = $this->elog_model->getAllConsoleNumbers();
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$viewData["allUsers"] = $this->user_model->getUnitUsers();
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$this->load->view("cancelationoflvosafe",$viewData);
	}
	
	
	public function canceledlvosafeguarding(){
		$rec = $this->elog_model->canceledlvosafeguarding($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$this->load->view("cancellvosafeguard",$viewData);
	}
	public function addevent(){
		$rec = $this->elog_model->getjobcard($_POST["id"]);
		$events = $this->elog_model->allevents($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["viewonly"] = $_POST["viewonly"];
		$viewData["addevents"]=$events;
		$viewData["equipments"] = $this->elog_model->getAllEquipments();
		$viewData["allUsers"] = $this->user_model->getUnitUsers();
		$this->load->view("addevent",$viewData);
	}
	public function closejob(){		$rec = $this->elog_model->getjobcard($_POST["id"]);		$viewData["log"] = $rec[0];		$this->load->view("closejob",$viewData);	}			public function faultrepclose(){		$rec = $this->elog_model->getjobcard($_POST["id"]);		$repnum = $rec[0]['faultreportnum'];		$reportnum = $this->elog_model->getFaultReporting($repnum );			foreach($reportnum  as $reportnums){			$iniat =  	$reportnums['initial'];			$errorText =  	$reportnums['error_text'];		}							$apptance_data = array(								"id"			 => 	"",								"accepted_by" => 	$this->userdetails["agentcode"],								"readed"=> 	0,								"fault_rep"	 => $repnum,								"date" =>		date("Y-m-d H:i:s"),								"notiat" =>		$iniat,								"error_text" =>		$_POST["Remarks"],								"status" => "Job Close Request",							);														$_POST['id']= "";														$closedetails = $this->elog_model->faultrepclose($_POST);																			$aceptedit = $this->elog_model->acepteddata($apptance_data);														if($aceptedit){					redirect("elog/mainview/faultreports/success");				}else{					redirect("index/listingpanel/success");				}			}													
	
	public function addeventdetails(){
		
		$events = $this->elog_model->gettheevents($_POST["id"]);
		$val = $events[0]['jobcard'];
		
	
		$rec = $this->elog_model->getjobcard($val);
	
		$viewData["log"] = $rec[0];
		$viewData["addevents"]=$events;

		$this->load->view("addeventdetails",$viewData);
	}
	
	
	public function addevents(){
		$viewData = array();
		$viewData["allusers"] = $this->user_model->getUnitUsers();		$viewData["jobcardno"] = $this->elog_model->getjobcard($_POST["id"]);
		$viewData["subjects"] = $this->elog_model->getAllSubjects();
		$this->load->view("header",array("page"=>"Addevent"));
		$this->load->view("addeventss",$viewData);
		$this->load->view("footer");
	}
		

	public function insertevents(){
		$viewData = array();
		$insert_id = $this->elog_model->insertevents($_POST);
		if(!empty($insert_id) && ( $insert_id != 0 )){
			
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"Add Events",
								"log_table"=> 	"addevent",
								"log_id"	 => 	$insert_id,
								"datetime" =>		date("Y-m-d H:i:s"),
							);
			$log_insert_id = $this->elog_model->insertformlog($log_data);
		
				$acceslog_data = array(
								"agentcode"		=>	$this->userdetails["agentcode"],
								"message"		=>	"New Event Added",
								"log_datetime"	=> 	date("Y-m-d H:i:s"),
								"form_log_id"	=>	$log_insert_id
							);
				$this->base_model->insertAccessLog($acceslog_data);
				$this->base_model->insertKeywords($_POST);
				if( ($this->userdetails["role"] == "engineer" ) || ($this->userdetails["role"] == "normal" ) ){
					redirect("elog/mainview/faultreports/success");
				}else{
					redirect("index/listingpanel/success");
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
		}
		
		
		
	public function canceljob(){
		$viewData = array();
		$datas = array(
		          "id" =>$_POST['Job_Code'],
				  "action_perfomed" => 1 , 
				  "Remarks" =>$_POST['Remarks'],
				  "frn" =>"Fault Canceled",				  "frnstatus" =>9,
				  );
	$insert_id = $this->elog_model->canceljob($_POST);
	if(isset($_POST['Job_Code'])){
		$repnum = $_POST['Job_Code'];	
		$reportnum = $this->elog_model->getFaultReporting($repnum );
			foreach($reportnum  as $reportnums){
			$iniat =  	$reportnums['initial'];
			$errorText =  	$reportnums['error_text'];
		}
			
				$apptance_data = array(
								"id"			 => 	"",
								"accepted_by" => 	$this->userdetails["agentcode"],
								"readed"=> 	0,
								"fault_rep"	 => $repnum,
								"date" =>		date("Y-m-d H:i:s"),
								"notiat" =>		$iniat,
								"error_text" =>		$errorText,
								"status" => "Job Canceled",								
							);
							$aceptedit = $this->elog_model->acepteddata($apptance_data);	
				}
		$response =$this->elog_model->actionperfomed($datas);
		
		if(!empty($insert_id) && ( $insert_id != 0 )){
			
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"Faults Canceled ",
								"log_table"=> 	"cancel_jobs",
								"log_id"	 => 	$insert_id,
								"datetime" =>		date("Y-m-d H:i:s"),
							);
			$log_insert_id = $this->elog_model->insertformlog($log_data);
		
				$acceslog_data = array(
								"agentcode"		=>	$this->userdetails["agentcode"],
								"message"		=>	"Canceled Fault",
								"log_datetime"	=> 	date("Y-m-d H:i:s"),
								"form_log_id"	=>	$log_insert_id
							);
				$this->base_model->insertAccessLog($acceslog_data);
				$this->base_model->insertKeywords($_POST);
				if( ($this->userdetails["role"] == "engineer" ) || ($this->userdetails["role"] == "normal" ) ){
						redirect("index/listingpanel/success");
				}else{
					redirect("index/listingpanel/success");
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
		}
		
	public function transferd(){
		$viewData = array();
		$othersection = $this->elog_model->getothersection($_POST['initials_code']);
		
			$datas = array(
		          "id" =>$_POST['Job_Code'],
				  "action_perfomed" => 4 , 
				  "Remarks" =>"Fault Transfered to ".$othersection[0]['name']." Department, &#13;&#10; ".$_POST['Remarks'],
				  "frn" =>"Fault Transfered to ".$othersection[0]['name'],				  "frnstatus" =>8,
				  );
		
				  
		if(isset($_POST['Job_Code'])){
		$repnum = $_POST['Job_Code'];	
		$reportnum = $this->elog_model->getFaultReporting($repnum );
			foreach($reportnum  as $reportnums){
			$iniat =  	$reportnums['initial'];
			$errorText =  	$reportnums['error_text'];
		}
			
				$apptance_data = array(
								"id"			 => 	"",
								"accepted_by" => 	$this->userdetails["agentcode"],
								"readed"=> 	0,
								"fault_rep"	 => $repnum,
								"date" =>		date("Y-m-d H:i:s"),
								"notiat" =>		$iniat,
								"error_text" =>		$errorText,
								"status" => "Fault Transfered",								
							);
							$aceptedit = $this->elog_model->acepteddata($apptance_data);	
				}
				
		$insert_id = $this->elog_model->transferd($_POST);
		$response =$this->elog_model->actionperfomed($datas);
		
		if(!empty($insert_id) && ( $insert_id != 0 )){
			
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"Faults Transfered",
								"log_table"=> 	"transfered_jobs",
								"log_id"	 => 	$insert_id,
								"datetime" =>		date("Y-m-d H:i:s"),
							);
			$log_insert_id = $this->elog_model->insertformlog($log_data);
		
				$acceslog_data = array(
								"agentcode"		=>	$this->userdetails["agentcode"],
								"message"		=>	"Fault Tranfered",
								"log_datetime"	=> 	date("Y-m-d H:i:s"),
								"form_log_id"	=>	$log_insert_id
							);
				$this->base_model->insertAccessLog($acceslog_data);
				$this->base_model->insertKeywords($_POST);
				if( ($this->userdetails["role"] == "engineer" ) || ($this->userdetails["role"] == "normal" ) ){
						redirect("elog/mmainview/faultreports");
				}else{
					redirect("elog/mainview/faultreports");
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
		}
		
		
	public function insertjob(){
		
				if(isset($_POST['faultreportnum'])){
					
					
		 	$repnum = $_POST['faultreportnum'];
		

			$reportnum = $this->elog_model->getFaultReporting($repnum );
					$datas = array(
		          "id" =>$repnum,
				  "action_perfomed" => 2 , 
				  "Remarks" =>"",			"frn" =>$_POST['jobcard'],				  "faultNum" => $_POST['jobcard'],				  "frnstatus" =>11,
				  );
			
			$response =$this->elog_model->actionperfomed($datas);
		foreach($reportnum  as $reportnums){
			
		$iniat =  	$reportnums['initial'];
		$errorText =  	$reportnums['error_text'];
		
		}
			
				$apptance_data = array(
								"id"			 => 	"",
								"accepted_by" => 	$this->userdetails["agentcode"],
								"readed"=> 	0,
								"fault_rep"	 => $repnum,
								"date" =>		date("Y-m-d H:i:s"),
								"notiat" =>		$iniat,
								"error_text" =>		$errorText,
								"status" => "Job Accepted",
							);
							
					$aceptedit = $this->elog_model->acepteddata($apptance_data);	
				}
				
		$viewData = array();
		$insert_id = $this->elog_model->jobcard($_POST);
		if(!empty($insert_id) && ( $insert_id != 0 )){
			
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"New Job Inserted",
								"log_table"=> 	"JobCard",
								"log_id"	 => 	$insert_id,
								"datetime" =>		date("Y-m-d H:i:s"),
							);
			$log_insert_id = $this->elog_model->insertformlog($log_data);
		
				$acceslog_data = array(
								"agentcode"		=>	$this->userdetails["agentcode"],
								"message"		=>	"NewJobCard",
								"log_datetime"	=> 	date("Y-m-d H:i:s"),
								"form_log_id"	=>	$log_insert_id
							);
				$this->base_model->insertAccessLog($acceslog_data);
				$this->base_model->insertKeywords($_POST);
				if( ($this->userdetails["role"] == "engineer" ) || ($this->userdetails["role"] == "normal" ) ){
						redirect("index/listingpanel/success");
				}else{
					redirect("index/listingpanel/success");
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
		}
		
		
	public function insertothersection(){
		$viewData = array();
		$insert_id = $this->elog_model->insertothersection($_POST);
		
		if(!empty($insert_id) && ( $insert_id != 0 )){
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"Inserting other Section",
								"log_table"=> 	"other_section",
								"log_id"	 => 	$insert_id,
								"datetime" =>		$_POST["datetime"],
							);
			$log_insert_id = $this->elog_model->insertformlog($log_data);
			
			if(!empty($log_insert_id) && ( $log_insert_id != 0 )){
				$acceslog_data = array(
								"agentcode"		=>	$this->userdetails["agentcode"],
								"message"		=>	"Inserted Domain Parameter other section",
								"log_datetime"	=> 	date("Y-m-d H:i:s"),
								"form_log_id"	=>	$log_insert_id
							);
				$this->base_model->insertAccessLog($acceslog_data);
				$this->base_model->insertKeywords($_POST);
				redirect("domainparameters/viewothersection");
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
		
	public function insertparajob(){
		$viewData = array();
		$insert_id = $this->elog_model->insertparajob($_POST);
		
		if(!empty($insert_id) && ( $insert_id != 0 )){
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"Inserting latest parameter domain Jobs",
								"log_table"=> 	"latest_parajob",
								"log_id"	 => 	$insert_id,
								"datetime" =>		$_POST["datetime"],
							);
			$log_insert_id = $this->elog_model->insertformlog($log_data);
			
			if(!empty($log_insert_id) && ( $log_insert_id != 0 )){
				$acceslog_data = array(
								"agentcode"		=>	$this->userdetails["agentcode"],
								"message"		=>	"Inserting latest parameter domain Jobs",
								"log_datetime"	=> 	date("Y-m-d H:i:s"),
								"form_log_id"	=>	$log_insert_id
							);
				$this->base_model->insertAccessLog($acceslog_data);
				$this->base_model->insertKeywords($_POST);
				redirect("domainparameters/ViewparaJob");
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
		
	public function insertparacustomer(){
	
		$viewData = array();
		$insert_id = $this->elog_model->insertparacustomer($_POST);
		if(!empty($insert_id) && ( $insert_id != 0 )){
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"Latest Insert Customer ",
								"log_table"=> 	"latest_customer",
								"log_id"	 => 	$insert_id,
								"datetime" =>		$_POST["datetime"],
							);
			$log_insert_id = $this->elog_model->insertformlog($log_data);
			if(!empty($log_insert_id) && ( $log_insert_id != 0 )){
				$acceslog_data = array(
								"agentcode"		=>	$this->userdetails["agentcode"],
								"message"		=>	"Inserted Lastest domain parameter customer",
								"log_datetime"	=> 	date("Y-m-d H:i:s"),
								"form_log_id"	=>	$log_insert_id
							);
				$this->base_model->insertAccessLog($acceslog_data);
				$this->base_model->insertKeywords($_POST);
				redirect("instructions/viewCustomer");
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

    public function allnotification(){
		
		
		$this->load->view("header_mat");
		$this->load->view("all_notification");
		$this->load->view("footer_mat");

		
	}
	
	
	public function insertlru(){
		$viewData = array();
		$insert_id = $this->elog_model->insertlru($_POST);
		if(!empty($insert_id) && ( $insert_id != 0 )){
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"Inserting latest parameter domain LRU ",
								"log_table"=> 	"latest_LRU",
								"log_id"	 => 	$insert_id,
								"datetime" =>		$_POST["datetime"],
							);
			$log_insert_id = $this->elog_model->insertformlog($log_data);
			if(!empty($log_insert_id) && ( $log_insert_id != 0 )){
				$acceslog_data = array(
								"agentcode"		=>	$this->userdetails["agentcode"],
								"message"		=>	"inserted latest domain parameter  LRU  ",
								"log_datetime"	=> 	date("Y-m-d H:i:s"),
								"form_log_id"	=>	$log_insert_id
							);
				$this->base_model->insertAccessLog($acceslog_data);
				$this->base_model->insertKeywords($_POST);
				redirect("domainparameters/ViewparaLRU");
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
	
	public function insertfrequency(){
		$viewData = array();
		$insert_id = $this->elog_model->insertfrequency($_POST);
		if(!empty($insert_id) && ( $insert_id != 0 )){
			$log_data = array(
								"id"			 => 	"",
								"log_type" => 	"Inserting Lastest parameter domain Frequency ",
								"log_table"=> 	"latest_Frequency",
								"log_id"	 => 	$insert_id,
								"datetime" =>		$_POST["datetime"],
							);
			$log_insert_id = $this->elog_model->insertformlog($log_data);
			if(!empty($log_insert_id) && ( $log_insert_id != 0 )){
				$acceslog_data = array(
								"agentcode"		=>	$this->userdetails["agentcode"],
								"message"		=>	"inserted Lastest domain parameter  Frequency  ",
								"log_datetime"	=> 	date("Y-m-d H:i:s"),
								"form_log_id"	=>	$log_insert_id
							);
				$this->base_model->insertAccessLog($acceslog_data);
				$this->base_model->insertKeywords($_POST);
				redirect("domainparameters/Viewparafrequency");
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
}

