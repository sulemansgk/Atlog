<script type="text/javascript">
</script>
<!-- // page content -->
<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>  Runway / Manoeuvring Area Inspection
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
				<form action="<?=base_url()?>elog/insertRunwayManoeuvringArea" class="rwy-form log-add-form" method="post">
					<input type="hidden" name="subject" value="Runway Manoeuvring Area Inspection" />
					<input type="hidden" name="initial" value="<?=$this->userdetails["agentcode"]?>" />
					<!-- <input type="hidden" name="datetime" value="<?=date("Y-m-d H:i:s")?>" /> -->
					<input type="hidden" class="date-field form-control date-picker" name='date' value="<?=date("m/d/Y")?>"/>
					<input type="hidden" class="form-control timepicker timepicker-default" name='time'/>
					
					<div class="row pform" style="padding-top:1%;"><!-- // column -->
					<div class="col-md-6">
						<span class="form-field-title">Inspected Runway/Manoeuvring Area * </span>
						<span class="form-field">
							<select name="inspected_rwy_area" required="required" class="form-control">
								<option value="">Select</option>
								<?
								foreach($areanames as $key=>$area){
								?>
								<option value="<?=$area["id"]?>" ><?=$area["areaname"]?></option>
								<?
								}
								?>
							</select>
						</span>
					</div>
					<div class="col-md-6 agl-remarks">
						<span class="form-field-title">[a] Runway Manoeuvring Area Inspection Completed</span>
						<span class="form-field">
							<!-- <input type="text" class="inspection_completed_time form-control timepicker timepicker-default" name="inspection_completed_time" oninput="maxLengthCheck(this);"  /> -->
							<input type="text" placeholder="Time" class="form-control clockpicker inspection_completed_time" value="<?=date("H:i")?>" name="dailysafety_completed_time"  oninput="maxLengthCheck(this);" />

						</span>
					</div>
					<div class="col-md-6 agl-remarks">
						<span class="form-field-title">[b] Daily Safety Inspection Form Completed</span>
						<span class="form-field">
							<!-- <input type="text" class="dailysafety_completed_time form-control timepicker timepicker-default" name="dailysafety_completed_time"  oninput="maxLengthCheck(this);"/> -->

							<input type="text" placeholder="Time" class="form-control clockpicker dailysafety_completed_time" value="<?=date("H:i")?>" name="dailysafety_completed_time"  oninput="maxLengthCheck(this);" />

						</span>
					</div>
					<div class="col-md-6">
						<span class="form-field-title">Runway Acceptable for Use?</span>
						<span class="form-field" >
							<select name="rwy_acceptable_foruse" id="form1" class="form-control" required="required" >
								<option value="">Select</option>
								<option value="YES">YES</option>
								<option value="NO">NO</option>
								<option value="NA">NA</option>
							</select>
						</span>
					</div>
					<div class="col-md-6">
						<span class="form-field-title">Manoeuvring Area Acceptable for Use?</span>
						<span class="form-field" >
							<select name="area_acceptable_foruse" id="form" class="form-control" required="required" >
								<option value="">Select</option>
								<option value="YES">YES</option>
								<option value="NO">NO</option>
								<option value="NA">NA</option>
							</select>
						</span>
					</div>
					<div class="col-md-6" style="padding-bottom:1%;">
						<span class="form-field-title">
							Remarks<p style="font-style:italic;color:red;">( Note: If "NO" add remarks.)*</p>
						</span>
						<span class="form-field" style="width:70%;">
							<textarea name="remarks" id="detail" class="form-control aa"></textarea>
						</span>
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
				
				<!-- // Example row -->
				
				
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
<script>
	$("#form").change(function() {
var confirm = $(this).val();
if (confirm == "NO") {
$(".aa").prop('required',true);
}
});
	$("#form1").change(function() {
var confirm = $(this).val();
if (confirm == "NO") {
$(".aa").prop('required',true);
}
});
</script>

<script type="text/javascript">
$('.clockpicker').clockpicker();
</script>