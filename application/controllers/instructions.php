<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class instructions extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("emergency_model");
		$this->load->model("base_model");
		$this->load->model("domain_model");
		$this->load->model("instructions_model");
		$this->load->library("session");
		$this->userdetails = $this->session->userdata("userdetails");
		if(empty($this->userdetails)){
			redirect(base_url());
		}
		$this->load->model("user_model");
		if(!empty($this->userdetails)){
			$this->userdetails["permissions"] = $this->user_model->getUserPermissions($this->userdetails["role_id"]);
		}
	}
	
	public function SupplementaryInstructions(){
		$data = array();
		$data["instructions"] = $this->instructions_model->getInstructions(1);
		$data["view"] = "Supplementary Instructions";
		$data["designations"] = $this->instructions_model->getAllDesignations();
		$data["instructionTypes"] = $this->instructions_model->getAllInstructionsTypes();
		$this->load->view("header_mat",array("page"=>"Supplementary Instructions"));
		$this->load->view("instructions-listing/Instructions_listing",$data);
		$this->load->view("footer_mat");				
	}
	public function TemporaryInstructions(){
		$data = array();
		$data["instructions"] = $this->instructions_model->getInstructions(2);
		$data["view"] = "Temporary Instructions";
		$data["designations"] = $this->instructions_model->getAllDesignations();
		$data["instructionTypes"] = $this->instructions_model->getAllInstructionsTypes();
		$this->load->view("header_mat",array("page"=>"Temporary instructions"));
		$this->load->view("instructions-listing/Instructions_listing",$data);
		$this->load->view("footer_mat");				
	}
	public function DatasetInstructions(){
		$data = array();
		$data["instructions"] = $this->instructions_model->getInstructions(3);
		$data["view"] = "Dataset Instructions";
		$data["designations"] = $this->instructions_model->getAllDesignations();
		$data["instructionTypes"] = $this->instructions_model->getAllInstructionsTypes();
		$this->load->view("header_mat",array("page"=>"Dataset Instructions"));
		$this->load->view("instructions-listing/Instructions_listing",$data);
		$this->load->view("footer_mat");				
	}
	public function NOTAMInstructions(){
		$data = array();
		$data["instructions"] = $this->instructions_model->getInstructions(4);
		$data["view"] = "NOTAM Instructions";
		$data["designations"] = $this->instructions_model->getAllDesignations();
		$data["instructionTypes"] = $this->instructions_model->getAllInstructionsTypes();
		$this->load->view("header_mat",array("page"=>"NOATM Instructions"));
		$this->load->view("instructions-listing/Instructions_listing",$data);
		$this->load->view("footer_mat");				
	}
	public function METInstructions(){
		$data = array();
		$data["instructions"] = $this->instructions_model->getInstructions(5);
		$data["view"] = "MET Instructions";
		$data["designations"] = $this->instructions_model->getAllDesignations();
		$data["instructionTypes"] = $this->instructions_model->getAllInstructionsTypes();
		$this->load->view("header_mat",array("page"=>"MET Instructions"));
		$this->load->view("instructions-listing/Instructions_listing",$data);
		$this->load->view("footer_mat");				
	}
	public function OtherInstructions(){
		$data = array();
		$data["instructions"] = $this->instructions_model->getInstructions(6);
		$data["view"] = "Other Instructions";
		$data["designations"] = $this->instructions_model->getAllDesignations();
		$data["instructionTypes"] = $this->instructions_model->getAllInstructionsTypes();
		$this->load->view("header_mat",array("page"=>"Other Instructions"));
		$this->load->view("instructions-listing/Instructions_listing",$data);
		$this->load->view("footer_mat");				
	}
	
	public function viewInstructions(){
		$instruction_type = str_replace("-"," ",$this->uri->segment(3));
		$instruction_type_id = $this->uri->segment(4);
		$data = array();
		$data["instructions"] = $this->instructions_model->getInstructions2($instruction_type_id);
		$data["view"] = "$instruction_type";
		$data["units"] = $this->user_model->getAllUnits();
		
		$data["designations"] = $this->instructions_model->getAllDesignations();
		$data["instructionTypes"] = $this->instructions_model->getAllInstructionsTypes();
		$this->load->view("header_mat",array("page"=>"Other Instructions"));
		$this->load->view("instructions-listing/Instructions_listing",$data);
		$this->load->view("footer_mat");				
	}
	
	public function addInstruction(){
		

      
		$explode =  explode("-",$_POST['publish_date']);
		$datee = date('Y-m-d',strtotime($explode[0]));
		
		$explode1 =  explode("-",$_POST['expiry_date']);
		$datee1 = date('Y-m-d',strtotime($explode1[0]));

        $_POST["publish_date"] = $datee;
        $_POST["expiry_date"] = $datee1;

        
		$_POST["issue_to"] = json_encode($_POST["issue_to"]);
		$view = $_POST["view"];
		unset($_POST["view"]);
		$instruction_files = array();
		if(!empty($_FILES)){
			if(trim($_FILES["files"]["name"][0]) != ""){
				foreach($_FILES["files"]["name"] as $key=>$fileName){
					
					$prof_image_name = $this->input->post("name")."-product-image-".$this->input->post("shop_name")."-".$fileName;

					$_FILES['currentFile']['name']    = preg_replace('/\s+/', '', $_FILES['files']["name"][$key]);
					
					$_FILES['currentFile']['type']    = $_FILES['files']["type"][$key];
					$_FILES['currentFile']['tmp_name']= $_FILES['files']["tmp_name"][$key];
					$_FILES['currentFile']['error']   = $_FILES['files']["error"][$key];
					$_FILES['currentFile']['size']    = $_FILES['files']["size"][$key];
					
					$this->load->library('upload');
					$config['upload_path'] = './assets/instruction_files/';
					$config['allowed_types'] = 'gif|jpg|png|doc|docx|pdf|tiff';
					$config['max_size']	= '10000000000000';
					$config['max_width']  = '10240000000';
					$config['max_height']  = '768000000000000';
					
					$config['remove_spaces']  = TRUE;
					$config['overwrite']  = FALSE;
					
				    
					 $this->upload->initialize($config);
					 
					  if ($this->upload->do_upload('currentFile'))
					  {
						$this->_uploaded[$fileName] = $this->upload->data();
					  }
					 
					if($_FILES['currentFile']['name']){
						$uploadData = $this->upload->data();
						
						$instruction_files[] = $_FILES['currentFile']['name'];
					}
				}
				
			}
			
			 
			if(!empty($instruction_files)){
				$_POST["files"] = json_encode($instruction_files);			
			}else{
				$_POST["files"] = "";
			}
		}
		$instruction_type_details = $this->domain_model->getInstructionTypeById($_POST["instruction_type"]);
		if($this->instructions_model->addyInstruction($_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Inserted instruction of type: <b>$instruction_type_details</b>.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	""
						);
			$this->base_model->insertAccessLog($acceslog_data);
			redirect("instructions/viewInstructions/".str_replace(" ","-",$instruction_type_details)."/".$_POST["instruction_type"]."/success");
		}else{
			redirect("instructions/viewInstructions/".str_replace(" ","-",$instruction_type_details)."/".$_POST["instruction_type"]."/error");
		}
	}
	
	public function editInstruction(){
		$viewData["designations"] = $this->instructions_model->getAllDesignations();
		$viewData["instructionTypes"] = $this->instructions_model->getAllInstructionsTypes();
		$rec = $this->instructions_model->getInstruction($_POST["id"]);
		
		$viewData["instruction"] = $rec[0];
		
		$this->load->view("instruction_edit",$viewData);
	}
	public function updateInstruction(){
		
		$explode =  explode("-",$_POST['publish_date']);
		$datee = date('Y-m-d',strtotime($explode[0]));
		
		$explode1 =  explode("-",$_POST['expiry_date']);
		$datee1 = date('Y-m-d',strtotime($explode1[0]));

        $_POST["publish_date"] = $datee;
        $_POST["expiry_date"] = $datee1;

        
		$prev_inst_type = $_POST["prev_inst_type"];
		unset($_POST["prev_inst_type"]);
		$inst_id = $_POST["inst_id"];
		$_POST["files"] = json_encode($_FILES);
		$_POST["issue_to"] = json_encode($_POST["issue_to"]);
		$view = $_POST["view"];
		unset($_POST["view"]);
		unset($_POST["inst_id"]);
		if(!empty($_FILES)){
			$instruction_files = array();
			if($_FILES["files"]["name"][0] != ""){
				foreach($_FILES["files"]["name"] as $key=>$fileName){
					
					$_FILES['currentFile']['name']    = $_FILES['files']["name"][$key];
					$_FILES['currentFile']['type']    = $_FILES['files']["type"][$key];
					$_FILES['currentFile']['tmp_name']= $_FILES['files']["tmp_name"][$key];
					$_FILES['currentFile']['error']   = $_FILES['files']["error"][$key];
					$_FILES['currentFile']['size']    = $_FILES['files']["size"][$key];
					$this->load->library('upload');
					$config['upload_path'] = './assets/instruction_files/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']	= '10000000000000';
					$config['max_width']  = '10240000000';
					$config['max_height']  = '768000000000000';
					
					$config['remove_spaces']  = TRUE;
					$config['overwrite']  = FALSE;
					$this->upload->initialize($config);
					 if ($this->upload->do_upload('currentFile'))
					  {
						$this->_uploaded[$fileName] = $this->upload->data();
					  }
					  
					if($_FILES['currentFile']['name']){
						$uploadData = $this->upload->data();
						
						$instruction_files[] = $_FILES['currentFile']['name'];
					}
				}
				$instruction_files = json_encode($instruction_files);
				$_POST["files"] = $instruction_files;
			}else{
			$_POST["files"] = '';
		}
			
		}else{
			$_POST["files"] = '';
		}
		$instruction_type_details = $this->domain_model->getInstructionTypeById($prev_inst_type);		
		if($this->instructions_model->updateInstruction($inst_id,$_POST)){
			$acceslog_data = array(
							"agentcode"		=>	$this->userdetails["agentcode"],
							"message"			=>	"Updated instruction of type: <b>$instruction_type_details</b>.",
							"log_datetime"=> 	date("Y-m-d H:i:s"),
							"form_log_id"	=>	$inst_id
						);
			$this->base_model->insertAccessLog($acceslog_data);
			
			if($_POST['instruction_type'] == 1){
				redirect("instructions/viewInstructions/Supplementary-Instructions/1");
			}elseif($_POST['instruction_type'] == 2){
				redirect("instructions/viewInstructions/Temporary-Instructions/2");
			}
		}else{
			print("error");
		}
	}
	public function deleteInstruction(){
		if($this->instructions_model->deleteInstruction($_POST["id"])){
			print("deleted");
		}else{
			print("error");
		}
	}
	
	public function readInstruction(){
		
		$rec = $this->instructions_model->getInstruction($_POST["id"]);
		
		$viewData["instruction"] = $rec[0];
		$viewData["instruction_type"] = $this->instructions_model->getInstructionTypeDetails($viewData["instruction"]["instruction_type"]);
		$viewData["designations"] = array();
		foreach(json_decode($viewData["instruction"]["issue_to"]) as $key=>$desig_id){
			$res = $this->instructions_model->getDesignation($desig_id);
			if(!empty($res)){
				$viewData["designations"][] = $res[0];
			}
		}
		
		$this->load->view("instruction_details",$viewData);
		
	}
	
	
	
		public function readacceptance_noti(){
		
		$rec = $this->instructions_model->getapctancenotis($_POST["id"]);
	
		$viewData["instruction"] = $rec[0];

	

		$this->load->view("aceptancedetails",$viewData);
		
	}
	
	
		public function AddIns(){
		$instruction_type = str_replace("-"," ",$this->uri->segment(3));
		$instruction_type_id = $this->uri->segment(4);
		$data = array();
		$data["instructions"] = $this->instructions_model->getInstructions2($instruction_type_id);
		$data["view"] = "$instruction_type";
		$data["units"] = $this->user_model->getAllUnits();
		$data["designations"] = $this->instructions_model->getAllDesignations();
		$data["instructionTypes"] = $this->instructions_model->getAllInstructionsTypes();
		$this->load->view("header_mat",array("page"=>"Add Instructions"));
		$this->load->view("instruc",$data);
		$this->load->view("footer_mat");
		
	     }
	
	
	
	
	public function readNotification(){
		$report = $this->instructions_model->getNotification($_POST["id"]);
		
		$viewData["report"] = $report[0];
		$viewData["notif_id"] = $_POST["notif_id"];
		
		$this->load->view("notification_details",$viewData);
	}
	public function updateATCReport(){
		
			$this->instructions_model->updateATCReport($_POST["equip_notif_id"]);
	
	}

	public function approveNotification(){

		if($this->instructions_model->approveNotification($_POST["notif_id"])){
			print("Successfully Updated.");
		}else{
			print("Some error occurred in approval please try later.");
		}
	}
	
	public function rejectNotification(){
		if($this->instructions_model->rejectNotification($_POST["notif_id"])){
			print("Successfully Updated.");
		}else{
			print("Some error occurred please try later.");
		}
	}
	
	public function recordRead(){
		$_POST["datetime"] = date("Y-m-d H:i:s");
		
		if($this->instructions_model->recordRead($_POST)){
			print("success");
		}else{
			print("error");
		}
		
	}
	
	
	public function aceptRead(){
	
		
		$rec = $this->instructions_model->setapctancenotis($_POST["id"]);
		
		
		
		$_POST["datetime"] = date("Y-m-d H:i:s");
	
		if($this->instructions_model->aceptRead($_POST)){
			print("success");
		}else{
			print("error");
		}
		
	}
	
	
	public function getApprovedNotifications(){
	
		$res = $this->instructions_model->getApprovedNotifications_ajax($_POST);
		print(json_encode($res));
	}
	public function getATCNotifications(){
		
		$res = $this->instructions_model->getATCNotifications_ajax($_POST);
		print(json_encode($res));
	}
	public function getUnApprovedNotifications(){
		
		$res = $this->instructions_model->getUnApprovedNotifications_ajax($_POST);
		print(json_encode($res));
	}
	public function getInstructions(){
		$instructions = $this->instructions_model->getInstructions_ajax($_POST);
		$readInstructions = array();
		$unReadInstructions = array();
		$i = 0;
		foreach($instructions as $key=>$inst){
			$InstTack = $this->instructions_model->getInstTack($inst["id"],$this->userdetails["agentcode"]);
			if(!empty($InstTack)){
				
				$readInstructions[$i] = $instructions[$key];
				$readInstructions[$i]["track"] = $InstTack[0];
				$i++;
				continue;
			}else{
				$unReadInstructions[] = $inst;
			}
		}
		print(json_encode($unReadInstructions));
	}
	
}