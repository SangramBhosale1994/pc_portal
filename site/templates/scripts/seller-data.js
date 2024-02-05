let all_editors_data;
let profile_to_edit = {};
let unverify_comment = {};


$(document).ready(function () {
    /* When Create New form is submitted */
    $(document).on("submit", "#create_new_modal_form", function (event) {
        /* Prevent submitting automatically*/
        event.preventDefault();
        event.stopPropagation();

        /* Serialize the form data to send */
        let new_editor_form_details = JSON.stringify($("#create_new_modal_form").serializeArray());

        $.ajax({
            url: homepath + 'api/admin-manage-editors/',
            method: "POST",
            //dataType : 'text',
            data: {
                "requested_action_to_take": "create_editor",
                "new_editor_form_details": new_editor_form_details
            },
            beforeSend: function () {
                $('#create_new_modal_submit').attr('disabled', 'true');
                $('#create_new_modal_submit').html('Creating...');
                $("#create_new_modal_error").hide()
            },
            complete: function () {
                $('#create_new_modal_submit').removeAttr("disabled");
                $('#create_new_modal_submit').html('Submit');
            },
            success: function (result) {
                //console.log(result)
                if (result.error.number_of_errors > 0) {
                    $("#create_new_modal_error").html(result.error.error_message)
                    $("#create_new_modal_error").show()
                }
                else {
                    /* Hide the error box and empty the error */
                    $("#create_new_modal_error").hide()
                    $("#create_new_modal_error").html("")

                    /* Hide the modal */
                    $("#create_new_modal").modal('hide');
                    /* Refresh the datatable */
                    api_fetch_editor_table_data();
                }
            },
            error: function (er, er2, er3) {
                //console.log(er3)
                $("#create_new_modal_error").html("Something went wrong, please refresh the page and try again.")
                $("#create_new_modal_error").show()
            }
        })
    })
    /* When Create New form is submitted END */

    /* When create new modal has been closed */
    $("#create_new_modal").on("hide.bs.modal", function () {
        document.getElementById("create_new_modal_form").reset();
    })
    /* When create new modal has been closed END */

    /* When edit profile button is clicked */
    $(document).on("click", ".unverify_comment_modal1", function () {
        unverify_comment.id = $(this).attr("id").replace("_unverify_comment_modal", "");
        console.log(unverify_comment.id);

        unverify_comment = all_editors_data.data.find(x => x.id == unverify_comment.id)
        
        console.log(unverify_comment);

        $("#rejection_reason").val(unverify_comment.rejection_reason);
        // let rejection=$("#rejection_reason").val(unverify_comment.rejection_reason);
        
        //  console.log(rejection);
        $("#seller_unverify_comment_modal").modal('show')
    })
    /* When edit profile button is clicked End */

    /* When Edit profile Form is submitted */
    $(document).on("submit", "#unverify_modal_form1", function (event) {
        /* Prevent submitting automatically*/
        event.preventDefault();
        event.stopPropagation();

        /* Serialize the form data to send */
        let unverify_modal_form_details = $("#unverify_modal_form").serializeArray();

        /* Add the page ID to be changed */
        unverify_modal_form_details.push({
            "name": "id",
            "value": unverify_comment.id
        })

        unverify_modal_form_details = JSON.stringify(unverify_modal_form_details);

        $.ajax({
            url: homepath + 'api/seller-data/',
            method: "POST",
            //dataType : 'text',
            data: {
               "requested_action_to_take": "unverify_profiles",
                "requested_referral_profile_to_unverify_profiles": unverify_modal_form_details
            },
            beforeSend: function () {
                $("#edit_profile_modal_submit").attr('disabled', 'true');
                $("#edit_profile_modal_submit").html('Saving...');
                $("#edit_profile_modal_error").hide()
            },
            complete: function () {
                $("#edit_profile_modal_submit").removeAttr("disabled");
                $("#edit_profile_modal_submit").html('Submit');
            },
            success: function (result) {
                //console.log(result)
                if (result.error.number_of_errors > 0) {
                    $("#edit_profile_modal_error").html(result.error.error_message)
                    $("#edit_profile_modal_error").show()
                }
                else {
                    /* Hide the error box and empty the error */
                    $("#edit_profile_modal_error").hide()
                    $("#edit_profile_modal_error").html("")

                    /* Hide the modal */
                    $("#edit_profile_modal").modal('hide');

                    /* Show the success message */
                    alert(result.success.success_message);

                    /* Refresh the datatable */
                    api_fetch_editor_unlock_request_table_data();
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

    /* When Delete selected button is clicked */
    // $(document).on("click", "#delete_selected_modal_trigger_button", function (event) {
    //     /* If no profile checkbox is selected */
    //     if ($(".editor_checkbox:checked").length == 0) {
    //         event.preventDefault();
    //         $("#delete_selected_list_container").html("Please select an entry to delete!");

    //         /* Keep the delete button in the modal disabled */
    //         $("#delete_selected_modal_submit").attr("disabled", true);

    //         return false;
    //     }
    //     /* If more than 10 have been selected */
    //     else if ($(".editor_checkbox:checked").length > 10) {
    //         event.preventDefault();
    //         $("#delete_selected_list_container").html("Only 10 profiles can be deleted at a time.");

    //         /* Keep the delete button in the modal disabled */
    //         $("#delete_selected_modal_submit").attr("disabled", true);

    //         return false;
    //     }

    //     /* Enable the delete button in the modal */
    //     $("#delete_selected_modal_submit").attr("disabled", false);

    //     /* Empty the "to delete" area in the modal */
    //     $("#delete_selected_list_container").html("");

    //     /* Add the list of IDs to be deleted to the "to delete" section in the modal */
    //     $(".editor_checkbox:checked").map(function () {
    //         $("#delete_selected_list_container").append("<h5>" + all_editors_data.data.find(x => x.id == $(this).attr("id").replace("_checkbox", "")).name + "</h5>");
    //     });

    // });
    /* When Delete selected button is clicked End */

    /* When Delete is confirmed */
    $(document).on("click", ".unlock_button", function () {
        /* Array of IDs of profiles to be deleted, converted to JSON */
        let requested_seller_profiles_to_unlock = $(this).attr("id").replace("_unlock_button", "");

        $(".unlock_button").attr('disabled', 'true');
        $(this).html('Verify...');
        $(".unverify_button").attr('disabled', 'true');
        
        
        /* Ajax request to delete the selected profile */
        $.ajax({
            url: homepath + 'api/seller-data/',
            method: "POST",
            // dataType: 'text',
            data: {
                "requested_action_to_take": "unlock_profiles",
                "requested_seller_profiles_to_unlock": requested_seller_profiles_to_unlock
            },
            beforeSend: function () {
                $(this).attr('disabled', 'true');
                $(this).html('Verify...');
              
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
                    api_fetch_editor_unlock_request_table_data();
                }
            },
            error: function (er, er2, er3) {
                console.log(er3)
                alert("Something went wrong, please refresh the page and try again.")
            }
        })
    });
    /* When Delete is confirmed End */

 
    /* When Delete is confirmed */
    $(document).on("click", ".unverify_button", function () {
        /* Array of IDs of profiles to be deleted, converted to JSON */
        let requested_referral_profile_to_unverify_profiles = $(this).attr("id").replace("_unverify_button", "");
        let rejection_reason = $('#rejection_reason_'+requested_referral_profile_to_unverify_profiles).val();
console.log(rejection_reason);

        $(".unverify_button").attr('disabled', 'true');
        $(this).html('Unverify...');
        $(".unlock_button").attr('disabled', 'true');
        
        /* Ajax request to delete the selected profile */
        $.ajax({
            url: homepath + 'api/seller-data/',
            method: "POST",
             //dataType: 'text',
            data: {
                "requested_action_to_take": "unverify_profiles",
                "requested_referral_profile_to_unverify_profiles": requested_referral_profile_to_unverify_profiles,
                "rejection_reason": rejection_reason
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
                    api_fetch_editor_unlock_request_table_data();
                }
            },
            error: function (er, er2, er3) {
                console.log(er3)
                alert("Something went wrong, please refresh the page and try again.")
            }
        })
    });
    /* When Delete is confirmed End */
    
    /* Ajax to get Data from the admin table data api */
    function api_fetch_editor_unlock_request_table_data() {
        $.ajax({
            url: homepath + 'api/seller-data/',
            method: "POST",
          // dataType: 'text',
            data: {
                "requested_action_to_take": "fetch_seller_profiles_request_table_data"
            },
            beforeSend: function () {
                $('#table_container').hide();
                $("#table_loading").show();
            },
            complete: function () {
                $("#table_loading").hide();
            },
            success: function (result) {
                console.log(result)
                if (result.error.number_of_errors > 0) {
                    $("#table_container_card_body").append('<div class="alert alert-danger " role="alert"><strong>' + result.error.error_message + '</strong></div>');
                }
                else {
                    /* Send the received data to refresh datatable function */
                    refresh_datatable(result)

                    /* Save received data to universal variable */
                    all_editors_data = result;
                }
            },
            error: function () {
                $("#table_container_card_body").append('<div class="alert alert-danger " role="alert"><strong>Could not load the table, please refresh the page and try again.</strong></div>');
            }
        })
    }
    /* Ajax to get Data from the admin table data api END */

    /* Function to refresh the datatable with given data */
    function refresh_datatable(input_table_data) {
        if ($.fn.DataTable.isDataTable('#dataTable')) {
            $('#dataTable').DataTable().destroy()
        }

        $('#dataTable').empty()


        $('#dataTable').DataTable({
            dom: 'Blfrtip',
            buttons: ['copy', 'excel'],
            "data": input_table_data.data,
            "columns": input_table_data.columns,
             //columnDefs: [ { type: 'date', 'targets': [2] } ],
             order: [[ 4, 'desc' ]],
        })

        $('#table_container').show();
    }
    /* Function to refresh the datatable with given data END */

    /* Call function to create the table at the start */
    api_fetch_editor_unlock_request_table_data();
    /* Call function to create the table at the start END*/
    
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
			else if($(".job_checkbox:checked").length > 10){
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
			$(".job_checkbox:checked").map(function(){
				$("#delete_selected_list_container").append("<h5>"+all_editors_data.data.find(x => x.id == $(this).attr("id").replace("_checkbox", "")).id+"</h5>");
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
				url : homepath+'api/seller-data/',
				method : "POST",
//dataType : 'text',
				data : {
					"requested_action_to_take" : "delete_profiles",
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
						api_fetch_editor_unlock_request_table_data();
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
});