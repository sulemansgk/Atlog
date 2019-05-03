<div class="row-fluid page-head">
	<h2 class="page-title"><i class="aweso-icon-list-alt"></i> Add Event</h2>
	<div class="page-bar">
		<div class="btn-toolbar"> </div>
	</div>
</div>
<!-- // page head -->
<form action="<?=base_url()?>elog/addevent" class="log-add-form" method="post">
	<input type="hidden" name="subject" value="Equipment Release" />
	<input type="hidden" name="initial" value="<?=$this->userdetails["agentcode"]?>" />
	<input type="hidden" name="datetime" value="<?=date("Y-m-d H:i:s")?>" />
	
	
	
	
	<div id="page-content" class="page-content">
		<section>
			
			
			<h4>Details</h4>
			<div class="row-fluid margin-top20"><!-- // column -->
			<form class="emergency-edit-form" method="post" action="<?=base_url()?>emergency/updatelog">
				<div class="form-row">
					<span class="form-field-title">Job Cards</span>
					<span class="form-field">
						<input type="text" readonly="readonly" value="" />
					</span>
				</div>
				<div class="form-row">
					<span class="form-field-title">Date</span>
					<span class="form-field">
						
						<input type="text"  readonly="readonly" value="" />
					</span>
				</div>
				<div class="form-row">
					<span class="form-field-title">Time</span>
					<span class="form-field">
						
						<input type="text"  readonly="readonly"  value="" />
					</span>
				</div>
				<div class="form-row">
					<span class="form-field-title">Subject</span>
					<span class="form-field">
						<input type="text" name="subject" readonly="readonly"  value="<?=$log["subject"]?>" />
					</span>
				</div>
			</form>
		</div>
		<!-- // Example row -->
	</section>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div id="page-content" class="page-content">
	<section>
		<div class="row-fluid margin-top20"><!-- // column -->
		
		<br /><h4>Details</h4>
		<div class="form-row">
			
			<span class="form-field-title">Job Status </span>
			<span class="form-field">
				<input type="text" name="console_number" disabled="disabled" value="" required="required" />
				
			</span>
			<span class="form-field-title">Stores Req #
				
				<span style="margin-left:9.5em; margin-top:-2em;" > <input type="text" name="console_number" disabled="disabled" value="" required="required" />
				
			</span></span>
		</div>
		<div class="form-row">
			<span class="form-field-title">Job X Ref </span>
			<span class="form-field">
				<input type="text" name="console_number" disabled="disabled" value="" required="required" />
				
			</span>
			<span class="form-field-title">Man Hours Total: </span>
			<span class="form-field">
				<span style="margin-left:9.5em; margin-top:-2em;" ><input type="text" name="console_number" disabled="disabled" value="" required="required" /></span>
				
				
			</span>
		</div>
		
		<div class="form-row">
			
		</div>
		<div class="form-row">
			<span class="form-field-title">Date/Time Equipment Handed back to ATC :</span>
			<span class="form-field">
				<input type="text" name="console_number" disabled="disabled" value="" required="required" />
			</span>
			<span class="form-field-title">Equipment Handed<br /> back to ATC by :</span>
			
			<span class="form-field">
				<span style="margin-left:52em; margin-top:-14%;"><input type="text" name="console_number" disabled="disabled" value="" required="required" /></span>
				
			</span>
		</div>
		<div class="form-row">
			
		</div>
		<h4>Date and Targets</h4>
		
		<div class="form-row">
			<span class="form-field-title">Date :</span>
			<span class="form-field">
				
				
				<input type="text" name="console_number" disabled="disabled" value="" required="required" />
				
			</span>
			<span class="form-field-title">Start Time :</span>
			<span class="form-field">
				
				<input style="margin-left:7em; margin-top:-2em;" type="text" class="time-field" value="<?=date("Hi")?>" oninput="maxLengthCheck(this);" />
				<input type="hidden" class="datetime-field" name="form_datetime"  value="<?=date("Y-m-d H:i:s")?>" required="required" />
			</span>
		</div>
		<div class="form-row">
			
		</div>
		<div class="form-row">
			<span class="form-field-title">Man Hours :</span>
			<span class="form-field">
				<input type="text" name="console_number" disabled="disabled" value="" required="required" />
				
			</span>
			<span class="form-field-title">On Behalf Of: *</span>
			<span class="form-field">
				<span style="margin-left:9.5em; margin-top:-2em;" class="form-field-title"></span>
				
				<select style="margin-left:8em; margin-top:-20%;" name="onbehalf" >
					<option value="">Select</option>
					
					
					<option value="">e</option>
					<option value="">e</option>
					.<option value="">e</option>
					<option value="">e</option>
				</select>
			</span>
		</div>
		
		<div class="form-row">
			<span class="form-field-title">Details of Action Taken: </span>
			<span class="form-field" style="">
				<textarea name="console_number" id="desc" style="width:270px;height:100px;"></textarea>
				
			</span>
			<span style="margin-left:55%; margin-top:-2em;" class="form-field-title">Staff Name: </span>
			<span class="form-field">
				
				<span style="margin-left:209%; margin-top:-2em;" class="form-field-title">
					
					<select style="margin-left: 2em; margin-top:-20%;width: 363%;" name="onbehalf" >
						<option value="">Select</option>
						
						
						<option value="">e</option>
						<option value="">e</option>
						.<option value="">e</option>
						<option value="">e</option>
					</select>
					
				</span>
				
			</span>
			
			
		</div>
		
		<div class="form-row">
			<span class="form-field-title">OJTI: </span>
			<span class="form-field">
				
				<span class="form-field-title"><input type="checkbox" name="console_number" disabled="disabled" value="" required="required" /> </span>
			</span>
			
			<span class="form-field-title">Training Hr: </span>
			<span class="form-field">
				
				<span style="margin-left:209%; margin-top:-2em;" ><input type="text" name="console_number" disabled="disabled" value="" required="required" /> </span>
				
				
				
			</span>
		</div>
		<div class="form-row">
			<span class="form-field-title"></span>
			
			
			<span class="form-field">
				<input type="reset" class="btn btn-blue" value="Reset" />
				<input type="submit" class="btn" value="Submit" />
				
			</span>
		</div>
	</div>
	<!-- // Example row -->
</section>
</div>
</form>