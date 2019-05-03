<div class="row">
	<a style='margin-left: 87%;' class='btn btn-primary' href="<?=base_url()?>domainparameters/latestfrequency">Add Frequency</a>
	<br>
	<br>
	<div class="col-md-12" >
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>Frequency
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
				<form action="<?=base_url()?>elog/mainview" method="post">
					<input type="hidden" name="faultreports" value="<?=$this->uri->segment(3)?>" />
					
					
				</form>
				<div class="table-scrollable">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th scope="col" >
									Name
								</th>
								<th scope="col">
									Descripton
								</th>
								<th scope="col">
									Active
								</th>
								<th scope="col">
									Action
								</th>
								
								
							</tr>
						</thead>
						<tbody>
							<?
							foreach($subjects as $key=>$row){
							
							?>
							
							<tr >
								<td>
									<?=$row["name"]?>
								</td>
								<td>
									<?=$row["description"]?>
								</td>
								<td>
									<?	if($row["status"] == "1" ){?>Yes<?}else{?>No<?}?>
								</td>
								<td>
									<a href="javascript:void(0);"  class="btn btn-primary" onclick="editF(<?=$row["id"]?>,'Edit: <?=$row["name"]?>');">Edit</a><a href="javascript:void(0);" class="btn btn-danger"  onclick="deleteF(<?=$row["id"]?>,this);">Delete</a>
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