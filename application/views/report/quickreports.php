<div class="row-fluid page-head">
	<img src="<?=base_url()?>assets/img/gal.png" style="float:left" />
	<h2 class="page-title"><i class="fontello-icon-monitor"></i>Qiuck Reports</h2>
	<div class="page-bar">
		<div class="btn-toolbar"> </div>
	</div>
</div>
<!-- // page head -->
<form action="<?=base_url()?>report/quickreport" class="report-form" method="post">
	<div id="page-content" class="page-content">
		<section>
			<div class="row-fluid margin-top20"><!-- // column -->
			<div class="form-row">
				<span class="form-field-title">From</span>
				<span class="form-field">
					<input type="text" name="from" class="reportdatefield" value="<?=$from?>" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">To</span>
				<span class="form-field">
					<input type="text" name="to" class="reportdatefield2" value="<?=$to?>" />
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
	</section>
</div>
</form>
<div class="reports-actions">
<a href="export" style="
	display: block;
	width: 200px;
	height: 30px;
	background-color: #006bb7;
	border-radius: 8px;
	font-size: 16px;
	color: #fff;
	padding: -3px;
	text-decoration: none;
	text-align: justify;
	text-align: center;
">Generate excel file</a>
</div>
<div class="report-container">
<div class="general-report">
	<div class="report-heading">General Report</div>
	<ul class="gr-list">
		<li class="gr-head">
			<span class="gr-initial" style="width: 6%;">Initial</span>
			<span class="gr-time">Time</span>
			<span class="gr-Management" style="width: 15%;">Management</span>
			<span class="gr-actions" style="width: 11%;">Actions</span>
			<span class="gr-subject" style="width: 16%;">Subject</span>
			<span class="gr-subject">Frn Status</span>
			<span class="gr-action col-action">Action</span>
		</li>
		<?
		if(!empty($generalEntryLogs)){
		foreach($generalEntryLogs as $key=>$log){
		?>
		<li class="gr-row">
			<span class="gr-initial"  style="width: 6%;"><?=$log["initial_details"]["agentname"]?></span>
			<span class="gr-time"><?=$log["ge_datetime"]?></span>
			<span class="gr-Management" style="width: 15%;"><?=$log["ge_Management"]?></span>
			<span class="gr-actions"style="width: 10%;"><?=$log["ge_actions"]?></span>
			<span class="gr-subject" ><?=$log["subject_subject"]?></span>
			
			<span class="ge- " style="width: 8%"><?=$log["ge_frnst"]?></span>
			
		</li>
		<?
		}
		}else{
		?>
		<li class="gr-row">General report not available!</li>
		<?
		}
		?>
	</ul>
</div>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<div class="fault-report">
	<div class="report-heading">Fault Report</div>
	<ul class="fr-list">
		<li class="fr-head">
			<span class="fr-initial">Initial</span>
			<span class="fr-time">Time</span>
			<span class="fr-position">Position</span>
			<span class="fr-console">Console</span>
			<span class="fr-equipment">System Equipment</span>
			<span class="fr-error-msg">Error Message</span>
			<span class="fr-action col-action">Action</span>
		</li>
		<?
		if(!empty($faultReportingLogs)){
		foreach($faultReportingLogs as $key=>$faultReport){
		?>
		<li class="fr-row">
			<span class="fr-initial"><?=$faultReport["initial_details"]["agentname"]?></span>
			<span class="fr-time"><?=$faultReport["fr_datetime"]?></span>
			<span class="fr-position"><?=$faultReport["fr_position_name"]?></span>
			<span class="fr-console"><?=$faultReport["fr_console_number"]?></span>
			<span class="fr-equipment"><?=$faultReport["fr_system_equipment"]?></span>
			<span class="fr-error-msg"><?=$faultReport["fr_any_other_details"]?></span>
			<span class="gr-action"><button class="btn-delete-row" onclick="$(this).parent().parent().remove();">Del</button></span>
		</li>
		<?
		}
		}else{
		?>
		<li class="gr-row">Fault report not available!</li>
		<?
		}
		?>
	</ul>
