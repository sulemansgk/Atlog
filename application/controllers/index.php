<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library("session");
		$this->load->model("instructions_model");
		$this->load->model("base_model");
		$this->load->model("report_model");
		$this->load->model("emergency_model");
		$this->userdetails = $this->session->userdata("userdetails");
		$this->load->model("user_model");
		$this->load->model("elog_model");
		$this->load->library("phpmailer");
		if(!empty($this->userdetails)){
			$this->userdetails["permissions"] = $this->user_model->getUserPermissions($this->userdetails["role_id"]);
		}
		
	}
	public function checkemailclass(){
					$this->phpmailer->isSMTP();                                      // Set mailer to use SMTP
					$this->phpmailer->Host = '10.6.5.90';  // Specify main and backup SMTP servers
					$this->phpmailer->SMTPAuth = false;                               // Enable SMTP authentication
					

					$this->phpmailer->From = 'smohammed@gal.adac.ae';
					$this->phpmailer->FromName = 'smohammed';
					$this->phpmailer->addAddress('smohammed@gal.adac.ae', 'smohammed');     // Add a recipient
					$this->phpmailer->addReplyTo('smohammed@gal.adac.ae', 'Information');

					$this->phpmailer->WordWrap = 50;                                 // Set word wrap to 50 characters

					$this->phpmailer->Subject = 'Test subject';
					$this->phpmailer->Body    = 'BODY';

					if(!$this->phpmailer->send()) {
							echo 'Message could not be sent.';
							echo 'Mailer Error: ' . $mail->ErrorInfo;
					} else {
							echo 'Message has been sent';
					}		
	}


	public function testEmail(){
		$email = $_POST['email'];
		$msg = $_POST['msg'];
		
		if(mail($email,"test subject",$msg)){
			echo "success";
		}
	}


	public function index()
	{
		$viewData = array();
		$viewData["userroles"] = $this->user_model->getAllUserRoles();
		$viewData["nationalities"] = $this->user_model->getAllNationalities();
		$viewData["designations"] = $this->user_model->getAllDesignations();
		$viewData["companies"] = $this->user_model->getAllCompanies();
		$userdetails = $this->session->userdata("userdetails");
		
		if(empty($userdetails)){
			
			$this->load->view("login_soft",$viewData);
		}else{
		
			$this->load->view('header_mat',array("page"=>"Dashboard"));
			$this->load->view("index_mat");
			$this->load->view("footer_mat");
		}
	}


	public function dashboard(){
		
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
				redirect("index/dashboard/faultreports");
			}
		}else if(empty($order)){
			$this->session->set_userdata(array("order"=>"desc"));		
		}
		
		if(isset($_POST["al-filter"])){
				$this->session->set_userdata(array(
				"accesslogs_filter"=>array(
				"frnstatus"=>$_POST["frnstatus"],
				"frn"=>$_POST["frn"]
				)
				));
			}
		$accesslogs_filter = $this->session->userdata("accesslogs_filter");
		$order = $this->session->userdata("order");
		$data = array();
		$this->load->library("pagination");
		$per_page = 200;
		$total = $this->elog_model->count_rec("form_logs");  //total post
		if($this->uri->segment(3) == "faultreports"){
			
			$data['logs'] = $this->elog_model->getAllLogs($per_page, $this->uri->segment(4),$accesslogs_filter);
			$config['base_url'] = $this->config->item('base_url').'elog/mainview/faultreports';
			$config['uri_segment'] = '4';
		}else{
			$data['logs'] = $this->elog_model->getAllLogs($per_page, $this->uri->segment(3),$accesslogs_filter);
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
		$data["accesslogs_filter"] = $accesslogs_filter;
		
		$this->load->view("header_mat",array("page"=>"Main View"));
		$this->load->view("index_mat",$data);
		$this->load->view("footer_mat");
	}


	public function registerSuccess(){
		$viewData = array();
		$viewData["userroles"] = $this->user_model->getAllUserRoles();
		$viewData["nationalities"] = $this->user_model->getAllNationalities();
		$viewData["designations"] = $this->user_model->getAllDesignations();
		$viewData["companies"] = $this->user_model->getAllCompanies();
			$this->load->view("login_soft",$viewData);
	}
	public function registerError(){
		$viewData = array();
		$viewData["userroles"] = $this->user_model->getAllUserRoles();
		$viewData["nationalities"] = $this->user_model->getAllNationalities();
		$viewData["designations"] = $this->user_model->getAllDesignations();
		$viewData["companies"] = $this->user_model->getAllCompanies();
			$this->load->view("login_soft",$viewData);
	}
	public function userExists(){
		$viewData = array();
		$viewData["userroles"] = $this->user_model->getAllUserRoles();
		$viewData["nationalities"] = $this->user_model->getAllNationalities();
		$viewData["designations"] = $this->user_model->getAllDesignations();
		$viewData["companies"] = $this->user_model->getAllCompanies();
			$this->load->view("login_soft",$viewData);
	}
	public function authenticate_user()
	{
		$userdetails = $this->user_model->authenticate_user($_POST);
		
		if(!empty($userdetails)){
			$this->user_model->updateLastAccess($userdetails[0]["agentcode"]);
			$res = $this->user_model->getUserRole($userdetails[0]["agentrole"]);
			$userdetails[0]["role"] = $res["role"];
			
			$userdetails[0]["role_id"] = $res["id"];
			unset($userdetails[0]["rights"]);
			$this->session->set_userdata(array("userdetails"=>$userdetails[0]));
			//echo base_url().'index/dashboard';die();
			redirect(base_url().'index/dashboard',"refresh");
		}else{
			$viewData = array();			
			$viewData["auth_error"] = "User name or password is incorrect.";
			$this->load->view("login_soft",$viewData);
		}
		
	}
	
	public function logout(){
		$this->session->set_userdata(array("userdetails"=>array()));
		redirect(base_url());
	}
	
	public function registerUser(){	
		
		$check = $this->user_model->check_user($_POST["agentname"]);
		if(!empty($check)){
			redirect("index/adduser/userExists");
		}else{
			$config['upload_path'] = FCPATH.'assets/user-profile-images/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']	= '5000';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			$config['encrypt_name']  = TRUE;
			$this->load->library('upload', $config);
			
			$viewData = array();
			$_POST["agentunit"] = serialize($_POST["agentunit"]);
			$insert_id = $this->user_model->registerUser($_POST);
			if(!empty($insert_id) && ( $insert_id != 0 )){
				redirect("index/adduser/registerSuccess");
			}else{
				redirect("index/adduser/registerError");
			}		
		}
	}
	
	
	public function UpdateUser(){
		
		$user_id = $_POST["agentcode"];
		unset($_POST["agentcode"]);
		$check = array();
		if(!empty($check)){
			redirect("index/adduser/userExists");
		}else{
			$config['upload_path'] = FCPATH.'assets/user-profile-images/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']	= '5000000000000';
			$config['max_width']  = '10240000000000';
			$config['max_height']  = '7680000000000';
			$config['encrypt_name']  = TRUE;
			$this->load->library('upload', $config);
			if(trim($_FILES["image"]["name"]) != ""){
				if ( ! $this->upload->do_upload("image")){
					$this->session->set_userdata(array("upload_error" => $this->upload->display_errors()));
					redirect("index/userprofile/$user_id/uploadError");
				}else{
					$upload_data = $this->upload->data();
					@unlink(FCPATH.'assets/user-profile-images/'.$_POST["old_image"]);
					unset($_POST["old_image"]);
					$_POST["image"] = $upload_data["file_name"];
				}
			}else{
					$_POST["image"] = $_POST["old_image"];			
					unset($_POST["old_image"]);
			}
			$viewData = array();
			if(isset($_POST["agentunit"])){
				$_POST["agentunit"] = serialize($_POST["agentunit"]);
			}
			$insert_id = $this->user_model->updateUser($user_id,$_POST);
			if(!empty($insert_id) && ( $insert_id != 0 )){
				if($this->userdetails["agentcode"] == trim( $_POST["agentcode"] )){
					$session = $this->session->userdata("userdetails");
					$session["image"] = $_POST["image"];
					$session["firstname"] = $_POST["firstname"];
					$session["lastname"] = $_POST["lastname"];
					$session["dob"] = $_POST["dob"];
					$session["dob"] = $_POST["dob"];
					$this->session->set_userdata(array("userdetails"=>$session));				
				}
				redirect("index/userprofile/$user_id/updateSuccess");
			}else{
					redirect("index/userprofile/$user_id/updateError");
			}		
		}
	}

		public function SendItBck() {

	if(isset($_POST["id"])){
	$fault_generatedby = $this->user_model->getUserById($_POST["initial"]);			$data = array(				"id" =>$_POST["id"],				"action_perfomed" => 3 , 				"Remarks" =>"This fault was sent back to ".$fault_generatedby["email"],				"frn" =>"Sent Back",				"frnstatus" =>10,			);			$affected_rows = $this->elog_model->sentBackFaultReport($data);

}

}

	public function notfound(){
		$viewData = array();
		$viewData["error_msg"] = "This url was not found on the server.";
		$this->load->view("header",array("page"=>"File Not Found"));
		$this->load->view("error_view",$viewData);
		$this->load->view("footer");
	}
	
	public function recordDashboardStatistics(){
		$this->base_model->recordDashboardStatistics($_POST);
	}

	public function d1(){
		$d1 = $this->base_model->getVisitors();
		foreach($d1 as $key=>$row){
			$d1[$row["cdate"]] = $row["count"];
			unset($d1[$key]);
		}
		print(json_encode($d1));
		
	}
	public function d2(){
		$d1 = $this->base_model->getRegistrations();
		foreach($d1 as $key=>$row){
			$d1[$row["cdate"]] = $row["count"];
			unset($d1[$key]);
		}
		print(json_encode($d1));
 		
 	}
	
	public function userroles(){
		$viewData = array();
		$viewData["agentroles"] = $this->user_model->getUserRoles();
		$this->load->view("header_mat",array("page"=>"User Roles"));
		$this->load->view("userroles",$viewData);
		$this->load->view("footer_mat");
	}
	public function units(){
		$viewData = array();
		$viewData["units"] = $this->user_model->getUnits();
		$this->load->view("header_mat",array("page"=>"Units"));
		$this->load->view("units",$viewData);
		$this->load->view("footer_mat");
	}
	public function users(){
		/* Set ordering of the dealers list */
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
																			"users_filter"=>array(
																															"agentrole"=>$_POST["agentrole"],
																															"agentunit"=>$_POST["agentunit"],
																															"company"=>$_POST["company"],
																															"designation"=>$_POST["designation"],
																															"nationality"=>$_POST["nationality"],
																															"agentname"=>$_POST["agentname"],
																															)
																			)
																		);
			}
			if(isset($_POST["al-filter-reset"])){
				$this->session->set_userdata(array(
																			"users_filter"=>array(
																															"agentrole"=>"",
																															"agentunit"=>"",
																															"company"=>"",
																															"designation"=>"",
																															"nationality"=>"",
																															"agentname"=>"",
																															)
																			)
																		);
			}
		}else if(empty($order)){
			$this->session->set_userdata(array("order"=>"desc"));		
		}
		$order = $this->session->userdata("order");
		/* Set ordering of the dealers list */
		
		/* Set the pagination of the list */
		$this->load->library("pagination");
		$per_page = 15;
		$config['base_url'] = base_url().'index/users/';
		$config['uri_segment'] = '3';
		$users_filter = $this->session->userdata("users_filter");
		$total = $this->user_model->count_users($users_filter);  //total records

		$viewData = array();
		$viewData["userroles"] = $this->user_model->getAllUserRoles();
		$viewData["nationalities"] = $this->user_model->getAllNationalities();
		$viewData["designations"] = $this->user_model->getAllDesignations();
		$viewData["companies"] = $this->user_model->getAllCompanies();
		$viewData["units"] = $this->user_model->getAllUnits();
			//get dealers records.
		$viewData["users"] = $this->user_model->getAllUsersAdmin($per_page, $this->uri->segment(3),$users_filter);
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
		$viewData["pagination_links"] = $this->pagination->create_links();
		/* Set the pagination of the list */
		$viewData["users_filter"] = $users_filter;
		$this->load->view("header_mat",array("page"=>"Users List"));
		$this->load->view("users",$viewData);
		$this->load->view("footer_mat");
		
	}
	
	public function insertRole(){
		
		$check_role = $this->user_model->getRole($_POST);
		if(!empty($check_role)){
			print("User role already exists.");
		}else{
			$insert_id = $this->user_model->insertRole($_POST["role"]);
			if(!empty($insert_id) && ($insert_id != 0)){
				print("success");
			}else{
				print("Some error occurred please try again later.");
			}		
		}
	}
	public function insertUnit(){
		
		$check_unit = $this->user_model->getUnit($_POST);
		if(!empty($check_unit)){
			echo("Unit already exists.");
		}else{
			$insert_id = $this->user_model->insertUnit($_POST);
			if(!empty($insert_id) && ($insert_id != 0)){
				echo("success");
				
			}else{
				echo("Some error occurred please try again later.");
			}		
		}
	}
	
	public function activateRole(){
		
		$affected_rows = $this->user_model->activateRole($_POST);
		if(!empty($affected_rows) && ($affected_rows != 0)){
			print("success");
		}else{
			print("Some error occurred please try again later");
		}
	}
	public function activateUser(){
		
		$affected_rows = $this->user_model->activateUser($_POST);
		if(!empty($affected_rows) && ($affected_rows != 0)){
			print("success");
		}else{
			print("Some error occurred please try again later");
		}
	}
	public function activateUnit(){
		
		$affected_rows = $this->user_model->activateUnit($_POST);
		if(!empty($affected_rows) && ($affected_rows != 0)){
			print("success");
		}else{
			print("Some error occurred please try again later");
		}
	}
	
	public function updateRole(){
	 
		$check_role = $this->user_model->getRole($_POST);
		if(!empty($check_role)){
			print("User role already exists.");
		}else{
			$affected_rows = $this->user_model->updateRole($_POST);
			
			if($affected_rows == 0){
				print("No changes detected");
			}else if(!empty($affected_rows) && ($affected_rows != 0)){
				print("success");
			}else{
				print("Some error occurred please try again later");
			}
		}
	}
	public function updateUnit(){
		
		$u_id = $_POST['u_id'];
		if(!empty($_POST['no_runway'])){
			$run = 1;
		}else{
			$run = 0;
		}
		$this->db->where("unit_id",$u_id);
		$this->db->update("units",array("unit"=>$_POST["unit"],"no_runway"=>$run));
		$this->db->affected_rows();
		
	
	}
	public function updateApprove(){
		$e_id = $_POST['e_id'];
		$this->db->where("id",$e_id);
		$data = array("frnstatus"=>12);
		if($this->db->update("fault_reporting",$data)){	
			return 'success';
		}else{
			
			return 'unsuccess';
		}
	}
	
	public function updateReject(){
		$e_id = $_POST['e_id'];
		$this->db->where("id",$e_id);
		$data = array("frnstatus"=>13);
		if($this->db->update("fault_reporting",$data)){	
			return 'success';
		}else{
			
			return 'unsuccess';
		}
	}
	public function equipClosed(){
		$e_id = $_POST['e_id'];
		$this->db->where("id",$e_id);
		$data = array("frnstatus"=>7);
		if($this->db->update("fault_reporting",$data)){	
			return 'success';
		}else{
			
			return 'unsuccess';
		}
	}
	
	public function permissions(){
		$viewData = array();
		$viewData["agentroles"] = $this->user_model->getUserRoles();
		$this->load->view("header_mat",array("page"=>"Permissios"));
		$this->load->view("permissions",$viewData);
		$this->load->view("footer_mat");
	}
	
	public function updatePermissions(){
		$role_id = $_POST["id"];
		unset($_POST["id"]);
		foreach($_POST as $key=>$value){
			$_POST[$key] = 1;
		}
		$permissions = serialize($_POST);
		$affected_rows = $this->user_model->updatePermissions($role_id,$permissions);
		if(trim($affected_rows) == 0){
			print("No changes detected.");
		}else if(empty($affected_rows)){
			print("The changes could not be updated");
		}else if(!empty($affected_rows) && ($affected_rows != 0)){
			print("permissions updated");
		}
		
	}
	
	public function addUser(){
		$viewData = array();
		$viewData["userroles"] = $this->user_model->getAllUserRoles();
		$viewData["nationalities"] = $this->user_model->getAllNationalities();
		$viewData["designations"] = $this->user_model->getAllDesignations();
		$viewData["companies"] = $this->user_model->getAllCompanies();
		$viewData["units"] = $this->user_model->getAllUnits();
		$this->load->view("header_mat",array("page"=>"New User Registration"));
		$this->load->view("addUser",$viewData);
		$this->load->view("footer_mat");
	}
	public function userprofile(){
		$user_id = $this->uri->segment(3);
		$viewData = array();
		$viewData["user_details"] = $this->user_model->getUserById($user_id);
		$viewData["userroles"] = $this->user_model->getAllUserRoles();
		$viewData["nationalities"] = $this->user_model->getAllNationalities();
		$viewData["designations"] = $this->user_model->getAllDesignations();
		$viewData["companies"] = $this->user_model->getAllCompanies();
		$viewData["units"] = $this->user_model->getAllUnits();
		$this->load->view("header_mat",array("page"=>"New User Registration"));
		$this->load->view("editUser",$viewData);
		$this->load->view("footer_mat");
	}
	public function editprofile(){
		$user_id = $this->uri->segment(3);
		$viewData = array();
		$viewData["user_details"] = $this->user_model->getUserById($user_id);
		$viewData["userroles"] = $this->user_model->getAllUserRoles();
		$viewData["nationalities"] = $this->user_model->getAllNationalities();
		$viewData["designations"] = $this->user_model->getAllDesignations();
		$viewData["companies"] = $this->user_model->getAllCompanies();
		$viewData["units"] = $this->user_model->getAllUnits();
		$this->load->view("header",array("page"=>"New User Registration"));
		$this->load->view("editUser",$viewData);
		$this->load->view("footer");
	}
	public function accessLogs(){
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
				"accesslogs_filter"=>array(
				"from"=>date('Y-m-d',strtotime($_POST["from"])),
			    "to"=>date('Y-m-d',strtotime($_POST["to"])),
				"keyword"=>$_POST["keyword"],
				"agentunit"=>$_POST["agentunit"]
				)
				));
			}
			
			if(isset($_POST["al-filter-reset"])){
				$this->session->set_userdata(array(
																			"accesslogs_filter"=>array(
																															"from"=>"",
																															"to"=>"",
																															"keyword"=>"",
																															"agentunit"=>""
																															)
																			)
																		);
			}
			
		}else if(empty($order)){
			$this->session->set_userdata(array("order"=>"desc"));		
		}
		$accesslogs_filter = $this->session->userdata("accesslogs_filter");
		
		$order = $this->session->userdata("order");
		$data = array();
		$this->load->library("pagination");
		$per_page = 20;
		$total = $this->elog_model->count_rec("access_logs");  //total post

		$data['logs'] = $this->elog_model->getAllAccessLogs($per_page, $this->uri->segment(3),$accesslogs_filter);
		$config['base_url'] = $this->config->item('base_url').'index/accessLogs/';
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
		$data["accesslogs_filter"] = $accesslogs_filter;
		$data["units"] = $this->user_model->getAllUnits();
		
		$this->load->view("header_mat",array("page"=>"Access Logs"));
		$this->load->view("accessLogs",$data);
		$this->load->view("footer_mat");
	}
	public function jobcard($id) {
		$_POST['id']= $id;
		$this->load->view("header_mat",array("page"=>"Job Card"));
	
		$viewData = array();
			$viewData["jobcat"] = $this->elog_model->getAllJobs();
		$viewData["Customers"] = $this->elog_model->getAllcust();
		$viewData["lru"] = $this->elog_model->getAlllru();
		$viewData["calibrationitem"] = $this->elog_model->getAllcalibrationitem();
		$viewData["system"] = $this->elog_model->getAllEquipments();
		
		$viewData["fault"] = $this->elog_model->getFaultReporting($_POST['id']);
		$viewData["freq"] = $this->elog_model->getAllfrequency($_POST['id']);

		
		$this->load->view("jobcard",$viewData);
			$this->load->view("footer_mat");

	}
	
		public function CancelFault() {
	
		$data["id"] =$_POST["id"];
		$this->load->view("canceljob",$data);
	
	}
	
	
	public function trnferfault() {

		$data["id"] =$_POST["id"];
		$data["section"] = $this->elog_model->getallotherSec();
		$this->load->view("trnferfault",$data);
	
	}
	
	
	
	
	
	public function jobcards() {
		$this->load->view("header",array("page"=>"Job Card"));
		$viewData = array();
		$viewData["jobcat"] = $this->elog_model->getAllJobs();
		$viewData["Customers"] = $this->elog_model->getAllcust();
		$viewData["lru"] = $this->elog_model->getAlllru();
		$viewData["calibrationitem"] = $this->elog_model->getAllcalibrationitem();
		$viewData["system"] = $this->elog_model->getAllEquipments();
		$this->load->view("jobcards",$viewData);
		$this->load->view("footer");	
	}
	public function listingpanel() {
	

		$data = array();
		$data["allusers"] = $this->user_model->getAllUsers();
		$data["equipments"] = $this->report_model->getAllEquipments();
		$data["positions"] = $this->report_model->getAllPositions();
		$data["consoleNumbers"] = $this->report_model->getAllConsoleNumbers();
		$data["frnstatuses"] = $this->emergency_model->getAllFrnStatuses();
		$data["units"] = $this->report_model->getAllUnits();

		$this->load->library("pagination");
		$config = array();
		$config["base_url"] = $this->config->item('base_url').'index/listingpanel';
		$total = $this->elog_model->count_recs("jobcard");  //total post
		$config["total_rows"] =$total;
		$config["per_page"] = 10;
        $config["uri_segment"] = 3;
		$config['total_rows'] = $total;
		
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$config['cur_tag_open'] = '<b> &nbsp;';
		$config['cur_tag_close'] = '</b>';
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config);
 
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		$data["data"] = $this->elog_model->getalljobcard($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		
		
	
    $data["total"] = $this->elog_model->count_recs("jobcard");
	
	
		$this->load->view("header_mat",array("page"=>"Listing Panel"));
		$this->load->view("listingpanel",$data);

		$this->load->view("footer_mat");
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */