<form action="<?=base_url()?>emergency/insertlog" class="emergency-edit-form" method="post">
	<?
	if($log["callstatus"] == "true"){
	?>
	<div class="call-email-status">
		<div class="form-row" style="clear:left;">
			<span class="form-field-title">Call Status:</span>
			<?
			foreach($log["phone_numbers"] as $key=>$phone){
			?>
			<span class="form-field" style="clear:left;margin-top: 1%;">
				<?
				print($phone["t_phone"]);
				if($phone["status"] != "calling"){
				?>
				<input type="button" class="btn btn-blue phone-status" value="Called" />
				<input type="button" class="btn btn-green" onclick="changeCallStatus(<?=$phone["p_id"]?>,this);" value="Redial" />
				<?
				}else{
				?>
				<input type="button" class="btn btn-blue phone-status" value="Calling" />
				<?
				}
				?>
			</span>
			<?
			}
			?>
		</div>
		<div class="form-row">
			<span class="form-field-title">Mailed To:</span>
			<span class="form-field">
				<?
				$emails = explode(",",$log["t_emails"]);
				if(!empty($emails)){
				foreach($emails as $key=>$email){
				print("<br />".$email);
				}
				}
				?>
			</span>
		</div>
	</div>
	<?
	}else{
	?>
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
						<input type="text" name="type_of_incident" class="form-control" readonly="readonly"  value="<?=$log["type_of_incident"]?>" />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Time Of Incident</span>
					<span class="form-field">
						<span style="width:100%;">Date</span>
						
						<input type="text"  readonly="readonly" class="form-control" value="<?=date("d/m/Y",strtotime($log["datetime"]))?>" />
					</div>
					<div class="col-md-6">
						<span style="width:100%;">Time</span>
						
						<input type="text" readonly="readonly" class="form-control" value="<?=date("Hi",strtotime($log["datetime"]))?>" />
						<input type="hidden" class="datetime-field form-control" name="datetime" value="<?=$log["datetime"]?>" />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Details</span>
					<span class="form-field">
						<textarea class="form-control" id="textarea"  readonly="readonly" name="any_other_details"><?=$log["any_other_details"]?></textarea>
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title dialog-manage-field">Management Comments</span>
					<span class="form-field">
						<textarea class="form-control" id="textarea" name="management"><?=$log["management"]?></textarea>
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title dialog-action-field">Unit Comments</span>
					<span class="form-field">
						<textarea class="form-control" id="textarea" name="actions"><?=$log["actions"]?></textarea>
					</span>
				</div>
				
				<div class="col-md-6">
					<span class="form-field-title">ROSI</span>
					<span class="form-field">
						<input type="text" class="form-control" id="roci" name="roci" value="<?=$log["roci"]?>">
					</span>
				</div>

				<div class="col-md-6">
					<span class="form-field-title">DECLARE (on airport)</span>
					<span class="form-field"><input type="radio" name="crash_type" id="radio" value="CRASH" disabled="disabled" <?if(trim($log["crash_type"]) == "CRASH"){?>checked="checked"<?}?> />Crash</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">DECLARE (off airport - on land)</span>
					<span class="form-field"><input type="radio" name="crash_type" id="radio" value="CRASH_OFF_AIRPORT" disabled="disabled" <?if(trim($log["crash_type"]) == "CRASH_OFF_AIRPORT"){?>checked="checked"<?}?> />CRASH OFF AIRPORT </span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">DECLARE (off airport - at sea)</span>
					<span class="form-field"><input type="radio" name="crash_type" id="radio" value="CRASH_AT_SEA"  disabled="disabled" <?if(trim($log["crash_type"]) == "CRASH_AT_SEA"){?>checked="checked"<?}?> />CRASH AT SEA</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Location (e.g. Runway):</span>
					<span class="form-field">
						<input type="text" name="location" value="<?=$log["location"]?>" class="form-control" readonly="readonly" placeholder="Enter value..." />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Aircraft Type:</span>
					<span class="form-field">
						<input type="text" name="aircraft_type" value="<?=$log["aircraft_type"]?>" class="form-control" readonly="readonly" placeholder="Enter value..." />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Persons on Board:</span>
					<span class="form-field">
						<input type="text" name="persons_on_board" value="<?=$log["persons_on_board"]?>" class="form-control" readonly="readonly" placeholder="Enter value..." />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Aircraft Operator:</span>
					<span class="form-field">
						<input type="text" name="aircraft_operator" value="<?=$log["aircraft_operator"]?>" class="form-control" readonly="readonly" placeholder="Enter value..." />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Callsign:</span>
					<span class="form-field">
						<input type="text" name="callsign" value="<?=$log["callsign"]?>" class="form-control" readonly="readonly" placeholder="Enter value..." />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Dangerous Goods:</span>
					<span class="form-field">
						<input type="text" class="form-control" name="dangerous_goods" value="<?=$log["dangerous_goods"]?>"  readonly="readonly" placeholder="Enter value..." />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Point of Departure:</span>
					<span class="form-field">
						<input type="text" name="point_of_departure" value="<?=$log["point_of_departure"]?>" class="form-control" readonly="readonly" placeholder="Enter value..." />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Destination:</span>
					<span class="form-field">
						<input type="text" name="destination" value="<?=$log["destination"]?>" class="form-control" readonly="readonly" placeholder="Enter value..." />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Nature of Accident:</span>
					<span class="form-field">
						<input type="text" name="nature_of_accident" class="form-control" value="<?=$log["nature_of_accident"]?>" readonly="readonly" placeholder="Enter value..." />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Time of Accident (UTC):</span>
					<span class="form-field">
						<input type="text" name="time_of_accident" class="form-control" value="<?=$log["time_of_accident"]?>" readonly="readonly" class="datetime-field" placeholder="Enter value..." />
					</span>
				</div>
				<div class="form-actions left">
					
					<div class="col-md-5">
						<div class=" form-actions" style="margin-top:5%">
							<input type="button" onclick="updateEmergencyLog(<?=$log["id"]?>);" class="btn btn-success" value="Submit" />
							<input type="reset" class="btn btn-danger" value="Cancel" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?
}
?>
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