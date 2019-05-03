<ul id="mainSideMenu" class="nav nav-list nav-side" style="margin-bottom: 60px;">
	<li class="accordion-group">
		<div class="accordion-heading <?if($this->uri->segment(1) == ""){ print("active"); }?>">
			<a href="<?=base_url()?>elog/addevent"class="accordion-toggle">
				<span class="item-icon fontello-icon-monitor"></span>
				<i class="chevron fontello-icon-right-open-3"></i>
				Home
			</a>
		</div>
		<ul class="accordion-content nav nav-list collapse in" id="accDash">
		</ul>
	</li>
	<li class="accordion-group">
		<div class="accordion-heading <?if($this->uri->segment(2) == "addevent"){ print("active"); }?>">
			<a href="<?=base_url()?>index/jobcard"class="accordion-toggle">
				<span class="item-icon fontello-icon-monitor"></span>
				<i class="chevron fontello-icon-right-open-3"></i>
				Add NEW job
			</a>
		</div>
		<ul class="accordion-content nav nav-list collapse in" id="accDash">
		</ul>
	</li>
	
	<li class="accordion-group">
		
		<?
		if(isset($this->userdetails["permissions"]["only_fault_reports"]) && ($this->userdetails["role_id"] != 1)){
		?>
		<div class="accordion-heading <?if($this->uri->segment(2) == "latestparacustomer"){ print("active"); }?>">
			<?
			if($this->uri->segment(1) != "LatestDomainParameters"){
			?>
			<a href="<?=base_url()?>elog/mainview/faultreports" class="accordion-toggle">
				<?
				}else{
				?>
				<a href="#accTables" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle">
					<?
					}
					?>
					<span class="item-icon fontello-icon-align-justify"></span>
					<i class="chevron fontello-icon-right-open-3"></i>
					Faults
				</a>
			</div>
			<?
			}else{
			?>
			<div class="accordion-heading <?if($this->uri->segment(1) == "LatestDomainParameters"){ print("active"); }?>">
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
						Lastest Domain Parameters
					</a>
				</div>
				<?
				}
				?>
				
				<ul class="accordion-content nav nav-list<?if($this->uri->segment(1) == "elog"){ print(" in"); }?> collapse" id="accForms">
					
					<li> <a href="<?=base_url()?>domainparameters/latestparacustomer"> <i class="fontello-icon-right-dir"></i>Customer</a> </li>
					<li> <a href="<?=base_url()?>domainparameters/latestfrequency"> <i class="fontello-icon-right-dir"></i>Frequency </a> </li>
					<li> <a href="<?=base_url()?>domainparameters/latestLRU"> <i class="fontello-icon-right-dir"></i> LRU </a> </li>
					<li> <a href="<?=base_url()?>domainparameters/latestcalibrationitem"> <i class="fontello-icon-right-dir"></i> Calibration Item</a> </li>
					<li> <a href="<?=base_url()?>domainparameters/latestparappe"> <i class="fontello-icon-right-dir"></i>Ppe</a> </li>
					<li> <a href="<?=base_url()?>domainparameters/latestparajob"> <i class="fontello-icon-right-dir"></i> Job Card </a> </li>
					
				</ul>
			</li>
			
			
			
			<li class="accordion-group">
				
				
				<?
				if(isset($this->userdetails["permissions"]["only_fault_reports"]) && ($this->userdetails["role_id"] != 1)){
				?>
				<div class="accordion-heading <?if($this->uri->segment(1) == "elog"){ print("active"); }?>">
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
							<span class="item-icon fontello-icon-align-justify"></span>
							<i class="chevron fontello-icon-right-open-3"></i>
							Faults
						</a>
					</div>
					<?
					}else{
					?>
					<div class="accordion-heading <?if($this->uri->segment(2) == "mainview"){ print("active"); }?>">
						<?
						if($this->uri->segment(2) != "mainview"){
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
						<?
						}
						?>
						
						
						<ul class="accordion-content nav nav-list<?if($this->uri->segment(2) == "mainview"){ print(" in"); }?> collapse" id="accForms">
							<?
							if(isset($this->userdetails["permissions"]["only_fault_reports"]) && ($this->userdetails["role_id"] != 1)){
							?>
							<li> <a href="<?=base_url()?>elog/mainview/faultreports"> <i class="fontello-icon-right-dir"></i> Fault Reports</a> </li>
							<?
							}else{
							?>
							<li> <a href="<?=base_url()?>elog/mainview"> <i class="fontello-icon-right-dir"></i> Main View </a> </li>
							<?
							}
							?>
							
							<?
							if(isset($this->userdetails["permissions"]["add_generalentry_logs"]) || ($this->userdetails["role_id"] == 1)){
							?>
							<li> <a href="<?=base_url()?>elog/generalentry"> <i class="fontello-icon-right-dir"></i> General Entry </a> </li>
							<?
							}
							?>
							<?
							if(isset($this->userdetails["permissions"]["add_fault_reporting"]) || ($this->userdetails["role_id"] == 1)){
							?>
							<li> <a href="<?=base_url()?>elog/faultReporting"> <i class="fontello-icon-right-dir"></i> Fault Reporting </a> </li>
							<?
							}
							?>
							<?
							if(isset($this->userdetails["permissions"]["add_equipment_release"]) || ($this->userdetails["role_id"] == 1)){
							?>
							<li> <a href="<?=base_url()?>elog/equipmentRelease"> <i class="fontello-icon-right-dir"></i> Equipment Release </a> </li>
							<?
							}
							?>
							<?
							if(isset($this->userdetails["permissions"]["add_aircraft_diversion"]) || ($this->userdetails["role_id"] == 1)){
							?>
							<li> <a href="<?=base_url()?>elog/aircraftDiversion"> <i class="fontello-icon-right-dir"></i> Aircraft Diversion </a> </li>
							<?
							}
							?>
							
							
							<?
							if(isset($this->userdetails["permissions"]["control_mobile"]) || ($this->userdetails["role_id"] == 1)){
							?>
							<li> <a href="<?=base_url()?>elog/controlmobile"> <i class="fontello-icon-right-dir"></i> Control Mobile In/Out </a> </li>
							<?
							}
							?>
							<?
							if(
							(
							isset($this->userdetails["permissions"]["runway_inuse"])
							&& in_array(5,unserialize($this->userdetails["agentunit"]))
							)
							|| ($this->userdetails["role_id"] == 1)
							){
							?>
							<li> <a href="<?=base_url()?>elog/runwayInUse"> <i class="fontello-icon-right-dir"></i> OMAA Runway In Use </a> </li>
							<?
							}
							?>
							<?
							if(
							( isset($this->userdetails["permissions"]["runway_inuse"])
							&& (
							!in_array(5,unserialize($this->userdetails["agentunit"]))
							|| ( sizeof(unserialize($this->userdetails["agentunit"])) > 1 )
							)
							)
							|| ($this->userdetails["role_id"] == 1)
							){
							?>
							<li> <a href="<?=base_url()?>elog/runwayInUse2"> <i class="fontello-icon-right-dir"></i> Runway In Use </a> </li>
							<?
							}
							?>
							<?
							if(isset($this->userdetails["permissions"]["add_inspection_entry"]) || ($this->userdetails["role_id"] == 1) ){
							?>
							<li>
								<a href="#">
								<i class="fontello-icon-right-dir"></i> Inspection Entry </a>
								<ul class="nav">
									<li>
										<a href="<?=base_url()?>elog/RunwayManoeuvringArea">
											<i class="fontello-icon-right-dir"></i> RWY/Manoeuvring Inspection
										</a>
									</li>
									<?
									$units = unserialize($this->userdetails["agentunit"]);
									if( ( $this->userdetails["agentrole"] == 1 ) || in_array(5,$units)){
									?>
									<li>
										<a href="<?=base_url()?>elog/atcfacility">
											<i class="fontello-icon-right-dir"></i> T1 ATC Facility Inspection
										</a>
									</li>
									<?
									}
									?>
									<li>
										<a href="<?=base_url()?>elog/agl">
											<i class="fontello-icon-right-dir"></i> AGL Inspection
										</a>
									</li>
								</ul>
							</li>
							<?
							}
							?>
							
							
							
							<?
							if(isset($this->userdetails["permissions"]["add_staff_absence"]) || ($this->userdetails["role_id"] == 1) ){
							?>
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
						<?
						}
						?>
						<!------------------------------------------here code of lvo -------------------------------->
						<?
						if(isset($this->userdetails["permissions"]["add_aircraft_diversion"]) || ($this->userdetails["role_id"] == 1)){
						?>
						<li> <a href="<?=base_url()?>elog/InitiateLVO"> <i class="fontello-icon-right-dir"></i> Initiate LVO </a> </li>
						<?
						}
						?>
						<?
						if(isset($this->userdetails["permissions"]["add_aircraft_diversion"]) || ($this->userdetails["role_id"] == 1)){
						?>
						<li> <a href="<?=base_url()?>elog/LVOSafeguarding"> <i class="fontello-icon-right-dir"></i> LVO Safeguarding </a> </li>
						<?
						}
						?>
						<!------------------------------------------here  end here code of lvo -------------------------------->
						
						
						
					</ul>
				</li>
				
				
				
				
				<?
				if(isset($this->userdetails["permissions"]["add_emergency_logs"]) || ($this->userdetails["role_id"] == 1) ){
				?>
				
				<?
				}
				?>
				<!-- // item accordionMenu Forms -->
				<?
				if(isset($this->userdetails["permissions"]["add_emergency_logs"]) || ($this->userdetails["role_id"] == 1) ){
				?>
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
				}
				?>
				<?
				
				if(isset($this->userdetails["permissions"]["add_domain_parameters"]) || ($this->userdetails["role_id"] == 1) ){
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
						<li>
							<a href="<?=base_url()?>domainparameters/email"> <i class="fontello-icon-right-dir">Email</i></a>
						</li>
						<li>
							<a href="<?=base_url()?>domainparameters/phone"> <i class="fontello-icon-right-dir">Phone</i></a>
						</li>
						<li>
							<a href="<?=base_url()?>domainparameters/runway"> <i class="fontello-icon-right-dir">Runway</i></a>
						</li>
					</ul>
				</li>
				<?
				}
				?>
				<!-- // item accordionMenu Components -->
				<?
				if(isset($this->userdetails["permissions"]["view_instructions"]) || ($this->userdetails["role_id"] == 1) ){
				?>
				<li class="accordion-group">
					<div class="accordion-heading <?if($this->uri->segment(1) == "instructions"){ print("active"); }?>">
						<a href="#accInstructions" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle">
							<span class="item-icon fontello-icon-align-justify"></span>
							<i class="chevron fontello-icon-right-open-3"></i> Documents
						</a>
					</div>
					<ul class="accordion-content nav nav-list <?if($this->uri->segment(1) == "instructions"){ print("in"); }?> collapse" id="accInstructions">
						<?
						$instructionTypes = $this->instructions_model->getAllInstructionsTypes();
						foreach($instructionTypes as $insttype){
						?>
						<li> <a href="<?=base_url()?>instructions/viewInstructions/<?=str_replace(" ","-",$insttype["name"])."/".$insttype["id"]?>"> <i class="fontello-icon-right-dir"></i> <?=$insttype["name"]?> </a> </li>
						<?
						}
						?>
						
					</ul>
				</li>
				<?
				}
				
				if(isset($this->userdetails["permissions"]["generate_reports"]) || ($this->userdetails["role_id"] == 1) ){
				?>
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
						<li> <a href="<?=base_url()?>report/InstructionsReport"> <i class="fontello-icon-right-dir"></i> <span class="hidden-tablet">Instructions Report</span></a> </li>
					</ul>
				</li>
				<?
				}
				?>
				<?
				if($this->userdetails["role_id"] == 1){
				?>
				<li class="accordion-group">
					<div class="accordion-heading <?if(strstr(strtolower($this->uri->segment(2)),"user") || ( $this->uri->segment(2) == "permissions")){ print("active"); }?>">
						<a href="#usermanage" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle">
							<span class="item-icon  fontello-icon-window"></span>
							<i class="chevron fontello-icon-right-open-3"></i>
							User Management
						</a>
					</div>
					<ul class="accordion-content nav nav-list <?if(strstr(strtolower($this->uri->segment(2)),"user") || ( $this->uri->segment(2) == "permissions") || ( $this->uri->segment(2) == "units") ){ print("in"); }?> collapse" id="usermanage">
						<li <?if($this->uri->segment(2) == "adduser"){?> class="active"<?}?>> <a href="<?=base_url()?>index/adduser"> <i class="fontello-icon-right-dir"></i> <span class="hidden-tablet">Add User</span></a> </li>
						<li <?if($this->uri->segment(2) == "users"){?> class="active"<?}?>> <a href="<?=base_url()?>index/users"> <i class="fontello-icon-right-dir"></i> <span class="hidden-tablet">Users</span></a> </li>
						<li <?if($this->uri->segment(2) == "userroles"){?> class="active"<?}?>> <a href="<?=base_url()?>index/userroles"> <i class="fontello-icon-right-dir"></i> <span class="hidden-tablet">User Roles</span></a> </li>
						<li <?if($this->uri->segment(2) == "permissions"){?> class="active"<?}?>> <a href="<?=base_url()?>index/permissions"> <i class="fontello-icon-right-dir"></i> <span class="hidden-tablet">Permissions</span></a> </li>
						<li <?if($this->uri->segment(2) == "units"){?> class="active"<?}?>> <a href="<?=base_url()?>index/units"> <i class="fontello-icon-right-dir"></i> <span class="hidden-tablet">Units</span></a> </li>
					</ul>
				</li>
				<?
				}
				?>
				<?
				if($this->userdetails["role_id"] == 1){
				?>
				<li class="accordion-group">
					<div class="accordion-heading <?if($this->uri->segment(2) == "accessLogs"){ print("active"); }?>">
						<a href="<?=base_url()?>index/accessLogs"class="accordion-toggle">
							<span class="item-icon fontello-icon-monitor"></span>
							<i class="chevron fontello-icon-right-open-3"></i>
							Access Logs
						</a>
					</div>
					<ul class="accordion-content nav nav-list collapse in" id="accDashss">
					</ul>
				</li>
				<?
				}
				?>
				
			</ul>