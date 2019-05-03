
<?php date_default_timezone_set('America/New_York');?>
<script type="text/javascript">
setTimeout(function(){
window.location.reload(1);
}, 2400000);
</script>
<style>
	.success{
		color: #45B6AF;
	}
	.danger{
		color: #F3565D;
	}
	.info{
		color: #89C4F4;
	}
	
/* Style the header */
.header {
padding: 10px 16px;

color: #f1f1f1;
}
/* Page content */
.content {
padding: 16px;
}
/* The sticky class is added to the header with JS when it reaches its scroll position */
.sticky {
position: fixed;
top: 60px;
width: 100%;
z-index:9995;
}
@media only screen and (max-width: 2000px) {
	.sticky {
		position: static;
}
}
body{
	margin: 0;
}
/* Add some top padding to the page content to prevent sudden quick movement (as the header gets a new position at the top of the page (position:fixed and top:0) */
.sticky + .content {
padding-top: 10%;
}
</style>
<?php
	$user_logged = $this->userdetails["agentunit"];
	$user_unit = unserialize($user_logged);
	$frm_logs = $this->db->order_by("id","desc")->get_where('form_logs', array('log_type' => 'Fault Reporting'))->result_array();
		$q = 0;
		$total_open_faults1 = 0;
		$total_closed_faults1 = 0;
		foreach ($frm_logs as $f) {
			
		$a = unserialize($f['unit_id']);
	$result = array_intersect($user_unit,$a);
		if(!empty($result)){
			
			$records = $this->db->order_by("id","desc")->get_where('fault_reporting', array('id' => $f['log_id'],'subject' => 'Fault Reporting'))->num_rows();
			$total_open_faults = $this->db->order_by("id","desc")->get_where('fault_reporting', array('id' => $f['log_id'],'frnstatus' => 14))->num_rows();
			$total_closed_faults = $this->db->order_by("id","desc")->get_where('fault_reporting', array('id' => $f['log_id'],'subject' => 'Fault Reporting','frnstatus' => 7))->num_rows();
if(!empty($records)){
				
				$q += 1;
				
			}
			if(!empty($total_open_faults)){
				
				$total_open_faults1 += 1;
			}
			if(!empty($total_closed_faults)){
				
				$total_closed_faults1 += 1;
			}
		}
		
		
		
		}
		$ins_count = 0;
	foreach ($user_unit as $unit) {
			$ins = $this->db->order_by("id","desc")->get_where('instructions', array('unit_id' => $unit))->num_rows();
			if (!empty($ins)) {
				$ins_count += $ins;
			}
			
			}
	/* Activity % */
	$this->db->select("device_category,count(*) as count");
	$this->db->from("dashboard_statistics");
	$this->db->group_by("device_category");
	$this->db->order_by("count","desc");
	$this->db->limit(6,0);
	$device_access = $this->db->get()->result_array();
	foreach($device_access as $key=>$row){
		$device_access[$row["device_category"]] = array($row["device_category"]=>$row["device_category"],"count"=>$row["count"]);
		unset($device_access[$key]);
	}
	if(!empty($device_access)){
		if(isset($device_access["Desktop"]) && !isset($device_access["Mobile"])){
			$device_access["Desktop"]["percent"] = 100;
				$device_access["Mobile"]["percent"] = 0;
		}else if(!isset($device_access["Desktop"]) && isset($device_access["Mobile"])){
			$device_access["Mobile"]["percent"] = 100;
			$device_access["Desktop"]["percent"] = 0;
		}else if(isset($device_access["Desktop"]) && isset($device_access["Mobile"])){
			$total = $device_access["Desktop"]["count"] + $device_access["Mobile"]["count"];
			$device_access["Desktop"]["percent"] = $device_access["Desktop"]["count"]/$total*100;
			$device_access["Mobile"]["percent"] = $device_access["Mobile"]["count"]/$total*100;
		}else{
			$device_access["Desktop"]["percent"] = 0;
					$device_access["Mobile"]["percent"] = 0;
		}
	}else{
		$device_access["Desktop"] = array();
				$device_access["Mobile"] = array();
		$device_access["Desktop"]["percent"] = 0;
				$device_access["Mobile"]["percent"] = 0;
	}
	$user = $this->userdetails['agentcode'];
	/* Total Faults */
	$this->db->where("subject","Fault Reporting");
	$this->db->where("initial",$user);
	$total_faults = $this->db->get("fault_reporting")->num_rows();
	
	
	/* Total Faults previous month */
	$this->db->where("datetime >= '".date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")."- 30 days"))."'");
	$total_faults_prev_month = $this->db->get("fault_reporting")->num_rows();
	
	/* Total Open Faults */
	
	/* Total Closed Faults */
	
	/* Total Logs */
	$total_logs = $this->db->get("form_logs")->num_rows();
	
	/* Total Logs previous month */
	$this->db->where("datetime >= '".date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")."- 30 days"))."'");
	$total_logs_prev_month = $this->db->get("form_logs")->num_rows();
	
	/* Total Logs last week*/
	$this->db->where("datetime >= '".date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")."- 7 days"))."'");
	$total_logs_lastweek = $this->db->get("form_logs")->num_rows();
	
	
	/* Total Suplementary Instructions*/
	$this->db->where("instruction_type",1);
	$total_si = $this->db->get("instructions")->num_rows();
	/* Total Data set instructions*/
	$this->db->where("instruction_type",3);
	$total_di = $this->db->get("instructions")->num_rows();
	
	/* Total Temporary Instructions*/
	$this->db->where("instruction_type",2);
	$total_ti = $this->db->get("instructions")->num_rows();
	
	/* Total NOATM Instructions*/
	$this->db->where("instruction_type",4);
	$total_noatm = $this->db->get("instructions")->num_rows();
	
	/* Total MET Instructions*/
	$this->db->where("instruction_type",5);
	$total_met = $this->db->get("instructions")->num_rows();
	
	/* Total Other Instructions*/
	$this->db->where("instruction_type",5);
	$total_other_inst = $this->db->get("instructions")->num_rows();
	
	/* Total Instructions */
	$total_instructions = $this->db->get("instructions")->num_rows();
	/* Total Instructions previous month */
	$this->db->where("creation_date >= '".date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")."- 30 days"))."'");
	$total_instructions_prev_month = $this->db->get("instructions")->num_rows();
		
	$total_units  = $this->db->query("SELECT * FROM units WHERE no_runway = 0");
	
	$subject = $this->db->query("SELECT * FROM subjectform");
	$user_logged = $this->userdetails["agentcode"];
	$aman = $this->db->order_by("id","desc")->get_where('generalentry', array('subject' => 1,'initial' => $user_logged))->row();
$instructions = $this->instructions_model->getInstructions("all");
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
?>
<!-- BEGIN HEADER -->
<!-- END SIDEBAR -->
<div class='row'>
	<div class='col-md-4'>
		<!-- BEGIN PAGE HEAD -->
		<div class="page-head">
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				<h1>Home</h1>
			</div>
			<!-- END PAGE TITLE -->
			<!-- BEGIN PAGE TOOLBAR -->
			
			<!-- END PAGE TOOLBAR -->
		</div>
		<!-- END PAGE HEAD -->
		<!-- BEGIN PAGE BREADCRUMB -->
	</div>
	<div class='col-md-4'>
		<!-- BEGIN PAGE HEAD -->
		<div class="page-head header" id='Myid1'>
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				
				<span id="date_time" style="color: #9eacb4;font-size: 13px;font-weight: 400;"></span>
				
			</div>
			<!-- END PAGE TITLE -->
			<!-- BEGIN PAGE TOOLBAR -->
			
			<!-- END PAGE TOOLBAR -->
		</div>
		<!-- END PAGE HEAD -->
		<!-- BEGIN PAGE BREADCRUMB -->
	</div>
	<div class='col-md-4'>
		<!-- BEGIN PAGE HEAD -->
		<div class="page-head header" id='Myid'>
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title " >
				<span style="color: #9eacb4;font-size: 13px;font-weight: 400;">Last Access: <?=date("d M Y, h:i a",strtotime($this->userdetails["last_access"]))?> <br> User Logged as  <b><?=strtoupper($this->userdetails["role"]);?></b></span>
			</div>
			<!-- END PAGE TITLE -->
			<!-- BEGIN PAGE TOOLBAR -->
			
			<!-- END PAGE TOOLBAR -->
		</div>
		<!-- END PAGE HEAD -->
		<!-- BEGIN PAGE BREADCRUMB -->
	</div>
</div>

<ul class="page-breadcrumb breadcrumb hide">
	<li>
		<a href="javascript:;">Home</a><i class="fa fa-circle"></i>
	</li>
	<li class="active">
		Dashboard
	</li>
</ul>
<!-- END PAGE BREADCRUMB -->
<!-- BEGIN PAGE CONTENT INNER -->
<div class="row margin-top-10">
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<div class="display" style="margin-bottom: 0">
				<div class="number">
					<h3 class="font-purple-soft"><?=$q?></h3>
					<small>Total Faults</small>
				</div>
				<div class="icon">
					<i class="fa fa-exclamation-circle"></i>
				</div>
			</div>
			<div class="progress-info">
				
				<div class="status">
					<div class="status-title">
						Total Open Faults:
					</div>
					<div class="status-number">
						<?=$total_open_faults1?>
					</div>
				</div>
			</div>
			<div class="progress-info">
				
				<div class="status">
					<div class="status-title">
						Total Closed Faults:
					</div>
					<div class="status-number">
						<?=$total_closed_faults1?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<div class="display">
				<div class="number">
					<h3 class="font-purple-soft"><?=$ins_count?></h3>
					<small>Instructions</small>
				</div>
				<div class="icon">
					<i class="fa fa-pencil-square-o"></i>
				</div>
			</div>
			<div class="progress-info">
				
				<div class="status">
					<div class="status-title">
						Unread Instructions:
					</div>
					<div class="status-number">
						<?=sizeof($unReadInstructions)?>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?
	if(isset($this->userdetails["permissions"]["ViewAMANDashboard"]) || ($this->userdetails["role"] == "admin")){
	?>
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
		<div class="dashboard-stat2">
			<div class="display">
				<div class="number">
					<h3 class="font-purple-soft">AMAN</h3>
					<small>latest record</small>
				</div>
				<div class="icon">
					<i class="fa fa-book"></i>
				</div>
			</div>
			<div class="progress-info">
				<div class="status">
					<div class="status-title">
						<?=$aman->description?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?}?>
	
</div>

<?
if(isset($this->userdetails["permissions"]["View_Runways"]) || ($this->userdetails["role"] == "admin")){
if (!empty($total_units)) { ?>
<div class="page-head">
	<div class="page-title">
		<h1>Runways</h1>
	</div>
</div>
<div class="row margin-top-10">
	<? foreach ($total_units->result() as $row2){
	$unit_name = $this->db->get_where('units', array('unit_id' => $row2->unit_id))->row();
	$unit_rwy = $this->db->order_by("id","desc")->get_where('rwy', array('unit_id' => $row2->unit_id))->row();
	$arr_rwy = $this->db->get_where('runway',array('runway_id' =>$unit_rwy->runway_in_use))->row();
	$dep_rwy = $this->db->get_where('runway',array('runway_id' =>$unit_rwy->runway_in_use_depart))->row();
	
	?>
	<? foreach ($user_unit as $unit) {
	if ($unit == $row2->unit_id) {
	if(isset($this->userdetails["permissions"]["Add_Runways"]) || ($this->userdetails["role"] == "admin")){
	?>
	<a href="#" data-toggle="modal" data-target="#rwy">
		<? 	} }	 } ?>
		
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="dashboard-stat2">
				<div class="display">
					<div class="number">
						<? if ($unit_rwy->unit_id > 0) { ?>
						<h3 class="font-red-thunderbird"><?=$row2->unit?></h3>
						<small class="font-red-thunderbird">Runway Used</small>
						<? } else {?>
						<h3 class="font-green-sharp"><?=$row2->unit?></h3>
						<small class="font-green-sharp">Runway Unused</small>
						<? } ?>
					</div>
					<div class="icon">
						<? if ($unit_rwy->unit_id > 0) { ?>
						<i class="fa fa-road font-red-thunderbird"></i>
						<? } else {?>
						<i class="fa fa-road font-green-sharp"></i>
						<? } ?>
					</div>
					
				</div>
				<div class="progress-info">
					
					<div class="status">
						<div class="status-title">
							Arrival:
						</div>
						<div class="status-number">
							<?=$arr_rwy->runway?>
						</div>
					</div>
				</div>
				<div class="progress-info">
					
					<div class="status">
						<div class="status-title">
							Departure:
						</div>
						<div class="status-number">
							<?=$dep_rwy->runway?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</a>
	<? } ?>
</div>
<? } }?>
<?
if(isset($this->userdetails["permissions"]["ViewMETCondition"]) || ($this->userdetails["role"] == "admin")){
if (!empty($total_units)) { ?>
<div class="page-head">
	<div class="page-title">
		<h1>MET Conditions</h1>
	</div>
</div>
<div class="row margin-top-10">
	<? foreach ($total_units->result() as $row2){
	$unit_name = $this->db->get_where('units', array('unit_id' => $row2->unit_id))->row();
	$unit_rwy = $this->db->order_by("id","desc")->get_where('rwy', array('unit_id' => $row2->unit_id))->row();
	$met = $this->db->order_by("id","desc")->get_where('met_condition',array('unit_id' => $row2->unit_id,'no_runway' => 0))->row();
	?>
	<? foreach ($user_unit as $unit) {
	if ($unit == $row2->unit_id) {
	if(isset($this->userdetails["permissions"]["Add_METCondition"]) || ($this->userdetails["role"] == "admin")){
	?>
	<a href="#" data-toggle="modal" data-target="#met">
		<? 	}	} } ?>
		
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="dashboard-stat2">
				<div class="display">
					<div class="number">
						<h3 class="font-green-sharp"><?=$row2->unit?></h3>
					</div>
					<div class="progress-info">
						
						<div class="status">
							<div class="status-title font-green-sharp" style="font-size: 13px">
								Met Condition:
							</div>
							<div class="status-number font-green-sharp" style="font-size: 13px">
								<?=$met->condition?>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</a>
	<? } ?>
</div>
<? } }?>

<div class="row margin-top-10">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title tabbable-line">
				<div class="caption" style="width: 100%">
					<i class="icon-globe font-dark hide"></i>
					<span class="caption-subject font-dark bold uppercase">E-log Main view</span>
					<?
					if(isset($this->userdetails["permissions"]["add_fault_reporting"]) || ($this->userdetails["role"] == "admin")){
					?>
					<a href="#" data-toggle="modal" data-target="#fault" class="btn btn-info" style="float: right;">Fault Reporting</a>
					<?
					}
					?>
					<?
					if(isset($this->userdetails["permissions"]["add_generalentry_logs"]) || ($this->userdetails["role"] == "admin")){
					?>
					<a href="#" data-toggle="modal" data-target="#gen" class="btn btn-info" style="float: right;margin-right: 10px"> General Entry</a>
					<?
					}
					?>
					
				</div>
			</div>
			<div class="portlet-body" style="overflow-y: auto;max-height: 600px">
				<!--BEGIN TABS-->
				
				<ul class="feeds">
					<?
					foreach($logs as $key=>$log){
					$subject = "";
					if($log["log_type"] == "generalentry"){
					$subject_details = $this->db->get_where("subjectform",array("id"=>trim($log["details"]["subject"])))->result_array();
					if(!empty($subject_details)){
					$subject = $subject_details[0]["subject"];
					}
					}else{
					if(isset($log["details"]["type_of_incident"])){
					$subject = $log["details"]["type_of_incident"];
					}else if(isset($log["details"]["subject"])){
					$subject = $log["details"]["subject"];
					}
					}
					$date_search = date('Y-m-d',strtotime($_GET['date']));
					$time_search = date('H:i:s',strtotime($_GET['time']));
					?>
					<li>
						<div class="col1" <?php if (isset($log["details"]["action_perfomed"])){if($log["details"]["action_perfomed"] == 1){ echo 'style="background: rgba(255, 0, 0, 0.46);"' ;}if($log["details"]["frnstatus"] == 7){ echo 'style="background: green;color:white;"' ;}if($log["details"]["frnstatus"] == 14 || $log["details"]["frnstatus"] == 12){ echo 'style="background: yellow;"' ;}if($log["details"]["frnstatus"] == 13){ echo 'style="background: pink;"' ;}
							if($log["details"]["action_perfomed"] == 3){ echo 'style="background: rgba(255, 255, 0, 0.57);"' ;}if($log["details"]["action_perfomed"] == 4){ echo 'style="background: rgba(46, 81, 190, 0.57);"' ;}}?> onclick="<?=strtolower(str_replace("(","",str_replace(")","",str_replace(" ","",$log["log_type"]))))?>(<?=$log["log_id"]?>,this,'<?=$subject?>',false)">
							<div class="cont">
								<div class="cont-col1">
									<i class="fa fa-circle success" style="padding: 6px"></i>
								</div>
								<div class="cont-col2">
									<div class="desc">
										<b>Entry On</b> <? print $subject; ?>,
										<b>Description</b> <?
										if($log["log_table"] == "rwy"){
										
										if(!empty($log["details"]["runway_in_use"] || $log["details"]["runway_in_use_depart"])){
										$runway_in_use2 = $this->db->get_where("runway",array("runway_id"=>$log["details"]["runway_in_use"]))->result_array();
										$runway_in_use_depart = $this->db->get_where("runway",array("runway_id"=>$log["details"]["runway_in_use_depart"]))->result_array();
										echo "Arrival Runway: ". $runway_in_use2[0]["runway"]. "<br>";
										echo "Departure Runway: ". $runway_in_use_depart[0]["runway"];
										}else{
										
										if($log["details"]["31R"] != "Not In Use"){
										print("31R: ".$log["details"]["31R"].",");
										}
										if($log["details"]["31L"] != "Not In Use"){
										print("31L: ".$log["details"]["31L"].",");
										}
										if($log["details"]["13R"] != "Not In Use"){
										print("13R: ".$log["details"]["13R"].",");
										}
										if($log["details"]["13L"] != "Not In Use"){
										print("13L: ".$log["details"]["13L"].",");
										}
										}
										}else if($log["log_table"] == "controlmobile"){
										$remarks = strip_tags($log["details"]["remarks"]);
										if(strlen($remarks) > 30){
										$remarks = substr($remarks,0,30).".........";
										}
										print("To/From: ".$log["details"]["to_from"]."<br /> Mobile Status: ".$log["details"]["control_mobile1"].$log["details"]["control_mobile2"]."<br />Remarks: ".$remarks);
										
										}else if($log["log_type"] == "No Show"){
										$name = "";
										if(!empty($log["details"]["name"])){
										$name = $this->db->get_where("tblagent",array("agentcode"=>$log["details"]["name"]))->result_array();
										$name = $name[0]["agentname"];
										}
										$shiftDuty = "";
										if(!empty($log["details"]["shift_duty"])){
										$shiftDuty = $this->db->get_where("shift",array("id"=>$log["details"]["shift_duty"]))->result_array();
										$shiftDuty = $shiftDuty[0]["shift"];
										}
										print("Name: ".$name."<br /> Shift Duty: ".$shiftDuty);
										}else if($log["log_type"] == "Late For Duty"){
										$name = "";
										if(!empty($log["details"]["name"])){
										$name = $this->db->get_where("tblagent",array("agentcode"=>$log["details"]["name"]))->result_array();
										$name = $name[0]["agentname"];
										}
										$lateDueTo = strip_tags($log["details"]["late_due_to"]);
										if(strlen($lateDueTo) > 30){
										$lateDueTo = substr($lateDueTo,0,30)."......";
										}
										print("Name: ".$name."<br /> Late Due To: ".$lateDueTo);
										}else if($log["log_type"] == "Sent Home"){
										$name = "";
										if(!empty($log["details"]["name"])){
										$name = $this->db->get_where("tblagent",array("agentcode"=>$log["details"]["name"]))->result_array();
										$name = $name[0]["agentname"];
										}
										$DueTo = strip_tags($log["details"]["absence_reason_details"]);
										if(strlen($DueTo) > 30){
										$DueTo = substr($DueTo,0,30)."......";
										}
										print("Name: ".$name."<br />Sent Home Time: ".$log["details"]["sent_home_time"]."<br /> Due To: ".$DueTo);
										}else if($log["log_type"] == "Unavailable For Duty"){
										$name = "";
										if(!empty($log["details"]["name"])){
										$name = $this->db->get_where("tblagent",array("agentcode"=>$log["details"]["name"]))->result_array();
										$name = $name[0]["agentname"];
										}
										$DueTo = strip_tags($log["details"]["absence_reason_details"]);
										if(strlen($DueTo) > 30){
										$DueTo = substr($DueTo,0,30)."......";
										}
										print("Name: ".$name."<br />First Day Of Unavailability: <br/>".$log["details"]["day_of_unavailibility"]."<br /> Due To: ".$DueTo);
										}else if($log["log_type"] == "Sickness For Duty"){
										$name = "";
										if(!empty($log["details"]["name"])){
										$name = $this->db->get_where("tblagent",array("agentcode"=>$log["details"]["name"]))->result_array();
										$name = $name[0]["agentname"];
										}
										$DueTo = strip_tags($log["details"]["absence_reason_details"]);
										if(strlen($DueTo) > 30){
										$DueTo = substr($DueTo,0,30)."......";
										}
										print("Name: ".$name."<br />Call Time: ".$log["details"]["call_time"]."<br />First Day Of Sickness: <br/>".$log["details"]["date_of_sickness"]."<br /> Due To: ".$DueTo);
										}else if($log["log_type"] == "Fitness Or Return For Duty"){
										$name = "";
										if(!empty($log["details"]["name"])){
										$name = $this->db->get_where("tblagent",array("agentcode"=>$log["details"]["name"]))->result_array();
										$name = $name[0]["agentname"];
										}
										$remarks = strip_tags($log["details"]["remarks"]);
										if(strlen($remarks) > 30){
										$remarks = substr($remarks,0,30)."......";
										}
										print("Name: ".$name."<br />First Date Of Duty: <br/>".$log["details"]["date_of_duty"]."<br /> Remarks: ".$remarks);
										}else{
										if(isset($log["details"]["any_other_details"])){
										print(strip_tags($log["details"]["any_other_details"]));
										}else if(isset($log["details"]["remarks"])){
										print(strip_tags($log["details"]["remarks"]));
										}else if(isset($log["details"]["description"])){
										print(strip_tags($log["details"]["description"]));
										}
										}
										?>,
										<b>Unit Comments</b> <? if(isset($log["details"]["actions"])){ print($log["details"]["actions"]); } ?>,
										<b>Management Comments</b> <? if(isset($log["details"]["actions"])){ print($log["details"]["management"]); } ?>,
										<b>ATE Comments</b> <? if(isset($log["details"]["actions"])){ print($log["details"]["ate"]); } ?>,
										<b>Closed By</b> <? if(isset($log["details"]["initial"])){ $userdata = $this->db->get_where("tblagent",array("agentcode"=>$log["details"]["initial"]))->result_array(); print($userdata[0]["agentname"]); } ?>,
									</div>
								</div>
							</div>
						</div>
						<div class="col2" style="margin-left: -80px;">
							<div class="date"><?
								if($log["log_table"]=="fault_reporting"){
								if(isset($log["details"]["datetime"])){
								print(date("d/m/Y",strtotime($log["details"]["datetime"])));
								}
								}else{
								if(isset($log["details"]["datetime"])){
								print(date("d/m/Y",strtotime($log["details"]["datetime"])));
								}
								}
								?> <? if($log["log_table"]=="fault_reporting"){
								if(isset($log["details"]["datetime"])){
								print(date("H:i",strtotime($log["details"]["datetime"])));
								}
								}else{
								if(isset($log["details"]["datetime"])){
								print(date("H:i",strtotime($log["details"]["datetime"])));
								}
								}
							?></div>
						</div>
					</li>
					<? } ?>
				</ul>
				
				<!--END TABS-->
			</div>
		</div>
	</div>
</div>
<!-- BEGIN QUICK SIDEBAR -->
<a href="javascript:;" class="page-quick-sidebar-toggler"><i class="icon-login"></i></a>
<div class="page-quick-sidebar-wrapper">
	<div class="page-quick-sidebar">
		<div class="nav-justified">
			<ul class="nav nav-tabs nav-justified">
				<li class="active">
					<a href="#quick_sidebar_tab_1" data-toggle="tab">
						Users <span class="badge badge-danger">2</span>
					</a>
				</li>
				<li>
					<a href="#quick_sidebar_tab_2" data-toggle="tab">
						Alerts <span class="badge badge-success">7</span>
					</a>
				</li>
				<li class="dropdown">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						More<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu pull-right" role="menu">
						<li>
							<a href="#quick_sidebar_tab_3" data-toggle="tab">
							<i class="icon-bell"></i> Alerts </a>
						</li>
						<li>
							<a href="#quick_sidebar_tab_3" data-toggle="tab">
							<i class="icon-info"></i> Notifications </a>
						</li>
						<li>
							<a href="#quick_sidebar_tab_3" data-toggle="tab">
							<i class="icon-speech"></i> Activities </a>
						</li>
						<li class="divider">
						</li>
						<li>
							<a href="#quick_sidebar_tab_3" data-toggle="tab">
							<i class="icon-settings"></i> Settings </a>
						</li>
					</ul>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active page-quick-sidebar-chat" id="quick_sidebar_tab_1">
					<div class="page-quick-sidebar-chat-users" data-rail-color="#ddd" data-wrapper-class="page-quick-sidebar-list">
						<h3 class="list-heading">Staff</h3>
						<ul class="media-list list-items">
							<li class="media">
								<div class="media-status">
									<span class="badge badge-success">8</span>
								</div>
								<img class="media-object" src="<?=base_url()?>assets//admin/layout/img/avatar3.jpg" alt="...">
								<div class="media-body">
									<h4 class="media-heading">Bob Nilson</h4>
									<div class="media-heading-sub">
										Project Manager
									</div>
								</div>
							</li>
							<li class="media">
								<img class="media-object" src="<?=base_url()?>assets//admin/layout/img/avatar1.jpg" alt="...">
								<div class="media-body">
									<h4 class="media-heading">Nick Larson</h4>
									<div class="media-heading-sub">
										Art Director
									</div>
								</div>
							</li>
							<li class="media">
								<div class="media-status">
									<span class="badge badge-danger">3</span>
								</div>
								<img class="media-object" src="<?=base_url()?>assets//admin/layout/img/avatar4.jpg" alt="...">
								<div class="media-body">
									<h4 class="media-heading">Deon Hubert</h4>
									<div class="media-heading-sub">
										CTO
									</div>
								</div>
							</li>
							<li class="media">
								<img class="media-object" src="<?=base_url()?>assets//admin/layout/img/avatar2.jpg" alt="...">
								<div class="media-body">
									<h4 class="media-heading">Ella Wong</h4>
									<div class="media-heading-sub">
										CEO
									</div>
								</div>
							</li>
						</ul>
						<h3 class="list-heading">Customers</h3>
						<ul class="media-list list-items">
							<li class="media">
								<div class="media-status">
									<span class="badge badge-warning">2</span>
								</div>
								<img class="media-object" src="<?=base_url()?>assets//admin/layout/img/avatar6.jpg" alt="...">
								<div class="media-body">
									<h4 class="media-heading">Lara Kunis</h4>
									<div class="media-heading-sub">
										CEO, Loop Inc
									</div>
									<div class="media-heading-small">
										Last seen 03:10 AM
									</div>
								</div>
							</li>
							<li class="media">
								<div class="media-status">
									<span class="label label-sm label-success">new</span>
								</div>
								<img class="media-object" src="<?=base_url()?>assets//admin/layout/img/avatar7.jpg" alt="...">
								<div class="media-body">
									<h4 class="media-heading">Ernie Kyllonen</h4>
									<div class="media-heading-sub">
										Project Manager,<br>
										SmartBizz PTL
									</div>
								</div>
							</li>
							<li class="media">
								<img class="media-object" src="<?=base_url()?>assets//admin/layout/img/avatar8.jpg" alt="...">
								<div class="media-body">
									<h4 class="media-heading">Lisa Stone</h4>
									<div class="media-heading-sub">
										CTO, Keort Inc
									</div>
									<div class="media-heading-small">
										Last seen 13:10 PM
									</div>
								</div>
							</li>
							<li class="media">
								<div class="media-status">
									<span class="badge badge-success">7</span>
								</div>
								<img class="media-object" src="<?=base_url()?>assets//admin/layout/img/avatar9.jpg" alt="...">
								<div class="media-body">
									<h4 class="media-heading">Deon Portalatin</h4>
									<div class="media-heading-sub">
										CFO, H&D LTD
									</div>
								</div>
							</li>
							<li class="media">
								<img class="media-object" src="<?=base_url()?>assets//admin/layout/img/avatar10.jpg" alt="...">
								<div class="media-body">
									<h4 class="media-heading">Irina Savikova</h4>
									<div class="media-heading-sub">
										CEO, Tizda Motors Inc
									</div>
								</div>
							</li>
							<li class="media">
								<div class="media-status">
									<span class="badge badge-danger">4</span>
								</div>
								<img class="media-object" src="<?=base_url()?>assets//admin/layout/img/avatar11.jpg" alt="...">
								<div class="media-body">
									<h4 class="media-heading">Maria Gomez</h4>
									<div class="media-heading-sub">
										Manager, Infomatic Inc
									</div>
									<div class="media-heading-small">
										Last seen 03:10 AM
									</div>
								</div>
							</li>
						</ul>
					</div>
					<div class="page-quick-sidebar-item">
						<div class="page-quick-sidebar-chat-user">
							<div class="page-quick-sidebar-nav">
								<a href="javascript:;" class="page-quick-sidebar-back-to-list"><i class="icon-arrow-left"></i>Back</a>
							</div>
							<div class="page-quick-sidebar-chat-user-messages">
								<div class="post out">
									<img class="avatar" alt="" src="<?=base_url()?>assets//admin/layout/img/avatar3.jpg"/>
									<div class="message">
										<span class="arrow"></span>
										<a href="javascript:;" class="name">Bob Nilson</a>
										<span class="datetime">20:15</span>
										<span class="body">
										When could you send me the report ? </span>
									</div>
								</div>
								<div class="post in">
									<img class="avatar" alt="" src="<?=base_url()?>assets//admin/layout/img/avatar2.jpg"/>
									<div class="message">
										<span class="arrow"></span>
										<a href="javascript:;" class="name">Ella Wong</a>
										<span class="datetime">20:15</span>
										<span class="body">
										Its almost done. I will be sending it shortly </span>
									</div>
								</div>
								<div class="post out">
									<img class="avatar" alt="" src="<?=base_url()?>assets//admin/layout/img/avatar3.jpg"/>
									<div class="message">
										<span class="arrow"></span>
										<a href="javascript:;" class="name">Bob Nilson</a>
										<span class="datetime">20:15</span>
										<span class="body">
										Alright. Thanks! :) </span>
									</div>
								</div>
								<div class="post in">
									<img class="avatar" alt="" src="<?=base_url()?>assets//admin/layout/img/avatar2.jpg"/>
									<div class="message">
										<span class="arrow"></span>
										<a href="javascript:;" class="name">Ella Wong</a>
										<span class="datetime">20:16</span>
										<span class="body">
										You are most welcome. Sorry for the delay. </span>
									</div>
								</div>
								<div class="post out">
									<img class="avatar" alt="" src="<?=base_url()?>assets//admin/layout/img/avatar3.jpg"/>
									<div class="message">
										<span class="arrow"></span>
										<a href="javascript:;" class="name">Bob Nilson</a>
										<span class="datetime">20:17</span>
										<span class="body">
										No probs. Just take your time :) </span>
									</div>
								</div>
								<div class="post in">
									<img class="avatar" alt="" src="<?=base_url()?>assets//admin/layout/img/avatar2.jpg"/>
									<div class="message">
										<span class="arrow"></span>
										<a href="javascript:;" class="name">Ella Wong</a>
										<span class="datetime">20:40</span>
										<span class="body">
										Alright. I just emailed it to you. </span>
									</div>
								</div>
								<div class="post out">
									<img class="avatar" alt="" src="<?=base_url()?>assets//admin/layout/img/avatar3.jpg"/>
									<div class="message">
										<span class="arrow"></span>
										<a href="javascript:;" class="name">Bob Nilson</a>
										<span class="datetime">20:17</span>
										<span class="body">
										Great! Thanks. Will check it right away. </span>
									</div>
								</div>
								<div class="post in">
									<img class="avatar" alt="" src="<?=base_url()?>assets//admin/layout/img/avatar2.jpg"/>
									<div class="message">
										<span class="arrow"></span>
										<a href="javascript:;" class="name">Ella Wong</a>
										<span class="datetime">20:40</span>
										<span class="body">
										Please let me know if you have any comment. </span>
									</div>
								</div>
								<div class="post out">
									<img class="avatar" alt="" src="<?=base_url()?>assets//admin/layout/img/avatar3.jpg"/>
									<div class="message">
										<span class="arrow"></span>
										<a href="javascript:;" class="name">Bob Nilson</a>
										<span class="datetime">20:17</span>
										<span class="body">
										Sure. I will check and buzz you if anything needs to be corrected. </span>
									</div>
								</div>
							</div>
							<div class="page-quick-sidebar-chat-user-form">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Type a message here...">
									<div class="input-group-btn">
										<button type="button" class="btn blue"><i class="icon-paper-clip"></i></button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane page-quick-sidebar-alerts" id="quick_sidebar_tab_2">
					<div class="page-quick-sidebar-alerts-list">
						<h3 class="list-heading">General</h3>
						<ul class="feeds list-items">
							<li>
								<div class="col1">
									<div class="cont">
										<div class="cont-col1">
											<div class="label label-sm label-info">
												<i class="fa fa-shopping-cart"></i>
											</div>
										</div>
										<div class="cont-col2">
											<div class="desc">
												New order received with <span class="label label-sm label-danger">
												Reference Number: DR23923 </span>
											</div>
										</div>
									</div>
								</div>
								<div class="col2">
									<div class="date">
										30 mins
									</div>
								</div>
							</li>
							<li>
								<div class="col1">
									<div class="cont">
										<div class="cont-col1">
											<div class="label label-sm label-success">
												<i class="fa fa-user"></i>
											</div>
										</div>
										<div class="cont-col2">
											<div class="desc">
												You have 5 pending membership that requires a quick review.
											</div>
										</div>
									</div>
								</div>
								<div class="col2">
									<div class="date">
										24 mins
									</div>
								</div>
							</li>
							<li>
								<div class="col1">
									<div class="cont">
										<div class="cont-col1">
											<div class="label label-sm label-danger">
												<i class="fa fa-bell-o"></i>
											</div>
										</div>
										<div class="cont-col2">
											<div class="desc">
												Web server hardware needs to be upgraded. <span class="label label-sm label-warning">
												Overdue </span>
											</div>
										</div>
									</div>
								</div>
								<div class="col2">
									<div class="date">
										2 hours
									</div>
								</div>
							</li>
							<li>
								<a href="javascript:;">
									<div class="col1">
										<div class="cont">
											<div class="cont-col1">
												<div class="label label-sm label-default">
													<i class="fa fa-briefcase"></i>
												</div>
											</div>
											<div class="cont-col2">
												<div class="desc">
													IPO Report for year 2013 has been released.
												</div>
											</div>
										</div>
									</div>
									<div class="col2">
										<div class="date">
											20 mins
										</div>
									</div>
								</a>
							</li>
						</ul>
						<h3 class="list-heading">System</h3>
						<ul class="feeds list-items">
							<li>
								<div class="col1">
									<div class="cont">
										<div class="cont-col1">
											<div class="label label-sm label-info">
												<i class="fa fa-shopping-cart"></i>
											</div>
										</div>
										<div class="cont-col2">
											<div class="desc">
												New order received with <span class="label label-sm label-success">
												Reference Number: DR23923 </span>
											</div>
										</div>
									</div>
								</div>
								<div class="col2">
									<div class="date">
										30 mins
									</div>
								</div>
							</li>
							<li>
								<div class="col1">
									<div class="cont">
										<div class="cont-col1">
											<div class="label label-sm label-success">
												<i class="fa fa-user"></i>
											</div>
										</div>
										<div class="cont-col2">
											<div class="desc">
												You have 5 pending membership that requires a quick review.
											</div>
										</div>
									</div>
								</div>
								<div class="col2">
									<div class="date">
										24 mins
									</div>
								</div>
							</li>
							<li>
								<div class="col1">
									<div class="cont">
										<div class="cont-col1">
											<div class="label label-sm label-warning">
												<i class="fa fa-bell-o"></i>
											</div>
										</div>
										<div class="cont-col2">
											<div class="desc">
												Web server hardware needs to be upgraded. <span class="label label-sm label-default ">
												Overdue </span>
											</div>
										</div>
									</div>
								</div>
								<div class="col2">
									<div class="date">
										2 hours
									</div>
								</div>
							</li>
							<li>
								<a href="javascript:;">
									<div class="col1">
										<div class="cont">
											<div class="cont-col1">
												<div class="label label-sm label-info">
													<i class="fa fa-briefcase"></i>
												</div>
											</div>
											<div class="cont-col2">
												<div class="desc">
													IPO Report for year 2013 has been released.
												</div>
											</div>
										</div>
									</div>
									<div class="col2">
										<div class="date">
											20 mins
										</div>
									</div>
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="tab-pane page-quick-sidebar-settings" id="quick_sidebar_tab_3">
					<div class="page-quick-sidebar-settings-list">
						<h3 class="list-heading">General Settings</h3>
						<ul class="list-items borderless">
							<li>
								Enable Notifications <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="success" data-on-text="ON" data-off-color="default" data-off-text="OFF">
							</li>
							<li>
								Allow Tracking <input type="checkbox" class="make-switch" data-size="small" data-on-color="info" data-on-text="ON" data-off-color="default" data-off-text="OFF">
							</li>
							<li>
								Log Errors <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="danger" data-on-text="ON" data-off-color="default" data-off-text="OFF">
							</li>
							<li>
								Auto Sumbit Issues <input type="checkbox" class="make-switch" data-size="small" data-on-color="warning" data-on-text="ON" data-off-color="default" data-off-text="OFF">
							</li>
							<li>
								Enable SMS Alerts <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="success" data-on-text="ON" data-off-color="default" data-off-text="OFF">
							</li>
						</ul>
						<h3 class="list-heading">System Settings</h3>
						<ul class="list-items borderless">
							<li>
								Security Level
								<select class="form-control input-inline input-sm input-small">
									<option value="1">Normal</option>
									<option value="2" selected>Medium</option>
									<option value="e">High</option>
								</select>
							</li>
							<li>
								Failed Email Attempts <input class="form-control input-inline input-sm input-small" value="5"/>
							</li>
							<li>
								Secondary SMTP Port <input class="form-control input-inline input-sm input-small" value="3560"/>
							</li>
							<li>
								Notify On System Error <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="danger" data-on-text="ON" data-off-color="default" data-off-text="OFF">
							</li>
							<li>
								Notify On SMTP Error <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="warning" data-on-text="ON" data-off-color="default" data-off-text="OFF">
							</li>
						</ul>
						<div class="inner-content">
							<button class="btn btn-success"><i class="icon-settings"></i> Save Changes</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END QUICK SIDEBAR -->
<!-- Modal -->
<div class="modal fade" id="rwy" role="dialog">
	<div class="modal-dialog">
		
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Runway In Use</h4>
			</div>
			<div class="modal-body">
				<form action="<?=base_url()?>elog/insertRunwayInUse" class="rwy-form" method="post">
					<input type="hidden" name="subject" value="Runway In Use" />
					<input type="hidden" name="initial" value="<?=$this->userdetails["agentcode"]?>" />
					<? $allusers = $this->user_model->getUnitUsers(); ?>
					
					<div class="row pform" style="padding-top:1%;" ><!-- // column -->
					<div class="col-md-6">
						<div class="form-group">
							<span class="form-field-title">Initial</span>
							<input type="text" readonly="readonly" class="form-control" value="<?=$this->userdetails["agentname"]?>" />
							<input type="hidden" name="initial" class="form-control" readonly="readonly" value="<?=$this->userdetails["agentcode"]?>" />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<span class="form-field-title">Date*</span>
							<input type="text" class="date-field form-control date-picker" name='date' value="<?=date("m/d/Y")?>" required="required" />
						</div>
					</div>
				</div>
				<div class="row pform">
					<div class="col-md-6">
						
						<div class="form-group">
							<span class="form-field-title">Time*</span>
							
							<input type="text" class="form-control timepicker timepicker-default" name='time' required="required"/>
							
							
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<span class="form-field-title">On Behalf</span>
							<select name="onbehalf" class="form-control">
								<option value="">--Select User--</option>
								<?
								foreach($allusers as $key=>$user){
								?>
								<option value="<?=$user["agentcode"]?>"><?=$user["agentname"]?></option>
								<?
								}
								?>
							</select>
						</div>
					</div>
					
					
				</div>
				<div class="row pform">
					<div class="col-md-6">
						<div class="form-group">
							<span class="form-field-title">Units</span>
							<select name="unit_id" class="form-control unt"  required="required">
								
								<option value="">--Select Unit--</option>
								<?
								foreach($user_unit as $unit){
								$unit_name = $this->db->get_where('units', array('unit_id' => $unit))->row();
								?>
								<option value="<?=$unit_name->unit_id?>"><?=$unit_name->unit?></option>
								<?
								} ?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<span class="form-field-title">Arrival Runway</span>
							<select name="runway_in_use" class="runway-status form-control rwy"  required="required">
								
								
							</select>
						</div>
					</div>
					
					
					
				</div>
				<div class="row pform">
					<div class="col-md-6">
						<div class="form-group">
							<span class="form-field-title">Departure Runway</span>
							<select name="runway_in_use_depart" class="runway-status form-control rwy"  required="required">
								
							</select>
						</div>
					</div>
					<div class="col-md-6" style="padding-bottom:1%;">
						<span class="form-field-title">Description</span>
						<span class="form-field" style="width: 70%;">
							<textarea name="description" id="textarea"  class="form-control"></textarea>
						</span>
					</div>
				</div>
				
				
				<!-- // Example row -->
				
			</div>
			<div class="modal-footer">
				<input type="submit" class="btn btn-success" value="Submit" />
				
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</form>
	</div>
	
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="met" role="dialog">
<div class="modal-dialog">
	
	<!-- Modal content-->
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">MET Condition</h4>
		</div>
		<div class="modal-body">
			<form action="<?=base_url()?>elog/insertmetcondition" class="log-add-form" method="post">
				<input type='hidden' name='subject' value='Met Condition' />
				<div class="row pform" style="padding-top:1%;"  >
					<div class="col-md-6">
						<div class="form-group">
							<span class="form-field-title">Initial</span>
							
							<input type="text" class="form-control" readonly="readonly" value="<?=$this->userdetails["agentname"]?>" />
							<input type="hidden" class="form-control" name="initial" readonly="readonly" value="<?=$this->userdetails["agentcode"]?>" />
							
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group">
							<span class="form-field-title">Date*</span>
							<input type="text" class="date-field form-control date-picker" name='date' value="<?=date("m/d/Y")?>" required="required" />
						</div></div>
						
						
						
						
						
						
					</div>
					
					
					
					
					<div class="row pform" >
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">Time*</span>
								
								<input type="text" class="form-control timepicker timepicker-default" name='time' required="required"/>
								
								
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">Units</span>
								<select name="unit_id" class="form-control"  required="required">
									<? if ($a != 1) { ?>
									<option value="">--Select Unit--</option>
									<? } ?>
									
									<?
									foreach($user_unit as $unit){
									$unit_name = $this->db->get_where('units', array('unit_id' => $unit))->row();
									?>
									<option value="<?=$unit_name->unit_id?>"><?=$unit_name->unit?></option>
									<?
									} ?>
								</select>
							</div>
						</div>
						
						
						
					</div>
					<div class="row pform" style="padding-top:1%;"  >
						<div class="col-md-12" style="padding-bottom: 1%;">
							<span class="form-field-title">MET Conditions</span>
						</div>
						
						<div class="col-md-12">
							<div class="form-group">
								
								
								<div class="form-field">
									<input type="radio" id="radio" name="condition" value="vmc" required="required" class="md-radiobtn">
									<label for="radio1">
										<span class="inc"></span>
										<span class="check"></span>
										<span class="box"></span>
									VMC </label>
								</div>
							</div>
						</div>
						
						<div class="col-md-12">
							<div class="form-group">
								
								
								<div class="form-field">
									<input type="radio" id="radio" name="condition" value="imc" required="required" class="md-radiobtn">
									<label for="radio2">
										<span class="inc"></span>
										<span class="check"></span>
										<span class="box"></span>
									IMC </label>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								
								
								<div class="form-field">
									<input type="radio" id="radio" name="condition" value="lvs" required="required" class="md-radiobtn">
									<label for="radio3">
										<span class="inc"></span>
										<span class="check"></span>
										<span class="box"></span>
									LVS </label>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								
								
								<div class="form-field">
									<input type="radio" id="radio" name="condition" value="lvo" required="required" class="md-radiobtn">
									<label for="radio3">
										<span class="inc"></span>
										<span class="check"></span>
										<span class="box"></span>
									LVO </label>
								</div>
							</div>
						</div>
						
						<div class="col-md-12">
							<div class="form-group">
								
								
								<div class="form-field">
									<input type="radio" id="radio" name="condition" value="lvp" required="required" class="md-radiobtn">
									<label for="radio3">
										<span class="inc"></span>
										<span class="check"></span>
										<span class="box"></span>
									LVP </label>
								</div>
								
								
								
							</div>
						</div>
					</div>
					
				</div>
				<div class="modal-footer">
					<input type="submit" class="btn btn-success" value="Submit" />
					<!-- <input type="reset" class="btn btn-danger" value="Cancel" /> -->
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
		
	</div>
</div>



<!-- Modal -->
<div id="gen" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">General Entry</h4>
			</div>
			<div class="modal-body">
				<?
				$this->db->like("active","on");
				$subjects = $this->db->order_by('subject')->get("subjectform")->result_array();
				?>
				<form action="<?=base_url()?>elog/insertgeneralentry" class="log-add-form" method="post">
					
					<div class="row pform" style="padding-top:1%;"  >
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">Initial</span>
								
								<input type="text" class="form-control" readonly="readonly" value="<?=$this->userdetails["agentname"]?>" />
								<input type="hidden" class="form-control" name="initial" readonly="readonly" value="<?=$this->userdetails["agentcode"]?>" />
								
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">Date*</span>
								<input type="text" class="date-field form-control date-picker" name='date' value="<?=date("m/d/Y")?>" required="required" />
							</div></div>
							
							
							
							
							
							
						</div>
						
						
						
						
						<div class="row pform" >
							<div class="col-md-6">
								
								<div class="form-group">
									<span class="form-field-title">Time*</span>
									
									<input type="text" class="form-control timepicker timepicker-default" name='time' required="required"/>
									
									
								</div>
							</div>
							
							
							<div class="col-md-6">
								<div class="form-group" >
									<?
									?>
									<span class="form-field-title">On Behalf</span>
									<select name="onbehalf" class="form-control">
										<option value="">--Select User--</option>
										<?
										foreach($allusers as $key=>$user){
										?>
										<option value="<?=$user["agentcode"]?>"><?=$user["agentname"]?></option>
										<?
										}
										?>
									</select>
								</div>
							</div>
						</div>
						
						
						
						
						<div class="row pform" >
							<div class="col-md-6">
								
								<div class="form-group">
									<span class="form-field-title">Subject *</span>
									
									<select name="subject"  class="form-control" required="required">
										<option value="">-- Select Subject --</option>
										<? foreach ($user_unit as $u) {
										foreach($subjects as $key=>$subject){
										if ($u == $subject["unit_id"]) {
										?>
										<option value="<?=$subject["id"]?>"><?=$subject["subject"]?></option>
										<?
										} } }
										?>
									</select>
								</div>
							</div>
							
							
							<div class="col-md-6">
								<div class="form-group" >
									<span class="form-field-title">Description</span>
									<textarea name="description" id="textarea"  class="form-control" ></textarea>
								</div>
							</div>
						</div>
						
						<div class="form-actions left">
							
							<div class="col-md-5">
								
								
								
								<div class=" form-actions" >
									
									
									
									
									
								</div>
								
							</div>
						</div>
						
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-success" value="Submit" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div id="fault" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Fault Reporting</h4>
				</div>
				<div class="modal-body">
					<?
					$positions = $this->db->order_by('name','asc')->get("positionname")->result_array();
					$consoleNumbers = $this->db->order_by('name','asc')->get("consolenumber")->result_array();
					$equipments = $this->db->order_by('name','asc')->get("system_equipment")->result_array();
					?>
					<form action="<?=base_url()?>elog/insertFaultReporting" class="log-add-form" method="post">
						<input type="hidden" name="subject" value="Fault Reporting" />
						<input type="hidden" name="initial" value="<?=$this->userdetails["agentcode"]?>" />
						<!-- <input type="hidden" name="datetime" value="<?=date("Y-m-d H:i:s")?>" /> -->
						
						<div class="row pform" style="padding-top:1%;"  >
							<div class="col-md-6">
								<div class="form-group">
									<span class="form-field-title">Initial</span>
									
									<input type="text" class="form-control" readonly="readonly" value="<?=$this->userdetails["agentname"]?>" />
									
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<span class="form-field-title">Date*</span>
									<input type="text" class="date-field form-control date-picker" value="<?=date("m/d/Y")?>" name="date" required="required" />
									
								</div>
							</div>
						</div>
						
						
						
						
						<div class="row pform" >
							<div class="col-md-6">
								
								<div class="form-group">
									<span class="form-field-title">Time *</span>
									
									<input type="text" class="form-control timepicker timepicker-default" name="time" />
									
								</div>
							</div>
							
							
							<div class="col-md-6">
								<div class="form-group" >
									<span class="form-field-title">On Behalf Of</span>
									<select name="onbehalf" class="form-control" >
										<option value="">Select</option>
										<?
										foreach($allusers as $key=>$user){
										?>
										<option value="<?=$user["agentcode"]?>"><?=$user["agentname"]?></option>
										<?
										}
										?>
									</select>
								</div>
							</div>
						</div>
						
						
						
						
						<div class="row pform" >
							<div class="col-md-6">
								
								<div class="form-group">
									<span class="form-field-title">Position</span>
									
									<select name="position_name" class="form-control">
										<option value="">--Select Position--</option>
										<? foreach ($user_unit as $u) {
										
										
										foreach($positions as $key=>$position){
										if ($u == $position["unit_id"]) {
										?>
										<option value="<?=$position["name"]?>"><?=$position["name"]?></option>
										<?
										} } }
										?>
									</select>
								</div>
							</div>
							
							
							<div class="col-md-6">
								<div class="form-group" >
									<span class="form-field-title">Console</span>
									<select name="console_number" class="form-control">
										<option value="">--Select Console--</option>
										<? foreach ($user_unit as $u) {
										foreach($consoleNumbers as $key=>$number){
										if ($u == $number["unit_id"]) {
										?>
										<option value="<?=$number["name"]?>"><?=$number["name"]?></option>
										<?
										} } }
										?>
									</select>
								</div>
							</div>
						</div>
						
						<div class="row pform" >
							<div class="col-md-6">
								
								<div class="form-group">
									<span class="form-field-title">Equipment</span>
									
									<select name="system_equipment" class="form-control">
										<option value="">--Select Equipment--</option>
										<?	foreach ($user_unit as $u) {
										foreach($equipments as $key=>$equipment){
										if ($u == $equipment["unit_id"]) {
										?>
										<option value="<?=$equipment["name"]?>"><?=$equipment["name"]?></option>
										<?
										} } }
										?>
									</select>
								</div>
								
							</div>
							<div class="col-md-6">
								<div class="form-group" >
									<span class="form-field-title">Error Text *</span>
									<input type="text" name="error_text" class="form-control" value="" required="required" />
								</div>
							</div>
						</div>
						
						<div class="row pform" >
							
							
							
							<div class="col-md-6">
								<div class="form-group" >
									<span class="form-field-title">Description *</span>
									<textarea name="any_other_details" id="desc" class="form-control" ></textarea>
								</div>
							</div>
						</div>
						
						<div class="form-actions left">
							
							<div class="col-md-5">
								
								
								
								<div class=" form-actions" >
									
									
									
									
									
								</div>
								
							</div>
						</div>
						
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-success" value="Submit" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<script type="text/javascript">
	tday=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
	tmonth=new Array("January","February","March","April","May","June","July","August","September","October","November","December");
	function GetClock(){
	var d=new Date();
	var nday=d.getDay(),nmonth=d.getMonth(),ndate=d.getDate(),nyear=d.getYear();
	if(nyear<1000) nyear+=1900;
	var nhour=d.getHours(),nmin=d.getMinutes(),nsec=d.getSeconds(),ap;
	if(nhour==0){ap=" AM";nhour=12;}
	else if(nhour<12){ap=" AM";}
	else if(nhour==12){ap=" PM";}
	else if(nhour>12){ap=" PM";nhour-=12;}
	if(nmin<=9) nmin="0"+nmin;
	if(nsec<=9) nsec="0"+nsec;
	document.getElementById('clockbox').innerHTML=" "+nhour+":"+nmin+":"+nsec+ap+" ";
	}
	window.onload=function(){
	GetClock();
	setInterval(GetClock,1000);
	}
	</script>
	<script type="text/javascript">
	$(document).ready(function(){
		$(".rwy-form").submit(function(){
				if(confirm("Please confirm to add the entry.")){
					return true;
				}else{
					return false;
				}
		});
	});
	</script>
	<script>
	$(".unt").change(function(){
	var unit= $(".unt").val();
	$.ajax({
	type:"post",
	url: "<? echo base_url(); ?>elog/SelectedUnit",
	data:{unit:unit},
	success:function(response)
	{
	
	$('.rwy').html(response);
	
	
	}
	
	}
	);
	});
	
	</script>
	<script>
		function date_time(id)
	{
	
	


	date = new Date(<?php echo date("Y, n - 1, d, H, i, s") ?>);
	
	year = date.getFullYear();
	month = date.getMonth();
	months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
	d = date.getDate();
	day = date.getDay();
	days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
	h = date.getHours();
	if(h<10)
	{
	h = "0"+h;
	}
	m = date.getMinutes();
	if(m<10)
	{
	m = "0"+m;
	}
	s = date.getSeconds();
	if(s<10)
	{
	s = "0"+s;
	}
	result = ''+days[day]+' '+months[month]+' '+d+' '+year+' '+h+':'+m+':'+s;
	document.getElementById(id).innerHTML = result;
	setTimeout('date_time("'+id+'");','1000');
	return true;
	}
	</script>
	<script>
	window.onscroll = function() {myFunction()};
	var header = document.getElementById("Myid");
	var header1 = document.getElementById("Myid1");
	var sticky = header.offsetTop;
	var sticky1 = header1.offsetTop;
	function myFunction() {
	if (window.pageYOffset > sticky) {
	header.classList.add("sticky");
	} else {
	header.classList.remove("sticky");
	}
	if (window.pageYOffset > sticky1) {
	header1.classList.add("sticky");
	} else {
	header1.classList.remove("sticky");
	}
	}
	</script>
	<script type="text/javascript">window.onload = date_time('date_time');</script>