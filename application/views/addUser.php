<!-- // page head -->
<?if($this->uri->segment(3) == "registerSuccess"){?>
<div class="success-msg" style="position: absolute;top: 4%;left: 50%;z-index:1;">
	<img src="<?=base_url()?>assets/img/success.png" />
	<span class="message">Successfully Registered.</span>
</div>
<?
}else if($this->uri->segment(3) == "registerError"){
?>
<div class="error-msg" style="position: absolute;top: 4%;left: 50%;z-index:1;">
	<img src="<?=base_url()?>assets/img/error.png">
	<span class="message">Some error occurred please try again.</span>
</div>
<?
}else if($this->uri->segment(3) == "userExists"){
?>
<div class="error-msg" style="position: absolute;top: 4%;left: 50%;z-index:1;">
	<img src="<?=base_url()?>assets/img/error.png">
	<span class="message">User already exists.</span>
</div>
<?
}
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>New User Registration
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
				<form class="form-tied margin-00" method="post" action="<?=base_url()?>index/registerUser" enctype="multipart/form-data" name="login_form">
					
					
					<div class="row pform" style="padding-top:1%;"  >
						<div class="col-md-6">
							<div class="form-group">
								<span>First Name:</span>
								<input id="idPassw" class="input-block-level form-control" type="text" name="firstname" required="required"/>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<span>Last Name</span>
								<input id="idPassw" class="input-block-level form-control" type="text" name="lastname" required="required"/>
								
							</div>
						</div>
					</div>
					
					
					
					
					<div class="row pform" >
						<div class="col-md-6">
							
							<div class="form-group">
								<span>Username</span>
								<input id="idPassw" class="input-block-level form-control" type="text" name="agentname" required="required"/>
								
							</div>
						</div>
						
						
						<div class="col-md-6">
							<div class="form-group" >
								<span>Image</span>
								<input id="image" class="input-block-level " type="file" name="image" required="required"/>
							</div>
						</div>
					</div>
					
					
					
					
					<div class="row pform" >
						<div class="col-md-6">
							
							<div class="form-group">
								<span>Date Of Birth</span>
								<input class="input-block-level form-control date-picker" type="text" name="dob" required="required"/>
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
									<option value="<?=$nationality["id"]?>"><?=$nationality["nationality"]?></option>
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
									<option value="<?=$designation["id"]?>"><?=$designation["designation"]?></option>
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
									<option value="<?=$company["id"]?>"><?=$company["name"]?></option>
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
								<input id="idPassw" class="input-block-level form-control" type="text" name="phone1" required="required"/>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group" >
								<span>Phone 2</span>
								<input id="idPassw" class="input-block-level form-control" type="text" name="phone2">
							</div>
						</div>
					</div>
					
					
					<div class="row pform" >
						<div class="col-md-6">
							<div class="form-group" >
								<span>Mobile</span>
								<input id="idPassw" class="input-block-level form-control" type="text" name="mobile" required="required"/>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group" >
								<span>Email</span>
								<input id="idPassw" class="input-block-level form-control" type="text" name="email" required="required"/>
							</div>
						</div>
					</div>
					
					<div class="row pform" >
						<div class="col-md-6">
							<div class="form-group" >
								<span>Address Line 1</span>
								<input id="idPassw" class="input-block-level form-control" type="text" name="address1" required="required"/>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group" >
								<span>Address Line 2</span>
								<input id="idPassw" class="input-block-level form-control" type="text" name="address2" />
							</div>
						</div>
					</div>
					<div class="row pform" >
						<div class="col-md-6">
							<div class="form-group" >
								<span>User Role</span>
								<select name="agentrole" required="required" class="form-control">
									<option value="">--Select--</option>
									<?
									foreach($userroles as $key=>$role){
									?>
									<option value="<?=$role["id"]?>"><?=$role["role"]?></option>
									<?
									}
									?>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group" >
								<span>Password</span>
								<input id="idPassw" class="input-block-level form-control" type="password" name="agentpassword" required="required"/>
								
							</div>
						</div>
					</div>
					<div class="row pform" style="padding-bottom:2%; ">
						<div class="col-md-6">
							<div class="form-group" >
								<span>Unit</span>
								<select name="agentunit[]" class="form-control" required="required" multiple="multiple">
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
							
							
							
							<div class=" form-actions" >
								
								
								<button type="submit" class="btn btn-success  " style="margin-top:5%">REGISTER TO ADIMS</button>
								
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