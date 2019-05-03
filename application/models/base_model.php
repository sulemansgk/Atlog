<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base_model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}
	
	public function insertKeywords($data){
		if(isset($data["aircraft_operator"])){
			$res = $this->db->get_where("aircraftoperator",array("name"=>$data["aircraft_operator"]))->result_array();
			if(empty($res)){
				$this->db->insert("aircraftoperator",array("name"=>$data["aircraft_operator"]));
			}
		}
		if(isset($data["aircraft_type"])){
			$res = $this->db->get_where("aircrafttype",array("name"=>$data["aircraft_type"]))->result_array();
			if(empty($res)){
				$this->db->insert("aircrafttype",array("name"=>$data["aircraft_type"]));
			}
		}
		if(isset($data["callsign"])){
			$res = $this->db->get_where("callsign",array("name"=>$data["callsign"]))->result_array();
			if(empty($res)){
				$this->db->insert("callsign",array("name"=>$data["callsign"]));
			}
		}
		if(isset($data["any_other_details"])){
			$res = $this->db->get_where("anotherdetail",array("name"=>$data["any_other_details"]))->result_array();
			if(empty($res)){
				$this->db->insert("anotherdetail",array("name"=>$data["any_other_details"]));
			}
		}
		if(isset($data["destination"])){
			$res = $this->db->get_where("destination",array("name"=>$data["destination"]))->result_array();
			if(empty($res)){
				$this->db->insert("destination",array("name"=>$data["destination"]));
			}
		}
		if(isset($data["original_destination"])){
			$res = $this->db->get_where("destination",array("name"=>$data["original_destination"]))->result_array();
			if(empty($res)){
				$this->db->insert("destination",array("name"=>$data["original_destination"]));
			}
		}
		if(isset($data["new_destination"])){
			$res = $this->db->get_where("destination",array("name"=>$data["new_destination"]))->result_array();
			if(empty($res)){
				$this->db->insert("destination",array("name"=>$data["new_destination"]));
			}
		}
		if(isset($data["location"])){
			$res = $this->db->get_where("location",array("name"=>$data["location"]))->result_array();
			if(empty($res)){
				$this->db->insert("location",array("name"=>$data["location"]));
			}
		}
		if(isset($data["nature_of_accident"])){
			$res = $this->db->get_where("natureofaccident",array("name"=>$data["nature_of_accident"]))->result_array();
			if(empty($res)){
				$this->db->insert("natureofaccident",array("name"=>$data["nature_of_accident"]));
			}
		}
		if(isset($data["reason"])){
			$res = $this->db->get_where("reason",array("name"=>$data["reason"]))->result_array();
			if(empty($res)){
				$this->db->insert("reason",array("name"=>$data["reason"]));
			}
		}
		if(isset($data["runway_in_use"])){
			$res = $this->db->get_where("runwayinuse",array("name"=>$data["runway_in_use"]))->result_array();
			if(empty($res)){
				$this->db->insert("runwayinuse",array("name"=>$data["runway_in_use"]));
			}
		}
		if(isset($data["type_of_incident"])){
			$res = $this->db->get_where("typeofincident",array("name"=>$data["type_of_incident"]))->result_array();
			if(empty($res)){
				$this->db->insert("typeofincident",array("name"=>$data["type_of_incident"]));
			}
		}
		if(isset($data["position_name"])){
			$res = $this->db->get_where("positionname",array("name"=>$data["position_name"],"unit_id"=>$this->userdetails["agentunit"]))->result_array();
			if(empty($res)){
				$this->db->insert("positionname",array("name"=>$data["position_name"]));
			}
		}
		if(isset($data["console_number"])){
			$res = $this->db->get_where("consolenumber",array("name"=>$data["console_number"],"unit_id"=>$this->userdetails["agentunit"]))->result_array();
			if(empty($res)){
				$this->db->insert("consolenumber",array("name"=>$data["console_number"]));
			}
		}
		if(isset($data["system_equipment"])){
			$res = $this->db->get_where("system_equipment",array("name"=>$data["system_equipment"],"unit_id"=>$this->userdetails["agentunit"]))->result_array();
			if(empty($res)){
				$this->db->insert("system_equipment",array("name"=>$data["system_equipment"]));
			}
		}
		if(isset($data["purpose_of_release"])){
			$res = $this->db->get_where("purposeofrelease",array("name"=>$data["purpose_of_release"]))->result_array();
			if(empty($res)){
				$this->db->insert("purposeofrelease",array("name"=>$data["purpose_of_release"]));
			}
		}
		if(isset($data["dangerous_goods"])){
			$res = $this->db->get_where("dangerousgood",array("name"=>$data["dangerous_goods"]))->result_array();
			if(empty($res)){
				$this->db->insert("dangerousgood",array("name"=>$data["dangerous_goods"]));
			}
		}
		if(isset($data["point_of_departure"])){
			$res = $this->db->get_where("pointofdeparture",array("name"=>$data["point_of_departure"]))->result_array();
			if(empty($res)){
				$this->db->insert("pointofdeparture",array("name"=>$data["point_of_departure"]));
			}
		}
		if(isset($data["reason"])){
			$res = $this->db->get_where("reason",array("name"=>$data["reason"]))->result_array();
			if(empty($res)){
				$this->db->insert("reason",array("name"=>$data["reason"]));
			}
		}
	}
	
	public function getVisitors(){
		$this->db->select("count( * ) AS count, CAST( `cdate` AS DATE ) AS cdate");
		$this->db->from("dashboard_statistics");
		$this->db->group_by("CAST(  `cdate` AS DATE ) ");
		$this->db->order_by("cdate","asc");
		return $this->db->get()->result_array();
	}

	public function getRegistrations(){
		$this->db->select("count( * ) AS count, CAST( `cdate` AS DATE ) AS cdate");
		$this->db->from("tblagent");
		$this->db->group_by("cdate");
		$this->db->order_by("cdate","asc");
		return $this->db->get()->result_array();
	}
	
	public function recordDashboardStatistics($data){
		$data["cdate"] = date("Y-m-d H:i:s");
		$this->db->insert("dashboard_statistics",$data);
	}

	public function insertAccessLog($data){
		$data["unit_id"] = $this->userdetails["agentunit"];
		$this->db->insert("access_logs",$data);
		return $this->db->insert_id();
	}
}

?>