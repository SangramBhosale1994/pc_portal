$(document).ready(function() {
	$(document).on("click", ".apply-button", function(){
	     job_code = $(this).attr("id").replace("job_code_", "");
	     console.log(job_code);
	    
	   // job_code=$('#job_page_job_code').val();
	   // console.log(job_code);
console.log("1");
console.log(homepath+'api/candidate-apply-for-job/');
		/* Ajax to get Data from the candidate-apply-job api*/
		$.ajax({
			url : homepath+'api/candidate-apply-for-job/',
			method : "POST",
// dataType : 'text',
			data : {
				"requested_action_to_take" : "apply_for_job",
				"job_code_to_add" : job_code,
			    
			},
			beforeSend: function(){
				$('.apply-button').prop('disabled', true);

			},
			complete: function(){
				$('.apply-button').prop('disabled', false);
			},
			success : function(result){
console.log(result)
console.log("2");
				if(result.error.number_of_errors > 0){
					alert(result.error.error_message);
				

					if(result.error.error_message === "Please log in and try again."){
						var win = window.open(homepath, '_blank');
						
						if (win) {
						    win.focus();
						} else {
						    alert('Please allow popups for this website');
						}
					}

					if(result.error.error_message === "about_job"){
						$('#about_job_modal').modal('show');
					}

				}
				else{
console.log("3");
					/* Send the received data to refresh datatable function */
					//refresh_datatable(result)


                    	alert(result.success.success_message);
					/* Save received data to universal variable */
					//all_jobs_data = result;
				}
			},
			error : function(er1, er2, er3){
console.log(er3)
console.log("4");
				//alert("Please log in to apply.")
					$('#myModal').modal('show');
			}
		})
		/* Ajax to get Data from the candidate-apply-job api END */
	})
});
