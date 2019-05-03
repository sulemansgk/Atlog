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
				<div class="col-md-6">
					<span class="form-field-title">ROSI</span>
					<span class="form-field">
						<input type="text" class="form-control" id="roci" name="roci" value="<?=$log["roci"]?>" >
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
				<div class="col-md-6">
					<span class="form-field-title">ATE Comments</span>
					<span class="form-field">
						<textarea class="form-control" id="textarea" name="ate"><?=$log["actions"]?></textarea>
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Description</span>
					<span class="form-field">
						<textarea class="form-control" id="textarea" name="description"><?=$log["description"]?></textarea>
					</span>
				</div>
				
				<?
				if(!empty($log["unit_id"])){
				$unit_in_use = $this->db->get_where("units",array("unit_id"=>$log["unit_id"]))->result_array();
				
				?>
				<div class="col-md-6">
					<span class="form-field-title">Unit*</span>
					<span class="form-field">
						<select name="unit_id" class="runway-status form-control"  disabled="disabled">
							
							<option value="<?=$unit_in_use[0]["unit_id"]?>"><?=$unit_in_use[0]["unit"]?></option>
							
						</select>
					</span>
				</div>
				<?
				}
				?>
			</div>
			<? $met_con = $this->db->get_where("met_condition",array("condition" => $log["condition"]))->row();
			
			?>
			<div class="row pform" style="padding-top:1%;"  >
				<div class="col-md-12" style="padding-bottom: 1%;">
					<span class="form-field-title">MET Conditions*</span>
				</div>
				
				<div class="col-md-2">
					<div class="form-group">
						
						
						<div class="form-field">
							<input type="radio" id="radio" name="condition" value="vmc" required="required" class="md-radiobtn" disabled="disabled" <? if($met_con->condition == 'vmc'){ ?> checked="checked" <? } ?> >
							<label for="radio1">
								<span class="inc"></span>
								<span class="check"></span>
								<span class="box"></span>
							VMC </label>
						</div>
					</div>
				</div>
				
				<div class="col-md-2">
					<div class="form-group">
						
						
						<div class="form-field">
							<input type="radio" id="radio" name="condition" value="imc" required="required" class="md-radiobtn" disabled="disabled" <? if($met_con->condition == 'imc'){ ?> checked="checked" <? } ?> >
							<label for="radio2">
								<span class="inc"></span>
								<span class="check"></span>
								<span class="box"></span>
							IMC </label>
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						
						
						<div class="form-field">
							<input type="radio" id="radio" name="condition" value="lvs" required="required" class="md-radiobtn" disabled="disabled" <? if($met_con->condition == 'lvs'){ ?> checked="checked" <? } ?> >
							<label for="radio3">
								<span class="inc"></span>
								<span class="check"></span>
								<span class="box"></span>
							LVS </label>
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						
						
						<div class="form-field">
							<input type="radio" id="radio" name="condition" value="lvo" required="required" class="md-radiobtn" disabled="disabled" <? if($met_con->condition == 'lvo'){ ?> checked="checked" <? } ?> >
							<label for="radio3">
								<span class="inc"></span>
								<span class="check"></span>
								<span class="box"></span>
							LVO </label>
						</div>
					</div>
				</div>

				<div class="col-md-2">
					<div class="form-group">
						
						
						<div class="form-field">
							<input type="radio" id="radio" name="condition" value="lvp" required="required" class="md-radiobtn" disabled="disabled" <? if($met_con->condition == 'lvp'){ ?> checked="checked" <? } ?> >
							<label for="radio3">
								<span class="inc"></span>
								<span class="check"></span>
								<span class="box"></span>
							LVP </label>
						</div>
					</div>
				</div>
				
				
			</div>
			<div class="row">
				<div class="form-actions left">
					<?php if(isset($this->userdetails["permissions"]["access_actions_field"]) && ($this->userdetails["permissions"]["Add_METCondition"]) || ($this->userdetails["role"] == "admin") ) {?>
					<div class="col-md-5">
						<div class=" form-actions" style="margin-top:5%">
							
							<input type="button" onclick="updateMetCondition(<?=$log["id"]?>);" class="btn btn-success" value="Submit" />
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