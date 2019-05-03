<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>Weather Standby
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
					<input type="hidden" name="type_of_incident" value="Weather Standby" />
					<input type="hidden" name="initial" value="<?=$this->userdetails["agentcode"]?>" />
					<input type="hidden" name="datetime" value="<?=date("Y-m-d H:i:s", strtotime('-4 hours'))?>" />
					<div class="row pform" style="padding-top:1%;"  >
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">Reason</span>
								
								<input type="text" name="reason" value="" class="auto10 ui-autocomplete-input form-control" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
								
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">Runway in use</span>
								<input type="text" name="runway_in_use" value="" class="auto2 ui-autocomplete-input form-control" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
							</div>
						</div>
						
					</div>
					
					<div class="row pform" style="padding-bottom:2%; padding-top:2%;">
						<div class="col-md-5">
							
							<div class="form-group">
								<span class="form-field-title">Time of Request (UTC)</span>
								
								<input type="text" name="time_of_request" value="<?=date("H:i", strtotime('-4 hours'))?>" class=" clockpicker timefield form-control" placeholder="Enter value..." oninput="maxLengthCheck(this);"/>
								
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


<script type="text/javascript">
$('.clockpicker').clockpicker();
</script>