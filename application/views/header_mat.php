<?
function curPageURL() {
$pageURL = 'http';

$pageURL .= "://";
if ($_SERVER["SERVER_PORT"] != "80") {
$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
} else {
$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
}
return $pageURL;
}
$url = parse_url(curPageURL());
$referrer_domain = $url["host"];

$equip_notifications = array();
if(isset($this->userdetails["permissions"]["getApprovedNotifications"])){
$equip_notifications = $this->instructions_model->getApprovedNotifications();
}
if(isset($this->userdetails["permissions"]["getATCNotifications"])){
$atc_notifications = $this->instructions_model->getATCNotifications();
foreach($atc_notifications as $key=>$row){
$equip_notifications[] = $row;
}
}
if(isset($this->userdetails["permissions"]["approve_equipment_release"])){
$equip_notifications = $this->instructions_model->getUnApprovedNotifications();
}

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
<!DOCTYPE html>
<html lang="en" class="no-js">
	<!-- BEGIN HEAD -->
	<head>
		<meta charset="utf-8"/>
		<title>Air Traffic Management System</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1" name="viewport"/>
		<meta content="" name="description"/>
		<meta content="" name="author"/>
		<!-- BEGIN GLOBAL MANDATORY STYLES -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
		<link href="<?=base_url()?>assets/global/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?=base_url()?>assets//global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?=base_url()?>assets//global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?=base_url()?>assets//global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?=base_url()?>assets//global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
		<link href="<?=base_url()?>assets//global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?=base_url()?>assets//global/plugins/bootstrap-toggle/css/bootstrap-toggle.min.css" rel="stylesheet" type="text/css"/>
		<!-- END GLOBAL MANDATORY STYLES -->
		<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
		<link href="<?=base_url()?>assets//global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
		<link href="<?=base_url()?>assets//global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?=base_url()?>assets//global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
		<link href="<?=base_url()?>assets//global/plugins/morris/morris.css" rel="stylesheet" type="text/css">
		<!-- END PAGE LEVEL PLUGIN STYLES -->
		<!-- BEGIN PAGE STYLES -->
		<link href="<?=base_url()?>assets//admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
		<!-- END PAGE STYLES -->
		<!-- BEGIN THEME STYLES -->
		<!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
		<link href="<?=base_url()?>assets//global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
		<link href="<?=base_url()?>assets//global/css/plugins.css" rel="stylesheet" type="text/css"/>
		<link href="<?=base_url()?>assets//admin/layout4/css/layout.css" rel="stylesheet" type="text/css"/>
		<link href="<?=base_url()?>assets//admin/layout4/css/themes/light.css" rel="stylesheet" type="text/css" id="style_color"/>
		<link href="<?=base_url()?>assets//admin/layout4/css/custom.css" rel="stylesheet" type="text/css"/>
		<!-- END THEME STYLES -->

		<!-- 24 Hours Timepicker -->
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/global/plugins/bootstrap-clockpicker.min.css">

		<!-- End -->

		<link rel="shortcut icon" href="<?=base_url()?>assets//admin/layout4/img/favi.png"/>
		<script src="<?=base_url()?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/global/plugins/bootstrap-toggle/js/bootstrap-toggle.min.js" type="text/javascript"></script>
		<style>
			.page-header.navbar .page-logo .logo-default {
		margin: 18px 0 0 0;
		}
		</style>
	</head>
	<!-- END HEAD -->
	<!-- BEGIN BODY -->
	<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
	<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
	<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
	<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
	<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
	<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
	<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
	<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
	<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
	<body class="page-header-fixed page-sidebar-closed-hide-logo page-sidebar-closed-hide-logo" onload=display_ct();>
		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog">
				
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"></h4>
					</div>
					<div class="modal-body">
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
				
			</div>
		</div>
		<div class="page-header navbar navbar-fixed-top">
			<!-- BEGIN HEADER INNER -->
			<div class="page-header-inner">
				<!-- BEGIN LOGO -->
				<div class="page-logo">
					<a href="<?=base_url().'index/dashboard'?>">
						<img src="<?=base_url()?>assets//admin/layout4/img/atmars1.png" alt="logo" class="logo-default" style="width: 160px"/>
					</a>
					<div class="menu-toggler sidebar-toggler">
						<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
					</div>
				</div>
				<!-- END LOGO -->
				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
				</a>
				
				<div class="page-top">
					
					<div class="top-menu">
						<ul class="nav navbar-nav pull-right">
							
							
							<!-- BEGIN NOTIFICATION DROPDOWN -->
							<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
							<li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
								<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
									<i class="icon-envelope"></i>
									<span class="badge badge-success">
									<?=sizeof($unReadInstructions)?> </span>
								</a>
								<ul class="dropdown-menu">
									<li class="external">
										<h3><span class="bold"><?=sizeof($unReadInstructions)?></span> Instructions</h3>
										
									</li>
									<li>
										<ul class="dropdown-menu-list scroller dropdown-menu-list" style="height: 250px;" data-handle-color="#637283">
											<?php
																						foreach($unReadInstructions as $inst){
											?>
											<li title="<?=trim($inst["title"])?>" onclick="readInstruction(<?=$inst['id']?>,'<?=$inst['title']?>',this)">
												<a href="javascript:;">
													<span class="inst-list-title"><?=$inst["title"]?></span>
													<span class="details">
														<span class="label label-sm label-icon label-success">
															<i class="fa fa-envelope"></i>
														</span>
													</span>
												</a>
											</li>
											
											<?php
																					}
											?>
										</ul>
									</li>
								</ul>
							</li>
							<!---- start Emails notifications---->
							<li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
								<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
									<i class="icon-bell"></i>
									<span class="badge badge-success">
									<?=sizeof($equip_notifications)?> </span>
								</a>
								<ul class="dropdown-menu">
									<li class="external">
										<h3><span class="bold"><?=sizeof($equip_notifications)?></span> Notifications</h3>
										<!----<a href="extra_profile.html">view all</a>--->
									</li>
									<li>
										<ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
											<?php
											foreach($equip_notifications as $notif){
												$notif_type = "";
																							$last_notif_arg = "";
																							if( ( ($notif["approved"] == 1) || ($notif["rejected"] == 1) ) && ($notif["atc_report"] == 0) ){
																								$notif_type = "approved_notif";
																								$last_notif_arg = 1;
																							}else if($notif["atc_report"] == 1){
																								$notif_type = "atc_report";
																								$last_notif_arg = 1;
																							}else if( ($notif["approved"] == 0) && ($notif["rejected"] == 0) && ($notif["atc_report"] == 0)  ){
																								$notif_type = "unapproved_notif";
																								$last_notif_arg = 0;
																							}
											?>
											
											
											<li notif_type = "<?=$notif_type?>" notif_id="<?=trim($notif["equip_notif_id"])?>" onclick="readNotification(<?=$notif["id"]?>,'<? print( strip_tags( substr($notif["any_other_details"], 0, 30) ) ); if(strlen(strip_tags($notif["any_other_details"])) > 30){ print("......."); }?>',this,<?=$notif["equip_notif_id"]?>,<?=$last_notif_arg?>)">
												<a href="javascript:;">
													<span class="inst-list-title">
														<?
														$notif["any_other_details"] = strip_tags($notif["any_other_details"]);
														print(substr($notif["any_other_details"], 0, 30));
														if(strlen($notif["any_other_details"]) > 30){
														print(".......");
														}
														?>
													</span>
													<span class="details">
														<span class="label label-sm label-icon label-success">
															<i class="fa fa-bell"></i>
														</span>
													</span>
												</a>
											</li>
											
											<?php
																					}
											?>
										</ul>
										
									</li>
									<li class="external">
										<a href="<?=base_url()?>elog/allnotification">View All Notifications</a>
										<br>
									</li>
								</ul>
							</li>
							<!----End Emails notifications---->
							
							
							<!-- END NOTIFICATION DROPDOWN -->
							<li class="separator hide">
							</li>
							<!-- BEGIN INBOX DROPDOWN -->
							<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
							
							<!-- END INBOX DROPDOWN -->
							<li class="separator hide">
							</li>
							<!-- BEGIN TODO DROPDOWN -->
							<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
							<!-----------------------send back notice ----------------------->
							<?php  $acppectednotis = $this->instructions_model->getapctancenoti(); ?>
							<li class="dropdown dropdown-extended dropdown-tasks dropdown-dark" id="header_task_bar">
								<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
									<i class="icon-calendar"></i>
									<span class="badge badge-primary">
									<?=sizeof($acppectednotis)?> </span>
								</a>
								<ul class="dropdown-menu extended tasks">
									
									<!---<li class="external">
											<h3>You have <span class="bold">12 pending</span> tasks</h3>
											<a href="page_todo.html">view all</a>
									</li>--->
									<li>
										
										<ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
											<?
											foreach($acppectednotis as $inst){
											?>
											<li inst_id = "<?=$inst["id"]?>" title="<?=trim($inst["error_text"])?>" onclick="readaceptancenoti(<?=$inst["id"]?>,'<?=$inst["error_text"]?>',this)">
												<a href="javascript:;">
													<span class="task">
														<span class="desc"><?=$inst["error_text"]?></span>
														<span class="percent">30%</span>
													</span>
													<span class="progress">
														<span style="width: 40%;" class="progress-bar progress-bar-success" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">40% Complete</span></span>
													</span>
												</a>
											</li>
											<?	}				      ?>
										</ul>
									</li>
								</ul>
							</li>
							<!-- END TODO DROPDOWN -->
							<!-- BEGIN USER LOGIN DROPDOWN -->
							<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
							<li class="dropdown dropdown-user dropdown-dark">
								<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
									<span class="username username-hide-on-mobile">
									<?=$this->userdetails["firstname"]." ".$this->userdetails["lastname"]?> <small>as <?=$this->userdetails["role"]?></small> </span>
									<!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
									<img alt="" class="img-circle" src="<?=base_url()?>assets/user-profile-images/<?=$this->userdetails["image"]?>"/>
									
								</a>
								<ul class="dropdown-menu dropdown-menu-default">
									<li>
										<a href="javascript:void(0);">
										<i class="icon-user"></i> My Profile </a>
									</li>
									
									<li class="divider">
									</li>
									<li>
										<a href="javascript:void(0);">
										<i class="icon-lock"></i> Lock Screen </a>
									</li>
									<li>
										<a href="<?=base_url()?>index/logout">
										<i class="icon-key"></i> Log Out </a>
									</li>
								</ul>
							</li>
							<!-- END USER LOGIN DROPDOWN -->
							<!-- BEGIN USER LOGIN DROPDOWN -->
							
							<!-- END USER LOGIN DROPDOWN -->
						</ul>
					</div>
					<!-- END TOP NAVIGATION MENU -->
					
				</div>
				<!-- END PAGE TOP -->
			</div>
			<!-- END HEADER INNER -->
		</div>
		<!-- END HEADER -->
		<div class="clearfix">
		</div>
		<!-- BEGIN CONTAINER -->
		<div class="page-container">
			<!-- BEGIN SIDEBAR -->
			<div class="page-sidebar-wrapper">
				<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
				<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
				<div class="page-sidebar navbar-collapse collapse">
					<!-- BEGIN SIDEBAR MENU -->
					<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
					<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
					<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
					<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
					<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
					<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
					
					
					
					
					<!-- // sidebar item - profile -->
					<?php
												
										$this->load->view("menus/admin_mainmenu");
												
					?>
					<!-- // sidebar menu -->
					
					
					
					<!-- END SIDEBAR MENU -->
				</div>
			</div>
			
			<!-- BEGIN CONTENT -->
			<div class="page-content-wrapper">
				<div class="page-content">
					<script type="text/javascript">
					var base_url = "<?=base_url()?>";
					var agentcode = '<?=$this->userdetails["agentcode"]?>';
					</script>
					<script type="text/javascript">
						
						$(document).ready(function(){
					<?if( ($this->uri->segment(3) == "success" ) || ($this->uri->segment(4) == "success" )|| ($this->uri->segment(5) == "success" ) ){?>
					showSuccessMessage("Successfully Added");
					<?}?>
					<?if( ( $this->uri->segment(3) == "updateSuccess" ) || ( $this->uri->segment(4) == "updateSuccess" ) || ( $this->uri->segment(5) == "updateSuccess" )){?>
					showSuccessMessage("Successfully Updated");
					<?}?>
					recordDashboardStatistics();
					});
					function recordDashboardStatistics(){
					var device = "";
					var browser = "";
					var device_category = "";
					var page = "<?=$page?>";
					var page_url = '<?=curPageURL()?>';
					var data = new Object();
					if((/windows/i.test(navigator.userAgent.toLowerCase()))){
					device = "Windows";
					device_category = "Desktop";
					}else if((/android/i.test(navigator.userAgent.toLowerCase()))){
					device = "Android";
					device_category = "Mobile";
					}else if((/webos/i.test(navigator.userAgent.toLowerCase()))){
					device = "WebOs";
					device_category = "Mobile";
					}else if((/iphone/i.test(navigator.userAgent.toLowerCase()))){
					device = "iPhone";
					device_category = "Mobile";
					}else if((/ipad/i.test(navigator.userAgent.toLowerCase()))){
					device = "iPad";
					device_category = "Mobile";
					}else if((/ipod/i.test(navigator.userAgent.toLowerCase()))){
					device = "iPod";
					device_category = "Mobile";
					}else if((/blackberry/i.test(navigator.userAgent.toLowerCase()))){
					device = "Black Berry";
					device_category = "Mobile";
					}else if((/iemobile/i.test(navigator.userAgent.toLowerCase()))){
					device = "IE Mobile";
					device_category = "Mobile";
					}
					if($.browser.chrome){
					browser = "Chrome";
					}else if($.browser.opera){
					browser = "Opera";
					}else if($.browser.mozilla){
					browser = "Mozilla Firefox";
					}else if($.browser.msie){
					browser = "Internet Explorer";
					}else if($.browser.webkit){
					browser = "Safari";
					}else if($.browser.safari){
					browser = "Safari";
					}else{
					browser = "Others";
					}
					data["device"] = device;
					data["device_category"] = device_category;
					data["browser"] = browser;
					data["page"] = page;
					data["page_url"] = page_url;
					<?
					if($referrer_domain != "10.10.18.59"){
					?>
					data["referrer_domain"] = '<?=$referrer_domain?>';
					<?
					}
					?>
					$.ajax({
					url:base_url+"index/recordDashboardStatistics",
					type:"post",
					data:data,
					success:function(res){
					console.log(res);
					}
					});
					}
					$("#jquery_jplayer_1").jPlayer({
					ready: function() {
					$(this).jPlayer("setMedia", {
					mp3: base_url+"assets/a.m4r"
					});
					},
					loop: false,
					swfPath: "/js"
					});
					<?
					if(isset($this->userdetails["permissions"]["getApprovedNotifications"])){
					?>
					setInterval(function(){
					var last_approved_notif_id = $("ul.dropdown-menu-list li[notif_type='approved_notif']").attr("notif_id");
					var postData = new Object();
					if(last_approved_notif_id == undefined){
					postData["last_approved_notif_id"] = "";
					}else{
					postData["last_approved_notif_id"] = last_approved_notif_id;
					}
					$.ajax({
					url:base_url+"instructions/getApprovedNotifications",
					type:"post",
					data:postData,
					success:function(res){
					
					$.each(jQuery.parseJSON(res),function(key,notif){
					var notif_html = 	'<li notif_type = "approved_notif" notif_id="'+$.trim(notif.equip_notif_id)+'" onclick="readNotification('+notif.id+',\''+stripHTML(notif.any_other_details)+'.......\',this,'+notif.equip_notif_id+',1)">'
						+'<span class="inst-list-title">'
							+stripHTML(notif.any_other_details)
						+'</span>'
					+'</li>';
					if($("ul.dropdown-menu-list").find("li").length == 0){
					console.log("no li found");
					$("ul.dropdown-menu-list").find("div.dropdown-menu-list").append(notif_html);
					incriment_notifications_number();
					}else{
					console.log("li found");
					$("ul.dropdown-menu-list li:nth-child(1)").before(notif_html);
					incriment_notifications_number();
					}
					});
					}
					});
					},10000);
					
					<?
					}
					?>
					<?
					if(isset($this->userdetails["permissions"]["getATCNotifications"])){
					?>
					setInterval(function(){
					var last_atc_notif_id = $("ul.dropdown-menu-list li[notif_type='atc_report']").attr("notif_id");
					
					var postData = new Object();
					if(last_atc_notif_id == undefined){
					postData["last_atc_notif_id"] = "";
					}else{
					postData["last_atc_notif_id"] = last_atc_notif_id;
					}
					$.ajax({
					url:base_url+"instructions/getATCNotifications",
					type:"post",
					data:postData,
					success:function(res){
					
					$.each(jQuery.parseJSON(res),function(key,notif){
					var notif_html = 	'<li notif_type = "atc_report" notif_id="'+$.trim(notif.equip_notif_id)+'" onclick="readNotification('+notif.id+',\''+stripHTML(notif.any_other_details)+'.......\',this,'+notif.equip_notif_id+','+notif.atc_report+')">'
						+'<span class="inst-list-title">'
							+stripHTML(notif.any_other_details)
						+'</span>'
					+'</li>';
					if($("ul.dropdown-menu-list").find("li").length == 0){
					console.log("no li found");
					$("ul.dropdown-menu-list").find("div.dropdown-menu-list").append(notif_html);
					incriment_notifications_number();
					}else{
					console.log("li found");
					$("ul.dropdown-menu-list li:nth-child(1)").before(notif_html);
					incriment_notifications_number();
					}
					});
					}
					});
					},10000);
					<?
					}
					?>
					<?
					if(isset($this->userdetails["permissions"]["approve_equipment_release"])){
					
					?>
					setInterval(function(){
					
					var last_unapproved_notif_id = $("ul.dropdown-menu-list li[notif_type='unapproved_notif']").attr("notif_id");
					
					var postData = new Object();
					if(last_unapproved_notif_id == undefined){
					postData["last_unapproved_notif_id"] = "";
					}else{
					postData["last_unapproved_notif_id"] = last_unapproved_notif_id;
					}
					$.ajax({
					url:base_url+"instructions/getUnApprovedNotifications",
					type:"post",
					data:postData,
					success:function(res){
					
					$.each(jQuery.parseJSON(res),function(key,notif){
					var notif_html = 	'<li notif_type = "unapproved_notif" notif_id="'+$.trim(notif.equip_notif_id)+'" onclick="readNotification('+notif.id+',\''+stripHTML(notif.any_other_details)+'.......\',this,'+notif.equip_notif_id+','+notif.atc_report+')">'
						+'<span class="inst-list-title">'
							+stripHTML(notif.any_other_details)
						+'</span>'
					+'</li>';
					if($("ul.dropdown-menu-list").find("li").length == 0){
					console.log("no li found");
					$("ul.dropdown-menu-list").find("div.dropdown-menu-list").append(notif_html);
					incriment_notifications_number();
					}else{
					console.log("li found");
					$("ul.dropdown-menu-list li:nth-child(1)").before(notif_html);
					incriment_notifications_number();
					}
					});
					}
					});
					},10000);
					<?
					}
					?>
					setInterval(function(){
					var last_inst_id = $("ul.dropdown-menu-list li").attr("inst_id");
					// console.log(last_unapproved_notif_id);
					var postData = new Object();
					if(last_inst_id == undefined){
					postData["last_inst_id"] = "";
					}else{
					postData["last_inst_id"] = last_inst_id;
					}
					$.ajax({
					url:base_url+"instructions/getInstructions",
					type:"post",
					data:postData,
					success:function(res){
					
					console.log(res);
					
					$.each(jQuery.parseJSON(res),function(key,inst){
					
					var inst_html = '<li inst_id = "'+inst.id+'" title="'+$.trim(inst.title)+'" onclick="readInstruction('+inst.id+',\''+inst.title+'\',this)">'
						+'<span class="inst-list-title">'+inst.title+'</span>'
					+'</li>';
					if($("ul.dropdown-menu-list").find("li").length == 0){
					console.log("no li found");
					$("ul.dropdown-menu-list").find("div.dropdown-menu-list").append(inst_html);
					incriment_instructions_number();
					}else{
					console.log("li found");
					$("ul.dropdown-menu-list li:nth-child(1)").before(inst_html);
					incriment_instructions_number();
					}
					});
					}
					});
					},10000);
					function stripHTML(dirtyString) {
					var container = document.createElement('div');
					container.innerHTML = dirtyString;
					var html_text = container.textContent || container.innerText;
					return html_text.substring(0, 30);
					}
					function incriment_notifications_number(){
					var num_of_notif = parseInt($(".num-of-notif").html());
					$(".num-of-notif").html(num_of_notif+1);
					$("#jquery_jplayer_1").jPlayer("play");
					}
					function incriment_instructions_number(){
					var num_of_inst = parseInt($(".num-of-inst").html());
					$(".num-of-inst").html(num_of_inst+1);
					$("#jquery_jplayer_1").jPlayer("play");
					}
					</script>
					<script type="text/javascript">
					tday=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
					tmonth=new Array("January","February","March","April","May","June","July","August","September","October","November","December");
					function GetClock(){
					var d=new Date();
					var nday=d.getDay(),nmonth=d.getMonth(),ndate=d.getDate(),nyear=d.getYear();
					if(nyear<1000) nyear+=1900;
					var nhour=d.getHours(),nmin=d.getMinutes(),nsec=d.getSeconds(),ap;
					if(nhour==0){ap=" AM";nhour=12;}
					else if(nhour<12){ap=" AM";}
					else if(nhour==12){ap=" PM";}
					else if(nhour>12){ap=" PM";nhour-=12;}
					if(nmin<=9) nmin="0"+nmin;
					if(nsec<=9) nsec="0"+nsec;
					document.getElementById('clockbox').innerHTML= + nday + ""+nhour+":"+nmin+":"+nsec+ap+" ";
					}
					window.onload=function(){
					GetClock();
					setInterval(GetClock,1000);
					}
					</script>
					<script>
						function date_time(id)
					{
					date = new Date;
					year = date.getFullYear();
					month = date.getMonth();
					months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
					d = date.getDate();
					day = date.getDay();
					days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
					h = date.getHours();
					if(h<10)
					{
					h = "0"+h;
					}
					m = date.getMinutes();
					if(m<10)
					{
					m = "0"+m;
					}
					s = date.getSeconds();
					if(s<10)
					{
					s = "0"+s;
					}
					result = ''+days[day]+' '+months[month]+' '+d+' '+year+' '+h+':'+m+':'+s;
					document.getElementById(id).innerHTML = result;
					setTimeout('date_time("'+id+'");','1000');
					return true;
					}
					</script>
					<script type="text/javascript">window.onload = date_time('date_time');</script>

					<script type="text/javascript" src="<?=base_url()?>assets/global/plugins/bootstrap-clockpicker.min.js"></script>