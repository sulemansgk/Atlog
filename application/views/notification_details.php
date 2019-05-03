<table class="table table-bordered">
	<tbody>
		<tr>
			<td style="width: 20%">Initial:</td>
			<td><?
				$initial = $this->db->get_where("tblagent",array("agentcode"=>$report["initial"]))->result_array();
				if(!empty($initial)){
				print($initial[0]["agentname"]);
				}
			?></td>
		</tr>
		<tr>
			<td>Date: </td>
			<td><?=date("d/m/Y",strtotime($report["datetime"]))?></td>
		</tr>
		<tr>
			<td>Time: </td>
			<td><?=date("H:i",strtotime($report["datetime"]))?></td>
		</tr>
		<tr>
			<td>On Behalf Of: </td>
			<td>
				<?
				$initial = $this->db->get_where("tblagent",array("agentcode"=>$report["onbehalf"]))->result_array();
				if(!empty($initial)){
				print($initial[0]["agentname"]);
				}
				?>
			</td>
		</tr>
		<tr>
			<td>Position Name: </td>
			<td><?=$report["position_name"]?></td>
		</tr>
		<tr>
			<td>Console Number: </td>
			<td><?=$report["console_number"]?></td>
		</tr>
		<tr>
			<td>System/Equipment: </td>
			<td><?=$report["system_equipment"]?></td>
		</tr>
		<tr>
			<td>Purpose of Release: </td>
			<td><?=$report["purpose_of_release"]?></td>
		</tr>
		<tr>
			<td>Description: </td>
			<td><?=$report["any_other_details"]?></td>
		</tr>
	</tbody>
</table>
<?
$rec = $this->db->get_where("equipment_notifications",array("equip_notif_id"=>$notif_id))->result_array();
if(isset($this->userdetails["permissions"]["getApprovedNotifications"]) && ( (trim($rec[0]["approved"]) == 1) || (trim($rec[0]["rejected"]) == 1) ) ){
$this->instructions_model->markAppprovedNotifAsRead($rec[0]["equip_notif_id"]);
}
if($rec[0]["atc_report"] == 0){
if( ($rec[0]["approved"] == 0) && ($rec[0]["rejected"] == 0) ){
?>
<button onclick="approveNotification(<?=$notif_id?>,this)" class="btn btn-blue" style="background: green;color: white;">Approve</button>
<button onclick="rejectNotification(<?=$notif_id?>,this)" class="btn btn-blue" style="background: rgb(147, 0, 0);color: white;" >Reject</button>
<?
}else if( ($rec[0]["approved"] == 0) && ($rec[0]["rejected"] == 1) ){
?>
<button style="background: rgb(147, 0, 0);" class="btn btn-red">Rejected</button>
<?
}else if( ($rec[0]["approved"] == 1) && ($rec[0]["rejected"] == 0) ){
?>
<button style="background: green;color: white;" class="btn btn-green">Approved</button>
<?
}
}else{
$this->instructions_model->updateATCReport($rec[0]["equip_notif_id"],$this->userdetails["agentcode"]);
?>

<?
}
?>