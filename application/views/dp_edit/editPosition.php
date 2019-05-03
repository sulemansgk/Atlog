<form class="subject-edit-form" method="post">
	<div id="page-content" class="page-content">
		<section>
			<div class="row-fluid margin-top20"><!-- // column -->
			<div class="row">
				<div class="col-md-6">
					<span class="form-field-title">Position Name</span>
					<span class="form-field">
						<input type="text" name="name" class="form-control" value="<?=$position["name"]?>" placeholder="Enter value..." required="required"  />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Unit</span>
					<span class="form-field">
						<select name="agentunit" required="required" class="form-control" onchange="dpSelectChange(this);">
							<option value="">--Select--</option>
							<?
							foreach($units as $key=>$unit){
							?>
							<option <?if($position["unit_id"] == $unit["unit_id"] ){?>selected="selected"<?}?> value="<?=$unit["unit_id"]?>"><?=$unit["unit"]?></option>
							<?
							}
							?>
						</select>
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Description</span>
					<span class="form-field">
						<textarea class="domain-desc form-control" name="description"><?=$position["description"]?></textarea>
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Active</span>
					<span class="form-field">
						<input type="checkbox" class="active-domain" name="active" <? if($position["active"] == "on"){?>checked="checked"<?}?>/>
					</span>
				</div>
				<div class="form-actions left">
					<div class="col-md-6">
						<div class="form-actions" style="margin-top: 5%;">
							<input type="button" onclick="updatePosition(<?=$position["id"]?>);" class="btn btn-success" value="Submit" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
</form>