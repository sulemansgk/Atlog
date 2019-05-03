<ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
	<li class="start active ">
		
		<a href="<?=base_url().'index/dashboard'?>">
			<i class="icon-home"></i>
			<span class="title">Home</span>
		</a>
	</li>
	
	
	<?
	if(isset($this->userdetails["permissions"]["Add_New_Job"]) && ($this->userdetails["role_id"] != 1)){
	?>
	
	<li class=" <?if($this->uri->segment(2) == "addevent"){ print("active"); }?>">
		
		<a href="<?=base_url()?>index/jobcards"class="accordion-toggle">
			
			<i class="icon-basket"></i>
			<span class="title">Add New job </span>
			
		</a>
		
		<ul class="accordion-content nav nav-list collapse in" id="accDash">
		</ul>
	</li>
	
	<? }?>
	
	
	<?
	if(isset($this->userdetails["permissions"]["List_Job"]) && ($this->userdetails["role_id"] != 1)){
	?>
	<li class="<?if($this->uri->segment(2) == "addevent"){ print("active"); }?>">
		
		<a href="<?=base_url()?>index/listingpanel"class="accordion-toggle">
			<i class="fa fa-list"></i>
			<span class="title">List Of Jobs </span>
			
		</a>
		
		<ul class="accordion-content nav nav-list collapse in" id="accDash">
		</ul>
	</li>
	<? }?>
	
	
	<li>
		<?
		if(isset($this->userdetails["permissions"]["only_fault_reports"]) && ($this->userdetails["role_id"] != 1)){
		?>
		
		<?
		if($this->uri->segment(1) != "elog"){
		?>
		<a href="<?=base_url()?>elog/mainview/faultreports" class="accordion-toggle">
			<?
			}else{
			?>
			<a href="#accTables" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle">
				<?
				}
				?>
				
				<i class="fa fa-exclamation-circle"></i>
				<span class="title">Faults </span>
				<span class="arrow "></span>
				
			</a>
			
			<?
			}else{
			?>
			<a href="<?=base_url()?>elog/mainview">
				<i class="icon-basket"></i>
				<span class="title">E-Log</span>
				<span class="arrow "></span>
			</a>
			<? } ?>
			<ul class="sub-menu <?if($this->uri->segment(2) == "mainview"){ print(" in"); }?>">
				
				<?
				if(isset($this->userdetails["permissions"]["only_fault_reports"]) && ($this->userdetails["role_id"] != 1)){
				?>
				<li> <a href="<?=base_url()?>elog/mainview/faultreports"> <i ></i> Fault Reports</a> </li>
				<?
				}else{
				?>
				<li>
					<a href="<?=base_url()?>elog/mainview">
						<i ></i>
					Main View</a>
				</li>
				<? } ?>
				
				<?
				if(isset($this->userdetails["permissions"]["add_generalentry_logs"]) || ($this->userdetails["role_id"] == 1)){
				?>
				<li>
					<a href="<?=base_url()?>elog/generalentry">
						<i ></i>
					General Entry</a>
				</li>
				<? } ?>
				
				<?
				if(isset($this->userdetails["permissions"]["add_fault_reporting"]) || ($this->userdetails["role_id"] == 1)){
				?>
				<li>
					<a href="<?=base_url()?>elog/faultReporting">
						<i ></i>
					Fault Reporting</a>
				</li>
				<?  } ?>
				
				<?
				if(isset($this->userdetails["permissions"]["add_equipment_release"]) || ($this->userdetails["role_id"] == 1)){
				?>
				<li>
					<a href="<?=base_url()?>elog/equipmentRelease">
						<i ></i>
					Equipment Release</a>
				</li><? } ?>
				
				
				<?
				if(isset($this->userdetails["permissions"]["add_aircraft_diversion"]) || ($this->userdetails["role_id"] == 1)){
				?>
				<li>
					<a href="<?=base_url()?>elog/aircraftDiversion">
						<i ></i>
					Aircraft Diversion</a>
				</li><? } ?>
				
				<?
				if(isset($this->userdetails["permissions"]["control_mobile"]) || ($this->userdetails["role_id"] == 1)){
				?>
				<li>
					<a href="<?=base_url()?>elog/controlmobile">
						<i ></i>
					Control Mobile In/Out</a>
				</li>
				<? } ?>
				
				
				<? if(isset($this->userdetails["permissions"]["Add_Runways"]) || ($this->userdetails["role"] == "admin")){ ?>
				<li>
					<a href="<?=base_url()?>elog/runwayInUse2">
						<i ></i>
					Runway In Use </a>
				</li><? }  ?>
				
				<?
				if(isset($this->userdetails["permissions"]["add_inspection_entry"]) || ($this->userdetails["role_id"] == 1) ){
				?>
				<li class="last ">
					<a href="javascript:;">
						<i ></i>
						<span class="title">Inspection Entry</span>
						<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="<?=base_url()?>elog/RunwayManoeuvringArea">
							RWY/Manoeuvring Inspection</a>
						</li>
						
						<li>
							<a href="<?=base_url()?>elog/agl">
							AGL Inspection</a>
						</li>
						
					</ul>
				</li>
				<?
				}
				?>
				
				
				<?
				if(isset($this->userdetails["permissions"]["add_staff_absence"]) || ($this->userdetails["role_id"] == 1) ){
				?>
				<li class="last ">
					<a href="javascript:;">
						<i ></i>
						<span class="title">Staff Absense</span>
						<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="<?=base_url()?>elog/NoShow">
							No Show</a>
						</li>
						<li>
							<a href="<?=base_url()?>elog/LateForDuty">
							Late For Duty</a>
						</li>
						<li>
							<a href="<?=base_url()?>elog/SentHome">
							Sent Home</a>
						</li>
						<li>
							<a href="<?=base_url()?>elog/UnavailableForDuty">
							Unavailable For Duty</a>
						</li>
						<li>
							<a href="<?=base_url()?>elog/SicknessForDuty">
							Sickness For Duty</a>
						</li>
						<li>
							<a href="<?=base_url()?>elog/FitnessOrReturnForDuty">
							Fitness Or Return For Duty</a>
						</li>
					</ul>
				</li>
				<?
				}
				?>
				<!------------------------------------------here code of lvo -------------------------------->
				<?
				if(isset($this->userdetails["permissions"]["Add_InitiateLVO"]) || ($this->userdetails["role_id"] == 1)){
				?>
				<li>
					<a href="<?=base_url()?>elog/InitiateLVO">
						<i ></i>
					Initiate LVO</a>
				</li>
				<?
				}
				?>
				<?
				if(isset($this->userdetails["permissions"]["Add_LVOSafeguarding"]) || ($this->userdetails["role_id"] == 1)){
				?>
				<li>
					<a href="<?=base_url()?>elog/LVOSafeguarding">
						<i ></i>
					LVO Safeguarding</a>
				</li>
				<? }
				if(isset($this->userdetails["permissions"]["Add_METCondition"]) || ($this->userdetails["role_id"] == 1)){
				?>
				
				<li>
					<a href="<?=base_url()?>elog/MetCondition">
						<i ></i>
					MET Conditions</a>
				</li>
				<?php }?>
			</ul>
		</li>
		
		
		
		
		
		
		<?
		if(isset($this->userdetails["permissions"]["add_emergency_logs"]) || ($this->userdetails["role_id"] == 1) ){
		?>
		<li class="last <?if($this->uri->segment(1) == "emergency"){ print("active"); }?>">
			<a href="javascript:;">
				<i class="fa fa-plus"></i>
				<span class="title">Emergencies</span>
				<span class="arrow "></span>
			</a>
			<ul class="sub-menu <?if($this->uri->segment(1) == "emergency"){ print("in"); }?>">
				<li>
					<a href="<?=base_url()?>emergency/aircraftcrash">
					Aircraft Crash</a>
				</li>
				<li>
					<a href="<?=base_url()?>emergency/aircraftgroundincident">
					Aircraft Ground Incident</a>
				</li>
				<li>
					<a href="<?=base_url()?>emergency/Bombwarning">
					Bomb Warning</a>
				</li>
				<li>
					<a href="<?=base_url()?>emergency/domesticfire">
					Domestic Fire </a>
				</li>
				<li>
					<a href="<?=base_url()?>emergency/FUELSPILLAGE">
					Fuel Spillage</a>
				</li>
				<li>
					<a href="<?=base_url()?>emergency/fullemergency">
					Full Emergency</a>
				</li>
				<li>
					<a href="<?=base_url()?>emergency/localstandby">
					Local Standby</a>
				</li>
				<li>
					<a href="<?=base_url()?>emergency/medicalemergency">
					Medical Emergency</a>
				</li>
				
				<li>
					<a href="<?=base_url()?>emergency/UnlawfulInteference">
					Unlawful Interference</a>
				</li>
				<li>
					<a href="<?=base_url()?>emergency/WeatherStandby">
					Weather Standby</a>
				</li>
				<li>
					<a href="<?=base_url()?>emergency/practiseemergency">
					Practice Emergency</a>
				</li>
				
			</ul>
		</li>
		<? } ?>
		
		<?
		
		if(isset($this->userdetails["permissions"]["add_domain_parameters"]) || ($this->userdetails["role_id"] == 1) ){
		?>
		<li class="last <?if($this->uri->segment(1) == "domainparameters"){ print("active"); }?>">
			<a href="javascript:;">
				<i class="fa fa-paper-plane-o"></i>
				<span class="title">Domain Parameters</span>
				<span class="arrow "></span>
			</a>
			<ul class="sub-menu <?if($this->uri->segment(1) == "domainparameters"){ print("in"); }?>">
				<li>
					<a href="<?=base_url()?>domainparameters/SubjectForm">
					Subject Form</a>
				</li>
				<li>
					<a href="<?=base_url()?>domainparameters/PositionName">
					Position Name</a>
				</li>
				<li>
					<a href="<?=base_url()?>domainparameters/EquipmentName">
					Equipment Name</a>
				</li>
				<li>
					<a href="<?=base_url()?>domainparameters/ConsoleNumber">
					Console Number</a>
				</li>
				<li>
					<a href="<?=base_url()?>domainparameters/ReleasePurpose">
					Release Purpose</a>
				</li>
				<li>
					<a href="<?=base_url()?>domainparameters/AircraftType">
					Aircraft Type</a>
				</li>
				<li>
					<a href="<?=base_url()?>domainparameters/Airport">
					Airport</a>
				</li>
				<li>
					<a href="<?=base_url()?>domainparameters/Shift">
					Shift</a>
				</li>
				<li>
					<a href="<?=base_url()?>domainparameters/StaffAbsenseReason">
					Staff Absense Reason</a>
				</li>
				<li>
					<a href="<?=base_url()?>domainparameters/RunwayManoeuvringArea">
					Runway/Manoeuvring Area</a>
				</li>
				<li>
					<a href="<?=base_url()?>domainparameters/Nationality">
					Nationality</a>
				</li>
				<li>
					<a href="<?=base_url()?>domainparameters/Designation">
					Designation</a>
				</li>
				<li>
					<a href="<?=base_url()?>domainparameters/Company">
					Company</a>
				</li>
				<li>
					<a href="<?=base_url()?>domainparameters/instructionType">
					Instruction Type</a>
				</li>
				<li>
					<a href="<?=base_url()?>domainparameters/email">
					Email</a>
				</li>
				<li>
					<a href="<?=base_url()?>domainparameters/phone">
					Phone</a>
				</li>
				<li>
					<a href="<?=base_url()?>domainparameters/runway">
					Runway</a>
				</li>
				
				<li>
					<a href="<?=base_url()?>domainparameters/latestfrequency">
					Frequency</a>
				</li>
				<li>
					<a href="<?=base_url()?>domainparameters/latestLRU">
					LRU</a>
				</li>
				<li>
					<a href="<?=base_url()?>domainparameters/latestcalibrationitem">
					Calibration Item</a>
				</li>
				
				<li>
					<a href="<?=base_url()?>domainparameters/latestparajob">
					Job Card</a>
				</li>
				<li>
					<a href="<?=base_url()?>domainparameters/othersection">
					Other Section</a>
				</li>
			</ul>
		</li>
		<?
		}
		?>
		<!-- // item accordionMenu Components -->
		<?
		if(isset($this->userdetails["permissions"]["view_instructions"]) || ($this->userdetails["role_id"] == 1) || ($this->userdetails["permissions"]["add_instructions"]) ){
		?>
		<li class="last ">
			<a href="javascript:;">
				<i class="fa fa-file-text-o"></i>
				<span class="title">Documents</span>
				<span class="arrow "></span>
			</a>
			<ul class="sub-menu">
				<? if (isset(($this->userdetails["permissions"]["add_instructions"])) || ($this->userdetails["role_id"] == 1)) { ?>
				<li>
					<a href="<?=base_url()?>instructions/AddIns">
					Add Instructions</a>
				</li>
				<?	} ?>
				<? if (isset($this->userdetails["permissions"]["view_instructions"]) || ($this->userdetails["role_id"] == 1)) { ?>
				<li>
					<?
					$instructionTypes = $this->instructions_model->getAllInstructionsTypes();
					foreach($instructionTypes as $insttype){
					?>
					<li> <a href="<?=base_url()?>instructions/viewInstructions/<?=str_replace(" ","-",$insttype["name"])."/".$insttype["id"]?>"> <i class="fontello-icon-right-dir"></i> <?=$insttype["name"]?> </a> </li>
					<?
					}
					?>
				</li>
				<? } ?>
				
				
			</ul>
		</li>
		<?
		}
		?>
		
		
		<?
		if(isset($this->userdetails["permissions"]["generate_reports"]) || ($this->userdetails["role_id"] == 1) ){
		?>
		
		<li class="last <?if($this->uri->segment(1) == "report"){ print("active"); }?>">
			<a href="javascript:;">
				<i class="fa fa-files-o"></i>
				<span class="title">Reports</span>
				<span class="arrow "></span>
			</a>
			<ul class="sub-menu <?if($this->uri->segment(1) == "report"){ print("in"); }?>">
				<li>
					<a href="<?=base_url()?>report/DailyReport">
					Daily Report</a>
				</li>
				<li>
					<a href="<?=base_url()?>report/SupervisorReport">
					Supervisor Report</a>
				</li>
				<li>
					<a href="<?=base_url()?>report/ManagementReport">
					Management Report</a>
				</li>
				<li>
					<a href="<?=base_url()?>report/FaultReport">
					Fault Report</a>
				</li>
				<li>
					<a href="<?=base_url()?>report/GeneralReport">
					General Report</a>
				</li>
				<li>
					<a href="<?=base_url()?>report/InstructionsReport">
					Instruction Report</a>
				</li>
				
			</ul>
		</li>
		<?
		}
		?>
		<?
		if($this->userdetails["role_id"] == 1){
		?>
		<li class="last <?if(strstr(strtolower($this->uri->segment(2)),"user") || ( $this->uri->segment(2) == "permissions")){ print("active"); }?>">
			<a href="javascript:;">
				<i class="fa fa-files-o"></i>
				<span class="title">User Management </span>
				<span class="arrow "></span>
			</a>
			<ul class="sub-menu <?if(strstr(strtolower($this->uri->segment(2)),"user") || ( $this->uri->segment(2) == "permissions") || ( $this->uri->segment(2) == "units") ){ print("in"); }?>">
				<li <?if($this->uri->segment(2) == "adduser"){?> class="active"<?}?>> <a href="<?=base_url()?>index/adduser"> <i class="fontello-icon-right-dir"></i> <span class="hidden-tablet">Add User</span></a> </li>
				<li <?if($this->uri->segment(2) == "users"){?> class="active"<?}?>> <a href="<?=base_url()?>index/users"> <i class="fontello-icon-right-dir"></i> <span class="hidden-tablet">Users</span></a> </li>
				<li <?if($this->uri->segment(2) == "userroles"){?> class="active"<?}?>> <a href="<?=base_url()?>index/userroles"> <i class="fontello-icon-right-dir"></i> <span class="hidden-tablet">User Roles</span></a> </li>
				<li <?if($this->uri->segment(2) == "permissions"){?> class="active"<?}?>> <a href="<?=base_url()?>index/permissions"> <i class="fontello-icon-right-dir"></i> <span class="hidden-tablet">Permissions</span></a> </li>
				<li <?if($this->uri->segment(2) == "units"){?> class="active"<?}?>> <a href="<?=base_url()?>index/units"> <i class="fontello-icon-right-dir"></i> <span class="hidden-tablet">Units</span></a> </li>
				
				
			</ul>
		</li>
		<? } ?>
		
		<?
		if($this->userdetails["role_id"] == 1){
		?>
		<li class="last <?if($this->uri->segment(2) == "accessLogs"){ print("active"); }?>">
			<a href="<?=base_url()?>index/accessLogs">
				<i class="fa fa-key"></i>
				<span class="title">Access Logs  </span>
				
			</a>
			
		</li>
		<? } ?>
	</ul>