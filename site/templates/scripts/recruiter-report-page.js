let all_candidate_data;
let profile_to_edit = {};

$(document).ready(function() {

  /* When checkbox is clicked */
  $(document).on("change", ".candidate_checkbox", function () {
    /* Change background colour of the row */
    let row_selection_bg_colour = "#fff";

    if($(this).prop("checked")){
      row_selection_bg_colour = "#f9f9f9";
    }

    $(this).parents("tr").css("background-color", row_selection_bg_colour);
    /* Change background colour of the row End */
  });
  /* When checkbox is clicked End */


  /* Ajax to get Data from the admin table data api */
  function api_fetch_candidate_report_table_data(){
    var url_string = window.location.href;
    console.log(url_string);
    var url_parameters="";
    if(url_string.indexOf("?")!=-1){
          url_parameters = url_string.substr(url_string.indexOf("?") + 1);
    }
    console.log(url_parameters);
    $.ajax({
      url : homepath+'api/api-recruiter-report-page/?'+url_parameters,
      method : "POST",
      // dataType : 'text',
      data : {
        "requested_action_to_take" : "fetch_candidate_report_table"
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
          $("#pills-unlocked-data").append('<div class="alert alert-danger " role="alert"><strong>'+result.error.error_message+'</strong></div>');
        }
        if(result.unlock_error.number_of_errors > 0){
          $("#pills-unlocked-data").append('<div class="alert alert-danger " role="alert"><strong>'+result.unlock_error.error_message+'</strong></div>');
        }
        if(result.download_error.number_of_errors > 0){
          $("#pills-download-data").append('<div class="alert alert-danger " role="alert"><strong>'+result.download_error.error_message+'</strong></div>');
        }
        if(result.time_logs_error.number_of_errors > 0){
          $("#pills-time-logs-data").append('<div class="alert alert-danger " role="alert"><strong>'+result.time_logs_error.error_message+'</strong></div>');
        }
        if(result.viewed_profile_error.number_of_errors > 0){
          $("#pills-viewed-profile-data").append('<div class="alert alert-danger " role="alert"><strong>'+result.viewed_profile_error.error_message+'</strong></div>');
        }
        if(result.offers_history_error.number_of_errors > 0){
          $("#pills-offers-input-data").append('<div class="alert alert-danger " role="alert"><strong>'+result.offers_history_error.error_message+'</strong></div>');
        }
        
          /* Send the received data to refresh datatable function */
          refresh_datatable(result)

          /* Save received data to universal variable */
          all_candidate_data = result;
        
      },
      error : function(){
        $("#table_container_card_body").append('<div class="alert alert-danger " role="alert"><strong>Could not load the table, please refresh the page and try again.</strong></div>');
      }
    })
  }
  /* Ajax to get Data from the admin table data api END */

  /* Function to refresh the datatable with given data */
  function refresh_datatable(input_table_data){
    if($.fn.DataTable.isDataTable( '#unlocked_data_dataTable')){
      $('#unlocked_data_dataTable').DataTable().destroy()
    }
    if ($.fn.DataTable.isDataTable('#download_data_dataTable')) {
      $('#download_data_dataTable').DataTable().destroy()
    }
    if ($.fn.DataTable.isDataTable('#time_log_data_dataTable')) {
      $('#time_log_data_dataTable').DataTable().destroy()
    }
    if ($.fn.DataTable.isDataTable('#viewed_profile_data_dataTable')) {
      $('#viewed_profile_data_dataTable').DataTable().destroy()
    }
    if ($.fn.DataTable.isDataTable('#offers_input_data_dataTable')) {
      $('#offers_input_data_dataTable').DataTable().destroy()
    }

    $('#unlocked_data_dataTable').empty()
    $('#download_data_dataTable').empty()
    $('#time_log_data_dataTable').empty()
    $('#viewed_profile_data_dataTable').empty()
    $('#offers_input_data_dataTable').empty()

    if(input_table_data.unlock_error.number_of_errors == 0){
      $('#unlocked_data_dataTable').DataTable({
        dom: 'Blfrtip',
        buttons: ['copy', 'excel'],
        "data" : input_table_data.unlocked_data,
        "columns" : input_table_data.unlocked_data_columns,
        order: [[ 0, 'desc' ]],
      })
    }

    if(input_table_data.download_error.number_of_errors == 0){
      $('#download_data_dataTable').DataTable({
        dom: 'Blfrtip',
        buttons: ['copy', 'excel'],
        "data" : input_table_data.download_data,
        "columns" : input_table_data.download_data_columns,
        order: [[ 0, 'desc' ]],
      })
    }

    if(input_table_data.time_logs_error.number_of_errors == 0){
      $('#time_log_data_dataTable').DataTable({
        dom: 'Blfrtip',
        buttons: ['copy', 'excel'],
        "data" : input_table_data.time_logs_data,
        "columns" : input_table_data.time_logs_data_columns,
        order: [[ 0, 'desc' ]],
      })
    }

    if(input_table_data.viewed_profile_error.number_of_errors == 0){
      $('#viewed_profile_data_dataTable').DataTable({
        dom: 'Blfrtip',
        buttons: ['copy', 'excel'],
        "data" : input_table_data.viewed_profiles_data,
        "columns" : input_table_data.viewed_profiles_data_columns,
        order: [[ 0, 'desc' ]],
      })
    }

    if(input_table_data.offers_history_error.number_of_errors == 0){
      $('#offers_input_data_dataTable').DataTable({
        dom: 'Blfrtip',
        buttons: ['copy', 'excel'],
        "data" : input_table_data.offers_data,
        "columns" : input_table_data.offers_data_columns,
        order: [[ 0, 'desc' ]],
      })
    }

    $('#table_container').show();
  }
  /* Function to refresh the datatable with given data END */

  /* Call function to create the table at the start */
  api_fetch_candidate_report_table_data();
  // console.log("***");
  /* Call function to create the table at the start END*/
  
});

