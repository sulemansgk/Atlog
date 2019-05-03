<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=exceldata.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table border='1'>
	<tr>
		<h1>General Report</h1>
	</tr>
	<tr>
		<td>Initial</td>
		<td>Time</td>
		<td>Management</td>
		<td>Actions</td>
		<td>Subject</td>
		<td>Frn Status</td>
		
		
	</tr>
	
	<?
	if(!empty($generalEntryLogs)){
	foreach($generalEntryLogs as $key=>$log){
	?>
	<tr>
		
		
		<td><?=$log["initial_details"]["agentname"]?></td>
		<td><?=$log["ge_datetime"]?></td>
		<td><?=$log["ge_Management"]?></td>
		<td><?=$log["ge_actions"]?></td>
		<td><?=$log["subject_subject"]?></td>
		
		<td><?=$log["ge_frnst"]?></td>
		
	</tr>
	
	
	<?
	}
	}else{
	?>
	<li class="gr-row">General report not available!</li>
	<?
	}
	?>
	
	<tr>
	</tr>
	<tr>
	</tr>
	<tr>
	</tr>
	
</table>
<table border='1'>
	
	
	
	
	
</tr>
<tr>
</tr>
<tr>
</tr>







<tr>
	<h1>Fault Report</h1>
</tr>
<tr><td>Initial</span>
<td>Time</td>
<td>Position</td>
<td>Console</td>
<td>System Equipment</td>
<td>Error Message</td>
<td>Action</td>




</tr>






<?
if(!empty($faultReportingLogs)){
foreach($faultReportingLogs as $key=>$faultReport){
?>
<tr>

<td><?=$faultReport["initial_details"]["agentname"]?></td>
<td>><?=$faultReport["fr_datetime"]?></td>
<td><?=$faultReport["fr_position_name"]?></td>
<td><?=$faultReport["fr_console_number"]?></td>
<td><?=$faultReport["fr_system_equipment"]?></td>
<td><?=$faultReport["fr_any_other_details"]?></td>


</tr>
<?
}
}else{
?>
<li class="gr-row">Fault report not available!</li>
<?
}
?>




</table>