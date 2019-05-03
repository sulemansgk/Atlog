$(document).ready(function(){

		
		
		$(".inst-list-open").click(function(){
			var curr_elem = this;
			if($(".instructions-list").is(":visible")){
				$(".instructions-list").fadeOut("fast");
				$(curr_elem).removeClass("active");
			}else{
				$(".instructions-list").fadeIn("fast");			
				$(curr_elem).addClass("active");
				$(".equip-notif-open").removeClass("active");
				$(".notifications-list").hide();
				$(".sendbacknoticed").removeClass("active");
				$(".sendbacknoticed-list").hide();
				$(".fault-rep-open").removeClass("active");
				$(".fault-list").hide();				
			}
		});
		$(".equip-notif-open").click(function(){
			var curr_elem = this;
			if($(".notifications-list").is(":visible")){
				$(".notifications-list").fadeOut("fast");
				$(curr_elem).removeClass("active");
			}else{
				$(".notifications-list").fadeIn("fast");			
				$(curr_elem).addClass("active");
				$(".inst-list-open").removeClass("active");
				$(".instructions-list").hide();	
				$(".sendbacknoticed").removeClass("active");
				$(".sendbacknoticed-list").hide();
				$(".fault-rep-open").removeClass("active");
				$(".fault-list").hide();	
				
			}
		});
		
			$(".sendbacknoticed").click(function(){
			var curr_elem = this;
			if($(".sendbacknoticed-list").is(":visible")){
				$(".sendbacknoticed-list").fadeOut("fast");
				$(curr_elem).removeClass("active");
			}else{
				$(".sendbacknoticed-list").fadeIn("fast");			
				$(curr_elem).addClass("active");
				$(".inst-list-open").removeClass("active");
				$(".equip-notif-open").removeClass("active");
				$(".fault-rep-open").removeClass("active");
				$(".fault-list").hide();
				$(".instructions-list").hide();		
				$(".notifications-list").hide();				
			}
		});
		
		
		
		
			$(".fault-rep-open").click(function(){
			var curr_elem = this;
			if($(".fault-list").is(":visible")){
				$(".fault-list").fadeOut("fast");
				$(curr_elem).removeClass("active");
			}else{
				$(".fault-list").fadeIn("fast");			
				$(curr_elem).addClass("active");
				$(".inst-list-open").removeClass("active");
				$(".equip-notif-open").removeClass("active");
				$(".sendbacknoticed").removeClass("active");
				$(".sendbacknoticed-list").hide();	
				$(".instructions-list").hide();		
				$(".notifications-list").hide();				
			}
		});
		
		

		
	
	$(document).keyup(function(e) {
		if (e.keyCode == 27) {
			$('.inst-add-form,.screen-hide').fadeOut(500);
		}
	});	
	
		
		
		
		
		
		
		

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		$( "#dialog" ).dialog({
      autoOpen: false,
			width:900,

      hide: {
        effect: "explode",
        duration: 1000
      }
    });


	$(document).on("change",".date-field,.time-field",function(){
			var date = $.datepicker.parseDate("dd/mm/yy",$(".date-field").val());
			var time = $(".time-field").val();
			time = time[0]+time[1]+time[2]+time[3]+time[4]+":00"
			date = $.datepicker.formatDate( "yy-mm-dd", date);
			var datetime = date+" "+time;
			$(".datetime-field").attr("value",datetime);
	});
	
	$( ".al-from" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 3,
			dateFormat:"yy-mm-dd",
      onClose: function( selectedDate ) {
        $( ".al-to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( ".al-to" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 3,
			dateFormat:"yy-mm-dd",
      onClose: function( selectedDate ) {
        $( ".al-from" ).datepicker( "option", "maxDate", selectedDate );
      }
    });	

	$( ".reportdatefield" ).datepicker({
		dateFormat:"yy-mm-dd",
	});	
	$( ".reportdatefield2" ).datepicker({
		dateFormat:"yy-mm-dd",
	});	
	
	
    $( "input[name='location']" ).autocomplete({
      source: base_url+"emergency/locations",
      minLength: 1,
    });
    $( "input[name='aircraft_type']" ).autocomplete({
      source: base_url+"emergency/aircrafttype",
      minLength: 1,
    });
    $( "input[name='aircraft_operator']" ).autocomplete({
      source: base_url+"emergency/aircraft_operator",
      minLength: 1,
    });
    $( "input[name='callsign']" ).autocomplete({
      source: base_url+"emergency/callsign",
      minLength: 1,
    });
    $( "input[name='dangerous_goods']" ).autocomplete({
      source: base_url+"emergency/dangerous_goods",
      minLength: 1,
    });
    $( "input[name='point_of_departure']" ).autocomplete({
      // source: base_url+"emergency/point_of_departure",
      source: base_url+"emergency/destination",
      minLength: 1,
    });
    $( "input[name='destination']" ).autocomplete({
      source: base_url+"emergency/destination",
      minLength: 1,
    });
    $( "input[name='airport']" ).autocomplete({
      source: base_url+"emergency/destination",
      minLength: 1,
    });
    $( "input[name='nature_of_accident']" ).autocomplete({
      source: base_url+"emergency/nature_of_accident",
      minLength: 1,
    });
    $( "input[name='position_name']" ).autocomplete({
      source: base_url+"emergency/position_name",
      minLength: 1,
    });
    $( "input[name='console_number']" ).autocomplete({
      source: base_url+"emergency/console_number",
      minLength: 1,
    });
    $( "input[name='system_equipment']" ).autocomplete({
      source: base_url+"emergency/system_equipment",
      minLength: 1,
    });
    $( "input[name='purpose_of_release']" ).autocomplete({
      source: base_url+"emergency/purpose_of_release",
      minLength: 1,
    });
    $( "input[name='original_destination']" ).autocomplete({
      source: base_url+"emergency/destination",
      minLength: 1,
    });
    $( "input[name='new_destination']" ).autocomplete({
      source: base_url+"emergency/destination",
      minLength: 1,
    });
    $( "input[name='reason']" ).autocomplete({
      source: base_url+"emergency/reason",
      minLength: 1,
    });
    $( "input[name='runway_in_use']" ).autocomplete({
      source: base_url+"emergency/runway_in_use",
      minLength: 1,
    });
    $( ".agl-select" ).change(function(){
			if($(this).val() == "Un Serviceable"){
				$(".agl-remarks").slideDown("slow");
			}else{
				$(".agl-remarks").slideUp("fast");
				$(".agl-remarks").find("textarea").attr("value","");
			}
		});
		$(".log-add-form").submit(function(){
			if(confirm("Please confirm to add the entry.")){
				return true;
			}else{
				return false;
			}
		});
		$(".runway-in-use-form").submit(function(event){
			var errors = false;
			$("form.runway-in-use-form").find("label.error").remove();
			
			
			var r31 = $('select[name="31R"]').val();
			var l31 = $('select[name="31L"]').val();
			var r13 = $('select[name="13R"]').val();
			var l13 = $('select[name="13L"]').val();
	
			if((r31 == "Arrival") && ((l13 == "Arrival") || (r13 == "Arrival"))){
				notyfy({
					text: '13L and 13R cannot be arrival when 31R is set to arrival.',
					type: 'error',
					layout: 'center',
					theme: 'boolight',
					closeWith: ['hover']
				});		
				errors = true;
			}else if((r31 == "Departure") && ((l13 == "Departure") || (r13 == "Departure"))){
				notyfy({
					text: '13L and 13R cannot be Departure when 31R is set to Departure.',
					type: 'error',
					layout: 'center',
					theme: 'boolight',
					closeWith: ['hover']
				});		
				errors = true;
			}else if((l31 == "Arrival") && ((l13 == "Arrival") || (r13 == "Arrival"))){
				notyfy({
					text: '13L and 13R cannot be Arrival when 31L is set to Arrival.',
					type: 'error',
					layout: 'center',
					theme: 'boolight',
					closeWith: ['hover']
				});		
				errors = true;
			}else if((l31 == "Departure") && ((l13 == "Departure") || (r13 == "Departure"))){
				notyfy({
					text: '13L and 13R cannot be Departure when 31L is set to Departure.',
					type: 'error',
					layout: 'center',
					theme: 'boolight',
					closeWith: ['hover']
				});		
				errors = true;
			}else if((r13 == "Arrival") && ((r31 == "Arrival") || (l31 == "Arrival"))){
				notyfy({
					text: '31L and 31R cannot be Arrival when 13R is set to Arrival.',
					type: 'error',
					layout: 'center',
					theme: 'boolight',
					closeWith: ['hover']
				});		
				errors = true;
			}else if((r13 == "Departure") && ((r31 == "Departure") || (l31 == "Departure"))){
				notyfy({
					text: '31L and 31R cannot be Departure when 13R is set to Departure.',
					type: 'error',
					layout: 'center',
					theme: 'boolight',
					closeWith: ['hover']
				});		
				errors = true;
			}else if((l13 == "Arrival") && ((r31 == "Arrival") || (l31 == "Arrival"))){
				notyfy({
					text: '31L and 31R cannot be Arrival when 13L is set to Arrival.',
					type: 'error',
					layout: 'center',
					theme: 'boolight',
					closeWith: ['hover']
				});		
				errors = true;
			}else if((l13 == "Departure") && ((r31 == "Departure") || (l31 == "Departure"))){
				notyfy({
					text: '31L and 31R cannot be Departure when 13L is set to Departure.',
					type: 'error',
					layout: 'center',
					theme: 'boolight',
					closeWith: ['hover']
				});		
				errors = true;
			}else if((r31 == "Closed/UnServiceable") && ((l13 != "Not In Use") && (l13 != "Closed/UnServiceable"))){
				// alert(l13);
				notyfy({
					text: '13L can only be <b>Not In Use</b> or <b>Closed / UnServiceable</b> when 31R is set to <b>Closed / UnServiceable</b>.',
					type: 'error',
					layout: 'center',
					theme: 'boolight',
					closeWith: ['hover']
				});		
				errors = true;
			}else if((l31 == "Closed/UnServiceable") && ((r13 != "Not In Use") && (r13 != "Closed/UnServiceable"))){
				// alert(r13);
				notyfy({
					text: '13R can only be <b>Not In Use</b> or <b>Closed / UnServiceable</b> when 31L is set to <b>Closed / UnServiceable</b>.',
					type: 'error',
					layout: 'center',
					theme: 'boolight',
					closeWith: ['hover']
				});		
				errors = true;
			}else if((r13 == "Closed/UnServiceable") && ((l31 != "Not In Use") && (l31 != "Closed/UnServiceable"))){
				// alert(r13);
				notyfy({
					text: '31L can only be <b>Not In Use</b> or <b>Closed / UnServiceable</b> when 13R is set to <b>Closed / UnServiceable</b>.',
					type: 'error',
					layout: 'center',
					theme: 'boolight',
					closeWith: ['hover']
				});		
				errors = true;
			}else if((l13 == "Closed/UnServiceable") && ((r31 != "Not In Use") && (r31 != "Closed/UnServiceable"))){
				// alert(r13);
				notyfy({
					text: '31R can only be <b>Not In Use</b> or <b>Closed / UnServiceable</b> when 13L is set to <b>Closed / UnServiceable</b>.',
					type: 'error',
					layout: 'center',
					theme: 'boolight',
					closeWith: ['hover']
				});		
				errors = true;
			}else{
				errors = false;			
			}
			console.log(errors);
			if(!errors){
				if(confirm("Please confirm to add the entry.")){
					return true;
				}else{
					return false;
				}			
			}else{
				return false;
			}
		});
		$(".cm1-add-form").submit(function(){
			if(confirm("Please confirm to add the entry.")){
				return true;
			}else{
				return false;
			}
		});
		$(".cm2-add-form").submit(function(){
			if(confirm("Please confirm to add the entry.")){
				return true;
			}else{
				return false;
			}
		});
		$(".acr-add-form").submit(function(){
			if(confirm("Please confirm to add the entry.")){
				return true;
			}else{
				return false;
			}
		});
		$(".vcr-add-form").submit(function(){
			if(confirm("Please confirm to add the entry.")){
				return true;
			}else{
				return false;
			}
		});
	$(".call-out-req").change(function(){
		if($(this).val() == "Yes"){
			$(".name2").slideDown();
			$(".shift-duty2").slideDown();
		}else{
			$(".name2").slideUp();
			$(".shift-duty2").slideUp();		
		}
	});
	
	$( "#permissions-tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
	$( "#permissions-tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
	
	$(".permissions-list").submit(function(event){
		event.preventDefault();
		var postData = $(this).serializeArray();
		console.log(postData);
		$.ajax({
			url:base_url+"index/updatePermissions",
			type:"post",
			data:postData,
			success:function(res){
				console.log(res);
				if(res == "permissions updated"){
					var n = notyfy({
						text: 'The permissions has been updated.',
						type: 'success',
						layout: 'topRight',
						theme: 'boolight',
						closeWith: ['hover']
					});				
				}else{
					var n = notyfy({
						text: res,
						type: 'error',
						layout: 'topRight',
						theme: 'boolight',
						closeWith: ['hover']
					});				
				}
			}
		});
	});
});
function aircraftcrash(id,curr_elem,popup_title,callstatus){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	data["callstatus"] = callstatus;
	$.ajax({
		url:base_url+"emergency/aircraftcrashedit",
		type:"post",
		data:data,
		success:function(html){

			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});

}
function aircraftgroundincident(id,curr_elem,popup_title,callstatus){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	data["callstatus"] = callstatus;
	$.ajax({
		url:base_url+"emergency/aircraftgroundincidentedit",
		type:"post",
		data:data,
		success:function(html){

			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});

}
function bombwarning(id,curr_elem,popup_title,callstatus){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	data["callstatus"] = callstatus;
	$.ajax({
		url:base_url+"emergency/bombwarningedit",
		type:"post",
		data:data,
		success:function(html){
		
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	
}

function practiseemergency(id,curr_elem,popup_title,callstatus){
	
	$( "#myModal" ).modal( "show" );
	//$( "#dialog" ).find( ".dialog-content" ).html("<img src='"+base_url+"assets/img/loading.gif' />");
	var data = new Object();
	data["id"] = id;
	data["callstatus"] = callstatus;
	$.ajax({
		url:base_url+"emergency/practiseemergencyedit",
		type:"post",
		data:data,
		success:function(html){
	
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});

}



function domesticfire(id,curr_elem,popup_title,callstatus){
	$( "#myModal" ).modal( "show" );
	//$( "#dialog" ).find( ".dialog-content" ).html("<img src='"+base_url+"assets/img/loading.gif' />");
	var data = new Object();
	data["id"] = id;
	data["callstatus"] = callstatus;
	$.ajax({
		url:base_url+"emergency/domesticfireedit",
		type:"post",
		data:data,
		success:function(html){
		
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});

}
function fuelspillage(id,curr_elem,popup_title,callstatus){
	$( "#myModal" ).modal( "show" );
	//$( "#dialog" ).find( ".dialog-content" ).html("<img src='"+base_url+"assets/img/loading.gif' />");
	var data = new Object();
	data["id"] = id;
	data["callstatus"] = callstatus;
	$.ajax({
		url:base_url+"emergency/fuelsipllageedit",
		type:"post",
		data:data,
		success:function(html){
	
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});

}
function fuelemergency(id,curr_elem,popup_title,callstatus){
	$( "#myModal" ).modal( "show" );
	//$( "#dialog" ).find( ".dialog-content" ).html("<img src='"+base_url+"assets/img/loading.gif' />");
	var data = new Object();
	data["id"] = id;
	data["callstatus"] = callstatus;
	$.ajax({
		url:base_url+"emergency/fuelsemergencyedit",
		type:"post",
		data:data,
		success:function(html){

			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});

}
function localstandby(id,curr_elem,popup_title,callstatus){
	$( "#myModal" ).modal( "show" );
	//$( "#dialog" ).find( ".dialog-content" ).html("<img src='"+base_url+"assets/img/loading.gif' />");
	var data = new Object();
	data["id"] = id;
	data["callstatus"] = callstatus;
	$.ajax({
		url:base_url+"emergency/localstandbyedit",
		type:"post",
		data:data,
		success:function(html){
			
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});

}
function medicalemergency(id,curr_elem,popup_title,callstatus){
	$( "#myModal" ).modal( "show" );
	//$( "#dialog" ).find( ".dialog-content" ).html("<img src='"+base_url+"assets/img/loading.gif' />");
	var data = new Object();
	data["id"] = id;
	data["callstatus"] = callstatus;
	$.ajax({
		url:base_url+"emergency/medicalemergencyedit",
		type:"post",
		data:data,
		success:function(html){
		
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	
}
function omademergencies(id,curr_elem,popup_title,callstatus){
	$( "#myModal" ).modal( "show" );
	//$( "#dialog" ).find( ".dialog-content" ).html("<img src='"+base_url+"assets/img/loading.gif' />");
	var data = new Object();
	data["id"] = id;
	data["callstatus"] = callstatus;
	$.ajax({
		url:base_url+"emergency/omademergenciesedit",
		type:"post",
		data:data,
		success:function(html){
	
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});

}
function ombyemergency(id,curr_elem,popup_title,callstatus){
	$( "#myModal" ).modal( "show" );
	//$( "#dialog" ).find( ".dialog-content" ).html("<img src='"+base_url+"assets/img/loading.gif' />");
	var data = new Object();
	data["id"] = id;
	data["callstatus"] = callstatus;
	$.ajax({
		url:base_url+"emergency/ombyemergencyedit",
		type:"post",
		data:data,
		success:function(html){
	
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});

}
function unlawfulinterference(id,curr_elem,popup_title,callstatus){
	$( "#myModal" ).modal( "show" );
	//$( "#dialog" ).find( ".dialog-content" ).html("<img src='"+base_url+"assets/img/loading.gif' />");
	var data = new Object();
	data["id"] = id;
	data["callstatus"] = callstatus;
	$.ajax({
		url:base_url+"emergency/unlawfulinterferenceedit",
		type:"post",
		data:data,
		success:function(html){
	
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	
}
function weatherstandby(id,curr_elem,popup_title,callstatus){
	$( "#myModal" ).modal( "show" );
	//$( "#dialog" ).find( ".dialog-content" ).html("<img src='"+base_url+"assets/img/loading.gif' />");
	var data = new Object();
	data["id"] = id;
	data["callstatus"] = callstatus;
	$.ajax({
		url:base_url+"emergency/weatherstandbyedit",
		type:"post",
		data:data,
		success:function(html){
			
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});

}
function generalentry(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	//$( "#dialog" ).find( ".dialog-content" ).html("<img src='"+base_url+"assets/img/loading.gif' />");
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"elog/generalentry_edit",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}
function runwaymanoeuvringareainspection(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	//$( "#dialog" ).find( ".dialog-content" ).html("<img src='"+base_url+"assets/img/loading.gif' />");
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"elog/runwaymanoeuvringareainspection_edit",
		type:"post",
		data:data,
		success:function(html){
		
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});

}
function updaterunwaymanoeuvringareainspection(log_id){
	if(confirm("Are you sure you want to update?")){
		var data = $(".emergency-edit-form").serializeArray();
		$.ajax({
			url:base_url+"elog/updaterunwaymanoeuvringareainspection?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				if(res == "updated"){
					window.location.href = base_url+"elog/mainview/updateSuccess";
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}







function enterdetails(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"elog/enterdetails",
		type:"post",
		data:data,
		success:function(html){
			
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});

}



function openclosedetails(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"elog/openclosedetails",
		type:"post",
		data:data,
		success:function(html){
			
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});

}





function acceptJobClose(id,engcode,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	data["engcode"] =engcode;
	$.ajax({
		url:base_url+"elog/acceptJobClose",
		type:"post",
		data:data,
		success:function(res){
			
			if(res == "updated"){
					window.location.href = base_url+"elog/mainview/updateSuccess";
				}else{
					alert("Some error occured please try again.");
				}
		}
		
		
		
		
	});

}


function cancelJobClose(id,engcode,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	data["engcode"] =engcode;
	$.ajax({
		url:base_url+"elog/cancelJobClose",
		type:"post",
		data:data,
		success:function(res){
			
			if(res == "updated"){
					window.location.href = base_url+"elog/mainview/updateSuccess";
				}else{
					alert("Some error occured please try again.");
				}
		}
		
		
		
		
	});

}











function faultreporting(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"elog/faultreporting_edit",
		type:"post",
		data:data,
		success:function(html){
			
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});

}





function acceptjob(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"index/jobcard",
		type:"post",
		data:data,
		success:function(html){
			
			document.location = base_url+"index/jobcard/" + id;
			
			
		}
	});

}




function CancelFaults(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"index/CancelFault",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".ui-dialog-title").html("Cancel Job");
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}

function SendItBck(id,curr_elem,popup_title,initial,error_text){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	data["initial"] = initial;
	data["error_text"] = error_text;
	$.ajax({
		url:base_url+"index/SendItBck",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".ui-dialog-title").html("Cancel Job");
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}


function trnferfault(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"index/trnferfault",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".ui-dialog-title").html("Transfer to another Department");
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}





function initiatelvo(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"elog/initiatelvo_edit",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}






function canceledlvosafeguarding(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"elog/canceledlvosafeguarding",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}




function addevent(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
		data["viewonly"]=0;
	$.ajax({
		url:base_url+"elog/addevent",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}


function closejob(id,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
		data["viewonly"]=0;
	$.ajax({
		url:base_url+"elog/closejob",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}




function viewevent(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	data["viewonly"]=1;
	$.ajax({
		url:base_url+"elog/addevent",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}





function viewevent(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	data["viewonly"]=1;
	$.ajax({
		url:base_url+"elog/addevent",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}







function addeventdetails(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"elog/addeventdetails",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}



function viewdetails(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"elog/viewdetails",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}













function CancelFault(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"index/CancelFault",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".ui-dialog-title").html("Cancel Job");
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}










function cancelofinitiate(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"elog/cancelofinitiate",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".ui-dialog-title").html("Initiate LVO Cancel");
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}




function canceledlvo(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"elog/canceledlvo",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}









function cancelationoflvosafe(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"elog/cancelationoflvosafe",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".ui-dialog-title").html("Initiate LVO Cancel");
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}














function safeguardinglvo(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"elog/insertsafeguardinglvo_edit",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}
function newjob(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"elog/newjob_edit",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}

function aircraftdiversion(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"elog/aircraftdiversion_edit",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}
function controlmobile1(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"elog/controlmobile1_edit",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}
function controlmobile2(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"elog/controlmobile2_edit",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}
function updateControlMobile(log_id){
	if(confirm("Are you sure you want to update?")){
		var data = $(".emergency-edit-form").serializeArray();
		$.ajax({
			url:base_url+"elog/updateControlMobile?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				if(res == "updated"){
					window.location.href = base_url+"elog/mainview/updateSuccess";
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$( "#dialog" ).dialog( "close" );
	}
}
function runwayinuse(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"elog/runwayinuse_edit",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}
function updateRunwayInUse(log_id){
	if(confirm("Are you sure you want to update?")){
		var data = $(".emergency-edit-form").serializeArray();
		$.ajax({
			url:base_url+"elog/updateRunwayInUse?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				if(res == "updated"){
					window.location.href = base_url+"elog/mainview/updateSuccess";
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}
function airfieldgroundlightingaglinspection(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"elog/agl_edit",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}
function updateAGL(log_id){
	if(confirm("Are you sure you want to update?")){
		var data = $(".emergency-edit-form").serializeArray();
		$.ajax({
			url:base_url+"elog/updateAGL?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				if(res == "updated"){
					window.location.href = base_url+"elog/mainview/updateSuccess";
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}
function terminal1t1atcfacilityinspection(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"elog/atc_edit",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}
function updateATC(log_id){
	if(confirm("Are you sure you want to update?")){
		var data = $(".emergency-edit-form").serializeArray();
		$.ajax({
			url:base_url+"elog/updateATC?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				if(res == "updated"){
					window.location.href = base_url+"elog/mainview/updateSuccess";
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}
function emergency_log_edit(id,curr_elem){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"emergency/emergency_log_edit",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}
function acceptfrn(table,id,curr_element){
	var data = new Object();
	data["id"] = id;
	data["table"] = table;
	$.ajax({
		url:base_url+"emergency/acceptfrn",
		type:"post",
		data:data,
		success:function(res){
			// console.log(res);
			// return;
			// alert(res);
			if(res != "error"){
				$(curr_element).parent().html(res);
				$("select[name='frnstatus']").find("option[selected='selected']").removeAttr("selected");
				$("select[name='frnstatus']").find("option[value='6']").attr("selected","selected").attr("disabled","disabled");
			}else{
				alert("Some error occured plase try again.");
			}
		}
	});
}
function updateEmergencyLog(log_id){
	if(confirm("Are you sure you want to update?")){
		var data = $(".emergency-edit-form").serializeArray();
		$.ajax({
			url:base_url+"emergency/updatelog?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				if(res == "updated"){
					window.location.href = base_url+"elog/mainview/updateSuccess";
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}
function generalentry_edit(id,curr_elem){
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"elog/generalentry_edit",
		type:"post",
		data:data,
		success:function(html){
			$(".messi-content").html(html);
		}
	});
	new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: 'Emergency Log Edit', modal: true});
}
function updateGeneralEntry(log_id){
	if(confirm("Are you sure you want to update?")){
		//var formdata = $(".emergency-edit-form").serializeArray().reverse();
		var data = new Object();
		 data["initial"] = $("input[name='initial']").val();
		 data["datetime"] = $("input[name='datetime']").val();
		 data["onbehalf"] = $("select[name='onbehalf']").val();
		 data["subject"] = $("input[name='subject']").val();
		 data["description"] = $("textArea[name='description']").val();
		 data["management"] = $("textArea[name='management']").val();
		 data["actions"] = $("textArea[name='actions']").val();
		
		
		$.ajax({
			url:base_url+"elog/updateGeneralEntry?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				
				if(res == "updated"){
					window.location.href = base_url+"elog/mainview/updateSuccess";
				}else{
					alert(res);
					
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}
function faultreporting_edit(id,curr_elem){
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"elog/faultreporting_edit",
		type:"post",
		data:data,
		success:function(html){
			$(".messi-content").html(html);
		}
	});
	new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: 'Emergency Log Edit', modal: true});
}
function updateFaultReporting(log_id){	
	
	if(confirm("Are you sure you want to update?")){
			
	    var data = new Object();
		 data["initial"] = $("input[name='initial']").val();
		 data["datetime"] = $("input[name='datetime']").val();
		 data["subject"] = $("input[name='subject']").val();
		 data["any_other_details"] = $("textArea[name='any_other_details']").val();
		 data["management"] = $("textArea[name='management']").val();
		 data["actions"] = $("textArea[name='actions']").val();
		 data["frnstatus"] = $("select[name='frnstatus']").val();
		 data["faultNum"] = $("input[name='faultNum']").val();
		 data["error_text"] = $("input[name='error_text']").val();
		 data["purpose_of_release"] = $("input[name='purpose_of_release']").val();
		 data["onbehalf"] = $("select[name='onbehalf']").val();
		 data["position_name"] = $("input[name='position_name']").val();
		 data["console_number"] = $("input[name='console_number']").val();
		 data["system_equipment"] = $("input[name='system_equipment']").val();
		
		 
	
		$.ajax({
			url:base_url+"elog/updateFaultReporting?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
           
				if(res == "updated"){
					if (/faultreports/i.test(window.location.href)){
						window.location.href = base_url+"elog/mainview/faultreports/updateSuccess";
					}else{
						window.location.href = base_url+"elog/mainview/updateSuccess";
					}
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}




function entersndbckdetails(log_id){
	//alert(log_id);
	if(confirm("Are you sure you want to update?")){
		var data = $(".emergency-edit-form").serializeArray();
		$.ajax({
			url:base_url+"elog/insertdetails?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				if(res == "updated"){
					if (/faultreports/i.test(window.location.href)){
						window.location.href = base_url+"elog/mainview/faultreports/updateSuccess";
					}else{
						window.location.href = base_url+"elog/mainview/updateSuccess";
					}
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}







function cancelsafeLVO(){
	if(confirm("Are you sure you want to update?")){
		var data = $(".emergency-edit-form").serializeArray();
		$.ajax({
			url:base_url+"elog/cancelsafeLVO?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				if(res == "updated"){
					window.location.href = base_url+"elog/mainview/updateSuccess";
				}else{
						window.location.href = base_url+"elog/mainview/updateSuccess";
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}




function insertNewjob(log_id,uri_segment){	
	// alert(uri_segment);
	if(confirm("Are you sure you want to update?")){
		var data = $(".emergency-edit-form").serializeArray();
		$.ajax({
			url:base_url+"elog/updateFaultReporting?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				if(res == "updated"){
					if (/faultreports/i.test(window.location.href)){
						window.location.href = base_url+"elog/mainview/faultreports/updateSuccess";
					}else{
						window.location.href = base_url+"elog/mainview/updateSuccess";
					}
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}






function cancellvo(log_id,uri_segment){	
	// alert(uri_segment);
	if(confirm("Are you sure you want to Cancel?")){
		var data = $(".emergency-edit-form").serializeArray();
		$.ajax({
			url:base_url+"elog/cancellvo?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				if(res == "updated"){
					if (/faultreports/i.test(window.location.href)){
						window.location.href = base_url+"elog/mainview/faultreports/updateSuccess";
					}else{
						window.location.href = base_url+"elog/mainview/updateSuccess";
					}
				}else{
			window.location.href = base_url+"elog/mainview/updateSuccess";
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}






















function deletesafeLVO(id,curr_elem,popup_title){
	if(confirm("Are you sure to delete the subject?")){
		var data = new Object();
		data["id"] = id;
		$.ajax({
			url:base_url+"elog/deletesafeLVO",
			data:data,
			type:"post",
			success:function(res){
				if(res == "deleted"){
					alert("Deleted");
					$(curr_elem).parent().parent().remove();
				}else{
					alert("Some error occurred please try again.");
				}
			}
		});
	}
}


























function aircraftdiversion_edit(id,curr_elem){
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"elog/aircraftdiversion_edit",
		type:"post",
		data:data,
		success:function(html){
			$(".messi-content").html(html);
		}
	});
	new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: 'Emergency Log Edit', modal: true});
}
function updateAirCraftDiversion(log_id){
	if(confirm("Are you sure you want to update?")){
		var data = $(".emergency-edit-form").serializeArray();
		$.ajax({
			url:base_url+"elog/updateAirCraftDiversion?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				if(res == "updated"){
					window.location.href = base_url+"elog/mainview/updateSuccess";
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}
function changeControlMobileStatus(curr){
	if($(curr).val() == "OUT"){
		$(curr).attr("value","IN");
		$(curr).removeClass("btn-red");
		$(curr).addClass("btn-blue");
	}else{
		$(curr).attr("value","OUT");
		$(curr).removeClass("btn-blue");
		$(curr).addClass("btn-red");
	}
}
function showSuccessMessage(message){
	$("span.message").html(message);		
	$(".success-msg").fadeIn("slow");
	$(".success-msg").fadeOut(5000);		
}
function confirmSubmit(){
	if(confirm('Please confirm to add the entry.')){
		$('.log-add-form').submit();
	}	
}
function confirmCM1Submit(){
	if(confirm('Please confirm to add the entry.')){
		$('.cm1-add-form').submit();
	}	
}
function confirmCM2Submit(){
	if(confirm('Please confirm to add the entry.')){
		$('.cm2-add-form').submit();
	}	
}
function confirmAGLSubmit(){
	if($("select[name='cat_routing']").val() == ""){
		new Messi('Select CAT- III Routing.', {title: 'Error', modal: true});
	}else if(confirm('Please confirm to add the entry.')){
		$('.log-add-form').submit();
	}	
}
function confirmVCRSubmit(){
	if(confirm('Please confirm to add Visual Control Room entry.')){
		$('.vcr-add-form').submit();
	}	
}
function confirmACRSubmit(){
	if(confirm('Please confirm to add Approach Control Room entry.')){
		$('.acr-add-form').submit();
	}	
}
function noshow(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"elog/noshow_edit",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}
function updatenoshow(log_id){
	if(confirm("Are you sure you want to update?")){
		var data = $(".emergency-edit-form").serializeArray();
		$.ajax({
			url:base_url+"elog/updatenoshow?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				if(res == "updated"){
					window.location.href = base_url+"elog/mainview/updateSuccess";
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}
function lateforduty(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"elog/lateforduty_edit",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}
function updatelateforduty(log_id){
	if(confirm("Are you sure you want to update?")){
		var data = $(".emergency-edit-form").serializeArray();
		$.ajax({
			url:base_url+"elog/updatelateforduty?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				if(res == "updated"){
					window.location.href = base_url+"elog/mainview/updateSuccess";
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}
function senthome(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"elog/senthome_edit",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}
function updatesenthome(log_id){
	if(confirm("Are you sure you want to update?")){
		var data = $(".emergency-edit-form").serializeArray();
		$.ajax({
			url:base_url+"elog/updatesenthome?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				if(res == "updated"){
					window.location.href = base_url+"elog/mainview/updateSuccess";
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}
function unavailableforduty(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"elog/unavailableforduty_edit",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}
function updateunavailableforduty(log_id){
	if(confirm("Are you sure you want to update?")){
		var data = $(".emergency-edit-form").serializeArray();
		$.ajax({
			url:base_url+"elog/updateunavailableforduty?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				if(res == "updated"){
					window.location.href = base_url+"elog/mainview/updateSuccess";
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}
function sicknessforduty(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"elog/sicknessforduty_edit",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}
function updatesicknessforduty(log_id){
	if(confirm("Are you sure you want to update?")){
		var data = $(".emergency-edit-form").serializeArray();
		$.ajax({
			url:base_url+"elog/updatesicknessforduty?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				if(res == "updated"){
					window.location.href = base_url+"elog/mainview/updateSuccess";
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}
function fitnessorreturnforduty(id,curr_elem,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"elog/fitnessorreturnforduty_edit",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}
function updatefitnessorreturnforduty(log_id){
	if(confirm("Are you sure you want to update?")){
		var data = $(".emergency-edit-form").serializeArray();
		$.ajax({
			url:base_url+"elog/updatefitnessorreturnforduty?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				if(res == "updated"){
					window.location.href = base_url+"elog/mainview/updateSuccess";
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}
function editSubject(id,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"domainparameters/editSubject",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}
function deleteSubject(id,curr_elem,popup_title){
	if(confirm("Are you sure to delete the subject?")){
		var data = new Object();
		data["id"] = id;
		$.ajax({
			url:base_url+"domainparameters/deleteSubject",
			data:data,
			type:"post",
			success:function(res){
				if(res == "deleted"){
					alert("Deleted");
					$(curr_elem).parent().parent().remove();
				}else{
					alert("Some error occurred please try again.");
				}
			}
		});
	}
}


function deleteF(id,curr_elem,popup_title){
	
	if(confirm("Are you sure to delete the Frequency?")){
		var data = new Object();
		data["id"] = id;
		$.ajax({
			url:base_url+"domainparameters/deleteFrequency",
			data:data,
			type:"post",
			success:function(res){
				if(res == "deleted"){
					alert("Deleted");
					$(curr_elem).parent().parent().remove();
				}else{
					alert("Some error occurred please try again.");
				}
			}
		});
	}
}



function deleteLRU(id,curr_elem,popup_title){
	
	if(confirm("Are you sure to delete the LRU?")){
		var data = new Object();
		data["id"] = id;
		$.ajax({
			url:base_url+"domainparameters/deleteLRU",
			data:data,
			type:"post",
			success:function(res){
				if(res == "deleted"){
					alert("Deleted");
					$(curr_elem).parent().parent().remove();
				}else{
					alert("Some error occurred please try again.");
				}
			}
		});
	}
}

function deleteOtherSection(id,curr_elem,popup_title){
	
	if(confirm("Are you sure to delete the Other Section?")){
		var data = new Object();
		data["id"] = id;
		$.ajax({
			url:base_url+"domainparameters/deleteOtherSection",
			data:data,
			type:"post",
			success:function(res){
				if(res == "deleted"){
					alert("Deleted");
					$(curr_elem).parent().parent().remove();
				}else{
					alert("Some error occurred please try again.");
				}
			}
		});
	}
}






function updateSubject(log_id){
	if(confirm("Are you sure you want to update?")){
		var data = new Object();
		data["subject"] = $("input[name='subject']").val();
		data["description"] = $("textarea[name='description']").val();
		if($(".active-domain").is(":checked")){
			data["active"] = "on";
		}else{
			data["active"] = "";		
		}
		if($(".management_report").is(":checked")){
			data["management_report"] = "on";
		}else{
			data["management_report"] = "";		
		}
		if($(".supervisor_report").is(":checked")){
			data["supervisor_report"] = "on";
		}else{
			data["supervisor_report"] = "";		
		}
		$.ajax({
			url:base_url+"domainparameters/updateSubject?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				// console.log(res);
				// return;
				if(res == "updated"){
					$( "#dialog" ).dialog( "close" );
					alert("Subject Updated.");
					window.location.reload();
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}

function updateF(log_id){
	
	if(confirm("Are you sure you want to update?")){
		var data = new Object();
		data["name"] = $("input[name='name']").val();
		data["description"] = $("textarea[name='description']").val();
		if($(".active-domain").is(":checked")){
			data["status"] = 1;
		}else{
			data["status"] = "";		
		}
		
		$.ajax({
			url:base_url+"domainparameters/updateFrequency?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				// console.log(res);
				// return;
				if(res == "updated"){
					$( "#dialog" ).dialog( "close" );
					alert("Frequency Updated.");
					window.location.reload();
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}



function updateLRU(log_id){
	
	if(confirm("Are you sure you want to update?")){
		var data = new Object();
		data["name"] = $("input[name='name']").val();
		data["description"] = $("textarea[name='description']").val();
		if($(".active-domain").is(":checked")){
			data["status"] = 1;
		}else{
			data["status"] = "";		
		}
		
		$.ajax({
			url:base_url+"domainparameters/updateLRU?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				// console.log(res);
				// return;
				if(res == "updated"){
					$( "#dialog" ).dialog( "close" );
					alert("LRU Updated.");
					window.location.reload();
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}



function updateOtherSection(log_id){
	
	if(confirm("Are you sure you want to update?")){
		var data = new Object();
		data["name"] = $("input[name='name']").val();
		data["description"] = $("textarea[name='description']").val();
		data["phone"] = $("input[name='phone']").val();
		data["initials_code"] = $("select[name='initials_code']").val();
		
		
		$.ajax({
			url:base_url+"domainparameters/updateOtherSection?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				// console.log(res);
				// return;
				if(res == "updated"){
					$( "#dialog" ).dialog( "close" );
					alert("OtherSection Updated.");
					window.location.reload();
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}


function updateCalibration(log_id){
	
	if(confirm("Are you sure you want to update?")){
		var data = new Object();
		data["name"] = $("input[name='name']").val();
		data["description"] = $("textarea[name='description']").val();
		if($(".active-domain").is(":checked")){
			data["status"] = 1;
		}else{
			data["status"] = "";		
		}
		
		$.ajax({
			url:base_url+"domainparameters/updateCalibration?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				// console.log(res);
				// return;
				if(res == "updated"){
					$( "#dialog" ).dialog( "close" );
					alert("Calibration Updated.");
					window.location.reload();
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}

function updateJobCard(log_id){
	
	if(confirm("Are you sure you want to update?")){
		var data = new Object();
		data["name"] = $("input[name='name']").val();
		data["description"] = $("textarea[name='description']").val();
		if($(".active-domain").is(":checked")){
			data["status"] = 1;
		}else{
			data["status"] = "";		
		}
		
		$.ajax({
			url:base_url+"domainparameters/updateJobCard?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				// console.log(res);
				// return;
				if(res == "updated"){
					$( "#dialog" ).dialog( "close" );
					alert("JobCard Updated.");
					window.location.reload();
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}


function editF(id,popup_title){
	
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"domainparameters/editF",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}



function editOtherSection(id,popup_title){
	
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"domainparameters/editOtherSection",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}

function editLRU(id,popup_title){
	
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"domainparameters/editLRU",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}

function editJobCard(id,popup_title){
	
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"domainparameters/editJobCard",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}


function editCalibration(id,popup_title){
	
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"domainparameters/editCalibration",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}



function editPosition(id,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"domainparameters/editPosition",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}






function deletePosition(id,curr_elem,popup_title){
	if(confirm("Are you sure to delete the Position Name?")){
		var data = new Object();
		data["id"] = id;
		$.ajax({
			url:base_url+"domainparameters/deletePosition",
			data:data,
			type:"post",
			success:function(res){
				if(res == "deleted"){
					alert("Deleted");
					$(curr_elem).parent().parent().remove();
				}else{
					alert("Some error occurred please try again.");
				}
			}
		});
	}
}


function deleteJobCard(id,curr_elem,popup_title){
	if(confirm("Are you sure to delete the Job Card Name?")){
		var data = new Object();
		data["id"] = id;
		$.ajax({
			url:base_url+"domainparameters/deleteJobCard",
			data:data,
			type:"post",
			success:function(res){
				if(res == "deleted"){
					alert("Deleted");
					$(curr_elem).parent().parent().remove();
				}else{
					alert("Some error occurred please try again.");
				}
			}
		});
	}
}


function deleteCalibration(id,curr_elem,popup_title){
	if(confirm("Are you sure to delete the Calibration Name?")){
		var data = new Object();
		data["id"] = id;
		$.ajax({
			url:base_url+"domainparameters/deleteCalibration",
			data:data,
			type:"post",
			success:function(res){
				if(res == "deleted"){
					alert("Deleted");
					$(curr_elem).parent().parent().remove();
				}else{
					alert("Some error occurred please try again.");
				}
			}
		});
	}
}
function dpSelectChange(curr_elem){
	var selected_unit = $(curr_elem).val();
	$(curr_elem).find("option[selected='selected']").removeAttr("selected");
	$(curr_elem).find("option[value='"+selected_unit+"']").attr("selected","selected");
	// var unit = $(curr_elem).val();
	// console.log(unit);
	// $(curr_elem).attr("selected","selected");
	// $(curr_elem).find("option").removeAttr("selected");
	// $(curr_elem).find("option[value='"+unit+"']").attr("selected");
}
function updatePosition(log_id){
	if(confirm("Are you sure you want to update?")){
		var data = new Object();
		data["name"] = $("input[name='name']").val();
		data["description"] = $("textarea[name='description']").val();
		data["unit_id"] = $("select[name='agentunit'] option[selected='selected']").attr("value");
		// console.log(data);
		// return;
		if($(".active-domain").is(":checked")){
			data["active"] = "on";
		}else{
			data["active"] = "";		
		}
		$.ajax({
			url:base_url+"domainparameters/updatePosition?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				// console.log(res);
				// return;
				if(res == "updated"){
					$( "#dialog" ).dialog( "close" );
					alert("Position Updated.");
					window.location.reload();
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}
function editEquipment(id,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"domainparameters/editEquipment",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}
function deleteEquipment(id,curr_elem,popup_title){
	if(confirm("Are you sure to delete the Equipment name?")){
		var data = new Object();
		data["id"] = id;
		$.ajax({
			url:base_url+"domainparameters/deleteEquipment",
			data:data,
			type:"post",
			success:function(res){
				if(res == "deleted"){
					alert("Deleted");
					$(curr_elem).parent().parent().remove();
				}else{
					alert("Some error occurred please try again.");
				}
			}
		});
	}
}
function updateEquipment(log_id){
	if(confirm("Are you sure you want to update?")){
		var data = new Object();
		data["name"] = $("input[name='name']").val();
		data["description"] = $("textarea[name='description']").val();
		data["unit_id"] = $("select[name='agentunit'] option[selected='selected']").attr("value");
		if($(".active-domain").is(":checked")){
			data["active"] = "on";
		}else{
			data["active"] = "";		
		}
		$.ajax({
			url:base_url+"domainparameters/updateEquipment?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				// console.log(res);
				// return;
				if(res == "updated"){
					$( "#dialog" ).dialog( "close" );
					alert("Equipment Updated.");
					window.location.reload();
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}
function editConsoleNumber(id,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"domainparameters/editConsoleNumber",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}
function deleteConsoleNumber(id,curr_elem,popup_title){
	if(confirm("Are you sure to delete the Console Number?")){
		var data = new Object();
		data["id"] = id;
		$.ajax({
			url:base_url+"domainparameters/deleteConsoleNumber",
			data:data,
			type:"post",
			success:function(res){
				if(res == "deleted"){
					alert("Deleted");
					$(curr_elem).parent().parent().remove();
				}else{
					alert("Some error occurred please try again.");
				}
			}
		});
	}
}

function deleteS(id,curr_elem,popup_title){
	console.log("abcd");
	if(confirm("Are you sure to delete the Frequency?")){
		var data = new Object();
		data["id"] = id;
		$.ajax({
			url:base_url+"domainparameters/deleteFrequency",
			data:data,
			type:"post",
			success:function(res){
				if(res == "deleted"){
					alert("Deleted");
					$(curr_elem).parent().parent().remove();
				}else{
					alert("Some error occurred please try again.");
				}
			}
		});
	}
}


function updateConsoleNumber(log_id){
	if(confirm("Are you sure you want to update?")){
		var data = new Object();
		data["name"] = $("input[name='name']").val();
		data["description"] = $("textarea[name='description']").val();
		data["unit_id"] = $("select[name='agentunit'] option[selected='selected']").attr("value");
		if($(".active-domain").is(":checked")){
			data["active"] = "on";
		}else{
			data["active"] = "";		
		}
		$.ajax({
			url:base_url+"domainparameters/updateConsoleNumber?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				// console.log(res);
				// return;
				if(res == "updated"){
					$( "#dialog" ).dialog( "close" );
					alert("Console Number Updated.");
					window.location.reload();
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}
function editReleasePurpose(id,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"domainparameters/editReleasePurpose",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}
function deleteReleasePurpose(id,curr_elem,popup_title){
	if(confirm("Are you sure to delete the Release Purpose?")){
		var data = new Object();
		data["id"] = id;
		$.ajax({
			url:base_url+"domainparameters/deleteReleasePurpose",
			data:data,
			type:"post",
			success:function(res){
				if(res == "deleted"){
					alert("Deleted");
					$(curr_elem).parent().parent().remove();
				}else{
					alert("Some error occurred please try again.");
				}
			}
		});
	}
}
function updateReleasePurpose(log_id){
	if(confirm("Are you sure you want to update?")){
		var data = new Object();
		data["name"] = $("input[name='name']").val();
		data["description"] = $("textarea[name='description']").val();
		if($(".active-domain").is(":checked")){
			data["active"] = "on";
		}else{
			data["active"] = "";		
		}
		$.ajax({
			url:base_url+"domainparameters/updateReleasePurpose?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				// console.log(res);
				// return;
				if(res == "updated"){
					$( "#dialog" ).dialog( "close" );
					alert("Release Purpose Updated.");
					window.location.reload();
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}
function editAircraftType(id,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"domainparameters/editAircraftType",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}
function deleteAircraftType(id,curr_elem,popup_title){
	if(confirm("Are you sure to delete the Aircraft type?")){
		var data = new Object();
		data["id"] = id;
		$.ajax({
			url:base_url+"domainparameters/deleteAircraftType",
			data:data,
			type:"post",
			success:function(res){
				if(res == "deleted"){
					alert("Deleted");
					$(curr_elem).parent().parent().remove();
				}else{
					alert("Some error occurred please try again.");
				}
			}
		});
	}
}
function updateAircraftType(log_id){
	if(confirm("Are you sure you want to update?")){
		var data = new Object();
		data["name"] = $("input[name='name']").val();
		data["description"] = $("textarea[name='description']").val();
		if($(".active-domain").is(":checked")){
			data["active"] = "on";
		}else{
			data["active"] = "";		
		}
		$.ajax({
			url:base_url+"domainparameters/updateAircraftType?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				// console.log(res);
				// return;
				if(res == "updated"){
					$( "#dialog" ).dialog( "close" );
					alert("Aircraft Type Updated.");
					window.location.reload();
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}
function editAirport(id,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"domainparameters/editAirport",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}
function deleteAirport(id,curr_elem,popup_title){
	if(confirm("Are you sure to delete the Airport?")){
		var data = new Object();
		data["id"] = id;
		$.ajax({
			url:base_url+"domainparameters/deleteAirport",
			data:data,
			type:"post",
			success:function(res){
				if(res == "deleted"){
					alert("Deleted");
					$(curr_elem).parent().parent().remove();
				}else{
					alert("Some error occurred please try again.");
				}
			}
		});
	}
}
function updateAirport(log_id){
	if(confirm("Are you sure you want to update?")){
		var data = new Object();
		data["airport"] = $("input[name='airport']").val();
		data["description"] = $("textarea[name='description']").val();
		if($(".active-domain").is(":checked")){
			data["active"] = "on";
		}else{
			data["active"] = "";		
		}
		$.ajax({
			url:base_url+"domainparameters/updateAirport?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				// console.log(res);
				// return;
				if(res == "updated"){
					$( "#dialog" ).dialog( "close" );
					alert("Airport Updated.");
					window.location.reload();
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}
function editShift(id,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"domainparameters/editShift",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}
function deleteShift(id,curr_elem,popup_title){
	if(confirm("Are you sure to delete the Shift?")){
		var data = new Object();
		data["id"] = id;
		$.ajax({
			url:base_url+"domainparameters/deleteShift",
			data:data,
			type:"post",
			success:function(res){
				if(res == "deleted"){
					alert("Deleted");
					$(curr_elem).parent().parent().remove();
				}else{
					alert("Some error occurred please try again.");
				}
			}
		});
	}
}
function updateShift(log_id){
	if(confirm("Are you sure you want to update?")){
		var data = new Object();
		data["shift"] = $("input[name='shift']").val();
		data["description"] = $("textarea[name='description']").val();
		if($(".active-domain").is(":checked")){
			data["active"] = "on";
		}else{
			data["active"] = "";		
		}
		$.ajax({
			url:base_url+"domainparameters/updateShift?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				// console.log(res);
				// return;
				if(res == "updated"){
					$( "#dialog" ).dialog( "close" );
					alert("Shift Updated.");
					window.location.reload();
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}
function editStaffAbsenseReason(id,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"domainparameters/editStaffAbsenseReason",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}
function deleteStaffAbsenseReason(id,curr_elem,popup_title){
	if(confirm("Are you sure to delete the Staff Absense Reason?")){
		var data = new Object();
		data["id"] = id;
		$.ajax({
			url:base_url+"domainparameters/deleteStaffAbsenseReason",
			data:data,
			type:"post",
			success:function(res){
				if(res == "deleted"){
					alert("Deleted");
					$(curr_elem).parent().parent().remove();
				}else{
					alert("Some error occurred please try again.");
				}
			}
		});
	}
}
function updateStaffAbsenseReason(log_id){
	if(confirm("Are you sure you want to update?")){
		var data = new Object();
		data["reason"] = $("input[name='reason']").val();
		data["description"] = $("textarea[name='description']").val();
		if($(".active-domain").is(":checked")){
			data["active"] = "on";
		}else{
			data["active"] = "";		
		}
		$.ajax({
			url:base_url+"domainparameters/updateStaffAbsenseReason?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				// console.log(res);
				// return;
				if(res == "updated"){
					$( "#dialog" ).dialog( "close" );
					alert("Staff Absense Reason Updated.");
					window.location.reload();
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}
function editRunwayManoeuvringArea(id,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"domainparameters/editRunwayManoeuvringArea",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}
function deleteRunwayManoeuvringArea(id,curr_elem,popup_title){
	if(confirm("Are you sure to delete the Runway Manoeuvring Area?")){
		var data = new Object();
		data["id"] = id;
		$.ajax({
			url:base_url+"domainparameters/deleteRunwayManoeuvringArea",
			data:data,
			type:"post",
			success:function(res){
				if(res == "deleted"){
					alert("Deleted");
					$(curr_elem).parent().parent().remove();
				}else{
					alert("Some error occurred please try again.");
				}
			}
		});
	}
}
function updateRunwayManoeuvringArea(log_id){
	if(confirm("Are you sure you want to update?")){
		var data = new Object();
		data["areaname"] = $("input[name='areaname']").val();
		data["description"] = $("textarea[name='description']").val();
		data["unit_id"] = $("select[name='agentunit'] option[selected='selected']").attr("value");
		if($(".active-domain").is(":checked")){
			data["active"] = 'on';
		}else{
			data["active"] = "";		
		}
		

		
		$.ajax({
			url:base_url+"domainparameters/updateRunwayManoeuvringArea?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
			
				 
				if(res == "updated"){
					$( "#dialog" ).dialog( "close" );
					alert("Runway Manoeuvring Area Updated.");
					window.location.reload();
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}
function editNationality(id,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"domainparameters/editNationality",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}
function deleteNationality(id,curr_elem,popup_title){
	if(confirm("Are you sure to delete the Nationality?")){
		var data = new Object();
		data["id"] = id;
		$.ajax({
			url:base_url+"domainparameters/deleteNationality",
			data:data,
			type:"post",
			success:function(res){
				if(res == "deleted"){
					alert("Deleted");
					$(curr_elem).parent().parent().remove();
				}else{
					alert("Some error occurred please try again.");
				}
			}
		});
	}
}
function updateNationality(log_id){
	if(confirm("Are you sure you want to update?")){
		var data = new Object();
		data["nationality"] = $("input[name='nationality']").val();
		data["description"] = $("textarea[name='description']").val();
		if($(".active-domain").is(":checked")){
			data["active"] = "on";
		}else{
			data["active"] = "";		
		}
		$.ajax({
			url:base_url+"domainparameters/updateNationality?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				// console.log(res);
				// return;
				if(res == "updated"){
					$( "#dialog" ).dialog( "close" );
					alert("Nationality Updated.");
					window.location.reload();
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}
function editDesignation(id,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"domainparameters/editDesignation",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}
function deleteDesignation(id,curr_elem,popup_title){
	if(confirm("Are you sure to delete the Designation?")){
		var data = new Object();
		data["id"] = id;
		$.ajax({
			url:base_url+"domainparameters/deleteDesignation",
			data:data,
			type:"post",
			success:function(res){
				if(res == "deleted"){
					alert("Deleted");
					$(curr_elem).parent().parent().remove();
				}else{
					alert("Some error occurred please try again.");
				}
			}
		});
	}
}
function updateDesignation(log_id){
	if(confirm("Are you sure you want to update?")){
		var data = new Object();
		data["designation"] = $("input[name='designation']").val();
		data["description"] = $("textarea[name='description']").val();
		if($(".active-domain").is(":checked")){
			data["active"] = "on";
		}else{
			data["active"] = "";		
		}
		$.ajax({
			url:base_url+"domainparameters/updateDesignation?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				// console.log(res);
				// return;
				if(res == "updated"){
					$( "#dialog" ).dialog( "close" );
					alert("Designation Updated.");
					window.location.reload();
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}
function editCompany(id,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"domainparameters/editCompany",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}
function deleteCompany(id,curr_elem,popup_title){
	if(confirm("Are you sure to delete the Company?")){
		var data = new Object();
		data["id"] = id;
		$.ajax({
			url:base_url+"domainparameters/deleteCompany",
			data:data,
			type:"post",
			success:function(res){
				if(res == "deleted"){
					alert("Deleted");
					$(curr_elem).parent().parent().remove();
				}else{
					alert("Some error occurred please try again.");
				}
			}
		});
	}
}
function updateCompany(log_id){
	if(confirm("Are you sure you want to update?")){
		var data = new Object();
		data["name"] = $("input[name='name']").val();
		data["description"] = $("textarea[name='description']").val();
		if($(".active-domain").is(":checked")){
			data["active"] = "on";
		}else{
			data["active"] = "";		
		}
		$.ajax({
			url:base_url+"domainparameters/updateCompany?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				// console.log(res);
				// return;
				if(res == "updated"){
					$( "#dialog" ).dialog( "close" );
					alert("Company Updated.");
					window.location.reload();
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}


function editInstructionType(id,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"domainparameters/editInstructionType",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}
function deleteInstructionType(id,curr_elem,popup_title){
	if(confirm("Are you sure to delete the Company?")){
		var data = new Object();
		data["id"] = id;
		$.ajax({
			url:base_url+"domainparameters/deleteInstructionType",
			data:data,
			type:"post",
			success:function(res){
				if(res == "deleted"){
					alert("Deleted");
					$(curr_elem).parent().parent().remove();
				}else{
					alert("Some error occurred please try again.");
				}
			}
		});
	}
}
function updateInstructionType(log_id){
	if(confirm("Are you sure you want to update?")){
		var data = new Object();
		data["name"] = $("input[name='name']").val();
		data["description"] = $("textarea[name='description']").val();
		if($(".active-domain").is(":checked")){
			data["active"] = "on";
		}else{
			data["active"] = "";		
		}
		$.ajax({
			url:base_url+"domainparameters/updateInstructionType?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				// console.log(res);
				// return;
				if(res == "updated"){
					$( "#dialog" ).dialog( "close" );
					alert("Instruction Type Updated.");
					window.location.reload();
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}























function downloadPDF(target){
	/* var specialElementHandlers = {
			'#editor': function (element,renderer) {
					return true;
			}
	};
	var doc = new jsPDF();
	doc.fromHTML($(target).get(0), 5, 2, {
	'width': 970, 
	'elementHandlers': specialElementHandlers
	});
	// $(".col-action,.btn-delete-row").hide();
	doc.save('sample-file.pdf');
	// $(".col-action,.btn-delete-row").show(); */
	$(".col-action,.btn-delete-row").hide();
	$(target).print();
	$(".col-action,.btn-delete-row").show();
}
function editInstruction(id,curr_elem,popup_title,view){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"instructions/editInstruction",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
			$( "input[name='view']" ).val( view );
			
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}
function updateInstruction(log_id,view){
	// alert(view);
	// return;
	if(confirm("Are you sure you want to update?")){
		var data = $(".inst-edit-form").serializeArray();
		$.ajax({
			url:base_url+"instructions/updateInstruction?log_id="+log_id,
			type:"post",
			data:data,
			success:function(res){
				console.log(res);
				return;
				if(res == "updated"){
					window.location.href = base_url+"instructions/"+view+"/updateSuccess";
					// alert("Instruction Updated.");
					// window.location.href = window.location.href;
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}
function deleteInstruction(id,curr_elem,popup_title){
	if(confirm("Are you sure to delete the Instruction?")){
		var data = new Object();
		data["id"] = id;
		$.ajax({
			url:base_url+"instructions/deleteInstruction",
			data:data,
			type:"post",
			success:function(res){
				if(res == "deleted"){
					$(curr_elem).parent().parent().remove();
					alert("Deleted");
				}else{
					alert("Some error occurred please try again.");
				}
			}
		});
	}
}
function notifications(curr_elem){
	if($(curr_elem).find("ul").is(":visible")){
		$(curr_elem).find("ul").slideUp("slow");
	}
}
function readInstruction(id,popup_title,curr_inst){
	// $( "#dialog" ).dialog( "open" );
	// $( "#dialog" ).find( ".dialog-content" ).html("<img src='"+base_url+"assets/img/loading.gif' />");
	//new Messi("<img src='"+base_url+"assets/img/loading.gif' class='messi-loading' />", {title: popup_title, modal: true,width:800});
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"instructions/readInstruction",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html("aaaaaaaaaaaaaaa");
			$("#myModal").modal('show');
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
			
			var readData = new Object();
			readData["agentcode"] = agentcode;
			readData["instruction_id"] = id;
			$.ajax({
				url:			base_url+"instructions/recordRead",
				type:			"post",
				data:			readData,
				success:	function(resRead){
					var num_of_inst = parseInt($(".num-of-inst").html());
					$(".num-of-inst").html(num_of_inst-1);
					$(curr_inst).remove();
					console.log(resRead);
				}
			});
			// $( "input[name='view']" ).val( view );
		}
	});
}








function readaceptancenoti(id,popup_title,curr_inst){
	$( "#dialog" ).dialog( "open" );
	 $( "#dialog" ).find( ".dialog-content" ).html("<img src='"+base_url+"assets/img/loading.gif' />");
	//new Messi("<img src='"+base_url+"assets/img/loading.gif' class='messi-loading' />", {title: popup_title, modal: true,width:800});
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"instructions/readacceptance_noti",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html("aaaaaaaaaaaaaaa");
			//$(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
			
			var readData = new Object();
			readData["agentcode"] = agentcode;
			readData["instruction_id"] = id;
			$.ajax({
				url:			base_url+"instructions/aceptRead",
				type:			"post",
				data:			readData,
				success:	function(resRead){
					var num_of_inst = parseInt($(".num-of-sndbck").html());
					$(".num-of-sndbck").html(num_of_inst-1);
					$(curr_inst).remove();
					console.log(resRead);
				}
			});
			// $( "input[name='view']" ).val( view );
		}
	});
}









function readInstruction_report(id,popup_title,curr_inst){
	// $( "#dialog" ).dialog( "open" );
	// $( "#dialog" ).find( ".dialog-content" ).html("<img src='"+base_url+"assets/img/loading.gif' />");
	new Messi("<img src='"+base_url+"assets/img/loading.gif' class='messi-loading' />", {title: popup_title, modal: true,width:800});
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"instructions/readInstruction",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html("aaaaaaaaaaaaaaa");
			$(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
			
			// var readData = new Object();
			// readData["agentcode"] = agentcode;
			// readData["instruction_id"] = id;
			// $.ajax({
				// url:			base_url+"instructions/recordRead",
				// type:			"post",
				// data:			readData,
				// success:	function(resRead){
					// var num_of_inst = parseInt($(".num-of-inst").html());
					// $(".num-of-inst").html(num_of_inst-1);
					// $(curr_inst).remove();
					// console.log(resRead);
				// }
			// });
			// $( "input[name='view']" ).val( view );
		}
	});
}
function readNotification(id,popup_title,curr_inst,notif_id,atc_report){
	
	// $( "#dialog" ).dialog( "open" );
	// $( "#dialog" ).find( ".dialog-content" ).html("<img src='"+base_url+"assets/img/loading.gif' />");
	//new Messi("<img src='"+base_url+"assets/img/loading.gif' class='messi-loading' />", {title: popup_title, modal: true,width:800});
	var data = new Object();
	data["id"] = id;
	data["notif_id"] = notif_id;
	
	
	$.ajax({
		url:base_url+"instructions/readNotification",
		type:"post",
		data:data,
		success:function(html){
		
			$("#myModal").modal('show');
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
			if(atc_report == 1){
				$('.notifications-list li[notif_id="'+notif_id+'"]').remove();
				var num_of_notif = parseInt($(".num-of-notif").html());
				$(".num-of-notif").html(num_of_notif-1);
			}
		
		}
	});
}
function approveNotification(notif_id,curr_elem){
    
	var postData = new Object();
	postData["notif_id"] = notif_id;
	
	$.ajax({
		url:base_url+"instructions/approveNotification",
		type:"post",
		data: postData,
		success:function(res){
		
			if(res == 'Successfully Updated.'){
				
				alert('Equipment Release Approved.');
				location.reload();
			
				$('.notifications-list li[notif_id="'+notif_id+'"],.messi,.messi-modal,.ui-tooltip.qtip.ui-tooltip-default.ui-tooltip-shadow.ui-tooltip-tipsy.ui-tooltip-pos-tc.ui-tooltip-focus').remove();
				var num_of_notif = parseInt($(".num-of-notif").html());
				$(".num-of-notif").html(num_of_notif-1);
				new Messi('<div class="success-dialog"><span class="success">'+res+'</span></div>', {title: res, modal: true,width:600});
				setTimeout(function(){
					$(".messi-modal,.messi").remove();
				},2000);
				
			}else{
				new Messi('<div class="error-dialog"><span class="error">'+res+'</span></div>', {title: "Error", modal: true,width:600});
				setTimeout(function(){
						$(".messi-modal,.messi").remove();
				},2000);
				location.reload();
			}
		}
	});
}
function rejectNotification(notif_id,curr_elem){

	var postData = new Object();
	postData["notif_id"] = notif_id;
	$.ajax({
		url:base_url+"instructions/rejectNotification",
		type:"post",
		data: postData,
		success:function(res){
			console.log(res);
			if(res == "Successfully Updated."){
				alert('Equipment Release Rejected.');
				location.reload();
				$('.notifications-list li[notif_id="'+notif_id+'"],.messi,.messi-modal,.ui-tooltip.qtip.ui-tooltip-default.ui-tooltip-shadow.ui-tooltip-tipsy.ui-tooltip-pos-tc.ui-tooltip-focus').remove();
				var num_of_notif = parseInt($(".num-of-notif").html());
				$(".num-of-notif").html(num_of_notif-1);
				new Messi('<div class="success-dialog"><span class="success">'+res+'</span></div>', {title: res, modal: true,width:600});
				setTimeout(function(){
					$(".messi-modal,.messi").remove();
				},2000);
			}else{
				new Messi('<div class="error-dialog"><span class="error">'+res+'</span></div>', {title: "Error", modal: true,width:600});
				setTimeout(function(){
						$(".messi-modal,.messi").remove();
				},2000);
				location.reload();
			}
		}
	});
}
function readInstructionPage(id,popup_title,curr_inst){
	//alert("abc");
	// $( "#dialog" ).dialog( "open" );
	// $( "#dialog" ).find( ".dialog-content" ).html("<img src='"+base_url+"assets/img/loading.gif' />");
	//new Messi("<img src='"+base_url+"assets/img/loading.gif' class='messi-loading' />", {title: popup_title, modal: true,width:800});
	var data = new Object();
	data["id"] = id;
	
	$.ajax({
		url:base_url+"instructions/readInstruction",
		
		type:"post",
		data:data,
		
		success:function(html){
			// $(".messi-content").html("aaaaaaaaaaaaaaa");
			//$(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
			$( "#myModal" ).modal( "show" );
			var readData = new Object();
			readData["agentcode"] = agentcode;
			readData["instruction_id"] = id;
			$.ajax({
				url:			base_url+"instructions/recordRead",
				type:			"post",
				data:			readData,
				success:	function(resRead){
					if( ($("ul.instructions-list").find("li[title='"+popup_title+"']").html()) != undefined ){
						$("ul.instructions-list").find("li[title='"+popup_title+"']").remove();
						var num_of_inst = parseInt($(".num-of-inst").html());
						$(".num-of-inst").html(num_of_inst-1);
					}
					// $(curr_inst).parent().remove();
					console.log(resRead);
				}
			});
			
			
			// $( "input[name='view']" ).val( view );
		}
	});
}
function readInstructionAgain(id,popup_title,curr_inst){
	// $( "#dialog" ).dialog( "open" );
	// $( "#dialog" ).find( ".dialog-content" ).html("<img src='"+base_url+"assets/img/loading.gif' />");
	new Messi("<img src='"+base_url+"assets/img/loading.gif' class='messi-loading' />", {title: popup_title, modal: true,width:800});
	var data = new Object();
	data["id"] = id;
	$.ajax({
		url:base_url+"instructions/readInstruction",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html("aaaaaaaaaaaaaaa");
			$(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
			
			var readData = new Object();
			readData["agentcode"] = agentcode;
			readData["instruction_id"] = id;
			$.ajax({
				url:			base_url+"instructions/recordRead",
				type:			"post",
				data:			readData,
				success:	function(resRead){
					// var num_of_inst = parseInt($(".num-of-inst").html());
					// $(".num-of-inst").html(num_of_inst-1);
					// $(curr_inst).parent().remove();
					console.log(resRead);
				}
			});
			
			
			// $( "input[name='view']" ).val( view );
		}
	});
}



































function editEmail(email_id,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["email_id"] = email_id;
	$.ajax({
		url:base_url+"domainparameters/editEmail",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}
function deleteEmail(email_id,curr_elem,popup_title){
	if(confirm("Are you sure to delete the subject?")){
		var data = new Object();
		data["email_id"] = email_id;
		$.ajax({
			url:base_url+"domainparameters/deleteEmail",
			data:data,
			type:"post",
			success:function(res){
				if(res == "deleted"){
					alert("Deleted");
					$(curr_elem).parent().parent().remove();
				}else{
					alert("Some error occurred please try again.");
				}
			}
		});
	}
}
function updateEmail(email_id){
	if(confirm("Are you sure you want to update?")){
		var data = $("#email-edit-form").serializeArray();
		// var data = new Object();
		// data["email_address"] = $("input[name='email_address']").val();
		// data["for_form"] = $("select[name='for_form']").val();
		// data["description"] = $("textarea[name='description']").val();
		$.ajax({
			url:base_url+"domainparameters/updateEmail?email_id="+email_id,
			type:"post",
			data:data,
			success:function(res){
				// console.log(res);
				// return;
				if(res == "updated"){
					$( "#dialog" ).dialog( "close" );
					alert("Email Updated.");
					window.location.reload();
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}





























function editPhone(phone_id,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["phone_id"] = phone_id;
	$.ajax({
		url:base_url+"domainparameters/editPhone",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}
function deletePhone(phone_id,curr_elem,popup_title){
	if(confirm("Are you sure to delete the Phone?")){
		var data = new Object();
		data["phone_id"] = phone_id;
		$.ajax({
			url:base_url+"domainparameters/deletePhone",
			data:data,
			type:"post",
			success:function(res){
				if(res == "deleted"){
					alert("Deleted");
					$(curr_elem).parent().parent().remove();
				}else{
					alert("Some error occurred please try again.");
				}
			}
		});
	}
}
function updatePhone(phone_id){
	if(confirm("Are you sure you want to update?")){
		var data = $("#phone-edit-form").serializeArray();
		// var data = new Object();
		// data["phone_number"] = $("input[name='phone_number']").val();
		// data["for_form"] = $("select[name='for_form']").val();
		// data["description"] = $("textarea[name='description']").val();
		$.ajax({
			url:base_url+"domainparameters/updatePhone?phone_id="+phone_id,
			type:"post",
			data:data,
			success:function(res){
				// console.log(res);
				// return;
				if(res == "updated"){
					$( "#dialog" ).dialog( "close" );
					alert("Phone Updated.");
					window.location.reload();
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}










function editRunway(runway_id,popup_title){
	$( "#myModal" ).modal( "show" );
	var data = new Object();
	data["runway_id"] = runway_id;
	$.ajax({
		url:base_url+"domainparameters/editRunway",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			$(".modal-title").html(popup_title);
			$(".modal-body").html(html);
		}
	});
	// new Messi("<img src='"+base_url+"assets/img/loading.gif' />", {title: popup_title, modal: true});
}
function deleteRunway(runway_id,curr_elem,popup_title){
	if(confirm("Are you sure to delete the Runway?")){
		var data = new Object();
		data["runway_id"] = runway_id;
		$.ajax({
			url:base_url+"domainparameters/deleteRunway",
			data:data,
			type:"post",
			success:function(res){
				if(res == "deleted"){
					alert("Deleted");
					$(curr_elem).parent().parent().remove();
				}else{
					alert("Some error occurred please try again.");
				}
			}
		});
	}
}
function updateRunway(runway_id){
	if(confirm("Are you sure you want to update?")){
		var data = $("#phone-edit-form").serializeArray();
		// var data = new Object();
		// data["phone_number"] = $("input[name='phone_number']").val();
		// data["for_form"] = $("select[name='for_form']").val();
		// data["description"] = $("textarea[name='description']").val();
		$.ajax({
			url:base_url+"domainparameters/updateRunway?runway_id="+runway_id,
			type:"post",
			data:data,
			success:function(res){
				// console.log(res);
				// return;
				if(res == "updated"){
					$( "#dialog" ).dialog( "close" );
					alert("Runway Updated.");
					window.location.reload();
				}else{
					alert("Some error occured please try again.");
				}
			}
		});
	}else{
		$("#dialog").dialog("close");
	}
}






















function changeCallStatus(p_id,curr_elem){
	var postData = new Object();
	postData["p_id"] = p_id;
	// if(confirm("Please cinfirm to call again.")){
		$.ajax({
			url:base_url+"emergency/changeCallStatus",
			type:"post",
			data:postData,
			success:function(res){
				if(res == "success"){
					$(curr_elem).parent().find(".phone-status").val("Calling");
					$(curr_elem).remove();
				}
			}
		});
	// }
}

function updateCallsStatus(log_id){
	// console.log("called");
	// $( "#dialog" ).find( ".dialog-content" ).html("<img src='"+base_url+"assets/img/loading.gif' />");
	var data = new Object();
	data["id"] = log_id;
	data["callstatus"] = true;
	$.ajax({
		url:base_url+"emergency/callStatus",
		type:"post",
		data:data,
		success:function(html){
			// $(".messi-content").html(html);
			// $(".modal-title").html(popup_title);
			$(".call-email-status").html(html);
		}
	});
}

function reportPDF(greport,sreport,mreport,freport,report_type){
	var curr_timestamp = new Date().getTime();
	var filename = report_type+curr_timestamp+".pdf";
	$.ajax({
		url:base_url+"report/reportPDF/"+greport+"/"+sreport+"/"+mreport+"/"+freport+"/"+report_type+"/"+filename,
		success:function(res){
			console.log(res);
			if(res == filename){
				alert("The file is being created. Please wait for a moment, do not reload the page.");
				// window.open(base_url+'assets/reports/'+filename,'_blank');
				OpenInNewTab(base_url+'assets/reports/'+filename);
			}else{
				alert("Some error occurred. please contact the system administrator.");
			}
		}
	});
}
function generalReportPDF(greport,sreport,mreport,freport,report_type){
	var curr_timestamp = new Date().getTime();
	var filename = report_type+curr_timestamp+".pdf";
	$.ajax({
		url:base_url+"report/generalReportPDF/"+greport+"/"+sreport+"/"+mreport+"/"+freport+"/"+report_type+"/"+filename,
		success:function(res){
			console.log(res);
			if(res == filename){
				alert("The file is being created. Please wait for a moment, do not reload the page.");
				// window.open(base_url+'assets/reports/'+filename,'_blank');
				OpenInNewTab(base_url+'assets/reports/'+filename);
			}else{
				alert("Some error occurred. please contact the system administrator.");
			}
		}
	});
}

function deleteDailyReportRow(curr_elem,log_id,type){
		$.blockUI({message: 'Deleting, please wait for a moment...', css: { 
				border: 'none', 
				padding: '15px', 
				backgroundColor: '#000', 
				'-webkit-border-radius': '10px', 
				'-moz-border-radius': '10px', 
				opacity: .5, 
				color: '#fff' 
			} 
		}); 
		// alert("asdasd");
	var postData = new Object();
	postData["log_id"] = log_id;
	postData["type"] = type;
	$.ajax({
		url:base_url+"report/deleteDailyReportRow",
		type:"post",
		data:postData,
		success:function(res){
			// console.log("res");
			if(res == "deleted"){
				$(curr_elem).parent().parent().remove();
				setTimeout($.unblockUI, 0); 			
			}else{
				notyfy({
					text: res,
					type: 'error',
					layout: 'center',
					theme: 'boolight',
					closeWith: ['hover']
				});		
				setTimeout($.unblockUI, 0); 			
			}
		}
	});
}

function OpenInNewTab(url )
{
console.log(url);
var win = window.open(url, '_blank');
if(win){
    //Browser has allowed it to be opened
    win.focus();
}else{
    //Broswer has blocked it
    alert('Please allow popups for this site');
}	// window.open(url);
  // var win=window.open(url, '_blank');
	// alert("opening file");
  // win.focus();
	// resizeTo( 500,500 );
}
function maxLengthCheck(object)
{
	if (object.value.length != "" ){
		if (object.value.length < 4){
			object.setCustomValidity('The length must be 4 numeric characters.');	
		}else if(object.value.length > 4){
			object.setCustomValidity('The length must be 4 numeric characters.');	
		}else{
				object.setCustomValidity('');	
		}
	}else{
		object.setCustomValidity('');		
	}
}

function addNewRole(){
	new Messi($(".add-new-role-form-wrap").html(), {title: "Add New User Role", modal: true, width:"auto"});
	$(".messi .messi-content .add-new-role-form").submit(function(event){
		event.preventDefault();
		var postData = new Object();
		postData["role"] = $(this).find('input[name="role"]').val();
		$.ajax({
			url:base_url+"index/insertRole",
			type:"post",
			data:postData,
			success:function(res){
				// console.log(res);
				if(res == "success"){
					alert("The new user role has been added successfully.");
					window.location.reload();
				}else{
					var n = notyfy({
						text: res,
						type: 'error',
						layout: 'topCenter',
						theme: 'boolight',
						closeWith: ['hover']
					});				
				}
			}
		});
	});
}
function addNewUnit(){
	new Messi($(".add-new-role-form-wrap").html(), {title: "Add New Unit", modal: true, width:"auto"});
	$(".messi .messi-content .add-new-unit-form").submit(function(event){
		event.preventDefault();
		var postData = new Object();
		postData["unit"] = $(this).find('input[name="unit"]').val();
		$.ajax({
			url:base_url+"index/insertUnit",
			type:"post",
			data:postData,
			success:function(res){
				// console.log(res);
				if(res == "success"){
					alert("The new user role has been added successfully.");
					window.location.reload();
				}else{
					var n = notyfy({
						text: res,
						type: 'error',
						layout: 'topCenter',
						theme: 'boolight',
						closeWith: ['hover']
					});				
				}
			}
		});
	});
}

function activateRole(role_id,curr_elem){
	var postData = new Object();
	if($.trim($(curr_elem).html()) == "Activate"){
		postData["id"] = role_id;
		postData["active"] = 1;
	}else{
		postData["id"] = role_id;
		postData["active"] = 0;
	}
	$.ajax({
		url:base_url+"index/activateRole",
		type:"post",
		data:postData,
		success:function(res){
			console.log(res);
			if(res == "success"){
				if($.trim($(curr_elem).html()) == "Activate"){
					$(curr_elem).addClass("btn-red");
					$(curr_elem).removeClass("btn-green");
					$(curr_elem).html("Deactivate");
				}else{
					$(curr_elem).removeClass("btn-red");
					$(curr_elem).addClass("btn-green");
					$(curr_elem).html("Activate");
				}
			}else{
				console.log(res);				
			}
		}
	});
}
function activateUnit(unit_id,curr_elem){
	var postData = new Object();
	if($.trim($(curr_elem).html()) == "Activate"){
		postData["unit_id"] = unit_id;
		postData["active"] = 1;
	}else{
		postData["unit_id"] = unit_id;
		postData["active"] = 0;
	}
	$.ajax({
		url:base_url+"index/activateUnit",
		type:"post",
		data:postData,
		success:function(res){
			console.log(res);
			if(res == "success"){
				if($.trim($(curr_elem).html()) == "Activate"){
					$(curr_elem).addClass("btn-red");
					$(curr_elem).removeClass("btn-green");
					$(curr_elem).html("Deactivate");
				}else{
					$(curr_elem).removeClass("btn-red");
					$(curr_elem).addClass("btn-green");
					$(curr_elem).html("Activate");
				}
			}else{
				console.log(res);				
			}
		}
	});
}
function editRole(role_id,role,curr_elem){
	new Messi($(".edit-role-form-wrap").html(), {title: "Edit User Role", modal: true, width:"auto"});
	$('.edit-role-form').find('input[name="role"]').val(role);
	$(".messi .messi-content .edit-role-form").submit(function(event){
		event.preventDefault();
		var postData = new Object();
		postData["role"] = $(this).find('input[name="role"]').val();
		postData["id"] = role_id;
		$.ajax({
			url:base_url+"index/updateRole",
			type:"post",
			data:postData,
			success:function(res){
				// console.log(res);
				if(res == "success"){
					alert("The new user role has been edit successfully.");
					window.location.reload();
				}else{
					var n = notyfy({
						text: res,
						type: 'error',
						layout: 'topCenter',
						theme: 'boolight',
						closeWith: ['hover']
					});				
				}
			}
		});
	}); 
}
function editUnit(unit_id,unit,curr_elem){
	new Messi($(".edit-role-form-wrap").html(), {title: "Edit Unit", modal: true, width:"auto"});
	$('.edit-unit-form').find('input[name="unit"]').val(unit);
	$(".messi .messi-content .edit-unit-form").submit(function(event){
		event.preventDefault();
		var postData = new Object();
		postData["unit"] = $(this).find('input[name="unit"]').val();
		postData["unit_id"] = unit_id;
		// console.log(postData);
		// return;
		$.ajax({
			url:base_url+"index/updateUnit",
			type:"post",
			data:postData,
			success:function(res){
				// console.log(res);
				if(res == "success"){
					alert("The new user role has been edit successfully.");
					window.location.reload();
				}else{
					var n = notyfy({
						text: res,
						type: 'error',
						layout: 'topCenter',
						theme: 'boolight',
						closeWith: ['hover']
					});				
				}
			}
		});
	}); 
}

function checkAll(curr_elem){
	// $(curr_elem).parent().find('input[type="checkbox"']).attr('checked','checked');
	$(curr_elem).parent().find('input[type="checkbox"]').attr('checked','checked');
}
function unCheckAll(curr_elem){
	$(curr_elem).parent().find('input[type="checkbox"]').removeAttr('checked');
}

function clearAccessLogsForm(){
	$(".al-from,.al-to,.al-keyword").attr("value","");
	// alert
	$(".accesslogs-search-form").submit();
}

function clearInstructionsAccessLogsForm(){
	$(".al-from,.al-to").attr("value","");
	$(".al-agent option[selected='selected']").removeAttr("selected");
	$(".al-agent option[value='']").attr("selected","selected");
	// alert
	$(".accesslogs-search-form").submit();
}