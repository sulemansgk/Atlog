<style type="text/css">
.box{

display: none;

}
</style>
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('input[type="checkbox"]').click(function(){
if($(this).attr("value")=="red"){
$(".red").toggle();
}
});
});
</script>
<div id="wrp" >
	<div class="row-fluid page-head">
		<h2 class="page-title"><i class="aweso-icon-list-alt"></i>JOB CARD</h2>
		<div class="page-bar">
			<div class="btn-toolbar"> </div>
		</div>
	</div>
	<div id="page-content" class="page-content" >
		<section>
			<div class="row-fluid margin-top20"><!-- // column -->
			<form class="emergency-edit-form" method="post" action="<?=base_url()?>elog/insertjob">
				<input type="hidden" name="subject" value="New Job Inserted" />
				<input type="hidden" name="initial" value="<?=$this->userdetails["agentcode"]?>" />
				<input type="hidden" name="datetime" value="<?=date("Y-m-d H:i:s")?>" />
				<input type="hidden" name="time" value="<?=date("H:i:s")?>" />
				<div class="form-row">
					<span class="form-field-title">Initials</span>
					<span class="form-field">
						<input type="text" name="initials" readonly="readonly" value="<?=$this->userdetails["agentname"]?>" />
					</span>
				</div>
				<div class="form-row">
					<span class="form-field-title">Date </span>
					<span class="form-field">
						
						<input type="text" required="required" value="15/09/2014" class="date-field hasDatepicker" id="dp1410757438442">
					</span>
				</div>
				<div class="form-row">
					<span class="form-field-title">Job Card(frn):</span>
					<span class="form-field">
						<input type="text" name="jobcard" value="" required="required" />
					</span>
				</div>
				<div class="form-row">
					<span class="form-field-title">Time GMT :</span>
					<span class="form-field">
						<input type="text" class="time-field" oninput="maxLengthCheck(this);" value="<?=date("H:i")?>" />
						<input type="hidden" class="datetime-field" name="form_datetime" oninput="maxLengthCheck(this);"value="<?=date("Y-m-d H:i:s")?>" required="required" />
						
					</span>
				</div>
				<div class="form-row">
					<span class="form-field-title">Task Description:</span>
					<span class="form-field">
						<textarea name="any_other_details" id="desc" style="width:290px;height:100px;"></textarea>
					</span>
				</div>
				<div class="form-row">
					<span class="form-field-title">Equip Manual:</span>
					<span class="form-field">
						<input type="file" class="btn btn-blue" value="Attachments" />
					</span>
				</div>
				
				<br /><br /><br />
				<br /><br /><br />
				<h4>Reported By</h4>
				<br /><br /><br />
				
				<div class="form-row">
					<span class="form-field-title">Customer :</span>
					<span class="form-field">
						
						<select name="customer">
							<option value="">--Customer--</option>
							<?
							foreach($Customers as $key=>$number){
							?>
							<option value="<?=$number["Customer_name"]?>"><?=$number["Customer_name"]?></option>
							<?
							}
							?>
						</select>
					</span>
				</div>
				
				
				<div class="form-row">
					<span class="form-field-title">Contact Tel :</span>
					<span class="form-field">
						<input type="text" name="contactTel" value="" required="required" />
					</span>
				</div>
				
				
				<div class="form-row">
					<span class="form-field-title">Job Category :</span>
					<span class="form-field">
						
						<select name="jobcat">
							<option value="">--Select Job Card--</option>
							<?
							foreach($jobcat as $key=>$number){
							?>
							<option value="<?=$number["name"]?>"><?=$number["name"]?></option>
							<?
							}
							?>
						</select>
						
					</span>
				</div>
				
				
				
				<div class="form-row">
					<span class="form-field-title">Callibration Item</span>
					<span class="form-field">
						<select name="calItem">
							<option value="">--Select Callibration Item--</option>
							<?
							foreach($calibrationitem as $key=>$number){
							?>
							<option value="<?=$number["name"]?>"><?=$number["name"]?></option>
							<?
							}
							?>
						</select>
					</span>
				</div>
				<div class="form-row">
					<span class="form-field-title">System</span>
					<span class="form-field">
						<select name="system">
							<option value="">--Select System--</option>
							<?
							foreach($system as $key=>$number){
							?>
							<option value="<?=$number["name"]?>"><?=$number["name"]?></option>
							<?
							}
							?>
						</select>
						
					</span>
				</div>
				
				
				<div class="form-row">
					<span class="form-field-title">Freq</span>
					<span class="form-field">
						
						<input type="text" name="freqch" value="" required="required" />
					</span>
				</div>
				
				
				
				<div class="form-row">
					<span class="form-field-title">LRU</span>
					<span class="form-field">
						<select name="lru">
							<option value="">--Select LRU--</option>
							<?
							foreach($lru as $key=>$number){
							?>
							<option value="<?=$number["name"]?>"><?=$number["name"]?></option>
							<?
							}
							?>
						</select>
					</span>
				</div>
				
				
				
				<div class="form-row" style="clear:left;">
					<span class="form-field-title">Ext Ref# </span>
					<span class="form-field">
						<input  type="text" name="ext" value="" required="required" />
					</span>
				</div>
				<div class="form-row">
					<span class="form-field-title">Initiate CCF </span>
					<span class="form-field">
						<select name="initiate">
							<option value="">--Select--</option>
							<option value="0">No</option>
							<option value="1">Yes</option>
							
						</select>
					</span>
				</div>
				
				
				
				
				
				
				
				<div class="red box form-row">
					<span class="form-field-title">ROSI Field</span>
					<span class="form-field">
						<select name="rosi">
							<option value="">--Select--</option>
							<option value="0">No</option>
							<option value="1">Yes</option>
						</select>
					</span>
				</div>
				<div class="form-row">
					<span class="form-field-title">ROSI</span>
					<span class="form-field">
						<input type="checkbox"  value="red">
					</span>
				</div>
				
				
				
				<div class="form-row">
					<span class="form-field-title"></span>
					<span class="form-field">
						
						<input type="reset" class="btn btn-blue" value="Reset" />
						<input type="submit" class="btn" value="Submit" />
					</span>
				</div>
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