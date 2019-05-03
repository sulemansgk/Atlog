<div class="row">
	<div class="col-md-12">
		<i class="aweso-icon-list-alt">
		<div class="page-bar">
			<div class="btn-toolbar">
				<ul class="nav nav-tabs pull-right">
					<li class="active acr-tab" id="user-tab" onclick="$(this).addClass('active');$('.acr-form').show();$('.vcr-tab').removeClass('active');$('.vcr-form').hide();" >
						<a href="#TabTop1" data-toggle="tab">Approach Control Room</a> </li>
						<li id="articles-tab" class="vcr-tab"  onclick="$(this).addClass('active');$('.acr-form').hide();$('.acr-tab').removeClass('active');$('.vcr-form').show();" >
							<a href="#TabTop2" data-toggle="tab">Visual Control Room</a>
						</li>
						
					</ul>
				</div>
			</div>
			</i>
			<div class="portlet box purple">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-desktop"></i>TERMINAL 1 (T1) ATC FACILITY INSPECTION
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse" data-original-title="" title="">
						</a>
						<a href="#portlet-config" >
						</a>
						<a href="javascript:;" >
						</a>
						<a href="javascript:;" >
						</a>
					</div>
				</div>
				<div class="portlet-body form">
					
					<form action="<?=base_url()?>elog/insertAtcAcrFacility" class="aircraft-crash-form acr-form acr-add-form" method="post">
						<input type="hidden" name="subject" value="TERMINAL 1 (T1) ATC FACILITY INSPECTION" />
						<input type="hidden" name="initial" value="<?=$this->userdetails["agentcode"]?>" />
						<input type="hidden" name="datetime" value="<?=date("Y-m-d H:i:s")?>" />
						<input type="hidden" name="atc_type" value="Approach Control Room" />
						<div class="row pform" style="padding-top:1%;"  >
							<div class="col-md-6">
								<div class="form-group">
									<span class="form-field-title">1. Radio (PAE Standby Radio)</span>
									
									<br>
									<i>a.</i>124.400 Mhz <input type="checkbox" name="124_4Mhz" />
									<br>
									<i>b.</i>127.500 Mhz <input type="checkbox" name="127_5Mhz" />
									<br>
									<i>c.</i>124.625 Mhz <input type="checkbox" name="124_6Mhz" />
									
									
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<span class="form-field-title">2.  Equipment</span>
									<br>
									<i>a.</i>RADAR <input type="checkbox" name="radar" />
									<br>
									<i>b.</i>AWOS <input type="checkbox" name="awos" />
									<br>
									<i>c.</i>Air-Conditioning <input type="checkbox" name="air_conditioning" />
									
								</div>
							</div>
							
						</div>
						
						<div class="row pform" >
							<div class="col-md-6">
								
								<div class="form-group">
									<span class="form-field-title">3.Telephones </span>
									
									<br>
									<i>a.</i>ATCC SUP <input type="checkbox" name="atcc_sup" />
									
									<br>	<i>b.</i>ATCC ARR <input type="checkbox" name="atcc_arr" />
									
									<br>	<i>c.</i>ATCC INFO <input type="checkbox" name="atcc_info" />
									
									<br>	<i>d.</i>ATCC ADCS <input type="checkbox" name="atcc_adcs" />
									
									<br>	<i>e.</i>ATCC AADN <input type="checkbox" name="atcc_aadn" />
									
									<br>	<i>f.</i>AES,MFC <input type="checkbox" name="aes_mfc" />
									
									
								</div>
							</div>
							
							<div class="col-md-6">
								
								<div class="form-group">
									<span class="form-field-title">Cleaning Required</span>
									<input type="checkbox" name="cleaning" style="float: none;margin-left: 19%;"/>
									
								</div>
							</div>
							
						</div>
						
						<div class="row pform" >
							<div class="col-md-6">
								
								<div class="form-group">
									<span class="form-field-title">T1 ACR Remarks </span>
									
									<textarea name="remarks" id="detail" class="form-control"></textarea>
									
								</div>
							</div>
						</div>
						
						<div class="form-actions left">
							
							<div class="col-md-5">
								
								
								
								<div class=" form-actions" >
									
									
									<input type="submit" class="btn btn-success" value="Submit" />
									<input type="reset" class="btn btn-danger" value="Cancel" />
									
								</div>
								
							</div>
						</div>
					</form>
					
					<form action="<?=base_url()?>elog/insertAtcVcrFacility" class="aircraft-crash-form vcr-form vcr-add-form" method="post">
						<input type="hidden" name="subject" value="TERMINAL 1 (T1) ATC FACILITY INSPECTION" />
						<input type="hidden" name="initial" value="<?=$this->userdetails["agentcode"]?>" />
						<input type="hidden" name="datetime" value="<?=date("Y-m-d H:i:s")?>" />
						<input type="hidden" name="atc_type" value="Visual Control Room" />
						<div class="row pform" style="padding-top:1%;"  >
							<div class="col-md-6">
								<div class="form-group">
									<span class="form-field-title">1.Radio (PAE Standby Radio) </span>
									
									
									<br><i>a.</i>119.200 Mhz <input type="checkbox" name="119_2Mhz" />
									
									<br><i>b.</i>118.675 Mhz <input type="checkbox" name="118_6Mhz" />
									
									<br><i>b.</i>123.975 Mhz <input type="checkbox" name="123_9Mhz" />
									
									<br>	<i>b.</i>121.950 Mhz <input type="checkbox" name="121_9Mhz" />
									<br>
									<i>b.</i>125.100 Mhz <input type="checkbox" name="125_1Mhz" />
									
									
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<span class="form-field-title">2.  Equipment</span>
									
									<br>	<i>a.</i>SMGC <input type="checkbox" name="SMGC" />
									
									<br>	<i>b.</i>Binoculars <input type="checkbox" name="Binoculars" />
									
									<br>	<i>c.</i>Signal Gun <input type="checkbox" name="SignalGun" />
									
									<br>	<i>d.</i>Air-Conditioning <input type="checkbox" name="air_conditioning" />
									
								</div>
							</div>
							
							
						</div>
						
						<div class="row pform" >
							<div class="col-md-6">
								
								<div class="form-group">
									<span class="form-field-title">3.Telephones </span>
									
									
									<br>	<i>a.</i>ATCC SUP <input type="checkbox" name="atcc_sup" />
									
									<br>	<i>b.</i>ATCC ARR <input type="checkbox" name="atcc_arr" />
									
									<br>	<i>c.</i>ATCC INFO <input type="checkbox" name="atcc_info" />
									
									<br>	<i>d.</i>ATCC ADCS <input type="checkbox" name="atcc_adcs" />
									
									<br>	<i>d.</i>ATCC AADN <input type="checkbox" name="atcc_aadn" />
									
									<br>		<i>d.</i>AES,MFC <input type="checkbox" name="aes_mfc" />
									
									
									
								</div>
							</div>
							
							<div class="col-md-6">
								
								<div class="form-group">
									<span class="form-field-title">Cleaning Required</span>
									<input type="checkbox" name="cleaning" style="float: none;margin-left: 19%;"/>
									
								</div>
							</div>
							
							
							
						</div>
						
						<div class="row pform" >
							<div class="col-md-6">
								
								<div class="form-group">
									<span class="form-field-title">T1 ACR Remarks </span>
									
									<textarea name="remarks" id="detail" class="form-control"></textarea>
									
								</div>
							</div>
							
							
							
							
							
						</div>
						
						
						
						
						
						
						
						
						
						
						<div class="form-actions left">
							
							<div class="col-md-5">
								
								
								
								<div class=" form-actions" >
									
									
									<input type="submit" class="btn btn-success" value="Submit" />
									<input type="reset" class="btn btn-danger" value="Cancel" />
									
								</div>
								
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- form -->
	<style>
		.pform
		{
			padding-left:2%;
			padding-right:2%;
		}
	</style>
	<!-- form -->
	<!-- // page content -->