	let all_recruiters_data;
	 let profile_to_edit = {};

	$(document).ready(function() {
		/* When checkbox is clicked */
		$(document).on("change", ".recruiter_checkbox", function () {
			/* Change background colour of the row */
			let row_selection_bg_colour = "#fff";

			if($(this).prop("checked")){
				row_selection_bg_colour = "#f9f9f9";
			}

			$(this).parents("tr").css("background-color", row_selection_bg_colour);
			/* Change background colour of the row End */
		}); 
		/* When checkbox is clicked End */

		// $("#create_new_modal_submit").click(function(){
		// 	console.log("***********");
		// 	var recruiter_type=$("#create_new_recruiter_type").val();
		// 	console.log(recruiter_type);
			
		// 	if(recruiter_type == ""){
		// 		alert("Please enter recruiter type.");
		// 	}
		// });

		/* When Create New form is submitted */
		$(document).on("submit", "#create_new_modal_form", function(event){
			/* Prevent submitting automatically*/
			event.preventDefault();
			event.stopPropagation();
			console.log("***********");

		
			// var recruiter_type=$("#create_new_recruiter_type").val();
			// console.log(recruiter_type.lenght);
			// if(recruiter_type == ""){
			// 	alert("Please enter recruiter type.");
			// }

			/* Serialize the form data to send */
			let new_recruiter_form_details = JSON.stringify($("#create_new_modal_form").serializeArray());
console.log(new_recruiter_form_details)
			$.ajax({
				url : homepath+'api/admin-manage-recruiters/',
				method : "POST",
//dataType : 'text',
				data : {
					"requested_action_to_take" : "create_recruiter",
					"new_recruiter_form_details" : new_recruiter_form_details
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
						api_fetch_recruiter_table_data();
					}
				},
				error : function(er, er2, er3){
//console.log(er3)
					$("#create_new_modal_error").html("Something went wrong, please refresh the page and try again!")
					$("#create_new_modal_error").show()
				}
			});
		});
		/* When Create New form is submitted END */

		/* When create new modal has been closed */
		$("#create_new_modal").on("hide.bs.modal", function(){
			document.getElementById("create_new_modal_form").reset();
		})
		/* When create new modal has been closed END */

		/* When edit profile button is clicked */
		$(document).on("click", ".profile_edit_button", function(){
		     profile_to_edit = {};
			profile_to_edit.id = $(this).attr("id").replace("_edit_button", "");
			console.log(profile_to_edit.id);

		//	profile_to_edit = all_recruiters_data.data.find(x=>x.id == profile_to_edit.id);
			
			for (i = 0; i < all_recruiters_data.data.length; i++) {
			    if(all_recruiters_data.data[i].id == profile_to_edit.id){
			        profile_to_edit=all_recruiters_data.data[i];
			    }
			}

				/* in iterate function pass name and index. and display checked value in category input field */
				function iterate(item, index) {
					console.log(`${item} has index ${index}`);
					$('#edit_profile_modal_form input[value="' + item + '"]').prop('checked', true);
					console.log($('#edit_profile_modal_form input[value="' + item + '"]').prop('checked', true));

				}
			$("#edit_profile_recruiter_name").val(profile_to_edit.name);
			$("#edit_profile_recruiter_email").val(profile_to_edit.email);
			$("#edit_profile_recruiter_subscription_from").val(profile_to_edit.subscription_from);
			$("#edit_profile_recruiter_subscription_to").val(profile_to_edit.subscription_to);
			$("#edit_profile_recruiter_total_unlock_quota").val(profile_to_edit.remaining_total_unlock_quota);
			$("#edit_profile_recruiter_unlock_quota").val(profile_to_edit.unlock_quota);
			$("#edit_profile_recruiter_applicants_unlock_quota").val(profile_to_edit.applicants_unlock_quota);
			$("#edit_profile_recruiter_job_limit").val(profile_to_edit.job_limit);
			$("#edit_profile_recruiter_company_name").val(profile_to_edit.company_name);
			$("#edit_profile_recruiter_type").val(profile_to_edit.recruiter_type);
			$("#edit_profile_recruiter_sub_recruiter_quota").val(profile_to_edit.sub_recruiter_quota);
			$('#edit_profile_recruiter_type').tagator('refresh');

			/*display checkbox checked category */
				/*get category id aaray and assign to cat constant variable */
		
					//const cat=[];
					const cat=profile_to_edit.accessible_sections_id_array;
					console.log(cat);
					console.log("*********");
						/*Check if category length is not zero then get edit category input feild attach category array with check property html input field  */
						if(cat.length!=0){
								const cat=profile_to_edit.accessible_sections_id_array;
								console.log(cat);
								console.log("+++++++++++");
								$('#edit_profile_modal_form input[name="accessible_sections[]"]').prop('checked', false);
								/*call iterate function with forEach loop through the category  */
								cat.forEach(iterate);
								
								console.log(profile_to_edit.accessible_sections_array);
								//$("#edit_profile_offer_category").val(cat.forEach(iterate));
								console.log(cat);
						}
						else{
								$('#edit_profile_modal_form input[name="accessible_sections[]"]').prop('checked', false);
								const cat=[];
						}
				
		    /*End display checkbox checked category */

			$("#edit_profile_modal").modal('show');
			//profile_to_edit=null;
		})
		/* When edit profile button is clicked End */

		/* When Edit profile Form is submitted */
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
				url : homepath+'api/admin-manage-recruiters/',
				method : "POST",
// dataType : 'text',
				data : {
					"requested_action_to_take" : "modify_recruiter",
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
						api_fetch_recruiter_table_data();
					}
				},
				error : function(er, er2, er3){
console.log(er3)
					$("#edit_profile_modal_error").html("Something went wrong, please refresh the page and try again.")
					$("#edit_profile_modal_error").show()
				}
			})
		})
		/* When Edit profile Form is submitted END */

		/* When Delete selected button is clicked */
		$(document).on("click", "#delete_selected_modal_trigger_button", function(event){
			/* If no profile checkbox is selected */
			if($(".recruiter_checkbox:checked").length == 0){
				event.preventDefault();
				$("#delete_selected_list_container").html("Please select an entry to delete!");

				/* Keep the delete button in the modal disabled */
				$("#delete_selected_modal_submit").attr("disabled", true);

				return false;
			}
			/* If more than 10 have been selected */
			// else if($(".recruiter_checkbox:checked").length > 10){
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
			$(".recruiter_checkbox:checked").map(function(){
				$("#delete_selected_list_container").append("<h5>"+all_recruiters_data.data.find(x=>x.id == $(this).attr("id").replace("_checkbox", "")).name+"</h5>");
			});

		});
		/* When Delete selected button is clicked End */

		/* When Delete is confirmed */
		$(document).on("click", "#delete_selected_modal_submit", function(){
			/* Array of IDs of profiles to be deleted, converted to JSON */
			let requested_profiles_to_delete_json = JSON.stringify( $(".recruiter_checkbox:checked").map(function(){
				return $(this).attr("id").replace("_checkbox", "");
			}).get());

			/* Ajax request to delete the selected profile */
			$.ajax({
				url : homepath+'api/admin-manage-recruiters/',
				method : "POST",
//dataType : 'text',
				data : {
					"requested_action_to_take" : "delete_recruiters",
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
						api_fetch_recruiter_table_data();
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
		function api_fetch_recruiter_table_data(){
			$.ajax({
				url : homepath+'api/admin-manage-recruiters/',
				method : "POST",
// dataType : 'text',
				data : {
					"requested_action_to_take" : "fetch_recruiter_table_data"
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
						all_recruiters_data = result;
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

			// new $.fn.dataTable.FixedHeader($('#dataTable'));

			$('#dataTable').DataTable({
				
			    dom: 'Blfrtip',
                buttons: ['copy', 'excel'],
				"data" : input_table_data.data,
				"columns" : input_table_data.columns,
				order: [[ 1, 'desc' ]],
			})

			$('#table_container').show();
		}
	// 	function refresh_datatable(input_table_data){
	// 		if($.fn.DataTable.isDataTable( '#dataTable')){
	// 			$('#dataTable').DataTable().destroy()
	// 		}
		
	// 		$('#dataTable').empty()
		
	// 		if ($('#dataTable').DataTable()) {
	// 			new $.fn.dataTable.FixedHeader( '#dataTable' );
	// 		}
			
			
	// 		var table = $('#dataTable').DataTable({
	// 			dom: 'Blfrtip',
	// 			buttons: ['copy', 'excel'],
	// 			"data" : input_table_data.data,
	// 			"columns" : input_table_data.columns,
	// 			footerCallback: function (row, data, start, end, display) {
	// 				var api = this.api();
	// 				api.columns('.sum').every(function () {
	// 					var sum = api
	// 						.column(this.index(), { search: 'applied' })
	// 						.data()
	// 						.reduce(function (a, b) {
	// 							return Number(a) + Number(b.replace(/[^0-9.-]+/g, ""));
	// 						}, 0);
	// 					$(api.column(this.index()).footer()).html('$' + sum.toFixed(2));
	// 				});
	// 			},
	// 			order: [[ 1, 'desc' ]],
	// 			initComplete: function () {
	// 				this.api().columns().every(function () {
	// 						var column = this;
	// 						var select = $('<select><option value=""></option></select>')
	// 								.appendTo($(column.footer()).empty())
	// 								.on('change', function () {
	// 										var val = $.fn.dataTable.util.escapeRegex(
	// 												$(this).val()
	// 										);
	// 										column
	// 												.search(val ? '^' + val + '$' : '', true, false)
	// 												.draw();
	// 								});
	// 						column.data().unique().sort().each(function (d, j) {
	// 								select.append('<option value="' + d + '">' + d + '</option>')
	// 						});
	// 				});
	// 				new $.fn.dataTable.FixedHeader($('#dataTable'));
	// 				new $.fn.dataTable.Select($('#dataTable'));
	// 			}
	// 		});
			
	// 		new $.fn.dataTable.FixedHeader( table );
		
	// 		$('#table_container').show();
	// 	}
	// 	function refresh_datatable(input_table_data){
	// 		if($.fn.DataTable.isDataTable( '#dataTable')){
	// 				$('#dataTable').DataTable().destroy()
	// 		}
			
	// 		$('#dataTable').empty()
	// 			if ($('#dataTable').DataTable()) {
	// 			new $.fn.dataTable.FixedHeader( '#dataTable' );
	// 		}
			

	// 		var table = $('#dataTable').DataTable({
	// 				dom: 'Blfrtip',
	// 				buttons: ['copy', 'excel'],
	// 				"data" : input_table_data.data,
	// 				"columns" : input_table_data.columns,
	// 				// footerCallback: function (row, data, start, end, display) {
	// 				// 		var api = this.api();
	// 				// 		api.columns('.sum').every(function () {
	// 				// 				var sum = api
	// 				// 						.column(this.index(), { search: 'applied' })
	// 				// 						.data()
	// 				// 						.reduce(function (a, b) {
	// 				// 								return Number(a) + Number(b.replace(/[^0-9.-]+/g, ""));
	// 				// 						}, 0);
	// 				// 				$(api.column(this.index()).footer()).html('$' + sum.toFixed(2));
	// 				// 		});
	// 				// },
	// 				order: [[ 1, 'desc' ]],
	// 				initComplete: function () {
	// 						this.api().columns().every(function () {
	// 										var column = this;
	// 										var select = $('<select><option value=""></option></select>')
	// 														.appendTo($(column.footer()).empty())
	// 														.on('change', function () {
	// 																		var val = $.fn.dataTable.util.escapeRegex(
	// 																						$(this).val()
	// 																		);
	// 																		column
	// 																						.search(val ? '^' + val + '$' : '', true, false)
	// 																						.draw();
	// 														});
	// 										column.data().unique().sort().each(function (d, j) {
	// 														select.append('<option value="' + d + '">' + d + '</option>')
	// 										});
	// 						});
	// 						new $.fn.dataTable.FixedHeader($('#dataTable'));
	// 						new $.fn.dataTable.Select($('#dataTable'));
						
	// 				}
					
	// 		});
	// 		new $.fn.dataTable.FixedHeader(table.table().header());
	// 		new $.fn.dataTable.Select(table);
	// 		$('#table_container').show();
	// }
	
		
		/* Function to refresh the datatable with given data END */

		/* Call function to create the table at the start */
		api_fetch_recruiter_table_data();
		/* Call function to create the table at the start END*/
	});