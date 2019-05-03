<!-- // page content -->
<div class="row">
	<div class="col-md-12" >
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>Units
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
			<div class="portlet-body">
				<div class="row pform" style="padding-top:1%;"  >
					
				</div>
				<a href="javascript:void(0);" class="btn btn-primary " onclick="addNewUnit();" data-toggle="modal" data-target="#myModal1">Add New Unit</a>
				<div class="table-scrollable">
					
					<table class="table table-striped table-bordered table-hover">
						<thead>
							
							<tr>
								
								<th scope="col">
									S.No
								</th>
								<th scope="col">
									Unit
								</th>
								<th scope="col">
									Actions
								</th>
								
							</tr>
						</thead>
						<tbody>
							<?
							if(!empty($units)){
							$i = 0;
							foreach($units as $unit){
							
							$i++;
							?>
							<tr  >
								<td  >
									<?=$i?>
								</td>
								<td>
									<?=ucfirst($unit["unit"])?>
								</td>
								<td>
									<a href="javascript:void(0);" class="btn btn-success ed" data-norunway="<?=$unit["no_runway"]?>" data-unit="<?=$unit["unit"]?>" data-id="<?=$unit["unit_id"]?>" onclick="editUnit(<?=$unit["unit_id"]?>,'<?=$unit["unit"]?>',<?=$unit["no_runway"]?>,this);" data-toggle="modal" data-target="#myModal2">Edit Unit</a>
									<a href="javascript:void(0);" class=" <?if($unit["active"] == 0){print("btn btn-success");}else{print("btn btn-danger");}?>" onclick="activateUnit(<?=$unit["unit_id"]?>,this);">
										<?if($unit["active"] == 0){?>Activate<?}else{?>Deactivate<?}?>
									</a>
									
								</td>
								
								
								
							</tr>
							<?
							
							}
							}else{
							?>
							<li class="list-row">There are no Units defined.</li>
							<?
							}
							?>
							
						</tbody>
						
					</table>
				</div>
				<div class="container">
					
					<!-- Modal -->
					<div class="modal fade" id="myModal1" role="dialog">
						<div class="modal-dialog">
							
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Add Unit</h4>
								</div>
								<div class="modal-body">
									<div class="add-new-role-form-wrap" >
										<form class="add-new-unit-form" id="form_data" action="<?=base_url()?>index/insertUnit" method="post">
											<div class="row">
												<div class="col-md-6">
													<label>Unit: </label>
													<input type="text" name="unit" class="form-control" placeholder="Unit..." required="required"/>
												</div>
												<div class="col-md-6">
													<span class="form-field-title">No Runway on Dashboard</span>
													<span class="form-field">
														<p>
															<input  name="no_runway" type="checkbox" data-toggle="toggle"  class="hello">
															
														</p>
														
													</span>
												</div>
											</div>
											<br>
											<input type="submit" class="btn btn-success btn_submit" value="Add" />
										</form>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
							
						</div>
					</div>
					
				</div>
				<!----Add unit end---->
				<!----Edit Unit---->
				<div class="container">
					
					<!-- Modal -->
					<div class="modal fade" id="myModal2" role="dialog">
						<div class="modal-dialog">
							
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Edit Unit</h4>
								</div>
								<div class="modal-body">
									<div class="edit-role-form-wrap" >
										<form class="edit-unit-form" id="data_form" action="<?=base_url()?>index/updateUnit" method="post">
											<input type='hidden' name='u_id' class='u_id' />
											<div class="row">
												<div class="col-md-6">
													<label>Unit: </label>
													<input type="text" name="unit" class="form-control un" value="" required="required"/>
												</div>
												<div class="col-md-6">
													<span class="form-field-title">No Runway on Dashboard</span>
													<span class="form-field">
														<p>
															
															<input id="toggle-trigger"  name="no_runway" type="checkbox" data-toggle="toggle">
														</p>
														
													</span>
												</div>
											</div>
											<br>
											<input type="submit" class="btn btn-success btn_submit2" value="Update" />
										</form>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
							
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<!-- END SAMPLE TABLE PORTLET-->
	</div>
</div>

<script>
$(".ed").click(function(e){
u_id = $(this).attr('data-id');
unitt = $(this).attr('data-unit');
norunway = $(this).attr('data-norunway');
$('.u_id').val(u_id);
$('.un').val(unitt);
if(norunway == 1){
$('#toggle-trigger').bootstrapToggle('on')
}else{
$('#toggle-trigger').bootstrapToggle('off')
}
});
</script>

<script>
$(".btn_submit").click(function(e){
e.preventDefault();
dataa = $("#form_data").serialize();
$.ajax({
url: "<?=base_url()?>index/insertUnit",
type: "POST",
data: dataa,
success: function(msg){
alert(msg);
}
});
return false;
});
</script>
<script>
$(".btn_submit2").click(function(e){
	e.preventDefault();
	dataa = $("#data_form").serialize();
$.ajax({
url: "<?=base_url()?>index/updateUnit",
type: "POST",
data: dataa,
success: function(msg){
alert('Successfully Unit Update');
location.reload();
}
});
return false;
});
</script>