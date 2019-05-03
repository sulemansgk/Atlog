<h1>All Notification</h1>
<table class="table" style="background-color:#FFF;">
	<thead>
		<tr>
			<th>Notification ID</th>
			<th>Date</th>
			<th>Status</th>
			<th>Approval/Reject Time</th>
			<th>Description</th>
		</tr>
	</thead>
	<tbody>
		<?
		$notification  = $this->db->query("SELECT * FROM equipment_notifications");
		foreach ($notification->result() as $row2) {
		$f = $this->db->query("select * from fault_reporting where id = $row2->equipment_release_id")->row();
		?>
		<tr>
			<td><b><?=$row2->equip_notif_id;?></b></td>
			<td><?=date('Y-m-d',strtotime($row2->datetime));?></td>
			<td>
				<?
				if($row2->approved == 1){
				
				echo "<b style='color:green;'>Approve</b>";
				
				}else if($row2->rejected == 1){
				
				echo "<b style='color:red;'>Reject</b>";
				
				}else{?>
				
				<a notif_type = "<? echo 'unapproved_notif';?>" notif_id="<?=trim($row2->equip_notif_id)?>" onclick="readNotification(<?=$f->id;?>,'<? print( strip_tags( substr($f->any_other_details, 0, 30) ) ); if(strlen(strip_tags($f->any_other_details)) > 30){ print("......."); }?>',this,<?=$row2->equip_notif_id;?>,<? echo 0;?>)">
					<? echo "<b style='color:blue;'>Un Read Notification</b>"; ?>
				</a>
				
				<?}
				?>
			</td>
			<td>
				<?
				if(!empty($row2->approval_time)){
				echo date('H:i:s',strtotime($row2->approval_time));
				}elseif(!empty($row2->reject_time)){
				echo date('H:i:s',strtotime($row2->reject_time));
				}else{
				echo "NOT DEFINE";
				}
				
				?>
			</td>
			<td><?=$f->any_other_details;?></td>
		</tr>
		<?}?>
		
	</tbody>
</table>