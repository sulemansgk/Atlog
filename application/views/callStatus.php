<div class="row">
	<div class="col-md-6">
		<span class="form-field-title"><b>Call Status:</b></span>
		<?
		foreach($log["phone_numbers"] as $key=>$phone){
		?>
		
		<table class="table table-bordered">
			<tbody>
				<tr>
					<td>
						<?
						print($phone["t_phone"]); ?>
					</td>
					<td align="center">
						<? if($phone["status"] != "calling"){
						?>
						<input type="button" class="btn btn-success btn-circle phone-status" value="Called" />
						<input type="button" class="btn btn-deafult " onclick="changeCallStatus(<?=$phone["p_id"]?>,this);" value="Redial" />
						<?
						}else{
						?>
						<input type="button" class="btn btn-success  phone-status" value="Calling" />
						<?
						}
						?>
					</td>
				</tr>
			</tbody>
		</table>
		
		<?
		}
		?>
	</div>
	<div class="col-md-6">
		<div class="form-row">
			<span class="form-field-title"><b>Mailed To:</b></span>
			<table class="table table-bordered">
				<tbody>
					<?
					$emails = explode(",",$log["t_emails"]);
					if(!empty($emails)){
					foreach($emails as $key=>$email){ ?>
					<tr>
						
						<td>
							<? print($email); ?>
						</td>
						
						
					</tr>
					<?	} } ?>
				</tbody>
			</table>
			
		</div>
	</div>
</div>