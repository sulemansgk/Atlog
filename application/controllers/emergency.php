<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emergency extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("emergency_model");
		$this->load->model("base_model");
		$this->load->model("domain_model");
		$this->load->library("session");
		$this->load->library("phpmailer");
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

	public function index(){
		$this->load->view('header_mat',array("page"=>"Emergency"));
		$this->load->view("emergency");
		$this->load->view("footer_mat");	
	}
	
	public function aircraftcrash()
	{
		$this->load->view('header_mat',array("page"=>"Aircraft Crash"));
		$this->load->view("aircraftcrash");
		$this->load->view("footer_mat");
	}
	
	public function aircraftgroundincident()
	{
		$this->load->view('header_mat',array("page"=>"Aircraft Ground Incdent"));
		$this->load->view("aircraftgroundincident");
		$this->load->view("footer_mat");
	}
	public function bombwarning()
	{
		$this->load->view('header_mat',array("page"=>"Bomb Warning"));
		$this->load->view("bombwarning");
		$this->load->view("footer_mat");
	}
	
	public function domesticfire()
	{
		$this->load->view('header_mat',array("page"=>"Domestic Fire"));
		$this->load->view("domesticfire");
		$this->load->view("footer_mat");
	}
	public function fuelspillage()
	{
		$this->load->view('header_mat',array("page"=>"Fuel Spillage"));
		$this->load->view("fuelspillage");
		$this->load->view("footer_mat");
	}
	public function fullemergency()
	{
		$this->load->view('header_mat',array("page"=>"Fuel Emergency"));
		$this->load->view("fullemergency");
		$this->load->view("footer_mat");
	}

	public function localstandby()
	{
		$this->load->view('header_mat',array("page"=>"Local Standby"));
		$this->load->view("localstandby");
		$this->load->view("footer_mat");
	}

	public function medicalemergency()
	{
		$this->load->view('header_mat',array("page"=>"Medical Emergency"));
		$this->load->view("medicalemergency");
		$this->load->view("footer_mat");
	}

	public function OMADEmergencies()
	{
		$this->load->view('header_mat',array("page"=>"OMAD Emergency"));
		$this->load->view("OMADEmergencies");
		$this->load->view("footer_mat");
	}
	public function OMBYEmergencies()
	{
		$this->load->view('header_mat',array("page"=>"OMBY Emergency"));
		$this->load->view("OMBYEmergencies");
		$this->load->view("footer_mat");
	}

	public function UnlawfulInteference()
	{
		$this->load->view('header_mat',array("page"=>"Unlawful Interference"));
		$this->load->view("UnlawfulInteferences");
		$this->load->view("footer_mat");
	}
	public function WeatherStandby()
	{
		$this->load->view('header_mat',array("page"=>"weather Standby"));
		$this->load->view("WeatherStandby");
		$this->load->view("footer_mat");
	}
	
	public function insertlog(){
	   
		$viewData = array();
		$insert_id = $this->emergency_model->insertlog($_POST);
		if(!empty($insert_id) && ( $insert_id != 0 )){
			$log_data = array(
								
								"log_type" => 	$_POST["type_of_incident"],
								"log_table"=> 	"emergency_formdata",
								"log_id"	 => 	$insert_id,
								"datetime" =>		$_POST["datetime"],
							);
							 
			$log_insert_id = $this->emergency_model->insertformlog($log_data);
			
			if(!empty($log_insert_id) && ($log_insert_id != 0 )){
				
				$acceslog_data = array(
								"agentcode"		=>	$this->userdetails["agentcode"],
								"message"		=>	"Inserted Emeergency Log: ".$_POST["type_of_incident"],
								"log_datetime"	=> 	date("Y-m-d H:i:s"),
								"form_log_id"	=>	$log_insert_id
							);
							
				$this->base_model->insertAccessLog($acceslog_data);
				$this->base_model->insertKeywords($_POST);
				
				/* 
					Send Emails to the email 
					addresses of this form 
				*/
				$emails = $this->domain_model->getFormEmails($_POST["type_of_incident"]);
		
				$emails_str = "";
		
				if(!empty($emails)){
					$body = "<table>
							<tbody>
							<tr>
								<th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
							</tr>";
					if(isset($_POST["initial"])){
						unset($_POST["initial"]);
					}
					foreach($_POST as $field_key=>$field){
						$body = $body."<tr><td>".strtoupper($field_key)." </td> <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>".$field."</td></tr>";
					}
					$body = $body."</tbody></table>";

					$this->phpmailer->isSMTP();                                      // Set mailer to use SMTP
					$this->phpmailer->IsHTML(true);
					$this->phpmailer->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
					$this->phpmailer->SMTPAuth = false;  
					$this->phpmailer->SMTPDebug = 1	;
					$this->phpmailer->Port       = 465;                   
					$this->phpmailer->SMTPSecure = "ssl";       					// Enable SMTP authentication
					$mail->Username = '';                 // SMTP username
					$mail->Password = 'giftsmine1310f';                           // SMTP password
					$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

					
					
					
					$to = "";
					$message = "";
					foreach($emails as $key=>$email){
			
						$message .= $body;
						$to .= $emails_str.$email["email_address"]."," ;
					}					
					$to = rtrim($to , ',');
					$subject = "ATM Application";

					

					// Always set content-type when sending HTML email
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

					
						if(!mail($to,$subject,$message,$headers)) {
							
					} else {
							
					}		
		
				}else{
					
				}
				
			
				$this->insertTblFormData($emails_str,$phones,$insert_id);
				
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
	
	public function locations(){
		print($this->emergency_model->getlocations($_GET["term"]));
	}
	public function aircrafttype(){
		print($this->emergency_model->aircrafttype($_GET["term"]));
	}
	public function aircraft_operator(){
		print($this->emergency_model->aircraft_operator($_GET["term"]));
	}
	public function callsign(){
		print($this->emergency_model->callsign($_GET["term"]));
	}
	public function dangerous_goods(){
		print($this->emergency_model->dangerous_goods($_GET["term"]));
	}
	public function point_of_departure(){
		print($this->emergency_model->point_of_departure($_GET["term"]));
	}
	public function destination(){
		print($this->emergency_model->destination($_GET["term"]));
	}
	public function reason(){
		print($this->emergency_model->reason($_GET["term"]));
	}
	public function runway_in_use(){
		print($this->emergency_model->runway_in_use($_GET["term"]));
	}
	public function nature_of_accident(){
		print($this->emergency_model->nature_of_accident($_GET["term"]));
	}
	public function position_name(){
		print($this->emergency_model->position_name($_GET["term"]));
		
	}
	public function console_number(){
		print($this->emergency_model->console_number($_GET["term"]));
	}
	public function system_equipment(){
		print($this->emergency_model->system_equipment($_GET["term"]));
	}
	public function purpose_of_release(){
		print($this->emergency_model->purpose_of_release($_GET["term"]));
	}
	public function aircraftcrashedit(){
		
		$rec = $this->emergency_model->getEmergencyLog($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["log"]["callstatus"] = $_POST["callstatus"];
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$this->load->view("aircraftcrashedit",$viewData);
	}
	public function aircraftgroundincidentedit(){
		$rec = $this->emergency_model->getEmergencyLog($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["log"]["callstatus"] = $_POST["callstatus"];
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$this->load->view("aircraftgroundincidentedit",$viewData);
	}
	public function bombwarningedit(){
		$rec = $this->emergency_model->getEmergencyLog($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["log"]["callstatus"] = $_POST["callstatus"];
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$this->load->view("bombwarningedit",$viewData);
	}
	public function domesticfireedit(){
		$rec = $this->emergency_model->getEmergencyLog($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["log"]["callstatus"] = $_POST["callstatus"];
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$this->load->view("domesticfireedit",$viewData);
	}

	public function fullemergency_edit(){
	
		$rec = $this->emergency_model->getEmergencyLog($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["log"]["callstatus"] = $_POST["callstatus"];
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$this->load->view("fullemergencyedit",$viewData);
	}

	public function fuelsipllageedit(){
		$rec = $this->emergency_model->getEmergencyLog($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["log"]["callstatus"] = $_POST["callstatus"];
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$this->load->view("fuelsipllageedit",$viewData);
	}
	public function fuelsemergencyedit(){
		$rec = $this->emergency_model->getEmergencyLog($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["log"]["callstatus"] = $_POST["callstatus"];
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$this->load->view("fuelemergencyedit",$viewData);
	}
	public function localstandbyedit(){
		$rec = $this->emergency_model->getEmergencyLog($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["log"]["callstatus"] = $_POST["callstatus"];
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$this->load->view("localstandbyedit",$viewData);
	}
	public function medicalemergencyedit(){
		$rec = $this->emergency_model->getEmergencyLog($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["log"]["callstatus"] = $_POST["callstatus"];
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$this->load->view("medicalemergencyedit",$viewData);
	}
	public function omademergenciesedit(){
		$rec = $this->emergency_model->getEmergencyLog($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["log"]["callstatus"] = $_POST["callstatus"];
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$this->load->view("omademergenciesedit",$viewData);
	}
	public function ombyemergencyedit(){
		$rec = $this->emergency_model->getEmergencyLog($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["log"]["callstatus"] = $_POST["callstatus"];
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$this->load->view("ombyemergencyedit",$viewData);
	}
	public function unlawfulinterferenceedit(){
		$rec = $this->emergency_model->getEmergencyLog($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["log"]["callstatus"] = $_POST["callstatus"];
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$this->load->view("unlawfulinterferenceedit",$viewData);
	}
	public function weatherstandbyedit(){
		$rec = $this->emergency_model->getEmergencyLog($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["log"]["callstatus"] = $_POST["callstatus"];
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$this->load->view("weatherstandbyedit",$viewData);
	}
	public function emergency_log_edit(){
		$rec = $this->emergency_model->getEmergencyLog($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$this->load->view("emergency_log_edit",$viewData);
	}
	public function acceptfrn(){
		
		$table = $_POST["table"];
		$log_id = $_POST["id"];
		$frnstatus = $this->emergency_model->acceptfrn($log_id,$table);
		if($frnstatus != "error"){
			print('<span class="frn-status">'.$frnstatus.'</span>');
		}else{
			print("error");
		}
	}
	
	public function updatelog(){
		$log_id = $_GET["log_id"];
		if($this->emergency_model->updatelog($log_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated ".$_POST["type_of_incident"]." log.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$log_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			print("updated");
		}else{
			print("error");
		}
		
	}
	
	public function insertTblFormData($emails_str,$phones,$log_insert_id){
		$strForm = "";
		$strForm2 = "";
		if($_POST["type_of_incident"] == "Aircraft Crash"){
				$strForm="
				DECLARE:".$_POST["crash_type"]."
				TYPE OF INCIDENT:".$_POST["type_of_incident"]."
				LOCATION:".$_POST["location"]."
				AIRCRAFT TYPE:".$_POST["aircraft_type"]."
				PERSON ON BOARD:".$_POST["persons_on_board"]."
				AIRCRAFT OPERATOR:".$_POST["aircraft_operator"]."
				CALL SIGN:".$_POST["callsign"]."
				DANGEROUS GOOD:".$_POST["dangerous_goods"]."
				POINT OF DEPARTURE:".$_POST["point_of_departure"]."
				DESTINATION:".$_POST["destination"]."
				NATURE OF INCIDENT:".$_POST["nature_of_accident"]."
				OTHER DETAIL:".$_POST["any_other_details"]."
				TIME OF INCIDENT=".$_POST["time_of_accident"]."
				";			
				$strForm2="
				<br/>DECLARE:".$_POST["crash_type"]."
				<br/>TYPE OF INCIDENT:".$_POST["type_of_incident"]."
				<br/>LOCATION:".$_POST["location"]."
				<br/>AIRCRAFT TYPE:".$_POST["aircraft_type"]."
				<br/>PERSON ON BOARD:".$_POST["persons_on_board"]."
				<br/>AIRCRAFT OPERATOR:".$_POST["aircraft_operator"]."
				<br/>CALL SIGN:".$_POST["callsign"]."
				<br/>DANGEROUS GOOD:".$_POST["dangerous_goods"]."
				<br/>POINT OF DEPARTURE:".$_POST["point_of_departure"]."
				<br/>DESTINATION:".$_POST["destination"]."
				<br/>NATURE OF INCIDENT:".$_POST["nature_of_accident"]."
				<br/>OTHER DETAIL:".$_POST["any_other_details"]."
				<br/>TIME OF INCIDENT=".$_POST["time_of_accident"]."
				";			
		}else if($_POST["type_of_incident"] == "Aircraft Ground Incident"){
				$strForm="
				TYPE OF INCIDENT:".$_POST["type_of_incident"]."
				LOCATION:".$_POST["location"]."
				AIRCRAFT TYPE:".$_POST["aircraft_type"]."
				PERSON ON BOARD:".$_POST["persons_on_board"]."
				ETA:".$_POST["eta"]."
				AIRCRAFT OPERATOR:".$_POST["aircraft_operator"]."
				CALL SIGN:".$_POST["callsign"]."
				DANGEROUS GOOD:".$_POST["dangerous_goods"]."
				NATURE OF INCIDENT:".$_POST["nature_of_accident"]."
				OTHER DETAIL:".$_POST["any_other_details"]."
				TIME OF INCIDENT=".$_POST["time_of_accident"]."
				";			
				$strForm2="
				<br/>TYPE OF INCIDENT:".$_POST["type_of_incident"]."
				<br/>LOCATION:".$_POST["location"]."
				<br/>AIRCRAFT TYPE:".$_POST["aircraft_type"]."
				<br/>PERSON ON BOARD:".$_POST["persons_on_board"]."
				<br/>ETA:".$_POST["eta"]."
				<br/>AIRCRAFT OPERATOR:".$_POST["aircraft_operator"]."
				<br/>CALL SIGN:".$_POST["callsign"]."
				<br/>DANGEROUS GOOD:".$_POST["dangerous_goods"]."
				<br/>NATURE OF INCIDENT:".$_POST["nature_of_accident"]."
				<br/>OTHER DETAIL:".$_POST["any_other_details"]."
				<br/>TIME OF INCIDENT=".$_POST["time_of_accident"]."
				";			
		}else if($_POST["type_of_incident"] == "Bomb Warning"){
				$strForm="
				TYPE OF INCIDENT:".$_POST["type_of_incident"]."
				LOCATION:".$_POST["location"]."
				AIRCRAFT TYPE:".$_POST["aircraft_type"]."
				PERSON ON BOARD:".$_POST["persons_on_board"]."
				AIRCRAFT OPERATOR:".$_POST["aircraft_operator"]."
				CALL SIGN:".$_POST["callsign"]."
				DANGEROUS GOOD:".$_POST["dangerous_goods"]."
				POINT OF DEPARTURE:".$_POST["point_of_departure"]."
				DESTINATION:".$_POST["destination"]."
				NATURE OF INCIDENT:".$_POST["nature_of_accident"]."
				OTHER DETAIL:".$_POST["any_other_details"]."
				TIME OF INCIDENT=".$_POST["time_of_accident"]."
				";			
				$strForm2="
				<br/>TYPE OF INCIDENT:".$_POST["type_of_incident"]."
				<br/>LOCATION:".$_POST["location"]."
				<br/>AIRCRAFT TYPE:".$_POST["aircraft_type"]."
				<br/>PERSON ON BOARD:".$_POST["persons_on_board"]."
				<br/>AIRCRAFT OPERATOR:".$_POST["aircraft_operator"]."
				<br/>CALL SIGN:".$_POST["callsign"]."
				<br/>DANGEROUS GOOD:".$_POST["dangerous_goods"]."
				<br/>POINT OF DEPARTURE:".$_POST["point_of_departure"]."
				<br/>DESTINATION:".$_POST["destination"]."
				<br/>NATURE OF INCIDENT:".$_POST["nature_of_accident"]."
				<br/>OTHER DETAIL:".$_POST["any_other_details"]."
				<br/>TIME OF INCIDENT=".$_POST["time_of_accident"]."
				";			
		}else if($_POST["type_of_incident"] == "Domestic Fire"){
				$strForm="
				TYPE OF INCIDENT:".$_POST["type_of_incident"]."
				LOCATION:".$_POST["location"]."
				AIRCRAFT TYPE:".$_POST["aircraft_type"]."
				PERSON ON BOARD:".$_POST["persons_on_board"]."
				AIRCRAFT OPERATOR:".$_POST["aircraft_operator"]."
				CALL SIGN:".$_POST["callsign"]."
				DANGEROUS GOOD:".$_POST["dangerous_goods"]."
				POINT OF DEPARTURE:".$_POST["point_of_departure"]."
				DESTINATION:".$_POST["destination"]."
				NATURE OF INCIDENT:".$_POST["nature_of_accident"]."
				OTHER DETAIL:".$_POST["any_other_details"]."
				TIME OF INCIDENT=".$_POST["time_of_accident"]."
				";			
				$strForm2="
				<br/>TYPE OF INCIDENT:".$_POST["type_of_incident"]."
				<br/>LOCATION:".$_POST["location"]."
				<br/>AIRCRAFT TYPE:".$_POST["aircraft_type"]."
				<br/>PERSON ON BOARD:".$_POST["persons_on_board"]."
				<br/>AIRCRAFT OPERATOR:".$_POST["aircraft_operator"]."
				<br/>CALL SIGN:".$_POST["callsign"]."
				<br/>DANGEROUS GOOD:".$_POST["dangerous_goods"]."
				<br/>POINT OF DEPARTURE:".$_POST["point_of_departure"]."
				<br/>DESTINATION:".$_POST["destination"]."
				<br/>NATURE OF INCIDENT:".$_POST["nature_of_accident"]."
				<br/>OTHER DETAIL:".$_POST["any_other_details"]."
				<br/>TIME OF INCIDENT=".$_POST["time_of_accident"]."
				";			
		}else if($_POST["type_of_incident"] == "Fuel Spillage"){
				$strForm="
				TYPE OF INCIDENT:".$_POST["type_of_incident"]."
				LOCATION:".$_POST["location"]."
				AIRCRAFT TYPE:".$_POST["aircraft_type"]."
				PERSON ON BOARD:".$_POST["persons_on_board"]."
				AIRCRAFT OPERATOR:".$_POST["aircraft_operator"]."
				CALL SIGN:".$_POST["callsign"]."
				DANGEROUS GOOD:".$_POST["dangerous_goods"]."
				POINT OF DEPARTURE:".$_POST["point_of_departure"]."
				DESTINATION:".$_POST["destination"]."
				NATURE OF INCIDENT:".$_POST["nature_of_accident"]."
				OTHER DETAIL:".$_POST["any_other_details"]."
				TIME OF INCIDENT=".$_POST["time_of_accident"]."
				";			
				$strForm2="
				<br/>TYPE OF INCIDENT:".$_POST["type_of_incident"]."
				<br/>LOCATION:".$_POST["location"]."
				<br/>AIRCRAFT TYPE:".$_POST["aircraft_type"]."
				<br/>PERSON ON BOARD:".$_POST["persons_on_board"]."
				<br/>AIRCRAFT OPERATOR:".$_POST["aircraft_operator"]."
				<br/>CALL SIGN:".$_POST["callsign"]."
				<br/>DANGEROUS GOOD:".$_POST["dangerous_goods"]."
				<br/>POINT OF DEPARTURE:".$_POST["point_of_departure"]."
				<br/>DESTINATION:".$_POST["destination"]."
				<br/>NATURE OF INCIDENT:".$_POST["nature_of_accident"]."
				<br/>OTHER DETAIL:".$_POST["any_other_details"]."
				<br/>TIME OF INCIDENT=".$_POST["time_of_accident"]."
				";			
		}else if($_POST["type_of_incident"] == "Fuel Emergency"){
				$strForm="
				TYPE OF INCIDENT:".$_POST["type_of_incident"]."
				LOCATION:".$_POST["location"]."
				AIRCRAFT TYPE:".$_POST["aircraft_type"]."
				PERSON ON BOARD:".$_POST["persons_on_board"]."
				ETA:".$_POST["eta"]."
				AIRCRAFT OPERATOR:".$_POST["aircraft_operator"]."
				CALL SIGN:".$_POST["callsign"]."
				DANGEROUS GOOD:".$_POST["dangerous_goods"]."
				POINT OF DEPARTURE:".$_POST["point_of_departure"]."
				DESTINATION:".$_POST["destination"]."
				NATURE OF INCIDENT:".$_POST["nature_of_accident"]."
				OTHER DETAIL:".$_POST["any_other_details"]."
				TIME OF INCIDENT=".$_POST["time_of_accident"]."
				";			
				$strForm2="
				<br/>TYPE OF INCIDENT:".$_POST["type_of_incident"]."
				<br/>LOCATION:".$_POST["location"]."
				<br/>AIRCRAFT TYPE:".$_POST["aircraft_type"]."
				<br/>PERSON ON BOARD:".$_POST["persons_on_board"]."
				<br/>AIRCRAFT OPERATOR:".$_POST["aircraft_operator"]."
				<br/>CALL SIGN:".$_POST["callsign"]."
				<br/>DANGEROUS GOOD:".$_POST["dangerous_goods"]."
				<br/>POINT OF DEPARTURE:".$_POST["point_of_departure"]."
				<br/>DESTINATION:".$_POST["destination"]."
				<br/>NATURE OF INCIDENT:".$_POST["nature_of_accident"]."
				<br/>OTHER DETAIL:".$_POST["any_other_details"]."
				<br/>TIME OF INCIDENT=".$_POST["time_of_accident"]."
				";			
		}else if($_POST["type_of_incident"] == "Local Standby"){
				$strForm="
				TYPE OF INCIDENT:".$_POST["type_of_incident"]."
				LOCATION:".$_POST["location"]."
				AIRCRAFT TYPE:".$_POST["aircraft_type"]."
				PERSON ON BOARD:".$_POST["persons_on_board"]."
				ETA:".$_POST["eta"]."
				AIRCRAFT OPERATOR:".$_POST["aircraft_operator"]."
				CALL SIGN:".$_POST["callsign"]."
				DANGEROUS GOOD:".$_POST["dangerous_goods"]."
				POINT OF DEPARTURE:".$_POST["point_of_departure"]."
				DESTINATION:".$_POST["destination"]."
				NATURE OF INCIDENT:".$_POST["nature_of_accident"]."
				OTHER DETAIL:".$_POST["any_other_details"]."
				TIME OF INCIDENT=".$_POST["time_of_accident"]."
				";			
				$strForm2="
				<br/>TYPE OF INCIDENT:".$_POST["type_of_incident"]."
				<br/>LOCATION:".$_POST["location"]."
				<br/>AIRCRAFT TYPE:".$_POST["aircraft_type"]."
				<br/>PERSON ON BOARD:".$_POST["persons_on_board"]."
				<br/>AIRCRAFT OPERATOR:".$_POST["aircraft_operator"]."
				<br/>CALL SIGN:".$_POST["callsign"]."
				<br/>DANGEROUS GOOD:".$_POST["dangerous_goods"]."
				<br/>POINT OF DEPARTURE:".$_POST["point_of_departure"]."
				<br/>DESTINATION:".$_POST["destination"]."
				<br/>NATURE OF INCIDENT:".$_POST["nature_of_accident"]."
				<br/>OTHER DETAIL:".$_POST["any_other_details"]."
				<br/>TIME OF INCIDENT=".$_POST["time_of_accident"]."
				";			
		}else if($_POST["type_of_incident"] == "Medical Emergency"){
				$strForm="
				TYPE OF INCIDENT:".$_POST["type_of_incident"]."
				NATURE OF INCIDENT:".$_POST["nature_of_accident"]."
				REASON:".$_POST["reason"]."
				LOCATION:".$_POST["location"]."
				AIRCRAFT TYPE:".$_POST["aircraft_type"]."
				PERSONS INVOLVED:".$_POST["persons_on_board"]."
				ETA:".$_POST["eta"]."
				AIRCRAFT OPERATOR:".$_POST["aircraft_operator"]."
				CALL SIGN:".$_POST["callsign"]."
				DANGEROUS GOOD:".$_POST["dangerous_goods"]."
				POINT OF DEPARTURE:".$_POST["point_of_departure"]."
				DESTINATION:".$_POST["destination"]."
				OTHER DETAIL:".$_POST["any_other_details"]."
				TIME OF INCIDENT=".$_POST["time_of_accident"]."
				";			
				$strForm2="
				<br/>TYPE OF INCIDENT:".$_POST["type_of_incident"]."
				<br/>NATURE OF INCIDENT:".$_POST["nature_of_accident"]."
				<br/>REASON:".$_POST["reason"]."
				<br/>LOCATION:".$_POST["location"]."
				<br/>AIRCRAFT TYPE:".$_POST["aircraft_type"]."
				<br/>PERSONS INVOLVED:".$_POST["persons_on_board"]."
				<br/>ETA:".$_POST["eta"]."
				<br/>AIRCRAFT OPERATOR:".$_POST["aircraft_operator"]."
				<br/>CALL SIGN:".$_POST["callsign"]."
				<br/>DANGEROUS GOOD:".$_POST["dangerous_goods"]."
				<br/>POINT OF DEPARTURE:".$_POST["point_of_departure"]."
				<br/>DESTINATION:".$_POST["destination"]."
				<br/>OTHER DETAIL:".$_POST["any_other_details"]."
				<br/>TIME OF INCIDENT=".$_POST["time_of_accident"]."
				";			
		}else if($_POST["type_of_incident"] == "OMAD Emergencies"){
				$strForm="
				TYPE OF INCIDENT:".$_POST["type_of_incident"]."
				TIME OF CALL FROM OMAD:".$_POST["time_of_accident"]."
				LOCATION:".$_POST["location"]."
				AIRCRAFT TYPE:".$_POST["aircraft_type"]."
				PERSONS ON BOARD:".$_POST["persons_on_board"]."
				AIRCRAFT OPERATOR:".$_POST["aircraft_operator"]."
				CALL SIGN:".$_POST["callsign"]."
				DANGEROUS GOOD:".$_POST["dangerous_goods"]."
				POINT OF DEPARTURE:".$_POST["point_of_departure"]."
				DESTINATION:".$_POST["destination"]."
				NATURE OF ACCIDENT:".$_POST["nature_of_accident"]."
				OTHER DETAIL:".$_POST["any_other_details"]."
				TIME OF INCIDENT=".$_POST["time_of_accident"]."
				";			
				$strForm2="
				<br/>TYPE OF INCIDENT:".$_POST["type_of_incident"]."
				<br/>TIME OF CALL FROM OMAD:".$_POST["time_of_accident"]."
				<br/>LOCATION:".$_POST["location"]."
				<br/>AIRCRAFT TYPE:".$_POST["aircraft_type"]."
				<br/>PERSONS ON BOARD:".$_POST["persons_on_board"]."
				<br/>AIRCRAFT OPERATOR:".$_POST["aircraft_operator"]."
				<br/>CALL SIGN:".$_POST["callsign"]."
				<br/>DANGEROUS GOOD:".$_POST["dangerous_goods"]."
				<br/>POINT OF DEPARTURE:".$_POST["point_of_departure"]."
				<br/>DESTINATION:".$_POST["destination"]."
				<br/>NATURE OF ACCIDENT:".$_POST["nature_of_accident"]."
				<br/>OTHER DETAIL:".$_POST["any_other_details"]."
				<br/>TIME OF INCIDENT=".$_POST["time_of_accident"]."
				";			
		}else if($_POST["type_of_incident"] == "OMBY Emergency"){
				$strForm="
				TYPE OF INCIDENT:".$_POST["type_of_incident"]."
				TIME OF CALL FROM OMBY:".$_POST["time_of_call_omby"]."
				LOCATION:".$_POST["location"]."
				AIRCRAFT TYPE:".$_POST["aircraft_type"]."
				PERSONS ON BOARD:".$_POST["persons_on_board"]."
				AIRCRAFT OPERATOR:".$_POST["aircraft_operator"]."
				CALL SIGN:".$_POST["callsign"]."
				DANGEROUS GOOD:".$_POST["dangerous_goods"]."
				POINT OF DEPARTURE:".$_POST["point_of_departure"]."
				DESTINATION:".$_POST["destination"]."
				NATURE OF ACCIDENT:".$_POST["nature_of_accident"]."
				OTHER DETAIL:".$_POST["any_other_details"]."
				TIME OF INCIDENT=".$_POST["time_of_accident"]."
				";			
				$strForm2="
				<br/>TYPE OF INCIDENT:".$_POST["type_of_incident"]."
				<br/>TIME OF CALL FROM OMBY:".$_POST["time_of_call_omby"]."
				<br/>LOCATION:".$_POST["location"]."
				<br/>AIRCRAFT TYPE:".$_POST["aircraft_type"]."
				<br/>PERSONS ON BOARD:".$_POST["persons_on_board"]."
				AIRCRAFT OPERATOR:".$_POST["aircraft_operator"]."
				CALL SIGN:".$_POST["callsign"]."
				DANGEROUS GOOD:".$_POST["dangerous_goods"]."
				POINT OF DEPARTURE:".$_POST["point_of_departure"]."
				DESTINATION:".$_POST["destination"]."
				NATURE OF ACCIDENT:".$_POST["nature_of_accident"]."
				OTHER DETAIL:".$_POST["any_other_details"]."
				TIME OF INCIDENT=".$_POST["time_of_accident"]."
				";			
		}else if($_POST["type_of_incident"] == "Unlawful Interference"){
				$strForm="
				TYPE OF INCIDENT:".$_POST["type_of_incident"]."
				LOCATION:".$_POST["location"]."
				AIRCRAF TYPE:".$_POST["aircraft_type"]."
				PERSONS ON BOARD:".$_POST["persons_on_board"]."
				ETA:".$_POST["eta"]."
				AIRCRAFT OPERATOR:".$_POST["aircraft_operator"]."
				CALL SIGN:".$_POST["callsign"]."
				DANGEROUS GOOD:".$_POST["dangerous_goods"]."
				POINT OF DEPARTURE:".$_POST["point_of_departure"]."
				DESTINATION:".$_POST["destination"]."
				NATURE OF ACCIDENT:".$_POST["nature_of_accident"]."
				OTHER DETAIL:".$_POST["any_other_details"]."
				TIME OF INCIDENT=".$_POST["time_of_accident"]."
				";			
				$strForm2="
				<br/>TYPE OF INCIDENT:".$_POST["type_of_incident"]."
				<br/>LOCATION:".$_POST["location"]."
				<br/>AIRCRAF TYPE:".$_POST["aircraft_type"]."
				<br/>PERSONS ON BOARD:".$_POST["persons_on_board"]."
				<br/>ETA:".$_POST["eta"]."
				<br/>AIRCRAFT OPERATOR:".$_POST["aircraft_operator"]."
				<br/>CALL SIGN:".$_POST["callsign"]."
				<br/>DANGEROUS GOOD:".$_POST["dangerous_goods"]."
				<br/>POINT OF DEPARTURE:".$_POST["point_of_departure"]."
				<br/>DESTINATION:".$_POST["destination"]."
				<br/>NATURE OF ACCIDENT:".$_POST["nature_of_accident"]."
				<br/>OTHER DETAIL:".$_POST["any_other_details"]."
				<br/>TIME OF INCIDENT=".$_POST["time_of_accident"]."
				";			
		}else if($_POST["type_of_incident"] == "Weather Standby"){
				$strForm="
				TYPE OF INCIDENT:".$_POST["type_of_incident"]."
				REASON:".$_POST["reason"]."
				RUNWAY IN USE:".$_POST["runway_in_use"]."
				TIME OF REQUEST:".$_POST["time_of_request"]."
				";			
				$strForm2="
				<br/>TYPE OF INCIDENT:".$_POST["type_of_incident"]."
				<br/>REASON:".$_POST["reason"]."
				<br/>RUNWAY IN USE:".$_POST["runway_in_use"]."
				<br/>TIME OF REQUEST:".$_POST["time_of_request"]."
				";			
		}
		
		$this->emergency_model->insertTblFormData($strForm,$log_insert_id,$emails_str,$phones);
		$headers = "From: info@jz.com";
		$subject = "NOTIFICATION TYPE OF INCIDENT=".$_POST["type_of_incident"];
		$semi_rand = md5(time());
		$mime_boundary = "==Multipart_Boundary_x{".$semi_rand."}x";
		$headers .= "\nMIME-Version: 1.0\n" .
			"Content-Type: multipart/alternative;\n" .
			" boundary=\"{".$mime_boundary."}\"";
		// Add a multipart boundary above the plain message
		$message = "This is a multi-part message in MIME format.\n\n" .
		 "--{".$mime_boundary."}\n" .
		 "Content-Type: text/html; charset=\"iso-8859-1\"\n" .
		 "Content-Transfer-Encoding: 7bit\n\n" .
		$strForm2 . "\n\n";
		$message .= "--{".$mime_boundary."}--\n";
		// Send the message


		$ok = mail("shoiab.junctionz@yopmail.com ", $subject, $message, $headers);
	}
	public function sendEmail(){
		$body             = "gdssdh";
		$this->phpmailer->IsSMTP(); 
		$this->phpmailer->Host       = "ssl://smtp.gmail.com"; 
		$this->phpmailer->SMTPDebug  = 1; 
		$this->phpmailer->SMTPAuth   = true; 
		$this->phpmailer->SMTPSecure = "ssl"; 
		$this->phpmailer->Host       = "smtp.gmail.com";  
		$this->phpmailer->Port       = 465;               
		$this->phpmailer->Username   = "webconsole.pk@gmail.com"; 
		$this->phpmailer->Password   = "shoaib@#123";   
		$this->phpmailer->SetFrom('contact@prsps.in', 'PRSPS');
		$this->phpmailer->Subject    = "PRSPS password";
		$this->phpmailer->MsgHTML($body);
		$address = "shoaib.icup@gmail.com";
		$this->phpmailer->AddAddress($address, "user2");
		if(!$this->phpmailer->Send()) {
			echo "Mailer Error: " . $this->phpmailer->ErrorInfo;
		} else {
			echo "Message sent!";
		}
	}
	public function callStatus(){
		
		$rec = $this->emergency_model->getEmergencyLog($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["log"]["callstatus"] = $_POST["callstatus"];
		
		$this->load->view("callStatus",$viewData);
	}	
	public function changeCallStatus(){
		$updated_rows = $this->emergency_model->changeCallStatus($_POST["p_id"]);
		if($updated_rows != 0){
			print("success");
		}else{
			print("error");
		}
		
	}
		public function practiseemergency()
	{
		$this->load->view('header_mat',array("page"=>"Bomb Warning"));
		$this->load->view("PractiseEmergency");
		$this->load->view("footer_mat");
	}
	
	
		public function practiseemergencyedit(){
		$rec = $this->emergency_model->getEmergencyLog($_POST["id"]);
		$viewData["log"] = $rec[0];
		$viewData["log"]["callstatus"] = $_POST["callstatus"];
		$viewData["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$this->load->view("bombwarningedit",$viewData);
	}
	
	public function EmergencyExtraOption(){
		$this->load->view('header_mat',array("page"=>"Emergency Extra Detail"));
		$this->load->view("emergency_extra_option");
		$this->load->view("footer_mat");
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */