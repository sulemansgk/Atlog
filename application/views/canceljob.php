<div id="wrp" style="">
	<div id="page-content" class="page-content" >
		<section>
			<div class="row-fluid margin-top20"><!-- // column -->
			<form class="emergency-edit-form" method="post" action="<?=base_url()?>elog/canceljob">
				<input type="hidden" name="subject" value="Job Canceled " />
				<input type="hidden" name="initial" value="<?=$this->userdetails["agentcode"]?>" />
				<input type="hidden" name="datetime" value="<?=date("Y-m-d H:i:s")?>" />
				
				<div class="row">
					<div class="col-md-6">
						<span class="form-field-title">Initials</span>
						<span class="form-field">
							<input type="text" name="initials" class="form-control"  readonly="readonly" value="<?=$this->userdetails["agentname"]?>" />
						</span>
					</div>
					<div class="col-md-6">
						<span class="form-field-title">Date </span>
						<span class="form-field">
							<input type="text" required="required" value="<?=date("d/m/Y")?>" class="date-field form-control"  id="dp1410757438442">
						</span>
					</div>
					<div class="col-md-6">
						<span class="form-field-title">Fault Id:</span>
						<span class="form-field">
							<input type="text"  readonly="readonly" class="form-control"  name="Job_Code" value="<?=$id;?>"/>
						</span>
					</div>
					
					<div class="col-md-6">
						<span class="form-field-title">Remarks:</span>
						<span class="form-field">
							
							<textarea placeholder="Enter Remarks..." class="form-control" id="textarea" name="Remarks"></textarea>
						</span>
					</div>
					
					
					<div class="col-md-6">
						<span class="form-field-title"></span>
						<span class="form-field">
							<input type="reset" class="btn btn-danger" value="Reset" />
							<input type="submit" class="btn btn-success" value="Submit" />
						</span>
					</div></div>
				</form>
			</div>
			<!-- // Example row -->
		</section>
	</div>
</div>
<script type="text/javascript">
	$( ".time-field" ).timepicker({
		timeFormat: "HHmm",
		});
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
<!-- // page content -->