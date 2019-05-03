<?
$user_logged = $this->userdetails["agentunit"];
$user_unit = unserialize($user_logged);
$a = count($user_unit);
$rwy_unit = $this->db->get_where('runway', array('unit_id' => $user_unit[0]))->result_array();
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>Runway In Use
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
				<form action="<?=base_url()?>elog/insertRunwayInUse" class="rwy-form" method="post">
					<input type="hidden" name="subject" value="Runway In Use" />
					<input type="hidden" name="initial" value="<?=$this->userdetails["agentcode"]?>" />
					
					<div class="row pform" style="padding-top:1%;" ><!-- // column -->
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
							<input type="text" class="date-field form-control date-picker" name='date' value="<?=date("m/d/Y", strtotime('-4 hours'))?>" required="required" />
						</div>
					</div>
				</div>
				<div class="row pform">
					<div class="col-md-6">
						
						<div class="form-group">
							<span class="form-field-title">Time*</span>
							<input type="text" required="required" placeholder="Time" class="form-control clockpicker" value="<?=date("H:i", strtotime('-4 hours'))?>" name="time" />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
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
				<div class="row pform">
					<div class="col-md-6">
						<div class="form-group">
							<span class="form-field-title">Units</span>
							<select name="unit_id" class="form-control unt"  required="required">
								
								<option value="">--Select Unit--</option>
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
					<div class="col-md-6">
						<div class="form-group">
							<span class="form-field-title">Arrival Runway</span>
							<select name="runway_in_use" class="runway-status form-control rwy"  required="required">
								
								
							</select>
						</div>
					</div>
					
					
					
				</div>
				<div class="row pform">
					<div class="col-md-6">
						<div class="form-group">
							<span class="form-field-title">Departure Runway</span>
							<select name="runway_in_use_depart" class="runway-status form-control rwy"  required="required">
								
							</select>
						</div>
					</div>
					<div class="col-md-6" style="padding-bottom:1%;">
						<span class="form-field-title">Description</span>
						<span class="form-field" style="width: 70%;">
							<textarea name="description" id="textarea"  class="form-control"></textarea>
						</span>
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
<script type="text/javascript">
$(document).ready(function(){
	$(".rwy-form").submit(function(){
			if(confirm("Please confirm to add the entry.")){
				return true;
			}else{
				return false;
			}
	});
});
</script>
<!-- AREA SELECTED -->
<script>
$(".unt").change(function(){
var unit= $(".unt").val();
$.ajax({
type:"post",
url: "<? echo base_url(); ?>elog/SelectedUnit",
data:{unit:unit},
success:function(response)
{

$('.rwy').html(response);


}

}
);
});

</script>
<!-- AREA SELECTED END -->
<!-- // page content -->

<script type="text/javascript">
$('.clockpicker').clockpicker();
</script>