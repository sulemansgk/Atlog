<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">
		
		<!-- Modal content-->
		<div class="modal-content">
			<div class='row'>
				<div class='col-md-6'>
					<div class='form-group'>
						<a href='http://ra3d.co/test_voice.mp3' class='btn btn-info' target='_blank' id='play_audio'>Press to play Audio Message</a><BR>
						<audio controls style='display:none;'>
							<source src="https://www.w3schools.com/html/horse.ogg" type="audio/ogg">
							<source src="https://www.w3schools.com/html/horse.mp3" type="audio/mpeg">
							Your browser does not support the audio element.
						</audio>
					</div>
				</div>
				
			</div>
			<div class='row'>
				<div class='col-md-6'>
					<div class='form-group'>
						<a href='javascript:;' class='btn btn-info' id='view_sms' >Press to view SMS</a><BR>
						
					</div>
				</div>
				
			</div>
			
			<?php
			$query = $this->db->query("SELECT * FROM email WHERE for_form LIKE '%".$_GET['type_of_incident']."%'")->result_array(); ?>
			
			<div class='row'>
				<div class='col-md-6'>
					<div class='form-group'>
						<select class='form-control email_dropdown'>
							<option value=''>Email Will be send to</option>
							
							<?
							foreach($query as $useremail){
							?>
							<option value="<?=$useremail["email_address"]?>"><?=$useremail["email_address"]?></option>
							<?
							}
							?>
						</select>
					</div>
				</div>
			</div>
			
			
			<fieldset style='padding-left:10px;display:none;' >
				<legend>SMS Text:</legend>
				<p id='sms_text' >
				</p>
			</fieldset>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default modal_submit" data-dismiss="modal">Submit</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
			
		</div>
	</div></div>
	
	
	<script>
	$("form").submit(function(e){
		
	});
	$("#play_audio").click(function(){
		
		var aud = new Audio();
		aud.src = 'https://forums.liveatc.net/index.php?action=dlattach;topic=14174.0;attach=9628';
		
	});
	$("#view_sms").click(function(){
		
		var sms_text = "";
		
		sms_text  = $("form").serialize();
		
		
		sms_text = sms_text.replace(/&/gi,"<BR><BR>");
		sms_text = sms_text.replace(/=/gi,": ");
		
		
		$("#sms_text").html(sms_text);
		
		$("fieldset").css('display','block');
	});
	$(".modal_submit").click(function(){
		
		var email = $(".email_dropdown").val();
		var msg = $("#sms_text").text();
		$("form").submit();
		
	});
	function abc(){
		$("#myModal").modal('show');
	}
	$("form").find("input[type=submit]").attr('type','button').attr('onClick','abc()');
	</script>