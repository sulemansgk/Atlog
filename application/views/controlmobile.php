<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>Control Mobile 1
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
				<form action="<?=base_url()?>elog/insertcontrolmobile1" class="log-add-form" method="post">
					
					<input type="hidden" name="subject" value="Control Mobile 1" />
					<input type="hidden" name="mobile_type" value="control mobile 1" />
					
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
								<span class="form-field-title">Date*</span>
								<input type="text" class="date-field form-control date-picker" name='date' value="<?=date("m/d/Y")?>" required="required" />
							</div>
						</div>
					</div>
					
					
					
					
					<div class="row pform" >
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">Time*</span>
								
								<!-- <input type="text" class="form-control timepicker timepicker-default" name='time' required="required"/> -->
								
								<input type="text" placeholder="Time" class="form-control clockpicker" value="<?=date("H:i")?>" name="time" required="required">	
								
							</div>
						</div>
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">To/From</span>
								
								<select name="to_from" class="form-control">
									<option value="">--Select User--</option>
									<?
									foreach($allusers as $key=>$user){
									?>
									<option value="<?=$user["agentname"]?>"><?=$user["agentname"]?></option>
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
								<span class="form-field-title">Remarks</span>
								
								<textarea name="remarks" id="textarea" class="form-control" ></textarea>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group" >
								<span class="form-field-title">Control Mobile 1</span>
								<?
								if(empty($cm1)){
								?>
								<input type="text" readonly="readonly" name="control_mobile1" class="btn btn-primary " style="cursor: pointer;" value="IN" />
								<?
								}else if($cm1["control_mobile1"] == "IN" ){
								?>
								<input type="text" readonly="readonly" name="control_mobile1" class="btn btn-danger " style="cursor: pointer;" value="OUT"  />
								<?
								}else if(($cm1["control_mobile1"] == "OUT")){
								?>
								<input type="text" readonly="readonly" name="control_mobile1" class="btn btn-primary " style="cursor: pointer;" value="IN" />
								<?
								}
								?>
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
<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>Control Mobile 2
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
				<form action="<?=base_url()?>elog/insertcontrolmobile2" class="log-add-form" method="post">
					<input type="hidden" name="datetime" value="<?=date("Y-m-d H:i:s")?>" />
					<input type="hidden" name="subject" value="Control Mobile 2" />
					<input type="hidden" name="mobile_type" value="control mobile 2" />
					
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
								<span class="form-field-title">Date*</span>
								<input type="text" class="date-field form-control date-picker" name='date' value="<?=date("m/d/Y")?>" required="required" />
							</div>
						</div>
					</div>
					
					
					
					
					<div class="row pform" >
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">Time*</span>
								
								<!-- <input type="text" class="form-control timepicker timepicker-default" name='time' required="required"/> -->

						<input type="text" placeholder="Time" class="form-control clockpicker" value="<?=date("H:i")?>" name="time" required="required">				
								
							</div>
						</div>
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">To/From </span>
								
								<select name="to_from" class="form-control">
									<option value="">--Select User--</option>
									<?
									foreach($allusers as $key=>$user){
									?>
									<option value="<?=$user["agentname"]?>"><?=$user["agentname"]?></option>
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
								<span class="form-field-title">Remarks</span>
								
								<textarea name="remarks"  class="cmtxt form-control" ></textarea>
							</div>
						</div>
						
						
						<div class="col-md-6">
							<div class="form-group" >
								<span class="form-field-title">Control Mobile 2</span>
								<?
								if(empty($cm2)){
								?>
								<input type="text" readonly="readonly" name="control_mobile2" class="btn btn-primary" style="cursor: pointer;" value="IN" />
								<?
								}else if($cm2["control_mobile2"] == "IN" ){
								?>
								<input type="text" readonly="readonly" name="control_mobile2" class="btn btn-danger" style="cursor: pointer;" value="OUT"  />
								<?
								}else if(($cm2["control_mobile2"] == "OUT")){
								?>
								<input type="text" readonly="readonly" name="control_mobile2" class="btn btn-primary" style="cursor: pointer;" value="IN" />
								<?
								}
								?>
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