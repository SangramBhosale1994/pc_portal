let all_editors_data;
let profile_to_edit = {};

$(document).ready(function () {
    $(document).on("change","#select_all_checkbox", function(){
        console.log("select all");
        $("#job_fair_applicants_dataTable .applicant_checkbox").prop('checked', $(this).prop("checked"));
        // $("#select_all_checkbox").html('Unselect All');
        // console.log($("#select_all_checkbox").val());
        console.log($(this).prop("checked"));
    });
    $(document).on("click",".paginate_button", function(){
        console.log("paginate");
        $("#select_all_checkbox").prop('checked','');
        $("#job_fair_applicants_dataTable .applicant_checkbox").prop('checked','');
    });
    

    $(document).on("change","#select_all_checkbox", function(){
        console.log("select all");
        $("#job_fair_applicants_dataTable .applicant_checkbox").prop('checked', $(this).prop("checked"));
        // $("#select_all_checkbox").html('Unselect All');
        // console.log($("#select_all_checkbox").val());
        console.log($(this).prop("checked"));
    });
    $(document).on("click",".paginate_button", function(){
        console.log("paginate");
        $("#select_all_checkbox").prop('checked','');
        $("#job_fair_applicants_dataTable .applicant_checkbox").prop('checked','');
    });
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
    $(document).on("click", ".profile_edit_button", function () {
        profile_to_edit.id = $(this).attr("id").replace("_edit_button", "");

        profile_to_edit = all_editors_data.data.find(x => x.id == profile_to_edit.id)

        $("#edit_profile_editor_name").val(profile_to_edit.name);
        $("#edit_profile_editor_email").val(profile_to_edit.email);

        $("#edit_profile_modal").modal('show')
    })
    /* When edit profile button is clicked End */

    /* When Edit profile Form is submitted */
    $(document).on("submit", "#edit_profile_modal_form", function (event) {
        /* Prevent submitting automatically*/
        event.preventDefault();
        event.stopPropagation();

        /* Serialize the form data to send */
        let edit_profile_form_details = $("#edit_profile_modal_form").serializeArray();

        /* Add the page ID to be changed */
        edit_profile_form_details.push({
            "name": "id",
            "value": profile_to_edit.id
        })

        edit_profile_form_details = JSON.stringify(edit_profile_form_details);

        $.ajax({
            url: homepath + 'api/admin-manage-editors/',
            method: "POST",
            //dataType : 'text',
            data: {
                "requested_action_to_take": "modify_editor",
                "edit_profile_form_details": edit_profile_form_details
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
                    api_fetch_editor_table_data();
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
    $(document).on("click", "#delete_selected_modal_trigger_button", function (event) {
        /* If no profile checkbox is selected */
        if ($(".editor_checkbox:checked").length == 0) {
            event.preventDefault();
            $("#delete_selected_list_container").html("Please select an entry to delete!");

            /* Keep the delete button in the modal disabled */
            $("#delete_selected_modal_submit").attr("disabled", true);

            return false;
        }
        /* If more than 10 have been selected */
        else if ($(".editor_checkbox:checked").length > 10) {
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
        $(".editor_checkbox:checked").map(function () {
            $("#delete_selected_list_container").append("<h5>" + all_editors_data.data.find(x => x.id == $(this).attr("id").replace("_checkbox", "")).name + "</h5>");
        });

    });
    /* When Delete selected button is clicked End */

    /* When edit profile button is clicked */
    // $(document).on("click", ".sub_user_button", function () {
    //     let sub_user_button_id = $(this).attr("id").replace("_sub_user_button", "");
    //     console.log(sub_user_button_id);

    //     //profile_to_edit = all_editors_data.data.find(x => x.id == profile_to_edit.id)

    //     $("#sub_user_modal").val(sub_user_button_id);
    //     console.log(sub_user_modal.value);
        
    //     //$("#edit_profile_editor_referrer_action").val(profile_to_edit.referrer_action);
    //      //$("#edit_profile_editor_referrer_reason").val(profile_to_edit.referrer_reason);

    //     $("#sub_user_modal").modal('show')
    // })
    /* When edit profile button is clicked End */

    /* When Edit profile Form is submitted */
//     $(document).on("submit", "#sub_user_modal_form", function (event) {
//         /* Prevent submitting automatically*/
//         event.preventDefault();
//         event.stopPropagation();

//         /* Serialize the form data to send */
//         let sub_user_modal_form_details = $("#sub_user_modal_form").serializeArray();
//         //let edit_profile_form_details = new FormData($('#edit_profile_modal_form')[0]);
// console.log(sub_user_modal_form_details);
//         // /* Add the page ID to be changed */
//         // edit_profile_form_details.push({
//         //     "name": "id",
//         //     "value": profile_to_edit.id
//         // })

//         sub_user_modal_form_details = JSON.stringify(sub_user_modal_form_details);

//         $.ajax({
//             url: homepath + 'api/company-data/',
//             method: "POST",
//             //dataType : 'text',
//             data: {
//                 "requested_action_to_take": "subusers_list",
//                 "sub_user_modal_form_details": sub_user_modal_form_details
//             },
//             //  data: {
//             //     "edit_profile_form_details": "edit_profile_form_details"
//             // },
//             // data: edit_profile_form_details,
//             beforeSend: function () {
//                 $("#edit_profile_modal_submit").attr('disabled', 'true');
//                 $("#edit_profile_modal_submit").html('Saving...');
//                 $("#edit_profile_modal_error").hide()
//             },
//             complete: function () {
//                 $("#edit_profile_modal_submit").removeAttr("disabled");
//                 $("#edit_profile_modal_submit").html('Submit');
//             },
//             success: function (result) {
//                 console.log(result)
//                 if (result.error.number_of_errors > 0) {
//                     $("#edit_profile_modal_error").html(result.error.error_message)
//                     $("#edit_profile_modal_error").show()
//                 }
//                 else {
//                     /* Hide the error box and empty the error */
//                     $("#edit_profile_modal_error").hide()
//                     $("#edit_profile_modal_error").html("")

//                     /* Hide the modal */
//                     $("#edit_profile_modal").modal('hide');

//                     /* Show the success message */
//                   alert(result.success.success_message);

//                     /* Refresh the page */
//                     window.location.reload();
//                 }
//             },
//             error: function (er, er2, er3) {
//                 console.log(er3)
//                 $("#edit_profile_modal_error").html("Something went wrong, please refresh the page and try again.")
//                 $("#edit_profile_modal_error").show()
//             }
//         })
//     })
    /* When Edit profile Form is submitted END */
    
    /* When Delete is confirmed */
    $(document).on("click", ".verify_button", function () {
        /* Array of IDs of profiles to be deleted, converted to JSON */
        let requested_job_fair_to_verify = $(this).attr("id").replace("_verify_button", "");

        /* Ajax request to delete the selected profile */
        $(".verify_button").attr('disabled', 'true');
        $(this).html('Accepting...');
        $(".verify_button").attr('disabled', 'true');
        //$(".verify_button").html('Verify');
        $.ajax({
            url: homepath + 'api/job-fair-verification/',
            method: "POST",
           // dataType: 'text',
            data: {
                "requested_action_to_take": "verify_profiles",
                "requested_job_fair_to_verify": requested_job_fair_to_verify
            },
            beforeSend: function () {
                $(this).attr('disabled', 'true');
                $(this).html('Accepting...');
            },
            complete: function () {
                $(this).removeAttr("disabled");
                $(this).html('Accept');
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
                    window.location.reload();
                }
            },
            error: function (er, er2, er3) {
                console.log(er3)
                alert("Something went wrong, please refresh the page and try again.")
            }
        })
    });
    /* When Delete is confirmed End */

            /* Activate multiple profiles using multi_verify_button */
		$(document).on("click", "#multi_verify_button", function(){

			$("#multi_verify_button").attr('disabled', 'true');
			// $("#multi_verify_button").html('Please Wait...');
			/* If no profile checkbox is selected */
			if($(".applicant_checkbox:checked").length == 0){
				event.preventDefault();
				alert("Please select a profile!");
                $("#multi_verify_button").removeAttr("disabled");
                $("#multi_verify_button").html('<i class="[ mr-2 ][ fas fa-check ]"></i> Accept');
                return false;
			}

			/* Array of IDs of profiles to be added to favourite, converted to JSON */
			let requested_profiles_to_verify_json = JSON.stringify( $(".applicant_checkbox:checked").map(function(){
				return $(this).attr("id").replace("_checkbox", "");
			}).get());

			console.log("***********");
			console.log(requested_profiles_to_verify_json);

			/* Ajax request to favourite the selected profiles */
			/**in homepath url add name of api processwire page */
			$.ajax({
				url : homepath+'api/job-fair-verification/',
				method : "POST",
//  dataType : "text",
				data : {
					"requested_action_to_take" : "multiple_profile_verify",
					"requested_profiles_to_verify_json" : requested_profiles_to_verify_json
				},
				beforeSend: function () {
					$("#multi_verify_button").attr('disabled', 'true');
					$("#multi_verify_button").html('Please Wait...');
				},
				complete: function () {
					$("#multi_verify_button").removeAttr("disabled");
					$("#multi_verify_button").html('<i class="[ mr-2 ][ fas fa-check ]"></i> Accept');
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
						api_fetch_job_fair_request_table_data();
						
					}
					
				},
				error : function(){
					alert("Something went wrong, please refresh the page and try again...")
				}
			})
		});
	/* End Activate multiple jobs using multi_verify_button */

    /* Activate multiple profiles using multi_unverify_button */
		$(document).on("click", "#multi_unverify_button", function(){

			$("#multi_unverify_button").attr('disabled', 'true');
			// $("#multi_unverify_button").html('Please Wait...');
			/* If no profile checkbox is selected */
			if($(".applicant_checkbox:checked").length == 0){
				event.preventDefault();
				alert("Please select a profile!");
                $("#multi_unverify_button").removeAttr("disabled");
                $("#multi_unverify_button").html('<i class="[ mr-2 ][ fas fa-times ]"></i> Reject');
                return false;
			}

			/* Array of IDs of profiles to be added to favourite, converted to JSON */
			let requested_profiles_to_unverify_json = JSON.stringify( $(".applicant_checkbox:checked").map(function(){
				return $(this).attr("id").replace("_checkbox", "");
			}).get());

			console.log("***********");
			console.log(requested_profiles_to_unverify_json);

			/* Ajax request to favourite the selected profiles */
			/**in homepath url add name of api processwire page */
			$.ajax({
				url : homepath+'api/job-fair-verification/',
				method : "POST",
//  dataType : "text",
				data : {
					"requested_action_to_take" : "multiple_profile_unverify",
					"requested_profiles_to_unverify_json" : requested_profiles_to_unverify_json
				},
				beforeSend: function () {
					$("#multi_unverify_button").attr('disabled', 'true');
					$("#multi_unverify_button").html('Please Wait...');
				},
				complete: function () {
					$("#multi_unverify_button").removeAttr("disabled");
					$("#multi_unverify_button").html('<i class="[ mr-2 ][ fas fa-times ]"></i> Reject');
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
						api_fetch_job_fair_request_table_data();
						
					}
					
				},
				error : function(){
					alert("Something went wrong, please refresh the page and try again...")
				}
			})
		});
	/* End Activate multiple jobs using multi_unverify_button */
    /* Ajax to get Data from the admin table data api */
    function api_fetch_job_fair_request_table_data() {
        $.ajax({
            url: homepath + 'api/job-fair-verification/',
            method: "POST",
           //dataType: 'text',
            data: {
                "requested_action_to_take": "fetch_job_fair_request_table_data"
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
        // if ($.fn.DataTable.isDataTable('#dataTable')) {
        //     $('#dataTable').DataTable().destroy()
        // }

        // $('#dataTable').empty()


        // $('#dataTable').DataTable({
        //     "data": input_table_data.data,
        //     "columns": input_table_data.columns,
        //     order: [[ 0, 'desc' ]],
        //         //retrieve: true,
        //         //paging: false,
        // })
        
        if ($.fn.DataTable.isDataTable('#lgbt_verified_dataTable')) {
            $('#lgbt_verified_dataTable').DataTable().destroy()
        }
        if ($.fn.DataTable.isDataTable('#job_fair_applicants_dataTable')) {
            $('#job_fair_applicants_dataTable').DataTable().destroy()
        }
        if ($.fn.DataTable.isDataTable('#job_fair_verified_dataTable')) {
            $('#job_fair_verified_dataTable').DataTable().destroy()
        }
        if ($.fn.DataTable.isDataTable('#job_fair_unverified_dataTable')) {
            $('#job_fair_unverified_dataTable').DataTable().destroy()
        }

        $('#lgbt_verified_dataTable').empty()
        $('#job_fair_applicants_dataTable').empty()
        $('#job_fair_verified_dataTable').empty()
        $('#job_fair_unverified_dataTable').empty()


        $('#lgbt_verified_dataTable').DataTable({
            order: [[ 0, 'desc' ]],
            "data": input_table_data.job_fair_lgbt_verified_data,
            "columns": input_table_data.columns_lgbt_verified

        })
        $('#job_fair_applicants_dataTable').DataTable({
            dom: 'Blfrtip',
            buttons: ['copy', 'excel'], 
            order: [[ 0, 'desc' ]],
            "data": input_table_data.job_fair_applicants_data,
            "columns": input_table_data.columns_job_fair_applicants

        })
        $('#job_fair_verified_dataTable').DataTable({
             dom: 'Blfrtip',
            buttons: ['copy', 'excel'],
            order: [[ 0, 'desc' ]],
            "data": input_table_data.job_fair_pass_verified_data,
            "columns": input_table_data.columns_all_verified

        })
        $('#job_fair_unverified_dataTable').DataTable({
            dom: 'Blfrtip',
            buttons: ['copy', 'excel'],
            order: [[ 0, 'desc' ]],
            "data": input_table_data.job_fair_pass_unverified_data,
            "columns": input_table_data.columns_all_unverified

        })

        $('#table_container').show();
    }
    /* Function to refresh the datatable with given data END */
    
    	 /* When Delete is confirmed */
    $(document).on("click", ".unverify_button", function () {
        /* Array of IDs of profiles to be deleted, converted to JSON */
        let requested_job_fair_to_unverify_profiles = $(this).attr("id").replace("_unverify_button", "");
//console.log();

        $(".unverify_button").attr('disabled', 'true');
        $(this).html('Rejecting...');
        $(".unverify_button").attr('disabled', 'true');
        /* Ajax request to delete the selected profile */
        $.ajax({
            url: homepath + 'api/job-fair-verification/',
            method: "POST",
             //dataType: 'text',
            data: {
                "requested_action_to_take": "unverify_profiles",
                "requested_job_fair_to_unverify_profiles": requested_job_fair_to_unverify_profiles
            },
            beforeSend: function () {
                $(this).attr('disabled', 'true');
                $(this).html('Rejecting...');
            },
            complete: function () {
                $(this).removeAttr("disabled");
                $(this).html('Reject');
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
                    api_fetch_job_fair_request_table_data();
                }
            },
            error: function (er, er2, er3) {
                console.log(er3)
                alert("Something went wrong, please refresh the page and try again.")
            }
        })
    });
    /* When Delete is confirmed End */

    /* Call function to create the table at the start */
    api_fetch_job_fair_request_table_data();
    /* Call function to create the table at the start END*/
});