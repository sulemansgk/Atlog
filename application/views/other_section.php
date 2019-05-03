<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>Other Section
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
				
				
				<form action="<?=base_url()?>elog/insertothersection" class="log-add-form" method="post">
					
					<div class="row pform" style="padding-top:1%;"  >
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title"> Name *</span>
								
								<input type="text" name="name" class="form-control" value="" required="required" />
								
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group" >
								<span class="form-field-title">Phone *</span>
								<input type="text" name="phone" class="form-control" value="" required="required" />
							</div>
						</div>
						
						
						
						
						
						
					</div>
					
					
					
					
					
					<div class="row pform" style="padding-bottom:2%;">
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">Username *</span>
								
								<select name="initials_code" class="form-control">
									<option value="">--Select Username--</option>
									
									<?
									
									foreach($users as $key=>$number){
									?>
									<option value="<?=$number["agentcode"]?>"><?=$number["agentname"]?></option>
									<?
									}
									?>
								</select>
								
							</div>
						</div><div class="col-md-6">
						
						<div class="form-group">
							<span class="form-field-title">Description *</span>
							
							<textarea name="Description" id="desc" class="form-control"></textarea>
							
						</div>
					</div>
					
					
					
				</div>
				
				
				
				
				
				
				<div class="form-actions left">
					
					<div class="col-md-6">
						
						
						
						<div class=" form-actions" style="border-top: 0">
							
							
							<input type="submit" class="btn btn-success" value="Submit" />
							<input type="reset" class="btn btn-danger" value="Cancel" />
							<a href="<?=base_url()?>domainparameters/viewothersection" class="btn btn-primary">View other Section</a>
							
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