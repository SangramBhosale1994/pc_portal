$(document).ready(function() {
	var datatable_columns;
	var column_select_checkbox_array;
	var columns_array;
	var search_filter;
	var filter_form;
	var candidate_filter;
	var candidate_status_filter;
	console.log(homepath);
				function fetch_columns(column_select_checkbox_array,search_filter_data,candidate_filter_data){
					
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

					if(candidate_filter_data!=""){
						candidate_status_filter=candidate_filter_data;
						candidate_filter="true";
					}
					else{
						candidate_status_filter="";
						candidate_filter="false";
					}

					console.log(candidate_filter_data);
			console.log(candidate_filter);
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
									refresh_datatable("default",search_filter,filter_form,candidate_status_filter,candidate_filter,url_parameters);
								}
							},
							error : function(){
								$("#table_container_card_body").append('<div class="alert alert-danger " role="alert"><strong>Something went wrong, please refresh the page and try again.</strong></div>');
							}
						});
					}
	
						 function refresh_datatable(columns_array_fetch,search_filter,filter_form,candidate_status_filter,candidate_filter,url_parameters){
						//	function refresh_datatable(search_filter_data){
							//fetch_columns();
							console.log("222");
							
							if($.fn.DataTable.isDataTable( '#dataTable')){
									// $('#dataTable').DataTable().draw()
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
								// select: {
								// 	style: 'multi'
								// },
										 //dom: 'tlip',
										dom: 'Blfrtip',
										buttons: ['copy', 'excel'],
								//  "data" : input_table_data.data,
								
								// "order": [[ 1, "desc" ]],
								//"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
								processing: true,
								"searching": true,
								// serverSide: true,
								
							//             "ajax": homepath + "api/fetch-candidate-table-data/",
							
													ajax: {
														url: homepath + "api/fetch-candidate-table-data/?"+url_parameters,
														type: 'POST',
														data:{
															"filter_form" : filter_form,
				 											"search_form_details" : search_filter,
															"candidate_filter" : candidate_filter,
															"candidate_filter_form_details" : candidate_status_filter,
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
	// 	$("#searchInput").on("input", function (e) {
	// 		e.preventDefault();
	// 		$('#dataTable').DataTable().search($(this).val()).draw();
	//  });
	}
	
			/* When Columns to be shown are changed */
			$(document).on("click", "#column_select_modal_submit", function(){
				console.log("333");
				 column_select_checkbox_array = $(".column_select_checkbox:checked").map(function(){
					return $(this).attr("id");
				}).get();
				//fetch_columns();
				console.log(column_select_checkbox_array);
				console.log("************");
				// refresh_datatable(JSON.stringify(column_select_checkbox_array),"");
				console.log(column_select_checkbox_array);
				// datatable_columns=column_select_checkbox_array;
				// console.log("------------");
				// console.log(datatable_columns);
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
			// $('[data-toggle="tooltip"]').tooltip(); 
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
			fetch_columns("default","");
			console.log("111");
			// refresh_datatable("default");

			/**when search form load */
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
		 
			$("#search_modal_submit").prop('disabled', true);
					 $(this).html('Searching...');
					 

			fetch_columns("default",search_form_details);
			$("#search-modal").modal('hide');
			$("#search_modal_submit").prop('disabled', false);
 			$("#search_modal_submit").html('Search');
			console.log(search_form_details)
			//fetch_columns();


// 		 $.ajax({
// 			 url : homepath+'api/fetch-candidate-table-data/',
// 			 method : "POST",
// //dataType : 'text',
// 			 data : {
// 				 "filter_form" : "true",
// 				 "search_form_details" : search_form_details,
// 				 "requested_columns_array_json" : "default"
// 			 },
		 
// 			 beforeSend: function(){
// 			 // 	$('#search-modal').attr('disabled', 'true');
// 			 // 	$('#search-modal').html('Creating...');
// 			 // 	$("#search_modal_error").hide()
// 			 },
// 			 complete: function(){
// 			 // 	$('#search-modal').removeAttr("disabled");
// 			 // 	$('#search-modal').html('Submit');
// 			 },
// 			 success : function(result){
// console.log(result)
// 				 if(result.error.number_of_errors > 0){
// 					 $("#search_modal_error").html(result.error.error_message)
// 					 $("#search_modal_error").show()
// 				 }
// 				 else{
// 					 /* Hide the error box and empty the error */
// 					 $("#search_modal_error").hide()
// 					 $("#search_modal_error").html("")

// 					 /* Hide the modal */
// 				 $("#search-modal").modal('hide');
// 				 $("#search_modal_submit").prop('disabled', false);
// 									 $("#search_modal_submit").html('Search');
					 
// 						 refresh_datatable(result)
// 					 //$("#search-modal").modal('show');
// 					 /* Refresh the datatable */
		 
// 						//api_fetch_candidate_table_data("default");
// 				 }
// 			 },
// 			 error : function(er, er2, er3){
// 						$("#search_modal_submit").prop('disabled', false);
// 										$("#search_modal_submit").html('Search');
// console.log(er3)
// 				 $("#search_modal_error").html("Something went wrong, please refresh the page and try again.")
// 				 $("#search_modal_error").show()
// 			 }
// 		 })
		})
		/** Search Candidate status */
		$("#btn_candidate_filter").on('click', function (e) {
					//$("#search-modal").show();
			/* Prevent submitting automatically*/
			event.preventDefault();
			event.stopPropagation();
			console.log("Candidate filter");
			/* Serialize the form data to send */
			let candidate_filter_form_details = JSON.stringify($("#candidate_filter_form").serializeArray());
			
			/* Save the data to send to the AJAX page into a variable */
			//let form_data_to_send = new FormData($('#search_container_form')[0]);
			/* Add the information confirming that this info came from the AJAX call. This will help in case JS does not work in the browser and the form is sent by HTML default. */
			//form_data_to_send.append('ajax', 'true');
			
				$("#btn_candidate_filter").prop('disabled', true);
				$(this).html('Filtering...');
				fetch_columns("default",candidate_filter_form_details);
				// $("#search-modal").modal('hide');
				$("#btn_candidate_filter").prop('disabled', false);
				$("#btn_candidate_filter").html('Apply Filters');
				console.log(candidate_filter_form_details)
				
		})

		/** End Search candidate status */
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
				// let delete_candidate_checkbox_array = $(".candidate_checkbox:checked").map(function(){
				// 	return $(this).attr("id").replace("_checkbox", "");
				// }).get();
	
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
						fetch_columns("default","");
	
						/* If errors are sent from the back-end */
						if(result.error.number_of_errors > 0){
							alert(result.error.error_message);
						}
						else{
							alert(result.success.success_message);
						}
					},
					error : function(){
						alert("Something went wrong, please refresh the page and try again. Local error")
					}
				})
			});
			/* When Delete is confirmed End */

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

		/**send new jobs mail to candidate */
		$(document).on("click", "#send_jobs_candidate_button", function(){
			/* If no profile checkbox is selected */
			if($(".candidate_checkbox:checked").length == 0){
				event.preventDefault();
				alert("Please select a profile!");
				$("#send_jobs_candidate_button").removeAttr("disabled");
				$("#send_jobs_candidate_button").html('Send Jobs');
				return false;
				
			}
			else{
				/* Array of IDs of profiles to be added to favourite, converted to JSON */
				let candidate_checkbox_json = JSON.stringify( $(".candidate_checkbox:checked").map(function(){
					return $(this).attr("id").replace("_checkbox", "");
				}).get());
	
				console.log("***********");
				console.log(candidate_checkbox_json);
	
				/* Ajax request to favourite the selected profiles */
				/**in homepath url add name of api processwire page */
				$.ajax({
					url : homepath+'api/admin-send-jobs-candidates/',
					method : "POST",
	//  dataType : "text",
					data : {
						"requested_action_to_take" : "save_to_session",
						"candidate_checkbox_json" : candidate_checkbox_json
					},
					beforeSend: function () {
						$("#send_jobs_candidate_button").attr('disabled', 'true');
						$("#send_jobs_candidate_button").html('Please Wait...');
						// $("#multi_unverify_button").attr('disabled', 'true');
						// $("#multi_unverify_button").html('Please Wait...');
					},
					complete: function () {
						$("#send_jobs_candidate_button").removeAttr("disabled");
						$("#send_jobs_candidate_button").html('Send Jobs');
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
							window.location.href =homepath+"send-jobs-mail-candidates/";
						}
						
					},
					error : function(){
						alert("Something went wrong, please refresh the page and try again...")
					}
				
				})
			}

		});
	


		 $.fn.dataTableExt.sErrMode = 'console';
		});