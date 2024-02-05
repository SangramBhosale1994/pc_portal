/*
--------------------------------------------------
Local script for form page.
JQuery required
By Amrut Todkar
--------------------------------------------------
*/

// let candidate_id;
let redirect_profile_url;

	/* Terms and Conditions Modal Auto-appear */
	$('#t_and_c_modal').modal({
		keyboard: false,
		backdrop: 'static'
	});
	/* Terms and Conditions Modal Auto-appear End */

	/* Adding Custom Textbox on Selecting Other */
	$("select").on("change", function () {
		// if ($(this).find(":selected").attr("value") == "other") {
		// 	$("#" + $(this).attr("id") + "_custom_container").show();
		// 	$("#" + $(this).attr("id") + "_custom").prop('required', true);
		// } else {
		// 	$("#" + $(this).attr("id") + "_custom_container").hide();
		// 	$("#" + $(this).attr("id") + "_custom").prop('required', false);
		// }
	})
	/* Adding Custom Textbox on Selecting Other End */
	
	/* Amrut Todkar 2021-02-06 Showing the referrer_code input when the "how did you get to know about us" selects "referred" */
	$("#how_did_you_know_about").on("change", function () {
		if ($(this).find(":selected").attr("value") == "Referred") {
			$("#referrer_code_container").show();
		} else {
			$("#referrer_code_container").hide();
		}
	})
	/* Showing the referrer_code input when the "how did you get to know about us" selects "referred" END */

	/* Age Limit for Application */
	let current_datetime = new Date();
	let old_date = current_datetime.getFullYear() - 18 + "-" + (current_datetime.getMonth() + 1) + "-" + ("0" + current_datetime.getDate()).slice(-2);

	$("#date_of_birth").attr('max', old_date,);
	/* Age Limit for Application End */

	/* Phone Number Typing Limitations */
	$("#phone_number").on("keypress", function (event) {
		var regex = new RegExp("^[0-9]+$");
		var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);

		if (!regex.test(key)) {
			event.preventDefault();
			return false;
		}
	})
	/* Phone Number Typing Limitations End */

	/* Prevent form from being submitted when enter key is pressed */
	$('#main-container').on('keyup keypress', function (e) {
		var keyCode = e.keyCode || e.which;

		if (keyCode === 13) {
			e.preventDefault();
			return false;
		}
	});
	/* Prevent form from being submitted when enter key is pressed END */
console.log("sub");
	/* Validation on Button Click and Tab Navigation */
	$("#main-container").on('submit', function (e) {
    	

		if ($(this).find('input, select, textbox').filter(function(){return this.checkValidity() === false}).length>0){
		    e.preventDefault();
		    e.stopPropagation();
			$(this).addClass('was-validated');
			alert("Submission failed. Please check if you have filled all fields correctly.");
		}
	    else{
	       // $("#main-container").submit();
	           // window.location("<?php $pages->get("name=cart")->httpUrl ?>");
		} 
// 		else {
// 		//	document.getElementById("main-container").scrollIntoView({
// 				// behavior: "smooth",
// 				// block: "start"
// 		//	});

// // 			$(".tab-pane.active").removeClass('active')

// // 			$($(this).attr('href')).addClass('active');

// 			//$(this).tab('show');
// 		}
	});

	$(".btn-back").on('click', function (e) {
		e.preventDefault();
		e.stopPropagation();

		document.getElementById("main-container").scrollIntoView({
			behavior: "smooth",
			block: "start"
		});

		$(".tab-pane.active").removeClass('active')

		$($(this).attr('href')).addClass('active');

		$(this).tab('show');
	})
	/* Validation on Button Click and Tab Navigationu End */


	/* When Edit Candidate Form is submitted */
	/** in document on submit button access modal form id */
	$(document).on("submit", "#skills-array-modal-form", function (skills) {
		/* Prevent submitting automatically*/
		skills.preventDefault();
		skills.stopPropagation();
		console.log("data");
		$("#btn_confirm_skill").html('Uploading...');
		$("#btn_confirm_skill").attr('disabled', 'true');
		/* Serialize the form data to send */
		let skills_array_modal_form_details = $("#skills-array-modal-form").serializeArray();
		console.log(skills_array_modal_form_details);
		/* Add the page ID to be changed */
		// skills_array_modal_form_details.push({


		// })
		console.log(skills_array_modal_form_details);
		/** */
		skills_array_modal_form_details = JSON.stringify(skills_array_modal_form_details);
		console.log(skills_array_modal_form_details);
		$.ajax({
			// url: homepath + 'api/api-candidate-register/',
			/** pass api page url  */
			url: website_rootpath + 'api/candidate-register/',
			method: "POST",
			//dataType: 'text',

			data: {
				"requested_action_to_take": "confirm_skills_submit",
				"skills_array_modal_form_details": skills_array_modal_form_details,
				"candidate_id": candidate_id
			},
			beforeSend: function () {
				console.log("1");
				$("#edit_profile_modal_submit").attr('disabled', 'true');
				$("#edit_profile_modal_submit").html('Saving...');
				$("#edit_profile_modal_error").hide()
			},
			complete: function () {
				console.log("2");
				$("#edit_profile_modal_submit").removeAttr("disabled");
				$("#edit_profile_modal_submit").html('Submit');
			},
			success: function (result) {
				console.log(result)
				console.log("3");
				if (result.error.number_of_errors > 0) {
					$("#edit_profile_modal_error").html(result.error.error_message)
					$("#edit_profile_modal_error").show()
				}
				else {
					console.log("4");
					/* Hide the error box and empty the error */
					$("#edit_profile_modal_error").hide()
					$("#edit_profile_modal_error").html("")

					/* Hide the modal */
					$("#edit_profile_modal").modal('hide');

					/* Show the success message */
					//alert(result.success.success_message);
					/** here redirect to profile url */
					window.location.href = redirect_profile_url;

					/* Refresh the datatable */
					//confirm_skills_submit();
					//api_fetch_event_table_data();
				}
			},
			error: function (er, er2, er3) {
				console.log(er3)
				$("#edit_profile_modal_error").html("Something went wrong, please refresh the page and try again.")
				$("#edit_profile_modal_error").show()
			}
		})
	})
	/* When Edit profile Form is submitted END */

	/* CTC Typing Preventions */
	$("#current_ctc").on("keypress", function (event) {
		var regex = new RegExp("^[0-9]+$");
		var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);

		if (!regex.test(key)) {
			event.preventDefault();
			return false;
		}
	})
	/* CTC Comma Typing Preventions End */

	/* Activate The Popovers */
	$("[data-toggle=popover]").popover({
		html: true
	})
	/* Activate The Popovers End */

	/* Make Popovers Disappear on Click */
	/*	$('body').on('click', function (e) {
			//only buttons
			if ($(e.target).data('toggle') !== 'popover' ){
				$('[data-toggle="popover"]').popover('hide');
			}
	
			if($(this).hasClass('fa-question-circle')){
				$('[data-toggle="popover"]').popover('hide');
			}
		});*/
	/* Make Popovers Disappear on Click End */

	/* Resume Upload Extension Check */
	$(function () {
		$('#resume').change(function () {
			let val = $(this).val().toLowerCase();
			let regex = new RegExp("(.*?)\.(docx|doc|pdf)$");

			if (!(regex.test(val))) {
				$(this).val('');
				$("#resume_label").html("PDF or MS Word files only");
				alert('Please upload a .docx, .doc or .pdf file.');
			} else {
				$("#resume_label").html($(this).val().split("\\").pop());
			}
		});
	});
	/* Resume Upload Extension Check End */

	/* Profile Image Upload Extension Check */
