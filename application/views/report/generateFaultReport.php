<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>Fault Report
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
			<div class="portlet-body form">
				
				<form action="<?=base_url()?>report/generateFaultReport" class="log-add-form" method="post">
					
					<div class="row pform" style="padding-top:1%;"  >
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">From</span>
								
								<input type="text" name="from" class="reportdatefield form-control" value="<?=date("m/d/Y")?>" />
								
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">To</span>
								<input type="text" name="to" class="reportdatefield2 form-control" value="<?=date("m/d/Y")?>" />
							</div>
						</div>
						
						
						
						
						
					</div>
					
					
					
					
					<div class="row pform" >
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">On Behalf </span>
								
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
						
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">Initial</span>
								<select class="form-control" name="initial">
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
								<span class="form-field-title">Position </span>
								
								<select name="position_name" class="form-control">
									<option value="">--Select User--</option>
									<?
									foreach($positions as $key=>$position){
									?>
									<option value="<?=$position["name"]?>"><?=$position["name"]?></option>
									<?
									}
									?>
								</select>
								
							</div>
						</div>
						
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">Equipment</span>
								<select name="system_equipment" class="form-control">
									<option value="">--Select User--</option>
									<?
									foreach($equipments as $key=>$equipment){
									?>
									<option value="<?=$equipment["name"]?>"><?=$equipment["name"]?></option>
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
								<span class="form-field-title">Console </span>
								
								<select name="console_number" class="form-control">
									<option value="">--Select User--</option>
									<?
									foreach($consoleNumbers as $key=>$number){
									?>
									<option value="<?=$number["name"]?>"><?=$number["name"]?></option>
									<?
									}
									?>
								</select>
								
							</div>
						</div>
						
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">FRN Status</span>
								<select name="frnstatus" class="form-control">
									<option value="">--FRN Status--</option>
									<?
									foreach($frnstatuses as $frnstatus){
									?>
									
									<option value="<?=$frnstatus["id"]?>" ><?=$frnstatus["frnstatus"]?></option>
									<?
									}
									?>
								</select>
								
							</div>
						</div>
						
						
						
					</div>
					
					<div class="row pform" style="padding-bottom:2%; ">
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">Unit </span>
								
								<select name="unit_id" class="form-control">
									<option value="">--Select--</option>
									<?
									foreach($units as $key=>$unit){
									?>
									<option value="<?=$unit["unit_id"]?>"><?=$unit["unit"]?></option>
									<?
									}
									?>
								</select>
								
							</div>
						</div>
						
						
						
						
						
					</div>
					
					
					
					
					
					
					<div class="form-actions left">
						
						<div class="col-md-5">
							
							
							
							<div class=" form-actions" style="border-top: 0">
								
								
								<input type="submit" class="btn btn-success" value="Submit" />
								<input type="reset" class="btn btn-danger" value="Cancel" />
								
							</div>
							
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- form -->
<style>
	.pform
	{
		padding-left:2%;
		padding-right:2%;
	}
</style>
<div class="reports-actions" style="padding-bottom: 1%">
	<input type="button" id="print" class="btn btn-primary" value="Print Report" />
	<!-- <input type="button" onclick="reportPDF('null','null','null','create','fault');" class="btn btn-primary" value="Download Report" /> -->
</div>
<?
$unit_name = $this->db->get_where("units",array("unit_id"=>$_POST["unit_id"]))->row();
?>
<div class="row" id="printableArea">
	<div id="printheader" style="display: none">
		<div class="row" style="margin-right: 0;margin-left: 0;margin-bottom: 10px">
			<div class="col-md-12" style="margin-top: 3%;">
				<img src="<?=base_url()?>assets//admin/layout4/img/dans_logo.jpg" id="logo" style="width: 170px">
				<img src="<?=base_url()?>assets//admin/layout4/img/atmars1.png" id="logo" style="width: 186px;float: right;margin-top: 15px;">
			</div>
		</div>
		<div class="row" style="margin-right: 0;margin-left: 0;margin-bottom: 10px">
			<div class="col-md-12" style="margin-top: 3%;text-align: center;">
				<h2 style="margin-top: 0;"><b>Fault Report</b></h2>
			</div>
		</div>
		<div class="row" style="margin-right: 0;margin-left: 0;margin-bottom: 10px">
			<div class="col-md-6 col-sm-6 col-xs-6">
				<h4 style="margin-top: 0;">From: <b><? echo $_POST['from']; ?></b></h4>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-6">
				<h4 style="margin-top: 0;text-align: right;">Unit: <b><? if (!empty($unit_name->unit)) {
				echo $unit_name->unit;
				} else {
				$allunits = $this->db->query("SELECT * FROM units");
				
				foreach($allunits->result() as $vall){
				
				?>
				<?=$vall->unit.',';?>
				<?}
				} ?>
				
				</b></h4>
			</div>
		</div>
		<div class="row" style="margin-right: 0;margin-left: 0;margin-bottom: 10px">
			<div class="col-md-6 col-sm-6 col-xs-6">
				<h4 style="margin-top: 0;">To: <b><? echo $_POST['to']; ?></b></h4>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-6">
				<h4 style="margin-top: 0;text-align: right;">Date Generated: <b><?=date("m/d/Y")?></b></h4>
			</div>
		</div>
	</div>
	<div class="col-md-12 mt" >
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet box purple remBox">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop remIcon"></i>Fault Report
					<hr class="hr" style="display: none">
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
				
				<div class="table-scrollable">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th scope="col" >
									Initial
								</th>
								<th scope="col">
									Time
									
								</th>
								<th scope="col">
									Position
									
								</th>
								<th scope="col">
									Console
									
								</th>
								<th scope="col" >
									ATE Comments
								</th>
								<th scope="col" >
									FRN
								</th>
								<th scope="col" >
									FRN Status
								</th>
								<th scope="col">
									System Equipment
								</th>
								<th scope="col">
									Error Message
								</th>
								<th scope="col" >
									Description
								</th>
								<th scope="col" class="action">
									Action
								</th>
								
								
							</tr>
						</thead>
						<tbody>
							<?
							if(!empty($faultReportingLogs)){
							foreach($faultReportingLogs as $key=>$faultReport){
							$frnstats = $this->db->get_where("frnstatus",array("id"=>$faultReport["fr_frnstatus"]))->row();
							$date = date('d/m/Y',strtotime($faultReport["fr_datetime"]));
							$time = date("H:m:s",strtotime($faultReport["fr_datetime"]));
							?>
							
							<tr >
								<td>
									<?=$faultReport["initial_details"]["agentname"]?>
								</td>
								<td>
									<?=$date?> <?=$time?>
								</td>
								<td>
									<?=$faultReport["fr_position_name"]?>
								</td>
								<td>
									<?=$faultReport["fr_console_number"]?>
								</td>
								<td><?=$faultReport["fr_ate"]?></td>
								<td><?=$faultReport["fr_faultNum"]?></td>
								<td><?=$frnstats->frnstatus?></td>
								<td>
									<?=$faultReport["fr_system_equipment"]?>
									
								</td>
								<td>
									<?=$faultReport["fr_error_text"]?>
									
								</td>
								<td><?=$faultReport["fr_any_other_details"]?></td>
								<td class="action">
									<button class="btn-delete-row btn btn-danger" onclick="deleteDailyReportRow(this,<?=$faultReport["fr_id"]?>,'fault');">Del</button>
									
									
								</td>
								
								
							</tr>
							
							
							
							
							
							
							<? }
							
							}
							else{
							?>
							<tr>
								<td colspan="11">Fault report not available!</td>
							</tr>
							<?
							}
							?>
							
							
						</tbody>
						
					</table>
				</div>
			</div>
		</div>
		<!-- END SAMPLE TABLE PORTLET-->
		<div class="row foot" style="display: none;position: fixed;bottom: 0">
			<h4 style="margin-top: 50px;">Report Generated By: <b><?=$this->userdetails["firstname"]?></b><b>-<?=$this->userdetails["role"]?></b></h4>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
$("#print").click(function(){
	$(".remBox").removeClass("portlet box purple");
	$(".caption").css({"font-size": "25px","text-align": "center"});
	$(".hr").css({"display": "block"});
	$(".mt").css({"margin-top": "30px"});
	$(".remIcon").hide();
	$(".action").hide();
	$(".foot").show();
	printDiv();
	$(".foot").hide();
	$(".action").show();
	$(".remIcon").show();
	$(".remBox").addClass("portlet box purple");
	$(".caption").css({"font-size": "18px"});
	$(".hr").css({"display": "none"});
	$(".mt").css({"margin-top": "0"});
});
});
				function printDiv() {
var printContents = document.getElementById('printableArea').innerHTML;
var originalContents = document.body.innerHTML;
document.body.innerHTML = printContents;
var yourUl = document.getElementById("printheader");
	yourUl.style.display = yourUl.style.display === 'none' ? 'block' : 'none';
window.print();
document.body.innerHTML = originalContents;
}
</script>
<style>
.report-container{
	float:left;
	width:100%;
	background:white
}
.report-heading {
	float: left;
	width: 99%;
	font-weight: bold;
	font-size: 110%;
	margin: 1% 0% 1% 0%;
	padding-left: 1%;
}
.general-report {
	float: left;
	width: 100%;
	border-bottom: 1px dashed gray;
}
.gr-list {
	float: left;
	width: 100%;
	list-style: none;
	margin: 0;
	padding: 0;
}
.gr-list .gr-head {
	float: left;
	width: 100%;
	margin: 0;
	font-weight: bold;
	background: lightgray;
	word-wrap: break-word;
}
.gr-list .gr-head .gr-initial {
	float: left;
	width: 10%;
	padding: 1%;
	word-wrap: break-word;
}
.gr-list .gr-head .gr-time {
	float: left;
	width: 10%;
	padding: 1%;
	word-wrap: break-word;
}
.gr-list .gr-head .gr-Management {
	float: left;
	width: 20%;
	padding: 1%;
	word-wrap: break-word;
}
.gr-list .gr-head .gr-actions {
	float: left;
	width: 20%;
	padding: 1%;
	word-wrap: break-word;
}
.gr-list .gr-head .gr-subject {
	float: left;
	width: 20%;
	padding: 1%;
	word-wrap: break-word;
}
.gr-list .gr-head .gr-action {
	float: left;
	width: 8%;
	padding: 1%;
	word-wrap: break-word;
}
.gr-list .gr-row {
	float: left;
	width: 100%;
	margin: 0;
	font-weight: normal;
	background: white;
	word-wrap: break-word;
	border-bottom: 1px solid gray;
	margin-bottom: 1px;
}
.gr-list .gr-row .gr-initial {
	float: left;
	width: 10%;
	padding: 0.5% 1% 0.5% 1%;
	word-wrap: break-word;
}
.gr-list .gr-row .gr-time {
	float: left;
	width: 10%;
	padding: 0.5% 1% 0.5% 1%;
	word-wrap: break-word;
}
.gr-list .gr-row .gr-Management {
	float: left;
	width: 20%;
	padding: 0.5% 1% 0.5% 1%;
	word-wrap: break-word;
}
.gr-list .gr-row .gr-actions {
	float: left;
	width: 20%;
	padding: 0.5% 1% 0.5% 1%;
	word-wrap: break-word;
}
.gr-list .gr-row .gr-subject {
	float: left;
	width: 20%;
	padding: 0.5% 1% 0.5% 1%;
	word-wrap: break-word;
}
.gr-list .gr-row .gr-action {
	float: left;
	width: 8%;
	padding: 0.5% 1% 0.5% 1%;
	word-wrap: break-word;
}
.fault-report {
	float: left;
	width: 100%;
	border-bottom: 1px dashed gray;
	word-wrap: break-word;
}
.report-heading {
	float: left;
	width: 100%;
	font-weight: bold;
	font-size: 110%;
	margin: 1% 0% 1% 0%;
	word-wrap: break-word;
}
.fr-list {
	float: left;
	width: 100%;
	list-style: none;
	margin: 0;
	padding: 0;
	word-wrap: break-word;
}
.fr-list .fr-head {
	float: left;
	width: 100%;
	margin: 0;
	font-weight: bold;
	background: lightgray;
	word-wrap: break-word;
}
.fr-list .fr-head .fr-initial {
	float: left;
	width: 10%;
	padding: 1%;
	word-wrap: break-word;
}
.fr-list .fr-head .fr-time {
	float: left;
	width: 10%;
	padding: 1%;
	word-wrap: break-word;
}
.fr-list .fr-head .fr-position {
	float: left;
	width: 12%;
	padding: 1%;
	word-wrap: break-word;
}
.fr-list .fr-head .fr-console {
	float: left;
	width: 12%;
	padding: 1%;
	word-wrap: break-word;
}
.fr-list .fr-head .fr-equipment {
	float: left;
	width: 14%;
	padding: 1%;
	word-wrap: break-word;
}
.fr-list .fr-head .fr-error-msg {
	float: left;
	width: 20%;
	padding: 1%;
	word-wrap: break-word;
}
.fr-list .fr-head .fr-action {
	float: left;
	width: 8%;
	padding: 1%;
	word-wrap: break-word;
}
.fr-list .fr-row {
	float: left;
	width: 100%;
	margin: 0;
	font-weight: normal;
	background: white;
	word-wrap: break-word;
	margin-bottom: 1px;
	border-bottom: 1px solid gray;
}
.fr-list .fr-row .fr-initial {
	float: left;
	width: 10%;
	padding: 0.5% 1% 0.5% 1%;
	word-wrap: break-word;
}
.fr-list .fr-row .fr-time {
	float: left;
	width: 10%;
	padding: 0.5% 1% 0.5% 1%;
	word-wrap: break-word;
}
.fr-list .fr-row .fr-position {
	float: left;
	width: 12%;
	padding: 0.5% 1% 0.5% 1%;
	word-wrap: break-word;
}
.fr-list .fr-row .fr-console {
	float: left;
	width: 12%;
	padding: 0.5% 1% 0.5% 1%;
	word-wrap: break-word;
}
.fr-list .fr-row .fr-equipment {
	float: left;
	width: 14%;
	padding: 0.5% 1% 0.5% 1%;
	word-wrap: break-word;
}
.fr-list .fr-row .fr-error-msg {
	float: left;
	width: 20%;
	padding: 0.5% 1% 0.5% 1%;
	word-wrap: break-word;
}
.fr-list .fr-row .fr-action {
	float: left;
	width: 8%;
	padding: 0.5% 1% 0.5% 1%;
	word-wrap: break-word;
}
</style>