	$(document).ready(function() {
		/* When Columns to be shown are changed */
		$(document).on("click", "#column_select_modal_submit", function(){
			let column_select_checkbox_array = $(".column_select_checkbox:checked").map(function(){
				return $(this).attr("id");
			}).get();

			//api_fetch_candidate_table_data(JSON.stringify(column_select_checkbox_array));
			fetch_columns(JSON.stringify(column_select_checkbox_array),"");
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
			else if($(".candidate_checkbox:checked").length > 1){
				alert("You can open only 1 profile at once.");
				return false;
			}

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

		/* When Add to Favourite button is clicked */
		$(document).on("click", "#add_to_favourite_button", function(){
			/* If no profile checkbox is selected */
			if($(".candidate_checkbox:checked").length == 0){
				event.preventDefault();
				alert("Please select a profile!");

				return false;
			}

			/* Array of IDs of profiles to be added to favourite, converted to JSON */
			let requested_profiles_to_favourite_json = JSON.stringify( $(".candidate_checkbox:checked").map(function(){
				return $(this).attr("id").replace("_checkbox", "");
			}).get());

			/* Ajax request to favourite the selected profiles */
			$.ajax({
				url : homepath+'api/editor-manage-candidates/',
				method : "POST",
//dataType : "text",
				data : {
					"requested_action_to_take" : "add_to_favourite",
					"requested_profiles_to_favourite_json" : requested_profiles_to_favourite_json
				},
				success : function(result){
console.log(result);
					/* If errors are sent from the back-end */
					if(result.error.number_of_errors > 0){
						alert(result.error.error_message);
					}
					else{
						alert(result.success.success_message);
						// api_fetch_candidate_table_data("default");
						//fetch_columns("default","");

					}
					
				},
				error : function(){
					alert("Something went wrong, please refresh the page and try again.")
				}
			})
		});
		/* When Add to Favourite button is clicked END */

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
				url : homepath+'api/editor-manage-candidates/',
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
						// api_fetch_candidate_table_data("default");
						//fetch_columns("default","");
					}
					
				},
				error : function(){
					alert("Something went wrong, please refresh the page and try again.")
				}
			})
		});
		/* When unlcok profiles button is clicked END */


			/* When edit profile button is clicked */
			$(document).on("click", "#edit_profile_button", function(){
				if($(".candidate_checkbox:checked").length == 0){
					alert("Please select an entry to edit!");
					return false;
				}
				else if($(".candidate_checkbox:checked").length > 1){
					alert("You can edit only 1 profile at once.");
					return false;
				}
	
				let page_id = $(".candidate_checkbox:checked").attr('id').replace("_checkbox", "")
	
				var win = window.open(homepath+"edit-application/?page_id="+page_id, '_blank');
	
				if (win) {
					//Browser has allowed it to be opened
					win.focus();
				} else {
					//Browser has blocked it
					alert('Please allow popups for this website');
				}
			})
			/* When edit profile button is clicked End */

		/* When Delete selected button is clicked */
		$(document).on("click", "#delete_selected_modal_trigger_button", function(event){
			/* If no profile checkbox is selected */
			if($(".candidate_checkbox:checked").length == 0){
				event.preventDefault();
				$("#delete_selected_list_container").html("Please select an entry to delete!");

				/* Keep the delete button in the modal disabled */
				$("#delete_selected_modal_submit").attr("disabled", true);

				return false;
			}
			/* If more than 10 have been selected */
			// else if($(".candidate_checkbox:checked").length > 10){
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
			$(".candidate_checkbox:checked").map(function(){
				$("#delete_selected_list_container").append("<h5>"+$(this).attr("id").replace("_checkbox", "")+"</h5>");
			});

		});
		/* When Delete selected button is clicked End */

		/* When Delete is confirmed */
		$(document).on("click", "#delete_selected_modal_submit", function(){
			/* Array of IDs of profiles to be deleted, converted to JSON */
			let requested_profiles_to_delete_json = JSON.stringify( $(".candidate_checkbox:checked").map(function(){
				return $(this).attr("id").replace("_checkbox", "");
			}).get());

			/* Ajax request to delete the selected profile */
			$.ajax({
				url : homepath+'api/delete-candidate-profile/',
				method : "POST",
				data : {
					"requested_profiles_to_delete_json" : requested_profiles_to_delete_json
				},
				success : function(result){
					/* Refresh the table to update the deleted profile entries */
					// api_fetch_candidate_table_data("default");
					

					/* If errors are sent from the back-end */
					if(result.error.number_of_errors > 0){
						alert(result.error.error_message);
					}
					else{
						alert(result.success.success_message);
						fetch_columns("default","");
					}
				},
				error : function(){
					alert("Something went wrong, please refresh the page and try again. Local error")
				}
			})
		});
		/* When Delete is confirmed End */

		/* Ajax to get Data from the admin table data api */
		function fetch_columns(column_select_checkbox_array,search_filter_data){
					
			console.log(column_select_checkbox_array);
			if(column_select_checkbox_array!=""){
				columns_array=column_select_checkbox_array;

			}
			else{
				columns_array="default";
			}

			if(search_filter_data!=""){
				search_filter=search_filter_data;
				filter_form="true";
			}
			else{
				search_filter="";
				filter_form="false";
			}
				var url_string = window.location.href;
				console.log(url_string);
				var url_parameters="";
				if(url_string.indexOf("?")!=-1){
							url_parameters = url_string.substr(url_string.indexOf("?") + 1);
				}
				
				console.log(url_parameters);
			$.ajax({
					url : homepath+'api/fetch-candidate-table-data/',

					method : "POST",
// dataType : 'text',

					data : {
						"requested_columns_array_json" : columns_array,
						"length" : 0
					},
				
					success : function(result){
console.log(result)
						if(result.error.number_of_errors > 0){
							$("#table_container_card_body").append('<div class="alert alert-danger " role="alert"><strong>'+result.error.error_message+'</strong></div>');
						}
						else{
							//refresh_datatable(result)
							datatable_columns=result.columns;
							//datatable_data=result.data;
							console.log(datatable_columns);
							refresh_datatable("default",search_filter,filter_form,url_parameters);
						}
					},
					error : function(){
						$("#table_container_card_body").append('<div class="alert alert-danger " role="alert"><strong>Something went wrong, please refresh the page and try again.</strong></div>');
					}
				});
			}

		function refresh_datatable(columns_array_fetch,search_filter,filter_form,url_parameters){
					console.log("222");
					if($.fn.DataTable.isDataTable( '#dataTable')){
						$('#dataTable').DataTable().destroy()
					}
		
					$('#dataTable').empty()
					var url_parameters;
					if(url_parameters==""){
						url_parameters="";
					}
					else{
						url_parameters=url_parameters;
					}

					$('#dataTable').DataTable({
								 //dom: 'tlip',
						dom: 'Blfrtip',
						buttons: ['copy', 'excel'],
						"processing": true,
						"searching": true,
							ajax: {
								url: homepath + "api/fetch-candidate-table-data/?"+url_parameters,
								type: 'POST',
								data:{
									"filter_form" : filter_form,
										"search_form_details" : search_filter,
									"requested_columns_array_json" : columns_array_fetch
									// "filter_form" : filter_form,
										// "search_form_details" : search_filter
								},
							},
						"columns":datatable_columns,
						"serverSide": true,
						"searching": true
					});

				$('#table_container').show();
				
		}





