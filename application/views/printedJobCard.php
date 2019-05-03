<div class="row-fluid page-head">
	<h2 class="page-title"><i class="aweso-icon-list-alt"></i>PRINTED JOB CARD</h2>
	<div class="page-bar">
		<div class="btn-toolbar"> </div>
	</div>
</div>
<!-- // page head -->
<form action="<?=base_url()?>index/printedJobCard" class="log-add-form" method="post">
	<input type="hidden" name="subject" value="Equipment Release" />
	<input type="hidden" name="initial" value="<?=$this->userdetails["agentcode"]?>" />
	<input type="hidden" name="datetime" value="<?=date("Y-m-d H:i:s")?>" />
	<div id="page-content" class="page-content">
		<section>
			
			
			<div class="row-fluid margin-top20"><!-- // column -->
			<div class="form-row">
				<span class="form-field-title"><label style="font-size:15px;">JOB CARD NO.<label></span>
				<span class="form-field-title"><label style="font-size:15px; margin-left:-2em; font-weight:normal;">[TF_AUTO_GENERATED_NUMBER]<label></span>
				
			</div>
			
			<div class="row-fluid margin-top20"><!-- // column -->
			<div class="form-row">
				<span class="form-field-title"><label style="font-size:15px;">Date:<label></span>
				<span class="form-field-title"><label style="font-size:15px; margin-left:-2em; font-weight:normal;">[TF_DATE]<label></span>
				
			</div>
			
			<div class="row-fluid margin-top20"><!-- // column -->
			<div class="form-row">
				<span class="form-field-title"><label style="font-size:15px;">Time:<label></span>
				<span class="form-field-title"><label style="font-size:15px; margin-left:-2em; font-weight:normal;">[TF_TIME]<label></span>
				
			</div>
			
			<div class="row-fluid margin-top20"><!-- // column -->
			<div class="form-row">
				<span class="form-field-title"><label style="font-size:15px;">Change Control Ref#<label></span>
				<span class="form-field-title"><label style="font-size:15px; margin-left:-2em; font-weight:normal;">[TF_CCR#]<label></span>
				
			</div>
			
			<div class="row-fluid margin-top20"><!-- // column -->
			<div class="form-row">
				<span class="form-field-title"><label style="font-size:15px;">Task Description<label></span>
				<span class="form-field-title"><label style="font-size:15px; margin-left:-2em; font-weight:normal;">[TF_TD]<label></span>
				
			</div>
			
			
			<div class="row-fluid margin-top20"><!-- // column -->
			<div class="form-row">
				<span class="form-field-title"><label style="font-size:15px;"><i>Work Done</i><label></span>
				
				
			</div>
			
			<ul class="logs-listing mainview-listing" style="width: 100%;">
				<li class="list-head">
					<span class="datetime-col" style="width: 15%; ">Date</span>
					<span class="datetime-col" style="width: 15%;">Start Time</span>
					<span class="subject-col" style="width: 15%;">Man Hours</span>
					<span class="description-col" style="width: 15%;">Engineer</span>
					<span class="description-col" style="width: 15%;">Technician</span>
					<span class="description-col" style="width: 15%;">Details Of Action Taken</span>
				</li>
				
				<li class="list-row">
					<span style="width: 15%;" class="datetime-col">
					[TF_DATE]</span>
					<span style="width: 15%;" class="datetime-col">
					[TF-Start-Time]</span>
					<span style="width: 15%;" class="subject-col">
					[TF_Man-Hour]</span>
					<span style="width: 15%;" class="subject-col">
					[TF_Eng]</span>
					<span style="width: 15%;" class="subject-col">
					[TF_Tech]</span>
					<span style="width: 15%;" class="description-col">
					[TF_DAK]<br /><br /><br /><br /></span>
				</li>
				
			</ul>
			
			<ul class="logs-listing mainview-listing" style="width: 100%;">
				<br /><br /><li class="list-head">
					<span class="datetime-col" style="width: 15%; ">Date</span>
					<span class="datetime-col" style="width: 15%;">Start Time</span>
					<span class="subject-col" style="width: 15%;">Man Hours</span>
					<span class="description-col" style="width: 15%;">Engineer</span>
					<span class="description-col" style="width: 15%;">Technician</span>
					<span class="description-col" style="width: 15%;">Details Of Action Taken</span>
				</li>
				
				<li class="list-row">
					<span style="width: 15%;" class="datetime-col">
					[TF_DATE]</span>
					<span style="width: 15%;" class="datetime-col">
					[TF-Start-Time]</span>
					<span style="width: 15%;" class="subject-col">
					[TF_Man-Hour]</span>
					<span style="width: 15%;" class="subject-col">
					[TF_Eng]</span>
					<span style="width: 15%;" class="subject-col">
					[TF_Tech]</span>
					<span style="width: 15%;" class="description-col">
					[TF_DAK]<br /><br /><br /><br /></span>
				</li>
				
			</ul>
			
			<ul class="logs-listing mainview-listing" style="width: 100%;">
				<br /><br /><li class="list-head">
					<span class="datetime-col" style="width: 15%; ">Date</span>
					<span class="datetime-col" style="width: 15%;">Start Time</span>
					<span class="subject-col" style="width: 15%;">Man Hours</span>
					<span class="description-col" style="width: 15%;">Engineer</span>
					<span class="description-col" style="width: 15%;">Technician</span>
					<span class="description-col" style="width: 15%;">Details Of Action Taken</span>
				</li>
				
				<li class="list-row">
					<span style="width: 15%;" class="datetime-col">
					[TF_DATE]</span>
					<span style="width: 15%;" class="datetime-col">
					[TF-Start-Time]</span>
					<span style="width: 15%;" class="subject-col">
					[TF_Man-Hour]</span>
					<span style="width: 15%;" class="subject-col">
					[TF_Eng]</span>
					<span style="width: 15%;" class="subject-col">
					[TF_Tech]</span>
					<span style="width: 15%;" class="description-col">
					[TF_DAK]<br /><br /><br /><br /></span>
				</li>
				
			</ul>
			
			<div class="row-fluid margin-top20"><!-- // column -->
			<div class="form-row">
				<br /><span class="form-field-title"><label style="font-size:15px;"><i>Close Entry Date</i><label></span>
			</div>
			
			<div class="row-fluid margin-top20"><!-- // column -->
			<div class="form-row">
				<span class="form-field-title"><label style="font-size:15px;">Total Eng Hours<label></span>
				<span class="form-field-title"><label style="font-size:15px; margin-left:-2em; font-weight:normal;">[Total_EH]<label></span>
				
			</div>
			<div class="row-fluid margin-top20"><!-- // column -->
			<div class="form-row">
				<span class="form-field-title"><label style="font-size:15px;">Total Tech Hours<label></span>
				<span class="form-field-title"><label style="font-size:15px; margin-left:-2em; font-weight:normal;">[Total_TH]<label></span>
				
			</div>
			
			<div class="row-fluid margin-top20"><!-- // column -->
			<div class="form-row">
				<span class="form-field-title"><label style="font-size:15px;">Date and Time Equipment hand back, ATC confirm.<label></span>
				<span class="form-field-title"><label style="font-size:15px;">Date:<label></span>
				<span class="form-field-title"><label style="font-size:15px; margin-left:-80%; font-weight:normal;">[TF_Date]<label></span>
				<span class="form-field-title"><label style="font-size:15px; margin-left:-140%;">Time<label></span>
				<span class="form-field-title"><label style="font-size:15px; margin-top:-3.3em; margin-left:80%; font-weight:normal;">[TF_Time]<label></span>
				
			</div>
			
		</div>
		<div class="row-fluid margin-top20"><!-- // column -->
		<div class="form-row">
			<span class="form-field-title"><label style="font-size:15px;">Equipment handed back by Engineer
			<label></span>
			<span class="form-field-title"><label style="font-size:15px;">Engineer Name:
			<label></span>
			<span class="form-field-title"><label style="font-size:15px; margin-left:-30%; font-weight:normal;">[Total_TH]<label></span>
			
		</div>
		
		<div class="form-row">
			
			<span class="form-field">
				<button class="btn btn-blue">Job Closed</button>
			</span>
		</div>
		
		
		
		
		<!-- // Example row -->
	</section>
</div>
</form>