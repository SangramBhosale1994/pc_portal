	let all_events_data;
	let profile_to_edit = {};

	$(document).ready(function() {
		/* initialize the text editor fields */
		// $('#create_new_event_summary').summernote();
		$('#edit_event_summary').summernote();
		$('#create_new_event_speaker_details').summernote();
		$('#edit_event_speaker_details').summernote();	
		/* initialize the text editor fields END */
		$('#create_new_event_summary').summernote({
			height: 300,
			dialogsInBody: true,
			onImageUpload: function(files, editor, welEditable) {
				sendFile(files[0], editor, welEditable);
		}
			// callbacks: {
			// 	onImageUpload: function(files) {
			// 		uploadImage(files[0], this);
			// 	},
			// 	onMediaDelete: function($target, editor, $editable) {
			// 		deleteImage($target);
			// 	}
			// }
		});
		function sendFile(file, editor, welEditable) {
			data = new FormData();
			data.append("files", file);
			upload_url = "<?php echo base_url(); ?>" + "dashboard/uploader/";
			$.ajax({
					data: data,
					type: "POST",
					url: upload_url,
					cache: false,
					contentType: false,
					processData: false,
					success: function(url) {
							editor.insertImage(welEditable, url);
					}
			});
	}
		
		// function uploadImage(file, editor) {
		// 	var data = new FormData();
		// 	data.append("file", file);
		// 	$.ajax({
		// 		url: "upload.php",
		// 		cache: false,
		// 		contentType: false,
		// 		processData: false,
		// 		data: data,
		// 		type: "post",
		// 		success: function(url) {
		// 			$(editor).summernote("insertImage", url);
		// 		},
		// 		error: function(data) {
		// 			console.log(data);
		// 		}
		// 	});
		// }
		
		// function deleteImage($target) {
		// 	$.ajax({
		// 		url: "delete.php",
		// 		data: {src: $target.attr("src")},
		// 		type: "post",
		// 		success: function(response) {
		// 			console.log(response);
		// 		},
		// 		error: function(data) {
		// 			console.log(data);
		// 		}
		// 	});
		// }
		

		/* When checkbox is clicked */
		$(document).on("change", ".event_checkbox", function () {
			/* Change background colour of the row */
			let row_selection_bg_colour = "#fff";

			if($(this).prop("checked")){
				row_selection_bg_colour = "#f9f9f9";
			}

			$(this).parents("tr").css("background-color", row_selection_bg_colour);
			/* Change background colour of the row End */
		});
		/* When checkbox is clicked End */

		/* When Create New form is submitted */
		$(document).on("submit", "#create_new_modal_form", function(event){
			/* Prevent submitting automatically*/
			event.preventDefault();
			event.stopPropagation();
			
			/* Serialize the form data to send */
			let new_event_form_details = JSON.stringify($("#create_new_modal_form").serializeArray());
      //console.log(new_event_form_details)
			$.ajax({
				url : homepath+'api/admin-manage-events/',
				method : "POST",
         // dataType : 'text',
				data : {
					"requested_action_to_take" : "create_event",
					"new_event_form_details" : new_event_form_details
				},
				beforeSend: function(){
					$('#create_new_modal_submit').attr('disabled', 'true');
					$('#create_new_modal_submit').html('Creating...');
					$("#create_new_modal_error").hide()
				},
				complete: function(){
					$('#create_new_modal_submit').removeAttr("disabled");
					$('#create_new_modal_submit').html('Submit');
				},
				success : function(result){
console.log(result)
					if(result.error.number_of_errors > 0){
						$("#create_new_modal_error").html(result.error.error_message)
						$("#create_new_modal_error").show()
					}
					else{
						/* Hide the error box and empty the error */
						$("#create_new_modal_error").hide()
						$("#create_new_modal_error").html("")

						/* Hide the modal */
						$("#create_new_modal").modal('hide');
						/* Refresh the datatable */
						api_fetch_event_table_data();
						$('#create_new_event_summary').summernote('reset');
						$('#create_new_event_speaker_details').summernote('reset');
					}
				},
				error : function(er, er2, er3){
console.log(er3)
					$("#create_new_modal_error").html("Something went wrong, please refresh the page and try again.")
					$("#create_new_modal_error").show()
				}
			})
		})
		/* When Create New form is submitted END */

		/* When create new modal has been closed */
		$("#create_new_modal").on("hide.bs.modal", function(){
			document.getElementById("create_new_modal_form").reset();
		})
		/* When create new modal has been closed END */

		/* When Edit modal has been closed */
		$("#edit_profile_modal_form").on("hide.bs.modal", function(){
			document.getElementById("edit_profile_modal_form").reset();
		})
		/* When edit modal has been closed END */

		/* When edit profile button is clicked */
		$(document).on("click", ".profile_edit_button", function(){
			profile_to_edit={};
			profile_to_edit.id = $(this).attr("id").replace("_edit_button", "");
      console.log(profile_to_edit);
			profile_to_edit = all_events_data.data.find(x=>x.id == profile_to_edit.id)

			$("#edit_event_title").val(profile_to_edit.title);
			$("#edit_event_application_deadline").val(profile_to_edit.application_deadline);
			$("#edit_event_event_code").val(profile_to_edit.event_code);
			$("#edit_event_event_facilitated_by").val(profile_to_edit.event_facilitated_by);
			$("#edit_event_location").val(profile_to_edit.location);
			$("#edit_event_event_start_date").val(profile_to_edit.event_start_date);
			$("#edit_event_event_end_date").val(profile_to_edit.event_end_date);
			$("#edit_event_event_start_time").val(profile_to_edit.event_start_time);
			$("#edit_event_event_end_time").val(profile_to_edit.event_end_time);
			$("#edit_event_event_link").val(profile_to_edit.event_link);
			$("#edit_event_who_can_attend").val(profile_to_edit.event_who_can_attend);
			$("#edit_event_event_ticket_price").val(profile_to_edit.ticket_price);

			$('#edit_event_summary').summernote('code', profile_to_edit.summary);
			$('#edit_event_speaker_details').summernote('code', profile_to_edit.event_speaker_details);

			console.log(profile_to_edit.is_show_popup);
			if (profile_to_edit.is_show_popup === "Show") {
				// Set the checkbox to checked
				$('input[name="edit_event_show_workshop_popup"]').prop('checked', true);
			} else {
					// Set the checkbox to unchecked
					$('input[name="edit_event_show_workshop_popup"]').prop('checked', false);
			}
			
			$("#edit_profile_modal").modal('show');


		})
		/* When edit event button is clicked End */

		/* When Edit event Form is submitted */
		$(document).on("submit", "#edit_profile_modal_form", function(event){
			/* Prevent submitting automatically*/
			event.preventDefault();
			event.stopPropagation();

			/* Serialize the form data to send */
			let edit_profile_form_details = $("#edit_profile_modal_form").serializeArray();

			/* Add the page ID to be changed */
			edit_profile_form_details.push({
				"name" : "id",
				"value" : profile_to_edit.id
			})

			edit_profile_form_details = JSON.stringify(edit_profile_form_details);

			$.ajax({
				url : homepath+'api/admin-manage-events/',
				method : "POST",
// dataType : 'text',
				data : {
					"requested_action_to_take" : "modify_event",
					"edit_profile_form_details" : edit_profile_form_details
				},
				beforeSend: function(){
					$("#edit_profile_modal_submit").attr('disabled', 'true');
					$("#edit_profile_modal_submit").html('Saving...');
					$("#edit_profile_modal_error").hide()
				},
				complete: function(){
					$("#edit_profile_modal_submit").removeAttr("disabled");
					$("#edit_profile_modal_submit").html('Submit');
				},
				success : function(result){
console.log(result)
					if(result.error.number_of_errors > 0){
						$("#edit_profile_modal_error").html(result.error.error_message)
						$("#edit_profile_modal_error").show()
					}
					else{
						/* Hide the error box and empty the error */
						$("#edit_profile_modal_error").hide()
						$("#edit_profile_modal_error").html("")

						/* Hide the modal */
						$("#edit_profile_modal").modal('hide');

						/* Show the success message */
						alert(result.success.success_message);

						/* Refresh the datatable */
						api_fetch_event_table_data();
					}
				},
				error : function(er, er2, er3){
//console.log(er3)
					$("#edit_profile_modal_error").html("Something went wrong, please refresh the page and try again.")
					$("#edit_profile_modal_error").show()
				}
			})
		})
		/* When Edit profile Form is submitted END */

		/* When Delete selected button is clicked */
		$(document).on("click", "#delete_selected_modal_trigger_button", function(event){
			/* If no profile checkbox is selected */
			if($(".event_checkbox:checked").length == 0){
				event.preventDefault();
				$("#delete_selected_list_container").html("Please select an entry to delete!");

				/* Keep the delete button in the modal disabled */
				$("#delete_selected_modal_submit").attr("disabled", true);

				return false;
			}
			/* If more than 10 have been selected */
			// else if($(".event_checkbox:checked").length > 10){
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
			$(".event_checkbox:checked").map(function(){
				$("#delete_selected_list_container").append("<h5>"+all_events_data.data.find(x=>x.id == $(this).attr("id").replace("_checkbox", "")).title+"</h5>");
			});

		});
		/* When Delete selected button is clicked End */

		/* When Delete is confirmed */
		$(document).on("click", "#delete_selected_modal_submit", function(){
			/* Array of IDs of profiles to be deleted, converted to JSON */
			let requested_profiles_to_delete_json = JSON.stringify( $(".event_checkbox:checked").map(function(){
				return $(this).attr("id").replace("_checkbox", "");
			}).get());

			/* Ajax request to delete the selected profile */
			$.ajax({
				url : homepath+'api/admin-manage-events/',
				method : "POST",
//dataType : 'text',
				data : {
					"requested_action_to_take" : "delete_events",
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
						api_fetch_event_table_data();
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
		function api_fetch_event_table_data(){
			$.ajax({
				url : homepath+'api/admin-manage-events/',
				method : "POST",
//dataType : 'text',
				data : {
					"requested_action_to_take" : "fetch_event_table_data"
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
						all_events_data = result;
					}
				},
				error : function(e1, e2, e3){
//console.log(e3);
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
				order: [[ 1, 'desc' ]],
			})

			$('#table_container').show();
		}
		/* Function to refresh the datatable with given data END */

		/* Call function to create the table at the start */
		api_fetch_event_table_data();
		/* Call function to create the table at the start END*/
	});