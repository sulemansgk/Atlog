<form class="subject-edit-form" method="post">
	<div id="page-content" class="page-content">
		<section>
			<div class="row-fluid margin-top20"><!-- // column -->
			<div class="row">
				<div class="col-md-6">
					<span class="form-field-title">Name</span>
					<span class="form-field">
						<input type="text" name="name" class="form-control" value="<?=$frequency["name"]?>" placeholder="Enter value..." required="required"  />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Description</span>
					<span class="form-field">
						<textarea class="domain-desc form-control" name="description"><?=$frequency["description"]?></textarea>
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Status</span>
					<span class="form-field">
						<input type="checkbox" class="active-domain" name="status" <? if($frequency["status"] == 1){?>checked="checked"<?}?>/>
					</span>
				</div>
				<div class="form-actions left">
					<div class="col-md-6">
						<div class="form-actions" style="margin-top: 5%;">
							<input type="button" onclick="updateF(<?=$frequency["id"]?>);" class="btn btn-success" value="Submit" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
</form>