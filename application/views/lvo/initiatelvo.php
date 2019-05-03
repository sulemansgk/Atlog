<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>Initiate Lvo
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
				<form action="<?=base_url()?>elog/insertlvo" class="log-add-form" method="post">
					<input type="hidden" name="subject" value="Initiate LVO" />
					<input type="hidden" name="initial" value="<?=$this->userdetails["agentcode"]?>" />
					
					
					<div class="row pform" style="padding-top:1%;"  >
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">Initial</span>
								
								<input type="text" name = "intial" readonly="readonly" class="form-control" value="<?=$this->userdetails["agentname"]?>" />
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">Date *</span>
								<input type="text" name="date" class="date-field form-control date-picker" name="date" value="<?=date("m/d/Y")?>" required="required" />
								
							</div>
						</div>
					</div>
					
					
					
					
					<div class="row pform" >
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">Time * </span>
								<input type="text" name = "time" value="<?=date("H:i")?>" class="time-field form-control clockpicker" oninput="maxLengthCheck(this);" />
								<input type="hidden" class="datetime-field form-control" name="form_datetime" oninput="maxLengthCheck(this);"value="<?=date("Y-m-d H:i:s")?>" required="required" />
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">On Behalf Of</span>
								
								<select name="onbehalf" class="form-control">
									<option value="">Select</option>
									<?
									foreach($allUsers as $key=>$user){
									?>
									<option value="<?=$user["agentname"]?>"><?=$user["agentname"]?></option>
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
								<span class="form-field-title">Operate AGL Panel </span>
								
								<input type="checkbox" name="checked" value="1">
								<select name="Operate_AGL_Panel" class="form-control" >
									<option value="">Select</option>
									<?
									foreach($allUsers as $key=>$user){
									?>
									<option value="<?=$user["agentname"]?>"><?=$user["agentname"]?></option>
									<?
									}
									?>
								</select>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">Request Weather Standby</span>
								
								<input type="checkbox" name="checked2" value="1">
								<select name="Request_Weather_Standby" class="form-control" >
									<option value="">Select</option>
									<?
									foreach($allUsers as $key=>$user){
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
							<div class="form-group" >
								<span class="form-field-title">Update ATIS (LVO in Force)</span>
								<input type="checkbox" name="checked3" value="1">
								<select name="Update_ATIS" class="form-control" >
									<option value="">Select</option>
									<?
									foreach($allUsers as $key=>$user){
									?>
									<option value="<?=$user["agentname"]?>"><?=$user["agentname"]?></option>
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

<script type="text/javascript">
$('.clockpicker').clockpicker();
</script>