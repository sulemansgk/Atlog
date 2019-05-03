<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>Aircraft Crash
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
					<input type="hidden" name="type_of_incident" value="Aircraft Crash" />
					<input type="hidden" name="initial" value="<?=$this->userdetails["agentcode"]?>" />
					<input type="hidden" name="datetime" value="<?=date("Y-m-d H:i:s", strtotime('-4 hours'))?>" />
					
					<div class="row pform" style="padding-top:1%;"  >
						<div class="col-md-4">
							<div class="form-group">
								<span class="form-field-title">DECLARE (on airport) </span>
								
								<div class="form-field">
									<input type="radio" id="radio" name="crash_type" value="CRASH" required="required" class="md-radiobtn">
									<label for="radio1">
										<span class="inc"></span>
										<span class="check"></span>
										<span class="box"></span>
									Crash </label>
								</div>
							</div>
						</div>
						
						<div class="col-md-4">
							<div class="form-group">
								<span class="form-field-title">DECLARE (off airport - on land)  </span>
								
								<div class="form-field">
									<input type="radio" id="radio" name="crash_type" value="CRASH_OFF_AIRPORT" required="required" class="md-radiobtn">
									<label for="radio2">
										<span class="inc"></span>
										<span class="check"></span>
										<span class="box"></span>
									CRASH OFF AIRPORT </label>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<span class="form-field-title">DECLARE (off airport - at sea)  </span>
								
								<div class="form-field">
									<input type="radio" id="radio" name="crash_type" value="CRASH_AT_SEA" required="required" class="md-radiobtn">
									<label for="radio3">
										<span class="inc"></span>
										<span class="check"></span>
										<span class="box"></span>
									CRASH AT SEA </label>
								</div>
							</div>
						</div>
					</div>
					<div class="row pform" >
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">Location (e.g. Runway) </span>
								
								<input type="text" name="location" class="form-control" value="" placeholder="Enter value..." />
							</div>
						</div>
						
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">Aircraft Type</span>
								
								<input type="text" name="aircraft_type" class="form-control" value="" placeholder="Enter value..." />
							</div>
						</div>
						
					</div>
					<div class="row pform" >
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">Persons On Board </span>
								
								<input type="text" name="persons_on_board" class="form-control" value="" placeholder="Enter value..." />
							</div>
						</div>
						
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">Aircraft Operator</span>
								
								<input type="text" name="aircraft_operator" class="form-control" value="" placeholder="Enter value..." />
							</div>
						</div>
						
					</div>
					
					<div class="row pform" >
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">Callsign </span>
								
								<input type="text" name="callsign" class="form-control" value="" placeholder="Enter value..." />
							</div>
						</div>
						
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">Dangerous Goods</span>
								
								<input type="text" name="dangerous_goods" class="form-control" value="" placeholder="Enter value..." />
							</div>
						</div>
						
					</div>
					
					<div class="row pform" >
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">Point Of Departure </span>
								
								<input type="text" name="point_of_departure" class="form-control" value="" placeholder="Enter value..." />
							</div>
						</div>
						
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">Destination</span>
								
								<input type="text" name="destination" class="form-control" value="" placeholder="Enter value..." />
							</div>
						</div>
						
					</div>
					<div class="row pform" >
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">Nature Of Accident </span>
								
								<input type="text" name="nature_of_accident" class="form-control" value="" placeholder="Enter value..." />
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group" >
								<span class="form-field-title">Time of Accident (UTC)</span>
								<input type="text" name="time_of_accident" value="<?=date("H:i", strtotime('-4 hours'))?>" class="clockpicker form-control" placeholder="Time" oninput="maxLengthCheck(this);"/>

								

							</div>
						</div>
						
					</div>
					
					<div class="row pform" style="padding-bottom:2%; ">
						
						
						
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">Any Other Details</span>
								
								<textarea placeholder="Enter value..." class="form-control"  id="textarea" name="any_other_details"></textarea>
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
<!-- // page content -->

<script type="text/javascript">
$('.clockpicker').clockpicker();
</script>