<html>
	<head>
		<title></title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript">
		setInterval("auto_refresh_function();", 3000);
		function auto_refresh_function() {
		$('#load_content').load('/atm/report/tables');
		}
		</script>
		<style>
			.report-container{
				float:left;
				width:100%;
				background:white
			}
			.report-heading {
				float: left;
				width: 99%;
				font-weight: bold;
				font-size: 110%;
				margin: 1% 0% 1% 0%;
				padding-left: 1%;
			}
			.general-report {
				float: left;
				width: 100%;
				border-bottom: 1px dashed gray;
			}
			.gr-list {
				float: left;
				width: 100%;
				list-style: none;
				margin: 0;
				padding: 0;
			}
			.gr-list .gr-head {
				float: left;
				width: 100%;
				margin: 0;
				font-weight: bold;
				background: lightgray;
				word-wrap: break-word;
			}
			.gr-list .gr-head .gr-initial {
				float: left;
				width: 10%;
				padding: 1%;
				word-wrap: break-word;
			}
			.gr-list .gr-head .gr-time {
				float: left;
				width: 10%;
				padding: 1%;
				word-wrap: break-word;
			}
			.gr-list .gr-head .gr-management {
				float: left;
				width: 20%;
				padding: 1%;
				word-wrap: break-word;
			}
			.gr-list .gr-head .gr-actions {
				float: left;
				width: 20%;
				padding: 1%;
				word-wrap: break-word;
			}
			.gr-list .gr-head .gr-subject {
				float: left;
				width: 20%;
				padding: 1%;
				word-wrap: break-word;
			}
			.gr-list .gr-head .gr-action {
				float: left;
				width: 8%;
				padding: 1%;
				word-wrap: break-word;
			}
			.gr-list .gr-row {
				float: left;
				width: 100%;
				margin: 0;
				font-weight: normal;
				background: white;
				word-wrap: break-word;
				border-bottom: 1px solid gray;
				margin-bottom: 1px;
			}
			.gr-list .gr-row .gr-initial {
				float: left;
				width: 10%;
				padding: 0.5% 1% 0.5% 1%;
				word-wrap: break-word;
			}
			.gr-list .gr-row .gr-time {
				float: left;
				width: 10%;
				padding: 0.5% 1% 0.5% 1%;
				word-wrap: break-word;
			}
			.gr-list .gr-row .gr-management {
				float: left;
				width: 20%;
				padding: 0.5% 1% 0.5% 1%;
				word-wrap: break-word;
			}
			.gr-list .gr-row .gr-actions {
				float: left;
				width: 20%;
				padding: 0.5% 1% 0.5% 1%;
				word-wrap: break-word;
			}
			.gr-list .gr-row .gr-subject {
				float: left;
				width: 20%;
				padding: 0.5% 1% 0.5% 1%;
				word-wrap: break-word;
			}
			.gr-list .gr-row .gr-action {
				float: left;
				width: 8%;
				padding: 0.5% 1% 0.5% 1%;
				word-wrap: break-word;
			}
			.fault-report {
				float: left;
				width: 100%;
				border-bottom: 1px dashed gray;
				word-wrap: break-word;
			}
			.report-heading {
				float: left;
				width: 100%;
				font-weight: bold;
				font-size: 110%;
				margin: 1% 0% 1% 0%;
				word-wrap: break-word;
			}
			.fr-list {
				float: left;
				width: 100%;
				list-style: none;
				margin: 0;
				padding: 0;
				word-wrap: break-word;
			}
			.fr-list .fr-head {
				float: left;
				width: 100%;
				margin: 0;
				font-weight: bold;
				background: lightgray;
				word-wrap: break-word;
			}
			.fr-list .fr-head .fr-initial {
				float: left;
				width: 10%;
				padding: 1%;
				word-wrap: break-word;
			}
			.fr-list .fr-head .fr-time {
				float: left;
				width: 10%;
				padding: 1%;
				word-wrap: break-word;
			}
			.fr-list .fr-head .fr-position {
				float: left;
				width: 12%;
				padding: 1%;
				word-wrap: break-word;
			}
			.fr-list .fr-head .fr-console {
				float: left;
				width: 12%;
				padding: 1%;
				word-wrap: break-word;
			}
			.fr-list .fr-head .fr-equipment {
				float: left;
				width: 14%;
				padding: 1%;
				word-wrap: break-word;
			}
			.fr-list .fr-head .fr-error-msg {
				float: left;
				width: 20%;
				padding: 1%;
				word-wrap: break-word;
			}
			.fr-list .fr-head .fr-action {
				float: left;
				width: 8%;
				padding: 1%;
				word-wrap: break-word;
			}
			.fr-list .fr-row {
				float: left;
				width: 100%;
				margin: 0;
				font-weight: normal;
				background: white;
				word-wrap: break-word;
				margin-bottom: 1px;
				border-bottom: 1px solid gray;
			}
			.fr-list .fr-row .fr-initial {
				float: left;
				width: 10%;
				padding: 0.5% 1% 0.5% 1%;
				word-wrap: break-word;
			}
			.fr-list .fr-row .fr-time {
				float: left;
				width: 10%;
				padding: 0.5% 1% 0.5% 1%;
				word-wrap: break-word;
			}
			.fr-list .fr-row .fr-position {
				float: left;
				width: 12%;
				padding: 0.5% 1% 0.5% 1%;
				word-wrap: break-word;
			}
			.fr-list .fr-row .fr-console {
				float: left;
				width: 12%;
				padding: 0.5% 1% 0.5% 1%;
				word-wrap: break-word;
			}
			.fr-list .fr-row .fr-equipment {
				float: left;
				width: 14%;
				padding: 0.5% 1% 0.5% 1%;
				word-wrap: break-word;
			}
			.fr-list .fr-row .fr-error-msg {
				float: left;
				width: 20%;
				padding: 0.5% 1% 0.5% 1%;
				word-wrap: break-word;
			}
			.fr-list .fr-row .fr-action {
				float: left;
				width: 8%;
				padding: 0.5% 1% 0.5% 1%;
				word-wrap: break-word;
			}
		</style>
	</head>
	<body>
		
		<div id="load_content">Loading</div>
	</body>
</html>