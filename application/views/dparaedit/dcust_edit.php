<form class="subject-edit-form" method="post">
	<div id="page-content" class="page-content">
		<section>
			<div class="row-fluid margin-top20"><!-- // column -->
			<div class="form-row">
				<span class="form-field-title">Customer Name</span>
				<span class="form-field">
					<input type="text" name="subject" value="<?=$subject["Customer_name"]?>" placeholder="Enter value..." required="required"  />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Customer Initials</span>
				<span class="form-field">
					<input type="text" name="subject" value="<?=$subject["Customer_initials"]?>" placeholder="Enter value..." required="required"  />
				</span>
			</div>
			
			<div class="form-row">
				<span class="form-field-title">Contact Person</span>
				<span class="form-field">
					<input type="text" name="subject" value="<?=$subject["Contact_person"]?>" placeholder="Enter value..." required="required"  />
				</span>
			</div>
			
			<div class="form-row">
				<span class="form-field-title">Phone</span>
				<span class="form-field">
					<input type="text" name="subject" value="<?=$subject["Phone"]?>" placeholder="Enter value..." required="required"  />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Email</span>
				<span class="form-field">
					<input type="text" name="subject" value="<?=$subject["Email"]?>" placeholder="Enter value..." required="required"  />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Active</span>
				<span class="form-field">
					<input type="checkbox" class="active-domain" name="active" <? if($subject["Status"] == "1"){?>checked="checked"<?}?>/>
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