</div>
</div>
<style>
.report-container{
	float:left;
	width:100%;
	background:white
}
.report-heading {
	float: left;
	width: 99%;
	font-weight: bold;
	font-size: 110%;
	margin: 1% 0% 1% 0%;
	padding-left: 1%;
}
.general-report {
	float: left;
	width: 100%;
	border-bottom: 1px dashed gray;
}
.gr-list {
	float: left;
	width: 100%;
	list-style: none;
	margin: 0;
	padding: 0;
}
.gr-list .gr-head {
	float: left;
	width: 100%;
	margin: 0;
	font-weight: bold;
	background: lightgray;
	word-wrap: break-word;
}
.gr-list .gr-head .gr-initial {
	float: left;
	width: 10%;
	padding: 1%;
	word-wrap: break-word;
}
.gr-list .gr-head .gr-time {
	float: left;
	width: 10%;
	padding: 1%;
	word-wrap: break-word;
}
.gr-list .gr-head .gr-Management {
	float: left;
	width: 20%;
	padding: 1%;
	word-wrap: break-word;
}
.gr-list .gr-head .gr-actions {
	float: left;
	width: 20%;
	padding: 1%;
	word-wrap: break-word;
}
.gr-list .gr-head .gr-subject {
	float: left;
	width: 20%;
	padding: 1%;
	word-wrap: break-word;
}
.gr-list .gr-head .gr-action {
	float: left;
	width: 8%;
	padding: 1%;
	word-wrap: break-word;
}
.gr-list .gr-row {
	float: left;
	width: 100%;
	margin: 0;
	font-weight: normal;
	background: white;
	word-wrap: break-word;
	border-bottom: 1px solid gray;
	margin-bottom: 1px;
}
.gr-list .gr-row .gr-initial {
	float: left;
	width: 10%;
	padding: 0.5% 1% 0.5% 1%;
	word-wrap: break-word;
}
.gr-list .gr-row .gr-time {
	float: left;
	width: 10%;
	padding: 0.5% 1% 0.5% 1%;
	word-wrap: break-word;
}
.gr-list .gr-row .gr-Management {
	float: left;
	width: 20%;
	padding: 0.5% 1% 0.5% 1%;
	word-wrap: break-word;
}
.gr-list .gr-row .gr-actions {
	float: left;
	width: 20%;
	padding: 0.5% 1% 0.5% 1%;
	word-wrap: break-word;
}
.gr-list .gr-row .gr-subject {
	float: left;
	width: 20%;
	padding: 0.5% 1% 0.5% 1%;
	word-wrap: break-word;
}
.gr-list .gr-row .gr-action {
	float: left;
	width: 8%;
	padding: 0.5% 1% 0.5% 1%;
	word-wrap: break-word;
}
.fault-report {
	float: left;
	width: 100%;
	border-bottom: 1px dashed gray;
	word-wrap: break-word;
}
.report-heading {
	float: left;
	width: 100%;
	font-weight: bold;
	font-size: 110%;
	margin: 1% 0% 1% 0%;
	word-wrap: break-word;
}
.fr-list {
	float: left;
	width: 100%;
	list-style: none;
	margin: 0;
	padding: 0;
	word-wrap: break-word;
}
.fr-list .fr-head {
	float: left;
	width: 100%;
	margin: 0;
	font-weight: bold;
	background: lightgray;
	word-wrap: break-word;
}
.fr-list .fr-head .fr-initial {
	float: left;
	width: 10%;
	padding: 1%;
	word-wrap: break-word;
}
.fr-list .fr-head .fr-time {
	float: left;
	width: 10%;
	padding: 1%;
	word-wrap: break-word;
}
.fr-list .fr-head .fr-position {
	float: left;
	width: 12%;
	padding: 1%;
	word-wrap: break-word;
}
.fr-list .fr-head .fr-console {
	float: left;
	width: 12%;
	padding: 1%;
	word-wrap: break-word;
}
.fr-list .fr-head .fr-equipment {
	float: left;
	width: 14%;
	padding: 1%;
	word-wrap: break-word;
}
.fr-list .fr-head .fr-error-msg {
	float: left;
	width: 20%;
	padding: 1%;
	word-wrap: break-word;
}
.fr-list .fr-head .fr-action {
	float: left;
	width: 8%;
	padding: 1%;
	word-wrap: break-word;
}
.fr-list .fr-row {
	float: left;
	width: 100%;
	margin: 0;
	font-weight: normal;
	background: white;
	word-wrap: break-word;
	margin-bottom: 1px;
	border-bottom: 1px solid gray;
}
.fr-list .fr-row .fr-initial {
	float: left;
	width: 10%;
	padding: 0.5% 1% 0.5% 1%;
	word-wrap: break-word;
}
.fr-list .fr-row .fr-time {
	float: left;
	width: 10%;
	padding: 0.5% 1% 0.5% 1%;
	word-wrap: break-word;
}
.fr-list .fr-row .fr-position {
	float: left;
	width: 12%;
	padding: 0.5% 1% 0.5% 1%;
	word-wrap: break-word;
}
.fr-list .fr-row .fr-console {
	float: left;
	width: 12%;
	padding: 0.5% 1% 0.5% 1%;
	word-wrap: break-word;
}
.fr-list .fr-row .fr-equipment {
	float: left;
	width: 14%;
	padding: 0.5% 1% 0.5% 1%;
	word-wrap: break-word;
}
.fr-list .fr-row .fr-error-msg {
	float: left;
	width: 20%;
	padding: 0.5% 1% 0.5% 1%;
	word-wrap: break-word;
}
.fr-list .fr-row .fr-action {
	float: left;
	width: 8%;
	padding: 0.5% 1% 0.5% 1%;
	word-wrap: break-word;
}
</style>