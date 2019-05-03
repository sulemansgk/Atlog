<div class="row-fluid page-head">
	<img src="<?=base_url()?>assets/img/gal.png" style="float:left" />
	<h2 class="page-title"><i class="fontello-icon-monitor"></i> Emergency</h2>
	<div class="page-bar">
		<div class="btn-toolbar"> </div>
	</div>
</div>
<!-- // page head -->
<form action="<?=base_url()?>emergency/insertlog" class="log-add-form" method="post">
	<input type="hidden" name="initial" value="<?=$this->userdetails["agentcode"]?>" />
	<input type="hidden" name="datetime" value="<?=date("Y-m-d H:i:s")?>" />
	<div id="page-content" class="page-content">
		<section>
			<div class="row-fluid margin-top20"><!-- // column -->
			<div class="form-row">
				<span class="form-field-title">Nature Of Accident:</span>
				<span class="form-field">
					<select name="type_of_incident" required="required">
						<option value="">-- Select nature of accident --</option>
						<option value="Aircraft Crash">Aircraft Crash</option>
						<option value="Aircraft Ground Incident">Aircraft Ground Incident</option>
						<option value="Bomb Warning">Bomb Warning</option>
						<option value="Domestic Fire">Domestic Fire</option>
						<option value="Fuel Spillage">Fuel Spillage</option>
						<option value="Fuel Emergency">Fuel Emergency</option>
						<option value="Local Standby">Local Standby</option>
						<option value="Medical Emergency">Medical Emergency</option>
						<option value="OMAD Emergencies">OMAD Emergencies</option>
						<option value="OMBY Emergency">OMBY Emergency</option>
						<option value="Unlawful Interference">Unlawful Interference</option>
						<option value="Weather Standby">Weather Standby</option>
					</select>
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Location (e.g. Runway):</span>
				<span class="form-field">
					<input type="text" name="location" value="" placeholder="Enter value..." />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Aircraft Type:</span>
				<span class="form-field">
					<input type="text" name="aircraft_type" value="" placeholder="Enter value..." />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Persons on Board:</span>
				<span class="form-field">
					<input type="text" name="persons_on_board" value="" placeholder="Enter value..." />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">ETA:</span>
				<span class="form-field">
					<input type="text" name="eta" class="etimefield" value="" placeholder="Enter value..." />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Callsign:</span>
				<span class="form-field">
					<input type="text" name="callsign" value="" placeholder="Enter value..." />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Dangerous Goods:</span>
				<span class="form-field">
					<input type="text" name="dangerous_goods" value="" placeholder="Enter value..." />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Point of Departure:</span>
				<span class="form-field">
					<input type="text" name="point_of_departure" value="" placeholder="Enter value..." />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Destination:</span>
				<span class="form-field">
					<input type="text" name="destination" value="" placeholder="Enter value..." />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Nature of Accident:</span>
				<span class="form-field">
					<input type="text" name="nature_of_accident" value="" placeholder="Enter value..." />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Any other Details:</span>
				<span class="form-field"  style="width: 70%;">
					<textarea placeholder="Enter value..." rows="5" cols="45" id="textarea" name="any_other_details"></textarea>
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">Time of Accident (UTC):</span>
				<span class="form-field">
					
					<input type="number" name="time_of_accident" value="<?=date("Hi")?>" class="timefield" placeholder="Enter value..." oninput="maxLengthCheck(this);"/>
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title"></span>
				<span class="form-field">
					<input type="submit" class="btn" value="Submit" />
					<input type="reset" class="btn btn-red" value="Cancel" />
				</span>
			</div>
		</div>
	</section>
</div>
</form>