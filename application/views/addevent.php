<div id="wrapper">
	<div class="row-fluid page-head">
		
		<h2 class="page-title"><i class="aweso-icon-list-alt"></i> Add Event</h2>
		<div class="page-bar">
			<div class="btn-toolbar"> </div>
		</div>
	</div>
	<!-- // page head -->
	<?php if($viewonly == 0){ ?>
	<form action="<?=base_url()?>elog/insertevents" class="log-add-form" method="post">
		<input type="hidden" name="subject" value="Equipment Release" />
		<input type="hidden" name="initial" value="<?=$this->userdetails["agentcode"]?>" />
		<input type="hidden" name="datetime" value="" />
		<input type="hidden" name="jobcard" value="<?=$log["id"]?>" />
		<!-- // column -->
		<form class="emergency-edit-form" method="post" action="<?=base_url()?>emergency/updatelog">
			<div class="row">
				<div class="col-md-6">
					<span class="form-field-title">Job Cards</span>
					<span class="form-field">
						<input type="text" readonly="readonly" class="form-control" value="<?=$log["jobcard"]?>" />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Date</span>
					<span class="form-field">
						
						<input type="text"  readonly="readonly" class="form-control" value="<?=date("d/m/Y")?>" />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Time</span>
					<span class="form-field">
						
						<input type="text"  readonly="readonly" class="form-control"  value="<?=date("H:i")?>" />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Subject</span>
					<span class="form-field">
						<input type="text" name="subject" readonly="readonly" class="form-control"  value="<?=$log["subject"]?>" />
					</span>
				</div>
				
				<br><br><br>
				<div class="col-md-12" style="text-align:center">
					<h4>Details</h4>
				</div>
				<br><br>
				<div class="col-md-6">
					<span class="form-field-title">Job Status</span>
					<span class="form-field">
						
						<select name="jobstatus" class="form-control">
							<option value="">----Select----</option>
							<option value="Outstanding">Outstanding</option>
							<option value="Pending">Pending</option>
							
						</select>
						
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Stores Req #</span>
					<span class="form-field">
						<input type="text" name="jobstatus"  class="form-control"/>
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Job X Ref</span>
					<span class="form-field">
						<input type="text" name="jobxref" class="form-control" />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Total Man Hours</span>
					<span class="form-field">
						<input type="text" name="Man_Hours_Total"  class="time-field form-control"  value="" />
						
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Date/Time Equipment Handed back to ATC </span>
					<span class="form-field">
						
						<input type="text" name="Equipment_Handed_back_to_ATC"  class="date-field form-control" value="" />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Equipment Handed back to ATC By</span>
					<span class="form-field">
						<select name="Equipment_Handed_back_to_ATC_by" class="form-control">
							<option value="">Select</option>
							<?
							foreach($equipments as $key=>$user){
							?>
							<option value="<?=$user["name"]?>"><?=$user["name"]?></option>
							<?
							}
							?>
						</select>
						
						
					</span>
				</div>
				<br/><br/>
				<br/><br/><br/>
				
				<div class="col-md-12" style="text-align:center">
					<h4>Date and Targets</h4>
				</div>
				<br/><br/>
				<br/><br/>
				<div class="col-md-6">
					<span class="form-field-title">Date :</span>
					<span class="form-field">
						
						<input type="text" name="Date" class="date-field form-control" value="<?=date("d/m/Y")?>" />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Start Time :</span>
					<span class="form-field">
						<input type="text" name="Start_Time"  class="time-field form-control"  value=""  />
					</span>
				</div>
				
				<div class="col-md-6">
					<span class="form-field-title">Man Hours:</span>
					<span class="form-field">
						<input type="text" name="Man_Hours" value=""    class="manhour form-control" />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">On Behalf Of:</span>
					<span class="form-field">
						
						
						
						<select name="On_Behalf_Of" class="form-control">
							<option value="">Select</option>
							<?
							foreach($allUsers as $key=>$user){
							?>
							<option value="<?=$user["agentname"]?>"><?=$user["agentname"]?></option>
							<?
							}
							?>
						</select>
						
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Details of Action Taken:</span>
					<span class="form-field">
						
						<textarea name="Details_of_Action_Taken" id="desc" class="form-control"></textarea>
					</span>
				</div>
				
				
				
				<div class="col-md-6">
					<span class="form-field-title">Staff Name:</span>
					<span class="form-field">
						
						<select name="Staff_Name" class="form-control">
							<option value="">Select</option>
							<?
							foreach($allUsers as $key=>$user){
							?>
							<option value="<?=$user["agentname"]?>"><?=$user["agentname"]?></option>
							<?
							}
							?>
						</select>
					</span>
				</div>
				
				<div class="col-md-6">
					<span class="form-field-title">OJTI:</span>
					<span class="form-field">
						<input type="checkbox" name="OJTI" class="form-control"  />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Traning Hr:</span>
					<span class="form-field">
						<input type="text" name="Try_Hour"   class="time-field form-control"  value=""  />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title"></span>
					
					
					<span class="form-field">
						<input type="reset" class="btn btn-primary" value="Reset" />
						<input type="submit" class="btn btn-success" value="Submit" />
						
					</span>
				</div>
			</div>
		</form>
		
		<!-- // Example row -->
		<?php }elseif($viewonly == 1){?>
		<div class="table-scrollable">
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th scope="col" >
							ID
						</th>
						<th scope="col">
							Job Status
						</th>
						<th scope="col">
							Job X Ref
						</th>
						<th scope="col">
							Stores Req
						</th>
						<th scope="col">
							Total Man Hours
						</th>
						<th scope="col">
							Date/Time Equipment Handed back to ATC
						</th>
						<th scope="col">
							Detail Of Action
						</th>
						<th scope="col">
							Equipment Handed back to ATC By
						</th>
						<th scope="col">
							Staff Name
						</th>
						
						<th scope="col">
							More Details
						</th>
						
					</tr>
				</thead>
				<tbody>
					<?		foreach($addevents as $datas){
					
					
					?>
					
					<tr  onclick="addeventdetails(<?=$datas['id'];?>,this,'Add Event',false)">
						<td >
							<?=$datas['id'];?>
						</td>
						<td>
							<?=$datas['JobStatus'];?>
						</td>
						<td>
							<?=$datas['JobXRef'];?>
						</td>
						
						<td>
							<?=$datas['Stores|_Req'];?>
						</td>
						<td>
							<?=$datas['Man_Hours_Total'];?>
						</td>
						<td>
							<?=$datas['Equipment_Handed_back_to_ATC'];?>
						</td>
						<td>
							<?=$datas['Equipment_Handed_back_to_ATC_by'];?>
						</td>
						<td>
							<?=$datas['Details_of_Action_Taken'];?>
						</td>
						<td>
							<?=$datas['Staff_Name'];?>
						</td>
						<td>
							<input type="button" class="btn btn-primary" value="View More"  onclick="addeventdetails(<?=$datas['id'];?>,this,'Add Event',false)" />
						</td>
					</tr>
					<? } ?>
				</tbody>
				
			</table></div>
			<?php } ?>
		</div>
		<script type="text/javascript">
			$( ".time-field" ).timepicker({
				timeFormat: "HH:mm",
																						});			$( ".manhour" ).timepicker({		timeFormat: "HHmm",	});
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