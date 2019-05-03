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
	<li class="accordion-group">
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
			<ul class="accordion-content nav nav-list<?if($this->uri->segment(1) == "elog"){ print(" in"); }?> collapse" id="accTables">
				<li> <a href="<?=base_url()?>elog/mainview/faultreports"> <i class="fontello-icon-right-dir"></i> Fault Reports</a> </li>
				<li> <a href="<?=base_url()?>elog/faultReporting"> <i class="fontello-icon-right-dir"></i> Fault Reporting </a> </li>
				<li> <a href="<?=base_url()?>elog/equipmentRelease"> <i class="fontello-icon-right-dir"></i> Equipment Release </a> </li>
			</ul>
		</li>
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