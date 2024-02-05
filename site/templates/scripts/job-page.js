$(document).ready(function() {
	$(document).on("click", ".apply-button", function(){
	     job_code = $(this).attr("id").replace("job_code_", "");
	     console.log(job_code);

	   // job_code=$('#job_page_job_code').val();
	   // console.log(job_code);
console.log("1");
console.log(homepath+'api/candidate-apply-for-job/');
		/* Ajax to get Data from the candidate-apply-job api*/
		$.ajax({
			url : homepath+'api/candidate-apply-for-job/',
			method : "POST",
// dataType : 'text',
			data : {
				"requested_action_to_take" : "apply_for_job",
				"job_code_to_add" : job_code,
				"about_job_popup_form_details" : ""
			    
			},
			beforeSend: function(){
				$('.apply-button').prop('disabled', true);

			},
			complete: function(){
				$('.apply-button').prop('disabled', false);
			},
			success : function(result){
console.log(result)
console.log("2");
				if(result.error.number_of_errors > 0){
					console.log("111");
					// if(result.error.error_message === "about_job"){
					// 	$('#about_job_modal').modal('show');
					// 	console.log("222");
					// }
					// alert(result.error.error_message);
					console.log("333");
				

					if(result.error.error_message === "Please log in and try again."){
						var win = window.open(homepath, '_blank');
						
						if (win) {
						    win.focus();
						} else {
						    alert('Please allow popups for this website');
						}
					}

					console.log("about_job");
					if(result.error.error_message === "about_job"){
						//  modal dispaly
						// Create the modal elements
						const modalContainer = $('<div>').addClass('modal fade bd-modal-sm').attr({
							'id': 'about_job_modal',
							'data-backdrop': 'static',
							'data-keyboard': 'false'
						});
						
						const modalDialog = $('<div>').addClass('modal-dialog');
						const modalContent = $('<div>').addClass('modal-content');
						const modalHeader = $('<div>').addClass('modal-header');
						const modalTitle = $('<h5>').addClass('modal-title').text('Jobs');
						const closeButton = $('<button>').addClass('close').attr({
								'type': 'button',
								'data-dismiss': 'modal',
								'aria-label': 'Close'
						}).append($('<span>').attr('aria-hidden', 'true').html('&times;'));
						
						// Create the form element with the desired id attribute
						const form = $('<form>').attr({
								'id': 'about_job_popup_form',
								'action': '',
								'method': 'POST',
								'enctype': 'multipart/form-data'
						});
						
						const modalBody = $('<div>').addClass('modal-body');
						const label = $('<label>').addClass('form-label').attr('for', 'sel1').text('How did you hear about the job?');
						const select = $('<select>').addClass('form-control').attr('name', 'about_job').attr('aria-label', 'Default select example').attr('required', 'required');
						select.append($('<option>').attr('selected', 'selected').text('Please select option'));
						select.append($('<option>').attr('value', 'Friend').text('Friend'));
						select.append($('<option>').attr('value', 'Referral').text('Referral'));
						select.append($('<option>').attr('value', 'Newspaper').text('Newspaper'));
						select.append($('<option>').attr('value', 'Facebook Advert').text('Facebook Advert'));
						select.append($('<option>').attr('value', 'Instagram Advert').text('Instagram Advert'));
						select.append($('<option>').attr('value', 'LinkedIn Advert').text('LinkedIn Advert'));
						select.append($('<option>').attr('value', 'Twitter Post').text('Twitter Post'));
						select.append($('<option>').attr('value', 'Social Media Story / Posts / Reel').text('Social Media Story / Posts / Reel'));
						select.append($('<option>').attr('value', 'Email Notification').text('Email Notification'));
						select.append($('<option>').attr('value', 'WhatsApp Forward Message').text('WhatsApp Forward Message'));			
						const messageSpan = $('<span>').attr('id', 'message').css('color', 'red');
						const modalFooter = $('<div>').addClass('modal-footer');
						const submitButton = $('<button>').addClass('btn btn-primary btn_submit_job').attr('type', 'button').attr('id', 'job_code_'+job_code).attr('name', 'btn_submit_job').text('Submit');
						
						// Assemble the modal elements
						modalHeader.append(modalTitle, closeButton);
						// modalBody.append(label, select);
						modalBody.append(label, select, messageSpan); // Append the <span> element for the message
						modalFooter.append(submitButton);
						form.append(modalBody, modalFooter); // Append modalBody and modalFooter to the form
						modalContent.append(modalHeader, form); // Replace modalBody with the form
						modalDialog.append(modalContent);
						modalContainer.append(modalDialog);
						
						// Append the modal to the body
						$('body').append(modalContainer);
						
						// Show the modal
						$('#about_job_modal').modal('show');
						// end modal display
					}

					if(result.error.error_message !="about_job"){
						alert(result.error.error_message);
					}

					

				}
				else{
console.log("3");
					/* Send the received data to refresh datatable function */
					//refresh_datatable(result)


                    	alert(result.success.success_message);
					/* Save received data to universal variable */
					//all_jobs_data = result;
				}
			},
			error : function(er1, er2, er3){
console.log(er3)
console.log("4");
				//alert("Please log in to apply.")
					$('#myModal').modal('show');
			}
		})
		/* Ajax to get Data from the candidate-apply-job api END */
	})

	$(document).on("click", ".btn_submit_job", function(){
		job_code = $(this).attr("id").replace("job_code_", "");
		console.log(job_code);

		const selectElement = document.querySelector('select[name="about_job"]');
    const messageElement = document.getElementById('message');
    
    if (selectElement.value === '') {
        messageElement.textContent = 'Please select an option.';
        event.preventDefault(); // Prevent form submission
    } else {
        messageElement.textContent = ''; // Clear the message
    }
			// job_code=$('#job_page_job_code').val();
			// console.log(job_code);
		/* Serialize the form data to send */
		let about_job_popup_form_details = JSON.stringify($("#about_job_popup_form").serializeArray());
		console.log(about_job_popup_form_details);
		console.log("-----");
	

		console.log("1");
		console.log(homepath+'api/candidate-apply-for-job/');
		/* Ajax to get Data from the candidate-apply-job api*/
		$.ajax({
			url : homepath+'api/candidate-apply-for-job/',
			method : "POST",
		// dataType : 'text',
			data : {
				"requested_action_to_take" : "apply_for_job",
				"job_code_to_add" : job_code,
				"about_job_popup_form_details" : about_job_popup_form_details
					
			},
			beforeSend: function(){
				$('.btn_submit_job').prop('disabled', true);

			},
			complete: function(){
				$('.btn_submit_job').prop('disabled', false);
			},
			success : function(result){
		console.log(result)
		console.log("2");
				if(result.error.number_of_errors > 0){
					console.log("111");
					// if(result.error.error_message === "about_job"){
					// 	$('#about_job_modal').modal('show');
					// 	console.log("222");
					// }
					// alert(result.error.error_message);
					console.log("333");
				

					if(result.error.error_message === "Please log in and try again."){
						var win = window.open(homepath, '_blank');
						console.log("1st popup");
						
						if (win) {
								win.focus();
						} else {
								alert('Please allow popups for this website');
						}
						console.log("1st popup..");
					}

					console.log("about_job");
					if(result.error.error_message === "about_job"){
						//  modal dispaly
						// Create the modal elements
						const modalContainer = $('<div>').addClass('modal fade bd-modal-sm').attr({
							'id': 'about_job_modal',
							'data-backdrop': 'static',
							'data-keyboard': 'false'
						});
						
						const modalDialog = $('<div>').addClass('modal-dialog');
						const modalContent = $('<div>').addClass('modal-content');
						const modalHeader = $('<div>').addClass('modal-header');
						const modalTitle = $('<h5>').addClass('modal-title').text('Jobs');
						const closeButton = $('<button>').addClass('close').attr({
								'type': 'button',
								'data-dismiss': 'modal',
								'aria-label': 'Close'
						}).append($('<span>').attr('aria-hidden', 'true').html('&times;'));
						
						// Create the form element with the desired id attribute
						const form = $('<form>').attr({
								'id': 'about_job_popup_form',
								'action': '',
								'method': 'POST',
								'enctype': 'multipart/form-data'
						});
						
						const modalBody = $('<div>').addClass('modal-body');
						const label = $('<label>').addClass('form-label').attr('for', 'sel1').text('How did you hear about the job?');
						const select = $('<select>').addClass('form-control').attr('name', 'about_job').attr('aria-label', 'Default select example').attr('required', 'required');
						select.append($('<option>').attr('selected', 'selected').text('Please select option'));
						select.append($('<option>').attr('value', 'Friend').text('Friend'));
						select.append($('<option>').attr('value', 'Referral').text('Referral'));
						select.append($('<option>').attr('value', 'Newspaper').text('Newspaper'));
						select.append($('<option>').attr('value', 'Facebook Advert').text('Facebook Advert'));
						select.append($('<option>').attr('value', 'Instagram Advert').text('Instagram Advert'));
						select.append($('<option>').attr('value', 'LinkedIn Advert').text('LinkedIn Advert'));
						select.append($('<option>').attr('value', 'Twitter Post').text('Twitter Post'));
						select.append($('<option>').attr('value', 'Social Media Story / Posts / Reel').text('Social Media Story / Posts / Reel'));
						select.append($('<option>').attr('value', 'Email Notification').text('Email Notification'));
						select.append($('<option>').attr('value', 'WhatsApp Forward Message').text('WhatsApp Forward Message'));			
						const messageSpan = $('<span>').attr('id', 'message').css('color', 'red');
						const modalFooter = $('<div>').addClass('modal-footer');
						const submitButton = $('<button>').addClass('btn btn-primary btn_submit_job').attr('type', 'button').attr('id', 'job_code_'+job_code).attr('name', 'btn_submit_job').text('Submit');
						
						// Assemble the modal elements
						modalHeader.append(modalTitle, closeButton);
						// modalBody.append(label, select);
						modalBody.append(label, select, messageSpan); // Append the <span> element for the message
						modalFooter.append(submitButton);
						form.append(modalBody, modalFooter); // Append modalBody and modalFooter to the form
						modalContent.append(modalHeader, form); // Replace modalBody with the form
						modalDialog.append(modalContent);
						modalContainer.append(modalDialog);
						
						// Append the modal to the body
						$('body').append(modalContainer);
						
						// Show the modal
						$('#about_job_modal').modal('show');
						// end modal display
					}

					if(result.error.error_message !="about_job"){
						alert(result.error.error_message);
						console.log("1st popup...");
					}

					

				}
				else{
		console.log("3");
					/* Send the received data to refresh datatable function */
					//refresh_datatable(result)
					alert(result.success.success_message);
					console.log("1st popup....");
					location.reload();
					/* Save received data to universal variable */
					//all_jobs_data = result;
				}
			},
			error : function(er1, er2, er3){
		console.log(er3)
		console.log("4");
				//alert("Please log in to apply.")
					$('#myModal').modal('show');
			}
		})
		/* Ajax to get Data from the candidate-apply-job api END */
	})

});
