<div class="row-fluid page-head">
	<img src="<?=base_url()?>assets/img/gal.png" style="float:left" />
	<h2 class="page-title"><i class="aweso-icon-list-alt"></i> Domain Parameter Customer</h2>
	<div class="page-bar">
		<div class="btn-toolbar"> </div>
	</div>
</div>
<div class="viewlist-link">
	<a href="<?=base_url()?>instructions/viewCustomer" class="btn btn-blue">View Customer</a>
</div>
<!-- // page head -->
<form action="<?=base_url()?>elog/insertparacustomer" class="log-add-form" method="post">
	<div id="page-content" class="page-content">
		<section>
			<div class="row-fluid margin-top20"><!-- // column -->
			
			
			
			<div class="form-row">
				<span class="form-field-title">Customer Name : *</span>
				<span class="form-field">
					<input type="text" name="Customer_name" value="" required="required" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Customer Initials: *</span>
				<span class="form-field">
					<input type="text" name="Customer_initials" value="" required="required" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Contact Person: *</span>
				<span class="form-field">
					<input type="text" name="Contact_Person" value="" required="required" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Phone: *</span>
				<span class="form-field">
					<input type="text" name="phone" value="" required="required" />
				</span>
			</div>
			
			<div class="form-row">
				<span class="form-field-title">Mobile: *</span>
				<span class="form-field">
					<input type="text" name="mobile" value="" required="required"/>
				</span>
			</div>
			
			<div class="form-row">
				<span class="form-field-title">Status: *</span>
				<span class="form-field" style="width: 70%;">
					<input type="checkbox" name="Status" value="1"  />
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