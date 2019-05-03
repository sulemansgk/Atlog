<div id="wrapper">
	<div class="row-fluid page-head">
		<h2 class="page-title"><i class="aweso-icon-list-alt"></i> Event Details </h2>
		<div class="page-bar">
			<div class="btn-toolbar"> </div>
		</div>
	</div>
	<!-- // page head -->
	<form action="<?=base_url()?>elog/insertevents" class="log-add-form" method="post">
		<input type="hidden" name="subject" value="Equipment Release" />
		<input type="hidden" name="initial" value="<?=$this->userdetails["agentcode"]?>" />
		<input type="hidden" name="datetime" value="" />
		<input type="hidden" name="jobcard" value="<?=$log["id"]?>" />
		
		
		
		<div id="page-content" class="page-content">
			<section>
				
				<?		foreach($addevents as $datas){
				
				
				?>
				<div class="row-fluid margin-top20"><!-- // column -->
				<form class="emergency-edit-form" method="post" action="<?=base_url()?>emergency/updatelog">
					<div class="form-row">
						<span class="form-field-title">Job Cards</span>
						<span class="form-field">
							<input type="text" readonly="readonly" value="<?=$datas["id"]?>" />
						</span>
					</div>
					<div class="form-row">
						<span class="form-field-title">Date</span>
						<span class="form-field">
							
							<input type="text"  readonly="readonly" value="<?=$datas["datetime"]?>" />
						</span>
					</div>
					<div class="form-row">
						<span class="form-field-title">Time</span>
						<span class="form-field">
							
							<input type="text"  readonly="readonly"  value="<?=$datas["id"]?>" />
						</span>
					</div>
					<div class="form-row">
						<span class="form-field-title">Subject</span>
						<span class="form-field">
							<input type="text" name="subject" readonly="readonly"  value="<?=$datas["subject"]?>" />
						</span>
					</div>
					<br><br>
					<br><br><br>
					<h4>Details</h4>
					<br><br>
					<div class="form-row">
						<span class="form-field-title">Job Status</span>
						<span class="form-field">
							
							<input type="text" name="subject" readonly="readonly"  value="<?=$datas["JobStatus"]?>" />
						</span>
					</div>
					<div class="form-row">
						<span class="form-field-title">Stores Req #</span>
						<span class="form-field">
							<input type="text" name="subject" readonly="readonly"  value="<?=$datas["Stores|_Req"]?>" />
						</span>
					</div>
					<div class="form-row">
						<span class="form-field-title">Job X Ref</span>
						<span class="form-field">
							<input type="text" name="subject" readonly="readonly"  value="<?=$datas["JobStatus"]?>" />
						</span>
					</div>
					<div class="form-row">
						<span class="form-field-title">Total Man Hours</span>
						<span class="form-field">
							<input type="text" name="subject" readonly="readonly"  value="<?=$datas["Man_Hours_Total"]?>" />
						</span>
					</div>
					<div class="form-row">
						<span class="form-field-title">Date/Time Equipment Handed back to ATC </span>
						<span class="form-field">
							<input type="text" name="subject" readonly="readonly"  value="<?=$datas["Equipment_Handed_back_to_ATC"]?>" />
						</span>
					</div>
					<div class="form-row">
						<span class="form-field-title">Equipment Handed back to ATC By</span>
						<span class="form-field">
							<input type="text" name="subject" readonly="readonly"  value="<?=$datas["Equipment_Handed_back_to_ATC_by"]?>" />
						</span>
					</div>
					<br/><br/>
					<br/><br/><br/>
					
					<br/><br/>
					<br/><br/>
					<br/><br/>
					<h4>Date and Targets</h4>
					<br/><br/>
					<br/><br/>
					<div class="form-row">
						<span class="form-field-title">Date :</span>
						<span class="form-field">
							<input type="text" name="subject" readonly="readonly"  value="<?=$datas["Date"]?>" />
						</span>
					</div>
					<div class="form-row">
						<span class="form-field-title">Start Time :</span>
						<span class="form-field">
							<input type="text" name="subject" readonly="readonly"  value="<?=$datas["Start_Time"]?>" />
						</span>
					</div>
					
					<div class="form-row">
						<span class="form-field-title">Man Hours:</span>
						<span class="form-field">
							<input type="text" name="subject" readonly="readonly"  value="<?=$datas["Man_Hours"]?>" />
						</span>
					</div>
					<div class="form-row">
						<span class="form-field-title">On Behalf Of:</span>
						<span class="form-field">
							<input type="text" name="subject" readonly="readonly"  value="<?=$datas["On_Behalf_Of"]?>" />
						</span>
					</div>
					<div class="form-row">
						<span class="form-field-title">Details of Action Taken:</span>
						<span class="form-field">
							
							<textarea name="Details_of_Action_Taken" id="desc" style="width:270px;height:100px; DISABLED"><?echo $datas["Details_of_Action_Taken"];?></textarea>
						</span>
					</div>
					
					
					
					<div class="form-row">
						<span class="form-field-title">Staff Name:</span>
						<span class="form-field">
							
							<input type="text" name="subject" readonly="readonly"  value="<?=$datas["Staff_Name"]?>" />
						</span>
					</div>
					
					<div class="form-row">
						<span class="form-field-title">OJTI:</span>
						<span class="form-field">
							<input type="checkbox" name="OJTI"   />
						</span>
					</div>
					<div class="form-row">
						<span class="form-field-title">Traning Hr:</span>
						<span class="form-field">
							<input type="text" name="subject" readonly="readonly"  value="<?=$datas["Try_Hour"]?>" />
						</span>
					</div>
					<div class="form-row">
						<span class="form-field-title"></span>
						
						
					</div>
				</form>
			</div>
			<!-- // Example row -->
		</section>
	</div>
</div>
<?}?>