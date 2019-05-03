<ul class="inst-details">
	<li class="">
		<span class="row-title">Accepted By</span>
		<span class="row-value"><?=$instruction["accepted_by"]?></span>
	</li>
	<li class="">
		<span class="row-title">Date</span>
		<span class="row-value"><?=$instruction["date"]?></span>
	</li>
	<li class="">
		<span class="row-title">Fault Report Number</span>
		<span class="row-value"><?=$instruction["fault_rep"]?></span>
	</li>
	<li class="">
		<span class="row-title">Status</span>
		<span class="row-value"><?=$instruction["status"]?></span>
	</li>
	<?php if($instruction["status"] == "Job Close Request"){?>
	<li class="">
		<span class="row-title">Remarks</span>
		<span class="row-value"><?=$instruction["error_text"]?></span>
	</li>
	<li class="">
		<input type="button" class="btn" value="Close Request" onclick="openclosedetails(<?=$instruction["fault_rep"]?>,this,'Close Request',false);" />
	</li>
	<?php }else{?>
	<li class="">
		<span class="row-title">Error Text</span>
		<span class="row-value"><?=$instruction["error_text"]?></span>
	</li>
	
	
	
	
	<li class="">
		<input type="button" class="btn" value="Details" onclick="enterdetails(<?=$instruction["fault_rep"]?>,this,'Detials',false);" />
	</li>
	<?php  }?>
</ul>