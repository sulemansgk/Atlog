<?
$user_logged = $this->userdetails["agentunit"];
$user_unit = unserialize($user_logged);
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>Add Instruction
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse" data-original-title="" title=""></a>
					<a href="#portlet-config" ></a>
					<a href="javascript:;" ></a>
					<a href="javascript:;" ></a>
				</div>
			</div>
			<div class="portlet-body form">
				<form action="<?=base_url()?>instructions/addInstruction" enctype="multipart/form-data"  class="log-add-form inst-add-form" id="<?=str_replace(" ","",$view)?>-form" method="post">
					
					<input type="hidden" name="view" value="<?=str_replace(" ","",$view)?>" />
					<input type="hidden" name="creation_date" value="<?=date("Y-m-d H:i:s")?>" />
					
					<section>
						<div class="row pform" style="padding-top:1%;" ><!-- // column -->
						<div class="col-md-6" >
							<span class="form-field-title" >Title</span>
							
							<input type="text" name="title" class="form-control" required="required"/>
							
						</div>
						<div class="col-md-6" >
							<span class="form-field-title" >Instruction Type</span>
							
							<select name="instruction_type" class="form-control" required="required">
								<option value="">--Select--</option>
								<?
								foreach($instructionTypes as $instructionType){
								?>
								<option value="<?=$instructionType["id"]?>"><?=$instructionType["name"]?></option>
								<?
								}
								?>
							</select>
						</div>
					</div>
					<div class="row pform">
						<div class="col-md-6" >
							<span class="form-field-title" >Document Number</span>
							
							<input type="text" class="form-control" name="document_number" required="required" />
							
						</div>
						<div class="col-md-6" >
							<span class="form-field-title">Publish Date</span>
							
							<input type="text" class="pdate-field form-control date-picker" value="<?=date("m/d/Y")?>" name="publish_date"  required="required"/>
							
						</div>
					</div>
					
					
					<div class="row pform">
						<div class="col-md-6" >
							<span class="form-field-title" style="width: 30%;">Expiry Date</span>
							
							<input type="text" class="edate-field form-control date-picker" value="<?=date("m/d/Y")?>" name="expiry_date"  required="required"/>
							
						</div>
						<div class="col-md-6" >
							<span class="form-field-title" style="width: 30%;">Files Upload</span>
							
							<input type="file" name="files[]" class="multiple-inst-file " multiple="multiple" />
						</div>
					</div>
					
					<div class="row pform">
						<div class="col-md-6" >
							<span class="form-field-title" style="width: 30%;">Unit</span>
							
							<select name="unit_id" class="form-control unt"  required="required">
								
								<option value="">--Select Unit--</option>
								<?
								foreach($user_unit as $unit){
								$unit_name = $this->db->get_where('units', array('unit_id' => $unit))->row();
								?>
								<option value="<?=$unit_name->unit_id?>"><?=$unit_name->unit?></option>
								<?
								} ?>
							</select>
							
						</div>
						<div class="col-md-6">
							<span class="form-field-title">Issue To</span>
							
							<select name="issue_to[]" class="mul-select-list form-control" multiple="multiple" required="required">
								
								
								
								<?
								foreach($designations as $designation){
								?>
								<option value="<?=$designation["id"]?>"><?=$designation["designation"]?></option>
								<?
								}
								?>
							</select>
							
						</div>
					</div>
					<div class="row pform" style="padding-bottom:1%">
						<div class="col-md-12" >
							<span class="form-field-title">Details</span>
							<span class="form-field" style="width: 75%;">
								<textarea name="details" id="inst-textarea" class="ckeditor form-control" ></textarea>
							</span>
						</div>
					</div>
					<div class="form-actions left">
						
						<div class="col-md-5">
							
							
							
							<div class=" form-actions" style="margin-top: 6%;">
								<span class="form-field-title"></span>
								
								<input type="submit" class="btn btn-success" value="Submit">
								<input type="reset" class="btn btn-danger" value="Cancel">
							</div>
						</div>
					</div>
				</section>
				
			</form>
		</div>
	</div>
</div>
</div>
<style>
	.pform
	{
		padding-left:2%;
		padding-right:2%;
		padding-top: 5px;
padding-bottom: 5px;
	}
</style>