<form class="subject-edit-form" method="post">
	<div id="page-content" class="page-content">
		<section>
			<div class="row-fluid margin-top20"><!-- // column -->
			<div class="form-row">
				<span class="form-field-title">Name</span>
				<span class="form-field">
					<input type="text" name="subject" value="<?=$subject["name"]?>" placeholder="Enter value..." required="required"  />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Description</span>
				<span class="form-field">
					<textarea class="domain-desc" name="description"><?=$subject["description"]?></textarea>
				</span>
			</div>
			
			
			
			
			<div class="form-row">
				<span class="form-field-title">Active</span>
				<span class="form-field">
					<input type="checkbox" class="active-domain" name="active" <? if($subject["status"] == "1"){?>checked="checked"<?}?>/>
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title"></span>
				<span class="form-field">
					<input type="reset" class="btn btn-blue" value="Reset" />
					<input type="button" onclick="updateSubject(<?=$subject["id"]?>);" class="btn" value="Submit" />
				</span>
			</div>
		</div>
	</section>
</div>
</form>