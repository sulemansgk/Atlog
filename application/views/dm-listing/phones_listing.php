<?
$user_logged = $this->userdetails["agentunit"];
$user_unit = unserialize($user_logged);
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>Phone Numbers Search
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
				<form action="<?=base_url()?>domainparameters/viewPhones" method="post" class="accesslogs-search-form">
					
					
					<div class="row pform" style="padding-top: 1%;">
						<div class="col-md-6">
							
							<div class="form-group">
								<label for="agentunit">Unit:</label>
								<select name="agentunit" class="form-control">
									<option value="">--Select--</option>
									<?
									foreach($user_unit as $unit){
									$unit_name = $this->db->get_where('units', array('unit_id' => $unit))->row();
									?>
									<option <?if($phone_filter["agentunit"] == $unit["unit_id"]){?>selected="selected"<?}?> value="<?=$unit_name->unit_id?>"><?=$unit_name->unit?></option>
									<?
									}
									?>
								</select>				</div>
							</div>
							
							<div class="col-md-6">
								
								<div class="form-group">
									<label for="agentname">Keyword:</label>
									
									<input name="keyword" placeholder="Enter keyword..." class="al-keyword form-control" type="text" value="<?=$positions_filter["keyword"]?>"/>
								</div>
							</div>
							
						</div>
						
						<div class="form-actions left" >
							
							<div class="col-md-5" style="padding-bottom:2%;">
								
								
								
								<div class=" form-actions" >
									
									
									<input type="submit" name="al-filter" class="btn btn-success" value="Filter"/>
									<input type="submit" name="al-filter-reset" class="al-form-reset btn btn-danger" value="Cancel" onclick="clearAccessLogsForm();"/>
									
								</div>
								
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12" >
			<!-- BEGIN SAMPLE TABLE PORTLET-->
			<div class="portlet box purple">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-desktop"></i>Phone Numbers
					</div>
					<a style='margin-left: 69%;margin-top: 4px;' class='btn btn-primary' href="<?=base_url()?>domainparameters/phone">Add Phone</a>
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
				<div class="portlet-body">
					<form action="<?=base_url()?>elog/mainview" method="post">
						<input type="hidden" name="faultreports" value="<?=$this->uri->segment(3)?>" />
						
						
					</form>
					<div class="table-scrollable">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th scope="col" >
										Phone Number
									</th>
									<th scope="col">
										For
									</th>
									<th scope="col">
										Descripton
									</th>
									<th scope="col">
										Unit
									</th>
									<th scope="col">
										Action
									</th>
									
									
								</tr>
							</thead>
							<tbody>
								<?
								foreach($phones as $key=>$row){
								$unit_name = $this->db->get_where("units",array("unit_id"=>$row["unit_id"]))->row();
								?>
								
								<tr >
									<td>
										<?=$row["phone_number"]?>
									</td>
									<td>
										<?
										$row_forms = unserialize($row["for_form"]);
										foreach($row_forms as $key=>$form){
										print($form.",");
										}
										?>
										
									</td>
									<td>
										<?=$row["description"]?>
									</td>
									<td>
										<?=$unit_name->unit?>
									</td>
									<td>
										<a href="javascript:void(0);"  class="btn btn-primary" onclick="editPhone(<?=$row["phone_id"]?>,'Edit: <?=$row["phone_number"]?>');">Edit</a><a href="javascript:void(0);" class="btn btn-danger"  onclick="deletePhone(<?=$row["phone_id"]?>,this);">Delete</a>
									</td>
									
								</tr>
								
								
								
								
								
								
								<? } ?>
								
								
							</tbody>
							
						</table>
					</div>
					
				</div>
			</div>
			<!-- END SAMPLE TABLE PORTLET-->
		</div>
	</div>
	
	<? if(!empty($_GET['msg']) && $_GET['msg'] == 'success'){?>
	<script>
	// assumes you're using jQuery
	$(document).ready(function() {
	$('.confirm-div').html("<div class='alert alert-success'><strong>Successfully Added!</strong></div>").show();
	setTimeout(function() {
	$('.confirm-div').slideUp("slow");
	}, 2000);
	
	});
	</script>
	<?}else if(!empty($_GET['msg']) && $_GET['msg'] == 'danger'){?>
	<script>
	// assumes you're using jQuery
	$(document).ready(function() {
	$('.confirm-div').html("<div class='alert alert-danger'><strong>Already Exist!</strong></div>").show();
	setTimeout(function() {
	$('.confirm-div').slideUp("slow");
	}, 2000);
	
	});
	</script>
	<?}?>
	<style>
		.pform
		{
			padding-left:2%;
			padding-right:2%;
		}
	</style>