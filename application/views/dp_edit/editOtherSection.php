<form class="subject-edit-form" method="post">
	<div id="page-content" class="page-content">
		<section>
			<div class="row-fluid margin-top20"><!-- // column -->
			<div class="row">
				<div class="col-md-6">
					<span class="form-field-title">Name</span>
					<span class="form-field">
						<input type="text" name="name" class="form-control" value="<?=$othersection["name"]?>" placeholder="Enter value..." required="required"  />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Phone</span>
					<span class="form-field">
						<input type="text" name="phone" class="form-control" value="<?=$othersection["phone"]?>" placeholder="Enter value..." required="required"  />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Username</span>
					<span class="form-field">
						<select name="initials_code" class="form-control" required="required" onchange="dpSelectChange(this);">
							<option value="">--Select--</option>
							<?
							foreach($users as $key=>$user){
							?>
							<option <?if($othersection["initials_code"] == $user["agentcode"] ){?>selected="selected"<?}?> value="<?=$user["agentcode"]?>"><?=$user["agentname"]?></option>
							<?
							}
							?>
						</select>
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Description</span>
					<span class="form-field">
						<textarea class="domain-desc form-control" name="description"><?=$othersection["description"]?></textarea>
					</span>
				</div>
				
				<div class="form-actions left">
					<div class="col-md-6">
						<div class="form-actions" style="margin-top: 5%;">
							<input type="button" onclick="updateOtherSection(<?=$othersection["id"]?>);" class="btn btn-success" value="Submit" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
</form>