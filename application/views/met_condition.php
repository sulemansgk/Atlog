<?
$user_logged = $this->userdetails["agentunit"];
$user_unit = unserialize($user_logged);
$a = count($user_unit);
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>MET Condition
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
				
				
				
				
				
				
				
				<form action="<?=base_url()?>elog/insertmetcondition" class="log-add-form" method="post">
					<input type='hidden' name='subject' value='MET Condition' />
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
									
									<input type="text" class="form-control clockpicker" value="<?=date("H:i", strtotime('-4 hours'))?>" name='time' required="required"/>
									
									
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<span class="form-field-title">Units*</span>
									<select name="unit_id" class="form-control"  required="required">
										<? if ($a != 1) { ?>
										<option value="">--Select Unit--</option>
										<? } ?>
										
										<?
										foreach($user_unit as $unit){
										$unit_name = $this->db->get_where('units', array('unit_id' => $unit))->row();
										?>
										<option value="<?=$unit_name->unit_id?>"><?=$unit_name->unit?></option>
										<?
										} ?>
									</select>
								</div>
							</div>
							
							
						</div>
						<div class="row pform" style="padding-top:1%;"  >
							<div class="col-md-12" style="padding-bottom: 1%;">
								<span class="form-field-title">MET Conditions*</span>
							</div>
							
							<div class="col-md-12">
								<div class="form-group">
									
									
									<div class="form-field">
										<input type="radio" id="radio" name="condition" value="vmc" required="required" class="md-radiobtn">
										<label for="radio1">
											<span class="inc"></span>
											<span class="check"></span>
											<span class="box"></span>
										VMC </label>
									</div>
								</div>
							</div>
							
							<div class="col-md-12">
								<div class="form-group">
									
									
									<div class="form-field">
										<input type="radio" id="radio" name="condition" value="imc" required="required" class="md-radiobtn">
										<label for="radio2">
											<span class="inc"></span>
											<span class="check"></span>
											<span class="box"></span>
										IMC </label>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									
									
									<div class="form-field">
										<input type="radio" id="radio" name="condition" value="lvs" required="required" class="md-radiobtn">
										<label for="radio3">
											<span class="inc"></span>
											<span class="check"></span>
											<span class="box"></span>
										LVS </label>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									
									
									<div class="form-field">
										<input type="radio" id="radio" name="condition" value="lvo" required="required" class="md-radiobtn">
										<label for="radio3">
											<span class="inc"></span>
											<span class="check"></span>
											<span class="box"></span>
										LVO </label>
									</div>
									
									
									
								</div>
							</div>
							
							<div class="col-md-12">
								<div class="form-group">
									
									
									<div class="form-field">
										<input type="radio" id="radio" name="condition" value="lvp" required="required" class="md-radiobtn">
										<label for="radio3">
											<span class="inc"></span>
											<span class="check"></span>
											<span class="box"></span>
										LVP </label>
									</div>
									
									
									
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