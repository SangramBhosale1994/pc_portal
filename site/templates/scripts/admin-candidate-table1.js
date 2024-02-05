$(document).ready(function() {
	var datatable_columns;
	var column_select_checkbox_array;
	var columns_array;
	var search_filter;
	var filter_form;
	console.log(homepath);
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
									refresh_datatable("default",search_filter,filter_form);
								}
							},
							error : function(){
								$("#table_container_card_body").append('<div class="alert alert-danger " role="alert"><strong>Something went wrong, please refresh the page and try again.</strong></div>');
							}
						});
					}
	
						 function refresh_datatable(columns_array_fetch,search_filter,filter_form){
						//	function refresh_datatable(search_filter_data){
							//fetch_columns();
							console.log("222");
							if($.fn.DataTable.isDataTable( '#dataTable')){
								$('#dataTable').DataTable().destroy()
							}
				
							$('#dataTable').empty()
	
							// var columns_array;
							// var search_filter;
							// var filter_form;
							// console.log(column_select_checkbox_array);
							// if(column_select_checkbox_array!=""){
							// 	columns_array=column_select_checkbox_array;
	
							// }
							// else{
							// 	columns_array="default";
							// }
							// console.log(search_filter_data);
							// if(search_filter_data!=""){
							// 	search_filter=search_filter_data;
							// 	filter_form="true";
							// }
							// else{
							// 	search_filter="";
							// 	filter_form="false";
							// }
							// filter_form="false";
							// if(filter_form!=""){
							// 	filter_form="true"
							// }
	
							$('#dataTable').DataTable({
										 //dom: 'tlip',
										dom: 'Blfrtip',
										buttons: ['copy', 'excel'],
								//  "data" : input_table_data.data,
								
								// "order": [[ 1, "desc" ]],
								//"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
								"processing": true,
								"searching": true,
								
								
												
							//             "ajax": homepath + "api/fetch-candidate-table-data/",
													ajax: {
														url: homepath + "api/fetch-candidate-table-data/",
														type: 'POST',
														data:{
															"filter_form" : filter_form,
				 											"search_form_details" : search_filter,
															"requested_columns_array_json" : columns_array_fetch
															// "filter_form" : filter_form,
				 											// "search_form_details" : search_filter
														},
													// 	"success": function (settings) { 
													// 		// Here the response
													// 		//var response = settings.json;
													// 		//datatable_columns=settings;
													// 		//datatable_data=settings.data;
													// 		console.log(settings.data);
													// 		console.log("8888888888888");
													// 		console.log(settings.columns);
													// 		//$('#table_container').html(settings.data);
	
															
	
													// },
												},
												"columns":datatable_columns,
											// 	"columns":[
											// 		{ "data": "selectbox" },
											// 		{ "data": "serial_number" },
											// 		{ "data": "view_profile_button" }
											// ],
												//"data":datatable_data,
							//             "deferLoading": 57
												//"paging":true,
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
			$(document).on("change",".select_all_checkbox", function(){
				$(".candidate_checkbox").prop('checked', $(this).prop("checked"));
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
			else if($(".candidate_checkbox:checked").length > 10){
				event.preventDefault();
				$("#delete_selected_list_container").html("Only 10 profiles can be deleted at a time.");

				/* Keep the delete button in the modal disabled */
				$("#delete_selected_modal_submit").attr("disabled", true);

				return false;
			}

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
		 $.fn.dataTableExt.sErrMode = 'console';
		});