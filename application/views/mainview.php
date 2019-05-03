<?
if(isset($this->userdetails["permissions"]["refresh_mainview"])){
?>
<script type="text/javascript">
setTimeout(function(){
window.location.reload(1);
}, 30000);
</script>
<?
}
?>
<?
$user_logged = $this->userdetails["agentunit"];
$user_unit = unserialize($user_logged);
?>
<div class="row">
	<div class="col-md-12" >
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>E-Log Main View
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse" data-original-title="" title="">
					</a>
					<a href="#portlet-config" >
					</a>
					<a href="javascript:;" >
					</a>
					<a href="javascript:;" >
					</a>
				</div>
			</div>
			<div class="portlet-body">
				<div class="row pform" style="padding-top: 1%">
					<form action="<?=base_url()?>elog/mainview" method="get" class="accesslogs-search-form">
						<div class="col-md-3">
							<div class="form-group">
								<span class="form-field-title">From</span>
								
								<input type="text" name="from" class="date-picker form-control" value="" autocomplete='off' />
								
							</div>
						</div>
						
						<div class="col-md-3">
							<div class="form-group">
								<span class="form-field-title">To</span>
								<input type="text" name="to" class="date-picker form-control" value="" autocomplete='off' />
							</div>
						</div>
						
						
						<div class="col-md-3">
							<div class="form-group">
								<span class="form-field-title">FRN Status</span>
								<select name="frnstatus"  class="form-control">
									<option value="">-- Select FRN Status --</option>
									<? $frnstatus = $this->db->get("frnstatus")->result_array();
									foreach($frnstatus as $key=>$frn){
									?>
									<option value="<?=$frn["id"]?>"><?=$frn["frnstatus"]?></option>
									<?
									}
									?>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<span class="form-field-title">Units</span>
								<select name="unit_id" class="form-control">
									<option value="">--Select--</option>
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
						
						
						<div class="col-md-12" style="padding-top:1%; padding-bottom:1%;">
							<div class="al-search-controls">
								<input type="submit" name="submit" style='float:right;' class="btn btn-danger" value="submit"/>
							</div>
						</div>
					</form>
				</div>
				<form action="<?=base_url()?>elog/mainview" method="post">
					<input type="hidden" name="faultreports" value="<?=$this->uri->segment(3)?>" />
					<span class="description-col" style="width: 10%!important;font-weight: bold!important;height: auto;margin: 0!important;padding: 0!important;margin-top: 1%!important;margin-left: 1%!important;">Order By: </span>
					<?
					$order = $this->session->userdata("order");
					if($order == "desc"){
					?>
					<span class="description-col">
						<input type="submit" class="btn btn-success" name="order" value="Ascending" />
					</span>
					<?
					}else{
					?>
					<span class="description-col">
						<input type="submit" class="btn btn-success" name="order" value="Descending" />
					</span>
					<?
					}
					?>
				</form>
				<div class="table-scrollable">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th scope="col" >
									Date
								</th>
								<th scope="col">
									Time
								</th>
								<th scope="col">
									Subject
								</th>
								<th scope="col">
									Description
								</th>
								<th scope="col" style='text-align:center;'>
									Unit <br> Comments
								</th>
								<th scope="col" style='text-align:center;'>
									Management <br> Comments
								</th>
								<th scope="col" style='text-align:center;'>
									ATE <br> Comments
								</th>
								<th scope="col">
									FRN
								</th>
								<th scope="col">
									ROSI
								</th>
								<th scope="col" style='text-align:center;'>
									FRN <br> Status
								</th>
								<th scope="col">
									Initial
								</th>
								
								<th scope="col" style='text-align:center;'>
									On <br> Behalf
								</th>
								<th scope="col">
									Units
								</th>
								
							</tr>
						</thead>
						<tbody>
							
							<?
							
							foreach($logs as $key=>$log){
							
							if(!empty($log['details'])){
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
							?>
							<tr
								<?php if (isset($log["details"]["action_perfomed"])){if($log["details"]["action_perfomed"] == 1){ echo 'style="background: rgba(255, 0, 0, 0.46);"' ;}if($log["details"]["frnstatus"] == 7){ echo 'style="background: green;color:white;"' ;}if($log["details"]["frnstatus"] == 14 || $log["details"]["frnstatus"] == 12){ echo 'style="background: yellow;"' ;}if($log["details"]["frnstatus"] == 13){ echo 'style="background: pink;"' ;}
								if($log["details"]["action_perfomed"] == 3){ echo 'style="background: rgba(255, 255, 0, 0.57);"' ;}if($log["details"]["action_perfomed"] == 4){ echo 'style="background: rgba(46, 81, 190, 0.57);"' ;}}?> onclick="<?=strtolower(str_replace("(","",str_replace(")","",str_replace(" ","",$log["log_type"]))))?>(<?=$log["log_id"]?>,this,'<?=$subject?>',false)">
								<td >
									<?
									if($log["log_table"]=="fault_reporting"){
									if(isset($log["details"]["datetime"])){
									print(date("d/m/Y",strtotime($log["details"]["datetime"])));
									}
									}else{
									if(isset($log["details"]["datetime"])){
									print(date("d/m/Y",strtotime($log["details"]["datetime"])));
									}
									}
									?>
								</td>
								<td>
									<?
									if($log["log_table"]=="fault_reporting"){
									if(isset($log["details"]["datetime"])){
									print(date("H:i",strtotime($log["details"]["datetime"])));
									}
									}else{
									if(isset($log["details"]["datetime"])){
									print(date("H:i",strtotime($log["details"]["datetime"])));
									}
									}
									?>
								</td>
								<td>
									<?
									print $subject;
									?>
								</td>
								<td>
									<?
									if($log["log_table"] == "rwy"){
									
									if(!empty($log["details"]["runway_in_use"] || $log["details"]["runway_in_use_depart"])){
									$runway_in_use2 = $this->db->get_where("runway",array("runway_id"=>$log["details"]["runway_in_use"]))->result_array();
									$runway_in_use_depart = $this->db->get_where("runway",array("runway_id"=>$log["details"]["runway_in_use_depart"]))->result_array();
									if(!empty($runway_in_use2[0]["runway"])){
									echo "Arrival Runway: ". $runway_in_use2[0]["runway"]. "<br>";
									}
									if(!empty($runway_in_use_depart[0]["runway"])){
									echo "Departure Runway: ". $runway_in_use_depart[0]["runway"]. "<br>";
									}
									if(!empty($log["details"]['description'])){
									echo "Description: ". $log["details"]['description'];
									}
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
									print('Description :'. strip_tags($log["details"]["any_other_details"])).'<br>';
									}else if(isset($log["details"]["remarks"])){
									print(strip_tags($log["details"]["remarks"]));
									}else if(isset($log["details"]["description"])){
									print(strip_tags($log["details"]["description"]));
									}
									}
									?>
									
									<?
									if($log['log_type'] == 'generalentry'){
									if(!empty($log["details"]["description"])){
									echo "Description : " . $log["details"]["description"].'<br>';
									}
									}elseif($log['log_type'] == 'Fault Reporting'){
									if(!empty($log["details"]["position_name"])){
									echo "Position Name : " . $log["details"]["position_name"].'<br>';
									}
									if(!empty($log["details"]["console_number"])){
									echo "Console Number : " . $log["details"]["console_number"].'<br>';
									}
									if(!empty($log["details"]["system_equipment"])){
									echo "System Equipment : " . $log["details"]["system_equipment"].'<br>';
									}
									if(!empty($log["details"]["error_text"])){
									echo "Error Text : " . $log["details"]["error_text"].'<br>';
									}
									if(!empty($log["details"]["Remarks"])){
									echo "Description : " . $log["details"]["Remarks"].'<br>';
									}
									}elseif($log['log_type'] == 'Aircraft Diversion'){
									if(!empty($log["details"]["callsign"])){
									echo "Aircraft Call Sign : " . $log["details"]["callsign"].'<br>';
									}
									if(!empty($log["details"]["aircraft_type"])){
									echo "Aircraft Type : " . $log["details"]["aircraft_type"].'<br>';
									}
									if(!empty($log["details"]["ssr_transporter_code"])){
									echo "Ssr Transporter Code : " . $log["details"]["ssr_transporter_code"].'<br>';
									}
									if(!empty($log["details"]["point_of_departure"])){
									echo "Point of Departure : " . $log["details"]["point_of_departure"].'<br>';
									}
									if(!empty($log["details"]["original_destination"])){
									echo "Original Destination : " . $log["details"]["original_destination"].'<br>';
									}
									if(!empty($log["details"]["new_destination"])){
									echo "New Destination : " . $log["details"]["new_destination"].'<br>';
									}
									if(!empty($log["details"]["time_of_arrival"])){
									echo "Time of Arrival : " . $log["details"]["time_of_arrival"].'<br>';
									}
									if(!empty($log["details"]["TrafficOfficerInformedTime"])){
									echo "Traffic Officer Informed Time : " . $log["details"]["TrafficOfficerInformedTime"].'<br>';
									}
									if(!empty($log["details"]["AOCCInformedTime"])){
									echo "AOCC Informed Time : " . $log["details"]["AOCCInformedTime"].'<br>';
									}
									if(!empty($log["details"]["any_other_details"])){
									echo "Details : " . $log["details"]["any_other_details"].'<br>';
									}
									}elseif($log['log_type'] == 'Met Condition'){
									if(!empty($log["details"]["condition"])){
									echo "Condition : " . strtoupper($log["details"]["condition"]).'<br>';
									}
									}elseif($log['log_type'] == 'Safe Guarding Lvo'){
									if(!empty($log["details"]["Operate_AGL_Panel"])){
									echo "Operate AGL Panel : " . $log["details"]["Operate_AGL_Panel"].'<br>';
									}
									if(!empty($log["details"]["Update_ATIS"])){
									echo "Update ATIS : " . $log["details"]["Update_ATIS"].'<br>';
									}
									}elseif($log['log_type'] == 'Aircraft Crash'){
									echo "Crash Type : " . $log["details"]["crash_type"].'<br>';
									echo "Location : " . $log["details"]["location"].'<br>';
									echo "Aircraft Type : " . $log["details"]["aircraft_type"].'<br>';
									echo "Persons on Board : " . $log["details"]["persons_on_board"].'<br>';
									echo "Aircraft Operator : " . $log["details"]["aircraft_operator"].'<br>';
									echo "Call Sign : " . $log["details"]["callsign"].'<br>';
									}
									?>
									
									
								</td>
								<td>
									<?
									if(isset($log["details"]["actions"])){
									print($log["details"]["actions"]);
									}
									?>
								</td>
								<td>
									<?
									if(isset($log["details"]["management"])){
									print($log["details"]["management"]);
									}
									?>
								</td>
								<td>
									<?
									if(isset($log["details"]["ate"])){
									print($log["details"]["ate"]);
									}
									?>
								</td>
								<td>
									<?
									if(isset($log["details"]["faultNum"])){
									print($log["details"]["faultNum"]);
									}
									?>
								</td>
								<td>
									<?
									if(isset($log["details"]["roci"])){
									print($log["details"]["roci"]);
									}
									?>
								</td>
								<td>
									<?
									if(isset($log["details"]["frnstatus"]) && !empty($log["details"]["frnstatus"])){
									if($log["details"]["frnstatus"] != "pending"){
									$frnstatus = $this->db->get_where("frnstatus",array("id"=>$log["details"]["frnstatus"]))->result_array();
									print_r($frnstatus[0]["frnstatus"]);
									}else{
									print($log["details"]["frnstatus"]);
									}
									}
									?>
								</td>
								<td>
									<?
									if(isset($log["details"]["initial"])){
									$userdata = $this->db->get_where("tblagent",array("agentcode"=>$log["details"]["initial"]))->result_array();
									print($userdata[0]["agentname"]);
									}
									?>
								</td>
								<td>
									<?
									if(isset($log["details"]["onbehalf"]) && !empty($log["details"]["onbehalf"])){
									$userdata = $this->db->get_where("tblagent",array("agentcode"=>$log["details"]["onbehalf"]))->result_array();
									print($userdata[0]["agentname"]);
									}
									?>
								</td>
								<td> <?if (!empty($log['details']['unit_id'])) {
									$unit_name = $this->db->get_where('units', array('unit_id' => $log['details']['unit_id']))->row();
									echo $unit_name->unit;
									} ?>
									
								</td>
							</tr>
							
							
							
							
							
							
							<? }} ?>
							
						</tbody>
						
					</table>
				</div>
				<div class="row">
					<div class="col-md-7 col-sm-12">
						<div class="dataTables_paginate paging_bootstrap_full_number" id="sample_1_paginate">
							<ul class="pagination" style="visibility: visible;">
								<?
								$pagination_links = trim($pagination_links);
								if(!empty($pagination_links)){
								?>
								<li >
									<?=$pagination_links?>
								</li>
								<?
								}
								?>
							</ul>
						</div></div></div>
					</div>
				</div>
				<!-- END SAMPLE TABLE PORTLET-->
			</div>
		</div>
		
		<script>
		$(document).ready(function(e){
			
		});
		
		</script>
		
		
		<style>
		.blink_me {
		-webkit-animation-name: blinker;
		-webkit-animation-duration: 3s;
		-webkit-animation-timing-function: linear;
		-webkit-animation-iteration-count: infinite;
		
		-moz-animation-name: blinker;
		-moz-animation-duration: 3s;
		-moz-animation-timing-function: linear;
		-moz-animation-iteration-count: infinite;
		
		animation-name: blinker;
		animation-duration: 3s;
		animation-timing-function: linear;
		animation-iteration-count: infinite;
		}
		@-moz-keyframes blinker {
		0% { color:black }
		25% { color:Orange }
		50% { color:red }
		75% { color:Yellow }
		100% {  color:green;}
		}
		@-webkit-keyframes blinker {
		0% { color:black }
		25% { color:Orange }
		50% { color:red }
		75% { color:Yellow }
		100% {  color:green;}
		}
		@keyframes blinker {
		0% { color:black }
		25% { color:Orange }
		50% { color:red }
		75% { color:Yellow }
		100% {  color:green;}
		}
		</style>