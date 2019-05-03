<!-- // page head -->
<style>
	.ui-widget-header{
		background: #45b6af !important;
		border:1px solid #45b6af;
	}
</style>
<div id="permissions-tabs">
	<ul>
		<?
		foreach($agentroles as $key=>$role){
		if($role["id"] != 1){
		?>
		<li><a style="color: black !important;" href="#<?=str_replace(" ","-",$role["role"])?>"><?=ucfirst($role["role"])?></a></li>
		<?
		}
		}
		?>
	</ul>
	<?
	foreach($agentroles as $key=>$role){
	if($role["id"] != 1){
	$permissions = unserialize($role["rights"]);
	?>
	<div id="<?=str_replace(" ","-",$role["role"])?>" class="tab-content">
		<h2><?=ucfirst($role["role"])?></h2>
		<a href="javascript:void(0);" class="btn btn-success checkAll" onclick="checkAll(this);">Check All</a>
		<a href="javascript:void(0);" class="btn btn-success uncheckAll" onclick="unCheckAll(this);">Uncheck All</a>
		<br><br>
		<form class="permissions-list">
			<input type="hidden" name="id" value="<?=$role["id"]?>"/>
			<?
			if(empty($permissions)){
			$permissions = array();
			}
			// print_r($permissions);
			?>
			<ul style="list-style:;">
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>Add Inspection Entry</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="add_inspection_entry" <?if(isset($permissions["add_inspection_entry"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>Add Staff Absence</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="add_staff_absence" <?if(isset($permissions["add_staff_absence"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>View Only Fault Reports</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="only_fault_reports" <?if(isset($permissions["only_fault_reports"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>Add Emergency Logs</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="add_emergency_logs" <?if(isset($permissions["add_emergency_logs"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>Add General Entry Logs</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="add_generalentry_logs" <?if(isset($permissions["add_generalentry_logs"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>Add Fault Reporting</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="add_fault_reporting" <?if(isset($permissions["add_fault_reporting"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>Add Equipment Release</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="add_equipment_release" <?if(isset($permissions["add_equipment_release"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>Add Aircraft Diversion</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="add_aircraft_diversion" <?if(isset($permissions["add_aircraft_diversion"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>Control Mobile</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="control_mobile" <?if(isset($permissions["control_mobile"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>Update Runway In Use</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="runway_inuse" <?if(isset($permissions["runway_inuse"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>Accept FRN</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="accept_frn" <?if(isset($permissions["accept_frn"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>Add Domain Parameters</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="add_domain_parameters" <?if(isset($permissions["add_domain_parameters"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>Add Instructions</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="add_instructions" <?if(isset($permissions["add_instructions"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>View Instructions</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="view_instructions" <?if(isset($permissions["view_instructions"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>Generate Reports</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="generate_reports" <?if(isset($permissions["generate_reports"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>Approve/Reject Equipment Release</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="approve_equipment_release" <?if(isset($permissions["approve_equipment_release"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>Get ATC Notifications</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="getATCNotifications" <?if(isset($permissions["getATCNotifications"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>Refresh Main view after 30 seconds</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="refresh_mainview" <?if(isset($permissions["refresh_mainview"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>Get Approved/Rejected Equipment Release Notifications</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="getApprovedNotifications" <?if(isset($permissions["getApprovedNotifications"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>Access Management Comments Field in log view</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="access_management_field" <?if(isset($permissions["access_management_field"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>Access Unit Comments Field in log view</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="access_actions_field" <?if(isset($permissions["access_actions_field"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>Update Faults</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="Update_Fault" <?if(isset($permissions["Update_Fault"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>Cancel Faults</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="Cancel_Fault" <?if(isset($permissions["Cancel_Fault"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>Accept Fault</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="Accept_Fault" <?if(isset($permissions["Accept_Fault"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>Sent It Back</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="Send_it_back" <?if(isset($permissions["Send_it_back"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>Transfer Fault</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="Transfer_fault" <?if(isset($permissions["Transfer_fault"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>Close Job</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="Close_jobs" <?if(isset($permissions["Close_jobs"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>List of Jobs</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="List_Job" <?if(isset($permissions["List_Job"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>View Runways on Dashboard</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="View_Runways" <?if(isset($permissions["View_Runways"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>Add Initiate LVO</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="Add_InitiateLVO" <?if(isset($permissions["Add_InitiateLVO"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>Add LVO Safeguarding </label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="Add_LVOSafeguarding" <?if(isset($permissions["Add_LVOSafeguarding"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>Add Runway in Use</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="Add_Runways" <?if(isset($permissions["Add_Runways"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>Add MET Condition</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="Add_METCondition" <?if(isset($permissions["Add_METCondition"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>View MET Condition on Dashboard</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="ViewMETCondition" <?if(isset($permissions["ViewMETCondition"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>View AMAN on Dashboard</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="ViewAMANDashboard" <?if(isset($permissions["ViewAMANDashboard"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>Add ATE Comments Field in log view</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="AddATE" <?if(isset($permissions["AddATE"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>Add Return to Service Button</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="AddRts" <?if(isset($permissions["AddRts"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<div class="row">
					<li>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<label>Approve/Reject Button in Equipment Release Log</label>
						</div>
						<div class="col-sm-6 col-md-6 col-xs-6">
							<input type="checkbox" name="AppRej" <?if(isset($permissions["AppRej"])){?>checked="checked"<?}?>/>
						</div>
					</li>
				</div>
				<hr>
				
				
				<input type="submit" class="btn btn-danger" value="Update"/>
				
				
				
				
				
				
				
				
				
			</ul>
			
		</form>
	</div>
	<?
	}
	}
	?>
</div>
<script>
$('.checkAll').click(function(){
	alert("check");
	$(this).parent().find('input[type="checkbox"]').attr('checked','checked');
	$(this).parent().find('span').addClass('checked');
});
$('.uncheckAll').click(function(){
	alert("uncheck");
	$(this).parent().find('input[type="checkbox"]').removeAttr('checked');
	$(this).parent().find('span').removeClass('checked');
});
function checkAll(curr_elem){


}
function unCheckAll(curr_elem){
$(curr_elem).parent().find('input[type="checkbox"]');
}
</script>