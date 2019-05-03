<div class="row-fluid page-head">
	<img src="<?=base_url()?>assets/img/gal.png" style="float:left" />
	<h2 class="page-title"><i class="aweso-icon-list-alt"></i> Domain Parameter Ppe</h2>
	<div class="page-bar">
		<div class="btn-toolbar"> </div>
	</div>
</div>
<div class="viewlist-link">
	<a href="<?=base_url()?>instructions/viewPpe" class="btn btn-blue">View Domain Parameter Ppe</a>
</div>
<!-- // page head -->
<form action="<?=base_url()?>instructions/viewPpe" class="log-add-form" method="post">
	<div id="page-content" class="page-content">
		<section>
			<div class="row-fluid margin-top20"><!-- // column -->
			
			
			
			<div class="form-row">
				<span class="form-field-title">Name : *</span>
				<span class="form-field">
					<input type="text" name="name" value="" required="required" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Description: *</span>
				<span class="form-field">
					<textarea name="description" id="desc" style="width:290px;height:100px;"></textarea>
				</span>
			</div>
			
			<div class="form-row">
				<span class="form-field-title">Status: *</span>
				<span class="form-field" style="width: 70%;">
					<input type="checkbox" name="status" value="1"  />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title"></span>
				<span class="form-field">
					<input type="reset" class="btn btn-blue" value="Reset" />
					<input type="submit" class="btn" value="Submit" />
				</span>
			</div>
		</div>
		<!-- // Example row -->
	</section>
</div>
</form>