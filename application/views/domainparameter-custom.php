<div class="row-fluid page-head">
	<img src="<?=base_url()?>assets/img/gal.png" style="float:left" />
	<h2 class="page-title"><i class="aweso-icon-list-alt"></i> Equipment Release</h2>
	<div class="page-bar">
		<div class="btn-toolbar"> </div>
	</div>
</div>
<!-- // page head -->
<form action="<?=base_url()?>elog/insertFaultReporting" class="log-add-form" method="post">
	<input type="hidden" name="subject" value="Equipment Release" />
	<input type="hidden" name="initial" value="<?=$this->userdetails["agentcode"]?>" />
	<input type="hidden" name="datetime" value="<?=date("Y-m-d H:i:s")?>" />
	<div id="page-content" class="page-content">
		<section>
			<div class="row-fluid margin-top20"><!-- // column -->
			<div class="form-row">
				<span class="form-field-title">Initials :</span>
				<span class="form-field">
					<input type="text" readonly="readonly" value="<?=$this->userdetails["agentname"]?>" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Date: *</span>
				<span class="form-field">
					<input type="text" class="date-field" value="<?=date("d/m/Y")?>" required="required" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Time: *</span>
				<span class="form-field">
					<input type="text" class="time-field" value="<?=date("Hi")?>" oninput="maxLengthCheck(this);" />
					<input type="hidden" class="datetime-field" name="form_datetime"  value="<?=date("Y-m-d H:i:s")?>" required="required" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">On Behalf Of: *</span>
				<span class="form-field">
					<select name="onbehalf" >
						<option value="">Select</option>
						<?
						foreach($allUsers as $key=>$user){
						?>
						<option value="<?=$user["agentcode"]?>"><?=$user["agentname"]?></option>
						<?
						}
						?>
					</select>
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Position Name: *</span>
				<span class="form-field">
					<input type="text" name="position_name" value="" required="required" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Console Number: *</span>
				<span class="form-field">
					<input type="text" name="console_number" value="" required="required" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">System/Equipment: *</span>
				<span class="form-field">
					<input type="text" name="system_equipment" value="" required="required" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Purpose Of Release: *</span>
				<span class="form-field">
					<input type="text" name="purpose_of_release" value="" required="required" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Description: *</span>
				<span class="form-field" style="width: 70%;">
					<textarea name="any_other_details" id="desc" style="width:290px;height:100px;"></textarea>
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title"></span>
				<span class="form-field">
					<input type="reset" class="btn btn-blue" value="Reset" />
					<input type="submit" class="btn" value="Submit" />
				</span>
			</div>
		</div>
		<!-- // Example row -->
	</section>
</div>
</form>