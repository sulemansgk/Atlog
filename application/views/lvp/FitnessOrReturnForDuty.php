<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>Fitness Or Return For Duty
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
					<input type="hidden" name="subject" value="Fitness Or Return For Duty" />
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
					
					
					
					
					<div class="row pform" style="padding-bottom:2%; ">
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">First Date Of Duty </span>
								
								<input type="text" class="datetime-field form-control date-picker" name="date_of_duty" />
							</div>
						</div>
						
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">Remarks</span>
								
								<textarea name="remarks"  class="cmtxt form-control" ></textarea>
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