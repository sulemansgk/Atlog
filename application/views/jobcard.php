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
<div id="wrp" style="">
	<?php foreach($fault as $faultss){  ?>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet box purple" style="display:block">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-desktop"></i>Job Details
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
					<form class="emergency-edit-form" method="post" action="<?=base_url()?>elog/insertjob">
						<div class="row pform" style="padding-top:1%;"  >
							<div class="col-md-6">
								<input type="hidden" name="subject" value="New Job Inserted" />
								<input type="hidden" name="initial" value="<?=$this->userdetails["agentcode"]?>" />
								<input type="hidden" name="datetime" value="<?=date("Y-m-d H:i:s")?>" />
								<input type="hidden" name="time" value="<?=date("H:i:s")?>" />
								<input type="hidden" name="faultreportnum" value="<?=$faultss['id']?>" />
								
								<span class="form-field-title">Username</span>
								<span class="form-field">
									<input type="text" class="form-control"  value="<?=$this->userdetails["agentcode"]?>" />
								</span>
							</div>
							
							<div class="col-md-6">
								<span class="form-field-title">Date</span>
								<span class="form-field">
									<input type="text" name="Equipment" class="date-field form-control date-picker" required="required" />
								</span>
							</div>
							
							<div class="col-md-6">
								<span class="form-field-title">Time</span>
								<span class="form-field">
									<input type="text" name="Equipment" class="time-field form-control timepicker timepicker-default"  required="required" />
									<input type="hidden" class="datetime-field" name="" oninput="maxLengthCheck(this);"value="<?=date("Y-m-d H:i:s")?>" required="required" />
								</span>
							</div>
							
							<div class="col-md-6">
								<span class="form-field-title">Job Card (FRN)</span>
								<span class="form-field">
									<input type="text" name="jobcard" class="form-control"  value="<?=$faultss["id"]; echo "-".date("m/y");?>"   />
								</span>
							</div>
							
							
							
							
							<div class="col-md-6">
								<span class="form-field-title">Customer :</span>
								<span class="form-field" >
									
									<select name="customer" class="form-control">
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
							
							
							<div class="col-md-6">
								<span class="form-field-title">Contact Tel :</span>
								<span class="form-field">
									<input type="text" class="form-control"  name="contactTel" value="" required="required" />
								</span>
							</div>
							
							
							<div class="col-md-6">
								<span class="form-field-title">Job Category :</span>
								<span class="form-field">
									
									<select name="jobcat" class="form-control">
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
							
							
							
							<div class="col-md-6">
								<span class="form-field-title">Callibration Item</span>
								<span class="form-field">
									<select name="calItem" class="form-control">
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
							
							
							<div class="col-md-6">
								<span class="form-field-title">System</span>
								<span class="form-field">
									<select name="system" class="form-control">
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
							
							
							
							<div class="col-md-6">
								<span class="form-field-title">Freq</span>
								<span class="form-field">
									<select name="freqch" class="form-control">
										<option value="">--Select Frequency--</option>
										<?
										foreach($freq as $key=>$number){
										?>
										<option value="<?=$number["name"]?>"><?=$number["name"]?></option>
										<?
										}
										?>
									</select>
									
								</span>
							</div>
							
							
							
							<div class="col-md-6">
								<span class="form-field-title">LRU</span>
								<span class="form-field">
									<select name="lru" class="form-control">
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
							
							
							<div class="col-md-6">
								<div class="" style="clear:left;">
									<span class="form-field-title">Ext Ref# </span>
									<span class="form-field">
										<input  type="text" class="form-control" name="ext" value=""  />
									</span>
								</div></div>
								<div class="col-md-6">
									<span class="form-field-title">Initiate CCF </span>
									<span class="form-field">
										<select name="initiate" class="form-control">
											<option value="">--Select--</option>
											<option value="0">No</option>
											<option value="1">Yes</option>
											
										</select>
									</span>
								</div>
								
								<div class="col-md-6" style="display:none">
									<div class="red box " >
										<span class="form-field-title">ROSI Field</span>
										<span class="form-field">
											<select name="rosi" class="form-control">
												<option value="">--Select--</option>
												<option value="0">No</option>
												<option value="1">Yes</option>
											</select>
										</span>
									</div></div>
									
									<br /><br /><br />
									<br /><br /><br />
									<br /><br /><br />
									
									
									
									<div class="col-md-6">
										<span class="form-field-title">Equip Manual:</span>
										<span class="form-field">
											<input type="file" class="btn btn-primary" value="Attachments" />
										</span>
									</div>
									
									
									
									
									<br /><br /><br />
									
									
									<div class="col-md-6">
										<span class="form-field-title">ROSI</span>
										<span class="form-field">
											<input type="checkbox"  value="red">
										</span>
									</div>
									
									<br /><br /><div class="col-md-12" style="text-align:center">
										<h4>Details Reported</h4>
									</div>
									<br /><br />
									
									<div class="col-md-6">
										<span class="form-field-title">Initials</span>
										<span class="form-field">
											<input type="text" name="initials" readonly="readonly" class="form-control" value="<?=$this->userdetails["agentname"]?>" />
										</span>
									</div>
									<div class="col-md-6">
										<span class="form-field-title">Date </span>
										<span class="form-field">
											
											<input type="text" required="required"  readonly="readonly" value="<?=$faultss['datetime'] ?>" class="form-control date-field hasDatepicker" id="dp1410757438442">
										</span>
									</div>
									<div class="col-md-6">
										<span class="form-field-title">Time GMT :</span>
										<span class="form-field">
											<? $str=strtotime($faultss['datetime']); ?>
											<input type="text" class="time-field form-control"  readonly="readonly"   value="<?=date('H:i',$str);?>" />
											<input type="hidden" class="datetime-field form-control" name="form_datetime" oninput="maxLengthCheck(this);"value="<?=date("Y-m-d H:i:s")?>" required="required" />
											
										</span>
									</div>
									
									<div class="col-md-6">
										<span class="form-field-title">Position</span>
										<span class="form-field">
											<input type="text" name="Position" class="form-control" readonly="readonly" value="<?=$faultss['position_name'] ?>"  />
										</span>
									</div>
									
									
									
									<div class="col-md-6">
										<span class="form-field-title">Console</span>
										<span class="form-field">
											<input type="text" name="Console" class="form-control"  readonly="readonly" value="<?=$faultss['console_number'] ?>"  />
										</span>
									</div>
									
									<div class="col-md-6">
										<span class="form-field-title">Equipment</span>
										<span class="form-field">
											<input type="text" name="Equipment" class="form-control"   readonly="readonly" value="<?=$faultss['system_equipment'] ?>"  />
										</span>
									</div>
									<div class="col-md-6">
										<span class="form-field-title">Error</span>
										<span class="form-field">
											<input type="text" name="error" class="form-control"  readonly="readonly" value="<?=$faultss['error_text'] ?>"  />
										</span>
									</div>
									
									<br/><br/><br/>
									<br/><br/><br/>
									<br/><br/>
									
									<div class="col-md-6">
										<span class="form-field-title">Task Description:</span>
										<span class="form-field">
											<textarea name="any_other_details" id="desc" readonly="readonly" class="form-control" ><?=$faultss['any_other_details'] ?></textarea>
										</span>
									</div>
									
									<br/><br/><br/>
									<br/><br/><br/>
									<div class="col-md-6" style="padding-bottom:2%;">
										<span class="form-field-title">Equip</span>
										<span class="form-field">
											<input type="text" class="form-control" name="error"   />
										</span>
									</div>
									
									<br /><br />
									<div class="row">
										<div class="col-md-6" style="padding-top:2%;">
											
											<span class="form-field">
												
												<input type="reset" class="btn btn-danger" value="Reset" />
												<input type="submit" class="btn btn-success" value="Submit" />
											</span>
										</div></div></div>
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
					<?php }?>
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