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
					
					<input type="text"  readonly="readonly"  value="<?=date("d/m/Y",strtotime($log["datetime"]))?>" />
					<span style="width:100%;">Time</span>
					
					<input type="text"  readonly="readonly"  value="<?=date("Hi",strtotime($log["datetime"]))?>" />
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
					<textarea rows="5" cols="45"  readonly="readonly" id="textarea" name="any_other_details"><?=$log["any_other_details"]?></textarea>
				</span>
			</div>
			<div class="form-row" style="clear:left;">
				<span class="form-field-title"><?if($log["isphoned"] == 0){print("Calling");}else{print("Called");}?> To:</span>
				<span class="form-field">
					<?
					$phonenumbers = explode("PHONE NUMBERS:",$log["form_value"]);
					if(!empty($phonenumbers) && isset($phonenumbers[1])){
					$phonenumbers = explode(",",$phonenumbers[1]);
					foreach($phonenumbers as $key=>$phonenumber){
					print("<br />".$phonenumber);
					}
					}
					?>
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title"><?if($log["isemailed"] == 0){print("Mailing");}else{print("Mailed");}?> To:</span>
				<span class="form-field">
					<?
					$emails = explode("EMAILS:",$log["form_value"]);
					if(!empty($emails) && isset($emails[1])){
					$emails = explode("PHONE NUMBERS:",$emails[1]);
					$emails = explode(",",$emails[0]);
					foreach($emails as $key=>$email){
					print("<br />".$email);
					}
					}
					?>
				</span>
			</div>
			<div class="form-row" style="clear:left;">
				<span class="form-field-title dialog-manage-field">Management Comments</span>
				<span class="form-field">
					<textarea rows="5" cols="45" id="textarea" name="Management"><?=$log["Management"]?></textarea>
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Unit Comments</span>
				<span class="form-field">
					<textarea rows="5" cols="45" id="textarea" name="actions"><?=$log["actions"]?></textarea>
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title"> Time of Call from OMBY:</span>
				<span class="form-field">
					<input type="text" name="time_of_call_omby" value="<?=$log["time_of_call_omby"]?>" readonly="readonly" class="omby-datetime-field" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Location (e.g. Runway):</span>
				<span class="form-field"><input type="text" name="location" value="<?=$log["location"]?>" readonly="readonly" class="auto2 ui-autocomplete-input" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
			</span>
		</div>
		<div class="form-row">
			<span class="form-field-title">Aircraft Type:</span>
			<span class="form-field"><input type="text" name="aircraft_type" value="<?=$log["aircraft_type"]?>" readonly="readonly" class="auto3 ui-autocomplete-input" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
		</span>
	</div>
	<div class="form-row">
		<span class="form-field-title">Persons on Board:</span>
		<span class="form-field"><input name="persons_on_board" value="<?=$log["persons_on_board"]?>" readonly="readonly" type="text" id="textfield" maxlength="4">
	</span>
</div>
<div class="form-row">
	<span class="form-field-title">Aircraft Operator:</span>
	<span class="form-field"><input type="text" name="aircraft_operator" value="<?=$log["aircraft_operator"]?>" readonly="readonly" class="auto4 ui-autocomplete-input" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>                          </span>
</div>
<div class="form-row">
	<span class="form-field-title">Callsign:</span>
	<span class="form-field"><input type="text" name="callsign" value="<?=$log["callsign"]?>" readonly="readonly" class="auto5 ui-autocomplete-input" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
</span>
</div>
<div class="form-row">
<span class="form-field-title">Dangerous Goods:</span>
<span class="form-field"><input type="text" name="dangerous_goods" value="<?=$log["dangerous_goods"]?>" readonly="readonly" class="auto6 ui-autocomplete-input" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
</span>
</div>
<div class="form-row">
<span class="form-field-title">Point of Departure:</span>
<span class="form-field"><input type="text" name="point_of_departure" value="<?=$log["point_of_departure"]?>" readonly="readonly" class="auto7 ui-autocomplete-input" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
</span>
</div>
<div class="form-row">
<span class="form-field-title">Destination:</span>
<span class="form-field"><input type="text" name="destination" value="<?=$log["destination"]?>" readonly="readonly" class="auto8 ui-autocomplete-input" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
</span>
</div>
<div class="form-row">
<span class="form-field-title"> Nature of Accident:</span>
<span class="form-field">
<input type="text" name="nature_of_accident" value="<?=$log["nature_of_accident"]?>" readonly="readonly" class="auto9 ui-autocomplete-input" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
</span>
</div>
<div class="form-row">
<span class="form-field-title"> Time of Accident (UTC):</span>
<span class="form-field">
<input type="text" name="time_of_accident" value="<?=$log["time_of_accident"]?>" readonly="readonly" class="datetime-field" />
</span>
</div>
<div class="form-row">
<span class="form-field-title"></span>
<span class="form-field">
<input type="button" onclick="updateEmergencyLog(<?=$log["id"]?>);" class="btn" value="Submit" />
<input type="reset" class="btn btn-red" value="Cancel" />
</span>
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