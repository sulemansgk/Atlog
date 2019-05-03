<?
$user_logged = $this->userdetails["agentunit"];
$user_unit = unserialize($user_logged);
?>
<form class="subject-edit-form" method="post">
	<div id="page-content" class="page-content">
		<section>
			<div class="row-fluid margin-top20"><!-- // column -->
			<div class="row">
				<div class="col-md-6">
					<span class="form-field-title">Subject</span>
					<span class="form-field">
						<input type="text" name="subject" class="form-control" value="<?=$subject["subject"]?>" placeholder="Enter value..." required="required"  />
					</span>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<span class="form-field-title">Unit</span>
						<select name="unit_id" class="form-control" required="required">
							<option value="">--Select--</option>
							<?
							
							foreach($user_unit as $unit){
							$unit_name = $this->db->get_where('units', array('unit_id' => $unit))->row();
							?>
							<option <? if($subject["unit_id"] == $unit["unit_id"] ){?>selected="selected"<?}?> value="<?=$unit_name->unit_id?>"><?=$unit_name->unit?></option>
							<?
							} ?>
						</select>
					</div></div>
					
					<div class="col-md-6">
						<span class="form-field-title">Description</span>
						<span class="form-field">
							<textarea class="domain-desc form-control" name="description"><?=$subject["description"]?></textarea>
						</span>
					</div>
					<div class="col-md-6">
						<span class="form-field-title">For Reports</span>
						<span class="form-field">
							<p>
								<input type="checkbox" class="supervisor_report " name="supervisor_report" <? if($subject["supervisor_report"] == "on"){?>checked="checked"<?}?>/> Supervisor Report
							</p>
							<p>
								<input type="checkbox" class="management_report " name="management_report" <? if($subject["management_report"] == "on"){?>checked="checked"<?}?>/> Management Report
							</p>
						</span>
					</div>
					<div class="col-md-6">
						<span class="form-field-title">Active</span>
						<span class="form-field">
							<input type="checkbox" class="active-domain" name="active" <? if($subject["active"] == "on"){?>checked="checked"<?}?>/>
						</span>
					</div>
					<div class="form-actions left">
						
						<div class="col-md-6">
							<div class=" form-actions" style="margin-top:5%">
								<input type="button" onclick="updateSubject(<?=$subject["id"]?>);" class="btn btn-success" value="Submit" />
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</form>