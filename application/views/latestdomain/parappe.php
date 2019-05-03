<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>Domain Parameter Ppe
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse" data-original-title="" title="">
					</a>
					<a href="#portlet-config" >
					</a>
					<a href="javascript:;" >
					</a>
					<a href="javascript:;" >
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				
				<form action="<?=base_url()?>elog/insertparacustomer" class="log-add-form" method="post">
					
					<div class="row pform" style="padding-top:1%;"  >
						<div class="col-md-5">
							<div class="form-group">
								<span class="form-field-title"> Customer Name *</span>
								
								<input type="text" name="Customer_name" class="form-control" value="" required="required" />
								
							</div>
						</div>
						
						<div class="col-md-5">
							<div class="form-group" >
								<span class="form-field-title">Customer Initials *</span>
								<input type="text" name="Customer_initials" class="form-control" value="" required="required" />
							</div>
						</div>
						
						
						
						<div class="col-md-2">
							<div class="form-actions right" style="background:none">
								<a href="<?=base_url()?>instructions/viewCustomer" class="btn btn-primary">View Customer
								</a>
							</div>
						</div>
						
						
					</div>
					
					
					
					
					
					<div class="row pform" style="padding-bottom:2%;">
						<div class="col-md-5">
							
							<div class="form-group">
								<span class="form-field-title">Contact Person *</span>
								
								<input type="text" name="Contact_Person" class="form-control" value="" required="required" />
								
							</div>
						</div>
						
						<div class="col-md-5">
							
							<div class="form-group">
								<span class="form-field-title">Phone *</span>
								
								<input type="text" name="phone" class="form-control" value="" required="required" />
								
							</div>
						</div>
						
					</div>
					
					
					
					<div class="row pform" style="padding-bottom:2%;">
						<div class="col-md-5">
							
							<div class="form-group">
								<span class="form-field-title">Mobile *</span>
								
								<input type="text" name="mobile" class="form-control" value="" required="required"/>
								
							</div>
						</div>
						
						<div class="col-md-3">
							<div class="form-group" >
								<span class="form-field-title">Status *</span>
								<div class="checkbox-list" style="padding-top: 2%;">
									
									<input type="checkbox" name="Status" value="1"  />
								</div>
							</div>
						</div>
						
					</div>
					
					
					<div class="form-actions left">
						
						<div class="col-md-5">
							
							
							
							<div class=" form-actions" >
								
								
								<input type="submit" class="btn btn-success" value="Submit" />
								<input type="reset" class="btn btn-danger" value="Cancel" />
								
							</div>
							
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- form -->
<style>
	.pform
	{
		padding-left:2%;
		padding-right:2%;
	}
</style>