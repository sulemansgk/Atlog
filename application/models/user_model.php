<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}
	
	public function authenticate_user($creds){
		 // fetch by username first
	     $this->db->where('agentname', $creds['agentname']);
	     $query = $this->db->get("tblagent");
	     $result = $query->result_array(); // get the row first
		 if($result[0]['agentactive'] == 1){
			  return false;
		 }else{
			  $check = hash_equals($result[0]['agentpassword'], crypt($creds['agentpassword'], $result[0]['agentpassword']));
		  if (!empty($check) && !empty($result)) {
			
	        return $result;
	      }else{
	        return false;
	       }
		}
	}
	
	public function updateLastAccess($agentcode){
		$this->db->where("agentcode",$agentcode);
		$this->db->update("tblagent",array("last_access"=>date("Y-m-d H:i:s")));
	}

	public function getUserRole($roleId){
		$res = $this->db->get_where("agentroles",array("id"=>$roleId))->result_array();
		if(!empty($res)){
			return $res[0];
		}else{
			return array();
		}
	}
	
	public function getAllUsers(){
		return $this->db->get("tblagent")->result_array();
	}

	public function getallevents($id){
		return $this->db->get_where("addevent",array("jobcard"=>$id))->result_array(); 
	}

	public function getUnitUsers(){
		if($this->userdetails["agentrole"] != 1){
			$units = unserialize($this->userdetails["agentunit"]);
			$units_size = sizeof($units);
			$this->db->like("agentunit",'"'.$units[0].'"');
			if($units_size > 1){
				for($i = 1; $i < $units_size; $i++){
					$this->db->or_like("agentunit",'"'.$units[$i].'"');			
				}
			}		
		}
		$this->db->where("agentcode != ",$this->userdetails["agentcode"]);
		return $this->db->order_by('agentname','asc')->get_where('tblagent',array('agentactive' => 0))->result_array();
		
	}

	public function getAllUserRoles(){
		return $this->db->get("agentroles")->result_array();
	}

	public function getAllUnits(){
		return $this->db->get("units")->result_array();
	}

	public function getRole($data){
		if(isset($data["id"])){
			$this->db->where("id !=",$data["id"]);
		}
		$this->db->where("role",$data["role"]);
		$res = $this->db->get("agentroles")->result_array();
		
		return $res;
	}
	
	public function getUnit($data){
		if(isset($data["unit_id"])){
			$this->db->where("unit_id !=",$data["unit_id"]);
		}
		$this->db->where("unit",$data["unit"]);
		$res = $this->db->get("units")->result_array();
		return $res;
	}

	public function getAllNationalities(){
		return $this->db->get("nationality")->result_array();
	}

	public function getAllDesignations(){
		return $this->db->get("designation")->result_array();
	}

	public function getAllCompanies(){
		return $this->db->get("company")->result_array();
	}
	
	public function registerUser($data){
		$data['agentpassword'] = crypt($data['agentpassword']);
		$this->db->insert("tblagent",$data);
		return $this->db->insert_id();
	}
	
	private function hash_password($password){
   		return password_hash($password, PASSWORD_BCRYPT);
    }
	
	public function check_user($agentname){
		$res = $this->db->get_where("tblagent",array("agentname"=>$agentname))->result_array();
		return $res;

	}
	
	public function getUserRoles(){
		return $this->db->get("agentroles")->result_array();
	}

	public function getUnits(){
		return $this->db->get("units")->result_array();
	}

	public function insertRole($role){
		$this->db->insert("agentroles",array("role"=>$role));
		return $this->db->insert_id();
	}

	public function insertUnit($data){
		if ($data['no_runway'] == 'on') {
			$this->db->insert("units",array("unit"=>$data["unit"],"no_runway"=>1));
		} else{
			$this->db->insert("units",array("unit"=>$data["unit"],"no_runway"=>0));
		}
		return $this->db->insert_id();
	}
	
	public function activateRole($data){
		$this->db->where("id",$data["id"]);
		$this->db->update("agentroles",array("active"=>$data["active"]));
		return $this->db->affected_rows();
	}

	public function activateUser($data){
		$this->db->where("agentcode",$data["agentcode"]);
		$this->db->update("tblagent",array("agentactive"=>$data["agentactive"]));
		return $this->db->affected_rows();
	}

	public function activateUnit($data){
		$this->db->where("unit_id",$data["unit_id"]);
		$this->db->update("units",array("active"=>$data["active"]));
		return $this->db->affected_rows();
	}

	public function updateRole($data){
		$this->db->where("id",$data["id"]);
		$this->db->update("agentroles",array("role"=>$data["role"]));
		return $this->db->affected_rows();
	}

	public function updateUnit($data){
		$this->db->where("unit_id",$data["unit_id"]);
		$this->db->update("units",array("unit"=>$data["unit"],"no_runway"=>$data['no_runway']));
		return $this->db->affected_rows();
	}

	public function updatePermissions($role_id,$permissions){
		$this->db->where("id",$role_id);
		$this->db->update("agentroles",array("rights"=>$permissions));
		return $this->db->affected_rows();
	}
	
	public function getUserPermissions($role_id){
		$this->db->select("rights");
		$res = $this->db->get_where("agentroles",array("id"=>$role_id))->result_array();
		if(empty($res)){
			return array();
		}else{
			return unserialize($res[0]["rights"]);
		}
	}
	
	public function getAllUsersAdmin($limit=NULL, $offset=NULL,$users_filter){
		if(!empty($users_filter)){
			if(!empty($users_filter["agentrole"])){
				$this->db->where("agentrole",$users_filter["agentrole"]);							
			}
			if(!empty($users_filter["agentunit"])){
				$this->db->like("agentunit",'"'.$users_filter["agentunit"].'"');
			}
			if(!empty($users_filter["company"])){
				$this->db->where("company",$users_filter["company"]);							
			}
			if(!empty($users_filter["designation"])){
				$this->db->where("designation",$users_filter["designation"]);
			}
			if(!empty($users_filter["nationality"])){
				$this->db->where("nationality",$users_filter["nationality"]);							
			}
			if(!empty($users_filter["agentname"])){
				$this->db->like("agentname",$users_filter["agentname"]);							
			}
		}
		$this->db->limit($limit, $offset);
		$order = $this->session->userdata("order");
		$this->db->join("agentroles","agentroles.id=tblagent.agentrole");
		$this->db->order_by("agentcode",$order);
		$res = $this->db->get("tblagent")->result_array();
		if(!empty($res)){
			return $res;
		}else{
			return array();
		}
	}

	public function getUserById($user_id){
		$this->db->join("agentroles","agentroles.id=tblagent.agentrole");
		$this->db->where("agentcode",$user_id);
		$res = $this->db->get("tblagent")->result_array();
		if(!empty($res)){
			return $res[0];
		}else{
			return array();
		}
	}

	public function updateUser($user_id,$updateData){
		$updateData['agentpassword'] = crypt($updateData['agentpassword']);
		$this->db->where("agentcode",$user_id);
		$this->db->update("tblagent",$updateData);
		return $this->db->affected_rows();
	}

	public function count_users($users_filter){
		if(!empty($users_filter)){
			if(!empty($users_filter["agentrole"])){
				$this->db->where("agentrole",$users_filter["agentrole"]);							
			}
			if(!empty($users_filter["agentunit"])){
				$this->db->like("agentunit",'"'.$users_filter["agentunit"].'"');							
			}
			if(!empty($users_filter["company"])){
				$this->db->where("company",$users_filter["company"]);							
			}
			if(!empty($users_filter["designation"])){
				$this->db->where("designation",$users_filter["designation"]);							
			}
			if(!empty($users_filter["nationality"])){
				$this->db->where("nationality",$users_filter["nationality"]);							
			}
			if(!empty($users_filter["agentname"])){
				$this->db->like("agentname",$users_filter["agentname"]);							
			}
		}
		return $this->db->get("tblagent")->num_rows();
	}
	
}

?>