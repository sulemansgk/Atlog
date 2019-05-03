<div class="row-fluid page-head">
	<img src="<?=base_url()?>assets/img/gal.png" style="float:left" />
	<h2 class="page-title"><i class="fontello-icon-monitor"></i>Quick Reports</h2>
	<div class="page-bar">
		<div class="btn-toolbar"> </div>
	</div>
</div>
<!-- // page head -->
<form action="<?=base_url()?>report/quickreport" class="report-form" method="post">
	<div id="page-content" class="page-content">
		<section>
			<div class="row-fluid margin-top20"><!-- // column -->
			<div class="form-row">
				<span class="form-field-title">From</span>
				<span class="form-field">
					<input type="text" name="from" class="reportdatefield" value="<?=date("Y-m-d")?>" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title">To</span>
				<span class="form-field">
					<input type="text" name="to" class="reportdatefield2" value="<?=date("Y-m-d")?>" />
				</span>
			</div>
			<div class="form-row">
				<span class="form-field-title"></span>
				<span class="form-field">
					<input type="reset" class="btn btn-blue" value="Reset" />
					<input type="submit" class="btn" value="Submit" />
				</span>
			</div>
		</div>
	</section>
</div>
</form>