	var candidate_filter;
	$(document).ready(function() {
		/* When Columns to be shown are changed */
		$(document).on("click", "#column_select_modal_submit", function(){
			let column_select_checkbox_array = $(".column_select_checkbox:checked").map(function(){
				return $(this).attr("id");
			}).get();

			api_fetch_candidate_table_data(JSON.stringify(column_select_checkbox_array));
		});
		/* When Columns to be shown are changed End */

		/* When checkbox is clicked */
		$(document).on("change", ".candidate_checkbox", function () {
			/* Change background colour of the row */
			let row_selection_bg_colour = "#fff";

			if($(this).prop("checked")){
				row_selection_bg_colour = "#f9f9f9";
			}

			$(this).parents("tr").css("background-color", row_selection_bg_colour);
			/* Change background colour of the row End */

			/* Add
console.log(result)elements to the delete dialogue */

			/* Add elements to the delete dialogue End*/
		});
		/* When checkbox is clicked End */

		/* When select-all-checkbox is clicked */
		// $(document).on("change",".select_all_checkbox", function(){
		// 	$(".candidate_checkbox").prop('checked', $(this).prop("checked"));
		// });

		$('[data-toggle="tooltip"]').tooltip(); 

		$(document).on("change","#select_all_checkbox", function(){
			console.log("select all");
			$("#dataTable .candidate_checkbox").prop('checked', $(this).prop("checked"));
			// $("#select_all_checkbox").html('Unselect All');
			// console.log($("#select_all_checkbox").val());
			console.log($(this).prop("checked"));
		});
		$(document).on("click",".paginate_button", function(){
			console.log("paginate");
			$("#select_all_checkbox").prop('checked','');
			$("#dataTable .candidate_checkbox").prop('checked','');
		});
		/* When select-all-checkbox is clicked End*/

		
	

		/* When show profile button is clicked */
		$(document).on("click", "#show_profile_button", function(){
			/* Making sure one and only one checkbox is selected */
			if($(".candidate_checkbox:checked").length == 0){
				alert("Please select an entry to show!");
				return false;
			}
			// else if($(".candidate_checkbox:checked").length > 1){
			// 	alert("You can open only 1 profile at once.");
			// 	return false;
			// }

			/* Requesed page and the requested fields encoded in json  */
			let requested_page_info_json = JSON.stringify({
				page_id : $(".candidate_checkbox:checked").attr('id').replace("_checkbox", ""),
				page_fields : [
					"httpUrl"
				]
			});

			/* Make ajax request to get the URL of the requested profile */
			$.ajax({
				url : homepath+'api/fetch-page-info/',
				method : "POST",
				data : {
					"requested_page_info_json" : requested_page_info_json
				},
				success : function(result){
					if(result.error.number_of_errors > 0){
						alert(result.error.error_message);
					}
					else{
						var win = window.open(result.data.httpUrl, '_blank');

						if (win) {
							//Browser has allowed it to be opened
							win.focus();
						} else {
							//Browser has blocked it
							alert('Please allow popups for this website');
						}
					}
				},
				error : function(jqXHR, textStatus, errorThrown){
					alert("Something went wrong, please refresh the page and try again.");
				}
			})
		})
		/* When show profile button is clicked End */

		/* When unlcok profiles button is clicked */
		$(document).on("click", "#unlcok_profiles_button", function(){
			/* If no profile checkbox is selected */
			if($(".candidate_checkbox:checked").length == 0){
				event.preventDefault();
				alert("Please select a profile!");

				return false;
			}

			/* Array of IDs of profiles to be unlocked, converted to JSON */
			let requested_profiles_to_unlock_json = JSON.stringify( $(".candidate_checkbox:checked").map(function(){
				return $(this).attr("id").replace("_checkbox", "");
			}).get());

			/* Ajax request to favourite the selected profiles */
			$.ajax({
				url : homepath+'api/recruiter-manage-candidates/',
				method : "POST",
// dataType : "text",
				data : {
					"requested_action_to_take" : "unlock_profiles",
					"requested_profiles_to_unlock_json" : requested_profiles_to_unlock_json
				},
				success : function(result){
console.log(result);
					
					/* If errors are sent from the back-end */
					if(result.error.number_of_errors > 0){
						alert(result.error.error_message);
					}
					else{
						alert(result.success.success_message);
						$("#select_all_checkbox").prop('checked','');
						/* Refresh the table to update the unlisted profile entries */
						api_fetch_candidate_table_data("default");
					}
				},
				error : function(){
					alert("Something went wrong, please refresh the page and try again.")
				}
			})
		});
		/* When unlcok profiles button is clicked END */


		/* When edit profile button is clicked */
		// $(document).on("click", "#edit_profile_button", function(){
		// 	if($(".candidate_checkbox:checked").length == 0){
		// 		alert("Please select an entry to edit!");
		// 		return false;
		// 	}
		// 	else if($(".candidate_checkbox:checked").length > 1){
		// 		alert("You can edit only 1 profile at once.");
		// 		return false;
		// 	}

		// 	let page_id = $(".candidate_checkbox:checked").attr('id').replace("_checkbox", "")

		// 	var win = window.open("../../edit-application/?page_id="+page_id, '_blank');

		// 	if (win) {
		// 		//Browser has allowed it to be opened
		// 		win.focus();
		// 	} else {
		// 		//Browser has blocked it
		// 		alert('Please allow popups for this website');
		// 	}
		// })
		/* When edit profile button is clicked End */

		/* When Unlist selected button is clicked */
		$(document).on("click", "#unlist_selected_modal_trigger_button", function(event){
			/* If no profile checkbox is selected */
			if($(".candidate_checkbox:checked").length == 0){
				event.preventDefault();
				$("#unlist_selected_list_container").html("Please select an entry to unlist!");

				/* Keep the unlist button in the modal disabled */
				$("#unlist_selected_modal_submit").attr("disabled", true);

				return false;
			}
			/* If more than 10 have been selected */
			// else if($(".candidate_checkbox:checked").length > 10){
			// 	event.preventDefault();
			// 	$("#unlist_selected_list_container").html("Only 10 profiles can be unlisted at a time.");

			// 	/* Keep the unlist button in the modal disabled */
			// 	$("#unlist_selected_modal_submit").attr("disabled", true);

			// 	return false;
			// }

			/* Enable the unlist button in the modal */
			$("#unlist_selected_modal_submit").attr("disabled", false);

			/* Empty the "to unlist" area in the modal */
			$("#unlist_selected_list_container").html("");

			/* Add the list of IDs to be unlistd to the "to unlist" section in the modal */
			$(".candidate_checkbox:checked").map(function(){
				$("#unlist_selected_list_container").append("<h5>"+$(this).attr("id").replace("_checkbox", "")+"</h5>");
			});

		});
		/* When unlist selected button is clicked End */

		/* When unlist is confirmed */
		$(document).on("click", "#unlist_selected_modal_submit", function(){
			/* Array of IDs of profiles to be unlisted, converted to JSON */
			let requested_profiles_to_unlist_json = JSON.stringify( $(".candidate_checkbox:checked").map(function(){
				return $(this).attr("id").replace("_checkbox", "");
			}).get());

			/* Ajax request to unlist the selected profile */
			$.ajax({
				url : homepath+'api/recruiter-manage-candidates/',
				method : "POST",
// dataType : "text",
				data : {
					"requested_action_to_take" : "unlist_from_favourite",
					"requested_profiles_to_unlist_json" : requested_profiles_to_unlist_json
				},
				success : function(result){
console.log(result)
					
					

					/* If errors are sent from the back-end */
					if(result.error.number_of_errors > 0){
						alert(result.error.error_message);
					}
					else{
						alert(result.success.success_message);
						$("#select_all_checkbox").prop('checked','');
						/* Refresh the table to update the unlisted profile entries */
						api_fetch_candidate_table_data("default");
					}
				},
				error : function(){
					alert("Something went wrong, please refresh the page and try again.")
				}
			})
		});
		/* When unlist is confirmed End */

		/* Ajax to get Data from the admin table data api */
			function api_fetch_candidate_table_data(requested_columns_array_json){
				$.ajax({
					url : homepath+'api/recruiter-manage-candidates/',
					method : "POST",
// dataType : 'text',
					data : {
						"requested_action_to_take" : "fetch_favourite_table_data",
						"requested_columns_array_json" : requested_columns_array_json
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
							refresh_datatable(result)
						}
					},
					error : function(){
						$("#table_container_card_body").append('<div class="alert alert-danger " role="alert"><strong>Something went wrong, please refresh the page and try again.</strong></div>');
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
				"data" : input_table_data.data,
				"columns" : input_table_data.columns
			})

			$('#table_container').show();
		}
		/* Function to refresh the datatable with given data END */

		/** Call function when click on view button  */
		$(document).on("click", ".view_candidate_profile", function(){
			/* Array of IDs of profiles to be listed, converted to JSON */
			// console.log($(this).data("id"));
			console.log($(this).prop("id"));
			// let requested_profiles_to_download_json=$(this).attr("id");
			let viewed_candidate_array=[$(this).attr("id")];
			let requested_profiles_to_viewed_profile_json = JSON.stringify( viewed_candidate_array );
console.log(requested_profiles_to_viewed_profile_json);
			/* Ajax request to unlist the selected profile */
			$.ajax({
				url : homepath+'api/recruiter-manage-candidates/',
				method : "POST",
// dataType : "text",
				data : {
					"requested_action_to_take" : "view_candidate_profile",
					"requested_profiles_to_viewed_profile_json" : requested_profiles_to_viewed_profile_json
				},
				success : function(result){
console.log(result)
					/* Refresh the table to update the unlisted profile entries */
					api_fetch_candidate_table_data("default");

					/* If errors are sent from the back-end */
					if(result.error.number_of_errors > 0){
						// alert(result.error.error_message);
						console.log(result.error.error_message);
					}
					else{
						// alert(result.success.success_message);
						console.log(result.success.success_message);
					}
				},
				error : function(){
					alert("Something went wrong, please refresh the page and try again.")
				}
			})
		});
		/** End Call function when click on view button  */

		/** Call function when click on view button  */
		$(document).on("click","#candidate_status_filters", function(){
			/* Array of IDs of profiles to be listed, converted to JSON */
			// console.log($(this).data("id"));
			// console.log($(this).val());
			// let requested_profiles_to_download_json=$(this).attr("id");
			// let candidate_status=[$(this).val()];
			console.log(homepath+'api/recruiter-manage-candidates/');
			let candidate_status = JSON.stringify($("#candidate_filter_form").serializeArray());
			// let candidate_status = JSON.stringify($("#candidate_filter_form").serializeArray());
			console.log(candidate_status);
			let requested_show_only_mine;
			requested_show_only_mine="false";
			if($('#show_only_mine_checkbox').is(":checked")) {
				requested_show_only_mine="true";
			}
			else{
				requested_show_only_mine="false";
			}
			console.log(requested_show_only_mine);
// 			let requested_profiles_to_viewed_profile_json = JSON.stringify( candidate_status );
// console.log(requested_profiles_to_viewed_profile_json);
			/* Ajax request to unlist the selected profile */
			$.ajax({
				url : homepath+'api/recruiter-manage-candidates/',
				method : "POST",
// dataType : "text",
				data : {
					// "requested_columns_array_json" : "default",
					// "requested_action_to_take" : "candidate_status_filter",
					"requested_candidate_status" : candidate_status,
					"candidate_filter" : "true",
					"requested_show_only_mine" : requested_show_only_mine
				},
				success : function(result){
console.log(result)
					/* Refresh the table to update the unlisted profile entries */
					
					refresh_datatable(result)
					/* If errors are sent from the back-end */
					if(result.error.number_of_errors > 0){
						// alert(result.error.error_message);
						console.log(result.error.error_message);
					}
					else{
						// alert(result.success.success_message);
						console.log(result.success.success_message);
					}
				},
				error : function(e){
					alert("Something went wrong, please refresh the page and try again..")
					// console.log("88");
					// console.log(e);
				}
			})
		});
		/** End Call function when click on view button  */

		/**Add show only mine filter using checkbox */
		$(document).on("change","#show_only_mine_checkbox", function(){
			console.log("Show only mine checkbox");
			 // Check if the checkbox is checked
  		if ($(this).is(":checked")) {
				let candidate_status = JSON.stringify($("#candidate_filter_form").serializeArray());
				if (candidate_status.length === 0) {
					candidate_status="";
					candidate_filter="false";
				} else {
					candidate_status=candidate_status;
					candidate_filter="true";
				}
				
			console.log("show only "+candidate_status);
				$.ajax({
					url : homepath+'api/recruiter-manage-candidates/',
					method : "POST",
	// dataType : "text",
					data : {
						"requested_show_only_mine" : "true",
						"requested_candidate_status" : candidate_status,
						"candidate_filter" : "true",
					},
					success : function(result){
	console.log(result)
						/* Refresh the table to update the unlisted profile entries */
						
						refresh_datatable(result)
						/* If errors are sent from the back-end */
						if(result.error.number_of_errors > 0){
							// alert(result.error.error_message);
							console.log(result.error.error_message);
						}
						else{
							// alert(result.success.success_message);
							console.log(result.success.success_message);
						}
					},
					error : function(e){
						alert("Something went wrong, please refresh the page and try again..")
					}
				})
			}
			else{
				api_fetch_candidate_table_data("default");
			}
			
		});
		/**Add show only mine filter using checkbox End*/

		/* Call function to create the table at the start */
		api_fetch_candidate_table_data("default");
		/* Call function to create the table at the start END*/
	});
