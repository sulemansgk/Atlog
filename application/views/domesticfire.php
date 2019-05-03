<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>Domestic Fire
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
					<input type="hidden" name="type_of_incident" value="Domestic Fire" />
					<input type="hidden" name="initial" value="<?=$this->userdetails["agentcode"]?>" />
					<input type="hidden" name="datetime" value="<?=date("Y-m-d H:i:s", strtotime('-4 hours'))?>" />
					
					<div class="row pform" style="padding-top:1%;"  >
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">Location, Building or Stand: </span>
								
								<input type="text" name="location" value="" class="auto2 ui-autocomplete-input form-control" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">Aircraft Type if Involved</span>
								
								<input type="text" name="aircraft_type" value="" class="auto3 ui-autocomplete-input form-control" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
							</div>
						</div>
					</div>
					
					
					
					
					<div class="row pform" >
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">Persons on Board</span>
								
								<input name="persons_on_board" type="text" class="form-control" id="textfield" maxlength="4">
							</div>
						</div>
						
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">Aircraft Operator</span>
								
								<input type="text" name="aircraft_operator" value="" class="auto4 ui-autocomplete-input form-control" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
							</div>
						</div>
						
					</div>
					<div class="row pform" >
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">Callsign</span>
								
								<input type="text" name="callsign" value="" class="auto5 ui-autocomplete-input form-control" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
							</div>
							
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">Dangerous Goods </span>
								
								<input type="text" name="dangerous_goods" value="" class="auto6 ui-autocomplete-input form-control" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
							</div>
							
						</div>
						
					</div>
					
					<div class="row pform" >
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">Point Of Departure</span>
								
								<input type="text" name="point_of_departure" value="" class="auto7 ui-autocomplete-input form-control" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
							</div>
						</div>
						
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">Destination </span>
								<input type="text" name="destination" value="" class="auto8 ui-autocomplete-input form-control" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
							</div>
						</div>
						
					</div>
					
					<div class="row pform" >
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">Nature Of Accident</span>
								
								<input type="text" name="nature_of_accident" value="" class="auto9 ui-autocomplete-input form-control" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">Any Other Details</span>
								
								<textarea name="any_other_details" class="form-control" id="textarea" ></textarea>
							</div>
							
						</div>
						
					</div>
					<div class="row pform" style="padding-bottom:2%; ">
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">Time of Accident (UTC)</span>
								
								<input type="text" name="time_of_accident" value="<?=date("H:i", strtotime('-4 hours'))?>" class="clockpicker timefield form-control" placeholder="Enter value..." oninput="maxLengthCheck(this);"/>
							</div>
						</div>
						
						<div class="col-md-6">
							
							
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