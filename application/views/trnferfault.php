<div id="wrp">
	<div id="page-content" class="page-content" >
		<section>
			<div class="row-fluid margin-top20"><!-- // column -->
			<form class="emergency-edit-form" method="post" action="<?=base_url()?>elog/transferd">
				<div class="row">
					<div class="col-md-6">
						<input type="hidden" name="subject" value="Job Canceled " />
						<input type="hidden" name="initial" value="<?=$this->userdetails["agentcode"]?>" />
						<input type="hidden" name="datetime" value="<?=date("Y-m-d H:i:s")?>" />
						
						<div class="form-row">
							<span class="form-field-title">Initials</span>
							<span class="form-field">
								<input type="text" name="initials" class="form-control" readonly="readonly" value="<?=$this->userdetails["agentname"]?>" />
							</span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-row">
							<span class="form-field-title">Date </span>
							<span class="form-field">
								<input type="text" required="required" value="<?=date("d/m/Y")?>" class="date-field form-control" >
							</span>
						</div></div>
						<input type="hidden"  readonly="readonly" name="Job_Code" value="<?=$id;?>"/>
						<div class="col-md-6">
							<div class="form-row">
								<span class="form-field-title">Ext Ref </span>
								<span class="form-field">
									<input type="text" name="Ext_Ref" class="form-control">
								</span>
							</div></div>
							
							<div class="col-md-6">
								<div class="form-row">
									<span class="form-field-title">Other Section : *</span>
									<span class="form-field">
										<select name="initials_code" class="form-control">
											<option value="">--Select Other Section--</option>
											
											<?
											
											foreach($section as $key=>$number){
											?>
											<option value="<?=$number["id"]?>"><?=$number["name"]?></option>
											<?
											}
											?>
										</select>
										
									</span>
								</div></div>
								<div class="col-md-6">
									<div class="form-row">
										<span class="form-field-title">Remarks:</span>
										<span class="form-field">
											
											<textarea placeholder="Enter Remarks..." class="form-control" id="textarea" name="Remarks"></textarea>
										</span>
									</div></div>
									<div class="col-md-6" style="margin-top:2%;">
										<div class="form-row">
											<span class="form-field-title"></span>
											<span class="form-field">
												<input type="reset" class="btn btn-danger" value="Reset" />
												<input type="submit" class="btn btn-success" value="Submit" />
											</span>
										</div></div></div>
										
									</form>
								</div>
								<!-- // Example row -->
							</section>
						</div>
					</div>
					<script type="text/javascript">
						$( ".time-field" ).timepicker({
							timeFormat: "HHmm",
							});
						$( ".date-field" ).datepicker({
							dateFormat:"dd/mm/yy",
							});
						$(document).on("change",".date-field,.time-field",function(){
								var date = $.datepicker.parseDate("dd/mm/yy",$(".date-field").val());
								var time = $(".time-field").val();
								time = time[0]+time[1]+":"+time[2]+time[3]+":00"
								date = $.datepicker.formatDate( "yy-mm-dd", date);
								var datetime = date+" "+time;
								$(".datetime-field").attr("value",datetime);
						});
					</script>
					<!-- // page content -->