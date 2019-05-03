<?
if(isset($this->userdetails["permissions"]["refresh_mainview"])){
?>
<script type="text/javascript">
</script>
<script type="text/javascript">
	var idleTime = 0;
	$(document).ready(function () {
			//Increment the idle time counter every minute.
			var idleInterval = setInterval(timerIncrement, 60000); // 1 minute
			//Zero the idle timer on mouse movement.
			$(this).mousemove(function (e) {
					idleTime = 0;
			});
			$(this).keypress(function (e) {
					idleTime = 0;
			});
	});
	function timerIncrement() {
			idleTime = idleTime + 1;
			if (idleTime > 3) { // 4 minutes
					window.location.reload();
			}
}
</script>
<?
}
?>
<div class="row-fluid page-head">
	<img src="<?=base_url()?>assets/img/gal.png" style="float:left" />
	<h2 class="page-title"><i class="fontello-icon-monitor"></i>E-Log Main View</h2>
	<div class="page-bar">
		<div class="btn-toolbar"> </div>
	</div>
</div>
<!-- // page head -->
<div id="page-content" class="page-content">
	<section>
		<div class="row-fluid margin-top20">
			<ul class="logs-listing mainview-listing">
				<li class="list-row order-row">
					<form action="<?=base_url()?>elog/mainview" method="post">
						<input type="hidden" name="faultreports" value="<?=$this->uri->segment(3)?>" />
						<span class="description-col" style="width: 10%!important;font-weight: bold!important;height: auto;margin: 0!important;padding: 0!important;margin-top: 1%!important;margin-left: 1%!important;">Order By: </span>
						<?
						$order = $this->session->userdata("order");
						if($order == "desc"){
						?>
						<span class="description-col">
							<input type="submit" class="btn btn-blue" name="order" value="Ascending" />
						</span>
						<?
						}else{
						?>
						<span class="description-col">
							<input type="submit" class="btn btn-blue" name="order" value="Descending" />
						</span>
						<?
						}
						?>
					</form>
				</li>
				<li class="list-head">
					<span class="datetime-col">Date</span>
					<span class="datetime-col">Time</span>
					<span class="subject-col">Subject</span>
					<span class="description-col">Description</span>
					<span class="actions-col">Actions</span>
					<span class="Management-col">Management Comments</span>
					<span class="frn-col">FRN</span>
					<span class="frnstatus-col">FRN Status</span>
					<span class="initial-col">Initial</span>
					<span class="onbehalf-col">On Behalf</span>
					<span class="onbehalf-col">Units</span>
				</li>
				<?
				foreach($logs as $key=>$log){
				?>
				<?
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
				<li class="list-row" onclick="<?=strtolower(str_replace("(","",str_replace(")","",str_replace(" ","","newjob"))))?>(<?=$log["log_id"]?>,this,'<?=$subject?>',false)">
					
					<span class="datetime-col">
						<?
						if($log["log_table"]=="fault_reporting"){
						if(isset($log["details"]["form_datetime"])){
						print(date("d/m/Y",strtotime($log["details"]["form_datetime"])));
						}
						}else{
						if(isset($log["details"]["datetime"])){
						print(date("d/m/Y",strtotime($log["details"]["datetime"])));
						}
						}
						?>
					</span>
					<span class="datetime-col">
						<?
						if($log["log_table"]=="fault_reporting"){
						if(isset($log["details"]["form_datetime"])){
						print(date("Hi",strtotime($log["details"]["form_datetime"])));
						}
						}else{
						if(isset($log["details"]["datetime"])){
						print(date("Hi",strtotime($log["details"]["datetime"])));
						}
						}
						?>
					</span>
					<span class="subject-col">
						<?
						print $subject;
						?>
					</span>
					<span class="description-col">
						<?
						if($log["log_table"] == "rwy"){
						
						if(!empty($log["details"]["runway_in_use"])){
						$runway_in_use2 = $this->db->get_where("runway",array("runway_id"=>$log["details"]["runway_in_use"]))->result_array();
						print($runway_in_use2[0]["runway"]);
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
						?>
					</span>
					<span class="actions-col">
						<?
						if(isset($log["details"]["actions"])){
						print($log["details"]["actions"]);
						}
						?>
					</span>
					<span class="Management-col">
						<?
						if(isset($log["details"]["management"])){
						print($log["details"]["management"]);
						}
						?>
					</span>
					
					<span class="frn-col">&nbsp;
						<?
						if(isset($log["details"]["frn"])){
						print($log["details"]["frn"]);
						}
						?>
					</span>
					<span class="frnstatus-col">&nbsp;
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
					</span>
					<span class="initial-col">
						<?
						if(isset($log["details"]["initial"])){
						$userdata = $this->db->get_where("tblagent",array("agentcode"=>$log["details"]["initial"]))->result_array();
						print($userdata[0]["agentname"]);
						}
						?>
					</span>
					<span class="onbehalf-col">
						<?
						if(isset($log["details"]["onbehalf"]) && !empty($log["details"]["onbehalf"])){
						$userdata = $this->db->get_where("tblagent",array("agentcode"=>$log["details"]["onbehalf"]))->result_array();
						print($userdata[0]["agentname"]);
						}
						?>
					</span>
					<span class="onbehalf-col">
						<?
						
						$units = unserialize($log["unit_id"]);
						
						foreach($units as $unit){
						$unit_details = $this->db->get_where("units",array("unit_id"=>$unit))->result_array();
						print($unit_details[0]["unit"].",");
						}
						
						?>
					</span>
				</li>
				
				<?
				}
				?>
				<?
				$pagination_links = trim($pagination_links);
				if(!empty($pagination_links)){
				?>
				<li class="list-row pagination-links">
					<?=$pagination_links?>
				</li>
				<?
				}
				?>
			</ul>
		</div>
		<!-- // Example row -->
	</section>
</div>
<!-- // page content -->