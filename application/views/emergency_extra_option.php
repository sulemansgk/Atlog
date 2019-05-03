<div class='row'>
	<div class='col-md-6'>
		<div class='form-group'>
			<a href='http://ra3d.co/test_voice.mp3' class='btn btn-info' id='play_audio'>Press to play Audio Message</a><BR>
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

<?php $query = $this->db->query("SELECT * FROM email WHERE for_form LIKE '%".$_GET['type_of_incident']."%'")->result_array(); ?>


<textarea id='sms_text' style='display:none;' rows="20" cols="50">
<? 	print_r($_GET); ?>
</textarea>

<script>
$("form").submit(function(e){
	
});
$("#play_audio").click(function(){
	
	var aud = new Audio();
	aud.src = 'https://forums.liveatc.net/index.php?action=dlattach;topic=14174.0;attach=9628';
	aud.play();
	
});
$("#view_sms").click(function(){
	
	var sms_text = "";
	$("form .form-group").each(function(){
		
			sms_text += $(this).find('span').text() + ": "+ $(this).find('input[type=text]').val() +"\\\n";
		
	});
	
	$("#sms_text").css('display','block');
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