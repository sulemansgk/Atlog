<!-- // page content -->
<div class="row">
	<div class="col-md-12" >
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>User Roles
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
				<a href="javascript:void(0);" class="btn btn-primary" onclick="addNewRole();" data-toggle="modal" data-target="#myModal1">Add New Role</a>
				<div class="table-scrollable">
					
					<table class="table table-striped table-bordered table-hover">
						<thead>
							
							<tr>
								
								<th scope="col">
									S.No
								</th>
								<th scope="col">
									Role
								</th>
								<th scope="col">
									Actions
								</th>
								
							</tr>
						</thead>
						<tbody>
							<?
							if(!empty($agentroles)){
							$i = 0;
							foreach($agentroles as $role){
							if($role["id"] != 1){
							$i++;
							?>
							<tr  >
								<td  >
									<?=$i?>
								</td>
								<td>
									<?=ucfirst($role["role"])?>
								</td>
								<td>
									<a href="<?=base_url()?>index/permissions/#<?=str_replace(" ","-",$role["role"])?>" class="btn btn-success">Edit Permissions</a>
									<a href="javascript:void(0);" data-id='<?=$role["id"]?>' data-name='<?=$role["role"]?>' class="btn btn-success dd" data-toggle="modal" data-target="#myModal2">Edit Role</a>
									<a href="javascript:void(0);" class="btn <?if($role["active"] == 0){print("btn-success");}else{print("btn-danger");}?>" onclick="activateRole(<?=$role["id"]?>,this);">
										<?if($role["active"] == 0){?>Activate<?}else{?>Deactivate<?}?>
									</a>
									<a href="javascript:void(0);" class="btn btn-danger" onclick="deleteRolee(<?=$role["id"]?>,this);">Delete</a>
								</td>
								
								
								
							</tr>
							<?
							}
							}
							}else{
							?>
							<li class="list-row">There are no user roles defined.</li>
							<?
							}
							?>
							
						</tbody>
						
					</table>
				</div>
				<div class="add-new-role-form-wrap" style="display:none;">
					
				</div>
				<div class="edit-role-form-wrap" style="display:none;">
					
				</div>
				<div class="container">
					
					<!-- Modal -->
					<div class="modal fade" id="myModal1" role="dialog">
						<div class="modal-dialog">
							
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Add Role</h4>
								</div>
								<div class="modal-body">
									<div class="add-new-role-form-wrap" >
										<form class="add-new-role-form" id="form_data" action="<?=base_url()?>index/insertRole" method="post">
											<label>Role: </label>
											<input type="text" name="role" class="form-control" placeholder="Role..." required="required"/><br>
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
									<h4 class="modal-title">Edit User Role</h4>
								</div>
								<div class="modal-body">
									<div class="edit-role-form-wrap" >
										<form class="edit-role-form" id="data_form" action="<?=base_url()?>index/updateRole" method="post">
											<label>Role: </label>
											<input type="text" name="role" class="form-control rolee" required="required"/><br>
											<input type="hidden" name="id" class="form-control roleeid" required="required"/><br>
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
$(".btn_submit").click(function(e){
e.preventDefault();

dataa = $("#form_data").serialize();

$.ajax({
url: "<?=base_url()?>index/insertRole",
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
url: "<?=base_url()?>index/updateRole",
type: "POST",
data: dataa,

success: function(msg){
alert(msg);



}
});
return false;
});
$(".dd").click(function(){
data_id = $(this).attr('data-id');
data_name = $(this).attr('data-name');
$('.rolee').val(data_name);
$('.roleeid').val(data_id);

});
</script>