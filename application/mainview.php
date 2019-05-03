<div class="row-fluid page-head">
	<img src="<?=base_url()?>assets/img/gal.png" style="float:left" />
	<h2 class="page-title"><i class="fontello-icon-monitor"></i>E-Log Main Viewd</h2>
	<div class="page-bar">
		<div class="btn-toolbar"> </div>
	</div>
</div>
<!-- // page head -->
<div id="page-content" class="page-content">
	<section>
		<div class="row-fluid margin-top20">
			<ul class="logs-listing">
				<li class="list-row order-row">
					<form action="<?=base_url()?>elog/mainview" method="post">
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
					<span class="management-col">Management</span>
					<span class="frn-col">FRN</span>
					<span class="frnstatus-col">FRN Status</span>
					<span class="initial-col">Initial</span>
					<span class="onbehalf-col">On Behalf</span>
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
				<li class="list-row" onclick="<?=strtolower(str_replace("(","",str_replace(")","",str_replace(" ","",$log["log_type"]))))?>(<?=$log["log_id"]?>,this,'<?=$subject?>')">
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
						if($log["log_table"] != "rwy"){
						if(isset($log["details"]["any_other_details"])){
						print($log["details"]["any_other_details"]);
						}else if(isset($log["details"]["remarks"])){
						print($log["details"]["remarks"]);
						}else if(isset($log["details"]["description"])){
						print($log["details"]["description"]);
						}
						}else if($log["log_table"] == "rwy"){
						print("31R: ".$log["details"]["31R"].",31L: ".$log["details"]["31L"].",<br />13R: ".$log["details"]["13R"].",13L: ".$log["details"]["13L"]);
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
					<span class="management-col">
						<?
						if(isset($log["details"]["management"])){
						print($log["details"]["management"]);
						}
						?>
					</span>
					<!--<span class="location-col">
							<?
								if(isset($log["details"]["location"])){
									print($log["details"]["location"]);
								}
						?>
					</span>-->
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