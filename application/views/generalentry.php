<?
$user_logged = $this->userdetails["agentunit"];
$user_unit = unserialize($user_logged);
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>General Entry
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
				
				
				
				
				
				
				
				<form action="<?=base_url()?>elog/insertgeneralentry" class="log-add-form" method="post">
					
					<div class="row pform" style="padding-top:1%;"  >
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">Initial</span>
								
								<input type="text" class="form-control" readonly="readonly" value="<?=$this->userdetails["agentname"]?>" />
								<input type="hidden" class="form-control" name="initial" readonly="readonly" value="<?=$this->userdetails["agentcode"]?>" />
								
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">Date*</span>
								<input type="text" class="date-field form-control date-picker" name='date' value="<?=date("m/d/Y", strtotime('-4 hours'))?>" required="required" />
							</div></div>
							
							
							
							
							
							
						</div>
						
						
						
						
						<div class="row pform" >
							<div class="col-md-6">
										
					<div class="form-group">
							
					<span class="form-field-title">Time*</span>
							
	<input type="text" placeholder="Time" class="form-control clockpicker" value="<?=date("H:i", strtotime('-4 hours'))?>" name="time" />
					
				</div>
										</div>
							
							
							<div class="col-md-6">
								<div class="form-group" >
									<? //echo "<pre>";print_r($allusers);die(); 
										?>
										<span class="form-field-title">On Behalf</span>
										<select name="onbehalf" class="form-control">
											<option value="">--Select User--</option>
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
										<span class="form-field-title">Subject *</span>
										
										<select name="subject"  class="form-control" required="required">
											<option value="">-- Select Subject --</option>
											<? foreach ($user_unit as $u) {
											foreach($subjects as $key=>$subject){
											if ($u == $subject["unit_id"]) {
											?>
											<option value="<?=$subject["id"]?>"><?=$subject["subject"]?></option>
											<?
											} } }
											?>
										</select>
									</div>
								</div>
								
								
								<div class="col-md-6">
									<div class="form-group" >
										<span class="form-field-title">Description</span>
										<textarea name="description" id="textarea"  class="form-control" ></textarea>
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