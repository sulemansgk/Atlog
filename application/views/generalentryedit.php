<div class="row-fluid page-head">
	<img src="<?=base_url()?>assets/img/gal.png" style="float:left" />
	<h2 class="page-title"><i class="fontello-icon-monitor"></i> General Entry</h2>
	<div class="page-bar">
		<div class="btn-toolbar"> </div>
	</div>
</div>
<!-- // page head -->
<form action="<?=base_url()?>elog/insertgeneralentry" class="aircraft-crash-form" method="post">
	<div id="page-content" class="page-content">
		<section>
			<div class="row-fluid margin-top20"><!-- // column -->
			<div class="row">
				<div class="col-md-6">
					<span class="form-field-title">Initial</span>
					<span class="form-field">
						<input type="text" readonly="readonly" class="form-control" value="<?=$this->userdetails["agentname"]?>" />
						<input type="hidden" class="form-control" name="initial" readonly="readonly" value="<?=$this->userdetails["agentcode"]?>" />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Date Time</span>
					<span class="form-field">
						
						<input type="text" class="form-control"  readonly="readonly" name="datetime" value="<?=date("Y-m-d H:i:s")?>" />
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">On Behalf</span>
					<span class="form-field">
						<select name="onbehalf" class="form-control" disabled="disabled">
							<option value="">--Select User--</option>
							<?
							foreach($allusers as $key=>$user){
							?>
							<option value="<?=$user["agentcode"]?>"><?=$user["agentname"]?></option>
							<?
							}
							?>
						</select>
						
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Subject</span>
					<span class="form-field" style="width: 50%;">
						<select name="subject"  class="form-control" disabled="disabled">
							<option value="">-- Select Subject --</option>
							<option value="subjec1">Subjec 1</option>
							<option value="subjec2">Subjec 2</option>
						</select>
					</span>
				</div>
				<div class="col-md-6">
					<span class="form-field-title">Description</span>
					<span class="form-field" style="width: 50%;">
						<textarea name="description"  readonly="readonly" id="textarea"  class="form-control"></textarea>
					</span>
				</div>
				<div class="form-row">
					<span class="form-field-title"></span>
					<span class="form-field">
						<input type="submit" id="button" value="Submit" />
						<input type="reset"id="btn btn-danger" value="Cancel" />
					</span>
				</div>
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
</div>
</form>
<!-- // page content -->