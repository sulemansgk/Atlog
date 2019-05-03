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
					<span class="form-field-title">Subject</span>
					<span class="form-field">
						<input type="text" name="subject" class="form-control" readonly="readonly"  value="<?=$log["subject"]?>" />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Date</span>
					<span class="form-field">
						
						<input type="text"  readonly="readonly" class="form-control"  value="<?=date("d/m/Y",strtotime($log["datetime"]))?>" />
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
					<span class="form-field-title">Inspected Runway/Manoeuvring Area * </span>
					<span class="form-field">
						<select name="inspected_rwy_area" disabled="disabled" class="form-control">
							<option value="">Select</option>
							<?
							foreach($areanames as $key=>$area){
							?>
							<option value="<?=$area["id"]?>" <?if($log["inspected_rwy_area"] == $area["id"]){ print('selected="selected"'); }?> ><?=$area["areaname"]?></option>
							<?
							}
							?>
						</select>
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">[a] Runway Manoeuvring Area Inspection Completed</span>
					<span class="form-field">
						<input type="text" name="inspection_completed_time" class="form-control" readonly="readonly" value="<?=$log["inspection_completed_time"]?>" />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">[b] Daily Safety Inspection Form Completed</span>
					<span class="form-field">
						<input type="text" name="dailysafety_completed_time" class="form-control" readonly="readonly" value="<?=$log["dailysafety_completed_time"]?>" />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Runway Acceptable for Use?</span>
					<span class="form-field">
						<select name="rwy_acceptable_foruse" disabled="disabled" class="form-control">
							<option value="">Select</option>
							<option value="YES" <?if($log["rwy_acceptable_foruse"] == "YES"){ print('selected="selected"'); }?>>YES</option>
							<option value="NO" <?if($log["rwy_acceptable_foruse"] == "NO"){ print('selected="selected"'); }?>>NO</option>
							<option value="NA" <?if($log["rwy_acceptable_foruse"] == "NA"){ print('selected="selected"'); }?>>NA</option>
						</select>
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Manoeuvring Area Acceptable for Use?</span>
					<span class="form-field">
						<select name="area_acceptable_foruse" disabled="disabled" class="form-control">
							<option value="">Select</option>
							<option value="YES" <?if($log["area_acceptable_foruse"] == "YES"){ print('selected="selected"'); }?>>YES</option>
							<option value="NO" <?if($log["area_acceptable_foruse"] == "NO"){ print('selected="selected"'); }?>>NO</option>
							<option value="NA" <?if($log["area_acceptable_foruse"] == "NA"){ print('selected="selected"'); }?>>NA</option>
						</select>
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">
						Remarks
					</span>
					<span class="form-field">
						<textarea name="remarks" id="detail" class="form-control" readonly="readonly"><?=$log["remarks"]?></textarea>
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
						<?php//echo "<pre>"; print_r($log['rosi']); die(); ?>
						<textarea class="form-control" id="textarea" name="roci"><?=$log['roci']?></textarea>
					</span>
				</div>
			</div>
			<div class="row">
				<div class="form-actions left">
					<?php if(isset($this->userdetails["permissions"]["access_actions_field"]) && ($this->userdetails["permissions"]["add_inspection_entry"]) || ($this->userdetails["role"] == "admin") ) {?>
					<div class="col-md-5">
						<div class=" form-actions" style="margin-top:5%">
							
							<input type="button" onclick="updaterunwaymanoeuvringareainspection(<?=$log["id"]?>);" class="btn btn-success" value="Submit" />
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