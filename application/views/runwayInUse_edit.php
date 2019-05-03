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
						
						<input class="form-control" id="roci" name="roci" value="<?=$log["roci"]?>">
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
							<option value="<?=$user["agentcode"]?>" <?if($log["onbehalf"] == $user["agentcode"]){?>selected="selected"<?}?>><?=$user["agentname"]?></option>
							<?
							}
							?>
						</select>
						
					</span>
				</div>
				<?
				if(!empty($log["runway_in_use"])){
				$runway_in_use2 = $this->db->get_where("runway",array("runway_id"=>$log["runway_in_use"]))->result_array();
				
				?>
				<div class="col-md-6">
					<span class="form-field-title">Arrival Runway</span>
					<span class="form-field">
						<select name="runway_in_use" class="runway-status form-control"  disabled="disabled">
							<? foreach($runways as $runway){
							
							?>
							<option value="<?=$runway_in_use2[0]["runway_id"]?>"><?=$runway_in_use2[0]["runway"]?></option>
							<? } ?>
						</select>
					</span>
				</div>
				<?
				}else{
				?>
				<?
				if($log["31R"] != "Not In Use"){
				?>
				<div class="col-md-6">
					<span class="form-field-title">31R</span>
					<span class="form-field">
						<select name="31R" class="runway-status form-control"  disabled="disabled">
							<option value="Not In Use" <?if(trim($log["31R"]) == "Not In Use"){?>selected="selected"<?}?>>Not In Use</option>
							<option value="Arrival" <?if(trim($log["31R"]) == "Arrival"){?>selected="selected"<?}?> >Arrival</option>
							<option value="Departure" <?if(trim($log["31R"]) == "Departure"){?>selected="selected"<?}?>>Departure</option>
							<option value="Mix" <?if(trim($log["31R"]) == "Mix"){?>selected="selected"<?}?>>Mix</option>
						</select>
					</span>
				</div>
				<?
				}
				?>
				<?
				if($log["31L"] != "Not In Use"){
				?>
				<div class="col-md-6">
					<span class="form-field-title">31L</span>
					<span class="form-field">
						<select name="31L" disabled="disabled" class="form-control">
							<option value="Not In Use" <?if(trim($log["31L"]) === "Not In Use"){?>selected="selected"<?}?>>Not In Use</option>
							<option value="Arrival" <?if(trim($log["31L"]) === "Arrival"){?>selected="selected"<?}?> >Arrival</option>
							<option value="Departure" <?if(trim($log["31L"]) === "Departure"){?>selected="selected"<?}?>>Departure</option>
							<option value="Mix" <?if(trim($log["31L"]) === "Mix"){?>selected="selected"<?}?>>Mix</option>
						</select>
					</span>
				</div>
				<?
				}
				?>
				<?
				if($log["13R"] != "Not In Use"){
				?>
				<div class="col-md-6">
					<span class="form-field-title">13R</span>
					<span class="form-field">
						<select name="13R" disabled="disabled" class="form-control">
							<option value="Not In Use" <?if(trim($log["13R"]) == "Not In Use"){?>selected="selected"<?}?>>Not In Use</option>
							<option value="Arrival" <?if(trim($log["13R"]) == "Arrival"){?>selected="selected"<?}?> >Arrival</option>
							<option value="Departure" <?if(trim($log["13R"]) == "Departure"){?>selected="selected"<?}?>>Departure</option>
							<option value="Mix" <?if(trim($log["13R"]) == "Mix"){?>selected="selected"<?}?>>Mix</option>
						</select>
					</span>
				</div>
				<?
				}
				?>
				<?
				if($log["13L"] != "Not In Use"){
				?>
				<div class="col-md-6">
					<span class="form-field-title">13L</span>
					<span class="form-field">
						<select name="13L" disabled="disabled" class="form-control">
							<option value="Not In Use" <?if(trim($log["13L"]) == "Not In Use"){?>selected="selected"<?}?>>Not In Use</option>
							<option value="Arrival" <?if(trim($log["13L"]) == "Arrival"){?>selected="selected"<?}?> >Arrival</option>
							<option value="Departure" <?if(trim($log["13L"]) == "Departure"){?>selected="selected"<?}?>>Departure</option>
							<option value="Mix" <?if(trim($log["13L"]) == "Mix"){?>selected="selected"<?}?>>Mix</option>
						</select>
					</span>
				</div>
				<?
				}
				?>
				<?
				}
				?>
				<?
				if(!empty($log["runway_in_use_depart"])){
				$runway_in_use2 = $this->db->get_where("runway",array("runway_id"=>$log["runway_in_use_depart"]))->result_array();
				
				?>
				<div class="col-md-6">
					<span class="form-field-title">Departure Runway</span>
					<span class="form-field">
						<select name="runway_in_use_depart" class="runway-status form-control"  disabled="disabled">
							<? foreach($runways as $runway){
							
							?>
							<option value="<?=$runway_in_use2[0]["runway_id"]?>"><?=$runway_in_use2[0]["runway"]?></option>
							<? } ?>
						</select>
					</span>
				</div>
				<?
				}
				?>
				<?
				if(!empty($log["unit_id"])){
				$unit_in_use = $this->db->get_where("units",array("unit_id"=>$log["unit_id"]))->result_array();
				
				
				?>
				<div class="col-md-6">
					<span class="form-field-title">Unit</span>
					<span class="form-field">
						<select name="runway_in_use_depart" class="runway-status form-control"  disabled="disabled">
							<? foreach($runways as $runway){
							
							?>
							<option value="<?=$unit_in_use[0]["unit_id"]?>"><?=$unit_in_use[0]["unit"]?></option>
							<? } ?>
						</select>
					</span>
				</div>
				<?
				}
				?>
			</div>
			<div class="row">
				<div class="form-actions left">
					<?php if(isset($this->userdetails["permissions"]["runway_inuse"]) && ($this->userdetails["permissions"]["access_actions_field"]) && ($this->userdetails["permissions"]["Add_Runways"]) || ($this->userdetails["role"] == "admin") ) {?>
					<div class="col-md-5">
						<div class=" form-actions" style="margin-top:5%">
							
							<input type="button" onclick="updateRunwayInUse(<?=$log["id"]?>);" class="btn btn-success" value="Submit" />
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