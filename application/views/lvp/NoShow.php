<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>No Show
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
				<form action="<?=base_url()?>elog/insertlvp" class="log-add-form" method="post">
					<input type="hidden" name="subject" value="No Show" />
					
					<input type="hidden" class="date-field form-control date-picker" name='date' value="<?=date("m/d/Y")?>"/>
					<input type="hidden" class="form-control timepicker timepicker-default" name='time'/>
					
					<div class="row pform" style="padding-top:1%;"  >
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">Initial</span>
								
								<input type="text" readonly="readonly" class="form-control" value="<?=$this->userdetails["agentname"]?>" />
								<input type="hidden" name="initial" class="form-control" readonly="readonly" value="<?=$this->userdetails["agentcode"]?>" />
								
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">Name</span>
								<select name="name" class="form-control">
									<option value="">--Select--</option>
									<?
									foreach($allusers as $key=>$user){
									?>
									<option value="<?=$user["agentcode"]?>"><?=$user["agentname"]?></option>
									<?
									}
									?>
								</select>
								
							</div>
						</div>
					</div>
					
					
					
					
					<div class="row pform" >
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">Shift Duty </span>
								
								<select name="shift_duty" class="form-control">
									<option value="">--Select--</option>
									<?
									foreach($shiftnames as $key=>$shift){
									?>
									<option value="<?=$shift["id"]?>"><?=$shift["shift"]?></option>
									<?
									}
									?>
								</select>
							</div>
						</div>
						
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">Call Out Required</span>
								
								<select name="call_out_required" class="call-out-req form-control">
									<option value="">--Select--</option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>
						
					</div>
					
					
					
					
					<div class="row pform req_yes" style="padding-bottom:2%; display:none; ">
						
						
						
						<div class="col-md-6">
							<div class="form-group" >
								<span class="form-field-title">Name</span>
								<select name="name2" class="form-control">
									<option value="">--Select--</option>
									<?
									foreach($allusers as $key=>$user){
									?>
									<option value="<?=$user["agentcode"]?>"><?=$user["agentname"]?></option>
									<?
									}
									?>
								</select>
							</div>
						</div>
						
						
						<div class="col-md-6">
							<div class="form-group" >
								<span class="form-field-title">Shift Duty</span>
								<select name="shift_duty2" class="form-control">
									<option value="">--Select--</option>
									<?
									foreach($shiftnames as $key=>$shift){
									?>
									<option value="<?=$shift["id"]?>"><?=$shift["shift"]?></option>
									<?
									}
									?>
								</select>
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
<script>
$(".call-out-req").change(function(){
	
	selected_value =$(this).val();
	
	if(selected_value == "Yes"){
		$(".req_yes").css('display','block');
	}else{
		$(".req_yes").css('display','none');
	}
	
	
	
});
</script>