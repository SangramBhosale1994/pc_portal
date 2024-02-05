$(document).ready(function() {
	/* Ajax to get Data from the candidate table data api */
	function api_fetch_candidate_table_data(requested_columns_array_json){
		$.ajax({
			url : homepath+'api/fetch-candidate-table-data/',
			method : "POST",
//dataType: "text",
			data : {
				"requested_columns_array_json" : requested_columns_array_json
			},
			beforeSend: function(){
				$('#table_container').hide();
				$("#table_loading").show();
			},
			complete: function(){
				$("#table_loading").hide();
			},
			success : function(result){
//console.log(result);
				if(result.error.number_of_errors > 0){
					$("#table_container_card_body").append('<div class="alert alert-danger " role="alert"><strong>'+result.error.error_message+'</strong></div>');
				}
				else{
					refresh_datatable(result)
				}
			},
			error : function(){
				$("#table_container_card_body").append('<div class="alert alert-danger " role="alert"><strong>Something went wrong, please refresh the page and try again.</strong></div>');
			}
		})
	}
	/* Ajax to get Data from the candidate table data api END */

	/* Function to refresh the datatable with given data */
	function refresh_datatable(input_table_data){
		if($.fn.DataTable.isDataTable( '#dataTable')){
			$('#dataTable').DataTable().destroy()
		}

		$('#dataTable').empty()


		$('#dataTable').DataTable({
			dom: 'Bfrtip',
			buttons: ['copy', 'excel'],
			"order": [[ 0, "desc" ]],
			"data" : input_table_data.data,
			"columns" : input_table_data.columns
		})

		$('#table_container').show();
	}
	/* Function to refresh the datatable with given data END */

	/* Call function to create the table */
	api_fetch_candidate_table_data("all");
	/* Call function to create the table END*/
});
