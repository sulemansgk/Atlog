<div class="table-scrollable">
	
	<table class="table table-striped table-bordered table-hover">
		<tbody>
			<tr>
				<th>Title</th>
				<td><?=$instruction["title"]?></td>
			</tr>
			<tr>
				<th>Instruction Type</th>
				<td><?=$instruction_type[0]["name"]?></td>
			</tr>
			<tr>
				<th>Document Number</th>
				<td><?=$instruction["document_number"]?></td>
			</tr>
			<tr>
				<th>Publish Date</th>
				<td><?=$instruction["publish_date"]?></td>
			</tr>
			<tr>
				<th>Expiry Date</th>
				<td><?=$instruction["expiry_date"]?></td>
			</tr>
			<tr>
				<th>Files Attached</th>
				<td><?
					$instruction["files"] = trim($instruction["files"]);
					if(!empty($instruction["files"])){
					$files = json_decode($instruction["files"]);
					foreach($files as $key=>$file){
					$ext = pathinfo($file, PATHINFO_EXTENSION);
					
					if($ext == 'PNG' || $ext == 'png' || $ext == 'JPG' || $ext == 'jpg'){?>
					<a href="<?=base_url()?>assets/instruction_files/<?=$file?>"  target='_blank' class="btn btn-success"  style="margin-bottom: 1%;"><?=$file?></a>
					<?}else{ ?>
					<a href="<?=base_url()?>assets/instruction_files/<?=$file?>"  class="btn btn-success"  style="margin-bottom: 1%;" download=""><?=$file?></a>
					<?}
					?>
					
					
					<?
					}
					}
				?></td>
			</tr>
			<tr>
				<th>Issued To</th>
				<td><?
					foreach($designations as $key=>$designation){
					?>
					<a href="javascript:void(0);" class="btn btn-success" style="margin-bottom: 1%;"><?=$designation["designation"]?></a>
					<?
					}
				?>			</td>
			</tr>
			<tr>
				<th>Details</th>
				<td><?=$instruction["details"]?></td>
			</tr>
			
		</tbody>
		
	</table>
</div>