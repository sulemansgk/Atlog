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
		<li> <a href="<?=base_url()?>emergency/fullemergency"> <i class="fontello-icon-right-dir"></i> Full Emergency </a></li>
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
			<i class="chevron fontello-icon-right-open-3"></i> Documents
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
	<div class="accordion-heading"> <a href="#accButtons" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle"> <span class="item-icon fontello-icon-puzzle"></span> <i class="chevron fontello-icon-right-open-3"></i> Rosters </a> </div>
	<ul class="accordion-content nav nav-list collapse" id="accButtons">
		<li> <a href="#"> <i class="fontello-icon-right-dir"></i> Monthly Rosters </a> </li>
		<li> <a href="#"> <i class="fontello-icon-right-dir"></i> Daily Rosters </a> </li>
		<li> <a href="#"> <i class="fontello-icon-right-dir"></i> ATCO Work Hour </a> </li>
		<li> <a href="#"> <i class="fontello-icon-right-dir"></i> Position Log </a> </li>
	</ul>
</li>

</ul>