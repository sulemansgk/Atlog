<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>Instruction Report
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
			<div class="portlet-body form">
				
				<form action="<?=base_url()?>report/InstructionsReport" class="log-add-form" method="post">
					
					<div class="row pform" style="padding-top:1%;"  >
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">From</span>
								
								<input name="from" placeholder="Select start date" class="al-from form-control" type="text" value="<?=date("m/d/Y")?>" readonly="readonly"/>
								
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<span class="form-field-title">To</span>
								<input name="to" placeholder="Select end date" class="al-to form-control" type="text" value="<?=date("m/d/Y")?>" readonly="readonly"/>
							</div>
						</div>
						
					</div>
					
					<div class="row pform" style="padding-bottom:2%; ">
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">User </span>
								
								<select name="agentcode" class="al-agent form-control">
									<option value="">--Select Agent--</option>
									<?
									foreach($agents as $agent){
									?>
									<option value="<?=$agent["agentcode"]?>" <?if($instructions_filter["agentcode"] == $agent["agentcode"]){?>selected="selected"<?}?>><?=$agent["agentname"]?></option>
									<?
									}
									?>
								</select>
								
							</div>
						</div>
						
						<div class="col-md-6">
							
							<div class="form-group">
								<span class="form-field-title">Unit</span>
								<select name="unit_id" class="form-control">
									<option value="">--Select--</option>
									<?
									foreach($units as $key=>$unit){
									?>
									<option <?if($instructions_filter["unit_id"] == $unit["unit_id"]){?>selected="selected"<?}?>value="<?=$unit["unit_id"]?>"><?=$unit["unit"]?></option>
									<?
									}
									?>
								</select>
								
							</div>
						</div>
						
						
						
					</div>
					
					<div class="form-actions left">
						<div class="col-md-5">
							
							<div class=" form-actions" style="border-top: 0">
								
								
								
								<input type="submit" name="al-filter" class="btn btn-success" value="Filter"/>
								<input type="submit" name="al-filter-reset" class="al-form-reset btn btn-danger" value="Cancel" onclick="clearInstructionsAccessLogsForm();"/>
								
								
								
							</div>
						</div>
					</div>
					
					
				</form>
			</div>
		</div>
	</div>
</div>
<!-- form -->
<div class="row" >
	<div class="col-md-12" >
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>Instructions Report
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
				<form action="<?=base_url()?>report/InstructionsReport" method="post">
					<input type="hidden" name="faultreports" value="<?=$this->uri->segment(3)?>" />
					<span class="description-col" style="width: 10%!important;font-weight: bold!important;height: auto;margin: 0!important;padding: 0!important;margin-top: 1%!important;margin-left: 1%!important;">Order By: </span>
					<?
					$order = $this->session->userdata("order");
					if($order == "desc"){
					?>
					<span class="description-col">
						<input type="submit" class="btn btn-primary" name="order" value="Ascending" />
					</span>
					<?
					}else{
					?>
					<span class="description-col">
						<input type="submit" class="btn btn-primary" name="order" value="Descending" />
					</span>
					<?
					}
					?>
				</form>
				<div class="table-scrollable">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th scope="col" >
									Date
								</th>
								<th scope="col">
									Time
									
								</th>
								<th scope="col">
									Initial
									
								</th>
								<th scope="col">
									Title
								</th>
								<th scope="col">
									Unit
								</th>
								<th scope="col">
									Message
									
								</th>
								
								
								
							</tr>
						</thead>
						<tbody>
							<?
							
							foreach($logs as $key=>$log){
							
							?>
							
							<tr >
								<td>
									<?=date("d/m/Y",strtotime($log["datetime"]));?>
								</td>
								<td>
									<?=date("H:i",strtotime($log["datetime"]));?>
								</td>
								<td>
									<?=$log["agentname"]?>
								</td>
								<td><?=$log["title"]?></td>
								<td>
									<?
									$unit_name = $this->db->get_where('units', array('unit_id' => $log['unit_id']))->row();
									if (!empty($unit_name)) {
									echo $unit_name->unit;
									} else {
									echo '-';
									}
									
									?>
								</td>
								<td>
									<b><?=$log["name"]?>:  </b><?=$log["details"]?>
								</td>
								
							</tr>
							
							
							<? }
							?>
							
						</tbody>
						
					</table>
					
					<div class="row">
						<div class="col-md-7 col-sm-12">
							<div class="dataTables_paginate paging_bootstrap_full_number" id="sample_1_paginate">
								<ul class="pagination" style="visibility: visible;">
									<?
									$pagination_links = trim($pagination_links);
									if(!empty($pagination_links)){
									?>
									<li class="list-row pagination-links">
										<?=$pagination_links?>
									</li>
									<?
									}
									?>
								</ul>
							</div></div></div>
						</div>
						
					</div>
				</div>
				<!-- END SAMPLE TABLE PORTLET-->
			</div>
		</div>
		<style>
			.pform
			{
				padding-left:2%;
				padding-right:2%;
			}
		</style>