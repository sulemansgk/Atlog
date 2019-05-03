<div class="row-fluid page-head">
	<img src="<?=base_url()?>assets/img/gal.png" style="float:left" />
	<h2 class="page-title"><i class="fontello-icon-monitor"></i>Quick Reports</h2>
	<div class="page-bar">
		<div class="btn-toolbar"> </div>
	</div>
</div>
<!-- // page head -->
<div id="page-content" class="page-content">
	<section>
		<div class="row-fluid margin-top20">
			<ul class="logs-listing mainview-listing" style="width: 100%;">
				<li class="list-row order-row">
					<form action="<?=base_url()?>index/quickreport" method="post" class="accesslogs-search-form">
						<label for="from">From:</label>
						<input name="from" placeholder="Select start date" class="al-from" type="text" value="<?=$accesslogs_filter["from"]?>" readonly="readonly"/>
						<label for="to">To:</label>
						<input name="to" placeholder="Select end date" class="al-to" type="text" value="<?=$accesslogs_filter["to"]?>" readonly="readonly"/>
						
						<div class="al-search-controls">
							<input type="submit" name="al-filter-reset" class="al-form-reset" value="Reset" onclick="clearAccessLogsForm();"/>
							<input type="submit" name="al-filter" value="Filter"/>
						</div>
					</form>
					<form action="<?=base_url()?>index/quickreport" method="post">
						<input type="hidden" name="faultreports" value="<?=$this->uri->segment(3)?>" />
						<span class="description-col" style="width: 10%!important;font-weight: bold!important;height: auto;margin: 0!important;padding: 0!important;margin-top: 1%!important;margin-left: 1%!important;">Order By: </span>
						<?
						$order = $this->session->userdata("order");
						if($order == "desc"){
						?>
						<span class="description-col">
							<input type="submit" class="btn btn-blue" name="order" value="Ascending" />
						</span>
						<?
						}else{
						?>
						<span class="description-col">
							<input type="submit" class="btn btn-blue" name="order" value="Descending" />
						</span>
						<?
						}
						?>
					</form>
				</li>
				<li class="list-head">
					<span class="datetime-col" style="width: 10%;">Date</span>
					<span class="datetime-col" style="width: 10%;">Time</span>
					<span class="subject-col" style="width: 20%;">Agent Name</span>
					<span class="description-col" style="width: 30%;">Message</span>
				</li>
				<?
				foreach($logs as $key=>$log){
				?>
				<li class="list-row" >
					<span class="datetime-col" style="width: 10%;">
						<?=date("d/m/Y",strtotime($log["log_datetime"]));?>
					</span>
					<span class="datetime-col" style="width: 10%;">
						<?=date("Hi",strtotime($log["log_datetime"]));?>
					</span>
					<span class="subject-col" style="width: 20%;">
						<?=$log["agentname"]?>
					</span>
					<span class="description-col" style="width: 30%;">
						<?=$log["message"]?>
					</span>
				</li>
				<?
				}
				?>
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
		</div>
		<!-- // Example row -->
	</section>
</div>
<!-- // page content -->