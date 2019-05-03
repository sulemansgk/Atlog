<form class="" method="post">
	<div id="page-content" class="page-content">
		<div class="row-fluid margin-top20"><!-- // column -->
		<div class="row">
			<div class="col-md-6">
				<span class="form-field-title">Unit</span>
				<span class="form-field">
					<input type="text" name="unit" class="form-control" value="<?=$unit["unit"]?>" placeholder="Enter value..." required="required"  />
				</span>
			</div>
			<div class="col-md-6">
				<span class="form-field-title">No Runway on Dashboard</span>
				<span class="form-field">
					<input type="checkbox" class="active-domain" name="active" <? if($unit["no_runway"] == 1){?>checked="checked"<?}?>/>
				</span>
			</div>
			<div class="form-actions left">
				
				<div class="col-md-6">
					<div class=" form-actions" style="margin-top:5%">
						<input type="button" onclick="updateUnit(<?=$unit["id"]?>);" class="btn btn-success" value="Submit" />
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</form>