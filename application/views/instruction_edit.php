<?
$issue_to_list = json_decode($instruction["issue_to"]);
$issue_to_arr = array();
foreach($issue_to_list as $key=>$row){
$issue_to_arr[$row] = $row;
}
?>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.form.js"></script>
<script type="text/javascript">
$(function(){
	$(".inst-edit-form").ajaxForm({
			success:function(res){
				if(res == "updated"){
					var view = $(".view-field").val();
				
					window.location.href = window.location.href+"/updateSuccess";
				}else{
					alert("Some error occured please try again.");
				}
			}
	});
	$(".mul-select-list").multiselect({sortable: false, searchable: false});
	tinymce.init({selector:'textarea'});
	$( ".datetime-field,.pdate-field,.edate-field" ).datetimepicker({
		dateFormat:"yy-mm-dd",
		timeFormat: "HH:mm:ss",
			});
});
</script>

<form action="<?=base_url()?>instructions/updateInstruction" enctype="multipart/form-data" class="emergency-edit-form inst-edit-form" method="post">
	<input type="hidden" name="inst_id" value="<?=$instruction["id"]?>" />
	<input type="hidden" name="view" class='view-field' value="" />
	<input type="hidden" name="creation_date" value="<?=date("Y-m-d H:i:s")?>" />
	<input type="hidden" name="prev_inst_type" value="<?=$instruction["instruction_type"]?>" />
	
	<section>
		<div class="row"><!-- // column -->
		<div class="col-md-6" >
			<span class="form-field-title" style="width: 30%;">Title</span>
			<span class="form-field" style="width: 70%;">
				<input type="text" name="title" class="form-control" value="<?=$instruction["title"]?>"/>
			</span>
		</div>
		<div class="col-md-6" >
			<span class="form-field-title" style="width: 30%;">Instruction Type</span>
			<span class="form-field" style="width: 70%;">
				<select name="instruction_type" class="form-control">
					<?
					foreach($instructionTypes as $instructionType){
					?>
					<option value="<?=$instructionType["id"]?>" <?if($instruction["instruction_type"]==$instructionType["id"]){?>selected="selected"<?}?>><?=$instructionType["name"]?></option>
					<?
					}
					?>
				</select>
			</span>
		</div>
		<div class="col-md-6" >
			<span class="form-field-title" style="width: 30%;">Document Number</span>
			<span class="form-field" >
				<input type="text" name="document_number" class="form-control" value="<?=$instruction["document_number"]?>"/>
			</span>
		</div>
		<div class="col-md-6" >
			<span class="form-field-title" style="width: 30%;">Publish Date</span>
			<span class="form-field" style="width: 70%;">
				<input type="text" class="pdate-field form-control date-picker" value="<?=date("m/d/Y")?>" name="publish_date" value="<?=$instruction["publish_date"]?>"/>
			</span>
		</div>
		<div class="col-md-6" >
			<span class="form-field-title" style="width: 30%;">Expiry Date</span>
			<span class="form-field" style="width: 70%;">
				<input type="text" class="edate-field form-control date-picker" value="<?=date("m/d/Y")?>" name="expiry_date" value="<?=$instruction["expiry_date"]?>"/>
			</span>
		</div>
		<div class="col-md-6" >
			<span class="form-field-title" style="width: 30%;">Files Upload</span>
			<span class="form-field" style="width: 70%;">
				<input type="file" name="files[]" class="multiple-inst-file " multiple="multiple" />
			</span>
		</div>
		<div class="col-md-6" >
			<span class="form-field-title" style="width: 15%;">Details</span>
			<span class="form-field" style="width: 85%;">
				<textarea name="details" class="ckeditor form-control" ><?=$instruction["details"]?></textarea>
			</span>
		</div>
		<div class="col-md-6" >
			<span class="form-field-title" style="width: 15%;">Issue To</span>
			<span class="form-field " style="width: 85%;">
				<select name="issue_to[]" class="mul-select-list form-control" multiple="multiple" >
					<?
					foreach($designations as $designation){
					?>
					<option value="<?=$designation["id"]?>" <?if(array_key_exists($designation["id"],$issue_to_arr)){?>selected="selected"<?}?>><?=$designation["designation"]?></option>
					<?
					}
					?>
				</select>
			</span>
		</div>
		
		<div class="col-md-6" >
			<span class="form-field-title"></span>
			<span class="form-field">
				
				<input type="submit" class="btn btn-success" style="margin-top:5%;" value="Update" />
			</span>
		</div>
	</div>
</section>

</form>
<script type="text/javascript">
</script>
<!-- // page content -->