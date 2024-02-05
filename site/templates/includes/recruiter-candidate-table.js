$(document).ready(function() {
	// var candidate_filter;
	// var candidate_status_filter;
	// var candidate_filter_data;
	/* When Columns to be shown are changed */
	$(document).on("click", "#column_select_modal_submit", function(){
		let column_select_checkbox_array = $(".column_select_checkbox:checked").map(function(){
			return $(this).attr("id");
		}).get();

		// api_fetch_candidate_table_data(JSON.stringify(column_select_checkbox_array));
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
		/**This is used for multiple requested value */
		/* Array of IDs of profiles to be show, converted to JSON */
		// let requested_profiles_to_show_json = JSON.stringify( $(".candidate_checkbox:checked").map(function(){
		// 	// page_id:$(this).attr("id").replace("_checkbox", "")
		// 	// page_fields:[
		// 	// 	"httpUrl"
		// 	// ]
		// 	return $(this).attr("id").replace("_checkbox", "");
		// }).get());

		// console.log(requested_profiles_to_show_json);
		/**This is used for single requested value */
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
		//dataType : "text",
			data : {
				"requested_page_info_json" : requested_page_info_json
				//"page_fields" : "httpUrl"
			},
			success : function(result){
console.log(result);
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
		console.log(requested_profiles_to_favourite_json);

		/* Ajax request to favourite the selected profiles */
		$.ajax({
			url : homepath+'api/recruiter-manage-candidates/',
			method : "POST",
// dataType : "text",
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
					$("#select_all_checkbox").prop('checked','');
					// api_fetch_candidate_table_data("default");
					//fetch_columns("default","");
				}
			},
			error : function(){
				alert("Something went wrong, please refresh the page and try again!")
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
	function fetch_columns(column_select_checkbox_array,search_filter_data,candidate_filter_data){
		candidate_filter="false";
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

		console.log(filter_form);
		// console.log("candidate filter data");
		// console.log(candidate_filter_data);
		// // console.log(candidate_filter);
		// if (candidate_filter_data.length > 0) {
		// 	console.log("if");
		// 	candidate_status_filter=candidate_filter_data;
		// 	candidate_filter="true";
		// }
		// else{
		// 	candidate_status_filter="";
		// 	candidate_filter="false";
		// }
	// 	if(Array.isArray(candidate_filter_data) && candidate_filter_data.length > 0) {
	// 		console.log("if");
	// 		candidate_status_filter = candidate_filter_data;
	// 		candidate_filter = "true";
	// }
	// else{
	// 		candidate_status_filter="";
	// 		candidate_filter="false";
	// 	}
		if(candidate_filter_data != ""){
			// console.log("if");
			candidate_status_filter=candidate_filter_data;
			candidate_filter="true";
		}
		else{
			candidate_status_filter="";
			candidate_filter="false";
		}
		console.log("candidate filter data");
		console.log(candidate_status_filter);
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
						console.log("else");
						refresh_datatable("default",search_filter,filter_form,candidate_status_filter,candidate_filter,url_parameters);
					}
				},
				error : function(){
					$("#table_container_card_body").append('<div class="alert alert-danger " role="alert"><strong>Something went wrong, please refresh the page and try again.</strong></div>');
				}
			});
		}

	function refresh_datatable(columns_array_fetch,search_filter,filter_form,candidate_status_filter,candidate_filter,url_parameters){
				console.log("222");
				console.log(candidate_status_filter);
				console.log("333");
				console.log(candidate_filter);
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
			
	}


// 			function api_fetch_candidate_table_data(requested_columns_array_json){
// 			     var url_string = window.location.href;
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
	// 		"data" : input_table_data.data,
	// 		"columns" : input_table_data.columns,
	// 		"order": [[ 1, "desc" ]]
	// 	})

	// 	$('#table_container').show();
	// }
	/* Function to refresh the datatable with given data END */

	
	/**Search Candidate status filter */
	$("#btn_applicant_candidate_filter").on('click', function (e) {
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
		
			$("#btn_applicant_candidate_filter").prop('disabled', true);
			$(this).html('Filtering...');
			fetch_columns("default","",candidate_filter_form_details);
			// $("#search-modal").modal('hide');
			$("#btn_applicant_candidate_filter").prop('disabled', false);
			$("#btn_applicant_candidate_filter").html('Apply Filters');
			console.log(candidate_filter_form_details)
				
	})

	/**Search Candidate Status filter END */
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
			fetch_columns("default",search_form_details,"");
		$("#search-modal").modal('hide');
		$("#search_modal_submit").prop('disabled', false);
		 $("#search_modal_submit").html('Search');
		console.log(search_form_details)
			

// 			$.ajax({
// 				url : homepath+'api/fetch-candidate-table-data/',
// 				method : "POST",
// //dataType : 'text',
// 				data : {
// 					"filter_form" : "true",
// 					"search_form_details" : search_form_details,
// 					"requested_columns_array_json" : "default"
// 				},
		
// 				beforeSend: function(){
// 				// 	$('#search-modal').attr('disabled', 'true');
// 				// 	$('#search-modal').html('Creating...');
// 				// 	$("#search_modal_error").hide()
// 				},
// 				complete: function(){
// 				// 	$('#search-modal').removeAttr("disabled");
// 				// 	$('#search-modal').html('Submit');
// 				},
// 				success : function(result){
					
// console.log(result)
// 					if(result.error.number_of_errors > 0){
// 						$("#search_modal_error").html(result.error.error_message)
// 						$("#search_modal_error").show()
// 					}
// 					else{
// 						/* Hide the error box and empty the error */
// 						$("#search_modal_error").hide()
// 						$("#search_modal_error").html("")

// 						/* Hide the modal */
// 					$("#search-modal").modal('hide');
// 					$("#search_modal_submit").prop('disabled', false);
//                     $("#search_modal_submit").html('Search');
								 
// 							refresh_datatable(result)
// 				// $("#search_modal_submit").prop('disabled', 'false');
// 						//$("#search-modal").modal('show');
// 						/* Refresh the datatable */
		
// 					   //api_fetch_candidate_table_data("default");
// 					}
// 				},
// 				error : function(er, er2, er3){
					
//                    $("#search_modal_submit").prop('disabled', false)
//                    $("#search_modal_submit").html('Search');
// console.log(er3)
// 					$("#search_modal_error").html("Something went wrong, please refresh the page and try again.")
// 					$("#search_modal_error").show()
// 				}
// 			})
	 })
	 $.fn.dataTableExt.sErrMode = 'console';
});
