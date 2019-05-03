<div class="row-fluid page-head
	<? $view = "Domain Parameter Customer" ;?>
	<img src="<?=base_url()?>assets/img/gal.png" style="float:left" />
	<h2 class="page-title"><i class="fontello-icon-monitor"></i><?=$view?></h2>
	<div class="page-bar">
		<div class="btn-toolbar"> </div>
	</div>
</div>
<?
if($this->userdetails["agentcode"] == 3){
?>

<background class="screen-hide" onclick="$('.inst-add-form,.screen-hide').fadeOut(500);"></background>
<form action="<?=base_url()?>instructions/addInstruction" enctype="multipart/form-data" style="display:none;" class="log-add-form inst-add-form" id="<?=str_replace(" ","",$view)?>-form" method="post">
	<div class="title" style="float:left;"><span>Add Instruction</span>
	<span class="ui-icon ui-icon-closethick" style="float: right;
		margin-right: 1%;
		cursor: pointer;
		color: white;
		background: none;
		text-indent: 0;
	width: 4%;" onclick="$('.inst-add-form,.screen-hide').fadeOut(500);">close</span>
</div>
<input type="hidden" name="view" value="<?=str_replace(" ","",$view)?>" />
<input type="hidden" name="creation_date" value="<?=date("Y-m-d H:i:s")?>" />
<div id="page-content" class="page-content">
	<section>
		<div class="row-fluid margin-top20"><!-- // column -->
		<div class="form-row" style="width:50%;" >
			<span class="form-field-title" style="width: 30%;">Titlesssssss</span>
			<span class="form-field" style="width: 70%;">
				<input type="text" name="title" required="required"/>
			</span>
		</div>
		<div class="form-row" style="width:50%;">
			<span class="form-field-title" style="width: 30%;">Instruction Type</span>
			<span class="form-field" style="width: 70%;">
				<select name="instruction_type" required="required">
					<option value="">--Select--</option>
					<?
					foreach($instructionTypes as $instructionType){
					?>
					<option value="<?=$instructionType["id"]?>"><?=$instructionType["name"]?></option>
					<?
					}
					?>
				</select>
			</span>
		</div>
		<div class="form-row" style="width:50%;">
			<span class="form-field-title" style="width: 30%;">Document Number</span>
			<span class="form-field" style="width: 70%;">
				<input type="text" name="document_number" required="required" />
			</span>
		</div>
		<div class="form-row" style="width:50%;">
			<span class="form-field-title" style="width: 30%;">Publish Date</span>
			<span class="form-field" style="width: 70%;">
				<input type="text" class="pdate-field" name="publish_date"  required="required"/>
			</span>
		</div>
		<div class="form-row" style="width:50%;">
			<span class="form-field-title" style="width: 30%;">Expiry Date</span>
			<span class="form-field" style="width: 70%;">
				<input type="text" class="edate-field" name="expiry_date"  required="required"/>
			</span>
		</div>
		<div class="form-row" style="width: 50%;">
			<span class="form-field-title" style="width: 30%;">Files Upload</span>
			<span class="form-field" style="width: 70%;">
				<input type="file" name="files[]" class="multiple-inst-file" multiple="multiple" />
			</span>
		</div>
		<div class="form-row">
			<span class="form-field-title">Issue To</span>
			<span class="form-field">
				<select name="issue_to[]" class="mul-select-list" multiple="multiple" required="required">
					<?
					foreach($designations as $designation){
					?>
					<option value="<?=$designation["id"]?>"><?=$designation["designation"]?></option>
					<?
					}
					?>
				</select>
			</span>
		</div>
		<div class="form-row">
			<span class="form-field-title">Details</span>
			<span class="form-field" style="width: 75%;">
				<textarea name="details" id="inst-textarea" class="ckeditor" style="width: 100%;"></textarea>
			</span>
		</div>
		<div class="form-row">
			<span class="form-field-title"></span>
			<span class="form-field">
				<input type="reset" class="btn btn-blue" value="Reset">
				<input type="submit" class="btn" value="Submit">
			</span>
		</div>
	</div>
</section>
</div>
</form>
<?
}
?>
<ul class="inst-listing">
<li class="inst-listing-head">
<span class="subject" style="width: 3%;">Id</span>
<span class="subject" style="width: 6%;">Customer Name</span>
<span class="description" style="width: 9%;">Customer Initials</span>
<span class="type" style="width: 9%;">Contact Person</span>
<span class="publish-date"style="width: 9%;">Phone</span>
<span class="expiry-date" style="width: 9%;">Email</span>
<span class="expiry-date" style="width: 9%;">Mobile</span>
<span class="expiry-date" style="width: 9%;">Status</span>
<span class="edit-delete" style="width: 9%;" >Edit/Delete</span>
</li>
<?
foreach($instructions as $instruction){
?>
<li class="inst-row">
<span class="subject" style="width: 3%;"  style="max-height: 56px;overflow: hidden;"><?=$instruction["id"]?></span>
<span class="description" style="width: 11%;" style="max-height: 56px;overflow: hidden;"><?=$instruction["Customer_name"]?></span>

<span class="publish-date" style="width: 9%;"><?=$instruction["Customer_initials"]?></span>
<span class="expiry-date"style="width: 9%;"><?=$instruction["Contact_person"]?></span>

<span class="publish-date" style="width: 9%;"><?=$instruction["Phone"]?></span>
<span class="expiry-date" style="width: 9%;"><?=$instruction["Email"]?></span>

<span class="publish-date" style="width: 9%;"><?=$instruction["Mobile"]?></span>
<span class="expiry-date" style="width: 9%;"><?=$instruction["Status"]?></span>


<span class="edit-delete">
	<?
	if($this->userdetails["agentcode"] == 3){
	?>
	<span class="edit-delete"><a href="javascript:void(0);"  class="btn btn-blue" onclick="editdparacust(<?=$instruction["id"]?>,'Edit: <?=$instruction["Customer_name"]?>');">Edit</a>
	<a href="javascript:void(0);" class="btn btn-red"  onclick="deletedparacust(<?=$instruction["id"]?>,this);">Delete</a></span>
	
	<?
	}else{
	?>
	
	<?
	}
	?>
</span>
</li>
<?
}
?>
</ul>