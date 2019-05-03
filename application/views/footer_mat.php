</div>
</div>
<!-- END CONTENT -->

<div class="page-footer">
<div class="page-footer-inner">
2019 &copy; Powered by dans ATMS. <a href="#" title="#" target="_blank"></a>
</div>
<div class="scroll-to-top">
<i class="icon-arrow-up"></i>
</div>
</div>
<script src="<?=base_url()?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?=base_url()?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<script type="text/javascript" src="<?=base_url()?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?=base_url()?>assets/global/plugins/scripts.js" type="text/javascript"></script>
<?php
	if(!empty($_GET) && isset($_GET["log_id"]) && ($_GET["log_id"] != "")){
		
		$logdetails = $this->db->get_where("emergency_formdata",array("id"=>$_GET["log_id"]))->result_array();
?>
<script type="text/javascript">
	$(document).ready(function(){
<?=strtolower(str_replace("(","",str_replace(")","",str_replace(" ","",$logdetails[0]["type_of_incident"]))))?>(<?=$logdetails[0]["id"]?>,this,'<?=$logdetails[0]["type_of_incident"]?>',true);
interval = setInterval(function(){
if(!$(".call-email-status").is(":visible")){
clearInterval(interval);
}else{
updateCallsStatus(<?=$_GET["log_id"]?>);
}
},5000);
});
</script>
<?php
	}
?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=base_url()?>assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui.min.js for drag & drop support -->
<script src="<?=base_url()?>assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=base_url()?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin/layout4/scripts/layout.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin/layout2/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin/layout4/scripts/demo.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin/pages/scripts/index3.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=base_url()?>/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?=base_url()?>assets/admin/pages/scripts/components-pickers.js"></script>
<script type="text/javascript">
function display_c(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('display_ct()',refresh)
}
function display_ct() {
var x = new Date()
document.getElementById('ct').innerHTML = x;
display_c();
}
</script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {
ComponentsPickers.init();
Metronic.init(); // init metronic core componets
Layout.init(); // init layout
Demo.init(); // init demo features
QuickSidebar.init(); // init quick sidebar
Index.init(); // init index page
Tasks.initDashboardWidget(); // init tash dashboard widget
ComponentsPickers.init();
});
</script>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Wait......</h4>
	</div>
	<div class="modal-body">
		<p>Wait.......</p>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
</div>

</div>
</div>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>