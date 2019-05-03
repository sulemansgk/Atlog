<div id="page-content" class="page-content">
	<section>
		<div class="row-fluid margin-top20"><!-- // column -->
		<form class="emergency-edit-form" method="post" action="<?=base_url()?>elog/insertdetails">
			<div class="form-row">
				<span class="form-field-title">Initial</span>
				<span class="form-field">
					<?
					$user_data = $this->db->get_where("tblagent",array("agentcode"=>$log["initial"]))->result_array();
					?>
					<input type="hidden" value="<?=$log["initial"]?>" />
					<input type="text" readonly="readonly" value="<?=$user_data[0]["agentname"]?>" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Date</span>
				<span class="form-field">
					<input type="text"  readonly="readonly" value="<?=date("d/m/Y",strtotime($log["form_datetime"]))?>" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Time</span>
				<span class="form-field">
					<input type="text"  readonly="readonly"  value="<?=date("Hi",strtotime($log["form_datetime"]))?>" />
					<input type="hidden" class="datetime-field" value="<?=$log["datetime"]?>" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Subject</span>
				<span class="form-field">
					<input type="text"  readonly="readonly"  value="<?=$log["subject"]?>" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Details</span>
				<span class="form-field">
					<textarea rows="5" cols="45" id="textarea"  readonly="readonly" ><?=$log["any_other_details"]?></textarea>
				</span>
			</div>
			<?
			if(isset($this->userdetails["permissions"]["access_Management_field"]) || ($this->userdetails["role"] == "admin")){
			?>
			<div class="form-row">
				<span class="form-field-title">Management Comments</span>
				<span class="form-field">
					<textarea rows="5" cols="45" id="textarea" ><?=$log["Management"]?></textarea>
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
					<textarea rows="5" cols="45" id="textarea"><?=$log["actions"]?></textarea>
				</span>
			</div>
			<?
			}
			?>
			<?
			if(trim($log["subject"]) != "Equipment Release"){
			?>
			<?
			if(isset($this->userdetails["permissions"]["accept_frn"])){
			?>
			<div class="form-row">
				<span class="form-field-title">FRN Status: *</span>
				<span class="form-field">
					<input type="text" readonly="readonly" value="<?=$log["frn"]?>" required="required" />
				</span>
			</div>
			<?
			}
			?>
			
			
			<div class="form-row">
				<span class="form-field-title">Error Text: *</span>
				<span class="form-field">
					<input type="text"  value="<?=$log["error_text"]?>" readonly="readonly" required="required" />
				</span>
			</div>
			
			
			<div class="form-row">
				<span class="form-field-title">Fault Reporting Number: *</span>
				<span class="form-field">
					
					<input type="text" value="<?
					
					
					echo $log["id"]; echo "-".date("m/y"); ?>" readonly="readonly" required="required" />
				</span>
			</div>
			
			
			<?
			}else{
			?>
			<div class="form-row">
				<span class="form-field-title">Purpose Of Release: *</span>
				<span class="form-field">
					<input type="text"  value="<?=$log["purpose_of_release"]?>" readonly="readonly" required="required" />
				</span>
			</div>
			<?
			}
			?>
			
			
			
			<div class="form-row" style="clear:left;">
				<span class="form-field-title">On Behalf</span>
				<span class="form-field">
					<select  disabled="disabled">
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
			<div class="form-row">
				<span class="form-field-title">Position Name: *</span>
				<span class="form-field">
					<input type="text"  value="<?=$log["position_name"]?>" readonly="readonly" required="required" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Console Number: *</span>
				<span class="form-field">
					<input type="text"  value="<?=$log["console_number"]?>" readonly="readonly" required="required" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">System/Equipment: *</span>
				<span class="form-field">
					<input type="text"  value="<?=$log["system_equipment"]?>" readonly="readonly" required="required" />
				</span>
			</div>
			
			<?php if($log["Remarks"]==Null ||($log["Remarks"]=="" )){ }else{?>
			
			
			
			<div class="form-row">
				<span class="form-field-title">Remarks </span>
				<span class="form-field">
					<textarea rows="5" cols="45" id="textarea"  readonly="readonly" ><?=$log["Remarks"]?></textarea>
				</span>
			</div>
			<input type="hidden" name="id" value="<?=$log["id"]?>" />
			<input type="hidden" name="action_perfomed" value="0" />
			<?php }?>
			
			<div class="form-row">
				<span class="form-field-title">Details </span>
				<span class="form-field">
					<textarea rows="5" cols="45" id="textarea"  name= "sendbckdetail"  > </textarea>
				</span>
			</div>
			
			<div class="form-row">
				<span class="form-field-title"></span>
				<span class="form-field">
					
					<input type="submit" class="btn" value="Save Details"  />
				</span>
			</div>
			<?php //}?>
			
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