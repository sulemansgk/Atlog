<?
$deleted_rows = $this->session->userdata("dailyreport_deleted_rows");

?>
<br /><br />
<?
if($greport){
?>
<table width="100%;" style="text-align:left;">
	<tbody>
		<tr>
			<th colspan="5" style="font-size:20px;text-align:center;padding-bottom:15px;"><b>General Report</b></th>
		</tr>
		<tr>
			<th colspan="5" style="font-size:20px;text-align:center;padding-bottom:15px;"><b>&nbsp;</b></th>
		</tr>
		<tr>
			<th><b>Initial</b></th>
			<th><b>Time</b></th>
			<th><b>Management</b></th>
			<th><b>Actions</b></th>
			<th><b>Subject</b></th>
		</tr>
		<?
		if(!empty($form_logs)){
		foreach($form_logs as $key=>$log){
		if(!array_key_exists($log["id"],$deleted_rows["general"])){
		?>
		<tr>
			<td colspan="5">&nbsp;</td>
		</tr>
		<tr>
			<td><?=$log["details"]["agentname"]?></td>
			<td><?=$log["datetime"]?></td>
			<td><?=$log["details"]["Management"]?></td>
			<td><?=$log["details"]["actions"]?></td>
			<td>&nbsp;
				<?
				if(isset($log["details"]["subject"])){
				if($log["log_type"] == "generalentry"){
				$subject_text = "";
				$subject_text = $this->db->get_where("subjectform",array("id"=>trim($log["details"]["subject"])))->result_array();
				if(!empty($subject_text)){
				$subject_text = $subject_text[0]["subject"];
				print($subject_text);
				}
				}else{
				print($log["details"]["subject"]);
				}
				}else if(isset($log["details"]["type_of_incident"])){
				print($log["details"]["type_of_incident"]);
				}
				
				?>
			</td>
		</tr>
		<tr>
			<th><b>Description:</b> &nbsp;</th>
			<td colspan="4">&nbsp;<? @print($log["details"]["description"].$log["details"]["any_other_details"]); ?></td>
		</tr>
		<tr>
			<th><b>On Behalf Of:</b> &nbsp;</th>
			<td colspan="4">&nbsp;
				<?
				if(isset($log["details"]["onbehalf"]) && !empty($log["details"]["onbehalf"])){
				$this->db->select("*");
				$this->db->where("agentcode",$log["details"]["onbehalf"]);
				$onbehalf_details = $this->db->get("tblagent")->result_array();
				
				print($onbehalf_details[0]["agentname"]);
				}
				?>
			</td>
		</tr>
		<tr>
			<td colspan="5">&nbsp;</td>
		</tr>
		<hr />
		<?
		}
		}
		}else{
		?>
		<tr>
			<td colspan="5">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="5">General report not available!</td>
		</tr>
		<tr>
			<td colspan="5">&nbsp;</td>
		</tr>
		<hr />
		<?
		}
		?>
		<tr border="thin solid gray">
			<td colspan="5">&nbsp;</td>
		</tr>
	</tbody>
</table>

<?
}
?>
<?
if($sreport){
?>
<table width="100%;" style="text-align:left;">
	<tbody>
		<tr>
			<th colspan="5" style="font-size:20px;text-align:center;padding-bottom:15px;"><b>&nbsp;</b></th>
		</tr>
		<tr>
			<th colspan="5" style="font-size:20px;text-align:center;padding-bottom:15px;"><b>Supervisor Report</b></th>
		</tr>
		<tr>
			<th colspan="5" style="font-size:20px;text-align:center;padding-bottom:15px;"><b>&nbsp;</b></th>
		</tr>
		<tr>
			<th><b>Initial</b></th>
			<th><b>Time</b></th>
			<th><b>Management</b></th>
			<th><b>Actions</b></th>
			<th><b>Subject</b></th>
		</tr>
		<?
		if(!empty($supervisor_reports)){
		foreach($supervisor_reports as $key=>$supervisor_report){
		if(!array_key_exists($supervisor_report["ge_id"],$deleted_rows["supervisor"])){
		?>
		<tr>
			<td colspan="5">&nbsp;</td>
		</tr>
		<tr>
			<td><?=$supervisor_report["initial_details"]["agentname"]?></td>
			<td><?=$supervisor_report["ge_datetime"]?></td>
			<td><?=$supervisor_report["ge_Management"]?></td>
			<td><?=$supervisor_report["ge_actions"]?></td>
			<td><?=$supervisor_report["subject_subject"]?></td>
		</tr>
		<br />
		<tr>
			<th><b>Description:</b> &nbsp;</th>
			<td colspan="4">&nbsp;<?=$supervisor_report["ge_description"]?></td>
		</tr>
		<tr>
			<th><b>On Behalf Of:</b> &nbsp;</th>
			<td colspan="4">&nbsp;<?=$supervisor_report["onbehalf_agentname"]?></td>
		</tr>
		<tr>
			<td colspan="5">&nbsp;</td>
		</tr>
		<hr />
		<?
		}
		}
		}else{
		?>
		<tr>
			<td colspan="5">Supervisor report not available!</td>
		</tr>
		<?
		}
		?>
	</tbody>
</table>

<?
}
?>
<?
if($mreport){
?>
<table width="100%;" style="text-align:left;">
	<tbody>
		<tr>
			<th colspan="5" style="font-size:20px;text-align:center;padding-bottom:15px;"><b>&nbsp;</b></th>
		</tr>
		<tr>
			<th colspan="5" style="font-size:20px;text-align:center;padding-bottom:15px;"><b>Management Report</b></th>
		</tr>
		<tr>
			<th colspan="5" style="font-size:20px;text-align:center;padding-bottom:15px;"><b>&nbsp;</b></th>
		</tr>
		<tr>
			<th><b>Initial</b></th>
			<th><b>Time</b></th>
			<th><b>Management</b></th>
			<th><b>Actions</b></th>
			<th><b>Subject</b></th>
		</tr>
		<?
		if(!empty($management_reports)){
		foreach($management_reports as $key=>$management_report){
		if(!array_key_exists($management_report["ge_id"],$deleted_rows["Management"])){
		?>
		<tr>
			<td colspan="5">&nbsp;</td>
		</tr>
		<tr>
			<td><?=$management_report["initial_details"]["agentname"]?></td>
			<td><?=$management_report["ge_datetime"]?></td>
			<td><?=$management_report["ge_Management"]?></td>
			<td><?=$management_report["ge_actions"]?></td>
			<td><?=$management_report["subject_subject"]?></td>
		</tr>
		<br />
		<tr>
			<th><b>Description:</b> &nbsp;</th>
			<td colspan="4">&nbsp;<?=$management_report["ge_description"]?></td>
		</tr>
		<tr>
			<th><b>On Behalf Of:</b> &nbsp;</th>
			<td colspan="4">&nbsp;<?=$management_report["onbehalf_agentname"]?></td>
		</tr>
		<tr>
			<td colspan="5">&nbsp;</td>
		</tr>
		<hr />
		<?
		}
		}
		}else{
		?>
		<tr>
			<td colspan="5">Management report not available!</td>
		</tr>
		<?
		}
		?>
	</tbody>
</table>

<?
}
?>
<?
if($freport){
?>
<table width="100%;" style="text-align:left;">
	<tbody>
		<tr>
			<th colspan="6" style="font-size:20px;text-align:center;padding-bottom:15px;"><b>&nbsp;</b></th>
		</tr>
		<tr>
			<th colspan="6" style="font-size:20px;text-align:center;padding-bottom:15px;"><b>Fault Report</b></th>
		</tr>
		<tr>
			<th colspan="6" style="font-size:20px;text-align:center;padding-bottom:15px;"><b>&nbsp;</b></th>
		</tr>
		<tr>
			<th><b>Initial</b></th>
			<th><b>Time</b></th>
			<th><b>Position</b></th>
			<th><b>Console</b></th>
			<th><b>System Equipment</b></th>
			<th><b>Error Message</b></th>
		</tr>
		<?
		if(!empty($faultReportingLogs)){
		foreach($faultReportingLogs as $key=>$faultReport){
		if(!array_key_exists($faultReport["fr_id"],$deleted_rows["fault"])){
		?>
		<tr>
			<th colspan="6" style="font-size:20px;text-align:center;padding-bottom:15px;"><b>&nbsp;</b></th>
		</tr>
		<tr>
			<td><?=$faultReport["initial_details"]["agentname"]?></td>
			<td><?=$faultReport["fr_datetime"]?></td>
			<td><?=$faultReport["fr_position_name"]?></td>
			<td><?=$faultReport["fr_console_number"]?></td>
			<td><?=$faultReport["fr_system_equipment"]?></td>
			<td><?=$faultReport["fr_error_text"]?></td>
		</tr>
		<tr>
			<th><b>Description:</b> &nbsp;</th>
			<td colspan="4">&nbsp;<?=$faultReport["fr_any_other_details"]?></td>
		</tr>
		<tr>
			<th><b>On Behalf Of:</b> &nbsp;</th>
			<td colspan="4">&nbsp;<?=$faultReport["onbehalf_agentname"]?></td>
		</tr>
		<tr>
			<th><b>FRN:</b> &nbsp;</th>
			<td colspan="4">&nbsp;<?=$faultReport["fr_frn"]?></td>
		</tr>
		<tr>
			<th><b>FRN Status:</b> &nbsp;</th>
			<td colspan="4">&nbsp;
				<?
				$this->db->select("*");
				$this->db->from("frnstatus");
				$this->db->where("id",$faultReport["fr_frnstatus"]);
				$log_frnstatus = $this->db->get()->result_array();
				print($log_frnstatus[0]["frnstatus"]);
				?>
			</td>
		</tr>
		<tr>
			<th colspan="6" style="font-size:20px;text-align:center;padding-bottom:15px;"><b>&nbsp;</b></th>
		</tr>
		<hr />
		<?
		}
		}
		}else{
		?>
		<tr>
			<th colspan="6" style="font-size:20px;text-align:center;padding-bottom:15px;"><b>&nbsp;Fault Report not available</b></th>
		</tr>
		<?
		}
		?>
	</tbody>
</table>
<?
}
?>