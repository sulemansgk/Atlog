<div id="page-content" class="page-content">
	<section>
		<div class="row-fluid margin-top20"><!-- // column -->
		<form class="emergency-edit-form" method="post" action="<?=base_url()?>elog/insertdetails">
			<div class="form-row">
				<span class="form-field-title">Initial</span>
				<span class="form-field">
					<?
					
					$user_data = $this->db->get_where("tblagent",array("agentcode"=>$log["initial"]))->result_array();
					
					
					$engineer = $this->db->get_where("jobcard",array("id"=>$log["jobcard_id"]))->result_array();
					
					$eginercode = $engineer[0]['initial'];
					
					?>
					<input type="hidden" value="<?=$log["initial"]?>" />
					<input type="text" readonly="readonly" value="<?=$user_data[0]["agentname"]?>" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Date</span>
				<span class="form-field">
					<input type="text" class="date-field" readonly="readonly" value="<?=date("d/m/Y",strtotime($log["datetime"]))?>" />
					
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Time</span>
				<span class="form-field">
					<input type="text" class="time-field" readonly="readonly" value="<?=date("Hi",strtotime($log["datetime"]))?>" />
					
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Subject</span>
				<span class="form-field">
					<input type="text"  readonly="readonly" readonly="readonly"  value="<?=$log["subject"]?>" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Details</span>
				<span class="form-field">
					<textarea rows="5" cols="45" id="textarea"   readonly="readonly" ><?=$log["Remarks"]?></textarea>
				</span>
			</div>
			
			<div class="form-row">
				<span class="form-field-title"></span>
				<span class="form-field">
					
					<input class="btn btn-blue" value="Accept Job Close"  onclick="acceptJobClose(<?=$log["faultrep"]?>,'<?=$eginercode?>','Accept job');" />
					
					
					<input  class="btn btn-red" value="Cancel"  onclick="cancelJobClose(<?=$log["faultrep"]?>,'<?=$eginercode?>','Cancel Request');"  />
				</span>
			</div>
			
			
		</form>
	</div>
	<!-- // Example row -->
</section>
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