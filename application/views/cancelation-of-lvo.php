<div id="page-content" class="page-content">
	<section>
		<div class="row-fluid margin-top20"><!-- // column -->
		<form class="emergency-edit-form" method="post" action="<?=base_url()?>elog/cancellvo">
			
			<div class="row">
				<div class="col-md-6">
					<span class="form-field-title">Initiate Lvo ID: *</span>
					<span class="form-field">
						<input type="text" name="Initiate_Lvo_ID" class="form-control" value="<?=$PostId?>" readonly="readonly" required="required" />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Initial</span>
					<span class="form-field">
						<?
						$user_data = $this->db->get_where("tblagent",array("agentcode"=>$log["initial"]))->result_array();
						?>
						<input type="hidden" name="initial" class="form-control" value="<?=$log["initial"]?>" />
						<input type="text" readonly="readonly" class="form-control" value="<?=$user_data[0]["agentname"]?>" />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Date</span>
					<span class="form-field">
						
						<input type="text"  readonly="readonly" name="date" class="form-control" value="<?=date("d/m/Y",strtotime($log["datetime"]))?>" />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Time</span>
					<span class="form-field">
						
						<input type="text"  readonly="readonly" class="form-control" name="time"  value="<?=date("H:i",strtotime($log["datetime"]))?>" />
						<input type="hidden" class="datetime-field form-control" value="<?=$log["datetime"]?>" />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Subject</span>
					<span class="form-field">
						<input type="text" name="subject" class="form-control" readonly="readonly"  value="Cancel LVO"<?=$log["subject"]?> />
					</span>
				</div>
				
				<div class="col-md-6">
					<span class="form-field-title">On Behalf</span>
					<span class="form-field">
						
						<select name="onbehalf" class="form-control">
							<option value="">Select</option>
							<?
							foreach($allUsers as $key=>$user){
							?>
							<option value="<?=$user["agentcode"]?>"><?=$user["agentname"]?></option>
							<?
							}
							?>
						</select>
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Cancel Weather Standby: </span>
					<span class="form-field">
						<select name="Request_Weather_Standby" class="form-control">
							<option value="">Select</option>
							<?
							foreach($allUsers as $key=>$user){
							?>
							<option value="<?=$user["agentname"]?>"><?=$user["agentname"]?></option>
							<?
							}
							?>
						</select>
						
					</span>
				</div>
				
				<div class="col-md-6">
					<span class="form-field-title">Update ATIS
					(LVO in Force): </span>
					<span class="form-field">
						
						<select name="Update_ATIS" class="form-control" >
							<option value="">Select</option>
							<?
							foreach($allUsers as $key=>$user){
							?>
							<option value="<?=$user["agentname"]?>"><?=$user["agentname"]?></option>
							<?
							}
							?>
						</select>
						
					</div>
					
					<div class="col-md-6">
						<span class="form-field-title">Operate AGL Panel: *</span>
						<span class="form-field" >
							
							<select name="Operate_AGL_Panel" class="form-control">
								<option value="">Select</option>
								<?
								foreach($allUsers as $key=>$user){
								?>
								<option value="<?=$user["agentname"]?>"><?=$user["agentname"]?></option>
								<?
								}
								?>
							</select>
						</span>
					</div>
					
					<div class="form-actions left">
						
						<div class="col-md-5">
							<div class=" form-actions" style="margin-top:5%">
								<input class="btn btn-primary" value="ok" onclick="cancellvo(<?=$log["id"]?>);" />
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<!-- // Example row -->
	</section>
</div>
<script type="text/javascript">
	$( ".time-field" ).timepicker({
		timeFormat: "HHmm",
		});
	$( ".date-field" ).datepicker({
		dateFormat:"dd/mm/yy",
		});
	$(document).on("change",".date-field,.time-field",function(){
			var date = $.datepicker.parseDate("dd/mm/yy",$(".date-field").val());
			var time = $(".time-field").val();
			time = time[0]+time[1]+":"+time[2]+time[3]+":00"
			date = $.datepicker.formatDate( "yy-mm-dd", date);
			var datetime = date+" "+time;
			$(".datetime-field").attr("value",datetime);
	});
</script>
<!-- // page content -->