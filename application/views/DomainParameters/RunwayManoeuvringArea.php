<!-- // page head -->
<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>Runway / Manoeuvring Area
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
				
				<form action="<?=base_url()?>domainparameters/InsertRunwayManoeuvringArea" class="log-add-form" method="post">
					
					<div class="row pform" style="padding-top:1%;"  >
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">Area Name</span>
								
								<input type="text" name="areaname" class="form-control" value="" placeholder="Enter value..." required="required"  />
								
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group" >
								<span class="form-field-title">Active</span>
								<div class="checkbox-list" style="padding-top: 2%;">
									<input type="checkbox" name="active" />
								</div>
							</div>
						</div>
						
					</div>
					
					<div class="row pform" style="padding-bottom:2%; padding-top:2%;">
						
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">Unit</span>
								<select name="unit_id" required="required" class="form-control">
									<option value="">--Select--</option>
									<?
									foreach($units as $key=>$unit){
									?>
									<option value="<?=$unit["unit_id"]?>"><?=$unit["unit"]?></option>
									<?
									}
									?>
								</select>
							</div></div>
							
							<div class="col-md-6">
								
								<div class="form-group">
									<span class="form-field-title">Description</span>
									
									<textarea class="domain-desc form-control" name="description"></textarea>
									
								</div>
							</div>
							
							
							
						</div>
						
						
						<div class="form-actions left">
							
							<div class="col-md-6">
								
								
								
								<div class=" form-actions" style="border-top: 0;">
									
									
									<input type="submit" class="btn btn-success" value="Submit" />
									<input type="reset" class="btn btn-danger" value="Cancel" />
									<a href="<?=base_url()?>domainparameters/viewRunwayManoeuvringAreas" class="btn btn-primary">View Runway / Manoeuvring Areas</a>
									
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