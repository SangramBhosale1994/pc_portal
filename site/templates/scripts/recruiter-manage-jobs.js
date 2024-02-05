	let all_jobs_data;
	let profile_to_edit = {};

	$(document).ready(function() {
		/* initialize the text editor fields */
		$('#create_new_job_summary').summernote();
		//$('#edit_profile_job_summary').summernote();
// 		$('#edit_profile_job_skills').summernote();
// 		$('#create_new_job_skills').summernote();	
		/* initialize the text editor fields END */

		/* When checkbox is clicked */
		$(document).on("change", ".job_checkbox", function () {
			/* Change background colour of the row */
			let row_selection_bg_colour = "#fff";

			if($(this).prop("checked")){
				row_selection_bg_colour = "#f9f9f9";
			}

			$(this).parents("tr").css("background-color", row_selection_bg_colour);
			/* Change background colour of the row End */
		});
		/* When checkbox is clicked End */
		
			/* Profile Image Upload Extension Check */
        	$(function () {
        		$('#job_profile_image').on("change", function () {
        
        
        			let val = $(this).val().toLowerCase();
        			let regex = new RegExp("(.*?)\.(jpg|jpeg|png)$");
        
        			if (!(regex.test(val))) {
        				$(this).val('');
        				$("#job_profile_image_label").html("PNG or JPG images only");
        				alert('Please upload a .jpg, .jpeg or .png file.');
        			} else if (this.files[0].size > 2000000) {
        				alert("Please upload a file of size less than 2Mb");
        				$(this).val('');
        			} else {
        				$("#job_profile_image_label").html($(this).val().split("\\").pop());
        			}
        		});
        	});
        	/* Profile Image Upload Extension Check End */

		/* When Create New form is submitted */
// 		$(document).on("submit", "#create_new_modal_form_m1", function(event){
// 			/* Prevent submitting automatically*/
// 			event.preventDefault();
// 			event.stopPropagation();

// 			/* Serialize the form data to send */
// 			let new_job_form_details = JSON.stringify($("#create_new_modal_form").serializeArray());
// //console.log(new_job_form_details)
// 			$.ajax({
// 				url : homepath+'api/recruiter-manage-jobs/',
// 				method : "POST",
//               // dataType : 'text',
// 				data : {
// 					"requested_action_to_take" : "create_job",
// 					"new_job_form_details" : new_job_form_details
// 				},
// 				beforeSend: function(){
// 					$('#create_new_modal_submit').attr('disabled', 'true');
// 					$('#create_new_modal_submit').html('Creating...');
// 					$("#create_new_modal_error").hide()
// 				},
// 				complete: function(){
// 					$('#create_new_modal_submit').removeAttr("disabled");
// 					$('#create_new_modal_submit').html('Submit');
// 				},
// 				success : function(result){
// console.log(result)
// 					if(result.error.number_of_errors > 0){
// 						$("#create_new_modal_error").html(result.error.error_message)
// 						$("#create_new_modal_error").show()
// 						alert(result.error.error_message);
// 					}
// 					else{
// 						/* Hide the error box and empty the error */
// 						$("#create_new_modal_error").hide()
// 						$("#create_new_modal_error").html("")

// 						/* Hide the modal */
// 						$("#create_new_modal").modal('hide');
// 						alert(result.success.success_message);
// console.log(result.success.success_message);
// 						/* Refresh the datatable */
// 						window.location.reload();
// 						api_fetch_job_table_data();
// 					}
// 				},
// 				error : function(er, er2, er3){
// console.log(er)				    
// console.log(er2)
// console.log(er3)
// 					$("#create_new_modal_error").html("Something went wrong, please refresh the page and try again.")
// 					$("#create_new_modal_error").show()
// 				}
// 			})
// 		})
		/* When Create New form is submitted END */
        // $('#myForm').on('submit', function(e) {
  
        //   if($('#TextText').summernote('isEmpty')) {
        //     console.log('contents is empty, fill it!');
        
        //     // cancel submit
        //     e.preventDefault();
        //   }
        //   else {
        //     // do action
        //   }
        // })

        //  $(document).on("submit", "#create_new_modal_form", function(event){
        //$('#create_new_modal_form').on('submit', function(e) {
             //create_new_modal_submit
        $('#create_new_modal_submit').click(function(e){
			/* Prevent submitting automatically*/
    // 			event.preventDefault();
    // 			event.stopPropagation();
    			
    			
    //     		if ($(this).find('input, select, textbox').filter(function(){return this.checkValidity() === false}).length>0){
    //     			$(this).addClass('was-validated');
    //     			alert("Submission failed. Please check if you have filled all fields correctly.");
    //     		}

// 			if($('#create_new_job_location').val()==""){
// 				alert("Please enter location");
// 			}
// 			else if($('#create_new_job_skills').val()==""){
// 				alert("Please enter skills");
// 			}
//             else if($('#create_new_job_type').val()==""){
//                 alert("Please enter job type");
//             }
//             else
            // if($('#create_new_job_summary').val()==""){
            //     alert("Please enter summary");
            // }
            // else{
            
            // }
            
            if($('#create_new_job_summary').summernote('isEmpty')) {
            console.log('contents is empty, fill it!');
            alert("contents is empty, fill it!");
            // cancel submit
            e.preventDefault();
          }
          else {
            // do action
          }
		
        	});
        	
        
        	
		/* When create new modal has been closed */
		$("#create_new_modal").on("hide.bs.modal", function(){
			document.getElementById("create_new_modal_form").reset();
		})
		/* When create new modal has been closed END */

		/* When edit profile button is clicked */
		$(document).on("click", ".profile_edit_button", function(){
			profile_to_edit.id = $(this).attr("id").replace("_edit_button", "");
			console.log(profile_to_edit.id);
			profile_to_edit = all_jobs_data.data.find(x=>x.id == profile_to_edit.id)

			function select_radio_button(name, SelectdValue) {
				$('input[name="' + name+ '"][value="' + SelectdValue + '"]').prop('checked', true);
				console.log(SelectdValue);
		}
			$("#edit_profile_job_id").val(profile_to_edit.id);
			$("#edit_profile_job_title").val(profile_to_edit.title);
			console.log(decodeHtml(profile_to_edit.title));
			//decodeHtml(profile_to_edit.title);
			/* decodeHtml(received_text) function for handling escape characters*/
				function decodeHtml(received_text) {
											var txt = document.createElement("textarea");
											txt.innerHTML = received_text;
											return txt.value;
									}
			
				$("#edit_profile_job_experience_min").val(profile_to_edit.min_experience);
				select_radio_button("job_experience_min",profile_to_edit.min_experience);
				$("#edit_profile_job_experience_max").val(profile_to_edit.max_experience);
				select_radio_button("job_experience_max",profile_to_edit.max_experience);

			//$("#edit_profile_job_experience").val(profile_to_edit.experience);
			$("#edit_profile_job_application_deadline").val(profile_to_edit.application_deadline);
			$("#edit_profile_job_job_code").val(profile_to_edit.job_code);
			$("#edit_profile_job_location").val(profile_to_edit.location);
			$("#edit_profile_job_skills").val(profile_to_edit.skills);
			$("#edit_profile_job_type").val(profile_to_edit.job_type);
			//$("#edit_profile_job_summary").val(profile_to_edit.summary);
			$("#edit_profile_job_company_name").val(profile_to_edit.company_name);
			$("#edit_profile_job_ctc").val(profile_to_edit.ctc);
			$("#edit_profile_job_position").val(profile_to_edit.position);
			
			$('#edit_profile_job_summary').summernote('code', profile_to_edit.summary);
			//$('#edit_profile_job_skills').summernote('code', profile_to_edit.skills);
			$("#edit_profile_job_sector").val(profile_to_edit.job_sector);
			select_radio_button("job_sector",profile_to_edit.job_sector);
			// console.log(profile_to_edit.job_sector);

			$("#upload_job_profile_image").attr("href",profile_to_edit.job_image);
			console.log(profile_to_edit.job_image);
			
			$("#edit_profile_modal").modal('show')


		})
		/* When edit profile button is clicked End */

		/* When Edit profile Form is submitted */
// 		$(document).on("submit", "#edit_profile_modal_form", function(event){
// 			/* Prevent submitting automatically*/
// 			event.preventDefault();
// 			event.stopPropagation();

// 			/* Serialize the form data to send */
// 			let edit_profile_form_details = $("#edit_profile_modal_form").serializeArray();

// 			/* Add the page ID to be changed */
// 			edit_profile_form_details.push({
// 				"name" : "id",
// 				"value" : profile_to_edit.id
// 			})

// 			edit_profile_form_details = JSON.stringify(edit_profile_form_details);

// 			$.ajax({
// 				url : homepath+'api/recruiter-manage-jobs/',
// 				method : "POST",
// //dataType : 'text',
// 				data : {
// 					"requested_action_to_take" : "modify_job",
// 					"edit_profile_form_details" : edit_profile_form_details
// 				},
// 				beforeSend: function(){
// 					$("#edit_profile_modal_submit").attr('disabled', 'true');
// 					$("#edit_profile_modal_submit").html('Saving...');
// 					$("#edit_profile_modal_error").hide()
// 				},
// 				complete: function(){
// 					$("#edit_profile_modal_submit").removeAttr("disabled");
// 					$("#edit_profile_modal_submit").html('Submit');
// 				},
// 				success : function(result){
// //console.log(result)
// 					if(result.error.number_of_errors > 0){
// 						$("#edit_profile_modal_error").html(result.error.error_message)
// 						$("#edit_profile_modal_error").show()
// 					}
// 					else{
// 						/* Hide the error box and empty the error */
// 						$("#edit_profile_modal_error").hide()
// 						$("#edit_profile_modal_error").html("")

// 						/* Hide the modal */
// 						$("#edit_profile_modal").modal('hide');

// 						/* Show the success message */
// 						alert(result.success.success_message);

// 						/* Refresh the datatable */
// 						api_fetch_job_table_data();
// 					}
// 				},
// 				error : function(er, er2, er3){
// //console.log(er3)
// 					$("#edit_profile_modal_error").html("Something went wrong, please refresh the page and try again.")
// 					$("#edit_profile_modal_error").show()
// 				}
// 			})
// 		})
		/* When Edit profile Form is submitted END */
		
// 		$('#create_new_job_type').tagator({
//             prefix: 'tagator_',           // CSS class prefix
//             height: 'auto',               // auto or element
//             useDimmer: false,             // dims the screen when result list is visible
//             showAllOptionsOnFocus: false, // shows all options even if input box is empty
//             allowAutocompleteOnly: false, // only allow the autocomplete options
//             autocomplete: []              // this is an array of autocomplete options
//         });
		
		// destroy the tag input
		
// 		$('#create_new_job_type').tagator({

//          //autocomplete: ['first','second','third'],

//          useDimmer:true

//         });


//$('#create_new_job_type').tagator('destroy');

		

		/* When Delete selected button is clicked */
		$(document).on("click", "#delete_selected_modal_trigger_button", function(event){
			/* If no profile checkbox is selected */
			if($(".job_checkbox:checked").length == 0){
				event.preventDefault();
				$("#delete_selected_list_container").html("Please select an entry to delete!");

				/* Keep the delete button in the modal disabled */
				$("#delete_selected_modal_submit").attr("disabled", true);

				return false;
			}
			/* If more than 10 have been selected */
			// else if($(".job_checkbox:checked").length > 10){
			// 	event.preventDefault();
			// 	$("#delete_selected_list_container").html("Only 10 profiles can be deleted at a time.");

			// 	/* Keep the delete button in the modal disabled */
			// 	$("#delete_selected_modal_submit").attr("disabled", true);

			// 	return false;
			// }

			/* Enable the delete button in the modal */
			$("#delete_selected_modal_submit").attr("disabled", false);

			/* Empty the "to delete" area in the modal */
			$("#delete_selected_list_container").html("");

			/* Add the list of IDs to be deleted to the "to delete" section in the modal */
			$(".job_checkbox:checked").map(function(){
				$("#delete_selected_list_container").append("<h5>"+all_jobs_data.data.find(x=>x.id == $(this).attr("id").replace("_checkbox", "")).title+"</h5>");
			});

		});
		/* When Delete selected button is clicked End */

		/* When Delete is confirmed */
		$(document).on("click", "#delete_selected_modal_submit", function(){
			/* Array of IDs of profiles to be deleted, converted to JSON */
			let requested_profiles_to_delete_json = JSON.stringify( $(".job_checkbox:checked").map(function(){
				return $(this).attr("id").replace("_checkbox", "");
			}).get());

			/* Ajax request to delete the selected profile */
			$.ajax({
				url : homepath+'api/recruiter-manage-jobs/',
				method : "POST",
//dataType : 'text',
				data : {
					"requested_action_to_take" : "delete_jobs",
					"requested_profiles_to_delete_json" : requested_profiles_to_delete_json
				},
				beforeSend: function(){
					$("#delete_selected_modal_submit").attr('disabled', 'true');
					$("#delete_selected_modal_submit").html('Deleting...');
					$("#delete_selected_modal_error").hide()
				},
				complete: function(){
					$("#delete_selected_modal_submit").removeAttr("disabled");
					$("#delete_selected_modal_submit").html('Delete Permanently');
				},
				success : function(result){
//console.log(result)
					if(result.error.number_of_errors > 0){
						$("#delete_selected_modal_error").html(result.error.error_message)
						$("#delete_selected_modal_error").show()
					}
					else{
						/* Hide the error box and empty the error */
						$("#delete_selected_modal_error").hide()
						$("#delete_selected_modal_error").html("")

						/* Hide the modal */
						$("#delete_selected_modal").modal('hide');

						/* Show the success message */
						alert(result.success.success_message);


						/* Refresh the datatable */
						api_fetch_job_table_data();
					}
				},
				error : function(er, er2, er3){
//console.log(er3)
					$("#edit_profile_modal_error").html("Something went wrong, please refresh the page and try again.")
					$("#edit_profile_modal_error").show()
				}
			})
		});
		/* When Delete is confirmed End */

		/* Ajax to get Data from the admin table data api */
		function api_fetch_job_table_data(){
			var url_string = window.location.href;
			console.log(url_string);
			var url_parameters="";
			if(url_string.indexOf("?")!=-1){
						url_parameters = url_string.substr(url_string.indexOf("?") + 1);
			}
			$.ajax({
				url : homepath+'api/recruiter-manage-jobs/?'+url_parameters,
				method : "POST",
        // dataType : 'text',
				data : {
					"requested_action_to_take" : "fetch_job_table_data"
				},
				beforeSend: function(){
					$('#table_container').hide();
					$("#table_loading").show();
				},
				complete: function(){
					$("#table_loading").hide();
				},
				success : function(result){
console.log(result)
					if(result.error.number_of_errors > 0){
						$("#table_container_card_body").append('<div class="alert alert-danger " role="alert"><strong>'+result.error.error_message+'</strong></div>');
					}
					else{
						/* Send the received data to refresh datatable function */
						refresh_datatable(result)

						/* Save received data to universal variable */
						all_jobs_data = result;
					}
				},
				error : function(){
					$("#table_container_card_body").append('<div class="alert alert-danger " role="alert"><strong>Could not load the table, please refresh the page and try again.</strong></div>');
				}
			})
		}
		/* Ajax to get Data from the admin table data api END */

		/* Function to refresh the datatable with given data */
		function refresh_datatable(input_table_data){
			if($.fn.DataTable.isDataTable( '#dataTable')){
				$('#dataTable').DataTable().destroy()
			}

			$('#dataTable').empty()


			$('#dataTable').DataTable({
				dom: 'Blfrtip',
        buttons: ['copy', 'excel'],
				"data" : input_table_data.data,
				"columns" : input_table_data.columns,
				order: [[ 0, 'desc' ]],
			})

			$('#table_container').show();
		}
		/* Function to refresh the datatable with given data END */

		/* Call function to create the table at the start */
		api_fetch_job_table_data();
		/* Call function to create the table at the start END*/
		
				
	$(document).on("click", ".active_button", function () {
        /* Array of IDs of profiles to be deleted, converted to JSON */
        let requested_job_profile_to_active = $(this).attr("id").replace("_active_button", "");
        console.log(requested_job_profile_to_active);

        /* Ajax request to delete the selected profile */
        $.ajax({
            url: homepath + 'api/recruiter-manage-jobs/',
            method: "POST",
             //dataType: 'text',
            data: {
                "requested_action_to_take": "active_profiles",
                "requested_job_profile_to_active": requested_job_profile_to_active
            },
            beforeSend: function () {
                $(this).attr('disabled', 'true');
                $(this).html('Unlocking...');
            },
            complete: function () {
                $(this).removeAttr("disabled");
                $(this).html('Unlock');
            },
            success: function (result) {
                console.log(result)
                if (result.error.number_of_errors > 0) {
                    alert(result.error.error_message)
                }
                else {
                    /* Show the success message */
                    alert(result.success.success_message);

                    /* Refresh the page */
                    //api_fetch_job_table_data();
                   window.location.reload();
                }
            },
            error: function (er, er2, er3) {
                console.log(er3)
                alert("Something went wrong, please refresh the page and try again.")
            }
        })
    });
    
        	 /* When Delete is confirmed */
    $(document).on("click", ".inactive_button", function () {
        /* Array of IDs of profiles to be deleted, converted to JSON */
        let requested_job_profile_to_inactive_profiles = $(this).attr("id").replace("_inactive_button", "");
//console.log();

        $(".inactive_button").attr('disabled', 'true');
        $(".inactive_button").html('Inactive...');
        $(".active_button").attr('disabled', 'true');
        $(".active_button").html('Active...');
        /* Ajax request to delete the selected profile */
        $.ajax({
            url: homepath + 'api/recruiter-manage-jobs/',
            method: "POST",
             //dataType: 'text',
            data: {
                "requested_action_to_take": "inactive_profiles",
                "requested_job_profile_to_inactive_profiles": requested_job_profile_to_inactive_profiles
            },
            beforeSend: function () {
                $(this).attr('disabled', 'true');
                $(this).html('Unverify...');
            },
            complete: function () {
                $(this).removeAttr("disabled");
                $(this).html('Unlock');
            },
            success: function (result) {
                console.log(result)
                if (result.error.number_of_errors > 0) {
                    alert(result.error.error_message)
                }
                else {
                    /* Show the success message */
                    alert(result.success.success_message);

                    /* Refresh the page */
                    //window.location.reload();
                    api_fetch_job_table_data();
                }
            },
            error: function (er, er2, er3) {
                console.log(er3)
                alert("Something went wrong, please refresh the page and try again.")
            }
        })
    });
    /* When Delete is confirmed End */
	});
	
