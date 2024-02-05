let all_jobs_data;
let profile_to_edit = {};
let datatable_data;
let url_parameters="";

$(document).ready(function() {
  /* initialize the text editor fields */
  $('#create_new_job_summary').summernote();
  $('#edit_profile_job_summary').summernote();
// 		$('#edit_profile_job_skills').summernote();
// 		$('#create_new_job_skills').summernote();	 
  /* initialize the text editor fields END */

  $(document).on("change","#select_all_checkbox", function(){
    console.log("select all");
    $("#dataTable .job_checkbox").prop('checked', $(this).prop("checked"));
    // $("#select_all_checkbox").html('Unselect All');
    // console.log($("#select_all_checkbox").val());
    console.log($(this).prop("checked"));
  });
  $(document).on("click",".paginate_button", function(){
    console.log("paginate");
    $("#select_all_checkbox").prop('checked','');
    $("#dataTable .job_checkbox").prop('checked','');
  });

  /* When checkbox is clicked */
  $(document).on("change", ".job_checkbox", function () {
    /* Change background colour of the row */
    let row_selection_bg_colour = "#fff";

    if($(this).prop("checked")){
      row_selection_bg_colour = "#f9f9f9";
    }

    $(this).parents("tr").css("background-color", row_selection_bg_colour);
    /* Change background colour of the row End */
  });
  /* When checkbox is clicked End */
  
    /* Profile Image Upload Extension Check */
        $(function () {
          $('#job_profile_image').on("change", function () {
      
      
            let val = $(this).val().toLowerCase();
            let regex = new RegExp("(.*?)\.(jpg|jpeg|png)$");
      
            if (!(regex.test(val))) {
              $(this).val('');
              $("#job_profile_image_label").html("PNG or JPG images only");
              alert('Please upload a .jpg, .jpeg or .png file.');
            } else if (this.files[0].size > 2000000) {
              alert("Please upload a file of size less than 2Mb");
              $(this).val('');
            } else {
              $("#job_profile_image_label").html($(this).val().split("\\").pop());
            }
          });
        });
        /* Profile Image Upload Extension Check End */
        
        /* Profile Image Upload Extension Check */
        $(function () {
          $('#edit_job_profile_image').on("change", function () {
      
      
            let val = $(this).val().toLowerCase();
            let regex = new RegExp("(.*?)\.(jpg|jpeg|png)$");
      
            if (!(regex.test(val))) {
              $(this).val('');
              $("#edit_job_profile_image_label").html("PNG or JPG images only");
              alert('Please upload a .jpg, .jpeg or .png file.');
            } else if (this.files[0].size > 2000000) {
             /* file size 2000000 means 2mb. check file size is greater than 2mb then display alert box.*/
              alert("Please upload a file of size less than 2Mb");
              $(this).val('');
            } else {
              $("#edit_job_profile_image_label").html($(this).val().split("\\").pop());
            }
          });
        });
        /* Profile Image Upload Extension Check End */

  /* When Create New form is submitted */
// 		$(document).on("submit", "#create_new_modal_form_m1", function(event){
// 			/* Prevent submitting automatically*/
// 			event.preventDefault();
// 			event.stopPropagation();

// 			/* Serialize the form data to send */
// 			//let new_job_form_details = JSON.stringify($("#create_new_modal_form").serializeArray());
// 			let form_data_to_send = new FormData($('#create_new_modal_form')[0]);
// 			console.log(form_data_to_send);
// 			console.log("abc");
// 			/* Add the information confirming that this info came from the AJAX call. This will help in case JS does not work in the browser and the form is sent by HTML default. */
// 			//form_data_to_send.append('ajax', 'true');
// 			 var fileInput = document.getElementById('job_profile_image');
//               var file = fileInput.files[0];
//               //var formData = new FormData();
//               form_data_to_send.append('job_profile_image', file);
// //console.log(new_job_form_details)
// 			$.ajax({
// 				url : homepath+'api/admin-manage-jobs/',
// 				method : "POST",
//                 //dataType : 'text',
//                 data:form_data_to_send,
// 				// data : {
// 				// 	"requested_action_to_take" : "create_job",
// 				// 	"new_job_form_details" : new_job_form_details,
// 				// 	
// 				// },
// 				contentType: false,
// 				processData: false,
// 				beforeSend: function(){
// 					$('#create_new_modal_submit').attr('disabled', 'true');
// 					$('#create_new_modal_submit').html('Creating...');
// 					$("#create_new_modal_error").hide()
// 				},
// 				complete: function(){
// 					$('#create_new_modal_submit').removeAttr("disabled");
// 					$('#create_new_modal_submit').html('Submit');
// 				},
// 				success : function(result){
// console.log(result)
// 					if(result.error.number_of_errors > 0){
// 						$("#create_new_modal_error").html(result.error.error_message)
// 						$("#create_new_modal_error").show()
// 					}
// 					else{
// 						/* Hide the error box and empty the error */
// 						$("#create_new_modal_error").hide()
// 						$("#create_new_modal_error").html("")

// 						/* Hide the modal */
// 						$("#create_new_modal").modal('hide');

// 						alert(result.success.success_message);
// console.log(result.success.success_message);
// 						window.location.reload();
// 						//$("#create_new_modal").reset();
// 						/* Refresh the datatable */
// 						api_fetch_job_table_data();
// 					}
// 				},
// 				error : function(er, er2, er3){
// //console.log(er3)
// 					$("#create_new_modal_error").html("Something went wrong, please refresh the page and try again.")
// 					$("#create_new_modal_error").show()
// 				}
// 			})
// 		})
  /* When Create New form is submitted END */

  /* When create new modal has been closed */
  $("#create_new_modal").on("hide.bs.modal", function(){
    document.getElementById("create_new_modal_form").reset();
  })
  /* When create new modal has been closed END */

  /* When edit profile button is clicked */
  $(document).on("click", ".profile_edit_button", function(){
  console.log("===================");
     profile_to_edit = {};
    profile_to_edit.id = $(this).attr("id").replace("_edit_button", "");
    
    console.log(profile_to_edit.id);

    profile_to_edit = datatable_data.find(x=>x.id == profile_to_edit.id);
console.log(profile_to_edit);
    function select_radio_button(name, SelectdValue) {
              $('input[name="' + name+ '"][value="' + SelectdValue + '"]').prop('checked', true);
          }
    
      //$("#edit_profile_job_experience_max").val(profile_to_edit.max_experience);
      //$("#edit_profile_job_experience_max").val("0");
    
      
    $("#edit_profile_job_id").val(profile_to_edit.id);
    $("#edit_profile_job_title").val(decodeHtml(profile_to_edit.title));
  console.log(decodeHtml(profile_to_edit.title));
  //decodeHtml(profile_to_edit.title);
  /* decodeHtml(received_text) function for handling escape characters*/
    function decodeHtml(received_text) {
                  var txt = document.createElement("textarea");
                  txt.innerHTML = received_text;
                  return txt.value;
              }
  
  
  
    $("#edit_profile_job_experience_min").val(profile_to_edit.min_experience);
    select_radio_button("job_experience_min",profile_to_edit.min_experience);
    $("#edit_profile_job_experience_max").val(profile_to_edit.max_experience);
    select_radio_button("job_experience_max",profile_to_edit.max_experience);
    $("#edit_profile_job_application_deadline").val(profile_to_edit.application_deadline);
    
    $("#edit_profile_job_job_code").val(profile_to_edit.job_code);
    $("#edit_profile_job_location").val(profile_to_edit.location);
    $('#edit_profile_job_location').tagator('refresh');
    $("#edit_profile_job_skills").val(profile_to_edit.skills);
    $('#edit_profile_job_skills').tagator('refresh');
    //$("#edit_profile_job_summary").val(profile_to_edit.summary);
    $("#edit_profile_job_company_name").val(profile_to_edit.company_name);
    $("#edit_profile_job_ctc").val(profile_to_edit.ctc);
    $("#edit_profile_job_position").val(profile_to_edit.position);
    $("#edit_profile_job_sector").val(profile_to_edit.job_sector);
    select_radio_button("job_sector",profile_to_edit.job_sector);
    $("#edit_profile_job_type").val(profile_to_edit.job_type);
    $('#edit_profile_job_type').tagator('refresh');
    $("#edit_profile_job_publish_shedule").val(profile_to_edit.job_publish_shedule);
    $("#edit_profile_job_active_status").val(profile_to_edit.active_status);
    select_radio_button("active_status",profile_to_edit.active_status);
    $("#edit_job_profile_image_label").html('PNG or JPG images only');
    $("#edit_job_profile_image").val('');
    $("#upload_job_profile_image").attr("href",profile_to_edit.job_image);
    // console.log(profile_to_edit.job_image);
    
    $('#edit_profile_job_summary').summernote('code', profile_to_edit.summary);
    //$('#edit_profile_job_skills').summernote('code', profile_to_edit.skills);
    $("#edit_profile_hot_job").val(profile_to_edit.hot_jobs);
    select_radio_button("hot_jobs",profile_to_edit.hot_jobs);
    
    $("#edit_profile_modal").modal('show')


  })
  /* When edit profile button is clicked End */

  /* When Edit profile Form is submitted */
// 		$(document).on("submit", "#edit_profile_modal_form_m", function(event){
// 			/* Prevent submitting automatically*/
// 			event.preventDefault();
// 			event.stopPropagation();

// 			/* Serialize the form data to send */
// 			let edit_profile_form_details = $("#edit_profile_modal_form").serializeArray();

// 			/* Add the page ID to be changed */
// 			edit_profile_form_details.push({
// 				"name" : "id",
// 				"value" : profile_to_edit.id
// 			})

// 			edit_profile_form_details = JSON.stringify(edit_profile_form_details);

// 			$.ajax({
// 				url : homepath+'api/admin-manage-jobs/',
// 				method : "POST",
// //dataType : 'text',
// 				data : {
// 					"requested_action_to_take" : "modify_job",
// 					"edit_profile_form_details" : edit_profile_form_details
// 				},
// 				beforeSend: function(){
// 					$("#edit_profile_modal_submit").attr('disabled', 'true');
// 					$("#edit_profile_modal_submit").html('Saving...');
// 					$("#edit_profile_modal_error").hide()
// 				},
// 				complete: function(){
// 					$("#edit_profile_modal_submit").removeAttr("disabled");
// 					$("#edit_profile_modal_submit").html('Submit');
// 				},
// 				success : function(result){
// console.log(result)
// 					if(result.error.number_of_errors > 0){
// 						$("#edit_profile_modal_error").html(result.error.error_message)
// 						$("#edit_profile_modal_error").show()
// 					}
// 					else{
// 						/* Hide the error box and empty the error */
// 						$("#edit_profile_modal_error").hide()
// 						$("#edit_profile_modal_error").html("")

// 						/* Hide the modal */
// 						$("#edit_profile_modal").modal('hide');

// 						/* Show the success message */
// 						alert(result.success.success_message);

// 						/* Refresh the datatable */
// 						api_fetch_job_table_data();
// 					}
// 				},
// 				error : function(er, er2, er3){
// console.log(er3)
// 					$("#edit_profile_modal_error").html("Something went wrong, please refresh the page and try again.")
// 					$("#edit_profile_modal_error").show()
// 				}
// 			})
// 		})
  /* When Edit profile Form is submitted END */

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
    // else if($(".job_checkbox:checked").length > 10){
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
    $(".job_checkbox:checked").map(function(){
      $("#delete_selected_list_container").append("<h5>"+datatable_data.find(x=>x.id == $(this).attr("id").replace("_checkbox", "")).title+"</h5>");
    });

  });
  /* When Delete selected button is clicked End */

  /* When Delete is confirmed */
  $(document).on("click", "#delete_selected_modal_submit", function(){
    /* Array of IDs of profiles to be deleted, converted to JSON */
    let requested_profiles_to_delete_json = JSON.stringify( $(".job_checkbox:checked").map(function(){
      return $(this).attr("id").replace("_checkbox", "");
    }).get());
    console.log(requested_profiles_to_delete_json);
    /* Ajax request to delete the selected profile */
    $.ajax({
      url : homepath+'api/editor-manage-jobs/',
      method : "POST",
//dataType : 'text',
      data : {
        "requested_action_to_take" : "delete_jobs",
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
console.log(result)
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
          // api_fetch_job_table_data();
          fetch_columns();
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
// 		function api_fetch_job_table_data(){ 
// 			var current = new Date();
// 			$.ajax({
// 				url : homepath+'api/admin-manage-jobs/',
// 				method : "POST",
// //dataType : 'text',
// 				data : {
// 					"requested_action_to_take" : "fetch_job_table_data"
// 				},
// 				beforeSend: function(){
// console.log("beforeSend");
// console.log(current.toLocaleTimeString());

// 					$('#table_container').hide();
// 					$("#table_loading").show();
// 				},
// 				complete: function(){
// 					$("#table_loading").hide();
// console.log("complete");
// console.log(current.toLocaleTimeString());
// 				},
// 				success : function(result){
// console.log("success1");
// let temp_time=current.toLocaleTimeString();
// console.log(temp_time);
// console.log(result)

// 					if(result.error.number_of_errors > 0){
// 						$("#table_container_card_body").append('<div class="alert alert-danger " role="alert"><strong>'+result.error.error_message+'</strong></div>');
// 					}
// 					else{
// 						/* Send the received data to refresh datatable function */
// 						$("#select_all_checkbox").prop('checked','');
// 						refresh_datatable(result)

// 						/* Save received data to universal variable */
// 						all_jobs_data = result;
// 						console.log("1");
// 						console.log(all_jobs_data);
// 					}
// console.log("success2");
// temp_time=current.toLocaleTimeString();
// console.log(temp_time);
// 				},
// 				error : function(){
// 					$("#table_container_card_body").append('<div class="alert alert-danger " role="alert"><strong>Could not load the table, please refresh the page and try again.</strong></div>');
// 				}
// 			})
// console.log("end");
// console.log(current.toLocaleTimeString());
// 		}

  function fetch_columns(){
    var url_string = window.location.href;
    console.log(url_string);
    var url_parameters="";
    if(url_string.indexOf("?")!=-1){
          url_parameters = url_string.substr(url_string.indexOf("?") + 1);
    }
    console.log(url_parameters);     
    $.ajax({
        url : homepath+'api/editor-manage-jobs/?'+url_parameters,

        method : "POST",
// dataType : 'text',

        data : {
          "requested_action_to_take" : "fetch_job_table_data",
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
            refresh_datatable();
            /* Save received data to universal variable */
             all_jobs_data = result;
             console.log(all_jobs_data);
          }
        },
        error : function(){
          $("#table_container_card_body").append('<div class="alert alert-danger " role="alert"><strong>Something went wrong, please refresh the page and try again.</strong></div>');
        }
      });
    }

    function refresh_datatable(){
      //	function refresh_datatable(search_filter_data){
        //fetch_columns();
        var url_string = window.location.href;
					console.log(url_string);
					var url_parameters="";
					if(url_string.indexOf("?")!=-1){
								url_parameters = url_string.substr(url_string.indexOf("?") + 1);
					}
					console.log(url_parameters);
        console.log("222");
        if($.fn.DataTable.isDataTable( '#dataTable')){
          $('#dataTable').DataTable().destroy()
        }
  
        $('#dataTable').empty()

        $('#dataTable').DataTable({
               //dom: 'tlip',
            dom: 'Blfrtip',
            buttons: ['copy', 'excel'],
            "order": [[ 3, "desc" ]],
          "processing": true,
          "searching": true,
              ajax: {
                url: homepath + "api/editor-manage-jobs/?"+url_parameters,
                type: 'POST',
                data:{
                  "requested_action_to_take" : "fetch_job_table_data",
                },
              },
              "drawCallback": function (settings) { 
                // Here the response
                var response = settings.json;
                datatable_data=response.data;
                console.log("setting json");
                console.log(datatable_data);
            },
            "columns":datatable_columns,
            "serverSide": true,
            "searching": true

        });

      $('#table_container').show();
    }




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
  // 		order: [[ 2, 'desc' ]],
  // 	})

  // 	$('#table_container').show();
  // }
  /* Function to refresh the datatable with given data END */

  /* Call function to create the table at the start */
  // api_fetch_job_table_data();
  fetch_columns();
  /* Call function to create the table at the start END*/
  
  
  $(document).on("click", ".unlock_button", function () {
      /* Array of IDs of profiles to be deleted, converted to JSON */
      let requested_job_profile_to_unlock = $(this).attr("id").replace("_unlock_button", "");

      /* Ajax request to delete the selected profile */
      $.ajax({
          url: homepath + 'api/editor-manage-jobs/',
          method: "POST",
          // dataType: 'text',
          data: {
              "requested_action_to_take": "unlock_profiles",
              "requested_job_profile_to_unlock": requested_job_profile_to_unlock
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
                  // api_fetch_job_table_data();
                  fetch_columns();
                  //window.location.reload();
              }
          },
          error: function (er, er2, er3) {
              console.log(er3)
              alert("Something went wrong, please refresh the page and try again.")
          }
      })
  });
  
     /* When Delete is confirmed */
  $(document).on("click", ".unverify_button", function () {
      /* Array of IDs of profiles to be deleted, converted to JSON */
      let requested_job_profile_to_unverify_profiles = $(this).attr("id").replace("_unverify_button", "");
//console.log();

      $(".unverify_button").attr('disabled', 'true');
      $(".unverify_button").html('Unverify...');
      $(".unlock_button").attr('disabled', 'true');
      $(".unlock_button").html('Unverify...');
      /* Ajax request to delete the selected profile */
      $.ajax({
          url: homepath + 'api/editor-manage-jobs/',
          method: "POST",
           //dataType: 'text',
          data: {
              "requested_action_to_take": "unverify_profiles",
              "requested_job_profile_to_unverify_profiles": requested_job_profile_to_unverify_profiles
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
                  // api_fetch_job_table_data();
                  fetch_columns();
              }
          },
          error: function (er, er2, er3) {
              console.log(er3)
              alert("Something went wrong, please refresh the page and try again.")
          }
      })
  });
  /* When Delete is confirmed End */

  /* verify multiple jobs using multi_verify_button */
  $(document).on("click", "#multi_verify_button", function(){

    $("#multi_verify_button").attr('disabled', 'true');
    $("#multi_verify_button").html('Please Wait...');
    $("#multi_unverify_button").attr('disabled', 'true');
    $("#multi_unverify_button").html('Please Wait...');
    $(".unverify_button").attr('disabled', 'true');
    $(".unverify_button").html('Please Wait...');
    $(".unlock_button").attr('disabled', 'true');
    $(".unlock_button").html('Please Wait...');
    

    /* If no profile checkbox is selected */
    if($(".job_checkbox:checked").length == 0){
      event.preventDefault();
      alert("Please select a profile!");
        $("#multi_verify_button").removeAttr("disabled");
        $("#multi_verify_button").html('<i class="[ mr-2 ][ fas fa-unlock ]"></i> Verify');
        $("#multi_unverify_button").removeAttr("disabled");
        $("#multi_unverify_button").html('<i class="[ mr-2 ][ fas fa-lock ]"></i> Draft');
        $(".unverify_button").removeAttr("disabled");
        $(".unverify_button").html('<i class="[ mr-2 ][ fas fa-ban ]"> Unverify');
        $(".unverify_button").css("font-family", "inherit");
        $(".unlock_button").removeAttr("disabled");
        $(".unlock_button").html('<i class="[ mr-2 ][ fas fa-unlock ]"> Verify');
        $(".unlock_button").css("font-family", "inherit");
      return false;
      
    }

    /* Array of IDs of profiles to be added to favourite, converted to JSON */
    let requested_profiles_to_verify_json = JSON.stringify( $(".job_checkbox:checked").map(function(){
      return $(this).attr("id").replace("_checkbox", "");
    }).get());

    /* Ajax request to favourite the selected profiles */
    $.ajax({
      url : homepath+'api/editor-manage-jobs/',
      method : "POST",
//dataType : "text",
      data : {
        "requested_action_to_take" : "multiple_job_verify",
        "requested_profiles_to_verify_json" : requested_profiles_to_verify_json
      },
      beforeSend: function () {
        $("#multi_verify_button").attr('disabled', 'true');
        $("#multi_verify_button").html('Please Wait...');
        $("#multi_unverify_button").attr('disabled', 'true');
        $("#multi_unverify_button").html('Please Wait...');
      },
      complete: function () {
        $("#multi_verify_button").removeAttr("disabled");
        $("#multi_verify_button").html('<i class="[ mr-2 ][ fas fa-unlock ]"></i> Verify');
        $("#multi_unverify_button").removeAttr("disabled");
        $("#multi_unverify_button").html('<i class="[ mr-2 ][ fas fa-lock ]"></i> Draft');
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
          // api_fetch_job_table_data();
          fetch_columns();
        }
        
      },
      error : function(){
        alert("Something went wrong, please refresh the page and try again.")
      }
    })
  });
  /* End verify multiple jobs using verify_button */

  /* Un-verify multiple jobs using multi_unverify_button */
  $(document).on("click", "#multi_unverify_button", function(){

    $("#multi_verify_button").attr('disabled', 'true');
    $("#multi_verify_button").html('Please Wait...');
    $("#multi_unverify_button").attr('disabled', 'true');
    $("#multi_unverify_button").html('Please Wait...');
    $(".unverify_button").attr('disabled', 'true');
    $(".unverify_button").html('Please Wait...');
    $(".unlock_button").attr('disabled', 'true');
    $(".unlock_button").html('Please Wait...');

    /* If no profile checkbox is selected */
    if($(".job_checkbox:checked").length == 0){
      event.preventDefault();
      alert("Please select a profile!");
      $("#multi_verify_button").removeAttr("disabled");
      $("#multi_verify_button").html('<i class="[ mr-2 ][ fas fa-unlock ]"></i> Verify');
      $("#multi_unverify_button").removeAttr("disabled");
      $("#multi_unverify_button").html('<i class="[ mr-2 ][ fas fa-lock ]"></i> Draft');
      $(".unverify_button").removeAttr("disabled");
      $(".unverify_button").html('<i class="[ mr-2 ][ fas fa-ban ]"> Unverify');
      $(".unverify_button").css("font-family", "inherit");
      $(".unlock_button").removeAttr("disabled");
      $(".unlock_button").html('<i class="[ mr-2 ][ fas fa-unlock ]"> Verify');
      $(".unlock_button").css("font-family", "inherit");

      return false;
    }

    /* Array of IDs of profiles to be added to favourite, converted to JSON */
    let requested_profiles_to_unverify_json = JSON.stringify( $(".job_checkbox:checked").map(function(){
      return $(this).attr("id").replace("_checkbox", "");
    }).get());
    console.log(requested_profiles_to_unverify_json);
    /* Ajax request to favourite the selected profiles */
    $.ajax({
      url : homepath+'api/editor-manage-jobs/',
      method : "POST",
//dataType : "text",
      data : {
        "requested_action_to_take" : "multiple_job_unverify",
        "requested_profiles_to_unverify_json" : requested_profiles_to_unverify_json
      },
      beforeSend: function () {
        $("#multi_verify_button").attr('disabled', 'true');
        $("#multi_verify_button").html('Please Wait...');
        $("#multi_unverify_button").attr('disabled', 'true');
        $("#multi_unverify_button").html('Please Wait...');
      },
      complete: function () {
        $("#multi_verify_button").removeAttr("disabled");
        $("#multi_verify_button").html('<i class="[ mr-2 ][ fas fa-unlock ]"></i> Verify');
        $("#multi_unverify_button").removeAttr("disabled");
        $("#multi_unverify_button").html('<i class="[ mr-2 ][ fas fa-lock ]"></i> Draft');
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
          // api_fetch_job_table_data();
          fetch_columns();
        }
        
      },
      error : function(){
        alert("Something went wrong, please refresh the page and try again.")
      }
    })
  });
  /* End Un-verify multiple jobs using unverify_button */


  $.fn.dataTableExt.sErrMode = 'console';

});

