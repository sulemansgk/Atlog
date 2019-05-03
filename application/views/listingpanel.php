<!-- // page content -->
<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>Job Listed
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
				<form action="<?=base_url()?>report/searchfault" class="report-form" method="post">
					
					<div class="row pform" style="padding-top:1%; padding-bottom:2%;"  >
						<div class="col-md-6">
							<span class="form-field-title">From</span>
							<span class="form-field">
								<input type="text" name="from" class="reportdatefield form-control" value="<?=date("Y-m-d")?>" />
							</span>
						</div>
						<div class="col-md-6">
							<span class="form-field-title">To</span>
							<span class="form-field">
								<input type="text" name="to" class="reportdatefield2 form-control" value="<?=date("Y-m-d")?>" />
							</span>
						</div>
						
						<div class="col-md-6" style="padding-top:2%;">
							
							<span class="form-field">
								<input type="submit" class="btn btn-success" value="Submit" />
								<input type="reset" class="btn btn-danger" value="Cancel" />
							</span>
						</div>
					</div>
					
				</form>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>Job Listed
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
				<div class="row pform" style="padding-top:1%; padding-bottom:2%;"  >
					<div class="col-md-12">
						<label for="date-time" style="font-size:15px;">Date and Time: <?=date("Y-m-d H:i:s");?>
							<div style="float:right"><? echo $total;?></div>
						</label>
					</div>
					<div class="col-md-12">
						<div class="table-scrollable">
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th scope="col" >
											Customer
										</th>
										<th scope="col">
											Contact Telephone
										</th>
										<th scope="col">
											Job Category
										</th>
										<th scope="col">
											Call Item
										</th>
										<th scope="col">
											System
										</th>
										<th scope="col">
											Job Number
										</th>
										<th scope="col">
											Details
										</th>
										<th scope="col">
											Initial
										</th>
										<th scope="col">
											Total Man Hr
										</th>
										
										<th scope="col">
											Actions
										</th>
										
										
										
										
										
										<span class="datetime-col" style="width: 5%;"></span>
									</tr>
								</thead>
								<tbody>
									<?
									
									
									
									foreach($data as $datas){
									$r = $datas['id'];
									$totalmanhour=0;
									$res =  $this->user_model->getallevents($r);
									foreach($res as $resp){
									$totalmanhour +=$resp['Man_Hours'];
									}
									
									
									?>
									
									<tr  <?php if (isset($log["details"]["action_perfomed"])){if($log["details"]["action_perfomed"] == 1){ echo 'style="background: rgba(255, 0, 0, 0.46);"' ;}if($log["details"]["action_perfomed"] == 2){ echo 'style="background: rgba(40, 184, 0, 0.57);"' ;}if($log["details"]["action_perfomed"] == 3){ echo 'style="background: rgba(255, 255, 0, 0.57);"' ;}if($log["details"]["action_perfomed"] == 4){ echo 'style="background: rgba(46, 81, 190, 0.57);"' ;}}?> onclick="<?=strtolower(str_replace("(","",str_replace(")","",str_replace(" ","",$log["log_type"]))))?>(<?=$log["log_id"]?>,this,'<?=$subject?>',false)">
										<td >
											<?=$datas['customer'];?>
										</td>
										<td>
											<?=$datas['ContactTel'];?>
										</td>
										<td>
											<?=$datas['jobcat'];?>
										</td>
										
										<td>
											<?=$datas['calItem'];?>
										</td>
										<td>
											<?=$datas['system'];?>
										</td>
										<td>
											<?=$datas['jobcard'];?>
										</td>
										<td>
											<?=$datas['any_other_details'];?>
										</td>
										<td>
											<?=$datas['initials'];?>
										</td>
										<td>
											<?=$totalmanhour;?>
										</td>
										<td>
											<input type="Button" class="btn btn-danger" value="Add"  onclick="addevent(<?=$datas['id'];?>,this,'Add Event',false)"/>
											<input type="Button" class="btn btn-primary"   onclick="viewevent(<?=$datas['id'];?>,this,'View Event',false)" value="View" />								<?php if(isset($this->userdetails["permissions"]["Close_jobs"])){?><br><input type="Button" class="btn btn-success"   onclick="closejob(<?=$datas['id'];?>,'Close Job')" value="close Job" /><?}?>
											
										</td>
									</tr>
									
									<? } ?>
									
									
								</tbody>
								
							</table>
							<div class="row">
								<div class="col-md-7 col-sm-12">
									<div class="dataTables_paginate paging_bootstrap_full_number" id="sample_1_paginate">
										<ul class="pagination" style="visibility: visible;">
											<?
											$links = trim($links);
											if(!empty($links)){
											?>
											<li class="list-row pagination-links">
												<?=$links?>
											</li>
											<?
											}
											?>
										</ul>
									</div></div></div>
									<ul  style="list-style:none">
										
										<!--Table Heading-->
										
									</li>
									<?
									
									
									
									foreach($data as $datas){
									$r = $datas['id'];
									$totalmanhour=0;
									$res =  $this->user_model->getallevents($r);
									foreach($res as $resp){
									$totalmanhour +=$resp['Man_Hours'];
									}
									
									
									?>
									<!--Row White-->
									<li  >
										
										
										
										<span style="width: 9%;" class="description-col">
										</span>
										
										<span style="width: 9%;" class="description-col">
										</span>
									</li>
									<?}?>
									
									
									<?
									$links = trim($links);
									if(!empty($links)){
									?>
									<li class="list-row pagination-links">
										<?=$links?>
									</li>
									<?
									}
									?>
									
								</ul>
							</div>
							
							
							
							
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- form -->
		<style>
			.pform
			{
				padding-left:2%;
				padding-right:2%;
			}
		</style>
		<!-- // page content -->