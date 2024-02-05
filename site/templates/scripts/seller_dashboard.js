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
	/* Validation on Button Click and Tab Navigation */
// 	$(document).on('submit', "#main-container", function (e) {
// 	    $('#education-next').html('Uploading...');
//  			$('#education-next').attr('disabled', 'true');
//  			// if(redirect==true){
//  			//     alert("Thanks for registering with us. We would review and get back shortly!");
//  			// }
//  			 //alert("Thanks for registering with us. We would review and get back shortly!");
// 	});
//  	$(document).on('submit', "#main-container", function (e) {
//     // $("#main-container").on('submit', function (e) {
// 		e.preventDefault();
// 		e.stopPropagation();
// console.log("submit");
// // 		if ($(this).closest('.tab-pane').find('input, select, textbox').filter(function () { return this.checkValidity() === false }).length > 0) {
// // 			$(this).closest('.tab-pane').addClass('was-validated');
// // 		} else if ($(this).hasClass('btn-submit')) {
// // 			$(this).html('Uploading...');
// // 			$(this).attr('disabled', 'true');
//         if ($(this).find('input, select, textbox').filter(function(){return this.checkValidity() === false}).length>0){
// 			$(this).addClass('was-validated');
// 			alert("Submission failed. Please check if you have filled all fields correctly.");
// 		}
// 	    else{
	        
// 	        $('#education-next').html('Uploading...');
// 			$('#education-next').attr('disabled', 'true');
// 			 //alert("Thanks for registering with us. We would review and get back shortly!");
//  			// window.location.href=homepath + "universe/?universal_logout=true";
// 			/* Save the data to send to the AJAX page into a variable */
// // 			let form_data_to_send = new FormData($('#main-container')[0]);
// // 			/* Add the information confirming that this info came from the AJAX call. This will help in case JS does not work in the browser and the form is sent by HTML default. */
// // 			form_data_to_send.append('ajax', 'true');
// // console.log((new Date()).toUTCString());
// // 			$.ajax({
// // 				type: 'POST',
// // 				url: homepath + 'universe/api/seller-uploading-form/',
// // 				data: form_data_to_send,
// // 				contentType: false,
// // 				//dataType: 'text',
// // 				processData: false,
// // 				success: function (seller_form_submit_result) {
// // 					console.log(seller_form_submit_result);
// // console.log("abc");
// // console.log((new Date()).toUTCString());
// // 					//candidate_id = seller_form_submit_result.candidate_id;
// // 					/*If the profile has not been created*/
// // 					if (!(seller_form_submit_result)) {
// // 						$('.btn-submit').html("Submit");
// // 						$('.btn-submit').attr('disabled', 'false');
// // 						alert("Something went wrong. Please try again.");
// // 					}
// // 					/* If the editing contains error, combine the error array and echo it. */
// // 					else if (seller_form_submit_result.error) {
// // 						$('.btn-submit').html("Submit");
// // 						$('.btn-submit').attr('disabled', 'false');
// // 						alert(seller_form_submit_result.error_text.toString());
// // 					}
// // 					else {
					    
// // 					       //location.reload();
// // 					       alert("Thanks for registering with us. We would review and get back shortly!");
// // 				            window.location.href=homepath + "universe/?universal_logout=true";
				            

// // 					}
// // 				},
// // 				error: function () {
// // 					/* Handle error here */
// // 				}
// // 			})
// 		} 
// // 		else {
// // 			document.getElementById("main-container").scrollIntoView({
// // 				behavior: "smooth",
// // 				block: "start"
// // 			});

// // 			$(".tab-pane.active").removeClass('active')

// // 			$($(this).attr('href')).addClass('active');

