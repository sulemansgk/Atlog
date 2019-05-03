<form action="<?=base_url()?>emergency/insertlog" class="emergency-edit-form" method="post">
	<div id="page-content" class="page-content">
		<section>
			<div class="row-fluid margin-top20"><!-- // column -->
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
					<span class="form-field-title"></span>
					<span class="form-field">
						<span style="width:100%;">Date</span>
						<input type="text"  readonly="readonly" class="form-control"  value="<?=date("d/m/Y",strtotime($log["datetime"]))?>" />
					</div>
					<div class="col-md-6">
						<span style="width:100%;">Time</span>
						<input type="text"  readonly="readonly" class="form-control"  value="<?=date("H:i",strtotime($log["datetime"]))?>" />
						<input type="hidden" class="datetime-field form-control" name="datetime" value="<?=$log["datetime"]?>" />
					</span>
				</div>
				
				<div class="col-md-6">
					<span class="form-field-title">Name</span>
					<span class="form-field">
						<?
						$name = "";
						if(!empty($log["name"])){
						$name = $this->db->get_where("tblagent",array("agentcode"=>$log["name"]))->result_array();
						$name = $name[0]["agentname"];
						}
						?>
						<input type="text" class="form-control" readonly="readonly"  value="<?=$name?>" />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Sent Home Time</span>
					<span class="form-field">
						<input type="text" class="form-control" readonly="readonly"  value="<?=$log["sent_home_time"]?>" />
					</span>
				</div>
			</div>
			<div class="row">
				<?
				if($log["call_out_required"] == "Yes"){
				$name2 = "";
				if(!empty($log["name2"])){
				$name2 = $this->db->get_where("tblagent",array("agentcode"=>$log["name2"]))->result_array();
				$name2 = $name2[0]["agentname"];
				}
				$shift_duty2 = "";
				if(!empty($log["shift_duty2"])){
				$shift_duty2 = $this->db->get_where("shift",array("id"=>$log["shift_duty2"]))->result_array();
				$shift_duty2 = $shift_duty2[0]["shift"];
				}
				?>
				
				<fieldset>
					<legend style="padding:10px;">Call Out Required: <?=$log["call_out_required"]?></legend>
					<div class="col-md-6">
						<span class="form-field-title">Name</span>
						<span class="form-field">
							<input type="text" class="form-control" value="<?=$name2?>" readonly="readonly" />
						</span>
					</div>
					<div class="col-md-6">
						<span class="form-field-title">Shift Duty</span>
						<span class="form-field">
							<input type="text" class="form-control" value="<?=$shift_duty2?>" readonly="readonly" />
						</span>
					</div>
				</fieldset>
				<?
				}else{
				?>
				<div class="col-md-6">
					<span class="form-field-title">Call Out Required</span>
					<span class="form-field">
						<input type="text" class="form-control" value="<?=$log["call_out_required"]?>" readonly="readonly" />
					</span>
				</div>
				<?
				}
				?>
				<div class="col-md-6">
					<?
					$due_to = "";
					if(!empty($log["due_to"])){
					$due_to = $this->db->get_where("staffabsensereason",array("id"=>$log["due_to"]))->result_array();
					$due_to = $due_to[0]["description"];
					}
					?>
					<span class="form-field-title">Due To</span>
					<span class="form-field">
						<input type="text" class="form-control" value="<?=$due_to?>" readonly="readonly" />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Remarks</span>
					<span class="form-field">
						<input type="text" class="form-control" value="<?=$log["remarks"]?>" readonly="readonly" />
					</span>
				</div>
			</div>
			<div class="row">
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
					<?php if(isset($this->userdetails["permissions"]["access_actions_field"]) && ($this->userdetails["permissions"]["add_staff_absence"]) || ($this->userdetails["role"] == "admin") ) {?>
					<div class="col-md-5">
						<div class=" form-actions" style="margin-top:5%">
							<input type="button" onclick="updatesenthome(<?=$log["id"]?>);" class="btn btn-success" value="Submit" />
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>
</div>
</form>
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