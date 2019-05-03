<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>Safe Guarding Lvo
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
				<form action="<?=base_url()?>elog/insertsafeguardinglvo" class="log-add-form" method="post">
					<input type="hidden" name="subject" value="Safe Guarding Lvo" />
					<input type="hidden" name="initial" value="<?=$this->userdetails["agentcode"]?>" />
					<input type="hidden" name="datetime" value="<?=date("Y-m-d H:i:s")?>" />
					
					
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
								<input type="text" name="date" class="date-field form-control date-picker" value="<?=date("d/m/Y")?>" required="required" />
								
							</div>
						</div>
					</div>
					
					
					
					
					<div class="row pform" >
						<div class="col-md-6">
							
							
							
							
							<div class="form-group">
								<span class="form-field-title">Time * </span>
								
								<input type="text" value="<?=date("H:i")?>" name="time" class="time-field form-control clockpicker" oninput="maxLengthCheck(this);"/>								
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
					<div class="row pform" style="padding-bottom:2%; ">
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
								<span class="form-field-title">Update ATIS</span>
								<input type="checkbox" name="checked2" value="1">
								<select name="Update_ATIS" class="form-control">
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