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
				<span class="form-field-title">Date</span>
				<span class="form-field">
					
					<input type="text"  readonly="readonly" value="<?=date("d/m/Y",strtotime($log["form_datetime"]))?>" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Time</span>
				<span class="form-field">
					
					<input type="text"  readonly="readonly"  value="<?=date("Hi",strtotime($log["form_datetime"]))?>" />
					<input type="hidden" class="datetime-field" name="datetime" value="<?=$log["datetime"]?>" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Subject</span>
				<span class="form-field">
					<input type="text" name="subject" readonly="readonly"  value="<?=$log["subject"]?>" />
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
			<?
			if(trim($log["subject"]) != "Equipment Release"){
			?>
			<?
			if(isset($this->userdetails["permissions"]["accept_frn"])){
			?>
			<div class="form-row">
				<span class="form-field-title">FRN: *</span>
				<span class="form-field">
					<input type="text" name="frn" value="<?=$log["frn"]?>" required="required" />
				</span>
			</div>
			<?
			}
			?>
			
			
			
			<div class="form-row">
				<span class="form-field-title">FRN Status</span>
				<span class="form-field">
					<select name="frnstatus" <?if($this->userdetails["agentrole"] != "3"){?>disabled="disabled"<?}?> >
						<option value="">--FRN Status--</option>
						<?
						foreach($frnstatuses as $frnstatus){
						?>
						<option value="<?=$frnstatus["id"]?>" <?
							if($log["frnstatus"]==$frnstatus["id"]){
							?>
							selected="selected"
							<?
							}
							if(($frnstatus["frnstatus"] == "pending") || ($frnstatus["frnstatus"] == "cleared")){
							?>
							disabled="disabled"
							<?
							}
							?>
							>
							<?=$frnstatus["frnstatus"]?>
						</option>
						<?
						}
						?>
					</select>
				</span>
			</div>
			
			<div class="form-row">
				<span class="form-field-title">Department</span>
				<span class="form-field">
					<select name="frnstatus" <?if($this->userdetails["agentrole"] != "3"){?><?}?> >
						<option value="">--Department Name--</option>
						<?
						foreach($department as $departments){
						?>
						<option value="<?=$departments["id"]?>"><?echo $departments["name"];?>
						</option>
						<?
						}
						?>
					</select>
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Department Job number: </span>
				<span class="form-field">
					
					<input type="text" name="dep_j_num" placeholder="Outer Job Number"  />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Error Text: *</span>
				<span class="form-field">
					<input type="text" name="error_text" value="<?=$log["error_text"]?>" readonly="readonly" required="required" />
				</span>
			</div>
			
			
			<div class="form-row">
				<span class="form-field-title">Fault Reporting Number: *</span>
				<span class="form-field">
					
					<input type="text" name="faultNum" value="<?
					
					
					echo $log["id"]; echo "-".date("m/y"); ?>" readonly="readonly" required="required" />
				</span>
			</div>
			
			
			<?
			}else{
			?>
			<div class="form-row">
				<span class="form-field-title">Purpose Of Release: *</span>
				<span class="form-field">
					<input type="text" name="error_text" value="<?=$log["purpose_of_release"]?>" readonly="readonly" required="required" />
				</span>
			</div>
			<?
			}
			?>
			
			
			
			<div class="form-row" style="clear:left;">
				<span class="form-field-title">On Behalf</span>
				<span class="form-field">
					<select name="onbehalf" disabled="disabled">
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
					<input type="text" name="position_name" value="<?=$log["position_name"]?>" readonly="readonly" required="required" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Console Number: *</span>
				<span class="form-field">
					<input type="text" name="console_number" value="<?=$log["console_number"]?>" readonly="readonly" required="required" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">System/Equipment: *</span>
				<span class="form-field">
					<input type="text" name="system_equipment" value="<?=$log["system_equipment"]?>" readonly="readonly" required="required" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title"></span>
				<span class="form-field">
					
					<input type="button" class="btn" value="Create Job" onclick="insertNewjob(<?=$log["id"]?>);" />
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