<div id="page-content" class="page-content">
	<section>
		<div class="row-fluid margin-top20"><!-- // column -->
		<form class="emergency-edit-form" method="post" action="<?=base_url()?>emergency/updatelog">
			<div class="row">
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
						
						<input type="text"  readonly="readonly" class="form-control"  value="<?=date("m/d/Y",strtotime($log["datetime"]))?>" />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Time</span>
					<span class="form-field">
						
						<input type="text"  readonly="readonly" class="form-control" value="<?=date("H:i",strtotime($log["datetime"]))?>" />
						<input type="hidden" class="datetime-field form-control" name="datetime" value="<?=$log["datetime"]?>" />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">On Behalf</span>
					<span class="form-field">
						<select name="onbehalf" disabled="disabled" class="form-control">
							<option value="">--Select User--</option>
							<?
							foreach($allusers as $key=>$user){
							?>
							<option value="<?=$user["agentcode"]?>" <?if($log["onbehalf"] == $user["agentcode"]){?> selected="selected" <?}?> ><?=$user["agentname"]?></option>
							<?
							}
							?>
						</select>
						
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Subject</span>
					<span class="form-field">
						<?
						$subject = "";
						$subject_trim = trim($log["subject"]);
						if(!empty($subject_trim)){
						$subject_details = $this->db->get_where("subjectform",array("id"=>trim($log["subject"])))->result_array();
						if(!empty($subject_details)){
						$subject = $subject_details[0]["subject"];
						}
						}
						?>
						<input type="hidden"  readonly="readonly" class="form-control" name="subject" value="<?=$log["subject"]?>" />
						<input type="text"  readonly="readonly" class="form-control" value="<?=$subject?>" />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Details</span>
					<span class="form-field">
						<textarea class="form-control" id="textarea"  readonly="readonly" name="description"><?=$log["description"]?></textarea>
					</span>
				</div>
				<?
				if(isset($this->userdetails["permissions"]["access_management_field"]) || ($this->userdetails["role"] == "admin")){
				?>
				<div class="col-md-6">
					<span class="form-field-title">Management Comments</span>
					<span class="form-field">
						<textarea class="form-control" id="textarea" name="management"><?=$log["management"]?></textarea>
					</span>
				</div>
				<?
				}
				?>
				<?
				if(isset($this->userdetails["permissions"]["access_actions_field"]) || ($this->userdetails["role"] == "admin")){
				?>
				<div class="col-md-6">
					<span class="form-field-title">Unit Comments</span>
					<span class="form-field">
						<textarea class="form-control" id="textarea" name="actions"><?=$log["actions"]?></textarea>
					</span>
				</div>
				<?
				}
				?>
				<?
				if(isset($this->userdetails["permissions"]["AddATE"]) || ($this->userdetails["role"] == "admin")){
				?>
				<div class="col-md-6">
					<span class="form-field-title">ATE Comments</span>
					<span class="form-field">
						<textarea class="form-control" id="textarea" name="ate"><?=$log["ate"]?></textarea>
					</span>
				</div>
				<?
				}
				?>

				<div class="col-md-6">
					<span class="form-field-title">ROSI</span>
					<span class="form-field">
						<textarea class="form-control" id="textarea" name="roci"><?=$log["roci"]?></textarea>
					</span>
				</div>
				
				<div class="form-actions left">
					<?php if(isset($this->userdetails["permissions"]["access_actions_field"]) && ($this->userdetails["permissions"]["add_generalentry_logs"]) || ($this->userdetails["role"] == "admin") ) {?>
					<div class="col-md-5">
						<div class=" form-actions" style="margin-top:5%">
							
							<input type="button" class="btn btn-success" value="Update" onclick="updateGeneralEntry(<?=$log["id"]?>);" />
						</div>
					</div>
					<?php } ?>
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