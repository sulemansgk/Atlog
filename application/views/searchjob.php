<div class="row-fluid page-head">
	<h2 class="page-title"><i class="fontello-icon-monitor"></i>Job Listed</h2>
	<div class="page-bar">
		<div class="btn-toolbar"> </div>
	</div>
</div>
<form action="<?=base_url()?>report/searchfault" class="report-form" method="post">
	<div id="page-content" class="page-content">
		<section>
			<div class="row-fluid margin-top20"><!-- // column -->
			<div class="form-row">
				<span class="form-field-title">From</span>
				<span class="form-field">
					<input type="text" name="from" class="reportdatefield" value="<?=date("Y-m-d")?>" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">To</span>
				<span class="form-field">
					<input type="text" name="to" class="reportdatefield2" value="<?=date("Y-m-d")?>" />
				</span>
			</div>
			
			<div class="form-row" style="float:right;">
				<span class="form-field-title"></span>
				<span class="form-field">
					<input type="submit" class="btn" value="Submit" />
					<input type="reset" class="btn btn-red" value="Cancel" />
				</span>
			</div>
		</div>
	</section>
</div>
</form>
<?php
$counit =  count($search); ?>
<!-- // page head -->
<div id="page-content" class="page-content">
<section>
	<div class="row-fluid margin-top20">
		<label for="date-time" style="font-size:15px;">Date and Time: <?=date("Y-m-d H:i:s");?>
			<div style="float:right"><? echo $total;?></div>
		</label>
		
		
		<ul class="logs-listing mainview-listing" style="width: 100%;">
			
			<!--Table Heading-->
			</br><li class="list-head">
				
				<span class="datetime-col" style="width: 10%;">Customer</span>
				<span class="description-col" style="width: 10%;">Contact Telephone</span>
				<span class="description-col" style="width: 10%;">Job Category </span>
				<span class="description-col" style="width: 10%;">Call Item </span>
				<span class="description-col" style="width: 10%;">System </span>
				
				
				<span class="description-col" style="width: 10%;">Subject</span>
				<span class="description-col" style="width: 15%;">Details</span>
				<span class="description-col" style="width: 10%;">Initial</span>
				<span class="datetime-col" style="width: 5%;">Actions</span>
			</li>
			
			<?php if ($counit == 0 ){ ?>
			
			<li class="list-row" > No Data Available  </li>
			<?php } else {?>
			
			<?		 foreach($search as $datas){
			
			
			?>
			<!--Row White-->
			<li class="list-row" >
				
				
				<span style="width: 10%;" class="datetime-col">
				<?=$datas['customer'];?></span>
				<span style="width: 10%;" class="subject-col">
				<?=$datas['ContactTel'];?></span>
				<span style="width: 10%;" class="description-col">
				<?=$datas['jobcat'];?></span>
				<span style="width: 10%;" class="description-col">
				<?=$datas['calItem'];?></span>
				<span style="width: 10%;" class="description-col">
				<?=$datas['system'];?></span>
				
				<span style="width: 10%;" class="description-col">
				<?=$datas['subject'];?></span>
				
				<span style="width: 15%;" class="description-col">
				<?=$datas['any_other_details'];?></span>
				<span style="width: 10%;" class="description-col">
				<?=$datas['initials'];?></span>
				
				<span style="width: 10%;" class="description-col">
					<input type="Button" class="btn btn-red" value="Add"  onclick="addevent(<?=$datas['id'];?>,this,'Add Event',false)"/>
					<input type="Button" class="btn btn-blue"   onclick="viewevent(<?=$datas['id'];?>,this,'View Event',false)" value="View" />
				</span>
			</li>
			<?}?>
			<?}?>
			
			
		</ul>
		
		
	</div>
	<br /><br />
	
	<!-- // Example row -->
</section>
</div>
<!-- // page content -->