<?php
function curPageURL() {
$pageURL = 'http';
// if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
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
// print(curPageURL());
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
		// print_r($InstTack);
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
<html>
	<head>
		<script type="text/javascript">
		var base_url = "<?=base_url()?>";
		var agentcode = '<?=$this->userdetails["agentcode"]?>';
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
									<input id="globalSearch" class="search-query input-medium" type="search" style="display:block!important;">
									<a class="search-button" href="javascript:void(0);"><i class="fontello-icon-search-5"></i></a> </div>
									<div class="nav-collapse collapse">
										<ul class="nav user-menu visible-desktop">
											<!-- Instructions list start -->
											<li>
												<a class="btn-glyph fontello-icon-edit tip-bc inst-list-open" href="javascript:void(0);" title="">
													<span class="badge badge-important num-of-inst"><?=sizeof($unReadInstructions)?></span>
												</a>
												<ul class="instructions-list" >
													
													<?php
														foreach($unReadInstructions as $inst){
													?>
													<li title="<?=trim($inst["title"])?>" onclick="readInstruction(<?=$inst["id"]?>,'<?=$inst["title"]?>',this)">
														<span class="inst-list-title"><?=$inst["title"]?></span>
														
													</li>
													<?php
														}
													?>
													
													
												</ul>
											</li>
											<!-- Instructions list start -->
											
											<li><a class="btn-glyph fontello-icon-mail-1 tip-bc" href="javascript:void(0);" title="Emails"></a></li>
											
											<!-- equipment release notifications list start -->
											<li>
												<a class="btn-glyph fontello-icon-lifebuoy tip-bc equip-notif-open" href="javascript:void(0);" title="">
													<span class="badge badge-important num-of-notif"><?=sizeof($equip_notifications)?></span>
												</a>
												<ul class="notifications-list" >
													<?php
														foreach($equip_notifications as $notif){
													?>
													<li notif_id="<?=trim($notif["equip_notif_id"])?>" onclick="readNotification(<?=$notif["id"]?>,'<?php print( strip_tags( substr($notif["any_other_details"], 0, 30) ) ); if(strlen(strip_tags($notif["any_other_details"])) > 30){ print("......."); }?>',this,<?=$notif["equip_notif_id"]?>,<?=$notif["atc_report"]?>)">
														<span class="inst-list-title">
															<?
															$notif["any_other_details"] = strip_tags($notif["any_other_details"]);
															print(substr($notif["any_other_details"], 0, 30));
															if(strlen($notif["any_other_details"]) > 30){
															print(".......");
															}
															?>
														</span>
														
													</li>
													<?php
														}
													?>
												</ul>
											</li>
											<!-- equipment release notifications list start -->
											
											<?php if($this->userdetails["role"]=="CNS-Engineer"){ ?>
											
											<li>
												<a class="btn-glyph fontello-icon-lifebuoy tip-bc fault-rep-open" href="javascript:void(0);" title="">
													
												</a>
												<ul class="fault-list" >
													
													<script type="text/javascript">
													setInterval(function(){
													$('#load_content').load(base_url+'report/tables');
													}, 1000);
													
													</script>
													
													<div id="load_content" style="color:#fff;">Loading		</div>
												</ul>
											</li>			<? }else {}?>
											<!-----------------------send back notice ----------------------->
											<?php  $acppectednotis = $this->instructions_model->getapctancenoti(); ?> 								                <li>	<a class="btn-glyph fontello-icon-lifebuoy tip-bc sendbacknoticed" href="javascript:void(0);" title="">    <span class="badge badge-important num-of-sndbck"><?=sizeof($acppectednotis)?></span>    </a>		    <ul class="sendbacknoticed-list" >					<?					foreach($acppectednotis as $inst){					?>				<li inst_id = "<?=$inst["id"]?>" title="<?=trim($inst["error_text"])?>" onclick="readaceptancenoti(<?=$inst["id"]?>,'<?=$inst["error_text"]?>',this)">			    <span class="inst-list-title"><?=$inst["error_text"]?></span>				</li>				<?	}				      ?>																																</ul>			</li>																<!-- equipment release notifications list start -->
											
										</ul>
										
										
										
										<ul class="nav">
											<li class="active"> <a href="<?=base_url()?>">Home</a> </li>
											
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
							<div class="media profile" style="padding-left: 1%;padding-bottom: 15%;">
								<div class="media-thumb media-left thumb-bordereb"> <a class="img-shadow" href="javascript:void(0);"><img class="thumb" src="<?=base_url()?>assets/user-profile-images/<?=$this->userdetails["image"]?>"></a> </div>
								<div class="media-body">
									<h5 class="media-heading"><?=$this->userdetails["firstname"]." ".$this->userdetails["lastname"]?> <small>as <?=$this->userdetails["role"]?></small></h5>
									<p class="data">Last Access: <?=date("d M Y, h:i a",strtotime($this->userdetails["last_access"]))?></p>
									<span style="
										margin: 0;
										padding: 0;
										float: left;
										width: 36%;
										"><a href="<?=base_url()?>index/logout" class="btn btn-red">Logout</a></span>
									</div>
								</div>
							</div>
							<!-- // sidebar item - profile -->
							<?php
														
															$this->load->view("menus/admin_mainmenu");
														
							?>
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
								// alert("sript tag");
								$(document).ready(function(){
							<? if( ($this->uri->segment(3) == "success" ) || ($this->uri->segment(4) == "success" )|| ($this->uri->segment(5) == "success" ) ){?>
							showSuccessMessage("Successfully Added");
							<?}?>
							<? if( ( $this->uri->segment(3) == "updateSuccess" ) || ( $this->uri->segment(4) == "updateSuccess" ) || ( $this->uri->segment(5) == "updateSuccess" )){?>
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
							<?
							if(isset($this->userdetails["permissions"]["getApprovedNotifications"])){
							?>
							setInterval(function(){
							var last_approved_notif_id = $("ul.notifications-list li[notif_type='approved_notif']").attr("notif_id");
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
							if($("ul.notifications-list").find("li").length == 0){
							console.log("no li found");
							$("ul.notifications-list").find("div.mCSB_container").append(notif_html);
							incriment_notifications_number();
							}else{
							console.log("li found");
							$("ul.notifications-list li:nth-child(1)").before(notif_html);
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
							var last_atc_notif_id = $("ul.notifications-list li[notif_type='atc_report']").attr("notif_id");
							
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
							if($("ul.notifications-list").find("li").length == 0){
							console.log("no li found");
							$("ul.notifications-list").find("div.mCSB_container").append(notif_html);
							incriment_notifications_number();
							}else{
							console.log("li found");
							$("ul.notifications-list li:nth-child(1)").before(notif_html);
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
							var last_unapproved_notif_id = $("ul.notifications-list li[notif_type='unapproved_notif']").attr("notif_id");
							
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
							if($("ul.notifications-list").find("li").length == 0){
							console.log("no li found");
							$("ul.notifications-list").find("div.mCSB_container").append(notif_html);
							incriment_notifications_number();
							}else{
							console.log("li found");
							$("ul.notifications-list li:nth-child(1)").before(notif_html);
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
							var last_inst_id = $("ul.instructions-list li").attr("inst_id");
							
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
							// console.log("ATC");
							console.log(res);
							// return;
							$.each(jQuery.parseJSON(res),function(key,inst){
							
							var inst_html = '<li inst_id = "'+inst.id+'" title="'+$.trim(inst.title)+'" onclick="readInstruction('+inst.id+',\''+inst.title+'\',this)">'
								+'<span class="inst-list-title">'+inst.title+'</span>'
							+'</li>';
							if($("ul.instructions-list").find("li").length == 0){
							console.log("no li found");
							$("ul.instructions-list").find("div.mCSB_container").append(inst_html);
							incriment_instructions_number();
							}else{
							console.log("li found");
							$("ul.instructions-list li:nth-child(1)").before(inst_html);
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