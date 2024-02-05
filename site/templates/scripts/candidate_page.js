$(document).ready(function() {
  console.log("candidate_page");
  console.log(homepath+'api/recruiter-manage-candidates/');
  /** Call function when click on download button  */
  $(document).on("click", ".candidate_resume_download", function(){
    /* Array of IDs of profiles to be unlisted, converted to JSON */
    	// console.log($(this).data("id"));
			console.log($(this).prop("id"));
			// let requested_profiles_to_download_json=$(this).attr("id");
			let candidate_download_array=[$(this).attr("id")];
			let requested_profiles_to_download_json = JSON.stringify( candidate_download_array );
console.log(requested_profiles_to_download_json);
    /* Ajax request to unlist the selected profile */
    $.ajax({
      url : homepath+'api/recruiter-manage-candidates/',
      method : "POST",
// dataType : "text",
      data : {
        "requested_action_to_take" : "candidate_resume_download",
        "requested_profiles_to_download_json" : requested_profiles_to_download_json
      },
      success : function(result){
console.log(result)
        /* Refresh the table to update the unlisted profile entries */
        // api_fetch_candidate_table_data("default");

        /* If errors are sent from the back-end */
        if(result.error.number_of_errors > 0){
          alert(result.error.error_message);
        }
        else{
          alert(result.success.success_message);
        }
      },
      error : function(){
        alert("Something went wrong, please refresh the page and try again.")
      }
    })
  });
  /** End Call function when click on download button  */
});
