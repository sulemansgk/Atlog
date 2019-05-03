<form class="subject-edit-form" id="phone-edit-form" method="post">
	<div id="page-content" class="page-content">
		<section>
			<div class="row-fluid margin-top20"><!-- // column -->
			<div class="row">
				<div class="col-md-6">
					<span class="form-field-title">Phone Number</span>
					<span class="form-field">
						<input type="text" name="phone_number" class="form-control" value="<?=$phone["phone_number"]?>" placeholder="Enter value..." required="required"  />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Unit</span>
					<span class="form-field">
						<select name="unit_id" class="form-control" required="required" onchange="dpSelectChange(this);">
							<option value="">--Select--</option>
							<?
							foreach($units as $key=>$unit){
							?>
							<option <?if($phone["unit_id"] == $unit["unit_id"] ){?>selected="selected"<?}?>value="<?=$unit["unit_id"]?>"><?=$unit["unit"]?></option>
							<?
							}
							?>
						</select>
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title" style="width:14%;">For</span>
					<span class="form-field">
						<select name="for_form[]" class="mul-select-list form-control" multiple="multiple" required="required" style="width: 270px;">
							<option value="Aircraft Crash" <?if(strstr($phone["for_form"],"Aircraft Crash")){?>selected="selected"<?}?>>Air Craft Crash </option>
							<option value="Aircraft Ground Incident" <?if(strstr($phone["for_form"],"Aircraft Ground Incident")){?>selected="selected"<?}?>>Air Craft Ground Incident</option>
							<option value="Bomb Warning" <?if(strstr($phone["for_form"],"Bomb Warning")){?>selected="selected"<?}?>>Bomb Warning</option>
							<option value="Domestic Fire" <?if(strstr($phone["for_form"],"Domestic Fire")){?>selected="selected"<?}?>>Domestic Fire</option>
							<option value="Fuel Spillage" <?if(strstr($phone["for_form"],"Fuel Spillage")){?>selected="selected"<?}?>>Fuel Spillage</option>
							<option value="Fuel Emergency" <?if(strstr($phone["for_form"],"Fuel Emergency")){?>selected="selected"<?}?>>Fuel Emergency</option>
							<option value="Local Standby" <?if(strstr($phone["for_form"],"Local Standby")){?>selected="selected"<?}?>>Local Standby</option>
							<option value="Medical Emergency" <?if(strstr($phone["for_form"],"Medical Emergency")){?>selected="selected"<?}?>>Medical Emergency</option>
							<option value="OMAD Emergencies" <?if(strstr($phone["for_form"],"OMAD Emergencies")){?>selected="selected"<?}?>>OMAD Emergencies</option>
							<option value="OMBY Emergency" <?if(strstr($phone["for_form"],"OMBY Emergency")){?>selected="selected"<?}?>>OMBYE Emergencies</option>
							<option value="Unlawful Interference" <?if(strstr($phone["for_form"],"Unlawful Interference")){?>selected="selected"<?}?>>Unlawful Inteference</option>
							<option value="Weather Standby" <?if(strstr($phone["for_form"],"Weather Standby")){?>selected="selected"<?}?>>Weather Standby</option>
							<select/>
							</span>
						</div>
						<div class="col-md-6">
							<span class="form-field-title">Description</span>
							<span class="form-field">
								<textarea class="domain-desc form-control" name="description"><?=$phone["description"]?></textarea>
							</span>
						</div>
						<div class="form-actions left">
							<div class="col-md-6">
								<div class="form-actions" style="margin-top: 5%;">
									<input type="button" onclick="updatePhone(<?=$phone["phone_id"]?>);" class="btn btn-success" value="Submit" />
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</form>
	<script type="text/javascript">
	$(function(){
			$(".mul-select-list").multiselect({sortable: false, searchable: false});
	})
	</script>