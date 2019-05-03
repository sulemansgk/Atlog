<?
$user_logged = $this->userdetails["agentunit"];
$user_unit = unserialize($user_logged);
?>
<!-- // page content -->
<div class="row">
	<div class="col-md-12" >
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>Users
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
					<form action="<?=base_url()?>index/users" method="post" class="accesslogs-search-form">
						<div class="col-md-6">
							<label for="agentrole">Role:</label>
							<select name="agentrole" class="form-control">
								<option value="">--Select--</option>
								<?
								foreach($userroles as $key=>$role){
								?>
								<option <?if($users_filter["agentrole"] == $role["id"]){?>selected="selected"<?}?> value="<?=$role["id"]?>"><?=$role["role"]?></option>
								<?
								}
								?>
							</select>
						</div>
						<div class="col-md-6">
							<label for="agentunit">Unit:</label>
							<select name="agentunit" class="form-control">
								<option value="">--Select--</option>
								<?
								foreach($units as $key=>$unit){
								?>
								<option <?if($users_filter["agentunit"] == $unit["unit_id"]){?>selected="selected"<?}?> value="<?=$unit["unit_id"]?>"><?=$unit["unit"]?></option>
								<?
								}
								?>
							</select>
						</div>
						<div class="col-md-6">
							<label for="company">Company:</label>
							<select name="company" class="form-control">
								<option value="">--Select--</option>
								<?
								foreach($companies as $key=>$company){
								?>
								<option <?if($users_filter["company"] == $company["id"]){?>selected="selected"<?}?> value="<?=$company["id"]?>"><?=$company["name"]?></option>
								<?
								}
								?>
							</select>
						</div>
						<div class="col-md-6">
							<label for="designation">Designation:</label>
							<select name="designation" class="form-control">
								<option value="">--Select--</option>
								<?
								foreach($designations as $key=>$designation){
								?>
								<option <?if($users_filter["designation"] == $designation["id"]){?>selected="selected"<?}?> value="<?=$designation["id"]?>"><?=$designation["designation"]?></option>
								<?
								}
								?>
							</select>
						</div>
						<div class="col-md-6">
							<label for="nationality">Nationality:</label>
							<select name="nationality" class="form-control">
								<option value="">--Select--</option>
								<?
								foreach($nationalities as $key=>$nationality){
								?>
								<option <?if($users_filter["nationality"] == $nationality["id"]){?>selected="selected"<?}?> value="<?=$nationality["id"]?>"><?=$nationality["nationality"]?></option>
								<?
								}
								?>
							</select>
						</div>
						<div class="col-md-6">
							<label for="agentname">Username:</label>
							<input name="agentname" placeholder="Enter username..." class="al-keyword form-control" type="text" value="<?=$users_filter["agentname"]?>"/>
						</div>
						<div class="col-md-6" style="padding-top:1%; padding-bottom:1%;">
							<div class="al-search-controls">
								<input type="submit" name="al-filter-reset" class="al-form-reset btn btn-danger" value="Cancel" onclick="clearAccessLogsForm();"/>
								<input type="submit" name="al-filter" class="btn btn-success" value="Filter"/>
							</div>
						</div>
					</form>
				</div>
				<form action="" method="post" >
					<span class="description-col" style="width: 10%!important;font-weight: bold!important;height: auto;margin: 0!important;padding: 0!important;margin-top: 1%!important;margin-left: 1%!important;">Order By: </span>
					<?
					$order = $this->session->userdata("order");
					if($order == "desc"){
					?>
					<span class="description-col">
						<input type="submit" class="btn btn-primary" name="order" value="Ascending" />
					</span>
					<?
					}else{
					?>
					<span class="description-col">
						<input type="submit" class="btn btn-primary" name="order" value="Descending" />
					</span>
					<?
					}
					?>
				</form>
				<li class="list-row pagination-links" style="list-style:none">
					<?=$pagination_links?>
				</li>
				<div class="table-scrollable">
					
					<table class="table table-striped table-bordered table-hover">
						<thead>
							
							<tr>
								<th scope="col" style="width:100px !important; " >
									Image
								</th>
								<th scope="col">
									Full Name
								</th>
								<th scope="col">
									Username
								</th>
								<th scope="col">
									Phone
								</th>
								<th scope="col">
									Email
								</th>
								<th scope="col">
									Mobile
								</th>
								<th scope="col">
									Role
								</th>
								<th scope="col">
									Unit(s)
								</th>
								
								<th scope="col" style="width: 20%">
									Actions
								</th>
							</tr>
						</thead>
						<tbody>
							<?
							foreach($users as $user){
							?>
							<tr  >
								<td  style="width:100px !important; ">
									<?
									if (!empty($user["image"])) { ?>
									<img src="<?=base_url()?>assets/user-profile-images/<?=$user["image"]?>" style="width:100px !important;"/>
									<? } else {	?>
									<img src="<?=base_url()?>assets/global/img/user-circle.png" style="width:100px !important;"/>
									<? } ?>
								</td>
								<td>
									<?=$user["firstname"]." ".$user["lastname"]?>
								</td>
								<td>
									<?=$user["agentname"]?>
								</td>
								
								<td>
									<?=$user["phone1"]?>
								</td>
								<td>
									<?=$user["email"]?>
								</td>
								<td>
									<?=$user["mobile"]?>
								</td>
								<td>
									<?=$user["role"]?>
								</td>
								<td>
									<?
									$a = $user['agentunit'];
									
									$user_unit = unserialize($a);
									
									foreach($user_unit as $unit){
									$unit_name = $this->db->get_where('units', array('unit_id' => $unit))->row(); ?>
									<?=$unit_name->unit.','?>
									<? } ?>
								</td>
								<td>
									<a href="<?=base_url()?>index/userprofile/<?=$user["agentcode"]?>" class="btn btn-sm btn-primary" >Edit Profile</a>
									<a href="javascript:void(0);" class="btn <?if($user["agentactive"] == 0){print("btn-success btn-sm");}else{print("btn-danger btn-sm");}?>" onclick="activateUser(<?=$user["agentcode"]?>,this);">
										<?if($user["agentactive"] == 0){?>Activate<?}else{?>Deactivate<?}?>
									</a>
								</td>
								
							</tr>
							
							<? } ?>
							
							
						</tbody>
						
					</table>
				</div>
				<div class="row">
					<div class="col-md-7 col-sm-12">
						<div class="dataTables_paginate paging_bootstrap_full_number" id="sample_1_paginate">
							<ul class="pagination" style="visibility: visible;">
								
								<li class="list-row pagination-links">
									<?=$pagination_links?>
								</li>
								
							</ul>
						</div></div></div>
					</div>
				</div>
				<!-- END SAMPLE TABLE PORTLET-->
			</div>
		</div>
		<style>
		.dealers-list li {
		float: left;
		width: 100%;
		margin: 0;
		}
		.dealers-list li.list-row:hover {
		background: lightblue;
		cursor: pointer;
		}
		.dealers-list li.list-row:nth-child(even) {
		background: rgb(244, 252, 255);
		}
		.dealers-list li.list-row:nth-child(odd) {
		background: white;
		}
		.dealers-list li span {
		float: left;
		width: auto;
		}
		.dealers-list li span.dealer-img {
		background: lightgray;
		width: 10%;
		height: 105px;
		margin-left: 0.5%;
		margin-bottom: 0.5%;
		position: inherit;
		}
		.dealers-list li span.dealer-img img {
		float: left;
		width: 100%;
		height: 100%;
		border-radius: 5px;
		}
		.dealers-list li.list-row span.name, .dealers-list li.list-row span.state_province, .dealers-list li.list-row span.city_locality, .dealers-list li.list-row span.email, .dealers-list li.list-row span.cell, .dealers-list li.list-row span.email, .dealers-list li.list-row span.country {
		display: -ms-flexbox;
		-ms-flex-pack: center;
		-ms-flex-align: center;
		display: -moz-box;
		-moz-box-pack: center;
		-moz-box-align: center;
		display: -webkit-box;
		-webkit-box-pack: center;
		-webkit-box-align: center;
		display: box;
		box-pack: center;
		box-align: center;
		height: 65px;
		}
		.dealers-list li span.name {
		float: left;
		width: 20%;
		padding: 5px;
		text-align: center;
		font-family: cursive;
		overflow: hidden;
		text-overflow: ellipsis;
		}
		.dealers-list li span.state_province {
		font-family: cursive;
		text-align: center;
		overflow: hidden;
		padding: 5px;
		width: 10%;
		}
		.dealers-list li span.city_locality {
		font-family: cursive;
		text-align: center;
		overflow: hidden;
		padding: 5px;
		width: 10%;
		}
		.dealers-list li span.dealer-list-controls {
		float: right;
		width: 85%;
		margin-bottom: 0.2%;
		text-align: right;
		margin-right: 0.5%;
		}
		.dealers-list li.list-head {
		background: gray;
		color: white;
		font-weight: bold;
		font-size: 110%;
		padding-bottom: 0.5%;
		padding-top: 0.5%;
		}
		.dealers-list li.list-head span.dealer-img {
		height: 0px;
		}
		.dealers-list li span.cell {
		font-family: cursive;
		text-align: center;
		overflow: hidden;
		padding: 5px;
		width: 10%;
		}
		.dealers-list li span.email {
		font-family: cursive;
		text-align: center;
		overflow: hidden;
		padding: 5px;
		width: 20%;
		}
		.dealers-list li span.country {
		font-family: cursive;
		text-align: center;
		overflow: hidden;
		padding: 5px;
		width: 10%;
		}
		</style>