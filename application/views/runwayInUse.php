<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>Runway In Use
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
				<form action="<?=base_url()?>elog/insertRunwayInUse" class="log-add-form" method="post">
					<input type="hidden" name="subject" value="Runway In Use" />
					<input type="hidden" name="initial" value="<?=$this->userdetails["agentcode"]?>" />
					
					
					<div class="row pform" style="padding-top:1%;"  >
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">Initial</span>
								
								<input type="text" readonly="readonly" class="form-control" value="<?=$this->userdetails["agentname"]?>" />
								<input type="hidden" name="initial" class="form-control" readonly="readonly" value="<?=$this->userdetails["agentcode"]?>" />
								
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">Date Time</span>
								<input type="text" name="rwy_datetime" class="eta-datetime-field form-control date form_meridian_datetime"  data-date="2012-12-21T15:25:00Z" value="<?=date("Y-m-d H:i:s")?>" placeholder="Enter value..." />
								
							</div>
						</div>
					</div>
					
					
					
					
					<div class="row pform" >
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">On Behalf </span>
								
								<select name="onbehalf" class="form-control">
									<option value="">--Select User--</option>
									<?
									foreach($allusers as $key=>$user){
									?>
									<option value="<?=$user["agentcode"]?>"><?=$user["agentname"]?></option>
									<?
									}
									?>
								</select>
							</div>
						</div>
						
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">31R</span>
								
								<select name="31R" class="runway-status form-control" >
									<option value="Not In Use" selected="selected" >Not In Use</option>
									<option value="Arrival">Arrival</option>
									<option value="Departure">Departure</option>
									<option value="Mix">Mix</option>
									<option value="Closed/UnServiceable">Closed / UnServiceable</option>
								</select>
							</div>
						</div>
						
					</div>
					<div class="row pform" >
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">31L </span>
								
								<select name="31L" class="form-control">
									<option value="Not In Use" selected="selected" >Not In Use</option>
									<option value="Arrival">Arrival</option>
									<option value="Departure">Departure</option>
									<option value="Mix">Mix</option>
									<option value="Closed/UnServiceable">Closed / UnServiceable</option>
								</select>
							</div>
						</div>
						
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">13R</span>
								
								<select name="13R" class="form-control">
									<option value="Not In Use" selected="selected" >Not In Use</option>
									<option value="Arrival">Arrival</option>
									<option value="Departure">Departure</option>
									<option value="Mix">Mix</option>
									<option value="Closed/UnServiceable">Closed / UnServiceable</option>
								</select>
							</div>
						</div>
						
					</div>
					<div class="row pform" style="padding-bottom:2%; " >
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">13L </span>
								
								<select name="13L"  class="form-control">
									<option value="Not In Use" selected="selected" >Not In Use</option>
									<option value="Arrival">Arrival</option>
									<option value="Departure">Departure</option>
									<option value="Mix">Mix</option>
									<option value="Closed/UnServiceable">Closed / UnServiceable</option>
								</select>
							</div>
						</div>
						
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">Description</span>
								
								<textarea name="description" id="textarea"  class="form-control"></textarea>
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