<form class="subject-edit-form" id="phone-edit-form" method="post">
	<div id="page-content" class="page-content">
		<section>
			<div class="row-fluid margin-top20"><!-- // column -->
			<div class="row">
				<div class="col-md-6">
					<span class="form-field-title">Runway</span>
					<span class="form-field">
						<input type="text" name="runway" class="form-control" value="<?=$runway["runway"]?>" placeholder="Enter value..." required="required"  />
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
							<option <?if($runway["unit_id"] == $unit["unit_id"] ){?>selected="selected"<?}?>value="<?=$unit["unit_id"]?>"><?=$unit["unit"]?></option>
							<?
							}
							?>
						</select>
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Description</span>
					<span class="form-field">
						<textarea class="domain-desc form-control" name="description"><?=$runway["description"]?></textarea>
					</span>
				</div>
				<div class="form-actions left">
					<div class="col-md-6">
						<div class="form-actions" style="margin-top: 5%;">
							<input type="button" onclick="updateRunway(<?=$runway["runway_id"]?>);" class="btn btn-success" value="Submit" />
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