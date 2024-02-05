let all_editors_data;
let profile_to_edit = {};

$(document).ready(function () {
    $(document).on("change","#select_all_checkbox", function(){
        console.log("select all");
        $("#dataTable .referrer_checkbox").prop('checked', $(this).prop("checked"));
        // $("#select_all_checkbox").html('Unselect All');
        // console.log($("#select_all_checkbox").val());
        console.log($(this).prop("checked"));
    });
    $(document).on("click",".paginate_button", function(){
        console.log("paginate");
        $("#select_all_checkbox").prop('checked','');
        $("#dataTable .referrer_checkbox").prop('checked','');
    });

    /* When checkbox is clicked */
    $(document).on("change", ".referrer_checkbox", function () {
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
        let referrer_to_edit_id = $(this).attr("id").replace("_edit_button", "");
        console.log(referrer_to_edit_id);

        //profile_to_edit = all_editors_data.data.find(x => x.id == profile_to_edit.id)

        $("#modal_referrer_id").val(referrer_to_edit_id);
        console.log(modal_referrer_id.value);
        
        //$("#edit_profile_editor_referrer_action").val(profile_to_edit.referrer_action);
         //$("#edit_profile_editor_referrer_reason").val(profile_to_edit.referrer_reason);

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
        //let edit_profile_form_details = new FormData($('#edit_profile_modal_form')[0]);
console.log(edit_profile_form_details);
        // /* Add the page ID to be changed */
        // edit_profile_form_details.push({
        //     "name": "id",
        //     "value": profile_to_edit.id
        // })

        edit_profile_form_details = JSON.stringify(edit_profile_form_details);

        $.ajax({
            url: homepath + 'api/referrer-data/',
            method: "POST",
            //dataType : 'text',
            data: {
                "requested_action_to_take": "add_points",
                "edit_profile_form_details": edit_profile_form_details
            },
            //  data: {
            //     "edit_profile_form_details": "edit_profile_form_details"
            // },
            // data: edit_profile_form_details,
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
                console.log(result)
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

                    /* Refresh the page */
                    window.location.reload();
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

    /* When Delete is confirmed */
    $(document).on("click", ".unlock_button", function () {
        /* Array of IDs of profiles to be deleted, converted to JSON */
        let requested_referral_profile_to_unlock = $(this).attr("id").replace("_unlock_button", "");

        /* Ajax request to delete the selected profile */
        $.ajax({
            url: homepath + 'api/referrer-data/',
            method: "POST",
            // dataType: 'text',
            data: {
                "requested_action_to_take": "unlock_profiles",
                "requested_referral_profile_to_unlock": requested_referral_profile_to_unlock
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

     /**When add points to multiple profiles */
    
     $(document).on("click", "#multiple_profile_add_points_btn", function(){
       
        /* If no profile checkbox is selected */
        if($(".referrer_checkbox:checked").length == 0){
            event.preventDefault();
            $("#referrer_points_error_msg").css('display','block');
            $('#referrer_points_modal_body').css('display','none');
            /* Keep the delete button in the modal disabled */
            $("#referrer_points_modal_submit").attr("disabled", true);


            return false;
        }
        /* Enable the delete button in the modal */
        $("#referrer_points_modal_submit").attr("disabled", false);
        $("#referrer_points_error_msg").css('display','none');
        $('#referrer_points_modal_body').css('display','block');

    })
    /**When add points to multiple profiles End */

    /* When add points to multiple profiles */
    $(document).on("submit", "#referrer_points_container_form", function (e) {
        e.preventDefault();
		e.stopPropagation();
        /* Array of IDs of profiles to be deleted, converted to JSON */
        // let requested_referral_profile_to_add_points = $(this).attr("id").replace("_referrer_checkbox", "");
        /* Array of IDs of profiles to be deleted, converted to JSON */
       
        if ($(this).find('input, select, textbox').filter(function(){return this.checkValidity() === false}).length>0){
			$(this).addClass('was-validated');
			alert("Submission failed. Please check if you have filled all fields correctly.");
		}
	    else{
            let requested_referral_profile_to_add_points_json = JSON.stringify( $(".referrer_checkbox:checked").map(function(){
                return $(this).attr("id").replace("_checkbox", "");
            }).get());
            console.log(requested_referral_profile_to_add_points_json);
            

            let referral_points_form_details = JSON.stringify($("#referrer_points_container_form").serializeArray());
            console.log(referral_points_form_details);
            // $(this).attr('disabled', 'true');
            $("#referrer_points_modal_submit").attr("disabled", true);
            // $("#referrer_points_container_form").validate();
            $("#referrer_points_modal_submit").html('Waiting...');

            /* Ajax request to delete the selected profile */
            $.ajax({
                url: homepath + 'api/referrer-data/',
                method: "POST",
                // dataType: 'text',
                data: {
                    "requested_action_to_take": "add_points_multiple_profiles",
                    "requested_referral_profile_to_add_points_id": requested_referral_profile_to_add_points_json,
                    "requested_referral_form_details": referral_points_form_details
                },
                beforeSend: function () {
                    $(this).attr('disabled', 'true');
                    $(this).html('Waiting...');
                },
                complete: function () {
                    $(this).removeAttr("disabled");
                    $(this).html('Add Points');
                },
                success: function (result) {
                    console.log(result)
                    if (result.error.number_of_errors > 0) {
                        alert(result.error.error_message)
                    }
                    else {
                        /* Show the success message */
                        alert(result.success.success_message);
                        $("#points-modal").modal('hide');
                        /* Refresh the page */
                        window.location.reload();
                    }
                },
                error: function (er, er2, er3) {
                    console.log(er3)
                    alert("Something went wrong, please refresh the page and try again.")
                }
            })
        }
    });
    /* When add points to multiple profiles End */
   

    /* Ajax to get Data from the admin table data api */
    function api_fetch_editor_unlock_request_table_data() {
        $.ajax({
            url: homepath + 'api/referrer-data/',
            method: "POST",
           //dataType: 'text',
            data: {
                "requested_action_to_take": "fetch_referral_profiles_request_table_data"
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
            //columnDefs: [ { type: 'date', 'targets': [0] } ],
            order: [[ 0, 'desc' ]],
        })

        $('#table_container').show();
    }
    /* Function to refresh the datatable with given data END */

    /* Call function to create the table at the start */
    api_fetch_editor_unlock_request_table_data();
    /* Call function to create the table at the start END*/
});