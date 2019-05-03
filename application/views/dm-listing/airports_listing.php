<div class="row">
	<br>
	<div class='confirm-div'></div>
	<br>
	<a style='margin-left: 88%;' class='btn btn-primary' href="<?=base_url()?>domainparameters/Airport">Add Airports</a>
	<br>
	<br>
	<div class="col-md-12" >
		<!-- BEGIN SAMPLE TABLE PORTLET-->
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-desktop"></i>Airports
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
									Airport
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
							foreach($airports as $key=>$row){
							
							?>
							
							<tr >
								<td>
									<?=$row["airport"]?>
								</td>
								<td>
									<?=$row["description"]?>
								</td>
								<td>
									<?	if($row["active"] == "on" ){?>Yes<?}else{?>No<?}?>
								</td>
								<td>
									<a href="javascript:void(0);"  class="btn btn-primary" onclick="editAirport(<?=$row["id"]?>,'Edit: <?=$row["subject"]?>');">Edit</a><a href="javascript:void(0);" class="btn btn-danger"  onclick="deleteAirport(<?=$row["id"]?>,this);">Delete</a>
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

<? if(!empty($_GET['msg']) && $_GET['msg'] == 'success'){?>
<script>
// assumes you're using jQuery
$(document).ready(function() {
$('.confirm-div').html("<div class='alert alert-success'><strong>Successfully Added!</strong></div>").show();
setTimeout(function() {
$('.confirm-div').slideUp("slow");
}, 2000);


});
</script>
<?}else if(!empty($_GET['msg']) && $_GET['msg'] == 'danger'){?>
<script>
// assumes you're using jQuery
$(document).ready(function() {
$('.confirm-div').html("<div class='alert alert-danger'><strong>Already Exist!</strong></div>").show();
setTimeout(function() {
$('.confirm-div').slideUp("slow");
}, 2000);
});
</script>
<?}?>