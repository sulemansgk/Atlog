<div id="wrapper">
	<div class="row-fluid page-head">
		<?php /*?><img src="<?=base_url()?>assets/img/gal.png" style="float:left" />
		<?php */?><h2 class="page-title"><i class="aweso-icon-list-alt"></i> Close Jobs</h2>
		<div class="page-bar">
			<div class="btn-toolbar"> </div>
		</div>
	</div>
	<!-- // page head -->
	<form action="<?=base_url()?>elog/faultrepclose" class="log-add-form" method="post">
		<input type="hidden" name="subject" value="close job" />
		<input type="hidden" name="initial" value="<?=$this->userdetails["agentcode"]?>" />
		<input type="hidden" name="datetime" value="<?=date("Y-m-d H:i:s")?>" 	/>
		<input type="hidden" name="faultrep" value="<?=$log["faultreportnum"]?>" /><input type="hidden" name="jobcard_id" value="<?=$log["id"]?>" />
		<input type="hidden" name="id" value="<?=$log["id"]?>" />
		
		<div class="row"><!-- // column -->
		
		<form class="emergency-edit-form" method="post" action="<?=base_url()?>elog/faultrepclose">
			<div class="col-md-6">
				<span class="form-field-title">Job Cards</span>
				<span class="form-field">
					<input type="text" class="form-control" readonly="readonly" value="<?=$log["jobcard"]?>" />
				</span>
			</div>
			<div class="col-md-6">
				<span class="form-field-title">Date</span>
				<span class="form-field">
					
					<input type="text" class="form-control"  readonly="readonly" value="<?=date("d/m/Y")?>" />
				</span>
			</div>
			<div class="col-md-6">
				<span class="form-field-title">Time</span>
				<span class="form-field">
					
					<input type="text" class="form-control"  readonly="readonly"  value="<?=date("H:i")?>" />
				</span>
			</div>
			
			
			
			<div class="col-md-6">				<span class="form-field-title">Remarks:</span>					<span class="form-field">
			<textarea placeholder="Enter Remarks..." class="form-control" id="textarea" name="Remarks"></textarea>
		</span>					</div>
		
		
		<div class="col-md-6">
			<span class="form-field-title"></span>
			
			
			<span class="form-field">
				<input type="reset" class="btn btn-danger" value="Reset" />
				<input type="submit" class="btn btn-success" value="Submit" />
				
			</span>
		</div>
	</form>
</div>
<!-- // Example row -->
</div>
<script type="text/javascript">
	$( ".time-field" ).timepicker({
		timeFormat: "HH:mm",
								});			$( ".manhour" ).timepicker({		timeFormat: "HHmm",	});
	$( ".date-field" ).datepicker({
		dateFormat:"dd/mm/yy",
		});
	$(document).on("change",".date-field,.time-field",function(){
			var date = $.datepicker.parseDate("dd/mm/yy",$(".date-field").val());
			var time = $(".time-field").val();
			time = time[0]+time[1]+":"+time[2]+time[3]+":00"
			date = $.datepicker.formatDate( "yy-mm-dd", date);
			var datetime = date+" "+time;
			$(".datetime-field").attr("value",datetime);
	});
</script>