<div class="row-fluid page-head">
	<img src="<?=base_url()?>assets/img/gal.png" style="float:left" />
	<h2 class="page-title"><i class="fontello-icon-monitor"></i>Subjects</h2>
	<div class="page-bar">
		<div class="btn-toolbar"> </div>
	</div>
</div>
<ul class="dm-listing">
	<li class="dm-listing-head">
		<span class="subject">Subject</span>
		<span class="description">Descripton</span>
		<span class="active">Active</span>
		<span class="edit-delete">Edit/Delete</span>
	</li>
	<?
	foreach($subjects as $key=>$row){
	?>
	<li class="dm-row">
		<span class="subject"><?=$row["subject"]?></span>
		<span class="description"><?=$row["description"]?></span>
		<span class="active"><?	if($row["active"] == "on" ){?>Yes<?}else{?>No<?}?></span>
		<span class="edit-delete"><a href="javascript:void(0);"  class="btn btn-blue" onclick="editSubject(<?=$row["id"]?>,'Edit: <?=$row["subject"]?>');">Edit</a><a href="javascript:void(0);" class="btn btn-red"  onclick="deleteSubject(<?=$row["id"]?>,this);">Delete</a></span>
	</li>
	<?
	}
	?>
</ul>