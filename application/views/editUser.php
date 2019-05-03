<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>Edit User
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
				<form class="form-tied margin-00" method="post" action="<?=base_url()?>index/updateUser" enctype="multipart/form-data" name="login_form">
					
					
					<div class="row pform" style="padding-top:1%;"  >
						<div class="col-md-6">
							<div class="form-group">
								<input type="hidden" name="agentcode" value="<?=$user_details["agentcode"]?>"/>
								<span>First Name:</span>
								<input id="idPassw" class="input-block-level form-control" type="text"  value="<?=$user_details["firstname"]?>"name="firstname" required="required"/>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<span>Last Name</span>
								<input id="idPassw" class="input-block-level form-control" type="text"  value="<?=$user_details["lastname"]?>"name="lastname" required="required"/>
							</div>
						</div>
					</div>
					
					
					
					
					<div class="row pform" >
						<div class="col-md-6">
							
							<div class="form-group">
								<span>Username</span>
								<input id="idPassw" class="input-block-level form-control" type="text"  readonly="readonly" value="<?=$user_details["agentname"]?>" required="required"/>
								
							</div>
						</div>
						
						
						<div class="col-md-6">
							<div class="form-group" >
								<span>Image</span>
								<input type="hidden" name="old_image" value="<?=$user_details["image"]?>"  />
								<input id="image" class="input-block-level " type="file" name="image"/>
							</div>
						</div>
					</div>
					
					
					
					
					<div class="row pform" >
						<div class="col-md-6">
							
							<div class="form-group">
								
								<span>Date Of Birth</span>
								<input class="input-block-level date-picker form-control" type="text" name="dob"  value="<?=$user_details["dob"]?>"required="required"/>
							</div>
						</div>
						
						
						<div class="col-md-6">
							<div class="form-group" >
								<span>Nationality</span>
								<select name="nationality" class="form-control">
									<option value="">--Select--</option>
									<?
									foreach($nationalities as $key=>$nationality){
									?>
									<option value="<?=$nationality["id"]?>" <? if($nationality["id"] == $user_details["nationality"]){?>selected="selected"<?}?>>
										<?=$nationality["nationality"]?>
									</option>
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
								<span>Designation</span>
								<select name="designation" class="form-control">
									<option value="">--Select--</option>
									<?
									foreach($designations as $key=>$designation){
									?>
									<option value="<?=$designation["id"]?>" <? if($designation["id"] == $user_details["designation"]){?>selected="selected"<?}?>><?=$designation["designation"]?></option>
									<?
									}
									?>
								</select>
							</div>
							
						</div>
						<div class="col-md-6">
							<div class="form-group" >
								<span>Company</span>
								<select name="company" class="form-control">
									<option value="">--Select--</option>
									<?
									foreach($companies as $key=>$company){
									?>
									<option value="<?=$company["id"]?>" <? if($company["id"] == $user_details["company"]){?>selected="selected"<?}?>><?=$company["name"]?></option>
									<?
									}
									?>
								</select>
							</div>
						</div>
					</div>
					
					<div class="row pform" >
						<div class="col-md-6">
							<div class="form-group" >
								<span>Phone 1</span>
								<input id="idPassw" class="input-block-level form-control" type="text" value="<?=$user_details["phone1"]?>" name="phone1" required="required"/>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group" >
								<span>Phone 2</span>
								<input id="idPassw" class="input-block-level form-control" type="text" value="<?=$user_details["phone2"]?>" name="phone2">
							</div>
						</div>
					</div>
					
					
					<div class="row pform" >
						<div class="col-md-6">
							<div class="form-group" >
								<span>Mobile</span>
								<input id="idPassw" class="input-block-level form-control" type="text" value="<?=$user_details["mobile"]?>" name="mobile" required="required"/>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group" >
								<span>Email</span>
								<input id="idPassw" class="input-block-level form-control" type="text" value="<?=$user_details["email"]?>" name="email" required="required"/>
							</div>
						</div>
					</div>
					
					<div class="row pform" >
						<div class="col-md-6">
							<div class="form-group" >
								<span>Address Line 1</span>
								<input id="idPassw" class="input-block-level form-control" type="text" value="<?=$user_details["address1"]?>" name="address1" required="required"/>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group" >
								<span>Address Line 2</span>
								<input id="idPassw" class="input-block-level form-control" type="text" value="<?=$user_details["address2"]?>" name="address2" />
							</div>
						</div>
					</div>
					<div class="row pform" >
						<div class="col-md-6">
							<div class="form-group" >
								<span>User Role</span>
								<select
									<?if($this->userdetails["agentrole"] == 1){?>name="agentrole"<?}else{?>disabled="disabled"<?}?>
									required="required" class="form-control">
									<option value="">--Select--</option>
									<?
									foreach($userroles as $key=>$role){
									?>
									<option value="<?=$role["id"]?>" <? if($role["id"] == $user_details["agentrole"]){?>selected="selected"<?}?>><?=$role["role"]?></option>
									<?
									}
									?>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group" >
								<span>Password</span>
								<input id="idPassw" class="input-block-level form-control" type="password" value="<?=$user_details["agentpassword"]?>" name="agentpassword" required="required"/>
								
							</div>
						</div>
					</div>
					<div class="row pform" style="padding-bottom:2%; ">
						<div class="col-md-6">
							<div class="form-group" >
								<span>Unit</span>
								<select
									<?if($this->userdetails["agentrole"] == 1){?>name="agentunit[]" <?}else{?>disabled="disabled"<?}?>
									required="required" multiple="multiple" class="form-control">
									
									<?
									$agentunits = unserialize($user_details["agentunit"]);
									
									foreach($units as $key=>$unit){
									?>
									<option <? if(in_array( $unit["unit_id"], $agentunits)){?>selected="selected"<?}?> value="<?=$unit["unit_id"]?>"><?=$unit["unit"]?></option>
									<?
									}
									?>
								</select>
							</div>
						</div>
						
					</div>
					<div class="form-actions left">
						
						<div class="col-md-5">
							
							
							
							<div class=" form-actions" >
								
								<button type="submit" class="btn btn-success" style="margin-top:5%">PROCEED</button>
								
								
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