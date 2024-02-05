$(document).ready(function() {
	$(document).on("click", ".apply-button", function(){
		// $('#about_workshop_modal').modal('show');
		event_code = $(this).attr("id").replace("event_code_", "");
	     console.log(event_code);
			 console.log("////");

		/* Ajax to get Data from the candidate-apply-event api*/
		$.ajax({
			url : homepath+'api/candidate-apply-for-event/',
			method : "POST",
// dataType : 'text', 
			data : {
				"requested_action_to_take" : "apply_for_event",
				"event_code_to_add" : event_code,
				"about_workshop_popup_form_details" : ""
			},
			beforeSend: function(){
				$('.apply-button').prop('disabled', true);

			},
			complete: function(){
				$('.apply-button').prop('disabled', false);
			},
			success : function(result){
console.log(result)
				if(result.error.number_of_errors > 0){
					  // alert(result.error.error_message);
					// var result_data=result.error.error_message;
					// result_data.dialog();
					// window.confirm(result.error.error_message);
						// var resume_link="https://www.thepridecircle.com/resume/";
						let flag_error = "false";
						
					if(result.error.error_message === "Please log in and try again."){
						// var win = window.open(homepath, '_blank');
						// window.location="https://www.thepridecircle.com/resume/";
						$('#myModal').modal('show');
						console.log("login popup");
						// if (win) {
						//     win.focus();
						// } else { 
						//     alert('Please allow popups for this website');
						// }
					}
					else{
						flag_error="true";
					}

					console.log("about_workshop");
					if(result.error.error_message === "about_workshop"){
						// var win = window.open(homepath, '_blank');
						// window.location="https://www.thepridecircle.com/resume/";
						$('#about_workshop_modal').modal('show');
						console.log("workshop popup");
						// if (win) {
						//     win.focus();
						// } else { 
						//     alert('Please allow popups for this website');
						// }
					}
					else{
						flag_error="true";
						
					}

					if(result.error.error_message !="about_workshop" && result.error.error_message !="Please log in and try again."){
						alert(result.error.error_message);
					}
				}
				else{
					/* Send the received data to refresh datatable function */
					//refresh_datatable(result)
					console.log("1st success");
					alert(result.success.success_message);

					/* Save received data to universal variable */
					//all_events_data = result;
				}
			},
			error : function(er1, er2, er3){
console.log(er3);
console.log(er2);
console.log(er1);
				// alert("Please log in to apply.")
				$('#myModal').modal('show');
			}
		})
		/* Ajax to get Data from the candidate-apply-event api END */
	})

	$(document).on("click", ".btn_submit_workshop", function(){
		// $('#about_workshop_modal').modal('show');
		event_code = $(this).attr("id").replace("event_code_", "");
	     console.log(event_code);
			 console.log("****");
		const selectElement = document.querySelector('select[name="about_workshop"]');
    const messageElement = document.getElementById('message');
    
    if (selectElement.value === '') {
        messageElement.textContent = 'Please select an option.';
        event.preventDefault(); // Prevent form submission
    } else {
        messageElement.textContent = ''; // Clear the message
    }
		
		/* Serialize the form data to send */
		let about_workshop_popup_form_details = JSON.stringify($("#about_workshop_popup_form").serializeArray());
		console.log(about_workshop_popup_form_details);
		console.log("-----");
		/* Ajax to get Data from the candidate-apply-event api*/
		$.ajax({
			url : homepath+'api/candidate-apply-for-event/',
			method : "POST",
// dataType : 'text', 
			data : {
				"requested_action_to_take" : "apply_for_event",
				"event_code_to_add" : event_code,
				"about_workshop_popup_form_details" : about_workshop_popup_form_details
			},
			beforeSend: function(){
				$('.apply-button').prop('disabled', true);

			},
			complete: function(){
				$('.apply-button').prop('disabled', false);
			},
			success : function(result){
console.log(result)
				if(result.error.number_of_errors > 0){
					  // alert(result.error.error_message);
					// var result_data=result.error.error_message;
					// result_data.dialog();
					// window.confirm(result.error.error_message);
						// var resume_link="https://www.thepridecircle.com/resume/";
						let flag_error = "false";
					if(result.error.error_message === "Please log in and try again."){
						// var win = window.open(homepath, '_blank');
						// window.location="https://www.thepridecircle.com/resume/";
						$('#myModal').modal('show');
						console.log("2nd login popup");
						// if (win) {
						//     win.focus();
						// } else { 
						//     alert('Please allow popups for this website');
						// }
					}
					else{
						flag_error="true";
					}

					console.log("about_workshop");
					if(result.error.error_message === "about_workshop"){
						// var win = window.open(homepath, '_blank');
						// window.location="https://www.thepridecircle.com/resume/";
						$('#about_workshop_modal').modal('show');
						console.log("2nd workshop popup");
						// if (win) {
						//     win.focus();
						// } else { 
						//     alert('Please allow popups for this website');
						// }
					}
					else{
						flag_error="true";
					}

					if(result.error.error_message !="about_workshop" && result.error.error_message !="Please log in and try again."){
						alert(result.error.error_message);
					}
				}
				else{
					/* Send the received data to refresh datatable function */
					//refresh_datatable(result)
					console.log("2nd success");
					alert(result.success.success_message);
					location.reload();
					/* Save received data to universal variable */
					//all_events_data = result;
				}
			},
			error : function(er1, er2, er3){
console.log(er3);
console.log(er2);
console.log(er1);
				// alert("Please log in to apply.")
				$('#myModal').modal('show');
			}
		})
		/* Ajax to get Data from the candidate-apply-event api END */
	})

});
