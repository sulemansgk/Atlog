<div class="row-fluid page-head">
	<img src="<?=base_url()?>assets/img/gal.png" style="float:left" />
	<h2 class="page-title"><i class="fontello-icon-monitor"></i>User Role</h2>
	<div class="page-bar">
		<div class="btn-toolbar"> </div>
	</div>
</div>
<!-- // page head -->
<div class="viewlist-link">
	<a href="<?=base_url()?>domainparameters/viewUserRoles" class="btn btn-blue">View User Roles</a>
</div>
<form action="" class="log-add-form" method="post">
	<div id="page-content" class="page-content">
		<section>
			<div class="row-fluid margin-top20"><!-- // column -->
			<div class="form-row">
				<span class="form-field-title">Name</span>
				<span class="form-field">
					<input type="text" name="name" value="" placeholder="Enter value..." required="required"  />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Description</span>
				<span class="form-field">
					<textarea class="domain-desc" name="description"></textarea>
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Rights</span>
				<span class="form-field">
					<p>
						<input type="checkbox" /> lorem ipsum
					</p>
					<p>
						<input type="checkbox" /> loremipsum
					</p>
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Active</span>
				<span class="form-field">
					<input type="checkbox" name="active" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title"></span>
				<span class="form-field">
					<input type="submit" class="btn" value="Submit" />
					<input type="reset" class="btn btn-red" value="Cancel" />
				</span>
			</div>
		</div>
	</section>
</div>
</form>