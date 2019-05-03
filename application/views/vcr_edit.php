<form action="<?=base_url()?>emergency/insertlog" class="emergency-edit-form" method="post">
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
				<span class="form-field-title">Subject</span>
				<span class="form-field">
					<input type="text" name="subject"  readonly="readonly" value="<?=$log["subject"]?>" />
				</span>
			</div>
			<div class="form-row dialog-time-field">
				<span class="form-field-title">Time Of Incident</span>
				<span class="form-field">
					<span style="width:100%;">Date</span>
					<input type="text" readonly="readonly" value="<?=date("d/m/Y",strtotime($log["datetime"]))?>" />
					<span style="width:100%;">Time</span>
					
					<input type="text"  readonly="readonly" value="<?=date("Hi",strtotime($log["datetime"]))?>" />
					<input type="hidden" class="datetime-field" name="datetime" value="<?=$log["datetime"]?>" />
				</span>
			</div>
			<div class="form-row dialog-details-field">
				<span class="form-field-title">Details</span>
				<span class="form-field">
					<textarea rows="5" cols="45" id="textarea"  readonly="readonly" name="remarks"><?=$log["remarks"]?></textarea>
				</span>
			</div>
			<?
			if(isset($this->userdetails["permissions"]["access_Management_field"]) || ($this->userdetails["role"] == "admin")){
			?>
			<div class="form-row">
				<span class="form-field-title">Management Comments</span>
				<span class="form-field">
					<textarea rows="5" cols="45" id="textarea" name="Management"><?=$log["Management"]?></textarea>
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
			<ul class="form-row atc-form dialog-atc-values">
				<li>
					<span class="group-title">1. Radio (PAE Standby Radio)</span>
					<span class="group-option">
						<i>a.</i>119.200 Mhz <input type="checkbox" name="119_2Mhz" <?if($log["119_2Mhz"] == "on"){?>checked="checked"<?}?> disabled="disabled" />
					</span>
					<span class="group-option">
						<i>b.</i>118.675 Mhz <input type="checkbox" name="118_6Mhz" <?if($log["118_6Mhz"] == "on"){?>checked="checked"<?}?> disabled="disabled" />
					</span>
					<span class="group-option">
						<i>b.</i>123.975 Mhz <input type="checkbox" name="123_9Mhz" <?if($log["123_9Mhz"] == "on"){?>checked="checked"<?}?> disabled="disabled" />
					</span>
					<span class="group-option">
						<i>b.</i>121.950 Mhz <input type="checkbox" name="121_9Mhz" <?if($log["121_9Mhz"] == "on"){?>checked="checked"<?}?> disabled="disabled" />
					</span>
					<span class="group-option">
						<i>b.</i>125.100 Mhz <input type="checkbox" name="125_1Mhz" <?if($log["125_1Mhz"] == "on"){?>checked="checked"<?}?> disabled="disabled" />
					</span>
				</li>
				<li>
					<span class="group-title"><i>2.</i> Equipment</span>
					<span class="group-option">
						<i>a.</i>SMGC <input type="checkbox" name="SMGC" <?if($log["SMGC"] == "on"){?>checked="checked"<?}?> disabled="disabled" />
					</span>
					<span class="group-option">
						<i>b.</i>Binoculars <input type="checkbox" name="Binoculars" <?if($log["Binoculars"] == "on"){?>checked="checked"<?}?> disabled="disabled" />
					</span>
					<span class="group-option">
						<i>c.</i>Signal Gun <input type="checkbox" name="SignalGun" <?if($log["SignalGun"] == "on"){?>checked="checked"<?}?> disabled="disabled" />
					</span>
					<span class="group-option">
						<i>d.</i>Air-Conditioning <input type="checkbox" name="air_conditioning" <?if($log["air_conditioning"] == "on"){?>checked="checked"<?}?> disabled="disabled" />
					</span>
				</li>
				<li>
					<span class="group-title"><i>3.</i> Telephones</span>
					<span class="group-option">
						<i>a.</i>ATCC SUP <input type="checkbox" name="atcc_sup" <?if($log["atcc_sup"] == "on"){?>checked="checked"<?}?> disabled="disabled" />
					</span>
					<span class="group-option">
						<i>b.</i>ATCC ARR <input type="checkbox" name="atcc_arr" <?if($log["atcc_arr"] == "on"){?>checked="checked"<?}?> disabled="disabled" />
					</span>
					<span class="group-option">
						<i>c.</i>ATCC INFO <input type="checkbox" name="atcc_info" <?if($log["atcc_info"] == "on"){?>checked="checked"<?}?> disabled="disabled" />
					</span>
					<span class="group-option">
						<i>d.</i>ATCC ADCS <input type="checkbox" name="atcc_adcs" <?if($log["atcc_adcs"] == "on"){?>checked="checked"<?}?> disabled="disabled" />
					</span>
					<span class="group-option">
						<i>d.</i>ATCC AADN <input type="checkbox" name="atcc_aadn" <?if($log["atcc_aadn"] == "on"){?>checked="checked"<?}?> disabled="disabled" />
					</span>
					<span class="group-option">
						<i>d.</i>AES,MFC <input type="checkbox" name="aes_mfc" <?if($log["aes_mfc"] == "on"){?>checked="checked"<?}?> disabled="disabled" />
					</span>
				</li>
				<li>
					<span class="group-title">&nbsp;</span>
					<span class="group-option" style="width: 75%;margin: 0;">
						<text> Cleaning Required</text>
						<input type="checkbox" name="cleaning" style="float: none;margin-left: 19%;" <?if($log["cleaning"] == "on"){?>checked="checked"<?}?> disabled="disabled" />
					</span>
				</li>
			</ul>
			<div class="form-row">
				<span class="form-field-title"></span>
				<span class="form-field">
					
					<input type="button" onclick="updateATC(<?=$log["id"]?>);" class="btn" value="Submit" />
				</span>
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