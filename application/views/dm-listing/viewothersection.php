<div class="row">
	<a style='margin-left: 85%;' class='btn btn-primary' href="<?=base_url()?>domainparameters/othersection">Add Other Section</a>
	<br>
	<br>
	<div class="col-md-12" >
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>Other Section
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
									Username
								</th>
								<th scope="col">
									Phone No
								</th>
								<th scope="col">
									Descripton
								</th>
								<th scope="col">
									Action
								</th>
								
								
							</tr>
						</thead>
						<tbody>
							<?
							foreach($subjects as $key=>$row){
							$query = $this->db->query('SELECT * FROM tblagent WHERE agentcode ='.$row["initials_code"]);
							$row1 = $query->row();
							?>
							
							<tr >
								<td>
									<?=$row["name"]?>
								</td>
								<td>
									<?=$row1->agentname?>
								</td>
								<td>
									<?=$row["phone"]?>
								</td>
								<td>
									<?=$row["description"]?>
								</td>
								<td>
									<a href="javascript:void(0);"  class="btn btn-primary" onclick="editOtherSection(<?=$row["id"]?>,'Edit: <?=$row["name"]?>');">Edit</a><a href="javascript:void(0);" class="btn btn-danger"  onclick="deleteOtherSection(<?=$row["id"]?>,this);">Delete</a>
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