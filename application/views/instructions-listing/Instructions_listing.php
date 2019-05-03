<div class="row">
	<div class="col-md-12" >
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>
					<?=$view ?>
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse" data-original-title="" title="">
					</a>
					<a href="#portlet-config" >
					</a>
					<a href="javascript:;" >
					</a>
					<a href="javascript:;" >
					</a>
				</div>
			</div>
			<div class="portlet-body">
				<!--- modal Start---->
				
				<!-- Modal -->
				<div class="modal fade" id="read-more" role="dialog">
					<div class="modal-dialog modal-lg">
						
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title"></h4>
							</div>
							<div class="modal-body">
								
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
						
					</div>
				</div>
				<!--- modal End---->
				<form action="<?=base_url()?>elog/mainview" method="post">
					<input type="hidden" name="faultreports" value="<?=$this->uri->segment(3)?>" />
					
					
				</form>
				<div class="table-scrollable">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th scope="col" >
									Title
								</th>
								<th scope="col">
									Details
								</th>
								<th scope="col">
									Type
								</th>
								<th scope="col">
									Publish Date
								</th>
								<th scope="col">
									Expiry Date
								</th>
								<th scope="col">
									Actions
								</th>
								
								
							</tr>
						</thead>
						<tbody>
							<?
							foreach($instructions as $instruction){
							$type = $this->db->get_where("instruction_type",array("id"=>$instruction["instruction_type"]))->result_array();
							?>
							
							<tr >
								<td>
									<?=$instruction["title"]?>
								</td>
								<td>
									<?=$instruction["details"]?>
								</td>
								<td>
									<?
									if(!empty($type)){
									print($type[0]["name"]);
									}
									?>
								</td>
								<td>
									<?=$instruction["publish_date"]?>
								</td>
								<td>
									<?=$instruction["expiry_date"]?>
								</td>
								<td>
									<?
									if($this->userdetails["agentcode"] == 3){
									?>
									<a href="javascript:void(0);" data-backdrop="static" data-keyboard="false" class="btn btn-success" onclick="editInstruction(<?=$instruction["id"]?>,this,'Edit: <?=$instruction["title"]?>','<?=str_replace(" ","",$view)?>');">Edit</a>
									<a href="javascript:void(0);" class="btn btn-danger"  onclick="deleteInstruction(<?=$instruction["id"]?>,this);">Delete</a>
									<a href="javascript:void(0);" onclick="readInstructionPage(<?=$instruction["id"]?>,'<?=$instruction["title"]?>',this)" class="inst-read-more btn btn-primary">Read More</a>
									<?
									}else{
									?>
									<a href="javascript:void(0);" onclick="readInstructionPage(<?=$instruction["id"]?>,'<?=$instruction["title"]?>',this)" class="inst-read-more btn btn-primary">Read More</a>
									<?
									}
									?>
								</td>
								
							</tr>
							
							
							
							
							
							
							<? } ?>
							
							
						</tbody>
						
					</table>
				</div>
				
			</div>
		</div>
		<!-- END SAMPLE TABLE PORTLET-->
	</div>
</div>