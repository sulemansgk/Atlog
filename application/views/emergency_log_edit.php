<div id="page-content" class="page-content">
	<section>
		<div class="row-fluid margin-top20"><!-- // column -->
		<form class="emergency-edit-form" method="post" action="<?=base_url()?>emergency/updatelog">
			<div class="form-row">
				<span class="form-field-title">Initial</span>
				<span class="form-field">
					<?
					$user_data = $this->db->get_where("tblagent",array("agentcode"=>$log["initial"]))->result_array();
					?>
					<input type="hidden" name="initial" value="<?=$log["initial"]?>" />
					<input type="text" readonly="readonly" value="<?=$user_data[0]["agentname"]?>" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Time Of Incident</span>
				<span class="form-field">
					<span style="width:100%;">Date</span>
					
					<input type="text"  readonly="readonly" value="<?=date("d/m/Y",strtotime($log["datetime"]))?>" />
					<span style="width:100%;">Time</span>
					
					<input type="text"  readonly="readonly" value="<?=date("Hi",strtotime($log["datetime"]))?>" />
					<input type="hidden" class="datetime-field" name="datetime" value="<?=$log["datetime"]?>" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Subject</span>
				<span class="form-field">
					<input type="text" name="type_of_incident"  readonly="readonly" value="<?=$log["type_of_incident"]?>" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Details</span>
				<span class="form-field">
					<textarea rows="5" cols="45" id="textarea"  readonly="readonly" name="any_other_details"><?=$log["any_other_details"]?></textarea>
				</span>
			</div>
			<?
			if(isset($this->userdetails["permissions"]["access_management_field"]) || ($this->userdetails["role"] == "admin")){
			?>
			<div class="form-row">
				<span class="form-field-title">Management Comments</span>
				<span class="form-field">
					<textarea rows="5" cols="45" id="textarea" name="management"><?=$log["management"]?></textarea>
				</span>
			</div>
			<?
			}
			?>
			<?
			if(isset($this->userdetails["permissions"]["access_actions_field"]) || ($this->userdetails["role"] == "admin")){
			?>
			<div class="form-row">
				<span class="form-field-title">Unit Comments</span>
				<span class="form-field">
					<textarea rows="5" cols="45" id="textarea" name="actions"><?=$log["actions"]?></textarea>
				</span>
			</div>
			<?
			}
			?>
			
			<div class="form-row">
				<span class="form-field-title"></span>
				<span class="form-field">
					
					<input type="button" id="button" value="Update" onclick="updateEmergencyLog(<?=$log["id"]?>);" />
				</span>
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