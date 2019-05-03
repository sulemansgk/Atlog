<!-- // page content -->
<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>AIRFIELD GROUND LIGHTING (AGL) INSPECTION
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
				<form action="<?=base_url()?>elog/insertAgl" class="log-add-form" method="post">
					<input type="hidden" name="subject" value="AIRFIELD GROUND LIGHTING (AGL) INSPECTION" />
					<input type="hidden" name="initial" value="<?=$this->userdetails["agentcode"]?>" />
					<input type="hidden" class="date-field form-control date-picker" name='date' value="<?=date("m/d/Y")?>"/>
					<input type="hidden" class="form-control timepicker timepicker-default" name='time'/>
					
					<div class="row pform" style="padding-top:1%; padding-bottom:2%; "  >
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">CAT- III Routing</span>
								
								<select class="agl-select form-control" name="cat_routing" required="required" >
									<option value="">Select</option>
									<option value="Serviceable">Serviceable</option>
									<option value="Un Serviceable">Un Serviceable</option>
								</select>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group agl-remarks" style="display:none;">
								<span class="form-field-title">Remarks</span>
								<textarea name="remarks" class="form-control" id="detail" ></textarea>
								
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
$(".agl-select").change(function(){
	
	selected_value =$(this).val();
	
	if(selected_value == "Un Serviceable"){
		$(".agl-remarks").css('display','block');
	}else{
		$(".agl-remarks").css('display','none');
	}
	
	
	
});
</script>