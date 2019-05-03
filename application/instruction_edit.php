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
					window.location.href = base_url+"instructions/"+view+"/updateSuccess";
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
<div id="page-content" class="page-content">
	<section>
		<div class="row-fluid margin-top20"><!-- // column -->
		<form action="<?=base_url()?>instructions/updateInstruction" enctype="multipart/form-data" class="emergency-edit-form inst-edit-form" method="post">
			<input type="hidden" name="inst_id" value="<?=$instruction["id"]?>" />
			<input type="hidden" name="view" class='view-field' value="" />
			<input type="hidden" name="creation_date" value="<?=date("Y-m-d H:i:s")?>" />
			<div id="page-content" class="page-content">
				<section>
					<div class="row-fluid margin-top20"><!-- // column -->
					<div class="form-row" style="width:50%;" >
						<span class="form-field-title" style="width: 30%;">Title</span>
						<span class="form-field" style="width: 70%;">
							<input type="text" name="title" value="<?=$instruction["title"]?>"/>
						</span>
					</div>
					<div class="form-row" style="width:50%;">
						<span class="form-field-title" style="width: 30%;">Instruction Type</span>
						<span class="form-field" style="width: 70%;">
							<select name="instruction_type">
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
					<div class="form-row" style="width:50%;">
						<span class="form-field-title" style="width: 30%;">Document Number</span>
						<span class="form-field" style="width: 70%;">
							<input type="text" name="document_number" value="<?=$instruction["document_number"]?>"/>
						</span>
					</div>
					<div class="form-row" style="width:50%;">
						<span class="form-field-title" style="width: 30%;">Publish Date</span>
						<span class="form-field" style="width: 70%;">
							<input type="text" class="pdate-field" name="publish_date" value="<?=$instruction["publish_date"]?>"/>
						</span>
					</div>
					<div class="form-row" style="width:50%;">
						<span class="form-field-title" style="width: 30%;">Expiry Date</span>
						<span class="form-field" style="width: 70%;">
							<input type="text" class="edate-field" name="expiry_date" value="<?=$instruction["expiry_date"]?>"/>
						</span>
					</div>
					<div class="form-row" style="width: 50%;">
						<span class="form-field-title" style="width: 30%;">Files Upload</span>
						<span class="form-field" style="width: 70%;">
							<input type="file" name="files[]" class="multiple-inst-file" multiple="multiple" />
						</span>
					</div>
					<div class="form-row" style="width: 100%;">
						<span class="form-field-title" style="width: 15%;">Issue To</span>
						<span class="form-field" style="width: 85%;">
							<select name="issue_to[]" class="mul-select-list" multiple="multiple" style="width: 600px;">
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
					<div class="form-row" style="width: 100%;">
						<span class="form-field-title" style="width: 15%;">Details</span>
						<span class="form-field" style="width: 85%;">
							<textarea name="details" class="ckeditor" style="width: 600px;"><?=$instruction["details"]?></textarea>
						</span>
					</div>
					<div class="form-row">
						<span class="form-field-title"></span>
						<span class="form-field">
							<input type="reset" class="btn btn-blue" value="Reset" />
							<input type="submit" class="btn" value="Update" />
						</span>
					</div>
				</div>
			</section>
		</div>
	</form>
</div>
<!-- // Example row -->
</section>
</div>
<!-- // page content -->