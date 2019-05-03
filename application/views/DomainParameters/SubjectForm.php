<?
$user_logged = $this->userdetails["agentunit"];
$user_unit = unserialize($user_logged);
?>
<!-- // page head -->
<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>Subject Form
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
				
				<form action="<?=base_url()?>domainparameters/InsertSubjectForm" class="log-add-form" method="post">
					
					<div class="row pform" style="padding-top:1%;"  >
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">Subject</span>
								
								<input type="text" name="subject" value="" placeholder="Enter value..." class="form-control" required="required"  />
								
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">Unit</span>
								<select name="unit_id" class="form-control" required="required">
									<option value="">--Select--</option>
									<?
									
									foreach($user_unit as $unit){
									$unit_name = $this->db->get_where('units', array('unit_id' => $unit))->row();
									?>
									<option value="<?=$unit_name->unit_id?>"><?=$unit_name->unit?></option>
									<?
									} ?>
								</select>
							</div></div>
							
						</div>
						
						<div class="row pform" style="padding-bottom:2%; padding-top:2%;">
							<div class="col-md-6">
								
								<div class="form-group">
									<span class="form-field-title">Description</span>
									
									<textarea class=" form-control"  name="description"></textarea>
									
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<span class="form-field-title">For Reports</span>
									<div class="checkbox-list" style="padding-top: 2%;">
										
										<input type="checkbox" name="supervisor_report" class="checkbox-inline" /> Supervisor Report
										
										<input type="checkbox" name="management_report" class="checkbox-inline" /> Management Report
										
									</div>
								</div></div>
								
							</div>
							
							<div class="row pform" style="padding-bottom:2%; padding-top:2%;">
								<div class="col-md-6">
									<div class="form-group" >
										<span class="form-field-title">Active</span>
										<div class="checkbox-list" style="padding-top: 2%;">
											<input type="checkbox"  name="active" />
										</div>
									</div>
								</div>
								
							</div>
							
							
							<div class="form-actions left">
								
								<div class="col-md-5">
									
									
									
									<div class=" form-actions" style="border-top: 0">
										
										
										<input type="submit" class="btn btn-success" value="Submit" />
										<input type="reset" class="btn btn-danger" value="Cancel" />
										<a href="<?=base_url()?>domainparameters/viewSubjects" class="btn btn-primary">View Subjects</a>
										
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