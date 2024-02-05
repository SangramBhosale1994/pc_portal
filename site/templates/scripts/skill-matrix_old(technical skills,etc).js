
let all_skills_data;
let profile_to_edit = {};

$(document).ready(function () {
    /* initialize the text editor fields */
    // $('#create_new_event_summary').summernote();
    // $('#edit_event_summary').summernote();
    // $('#create_new_event_speaker_details').summernote();
    // $('#edit_event_speaker_details').summernote();
    /* initialize the text editor fields END */

    /* When checkbox is clicked */
    $(document).on("change", ".event_checkbox", function () {
        /* Change background colour of the row */
        let row_selection_bg_colour = "#fff";

        if ($(this).prop("checked")) {
            row_selection_bg_colour = "#f9f9f9";
        }

        $(this).parents("tr").css("background-color", row_selection_bg_colour);
        /* Change background colour of the row End */
    });
    /* When checkbox is clicked End */



    /* When Edit modal has been closed */
    // $("#edit_profile_modal_form").on("hide.bs.modal", function () {
    //     document.getElementById("edit_profile_modal_form").reset();
    // })
    /* When edit modal has been closed END */

    /* When edit profile button is clicked */
    $(document).on("click", ".skills_edit_button", function () {
        profile_to_edit = {};
        profile_to_edit.id = $(this).attr("id").replace("_skills_edit_button", "");
        console.log(profile_to_edit.id);
       // console.log(all_skills_data);
       // console.log(all_skills_data.skills_data);
        skills_to_edit =all_skills_data.skills_data[profile_to_edit.id];
       // console.log(all_skills_data.skills_data[profile_to_edit.id]);

        $("#edit_skill_title").val(skills_to_edit.key);
        $("#edit_skill_candidates").val(skills_to_edit.number_of_candidates);
        $("#edit_skill_synonym").val(skills_to_edit.synonyms);
        $("#edit_skill_type").val('old_skills_matrix');


        $("#edit_profile_modal").modal('show');


    });
    
     $(document).on("click", ".soft_skills_edit_button", function () {
        profile_to_edit = {};
        profile_to_edit.id = $(this).attr("id").replace("_soft_skills_edit_button", "");
        console.log(profile_to_edit.id);
        // console.log(all_skills_data.data);
        // profile_to_edit = all_skills_data.data.find(x => x.id == profile_to_edit.id);
        soft_skills_to_edit =all_skills_data.soft_skills_data[profile_to_edit.id];

        $("#edit_skill_title").val(soft_skills_to_edit.key);
        $("#edit_skill_candidates").val(soft_skills_to_edit.number_of_candidates);
        $("#edit_skill_synonym").val(soft_skills_to_edit.synonyms);
        $("#edit_skill_type").val('soft_skills_matrix');


        $("#edit_profile_modal").modal('show');


    });
    
     $(document).on("click", ".technical_skills_edit_button", function () {
        profile_to_edit = {};
        profile_to_edit.id = $(this).attr("id").replace("_technical_skills_edit_button", "");
        console.log(profile_to_edit.id);
        // console.log(all_skills_data.data);
        // profile_to_edit = all_skills_data.data.find(x => x.id == profile_to_edit.id);
        technical_skills_to_edit =all_skills_data.technical_skills_data[profile_to_edit.id];

        $("#edit_skill_title").val(technical_skills_to_edit.key);
        $("#edit_skill_candidates").val(technical_skills_to_edit.number_of_candidates);
        $("#edit_skill_synonym").val(technical_skills_to_edit.synonyms);
        $("#edit_skill_type").val('technical_skills_matrix');


        $("#edit_profile_modal").modal('show');


    });
    
     $(document).on("click", ".non_technical_skills_edit_button", function () {
        profile_to_edit = {};
        profile_to_edit.id = $(this).attr("id").replace("_non_technical_skills_edit_button", "");
        console.log(profile_to_edit.id);
        // console.log(all_skills_data.data);
        // profile_to_edit = all_skills_data.data.find(x => x.id == profile_to_edit.id);
        non_technical_skills_to_edit =all_skills_data.non_technical_skills_data[profile_to_edit.id];

        $("#edit_skill_title").val(non_technical_skills_to_edit.key);
        $("#edit_skill_candidates").val(non_technical_skills_to_edit.number_of_candidates);
        $("#edit_skill_synonym").val(non_technical_skills_to_edit.synonyms);
        $("#edit_skill_type").val('non_technical_skills_matrix');


        $("#edit_profile_modal").modal('show');


    })
    /* When edit event button is clicked End */

    /* When Edit event Form is submitted */
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
            url: homepath + 'api/skills-matrix/',
            method: "POST",
            //dataType: 'text',
            data: {
                "requested_action_to_take": "modify_skills",
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

                    /* Refresh the datatable */
                    api_fetch_skills_table_data();
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
        if ($(".event_checkbox:checked").length == 0) {
            event.preventDefault();
            $("#delete_selected_list_container").html("Please select an entry to delete!");

            /* Keep the delete button in the modal disabled */
            $("#delete_selected_modal_submit").attr("disabled", true);

            return false;
        }
        /* If more than 10 have been selected */
        else if ($(".event_checkbox:checked").length > 10) {
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
        $(".event_checkbox:checked").map(function () {
            $("#delete_selected_list_container").append("<h5>" + all_skills_data.data.find(x => x.id == $(this).attr("id").replace("_checkbox", "")).title + "</h5>");
        });

    });
    /* When Delete selected button is clicked End */

    /* When Delete is confirmed */
    $(document).on("click", "#delete_selected_modal_submit", function () {
        /* Array of IDs of profiles to be deleted, converted to JSON */
        let requested_profiles_to_delete_json = JSON.stringify($(".event_checkbox:checked").map(function () {
            return $(this).attr("id").replace("_checkbox", "");
        }).get());

        /* Ajax request to delete the selected profile */
        $.ajax({
            url: homepath + 'api/skills-matrix/',
            method: "POST",
            //dataType : 'text',
            data: {
                "requested_action_to_take": "delete_events",
                "requested_profiles_to_delete_json": requested_profiles_to_delete_json
            },
            beforeSend: function () {
                $("#delete_selected_modal_submit").attr('disabled', 'true');
                $("#delete_selected_modal_submit").html('Deleting...');
                $("#delete_selected_modal_error").hide()
            },
            complete: function () {
                $("#delete_selected_modal_submit").removeAttr("disabled");
                $("#delete_selected_modal_submit").html('Delete Permanently');
            },
            success: function (result) {
                //console.log(result)
                if (result.error.number_of_errors > 0) {
                    $("#delete_selected_modal_error").html(result.error.error_message)
                    $("#delete_selected_modal_error").show()
                }
                else {
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
            error: function (er, er2, er3) {
                //console.log(er3)
                $("#edit_profile_modal_error").html("Something went wrong, please refresh the page and try again.")
                $("#edit_profile_modal_error").show()
            }
        })
    });
    /* When Delete is confirmed End */

    /* Ajax to get Data from the admin table data api */
    function api_fetch_skills_table_data() {
        $.ajax({
            url: homepath + 'api/skills-matrix/',
            method: "POST",
            //dataType: 'text',
            data: {
                "requested_action_to_take": "fetch_skills_matrix_table_data"
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
                    all_skills_data = result;
                    console.log(all_skills_data);
                }
            },
            error: function (e1, e2, e3) {
                //console.log(e3);
                $("#table_container_card_body").append('<div class="alert alert-danger " role="alert"><strong>Could not load the table, please refresh the page and try again.</strong></div>');
            }
        })
    }
    /* Ajax to get Data from the admin table data api END */

    /* Ajax to refresh Data from the admin table data api */
    $(document).on("click", "#refresh_modal_trigger_button", function () {
        //function api_refresh_skill_matrix() {
        $.ajax({
            url: homepath + 'api/skills-matrix/',
            method: "POST",
            // dataType: 'text',
            data: {
                "requested_action_to_take": "refresh_skills"
            },
            beforeSend: function () {
                $("#refresh_modal_trigger_button").attr('disabled', 'true');
                $("#refresh_modal_trigger_button").html('Refreshing...');
                $('#table_container').hide();
                $("#table_loading").show();
            },
            complete: function () {
                $("#refresh_modal_trigger_button").removeAttr("disabled");
                $("#table_loading").hide();
            },
            success: function (result) {
                console.log(result)
                if (result.error.number_of_errors > 0) {
                    $("#table_container_card_body").append('<div class="alert alert-danger " role="alert"><strong>' + result.error.error_message + '</strong></div>');
                }
                else {
                    /* Send the received data to refresh datatable function */
                    api_fetch_skills_table_data();
                    //refresh_datatable(result)

                    /* Save received data to universal variable */
                    all_skills_data = result;
                }
                $("#refresh_modal_trigger_button").attr('disabled', 'false');
                $("#refresh_modal_trigger_button").html('Refresh');
            },
            error: function (e1, e2, e3) {
                // console.log(e3);
                $("#table_container_card_body").append('<div class="alert alert-danger " role="alert"><strong>Could not load the table, please refresh the page and try again.</strong></div>');
            }
        })
    });
    /* Ajax to refresh Data from the admin table data api END */

    /* Function to refresh the datatable with given data */
    function refresh_datatable(input_table_data) {
        if ($.fn.DataTable.isDataTable('#skills_dataTable')) {
            $('#skills_dataTable').DataTable().destroy()
        }
        if ($.fn.DataTable.isDataTable('#soft_skills_dataTable')) {
            $('#soft_skills_dataTable').DataTable().destroy()
        }
        if ($.fn.DataTable.isDataTable('#technical_skills_dataTable')) {
            $('#technical_skills_dataTable').DataTable().destroy()
        }
        if ($.fn.DataTable.isDataTable('#non_technical_skills_dataTable')) {
            $('#non_technical_skills_dataTable').DataTable().destroy()
        }

        $('#skills_dataTable').empty()
        $('#soft_skills_dataTable').empty()
        $('#technical_skills_dataTable').empty()
        $('#non_technical_skills_dataTable').empty()


        $('#skills_dataTable').DataTable({
            order: [[2, 'desc'], [1, 'asc']],
            "data": input_table_data.skills_data,
            "columns": input_table_data.columns

        })
        $('#soft_skills_dataTable').DataTable({
            order: [[2, 'desc'], [1, 'asc']],
            "data": input_table_data.soft_skills_data,
            "columns": input_table_data.columns

        })
        $('#technical_skills_dataTable').DataTable({
            order: [[2, 'desc'], [1, 'asc']],
            "data": input_table_data.technical_skills_data,
            "columns": input_table_data.columns

        })
        $('#non_technical_skills_dataTable').DataTable({
            order: [[2, 'desc'], [1, 'asc']],
            "data": input_table_data.non_technical_skills_data,
            "columns": input_table_data.columns

        })

        $('#table_container').show();
    }
    // $('#dataTable').DataTable();
    // $(document).ready(function () {
    //     $('#skills_dataTable').DataTable(
    //         {
    //             order: [[1, 'desc'], [0, 'asc']],
    //             retrieve: true,
    //             paging: false,
    //             // "aoColumnDefs": [
    //             //     { "aDataSort": [0, 1], "aTargets": [0] },
    //             //     { "aDataSort": [1, 0], "aTargets": [1] },
    //             //     { "aDataSort": [2, 3, 4], "aTargets": [2] }
    //             // ]
    //         }
    //     );
    // });

    // $(document).ready(function () {
    //     $('#soft_skills_dataTable').DataTable(
    //         {
    //             order: [[1, 'desc'], [0, 'asc']],
    //             retrieve: true,
    //             paging: false
    //         }
    //     );
    // });

    // $(document).ready(function () {
    //     $('#technical_skills_dataTable').DataTable(
    //         {
    //             order: [[1, 'desc'], [0, 'asc']],
    //             retrieve: true,
    //             paging: false
    //         }
    //     );
    // });

    // $(document).ready(function () {
    //     $('#non_technical_skills_dataTable').DataTable(
    //         {
    //             order: [[1, 'desc'], [0, 'asc']],
    //             retrieve: true,
    //             paging: false
    //         }
    //     );
    // });

    /* Function to refresh the datatable with given data END */

    /* Call function to create the table at the start */
    api_fetch_skills_table_data();
    //api_refresh_skill_matrix();
    /* Call function to create the table at the start END*/
});