// 			function api_fetch_candidate_table_data(requested_columns_array_json){
// 				var url_string = window.location.href;
//                 var url_parameters="";
//                 if(url_string.indexOf("?")!=-1){
//                       url_parameters = url_string.substr(url_string.indexOf("?") + 1);
//                 }
        
//                 console.log(url_parameters);
// 				$.ajax({
// 					url : homepath+'api/fetch-candidate-table-data/?'+url_parameters,
// 					method : "POST",
// //dataType : 'text',
// 					data : {
// 						"requested_columns_array_json" : requested_columns_array_json
// 					},
// 					beforeSend: function(){
// 						$('#table_container').hide();
// 						$("#table_loading").show();
// 					},
// 					complete: function(){
// 						$("#table_loading").hide();
// 					},
// 					success : function(result){
// console.log(result)
// 						if(result.error.number_of_errors > 0){
// 							$("#table_container_card_body").append('<div class="alert alert-danger " role="alert"><strong>'+result.error.error_message+'</strong></div>');
// 						}
// 						else{
// 							refresh_datatable(result)
// 						}
// 					},
// 					error : function(){
// 						$("#table_container_card_body").append('<div class="alert alert-danger " role="alert"><strong>Something went wrong, please refresh the page and try again.</strong></div>');
// 					}
// 				})
// 			}
		/* Ajax to get Data from the admin table data api END */

		/* Function to refresh the datatable with given data */
		// function refresh_datatable(input_table_data){
		// 	if($.fn.DataTable.isDataTable( '#dataTable')){
		// 		$('#dataTable').DataTable().destroy()
		// 	}

		// 	$('#dataTable').empty()


		// 	$('#dataTable').DataTable({
		// 		dom: 'Blfrtip',
    //     buttons: ['copy', 'excel'],
		// 		"data" : input_table_data.data,
		// 		"columns" : input_table_data.columns,
		// 		"order": [[ 1, "desc" ]]
		// 	})

		// 	$('#table_container').show();
		// }
		/* Function to refresh the datatable with given data END */

		/* Call function to create the table at the start */
		// api_fetch_candidate_table_data("default");
		fetch_columns("default","");
		/* Call function to create the table at the start END*/

		$("#search_modal_submit").on('click', function (e) {
			//$("#search-modal").show();
	 /* Prevent submitting automatically*/
	 event.preventDefault();
	 event.stopPropagation();
console.log("form submit");
	 /* Serialize the form data to send */
	 let search_form_details = JSON.stringify($("#search_container_form").serializeArray());
	 
	 /* Save the data to send to the AJAX page into a variable */
	 //let form_data_to_send = new FormData($('#search_container_form')[0]);
	 /* Add the information confirming that this info came from the AJAX call. This will help in case JS does not work in the browser and the form is sent by HTML default. */
	 //form_data_to_send.append('ajax', 'true');
console.log(search_form_details)

				 $("#search_modal_submit").prop('disabled', true);
				 $(this).html('Searching...');
				 // $(".search_modal_submit").attr('disabled', 'true');
				 // $(this).html('Search');
				 fetch_columns("default",search_form_details);
			$("#search-modal").modal('hide');
			$("#search_modal_submit").prop('disabled', false);
 			$("#search_modal_submit").html('Search');
			console.log(search_form_details)
		 

// 	 $.ajax({
// 		 url : homepath+'api/fetch-candidate-table-data/',
// 		 method : "POST",
// //dataType : 'text',
// 		 data : {
// 			 "filter_form" : "true",
// 			 "search_form_details" : search_form_details,
// 			 "requested_columns_array_json" : "default"
// 		 },
	 
// 		 beforeSend: function(){
// 		 // 	$('#search-modal').attr('disabled', 'true');
// 		 // 	$('#search-modal').html('Creating...');
// 		 // 	$("#search_modal_error").hide()
// 		 },
// 		 complete: function(){
// 		 // 	$('#search-modal').removeAttr("disabled");
// 		 // 	$('#search-modal').html('Submit');
// 		 },
// 		 success : function(result){
				 
// console.log(result)
// 			 if(result.error.number_of_errors > 0){
// 				 $("#search_modal_error").html(result.error.error_message)
// 				 $("#search_modal_error").show()
// 			 }
// 			 else{
// 				 /* Hide the error box and empty the error */
// 				 $("#search_modal_error").hide()
// 				 $("#search_modal_error").html("")

// 				 /* Hide the modal */
// 			 $("#search-modal").modal('hide');
// 			 $("#search_modal_submit").prop('disabled', false);
// 								 $("#search_modal_submit").html('Search');
								
// 					 refresh_datatable(result)
// 		 // $("#search_modal_submit").prop('disabled', 'false');
// 				 //$("#search-modal").modal('show');
// 				 /* Refresh the datatable */
	 
// 					//api_fetch_candidate_table_data("default");
// 			 }
// 		 },
// 		 error : function(er, er2, er3){
				 
// 								$("#search_modal_submit").prop('disabled', false)
// 								$("#search_modal_submit").html('Search');
// console.log(er3)
// 			 $("#search_modal_error").html("Something went wrong, please refresh the page and try again.")
// 			 $("#search_modal_error").show()
// 		 }
// 	 })
	})

			/* Activate multiple profiles using multi_active_button */
			$(document).on("click", "#multi_active_button", function(){

				$("#multi_active_button").attr('disabled', 'true');
				$("#multi_active_button").html('Please Wait...');
				// $("#multi_unverify_button").attr('disabled', 'true');
				// $("#multi_unverify_button").html('Please Wait...');
				// $(".unverify_button").attr('disabled', 'true');
				// $(".unverify_button").html('Please Wait...');
				// $(".unlock_button").attr('disabled', 'true');
				// $(".unlock_button").html('Please Wait...');
				
	
				/* If no profile checkbox is selected */
				if($(".candidate_checkbox:checked").length == 0){
					event.preventDefault();
					alert("Please select a profile!");
						$("#multi_active_button").removeAttr("disabled");
						$("#multi_active_button").html('<i class="[ mr-2 ][ fas fa-unlock ]"></i> Active');
						// $("#multi_unverify_button").removeAttr("disabled");
						// $("#multi_unverify_button").html('<i class="[ mr-2 ][ fas fa-lock ]"></i> Draft');
						// $(".unverify_button").removeAttr("disabled");
						// $(".unverify_button").html('<i class="[ mr-2 ][ fas fa-ban ]"> Unverify');
						// $(".unverify_button").css("font-family", "inherit");
						// $(".unlock_button").removeAttr("disabled");
						// $(".unlock_button").html('<i class="[ mr-2 ][ fas fa-unlock ]"> Verify');
						// $(".unlock_button").css("font-family", "inherit");
					return false;
					
				}
	
				/* Array of IDs of profiles to be added to favourite, converted to JSON */
				let requested_profiles_to_active_json = JSON.stringify( $(".candidate_checkbox:checked").map(function(){
					return $(this).attr("id").replace("_checkbox", "");
				}).get());
	
				console.log("***********");
				console.log(requested_profiles_to_active_json);
	
				/* Ajax request to favourite the selected profiles */
				/**in homepath url add name of api processwire page */
				$.ajax({
					url : homepath+'api/admin-candidates-actions/',
					method : "POST",
	//  dataType : "text",
					data : {
						"requested_action_to_take" : "multiple_profile_active",
						"requested_profiles_to_active_json" : requested_profiles_to_active_json
					},
					beforeSend: function () {
						$("#multi_active_button").attr('disabled', 'true');
						$("#multi_active_button").html('Please Wait...');
						// $("#multi_unverify_button").attr('disabled', 'true');
						// $("#multi_unverify_button").html('Please Wait...');
					},
					complete: function () {
						$("#multi_active_button").removeAttr("disabled");
						$("#multi_active_button").html('<i class="[ mr-2 ][ fas fa-unlock ]"></i> Active');
						// $("#multi_unverify_button").removeAttr("disabled");
						// $("#multi_unverify_button").html('<i class="[ mr-2 ][ fas fa-lock ]"></i> Draft');
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
							// api_fetch_job_table_data();
							fetch_columns("default","");
						}
						
					},
					error : function(){
						alert("Something went wrong, please refresh the page and try again...")
					}
				})
			});
			/* End Activate multiple jobs using multi_active_button */
	
			/* Inactivate multiple profiles using multi_inactive_button */
			$(document).on("click", "#multi_inactive_button", function(){
	
				$("#multi_inactive_button").attr('disabled', 'true');
				$("#multi_inactive_button").html('Please Wait...');
				// $("#multi_unverify_button").attr('disabled', 'true');
				// $("#multi_unverify_button").html('Please Wait...');
				// $(".unverify_button").attr('disabled', 'true');
				// $(".unverify_button").html('Please Wait...');
				// $(".unlock_button").attr('disabled', 'true');
				// $(".unlock_button").html('Please Wait...');
				
	
				/* If no profile checkbox is selected */
				if($(".candidate_checkbox:checked").length == 0){
					event.preventDefault();
					alert("Please select a profile!");
						$("#multi_inactive_button").removeAttr("disabled");
						$("#multi_inactive_button").html('<i class="[ mr-2 ][ fas fa-lock ]"></i> Inactive');
						// $("#multi_unverify_button").removeAttr("disabled");
						// $("#multi_unverify_button").html('<i class="[ mr-2 ][ fas fa-lock ]"></i> Draft');
						// $(".unverify_button").removeAttr("disabled");
						// $(".unverify_button").html('<i class="[ mr-2 ][ fas fa-ban ]"> Unverify');
						// $(".unverify_button").css("font-family", "inherit");
						// $(".unlock_button").removeAttr("disabled");
						// $(".unlock_button").html('<i class="[ mr-2 ][ fas fa-unlock ]"> Verify');
						// $(".unlock_button").css("font-family", "inherit");
					return false;
					
				}
	
				/* Array of IDs of profiles to be added to favourite, converted to JSON */
				let requested_profiles_to_inactive_json = JSON.stringify( $(".candidate_checkbox:checked").map(function(){
					return $(this).attr("id").replace("_checkbox", "");
				}).get());
	
				console.log("***********");
				console.log(requested_profiles_to_inactive_json);
	
				/* Ajax request to favourite the selected profiles */
				/**in homepath url add name of api processwire page */
				$.ajax({
					url : homepath+'api/admin-candidates-actions/',
					method : "POST",
	//  dataType : "text",
					data : {
						"requested_action_to_take" : "multiple_profile_inactive",
						"requested_profiles_to_inactive_json" : requested_profiles_to_inactive_json
					},
					beforeSend: function () {
						$("#multi_inactive_button").attr('disabled', 'true');
						$("#multi_inactive_button").html('Please Wait...');
						// $("#multi_unverify_button").attr('disabled', 'true');
						// $("#multi_unverify_button").html('Please Wait...');
					},
					complete: function () {
						$("#multi_inactive_button").removeAttr("disabled");
						$("#multi_inactive_button").html('<i class="[ mr-2 ][ fas fa-lock ]"></i> Inactive');
						// $("#multi_unverify_button").removeAttr("disabled");
						// $("#multi_unverify_button").html('<i class="[ mr-2 ][ fas fa-lock ]"></i> Draft');
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
							// api_fetch_job_table_data();
							fetch_columns("default","");
						}
						
					},
					error : function(){
						alert("Something went wrong, please refresh the page and try again...")
					}
				})
			});
			/* End Inactivate multiple jobs using multi_inactive_button */
	
			/* LGBT+ confirmed multiple profiles using multi_lgbt_confirm_button */
			$(document).on("click", "#multi_lgbt_confirm_button", function(){
	
				$("#multi_lgbt_confirm_button").attr('disabled', 'true');
				$("#multi_lgbt_confirm_button").html('Please Wait...');
				// $("#multi_unverify_button").attr('disabled', 'true');
				// $("#multi_unverify_button").html('Please Wait...');
				// $(".unverify_button").attr('disabled', 'true');
				// $(".unverify_button").html('Please Wait...');
				// $(".unlock_button").attr('disabled', 'true');
				// $(".unlock_button").html('Please Wait...');
				
	
				/* If no profile checkbox is selected */
				if($(".candidate_checkbox:checked").length == 0){
					event.preventDefault();
					alert("Please select a profile!");
						$("#multi_lgbt_confirm_button").removeAttr("disabled");
						$("#multi_lgbt_confirm_button").html('<i class="[ mr-2 ][ fas fa-user-check ]"></i>LGBT+ Confirm');
						// $("#multi_unverify_button").removeAttr("disabled");
						// $("#multi_unverify_button").html('<i class="[ mr-2 ][ fas fa-lock ]"></i> Draft');
						// $(".unverify_button").removeAttr("disabled");
						// $(".unverify_button").html('<i class="[ mr-2 ][ fas fa-ban ]"> Unverify');
						// $(".unverify_button").css("font-family", "inherit");
						// $(".unlock_button").removeAttr("disabled");
						// $(".unlock_button").html('<i class="[ mr-2 ][ fas fa-unlock ]"> Verify');
						// $(".unlock_button").css("font-family", "inherit");
					return false;
					
				}
	
				/* Array of IDs of profiles to be added to favourite, converted to JSON */
				let requested_profiles_to_lgbt_verification_json = JSON.stringify( $(".candidate_checkbox:checked").map(function(){
					return $(this).attr("id").replace("_checkbox", "");
				}).get());
	
				console.log("***********");
				console.log(requested_profiles_to_lgbt_verification_json);
	
				/* Ajax request to favourite the selected profiles */
				/**in homepath url add name of api processwire page */
				$.ajax({
					url : homepath+'api/admin-candidates-actions/',
					method : "POST",
	//  dataType : "text",
					data : {
						"requested_action_to_take" : "multiple_profile_lgbt_confirm",
						"requested_profiles_to_lgbt_verification_json" : requested_profiles_to_lgbt_verification_json
					},
					beforeSend: function () {
						$("#multi_lgbt_confirm_button").attr('disabled', 'true');
						$("#multi_lgbt_confirm_button").html('Please Wait...');
						// $("#multi_unverify_button").attr('disabled', 'true');
						// $("#multi_unverify_button").html('Please Wait...');
					},
					complete: function () {
						$("#multi_lgbt_confirm_button").removeAttr("disabled");
						$("#multi_lgbt_confirm_button").html('<i class="[ mr-2 ][ fas fa-user-check ]"></i>LGBT+ Confirm');
						// $("#multi_unverify_button").removeAttr("disabled");
						// $("#multi_unverify_button").html('<i class="[ mr-2 ][ fas fa-lock ]"></i> Draft');
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
							// api_fetch_job_table_data();
							fetch_columns("default","");
						}
						
					},
					error : function(){
						alert("Something went wrong, please refresh the page and try again...")
					}
				})
			});
			/* End LGBT+ confirmed multiple jobs using multi_lgbt_confirm_button */
	
			/* LGBT+ rejected multiple profiles using multi_lgbt_reject_button */
			$(document).on("click", "#multi_lgbt_reject_button", function(){
	
				$("#multi_lgbt_reject_button").attr('disabled', 'true');
				$("#multi_lgbt_reject_button").html('Please Wait...');
				// $("#multi_unverify_button").attr('disabled', 'true');
				// $("#multi_unverify_button").html('Please Wait...');
				// $(".unverify_button").attr('disabled', 'true');
				// $(".unverify_button").html('Please Wait...');
				// $(".unlock_button").attr('disabled', 'true');
				// $(".unlock_button").html('Please Wait...');
				
	
				/* If no profile checkbox is selected */
				if($(".candidate_checkbox:checked").length == 0){
					event.preventDefault();
					alert("Please select a profile!");
						$("#multi_lgbt_reject_button").removeAttr("disabled");
						$("#multi_lgbt_reject_button").html('<i class="[ mr-2 ][ fas fa-window-close ]"></i> LGBT+ Reject');
						// $("#multi_unverify_button").removeAttr("disabled");
						// $("#multi_unverify_button").html('<i class="[ mr-2 ][ fas fa-lock ]"></i> Draft');
						// $(".unverify_button").removeAttr("disabled");
						// $(".unverify_button").html('<i class="[ mr-2 ][ fas fa-ban ]"> Unverify');
						// $(".unverify_button").css("font-family", "inherit");
						// $(".unlock_button").removeAttr("disabled");
						// $(".unlock_button").html('<i class="[ mr-2 ][ fas fa-unlock ]"> Verify');
						// $(".unlock_button").css("font-family", "inherit");
					return false;
					
				}
	
				/* Array of IDs of profiles to be added to favourite, converted to JSON */
				let requested_profiles_to_lgbt_verification_json = JSON.stringify( $(".candidate_checkbox:checked").map(function(){
					return $(this).attr("id").replace("_checkbox", "");
				}).get());
	
				console.log("***********");
				console.log(requested_profiles_to_lgbt_verification_json);
	
				/* Ajax request to favourite the selected profiles */
				/**in homepath url add name of api processwire page */
				$.ajax({
					url : homepath+'api/admin-candidates-actions/',
					method : "POST",
	//  dataType : "text",
					data : {
						"requested_action_to_take" : "multiple_profile_lgbt_reject",
						"requested_profiles_to_lgbt_verification_json" : requested_profiles_to_lgbt_verification_json
					},
					beforeSend: function () {
						$("#multi_lgbt_reject_button").attr('disabled', 'true');
						$("#multi_lgbt_reject_button").html('Please Wait...');
						// $("#multi_unverify_button").attr('disabled', 'true');
						// $("#multi_unverify_button").html('Please Wait...');
					},
					complete: function () {
						$("#multi_lgbt_reject_button").removeAttr("disabled");
						$("#multi_lgbt_reject_button").html('<i class="[ mr-2 ][ fas fa-window-close ]"></i> LGBT+ Reject');
						// $("#multi_unverify_button").removeAttr("disabled");
						// $("#multi_unverify_button").html('<i class="[ mr-2 ][ fas fa-lock ]"></i> Draft');
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
							// api_fetch_job_table_data();
							fetch_columns("default","");
						}
						
					},
					error : function(){
						alert("Something went wrong, please refresh the page and try again...")
					}
				})
			});
			/* End LGBT+ rejected multiple jobs using multi_lgbt_reject_button */

	$.fn.dataTableExt.sErrMode = 'console';
	});
