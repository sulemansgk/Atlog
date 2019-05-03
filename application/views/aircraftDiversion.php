<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>Aircraft Diversion
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
				<form action="<?=base_url()?>elog/insertAircraftDiversion" class="log-add-form" method="post">
					<input type="hidden" name="subject" value="Aircraft Diversion" />
					<input type="hidden" name="initial" value="<?=$this->userdetails["agentcode"]?>" />
					<!-- <input type="hidden" name="datetime" value="<?=date("Y-m-d H:i:s")?>" /> -->
					<input type="hidden" class="date-field form-control date-picker" name='date' value="<?=date("m/d/Y")?>"/>
					<input type="hidden" class="form-control timepicker timepicker-default" name='time'/>
					
					<div class="row pform" style="padding-top:1%;"  >
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">Initial</span>
								
								<input type="text" readonly="readonly" class="form-control" value="<?=$this->userdetails["agentname"]?>" />
								<input type="hidden" class="form-control" name="initial" readonly="readonly" value="<?=$this->userdetails["agentcode"]?>" />
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">On Behalf Of</span>
								<select name="onbehalf" class="form-control" >
									<option value="">--Select User--</option>
									<?								foreach($allusers as $key=>$user){							?>
									<option value="
										<?=$user["agentcode"]?>">
										<?=$user["agentname"]?>
									</option>
									<?								}							?>
								</select>
								
							</div>
						</div>
					</div>
					<div class="row pform" >
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">Time when aircraft Divert *</span>
								
								<!-- <input type="text" name="time_aircraft_divert" class="form-control timepicker timepicker-default" required="required" /> -->
								<input type="text" class="form-control clockpicker" value="<?=date("H:i")?>" placeholder="Time" name="time_aircraft_divert">	
							</div>
						</div>
						
						
						<div class="col-md-6">
							<div class="form-group" >
								<span class="form-field-title">Aircraft Callsign</span>
								<input type="text" name="callsign" class="form-control" value="" />
							</div>
						</div>
					</div>
					
					<div class="row pform" >
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">Aircraft Type</span>
								
								<input type="text" name="aircraft_type" class="form-control" value="" />
							</div>
						</div>
						
						
						<div class="col-md-6">
							<div class="form-group" >
								<span class="form-field-title">SSR Transponder Code</span>
								<input type="text" name="ssr_transporter_code" class="form-control" value="" />
							</div>
						</div>
					</div>
					
					<div class="row pform" >
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">Point Of Departure</span>
								
								<input type="text" name="point_of_departure" class="form-control" value="" />
							</div>
							
						</div>
						<div class="col-md-6">
							<div class="form-group" >
								<span class="form-field-title">Original Destination</span>
								<input type="text" name="original_destination" class="form-control" value="" />
							</div>
						</div>
					</div>
					
					
					<div class="row pform" >
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">New Destination</span>
								
								<input type="text" name="new_destination" class="form-control" value="" />
							</div>
							
						</div>
						<div class="col-md-6">
							<div class="form-group" >
								<span class="form-field-title">Actual Time Of Arrival</span>
								<!-- <input type="text" name="time_of_arrival" class="arr_time_field form-control timepicker timepicker-default" /> -->
								<input type="text" class="form-control clockpicker arr_time_field" placeholder="Time" value="<?=date("H:i")?>" name="time_of_arrival">
							</div>
						</div>
					</div>
					
					<div class="row pform" >
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">Traffic Officer Informed @ Time</span>
								
								<!-- <input type="text" name="TrafficOfficerInformedTime" class="timepicker timepicker-default tof_time_field form-control" /> -->
								<input type="text" class="form-control clockpicker tof_time_field" placeholder="Time" value="<?=date("H:i")?>" name="TrafficOfficerInformedTime">
							</span>
						</div>
						
					</div>
					<div class="col-md-6">
						<div class="form-group" >
							<span class="form-field-title">AOCC Informed @ Time</span>
							<!-- <input type="text" name="AOCCInformedTime" class="aocc_time_field form-control timepicker timepicker-default" /> -->
							<input type="text" class="form-control clockpicker aocc_time_field" placeholder="Time" value="<?=date("H:i")?>" name="AOCCInformedTime">
						</div>
					</div>
				</div>
				<div class="row pform" style="padding-bottom:2%; ">
					
					
					
					<div class="col-md-6">
						<div class="form-group" >
							<span class="form-field-title">Details / Reasons</span>
							<textarea type="text" name="any_other_details" class="form-control"  value="" ></textarea>
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
<!-- // page content -->


<script type="text/javascript">
$('.clockpicker').clockpicker();
</script>



