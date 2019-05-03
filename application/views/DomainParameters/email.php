<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>Email address
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
				
				
				<form action="<?=base_url()?>domainparameters/insertEmail" class="log-add-form" method="post">
					<input type="hidden" name="datetime" value="<?=date("Y-m-d H:i:s")?>" />
					<div class="row pform" style="padding-top:1%;"  >
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">Email address</span>
								
								<input type="email" name="email_address" class="form-control" value="" placeholder="Enter value..." required="required"  />
								
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">For</span>
								<select name="for_form[]" class="mul-select-list form-control" multiple="multiple" required="required">
									<option value="Aircraft Crash">Air Craft Crash </option>
									<option value="Aircraft Ground Incident">Air Craft Ground Incident</option>
									<option value="Bomb Warning">Bomb Warning</option>
									<option value="Domestic Fire">Domestic Fire</option>
									<option value="Fuel Spillage">Fuel Spillage</option>
									<option value="Fuel Emergency">Fuel Emergency</option>
									<option value="Local Standby">Local Standby</option>
									<option value="Medical Emergency">Medical Emergency</option>
									<option value="Unlawful Interference">Unlawful Inteference</option>
									<option value="Weather Standby">Weather Standby</option>
								</select>
							</div></div>
							
						</div>
						
						<div class="row pform" style="padding-bottom:2%; ">
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
									
									
								</div>
							</div>
							
							<div class="col-md-6">
								
								<div class="form-group">
									<span class="form-field-title">Description</span>
									
									<textarea class="domain-desc form-control" name="description"></textarea>
									
								</div>
								
							</div>
							
						</div>
						
						<div class="form-actions left">
							
							<div class="col-md-6">
								
								<div class=" form-actions" style="border-top: 0">
									
									
									<input type="submit" class="btn btn-success" value="Submit" />
									<input type="reset" class="btn btn-danger" value="Cancel" />
									<a href="<?=base_url()?>domainparameters/viewEmails" class="btn btn-primary">View Emails</a>
									
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