// // 			$(this).tab('show');
// // 		}
// 	});
	/* Resume Upload Extension Check */
	$(function () {
// 		$('#document_legal_agreement').change(function () {
// 			let val = $(this).val().toLowerCase();
// 			let regex = new RegExp("(.*?)\.(docx|doc|pdf|jpg|jpeg|png)$");

// 			if (!(regex.test(val))) {
// 				$(this).val('');
// 				$("#document_legal_agreement_label").html("PDF, MS Word, JPG, JPEG, PNG files only");
// 				alert('Please upload a .docx, .doc or .pdf file.');
// 			} else {
// 				$("#document_legal_agreement_label").html($(this).val().split("\\").pop());
// 			}
// 		});
		
		$('#document_onboarding_form').change(function () {
			let val = $(this).val().toLowerCase();
			let regex = new RegExp("(.*?)\.(docx|doc|pdf|jpg|jpeg|png)$");

			if (!(regex.test(val))) {
				$(this).val('');
				$("#document_onboarding_form_label").html("PDF, MS Word, JPG, JPEG, PNG files only");
				alert('Please upload a .docx, .doc, .pdf, .jpg, .png, .jpeg file.');
			} else {
				$("#document_onboarding_form_label").html($(this).val().split("\\").pop());
			}
		});
		
		$('#document_pan').change(function () {
			let val = $(this).val().toLowerCase();
			let regex = new RegExp("(.*?)\.(docx|doc|pdf|jpg|jpeg|png)$");

			if (!(regex.test(val))) {
				$(this).val('');
				$("#document_pan_label").html("PDF, MS Word, JPG, JPEG, PNG files only");
				alert('Please upload a .docx, .doc, .pdf, .jpg, .png, .jpeg file.');
			} else {
				$("#document_pan_label").html($(this).val().split("\\").pop());
			}
		});
		
		$('#document_gst').change(function () {
			let val = $(this).val().toLowerCase();
			let regex = new RegExp("(.*?)\.(docx|doc|pdf|jpg|jpeg|png)$");

			if (!(regex.test(val))) {
				$(this).val('');
				$("#document_gst_label").html("PDF, MS Word, JPG, JPEG, PNG files only");
				alert('Please upload a .docx, .doc, .pdf, .jpg, .png, .jpeg file.');
			} else {
				$("#document_gst_label").html($(this).val().split("\\").pop());
			}
		});
		
		$('#document_pan_directors').change(function () {
			let val = $(this).val().toLowerCase();
			let regex = new RegExp("(.*?)\.(docx|doc|pdf|jpg|jpeg|png)$");

			if (!(regex.test(val))) {
				$(this).val('');
				$("#document_pan_directors_label").html("PDF, MS Word, JPG, JPEG, PNG files only");
				alert('Please upload a .docx, .doc, .pdf, .jpg, .png, .jpeg file.');
			} else {
				$("#document_pan_directors_label").html($(this).val().split("\\").pop());
			}
		});
		
		$('#document_cancelled_cheque').change(function () {
			let val = $(this).val().toLowerCase();
			let regex = new RegExp("(.*?)\.(docx|doc|pdf|jpg|jpeg|png)$");

			if (!(regex.test(val))) {
				$(this).val('');
				$("#document_cancelled_cheque_label").html("PDF, MS Word, JPG, JPEG, PNG files only");
				alert('Please upload a .docx, .doc, .pdf, .jpg, .png, .jpeg file.');
			} else {
				$("#document_cancelled_cheque_label").html($(this).val().split("\\").pop());
			}
		});
		
// 		$("#pan_number").change(function () {    
// 		//$(document).on("keyup","#pan_number",  function(){
//             var inputvalues = $(this).val();      
//               var regex = /[A-Z]{5}[0-9]{4}[A-Z]{1}$/;    
//               if(!regex.test(inputvalues)){      
//               $("#pan_number").val("");    
//               alert("Please enter valid PAN number.");    
//               return regex.test(inputvalues);    
//               }    
//         }); 
        
        // $("#gst_number").change(function () {      
        //     var inputvalues = $(this).val();  
        //         var regex = /([0-9a-zA-Z]){15}?$/; 
        //       //var regex =/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}[0-9A-Z]{1}$/;
        //       //var regex = /([0-9]){2}([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}([0-9]){1}([a-zA-Z]){1}([0-9A-Z]){1}?$/; 
        //       //var regex =/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}[0-9A-Z]{1}$/;
        //       if(!regex.test(inputvalues)){      
        //       $("#gst_number").val("");    
        //       alert("Please enter valid GST number.");    
        //       return regex.test(inputvalues);    
        //       }    
        // });
        
        $("#pan_number").on("keypress", function (event) {
    		var regex = new RegExp("^[0-9a-zA-Z]+$");
    		var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    
    		if (!regex.test(key)) {
    			event.preventDefault();
    			return false;
    		}
    	})
        
        $("#gst_number").on("keypress", function (event) {
    		var regex = new RegExp("^[0-9a-zA-Z]+$");
    		var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    
    		if (!regex.test(key)) {
    			event.preventDefault();
    			return false;
    		}
    	})
	
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
	
});

