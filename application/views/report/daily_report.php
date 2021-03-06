<!-- // page head -->
<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>Daily Report
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
				
				
				<form action="<?=base_url()?>report/generateDailyReport" class="log-add-form" method="post">
					
					<div class="row pform" style="padding-top:1%;"  >
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">From</span>
								
								<input type="text" name="from" class="date-picker form-control" value="<?=date("m/d/Y")?>" />
								
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">To</span>
								<input type="text" name="to" class="date-picker form-control" value="<?=date("m/d/Y")?>" />
							</div>
						</div>
						
						
						
						
						
					</div>
					
					
					
					
					<div class="row pform" style="padding-bottom:2%; padding-top:2%;">
						<div class="col-md-5">
							
							<div class="form-group">
								<span class="form-field-title">Unit</span>
								
								<select name="unit_id" class="form-control" required="required">
									<option value="">--Select--</option>
									<?
									foreach($units as $key=>$unit){
									?>
									<option value="<?=$unit["unit_id"]?>"><?=$unit["unit"]?></option>
									<?
									}
									?>
								</select>
								
							</div>
						</div>
						
						
						
					</div>
					
					<div class="form-actions left">
						
						<div class="col-md-5">
							
							
							
							<div class=" form-actions" style="border-top: 0">
								
								
								<input type="submit" class="btn btn-success" name="submit" value="Submit" />
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