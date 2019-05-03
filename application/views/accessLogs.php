<!-- // page content -->
<div class="row">
	<div class="col-md-12" >
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>Access Logs
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
				<div class="row pform" style="padding-top:1%;"  >
					<form action="<?=base_url()?>index/accessLogs" method="post" class="accesslogs-search-form">
						<div class="col-md-6">
							<label for="from">From:</label>
							<input name="from" placeholder="Select start date" class="al-from form-control" type="text" value="<?=date('m/d/Y')?>" readonly="readonly"/>
						</div>
						<div class="col-md-6">
							<label for="to">To:</label>
							<input name="to" placeholder="Select end date" class="al-to form-control" type="text" value="<?=date('m/d/Y')?>" readonly="readonly"/>
						</div>
						<div class="col-md-6"><label for="to">Unit:</label>
						<select name="agentunit" class="form-control">
							<option value="">--Select--</option>
							<?
							foreach($units as $key=>$unit){
							?>
							<option <?if($accesslogs_filter["agentunit"] == $unit["unit_id"]){?>selected="selected"<?}?> value="<?=$unit["unit_id"]?>"><?=$unit["unit"]?></option>
							<?
							}
							?>
						</select></div>
						<div class="col-md-6">
							<label for="keyword">Keyword/Form Name:</label>
							<input name="keyword" placeholder="Enter keyword or form name" class="al-keyword form-control" type="text" value="<?=$accesslogs_filter["keyword"]?>"/>
						</div>
						<div class="col-md-6" style="padding-top:1%; padding-bottom:1%;">
							<div class="al-search-controls">
								<input type="submit" name="al-filter-reset" class="al-form-reset btn btn-danger" value="Cancel" onclick="clearAccessLogsForm();"/>
								<input type="submit" name="al-filter" class="btn btn-success" value="Filter"/>
							</div>
						</div>
					</form>
					<form action="<?=base_url()?>index/accessLogs" method="post">
						<div class="col-md-6" style="padding-top:1%; padding-bottom:1%;">
							<input type="hidden" name="faultreports" value="<?=$this->uri->segment(3)?>" />
							<span class="description-col" style="width: 10%!important;font-weight: bold!important;height: auto;margin: 0!important;padding: 0!important;margin-top: 1%!important;margin-left: 1%!important;">Order By: </span>
							<?
							$order = $this->session->userdata("order");
							if($order == "desc"){
							?>
							
							<input type="submit" class="btn btn-primary" name="order" value="Ascending" />
							
							<?
							}else{
							?>
							
							<input type="submit" class="btn btn-primary" name="order" value="Descending" />
							
							<?
							}
							?>
						</div>
					</form>
					<div class="col-md-12" >
						<div class="table-scrollable">
							
							<table class="table table-striped table-bordered table-hover">
								<thead>
									
									<tr>
										
										<th scope="col">
											Date
										</th>
										<th scope="col">
											Time
										</th>
										<th scope="col">
											Agent Name
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
									<tr  >
										<td  >
											<?=date("d/m/Y",strtotime($log["log_datetime"]));?>
										</td>
										<td >
											<?=date("H:i",strtotime($log["log_datetime"]));?>
										</td>
										<td >
											<?=$log["agentname"]?>
										</td>
										
										<td >
											
											<?=$log["message"]?>
											
										</td>
										
										
									</tr>
									
									<? } ?>
									
									
								</tbody>
								
							</table>
						</div>
						
						<div class="row">
							<div class="col-md-7 ">
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
								</div></div></div></div>
							</div>
						</div>
						<!-- END SAMPLE TABLE PORTLET-->
					</div>
				</div>