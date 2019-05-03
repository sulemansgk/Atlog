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
						<input type="text"  readonly="readonly" class="form-control" value="<?=date("m/d/Y",strtotime($log["datetime"]))?>" />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Time</span>
					<span class="form-field">
						<input type="text"  readonly="readonly" class="form-control"  value="<?=date("H:i",strtotime($log["datetime"]))?>" />
						<input type="hidden" class="datetime-field form-control" name="datetime" value="<?=$log["datetime"]?>" />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Subject</span>
					<span class="form-field">
						<input type="text" name="subject" readonly="readonly" class="form-control"  value="<?=$log["subject"]?>" />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Details</span>
					<span class="form-field">
						<textarea class="form-control" id="textarea" readonly="readonly"   name="any_other_details"><?=$log["any_other_details"]?></textarea>
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
				<!-- roci -->
				
				<div class="col-md-6">
					<span class="form-field-title">ROSI</span>
					<span class="form-field">
						<input type="text" class="form-control" id="textarea" name="roci" value="<?=$log["roci"]?>">
					</span>
				</div>
				

				<?
				if(trim($log["subject"]) != ""){
				?>
				<?
				if(isset($this->userdetails["permissions"]["accept_frn"]) || ($this->userdetails["role"] == "admin")){
				?>
				<?
				$frnstats  = $this->db->query("SELECT * FROM frnstatus WHERE id IN (7,14)");
				$equip  = $this->db->query("SELECT * FROM frnstatus WHERE id IN (12,13)");
				 //echo "<pre>";print_r($log);die();
					?>
					<div class="col-md-6">
						<span class="form-field-title">FRN Status: *</span>
						<span class="form-field">
							<select name="frnstatus" class="form-control">
								<? if ($log["subject"] == "Fault Reporting") { ?>
								
								<option value="">--Select FRN Status--</option>
								<?foreach($frnstats->result() as $key=>$user){
								//echo "<pre>";print_r($user);die();
									?>
									<option value="<?=$user->id?>"  <?php if($log['frnstatus'] == $user->id){
										echo "selected='selected'";
									}?>><?=$user->frnstatus?></option>
									<?
									} } else {?>
									<option value="">--Select FRN Status--</option>
									                               <?
									 foreach($equip->result() as $key=>$user){
									?>
									<option value="<?=$user->id?>"  <?php if($log['frnstatus'] == $user->id){
										echo "selected='selected'";
									}?>><?=$user->frnstatus?></option>
									<? }}  ?>
								</select>
							</span>
						</div>
						<div class="col-md-6">
							<span class="form-field-title">FRN: </span>
							<span class="form-field">
								
								<input type="text" class="form-control" name="faultNum" value="<?  
								echo $log["faultNum"];?>" />
							</span>
						</div>
						<?
						}
						?>
						<div class="col-md-6">
							<span class="form-field-title">Error Text: *</span>
							<span class="form-field">
								<input type="text" name="error_text" class="form-control" value="<?=$log["error_text"]?>" readonly="readonly" required="required" />
							</span>
						</div>
						<?
						}else{
						?>
						<div class="col-md-6">
							<span class="form-field-title">Purpose Of Release: *</span>
							<span class="form-field">
								<input type="text" name="purpose_of_release" class="form-control" value="<?=$log["purpose_of_release"]?>" readonly="readonly" required="required" />
							</span>
						</div>
						<?
						}
						?>
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
							<span class="form-field-title">Position Name: *</span>
							<span class="form-field">
								<input type="text" name="position_name" class="form-control" value="<?=$log["position_name"]?>" readonly="readonly" required="required" />
							</span>
						</div>
						<div class="col-md-6">
							<span class="form-field-title">Console Number: *</span>
							<span class="form-field">
								<input type="text" class="form-control" name="console_number" value="<?=$log["console_number"]?>" readonly="readonly" required="required" />
							</span>
						</div>
						<div class="col-md-6">
							<span class="form-field-title">System/Equipment: *</span>
							<span class="form-field">
								<input type="text" class="form-control" name="system_equipment" value="<?=$log["system_equipment"]?>" readonly="readonly" required="required" />
							</span>
						</div>
						
						<?php if($log["Remarks"]==Null ||($log["Remarks"]=="" )){ }else{?>
						
						
						
						<div class="col-md-6">
							<span class="form-field-title">Remarks </span>
							<span class="form-field">
								<textarea class="form-control" id="textarea"  readonly="readonly" ><?=$log["Remarks"]?></textarea>
							</span>
						</div>
						
						
						<?php }?>
						
						<?php if($log["sendbckdetail"]==Null ||($log["sendbckdetail"]=="" )){ }else{?>
						
						
						
						<div class="col-md-6">
							<span class="form-field-title">Details </span>
							<span class="form-field">
								<textarea class="form-control" id="textarea"  readonly="readonly" ><?=$log["sendbckdetail"]?></textarea>
							</span>
						</div>
						
						
						<?php }?>
						
						
						<?php if(isset($this->userdetails["permissions"]["Update_Fault"]) && ($this->userdetails["permissions"]["access_actions_field"]) && ($this->userdetails["permissions"]["add_fault_reporting"]) || ($this->userdetails["role"] == "admin") || ($this->userdetails["role"] == "CNS-Engineer")) {?>
						<div class="col-md-6">
							<br>
							<span class="form-field">
								
								<input type="button" class="btn btn-success" value="Update" onclick="updateFaultReporting(<?=$log["id"]?>);" />
							</span>
							
							<?php }?>
							<?php if(isset($this->userdetails["permissions"]["AddRts"]) || ($this->userdetails["role"] == "admin")){?>
							<? if ($log["subject"] == "Fault Reporting") { ?>
							<? if($log["frnstatus"] != 7){ ?>
							<span class="form-field">
								<a onclick="equipClosed(<?=$log['id']?>,this)" class="btn btn-success" style="color: white;">Return to Service</a>
							</span>
						</div>
						<?php } } }?>
						<?php if(isset($this->userdetails["permissions"]["AppRej"]) || ($this->userdetails["role"] == "admin")){?>
						<? if (($log["subject"] == "Equipment Release") && ($log['frnstatus'] == '')) { ?>
						<span class="form-field">
							<a onclick="approveEquip(<?=$log['id']?>,this)" class="btn btn-blue" style="background: green;color: white;">Approve</a>
							<a onclick="rejectEquip(<?=$log['id']?>,this)" class="btn btn-blue" style="background: rgb(147, 0, 0);color: white;" >Reject</a>
							
							
						</span>
					</div>
					<?php } }?>
					<?php if(isset($this->userdetails["permissions"]["Accept_Fault"])){?>
					<div class="col-md-6" style="padding-top:2%;">
						<span class="form-field-title"></span>
						<span class="form-field">
							
							<input type="button" class="btn btn-success"  value="Accept the Job" onclick="acceptjob(<?=$log["id"]?>,this,'Add Event',false);" />
						</span>
					</div>
					<?php }?>
					
					<?php if(isset($this->userdetails["permissions"]["Cancel_Fault"])){?>
					<div class="col-md-6" style="padding-top:2%;">
						<span class="form-field-title"></span>
						<span class="form-field">
							
							<input type="button" class="btn btn-danger" value="Cancel Fault" onclick="CancelFault(<?=$log["id"]?>,this,'Add Event',false);" />
						</span>
					</div>
					<?php }?>
					<?php if(isset($this->userdetails["permissions"]["Send_it_back"])){?>
					<div class="col-md-6" style="padding-top:2%;">
						<span class="form-field-title"></span>
						<span class="form-field">
							
							<input type="button" class="btn btn-success" value="Send It Back" onclick="SendItBck(<?=$log["id"]?>,this,'Add Event',<?=$log["initial"]?>,'<?=$log["error_text"]?>');" />
						</span>
					</div>
					<?php }?>
					<?php if(isset($this->userdetails["permissions"]["Transfer_fault"])){?>
					<div class="col-md-6" style="padding-top:2%;">
						
						<span class="form-field">
							
							<input type="button" class="btn btn-danger" value="Tranfer Fault" onclick="trnferfault(<?=$log["id"]?>,this,'Transfer Fault',false);" />
						</span>
					</div>
					<?php }?>
					
					
					
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