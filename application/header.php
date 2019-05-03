<?php
	$instructions = $this->instructions_model->getInstructions("all");
	$readInstructions = array();
	$unReadInstructions = array();
	$i = 0;
	foreach($instructions as $key=>$inst){
		$InstTack = $this->instructions_model->getInstTack($inst["id"],$this->userdetails["agentcode"]);
		if(!empty($InstTack)){
			$readInstructions[$i] = $instructions[$key];
			$readInstructions[$i]["track"] = $InstTack[0];
			$i++;
			continue;
		}else{
			$unReadInstructions[] = $inst;
		}
	}
?>
<html>
	<head>
		<script type="text/javascript">
		var base_url = "<?=base_url()?>";
		var agentcode = <?=$this->userdetails["agentcode"]?>
		</script>
		<script src="<?=base_url()?>assets/js/lib/jquery.js"></script>
		<meta charset="utf-8">
		<title>Air Traffic Management System</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="description" content="">
		<meta name="author" content="">
		<!-- Le styles -->
		<link href="<?=base_url()?>assets/css/lib/bootstrap.css" rel="stylesheet">
		<link href="<?=base_url()?>assets/css/lib/bootstrap-responsive.css" rel="stylesheet">
		<link href="<?=base_url()?>assets/css/boo-extension.css" rel="stylesheet">
		<link href="<?=base_url()?>assets/css/boo.css" rel="stylesheet">
		<link href="<?=base_url()?>assets/css/style.css" rel="stylesheet">
		<link href="<?=base_url()?>assets/css/boo-coloring.css" rel="stylesheet">
		<link href="<?=base_url()?>assets/css/boo-utility.css" rel="stylesheet">
		<!-- Le fav and touch icons -->
		<link rel="shortcut icon" href="assets/ico/favicon.ico">
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
	</head>
	<body class="sidebar-left ">
		<div id="dialog" title="Basic dialog">
			<div class="dialog-content">
			</div>
		</div>
		<div class="page-container">
			<div id="header-container">
				<div id="header">
					<div class="navbar navbar-inverse navbar-fixed-top">
						<div class="navbar-inner">
							<div class="container-fluid">
								<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
								<a class="brand" href="javascript:void(0);" style="padding-top: 1%;font-family: ForteMT;">
									ADIMS
								</a>
								<div class="search-global">
									<input id="globalSearch" class="search search-query input-medium" type="search" style="display:block!important;">
									<a class="search-button" href="javascript:void(0);"><i class="fontello-icon-search-5"></i></a> </div>
									<div class="nav-collapse collapse">
										<ul class="nav user-menu visible-desktop">
											<li>
												<a class="btn-glyph fontello-icon-edit tip-bc inst-list-open" href="javascript:void(0);" title="">
													<span class="badge badge-important num-of-inst"><?=sizeof($unReadInstructions)?></span>
												</a>
												<ul class="instructions-list" >
													<?
													foreach($unReadInstructions as $inst){
													?>
													<li title="<?=trim($inst["title"])?>">
														<span class="inst-list-title"><?=$inst["title"]?></span>
														<a href="javascript:void(0);" onclick="readInstruction(<?=$inst["id"]?>,'<?=$inst["title"]?>',this)" class="inst-read-more btn btn-blue" >Read More</a>
													</li>
													<?
													}
													?>
													
													<?
													
													}
													?>
												</ul>
											</li>
											<li><a class="btn-glyph fontello-icon-mail-1 tip-bc" href="javascript:void(0);" title="Emails"></a></li>
											<li><a class="btn-glyph fontello-icon-lifebuoy tip-bc" href="javascript:void(0);" title="Support"><span class="badge badge-important">4</span></a></li>
										</ul>
										<ul class="nav">
											<li class="active"> <a href="<?=base_url()?>">Home</a> </li>
											<li> <a href="javascript:void(0);">Components</a> </li>
											<li> <a href="component-fullcalendar-demo.html"><span class="fontello-icon-calendar"></span>Calendar</a> </li>
											<li> <a href="javascript:void(0);"><span class="fontello-icon-users"></span>Contacts</a> </li>
											<li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"><span class="fontello-icon-list-1"></span>Customize <b class="caret"></b></a>
											<ul class="dropdown-menu">
												<li><a tabindex="-1" href="component-form-demo.html">Demo Form</a></li>
												<li><a tabindex="-1" href="component-widgets-remember.html">Remember</a></li>
												<li><a tabindex="-1" href="component-widgets-users.html">User List</a></li>
												<li class="dropdown-submenu"><a tabindex="-1" href="javascript:void(0);">Login page</a>
												<ul class="dropdown-menu">
													<li><a tabindex="-1" href="login-01.html" target="_blanc">Type Horizontal</a></li>
													<li><a tabindex="-1" href="login-02.html" target="_blanc">Type Vertical</a></li>
												</ul>
											</li>
											<li class="divider"></li>
											<li class="nav-header">Next Update</li>
											<li><a tabindex="-1" href="javascript:void(0);">Contacts</a></li>
											<li><a tabindex="-1" href="javascript:void(0);">Email</a></li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- // navbar -->
				
				<div class="header-drawer">
					<div class="mobile-nav text-center visible-phone"> <a href="javascript:void(0);" class="mobile-btn" data-toggle="collapse" data-target=".sidebar"><i class="aweso-icon-chevron-down"></i> Components</a> </div>
					<!-- // Resposive navigation -->
					<div class="breadcrumbs-nav hidden-phone">
						<ul id="breadcrumbs" class="breadcrumb">
							<li><a href="<?=base_url()?>"><i class="fontello-icon-home f12"></i> Home</a> <span class="divider">/</span></li>
							<li class="dropdown"><a href="javascript:void(0);">Table </a> <span class="divider">/</span>
							<ul class="dropdown-menu">
								<li><a href="javascript:void(0);">Table</a></li>
								<li><a href="javascript:void(0);">Elements</a></li>
								<li><a href="javascript:void(0);">Elements</a></li>
								<li><a href="javascript:void(0);">Elements</a></li>
							</ul>
						</li>
						<li class="active">Boo Admin </li>
					</ul>
				</div>
				<!-- // breadcrumbs -->
			</div>
			<!-- // drawer -->
		</div>
	</div>
	<!-- // header-container -->
	
	<div id="main-container">
		<div id="main-sidebar" class="sidebar sidebar-inverse">
			<div class="sidebar-item">
				<div class="media profile">
					<div class="media-thumb media-left thumb-bordereb"> <a class="img-shadow" href="javascript:void(0);"><img class="thumb" src="<?=base_url()?>assets/img/demo/demo-avatar9604.jpg"></a> </div>
					<div class="media-body">
						<h5 class="media-heading"><?=$this->userdetails["agentname"]?> <small>as <?=$this->userdetails["role"]?></small></h5>
						<p class="data">Last Access: 03 June 12:30</p>
						<span style="
							margin: 0;
							padding: 0;
							float: left;
							width: 36%;
							"><a href="<?=base_url()?>index/logout">Logout</a></span>
						</div>
					</div>
				</div>
				<!-- // sidebar item - profile -->
				
				<ul id="mainSideMenu" class="nav nav-list nav-side">
					<li class="accordion-group">
						<div class="accordion-heading <?if($this->uri->segment(1) == ""){ print("active"); }?>">
							<a href="<?=base_url()?>"class="accordion-toggle">
								<span class="item-icon fontello-icon-monitor"></span>
								<i class="chevron fontello-icon-right-open-3"></i>
								Home
							</a>
						</div>
						<ul class="accordion-content nav nav-list collapse in" id="accDash">
						</ul>
					</li>
					<!-- // item accordionMenu Dashboard -->
					<li class="accordion-group">
						<div class="accordion-heading <?if($this->uri->segment(1) == "elog"){ print("active"); }?>">
							<?
							if($this->uri->segment(1) != "elog"){
							?>
							<a href="<?=base_url()?>elog/mainview" class="accordion-toggle">
								<?
								}else{
								?>
								<a href="#accForms" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle">
									<?
									}
									?>
									<span class="item-icon aweso-icon-list-alt"></span>
									<i class="chevron fontello-icon-right-open-3"></i>
									E-Log
								</a>
							</div>
							<ul class="accordion-content nav nav-list<?if($this->uri->segment(1) == "elog"){ print(" in"); }?> collapse" id="accForms">
								<li> <a href="<?=base_url()?>elog/mainview"> <i class="fontello-icon-right-dir"></i> Main View </a> </li>
								<li> <a href="<?=base_url()?>elog/generalentry"> <i class="fontello-icon-right-dir"></i> General Entry </a> </li>
								<li> <a href="<?=base_url()?>elog/faultReporting"> <i class="fontello-icon-right-dir"></i> Fault Reporting </a> </li>
								<li> <a href="<?=base_url()?>elog/aircraftDiversion"> <i class="fontello-icon-right-dir"></i> Aircraft Diversion </a> </li>
								<li> <a href="<?=base_url()?>elog/controlmobile"> <i class="fontello-icon-right-dir"></i> Control Mobile In/Out </a> </li>
								<li> <a href="<?=base_url()?>elog/runwayInUse"> <i class="fontello-icon-right-dir"></i> Runway In Use </a> </li>
								<li>
									<a href="#">
									<i class="fontello-icon-right-dir"></i> Inspection Entry </a>
									<ul class="nav">
										<li>
											<a href="<?=base_url()?>elog/RunwayManoeuvringArea">
												<i class="fontello-icon-right-dir"></i> RWY/Manoeuvring Inspection
											</a>
										</li>
										<li>
											<a href="<?=base_url()?>elog/atcfacility">
												<i class="fontello-icon-right-dir"></i> T1 ATC Facility Inspection
											</a>
										</li>
										<li>
											<a href="<?=base_url()?>elog/agl">
												<i class="fontello-icon-right-dir"></i> AGL Inspection
											</a>
										</li>
									</ul>
								</li>
								<li> <a href="#"> <i class="fontello-icon-right-dir"></i> LVP Entry </a>
								<ul class="nav">
									<li>
										<a href="#">
											<i class="fontello-icon-right-dir"></i> LVP Safeguarding Initiation
										</a>
									</li>
									<li>
										<a href="#">
											<i class="fontello-icon-right-dir"></i> LVP Initiation
										</a>
									</li>
									<li>
										<a href="#">
											<i class="fontello-icon-right-dir"></i> LVP Cancellation
										</a>
									</li>
									<li>
										<a href="#">
											<i class="fontello-icon-right-dir"></i> LVP safeguarding Cencellation
										</a>
									</li>
								</ul>
							</li>
							<li> <a href="#"> <i class="fontello-icon-right-dir"></i> Staff Absense</a>
							<ul class="nav">
								<li>
									<a href="<?=base_url()?>elog/NoShow">
										<i class="fontello-icon-right-dir"></i> No Show
									</a>
								</li>
								<li>
									<a href="<?=base_url()?>elog/LateForDuty">
										<i class="fontello-icon-right-dir"></i> Late for Duty
									</a>
								</li>
								<li>
									<a href="<?=base_url()?>elog/SentHome">
										<i class="fontello-icon-right-dir"></i> Sent Home
									</a>
								</li>
								<li>
									<a href="<?=base_url()?>elog/UnavailableForDuty">
										<i class="fontello-icon-right-dir"></i> Unavailable for Duty
									</a>
								</li>
								<li>
									<a href="<?=base_url()?>elog/SicknessForDuty">
										<i class="fontello-icon-right-dir"></i> Sickness for Duty
									</a>
								</li>
								<li>
									<a href="<?=base_url()?>elog/FitnessOrReturnForDuty">
										<i class="fontello-icon-right-dir"></i> Fitness or Return for Duty
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</li>
				<!-- // item accordionMenu Forms -->
				<li class="accordion-group">
					<div class="accordion-heading <?if($this->uri->segment(1) == "emergency"){ print("active"); }?>">
						<a href="#accComponents" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle">
							<span class="item-icon fontello-icon-align-justify"></span>
							<i class="chevron fontello-icon-right-open-3"></i> Emergencies
						</a>
					</div>
					<ul class="accordion-content nav nav-list <?if($this->uri->segment(1) == "emergency"){ print("in"); }?> collapse" id="accComponents">
						<li> <a href="<?=base_url()?>emergency/aircraftcrash"> <i class="fontello-icon-right-dir">Aircraft Crash</i></a></li>
						<li> <a href="<?=base_url()?>emergency/aircraftgroundincident"> <i class="fontello-icon-right-dir"></i> Aircraft ground Incident </a></li>
						<li> <a href="<?=base_url()?>emergency/Bombwarning"> <i class="fontello-icon-right-dir"></i> Bomb Warning </a></li>
						<li> <a href="<?=base_url()?>emergency/domesticfire"> <i class="fontello-icon-right-dir"></i> Domestic Fire </a></li>
						<li> <a href="<?=base_url()?>emergency/FUELSPILLAGE"> <i class="fontello-icon-right-dir"></i> Fuel Spillage </a></li>
						<li> <a href="<?=base_url()?>emergency/fullemergency"> <i class="fontello-icon-right-dir"></i> Fuel Emergency </a></li>
						<li> <a href="<?=base_url()?>emergency/localstandby"> <i class="fontello-icon-right-dir"></i> Local Standby </a></li>
						<li> <a href="<?=base_url()?>emergency/medicalemergency"> <i class="fontello-icon-right-dir"></i> Medical Emergency </a></li>
						<li> <a href="<?=base_url()?>emergency/OMADEmergencies"> <i class="fontello-icon-right-dir"></i> OMAD Emergencies </a></li>
						<li> <a href="<?=base_url()?>emergency/OMBYEmergencies"> <i class="fontello-icon-right-dir"></i> OMBY Emergencies </a></li>
						<li> <a href="<?=base_url()?>emergency/UnlawfulInteference"> <i class="fontello-icon-right-dir"></i> Unlawful Interference </a></li>
						<li> <a href="<?=base_url()?>emergency/WeatherStandby"> <i class="fontello-icon-right-dir"></i> Weather Standby </a></li>
					</ul>
				</li>
				<?
				$userdetails = $this->session->userdata("userdetails");;
				if($userdetails["role"] == "admin"){
				?>
				<li class="accordion-group">
					<div class="accordion-heading <?if($this->uri->segment(1) == "domainparameters"){ print("active"); }?>">
						<a href="#domainparameterssub" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle">
							<span class="item-icon fontello-icon-align-justify"></span>
							<i class="chevron fontello-icon-right-open-3"></i>
							Domain Parameters
						</a>
					</div>
					<ul class="accordion-content nav nav-list <?if($this->uri->segment(1) == "domainparameters"){ print("in"); }?> collapse" id="domainparameterssub">
						<li>
							<a href="<?=base_url()?>domainparameters/SubjectForm"> <i class="fontello-icon-right-dir">Subject Form</i></a>
						</li>
						<li>
							<a href="<?=base_url()?>domainparameters/PositionName"> <i class="fontello-icon-right-dir">Position Name</i></a>
						</li>
						<li>
							<a href="<?=base_url()?>domainparameters/EquipmentName"> <i class="fontello-icon-right-dir">Equipment Name</i></a>
						</li>
						<li>
							<a href="<?=base_url()?>domainparameters/ConsoleNumber"> <i class="fontello-icon-right-dir">Console Number</i></a>
						</li>
						<li>
							<a href="<?=base_url()?>domainparameters/ReleasePurpose"> <i class="fontello-icon-right-dir">Release Purpose</i></a>
						</li>
						<li>
							<a href="<?=base_url()?>domainparameters/AircraftType"> <i class="fontello-icon-right-dir">Aircraft Type</i></a>
						</li>
						<li>
							<a href="<?=base_url()?>domainparameters/Airport"> <i class="fontello-icon-right-dir">Airport</i></a>
						</li>
						<li>
							<a href="<?=base_url()?>domainparameters/Shift"> <i class="fontello-icon-right-dir">Shift</i></a>
						</li>
						<li>
							<a href="<?=base_url()?>domainparameters/StaffAbsenseReason"> <i class="fontello-icon-right-dir">Staff Absense Reason</i></a>
						</li>
						<li>
							<a href="<?=base_url()?>domainparameters/RunwayManoeuvringArea"> <i class="fontello-icon-right-dir">Runway/Manoeuvring Area</i></a>
						</li>
						<li>
							<a href="<?=base_url()?>domainparameters/UserRights"> <i class="fontello-icon-right-dir">User Rights</i></a>
						</li>
						<li>
							<a href="<?=base_url()?>domainparameters/UserRole"> <i class="fontello-icon-right-dir">User Role</i></a>
						</li>
						<li>
							<a href="<?=base_url()?>domainparameters/Nationality"> <i class="fontello-icon-right-dir">Nationality</i></a>
						</li>
						<li>
							<a href="<?=base_url()?>domainparameters/Designation"> <i class="fontello-icon-right-dir">Designation</i></a>
						</li>
						<li>
							<a href="<?=base_url()?>domainparameters/Company"> <i class="fontello-icon-right-dir">Company</i></a>
						</li>
						<li>
							<a href="<?=base_url()?>domainparameters/instructionType"> <i class="fontello-icon-right-dir">Instruction Type</i></a>
						</li>
					</ul>
				</li>
				<?
				}
				?>
				<!-- // item accordionMenu Components -->
				<li class="accordion-group">
					<div class="accordion-heading <?if($this->uri->segment(1) == "instructions"){ print("active"); }?>">
						<a href="#accInstructions" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle">
							<span class="item-icon fontello-icon-align-justify"></span>
							<i class="chevron fontello-icon-right-open-3"></i> Instructions
						</a>
					</div>
					<ul class="accordion-content nav nav-list <?if($this->uri->segment(1) == "instructions"){ print("in"); }?> collapse" id="accInstructions">
						
						<li> <a href="<?=base_url()?>instructions/SupplementaryInstructions"> <i class="fontello-icon-right-dir"></i> Supplementary Instructions </a> </li>
						<li> <a href="<?=base_url()?>instructions/TemporaryInstructions"> <i class="fontello-icon-right-dir"></i> Temporary Instructions </a> </li>
						<li> <a href="<?=base_url()?>instructions/DatasetInstructions"> <i class="fontello-icon-right-dir"></i> Dataset Instructions </a> </li>
						<li> <a href="<?=base_url()?>instructions/NOTAMInstructions"> <i class="fontello-icon-right-dir"></i> NOTAM </a> </li>
						<li> <a href="<?=base_url()?>instructions/METInstructions"> <i class="fontello-icon-right-dir"></i> MET </a> </li>
						<li> <a href="<?=base_url()?>instructions/OtherInstructions"> <i class="fontello-icon-right-dir"></i> Other </a> </li>
					</ul>
				</li>
				<li class="accordion-group">
					<div class="accordion-heading"> <a href="#accTables" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle"> <span class="item-icon fontello-icon-align-justify"></span> <i class="chevron fontello-icon-right-open-3"></i> Faults </a> </div>
					<ul class="accordion-content nav nav-list collapse" id="accTables">
						<li> <a href="#"> <i class="fontello-icon-right-dir"></i> Fault Reporting </a> </li>
						<li> <a href="#"> <i class="fontello-icon-right-dir"></i> Equipment Release </a> </li>
					</ul>
				</li>
				<!-- // item accordionMenu Tables -->
				<li class="accordion-group">
					<div class="accordion-heading"> <a href="#accStatistics" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle"> <span class="item-icon fontello-icon-chart"></span> <i class="chevron fontello-icon-right-open-3"></i> Statistics </a> </div>
					<ul class="accordion-content nav nav-list collapse" id="accStatistics">
						<li> <a href="statistic-flot.html"> <i class="fontello-icon-right-dir"></i> Charts </a> </li>
						<li> <a href="statistic-sparkline.html"> <i class="fontello-icon-right-dir"></i> Sparklines </a> </li>
						<li> <a href="statistic-circle.html"> <i class="fontello-icon-right-dir"></i> Circle </a> </li>
					</ul>
				</li>
				<!-- // item accordionMenu Statistics -->
				<li class="accordion-group">
					<div class="accordion-heading <?if($this->uri->segment(1) == "report"){ print("active"); }?>">
						<a href="#accReport" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle">
							<span class="item-icon  fontello-icon-window"></span>
							<i class="chevron fontello-icon-right-open-3"></i>
							Reports
						</a>
					</div>
					<ul class="accordion-content nav nav-list <?if($this->uri->segment(1) == "report"){ print("in"); }?> collapse" id="accReport">
						<li> <a href="<?=base_url()?>report/DailyReport"> <i class="fontello-icon-right-dir"></i> <span class="hidden-tablet">Daily Report</span></a> </li>
						<li> <a href="<?=base_url()?>report/SupervisorReport"> <i class="fontello-icon-right-dir"></i> <span class="hidden-tablet">Supervisor Report</span></a> </li>
						<li> <a href="<?=base_url()?>report/ManagementReport"> <i class="fontello-icon-right-dir"></i> <span class="hidden-tablet">Management Report</span></a> </li>
						<li> <a href="<?=base_url()?>report/FaultReport"> <i class="fontello-icon-right-dir"></i> <span class="hidden-tablet">Fault Report</span></a> </li>
						<li> <a href="<?=base_url()?>report/GeneralReport"> <i class="fontello-icon-right-dir"></i> <span class="hidden-tablet">General Report</span></a> </li>
					</ul>
				</li>
				<!-- // item accordionMenu Widgets -->
				<li class="accordion-group">
					<div class="accordion-heading"> <a href="#accButtons" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle"> <span class="item-icon fontello-icon-puzzle"></span> <i class="chevron fontello-icon-right-open-3"></i> Rosters </a> </div>
					<ul class="accordion-content nav nav-list collapse" id="accButtons">
						<li> <a href="#"> <i class="fontello-icon-right-dir"></i> Monthly Rosters </a> </li>
						<li> <a href="#"> <i class="fontello-icon-right-dir"></i> Daily Rosters </a> </li>
						<li> <a href="#"> <i class="fontello-icon-right-dir"></i> ATCO Work Hour </a> </li>
						<li> <a href="#"> <i class="fontello-icon-right-dir"></i> Position Log </a> </li>
					</ul>
				</li>
				<!-- // item accordionMenu UI Elements -->
				<li class="accordion-group">
					<div class="accordion-heading"> <a href="#accCalendar" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle"> <span class="item-icon fontello-icon-calendar"></span> <i class="chevron fontello-icon-right-open-3"></i> Documents </a> </div>
					<ul class="accordion-content nav nav-list collapse" id="accCalendar">
						
						<li> <a href="#"> <i class="fontello-icon-right-dir"></i> <span class="hidden-tablet">Supplementary Instructions </span></a> </li>
						<li> <a href="#"> <i class="fontello-icon-right-dir"></i> <span class="hidden-tablet">Temporary Instructions </span></a> </li>
						<li> <a href="#"> <i class="fontello-icon-right-dir"></i> <span class="hidden-tablet">Dataset Instructions </span></a> </li>
					</ul>
				</li>
				<!-- // item accordionMenu Calendar -->
			</ul>
			<!-- // sidebar menu -->
			
			<div class="sidebar-item"></div>
			<!-- // sidebar item -->
			
		</div>
		<!-- // sidebar -->
		
		<div id="main-content" class="main-content container-fluid">
			<div class="success-msg" style="display:none;position: absolute;top: 9%;left: 40%;z-index:1;">
				<img src="<?=base_url()?>assets/img/success.png">
				<span class="message">Successfully Added.</span>
			</div>
			<script type="text/javascript">
				$(document).ready(function(){
			<?if($this->uri->segment(3) == "success"){?>
			showSuccessMessage("Successfully Added");
			<?}?>
			<?if($this->uri->segment(3) == "updateSuccess"){?>
			showSuccessMessage("Successfully Updated");
			<?}?>
			});
			</script>