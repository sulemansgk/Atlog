<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>Practice Emergency
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
				
				<form action="<?=base_url()?>emergency/insertlog" class="log-add-form" method="post">
					<input type="hidden" name="type_of_incident" value="Practice Emergency" />
					<input type="hidden" name="initial" value="<?=$this->userdetails["agentcode"]?>" />
					<input type="hidden" name="datetime" value="<?=date("Y-m-d H:i:s", strtotime('-4 hours'))?>" />
					<div class="row pform" style="padding-top:1%; padding-bottom:2%;"  >
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">Emergency Name</span>
								
								<input type="text" name="location" class="form-control" value="" placeholder="Enter value..." />
								
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">Details</span>
								<textarea name="any_other_details" id="textarea" class="form-control"></textarea>
							</div>
						</div>
						
					</div>
					
					<div class="form-actions left">
						
						<div class="col-md-5">
							
							
							
							<div class=" form-actions" style="border-top: 0">
								
								
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