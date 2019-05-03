<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("emergency_model");
		$this->load->model("base_model");
		$this->load->model("report_model");
		$this->load->model("elog_model");
		$this->load->model("user_model");
		$this->load->library("session");
		$this->load->model("instructions_model");	
		$this->load->library("tcpdf");
		$this->userdetails = $this->session->userdata("userdetails");
		if(empty($this->userdetails)){
			redirect(base_url());
		}
		$this->load->model("user_model");
		if(!empty($this->userdetails)){
			$this->userdetails["permissions"] = $this->user_model->getUserPermissions($this->userdetails["role_id"]);
		}
	}
	
	public function deleteDailyReportRow(){
		$deleted_rows = $this->session->userdata("dailyreport_deleted_rows");
		$deleted_rows[$_POST["type"]][$_POST["log_id"]] = array();
		$this->session->set_userdata(array("dailyreport_deleted_rows"=>$deleted_rows));		
		if(array_key_exists($_POST["log_id"],$deleted_rows[$_POST["type"]])){
			print("deleted");
		}else{
			print("Some error occurred please try again later.");
		}
	}
	
	public function DailyReport(){
		$viewData = array();
		$viewData["units"] = $this->report_model->getAllUnits();
		$this->load->view("header_mat",array("page"=>"Daily Report"));
		$this->load->view("report/daily_report",$viewData);
		$this->load->view("footer_mat");
	}
	public function generateDailyReport(){
		
		$this->session->set_userdata(
	    array(
			"dailyreport_deleted_rows"=>array(
			"general" => array(),
			"supervisor" => array(),
			"management" => array(),
		   "fault" => array()
								 ))
								);
		$this->session->set_userdata(array("DailyReport"=>$_POST));
		$data = array();
		$data["from"] = $_POST["from"];
		$data["to"] = $_POST["to"];
		$data["unit_id"] = $_POST["unit_id"];
		$data["form_logs"] = $this->report_model->getFormLogs($_POST);
		$data["faultReportingLogs"] = $this->report_model->getFaultReportingLogs($_POST);
		$data["supervisor_reports"] = $this->report_model->getSupervisorLogs($_POST);
		$data["management_reports"] = $this->report_model->getManagementLogs($_POST);
		$data["units"] = $this->report_model->getAllUnits();
		$this->load->view("header_mat",array("page"=>"Daily Report"));
		$this->load->view("report/generateDailyReport",$data);
		$this->load->view("footer_mat");
	}
	public function SupervisorReport(){
		$data = array();
		$data["subjects"] = $this->elog_model->getAllActiveSubjects();
		$data["allusers"] = $this->user_model->getAllUsers();
		$data["units"] = $this->report_model->getAllUnits();
		$this->load->view("header_mat",array("page"=>"Supervisor Report"));
		$this->load->view("report/SupervisorReport",$data);
		$this->load->view("footer_mat");
	}
	public function Faultupdate(){
		$data = array();
		$data["subjects"] = $this->elog_model->getAllActiveSubjects();
		$data["allusers"] = $this->user_model->getAllUsers();
		$data["units"] = $this->report_model->getAllUnits();
		$this->load->view("header_mat",array("page"=>"FAUlT UPDATE"));
		$this->load->view("yes/index",$data);
		$this->load->view("footer_mat");
	}
	
	public function table(){
	    $query = $this->db->query('SELECT * 
		FROM fault_reporting
		ORDER BY id DESC');   
		   echo 
		   '<div class="report-container">
				<div class="fault-report">
					<div class="report-heading">Fault Report</div>
						<ul class="fr-list">
							<li class="fr-head">
								<span class="fr-initial">Initial</span>
								<span class="fr-time">Time</span>
								<span class="fr-position">Position</span>
								<span class="fr-console">Console</span>
								<span class="fr-equipment">System Equipment</span>
								<span class="fr-error-msg">Error Message</span>
								<span class="fr-action col-action">More Details</span>
							</li>
						</ul>
				</div>
			</div>';

		foreach ($query->result() as $row){
			echo '<li class="fr-row" style=" width: 100%; "> ';
			echo '<span class="fr-initial"style=" width: 7%; margin-right:7%;">'.$row->initial.'</span>';
			echo '<span class="fr-time" style=" width: 10%; margin-right:5%;">'.$row->form_datetime.'</span>';
			echo '<span class="fr-position" style=" width: 10%; margin-right:10%;">'.$row->position_name.'</span>';
			echo '<span class="fr-console" style=" width: 10%; margin-right:12%;">'.$row->console_number.'</span>';
			echo '<span class="fr-equipment" style=" width: 10%; margin-right:14%;">'.$row->system_equipment.'</span>';
			echo '<span class="fr-error-msg" style=" width: 10%; " > '.$row->error_text.'</span>';
			echo '<div class="fr-error-msg" style="  width: 10%;  height:60px;margin-left:90%; overflow: scroll;">'.$row->any_other_details.'</div>';
			echo "</li>";

		}

		$this->session->set_userdata('user_input',$query->num_rows());
		$userinput = $this->session->userdata('user_input');
		$query = $this->db->get('news');  
		foreach ($query->result() as $row){
		    $count =  $row->counting;
		}
		if($count < $userinput){
  			$url =base_url() . "pew.mp3";
			echo "A new entry have been submited";
			echo "<audio controls autoplay='autoplay'>
	  				 <source src='$url' type='audio/mpeg'>
	 				 <source src='$url' type='audio/mpeg'>
					 Your browser does not support the audio element.
				  </audio>";

			$data = array(
	               			'counting' => $userinput,
	            		 );

			$this->db->where('id', 1);
			$this->db->update('news', $data); 
	
		}
  	}

	public function tables(){
		$query = $this->db->query('SELECT * 
		FROM fault_reporting
		ORDER BY id DESC');
		$querys = $this->db->query('SELECT * 
		FROM fault_reporting
		ORDER BY id DESC  LIMIT 5');
		foreach ($querys->result() as $row)
		{
			$fault = "'Fault Reporting'";
		echo '<li onclick="faultreporting('.$row->id.',this,'.$fault.',false)"><span class="inst-list-title">'.$row->error_text.'</span>
			</li>';
		}
		$this->session->set_userdata('user_input',$query->num_rows());
		$userinput = $this->session->userdata('user_input');
		$query = $this->db->get('news');  
		foreach ($query->result() as $row)
		{
			$count =  $row->counting;
		}
		if($count < $userinput){
			$url =base_url() . "pew.mp3";
			echo "A new entry have been submited";
			echo "<audio controls autoplay='autoplay'>
				<source src='$url' type='audio/mpeg'>
				<source src='$url' type='audio/mpeg'>
				Your browser does not support the audio element.
				</audio>";
			$data = array(
										 'counting' => $userinput,
									);
			$this->db->where('id', 1);
			$this->db->update('news', $data); 
		}
    }
	public function add(){
		$this->load->view("header_mat",array("page"=>"FAUlT UPDATE"));
		$this->load->view("yes/add",$data);
		$this->load->view("footer_mat");
	}
	public function generateSupervisorReport(){
		$this->session->set_userdata(
																	array(
																		"dailyreport_deleted_rows"=>array(
																																				"general" => array(),
																																				"supervisor" => array(),
																																				"management" => array(),
																																				"fault" => array()
																																			)
																			)
																);
		$this->session->set_userdata(array("SupervisorReport"=>$_POST));
		$data = array();
		$data["units"] = $this->report_model->getAllUnits();
		$data["from"] = $_POST["from"];
		$data["to"] = $_POST["to"];
		$data["unit_id"] = $_POST["unit_id"];
		$data["subject"] = $_POST["subject"];
		$data["initial"] = $_POST["initial"];
		$data["onbehalf"] = $_POST["onbehalf"];
		$data["subjects"] = $this->elog_model->getAllActiveSubjects();
		$data["allusers"] = $this->user_model->getAllUsers();
		$data["supervisor_reports"] = $this->report_model->getSupervisorLogs($_POST);
		$this->load->view("header_mat",array("page"=>"Daily Report"));
		$this->load->view("report/generateSupervisorReport",$data);
		$this->load->view("footer_mat");
	}
	public function ManagementReport(){
		$data = array();
		$data["subjects"] = $this->elog_model->getAllActiveSubjects();
		$data["allusers"] = $this->user_model->getAllUsers();
		$data["units"] = $this->report_model->getAllUnits();
		$this->load->view("header_mat",array("page"=>"Management Report"));
		$this->load->view("report/ManagementReport",$data);
		$this->load->view("footer_mat");
	}
	public function generateManagementReport(){
		$this->session->set_userdata(
																	array(
																		"dailyreport_deleted_rows"=>array(
																																				"general" => array(),
																																				"supervisor" => array(),
																																				"management" => array(),
																																				"fault" => array()
																																			)
																			)
																);
		$this->session->set_userdata(array("ManagementReport"=>$_POST));
		$data = array();
		$data["from"] = $_POST["from"];
		$data["to"] = $_POST["to"];
		$data["unit_id"] = $_POST["unit_id"];
		$data["subject"] = $_POST["subject"];
		$data["initial"] = $_POST["initial"];
		$data["units"] = $this->report_model->getAllUnits();
		$data["onbehalf"] = $_POST["onbehalf"];
		$data["subjects"] = $this->elog_model->getAllActiveSubjects();
		$data["allusers"] = $this->user_model->getAllUsers();
		$data["management_reports"] = $this->report_model->getManagementLogs($_POST);
		$this->load->view("header_mat",array("page"=>"Daily Report"));
		$this->load->view("report/generateManagementReport",$data);
		$this->load->view("footer_mat");
	}
	public function GeneralReport(){
		$data = array();
		$data["subjects"] = $this->elog_model->getAllActiveSubjects();
		$data["allusers"] = $this->user_model->getAllUsers();
		$data["units"] = $this->report_model->getAllUnits();
		$this->load->view("header_mat",array("page"=>"General Report"));
		$this->load->view("report/GeneralReport",$data);
		$this->load->view("footer_mat");
	}
	
	public function InstructionsReport(){
		
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
																			"instructions_filter"=>array(
																					"from"=>date('Y-m-d',strtotime($_POST["from"])),
																					"to"=>date('Y-m-d',strtotime($_POST["to"])),
																					"agentcode"=>$_POST["agentcode"],
																					"unit_id"	=> $_POST["unit_id"]
																															)
																			)
																		);
			}
			if(isset($_POST["al-filter-reset"])){
				
				$this->session->set_userdata(array(
																			"instructions_filter"=>array(
																					"from"=>"",
																					"to"=>"",
																					"agentcode"=>"",
																					"unit_id"	=> ""
																															)
																			)
																		);
			}
			
		}else if(empty($order)){
			$this->session->set_userdata(array("order"=>"desc"));		
		}
		$instructions_filter = $this->session->userdata("instructions_filter");
		$order = $this->session->userdata("order");
		$data = array();
		$data["agents"] = $this->user_model->getAllUsers();
		$this->load->library("pagination");
		$per_page = 20;
		$total = $this->instructions_model->countInstructionsAccessLogs($instructions_filter);  //total post

		$data['logs'] = $this->instructions_model->getAllInstructionsAccessLogs($per_page, $this->uri->segment(3),$instructions_filter);
		$config['base_url'] = $this->config->item('base_url').'report/InstructionsReport/';
		$config['uri_segment'] = '3';

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
		$data["instructions_filter"] = $instructions_filter;
		$data["units"] = $this->report_model->getAllUnits();
		$this->load->view("header_mat",array("page"=>"Instructions Report"));
		$this->load->view("report/accessLogs",$data);
		$this->load->view("footer_mat");
	}
	
	public function generateGeneralReport(){
		$this->session->set_userdata(
																	array(
																		"dailyreport_deleted_rows"=>array(
																																				"general" => array(),
																																				"supervisor" => array(),
																																				"management" => array(),
																																				"fault" => array()
																																			)
																			)
																);
		$this->session->set_userdata(array("GeneralReport"=>$_POST));
		$data = array();
		$data["from"] = $_POST["from"];
		$data["to"] = $_POST["to"];
		$data["unit_id"] = $_POST["unit_id"];
		$data["subject"] = array();
		if(isset($_POST["subject"])){
			$data["subject"] = $_POST["subject"];
		}
		$data["initial"] = $_POST["initial"];
		$data["onbehalf"] = $_POST["onbehalf"];
		$data["units"] = $this->report_model->getAllUnits();
		$data["unit_id"] = $_POST["unit_id"];
		$data["subjects"] = $this->elog_model->getAllActiveSubjects();
		$data["allusers"] = $this->user_model->getAllUsers();
		$data["form_logs"] = $this->report_model->getFormLogs($_POST);
		$this->load->view("header_mat",array("page"=>"Daily Report"));
		$this->load->view("report/generateGeneralReport",$data);
		$this->load->view("footer_mat");
	}
	public function FaultReport(){
		$data = array();
		$data["allusers"] = $this->user_model->getAllUsers();
		$data["equipments"] = $this->report_model->getAllEquipments();
		$data["positions"] = $this->report_model->getAllPositions();
		$data["consoleNumbers"] = $this->report_model->getAllConsoleNumbers();
		$data["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$data["units"] = $this->report_model->getAllUnits();
		$this->load->view("header_mat",array("page"=>"Fault Report"));
		$this->load->view("report/FaultReport",$data);
		$this->load->view("footer_mat");
	}
	public function generateFaultReport(){
		$this->session->set_userdata(
																	array(
																		"dailyreport_deleted_rows"=>array(
																																				"general" => array(),
																																				"supervisor" => array(),
																																				"management" => array(),
																																				"fault" => array()
																																			)
																			)
																);
		$this->session->set_userdata(array("FaultReport"=>$_POST));
		$data = array();
		$data["from"] = $_POST["from"];
		$data["to"] = $_POST["to"];
		$data["unit_id"] = $_POST["unit_id"];
		$data["onbehalf"] = $_POST["onbehalf"];
		$data["initial"] = $_POST["initial"];
		$data["position_name"] = $_POST["position_name"];
		$data["console_number"] = $_POST["console_number"];
		$data["system_equipment"] = $_POST["system_equipment"];
		$data["post_frnstatus"] = $_POST["frnstatus"];
		$data["equipments"] = $this->report_model->getAllEquipments();
		$data["positions"] = $this->report_model->getAllPositions();
		$data["consoleNumbers"] = $this->report_model->getAllConsoleNumbers();
		$data["units"] = $this->report_model->getAllUnits();
		$data["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$data["allusers"] = $this->user_model->getAllUsers();
		$data["faultReportingLogs"] = $this->report_model->getFaultReportingLogs($_POST);
		$this->load->view("header_mat",array("page"=>"Daily Report"));
		$this->load->view("report/generateFaultReport",$data);
		$this->load->view("footer_mat");
	}
	
	
	
	public function searchfault(){
			
				$data = array();
		$data["from"] = $_POST["from"];
		$data["to"] = $_POST["to"];
		$data["search"] = $this->report_model->getjobsearch($_POST);
		$data["total"] = $this->elog_model->count_recs("jobcard");
		
		$this->load->view("header_mat",array("page"=>"Daily Report"));
		$this->load->view("searchjob",$data);
		$this->load->view("footer_mat");
		}
	
	
	
	public function reportPDF($greport = NULL,$sreport = NULL,$mreport = NULL,$freport = NULL,$report_type = NULL,$filename = NULL){
		$report_heading = "";
		$postData = array();
		if($report_type == "daily"){
			$postData = $this->session->userdata("DailyReport");
			$report_heading = "Daily Report";
		}else if($report_type == "supervisor"){
			$postData = $this->session->userdata("SupervisorReport");
			$report_heading = "Supervisor Report";
		}else if($report_type == "general"){
			$postData = $this->session->userdata("GeneralReport");
			$report_heading = "General Report";
		}else if($report_type == "management"){
			$postData = $this->session->userdata("ManagementReport");
			$report_heading = "Management Report";
		}else if($report_type == "fault"){
			$postData = $this->session->userdata("FaultReport");
			$report_heading = "Fault Report";
		}
		$data = array();
		$data["from"] = $postData["from"];
		$data["to"] = $postData["to"];
		$data["unit_id"] = $postData["unit_id"];
		if($greport == "create"){
	
			$data["form_logs"] = $this->report_model->getFormLogs($postData);		
			$data["greport"] = true;
			
		}else{
			$data["greport"] = false;		
		}
		if($sreport == "create"){
			$data["supervisor_reports"] = $this->report_model->getSupervisorLogs($postData);
			$data["sreport"] = true;
		}else{
			$data["sreport"] = false;
		}
		if($mreport == "create"){
			$data["management_reports"] = $this->report_model->getManagementLogs($postData);
			$data["mreport"] = true;
		}else{
			$data["mreport"] = false;
		}
		if($freport == "create"){
			$data["faultReportingLogs"] = $this->report_model->getFaultReportingLogs($postData);
			$data["freport"] = true;
		}else{
			$data["freport"] = false;
		}
		$html = $this->load->view("report/generateDailyReportPDF",$data,TRUE);

		$this->tcpdf->SetCreator(PDF_CREATOR);
		

		$this->tcpdf->SetHeaderData(PDF_HEADER_LOGO, 60, "$report_heading", "Dated: ".date("Y-m-d H:i:s"));

		$this->tcpdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$this->tcpdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		$this->tcpdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		$this->tcpdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$this->tcpdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$this->tcpdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		$this->tcpdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		$this->tcpdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$pdf->setLanguageArray($l);
		}

		$this->tcpdf->SetFont('dejavusans', '', 10);

		$this->tcpdf->AddPage();

		$this->tcpdf->writeHTML($html, true, false, true, false, '');

		$this->tcpdf->lastPage();
		if($this->tcpdf->Output(FCPATH.'/assets/reports/'.$filename, 'F')){
			print($filename);
		}else{
			print("error");
		}	
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */