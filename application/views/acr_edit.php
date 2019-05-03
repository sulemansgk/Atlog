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
						<input type="text" name="subject" class="form-control"  readonly="readonly" value="<?=$log["subject"]?>" />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Time Of Incident</span>
					<span class="form-field">
						<span style="width:100%;">Date</span>
						<input type="text"  readonly="readonly" class="form-control"  value="<?=date("d/m/Y",strtotime($log["datetime"]))?>" />
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
						<textarea class="form-control" id="textarea" readonly="readonly" name="remarks"><?=$log["remarks"]?></textarea>
					</span>
				</div>
				<?
				if(isset($this->userdetails["permissions"]["access_Management_field"]) || ($this->userdetails["role"] == "admin")){
				?>
				<div class="col-md-6">
					<span class="form-field-title">Management Comments</span>
					<span class="form-field">
						<textarea class="form-control" id="textarea" name="Management"><?=$log["Management"]?></textarea>
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
					
					<span class="group-title">1. Radio (PAE Standby Radio)</span>
					<span class="group-option">
						<i>a.</i>124.400 Mhz <input type="checkbox" <?if($log["124_4Mhz"] == "on"){?>checked="checked"<?}?> disabled="disabled" name="124_4Mhz" />
					</span>
					<span class="group-option">
						<i>b.</i>127.500 Mhz <input type="checkbox" <?if($log["127_5Mhz"] == "on"){?>checked="checked"<?}?> disabled="disabled" name="127_5Mhz" />
					</span>
					<span class="group-option">
						<i>c.</i>124.625 Mhz <input type="checkbox" <?if($log["124_6Mhz"] == "on"){?>checked="checked"<?}?> disabled="disabled" name="124_6Mhz" />
					</span>
					
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					
					<span class="group-title"><i>2.</i> Equipment</span>
					<span class="group-option">
						<i>a.</i>RADAR <input type="checkbox" <?if($log["radar"] == "on"){?>checked="checked"<?}?> disabled="disabled" name="radar" />
					</span>
					<span class="group-option">
						<i>b.</i>AWOS <input type="checkbox" <?if($log["awos"] == "on"){?>checked="checked"<?}?> disabled="disabled" name="awos" />
					</span>
					<span class="group-option">
						<i>c.</i>Air-Conditioning <input type="checkbox" <?if($log["air_conditioning"] == "on"){?>checked="checked"<?}?> disabled="disabled" name="air_conditioning" />
					</span>
					
				</div>
				<div class="col-md-6">
					
					<span class="group-title"><i>3.</i> Telephones</span>
					<span class="group-option">
						<i>a.</i>ATCC SUP <input type="checkbox" <?if($log["atcc_sup"] == "on"){?>checked="checked"<?}?> disabled="disabled" name="atcc_sup" />
					</span>
					<span class="group-option">
						<i>b.</i>ATCC ARR <input type="checkbox" <?if($log["atcc_arr"] == "on"){?>checked="checked"<?}?> disabled="disabled" name="atcc_arr" />
					</span>
					<span class="group-option">
						<i>c.</i>ATCC INFO <input type="checkbox" <?if($log["atcc_info"] == "on"){?>checked="checked"<?}?> disabled="disabled" name="atcc_info" />
					</span>
					<span class="group-option">
						<i>d.</i>ATCC ADCS <input type="checkbox" <?if($log["atcc_adcs"] == "on"){?>checked="checked"<?}?> disabled="disabled" name="atcc_adcs" />
					</span>
					<span class="group-option">
						<i>e.</i>ATCC AADN <input type="checkbox" <?if($log["atcc_aadn"] == "on"){?>checked="checked"<?}?> disabled="disabled" name="atcc_aadn" />
					</span>
					<span class="group-option">
						<i>f.</i>AES,MFC <input type="checkbox" <?if($log["aes_mfc"] == "on"){?>checked="checked"<?}?> disabled="disabled" name="aes_mfc" />
					</span>
					
				</div>
				<div class="col-md-6">
					
					<span class="group-title">&nbsp;</span>
					<span class="group-option" style="width: 75%;margin: 0;">
						<text> Cleaning Required</text>
						<input type="checkbox" name="cleaning" <?if($log["cleaning"] == "on"){?>checked="checked"<?}?> disabled="disabled" style="float: none;margin-left: 19%;"/>
					</span>
					
				</div>
				
				<div class="form-actions left">
					
					<div class="col-md-5">
						<div class=" form-actions" style="margin-top:5%">
							<input type="button" onclick="updateATC(<?=$log["id"]?>);" class="btn btn-success" value="Submit" />
						</div>
					</div>
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