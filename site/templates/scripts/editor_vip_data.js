let all_editors_data;
let profile_to_edit = {};
$(document).ready(function () {
 
    /* Ajax to get Data from the admin table data api */
    function api_fetch_ticketing_purchase_request_table_data() {
        $.ajax({
            url: homepath + 'api/admin-ticketing-vip-data/',
            method: "POST",
            //dataType: 'text',
            data: {
                "requested_action_to_take": "fetch_ticketing_purchase_request_table_data"
            },
            beforeSend: function () {
                $('#table_container').hide();
                $("#table_loading").show();
            },
            complete: function () {
                $("#table_loading").hide();
            },
            success: function (result) {
                // console.log(result);
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
                $("#table_container_card_body").append('<div class="alert alert-danger " role="alert"><strong>Could not load the table, please refresh the page and try again.</strong></div>');
            }
        });
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
            order: [[ 0, 'desc' ]],
                //retrieve: true,
                //paging: false,
        })

        $('#table_container').show();
    }
    /* Function to refresh the datatable with given data END */

    /* Call function to create the table at the start */
    api_fetch_ticketing_purchase_request_table_data();
    /* Call function to create the table at the start END*/
    
    /* When Delete is confirmed */
    $(document).on("click", ".verify_button", function () {
        /* Array of IDs of profiles to be deleted, converted to JSON */
        let requested_job_fair_to_verify = $(this).attr("id").replace("_verify_button", "");

        /* Ajax request to delete the selected profile */
        $(".verify_button").attr('disabled', 'true');
        $(this).html('Verifying...');
        $(".verify_button").attr('disabled', 'true');
        //$(".verify_button").html('Verify');
        $.ajax({
            url: homepath + 'api/admin-ticketing-vip-data/',
            method: "POST",
            //dataType: 'text',
            data: {
                "requested_action_to_take": "verify_profiles",
                "requested_job_fair_to_verify": requested_job_fair_to_verify
            },
            beforeSend: function () {
                $(this).attr('disabled', 'true');
                $(this).html('Verifing...');
            },
            complete: function () {
                $(this).removeAttr("disabled");
                $(this).html('Unlock');
            },
            success: function (result) {
               // console.log(result);
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

});
