/*
--------------------------------------------------
Local script for form page.
JQuery required
By Amrut Todkar
--------------------------------------------------
*/

let candidate_id;
let redirect_profile_url;
$(document).ready(function () {
	/* Terms and Conditions Modal Auto-appear */
	$('#t_and_c_modal').modal({
		keyboard: false,
		backdrop: 'static'
	});
	/* Terms and Conditions Modal Auto-appear End */

	/* Adding Custom Textbox on Selecting Other */
	$("select").on("change", function () {
		if ($(this).find(":selected").attr("value") == "other") {
			$("#" + $(this).attr("id") + "_custom_container").show();
			$("#" + $(this).attr("id") + "_custom").prop('required', true);
		} else {
			$("#" + $(this).attr("id") + "_custom_container").hide();
			$("#" + $(this).attr("id") + "_custom").prop('required', false);
		}
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
    	e.preventDefault();
		e.stopPropagation();
		var intern=$("#internship_apply").val();
		if(intern=="Yes"){
    		checked = $("#internship_month_section input[type=checkbox]:checked").length;
    		if(!checked) {
    			$("#internship_month_section input[type=checkbox]").prop('required', true);
    			$("#month_error").css('display','block');
    		}
    		else{
    			$("#internship_month_section input[type=checkbox]").prop('required', false);
    			$("#month_error").css('display','none');
    		}
		}

		if ($(this).find('input, select, textbox').filter(function(){return this.checkValidity() === false}).length>0){
			$(this).addClass('was-validated');
			alert("Submission failed. Please check if you have filled all fields correctly.");
		}
	    else{
// 		e.preventDefault();
// 		e.stopPropagation();

// 		if ($(this).closest('.tab-pane').find('input, select, textbox').filter(function () { return this.checkValidity() === false }).length > 0) {
// 			$(this).closest('.tab-pane').addClass('was-validated');
// 		} 
       // else if ($(this).hasClass('btn-submit')) {
            //$(this).closest('form').submit();
			$('#education-next').html('Uploading...');
			$('#education-next').attr('disabled', 'true');

			/* Save the data to send to the AJAX page into a variable */
			let form_data_to_send = new FormData($('#main-container')[0]);
			/* Add the information confirming that this info came from the AJAX call. This will help in case JS does not work in the browser and the form is sent by HTML default. */
			form_data_to_send.append('ajax', 'true');
console.log("submit");
			$.ajax({
				type: 'POST',
				url: website_rootpath + 'thank-you/',
				data: form_data_to_send,
				contentType: false,
				//dataType: 'text',
				processData: false,
				success: function (form_submit_result) {
console.log("submit1");
console.log(form_submit_result);
					candidate_id = form_submit_result.candidate_id;
					/*If the profile has not been created*/
					if (!(form_submit_result.profile_created || form_submit_result.profile_edited)) {
						$('.btn-submit').html("Submit");
						$('.btn-submit').prop('disabled', false);
						if(form_submit_result.error_text!=""){
						    alert(form_submit_result.error_text.toString());
						}
						else{
						    alert("Something went wrong. Please try again.");
						}
						
					}
					/* If the editing contains error, combine the error array and echo it. */
					else if (form_submit_result.error) {
						$('.btn-submit').html("Submit");
						$('.btn-submit').prop('disabled', false);
						//$("#search_modal_submit").prop('disabled', false);
						alert(form_submit_result.error_text.toString());
					}
					else {
					    console.log("redirect");
					        //if(form_submit_result.profile_created){
					    	window.location.href = form_submit_result.profile_url;
					        //}
						/** here get confirm skills array like technical_skills_array ,non_technical_skills_array,soft_skills_array  */
				// 		if (form_submit_result.skills_to_confirm) {
				// 			console.log("1");

				// 			redirect_profile_url = form_submit_result.profile_url;
				// 			/** here call function skill_confirm_modal for display popup and also in this popup display skills */
				// 			skill_confirm_modal(form_submit_result.technical_skills_to_confirm, form_submit_result.non_technical_skills_to_confirm, form_submit_result.soft_skills_to_confirm);
				// 		}
				// 		else {
				// 			/** here page redirect to profile page */
				// 			window.location.href = form_submit_result.profile_url;
				// 		}

					}
				},
				error: function (e1, e2, e3) {
console.log(e1);
console.log(e2);
console.log(e3);
				}
			})
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
// 		var regex = new RegExp("^[0-9]+$");
// 		var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);

// 		if (!regex.test(key)) {
// 			event.preventDefault();
// 			return false;
// 		}
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
	$(function () {
		$('#profile_image').on("change", function () {


			let val = $(this).val().toLowerCase();
			let regex = new RegExp("(.*?)\.(jpg|jpeg|png)$");

			if (!(regex.test(val))) {
				$(this).val('');
				$("#profile_image_label").html("PNG or JPG images only");
				alert('Please upload a .jpg, .jpeg or .png file.');
			} else if (this.files[0].size > 2000000) {
				alert("Please upload a file of size less than 2Mb");
				$(this).val('');
			} else {
				$("#profile_image_label").html($(this).val().split("\\").pop());
			}
		});
	});
	/* Profile Image Upload Extension Check End */

	/* Multiselect Limit for Preferred Location */
	/*$("#preferred_location1, #preferred_location2, #preferred_location3").on("change", function(e) {
		if(
			($("#preferred_location1 option:selected").attr("value") == $("#preferred_location2 option:selected").attr("value") && $("#preferred_location2 option:selected").attr("value") !="") ||
			($("#preferred_location1 option:selected").attr("value") == $("#preferred_location3 option:selected").attr("value")&& $("#preferred_location1 option:selected").attr("value") !="") ||
			($("#preferred_location2 option:selected").attr("value") == $("#preferred_location3 option:selected").attr("value") && $("#preferred_location2 option:selected").attr("value") !="")){
			alert("You have already selected that option!");
			$(this).find($("option:selected")).prop("selected", false);
			//$(this).find($("option:selected").css('background-color', 'yellow'));//.prop("selected", false));
			//$(this).find($("option ").first().prop("selected", true));
		}


	});
*/
	let location_value = ["example", "example", "example"];
	$("#preferred_location1").on("change", function () {
		$("#preferred_location2 option[value='" + location_value[0] + "'], #preferred_location3 option[value='" + location_value[0] + "']").show();
		location_value[0] = $(this).val();
		$("#preferred_location2 option[value='" + location_value[0] + "'], #preferred_location3 option[value='" + location_value[0] + "']").hide();
	})

	$("#preferred_location2").on("change", function () {
		$("#preferred_location1 option[value='" + location_value[1] + "'], #preferred_location3 option[value='" + location_value[1] + "']").show();
		location_value[1] = $(this).val();
		$("#preferred_location1 option[value='" + location_value[1] + "'], #preferred_location3 option[value='" + location_value[1] + "']").hide();
	})

	$("#preferred_location3").on("change", function () {
		$("#preferred_location1 option[value='" + location_value[2] + "'], #preferred_location2 option[value='" + location_value[2] + "']").show();
		location_value[2] = $(this).val();
		$("#preferred_location1 option[value='" + location_value[2] + "'], #preferred_location2 option[value='" + location_value[2] + "']").hide();
	})

	/* Multiselect Limit for Preferred Location End */
});




/*(function() {
	'use strict';
	window.addEventListener('load', function() {
		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		var forms = document.getElementsByClassName('needs-validation');
		// Loop over them and prevent submission
		var validation = Array.prototype.filter.call(forms, function(form) {
			form.addEventListener('submit', function(event) {
				if (form.checkValidity() === false) {
					event.preventDefault();
					event.stopPropagation();
				}
				form.classList.add('was-validated');
			}, false);
		});
	}, false);
})();
*/


/*
(function() {
	validate.extend(validate.validators.datetime, {
		// The value is guaranteed not to be null or undefined but otherwise it
		// could be anything.
		parse: function(value, options) {
			return +moment.utc(value);
		},
		// Input is a unix timestamp
		format: function(value, options) {
			var format = options.dateOnly ? "YYYY-MM-DD" : "YYYY-MM-DD hh:mm:ss";
			return moment.utc(value).format(format);
		}
	});

	var constraints = {
		email: {
			// Email is required
			presence: true,
			// and must be an email (duh)
			email: true
		}
	}

	// Hook up the form so we can prevent it from being posted
	var form = document.querySelector("form#main-container");
	form.addEventListener("submit", function(ev) {
		ev.preventDefault();
		handleFormSubmit(form);
	});

	// Hook up the inputs to validate on the fly
	var inputs = document.querySelectorAll("input, textarea, select")
	for (var i = 0; i < inputs.length; ++i) {
		inputs.item(i).addEventListener("change", function(ev) {
			var errors = validate(form, constraints) || {};
			showErrorsForInput(this, errors[this.name])
		});
	}

	function handleFormSubmit(form, input) {
		// validate the form against the constraints
		var errors = validate(form, constraints);
		// then we update the form to reflect the results
		showErrors(form, errors || {});
		if (!errors) {
			showSuccess();
		}
	}

	// Updates the inputs with the validation errors
	function showErrors(form, errors) {
		// We loop through all the inputs and show the errors for that input
		_.each(form.querySelectorAll("input[name], select[name]"), function(input) {
			// Since the errors can be null if no errors were found we need to handle
			// that
			showErrorsForInput(input, errors && errors[input.name]);
		});
	}

	// Shows the errors for a specific input
	function showErrorsForInput(input, errors) {
		// This is the root of the input
		var formGroup = closestParent(input.parentNode, "form-group")
			// Find where the error messages will be insert into
			, messages = formGroup.querySelector(".messages");
		// First we remove any old messages and resets the classes
		resetFormGroup(formGroup);
		// If we have errors
		if (errors) {
			// we first mark the group has having errors
			formGroup.classList.add("has-error");
			// then we append all the errors
			_.each(errors, function(error) {
				addError(messages, error);
			});
		} else {
			// otherwise we simply mark it as success
			formGroup.classList.add("has-success");
		}
	}

	// Recusively finds the closest parent that has the specified class
	function closestParent(child, className) {
		if (!child || child == document) {
			return null;
		}
		if (child.classList.contains(className)) {
			return child;
		} else {
			return closestParent(child.parentNode, className);
		}
	}

	function resetFormGroup(formGroup) {
		// Remove the success and error classes
		formGroup.classList.remove("has-error");
		formGroup.classList.remove("has-success");
		// and remove any old messages
		_.each(formGroup.querySelectorAll(".help-block.error"), function(el) {
			el.parentNode.removeChild(el);
		});
	}

	// Adds the specified error with the following markup
	// <p class="help-block error">[message]</p>
	function addError(messages, error) {
		var block = document.createElement("p");
		block.classList.add("help-block");
		block.classList.add("error");
		block.classList.add("invalid-tooltip");
		block.innerText = error;
		messages.appendChild(block);
	}

	function showSuccess() {
		// We made it \:D/
		alert("Success!");
	}
})();*/

/** create function for display popup and skills data */
/**  in function pass technica_skills_array, non_technical_skills_array_soft_skills_array */
function skill_confirm_modal(technical_skills_array, non_technical_skills_array, soft_skills_array) {
	// console.log("2");
	/** here show or display modal on upload resume and click on submit button */
	$('#myModalDemo').modal('show');

	/** here use for of loop for technical_skills_array like foreach loop*/
	let loop_counter = 0;
	for (let value of technical_skills_array) {
		loop_counter++;
		console.log(value);

		/** display checkbox and technical skills array value */
		/** html imput assign to checkbox variable */
		var checkbox = "<input type='checkbox' name='technical_skills_array' value='" + value + "' id='technical_skill_checkbox_" + loop_counter + "'><label class='form-check-label' style='padding-left:8px;' for='technical_skill_checkbox_" + loop_counter + "'>" + value + "</label></br>";

		/**here checkbox variable append to id of modal form div   */
		$("#technical_skills_array").append(checkbox);

	}
	/** check technical skills array length is zero then hide id block of modal  */
	if (technical_skills_array.length == 0) {
		$('#technical_skills_array').hide();
	}


	for (let value of non_technical_skills_array) {
		loop_counter++;
		console.log(value);

		/** display checkbox and technical skills array value */
		/** html imput assign to checkbox variable */
		var checkbox = "<input type='checkbox' name='non_technical_skills_array'  value='" + value + "' id='non_technical_skill_checkbox_" + loop_counter + "'><label class='form-check-label' style='padding-left:8px;' for='non_technical_skill_checkbox_" + loop_counter + "'>" + value + "</label></br>";

		/**here checkbox variable append to id of modal form div   */
		$("#non_technical_skills_array").append(checkbox);

	}
	/** check non technical skills array length is zero then hide id block of modal  */
	if (non_technical_skills_array.length == 0) {
		$('#non_technical_skills_array').hide();
	}


	for (let value of soft_skills_array) {
		loop_counter++;
		console.log(value);

		/** display checkbox and technical skills array value */
		/** html imput assign to checkbox variable */
		var checkbox = "<input type='checkbox' name='soft_skills_array' value='" + value + "' id='soft_skill_checkbox_" + loop_counter + "'><label class='form-check-label' style='padding-left:8px;' for='soft_skill_checkbox_" + loop_counter + "'>" + value + "</label></br>";

		/**here checkbox variable append to id of modal form div   */
		$("#soft_skills_array").append(checkbox);

	}
	/** check soft skills array length is zero then hide id block of modal  */
	if (soft_skills_array.length == 0) {
		$('#soft_skills_array').hide();
	}
}
