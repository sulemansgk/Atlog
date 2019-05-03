<form class="subject-edit-form" method="post">
	<div id="page-content" class="page-content">
		<section>
			<div class="row-fluid margin-top20"><!-- // column -->
			<div class="row">
				<div class="col-md-6">
					<span class="form-field-title">Nationality</span>
					<span class="form-field">
						<input type="text" name="nationality" class="form-control" value="<?=$nationality["nationality"]?>" placeholder="Enter value..." required="required"  />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Description</span>
					<span class="form-field">
						<textarea class="domain-desc form-control" name="description"><?=$nationality["description"]?></textarea>
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Active</span>
					<span class="form-field">
						<input type="checkbox" class="active-domain" name="active" <? if($nationality["active"] == "on"){?>checked="checked"<?}?>/>
					</span>
				</div>
				<div class="form-actions left">
					<div class="col-md-6">
						<div class="form-actions" style="margin-top: 5%;">
							<input type="button" onclick="updateNationality(<?=$nationality["id"]?>);" class="btn btn-success" value="Submit" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
</form>