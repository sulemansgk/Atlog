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
					
					<?
					$user_data = $this->db->get_where("tblagent",array("agentcode"=>$log["initial"]))->result_array();
					?>
					<input type="hidden" name="initial" class="form-control" value="<?=$log["initial"]?>" />
					<input type="text" readonly="readonly" class="form-control" value="<?=$user_data[0]["agentname"]?>" />
					
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Time Of Incident</span>
					<span class="form-field">
						<span style="width:100%;">Date</span>
						
						<input type="text" readonly="readonly" class="form-control" value="<?=date("d/m/Y",strtotime($log["datetime"]))?>" />
					</div>
					<div class="col-md-6">
						<span style="width:100%;">Time</span>
						
						<input type="text" readonly="readonly" class="form-control" value="<?=date("Hi",strtotime($log["datetime"]))?>" />
						<input type="hidden" class="datetime-field form-control" name="datetime" value="<?=$log["datetime"]?>" />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Subject</span>
					<span class="form-field">
						<input type="text" name="type_of_incident" class="form-control"  readonly="readonly" value="<?=$log["type_of_incident"]?>" />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Details</span>
					<span class="form-field">
						<textarea class="form-control" id="textarea"  readonly="readonly" name="any_other_details"><?=$log["any_other_details"]?></textarea>
					</span>
				</div>
				<div class="col-md-6">
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
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<span class="form-field-title dialog-manage-field">Management Comments</span>
					<span class="form-field">
						<textarea class="form-control" id="textarea" name="management"><?=$log["management"]?></textarea>
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Unit Comments</span>
					<span class="form-field">
						<textarea class="form-control" id="textarea" name="actions"><?=$log["actions"]?></textarea>
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">ROSI</span>
					<span class="form-field">
						<input type="text" class="form-control" id="roci" name="roci" value="<?=$log["roci"]?>" >
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title"> Reason:</span>
					<span class="form-field">
						<input type="text" name="reason" value="<?=$log["reason"]?>" readonly="readonly" class="auto10 ui-autocomplete-input form-control" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Runway in use:</span>
					<span class="form-field">
						<input type="text" name="runway_in_use" value="<?=$log["runway_in_use"]?>" readonly="readonly" class="auto2 ui-autocomplete-input form-control" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title"> Time of Request (UTC):</span>
					<span class="form-field">
						<input type="text" name="time_of_request" value="<?=$log["time_of_request"]?>" readonly="readonly" class="datetime-field form-control" />
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
			date = $.datepicker.formaspanate( "yy-mm-dd", date);
			var datetime = date+" "+time;
			$(".datetime-field").attr("value",datetime);
	});
</script>