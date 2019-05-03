<?php
/* Activity % */
$this->db->select("device_category,count(*) as count");
$this->db->from("dashboard_statistics");
$this->db->group_by("device_category");
$this->db->order_by("count","desc");
$this->db->limit(6,0);
$device_access = $this->db->get()->result_array();
foreach($device_access as $key=>$row){
	$device_access[$row["device_category"]] = array($row["device_category"]=>$row["device_category"],"count"=>$row["count"]);
	unset($device_access[$key]);
}
if(!empty($device_access)){
	if(isset($device_access["Desktop"]) && !isset($device_access["Mobile"])){
		$device_access["Desktop"]["percent"] = 100;
			$device_access["Mobile"]["percent"] = 0;
	}else if(!isset($device_access["Desktop"]) && isset($device_access["Mobile"])){
		$device_access["Mobile"]["percent"] = 100;
		$device_access["Desktop"]["percent"] = 0;
	}else if(isset($device_access["Desktop"]) && isset($device_access["Mobile"])){
		$total = $device_access["Desktop"]["count"] + $device_access["Mobile"]["count"];
		$device_access["Desktop"]["percent"] = $device_access["Desktop"]["count"]/$total*100;
		$device_access["Mobile"]["percent"] = $device_access["Mobile"]["count"]/$total*100;
	}else{
		$device_access["Desktop"]["percent"] = 0;
				$device_access["Mobile"]["percent"] = 0;
	}
}else{
	$device_access["Desktop"] = array();
			$device_access["Mobile"] = array();
	$device_access["Desktop"]["percent"] = 0;
			$device_access["Mobile"]["percent"] = 0;
}

/* Total Faults */
$total_faults = $this->db->get("fault_reporting")->num_rows();

