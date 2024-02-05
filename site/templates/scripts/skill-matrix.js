$(document).ready(function () {
    /* Ajax to get Data from the admin table data api */
    function fetch_skills_request_table_data() {
        $.ajax({
            url: homepath + 'api/skills-matrix/',
            method: "POST",
            // dataType: 'text',
            data: {
                "requested_action_to_take": "fetch_skills_request_table_data"
                // "requested_action_to_take": "fetch_skills_location_request_table_data"
                
            },
            beforeSend: function () {
                $('#table_container').hide();
                $("#table_loading").show();
            },
            complete: function () {
                $("#table_loading").hide();
            },
            success: function (result) {
                console.log(result);
                if (result.error.number_of_errors > 0) {
                    $("#table_container_card_body").append('<div class="alert alert-danger " role="alert"><strong>' + result.error.error_message + '</strong></div>');
                }
                else {
                    /* Send the received data to refresh datatable function */
                    refresh_datatable(result);

                    /* Save received data to universal variable */
                    //all_editors_data = result;
                }
            },
            error: function () {
                $("#table_container_card_body").append('<div class="alert alert-danger " role="alert"><strong>Could not load the table, please refresh the page and try again.1</strong></div>');
            }
        })
    }

    /**search filter */
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
        $("#search-modal").modal('hide');
        $("#search_modal_submit").prop('disabled', false);
        $("#search_modal_submit").html('Search');
        console.log(search_form_details)
        //fetch_columns();


        $.ajax({
            url : homepath+'api/skills-matrix/',
            method : "POST",
        dataType : 'text',
            data : {
                "requested_action_to_take": "fetch_skills_request_table_data",
                "filter_form" : "true",
                "search_form_details" : search_form_details,
                
            },

            beforeSend: function(){
            // 	$('#search-modal').attr('disabled', 'true');
            // 	$('#search-modal').html('Creating...');
            // 	$("#search_modal_error").hide()
            },
            complete: function(){
            // 	$('#search-modal').removeAttr("disabled");
            // 	$('#search-modal').html('Submit');
            },
            success : function(result){
console.log(result)
                if(result.error.number_of_errors > 0){
                    $("#search_modal_error").html(result.error.error_message)
                    $("#search_modal_error").show()
                }
                else{
                    /* Hide the error box and empty the error */
                    $("#search_modal_error").hide()
                    $("#search_modal_error").html("")

                    /* Hide the modal */
                    $("#search-modal").modal('hide');
                    $("#search_modal_submit").prop('disabled', false);
                    $("#search_modal_submit").html('Search');
                     refresh_datatable(result);
                    //  fetch_skills_request_table_data();
                }
            },
            error : function(er, er2, er3){
                $("#search_modal_submit").prop('disabled', false);
                $("#search_modal_submit").html('Search');
console.log(er3)
                $("#search_modal_error").html("Something went wrong, please refresh the page and try again.")
                $("#search_modal_error").show()
            }
        })
    })
    /** Fetch location wise skills */
    /* Ajax to get Data from the admin table data api */
    function fetch_skills_location_request_table_data() {
        $.ajax({
            url: homepath + 'api/skills-matrix/',
            method: "POST",
            // dataType: 'text',
            data: {
                "requested_action_to_take": "fetch_skills_location_request_table_data"
            },
            beforeSend: function () {
                $('#table_container').hide();
                $("#table_loading").show();
            },
            complete: function () {
                $("#table_loading").hide();
            },
            success: function (result) {
            console.log(result);
                if (result.error.number_of_errors > 0) {
                    $("#table_container_card_body").append('<div class="alert alert-danger " role="alert"><strong>' + result.error.error_message + '</strong></div>');
                }
                else {
                    /* Send the received data to refresh datatable function */
                    refresh_location_datatable(result);
                    // refresh_datatable(result);

                    /* Save received data to universal variable */
                    //all_editors_data = result;
                }
            },
            error: function () {
                $("#table_container_card_body").append('<div class="alert alert-danger " role="alert"><strong>Could not load the table, please refresh the page and try again.2</strong></div>');
            }
        })
    }
    /* Ajax to get Data from the admin table data api END */

    /** Fetch candidate count using identify as */
    /* Ajax to get Data from the admin table data api */
    function fetch_skills_identify_as_request_table_data() {
        $.ajax({
            url: homepath + 'api/skills-matrix/',
            method: "POST",
            // dataType: 'text',
            data: {
                "requested_action_to_take": "fetch_skills_identify_as_request_table_data"
            },
            beforeSend: function () {
                $('#table_container').hide();
                $("#table_loading").show();
            },
            complete: function () {
                $("#table_loading").hide();
            },
            success: function (result) {
            console.log(result);
                if (result.error.number_of_errors > 0) {
                    $("#table_container_card_body").append('<div class="alert alert-danger " role="alert"><strong>' + result.error.error_message + '</strong></div>');
                }
                else {
                    /* Send the received data to refresh datatable function */
                    refresh_identify_as_datatable(result);
                    // refresh_datatable(result);

                    /* Save received data to universal variable */
                    //all_editors_data = result;
                }
            },
            error: function () {
                $("#table_container_card_body").append('<div class="alert alert-danger " role="alert"><strong>Could not load the table, please refresh the page and try again.3</strong></div>');
            }
        })
    }
    /* Ajax to get Data from the admin table data api END */
    
    /** Fetch candidate count using experience */
    /* Ajax to get Data from the admin table data api */
    function fetch_skills_experience_request_table_data() {
        $.ajax({
            url: homepath + 'api/skills-matrix/',
            method: "POST",
            // dataType: 'text',
            data: {
                "requested_action_to_take": "fetch_skills_experience_request_table_data"
            },
            beforeSend: function () {
                $('#table_container').hide();
                $("#table_loading").show();
            },
            complete: function () {
                $("#table_loading").hide();
            },
            success: function (result) {
            console.log(result);
                if (result.error.number_of_errors > 0) {
                    $("#table_container_card_body").append('<div class="alert alert-danger " role="alert"><strong>' + result.error.error_message + '</strong></div>');
                }
                else {
                    /* Send the received data to refresh datatable function */
                    refresh_experience_datatable(result);
                    // refresh_datatable(result);

                    /* Save received data to universal variable */
                    //all_editors_data = result;
                }
            },
            error: function () {
                $("#table_container_card_body").append('<div class="alert alert-danger " role="alert"><strong>Could not load the table, please refresh the page and try again.4</strong></div>');
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
            "ordering": false,
            // "order": [[ 1, 'desc' ]],
                //retrieve: true,
                //paging: false,
        })

        $('#table_container').show();

        // if ($.fn.DataTable.isDataTable('#dataTable_location')) {
        //     $('#dataTable_location').DataTable().destroy()
        // }

        // $('#dataTable_location').empty()


        // $('#dataTable_location').DataTable({
        //     dom: 'Blfrtip',
        //     buttons: ['copy', 'excel'],
        //     "data": input_table_data.data,
        //     "columns": input_table_data.columns,
        //     "order": [[ 1, 'desc' ]],
        //         //retrieve: true,
        //         //paging: false,
        // })

        // $('#table_container_location').show();

        // if ($.fn.DataTable.isDataTable('#dataTable_experience')) {
        //     $('#dataTable_experience').DataTable().destroy()
        // }

        // $('#dataTable_experience').empty()


        // $('#dataTable_experience').DataTable({
        //     dom: 'Blfrtip',
        //     buttons: ['copy', 'excel'],
        //     "data": input_table_data.data,
        //     "columns": input_table_data.columns,
        //     "order": [[ 1, 'desc' ]],
        //         //retrieve: true,
        //         //paging: false,
        // })

        // $('#table_container_experience').show();

        // if ($.fn.DataTable.isDataTable('#dataTable_identify_as')) {
        //     $('#dataTable_identify_as').DataTable().destroy()
        // }

        // $('#dataTable_identify_as').empty()


        // $('#dataTable_identify_as').DataTable({
        //     dom: 'Blfrtip',
        //     buttons: ['copy', 'excel'],
        //     "data": input_table_data.data,
        //     "columns": input_table_data.columns,
        //     "order": [[ 1, 'desc' ]],
        //         //retrieve: true,
        //         //paging: false,
        // })

        // $('#table_container_identify_as').show();
    }

    function refresh_location_datatable(input_table_data) {
        if ($.fn.DataTable.isDataTable('#dataTable_location')) {
            $('#dataTable_location').DataTable().destroy()
        }

        $('#dataTable_location').empty()


        $('#dataTable_location').DataTable({
            dom: 'Blfrtip',
            buttons: ['copy', 'excel'],
            "data": input_table_data.data,
            "columns": input_table_data.columns,
            "ordering": false,
            // "order": [[ 1, 'desc' ]],
                //retrieve: true,
                //paging: false,
        })

        $('#table_container_location').show();

    }

    function refresh_identify_as_datatable(input_table_data) {
        if ($.fn.DataTable.isDataTable('#dataTable_identify_as')) {
            $('#dataTable_identify_as').DataTable().destroy()
        }

        $('#dataTable_identify_as').empty()


        $('#dataTable_identify_as').DataTable({
            dom: 'Blfrtip',
            buttons: ['copy', 'excel'],
            "data": input_table_data.data,
            "columns": input_table_data.columns,
            "ordering": false,
            // "order": [[ 1, 'desc' ]],
                //retrieve: true,
                //paging: false,
        })

        $('#table_container_identify_as').show();

    }

    function refresh_experience_datatable(input_table_data) {
        if ($.fn.DataTable.isDataTable('#dataTable_experience')) {
            $('#dataTable_experience').DataTable().destroy()
        }

        $('#dataTable_experience').empty()


        $('#dataTable_experience').DataTable({
            dom: 'Blfrtip',
            buttons: ['copy', 'excel'],
            "data": input_table_data.data,
            "columns": input_table_data.columns,
            "ordering": false,
            // "order": [[ 1, 'desc' ]],
                //retrieve: true,
                //paging: false,
        })

        $('#table_container_experience').show();

    }
    /* Function to refresh the datatable with given data END */

    /* Call function to create the table at the start */
    fetch_skills_request_table_data();
    fetch_skills_identify_as_request_table_data();
    fetch_skills_experience_request_table_data();
    fetch_skills_location_request_table_data();
    console.log("data");
    /* Call function to create the table at the start END*/
});