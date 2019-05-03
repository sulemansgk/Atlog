<?
$user_logged = $this->userdetails["agentunit"];
$user_unit = unserialize($user_logged);
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i> Equipment Release
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
				<form action="<?=base_url()?>elog/insertFaultReporting" class="log-add-form" method="post">
					<input type="hidden" name="subject" value="Equipment Release" />
					<input type="hidden" name="initial" value="<?=$this->userdetails["agentcode"]?>" />
					<div class="row pform" style="padding-top:1%;"  ><!-- // column -->
					<div class="col-md-6">
						<div class="form-group">
							<span class="form-field-title">Initial</span>
							<input type="text" readonly="readonly" class="form-control" value="<?=$this->userdetails["agentname"]?>" />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<span class="form-field-title">Date: *</span>
							<input type="text" class="date-field form-control date-picker" name="date" value="<?=date("m/d/Y")?>" required="required" />
						</div>
					</div>
				</div>
				<div class="row pform">
					<div class="col-md-6">
						<div class="form-group">
							<span class="form-field-title">Time: *</span>
							<!-- <input type="text" id="time" name="time" placeholder="Time" class="form-control"> -->
							<input type="text" placeholder="Time" class="form-control clockpicker" value="<?=date("H:i")?>" name="time" />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<span class="form-field-title">On Behalf Of: *</span>
							<select name="onbehalf" class="form-control">
								<option value="">Select</option>
								<?
								foreach($allUsers as $key=>$user){
								?>
								<option value="<?=$user["agentcode"]?>"><?=$user["agentname"]?></option>
								<?
								}
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="row pform">
					<div class="col-md-6">
						<div class="form-group">
							<span class="form-field-title">Position: </span>
							<select name="position_name" class="form-control">
								<option value="">--Select Position--</option>
								<? foreach ($user_unit as $u) {
								
								
								foreach($positions as $key=>$position){
								if ($u == $position["unit_id"]) {
								?>
								<option value="<?=$position["name"]?>"><?=$position["name"]?></option>
								<?
								} } }
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<span class="form-field-title">Console: </span>
							<select name="console_number" class="form-control">
								<option value="">--Select Console--</option>
								<? foreach ($user_unit as $u) {
								foreach($consoleNumbers as $key=>$number){
								if ($u == $number["unit_id"]) {
								?>
								<option value="<?=$number["name"]?>"><?=$number["name"]?></option>
								<?
								} } }
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="row pform">
					<div class="col-md-6">
						<div class="form-group">
							<span class="form-field-title">Equipment: </span>
							<select name="system_equipment" class="form-control">
								<option value="">--Select Equipment--</option>
								<?	foreach ($user_unit as $u) {
								foreach($equipments as $key=>$equipment){
								if ($u == $equipment["unit_id"]) {
								?>
								<option value="<?=$equipment["name"]?>"><?=$equipment["name"]?></option>
								<?
								} } }
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<span class="form-field-title">Purpose Of Release: *</span>
							<input type="text" name="purpose_of_release" class="form-control" value="" required="required" />
						</div>
					</div>
				</div>
				<div class="row pform">
					<div class="col-md-6" style="padding-bottom:2%;">
						<div class="form-group">
							<span class="form-field-title">Description: *</span>
							<textarea name="any_other_details" id="desc" class="form-control"></textarea>
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
				<!-- // Example row -->
				
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