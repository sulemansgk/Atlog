<div class="row-fluid page-head">
	<img src="<?=base_url()?>assets/img/gal.png" style="float:left" />
	<h2 class="page-title"><i class="aweso-icon-list-alt"></i> Fault Reportingss</h2>
	<div class="page-bar">
		<div class="btn-toolbar"> </div>
	</div>
</div>
<!-- // page head -->
<form action="<?=base_url()?>elog/insertNewJobx" class="log-add-form" method="post">
	<input type="hidden"  value="Fault Reporting" />
	<input type="hidden"  value="<?=$this->userdetails["agentcode"]?>" />
	<input type="hidden" value="<?=date("Y-m-d H:i:s")?>" />
	<div id="page-content" class="page-content">
		<section >
			<h2>Details Reported</h2>
			<div class="row-fluid margin-top20"><!-- // column -->
			<div class="form-row" style="
				width: 50%;
				">
				<span class="form-field-title">Initial :</span>
				<span class="form-field">
					<input type="text" name="initial" readonly="readonly" value="<?=$this->userdetails["agentname"]?>" />
				</span>
			</div>
			<div class="form-row" style="
				width: 50%;
				">
				<span class="form-field-title">Date: *</span>
				<span class="form-field">
					<input type="text" name = "date" class="date-field" value="<?=date("d/m/Y")?>" required="required" />
				</span>
			</div>
			<div class="form-row" style="
				width: 50%;
				">
				<span class="form-field-title">Time: *</span>
				<span class="form-field">
					<input type="text" class="time-field" oninput="maxLengthCheck(this);" value="<?=date("Hi")?>" />
					<input type="hidden" name ="time" class="datetime-field"  oninput="maxLengthCheck(this);"value="<?=date("Y-m-d H:i:s")?>" required="required" />
				</span>
			</div>
			
			<div class="form-row" style="
				width: 50%;
				">
				<span class="form-field-title">Position: </span>
				<span class="form-field">
					<select name ="position" >
						<option value="">--Select User--</option>
						<?
						foreach($positions as $key=>$position){
						?>
						<option value="<?=$position["name"]?>"><?=$position["name"]?></option>
						<?
						}
						?>
					</select>
				</span>
			</div>
			<div class="form-row" style="
				width: 50%;
				">
				<span class="form-field-title">Console: </span>
				<span class="form-field">
					<select name = "console">
						<option value="">--Select User--</option>
						<?
						foreach($consoleNumbers as $key=>$number){
						?>
						<option value="<?=$number["name"]?>"><?=$number["name"]?></option>
						<?
						}
						?>
					</select>
				</span>
			</div>
			<div class="form-row" style="
				width: 50%;
				">
				<span class="form-field-title">Equipment: </span>
				<span class="form-field">
					<select name = "equipment">
						<option value="">--Select User--</option>
						<?
						foreach($equipments as $key=>$equipment){
						?>
						<option value="<?=$equipment["name"]?>"><?=$equipment["name"]?></option>
						<?
						}
						?>
					</select>
				</span>
			</div>
			<div class="form-row" style="
				width: 50%;
				">
				<span class="form-field-title">Error Text: *</span>
				<span class="form-field">
					<input type="text" name = "error_text" value="" required="required" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Description: *</span>
				<span class="form-field" style="width: 70%;">
					<textarea id="desc" name = "Description" style="width:290px;height:100px;"></textarea>
				</span>
			</div>
			
		</div>
		<!-- // Example row -->
	</section>
	
	
	
	
	<section>
		<h2>Job Details</h2>
		<div class="row-fluid margin-top20"><!-- // column -->
		<div class="form-row"style="
			width: 50%;
			">
			<span class="form-field-title">User Name :</span>
			<span class="form-field">
				<input type="text" name = "User" readonly="readonly" value="<?=$this->userdetails["agentname"]?>" />
			</span>
		</div>
		
		
		
		<div class="form-row" style="
			width: 50%;
			">
			<span class="form-field-title">Job Card (FRN): *</span>
			<span class="form-field">
				<input type="text" name = "jobCard" value="" />
			</span>
		</div>
		
		<div class="form-row" style="
			width: 50%;
			">
			<span class="form-field-title">Customer: </span>
			<span class="form-field">
				<select name = "Customer" >
					<option value="">--Select User--</option>
					<?
					foreach($positions as $key=>$position){
					?>
					<option value="<?=$position["name"]?>"><?=$position["name"]?></option>
					<?
					}
					?>
				</select>
			</span>
		</div>
		
		
		<div class="form-row" style="
			width: 50%;
			">
			<span class="form-field-title">Contact: *</span>
			<span class="form-field">
				<input type="text" name = "Contact" class="time-field" value="" />
			</span>
		</div>
		
		
		
		<div class="form-row" style="
			width: 50%;
			">
			<span class="form-field-title">Description: *</span>
			<span class="form-field" style="width: 70%;">
				<textarea  id="desc" name = "Des_job" style="width:290px;height:100px;"></textarea>
			</span>
		</div>
		
		
		
		
		<div class="form-row" style="
			width: 50%;
			">
			<span class="form-field-title">Job Category: </span>
			<span class="form-field">
				<select name = "job_cat" >
					<option value="">--Select User--</option>
					<?
					foreach($positions as $key=>$position){
					?>
					<option value="<?=$position["name"]?>"><?=$position["name"]?></option>
					<?
					}
					?>
				</select>
			</span>
		</div>
		<div class="form-row" style="
			width: 50%;
			">
			<span class="form-field-title">Callibration Item: </span>
			<span class="form-field">
				<select name = "callibration">
					<option value="">--Select User--</option>
					<?
					foreach($consoleNumbers as $key=>$number){
					?>
					<option value="<?=$number["name"]?>"><?=$number["name"]?></option>
					<?
					}
					?>
				</select>
			</span>
		</div>
		<div class="form-row" style="
			width: 50%;
			">
			<span class="form-field-title">System: </span>
			<span class="form-field">
				<select name = "system" >
					<option value="">--Select User--</option>
					<?
					foreach($equipments as $key=>$equipment){
					?>
					<option value="<?=$equipment["name"]?>"><?=$equipment["name"]?></option>
					<?
					}
					?>
				</select>
			</span>
		</div>
		
		
		<div class="form-row" style="
			width: 50%;
			">
			<span class="form-field-title">Freq: </span>
			<span class="form-field">
				<select name = "freq"  >
					<option value="">--Select User--</option>
					<?
					foreach($equipments as $key=>$equipment){
					?>
					<option value="<?=$equipment["name"]?>"><?=$equipment["name"]?></option>
					<?
					}
					?>
				</select>
			</span>
		</div>
		
		<div class="form-row" style="
			width: 50%;
			">
			<span class="form-field-title">LRU: </span>
			<span class="form-field">
				<select name = "freq">
					<option value="">--Select User--</option>
					<?
					foreach($equipments as $key=>$equipment){
					?>
					<option value="<?=$equipment["name"]?>"><?=$equipment["name"]?></option>
					<?
					}
					?>
				</select>
			</span>
		</div>
		<div class="form-row" style="
			width: 50%;
			">
			<span class="form-field-title">Ext Ref :</span>
			<span class="form-field">
				<input type="text" name= "ExtRef" />
			</span>
		</div>
		<div class="form-row" style="
			width: 50%;
			">
			<span class="form-field-title">Initiate CCF: </span>
			<span class="form-field">
				<select  name ="Initiate_CCF">
					<option value="">--Select User--</option>
					
					<option value="1">Yes</option>
					<option value="0">No</option>
					
				</select>
			</span>
		</div>
		<div class="form-row" style="
			width: 50%;
			">
			<span class="form-field-title">Equipment Manual :</span>
			<span class="form-field">
				<input type="file"  name ="Equipment_Manual" />
			</span>
		</div>
		<div class="form-row" style="
			width: 50%;
			">
			<span class="form-field-title">ROSI Filed: </span>
			<span class="form-field">
				<select >
					<option value="">--Select User--</option>
					
					<option value="1">Yes</option>
					<option value="0">No</option>
					
				</select>
			</span>
		</div>
		<div class="form-row" style="
			width: 50%;
			">
			<span class="form-field-title">ROSI Filed:</span>
			<span class="form-field">
				<input type="text"  name = "ROSI_Filed" />
			</span>
		</div>
	</div>
	<!-- // Example row -->
</section>
<div class="form-row">
	<span class="form-field-title"></span>
	<span class="form-field">
		<input type="submit" class="btn" value="Submit" />
		<input type="reset" class="btn btn-red" value="Cancel" />
	</span>
</div>

</div>
</form>