/* Total Faults previous month */
$this->db->where("datetime >= '".date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")."- 30 days"))."'");
$total_faults_prev_month = $this->db->get("fault_reporting")->num_rows();

/* Total Logs */
$total_logs = $this->db->get("form_logs")->num_rows();

/* Total Logs previous month */
$this->db->where("datetime >= '".date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")."- 30 days"))."'");
$total_logs_prev_month = $this->db->get("form_logs")->num_rows();

/* Total Logs last week*/
$this->db->where("datetime >= '".date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")."- 7 days"))."'");
$total_logs_lastweek = $this->db->get("form_logs")->num_rows();


/* Total Suplementary Instructions*/
$this->db->where("instruction_type",1);
$total_si = $this->db->get("instructions")->num_rows();
/* Total Data set instructions*/
$this->db->where("instruction_type",3);
$total_di = $this->db->get("instructions")->num_rows();

/* Total Temporary Instructions*/
$this->db->where("instruction_type",2);
$total_ti = $this->db->get("instructions")->num_rows();

/* Total NOATM Instructions*/
$this->db->where("instruction_type",4);
$total_noatm = $this->db->get("instructions")->num_rows();

/* Total MET Instructions*/
$this->db->where("instruction_type",5);
$total_met = $this->db->get("instructions")->num_rows();

/* Total Other Instructions*/
$this->db->where("instruction_type",5);
$total_other_inst = $this->db->get("instructions")->num_rows();

/* Total Instructions */
$total_instructions = $this->db->get("instructions")->num_rows();
/* Total Instructions previous month */
$this->db->where("creation_date >= '".date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")."- 30 days"))."'");
$total_instructions_prev_month = $this->db->get("instructions")->num_rows();
	/* Browsers % */
$this->db->select("browser,count(*) as count");
$this->db->from("dashboard_statistics");
$this->db->group_by("browser");
$this->db->order_by("count","desc");
$this->db->limit(6,0);
$browsers_access = $this->db->get()->result_array();

$borwoser_total_visits = 0;
foreach($browsers_access as $key=>$row){
	$borwoser_total_visits = $borwoser_total_visits+$row["count"];
}
foreach($browsers_access as $key=>$row){
	$browsers_access[$key]["percent"] = $row["count"]/$borwoser_total_visits*100;
	if($browsers_access[$key]["percent"] > (floor($browsers_access[$key]["percent"]) + 0.5)){
		$browsers_access[$key]["percent"] = ceil($browsers_access[$key]["percent"]);
	}else{
		$browsers_access[$key]["percent"] = floor($browsers_access[$key]["percent"]);
	}
	$browsers_access[$row["browser"]] = $browsers_access[$key];
	unset($browsers_access[$key]);
}

	/* Pages Visits */
$this->db->select("page,page_url,count(*) as count");
$this->db->from("dashboard_statistics");
$this->db->group_by("page");
$this->db->order_by("count","desc");
$this->db->limit(6,0);
$pages_visits = $this->db->get()->result_array();

/* Top Referrers */
$this->db->select("referrer_domain,count(*) as count");
$this->db->from("dashboard_statistics");
$this->db->group_by("referrer_domain");
$this->db->order_by("count","desc");
$this->db->limit(6,0);
$top_referrers = $this->db->get()->result_array();
?>
<div class="row-fluid page-head">
	<img src="<?=base_url()?>assets/img/gal.png" style="float:left;" />
	<h2 class="page-title"><i class="fontello-icon-monitor"></i> ATM Dashboard</h2>
	<!--<p class="pagedesc">Air Traffic Management Dashboard </p>-->
	<div class="page-bar">
		<div class="btn-toolbar"> </div>
	</div>
</div>
<!-- // page head -->

<div id="page-content" class="page-content">
	<section>
		<div class="row-fluid margin-top20">
			<div class="span12 well well-black">
				<div class="row-fluid">
					<div class="span6 grider">
						<h3><i class="fontello-icon-chart-bar-3"></i> Daily LOGS <small>Weekends are colored</small></h3>
						<p class="pagedesc">Statistical sample chart with Flot graphs. The content below are loaded using sample data.</p>
						<hr class="margin-mx">
						<div id="dashChartVisitors" style="width:100%; height:170px" class="margin-bottom32"> </div>
						<!-- // Chart 1 -->
						<div id="dashChartVisitorsOverview" style="width:99%;height:45px"> </div>
						<!-- // Chart 2 -->
						<p class="info-block">To zoom in, select the area or use the button.</p>
						<ul class="btn-toolbar">
							<li><a id="setLastHours" class="btn btn-green">last 24 hours</a></li>
							<li><a id="setLastSevenDays" class="btn btn-green">last 7 days</a> </li>
							<li><a id="setLastFortnight" class="btn btn-green">last 14 days</a> </li>
							<li><a id="clearSelection" class="btn btn-red">Clear</a> </li>
							<li><a class="btn btn-grey" href="#">View details &raquo;</a> </li>
						</ul>
						<hr class="mm" />
						<!-- // Chart block -->
						
						<div class="row-fluid">
							<div class="span12">
								<table class="table table-condensed">
									<caption>
									Default Table Caption - Title for table <span>Here text in span</span>
									</caption>
									<thead>
										<tr>
											<th scope="col" width="40%"> Traffic sources</th>
											<th scope="col" class="hidden-phone">Current Month</th>
											<th scope="col" class="hidden-tablet hidden-phone">Change</th>
											<th scope="col" class="text-right">Target</th>
											<th scope="col" width="100px">Trend</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th><span class="label label-positive">Direct</span></th>
											<td class="hidden-phone text-right bold">547</td>
											<td class="hidden-tablet hidden-phone text-right positive bold"> + 44 <i class="ficon-up-dir f-16"></i></td>
											<td class="text-right">600</td>
											<td>
												<div class="section-chart">
													<span class="DSPLine" values="7,9,8,7,7,9,8,9,10,11,12,10,9,9,8,10,11,9,10,3,7,8,6"></span>
												</div>
											</td>
										</tr>
										<tr>
											<th><span class="label label-positive">Refer</span></th>
											<td class="hidden-phone text-right bold">724</td>
											<td class="hidden-tablet hidden-phone text-right positive bold">+ 38 <i class="ficon-up-dir f-16"></i></td>
											<td class="text-right">500</td>
											<td><div class="section-chart"> <span class="DSPLine" values="30,32,33,31,33,34,36,37,38,40,36,32,33,37,39,42"></span> </div></td>
										</tr>
										<tr>
											<th><span class="label label-negative">Social</span></th>
											<td class="hidden-phone text-right bold">918</td>
											<td class="hidden-tablet hidden-phone text-right"><span class="badge badge-negative"> - 59 <i class="ficon-down-dir f-16"></i></span></td>
											<td class="text-right">600</td>
											<td><div class="section-chart"> <span class="DSPLine" values="10,11,10,18,16,17,19,19,21,24,25,27,25,28,22,17"></span> </div></td>
										</tr>
										<tr>
											<th><span class="label label-positive">Search</span></th>
											<td class="hidden-phone text-right bold">754</td>
											<td class="hidden-tablet hidden-phone text-right positive bold">+ 42 <i class="ficon-up-dir f-16"></i></td>
											<td class="text-right">600</td>
											<td><div class="section-chart"> <span class="DSPLine" values="7,7,0,2,4,5,0,1,1,2,6,2,5,7,9,0,4,3,4,6,5,3"></span> </div></td>
										</tr>
										<tr>
											<th><span class="label label-inverse">Internal</span></th>
											<td class="hidden-phone text-right bold">700</td>
											<td class="hidden-tablet hidden-phone text-right bold">+ 95 <i class=" ficon-left-dir f-16"></i></td>
											<td class="text-right">1000</td>
											<td><div class="section-chart"> <span class="DSPLine" values="17,17,17,17,17,18,17,17,17,17,17,17,18,17,17,18,17"></span> </div></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<!-- // Example row -->
						
					</div>
					<!-- // column -->
					
					<div class="span6 grider">
						<div class="row-fluid">
							<div class="span6 grider-item">
								<div class="row-fluid">
									<div class="span12 grider-item">
										<div class="statistic-box well well-black">
											<div class="section-title">
												<h5><i class="fontello-icon-back-in-time"></i> Activity</h5>
											</div>
											<div class="section-content item">
												<h4 class="statistic-values pull-left padding-right10">
												<span class="section-icon">
												<i class="fontello-icon-monitor"></i></span> <?=(int)$device_access["Desktop"]["percent"]?>% </h4>
												<span> Desktop</span> </div>
												<div class="section-content">
													<h4 class="statistic-values pull-left padding-right10">
													<span class="section-icon">
													<i class="fontello-icon-mobile"></i></span> <?=(int)$device_access["Mobile"]["percent"]?>% </h4>
													<span> Mobile</span> </div>
												</div>
												<!-- // box -->
											</div>
											<!-- // column -->
										</div>
										<!-- // Example row -->
										
										<div class="row-fluid">
											<div class="span12 grider-item">
												<ul class="nav nav-well">
													<li><a class="well well-black" href="javascript:void(0);"><i class="fontello-icon-users"></i>
														<h4 class="statistic-values pull-right"><?=$total_logs?></h4>
													Total Logs (Overall)</a></li>
													<li><a class="well well-black" href="javascript:void(0);"><i class="fontello-icon-user-4"></i>
														<h4 class="statistic-values pull-right"><?=$total_logs_lastweek?></h4>
													Total Logs (last week)</a></li>
													<li><a class="well well-black" href="javascript:void(0);"><i class="fontello-icon-basket-2"></i>
														<h4 class="statistic-values pull-right"><?=$total_faults?></h4>
													Total Faults</a></li>
													<li><a class="well well-black" href="javascript:void(0);"><i class="fontello-icon-archive"></i>
														<h4 class="statistic-values pull-right"><?=$total_si?></h4>
													Total SI</a></li>
													<li><a class="well well-black " href="javascript:void(0);"><i class="fontello-icon-download"></i>
														<h4 class="statistic-values pull-right"><?=$total_di?></h4>
													Total DI</a></li>
													<li><a class="well well-black " href="javascript:void(0);"><i class="fontello-icon-lifebuoy"></i>
														<h4 class="statistic-values pull-right"><?=$total_ti?></h4>
													Total TI</a></li>
													<li><a class="well well-black" href="javascript:void(0);"><i class="fontello-icon-lifebuoy"></i>
														<h4 class="statistic-values pull-right"><?=$total_noatm?></h4>
													Total NOTAM Instructions</a></li>
													<li><a class="well well-black " href="javascript:void(0);"><i class="fontello-icon-lifebuoy"></i>
														<h4 class="statistic-values pull-right"><?=$total_met?></h4>
													Total MET Instructions</a></li>
													<li><a class="well well-black " href="javascript:void(0);"><i class="fontello-icon-lifebuoy"></i>
														<h4 class="statistic-values pull-right"><?=$total_other_inst?></h4>
													Total Other Instructions</a></li>
												</ul>
												<!-- // statistic nav -->
											</div>
											<!-- // column -->
										</div>
										<!-- // Example row -->
										
									</div>
									<!-- // column -->
									
									<div class="span6 grider-item">
										<div class="row-fluid">
											<div class="span12 grider-item">
												<div class="statistic-box well well-black well-impressed">
													<div class="section-title">
														<h5><i class="fontello-icon-users"></i> Total Faults</h5>
													</div>
													<div class="section-content">
														<h2 class="statistic-values"><?=$total_faults?>
														
														</h2>
														<span class="info-block">Total Faults Previous 30 days: <?=$total_faults_prev_month?></span> </div>
													</div>
													<!-- // box -->
												</div>
												<!-- // column -->
											</div>
											<!-- // Example row -->
											
											<div class="row-fluid">
												<div class="span12 grider-item">
													<div class="statistic-box well well-black well-impressed">
														<div class="section-title">
															<h5><i class="fontello-icon-user"></i> Total Logs</h5>
														</div>
														<div class="section-content">
															<h2 class="statistic-values"><?=$total_logs?>
															
															</h2>
															<span class="info-block">Total Logs Previous 30 days: <?=$total_logs_prev_month?></span> </div>
														</div>
														<!-- // box -->
													</div>
													<!-- // column -->
												</div>
												<!-- // Example row -->
												
												<div class="row-fluid">
													<div class="span12 grider-item">
														<div class="statistic-box well well-black well-impressed">
															<div class="section-title">
																<h5><i class="fontello-icon-user"></i> Instructions</h5>
															</div>
															<div class="section-content">
																<h2 class="statistic-values"><?=$total_instructions?>
																
																</h2>
																<span class="info-block">Instructions Previous 30 days: <?=$total_instructions_prev_month?></span> </div>
															</div>
															<!-- // box -->
														</div>
														<!-- // column -->
													</div>
													<!-- // Example row -->
													
													<div class="row-fluid">
														<div class="span12 grider-item">
															<div class="statistic-box well well-black well-impressed">
																<div class="section-left"> <i class="fontello-icon-users f-28"></i> </div>
																<div class="section-wrapper-right">
																	<div class="section-right">
																		<h3 class="statistic-values negative"> - 2,726 <i class="indicator fontello-icon-down-dir f-28"></i></h3>
																		<span class="info-block">Total trafic 30 days</span> </div>
																	</div>
																</div>
																<!-- // box -->
															</div>
															<!-- // column -->
														</div>
														<!-- // Example row -->
														
														<div class="row-fluid">
															<div class="span12 grider-item">
																<div class="statistic-box well well-black well-impressed">
																	<div class="section-left"> <i class="fontello-icon-users f-28"></i> </div>
																	<div class="section-wrapper-right">
																		<div class="section-right">
																			<h3 class="statistic-values positive"> + 2,726 <i class="indicator fontello-icon-up-dir f-28"></i></h3>
																			<span class="info-block">Total trafic 30 days</span> </div>
																		</div>
																	</div>
																	<!-- // box -->
																</div>
																<!-- // column -->
															</div>
															<!-- // Example row -->
															
														</div>
														<!-- // column -->
														
													</div>
													<!-- // Example row -->
												</div>
												<!-- // column -->
												
											</div>
										</div>
										<!-- // column -->
										
									</div>
									<!-- // Example row -->
									
								</section>
								<section>
									<div class="row-fluid">
										<div class="span4">
											<div class="widget widget-simple">
												<div class="widget-header header-small"> <a class="btn btn-mini btn-success pull-right" href="#">Show All</a>
												<h6><i class="fontello-icon-net"></i> Top Referrers</h6>
											</div>
											<div class="widget-content">
												<div class="widget-body">
													<table class="table table-condensed table-striped">
														<thead>
															<tr>
																<th>Referrer</th>
																<th>Uniques</th>
															</tr>
														</thead>
														<tbody>
															<?php
																foreach($top_referrers as $referrer){
															?>
															<tr>
																<td><a target="_blank" href="http://<?=$referrer["referrer_domain"]?>"><?=$referrer["referrer_domain"]?></a></td>
																<td><span><?=$referrer["count"]?></span></td>
															</tr>
															<?php
																}
															?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
										<!-- // widget -->
									</div>
									<!-- // column -->
									
									<div class="span4">
										<div class="widget widget-simple">
											<div class="widget-header header-small"> <a class="btn btn-mini btn-success pull-right" href="#">Show All</a>
											<h6><i class="fontello-icon-eye-1"></i> Most Visited Pages</h6>
										</div>
										<div class="widget-content">
											<div class="widget-body">
												<table class="table table-condensed table-striped">
													<thead>
														<tr>
															<th>Page</th>
															<th>Visits</th>
														</tr>
													</thead>
													<tbody>
														<?php
															foreach($pages_visits as $page_visit){
														?>
														<tr>
															<td><a href="<?=$page_visit["page_url"]?>" target="_blank"><?=$page_visit["page"]?></a></td>
															<td><span><?=$page_visit["count"]?></span></td>
														</tr>
														<?php
															}
														?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<!-- // column -->
								
								<div class="span4">
									<div class="widget well well-black">
										<div class="widget-header header-small"> <a class="btn btn-mini btn-success pull-right" href="#">Show All</a>
										<h6><i class="fontello-icon-popup-2"></i> Browsers</h6>
									</div>
									<div class="widget-content">
										<div class="widget-body">
											<table class="table table-condensed table-striped">
												<thead>
													<tr>
														<th>Browser</th>
														<th>Visits</th>
														<th>Percent</th>
													</tr>
												</thead>
												<tbody>
													<tr style="color: white;">
														<th>Firefox</th>
														<td><span><?if(isset($browsers_access["Mozilla Firefox"])){ print($browsers_access["Mozilla Firefox"]["count"]);}else{ print("0"); }?></span></td>
														<td><div class="progress progress-success progress-small margin-s0">
															<div class="bar tip-tc" style="width:<?if(isset($browsers_access["Mozilla Firefox"])){ print($browsers_access["Mozilla Firefox"]["percent"]);	}else{ print("0"); }?>%" title="<?if(isset($browsers_access["Mozilla Firefox"])){ print($browsers_access["Mozilla Firefox"]["percent"]);}else{ print("0"); }?>%"> </div>
														</div></td>
													</tr>
													<tr style="color: white;">
														<th>Chrome</th>
														<td><span><?if(isset($browsers_access["Chrome"])){ print($browsers_access["Chrome"]["count"]);}else{ print("0"); }?></span></td>
														<td><div class="progress progress-success progress-small margin-s0">
															<div class="bar tip-tc" style="width:<?if(isset($browsers_access["Chrome"])){ print($browsers_access["Chrome"]["percent"]);}else{ print("0"); }?>%" title="<?if(isset($browsers_access["Chrome"])){ print($browsers_access["Chrome"]["percent"]);}else{ print("0"); }?>%"> </div>
														</div></td>
													</tr>
													<tr style="color: white;">
														<th>Internet Explorer</th>
														<td><span><?if(isset($browsers_access["Internet Explorer"])){ print($browsers_access["Internet Explorer"]["count"]);}else{ print("0"); }?></span></td>
														<td><div class="progress progress-success progress-small margin-s0">
															<div class="bar tip-tc" style="width:<?if(isset($browsers_access["Internet Explorer"])){ print($browsers_access["Internet Explorer"]["percent"]);}else{ print("0"); }?>%" title="<?if(isset($browsers_access["Internet Explorer"])){ print($browsers_access["Internet Explorer"]["percent"]);}else{ print("0"); }?>%"> </div>
														</div></td>
													</tr>
													<tr style="color: white;">
														<th>Safari</th>
														<td><span><?if(isset($browsers_access["Safari"])){ print($browsers_access["Safari"]["count"]);}else{ print("0"); }?></span></td>
														<td><div class="progress progress-success progress-small margin-s0">
															<div class="bar tip-tc" style="width:<?if(isset($browsers_access["Safari"])){ print($browsers_access["Safari"]["percent"]);}else{ print("0"); }?>%" title="<?if(isset($browsers_access["Safari"])){ print($browsers_access["Safari"]["percent"]);}else{ print("0"); }?>%"> </div>
														</div></td>
													</tr>
													<tr style="color: white;">
														<th>Opera</th>
														<td><span><?if(isset($browsers_access["Opera"])){ print($browsers_access["Opera"]["count"]);}else{ print("0"); }?></span></td>
														<td><div class="progress progress-success progress-small margin-s0">
															<div class="bar tip-tc" style="width:<?if(isset($browsers_access["Opera"])){ print($browsers_access["Opera"]["percent"]);}else{ print("0"); }?>%" title="<?if(isset($browsers_access["Opera"])){ print($browsers_access["Opera"]["percent"]);}else{ print("0"); }?>%"> </div>
														</div></td>
													</tr>
													<tr style="color: white;">
														<th>Others</th>
														<td><span><?if(isset($browsers_access["Others"])){ print($browsers_access["Others"]["count"]);}else{ print("0"); }?></span></td>
														<td><div class="progress progress-success progress-small margin-s0">
															<div class="bar tip-tc" style="width:<?if(isset($browsers_access["Others"])){ print($browsers_access["Others"]["percent"]);}else{ print("0"); }?>%" title="<?if(isset($browsers_access["Others"])){ print($browsers_access["Others"]["percent"]);}else{ print("0"); }?>%"> </div>
														</div></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<!-- // column -->
							
						</div>
						<!-- // Example row -->
						
					</section>
					<section>
						<div class="row-fluid">
							<div class="span8">
								<div class="widget widget-recent">
									<div class="widget-header">
										<h4><i class="fontello-icon-article-alt-1"></i>Recent Posts</h4>
									</div>
									<div class="widget-content">
										<div class="widget-body">
											<ul class="widget-list">
												<li class="media media-overflow">
													<div class="media-right">
														<div class="quick-menu">
															<div class="btn-group"> <a class="btn btn-mini btn-success" href="javascript:void(0);">Approve</a> <a data-toggle="dropdown" class="btn btn-mini dropdown-toggle"> or&nbsp; <span class="caret"></span></a>
															<ul class="dropdown-menu pull-right">
																<li><a href="javascript:void(0);"><i class="icon-pencil"></i><span class="divider-text"></span> Edit</a></li>
																<li><a href="javascript:void(0);"><i class="icon-remove"></i><span class="divider-text"></span> Reject</a></li>
																<li><a href="javascript:void(0);"><i class="icon-ok"></i><span class="divider-text"></span> Approve</a></li>
																<li class="divider"></li>
																<li><a href="javascript:void(0);"><i class="icon-trash"></i><span class="divider-text"></span> Delete</a></li>
															</ul>
														</div>
													</div>
												</div>
												<div class="media-body">
													<ul class="data inline">
														<li><i class="fontello-icon-feather"></i> By: <a href="#"><strong>John Doe</strong></a></li>
														<li class="divider-vertical"></li>
														<li><strong>2 Aug 2012</strong>, 09:27 AM</li>
														<li class="divider-vertical"></li>
														<li>IP: <strong>158.45.46.27</strong></li>
														<li class="divider-vertical"></li>
														<li>updated: <strong>6:25 PM</strong> (5 hours ago)</li>
													</ul>
													<h4 class="media-heading"> <a href="javascript:void(0);">Aliquam facilisis enim et elit tincidunt Suspendisse</a></h4>
													<p class="data">Lorem ipsum dolor sit amet consectetuer Nunc porta Maecenas lorem semper. Mauris risus justo egest...</p>
												</div>
											</li>
											<li class="media media-overflow">
												<div class="media-right">
													<div class="quick-menu">
														<div class="btn-group"> <a class="btn btn-mini btn-success" href="javascript:void(0);">Approve</a> <a data-toggle="dropdown" class="btn btn-mini dropdown-toggle"> or&nbsp; <span class="caret"></span></a>
														<ul class="dropdown-menu pull-right">
															<li><a href="javascript:void(0);"><i class="icon-pencil"></i><span class="divider-text"></span> Edit</a></li>
															<li><a href="javascript:void(0);"><i class="icon-remove"></i><span class="divider-text"></span> Reject</a></li>
															<li><a href="javascript:void(0);"><i class="icon-ok"></i><span class="divider-text"></span> Approve</a></li>
															<li class="divider"></li>
															<li><a href="javascript:void(0);"><i class="icon-trash"></i><span class="divider-text"></span> Delete</a></li>
														</ul>
													</div>
												</div>
											</div>
											<div class="media-body">
												<ul class="data inline">
													<li><i class="fontello-icon-feather"></i> By: <a href="#"><strong>John Doe</strong></a></li>
													<li class="divider-vertical"></li>
													<li><strong>2 Aug 2012</strong>, 09:27 AM</li>
													<li class="divider-vertical"></li>
													<li>IP: <strong>158.45.46.27</strong></li>
													<li class="divider-vertical"></li>
													<li>updated: <strong>6:25 PM</strong> (5 hours ago)</li>
												</ul>
												<h4 class="media-heading"> <a href="javascript:void(0);">Lorem ipsum dolor sit amet consectetuer</a></h4>
												<p class="data">Lorem ipsum dolor sit amet consectetuer Nunc porta Maecenas lorem semper. Mauris risus justo egest Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus. Cras sit amet nibh libero, in gravida nulla.</p>
											</div>
										</li>
										<li class="media media-overflow">
											<div class="media-right">
												<div class="quick-menu">
													<div class="btn-group"> <a class="btn btn-mini btn-success" href="javascript:void(0);">Approve</a> <a data-toggle="dropdown" class="btn btn-mini dropdown-toggle"> or&nbsp; <span class="caret"></span></a>
													<ul class="dropdown-menu pull-right">
														<li><a href="javascript:void(0);"><i class="icon-pencil"></i><span class="divider-text"></span> Edit</a></li>
														<li><a href="javascript:void(0);"><i class="icon-remove"></i><span class="divider-text"></span> Reject</a></li>
														<li><a href="javascript:void(0);"><i class="icon-ok"></i><span class="divider-text"></span> Approve</a></li>
														<li class="divider"></li>
														<li><a href="javascript:void(0);"><i class="icon-trash"></i><span class="divider-text"></span> Delete</a></li>
													</ul>
												</div>
											</div>
										</div>
										<div class="media-body">
											<ul class="data inline">
												<li><i class="fontello-icon-feather"></i> By: <a href="#"><strong>John Doe</strong></a></li>
												<li class="divider-vertical"></li>
												<li><strong>2 Aug 2012</strong>, 09:27 AM</li>
												<li class="divider-vertical"></li>
												<li>IP: <strong>158.45.46.27</strong></li>
												<li class="divider-vertical"></li>
												<li>updated: <strong>6:25 PM</strong> (5 hours ago)</li>
											</ul>
											<h4 class="media-heading"> <a href="javascript:void(0);">Nunc porta Maecenas</a></h4>
											<p class="data">Lorem ipsum dolor sit amet consectetuer Nunc porta Maecenas lorem semper. Mauris risus justo egest...</p>
										</div>
									</li>
									<li class="media media-overflow">
										<div class="media-right">
											<div class="quick-menu">
												<div class="btn-group"> <a class="btn btn-mini btn-success" href="javascript:void(0);">Approve</a> <a data-toggle="dropdown" class="btn btn-mini dropdown-toggle"> or&nbsp; <span class="caret"></span></a>
												<ul class="dropdown-menu pull-right">
													<li><a href="javascript:void(0);"><i class="icon-pencil"></i><span class="divider-text"></span> Edit</a></li>
													<li><a href="javascript:void(0);"><i class="icon-remove"></i><span class="divider-text"></span> Reject</a></li>
													<li><a href="javascript:void(0);"><i class="icon-ok"></i><span class="divider-text"></span> Approve</a></li>
													<li class="divider"></li>
													<li><a href="javascript:void(0);"><i class="icon-trash"></i><span class="divider-text"></span> Delete</a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="media-body">
										<ul class="data inline">
											<li><i class="fontello-icon-feather"></i> By: <a href="#"><strong>John Doe</strong></a></li>
											<li class="divider-vertical"></li>
											<li><strong>2 Aug 2012</strong>, 09:27 AM</li>
											<li class="divider-vertical"></li>
											<li>IP: <strong>158.45.46.27</strong></li>
											<li class="divider-vertical"></li>
											<li>updated: <strong>6:25 PM</strong> (5 hours ago)</li>
										</ul>
										<h4 class="media-heading"> <a href="javascript:void(0);">Elit tincidunt Suspendisse</a></h4>
										<p class="data">Lorem ipsum dolor sit amet consectetuer Nunc porta Maecenas lorem semper. Mauris risus justo egest Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus. Cras sit amet nibh libero.</p>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- // Widget -->
			</div>
			<!-- // column -->
			
			<div class="span4">
				<div class="widget widget-simple">
					<div class="widget-header">
						<h4><i class="fontello-icon-th-list-4"></i> Posts by Category</h4>
					</div>
					<!-- // widget header -->
					<div class="widget-content">
						<div class="widget-body">
							<div class="progress-group margin-00">
								<div class="label-field">Entertaiment <span class="pull-right">536 posts</span></div>
								<div class="progress progress-success progress-mini filled3 margin-0s">
									<div class="filler">
										<div class="bar" style="width:100%"> </div>
									</div>
								</div>
								<!-- // progress 1 -->
								
								<div class="label-field">Fashion <span class="pull-right">359 posts</span></div>
								<div class="progress progress-success progress-mini filled3 margin-0s">
									<div class="filler">
										<div class="bar" style="width:75%"> </div>
									</div>
								</div>
							</div>
							<!-- // progress 2 -->
							
							<div class="label-field">Gaming <span class="pull-right">298 posts</span></div>
							<div class="progress progress-success progress-mini filled3 margin-0s">
								<div class="filler">
									<div class="bar" style="width:52%"> </div>
								</div>
							</div>
							<!-- // progress 3 -->
							
							<div class="label-field">Business <span class="pull-right">274 posts</span></div>
							<div class="progress progress-success progress-mini filled3 margin-0s">
								<div class="filler">
									<div class="bar" style="width:50%"> </div>
								</div>
							</div>
							<!-- // progress 3 -->
							
							<div class="label-field">Journals <span class="pull-right">214 posts</span></div>
							<div class="progress progress-success progress-mini filled3 margin-0s">
								<div class="filler">
									<div class="bar" style="width:46%"> </div>
								</div>
							</div>
							<!-- // progress 3 -->
							
							<div class="label-field">Auto <span class="pull-right">196 posts</span></div>
							<div class="progress progress-success progress-mini filled3 margin-0s">
								<div class="filler">
									<div class="bar" style="width:38%"> </div>
								</div>
							</div>
							<!-- // progress 3 -->
						</div>
					</div>
					<!-- // widget content -->
				</div>
				<!-- // Widget -->
			</div>
			<!-- // column -->
		</div>
		<!-- // Example row -->
		
	</section>
</div>
<!-- // page content -->