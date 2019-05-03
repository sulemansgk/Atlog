<div class="row-fluid page-head">
	<img src="<?=base_url()?>assets/img/gal.png" style="float:left" />
	<h2 class="page-title"><i class="fontello-icon-monitor"></i>OMBYE Emergencies</h2>
	<div class="page-bar">
		<div class="btn-toolbar"> </div>
	</div>
</div>
<!-- // page head -->
<form action="<?=base_url()?>emergency/insertlog" class="log-add-form" method="post">
	<input type="hidden" name="type_of_incident" value="OMBY Emergency" />
	<input type="hidden" name="initial" value="<?=$this->userdetails["agentcode"]?>" />
	<input type="hidden" name="datetime" value="<?=date("Y-m-d H:i:s")?>" />
	<div id="page-content" class="page-content">
		<section>
			<div class="row-fluid margin-top20"><!-- // column -->
			<table width="90%" border="0" cellspacing="2" cellpadding="2">
				<tbody><tr>
					<td height="103"> Time of Call from OMBY:</td>
					<td colspan="2">
						
						<input type="number" name="time_of_call_omby" value="<?=date("Hi")?>" class="etimefield" placeholder="Enter value..." oninput="maxLengthCheck(this);"/>
					</td>
				</tr>
				<tr>
					<td>Location (e.g. Runway):</td>
					<td colspan="2"><input type="text" name="location" value="" class="auto2 ui-autocomplete-input" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
				</td>
			</tr>
			<tr>
				<td>Aircraft Type:</td>
				<td colspan="2"><input type="text" name="aircraft_type" value="" class="auto3 ui-autocomplete-input" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
			</td>
		</tr>
		<tr>
			<td>Persons on Board:</td>
			<td colspan="2"><input name="persons_on_board" type="text" id="textfield" maxlength="4">
		</td>
	</tr>
	
	
	<tr>
		<td>Aircraft Operator:</td>
		<td colspan="2"><input type="text" name="aircraft_operator" value="" class="auto4 ui-autocomplete-input" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>                          </td>
	</tr>
	<tr>
		<td>Callsign:</td>
		<td colspan="2"><input type="text" name="callsign" value="" class="auto5 ui-autocomplete-input" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
	</td>
</tr>
<tr>
	<td>Dangerous Goods:</td>
	<td colspan="2"><input type="text" name="dangerous_goods" value="" class="auto6 ui-autocomplete-input" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
</td>
</tr>
<tr>
<td>Point of Departure:</td>
<td colspan="2"><input type="text" name="point_of_departure" value="" class="auto7 ui-autocomplete-input" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
</td>
</tr>
<tr>
<td>Destination:</td>
<td colspan="2"><input type="text" name="destination" value="" class="auto8 ui-autocomplete-input" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
</td>
</tr>
<tr>
<td> Nature of Accident:</td>
<td colspan="2">
<input type="text" name="nature_of_accident" value="" class="auto9 ui-autocomplete-input" autocomplete="off"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
</td>
</tr>
<tr>
<td height="103"> Any other Details:</td>
<td colspan="2"><textarea name="any_other_details" id="textarea" cols="45" rows="5"></textarea>
</td>
</tr>
<tr>
<td height="103"> Time of Accident (UTC):</td>
<td colspan="2">

<input type="number" name="time_of_accident" value="<?=date("Hi")?>" class="timefield" placeholder="Enter value..." oninput="maxLengthCheck(this);"/>
</td>
</tr>
<tr>
<td colspan="3"><table width="10%" border="0" align="center" cellpadding="2" cellspacing="2">
<tbody><tr>
<td><input type="submit" class="btn" value="Submit"></td>
<td><input type="reset" class="btn btn-red" value="Cancel"></td>
</tr>
</tbody></table></td>
</tr>
</tbody></table>
</div>
<!-- // Example row -->

</section>
<section>
<div class="row-fluid">
<div class="span8"><!-- // Widget -->
</div>
<!-- // column -->

<div class="span4"><!-- // Widget -->
</div>
<!-- // column -->
</div>
<!-- // Example row -->
</section>
</div></form>
<!-- // page content -->